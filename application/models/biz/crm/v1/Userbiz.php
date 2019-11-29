<?php
/**
 * @ description : User model
 * @ author : jeromc
 * @property Commondao $commondao
 */
class Userbiz extends CI_Model {
    public function __construct() { // {{{
        parent::__construct();
        $this->db2 = $this->load->database('insertdb', TRUE);
        $this->load->model('dao/Commondao','commondao');
    } // }}}


    //관리자 로그인 by.jeromc 2018-11-05
    public function login_admin($user_id, $user_pw){
        $return = array();
        $sql_param = array();


        $sql = "SELECT
                    USER.*,
                    INFO.info_title,
                    INFO.info_yn,
                    INFO.info_value
                FROM tbl_hosptl_accnt as USER
                    left join tbl_hosptl_base as OFFICE  on OFFICE.hb_idx=  USER.hb_idx
                    left join infos as INFO on INFO.info_tag='user_grade' and  USER.hc_grade=INFO.info_value
                WHERE USER.hc_grade > 0 AND USER.hc_state='Y' and OFFICE.hb_state='Y'
                    AND USER.hc_id = ? 
        ";
        $sql_param['hc_id'] =$user_id;
        $result = $this->commondao->get_query($sql, $sql_param);
        $user_info = $result[0];
//        fn_log($user_info,"user_info");
        if(empty($user_info)) {
            $return['msg'] = 'error';
            $return['data'] = '데이터가 없습니다.';
        } else {

            if(password_verify($user_pw, $user_info['hc_pwd'])) {
                unset($user_info['hc_pwd']);
                $user_info['first'] = "N";
                $user_info['auth_flag'] = "Y";
                if ($user_pw == "mplan!2345*") $user_info['first'] = "Y";
                $return['msg'] = 'success';
                $return['data'] = $user_info;
                $this->_login_admin($user_info['hb_idx'], "SUCCESS");
            }else{
                $return['msg'] = 'error';
                $return['data'] = '비밀번호나 아이디가 맞지 않습니다.';
            }
        }
        return $return;
    }

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

    // 관리자 어드민 로그인 로그 저장 by.jeromc 2018-11-06
    private function _login_admin($user_srl, $status,$user_login_log_srl=null) { // {{{
        $sql_param = array();

        if(!$user_login_log_srl){
            $sql_param['user_srl'] = $user_srl;
            $sql_param['user_login'] = "SUCCESS";
            $sql_param['user_auth_login'] = "SUCCESS";
            $sql_param['user_login_ip_address'] = $_SERVER['REMOTE_ADDR'];
            $sql_param['user_login_device'] =json_encode( $_SERVER['HTTP_USER_AGENT']);
            $sql_param['user_login_session'] = session_id();
            $sql_param['user_login_date'] = YMD_HIS;
            $user_login_log_srl = $this->commondao->insert_table('admin_user_login_log', $sql_param);
            $this->session->set_userdata('user_login_log_srl', $user_login_log_srl);

        }else{
            $where = array();
            $where['user_login_log_srl'] = $user_login_log_srl;
            $sql_param['user_auth_login'] = $status;
            $result = $this->commondao->update_table('admin_user_login_log', $sql_param, $where);
            if($result == 0) except('데이터 저장에 오류가 있습니다.', true);
            if($result < 0) except('데이터 저장에 실패하였습니다.', true);
        }
    } // }}}

    // 회원수 가져오기 get_user_count
    public function get_user_count($search=array()) { // {{{
        $return = array();
        $sql_param = array();
        $sql = "";

        if(empty($user)) {
            $return['msg'] = 'error';
            $return['data'] = array();
        } else {
            $return['msg'] = 'success';
            $return['data'] = $user;
        }
        return $return;
    } // }}}


