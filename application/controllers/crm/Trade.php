<?php
defined('BASEPATH') OR exit('No direct script access allowed');
/**
 * @ description : 견적 관련
 * @ author : jeromc
 * @property Tradebiz $tradebiz
 * @property Userbiz $userbiz
 */
class Trade extends CI_Controller {

    // construct
    public function __construct() { // {{{
        parent::__construct();
        $this->load->model('biz/crm/v1/Tradebiz', 'tradebiz');
        $this->load->model('biz/crm/v1/Userbiz', 'userbiz');
    } // }}}

    // 견적 리스트  by.jeromc 2018-11-09
    public function estimate() { // {{{
        $this->__login_chk();
        $data = array();
        $param = array();

        // url 쿼리
        $search_key = $this->input->get('search_key', true);
        $search_val = $this->input->get('search_val', true);
        $page = $this->input->get('per_page');
        $search_em_type = $this->input->get('search_em_type');
        $sdate = $this->input->get('sdate');
        $edate = $this->input->get('edate');
        $chk_only = $this->input->get('chk_only');
        $chk_only_y = $this->input->get('chk_only_y');

        // 날짜 기본값- 일주일
        $time = time();
        if(empty($sdate))$sdate= date("Y-m-d",strtotime("-1 week", $time));
        if(empty($edate))$edate = date("Y-m-d");

        // 검색 조건 만들기
        if(empty($search_em_type)&&$search_em_type=="") $search_em_type = "ALL";
        if(!empty($search_val)) $param[$search_key] = $search_val;
        if( $search_em_type != "ALL")$param['em_type']=$search_em_type;
        $param['sdate']=$sdate;
        $param['edate']=$edate;
        $param['chk_only']=$chk_only;
        $param['chk_only_y']=$chk_only_y;
        //paging
        if(empty($page)) $page = 1;
        $limit = 10;
        $offset = ($page -1) * $limit;
        $data['infos_array']=infos_array('req_type');

        $count = $this->tradebiz->get_estimate_count($param);

        $data['count'] = $count['data']['nt_count'];

        $list = $this->tradebiz->get_estimate_list($param, $limit, $offset);
        foreach ($list['data'] as $k => $v) {
                $tmp = explode("!^!", $v['em_c1']);
                $list['data'][$k]['em_c1']=$tmp[1];
        }
        $data['list'] = $list['data'];

        // 페이지 처리
        $this->load->library('pagination');
        $config["per_page"] = $limit;
        $config['base_url'] = '/crm/trade/estimate/';
        $config['total_rows'] = $data['count'];
        $config['page_query_string'] = TRUE;
        $this->pagination->initialize($config);

        $data['pagination'] = $this->pagination->create_links();
        $data['per_page'] = $page;
        $data['search_em_type'] = $search_em_type;
        $data['search_key'] = $search_key;
        $data['search_val'] = $search_val;
        $data['sdate']=$sdate;
        $data['edate']=$edate;
        $data['chk_only']=$chk_only;
        $data['chk_only_y']=$chk_only_y;
        load_admin_view('crm/trade/estimate', $data);
    } // }}}



    // 견적 상세  by.jeromc 2018-10-29
    public function detail($srl=0) { // {{{
        $this->__login_chk();
        $data = array();

        //paging
        $page = $this->input->get('per_page');
        $tpage = $this->input->get('t_per_page');
        if(empty($page)) $page = 1;
        $limit = 10;
        $offset = ($page -1) * $limit;
        // 견적 상세 정보
        $list_one= $this->tradebiz->get_estimate_one($srl);
        // 견적답변 카운트
        $count = $this->tradebiz->get_estimate_rsp_count($srl);
        // 견적 답변 리스트
        $list_rsp = $this->tradebiz->get_estimate_rsp($srl, $limit, $offset);

        $data['count'] = $count['data']['nt_count'];
        $data['list'] = $list_one['data'];
        $data['rsp'] = $list_rsp['data'];
        $data['srl']=$srl;

        // 페이지 처리
        $this->load->library('pagination');
        $config["per_page"] = $limit;
        $config['base_url'] = '/crm/trade/detail/'.$srl."/";
        $config['total_rows'] = $data['count'];
        $config['page_query_string'] = TRUE;
        $this->pagination->initialize($config);

        $data['pagination'] = $this->pagination->create_links();
        $data['per_page'] = $page;
        $data['t_per_page'] = $tpage;

        load_admin_view('crm/trade/detail', $data);
    } // }}}


