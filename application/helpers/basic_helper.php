<?php  if ( ! defined('BASEPATH')) exit('No direct script access allowed');

// 팝업창이면 팝업 닫고
// 아니면 URL을 replace 하거나, back();
if(!function_exists('alertmsg_move')) {
    function alertmsg_move($msg, $url=''){ // {{{
        echo "<html>";
        echo "<head>";
        echo "<meta http-equiv='Content-Type' content='text/html; charset=utf-8'>";
        echo "</head>";
        echo "<body>";
        echo "<script>";
        echo "alert('".$msg."');";
        echo "if(window.opener){";
        if(!empty($url))
            echo "opener.location.replace('".$url."');";
        echo "window.close();";
        echo "}else{";
        if(empty($url))
            echo "history.go(-1);";
        else
            echo "location.replace('".$url."');";
        echo "}";
        echo "</script>";
        echo "</body>";
        echo "</html>";
        exit;
    } // }}}
}

if(!function_exists('alertmsg_move2')) {
    function alertmsg_move2($msg, $url=''){ // {{{
        echo "<html>";
        echo "<head>";
        echo "<meta http-equiv='Content-Type' content='text/html; charset=utf-8'>";
        echo "</head>";
        echo "<body>";
        echo "<script>";
        echo "alert('".$msg."');";
        if(empty($url))
            echo "history.go(-1);";
        else
            echo "location.replace('".$url."');";
        echo "</script>";
        echo "</body>";
        echo "</html>";
        exit;
    } // }}}
}

if(!function_exists('email')) {
    function email() { // {{{
        $email = array(
            'naver.com' => 'naver.com',
            'hanmail.net' => 'hanmail.net',
            'nate.com' => 'nate.com',
            'gmail.com' => 'gmail.com',
            'lycos.co.kr' => 'lycos.co.kr',
            'yahoo.com' => 'yahoo.com',
            'yahoo.co.kr' => 'yahoo.co.kr',
            'empal.com' => 'empal.com',
            'dreamwiz.com' => 'dreamwiz.com',
            'paran.com' => 'paran.com',
            'korea.com' => 'korea.com',
            'chol.com' => 'chol.com',
            'hanmir.com' => 'hanmir.com',
            'hanafos.com' => 'hanafos.com',
            'freechal.com' => 'freechal.com',
            'hotmail.com' => 'hotmail.com',
            'netian.com' => 'netian.com',
        );
        return $email;
    } // }}}
}

if(!function_exists('grade_title')) {
    function grade_title($grade) { // {{{
        //(P/D/G/S/B- 플래티넘/다이아/골드/실버/일반)
        $grade_title = array(
            'P' => '플래티넘',
            'D' => '다이아몬드',
            'G' => '골드',
            'S' => '실버',
            'B' => '일반',
        );
        return isset($grade_title[$grade])?$grade_title[$grade]:null;
    } // }}}
}


if(!function_exists('add_month')) {
    function add_month($ymd_his, $i) { // {{{
        // +i 번째 달의 마지막 날
        $last_day_of_i_th_month = date("t", strtotime(date("Y-m-01", strtotime($ymd_his))." +".$i." month"));
        // 오늘 날짜랑 비교해서 오늘날짜가 더 크면... 이달 1일의 다음달의 마지막날로 넣어줌.. 헥헥
        if(date("d", strtotime($ymd_his)) > $last_day_of_i_th_month){
            return date("Y-m-t H:i:s", strtotime(date("Y-m-01", strtotime($ymd_his))." +".$i." month"));
        }else{
            return date("Y-m-d H:i:s", strtotime($ymd_his." +".$i." month"));
        }
    } // }}}
}

