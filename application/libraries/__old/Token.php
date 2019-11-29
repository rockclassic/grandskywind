<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');
/**
 * @ description : Token Library 
 * @ author : prog106 <prog106@haomun.com>
 */
class Token {
    var $CI;
    var $db;
    var $return;
    public function __construct() { // {{{
        $this->CI =& get_instance();
        $this->CI->load->database();
        $this->db = $this->CI->db;
        $this->return = array(
            'msg' => 'error',
            'data' => null,
        );
    } // }}}

    // token 생성하기
    private function create_token() { // {{{
        $this->CI->load->library('encrypt');
        $encode = $this->CI->encrypt->encode(time().$this->CI->input->server('REMOTE_ADDR').self::random());
        return $encode;
    } // }}}

    // token 등록
    private function regist_token($token=null, $user=null) { // {{{
        // token 이 있는 경우 삭제 후 등록
        if(!empty($token)) self::delete_token($token, $user);
        // 새로운 token 등록
        $new_token = self::create_token();
        $sql_param = array();
        $sql_param['tk_key'] = $new_token;
        if(!empty($user)) $sql_param['tk_user'] = $user;
        $sql_param['tk_expire'] = self::token_time('7'); // 7일 후
        $this->db->insert('user_token', $sql_param);
        return $new_token;
    } // }}}

    // token 갱신하기
    public function refresh_token($token=null, $user=null) { // {{{
        if(!empty($token)) {
            $st = self::check_token($token, $user);
            switch($st) {
                // 없는 token - 새로운 token 발급
                case "error":
                    //$user = null;
                    $new_token = self::regist_token($token, $user);
                    $this->return['msg'] = 'success';
                    $this->return['data'] = $new_token;
                break;
                // 유효기간 종료 - 새로운 token 발급
                case "expired":
                    $new_token = self::regist_token($token, $user);
                    $this->return['msg'] = 'success';
                    $this->return['data'] = $new_token;
                break;
                // 사용자 상이 token - 새로운 비회원 token 발급
                case "error_user":
                    //$user = null;
                    $new_token = self::regist_token($token, $user);
                    $this->return['msg'] = 'success';
                    $this->return['data'] = $new_token;
                break;
                // 정상 token
                case "ok":
                    $this->return['msg'] = 'success';
                    $this->return['data'] = $token;
                break;
            }
        } else {
            $token = self::regist_token();
            $this->return['msg'] = 'success';
            $this->return['data'] = $token;
        }
        return $this->return;
    } // }}}

    // token 삭제하기
    private function delete_token($token, $user=null) { // {{{
        $sql_param = array();
        $sql_param['tk_expire'] = date('Y-m-d H:i:s');
        $where = array();
        $where['tk_key'] = $token;
        if(!empty($user)) $where['tk_user'] = $user;
        $this->db->set($sql_param);
        $this->db->where($where);
        $this->db->update('user_token');
        return $this->db->affected_rows();
    } // }}}

    // 난수 생성하기
    private function random($str='4') { // {{{
        $this->CI->load->helper('string');
        return random_string('alnum', $str);
    } // }}}

    // token 시간 설정 + 1 day
    private function token_time($str='1') { // {{{
        $date = new DateTime(date('Y-m-d H:i:s'));
        $date->modify('+'.$str.' day');
        return $date->format('Y-m-d H:i:s');
    } // }}}

    // token 정상 체크하기
    private function check_token($token, $user=NULL) { // {{{
        if(empty($token)) return 'error';
        $token_info =  self::get_token($token);
        if(empty($token_info)) return 'error';
        if($token_info['tk_expire'] < date('Y-m-d H:i:s')) return 'expired';
        if($token_info['tk_user'] !== $user) return 'error_user';
        return 'ok'; 
    } // }}}

    // token 가져오기
    private function get_token($token=null) { // {{{
        $where = array();
        if(!empty($token)) $where['tk_key'] = $token;
        $this->db->where($where);
        $result = $this->db->get('user_token');
        return $result->row_array();
    } // }}}

}
