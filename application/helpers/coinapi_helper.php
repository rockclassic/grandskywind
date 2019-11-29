<?php  if ( ! defined('BASEPATH')) exit('No direct script access allowed');
/**
 * @ description : Point biz
 * @ author : prog106 <prog106@haomun.com>
 * @property Commondao $commondao
 * @property Pointbiz $pointbiz
 * @property Openssl_mem $openssl_mem
 * x
 */
function get_microtime()
{
    list($usec, $sec) = explode(" ",microtime());
    return ((float)$usec + (float)$sec);
}

if(!function_exists('show_return')) {
    function show_json_return($data=array()) { // {{{
        $return = array(
            'result' => 'success',
            'message' => null,
            'data' => $data,
        );
        echo json_encode($return);
        exit();
    } // }}}
}

if(!function_exists('show_return')) {
    function show_return($data=array()) { // {{{
        $return = array(
            'result' => 'success',
            'message' => null,
            'data' => $data,
        );
        if(defined('SAMPLE')) {
            echo "URL : ";
            debug($_SERVER['REQUEST_URI']);
            echo "POST : ";
            debug($_POST);
            echo "RESULT : ";
            debug($return);
        } else echo json_encode($return);
        exit();
    } // }}}
}

if(!function_exists('show_error_msg')) {
    function show_error_msg($error_msg='알수없는 에러발생') { // {{{
        $return = array(
            'result' => 'error',
            'message' => $error_msg,
            'data' => array(),
        );
        if(defined('SAMPLE')) {
            echo "URL : ";
            debug($_SERVER['REQUEST_URI']);
            echo "POST : ";
            debug($_POST);
            echo "RESULT : ";
            debug($return);
        } else echo json_encode($return);
        exit();
    } // }}}
}


if(!function_exists('fn_curl_post')) {
    function fn_curl_post($header, $param, $request_url) { // {{{
        $param = json_encode($param);
        $ch = curl_init();
        curl_setopt($ch, CURLOPT_URL, $request_url);
        curl_setopt($ch, CURLOPT_HEADER, 0);
        curl_setopt($ch, CURLOPT_POST, 0);
        curl_setopt($ch, CURLOPT_POSTFIELDS, $param);
        curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, 0);
        curl_setopt($ch, CURLOPT_HTTPHEADER, $header);
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, TRUE);
        $result = curl_exec($ch);
        $result = json_decode($result, true);
        curl_close($ch);
        return $result;
    } // }}}
}

if(!function_exists('parameter_check')) {
    function parameter_check($param=array(), $post=array()) { // {{{
        $return = array();
        //fn_log($post,"post");

        if(is_array($param)) {
            foreach($param as $k => $v) {
                if($k == 'method_comment') continue;

                if(!empty($v['MUST'])) {
                    if(empty($post[$k])) fn_log($k.'('.$v['COMMENT'].') - 필수 파라미터 데이터 오류','parameter_check err');
                    $return[$k] = $post[$k];
                } else {
                    $return[$k] = (!empty($post[$k]))?$post[$k]:((!empty($v['DEFAULT']))?$v['DEFAULT']:null);
                }
            }
        }
        return $return;
    } // }}}
}

if(!function_exists('return_json')) {
    function return_json($return=array()) { // {{{
        if($return['msg'] == 'success') show_return($return['data']);
        else if($return === true) show_return($return);
        else show_error_msg($return['data']);
    } // }}}
}

if(!function_exists('ex')) {
    function except($msg=null, $code=null) { // {{{
        throw new Exception($msg, $code);
    } // }}}
}