if(!function_exists('file_copy')) {
    /*
    * @param $file_list_arr = 
    *                       array(
    *                            array('file'=>'업로드된 파일 경로', 'folder'=>'업로드할 uploads 하위 폴더명', 'prefix'=>'파일 앞에 붙일 prefix', 'suffix'=>'파일 뒤에 붙일 suffix'),
    *                            array('file'=>'업로드된 파일 경로', 'folder'=>'업로드할 uploads 하위 폴더명', 'prefix'=>'파일 앞에 붙일 prefix', 'suffix'=>'파일 뒤에 붙일 suffix'),
    *                            array('file'=>'업로드된 파일 경로', 'folder'=>'업로드할 uploads 하위 폴더명', 'prefix'=>'파일 앞에 붙일 prefix', 'suffix'=>'파일 뒤에 붙일 suffix'),
    *                       )
    * @return $file_list_arr = 
    *                       array(
    *                           array('file'=>'업로드된 파일 경로', 'folder'=>'업로드할 uploads 하위 폴더명', 'prefix'=>'파일 앞에 붙일 prefix', 'suffix'=>'파일 뒤에 붙일 suffix', 'ret'=>결과, 'msg'=>결과문구, 'new_file'=>이동된 파일)
    *                           array('file'=>'업로드된 파일 경로', 'folder'=>'업로드할 uploads 하위 폴더명', 'prefix'=>'파일 앞에 붙일 prefix', 'suffix'=>'파일 뒤에 붙일 suffix', 'ret'=>결과, 'msg'=>결과문구, 'new_file'=>이동된 파일)
    *                           array('file'=>'업로드된 파일 경로', 'folder'=>'업로드할 uploads 하위 폴더명', 'prefix'=>'파일 앞에 붙일 prefix', 'suffix'=>'파일 뒤에 붙일 suffix', 'ret'=>결과, 'msg'=>결과문구, 'new_file'=>이동된 파일)
    *                       )
    *
    */
    function file_copy($file_list_arr) { // {{{
        $upload_root = $_SERVER['DOCUMENT_ROOT'];
        foreach($file_list_arr as $idx=>$file_row){
            if(empty($file_row['file'])){
                $file_row['ret'] = 'nok';
                $file_row['msg'] = 'no file';
            }
            else{
                $upload_path = '/uploads';
                $original_file_name = $file_row['file'];
                $folder_name_arr = array_key_exists('folder_arr', $file_row) ? $file_row['folder_arr'] : '';
                $file_name_prefix = array_key_exists('prefix', $file_row) ? $file_row['prefix'] : '';
                $file_name_suffix = array_key_exists('suffix', $file_row) ? $file_row['suffix'] : '';
                
                if(!empty($folder_name_arr)){
                    if(is_array($folder_name_arr)){
                        foreach($folder_name_arr as $folder_name){
                            $upload_path .= '/'.$folder_name;
                            if(!is_dir($upload_root.$upload_path)){
                                mkdir($upload_root.$upload_path,0777,TRUE);
                                chmod($upload_root.$upload_path, 0777);
                            }
                        }
                    }
                    else{
                        $upload_path .= '/'.$folder_name;
                        if(!is_dir($upload_root.$upload_path)){
                            mkdir($upload_root.$upload_path,0777,TRUE);
                            chmod($upload_root.$upload_path, 0777);
                        }
                    }
                }
                
                $original_file_ext = explode('.', $original_file_name);
                $original_file_ext =  $original_file_ext[count($original_file_ext)-1];
                $micro_time = round(array_sum(explode(' ', microtime())), 3);
                $new_file_name = $file_name_prefix.($idx.'_'.str_replace('.', '', $micro_time)).$file_name_suffix.'.'.$original_file_ext;

                if (!copy($upload_root.$original_file_name, $upload_root.$upload_path.'/'.$new_file_name)) { // 파일 카피 실패
                    $file_row['ret'] = 'nok';
                    $file_row['msg'] = 'file upload fail';
                    continue;
                }

                $file_row['ret'] = 'ok';
                $file_row['msg'] = 'copy success';
                $file_row['new_file'] = $upload_path.'/'.$new_file_name;
            }

            $file_list_arr[$idx] = $file_row;

        }

        return $file_list_arr;
    } // }}}
}

