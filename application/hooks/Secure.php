<?php
function authcheck() {
    // 배치나 데몬은 그냥 패스
    if(isset($_SERVER['REMOTE_ADDR'])) {

        define('HTTPS_SET', $_SERVER['HTTPS']);

        $headers = apache_request_headers();
        $auth_key = $headers['Auth-Key'];
        //print_r($headers);
        //die;

        $test_auth_key = 'LrMgyJaOG8spYK4652PbRoqs3fdZvlcXSxWe95awF1a';
        $CI =& get_instance();
        $method = $CI->router->fetch_method();
        $class = $CI->router->fetch_class();
        $directory = $CI->uri->segment(1);
        $host_arr=explode("sysinfo.",$_SERVER['HTTP_HOST']);

//        fn_log($class."/".$directory."/".$method);
        //fn_log($CI->session->userdata());
        //board/crm/open_read
        define("PAGE_LIMIT", 10); // 모든 게시판 게시글 수
        // 임시 회원 정보
//        $CI->session->set_userdata('user_grade',$CI->openssl_mem->aes_encrypt('9'));
//        $CI->session->set_userdata('office_idx','10');
//        $CI->session->set_userdata(array('user_id' => $CI->openssl_mem->aes_encrypt('jeromc@gmail.com'),'user_grade'=>$CI->openssl_mem->aes_encrypt('9'),'user_srl' => 100,'user_name'=>'제롬씨','auth_flag'=>'Y','first'=>'N'));
        if(empty($auth_key)) {
            if($_POST['auth_key'] !== 'U5tiSICnPORmUJeXjoctq28A7tla8hOz') {
              if(in_array($directory, array('crm'))) {
                    if($CI->session->userdata('user_id')) {
                        if(in_array($host_arr[0], array('crm.','www.'))) {
                            define('USER_ID', $CI->session->userdata('user_id'));
                            define('USER_IDX', $CI->session->userdata('user_idx'));
                        }else{
                            header('Location: http://www.sysinfo.' . $host_arr[1].$_SERVER['REQUEST_URI']);
                        }
                    } else {
                        if ($class == "board"&& $method=="open_read") {

                        }else if($class != 'login') {
                            redirect('/crm/login/', 'refresh');
                            die;
                        }
                    }
                } else if($class == 'home') { // home 페이지 링크 모음 - 나중에 바꾸거나 지울것
                    redirect('/crm/', 'refresh');
                } else if($class == 'test') { // home 페이지 링크 모음 - 나중에 바꾸거나 지울것
                } else if($directory == 'cli') { // crontab
                } else {
                    echo show_deny();
                    //echo $auth_key;
                    die;
                }
            }
            unset($_POST['auth_key']);
            define('SAMPLE', true);
        } else {
                if($test_auth_key === $auth_key) {
                    if(!in_array($directory, array('api')) ) {
                       echo show_deny();
                        die;
                    }else if($host_arr[0]!='api.') {
                            echo show_deny();
                            die;
                    }
                }else{
                    echo show_deny();
                    //echo $auth_key;
                    die;
                }
        }
    }

    //$CI->output->enable_profiler(true);

}
?>