    // 초기화 비번 변경 by.jeromc 2018-11-07
    public function change_pw_admin($admin_pw1,$admin_pw2){
        $return = array();
        try {

            $return = array();
            $where = array();

            $sql = "SELECT
                    *
                FROM tbl_office_accnt USER
                WHERE USER.ac_officeAcc_idx =?
        ";
            $user_srl=$this->session->userdata('user_idx');
            $where['ac_officeAcc_idx'] = $user_srl;
            $result = $this->commondao->get_query($sql, $where);
            $user_info = $result[0];


            //if($this->openssl_mem->aes_decrypt($admin_info['user_password'])!=$admin_pw1){
            if(!password_verify($admin_pw1, $user_info['ac_pwd'])){
                except('기존 비밀번호가 틀립니다. 다시 확인해 주세요.', true);
            }
            $this->db2->trans_begin();

            $sql_param = array();
            //$sql_param['user_password'] =$this->openssl_mem->aes_encrypt($admin_pw2);
            $sql_param['ac_pwd'] =password_hash($admin_pw2, PASSWORD_DEFAULT);
            $sql_param['ac_uptDt'] =YMD_HIS;//date('Y-m-d H:i:s');


//            $where['user_srl'] =  $sql_param['user_srl'];

            $result = $this->commondao->update_table('tbl_office_accnt', $sql_param, $where);

            if($result == 0) except('이미 초기화 되었거나 데이터 저장에 오류가 있습니다.(4)'.$result, true);
            if($result < 0) except('데이터 저장에 실패하였습니다.'.$result, true);

            $return['msg'] = 'success';
            $return['data'] = $result;
            $this->db2->trans_commit();
            $this->_save_admin($user_srl, '자신 비번 변경');

        } catch (Exception $e) {
            if(!empty($e->getCode())) $this->db->trans_rollback();
            $return['msg'] = 'error';
            $return['data'] = $e->getMessage();
        }
        return $return;
    }

