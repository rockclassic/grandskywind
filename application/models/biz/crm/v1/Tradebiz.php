<?php
/**
 * @ description : Trade model
 * @ author : jeromc
 * @property Commondao $commondao
 */
class Tradebiz extends CI_Model {
    public function __construct() { // {{{
        parent::__construct();
        $this->db2 = $this->load->database('insertdb', TRUE);
        $this->load->model('dao/Commondao','commondao');
    } // }}}


    // 관리자 로그 저장
    private function _save_admin($user_srl=null, $comment) { // {{{
        $sql_param = array();
        $sql_param['admin_id'] = $this->openssl_mem->aes_decrypt(USER_ID);
        $sql_param['user_srl'] = $user_srl;
        $sql_param['action_comment'] = $comment;
        $sql_param['user_log_ip_address'] = $_SERVER['REMOTE_ADDR'];
        $sql_param['action_date'] = YMD_HIS;
        $admin_srl = $this->commondao->insert_table('admin_log', $sql_param);
        if(empty($admin_srl)) except('데이터 저장 실패', true);
    } // }}}


    // 견적신청 count by.jeromc 2018-11-09
    public function get_estimate_count($search=array()) { // {{{
        $return = array();
        $sql_param = array();
        $sql=" SELECT SUM(IF(nt_count>0,1,0)) as nt_count FROM (";
        if(empty($search['chk_only'])&&empty($search['chk_only_y'])) {
            $sql .= "SELECT
                            COUNT(a.em_estmtReq_idx) AS nt_count
                        FROM  tbl_estmtreq_mast as a left join tbl_estmtrsp as b on a.em_estmtReq_idx=b.em_estmtReq_idx
                        where 1=1
                ";
        }else if($search['chk_only']&&empty($search['chk_only_y'])){
            $sql .= "SELECT
                            COUNT(a.em_estmtReq_idx) AS nt_count
                        FROM tbl_estmtrsp as b left join tbl_estmtreq_mast as a on a.em_estmtReq_idx=b.em_estmtReq_idx
                        where b.hb_idx='".$this->session->userdata('hb_idx')."'";


        }else{
            $sql .= "SELECT
                            COUNT(a.em_estmtReq_idx) AS nt_count
                        FROM tbl_estmtrsp as b left join tbl_estmtreq_mast as a on a.em_estmtReq_idx=b.em_estmtReq_idx
                        where b.hb_idx='".$this->session->userdata('hb_idx')."'  and b.rs_state='Y'  ";
        }

        $sdate="";
        $edate="";
        foreach($search as $k => $v) {
            if($k=="em_tel") {
                $tel = fn_only_number($v);
                $sql .= " AND a." . $k . "  = '" . $this->openssl_mem->aes_encrypt($tel) . "'";
            }else if($k=="em_type"){
                $sql .= " AND a." . $k . "  = '" . $v . "'";
            }else if($k=="sdate"){
                $sdate=$v;
            }else if($k=="chk_only"){
            }else if($k=="chk_only_y"){

            }else if($k=="edate"){
                $edate=$v;
            }else {
                if (!empty($v)) $sql .= " AND a." . $k . " LIKE '%" . $v . "%'";
            }
        }
        if($sdate && $edate)  $sql .= " AND a.em_regDt BETWEEN '".$sdate." 00:00:00' and '".$edate." 23:59:59'";
        $sql .= " GROUP BY a.em_estmtReq_idx) as t";
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


    // 견적신청 list by.jeromc 2018-11-09
    public function get_estimate_list($search=array(),$limit,$offset) { // {{{
        $return = array();
        $sql_param = array();


        if(empty($search['chk_only'])) {
            $sql = "SELECT
                    a.*,  SUM(IF(b.rs_estmtRsp_idx is not null,1,0)) as  em_cnt
                 FROM  tbl_estmtreq_mast as a left join tbl_estmtrsp as b on a.em_estmtReq_idx=b.em_estmtReq_idx
                where 1=1
            ";
        } else if($search['chk_only']&&empty($search['chk_only_y'])){
            $sql = "SELECT
                              a.*,  SUM(IF(b.rs_estmtRsp_idx is not null,1,0)) as  em_cnt
                        FROM tbl_estmtrsp as b left join tbl_estmtreq_mast as a on a.em_estmtReq_idx=b.em_estmtReq_idx
                        where b.hb_idx='".$this->session->userdata('hb_idx')."'";


        }else{
            $sql = "SELECT
                              a.*,  SUM(IF(b.rs_estmtRsp_idx is not null,1,0)) as  em_cnt
                        FROM tbl_estmtrsp as b left join tbl_estmtreq_mast as a on a.em_estmtReq_idx=b.em_estmtReq_idx
                        where b.hb_idx='".$this->session->userdata('hb_idx')."'  and b.rs_state='Y'  ";
        }


        $sdate="";
        $edate="";
        foreach($search as $k => $v) {
            if($k=="em_tel") {
                $tel = fn_only_number($v);
                $sql .= " AND a." . $k . "  = '" . $this->openssl_mem->aes_encrypt($tel) . "'";
            }else if($k=="em_type"){
                $sql .= " AND a." . $k . "  = '" . $v . "'";
            }else if($k=="chk_only"){
            }else if($k=="chk_only_y"){
            }else if($k=="sdate"){
                $sdate=$v;
            }else if($k=="edate"){
                $edate=$v;
            }else {
                if (!empty($v)) $sql .= " AND a." . $k . " LIKE '%" . $v . "%'";
            }
        }
        if($sdate && $edate)  $sql .= " AND a.em_regDt BETWEEN '".$sdate." 00:00:00' and '".$edate." 23:59:59'";

        $sql .= " GROUP BY a.em_estmtReq_idx";
        $sql.=" order by a.em_estmtReq_idx desc ";

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


    //견적신청 상세  데이터 by.jeromc 2018-11-09
    public function get_estimate_one($srl){
        $return = array();
        $sql_param = array(
            'em_estmtReq_idx' => $srl,
        );
        $result = $this->commondao->get_table('tbl_estmtreq_mast', $sql_param);

        $list = $result[0];

        for($i=1;$i<10;$i++){
            $list['em_c'.$i]=explode("!^!" ,$list['em_c'.$i]);

        }

        if(empty($list)) {
            $return['msg'] = 'error';
            $return['data'] = array();
        } else {
            $return['msg'] = 'success';
            $return['data'] = $list;
        }
        return $return;
    }

    // 견적신청 답변 데이터 by.jeromc 2018-11-12
    public function get_estimate_rsp($srl,$limit,$offset){
        $return = array();
        $sql_param = array(
            'em_estmtReq_idx' => $srl,
        );


        $sql = "SELECT
                    a.*, b.hb_hosptl_nm, '' as ob_email, b.hb_tel,b.hb_state
                FROM tbl_estmtrsp as a 
                left join tbl_hosptl_base as b on a.hb_idx=b.hb_idx
                where a.em_estmtReq_idx=?
        ";

        if($this->openssl_mem->aes_decrypt($this->session->userdata('user_grade'))<=6){
            $sql.=" and a.hb_idx =? ";
            $sql_param['hb_idx']= $this->session->userdata('hb_idx');
        }
        $sql.=" order by a.rs_estmtRsp_idx desc ";
        if($limit>0) $sql .= " LIMIT ".$limit." OFFSET ".$offset;

        //print_r($sql);

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
    }
    // 견적신청 답변 데이터 by.jeromc 2018-11-12
    public function get_estimate_answer($srl,$limit,$offset){
        $return = array();
        $sql_param = array(
            'rs_estmtRsp_idx' => $srl,
        );


        $sql = "SELECT
                    a.*, b.hb_hosptl_nm, '' as ob_email, b.hb_tel,b.hb_state
                FROM tbl_estmtrsp as a 
                left join tbl_hosptl_base as b on a.hb_idx=b.hb_idx
                where a.rs_estmtRsp_idx=?
        ";

        if($this->openssl_mem->aes_decrypt($this->session->userdata('user_grade'))<=6){
            $sql.=" and a.hb_idx =? ";
            $sql_param['hb_idx']= $this->session->userdata('office_idx');
        }

        if($limit>0) $sql .= " LIMIT ".$limit." OFFSET ".$offset;

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
    }
    // 견적신청 답변 카운트 by.jeromc 2018-11-12
    public function get_estimate_rsp_count($srl){
        $return = array();
        $sql_param = array(
            'em_estmtReq_idx' => $srl,
        );


        $sql = "SELECT
                    COUNT(*) AS nt_count
               FROM tbl_estmtrsp as a 
                left join tbl_hosptl_base as b on a.hb_idx=b.hb_idx
                where a.em_estmtReq_idx=?
        ";

        if($this->openssl_mem->aes_decrypt($this->session->userdata('user_grade'))<=6){
            $sql.=" and a.hb_idx =? ";
            $sql_param['hb_idx']= $this->session->userdata('office_idx');
        }

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

    }
    // 견적신청 답변 by.jeromc 2018-11-09
    public function set_estimate_answer($params){
        $return = array();
        try {
            $this->db2->trans_begin();
            $sql_param['rs_regDt']=YMD_HIS;
            $sql_param['rs_uptDt']=YMD_HIS;
            $sql_param['rs_regId']=$this->openssl_mem->aes_decrypt(USER_ID);
            $sql_param['rs_uptId']=$this->openssl_mem->aes_decrypt(USER_ID);
            $sql_param['rs_state']='R';
            $sql_param['em_estmtReq_idx']= $params['em_estmtReq_idx'];
            $sql_param['hb_idx']= $this->session->userdata('hb_idx');

            if($params['rs_estmt_amt'])  $sql_param['rs_estmt_amt']=fn_only_number($params['rs_estmt_amt']);
            $sql_param['rs_estmt_memo']=$params['rs_estmt_memo'];

            $result = $this->commondao->insert_table('tbl_estmtrsp', $sql_param);
            if($result == 0) except('데이터 저장에 오류가 있습니다.', true);
            if($result < 0) except('데이터 저장에 실패하였습니다.', true);
            $return['msg'] = 'success';
            $return['data'] = $result;
            $this->db2->trans_commit();
            //견적 포인트 적립 by.jeromc 2018-11-27
            $sql_tmp="select  count(*) as tcnt, sum(if(hb_idx=?,1,0)) as cnt from tbl_estmtrsp where em_estmtReq_idx=?";
            $return_tmp = $this->commondao->get_query($sql_tmp, array($sql_param['hb_idx'],$sql_param['em_estmtReq_idx']));
            //if($return_tmp[0]['cnt']==1) {
            //    if($return_tmp[0]['tcnt']<=3) {
            //        $point = 10;
            //        fn_point_save($sql_param['hb_idx'], $point, '', 365, 110, '견적답변 적립 : ' . $result);
            //    }
            //}
            //답변 랭킹 점수 + by.jeromc 2018-11-28
            //fn_answer($sql_param['hb_idx']);
            $this->_save_admin($result, "견적 답변  - ". $sql_param['rs_estmt_amt']."원 / ".$params['rs_estmt_memo']);
        } catch (Exception $e) {
            if(!empty($e->getCode())) $this->db2->trans_rollback();
            $return['msg'] = 'error';
            $return['data'] = $e->getMessage();
        }
        return $return;
    }


    //견적답변상태변경 by,jeromc 2018-11-14
    public function update_rs_state($params){
        $return = array();
        try {
            $this->db2->trans_begin();
            $sql_param['rs_uptDt']=YMD_HIS;
            $sql_param['rs_regId']=$this->openssl_mem->aes_decrypt(USER_ID);
            $sql_param['rs_uptId']=$this->openssl_mem->aes_decrypt(USER_ID);
            $sql_param['rs_state']=$params['rs_state'];

            $where['rs_estmtRsp_idx']=$params['rs_estmtRsp_idx'];

            $result = $this->commondao->update_table('tbl_estmtrsp', $sql_param, $where);
            if($result == 0) except('데이터 변경이 안되었습니다.', true);
            if($result < 0) except('데이터 저장에 실패하였습니다.', true);
            $return['msg'] = 'success';
            $return['data'] = $result;
            $this->db2->trans_commit();
            $this->_save_admin($params['rs_estmtRsp_idx'], "견적답변 진행상태 - ".$params['rs_state']);
        } catch (Exception $e) {
            if(!empty($e->getCode())) $this->db2->trans_rollback();
            $return['msg'] = 'error';
            $return['data'] = $e->getMessage();
        }
        return $return;
    }

    //견적상태변경 by,jeromc 2018-11-14
    public function update_em_state($params){
        $return = array();
        try {
            $this->db2->trans_begin();
            $sql_param['em_uptDt']=YMD_HIS;
            $sql_param['em_regId']=$this->openssl_mem->aes_decrypt(USER_ID);
            $sql_param['em_uptId']=$this->openssl_mem->aes_decrypt(USER_ID);
            $sql_param['em_state']=$params['em_state'];

            $where['em_estmtReq_idx']=$params['em_estmtReq_idx'];

            $result = $this->commondao->update_table('tbl_estmtreq_mast', $sql_param, $where);
            if($result == 0) except('데이터 변경이 안되었습니다.', true);
            if($result < 0) except('데이터 저장에 실패하였습니다.', true);
            $return['msg'] = 'success';
            $return['data'] = $result;
            $this->db2->trans_commit();
            $this->_save_admin($params['em_estmtReq_idx'], "견적답변 진행상태 - ".$params['em_state']);
        } catch (Exception $e) {
            if(!empty($e->getCode())) $this->db2->trans_rollback();
            $return['msg'] = 'error';
            $return['data'] = $e->getMessage();
        }
        return $return;
    }
}
