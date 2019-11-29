<?php
/**
 * @ description : Board model
 * @ author : jeromc
 * @property Commondao $commondao
 */
class Boardbiz extends CI_Model {

    public function __construct() { // {{{
        parent::__construct();
        $this->db2 = $this->load->database('insertdb', TRUE);
        $this->load->model('dao/Commondao','commondao');
    } // }}}


    // 게시판 저장을 위한 함수 by.jeromc 2018-10-29
    public function set_bbs($params){
        $return = array();
        try {
            $this->db2->trans_begin();
            $sql_param = array();
            $sql_param['nt_title'] = $params['subject'];
            $sql_param['nt_cate_gbn'] = $params['top_show']=="on"? 1:0;
            $sql_param['nt_show_gbn'] = $params['show_yn']=="on"? 1:0;
            $sql_param['nt_content'] = $params['MCONT'];
            $sql_param['nt_uptDt'] = YMD_HIS;
            $sql_param['nt_uptId'] = $this->session->userdata('user_name');
            $sql_param['nt_targt_gbn'] = $params['targt_gbn'];
            if($params['flag']=="notice"){
                $flag="tbl_notice";
                $srl="nt_notice_idx";
            }else{
                $srl=$params['flag']."_idx";
                $flag=$params['flag'];
            }

            if($params['srl']>0) {//update
                $where = array();
                $where[$srl] = $params['srl'];
                $result = $this->commondao->update_table($flag, $sql_param, $where);
                $srl_tmp="게시물 수정 :: ".$params['srl'];
            }else{ //insert
                $sql_param['nt_regDt'] = YMD_HIS;
                $sql_param['nt_read_count'] = 0;
                $sql_param['nt_regId'] = $this->session->userdata('user_name');
                $result = $this->commondao->insert_table($flag, $sql_param);
                $srl_tmp="게시물 작성 :: ".$result;
            }

            if($result == 0) except('인증에 오류가 있습니다...', true);
            if($result < 0) except('인증에 실패하였습니다.', true);
            $return['msg'] = 'success';
            $return['data'] = '저장 되었습니다.';
            $this->db2->trans_commit();
            $this->_save_admin(0, $flag.' '.$srl_tmp);
        } catch (Exception $e) {
            if(!empty($e->getCode())) $this->db2->trans_rollback();
            $return['msg'] = 'error';
            $return['data'] = $e->getMessage();
        }
        return $return;
    }
    // 공지 count by.jeromc 2018-06-27
    public function get_notice_count($search=array()) { // {{{
        $return = array();
        $sql_param = array();

        $sql = "SELECT
                    COUNT(*) AS nt_count
                FROM tbl_notice
               
        ";

        if($search['nt_show_gbn']!='-1') $sql.=" where nt_show_gbn=".$search['nt_show_gbn'];
        $result = $this->commondao->get_query($sql, $sql_param);
        $list = $result[0];
        if(empty($list)) {
            $return['msg'] = 'error';
            $return['data'] = array();
        } else {
            $return['msg'] = 'success';
            $return['data'] = $list;
        }
        return $return;
    } // }}}


    // 공지 list by.jeromc 2018-10-29
    public function get_notice_list($search=array(),$limit,$offset) { // {{{
        $return = array();
        $sql_param = array();

        $sql = "SELECT
                    *
                FROM tbl_notice
                
                
        ";
        if($search['nt_show_gbn']!='-1') $sql.=" where nt_show_gbn=".$search['nt_show_gbn'];
        $sql.=" order by nt_notice_idx desc ";
        if($limit>0) $sql .= " LIMIT ".$limit." OFFSET ".$offset;
        $result = $this->commondao->get_query($sql, $sql_param);
        $list = $result;
        if(empty($list)) {
            $return['msg'] = 'error';
            $return['data'] = array();
        } else {
            $return['msg'] = 'success';
            $return['data'] = $list;
        }
        return $return;
    } // }}}