if(!function_exists('callrpc')) {
    function callrpc($request_url=array(), $request_post=array()) { // {{{
        $post = (!empty($request_post)) ? json_encode($request_post) : '';
        $headers = array("Auth-Key:LrMgyJaOG8spYK2PbRoqsdZvlcXSxWe95awF1a");
        $ch = curl_init();
        $host = 'http://api.medicalplan';
        if(ENVIRONMENT=="local"){
            $host=$host.".me/";
        }else if(ENVIRONMENT=="development"){
            $host=$host.".xyz/";
        }else if(ENVIRONMENT=="site"){
//            $host=$host.".site/";
            $host=$host.".xyz/";
        }else{
//            $host=$host.".com/";
            $host=$host.".xyz/";
        }

        curl_setopt($ch, CURLOPT_URL, $host.$request_url);
        curl_setopt($ch, CURLOPT_HEADER, 0);
        curl_setopt($ch, CURLOPT_POST, 0);
        curl_setopt($ch, CURLOPT_POSTFIELDS, $post);
        curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, 0);
        curl_setopt($ch, CURLOPT_HTTPHEADER, $headers);
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, TRUE);
        $result = curl_exec($ch);
        curl_close($ch);
        return json_decode($result, true);
    } // }}}
}

if(!function_exists('alertmsg_close')) {
    function alertmsg_close($msg){ // {{{
        echo "<html>";
        echo "<head>";
        echo "<meta http-equiv='Content-Type' content='text/html; charset=utf-8'>";
        echo "</head>";
        echo "<body>";
        echo "<script>";
        echo "alert('".$msg."');";
        echo "window.close();";
        echo "</script>";
        echo "</body>";
        echo "</html>";
        exit;
    } // }}}
}

if(!function_exists('alertmsg_move')) {
    function alertmsg_move($msg, $url=''){ // {{{
        echo "<html>";
        echo "<head>";
        echo "<meta http-equiv='Content-Type' content='text/html; charset=utf-8'>";
        echo "</head>";
        echo "<body>";
        echo "<script>";
        echo "alert('".$msg."');";
        echo "location.replace('".$url."');";
        echo "</script>";
        echo "</body>";
        echo "</html>";
        exit;
    } // }}}
}

if(!function_exists('alertmsg_back')) {
    function alertmsg_back($msg){ // {{{
        echo "<html>";
        echo "<head>";
        echo "<meta http-equiv='Content-Type' content='text/html; charset=utf-8'>";
        echo "</head>";
        echo "<body>";
        echo "<script>";
        echo "alert('".$msg."');";
        echo "history.go(-1);";
        echo "</script>";
        echo "</body>";
        echo "</html>";
        exit;
    } // }}}
}



// infos array 정보 출력 by.jeromc 2018-06-21
if(!function_exists('infos_array')) {
    function infos_array($tag,$flag="Y") { // {{{
        $CI =& get_instance();
        $CI->load->database();
        $CI->load->model('dao/Commondao','commondao');
        $flag_sql="";
        if($flag!="ALL"){
            $flag_sql=" and  INFO.info_yn='".$flag."'";
        }
        $sql = "SELECT
                    INFO.info_title,
                    INFO.info_yn,
                    INFO.info_value
                FROM infos INFO 
                WHERE INFO.info_tag='".$tag."' ".$flag_sql."
        ";
        $sql_param['user_srl'] = '';
        $result = $CI->commondao->get_query($sql, $sql_param);
        $user = $result;
        return $user;
    } // }}}
}

// infos 정보 출력 by.jeromc 2018-06-21
if(!function_exists('info_value')) {
    function info_value($tag,$value) { // {{{
        $CI =& get_instance();
        $CI->load->database();
        $CI->load->model('dao/Commondao','commondao');
        $flag_sql="";

        $sql = "SELECT
                    INFO.info_title,
                    INFO.info_yn,
                    INFO.info_value
                FROM infos INFO 
                WHERE INFO.info_tag='".$tag."' and INFO.info_value='".$value."'
        ";
        $sql_param['user_srl'] = '';
        $result = $CI->commondao->get_query($sql, $sql_param);
        $user = $result[0];
        return $user['info_title'];
    } // }}}
}


//이미지 암호화 함수 by.jeromc 2018-06-25
if(!function_exists('img_encrypt')) {
    function img_encrypt($image) { // {{{
        $CI =& get_instance();
        $imageblob = file_get_contents($image);
        $data_en=$CI->openssl_mem->aes_encrypt($imageblob);
        write_file($image, $data_en, 'w');
        return true;
    } // }}}
}

