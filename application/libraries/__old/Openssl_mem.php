<?php
/**
 * @ description : Openssl_mem Library 회원정보 암호화 라이브러리
 * @ author : prog106 <prog106@haomun.com>
**/
class Openssl_mem {

    var $CI;

    public function __construct()
    {
        $this->CI =& get_instance();
    }

    public function aes_encrypt($data, $key_type = 'data_encryption_key') { // {{{
        $key = $this->CI->config->item($key_type);
        return base64_encode(openssl_encrypt($data, "aes-256-cbc", $key, true, str_repeat(chr(0), 16)));
    } // }}}

    public function aes_decrypt($data, $key_type = 'data_encryption_key') { // {{{
        $key = $this->CI->config->item($key_type);
        return openssl_decrypt(base64_decode($data), "aes-256-cbc", $key, true, str_repeat(chr(0), 16));
    } // }}}

}
?>