    // 답변 상세 by.jeromc 2018-11-12
    public  function get_estimate_answer(){
        $this->__login_chk();
        $params = json_decode(trim(file_get_contents('php://input')), true);
        $limit=10;
        $offset=0;
        $return = $this->tradebiz->get_estimate_answer($params['rs_estmtRsp_idx'], $limit, $offset);
        echo json_encode($return);
    }

    //  견적 답변 저장 by.jeromc 2018-11-12
    public function set_estimate_answer(){
        $params = json_decode(trim(file_get_contents('php://input')), true);
        $return['ret']= $this->tradebiz->set_estimate_answer($params);
        // fcm 전송 고객에게 topic으로 전송
        if($return['ret']['msg'] == 'success') {
//            $topic="partner";    //토픽 :: 세무사
            $topic = "user";    //토픽
            if ($topic == "user") { //메세지 타입(1: 고객, 2:회원)
                $type = 1;
            } else {
                $type = 2;
            }

            $id=user_dvceid($params['em_estmtReq_idx']);
            $title = "답변 등록"; //title
            $msg = "고객님의 견적에 답변이 들어왔습니다.";
            if(count($id)>0) {
                $message = array(
                    'registration_ids' => $id,//모든 세무사 디바이스 ID를 가져와 넣어줘야 함.
                    'data' => array(
                        "title" => $title,
                        "body" => $msg,//견적 유형을 함께건달.
                        "idx" => $params['em_estmtReq_idx'], //idx
                    )
                    /*
                     ,
                    'notification' => array(
                        "title" => $title,
                        "body" => $msg,
                        "sound" => "default"
                    ),
                    */
                );
                $param['f_ret'] = send_fcm($message, $type);
                $param['f_send_idx'] = $id;//json_encode($topic, JSON_UNESCAPED_UNICODE);
                $param['f_send_msg'] = json_encode($message, JSON_UNESCAPED_UNICODE);
                $param['f_title'] = $title;
                $param['f_memo'] = "견적 답변 FCM 발송";
                $return = $this->userbiz->set_fcm($param);
            }else{
                $return['msg'] = 'error';
                $return['data'] = "디바이스 아이디가 없습니다.";

            }
        }
        echo json_encode($return);
    }

    // 답변 상태변경 by.jeromc 2018-11-14
    public function update_rs_state(){
        $this->__login_chk();
        $params = json_decode(trim(file_get_contents('php://input')), true);
        $return= $this->tradebiz->update_rs_state($params);
        echo json_encode($return);
    }

    // 견적 상태변경 by.jeromc 2018-11-14
    public function update_em_state(){
        $this->__login_chk();
        $params = json_decode(trim(file_get_contents('php://input')), true);
        $return= $this->tradebiz->update_em_state($params);
        echo json_encode($return);
    }

    private function __login_chk() { // {{{
        if(defined('USER_ID') && $this->session->userdata('auth_flag')=="Y"&& $this->session->userdata('first') == "N") {

        }elseif(defined('USER_ID') && $this->session->userdata('auth_flag')=="Y"&& $this->session->userdata('first') == "Y"){
            redirect('/crm/login/change_pwd', 'refresh');
            die;
        }else{
            redirect('/crm/login', 'refresh');
            die;
        }
    } // }}}

}
?>
