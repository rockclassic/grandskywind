<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');
/**
 * @ description : Amazon_s3 Library 
 * @ author : prog106 <prog106@haomun.com>
 */
class Amazon_s3 {
    var $CI;
    var $path;
    var $logpath;
    var $return;
    public function __construct() { // {{{
        $this->CI =& get_instance();
        $this->path = "/var/www/";
        $this->logpath = "/var/www/deploy/log/";
        $this->return = array(
            'msg' => 'error',
            'data' => null,
        );
    } // }}}

    // S3 이미지 올리기
    public function image_upload($img_name=array()) { // {{{
        if(ENVIRONMENT == 'development') {
            $img_path = "/var/www/dev/tossway/uploads_image/";
            $s3_img_path = "s3://pagedev.tossway.com/image/";
        } else if(ENVIRONMENT == 'release') {
            $img_path = "/var/www/work/tossway.com/uploads_image/";
            $s3_img_path = "s3://page.tossway.com/image/";
        }
        if(!empty($img_name)) {
            // 파일이 실제 있는지 체크
            foreach($img_name as $row) {
                $filename = $img_path.$row;
                if(file_exists($filename)) {
                    $repos = $filename;
                    $target_repos = $s3_img_path.$row;
                    $this->s3_upload($repos, $target_repos);
                    $this->rm_file($repos);
                } else {
                }
            }
        } else {
            $repos = $img_path;
            $target_repos = $s3_img_path;
            $this->s3_upload($repos, $target_repos);
            $this->rm_file($repos."*");
        }
    } // }}}

    // S3 html 올리기
    public function html_upload($list) { // {{{
        foreach($list as $k => $v) {
            if(file_exists($k)) $this->s3_upload($k, $v);
        }
    } // }}}

    // S3 전송
    private function s3_upload($repos, $target_repos) { // {{{
        $shell = "/usr/local/bin/./s3cmd -c /var/www/.s3cfg put ";
        //$shell .= "--dry-run ";
        $shell .= "--recursive ";
        $shell .= $repos." ";
        $shell .= $target_repos;
        shell_exec($shell);
    } // }}}

    // S3 전송 후 삭제(필요시 사용) - image
    private function rm_file($repos) { // {{{
        $shell = "rm -f ".$repos;
        shell_exec($shell);
    } // }}}

}
