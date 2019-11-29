<?php
defined('BASEPATH') OR exit('No direct script access allowed');
/**
 * @ description : Login Controller
 * @ author : jeromc
 * @property Userbiz $userbiz
 * @property CI_Session $session
 */
class Login extends CI_Controller {

    // construct
    public function __construct() { // {{{
        parent::__construct();
        $this->load->model('biz/crm/v1/Userbiz', 'userbiz');
    } // }}}

    // index
    public function index() { // {{{ // 파트너 로그
        $this->__login_chk();
        $data = array();
        $this->load->view('crm/login', $data);
    } // }}}

    public  function change_pwd(){
//        $this->__login_chk();
        $data = array();
        $this->load->view('crm/change_pwd', $data);
    }
    // ax_login
    public function ax_login() { // {{{

        $params = json_decode(trim(file_get_contents('php://input')), true);
        $return = array(
            'msg' => 'error',
        );
        $user_id = $params['user_id'];
        $user_pw = $params['user_pw'];
        $result = $this->userbiz->login_admin($user_id, $user_pw);
//        fn_log($result);
        if($result['msg'] == "success") {
            $return['msg'] = 'ok';
            $user_info=$result['data'];
            $this->session->set_userdata('user_id', $this->openssl_mem->aes_encrypt($user_id));
            $this->session->set_userdata('user_grade', $this->openssl_mem->aes_encrypt($user_info['hc_grade']));
            $this->session->set_userdata('user_name', $user_info['hc_nm']);
            $this->session->set_userdata('user_idx', $user_info['hc_idx']);
            $this->session->set_userdata('hb_idx', $user_info['hb_idx']);
            $this->session->set_userdata('first', $user_info['first']);
            $this->session->set_userdata('auth_flag', $user_info['auth_flag']);
            $this->session->set_userdata('info_title', $user_info['info_title']); //   등급 명칭
        }else{
            $return['msg'] = '접속이 제한된 계정이거나 아이디, 패스워드가 틀립니다. 다시 확인해 주세요.';
        }
        echo json_encode($return);
    } // }}}

    public function ax_change_pw() { // {{{
        $params = json_decode(trim(file_get_contents('php://input')), true);
        $return = array(
            'msg' => 'error',
        );
        $admin_pw1 =  $params['admin_pw1'];//$this->input->post('admin_pw1', true);
        $admin_pw2 =  $params['admin_pw2'];//$this->input->post('admin_pw2', true);
        $result = $this->userbiz->change_pw_admin($admin_pw1,$admin_pw2);

        if($result['msg'] == "success") {
            $return['msg'] = 'ok';
            $this->session->set_userdata('first', 'N');
            //admin_user_login_log update
        }else{
            $return['msg'] = $result['data'];

        }
        echo json_encode($return);
    } // }}}
    // 중복로그인시 로그아웃 페이지
    public function logout(){
        $this->session->unset_userdata('user_id');
        $this->session->unset_userdata('user_grade');
        $this->session->unset_userdata('user_name');
        $this->session->unset_userdata('user_srl');
        $this->session->unset_userdata('first');
        $this->session->unset_userdata('auth_flag');
        $this->session->unset_userdata('info_title');
        $this->session->unset_userdata('main_title');
        $this->session->unset_userdata('title');
        $this->session->sess_destroy();
        redirect('/crm/', 'refresh');
    }

    // 로그인 여부 체크
    private function __login_chk() { // {{{
        if(defined('USER_ID') && $this->session->userdata('auth_flag')=="Y"&& $this->session->userdata('first') == "N") {
            redirect('/crm/', 'refresh');
            die;
        }elseif(defined('USER_ID') && $this->session->userdata('auth_flag')=="Y"&& $this->session->userdata('first') == "Y"){
            redirect('/crm/login/change_pwd', 'refresh');
            die;
        }
    } // }}}
}
?>
