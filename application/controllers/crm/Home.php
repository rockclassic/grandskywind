<?php
defined('BASEPATH') OR exit('No direct script access allowed');
/**
 * @ description : Home Controller
 * @ author : prog106 <prog106@haomun.com>
 * @property Boardbiz $boardbiz
 */
class Home extends CI_Controller {

    // construct
    public function __construct() { // {{{
        parent::__construct();
        $this->load->model('biz/crm/v1/Boardbiz', 'boardbiz');
    } // }}}

    // index
    public function index() { // {{{
        $this->__login_chk();
        $data = $this->boardbiz->get_board();
//        fn_log($data);
        load_admin_view('crm/home', $data);
    } // }}}

    // 로그인 여부 체크
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