    //게시판 수정용 데이터 by.jeromc 2018-10-29
    public function get_board_one($flag,$srl){
        $return = array();

        if($flag=="notice"){
            $sql_param = array(
               'nt_notice_idx' => $srl,
            );
            $result = $this->commondao->get_table('tbl_notice', $sql_param);
            if(!empty($result[0])){//읽음 카운트 하나 올린다.
                $sql="UPDATE tbl_notice SET `nt_read_count` = nt_read_count+1 where nt_notice_idx=?";
                $result_tmp = $this->commondao->update_query($sql, $srl);
            }
        } else if($flag=="ask"){
                $sql_param = array(
                    'ar_ask_idx' => $srl,
                );
                $result = $this->commondao->get_table('tbl_ask_req', $sql_param);
        }else {
            $sql_param = array(
                $flag . '_idx' => $srl,
            );
            $result = $this->commondao->get_table($flag, $sql_param);
        }
        $list = $result[0];
        if(empty($list)) {
            $return['msg'] = 'error';
            $return['data'] = array();
        } else {
            $return['msg'] = 'success';
            $return['data'] = $list;
        }
        return $return;
    }

    // 대쉬보드 정보 가져오기 by.jeromc 2018-11-07
    public function get_board(){

        $return = array();
        $sql_param = array();

        //notice
        $sql = "SELECT
                    nt_notice_idx, nt_title, nt_regDt
                FROM tbl_notice
                where nt_targt_gbn in ('ALL','OFF')
                and nt_show_gbn='1'
                order by nt_cate_gbn desc,nt_notice_idx desc limit 10
                
        ";

        $return['notice'] = $this->commondao->get_query($sql, $sql_param);
//        //견적의뢰
//        $sql = "SELECT
//                    em_c1, em_regDt, em_state
//                FROM tbl_estmtreq_mast
//                where em_state='R'
//                order by em_estmtReq_idx desc limit 10
//
//        ";
//        $return['req'] = $this->commondao->get_query($sql, $sql_param);
//        foreach ($return['req'] as $k => $v) {
//            $tmp = explode("!^!", $v['em_c1']);
//            $return['req'][$k]['em_c1']=$tmp[1];
//        }
//        //견적답변
////        $sql = "SELECT
////                     rs_estmt_memo,rs_regDt, rs_state
////                FROM tbl_estmtrsp
////                where rs_state='R'
////                order by rs_estmtRsp_idx desc limit 10
////
////        ";
//        $sql=" SELECT
//                    a.*, b.ob_officeNm, b.ob_email, b.ob_tel,b.ob_state
//                FROM tbl_estmtrsp as a
//                left join tbl_office_base as b on a.ob_office_idx=b.ob_office_idx
//                where a.rs_state not in('N')
//                order by a.em_estmtReq_idx desc  LIMIT 10
//         ";
//
//        $return['rsp'] = $this->commondao->get_query($sql, $sql_param);
//        //1주일 데이터
//        $sql = "SELECT
//                    sum(t.req_cnt) as req_cnt, sum(t.rsp_cnt) as rsp_cnt, sum(t.user_cnt) as user_cnt, sum(t.ask_cnt) as ask_cnt, sum(t.ans_cnt) as ans_cnt
//                from (
//                    SELECT
//                         count(*) as req_cnt, 0 as rsp_cnt , 0 as user_cnt, 0 as ask_cnt, 0 as ans_cnt
//                    FROM tbl_estmtreq_mast
//                    where em_regDt > date_add(now(),interval -7 day)
//                    UNION
//                    SELECT
//                         0 as req_cnt, count(*)  as rsp_cnt, 0 as user_cnt, 0 as ask_cnt, 0 as ans_cnt
//                    FROM tbl_estmtrsp
//                    where rs_regDt > date_add(now(),interval -7 day) and rs_state not in('N')
//                    UNION
//                    SELECT
//                         0 as req_cnt, 0  as rsp_cnt, count(*) as user_cnt, 0 as ask_cnt, 0 as ans_cnt
//                    FROM tbl_office_base
//                    where ob_regDt > date_add(now(),interval -7 day)
//                    UNION
//                    SELECT  0 as req_cnt, 0  as rsp_cnt, 0 as user_cnt, count(*) as ask_cnt,  ifnull(sum(if(ar_state='R',1,0)),0) as ans_cnt
//                    FROM tbl_ask_req
//                    where ar_regDt > date_add(now(),interval -7 day)
//                ) as t
//        ";
//        $return['cnt'] = $this->commondao->get_query($sql, $sql_param);


        return $return;

    }

    // 공지 count by.jeromc 2018-06-27
    public function get_ask_count($search=array()) { // {{{
        $return = array();
        $sql_param = array();

        $sql = "SELECT
                    COUNT(*) AS nt_count
                FROM tbl_ask_req
               
        ";

        if($search['ar_state']!='ALL') $sql.=" where ar_state='".$search['ar_state']."'";
        $result = $this->commondao->get_query($sql, $sql_param);
        $list = $result[0];
        if(empty($list)) {
            $return['msg'] = 'error';
            $return['data'] = array();
        } else {
            $return['msg'] = 'success';
            $return['data'] = $list;
        }
        return $return;
    } // }}}