if(!function_exists('convert_text')) {
    function convert_text($text, $nl2br=true) { // {{{
        if($nl2br) {
            $str = nl2br(strip_tags($text));
        } else {
            $str = strip_tags($text);
        }
        return $str;
    } // }}}
}

if(!function_exists('save_users_log')) {
    function save_users_log($user_srl, $prm, $password=null, $sendmail=null) { // {{{
        if(array_key_exists('HTTP_X_FORWARDED_FOR', $_SERVER)) {
            $ip = $_SERVER['HTTP_X_FORWARDED_FOR'];
        } elseif(array_key_exists('REMOTE_ADDR', $_SERVER)) {
            $ip = $_SERVER['REMOTE_ADDR'];
        } elseif(array_key_exists('HTTP_CLIENT_IP', $_SERVER)) {
            $ip = $_SERVER['HTTP_CLIENT_IP'];
        }
        $prm['user_srl'] = $user_srl;
        /*$prm['user_name'] = $user_name;
        $prm['email1'] = $email1;
        $prm['email2'] = $email2;
        $prm['phone1'] = $phone1;
        $prm['phone2'] = $phone2;
        $prm['phone3'] = $phone3;
        $prm['user_status'] = $user_status;*/
        $sql_param['user_srl'] = $user_srl;
        $sql_param['contents'] = json_encode($prm);
        $sql_param['user_password'] = (!empty($password))?'change':'';
        $sql_param['admin_srl'] = (defined('ADM_USER_SRL'))?ADM_USER_SRL:(!empty($sendmail)?$sendmail:'');
        $sql_param['created_at'] = YMD_HIS;
        $sql_param['ip'] = $ip;
        //$CI =& get_instance();
        //$log = $CI->load->database('default', TRUE);
        //$log->insert('users_log', $sql_param);
    } // }}}
}

if(!function_exists('errorlog')) {
    function errorlog($msg) { // {{{
        $sql_param = array();
        if(!empty($msg)) $sql_param['warn_msg'] = $msg;
        else return false;
        $CI =& get_instance();
        $log = $CI->load->database('default', TRUE);
        $log->insert('warning', $sql_param);
    } // }}}
}

// gmail smtp 로 메일 보내기(lotto@haomun.com) - system 메일
if(!function_exists('sendmail')) {
    function sendmail($to, $subject, $message, $html='html', $from='lotto@haomun.com', $from_name='로또하자') { // {{{
        if(empty($to) || empty($subject) || empty($message)) return false;
        $CI =& get_instance();
        $gmail_smtp = array(
            'protocol' => "smtp",
            'smtp_host' => "ssl://smtp.gmail.com",
            'smtp_port' => "465",//"587",
            'smtp_user' => "lotto@haomun.com",
            'smtp_pass' => "haomun1004",
            'charset' => "utf-8",
            'mailtype' => "html",
            'smtp_timeout' => 10,
        );
        $CI->load->library('email');
        if(ENVIRONMENT == 'development') {
            $to = "prog106@haomun.com";
        }
        $CI->email->from($from, $from_name);
        $CI->email->to($to);
        $CI->email->set_mailtype($html);
        $CI->email->subject($subject);
        $CI->email->message($message);
        //$CI->email->set_alt_message($message);
        $CI->email->send();
    } // }}}
}

