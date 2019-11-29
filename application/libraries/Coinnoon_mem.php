<?php
/**
 * @ description : Coinnoon_mem Library 회원정보 암호화 라이브러리
 * @ author : prog106 <prog106@haomun.com>
**/
class Coinnoon_mem {

    var $CI;

    public function __construct()
    {
        $this->CI =& get_instance();
    }

    // 암호화
    function HAOEncrypt($plain_text)
    {
        $iv_len = ENCRYPT_CODE_LENGTH;
        $key = ENCRYPT_CODE_STRING;

        if($iv_len < 3){
            $iv_len = 3;
        }
        else if($iv_len > 15){
            $iv_len = 15;
        }

        $n = strlen($plain_text);
        if ($n % 16) $plain_text .= str_repeat("\0", 16 - ($n % 16));
        $i = 0;

        $enc_text = '';

        while ($iv_len-- >0)
        {
            $enc_text .= chr(mt_rand() & 0xff);
        }

        $iv = substr($key ^ $enc_text, 0, 512);
        $t = 0;
        while($i <$n)
        {
            $block = substr($plain_text, $i, 16) ^ pack('H*', md5($iv));
            $enc_text .= $block;
            $iv = substr($block . $iv, 0, 512) ^ $key;
            $i += 16;
            $t++;
        }

        return (base64_encode($enc_text));
    }

    // 복호화
    function HAODecrypt($enc_text)
    {
        $enc_text = urldecode($enc_text);
        $enc_text = str_replace(" ","+",$enc_text);

        $iv_len = ENCRYPT_CODE_LENGTH;
        $key = ENCRYPT_CODE_STRING;

        $enc_text = base64_decode($enc_text);

        if($iv_len < 3){
            $iv_len = 3;
        }
        else if($iv_len > 15){
            $iv_len = 15;
        }

        $n = strlen($enc_text);
        $i = $iv_len;
        $plain_text = '';
        $iv = substr($key ^ substr($enc_text, 0, $iv_len), 0, 512);
        while($i <$n)
        {
            $block = substr($enc_text, $i, 16);
            $plain_text .= $block ^ pack('H*', md5($iv));
            $iv = substr($block . $iv, 0, 512) ^ $key;
            $i += 16;
        }
        $plain_text = (preg_replace('/\0\x00*$/', '', $plain_text));

        return urldecode($plain_text);
    }

    // 로그인처리
    public function login($user_srl, $user_email, $user_name) { // {{{
        $this->CI->session->set_userdata('user_srl', $user_srl);
        $this->CI->session->set_userdata('user_email', $user_email);
        $this->CI->session->set_userdata('user_name', $user_name);
    } // }}}

    // 로그아웃처리
    public function logout() { // {{{
        $this->CI->session->unset_userdata('user_srl');
        $this->CI->session->unset_userdata('user_email');
        $this->CI->session->unset_userdata('user_name');
    } // }}}

    // 회원레벨
    private function level($user_auth_phone, $user_auth_email, $user_auth_name, $user_auth_idcard, $user_auth_pledge, $user_auth_resident) { // {{{
        $level = 0;
        if($user_auth_phone == 'YES' && $user_auth_email == 'YES') $level += 1; 
        if($user_auth_name == 'YES' || $user_auth_idcard == 'YES') $level += 1;
        if($user_auth_pledge == 'YES') $level += 1;
        if($user_auth_resident == 'YES') $level += 1;
        return $level;
    } // }}}

}
?>
