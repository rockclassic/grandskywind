<?php
defined('BASEPATH') OR exit('No direct script access allowed');
/**
 * @ description : api 공통 용
 * @ author : prog106 <prog106@haomun.com>
 * @property Apibiz $apibiz
 * @property Testbiz $testbiz
 * @property Mbrofficebiz $mbrofficebiz
 */
class App extends CI_Controller {

    public function __construct() { // {{{
        parent::__construct();
        date_default_timezone_set('Asia/Seoul');
        $this->load->model('biz/api/v1/Apibiz', 'apibiz');

    } // }}}

    // mp 메인화면 정보요청 by.jeromc 2019-01-30
    public  function main_info(){ // {{{
        $params = json_decode(trim(file_get_contents('php://input')), true);
        //  hd_latitude : 위도
        //  hd_longtitude : 경도
        //병원정보
        $h_info = $this->apibiz->get_h_info($params);
        //약국정보
        $p_info = $this->apibiz->get_p_info($params);
        //공지사항 :: 10개만 노출
        $page=1;
        $limit = 10;
        $offset = ($page -1) * $limit;
        $param['nt_targt_gbn']="USR";

        $notice = $this->apibiz->get_notice_list($param, $limit, $offset);

        //병원정보
        $return['h_info']=$h_info;
        //약국정보
        $return['p_info']=$p_info;
        //공지 리스트
        $return['notice']=$notice;

        echo json_encode($return);
    } // }}}

    // mp 공지 리스트 by.jeromc 2019-01-30
    public function notice_list(){ // {{{
        $params = json_decode(trim(file_get_contents('php://input')), true);
        if($params['page'])$page=$params['page'];
        else $page=1;
        $limit = 10;
        $offset = ($page -1) * $limit;
        $params['nt_targt_gbn']="USR";
        $count = $this->apibiz->get_notice_count($params);
        $list['count'] = $count['data']['nt_count'];
        $list['list'] = $this->apibiz->get_notice_list($params, $limit, $offset);
        echo json_encode($list);
    } // }}}

    // mp 공지 상세 내용  by.jeromc 2019-01-30
    public function notice_cont(){
        $params = json_decode(trim(file_get_contents('php://input')), true);
        $list['notice'] = $this->apibiz->get_notice_cont( $params['nt_notice_idx']);
        echo json_encode($list);
    } // }}}


    // mp 로그인 관련 by.jeromc 2019-01-31
    public function ax_login() { // {{{
        $params = json_decode(trim(file_get_contents('php://input')), true);
        $user_id = $params['user_id'];
        $user_pw = $params['user_pw'];
        $result = $this->apibiz->ax_login($user_id, $user_pw);
        echo json_encode($result);
    } // }}}


    //지도 좌표 리스트 by.jeromc 2018-11-22
    public function map_info(){ // {{{
        $params = json_decode(trim(file_get_contents('php://input')), true);
        if($params['page'])$page=$params['page'];
        else $page=1;

        if($params['limit'])$limit=$params['limit'];
        else $limit=10;
        if($limit=="all") $limit=0;
        $offset = ($page -1) * $limit;
        $list['list'] = $this->apibiz->map_hosptl_list($params, $limit, $offset);
        echo json_encode($list);
    } // }}}

//------------------- mp 개발 구분  ------------------------------------------------------------------------------------


