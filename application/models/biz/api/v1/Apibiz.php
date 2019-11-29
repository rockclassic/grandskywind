<?php
/**
 * @ description : Api model
 * @ author : jeromc
 * @property Commondao $commondao
 * @property Openssl_mem $openssl_mem
 */
class Apibiz extends CI_Model {

    public function __construct() { // {{{
        parent::__construct();
        $this->db2 = $this->load->database('insertdb', TRUE);
        $this->load->model('dao/Commondao','commondao');
    } // }}}

    // ============ 내부함수 및 사용 안하는 함수... 시작 ============

    // mp 관리자 어드민 로그인 로그 저장 by.jeromc 2018-11-06 :: 2019-01-31
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

    // mp 관리자 로그 저장 2019-01-31
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

    // mp 관리자 로그인 by.jeromc 2018-11-05 :: 2019-01-31 :: 따로 사용은 안함
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

    // ============ 내부함수 및 사용 안하는 함수...  끝 ============

    // mp 회원 로그인 by.jeromc 2019-01-31
    public function ax_login($user_id, $user_pw){
        $return = array();
        $sql_param = array();


        $sql = "SELECT
                    USER.*
                FROM tbl_mbr as USER
                WHERE USER.mb_email = ? 
        ";
        $sql_param['mb_email'] =$user_id;
        $result = $this->commondao->get_query($sql, $sql_param);
        $user_info = $result[0];
        if(empty($user_info)) {
            $return['msg'] = 'error';
            $return['data'] = '데이터가 없습니다.';
        } else {

            if(password_verify($user_pw, $user_info['mb_pwd'])) {
                unset($user_info['mb_pwd']);
                $user_info['auth_flag'] = "Y";
                $return['msg'] = 'success';
                $return['data'] = $user_info;
                $this->_login_admin($user_info['mb_idx'], "SUCCESS");
            }else{
                $return['msg'] = 'error';
                $return['data'] = '비밀번호나 아이디가 맞지 않습니다.';
            }
        }
        return $return;
    }

    // mp 메인화면 병원정보 by.jeromc 2019-01-30 : 정보정보 이용 여부 확인필요
    public function get_h_info($search=array()){

    }