    // 공지 list by.jeromc 2018-10-29
    public function get_ask_list($search=array(),$limit,$offset) { // {{{
        $return = array();
        $sql_param = array();

        $sql = "SELECT
                    *
                FROM tbl_ask_req
                
                
        ";
        if($search['ar_state']!='ALL') $sql.=" where ar_state='".$search['ar_state']."'";
        $sql.=" order by ar_ask_idx desc ";
        if($limit>0) $sql .= " LIMIT ".$limit." OFFSET ".$offset;

        $result = $this->commondao->get_query($sql, $sql_param);
        $list = $result;
        if(empty($list)) {
            $return['msg'] = 'error';
            $return['data'] = array();
        } else {
            $return['msg'] = 'success';
            $return['data'] = $list;
        }
        return $return;
    } // }}}

    //1:1 문의 답변 저장 2018-11-09
    public function set_ask_answer($params){
        $return = array();
        try {
            $this->db2->trans_begin();
            $sql_param['ar_uptDt']=YMD_HIS;
            $sql_param['ar_regId']=$this->openssl_mem->aes_decrypt(USER_ID);
            $sql_param['ar_uptId']=$this->openssl_mem->aes_decrypt(USER_ID);
            $sql_param['ar_state']='Y';
            $sql_param['ar_answer']=$params['ar_answer'];

            $where['ar_ask_idx']=$params['ar_ask_idx'];

            $result = $this->commondao->update_table('tbl_ask_req', $sql_param, $where);
            if($result == 0) except('데이터 저장에 오류가 있습니다.', true);
            if($result < 0) except('데이터 저장에 실패하였습니다.', true);
            $return['msg'] = 'success';
            $return['data'] = $result;
            $this->db2->trans_commit();
            $this->_save_admin($params['ar_ask_idx'], "1:1문의 답변 - ".$params['ar_answer']);
        } catch (Exception $e) {
            if(!empty($e->getCode())) $this->db2->trans_rollback();
            $return['msg'] = 'error';
            $return['data'] = $e->getMessage();
        }
        return $return;
    }

    //1:1 문의 답변 저장 2018-11-09
    public function get_ask_answer($params){
        $return = array();
        $sql_param = array();
        if($params['type']=="list"){ // 리스트
            $sql_param['ar_tel'] =$this->openssl_mem->aes_encrypt(fn_only_number($params['ar_tel']));
            $orderby="ar_ask_idx desc";
            $result = $this->commondao->get_table('tbl_ask_req', $sql_param,$orderby);
            $list = $result;
            if (empty($list)) {
                $return['msg'] = 'error';
                $return['data'] = array();
            } else {
                $return['msg'] = 'success';
                $return['data'] = $list;
            }

        }else if($params['type']=="answer"){ // 답변 및 상세
            if($params['ar_ask_idx']) {
                $sql_param_tmp=array();
                $sql_param_tmp['ar_ask_idx']= $params['ar_ask_idx'];
                $result_tmp = $this->commondao->get_table('tbl_ask_req', $sql_param_tmp);
                $list = $result_tmp[0];

                if (empty($list)) {
                    $return['msg'] = 'error';
                    $return['data'] = array();
                } else {
                    $return['msg'] = 'success';
                    $return['data'] = $list;
                }
            }else{
                $return['msg'] = 'error';
                $return['data'] = array();
            }
        }else{
            $return['msg'] = 'error';
            $return['data'] = array();
        }

        return $return;
    }

    // 관리자 로그 저장
    private function _save_admin($user_srl, $comment) { // {{{

        $sql_param = array();
        $sql_param['admin_id'] = $this->openssl_mem->aes_decrypt(USER_ID);
        $sql_param['user_srl'] = $user_srl;
        $sql_param['action_comment'] = $comment;
        $sql_param['user_log_ip_address'] = $_SERVER['REMOTE_ADDR'];
        $sql_param['action_date'] = YMD_HIS;
        $admin_srl = $this->commondao->insert_table('admin_log', $sql_param);
        if(empty($admin_srl)) except('데이터 저장 실패', true);
    } // }}}
}
