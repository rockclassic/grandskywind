<?php
defined('BASEPATH') OR exit('No direct script access allowed');
/**
 * @ description : Home Controller
 * @ author : prog106 <prog106@haomun.com>
 * @property Userbiz $userbiz
 */
class Operation extends CI_Controller {

    // construct
    public function __construct() { // {{{
        parent::__construct();
        $this->load->model('biz/crm/v1/Userbiz', 'userbiz');
    } // }}}

    // index
    public function index() { // {{{
        $this->__login();
//        $data=array();
//        load_admin_view('crm/home', $data);
        redirect('/crm/operation/user_setting', 'refresh');
        die;
    } // }}}

    //계정관리 by.jeromc 2018-11-14
    public function user_setting(){
        $this->__login();
        $param=array();
        // url 쿼리
        $search_key = $this->input->get('search_key', true);
        $search_val = $this->input->get('search_val', true);
        $search_grade = $this->input->get('search_grade', true);
        $search_state = $this->input->get('search_state', true);

        if(!empty($search_val)) $param[$search_key] = $search_val;
        if( $search_grade != "ALL")$param['ac_grade']=$search_grade;
        if( $search_state != "ALL")$param['ac_state']=$search_state;

        //paging
        $page = $this->input->get('per_page');
        if(empty($page)) $page = 1;
        $limit = 10;
        $offset = ($page -1) * $limit;
        // 계정 카운트
        $count = $this->userbiz->get_admin_count($param);
        // 계정 답변 리스트
        $list= $this->userbiz->get_admin_list($param, $limit, $offset);
        //계정등급
        $data['infos_array']=infos_array('user_grade');
        $data['count'] = $count['data']['nt_count'];
        $data['list'] = $list['data'];

        // 페이지 처리
        $this->load->library('pagination');
        $config["per_page"] = $limit;
        $config['base_url'] = '/crm/operation/user_setting/';
        $config['total_rows'] = $data['count'];
        $config['page_query_string'] = TRUE;
        $this->pagination->initialize($config);
        $data['pagination'] = $this->pagination->create_links();
        $data['per_page'] = $page;
        $data['search_key'] = $search_key;
        $data['search_val'] = $search_val;
        $data['search_grade'] = $search_grade;
        $data['search_state'] = $search_state;


        load_admin_view('crm/user/setting', $data);
    }


    //  견적 답변 저장 by.jeromc 2018-11-12
    public function set_admin(){
        $this->__login();
        $params = json_decode(trim(file_get_contents('php://input')), true);
        $return= $this->userbiz->set_admin($params);
        echo json_encode($return);
    }

    //fcm by.jeromc 2018-11-16
    public function fcm(){
        $this->__login();
        $param=array();
        // url 쿼리
        $sdate = $this->input->get('sdate');
        $edate = $this->input->get('edate');

        // 날짜 기본값- 일주일
        $time = time();
        if(empty($sdate))$sdate= date("Y-m-d",strtotime("-1 week", $time));
        if(empty($edate))$edate = date("Y-m-d");

        // 검색 조건 만들기
        $param['sdate']=$sdate;
        $param['edate']=$edate;

        //paging
        $page = $this->input->get('per_page');
        if(empty($page)) $page = 1;
        $limit = 10;
        $offset = ($page -1) * $limit;


        $count = $this->userbiz->get_fcm_count($param);
        $data['count'] = $count['data']['nt_count'];

        $list = $this->userbiz->get_fcm_list($param, $limit, $offset);
        $data['list'] = $list['data'];

        // 페이지 처리
        $this->load->library('pagination');
        $config["per_page"] = $limit;
        $config['base_url'] = '/crm/operation/fcm/';
        $config['total_rows'] = $data['count'];
        $config['page_query_string'] = TRUE;
        $this->pagination->initialize($config);

        $data['pagination'] = $this->pagination->create_links();
        $data['per_page'] = $page;
        $data['sdate']=$sdate;
        $data['edate']=$edate;
        load_admin_view('crm/user/fcm', $data);
    }