    // mp 메인화면 약국정보 by.jeromc 2019-01-30 : 정보정보 이용 여부 확인필요
    public function get_p_info($search=array()){

    }
    // mp  공지 count by.jeromc 2018-06-27 :: 2019-01-30
    public function get_notice_count($search=array()) { // {{{
        $return = array();
        $sql_param=array();
        $sql = "SELECT
                    COUNT(*) AS nt_count
                FROM tbl_notice
                WHERE nt_show_gbn=1
        ";

        if($search['nt_targt_gbn']){
            $sql.=" and nt_targt_gbn in ('ALL',?)";
            $sql_param['nt_targt_gbn']=$search['nt_targt_gbn'];
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


    // mp 공지 list by.jeromc 2018-10-29 :: 2019-01-30
    public function get_notice_list($search=array(),$limit,$offset) { // {{{
        $return = array();
        $sql_param = array();

        $sql = "SELECT
                    nt_notice_idx,nt_show_gbn,nt_cate_gbn,nt_title,nt_read_count,nt_regDt,nt_regId
                FROM tbl_notice
                WHERE nt_show_gbn=1
        ";
        if($search['nt_targt_gbn']){
            $sql.=" and nt_targt_gbn in ('ALL',?)";
            $sql_param['nt_targt_gbn']=$search['nt_targt_gbn'];
        }

        $sql.=" order by nt_cate_gbn desc, nt_notice_idx desc ";
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
        return $return['data'];
    } // }}}



    public function get_doctrList($limit,$offset){
        $return = array();
        $sql_param = array();

        $sql = "SELECT
                  md_idx,
                  md_dctr_nm,
                  hb_idx,
                  md_img,
                  md_img_path,
                  md_img_width,
                  md_img_height,
                  md_mdcalsubjct_cd,
                  md_mdcalsubjct_nm,
                  md_profield_cd,
                  md_profield_nm,
                  md_regdt,
                  md_uptdt,
                  md_regid,
                  md_uptid
                FROM tbl_main_doctr
                WHERE 1=1
        ";
        //if($search['nt_targt_gbn']){
        $sql.=" and hb_idx in (?)";
        $sql_param['hb_idx']='1';
        //}

        $sql.=" order by md_idx desc";
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
        return $return['data'];
    }



    public function get_mainCenterData_img($limit,$offset){
        $return = array();
        $sql_param = array();

        $sql = "SELECT   hi_idx,
                          hb_idx,
                          hi_img,
                          hi_img_path,
                          hi_img_width,
                          hi_img_height,
                          hi_main_gbn,
                          hi_regdt,
                          hi_uptdt,
                          hi_regid,
                          hi_uptid
                FROM tbl_hosptl_img
                WHERE 1=1
        ";
        //if($search['nt_targt_gbn']){
            $sql.=" and hb_idx in (?)";
            $sql_param['hb_idx']='1';
        //}

        $sql.=" order by hi_idx desc";
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
        return $return['data'];
    }




    public function get_mainCenterData_info()
    {
        $return = array();

        $sql = "
                 SELECT
                      m.hb_idx,
                      hb_hosptl_nm,
                      hb_zip_num,
                      hb_addr,
                      hb_addr_desc,
                      hb_sido,
                      hb_gu,
                      hb_latitude,
                      hb_longtitude,
                      hb_tel,
                      hb_intro,
                      hb_img,
                      hb_img_path,
                      hb_img_width,
                      hb_img_height,
                      hb_memo,
                      hb_mdcalsubjct_cd,
                      hb_theme_cd,
                      hb_profield_cd,
                      hb_hosptl_gbn,
                      hb_reserv_gbn,
                      hb_accpt_gbn,
                      hb_estmate_gbn,
                      hb_state,
                      n.hi_img officeImg
                FROM tbl_hosptl_base m
                  LEFT OUTER JOIN tbl_hosptl_img n
                    ON m.hb_idx = n.hb_idx
                    AND n.hi_main_gbn = 'Y'
                WHERE 1=1
                  and  m.hb_idx = ? 
        ";

        //if ($params['hb_idx']) {
            //$sql .= " and  hb_idx = ?";
            $sql_param['hb_idx'] = '1';
        //}
        //fn_log($sql);

        $result = $this->commondao->get_query($sql, $sql_param);
        $hb_idx = $result[0]['hb_idx'];
        $hb_hosptl_nm = $result[0]['hb_hosptl_nm'];
        $hb_addr = $result[0]['hb_addr'];
        $hb_addr_desc = $result[0]['hb_addr_desc'];
        $officeImg = $result[0]['officeImg'];

        if (!empty($result)) {
            $return['msg'] = 'TRUE';
            $return['hb_idx'] = $hb_idx;
            $return['hb_hosptl_nm'] = $hb_hosptl_nm;
            $return['hb_addr'] = $hb_addr;
            $return['hb_addr_desc'] = $hb_addr_desc;
            $return['officeImg'] = $officeImg;
        } else {
            $return['msg'] = 'FALSE';
            $return['hb_idx'] = '';
            $return['hb_hosptl_nm'] = '';
            $return['hb_addr'] = '';
            $return['hb_addr_desc'] = '';
            $return['officeImg'] = '';
        }

        return $return;
    }


    // mp 공지 상세 list by.jeromc 2018-10-29 :: 2019-01-30
    public function get_notice_cont($idx){
        $sql_param = array();
        $sql_param['nt_notice_idx']=$idx;
        $result = $this->commondao->get_table('tbl_notice', $sql_param);
        if(!empty($result)) {
            $this->set_notice_count($idx);
        }
        return $result;
    }

    // mp 공지 읽음 업데아트 list by.jeromc 2018-10-29 :: 2019-01-30
    public function set_notice_count($idx){
        $sql="UPDATE tbl_notice SET `nt_read_count` = nt_read_count+1 where nt_notice_idx=?";
        $result = $this->commondao->update_query($sql, $idx);
        return $result;

    }

    // mp 앱버전 list by.jeromc 2019-01-31 :: 2018-10-29
    public function get_version($info_tag){
        $sql_param = array();
        $sql_param['info_tag']=$info_tag;
        $result = $this->commondao->get_table('infos', $sql_param);
        $data['ios']=$result[0]['info_title'];
        $data['android']=$result[0]['info_value'];
        return $data;

    }

    // mp 시도구 전송 by.jeromc 2019-01-31
    public function get_sidogu($search=array()){
        $return = array();
        $sql_param=array();
        if($search['type']=="sido"){
            $sql="select  sdg_sido_no,sdg_sido_nm from tbl_sidogu group by  sdg_sido_no,sdg_sido_nm";
        }else if($search['type']=="gu") {
            $sql="select  sdg_gu_no,sdg_gu_nm from tbl_sidogu where  sdg_sido_no=?";
            $sql_param['sdg_sido_no']=$search['sdg_sido_no'];
        }else{
            $sql="select  sdg_sido_no,sdg_sido_nm from tbl_sidogu group by  sdg_sido_no,sdg_sido_nm";
        }
        $return = $this->commondao->get_query($sql, $sql_param);
        return $return;
    }

    // mp 우리 가맹업체들 지도 정보 by.jeromc 2019-01-31
    public function map_hosptl_list($search, $limit, $offset){
        $sql = "
           SELECT  ( 6371 * acos( cos( radians(?) ) * cos( radians( ob_latitud ) )
                      * cos( radians( ob_longtitud ) - radians(?) )
                      + sin( radians(?) ) * sin( radians( ob_latitud ) ) ) ) AS distance,a.*
                      /*,ob_choice_rank,ob_answer_rank,ob_sado_rank*/
              FROM tbl_hosptl_base as a
              where  ob_state in('Y')
              HAVING distance <= ?            
        ";
        $sql .= " order by distance ";
        if($limit>0) $sql .= " LIMIT ".$limit." OFFSET ".$offset;
        $sql_param=array($search['latitud'],$search['longtitud'],$search['latitud'],$search['rang_km']);

        $result = $this->commondao->get_query($sql, $sql_param);

        return $result;
    }
    //------------------- mp 개발 구분  ------------------------------------------------------------------------------------



    // 견적의뢰 list by.jeromc 2018-11-09
    public function get_req_list($search=array(),$limit,$offset) { // {{{
        $return = array();
        $sql_param = array();

        $sql = "SELECT
                   em_estmtReq_idx,em_estmtReqNm,em_dvceid,em_type,em_c1,em_c2,em_c3,em_c4,em_c5,em_c6,em_c7,em_c8,em_c9,em_state,em_regDt
                FROM tbl_estmtreq_mast
             
                
        ";

        $sql.=" order by em_estmtReq_idx desc ";
        if($limit>0) $sql .= " LIMIT ".$limit." OFFSET ".$offset;

        $result = $this->commondao->get_query($sql, $sql_param);
        $list = $result;
        if(empty($list)) {
            $return['msg'] = 'error';
            $return['data'] = array();
        } else {
            foreach ($list as $k => $v) {

                for ($i = 1; $i < 10; $i++) {
                    $tmp = explode("!^!", $v['em_c' . $i]);
                    $list[$k]['em_c' . $i]=$tmp[1];
                }
            }

            $return['msg'] = 'success';
            $return['data'] = $list;
        }
        return $return['data'];
    } // }}}






    //견적요청 저장 by.jeromc 2018-10-31
    public function set_estmtreq($sql_param){
        $return = array();
        try {
            $this->db2->trans_begin();
            $sql_param['em_regDt']=YMD_HIS;
            $sql_param['em_uptDt']=YMD_HIS;
            $sql_param['em_state']='R';
            if(!empty($sql_param['em_tel'])){
                $sql_param['em_tel']=$this->openssl_mem->aes_encrypt(fn_only_number($sql_param['em_tel']));
            }
            $result = $this->commondao->insert_table('tbl_estmtreq_mast', $sql_param);
            if($result == 0) except('데이터 저장에 오류가 있습니다.', true);
            if($result < 0) except('데이터 저장에 실패하였습니다.', true);
            $return['msg'] = 'success';
            $return['data'] = $result;
            $this->db2->trans_commit();
        } catch (Exception $e) {
            if(!empty($e->getCode())) $this->db2->trans_rollback();
            $return['msg'] = 'error';
            $return['data'] = $e->getMessage();
        }
        return $return;
    }

    // 내 견적 요청 count by.jeromc 2018-10-31
    public function get_estmtreq_count($userid){
        $return = array();
        $sql_param=array();
        $sql = "SELECT
                    COUNT(*) AS nt_count
                FROM tbl_estmtreq_mast
                
        ";

        if($userid){
            $sql.=" where em_tel = ?";
            $sql_param['em_tel']=$this->openssl_mem->aes_encrypt(fn_only_number($userid));
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

    // 내 견적 요청 by.jeromc 2018-10-31
    public function get_estmtreq($userid,$limit,$offset){
        $return = array();
        $sql_param=array();
        $sql = "SELECT
                    * ,(select count(*) as cnt from tbl_estmtrsp where rs_state not in('N') and em_estmtReq_idx=tbl_estmtreq_mast.em_estmtReq_idx) as em_cnt
                FROM tbl_estmtreq_mast
                
        ";
        if($userid){
            $sql.=" where em_tel = ?";
            $sql_param['em_tel']=$this->openssl_mem->aes_encrypt(fn_only_number($userid));
        }
        $sql.=" order by em_estmtReq_idx desc ";
        if($limit>0) $sql .= " LIMIT ".$limit." OFFSET ".$offset;

        $result = $this->commondao->get_query($sql, $sql_param);
        $list = $result;

        foreach ($list as $k => $v) {

            for ($i = 1; $i < 10; $i++) {
                $tmp = explode("!^!", $v['em_c' . $i]);
                $list[$k]['em_c' . $i]=$tmp[1];
            }
        }

        if(empty($list)) {
            $return['msg'] = 'error';
            $return['data'] = array();
        } else {
            $return['msg'] = 'success';
            $return['data'] = $list;
        }
        return $return['data'];
    }

    //  견적 답변  count by.jeromc 2018-10-31
    public function get_answer_count($search=array()){
        $return = array();
        $sql_param=array();
        $sql = "SELECT
                    COUNT(*) AS nt_count
                
                from  tbl_estmtrsp as a 
                left join tbl_estmtreq_mast as b on a.em_estmtReq_idx=b.em_estmtReq_idx
                left join tbl_office_base as c on a.ob_office_idx=c.ob_office_idx
                where a.rs_state not in('N') and c.ob_state in('Y')
        ";

        if($search['userid']){
            $sql.=" and  b.em_tel = ?";
            $sql_param['em_tel']=$this->openssl_mem->aes_encrypt(fn_only_number($search['userid']));
        }
        if($search['ob_office_idx']){
            $sql.=" and  a.ob_office_idx = ?";
            $sql_param['ob_office_idx']=$search['ob_office_idx'];
        }
        if($search['rs_estmtRsp_idx']){
            $sql.=" and  a.rs_estmtRsp_idx = ?";
            $sql_param['rs_estmtRsp_idx']=$search['rs_estmtRsp_idx'];
        }
        if($search['em_estmtReq_idx']){ //문의 id
            $sql.=" and  a.em_estmtReq_idx = ?";
            $sql_param['em_estmtReq_idx']=$search['em_estmtReq_idx'];
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

    public function get_answer($search=array(),$limit,$offset){
        $return = array();
        $sql_param=array();
        $sql = "SELECT
                    a.*,b.em_tel,c.ob_choice_rank,c.ob_answer_rank,c.ob_sado_rank
                 from  tbl_estmtrsp as a 
                left join tbl_estmtreq_mast as b on a.em_estmtReq_idx=b.em_estmtReq_idx
                left join tbl_office_base as c on a.ob_office_idx=c.ob_office_idx
                where a.rs_state not in('N') and c.ob_state in('Y')
        ";

        if($search['userid']){
            $sql.=" and  b.em_tel = ?";
            $sql_param['em_tel']=$this->openssl_mem->aes_encrypt(fn_only_number($search['userid']));
        }
        if($search['ob_office_idx']){   //세무소 id
            $sql.=" and  a.ob_office_idx = ?";
            $sql_param['ob_office_idx']=$search['ob_office_idx'];
        }
        if($search['rs_estmtRsp_idx']){ //답변 id
            $sql.=" and  a.rs_estmtRsp_idx = ?";
            $sql_param['rs_estmtRsp_idx']=$search['rs_estmtRsp_idx'];
        }
        if($search['em_estmtReq_idx']){ //문의 id
            $sql.=" and  a.em_estmtReq_idx = ?";
            $sql_param['em_estmtReq_idx']=$search['em_estmtReq_idx'];
        }



        if($search['orderby']){
            $sql .= " order by ".$search['orderby']." ".$search['sort'].", a.rs_estmtRsp_idx desc  ";
        }else {
            $sql .= " order by a.rs_estmtRsp_idx desc ";
        }
        if($limit>0) $sql .= " LIMIT ".$limit." OFFSET ".$offset;

        $result = $this->commondao->get_query($sql, $sql_param);
        foreach ($result as $k=>$v){
            if(!empty($v['em_tel'])) $v['em_tel']=$this->openssl_mem->aes_decrypt($v['em_tel']);
            $return[]=$v;
        }

        return $return;
    }


    // 제휴 신청 저장 by.jeromc 2018-10-31
    public function set_partner($sql_param){
        $return = array();
        try {
            $this->db2->trans_begin();
            $sql_param['jr_regDt']=YMD_HIS;
            $sql_param['jr_uptDt']=YMD_HIS;
            $sql_param['jr_state']='R';
            if(!empty($sql_param['jr_tel'])){
                $sql_param['jr_tel']=$this->openssl_mem->aes_encrypt(fn_only_number($sql_param['jr_tel']));
            }
            $result = $this->commondao->insert_table('tbl_join_req', $sql_param);
            if($result == 0) except('데이터 저장에 오류가 있습니다.', true);
            if($result < 0) except('데이터 저장에 실패하였습니다.', true);
            $return['msg'] = 'success';
            $return['data'] = $result;
            $this->db2->trans_commit();
        } catch (Exception $e) {
            if(!empty($e->getCode())) $this->db2->trans_rollback();
            $return['msg'] = 'error';
            $return['data'] = $e->getMessage();
        }
        return $return;
    }
    // 답변 저장 by.jeromc 2018-10-31
    public function set_answer($sql_param){
        $return = array();
        try {
            $this->db2->trans_begin();
            $sql_param['rs_regDt']=YMD_HIS;
            $sql_param['rs_uptDt']=YMD_HIS;
            $sql_param['rs_state']='R';
            if($sql_param['rs_estmt_amt']) $sql_param['rs_estmt_amt']=fn_only_number($sql_param['rs_estmt_amt']);
            $result = $this->commondao->insert_table('tbl_estmtrsp', $sql_param);
            if($result == 0) except('데이터 저장에 오류가 있습니다.', true);
            if($result < 0) except('데이터 저장에 실패하였습니다.', true);

            $return['msg'] = 'success';
            $return['data'] = $result;
            $this->db2->trans_commit();
            //견적 포인트 적립 by.jeromc 2018-11-27
            $sql_tmp="select  count(*) as tcnt, sum(if(ob_office_idx==?,1,0)) as cnt from tbl_estmtrsp where em_estmtReq_idx=?";
            $return_tmp = $this->commondao->get_query($sql_tmp, array($sql_param['ob_office_idx'],$sql_param['em_estmtReq_idx']));
            if($return_tmp[0]['cnt']==1) {
                if($return_tmp[0]['tcnt']<=3) {
                    $point = 10;
                    fn_point_save($sql_param['ob_office_idx'], $point, '', 365, 110, '견적답변 적립 : ' . $result);
                }
            }
            //답변 랭킹 점수 + by.jeromc 2018-11-28
            fn_answer($sql_param['ob_office_idx']);
        } catch (Exception $e) {
            if(!empty($e->getCode())) $this->db2->trans_rollback();
            $return['msg'] = 'error';
            $return['data'] = $e->getMessage();
        }
        return $return;
    }

    //법률 상담 저장 2018-11-05
    public function set_law_req($sql_param){
        $return = array();
        try {
            $this->db2->trans_begin();
            $sql_param['tr_regDt']=YMD_HIS;
            $sql_param['tr_uptDt']=YMD_HIS;
            $sql_param['tr_state']='R';
            $sql_param['tr_show_gbn']='Y';
            if($sql_param['tr_tel'])$sql_param['tr_tel']=$this->openssl_mem->aes_encrypt(fn_only_number($sql_param['tr_tel']));
            if($sql_param['tr_pwd'])$sql_param['tr_pwd']=$this->openssl_mem->aes_encrypt($sql_param['tr_pwd']);
            $result = $this->commondao->insert_table('tbl_taxlawcounsel_req', $sql_param);
            if($result == 0) except('데이터 저장에 오류가 있습니다.', true);
            if($result < 0) except('데이터 저장에 실패하였습니다.', true);
            $return['msg'] = 'success';
            $return['data'] = $result;
            $this->db2->trans_commit();
        } catch (Exception $e) {
            if(!empty($e->getCode())) $this->db2->trans_rollback();
            $return['msg'] = 'error';
            $return['data'] = $e->getMessage();
        }
        return $return;
    }

    //법률 상담 저장 2018-11-05
    public function set_law_rsp($sql_param){
        $return = array();
        try {
            $this->db2->trans_begin();
            $sql_param['tp_regDt']=YMD_HIS;
            $sql_param['tp_uptDt']=YMD_HIS;
            $sql_param['tp_state']='R';
            //$sql_param['tp_show_gbn']='Y';
            $result = $this->commondao->insert_table('tbl_taxlawcounsel_rsp', $sql_param);
            if($result == 0) except('데이터 저장에 오류가 있습니다.', true);
            if($result < 0) except('데이터 저장에 실패하였습니다.', true);
            $return['msg'] = 'success';
            $return['data'] = $result;
            $this->db2->trans_commit();
        } catch (Exception $e) {
            if(!empty($e->getCode())) $this->db2->trans_rollback();
            $return['msg'] = 'error';
            $return['data'] = $e->getMessage();
        }
        return $return;
    }

    //법률 리스트 api 2018-11-05
    public function get_law_req($params){
        $return = array();
        $sql_param = array();
        if($params['type']=="list"){ // 리스트

            if($params['tr_tel']) {
                $sql_param['tr_tel'] =$this->openssl_mem->aes_encrypt(fn_only_number($params['tr_tel']));
                $sql_param['tr_show_gbn'] ='Y';
                $orderby="tr_taxcunselreq_idx desc";
                $result = $this->commondao->get_table('tbl_taxlawcounsel_req', $sql_param,$orderby);
                $list = $result;
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
        }else if($params['type']=="answer"){ // 답변 및 상세
            if($params['tr_taxcunselreq_idx']) {
                $sql_param_tmp=array();
                $sql_param_tmp['tr_taxcunselreq_idx']= $params['tr_taxcunselreq_idx'];
                $sql_param_tmp['tr_pwd'] =$this->openssl_mem->aes_encrypt($params['tr_pwd']);
                $sql_param_tmp['tr_show_gbn'] ='Y';
                $result_tmp = $this->commondao->get_table('tbl_taxlawcounsel_req', $sql_param_tmp);
                $list_tmp = $result_tmp[0];

                if (empty($list_tmp)) {
                    $return['msg'] = 'error';
                    $return['data'] = array();
                } else {
                    //답변을 가져온다.
                    $sql_param['tr_taxcunselreq_idx']= $list_tmp['tr_taxcunselreq_idx'];
                    $result = $this->commondao->get_table('tbl_taxlawcounsel_rsp', $sql_param);
                    $list = $result;
                    $return['data']['req']=$list_tmp;
                    if(empty($list)) {
                        $return['msg'] = 'error';
                        $return['data']['rsp'] = array();
                    } else {
                        $return['msg'] = 'success';
                        $return['data']['rsp'] = $list;
                    }
                }
            }else{
                $return['msg'] = 'error';
                $return['data'] = array();
            }
        }else{
            $return['msg'] = 'error';
            $return['data'] = array();
        }

        return $return['data'];
    }

    //1:1 문의 저장 2018-11-08
    public function set_ask_req($sql_param){
        $return = array();
        try {
            $this->db2->trans_begin();
            $sql_param['ar_regDt']=YMD_HIS;
            $sql_param['ar_uptDt']=YMD_HIS;
            $sql_param['ar_state']='R';
            if($sql_param['ar_tel'])$sql_param['ar_tel']=$this->openssl_mem->aes_encrypt(fn_only_number($sql_param['ar_tel']));
            if($sql_param['ar_pwd'])$sql_param['ar_pwd']=$this->openssl_mem->aes_encrypt($sql_param['ar_pwd']);
            $result = $this->commondao->insert_table('tbl_ask_req', $sql_param);
            if($result == 0) except('데이터 저장에 오류가 있습니다.', true);
            if($result < 0) except('데이터 저장에 실패하였습니다.', true);
            $return['msg'] = 'success';
            $return['data'] = $result;
            $this->db2->trans_commit();
        } catch (Exception $e) {
            if(!empty($e->getCode())) $this->db2->trans_rollback();
            $return['msg'] = 'error';
            $return['data'] = $e->getMessage();
        }
        return $return;
    }
    //1:1 문의 리스트 2018-11-08
    public function get_ask_req($params){
        $return = array();
        $sql_param = array();
        if($params['type']=="list"){ // 리스트

            if($params['ar_tel']) {
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
            }else{
                $return['msg'] = 'error';
                $return['data'] = array();
            }
        }else if($params['type']=="answer"){ // 답변 및 상세
            if($params['ar_ask_idx']) {
                $sql_param_tmp=array();
                $sql_param_tmp['ar_ask_idx']= $params['ar_ask_idx'];
                $sql_param_tmp['ar_pwd'] =$this->openssl_mem->aes_encrypt($params['ar_pwd']);
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

        return $return['data'];
    }

    //견적답변상태변경 by,jeromc 2018-11-14
    public function update_rs_state($params){
        $return = array();
        try {
            $this->db2->trans_begin();
            $sql_param['rs_uptDt']=YMD_HIS;
            $sql_param['rs_state']=$params['rs_state'];
            if(!empty($params['user_id'])) {
                $sql_param['rs_regId'] = $params['userid'];
                $sql_param['rs_uptId'] = $params['userid'];
            }
            $where['rs_estmtRsp_idx']=$params['rs_estmtRsp_idx'];

            $result = $this->commondao->update_table('tbl_estmtrsp', $sql_param, $where);
            if($result == 0) except('데이터 변경이 안되었습니다.', true);
            if($result < 0) except('데이터 저장에 실패하였습니다.', true);
            $return['msg'] = 'success';
            $return['data'] = $result;
            $this->db2->trans_commit();
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
            $sql_param['em_state']=$params['em_state'];
            if(!empty($params['user_id'])) {
                $sql_param['em_regId'] = $params['userid'];
                $sql_param['em_uptId'] = $params['userid'];
            }

            $where['em_estmtReq_idx']=$params['em_estmtReq_idx'];

            $result = $this->commondao->update_table('tbl_estmtreq_mast', $sql_param, $where);
            if($result == 0) except('데이터 변경이 안되었습니다.', true);
            if($result < 0) except('데이터 저장에 실패하였습니다.', true);
            $return['msg'] = 'success';
            $return['data'] = $result;
            $this->db2->trans_commit();
        } catch (Exception $e) {
            if(!empty($e->getCode())) $this->db2->trans_rollback();
            $return['msg'] = 'error';
            $return['data'] = $e->getMessage();
        }
        return $return;
    }

    // 고객 답변 확정 by.jeromc 2018-11-16
    public function confirm_answer($params){
        // 답변 정보
        $sql="select  a.*, b.ob_officeNm, b.ob_email,b.ob_tel, b.ob_state
              from tbl_estmtrsp as a 
              left join tbl_office_base as b on a.ob_office_idx=b.ob_office_idx and b.ob_state='Y'
              where a.rs_estmtRsp_idx=?
              ";

        $sql_param_sel['rs_estmtRsp_idx']=$params['rs_estmtRsp_idx'];
        $result =$this->commondao->get_query($sql, $sql_param_sel);
        $data=$result[0];
        if(!empty($data)) {

            if($data['rs_state']=="R") {
                $return = array();
                try {
                    $this->db2->trans_begin();
                    $sql_param['rs_uptDt'] = YMD_HIS;
                    $sql_param['rs_uptId'] = '';
                    $sql_param['rs_state'] = 'Y';

                    $where['rs_estmtRsp_idx'] = $params['rs_estmtRsp_idx'];

                    $result = $this->commondao->update_table('tbl_estmtrsp', $sql_param, $where);
                    if ($result == 0) except('데이터 변경이 안되었습니다.', true);
                    if ($result < 0) except('데이터 저장에 실패하였습니다.', true);
                    $return['msg'] = 'success';
                    $return['data'] = $data;
                    $return['tel'] = $this->openssl_mem->aes_decrypt($data['ob_tel']);
                    $return['email'] = $this->openssl_mem->aes_decrypt($data['ob_email']);
                    $this->db2->trans_commit();
                    //선택 포인트 적립 by.jeromc 2018-11-27
                    $point=100;
                    fn_point_save($data['ob_office_idx'],$point,'',365,120,'고객선택 적립 : '.$params['rs_estmtRsp_idx']);

                    //답변 선택 점수 + by.jeromc 2018-11-28
                    fn_choice($data['ob_office_idx']);
                } catch (Exception $e) {
                    if (!empty($e->getCode())) $this->db2->trans_rollback();
                    $return['msg'] = 'error';
                    $return['data'] = $e->getMessage();
                    $return['tel'] = "";
                    $return['email'] = "";
                }
            }else{
                $return['msg'] = 'other';
                $return['data'] = "이미 확정된 답변입니다.(".$data['rs_state'].")";
                $return['tel'] = $this->openssl_mem->aes_decrypt($data['ob_tel']);
                $return['email'] = $this->openssl_mem->aes_decrypt($data['ob_email']);
            }
        }else{
            $return['msg'] = 'error';
            $return['data'] = "답변 데이터 에러입니다. 확인 해 주세요.";
            $return['tel'] = "";
            $return['email'] = "";

        }
        return $return;
    }
    public function rank_office_list($search, $limit, $offset){
        $sql_param=array();
        $sql = "
          SELECT  @rownum := @rownum + 1 AS ranking, T.* FROM
                (
                SELECT
                    sido.sdg_sido_nm,sido.sdg_gu_nm, ob_office_idx,ob_officeNm,ob_bizNum,ob_wrkrNum,ob_email
                    ,ob_ceoNm,ob_tel,ob_logo,ob_addr,ob_addr_desc,ob_choice_rank,ob_answer_rank,ob_sado_rank,ob_latitud,ob_longtitud
                
                from  tbl_office_base 
                JOIN (SELECT @rownum := ".$offset.") r
                 left join tbl_sidogu sido
                   on tbl_office_base.ob_sido=sido.sdg_sido_no and tbl_office_base.ob_gu=sido.sdg_gu_no
                where ob_state in('Y','N','R')
        ";

        if($search['orderby']){
            $sql .= " order by ".$search['orderby']." ".$search['sort']." , ob_office_idx desc";
        }else {
            $sql .= " order by ob_sado_rank desc, ob_office_idx desc ";
        }
        if($limit>0) $sql .= " LIMIT ".$limit." OFFSET ".$offset;

        if(empty($search['orderby']))  $sql .= " ) AS T ORDER BY T.ob_sado_rank DESC";
        else   $sql .= " ) AS T ORDER BY T.".$search['orderby']." DESC";

        $result = $this->commondao->get_query($sql, $sql_param);
        foreach ($result as $k=>$v){
            $tmp="";
            $tmp_email="";
            if(!empty($v['ob_tel'])) $tmp=$this->openssl_mem->aes_decrypt($v['ob_tel']);
            if(!empty($v['ob_email'])) $tmp_email=$this->openssl_mem->aes_decrypt($v['ob_email']);
            $result[$k]['ob_tel']=$tmp;
            $result[$k]['ob_email']=$tmp_email;
        }

        return $result;

    }


    public function get_answer_data($search, $limit, $offset){
        //{"page":"1", " type ": "1", "ob_office_idx": "10", "sdate ": "2018-11-10", "edate ": "2018-11-17" }
        $sql_param['ob_office_idx']=$search['ob_office_idx'];

        if($search['type']==1){//전체
            $sql = "SELECT
                              a.*, b.rs_estmtRsp_idx,b.ob_office_idx,b.rs_estmt_amt,b.rs_estmt_memo,b.rs_state,b.rs_regDt,b.rs_uptDt
                        FROM tbl_estmtrsp as b left join tbl_estmtreq_mast as a on a.em_estmtReq_idx=b.em_estmtReq_idx
                        where b.ob_office_idx=?  ";


        }else{//완료건만
            $sql = "SELECT
                             a.*, b.rs_estmtRsp_idx,b.ob_office_idx,b.rs_estmt_amt,b.rs_estmt_memo,b.rs_state,b.rs_regDt,b.rs_uptDt
                        FROM tbl_estmtrsp as b left join tbl_estmtreq_mast as a on a.em_estmtReq_idx=b.em_estmtReq_idx
                        where b.ob_office_idx=?  and b.rs_state='Y'  ";
        }

        $sql.= " AND b.rs_regDt BETWEEN '".$search['sdate']." 00:00:00' and '".$search['edate']." 23:59:59'";
        $sql.=" order by a.em_estmtReq_idx desc ";
        if($limit>0) $sql .= " LIMIT ".$limit." OFFSET ".$offset;
        $reasult=$this->commondao->get_query($sql, $sql_param);
        foreach ($reasult as $k => $v){
            for ($i = 1; $i < 10; $i++) {
                $tmp = explode("!^!", $v['em_c' . $i]);
                $reasult[$k]['em_c' . $i]=$tmp[1];
                $reasult[$k]['em_t' . $i]=$tmp[0];
            }
        }
        return $reasult;
    }
}