//이미지 복호화 함수 by.jeromc 2018-06-25
if(!function_exists('img_decrypt')) {
    function img_decrypt($image) { // {{{
        $CI =& get_instance();
        $imageblob = @file_get_contents($image);
        $data_de="";
        if($imageblob) $data_de=$CI->openssl_mem->aes_decrypt($imageblob);
        return  $data_de;
    } // }}}
}

//랜덤 스트링 생성 by.jeromc 2018-06-26
if(!function_exists('rand_string')) {
    //type 1:: 전체, 2:: 숫자, 3:: 숫자+소문자, 기타:: 전체(특수문자제외)
    function rand_string($len=8,$type=1) { // {{{
        if($type==1) $characters = '0123456789abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ!@#$';
        elseif($type==2) $characters = '0123456789';
        elseif($type==3) $characters = '0123456789abcdefghijklmnopqrstuvwxyz';
        else $characters = '0123456789abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ';

        $charactersLength = strlen($characters);
        $randomString = '';
        for ($i = 0; $i < $len; $i++) {
            $randomString .= $characters[rand(0, $charactersLength - 1)];
        }
        return $randomString;
    } // }}}
}


//이메일 send 공통 함수 by.jeromc 2018-06-27 :: 차후 이메일 연동시 수정 필요함
if(!function_exists('fn_mail_send')) {
    function fn_mail_send($to,$subject,$message=array()) { // {{{
        $CI =& get_instance();
        $CI->load->library('email');
        $config = Array(
            'protocol' => 'smtp',
            'smtp_host' => 'email-smtp.us-east-1.amazonaws.com',
            'smtp_port' =>  587,
            'smtp_user' => 'AKIAJLTHJIOJ4WKTLC2A',
            'smtp_pass' => 'AsgNaBQFG13mLiVKu4Ya4uQXU4lUCIOYnjcabrUj9jf7',
            'mailtype'  => 'html',
            'charset'   => 'utf-8',
            'validation' => FALSE,
            'smtp_timeout' => 10,
            //'newline' => "\r\n"
        );

        if( ! ini_get('date.timezone') )
        {
            date_default_timezone_set('GMT');
        }

        $CI->email->initialize($config);
        //$this->load->library('email', $config);
        $CI->email->set_newline("\r\n");
        $CI->email->from('cs@banco.id','보라빛센터');
        //$CI->email->from('help@borabit.com','보라빛고객센터');
        //$to="jeromc.mail@gmail.com";
        $CI->email->to($to);
        $CI->email->subject($subject);
        //$message['title'],$message['msg']
        $CI->email->message($CI->load->view('/admin/mail/common', $message, TRUE));

        $CI->email->send();
        $deb=$CI->email->print_debugger();
        $deb_tmp=preg_replace("/\s+/", "", $deb);
        $deb_tmp=preg_replace("/<pre[^>]*>/i", "", $deb_tmp);
        $deb_tmp=preg_replace("/<\/pre>/i", "", $deb_tmp);
        if($deb_tmp)fn_log($deb,"print_debugger",'error');
        return $deb;


    } // }}}
}
//custom log by.jeromc 2018-06-29
if(!function_exists('fn_log')) {
    function fn_log($message,$title=null,$type="custom") { // {{{
        if($title)log_message($type,"<<=== ".$title." ===>>");
        log_message($type,$message);
    } // }}}
}


//sms send by.jeromc 2018-07-10
if(!function_exists('fn_sms')) {
    function fn_sms($message,$sender,$receiver,$user_srl=null,$admin_srl=null,$title=null) { // {{{

        $request_url = 'https://apis.aligo.in/send/';
        $post=Array(
            'userid' => 'ontac01', // sms id
            'key' => 'aoxe55295hnosgcjz9p6e0yz79833cpi',    // 인증키
            'msg'  => $message,
            'destination' => '오늘플랜',
            'receiver' =>  preg_replace("/[^0-9]*/s", "", $receiver), //수신번호
            'sender' =>  preg_replace("/[^0-9]*/s", "", $sender), //발신번호
            'testmode_yn' =>'N'
        );
        $host_info = explode("/", $request_url);
        $port = $host_info[0] == 'https:' ? 443 : 80;
        $ch = curl_init();
        curl_setopt($ch, CURLOPT_PORT, $port);
        curl_setopt($ch, CURLOPT_URL, $request_url);
        curl_setopt($ch, CURLOPT_POST, 1);
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
        curl_setopt($ch, CURLOPT_POSTFIELDS, $post);
        curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, FALSE);
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, TRUE);
        $result = curl_exec($ch );
        curl_close( $ch );
        return json_decode($result);
    } // }}}
}