    // 고객 공지,견적현황 list by.jeromc 2018-10-18
    public function get_list_data(){
        $params = json_decode(trim(file_get_contents('php://input')), true);
        if($params['type']=="my"){ //내 비교견적 현황
            if($params['page'])$page=$params['page'];
            else $page=1;
            $limit = 10;
            $offset = ($page -1) * $limit;
            if(!empty($params['userid'])) {
                $userid = preg_replace("/[^0-9]*/s", "", $params['userid']);
            }
            $count = $this->apibiz->get_estmtreq_count($userid);
            $list['count'] = $count['data']['nt_count'];
            $list['list'] = $this->apibiz->get_estmtreq($userid, $limit, $offset);
        }else if($params['type']=="all"){ //메인화면 리스트
            $page=1;
            $limit = 10;
            $offset = ($page -1) * $limit;
            $param['nt_targt_gbn']="USR";
            $list['notice']=$this->apibiz->get_notice_list($param, $limit, $offset);
            $list['list']=$this->apibiz->get_req_list($param, $limit, $offset);
            $info_tag="u_version";
            $list['version'] = $this->apibiz->get_version($info_tag);
        }else if($params['type']=="notice_list") { //공지 리스트
            if($params['page'])$page=$params['page'];
            else $page=1;
            $limit = 10;
            $offset = ($page -1) * $limit;
            $param['nt_targt_gbn']="USR";
            $count = $this->apibiz->get_notice_count($param);
            $list['count'] = $count['data']['nt_count'];
            $list['list'] = $this->apibiz->get_notice_list($param, $limit, $offset);
        }else if($params['type']=="notice_detail") { //공지 상세
            $list['notice'] = $this->apibiz->get_notice_cont( $params['nt_notice_idx']);
        }else if($params['type']=="answer"){
            $search=array();
            if($params['page'])$page=$params['page'];
            else $page=1;
            $limit = 10;
            $offset = ($page -1) * $limit;
            if(!empty($params['userid'])) {
                $search['userid'] = preg_replace("/[^0-9]*/s", "", $params['userid']);
            }
            if(!empty($params['ob_office_idx'])) $search['ob_office_idx']=$params['ob_office_idx'];         //사무실 id
            if(!empty($params['rs_estmtRsp_idx'])) $search['rs_estmtRsp_idx']=$params['rs_estmtRsp_idx'];   //답변 id
            if(!empty($params['em_estmtReq_idx'])) $search['em_estmtReq_idx']=$params['em_estmtReq_idx'];   //문의 id

            if(empty($params['orderby'])) $search['orderby']="c.ob_sado_rank";   //정렬
            else $search['orderby']=$params['orderby'];   //정렬

            if(empty($params['sort'])) $search['sort']="desc";   //오름/내림차순
            else $search['sort']=$params['sort'];   //오름/내림차순

            $count = $this->apibiz->get_answer_count($search);
            $list['count'] = $count['data']['nt_count'];
            $list['list'] = $this->apibiz->get_answer($search, $limit, $offset);
            $list['orderby']=$search['orderby'];
            $list['sort']=$search['sort'];
        }else{ //version
            $info_tag="u_version";
            $list['version'] = $this->apibiz->get_version($info_tag);
        }
        echo json_encode($list);
    }
    // 공지 읽음 list by.jeromc 2018-10-29
    public function set_read_count(){
        $params = json_decode(trim(file_get_contents('php://input')), true);
        $param['nt_notice_idx']=$params['nt_notice_idx'];
        $cnt = $this->apibiz->set_notice_count($param);

        if($cnt>0){
            $return['ret']="true";
        }else{
            $return['ret']="false";
        }
        echo json_encode($return);
    }

    // fcm 보내는 함수 by.jeromc 2018-10-18
    public function send_fcm()
    {
        $params = json_decode(trim(file_get_contents('php://input')), true);
        $userid = $params['userid']; //회원아이디 or 전화번호
        $type = $params['type']; //메세지 타입(1: 고객, 2:회원)
        $id= $params['id']; //디바이스ID
//        $id[]= $params['id']; //디바이스ID
        $title = $params['title']; //title
        $msg = $params['msg']; //견적 유형, DB에 저장된 견적문의 시퀸스number

        $message = array(
            'registration_ids' => $id,//모든 세무사 디바이스 ID를 가져와 넣어줘야 함.
            'data' => array(
                "title" => $title,
                "body" => $msg,//견적 유형을 함께건달.
            ),
            'notification' => array(
                "title" => $title,
                "body" => $msg,
                "sound" => "default"
            ),
        );

        $return['ret']=send_fcm($message,$type);
        echo json_encode($return);
    }


    // 전체 회원에게 fcm 보내는 함수 by.jeromc 2018-10-18(topic)
    public function send_fcm_user(){
        $params = json_decode(trim(file_get_contents('php://input')), true);
        $topic=$params['topic'];    //토픽
        $type = $params['type']; //메세지 타입(1: 고객, 2:회원)
        $title = $params['title']; //title
        $msg = $params['msg']; //견적 유형, DB에 저장된 견적문의 시퀸스number
        $message = array(
            "to"=> "/topics/".$topic,
            'data' => array(
                "title" => $title,
                "body" => $msg,//견적 유형을 함께건달.
            ),
            'notification' => array(
                "title" => $title,
                "body" => $msg,
                "sound" => "default"
            ),
        );

        $return['ret']=send_fcm($message,$type);
        echo json_encode($return);
    }

    public function fn_encrypt(){
         $params = json_decode(trim(file_get_contents('php://input')), true);
         if($params['type']=="enc"){
             $params['ret']=$this->openssl_mem->aes_encrypt($params['text']);
         }else{
             $params['ret']=$this->openssl_mem->aes_decrypt($params['text']);
         }

        echo json_encode($params);
    }