    //fcm 상세 by.jeromc 2018-11-16
    public function get_fcm_one(){
        $this->__login();
        $params = json_decode(trim(file_get_contents('php://input')), true);
        $return= $this->userbiz->get_fcm_one($params);

        echo json_encode($return);
    }
    // 전체 회원에게 fcm 보내는 함수 by.jeromc 2018-10-18(topic)
    public function send_fcm(){
        $this->__login();
        $params = json_decode(trim(file_get_contents('php://input')), true);
        //{'f_send_idx':$("#f_send_idx").val(),'f_send_msg':$("#f_send_msg").val(),'f_memo':$("#f_memo").val(),'f_title':$("#f_title").val()};
        $topic=$params['f_send_idx'];    //토픽
        if($topic=="user"){ //메세지 타입(1: 고객, 2:회원)
            $type=1;
        }else{
            $type=2;
        }
        $title = $params['f_title']; //title

        $msg =  nl2br($params['f_send_msg']); //메세지
//        $msg =  ($params['f_send_msg']); //메세지
        $message = array(
            "to"=> "/topics/".$topic,
            'data' => array(
                "title" => $title,
                "body" => $msg,//견적 유형을 함께건달.
            ),
            'notification' => array(
                "title" => $title,
                "body" => $msg,
                "sound" => "default"
            ),
        );

        $param['f_ret']=send_fcm($message,$type);
//        $params['f_send_idx'] = json_encode($params['f_send_idx'], JSON_UNESCAPED_UNICODE);

        $param['f_send_idx'] = $topic;//json_encode($topic, JSON_UNESCAPED_UNICODE);
        $param['f_send_msg'] = json_encode($message, JSON_UNESCAPED_UNICODE);
        $param['f_title'] = $title;
        $param['f_memo'] = $params['f_memo'];
        $return=$this->userbiz->set_fcm($param);
        echo json_encode($return);
    }
    // 로그인 여부 체크
    private function __login() { // {{{
        if(defined('USER_ID')&&$this->session->userdata('auth_flag')=="N"){
            redirect('/crm/login', 'refresh');
            die;
        }elseif(defined('USER_ID')&&$this->session->userdata('first')=="Y"){
            redirect('/crm/login', 'refresh');
            die;
        }elseif(!defined('USER_ID')) {
            redirect('/crm/login', 'refresh');
            die;
        }
    } // }}}