// AWS SES smtp 로 메일 보내기 - 사용자 메일
if(!function_exists('sesmail')) {
    function sesmail($to, $subject, $message, $html='html', $from='lotto@haomun.com', $from_name='로또하자') { // {{{
        if(empty($to) || empty($subject) || empty($message)) return false;
        $CI =& get_instance();
        $gmail_smtp = array(
            'protocol' => "smtp",
            'smtp_host' => 'email-smtp.us-east-1.amazonaws.com',
            'smtp_user' => 'AKIAIJLS4KMZJIGHFDGA',
            'smtp_pass' => 'AlMJFgGuzQi2h9kWlZx5yqqoST5AKt1N0gBMiifgHh3A',
            'smtp_port' => 465,
            'charset' => "utf-8",
            'mailtype' => "html",
            'smtp_timeout' => 10,
        );

        $CI->load->library('email');
        if(ENVIRONMENT == 'development') {
            $to = "prog106@haomun.com";
        }
        $CI->email->from($from, $from_name);
        $CI->email->to($to);
        $CI->email->set_mailtype($html);
        $CI->email->subject($subject);
        $CI->email->message($message);

        $CI->email->send();
        //echo $CI->email->print_debugger();
    } // }}}
}

// AWS SES API 로 메일 보내기 - 사용자 메일
if(!function_exists('sesapimail')) {
    function sesapimail($to, $subject, $message) { // {{{
        if(empty($to) || empty($subject) || empty($message)) return false;
        $CI =& get_instance();
        $CI->load->library('curl');

        $curl_url = "http://api.haomun.com/send/email";
        if(ENVIRONMENT == 'development') {
            //$to = 'prog106@haomun.com';
            $curl_url = "http://tapi.haomun.com/send/email";
        }

        // 전달할 코드정보
        $curl_prm = array(
            'from' => 'help@gamecoupon.com', // 발송 이메일
            'code' => 'znIVChequcTRvfBJ', // 인증코드
            'to' => $to, // 수신자 이메일
            'subject' => $subject, // 이메일 제목
            'message' => $message, // 이메일 내용
        );
        $return = $CI->curl->simple_post($curl_url, $curl_prm, array(CURLOPT_BUFFERSIZE => 10, CURLOPT_FAILONERROR => false, CURLOPT_HTTP200ALIASES => array(400)));

        // returncode , returnmessage , data
        $result = json_decode($return, true);
        if(empty($result) || $result['returncode'] != '200') {
            $e = $CI->curl->error_code; // int
            $s = $CI->curl->error_string;
            // SMS 발송 처리를 실패하는 경우 - 로그 남기기
        }
    } // }}}
}

// AWS SES 로 메일 보내기 - 사용자 메일
if(!function_exists('sessendmail')) {
    function sessendmail($to, $subject, $message) { // {{{
        if(empty($to) || empty($subject) || empty($message)) return false;
        $CI =& get_instance();
        $CI->load->library('amazon_ses');
        $from = "help@gamecoupon.com";
        $from_name = "게임쿠폰";
        if(ENVIRONMENT == 'development') {
            $to = "prog106@haomun.com";
        }
        $CI->amazon_ses->to($to);
        $CI->amazon_ses->from($from, $from_name);
        $CI->amazon_ses->subject($subject);
        $CI->amazon_ses->message($message);
        if($CI->amazon_ses->send()) {
            // 메일 발송 성공일 경우만 저장
            $log = $CI->load->database('default', TRUE);
            $sql_param = array();
            $sql_param['email'] = $to;
            $sql_param['subject'] = $subject;
            $sql_param['message'] = $message;
            $sql_param['created_at'] = YMD_HIS;
            $log->insert('sendmail', $sql_param);
            return true;
        }
        return false;
    } // }}}
}

// 메일 폼 용도에 맞게 가져오기
if(!function_exists('mailtemp')) {
    function mailtemp($code, $data) { // {{{
        // $code : coupon(쿠폰번호)
        $codes = array('coupon', 'password', 'cultureland');
        if(!in_array($code, $codes)) return false;
        $CI =& get_instance();
        $ret = $CI->load->view('mail/head', array(), true);
        $ret .= $CI->load->view('mail/template_'.$code, $data, true);
        $ret .= $CI->load->view('mail/footer', array(), true);
        return $ret;
    } // }}}
}

