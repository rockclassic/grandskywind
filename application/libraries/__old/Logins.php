<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');
/**
 * @ description : Login Library 
 * @ author : prog106 <prog106@haomun.com>
 */
class Logins {
    var $CI;
    public function __construct() { // {{{
        $this->CI =& get_instance();
    } // }}}

    // 로그인 세션 생성하기
    public function set_session($user_srl=null, $user_name=null, $user_email=null, $created_at=null, $user_phone=null) { // {{{
        //$this->CI->load->library('session');
        $this->CI->session->set_userdata('user_srl', $user_srl);
        $this->CI->session->set_userdata('user_name', $user_name);
        $this->CI->session->set_userdata('user_email', $user_email);
        $this->CI->session->set_userdata('created_at', $created_at);
        $this->CI->session->set_userdata('user_phone', $user_phone);
    } // }}}

    // 로그인 세션 초기화
    public function unset_session() { // {{{
        $array_session = array('user_srl', 'user_name', 'user_email', 'created_at', 'user_phone');
        $this->CI->session->unset_userdata($array_session);
    } // }}}

    // 쿠키 생성하기/초기화하기
    public function set_cookie($username=null) { // {{{
        $cookie = array(
            'name' => 'username',
            'value' => $username,
            'expire' => 0,
            'domain' => ROOT_PATH,
            'path' => '/',
        );
        $this->CI->input->set_cookie($cookie);
    } // }}}

}