    // 제휴처 리스트 사도 랭킹 관리 페이지 by.jeromc 2018-11-22
    public function rank() {
        $this->__login();
        $data = array();
        $param = array();

        $param['ob_officeNm'] = $this->input->post('ob_officeNm', true);
        $param['ob_addr'] = $this->input->post('ob_addr', true);
        $param['ob_tel'] = $this->input->post('ob_tel', true);
        $param['ob_state'] = $this->input->post('ob_state', true);
        $param['orderby'] = $this->input->post('orderby', true);
        if(empty($param['orderby']))$param['orderby']="ob_sado_rank";
        $page = $this->input->get('per_page');

        if(empty($page)) $page = 1;
        $limit = 10;
        $offset = ($page -1) * $limit;
        $count = $this->userbiz->get_rank_count($param);
        $data['count'] = $count['data']['nt_count'];

        $list = $this->userbiz->get_rank_list($param, $limit, $offset);
        $data['list'] = $list['data'];

        // 페이지 처리
        $this->load->library('pagination');
        $config["per_page"] = $limit;
        $config['base_url'] = '/crm/operation/rank/';
        $config['total_rows'] = $data['count'];
        $config['page_query_string'] = TRUE;
        $this->pagination->initialize($config);
        $data['pagination'] = $this->pagination->create_links();
        $data['per_page'] = $page;

        $data['ob_officeNm_param'] = $param['ob_officeNm'];
        $data['ob_addr_param'] = $param['ob_addr'];
        $data['ob_tel_param'] = $param['ob_tel'];
        $data['ob_state_param'] = $param['ob_state'];
        $data['orderby'] = $param['orderby'];

        load_admin_view('/crm/user/rank', $data);
    }
    //rank 변경 by.jeromc 2018-11-22
    public function set_rank(){
        $this->__login();
        $params = json_decode(trim(file_get_contents('php://input')), true);
        $return= $this->userbiz->set_rank($params);

        echo json_encode($return);
    }
    //log by.jeromc 2018-11-23
    public function log(){
        $this->__login();
        $param=array();
        // url 쿼리
        $sdate = $this->input->get('sdate');
        $edate = $this->input->get('edate');

        // 날짜 기본값- 일주일
        $time = time();
        if(empty($sdate))$sdate= date("Y-m-d",strtotime("-2 day", $time));
        if(empty($edate))$edate = date("Y-m-d");

        // 검색 조건 만들기
        $param['sdate']=$sdate;
        $param['edate']=$edate;

        //paging
        $page = $this->input->get('per_page');
        if(empty($page)) $page = 1;
        $limit = 10;
        $offset = ($page -1) * $limit;


        $count = $this->userbiz->get_log_count($param);
        $data['count'] = $count['data']['nt_count'];

        $list = $this->userbiz->get_log_list($param, $limit, $offset);
        $data['list'] = $list['data'];

        // 페이지 처리
        $this->load->library('pagination');
        $config["per_page"] = $limit;
        $config['base_url'] = '/crm/operation/log/';
        $config['total_rows'] = $data['count'];
        $config['page_query_string'] = TRUE;
        $this->pagination->initialize($config);

        $data['pagination'] = $this->pagination->create_links();
        $data['per_page'] = $page;
        $data['sdate']=$sdate;
        $data['edate']=$edate;
        load_admin_view('crm/user/log', $data);
    }

    //log 상세 by.jeromc 2018-11-23
    public function get_log_one(){
        $this->__login();
        $params = json_decode(trim(file_get_contents('php://input')), true);
        $return= $this->userbiz->get_log_one($params);
        $return['action_comment']=json_decode($return['action_comment']);
        fn_log($return);
        echo json_encode($return);
    }

