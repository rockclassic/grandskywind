<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');
/* 
 * @ description : Fileploads Library 
 * @ author : prog106 <prog106@haomun.com>
 */  
class Fileuploads { 
    public function __construct() {
    } 

    // 파일 저장
    public function save_file($file, $path='') { // {{{
        if(!empty($file)) {
            $CI =& get_instance();
            $CI->load->helper('string');
            $code = random_string('alnum', '4');
            $org_info = $file; // name, type, tmp_name, error, size
            $org_file_name = $org_info['name'];
            $tmp_file_name = $org_info['tmp_name'];
            $extension = pathinfo($org_info['name']);
            $new_path = $_SERVER['DOCUMENT_ROOT'].'uploads/'.$path.(!empty($path)?'/':'');
            $new_domain_path = 'http://coinapi.tossway.com/uploads/'.$path.(!empty($path)?'/':'');
            $new_file_name = time().'_'.$code.'.'.$extension['extension']; // 저장할 파일명
            move_uploaded_file($tmp_file_name, $new_path.$new_file_name);
            $return = array(
                'result' => 'success',
                'message' => '',
                'data' => array(
                    'org_name' => $org_file_name,
                    'new_file_name' => $new_domain_path.$new_file_name,
                ),
            );
        } else {
            $return = array(
                'result' => 'error',
                'message' => '파일을 다시 확인해 주세요.',
                'data' => array(),
            );
        }
        return $return;
    } // }}}

}