// SMS 문자보내기
if(!function_exists('sendsms')) {
    function sendsms($tps='sms', $phone=null, $subject=null, $msg=null, $file=array(), $callback='025541664') { // {{{
        /*
         * /var/www/sms 폴더에 sms 모듈 설치되어 있음
         * ./uagent.sh start|stop|kill
         * config file : cfg/sms_client.cfg
         */
        $CI =& get_instance();
        $CI->load->library('curl');

        // 컬쳐랜드에 전달할 코드정보
        $curl_prm = array(
            'callback' => '025541664', // 발신자 번호
            'code' => 'znIVChequcTRvfBJ', // 인증코드
            'phone' => $phone, // 수신자 핸드폰
            'subject' => $subject, // sms 문자내용, lms 문자 제목
            'message' => $msg, // lms 문자 내용
        );

        $curl_url = "http://api.haomun.com/send/".$tps;
        if(ENVIRONMENT == 'development') {
            //$phone = '01094570932';
            $curl_url = "http://tapi.haomun.com/send/".$tps;
        }
        $return = $CI->curl->simple_post($curl_url, $curl_prm, array(CURLOPT_BUFFERSIZE => 10, CURLOPT_FAILONERROR => false, CURLOPT_HTTP200ALIASES => array(400)));

        // returncode , returnmessage , data
        $result = json_decode($return, true);
        if(empty($result) || $result['returncode'] != '200') {
            $e = $CI->curl->error_code; // int
            $s = $CI->curl->error_string;
            // SMS 발송 처리를 실패하는 경우 - 로그 남기기
            log_message('error', YMD_HIS.' '.$phone.' SMS Error : code = '.$result['returncode'].' : '.$result['returnmessage'].' : string = '.$e.' : '.$s);
            errorlog(YMD_HIS.'SMS Error : '.$result['returncode'].' : '.$phone.' / '.$subject.' / '.USER_ID);
        }
    } // }}}
}

// text 처리
if(!function_exists('convert_text')) {
    function convert_text($text='', $nl2br=true, $autolink=true) { // {{{
        if($nl2br) {
            $str = nl2br(strip_tags($text));
        } else {
            $str = strip_tags($text);
        }
        return ($autolink) ? autolink($str) : $str;
    } // }}}
}

// text 자동 링크 걸기
if(!function_exists('autolink')) {
    function autolink($text) { // {{{
        if(preg_match('%(?:youtube(?:-nocookie)?\.com/(?:[^/]+/.+/|(?:v|e(?:mbed)?)/|.*[?&]v=)|youtu\.be/)([^"&?/ ]{11})%i', $text, $match)) {
            $text .= "<iframe width=\"100%\" height=\"100%\" src=\"https:\/\/www.youtube.com\/embed\/".$match[1]."\" frameborder=\"0\" allowfullscreen></iframe>";
        }
        // http
        $text = preg_replace("/http:\/\/([0-9a-z-.\/@~?&=_]+)/i", "<a href=\"http://\\1\" class=\"getmeta\" target='_blank'>http://\\1</a>", $text);
        // https
        $text = preg_replace("/https:\/\/([0-9a-z-.\/@~?&=_]+)/i", "<a href=\"https://\\1\" class=\"getmeta\" target='_blank'>https://\\1</a>", $text);
        // ftp
        //$text = preg_replace("/ftp:\/\/([0-9a-z-.\/@~?&=_]+)/i", "<a href=\"ftp://\\1\" target='_blank'>ftp://\\1</a>", $text);
        // email
        //$text = preg_replace("/([_0-9a-z-]+(\.[_0-9a-z-]+)*)@([0-9a-z-]+(\.[0-9a-z-]+)*)/i", "<a href=\"mailto:\\1@\\3\">\\1@\\3</a>", $text);
        return $text;
    } // }}}
}

// http 추가
if(!function_exists('addhttp')) {
    function addhttp($url) { // {{{
        if (!preg_match("~^(?:f|ht)tps?://~i", $url)) {
            $url = "http://" . $url;
        }
        return $url;
    } // }}}
}

?>