    // point 리스트 사도 랭킹 관리 페이지 by.jeromc 2018-11-27
    public function point() {
        $this->__login();
        $data = array();
        $param = array();

        $param['ob_officeNm'] = $this->input->post('ob_officeNm', true);
        $param['ob_addr'] = $this->input->post('ob_addr', true);
        $param['ob_tel'] = $this->input->post('ob_tel', true);
        $param['ob_state'] = $this->input->post('ob_state', true);
        $param['orderby'] = $this->input->post('orderby', true);
        if(empty($param['orderby']))$param['orderby']="sum_amount";
        $page = $this->input->get('per_page');

        if(empty($page)) $page = 1;
        $limit = 10;
        $offset = ($page -1) * $limit;
        $count = $this->userbiz->get_point_count($param);
        $data['count'] = $count['data']['nt_count'];

        $list = $this->userbiz->get_point_list($param, $limit, $offset);
        $data['list'] = $list['data'];

        // 페이지 처리
        $this->load->library('pagination');
        $config["per_page"] = $limit;
        $config['base_url'] = '/crm/operation/point/';
        $config['total_rows'] = $data['count'];
        $config['page_query_string'] = TRUE;
        $this->pagination->initialize($config);
        $data['pagination'] = $this->pagination->create_links();
        $data['per_page'] = $page;

        $data['ob_officeNm_param'] = $param['ob_officeNm'];
        $data['ob_addr_param'] = $param['ob_addr'];
        $data['ob_tel_param'] = $param['ob_tel'];
        $data['ob_state_param'] = $param['ob_state'];
        $data['orderby'] = $param['orderby'];

        load_admin_view('/crm/user/point', $data);
    }
    // point 리스트 사도 랭킹 관리 페이지 by.jeromc 2018-11-27
    public function point_detail($ob_office_idx) {
        $this->__login();
        $data = array();


        //paging
        $tpage = $this->input->get('t_per_page');
        $page = $this->input->get('per_page');
        if(empty($page)) $page = 1;
        $limit = 10;
        $offset = ($page -1) * $limit;
        $count = $this->userbiz->get_point_d_count($ob_office_idx);
        $data['count'] = $count['data']['nt_count'];

        $list = $this->userbiz->get_point_d_list($ob_office_idx, $limit, $offset);
        $data['list'] = $list['data'];
        $data['ob_office_idx'] = $ob_office_idx;

        $data['sum_point']=fn_point($ob_office_idx);
        $p_dtype=infos_array('p_dtype');
        foreach ( $p_dtype as $k => $v) {
            $data['p_dtype_array'][$v['info_value']]=$v['info_title'];
        }

        // 페이지 처리
        $this->load->library('pagination');
        $config["per_page"] = $limit;
        $config['base_url'] = '/crm/operation/point_detail/'.$ob_office_idx."/";
        $config['total_rows'] = $data['count'];
        $config['page_query_string'] = TRUE;
        $this->pagination->initialize($config);
        $data['pagination'] = $this->pagination->create_links();
        $data['per_page'] = $page;
        $data['t_per_page'] = $tpage;

        load_admin_view('/crm/user/point_detail', $data);
    }
    //point 변경 by.jeromc 2018-11-27
    public function set_point(){
        $this->__login();
        $params = json_decode(trim(file_get_contents('php://input')), true);
        $return= $this->userbiz->set_point($params);

        echo json_encode($return);
    }
    //공통 정보 관리  by.jeromc 2018-11-16
    public function infos(){
        $this->__login();
        $param=array();

        //paging
        $page = $this->input->get('per_page');
        $info_tag = $this->input->get('search_info_tag');
        if($info_tag){
            $page = 1;
            $limit = 0;
        }else {
            if (empty($page)) $page = 1;
            $limit = 10;
        }
        $param['search_info_tag']=$info_tag;
        $offset = ($page -1) * $limit;

        $data['info_tag_array']=infos_array('infos_tag');//$this->userbiz->get_infos_array();

        $count = $this->userbiz->get_infos_count($param);
        $data['count'] = $count['data']['nt_count'];

        $list = $this->userbiz->get_infos_list($param, $limit, $offset);
        $data['list'] = $list['data'];

        // 페이지 처리
        $this->load->library('pagination');
        $config["per_page"] = $limit;
        $config['base_url'] = '/crm/operation/infos/';
        $config['total_rows'] = $data['count'];
        $config['page_query_string'] = TRUE;
        $this->pagination->initialize($config);

        $data['pagination'] = $this->pagination->create_links();
        $data['per_page'] = $page;
        $data['search_info_tag'] = $info_tag;

        load_admin_view('crm/user/infos', $data);
    }
    //fcm 상세 by.jeromc 2018-11-16
    public function get_infos_one(){
        $this->__login();
        $params = json_decode(trim(file_get_contents('php://input')), true);
        $return= $this->userbiz->get_infos_one($params);

        echo json_encode($return);
    }
    // 전체 회원에게 fcm 보내는 함수 by.jeromc 2018-10-18(topic)
    public function set_infos(){
        $this->__login();
        $params = json_decode(trim(file_get_contents('php://input')), true);

        $return=$this->userbiz->set_infos($params);
        echo json_encode($return);
    }

    //푸쉬 알람 by.jeromc 2018-12-14
    public function push(){
        $this->__login();
        $data=array();
        load_admin_view('crm/user/push', $data);
    }
}
?>
