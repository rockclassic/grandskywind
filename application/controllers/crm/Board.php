<?php
defined('BASEPATH') OR exit('No direct script access allowed');
/**
 * @ description : 고객센터
 * @ author : jeromc
 * @property Boardbiz $boardbiz
 */
class Board extends CI_Controller {

    // construct
    public function __construct() { // {{{
        parent::__construct();
        $this->load->model('biz/crm/v1/Boardbiz', 'boardbiz');
    } // }}}

    // 에디터  by.jeromc 2018-10-29
    public function editor($flag,$srl=0) { // {{{
        $this->__login_chk();
        $data = array();
        $list = $this->boardbiz->get_board_one($flag,$srl);
        $data['list'] = $list['data'];
        $data['srl']=$srl;
        $data['flag']=$flag;
        $data['per_page']=$this->input->get('per_page', true);
        load_admin_view('crm/board/editor', $data);
    } // }}}

    // 공지사항  by.jeromc 2018-10-29
    public function notice() { // {{{
        $this->__login_chk();
        $data = array();
        $param = array();

        $page = $this->input->get('per_page');
        $search_show_yn = $this->input->get('search_show_yn');
        $search_val = $this->input->get('search_val');
        $data['user_grade']=  $this->openssl_mem->aes_decrypt($this->session->userdata('user_grade'));

        if(empty($search_show_yn)&&$search_show_yn=="") $search_show_yn = "-1";
        if($data['user_grade']<=5){
            $search_show_yn="1";
        }
        if(empty($page)) $page = 1;
        $limit = 10;
        $offset = ($page -1) * $limit;
        $param['nt_show_gbn']=$search_show_yn;
        $count = $this->boardbiz->get_notice_count($param);
        $data['count'] = $count['data']['nt_count'];

        $list = $this->boardbiz->get_notice_list($param, $limit, $offset);
        $data['list'] = $list['data'];

        // 페이지 처리
        $this->load->library('pagination');
        $config["per_page"] = $limit;
        $config['base_url'] = '/crm/board/notice/';
        $config['total_rows'] = $data['count'];
        $config['page_query_string'] = TRUE;
        $this->pagination->initialize($config);

        $data['pagination'] = $this->pagination->create_links();
        $data['per_page'] = $page;
        $data['search_show_yn'] = $search_show_yn;
        $data['search_val'] = $search_val;
        load_admin_view('crm/board/notice', $data);
    } // }}}

    // read  by.jeromc 2018-10-29
    public function read($flag,$srl=0) { // {{{
        $this->__login_chk();
        $data = array();
        $list = $this->boardbiz->get_board_one($flag,$srl);
        $data['list'] = $list['data'];
        $data['srl']=$srl;
        $data['flag']=$flag;
        $data['per_page']=$this->input->get('per_page', true);
        load_admin_view('crm/board/read', $data);
    } // }}}

    public function open_read($flag,$srl=0) { // {{{
        if($flag&& $srl>0) {
            $data = array();
            $list = $this->boardbiz->get_board_one($flag, $srl);
            $data['list'] = $list['data'];
            $data['srl'] = $srl;
            $data['flag'] = $flag;
            $data['per_page'] = $this->input->get('per_page', true);
            $this->load->view('crm/board/open_read', $data);
        }else{
            show_error('잘못된 접속을 하셨습니다. 다시 이용해 주세요.', 403);
        }
    } // }}}

    // 게시판 저장 함수 by.jeromc 2018-10-29
    public function writeProc($page=0){
        $this->__login_chk();
        $params=$this->input->post();
//        fn_log($params);
        if(!isset($params['per_page']))$params['per_page']=1;
        $srl=$params['srl'];

        if(!$srl){//insert
            $params['per_page']=1;
        }
        $this->boardbiz->set_bbs($params);
        redirect('crm/board/'.$params['flag'].'/?per_page='.$params['per_page']);
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

    // 1:1 문의  by.jeromc 2018-10-29
    public function ask() { // {{{
        $this->__login_chk();
        $data = array();
        $param = array();

        $page = $this->input->get('per_page');
        $search_ar_state = $this->input->get('search_ar_state');
        $search_val = $this->input->get('search_val');
        $data['user_grade']=  $this->openssl_mem->aes_decrypt($this->session->userdata('user_grade'));

        if(empty($search_ar_state)&&$search_ar_state=="") $search_ar_state = "ALL";
        if(empty($page)) $page = 1;
        $limit = 10;
        $offset = ($page -1) * $limit;
        $param['ar_state']=$search_ar_state;
        $count = $this->boardbiz->get_ask_count($param);
        $data['count'] = $count['data']['nt_count'];

        $list = $this->boardbiz->get_ask_list($param, $limit, $offset);
        $data['list'] = $list['data'];

        // 페이지 처리
        $this->load->library('pagination');
        $config["per_page"] = $limit;
        $config['base_url'] = '/crm/board/notice/';
        $config['total_rows'] = $data['count'];
        $config['page_query_string'] = TRUE;
        $this->pagination->initialize($config);

        $data['pagination'] = $this->pagination->create_links();
        $data['per_page'] = $page;
        $data['search_ar_state'] = $search_ar_state;
        $data['search_val'] = $search_val;
        load_admin_view('crm/board/ask', $data);
    } // }}}

    public function set_ask_answer(){
        $this->__login_chk();
        $params = json_decode(trim(file_get_contents('php://input')), true);
        $return= $this->boardbiz->set_ask_answer($params);
        echo json_encode($return);
    }

    public function get_ask_answer(){
        $this->__login_chk();
        $params = json_decode(trim(file_get_contents('php://input')), true);
        $return= $this->boardbiz->get_ask_answer($params);
        echo json_encode($return);
    }



}
?>