    // 제휴신청 count by.jeromc 2018-11-09
    public function get_join_count($search=array()) { // {{{
        $return = array();
        $sql_param = array();

        $sql = "SELECT
                    COUNT(*) AS nt_count
                FROM tbl_join_req
                where 1=1
        ";

        foreach($search as $k => $v) {
            if($k=="jr_tel") {
                $tel = fn_only_number($v);
                $sql .= " AND " . $k . "  = '" . $this->openssl_mem->aes_encrypt($tel) . "'";
            }else if($k=="jr_state"){
                $sql .= " AND " . $k . "  = '" . $v . "'";
            }else {
                if (!empty($v)) $sql .= " AND " . $k . " LIKE '%" . $v . "%'";
            }
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
    } // }}}


    // 제휴신청 list by.jeromc 2018-11-09
    public function get_join_list($search=array(),$limit,$offset) { // {{{
        $return = array();
        $sql_param = array();

        $sql = "SELECT
                    *
                FROM tbl_join_req
                where 1=1
                
                
        ";
        foreach($search as $k => $v) {
            if($k=="jr_tel") {
                $tel = fn_only_number($v);
                $sql .= " AND " . $k . "  = '" . $this->openssl_mem->aes_encrypt($tel) . "'";
            }else if($k=="jr_state"){
                $sql .= " AND " . $k . "  = '" . $v . "'";
            }else {
                if (!empty($v)) $sql .= " AND " . $k . " LIKE '%" . $v . "%'";
            }
        }

        $sql.=" order by jr_joinReq_idx desc ";
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

    // 제휴 신청 상태 변경
    public function set_join_answer($params){
        $return = array();
        try {
            $this->db2->trans_begin();
            $sql_param['jr_uptDt']=YMD_HIS;
            $sql_param['jr_regId']=$this->openssl_mem->aes_decrypt(USER_ID);
            $sql_param['jr_uptId']=$this->openssl_mem->aes_decrypt(USER_ID);
            $sql_param['jr_state']=$params['jr_state'];

            $where['jr_joinReq_idx']=$params['jr_joinReq_idx'];

            $result = $this->commondao->update_table('tbl_join_req', $sql_param, $where);
            if($result == 0) except('데이터 변경이 안되었습니다.', true);
            if($result < 0) except('데이터 저장에 실패하였습니다.', true);
            $return['msg'] = 'success';
            $return['data'] = $result;
            $this->db2->trans_commit();
            $this->_save_admin($params['jr_joinReq_idx'], "제휴신청 진행상태 - ".$params['jr_state']);
        } catch (Exception $e) {
            if(!empty($e->getCode())) $this->db2->trans_rollback();
            $return['msg'] = 'error';
            $return['data'] = $e->getMessage();
        }
        return $return;
    }

    ////////// 관리자 계정
    // 관리자 카운트 count by.jeromc 2018-11-14
    public function get_admin_count($search=array()) { // {{{
        $return = array();
        $sql_param = array();

        $sql = "SELECT
                    COUNT(*) AS nt_count
                FROM tbl_hosptl_accnt
                where hb_idx='1'
        ";

        foreach($search as $k => $v) {
            if($k=="hc_grade") {
                if (!empty($v))  $sql .= " AND " . $k . "  = '" . $v . "'";
            }else if($k=="hc_state"){
                if (!empty($v)) $sql .= " AND " . $k . "  = '" . $v . "'";
            }else {
                if (!empty($v)) $sql .= " AND " . $k . " LIKE '%" . $v . "%'";
            }
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
    } // }}}


    // 관리자 list by.jeromc 2018-11-14
    public function get_admin_list($search=array(),$limit,$offset) { // {{{
        $return = array();
        $sql_param = array();

        $sql = "SELECT
                    *
                FROM tbl_hosptl_accnt
                where hb_idx='1'
                
                
        ";
        foreach($search as $k => $v) {
            if($k=="hc_grade") {
                if (!empty($v))  $sql .= " AND " . $k . "  = '" . $v . "'";
            }else if($k=="hc_state"){
                if (!empty($v)) $sql .= " AND " . $k . "  = '" . $v . "'";
            }else {
                if (!empty($v)) $sql .= " AND " . $k . " LIKE '%" . $v . "%'";
            }
        }

        $sql.=" order by hc_grade desc, hc_nm ";
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

    // 관리자 계정 변경
    public function set_admin($params){
        $return = array();
        try {
            $this->db2->trans_begin();

            if(empty($params['hc_idx'])){
                $sql_param['hc_regdt'] = YMD_HIS;
                $sql_param['hc_uptdt'] = YMD_HIS;
                $sql_param['hc_regid'] = $this->openssl_mem->aes_decrypt(USER_ID);
                $sql_param['hc_uptid'] = $this->openssl_mem->aes_decrypt(USER_ID);
                $sql_param['hb_idx'] = "1";
                if (!empty($params['hc_id'])) $sql_param['hc_id'] = $params['hc_id'];
                if (!empty($params['hc_nm'])) $sql_param['hc_nm'] = $params['hc_nm'];
                $sql_param['hc_pwd'] =  password_hash("mplan!2345*", PASSWORD_DEFAULT);
                if (!empty($params['hc_grade'])) $sql_param['hc_grade'] = $params['hc_grade'];
                if (!empty($params['hc_state'])) $sql_param['hc_state'] = $params['hc_state'];

                $result = $this->commondao->insert_table('tbl_hosptl_accnt', $sql_param);
                if ($result == 0) except('데이터 변경이 안되었습니다.', true);
                if ($result < 0) except('데이터 저장에 실패하였습니다.', true);
                $return['msg'] = 'success';
                $return['data'] = $result;
                $this->db2->trans_commit();
                $this->_save_admin($params['hc_idx'], "관리자계정 저장 - " . json_encode($sql_param,JSON_UNESCAPED_UNICODE));
            }else {
                $sql_param['hc_uptdt'] = YMD_HIS;
                $sql_param['hc_regid'] = $this->openssl_mem->aes_decrypt(USER_ID);
                $sql_param['hc_uptid'] = $this->openssl_mem->aes_decrypt(USER_ID);
                if (!empty($params['hc_pwd']) && $params['hc_pwd']=="Y") $sql_param['hc_pwd'] =  password_hash("mplan!2345*", PASSWORD_DEFAULT);
                if (!empty($params['hc_grade'])) $sql_param['hc_grade'] = $params['hc_grade'];
                if (!empty($params['hc_state'])) $sql_param['hc_state'] = $params['hc_state'];

                $where['hc_idx'] = $params['hc_idx'];

                $result = $this->commondao->update_table('tbl_hosptl_accnt', $sql_param, $where);
                if ($result == 0) except('데이터 변경이 안되었습니다.', true);
                if ($result < 0) except('데이터 저장에 실패하였습니다.', true);
                $return['msg'] = 'success';
                $return['data'] = $result;
                $this->db2->trans_commit();
                $this->_save_admin($params['hc_idx'], "관리자계정 수정 - " . json_encode($sql_param,JSON_UNESCAPED_UNICODE));
            }
        } catch (Exception $e) {
            if(!empty($e->getCode())) $this->db2->trans_rollback();
            $return['msg'] = 'error';
            $return['data'] = $e->getMessage();
        }
        return $return;
    }

    ////////// fcm 계정
    // fcm 카운트 count by.jeromc 2018-11-14
    public function get_fcm_count($search=array()) { // {{{
        $return = array();
        $sql_param = array();

        $sql = "SELECT
                    COUNT(*) AS nt_count
                FROM tbl_fcm
                where 1=1
        ";

        foreach($search as $k => $v) {
           if($k=="sdate"){
                $sdate=$v;
            }else if($k=="edate"){
                $edate=$v;
            }else {
                if (!empty($v)) $sql .= " AND " . $k . " LIKE '%" . $v . "%'";
            }
        }

        if($sdate && $edate)  $sql .= " AND f_sendDt BETWEEN '".$sdate." 00:00:00' and '".$edate." 23:59:59'";
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


    // fcm list by.jeromc 2018-11-14
    public function get_fcm_list($search=array(),$limit,$offset) { // {{{
        $return = array();
        $sql_param = array();

        $sql = "SELECT
                   *
                FROM tbl_fcm
                where 1=1
        ";

        foreach($search as $k => $v) {
            if($k=="sdate"){
                $sdate=$v;
            }else if($k=="edate"){
                $edate=$v;
            }else {
                if (!empty($v)) $sql .= " AND " . $k . " LIKE '%" . $v . "%'";
            }
        }

        if($sdate && $edate)  $sql .= " AND f_sendDt BETWEEN '".$sdate." 00:00:00' and '".$edate." 23:59:59'";

        $sql.=" order by f_sendDt desc ";
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

    // fcm 전송 내역 저장 by.jeromc 2018-11-16
    public function set_fcm($params){
        $return = array();
        try {
            $this->db2->trans_begin();
            $sql_param['f_send_idx']= json_encode($params['f_send_idx'],JSON_UNESCAPED_UNICODE);
            $sql_param['f_send_msg']= json_encode($params['f_send_msg'],JSON_UNESCAPED_UNICODE);
            $sql_param['f_title']= $params['f_title'];
            $sql_param['f_ret']= $params['f_ret'];
            $sql_param['f_memo']= $params['f_memo'];
            $sql_param['f_sendDt']=YMD_HIS;
            $sql_param['f_sendId']=$this->openssl_mem->aes_decrypt(USER_ID);

            $result = $this->commondao->insert_table('tbl_fcm', $sql_param);
            if($result == 0) except('데이터 저장에 오류가 있습니다.', true);
            if($result < 0) except('데이터 저장에 실패하였습니다.', true);
            $return['msg'] = 'success';
            $return['data'] = $result;
            $this->db2->trans_commit();
            $this->_save_admin($result, "fcm 전송 - ".json_encode($sql_param,JSON_UNESCAPED_UNICODE));
        } catch (Exception $e) {
            if(!empty($e->getCode())) $this->db2->trans_rollback();
            $return['msg'] = 'error';
            $return['data'] = $e->getMessage();
        }
        return $return;
    }

    public function get_fcm_one($params){
        $sql_param = array();
        $sql_param['f_idx']=$params['f_idx'];
        $result = $this->commondao->get_table('tbl_fcm', $sql_param);

        $list = $result[0];
        if(empty($list)) {
            $return['msg'] = 'error';
            $return['data'] = array();
        } else {
            $list['f_send_msg']=json_decode($list['f_send_msg']);
            $return['msg'] = 'success';
            $return['data'] = $list;
        }
        return $return;
    }

    // rank 카운트 count by.jeromc 2018-11-22
    public function get_rank_count($param=array()) { // {{{
        $return = array();
        $where = array();

        if($this->openssl_mem->aes_decrypt($this->session->userdata('user_grade')) <= 6){
            $where['ob_office_idx'] = $this->session->userdata('office_idx');
        }

        $sql = "
                SELECT  
                COUNT(*) AS nt_count
                FROM tbl_office_base ob
                 left outer join  tbl_mbrship ms on ob.ob_office_idx = ms.ob_office_idx
                 left outer join tbl_serivce_goods sg on ms.si_svcgds_idx = sg.si_svcgds_idx
                 left join tbl_sidogu sido on ob.ob_sido=sido.sdg_sido_no and ob.ob_gu=sido.sdg_gu_no
                WHERE 1=1    
                ";

        if ($param['ob_officeNm'] != "") {
            $where['ob_officeNm'] = $param['ob_officeNm'];
        }
        if ($param['ob_addr'] != "") {
            $where['ob_addr'] = $param['ob_addr'];
        }
        if ($param['ob_tel'] != "") {
            $where['ob_tel'] = $param['ob_tel'];
        }
        if ($param['ob_state'] != "") {
            $where['ob_state'] = $param['ob_state'];
        }
        foreach ($where as $k => $v) {
            if ($k == 'ob_addr') {
                if (!empty($v)) $sql .= " AND (ob.ob_addr LIKE '%" . $v . "%' OR ob.ob_addr_desc LIKE '%" . $v . "%' )";
            } else if ($k == 'ob_officeNm') {
                if (!empty($v)) $sql .= " AND ob." . $k . " like '%" . $v . "%'";
            } else if ($k == 'ob_office_idx') {
                if (!empty($v)) $sql .= " AND ob.ob_office_idx = '" . $v . "'";
            } else {
                if (!empty($v)) $sql .= " AND ob." . $k . " = '" . $v . "'";
            }
        }
            $result = $this->commondao->get_query($sql, $where);
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
    //세무사무소 리스트  by.jeromc 2018-11-22
    public function get_rank_list($param, $limit, $offset)
    {
        $return = array();
        $where = array();

        if($this->openssl_mem->aes_decrypt($this->session->userdata('user_grade')) <= 6){
            $where['ob_office_idx'] = $this->session->userdata('office_idx');
        }

        $sql = "
              SELECT  @rownum := @rownum + 1 AS ranking, T.* FROM
              (
                SELECT  
                sido.sdg_sido_nm,sido.sdg_gu_nm,
                ob.ob_office_idx, ob.ob_officeNm, ob.ob_bizNum, ob.ob_bltDt, ob.ob_wrkrNum, ob.ob_email, ob.ob_ceoNm, ob.ob_tel, ob.ob_logo, ob.ob_filePath
                       ,ob.ob_zip, ob.ob_addr, ob.ob_addr_desc, ob.ob_memo, ob.ob_latitud, ob.ob_longtitud, ob.ob_state, ob.ob_regDt, ob.ob_uptDt, ob.ob_regId, ob.ob_uptId
                       ,ifnull(sg.si_svcgdsNm,'-') si_svcgdsNm, sg.si_svcgds_amt, ifnull(ms.ms_mbrBeginDt,'-')ms_mbrBeginDt, ifnull(ms.ms_mbrEndDt,'-')ms_mbrEndDt,
                       ob.ob_choice_rank,ob.ob_answer_rank,ob.ob_sado_rank
                FROM tbl_office_base ob
                JOIN (SELECT @rownum := ".$offset.") r
                 left outer join  tbl_mbrship ms on ob.ob_office_idx = ms.ob_office_idx
                 left outer join tbl_serivce_goods sg on ms.si_svcgds_idx = sg.si_svcgds_idx
                 left join tbl_sidogu sido on ob.ob_sido=sido.sdg_sido_no and ob.ob_gu=sido.sdg_gu_no
                WHERE 1=1    
                ";

        if ($param['ob_officeNm'] != "") {
            $where['ob_officeNm'] = $param['ob_officeNm'];
        }
        if ($param['ob_addr'] != "") {
            $where['ob_addr'] = $param['ob_addr'];
        }
        if ($param['ob_tel'] != "") {
            $where['ob_tel'] = $param['ob_tel'];
        }
        if ($param['ob_state'] != "") {
            $where['ob_state'] = $param['ob_state'];
        }
        foreach ($where as $k => $v) {
            if ($k == 'ob_addr') {
                if (!empty($v)) $sql .= " AND (ob.ob_addr LIKE '%" . $v . "%' OR ob.ob_addr_desc LIKE '%" . $v . "%' )";
            } else if ($k == 'ob_officeNm') {
                if (!empty($v)) $sql .= " AND ob." . $k . " like '%" . $v . "%'";
            } else if ($k == 'ob_office_idx') {
                if (!empty($v)) $sql .= " AND ob.ob_office_idx = '" . $v . "'";
            } else {
                if (!empty($v)) $sql .= " AND ob." . $k . " = '" . $v . "'";
            }
        }
        if(empty($param['orderby']))  $sql .= " ORDER BY ob.ob_sado_rank DESC";
        else  $sql .= " ORDER BY ob.".$param['orderby']." DESC";
        $sql .= " LIMIT " . $limit . " OFFSET " . $offset;
        if(empty($param['orderby']))  $sql .= " ) AS T ORDER BY T.ob_sado_rank DESC";
        else   $sql .= " ) AS T ORDER BY T.".$param['orderby']." DESC";


        $result = $this->commondao->get_query($sql, $where);
        $return['msg'] = 'success';
        $return['data'] = $result;
        return $return;

    }

    // 랭킹 수정 by.jeromc 2018-11-22
    public function set_rank($params){

        $return = array();
        try {

            $return = array();
            $where = array();
            $sql_param=array();

            $this->db2->trans_begin();
            $sql_param['ob_uptDt'] = YMD_HIS;
            $sql_param['ob_uptId'] = $this->openssl_mem->aes_decrypt(USER_ID);
            $params['ob_choice_rank'] = fn_only_number($params['ob_choice_rank']);
            $params['ob_answer_rank'] = fn_only_number($params['ob_answer_rank']);
            $params['ob_sado_rank'] = fn_only_number($params['ob_sado_rank']);

            if(!empty($params['ob_choice_rank'])&&$params['ob_choice_rank']>0) $sql_param['ob_choice_rank']=$params['ob_choice_rank'];
            if(!empty($params['ob_answer_rank'])&&$params['ob_answer_rank']>0) $sql_param['ob_answer_rank']=$params['ob_answer_rank'];
            if(!empty($params['ob_sado_rank'])&&$params['ob_sado_rank']>0) $sql_param['ob_sado_rank']=$params['ob_sado_rank'];

            $where['ob_office_idx'] = $params['ob_office_idx'];

            $result = $this->commondao->update_table('tbl_office_base', $sql_param, $where);
            if ($result == 0) except('데이터 변경이 안되었습니다.', true);
            if ($result < 0) except('데이터 저장에 실패하였습니다.', true);
            $return['msg'] = 'success';
            $return['data'] = $result;

            $this->db2->trans_commit();
            $this->_save_admin($params['ob_office_idx'], '랭킹변경 - '.json_encode($sql_param,JSON_UNESCAPED_UNICODE));

        } catch (Exception $e) {
            if(!empty($e->getCode())) $this->db->trans_rollback();
            $return['msg'] = 'error';
            $return['data'] = $e->getMessage();
        }
        return $return;
    }

    ////////// log
    // log 카운트 count by.jeromc 2018-11-23
    public function get_log_count($search=array()) { // {{{
        $return = array();
        $sql_param = array();

        $sql = "SELECT
                    COUNT(*) AS nt_count
                FROM admin_log
                where 1=1
        ";

        foreach($search as $k => $v) {
            if($k=="sdate"){
                $sdate=$v;
            }else if($k=="edate"){
                $edate=$v;
            }else {
                if (!empty($v)) $sql .= " AND " . $k . " LIKE '%" . $v . "%'";
            }
        }

        if($sdate && $edate)  $sql .= " AND action_date BETWEEN '".$sdate." 00:00:00' and '".$edate." 23:59:59'";
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


    // log list by.jeromc 2018-11-23
    public function get_log_list($search=array(),$limit,$offset) { // {{{
        $return = array();
        $sql_param = array();

        $sql = "SELECT
                   *
                FROM admin_log
                where 1=1
        ";

        foreach($search as $k => $v) {
            if($k=="sdate"){
                $sdate=$v;
            }else if($k=="edate"){
                $edate=$v;
            }else {
                if (!empty($v)) $sql .= " AND " . $k . " LIKE '%" . $v . "%'";
            }
        }

        if($sdate && $edate)  $sql .= " AND action_date BETWEEN '".$sdate." 00:00:00' and '".$edate." 23:59:59'";

        $sql.=" order by admin_log_srl desc ";
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

    //log 상세 by.jeromc 2018-11-23
    public function get_log_one($params){
        $sql_param = array();
        $sql_param['admin_log_srl']=$params['admin_log_srl'];
        $result = $this->commondao->get_table('admin_log', $sql_param);

        $list = $result[0];
        if(empty($list)) {
            $return['msg'] = 'error';
            $return['data'] = array();
        } else {
            $list['f_send_msg']=json_decode($list['f_send_msg']);
            $return['msg'] = 'success';
            $return['data'] = $list;
        }
        return $return;
    }

    ///////////////////////////
    /// point
    // point 카운트 count by.jeromc 2018-11-27
    public function get_point_count($param=array()) { // {{{
        $return = array();
        $where = array();

        if($this->openssl_mem->aes_decrypt($this->session->userdata('user_grade')) <= 6){
            $where['ob_office_idx'] = $this->session->userdata('office_idx');
        }

        $sql = "
                SELECT  
                COUNT(*) AS nt_count
                 from tbl_office_base as a 
                 left join tbl_point as b on a.ob_office_idx=b.ob_office_idx
                WHERE 1=1    
                ";

        if ($param['ob_officeNm'] != "") {
            $where['ob_officeNm'] = $param['ob_officeNm'];
        }
        if ($param['ob_addr'] != "") {
            $where['ob_addr'] = $param['ob_addr'];
        }
        if ($param['ob_tel'] != "") {
            $where['ob_tel'] = $param['ob_tel'];
        }
        if ($param['ob_state'] != "") {
            $where['ob_state'] = $param['ob_state'];
        }
        foreach ($where as $k => $v) {
            if ($k == 'ob_addr') {
                if (!empty($v)) $sql .= " AND (a.ob_addr LIKE '%" . $v . "%' OR a.ob_addr_desc LIKE '%" . $v . "%' )";
            } else if ($k == 'ob_officeNm') {
                if (!empty($v)) $sql .= " AND a." . $k . " like '%" . $v . "%'";
            } else if ($k == 'ob_office_idx') {
                if (!empty($v)) $sql .= " AND a.ob_office_idx = '" . $v . "'";
            } else {
                if (!empty($v)) $sql .= " AND a." . $k . " = '" . $v . "'";
            }
        }
        $result = $this->commondao->get_query($sql, $where);
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
    //point 리스트  by.jeromc 2018-11-27
    public function get_point_list($param, $limit, $offset)
    {
        $return = array();
        $where = array();

        if($this->openssl_mem->aes_decrypt($this->session->userdata('user_grade')) <= 6){
            $where['ob_office_idx'] = $this->session->userdata('office_idx');
        }

        $sql = "
              SELECT  @rownum := @rownum + 1 AS ranking, T.* FROM
              (
                select a.ob_office_idx, max(a.ob_officeNm) as ob_officeNm,max(a.ob_state) as ob_state,
                             ifnull(sum(b.amount),0) as t_amount,
                             ifnull(sum(b.used_amount),0) as used_amount,
                             ifnull(sum(if(b.expiredDt>now(),b.amount-b.used_amount,0)),0) as sum_amount,  
                             ifnull(sum(if(b.expiredDt>now() && b.expiredDt<date_add(now(), interval +7 day),b.amount-b.used_amount,0)),0) as sum_amount_week
                             from tbl_office_base as a 
                              JOIN (SELECT @rownum := ".$offset.") r
                             left join tbl_point as b on a.ob_office_idx=b.ob_office_idx
                WHERE 1=1    
                ";

        if ($param['ob_officeNm'] != "") {
            $where['ob_officeNm'] = $param['ob_officeNm'];
        }
        if ($param['ob_addr'] != "") {
            $where['ob_addr'] = $param['ob_addr'];
        }
        if ($param['ob_tel'] != "") {
            $where['ob_tel'] = $param['ob_tel'];
        }
        if ($param['ob_state'] != "") {
            $where['ob_state'] = $param['ob_state'];
        }
        foreach ($where as $k => $v) {
            if ($k == 'ob_addr') {
                if (!empty($v)) $sql .= " AND (a.ob_addr LIKE '%" . $v . "%' OR a.ob_addr_desc LIKE '%" . $v . "%' )";
            } else if ($k == 'ob_officeNm') {
                if (!empty($v)) $sql .= " AND a." . $k . " like '%" . $v . "%'";
            } else if ($k == 'ob_office_idx') {
                if (!empty($v)) $sql .= " AND a.ob_office_idx = '" . $v . "'";
            } else {
                if (!empty($v)) $sql .= " AND a." . $k . " = '" . $v . "'";
            }
        }
        $sql .="  group by a.ob_office_idx ";
        if(empty($param['orderby']))  $sql .= " ORDER BY sum_amount DESC";
        else  $sql .= " ORDER BY ".$param['orderby']." DESC";
        $sql .= " LIMIT " . $limit . " OFFSET " . $offset;
        if(empty($param['orderby']))  $sql .= " ) AS T ORDER BY T.sum_amount DESC";
        else   $sql .= " ) AS T ORDER BY T.".$param['orderby']." DESC";

        $result = $this->commondao->get_query($sql, $where);
        $return['msg'] = 'success';
        $return['data'] = $result;
        return $return;

    }

    ///////////////////////////
    /// point
    // point 상세 카운트 count by.jeromc 2018-11-27
    public function get_point_d_count($ob_office_idx) { // {{{
        $return = array();

        if($this->openssl_mem->aes_decrypt($this->session->userdata('user_grade')) <= 6){
            $ob_office_idx = $this->session->userdata('office_idx');
        }

        $sql = "
                SELECT  
                COUNT(*) AS nt_count
                 from tbl_point 
                WHERE ob_office_idx=?    
                ";

        $where['ob_office_idx'] = $ob_office_idx;
        $result = $this->commondao->get_query($sql, $where);
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
    //point 상세 리스트  by.jeromc 2018-11-27
    public function get_point_d_list($ob_office_idx, $limit, $offset)
    {
        $return = array();
        if($this->openssl_mem->aes_decrypt($this->session->userdata('user_grade')) <= 6){
            $ob_office_idx = $this->session->userdata('office_idx');
        }

        $sql = "
                SELECT  
                a.*, b.info_title
                 from tbl_point as a 
                 left join infos as b on a.p_dtype=b.info_value and b.info_tag='p_dtype'
                WHERE a.ob_office_idx=?    
                ";
        $sql .= " ORDER BY a.p_idx DESC";
        $sql .= " LIMIT " . $limit . " OFFSET " . $offset;


        $where['ob_office_idx'] = $ob_office_idx;
        $result = $this->commondao->get_query($sql, $where);
        $return['msg'] = 'success';
        $return['data'] = $result;
        return $return;

    }

    // point 수정 by.jeromc 2018-11-27
    public function set_point($params){
//{'ob_office_idx': id, 'amount': amount, 'p_dtype': p_dtype, 'p_memo': p_memo, 'expiredDt': expiredDt};
            $return = array();

            if($params['p_dtype']>=200){//출금
                $return= fn_point_use($params['ob_office_idx'], $params['amount'],'',$params['p_dtype'],$params['p_memo']);

            }else{//입금
                $return= fn_point_save($params['ob_office_idx'], $params['amount'],'',$params['expiredDt'],$params['p_dtype'],$params['p_memo']);
            }

        return $return;
    }


    ////////// infos 계정
    // infos array by.jeromc 2018-12-05
    public function get_infos_array(){
        $sql_param = array();
        $sql = "SELECT
                    info_tag 
                FROM infos
                where info_yn='Y'
                group by info_tag
                order by info_tag 
        ";

        $result = $this->commondao->get_query($sql, $sql_param);
        return $result;
    }
    // infos 카운트 count by.jeromc 2018-12-05
    public function get_infos_count($search=array()) { // {{{
        $return = array();
        $sql_param = array();

        $sql = "SELECT
                    COUNT(*) AS nt_count
                FROM infos
                where 1=1
        ";

        if($search['search_info_tag']){
            $sql .= " AND info_tag = ? ";
            $sql_param['info_tag']=$search['search_info_tag'];
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
    } // }}}


    // infos list by.jeromc 2018-12-05
    public function get_infos_list($search=array(),$limit,$offset) { // {{{
        $return = array();
        $sql_param = array();

        $sql = "SELECT
                   *
                FROM infos
                where 1=1
        ";
        if($search['search_info_tag']){
            $sql .= " AND info_tag = ? ";
            $sql_param['info_tag']=$search['search_info_tag'];
        }

        $sql.=" order by info_tag ";
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

    // infos 전송 내역 저장 by.jeromc 2018-12-05
    public function set_infos($params){
        $return = array();
        $sql_param=array();
        try {
            $this->db2->trans_begin();
            if($params['info_srl']){ //update

                $sql_param['info_title']= $params['info_title'];
                $sql_param['info_value']= $params['info_value'];
                $sql_param['info_yn']= $params['info_yn'];
                $sql_param['info_update']=YMD_HIS;
                $where=array();
                $where['info_srl']=$params['info_srl'];
                $result = $this->commondao->update_table('infos', $sql_param, $where);
                $str="infos 수정 - ";
            }else{//insert
                $sql_param['info_tag']= $params['info_tag'];
                $sql_param['info_title']= $params['info_title'];
                $sql_param['info_value']= $params['info_value'];
                $sql_param['info_yn']= $params['info_yn'];
                $sql_param['info_date']=YMD_HIS;
                $sql_param['info_update']=YMD_HIS;
                $result = $this->commondao->insert_table('infos', $sql_param);
                $str="infos 저장 - ";
            }

            if($result == 0) except('데이터 저장에 오류가 있습니다.', true);
            if($result < 0) except('데이터 저장에 실패하였습니다.', true);
            $return['msg'] = 'success';
            $return['data'] = $result;
            $this->db2->trans_commit();
            $this->_save_admin($result, $str.json_encode($sql_param,JSON_UNESCAPED_UNICODE));
        } catch (Exception $e) {
            if(!empty($e->getCode())) $this->db2->trans_rollback();
            $return['msg'] = 'error';
            $return['data'] = $e->getMessage();
        }
        return $return;
    }

    //infos by.jeromc 2018-12-05
    public function get_infos_one($params){
        $sql_param = array();
        $sql_param['info_srl']=$params['info_srl'];
        $result = $this->commondao->get_table('infos', $sql_param);

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

}
