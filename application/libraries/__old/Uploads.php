<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');
/* 
 * @ description : Uploads Library 
 * @ author : prog106 <prog106@haomun.com>
 */  
class Uploads { 
    var $upload_path;
    var $s3_upload_path;
    public function __construct() {
        $this->upload_path = 'uploads_image';
        $this->s3_upload_path = 'image';
    } 

    public function image($files, $file_header='') { // {{{
        $result = array('result' => 'nok', 'msg' => '업로드에 실패하였습니다.');
        if(!empty($files)) {
            $file_name = $files['imageData']['name'];
            $tmp_name = $files['imageData']['tmp_name'];
            $file_size = $files['imageData']['size'];
            if($file_size > 10000) {
            }
            if(!empty($file_name) && !empty($tmp_name)) {
                $fileParts = pathinfo($files['imageData']['name']);
                $targetPath = $_SERVER['DOCUMENT_ROOT']."/".$this->upload_path; // 임시 보관 PATH
                $CI =& get_instance();
                $CI->load->helper('string');
                $code = random_string('alnum', '4');
                $targetFilename = $file_header.'_'.$code;
                $targetFile = rtrim($targetPath,'/').'/'.$targetFilename.".".$fileParts['extension'];
                $targetFullname = "/".$this->upload_path."/".$targetFilename.".".$fileParts['extension'];
                $finalFullname = PAGEHOST."/".((ENVIRONMENT == 'development') ? $this->upload_path : $this->s3_upload_path)."/".$targetFilename.".".$fileParts['extension'];
                //$targetThumbname = "/uploads/".$targetFilename."_thumb.".$fileParts['extension'];
                $fileTypes = array('jpg','jpeg','png'); // File extensions
                if(in_array($fileParts['extension'],$fileTypes)) {
                    move_uploaded_file($tmp_name,$targetFile);
                    /*$config['image_library'] = 'gd2';
                    $config['source_image'] = $_SERVER['DOCUMENT_ROOT'].$targetFullname;
                    $config['new_image'] = $_SERVER['DOCUMENT_ROOT'].$targetThumbname;
                    //$config['create_thumb'] = TRUE;
                    //$config['maintain_ratio'] = TRUE;
                    $config['width'] = 50;
                    $config['height'] = 50;
                    $this->load->library('image_lib', $config);
                    if(!$this->image_lib->resize()) {
                        echo $this->image_lib->display_errors();
                    } else {
                        unlink($config['source_image']);
                        $result = array(
                            'result' => 'ok',
                            'file_name' => $file_name,
                            'tmp_name' => $targetFullname,
                            'thumb_name' => $targetThumbname,
                        );
                    }*/
                    $result = array(
                        'result' => 'ok',
                        'file_name' => $file_name,
                        'tmp_name' => $targetFullname,
                        'final_name' => $finalFullname,
                    );
                } else {
                    $result = array('result' => 'nok', 'msg' => '지원하는 이미지 형식이 아닙니다.');
                }
            }
        }
        return $result;
    } // }}}

    // 이미지 옮기기
    public function move_image($path) { // {{{
        // path : http://image.gamecoupon.com/images/xxxxxxxxx.png
        $img = explode("/", $path);
        $img_name = $_SERVER['DOCUMENT_ROOT'].$this->upload_path."/".$img[4];
        $target_name = $_SERVER['DOCUMENT_ROOT'].$img[2]."/".$this->s3_upload_path."/".$img[4];
        if(file_exists($img_name) && ENVIRONMENT == 'release') {
            if(copy($img_name, $target_name)) unlink($img_name);
        }
    } // }}}

}
