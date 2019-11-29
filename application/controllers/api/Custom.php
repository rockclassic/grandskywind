<?php
defined('BASEPATH') OR exit('No direct script access allowed');
/**
 * @ description : api 연동 고객용 앱
 * @ author : prog106 <prog106@haomun.com>
 * @property Apibiz $apibiz
 * @property Userbiz $userbiz
 */
class Custom extends CI_Controller {

    public function __construct() { // {{{
        parent::__construct();
        date_default_timezone_set('Asia/Seoul');
        $this->load->model('biz/api/v1/Apibiz', 'apibiz');
        $this->load->model('biz/crm/v1/Userbiz', 'userbiz');
    } // }}}

    // test by.jeromc 2018-10-18
    public function test_req()
    {
        $params = json_decode(trim(file_get_contents('php://input')), true);
        $params['ret']='Y';
        echo json_encode($params);
    }

    // 고객 공지,견적현황 list by.jeromc 2018-10-18
    public function get_list_data(){
        $params = json_decode(trim(file_get_contents('php://input')), true);


        if($params['type']=="getDoctrList"){
            if($params['page'])$page=$params['page'];
            else $page=1;
            $limit = 10;
            $offset = ($page -1) * $limit;

            $list['list'] = $this->apibiz->get_doctrList($limit, $offset);

        }else if($params['type']=="mainCenterData_img"){
            if($params['page'])$page=$params['page'];
            else $page=1;
            $limit = 10;
            $offset = ($page -1) * $limit;

            $list['list'] = $this->apibiz->get_mainCenterData_img($limit, $offset);

        }else if($params['type']=="mainCenterData_info") {
            $list['data'] = $this->apibiz->get_mainCenterData_info();


        }else if($params['type']=="my"){ //내 비교견적 현황
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

    // 비교견적 저장 by.jeromc 2018-10-18
    public function set_quote(){
        $params = json_decode(trim(file_get_contents('php://input')), true);
        $return['ret']= $this->apibiz->set_estmtreq($params);
        // fcm 전송 세무사에게 topic으로 전송
		/*
        if($return['ret']['msg'] == 'success') {
            $topic="partner";    //토픽 :: 세무사
//            $topic = "user";    //토픽
            if ($topic == "user") { //메세지 타입(1: 고객, 2:회원)
                $type = 1;
            } else {
                $type = 2;
            }
            $title = "[사도] 견적 의뢰"; //title
            $tmp = explode("!^!", $params['em_c1']);
            $msg = "고객님의 [".$tmp[1]."] 견적요청이 들어왔습니다.";

            $message = array(
                "to" => "/topics/" . $topic,
                'data' => array(
                    "title" => $title,
                    "body" => $msg,//견적 유형을 함께건달.
                    "idx" => $return['ret']['data'], //idx
                ),
                'notification' => array(
                    "title" => $title,
                    "body" => $msg,
                    "sound" => "default"
                ),
            );

            $param['f_ret'] = send_fcm($message, $type);
            $param['f_send_idx'] = $topic;//json_encode($topic, JSON_UNESCAPED_UNICODE);
            $param['f_send_msg'] = json_encode($message, JSON_UNESCAPED_UNICODE);
            $param['f_title'] = $title;
            $param['f_memo'] = "견적 요청 FCM 발송";
            $return['ret'] = $this->userbiz->set_fcm($param);

        }
		*/
        echo json_encode($return);
    }

    // 제휴문의 저장 by.jeromc 2018-10-18
    public function set_partner(){
        $params = json_decode(trim(file_get_contents('php://input')), true);
        $return['ret']= $this->apibiz->set_partner($params);
        echo json_encode($return);
    }

    // 시도 데이터 전송 by.jeromc 2018-11-01
    public function get_sidogu()
    {
        $params = json_decode(trim(file_get_contents('php://input')), true);
        $return['list']= $this->apibiz->get_sidogu($params);
        echo json_encode($return);

    }
    // 법률 상담 저장 by.jeromc 2018-11-05
    public function set_law_req(){
        $params = json_decode(trim(file_get_contents('php://input')), true);
        $return['ret']= $this->apibiz->set_law_req($params);
        // fcm 전송 (오늘전용)

        echo json_encode($return);
    }

    // 법률 상담 저장 by.jeromc 2018-11-05
    public function get_law_req(){
        $params = json_decode(trim(file_get_contents('php://input')), true);
        $return['ret']= $this->apibiz->get_law_req($params);
        echo json_encode($return);
    }

    // 1:1문의 저장 by.jeromc 2018-11-08
    public function set_ask_req(){
        $params = json_decode(trim(file_get_contents('php://input')), true);
        $return['ret']= $this->apibiz->set_ask_req($params);
        echo json_encode($return);
    }

    // 1:1문의 저장 by.jeromc 2018-11-08
    public function get_ask_req(){
        $params = json_decode(trim(file_get_contents('php://input')), true);
        $return['ret']= $this->apibiz->get_ask_req($params);
        echo json_encode($return);
    }
    // 고객 답변 확정 by.jeromc 2018-11-16
    public function confirm_answer(){
        $params = json_decode(trim(file_get_contents('php://input')), true);
        $return['ret']= $this->apibiz->confirm_answer($params);
        echo json_encode($return);
    }
}
?>
