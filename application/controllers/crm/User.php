<?php
defined('BASEPATH') OR exit('No direct script access allowed');
/**
 * @ description : 세무사 관련
 * @ author : jeromc
 * @property Userbiz $userbiz
 */
class User extends CI_Controller {

    // construct
    public function __construct() { // {{{
        parent::__construct();
        $this->load->model('biz/crm/v1/Userbiz', 'userbiz');
    } // }}}

    // 제휴신청  by.jeromc 2018-11-09
    public function join() { // {{{
        $this->__login_chk();
        $data = array();
        $param = array();

        // url 쿼리
        $search_key = $this->input->get('search_key', true);
        $search_val = $this->input->get('search_val', true);
        $page = $this->input->get('per_page');
        $search_jr_state = $this->input->get('search_jr_state');

        if(empty($search_jr_state)&&$search_jr_state=="") $search_jr_state = "ALL";
        if(!empty($search_val)) $param[$search_key] = $search_val;
        if( $search_jr_state != "ALL")$param['jr_state']=$search_jr_state;

        //paging
        if(empty($page)) $page = 1;
        $limit = 10;
        $offset = ($page -1) * $limit;


        $count = $this->userbiz->get_join_count($param);
        $data['count'] = $count['data']['nt_count'];

        $list = $this->userbiz->get_join_list($param, $limit, $offset);
        $data['list'] = $list['data'];

        // 페이지 처리
        $this->load->library('pagination');
        $config["per_page"] = $limit;
        $config['base_url'] = '/crm/user/join/';
        $config['total_rows'] = $data['count'];
        $config['page_query_string'] = TRUE;
        $this->pagination->initialize($config);

        $data['pagination'] = $this->pagination->create_links();
        $data['per_page'] = $page;
        $data['search_jr_state'] = $search_jr_state;
        $data['search_key'] = $search_key;
        $data['search_val'] = $search_val;
        load_admin_view('crm/user/join', $data);
    } // }}}

    public function set_join_answer(){
        $this->__login_chk();
        $params = json_decode(trim(file_get_contents('php://input')), true);
        $return= $this->userbiz->set_join_answer($params);
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