//숫자 필터링 by.jeromc 2018-07-18
if(!function_exists('fn_only_number')) {
    function fn_only_number($str) { // {{{
        return preg_replace("/[^0-9]*/s", "", $str);
    } // }}}
}

//숫자 필터링 by.jeromc 2018-07-18
if(!function_exists('fn_ymd')) {
    function fn_ymd($str) { // {{{
        return substr($str,0,10);
    } // }}}
}


// 마이크로 타임을 얻어 계산 형식으로 만듦
if (!function_exists('get_microtime')) {
    function get_microtime()
    {
        list($usec, $sec) = explode(" ", microtime());
        return ((float)$usec + (float)$sec);
    }
}


// fcm by.jeromc 2018-10-18
if(!function_exists('send_fcm')){
    function send_fcm($message,$type=1){
        if($type==1) {
            //고객
            $headers = array(
                //Authorization: key는 FCM에 등록된 App key
                'Authorization: key=' . 'AAAAWFChDTw:APA91bGzUfc62Qf3_VAVcHZKW7tuSFlC3mFJxQSZY2OJ3-1B__jgshep6fY5wJyqVXWpZG1Q5hrpwmMEUFrCrHChO6hPwJOqe_NHjlZGPIez36h38EbbzrOyt4qah2M9MZs4hK-by7er',
                'Content-Type: application/json'
            );
        }else  if($type==3) {
            //고객
            $headers = array(
                //Authorization: key는 FCM에 등록된 App key
                'Authorization: key=' . '',
                'Content-Type: application/json'
            );
        }else {
            //세무사
            $headers = array(
                //Authorization: key는 FCM에 등록된 App key 2018-12-03 변경
                'Authorization: key=' . '',
                'Content-Type: application/json'
            );
        }
        #Send Reponse To FireBase Server
        $ch = curl_init();
        curl_setopt( $ch,CURLOPT_URL, 'https://fcm.googleapis.com/fcm/send' );
        curl_setopt( $ch,CURLOPT_POST, true );
        curl_setopt( $ch,CURLOPT_HTTPHEADER, $headers );
        curl_setopt( $ch,CURLOPT_RETURNTRANSFER, true );
        curl_setopt( $ch,CURLOPT_SSL_VERIFYPEER, false );
        curl_setopt( $ch,CURLOPT_POSTFIELDS, json_encode($message));
        $result = curl_exec($ch );
        curl_close( $ch );
        return $result;
    }
}
// chrom fcm by.jeromc 2018-12-11
if(!function_exists('send_chrome_fcm')){
    function send_chrome_fcm($endpoint,$msg){
        $message = array(
            'subscription' => json_decode($endpoint),
            "data" => $msg,
            "applicationKeys" => array(

                "public" => "BI5MrngKqqRnJptRzmKWkykrQuoGkX-6Mba44e82MIzrXAADDrIsbKDmpzM-6Prz1h0DRtQtGR824zsuAsSIJLM",
                "private" => "aKkfnA_A9p_m9imtoeWBe4n-dMd5JEp8UNeZ-L7-hQM"
            )
        );
        #Send Reponse To FireBase Server
        $ch = curl_init();

        curl_setopt($ch, CURLOPT_URL, "https://web-push-codelab.glitch.me/api/send-push-msg");
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
        curl_setopt($ch, CURLOPT_POSTFIELDS, json_encode($message));
        curl_setopt($ch, CURLOPT_POST, 1);

        $headers = array();
        $headers[] = "Content-Type: application/json";
        curl_setopt($ch, CURLOPT_HTTPHEADER, $headers);

        $result = curl_exec($ch);
        echo($result);
        if (curl_errno($ch)) {
            echo 'Error:' . curl_error($ch);
        }
        curl_close ($ch);
        return $result;
    }
}