    public function chg_state(){
        $params = json_decode(trim(file_get_contents('php://input')), true);
        if($params['type']=="em"){
            $return= $this->apibiz->update_em_state($params);
        }else if($params['type']=="rs"){
            $return= $this->apibiz->update_rs_state($params);
        }else{
            $return['msg'] = 'error';
            $return['data'] = 'type이 잘못되었습니다.';
        }

        echo json_encode($return);
    }

    // 세무사무소 정보 by.jeromc 2018-11-15
    public  function office_info(){
        $params = json_decode(trim(file_get_contents('php://input')), true);

        $office = $this->mbrofficebiz->get_office_baseInf($params);
        //사용안함
//        $mbrship = $this->mbrofficebiz->get_office_mbrshipInf($params);
        $profile = $this->mbrofficebiz->get_office_profileInf($params);
        $taxAccnt = $this->mbrofficebiz->get_office_taxAccntInf($params);
        $client = $this->mbrofficebiz->get_office_clientInf($params);
        $wrkfield = $this->mbrofficebiz->get_office_wrkfieldInf($params);
        $intrvw = $this->mbrofficebiz->get_office_intrvwInf($params);

        //기본정보
        $return['office']=$office['data'];
        //요금제 정보
//        $return['mbrship']=$mbrship['data'];
        //약력
        $return['profile']=$profile['list'];
        //세무 정보
        $return['taxAccnt']=$taxAccnt['list'];
        //주요고객
        $return['client']=$client['list'];
        //전문분야
        $return['wrkfield']=$wrkfield['list'];
        //미니인터뷰
        $return['intrvw']=$intrvw['list'];
        echo json_encode($return);
    }
    //사도 랭킹 데이터 by.jeromc 2018-11-22
    public function rank_office(){
        $params = json_decode(trim(file_get_contents('php://input')), true);
        if($params['page'])$page=$params['page'];
        else $page=1;

        if(empty($params['orderby']))$params['orderby']="ob_sado_rank";
        if(empty($params['sort']))$params['sort']="desc";

        $limit = 10;
        $offset = ($page -1) * $limit;
        $list['list'] = $this->apibiz->rank_office_list($params, $limit, $offset);

        echo json_encode($list);
    }



    //인증번호 sms 전송 by.jeromc 2018-12-10
    public function confirm_auth(){
        $params = json_decode(trim(file_get_contents('php://input')), true);
        $params['auth_num']=rand_string(6,2);
        //tel_num
        if($params['tel_num']){
            $tel_num=fn_only_number($params['tel_num']);
            $auth_num=rand_string(6,2);
            // sms 전송 시작
            $message="[사도알림]\n 인증번호는 [".$auth_num."] 입니다.";
            $sender="0269290614"; // 발신번호
            $receiver=fn_only_number($params['tel_num']); //수신번호

            $return['msg_sms']=fn_sms($message,$sender,$receiver);
            // sms 전송 완료
            $return['msg'] = 'success';
            $return['auth_num'] = $auth_num;
            $return['tel_num'] = $tel_num;
        }else{
            $return['msg'] = 'error';
            $return['auth_num'] = "no data";
            $return['tel_num'] = "";
            $return['msg_sms'] = "";
        }
        echo json_encode($return);
    }











    public function apireq()
    {
        $data = array(); // 새로운 배열
        $data['from'] = trim('SDFSDFF');
        $data['to'] = trim('SDFSDFSDF');
        $data = json_encode($data); // $data 배열을 json 형식으로 변환

        $token = "LrMgyJaOG8spYK4652PbRoqs3fdZvlcXSxWe95awF1a";
        $headers = array('Content-Type: application/json',"Auth-Key: ".$token);

        $curl_url = "http://api.sysinfo.xyz/api/app/apiresult";
        $curl = curl_init($curl_url);

        curl_setopt($curl,CURLOPT_USERAGENT,'Mozilla/5.0 (compatible; with PHP');
        curl_setopt($curl, CURLOPT_HEADER, 0);
        curl_setopt($curl, CURLOPT_ENCODING, '');
        curl_setopt($curl, CURLOPT_CUSTOMREQUEST, 'PATCH'); // 보통 쓰지 않지만 특별히 제공측에서 원하는 경우 타입을 써줌.
        curl_setopt($curl, CURLOPT_HTTPHEADER, $headers);
        curl_setopt($curl, CURLOPT_POSTFIELDS, json_encode($data));
        curl_setopt($curl, CURLOPT_FOLLOWLOCATION, 1);
        curl_setopt($curl,CURLOPT_RETURNTRANSFER,1);
        curl_setopt($curl,CURLOPT_NOSIGNAL,1);
        curl_setopt($curl, CURLOPT_SSL_VERIFYPEER, false);
        //print_r($curl);

        $result = curl_exec($curl);
        echo $result;
        //return $result;

    }







}
?>