//xml to array
if(!function_exists('object2array')) {
    function object2array($object)
    {
        return @json_decode(@json_encode($object), 1);
    }
}

// 고객 디바이스 아이디 추출 by.jeromc 2018-11-21
if(!function_exists('user_dvceid')) {
    function user_dvceid($idx) { // {{{
        $CI =& get_instance();
        $CI->load->database();
        $CI->load->model('dao/Commondao','commondao');
        $user=array();

        $sql = "SELECT
                    em_dvceid
                FROM tbl_estmtreq_mast 
                WHERE em_estmtReq_idx=?
        ";
        $sql_param['em_estmtReq_idx'] = $idx;
        $result = $CI->commondao->get_query($sql, $sql_param);
        foreach($result as $k){
            $user[]=$k['em_dvceid'];
        }
        return $user;
    } // }}}
}

// 세무사 디바이스 아이디 추출 by.jeromc 2018-11-21
if(!function_exists('partner_dvceid')) {
    function partner_dvceid($idx) { // {{{
        $CI =& get_instance();
        $CI->load->database();
        $CI->load->model('dao/Commondao','commondao');
        $user=array();

        $sql = "SELECT
                    od_dvceid_val
                FROM tbl_office_dvceid 
                WHERE ob_office_idx=?
        ";
        $sql_param['ob_office_idx'] = $idx;
        $result = $CI->commondao->get_query($sql, $sql_param);
        foreach($result as $k ){
            $user[]=$k['em_dvceid'];
        }
        return $user;
    } // }}}
}


// 포인트 적립 by.jeromc 2018-11-26
if(!function_exists('fn_point_save')) {
    function fn_point_save($office_id, $amount,$user_id,$expire_days=365,$dtype=190,$memo=null) { // {{{
        $CI =& get_instance();
        $CI->load->database();
        $CI->load->model('biz/crm/v1/Pointbiz', 'pointbiz');
        $point= $CI->pointbiz->point_save('save',$office_id, $amount,$user_id,$expire_days,$dtype,$memo);
        return $point;
    } // }}}
}

// 포인트 사용 by.jeromc 2018-11-26
if(!function_exists('fn_point_use')) {
    function fn_point_use($office_id, $amount,$user_id,$dtype=190,$memo=null) { // {{{
        $CI =& get_instance();
        $CI->load->database();
        $CI->load->model('biz/crm/v1/Pointbiz', 'pointbiz');
        $point= $CI->pointbiz->point_save('use',$office_id, $amount,$user_id,'',$dtype,$memo);
        return $point;
    } // }}}
}


// 포인트 금액 by.jeromc 2018-11-26
if(!function_exists('fn_point')) {
    function fn_point($office_id) { // {{{
        $CI =& get_instance();
        $CI->load->database();
        $CI->load->model('biz/crm/v1/Pointbiz', 'pointbiz');
        $point= $CI->pointbiz->get_point($office_id);
        return $point;
    } // }}}
}

// 랭킹점수(choice) + by.jeromc 2018-11-28
if(!function_exists('fn_choice')) {
    function fn_choice($office_id) { // {{{
        $CI =& get_instance();
        $CI->load->database();
        $sql="UPDATE tbl_office_base SET ob_choice_rank = ob_choice_rank+1 where ob_office_idx=?";
        $result = $CI->commondao->update_query($sql, $office_id);

        return $result;
    } // }}}
}

// 랭킹점수(answer) + by.jeromc 2018-11-28
if(!function_exists('fn_answer')) {
    function fn_answer($office_id) { // {{{
        $CI =& get_instance();
        $CI->load->database();
        $sql="UPDATE tbl_office_base SET ob_answer_rank = ob_answer_rank+1 where ob_office_idx=?";
        $result = $CI->commondao->update_query($sql, $office_id);
        return $result;
    } // }}}
}


