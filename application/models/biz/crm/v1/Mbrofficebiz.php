<?php
/**
 * @ description : Code biz
 * @ author : prog106 <prog106@haomun.com>
 */
class Mbrofficebiz extends CI_Model
{
    public function __construct()
    {
        parent::__construct();

        //$this->load->database();
        $this->db2 = $this->load->database('insertdb', TRUE);
        $this->load->model('dao/Commondao', 'commondao');

        date_default_timezone_set('Asia/Seoul');
    }

    //세무사무소 리스트
    public function get_mbroffice_list($param, $limit, $offset)
    {
        $return = array();
        $where = array();

        if($this->openssl_mem->aes_decrypt($this->session->userdata('user_grade')) <= 6){
            $where['ob_office_idx'] = $this->session->userdata('office_idx');
        }

        $sql = "
                SELECT ob.ob_office_idx, ob.ob_officeNm, ob.ob_bizNum, ob.ob_bltDt, ob.ob_wrkrNum, ob.ob_email, ob.ob_ceoNm, ob.ob_tel, ob.ob_logo, ob.ob_filePath
                       ,ob.ob_zip, ob.ob_addr, ob.ob_addr_desc, ob.ob_memo, ob.ob_latitud, ob.ob_longtitud, ob.ob_state, ob.ob_regDt, ob.ob_uptDt, ob.ob_regId, ob.ob_uptId
                       ,ifnull(sg.si_svcgdsNm,'-') si_svcgdsNm, sg.si_svcgds_amt, ifnull(ms.ms_mbrBeginDt,'-')ms_mbrBeginDt, ifnull(ms.ms_mbrEndDt,'-')ms_mbrEndDt
                FROM tp.tbl_office_base ob
                 left outer join  tp.tbl_mbrship ms
                   on ob.ob_office_idx = ms.ob_office_idx
                 left outer join tp.tbl_serivce_goods sg
                   on ms.si_svcgds_idx = sg.si_svcgds_idx
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
        //fn_log($param);

        foreach ($where as $k => $v) {
            if ($k == 'ob_addr') {
                if (!empty($v)) $sql .= " AND (ob_addr LIKE '%" . $v . "%' OR ob_addr_desc LIKE '%" . $v . "%' )";
            } else if ($k == 'ob_officeNm') {
                if (!empty($v)) $sql .= " AND " . $k . " like '%" . $v . "%'";
            } else if ($k == 'ob_office_idx') {
                if (!empty($v)) $sql .= " AND ob.ob_office_idx = '" . $v . "'";
            } else {
                if (!empty($v)) $sql .= " AND " . $k . " = '" . $v . "'";
            }
        }
        $sql .= " ORDER BY ob_office_idx DESC";
        $sql .= " LIMIT " . $limit . " OFFSET " . $offset;

        //fn_log($sql);
        $result = $this->commondao->get_query($sql, $where);
        $return['msg'] = 'success';
        $return['data'] = $result;
        return $return;

    }

    //세무사무소 리스트 카운트
    public function get_mbrofficeList_count($param)
    {
        $return = array();
        $where = array();

        $sql0 = "
                SELECT count(*) as mbroffice_ttl_count
                FROM tp.tbl_office_base
                WHERE 1=1    
                ";

        $result0 = $this->commondao->get_query($sql0, '');
        $result_ttl_v = $result0[0];


        $sql = "
                SELECT count(*) as mbroffice_count
                FROM tp.tbl_office_base
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
                if (!empty($v)) $sql .= " AND (ob_addr LIKE '%" . $v . "%' OR ob_addr_desc LIKE '%" . $v . "%' )";
            } else if ($k == 'ob_officeNm') {
                if (!empty($v)) $sql .= " AND " . $k . " like '%" . $v . "%'";
            } else {
                if (!empty($v)) $sql .= " AND " . $k . " = '" . $v . "'";
            }
        }

        //print_r($sql);
        //fn_log($where);

        $result = $this->commondao->get_query($sql, $where);
        $result_v = $result[0];

        if (empty($result_v)) {
            $return['msg'] = 'error';
            $return['cnt'] = array();
            $return['ttl'] = array();
        } else {
            $return['msg'] = 'success';
            $return['cnt'] = $result_v;
            $return['ttl'] = $result_ttl_v;
        }

        return $return;
    }

    //세무사무소 등록
    public function set_office_reg($param)
    {
        $return = array();
        $sql_param = array();
        $sql_param2 = array();

        try {
            $this->db2->trans_begin();

            $sql_param['ob_officeNm'] = $param['ob_officeNm'];
            //$sql_param['ob_bizNum'] = $param['ob_bizNum'];
            $sql_param['ob_bltDt'] = $param['ob_bltDt'];
            $sql_param['ob_wrkrNum'] = $param['ob_wrkrNum'];
            //$sql_param['ob_email'] = $param['ob_email'];
            $sql_param['ob_email'] = $this->openssl_mem->aes_encrypt($param['ob_email']);
            $sql_param['ob_ceoNm'] = $param['ob_ceoNm'];
            $sql_param['ob_tel'] = $this->openssl_mem->aes_encrypt(fn_only_number($param['ob_tel']));
            $sql_param['ob_bizNum'] = $param['ob_bizNum'];
            //$sql_param['ob_logo_bak'] = $param['ob_logo_bak'];
            $sql_param['ob_zip'] = $param['ob_zip'];
            $sql_param['ob_addr'] = $param['ob_addr'];
            $sql_param['ob_addr_desc'] = $param['ob_addr_desc'];
            $sql_param['ob_sido'] = $param['sdg_sido_no'];
            $sql_param['ob_gu'] = $param['sdg_gu_no'];
            $sql_param['ob_memo'] = $param['ob_memo'];
            $sql_param['ob_latitud'] = $param['ob_latitud'];
            $sql_param['ob_longtitud'] = $param['ob_longtitud'];
            $sql_param['ob_state'] = $param['ob_state'];
            $sql_param['ob_logo'] = $param['file_name'];
            $sql_param['ob_img_width'] = $param['image_width'];
            $sql_param['ob_img_height'] = $param['image_height'];

            $sql_param['ob_filePath'] = $param['file_path'];
            $sql_param['ob_regDt'] = YMD_HIS;
            $sql_param['ob_regId'] = $this->session->userdata('user_id');

            $insert_id = $this->commondao->insert_table('tbl_office_base', $sql_param);
            fn_log('insert_id-'.$insert_id);
            $this->_save_admin($insert_id, "세무사무소 신규저장 - " . json_encode($sql_param,JSON_UNESCAPED_UNICODE));

            $sql_param2['ac_id'] = $param['ac_id'];
            $sql_param2['ac_nm'] = $param['ac_nm'];
            $sql_param2['ac_pwd'] = password_hash($param['ac_pwd'], PASSWORD_DEFAULT);
            $sql_param2['ob_office_idx'] = $insert_id;
            $sql_param2['ac_state'] = 'Y';
            $sql_param2['ac_regDt'] = YMD_HIS;
            $sql_param2['ac_regId'] = $this->session->userdata('user_id');

            $insert_id2 = $this->commondao->insert_table('tbl_office_accnt', $sql_param2);

            if ($insert_id == 0 || $insert_id < 0) except('데이터 저장이 실패하였습니다.', true);
            if ($insert_id2 == 0 || $insert_id2 < 0) except('데이터 저장이 실패하였습니다.', true);

            $return['msg'] = 'success';
            //$return['data'] = $insert_id . ',' . $insert_id2;
            $return['data'] = $insert_id;


            $this->db2->trans_commit();
            $this->_save_admin($insert_id2, "세무사무소 계정저장 - " . json_encode($sql_param2,JSON_UNESCAPED_UNICODE));

        }
        catch (Exception $e) {
            if (!empty($e->getCode())) $this->db2->trans_rollback();
            $return['msg'] = 'error';
            $return['data'] = $e->getMessage();
        }
        //fn_log($return);
        return $return;

    }



    //세무사무소 수정

    public function set_office_edt($param)
    {
        $return = array();
        $sql_param = array();
        $sql_param2 = array();

        try {
            $this->db2->trans_begin();

            if($param['ob_officeNm']){ $sql_param['ob_officeNm'] = $param['ob_officeNm']; }
            if($param['ob_bltDt']){ $sql_param['ob_bltDt'] = $param['ob_bltDt']; }
            if($param['ob_wrkrNum']){ $sql_param['ob_wrkrNum'] = $param['ob_wrkrNum']; }
            if($param['ob_email']){ $sql_param['ob_email'] = $this->openssl_mem->aes_encrypt($param['ob_email']); }
            if($param['ob_ceoNm']){ $sql_param['ob_ceoNm'] = $param['ob_ceoNm']; }
            if($param['ob_tel']){ $sql_param['ob_tel'] = $this->openssl_mem->aes_encrypt(fn_only_number($param['ob_tel'])); }
            if($param['ob_bizNum']){ $sql_param['ob_bizNum'] = $param['ob_bizNum']; }
            if($param['ob_zip']){ $sql_param['ob_zip'] = $param['ob_zip']; }
            if($param['ob_addr']){ $sql_param['ob_addr'] = $param['ob_addr']; }
            if($param['ob_addr_desc']){ $sql_param['ob_addr_desc'] = $param['ob_addr_desc']; }
            if($param['sdg_sido_no']){ $sql_param['ob_sido'] = $param['sdg_sido_no']; }
            if($param['sdg_gu_no']){ $sql_param['ob_gu'] = $param['sdg_gu_no']; }
            if($param['ob_memo']){ $sql_param['ob_memo'] = $param['ob_memo']; }
            if($param['ob_latitud']){ $sql_param['ob_latitud'] = $param['ob_latitud']; }
            if($param['ob_longtitud']){ $sql_param['ob_longtitud'] = $param['ob_longtitud']; }
            if($param['ob_state']){ $sql_param['ob_state'] = $param['ob_state']; }
            if($param['file_name']){ $sql_param['ob_logo'] = $param['file_name']; }
            if($param['image_width']){ $sql_param['ob_img_width'] = $param['image_width']; }
            if($param['image_height']){ $sql_param['ob_img_height'] = $param['image_height']; }
            if($param['file_path']){ $sql_param['ob_filePath'] = $param['file_path']; }
            $sql_param['ob_regDt'] = YMD_HIS;
            $sql_param['ob_regId'] = $this->session->userdata('user_id');
            //fn_log('param - '.$param);

            $where['ob_office_idx'] = $param['ob_office_idx'];

            $tableNm = 'tbl_office_base';
            $result = $this->commondao->update_table($tableNm, $sql_param, $where);

            if ($result == 0 || $result < 0) except('데이터 저장이 실패하였습니다.', true);
            $this->_save_admin($param['ob_office_idx'], "세무사무소 수정 - " . json_encode($sql_param,JSON_UNESCAPED_UNICODE));


            //세무사무소 계정저장 INS OR UPT
            $sql1 = "
                    select count(*) office_accnt_cnt from tp.tbl_office_accnt 
                    where 1=1 
            ";
            if($param['ob_office_idx']) {
                $sql_param1['ob_office_idx'] = $param['ob_office_idx'];
                $sql1 .= " and ob_office_idx = ? ";
            }

            $result1 = $this->commondao->get_query($sql1, $sql_param1);
            $rtn1 = $result1[0]['office_accnt_cnt'];
            //fn_log('rtn1 - '.$rtn1);
            //print_r($result1);




            if($param['ac_id']){ $sql_param2['ac_id'] = $param['ac_id']; }
            if($param['ac_nm']){ $sql_param2['ac_nm'] = $param['ac_nm']; }
            if($param['ac_pwd']){ $sql_param2['ac_pwd'] = password_hash($param['ac_pwd'], PASSWORD_DEFAULT); }
            $sql_param2['ac_state'] = 'Y';
            $sql_param2['ac_regDt'] = YMD_HIS;
            $sql_param2['ac_regId'] = $this->session->userdata('user_id');
            $where2['ob_office_idx'] = $param['ob_office_idx'];



            if($param['ob_office_idx'] != '1'){

                $tableNm2 = 'tbl_office_accnt';
                if($rtn1 > 0){
                    //$proc_gbn1 = "UPT";
                    $result2 = $this->commondao->update_table($tableNm2, $sql_param2, $where2);
                    $this->_save_admin($param['ob_office_idx'], "세무사무소계정 수정 - " . json_encode($sql_param2,JSON_UNESCAPED_UNICODE));
                }else{
                    //$proc_gbn1 = "INS";
                    $sql_param2['ob_office_idx'] = $param['ob_office_idx'];
                    $result2 = $this->commondao->insert_table($tableNm2, $sql_param2);
                    $this->_save_admin($param['ob_office_idx'], "세무사무소계정 저장 - " . json_encode($sql_param2,JSON_UNESCAPED_UNICODE));
                }

                if ($result2 == 0 || $result2 < 0) except('데이터 저장이 실패하였습니다.', true);
            }

            $return['msg'] = 'TRUE';
            //$return['data'] = $result . ',' . $result2;
            $return['data'] = $result;


            $this->db2->trans_commit();
        }
        catch (Exception $e) {
            if (!empty($e->getCode())) $this->db2->trans_rollback();
            $return['msg'] = 'FALSE';
            $return['data'] = $e->getMessage();
        }
        //fn_log($return);
        return $return;

    }


    //세무사무소 아이디 중복 체크
    public function set_id_dup_chk($params)
    {
        $return = array();
        //fn_log($params);
        //fn_log('----------');

        /*$sql = "
                SELECT count(*) as idDup_count
                FROM tp.tbl_office_base ob
                  inner join tp.tbl_office_accnt oa
                     on ob.ob_office_idx = oa.ob_office_idx
                WHERE 1=1    
                ";*/

        $sql = "
                SELECT count(*) as idDup_count
                FROM tp.tbl_office_accnt 
                WHERE 1=1    
                ";

        if ($params['ac_id']) {
            $sql .= " and  ac_id = ?";
            $sql_param['ac_id'] = $params['ac_id'];
        }
        //fn_log($sql);

        $result = $this->commondao->get_query($sql, $sql_param);
        $result_v = $result[0]['idDup_count'];
        //fn_log($result);
        //fn_log($result_v);

        if ($result_v > 0) {
            $return['msg'] = 'FALSE';
            $return['data'] = '';
        } else {
            $return['msg'] = 'TRUE';
            $return['data'] = $result_v;
        }

        return $return;
    }

    //서비스 상품 리스트
    public function get_svcgds_list()
    {
        $return = array();
        $where = array();

        $sql = "
                SELECT si_svcgds_idx, si_svcgdsNm, si_svcgds_amt, si_svc_period, si_usegbn
                FROM tp.tbl_serivce_goods
                WHERE 1=1 
                  and  si_usegbn = 'Y'    
                ORDER BY si_svc_period asc 
                ";

        //fn_log($sql);
        $result = $this->commondao->get_query($sql, $where);
        $return['msg'] = 'success';
        $return['data'] = $result;
        //fn_log($result);

        return $result;
    }

    //세무사무소 맴버쉽서비스 정보
    public function get_mbrsvc_inf($params)
    {
        $return = array();

        $sql = "
                SELECT si_svcgds_idx, si_svcgdsNm, si_svcgds_amt, si_svc_period, si_usegbn
                FROM tp.tbl_serivce_goods
                where si_usegbn = 'Y'
        ";

        if ($params['si_svcgds_idx']) {
            $sql .= " and  si_svcgds_idx = ?";
            $sql_param['si_svcgds_idx'] = $params['si_svcgds_idx'];
        }
        //fn_log($sql);

        $result = $this->commondao->get_query($sql, $sql_param);
        $si_svcgds_idx = $result[0]['si_svcgds_idx'];
        $si_svcgdsNm = $result[0]['si_svcgdsNm'];
        $si_svcgds_amt = $result[0]['si_svcgds_amt'];
        $si_svc_period = $result[0]['si_svc_period'];


        if (!empty($result)) {
            $return['msg'] = 'TRUE';
            $return['si_svcgds_idx'] = $si_svcgds_idx;
            $return['si_svcgdsNm'] = $si_svcgdsNm;
            $return['si_svcgds_amt'] = $si_svcgds_amt;
            $return['si_svc_period'] = $si_svc_period;
        } else {
            $return['msg'] = 'FALSE';
            $return['si_svcgds_idx'] = '';
            $return['si_svcgdsNm'] = '';
            $return['si_svcgds_amt'] = '';
            $return['si_svc_period'] = '';
        }

        return $return;
    }


    //세무사무소 맴버쉽서비스 정보 등록
    public function set_regMbrsvc($params)
    {
        $return = array();
        $sql_param = array();
        $where = array();

        try {
            $this->db2->trans_begin();

            $sql_param['ob_office_idx'] = trim($params['ob_office_idx']);
            $sql_param['ms_mbr_idx'] = trim($params['ms_mbr_idx']);
            $sql_param['si_svcgds_idx'] = trim($params['si_svcgds_idx']);
            $sql_param['ms_joinDt'] = trim($params['ms_joinDt']);
            $sql_param['ms_mbrgbn'] = trim($params['ms_mbrgbn']);
            $sql_param['ms_ttlAmt'] = trim($params['ms_ttlAmt']);
            $sql_param['ms_ttlperiod'] = trim($params['ms_ttlperiod']);
            $sql_param['ms_freeBeginDt'] = trim($params['ms_freeBeginDt']);
            $sql_param['ms_freeEndDt'] = trim($params['ms_freeEndDt']);
            $sql_param['ms_mbrBeginDt'] = trim($params['ms_mbrBeginDt']);
            $sql_param['ms_mbrEndDt'] = trim($params['ms_mbrEndDt']);
            $sql_param['ms_regDt'] = YMD_HIS;
            $sql_param['ms_regId'] = $this->session->userdata('user_id');

            if ($sql_param['ob_office_idx']) {
                if ($sql_param['ms_mbr_idx']) {
                    $proc_gbn = 'upt';
                } else {
                    $proc_gbn = 'ins';
                }
            } else {
                $proc_gbn = '';
            }

            $tblNm = 'tbl_mbrship';

            if ($proc_gbn == 'upt') {
                if ($params['ob_office_idx']) {
                    $where['ob_office_idx'] = $params['ob_office_idx'];
                }
                if ($params['ms_mbr_idx']) {
                    $where['ms_mbr_idx'] = $params['ms_mbr_idx'];
                }
                $result = $this->commondao->update_table($tblNm, $sql_param, $where);

            } elseif ($proc_gbn == 'ins') {
                $result = $this->commondao->insert_table($tblNm, $sql_param);
            }

            if ($result == 0) except('데이터 처리에 오류가 있습니다...', true);
            if ($result < 0) except('데이터 처리에 실패하였습니다.', true);


            $return['msg'] = 'TRUE';
            $return['data'] = $result;

            $this->db2->trans_commit();

            if ($proc_gbn == 'upt') {
                $this->_save_admin($params['ob_office_idx'], "맴버쉽정보 수정 - " . json_encode($sql_param,JSON_UNESCAPED_UNICODE));
            } elseif ($proc_gbn == 'ins') {
                $this->_save_admin($result, "맴버쉽정보 저장 - " . json_encode($sql_param,JSON_UNESCAPED_UNICODE));
            }
        }
        catch (Exception $e) {
            if (!empty($e->getCode())) $this->db2->trans_rollback();
            $return['msg'] = 'FALSE';
            $return['data'] = $e->getMessage();
        }
        return $return;

    }

    
    
    // 세무사무소 주요약력 등록
    public function set_regOfficeProfile($params)
    {
        $return = array();
        $sql_param = array();

        try {
            $this->db2->trans_begin();

            $sql_param['ob_office_idx'] = trim($params['ob_office_idx']);
            $sql_param['pf_date'] = trim($params['pf_date']);
            $sql_param['pf_desc'] = trim($params['pf_desc']);
            $sql_param['pf_regDt'] = YMD_HIS;
            $sql_param['pf_regId'] = $this->session->userdata('user_id');

            $tblNm = 'tbl_office_profile';
            $result = $this->commondao->insert_table($tblNm, $sql_param);

            if ($result == 0) except('데이터 처리에 오류가 있습니다...', true);
            if ($result < 0) except('데이터 처리에 실패하였습니다.', true);

            $return['msg'] = 'TRUE';
            $return['data'] = $result;

            $this->db2->trans_commit();
            $this->_save_admin($params['ob_office_idx'], "세무사무소 주요약력 저장 - " . json_encode($sql_param,JSON_UNESCAPED_UNICODE));
        }
        catch (Exception $e) {
            if (!empty($e->getCode())) $this->db2->trans_rollback();
            $return['msg'] = 'FALSE';
            $return['data'] = $e->getMessage();
        }

        return $return;
    }


    // 세무사무소 주요약력 리스트
    public function get_office_profile_list($params)
    {
        $return = array();

        $sql = "
                SELECT pf_profile_idx, ob_office_idx, pf_date, pf_desc
                FROM tp.tbl_office_profile
                WHERE 1=1    
                ";

        if ($params['ob_office_idx']) {
            $sql .= " and  ob_office_idx = ?";
            $sql_param['ob_office_idx'] = $params['ob_office_idx'];
        }
        //fn_log($sql);

        $result = $this->commondao->get_query($sql, $sql_param);
        $list = $result;

        if(empty($list)) {
            $return['msg'] = 'FALSE';
            $return['list'] = array();
        } else {
            $return['msg'] = 'TRUE';
            $return['list'] = $list;
        }

        return $return;
    }


    // 세무사무소 주요약력 수정 삭제
    public function set_procOfficeProfile($params){
        $return = array();
        $sql_param = array();
        $where = array();

        try{
            $this->db2->trans_begin();

            if($params['procgbn'] == 'EDT')
            {
                if($params['curr_pf_date']) {
                    $sql_param['pf_date'] = $params['curr_pf_date'];
                }
                if($params['curr_pf_desc']) {
                    $sql_param['pf_desc'] = $params['curr_pf_desc'];
                }
                $sql_param['pf_uptDt'] = YMD_HIS;
                $sql_param['pf_uptId'] = $this->session->userdata('user_id');

                if($params['ob_office_idx']) {
                    $where['ob_office_idx'] = $params['ob_office_idx'];
                }
                if($params['pf_profile_idx']) {
                    $where['pf_profile_idx'] = $params['pf_profile_idx'];
                }

                $tblNm = 'tbl_office_profile';
                $result = $this->commondao->update_table($tblNm, $sql_param, $where);
            }
            else{  //DEL
                $sql = "
                        DELETE FROM tp.tbl_office_profile
                        WHERE 1=1    
                ";

                if($params['ob_office_idx']) {
                    $where['ob_office_idx'] = $params['ob_office_idx'];
                }
                if($params['pf_profile_idx']) {
                    $where['pf_profile_idx'] = $params['pf_profile_idx'];
                }
                $tableNm = 'tbl_office_profile';
                $result = $this->commondao->delete_table($tableNm, $where);

            }
            //fn_log('procgbn - '.$params['procgbn']);
            //fn_log('$result - '.$result);


            if ($result == 0) except('데이터 처리에 오류가 있습니다...', true);
            if ($result < 0) except('데이터 처리에 실패하였습니다.', true);

            $return['msg'] = 'TRUE';
            $return['data'] = $result;

            $this->db2->trans_commit();


            if($params['procgbn'] == 'EDT'){
                $this->_save_admin($params['ob_office_idx'].','.$params['pf_profile_idx'], "세무사무소 주요약력 수정 - " . json_encode($sql_param,JSON_UNESCAPED_UNICODE));
            } else {
                $this->_save_admin($params['ob_office_idx'].','.$params['pf_profile_idx'], "세무사무소 주요약력 삭제 - " . '');
            }


        }
        catch (Exception $e) {
            if (!empty($e->getCode())) $this->db2->trans_rollback();
            $return['msg'] = 'FALSE';
            $return['data'] = $e->getMessage();
        }

        return $return;
    }


    //세무사무소 세무사직원 등록
    public function set_reg_office_taxaccnt($params)
    {
        $return = array();
        $sql_param = array();

        try{
            $this->db2->trans_begin();

            $sql_param['ob_office_idx'] = trim($params['ob_office_idx']);
            $sql_param['at_taxAccntNm'] = trim($params['at_taxAccntNm']);
            $sql_param['at_eduLvl'] = trim($params['at_eduLvl']);
            $sql_param['at_jobfield'] = trim($params['at_jobfield']);
            $sql_param['at_Profile'] = trim($params['at_Profile']);
            $sql_param['at_wrkgbn'] = 'Y';
            $sql_param['at_regDt'] = YMD_HIS;
            $sql_param['at_regId'] = $this->session->userdata('user_id');

            $tblNm = 'tbl_office_taxaccnt';
            $result = $this->commondao->insert_table($tblNm, $sql_param);

            if ($result == 0) except('데이터 처리에 오류가 있습니다.', true);
            if ($result < 0) except('데이터 처리에 실패하였습니다.', true);

            $return['msg'] = 'TRUE';
            $return['data'] = $result;

            $this->db2->trans_commit();

            $this->_save_admin($result, "세무사무소 세무사직원 저장 - " . json_encode($sql_param,JSON_UNESCAPED_UNICODE));

        }
        catch (Exception $e) {
            if (!empty($e->getCode())) $this->db2->trans_rollback();
            $return['msg'] = 'FALSE';
            $return['data'] = $e->getMessage();
        }

        return $return;
    }


    // 세무사무소 세무사직원 리스트
    public function get_office_taxAccnt_list($params)
    {
        $return = array();

        $sql = "
                SELECT at_taxAccnt_idx, ob_office_idx, at_taxAccntNm, at_eduLvl, at_jobfield, at_Profile, at_wrkgbn, at_regDt, at_uptDt, at_regId, at_uptId
                FROM tp.tbl_office_taxaccnt
                WHERE 1=1    
                  and  at_wrkgbn = 'Y'
                ";

        if ($params['ob_office_idx']) {
            $sql .= " and  ob_office_idx = ?";
            $sql_param['ob_office_idx'] = $params['ob_office_idx'];
        }
        //fn_log($sql);

        $result = $this->commondao->get_query($sql, $sql_param);
        $list = $result;

        if(empty($list)) {
            $return['msg'] = 'FALSE';
            $return['list'] = array();
        } else {
            $return['msg'] = 'TRUE';
            $return['list'] = $list;
        }

        return $return;
    }


    // 세무사무소 세무사직원 수정 삭제
    public function set_office_taxAccnt_proc($params)
    {
        $return = array();
        $sql_param = array();
        $where = array();

        try{
            $this->db2->trans_begin();

            if($params['procgbn'] == 'EDT')
            {
                if($params['at_taxAccntNm']) {
                    $sql_param['at_taxAccntNm'] = $params['at_taxAccntNm'];
                }
                if($params['at_eduLvl']) {
                    $sql_param['at_eduLvl'] = $params['at_eduLvl'];
                }
                if($params['at_jobfield']) {
                    $sql_param['at_jobfield'] = $params['at_jobfield'];
                }
                if($params['at_Profile']) {
                    $sql_param['at_Profile'] = $params['at_Profile'];
                }
                $sql_param['at_uptDt'] = YMD_HIS;
                $sql_param['at_uptId'] = $this->session->userdata('user_id');

                if($params['ob_office_idx']) {
                    $where['ob_office_idx'] = $params['ob_office_idx'];
                }
                if($params['at_taxAccnt_idx']) {
                    $where['at_taxAccnt_idx'] = $params['at_taxAccnt_idx'];
                }

                $tblNm = 'tbl_office_taxaccnt';
                $result = $this->commondao->update_table($tblNm, $sql_param, $where);
            }
            else{  //DEL
                $sql = "
                        DELETE FROM tp.tbl_office_taxaccnt
                        WHERE 1=1    
                ";

                if($params['ob_office_idx']) {
                    $where['ob_office_idx'] = $params['ob_office_idx'];
                }
                if($params['at_taxAccnt_idx']) {
                    $where['at_taxAccnt_idx'] = $params['at_taxAccnt_idx'];
                }
                $tableNm = 'tbl_office_taxaccnt';
                $result = $this->commondao->delete_table($tableNm, $where);

            }
            //fn_log('procgbn - '.$params['procgbn']);
            //fn_log('$result - '.$result);


            if ($result == 0) except('데이터 처리에 오류가 있습니다...', true);
            if ($result < 0) except('데이터 처리에 실패하였습니다.', true);

            $return['msg'] = 'TRUE';
            $return['data'] = $result;

            $this->db2->trans_commit();

            if($params['procgbn'] == 'EDT'){
                $this->_save_admin($params['ob_office_idx'].','.$params['at_taxAccnt_idx'], "세무사무소 세무사직원 수정 - " . json_encode($sql_param,JSON_UNESCAPED_UNICODE));
            } else {
                $this->_save_admin($params['ob_office_idx'].','.$params['at_taxAccnt_idx'], "세무사무소 세무사직원 삭제 - " . '');
            }

        }
        catch (Exception $e) {
            if (!empty($e->getCode())) $this->db2->trans_rollback();
            $return['msg'] = 'FALSE';
            $return['data'] = $e->getMessage();
        }

        return $return;
    }




    // 세무사무소 주요약력 등록
    public function set_reg_office_client($params)
    {
        $return = array();
        $sql_param = array();

        try{
            $this->db2->trans_begin();

            $sql_param['ob_office_idx'] = trim($params['ob_office_idx']);
            $sql_param['mc_clientNm'] = trim($params['mc_clientNm']);
            $sql_param['mc_fieldgbn'] = trim($params['mc_fieldgbn']);
            $sql_param['mc_wrkdesc'] = trim($params['mc_wrkdesc']);
            $sql_param['mc_regDt'] = YMD_HIS;
            $sql_param['mc_regId'] = $this->session->userdata('user_id');

            $tblNm = 'tbl_office_client';
            $result = $this->commondao->insert_table($tblNm, $sql_param);

            if ($result == 0) except('데이터 처리에 오류가 있습니다.', true);
            if ($result < 0) except('데이터 처리에 실패하였습니다.', true);

            $return['msg'] = 'TRUE';
            $return['data'] = $result;

            $this->db2->trans_commit();

            $this->_save_admin($result, "세무사무소 주요약력 저장 - " . json_encode($sql_param,JSON_UNESCAPED_UNICODE));

        }
        catch (Exception $e) {
            if (!empty($e->getCode())) $this->db2->trans_rollback();
            $return['msg'] = 'FALSE';
            $return['data'] = $e->getMessage();
        }

        return $return;
    }



    // 세무사무소 주요고객 리스트
    public function get_office_client_list($params)
    {
        $return = array();

        $sql = "
                SELECT mc_client_idx, ob_office_idx, mc_clientNm, mc_fieldgbn, mc_wrkdesc, mc_regDt, mc_uptDt, mc_regId, mc_uptId
                FROM tp.tbl_office_client
                WHERE 1=1    
                ";

        if ($params['ob_office_idx']) {
            $sql .= " and  ob_office_idx = ?";
            $sql_param['ob_office_idx'] = $params['ob_office_idx'];
        }
        //fn_log($sql);

        $result = $this->commondao->get_query($sql, $sql_param);
        $list = $result;

        if(empty($list)) {
            $return['msg'] = 'FALSE';
            $return['list'] = array();
        } else {
            $return['msg'] = 'TRUE';
            $return['list'] = $list;
        }

        return $return;
    }



    // 세무사무소 주요고객 수정 삭제
    public function set_office_client_proc($params)
    {
        $return = array();
        $sql_param = array();
        $where = array();

        try{
            $this->db2->trans_begin();

            if($params['procgbn'] == 'EDT')
            {
                if($params['mc_clientNm']) {
                    $sql_param['mc_clientNm'] = $params['mc_clientNm'];
                }
                if($params['mc_fieldgbn']) {
                    $sql_param['mc_fieldgbn'] = $params['mc_fieldgbn'];
                }
                if($params['mc_wrkdesc']) {
                    $sql_param['mc_wrkdesc'] = $params['mc_wrkdesc'];
                }
                $sql_param['mc_uptDt'] = YMD_HIS;
                $sql_param['mc_uptId'] = $this->session->userdata('user_id');

                if($params['ob_office_idx']) {
                    $where['ob_office_idx'] = $params['ob_office_idx'];
                }
                if($params['mc_client_idx']) {
                    $where['mc_client_idx'] = $params['mc_client_idx'];
                }

                $tblNm = 'tbl_office_client';
                $result = $this->commondao->update_table($tblNm, $sql_param, $where);
            }
            else{  //DEL
                $sql = "
                        DELETE FROM tp.tbl_office_taxaccnt
                        WHERE 1=1    
                ";

                if($params['ob_office_idx']) {
                    $where['ob_office_idx'] = $params['ob_office_idx'];
                }
                if($params['mc_client_idx']) {
                    $where['mc_client_idx'] = $params['mc_client_idx'];
                }
                $tableNm = 'tbl_office_client';
                $result = $this->commondao->delete_table($tableNm, $where);

            }
            //fn_log('procgbn - '.$params['procgbn']);
            //fn_log('$result - '.$result);


            if ($result == 0) except('데이터 처리에 오류가 있습니다...', true);
            if ($result < 0) except('데이터 처리에 실패하였습니다.', true);

            $return['msg'] = 'TRUE';
            $return['data'] = $result;

            $this->db2->trans_commit();

            if($params['procgbn'] == 'EDT'){
                $this->_save_admin($params['ob_office_idx'].','.$params['mc_client_idx'], "세무사무소 주요고객 수정 - " . json_encode($sql_param,JSON_UNESCAPED_UNICODE));
            } else {
                $this->_save_admin($params['ob_office_idx'].','.$params['mc_client_idx'], "세무사무소 주요고객 삭제 - " . '');
            }
        }
        catch (Exception $e) {
            if (!empty($e->getCode())) $this->db2->trans_rollback();
            $return['msg'] = 'FALSE';
            $return['data'] = $e->getMessage();
        }

        return $return;
    }




    // 세무사무소 전문분야 등록
    public function set_reg_office_wrkfield($params)
    {
        $return = array();
        $sql_param = array();

        try{
            $this->db2->trans_begin();

            $sql_param['ob_office_idx'] = trim($params['ob_office_idx']);
            $sql_param['mf_wrkfieldNm'] = trim($params['mf_wrkfieldNm']);
            $sql_param['mf_regDt'] = YMD_HIS;
            $sql_param['mf_regId'] = $this->session->userdata('user_id');

            $tblNm = 'tbl_office_wrkfield';
            $result = $this->commondao->insert_table($tblNm, $sql_param);

            if ($result == 0) except('데이터 처리에 오류가 있습니다.', true);
            if ($result < 0) except('데이터 처리에 실패하였습니다.', true);

            $return['msg'] = 'TRUE';
            $return['data'] = $result;

            $this->db2->trans_commit();

            $this->_save_admin($result, "세무사무소 전문분야 저장 - " . json_encode($sql_param,JSON_UNESCAPED_UNICODE));
        }
        catch (Exception $e) {
            if (!empty($e->getCode())) $this->db2->trans_rollback();
            $return['msg'] = 'FALSE';
            $return['data'] = $e->getMessage();
        }

        return $return;
    }



    // 세무사무소 전문분야 리스트
    public function get_office_wrkfield_list($params)
    {
        $return = array();

        $sql = "
                SELECT mf_wrkfield_idx, ob_office_idx, mf_wrkfieldNm, mf_regDt, mf_uptDt, mf_regId, mf_uptId
                FROM tp.tbl_office_wrkfield
                WHERE 1=1    
                ";

        if ($params['ob_office_idx']) {
            $sql .= " and  ob_office_idx = ?";
            $sql_param['ob_office_idx'] = $params['ob_office_idx'];
        }
        //fn_log($sql);

        $result = $this->commondao->get_query($sql, $sql_param);
        $list = $result;

        if(empty($list)) {
            $return['msg'] = 'FALSE';
            $return['list'] = array();
        } else {
            $return['msg'] = 'TRUE';
            $return['list'] = $list;
        }

        return $return;
    }



    // 세무사무소 전문분야 수정삭제
    public function set_office_wrkfield_proc($params)
    {
        $return = array();
        $sql_param = array();
        $where = array();

        try{
            $this->db2->trans_begin();

            if($params['procgbn'] == 'EDT')
            {
                if($params['mf_wrkfieldNm']) {
                    $sql_param['mf_wrkfieldNm'] = $params['mf_wrkfieldNm'];
                }
                $sql_param['mf_uptDt'] = YMD_HIS;
                $sql_param['mf_uptId'] = $this->session->userdata('user_id');

                if($params['ob_office_idx']) {
                    $where['ob_office_idx'] = $params['ob_office_idx'];
                }
                if($params['mf_wrkfield_idx']) {
                    $where['mf_wrkfield_idx'] = $params['mf_wrkfield_idx'];
                }

                $tblNm = 'tbl_office_wrkfield';
                $result = $this->commondao->update_table($tblNm, $sql_param, $where);
            }
            else{  //DEL
                $sql = "
                        DELETE FROM tp.tbl_office_wrkfield
                        WHERE 1=1    
                ";

                if($params['ob_office_idx']) {
                    $where['ob_office_idx'] = $params['ob_office_idx'];
                }
                if($params['mf_wrkfield_idx']) {
                    $where['mf_wrkfield_idx'] = $params['mf_wrkfield_idx'];
                }
                $tableNm = 'tbl_office_wrkfield';
                $result = $this->commondao->delete_table($tableNm, $where);

            }
            //fn_log('procgbn - '.$params['procgbn']);
            //fn_log('$result - '.$result);


            if ($result == 0) except('데이터 처리에 오류가 있습니다...', true);
            if ($result < 0) except('데이터 처리에 실패하였습니다.', true);

            $return['msg'] = 'TRUE';
            $return['data'] = $result;

            $this->db2->trans_commit();

            if($params['procgbn'] == 'EDT'){
                $this->_save_admin($params['ob_office_idx'].','.$params['mf_wrkfield_idx'], "세무사무소 전문분야 수정 - " . json_encode($sql_param,JSON_UNESCAPED_UNICODE));
            } else {
                $this->_save_admin($params['ob_office_idx'].','.$params['mf_wrkfield_idx'], "세무사무소 전문분야 삭제 - " . '');
            }
        }
        catch (Exception $e) {
            if (!empty($e->getCode())) $this->db2->trans_rollback();
            $return['msg'] = 'FALSE';
            $return['data'] = $e->getMessage();
        }

        return $return;
    }




    // 세무사무소 인터뷰 등록
    public function set_reg_office_intrvw($params)
    {
        $return = array();
        $sql_param = array();

        try{
            $this->db2->trans_begin();

            $sql_param['ob_office_idx'] = trim($params['ob_office_idx']);
            $sql_param['iv_officeQ'] = trim($params['iv_officeQ']);
            $sql_param['iv_officeA'] = trim($params['iv_officeA']);
            $sql_param['iv_regDt'] = YMD_HIS;
            $sql_param['iv_regId'] = $this->session->userdata('user_id');

            $tblNm = 'tbl_office_intrvw';
            $result = $this->commondao->insert_table($tblNm, $sql_param);

            if ($result == 0) except('데이터 처리에 오류가 있습니다.', true);
            if ($result < 0) except('데이터 처리에 실패하였습니다.', true);

            $return['msg'] = 'TRUE';
            $return['data'] = $result;

            $this->db2->trans_commit();

            $this->_save_admin($result, "세무사무소 인터뷰 저장 - " . json_encode($sql_param,JSON_UNESCAPED_UNICODE));

        }
        catch (Exception $e) {
            if (!empty($e->getCode())) $this->db2->trans_rollback();
            $return['msg'] = 'FALSE';
            $return['data'] = $e->getMessage();
        }

        return $return;
    }



    // 세무사무소 인터뷰 리스트
    public function get_office_intrvw_list($params)
    {
        $return = array();

        $sql = "
                SELECT iv_officeQnA_idx, ob_office_idx, iv_officeQ, iv_officeA, iv_regDt, iv_uptDt, iv_regId, iv_uptId
                FROM tp.tbl_office_intrvw
                WHERE 1=1    
                ";

        if ($params['ob_office_idx']) {
            $sql .= " and  ob_office_idx = ?";
            $sql_param['ob_office_idx'] = $params['ob_office_idx'];
        }
        //fn_log($sql);

        $result = $this->commondao->get_query($sql, $sql_param);
        $list = $result;

        if(empty($list)) {
            $return['msg'] = 'FALSE';
            $return['list'] = array();
        } else {
            $return['msg'] = 'TRUE';
            $return['list'] = $list;
        }

        return $return;
    }



    // 세무사무소 인터뷰 수정삭제
    public function set_office_intrvw_proc($params)
    {
        $return = array();
        $sql_param = array();
        $where = array();

        try{
            $this->db2->trans_begin();

            if($params['procgbn'] == 'EDT')
            {
                if($params['iv_officeQ']){
                    $sql_param['iv_officeQ'] = $params['iv_officeQ'];
                }
                if($params['iv_officeQ']){
                    $sql_param['iv_officeA'] = $params['iv_officeA'];
                }
                $sql_param['iv_uptDt'] = YMD_HIS;
                $sql_param['iv_uptId'] = $this->session->userdata('user_id');

                if($params['ob_office_idx']) {
                    $where['ob_office_idx'] = $params['ob_office_idx'];
                }
                if($params['iv_officeQnA_idx']) {
                    $where['iv_officeQnA_idx'] = $params['iv_officeQnA_idx'];
                }

                $tableNm = 'tbl_office_intrvw';
                $result = $this->commondao->update_table($tableNm, $sql_param, $where);
            }
            else{
                $sql = "
                        DELETE FROM tp.tbl_office_intrvw
                        WHERE 1=1    
                ";

                if($params['ob_office_idx']) {
                    $where['ob_office_idx'] = $params['ob_office_idx'];
                }
                if($params['iv_officeQnA_idx']) {
                    $where['iv_officeQnA_idx'] = $params['iv_officeQnA_idx'];
                }
                $tableNm = 'tbl_office_intrvw';
                $result = $this->commondao->delete_table($tableNm, $where);
            }

            if ($result == 0) except('데이터 처리에 오류가 있습니다.', true);
            if ($result < 0) except('데이터 처리에 실패하였습니다.', true);

            $return['msg'] = 'TRUE';
            $return['data'] = $result;

            $this->db2->trans_commit();


            if($params['procgbn'] == 'EDT'){
                $this->_save_admin($params['ob_office_idx'].','.$params['iv_officeQnA_idx'], "세무사무소 인터뷰 수정 - " . json_encode($sql_param,JSON_UNESCAPED_UNICODE));
            } else {
                $this->_save_admin($params['ob_office_idx'].','.$params['iv_officeQnA_idx'], "세무사무소 인터뷰 삭제 - " . '');
            }
        }
        catch (Exception $e) {
            if (!empty($e->getCode())) $this->db2->trans_rollback();
            $return['msg'] = 'FALSE';
            $return['data'] = $e->getMessage();
        }

        return $return;
    }






    // 세무사무소 기본정보 api
    public function get_office_baseInf($param)
    {
        $return = array();

        $sql = "
                SELECT ob.ob_office_idx, ob.ob_officeNm, ob.ob_bizNum, ob.ob_bltDt, ob.ob_wrkrNum, ob.ob_email, ob.ob_ceoNm, ob.ob_tel, ob.ob_logo, ob.ob_filePath, ob.ob_img_width, ob.ob_img_height, 
                        ob.ob_zip, ob.ob_addr, ob.ob_addr_desc, ob.ob_sido, ob.ob_gu, ob.ob_memo, ob.ob_latitud, ob.ob_longtitud, ob.ob_state, ob.ob_regDt, ob.ob_uptDt, ob.ob_regId, ob.ob_uptId
                        ,oa.ac_id, oa.ac_nm, oa.ac_pwd
                FROM tp.tbl_office_base ob
                  left outer join tp.tbl_office_accnt oa
                    on ob.ob_office_idx = oa.ob_office_idx
                    
                WHERE 1=1    
                ";

        if($param['ob_office_idx']){
            $sql .= ' and  ob.ob_office_idx = ? ';
            $sql_param['ob_office_idx'] = $param['ob_office_idx'];
        }
        $result = $this->commondao->get_query($sql, $sql_param);

        foreach ($result as $k => $v) {
            //print_r($k);
            //print_r($v);
            $result[0]['ob_tel'] = $this->openssl_mem->aes_decrypt($v['ob_tel']);
            $result[0]['ob_email'] = $this->openssl_mem->aes_decrypt($v['ob_email']);
        }

        if (empty($result)) {
            $return['msg'] = 'error';
            $return['data'] = '';
        } else {
            $return['msg'] = 'success';
            $return['data'] = $result[0];
            //$return['data'] = $result;
        }

        return $return;
    }




    // 세무사무소 맴버쉽정보 api
    public function get_office_mbrshipInf($param)
    {
        $return = array();

        $sql = "
                SELECT ms_mbr_idx, ob_office_idx, si_svcgds_idx, ms_mbrgbn, ms_joinDt, ms_freeBeginDt, ms_freeEndDt,
                       ms_mbrBeginDt, ms_mbrEndDt, ms_ttlAmt, ms_monthAmt, ms_ttlperiod, ms_regDt, ms_uptDt, ms_regId, ms_uptId
                FROM tp.tbl_mbrship
                WHERE 1=1    
                ";

        if($param['ob_office_idx']){
            $sql .= ' and  ob_office_idx = ? ';
            $sql_param['ob_office_idx'] = $param['ob_office_idx'];
        }
        $result = $this->commondao->get_query($sql, $sql_param);

        if (empty($result)) {
            $return['msg'] = 'error';
            $return['data'] = '';
        } else {
            $return['msg'] = 'success';
            $return['data'] = $result[0];
            //$return['data'] = $result;
        }

        return $return;
    }




    // 세무사무소 주요약력 api
    public function get_office_profileInf($params)
    {
        $return = array();

        $sql = "
                SELECT pf_profile_idx, ob_office_idx, pf_date, pf_desc
                FROM tp.tbl_office_profile
                WHERE 1=1    
                ";

        if ($params['ob_office_idx']) {
            $sql .= " and  ob_office_idx = ?";
            $sql_param['ob_office_idx'] = $params['ob_office_idx'];
        }
        //fn_log($sql);

        $result = $this->commondao->get_query($sql, $sql_param);
        $list = $result;

        if(empty($list)) {
            $return['msg'] = 'FALSE';
            $return['list'] = array();
        } else {
            $return['msg'] = 'TRUE';
            $return['list'] = $list;
        }

        return $return;
    }




    // 세무사무소 세무사직원 정보 api
    public function get_office_taxAccntInf($params)
    {
        $return = array();

        $sql = "
                SELECT at_taxAccnt_idx, ob_office_idx, at_taxAccntNm, at_eduLvl, at_jobfield, at_Profile, at_wrkgbn, at_regDt, at_uptDt, at_regId, at_uptId
                FROM tp.tbl_office_taxaccnt
                WHERE 1=1    
                  and  at_wrkgbn = 'Y'
                ";

        if ($params['ob_office_idx']) {
            $sql .= " and  ob_office_idx = ?";
            $sql_param['ob_office_idx'] = $params['ob_office_idx'];
        }
        //fn_log($sql);

        $result = $this->commondao->get_query($sql, $sql_param);
        $list = $result;

        if(empty($list)) {
            $return['msg'] = 'FALSE';
            $return['list'] = array();
        } else {
            $return['msg'] = 'TRUE';
            $return['list'] = $list;
        }

        return $return;
    }



    // 세무사무소 주요고객 정보 api
    public function get_office_clientInf($params)
    {
        $return = array();

        $sql = "
                SELECT mc_client_idx, ob_office_idx, mc_clientNm, mc_fieldgbn, mc_wrkdesc, mc_regDt, mc_uptDt, mc_regId, mc_uptId
                FROM tp.tbl_office_client
                WHERE 1=1    
                ";

        if ($params['ob_office_idx']) {
            $sql .= " and  ob_office_idx = ?";
            $sql_param['ob_office_idx'] = $params['ob_office_idx'];
        }
        //fn_log($sql);

        $result = $this->commondao->get_query($sql, $sql_param);
        $list = $result;

        if(empty($list)) {
            $return['msg'] = 'FALSE';
            $return['list'] = array();
        } else {
            $return['msg'] = 'TRUE';
            $return['list'] = $list;
        }

        return $return;
    }



    // 세무사무소 전문분야 정보 api
    public function get_office_wrkfieldInf($params)
    {
        $return = array();

        $sql = "
                SELECT mf_wrkfield_idx, ob_office_idx, mf_wrkfieldNm, mf_regDt, mf_uptDt, mf_regId, mf_uptId
                FROM tp.tbl_office_wrkfield
                WHERE 1=1    
                ";

        if ($params['ob_office_idx']) {
            $sql .= " and  ob_office_idx = ?";
            $sql_param['ob_office_idx'] = $params['ob_office_idx'];
        }
        //fn_log($sql);

        $result = $this->commondao->get_query($sql, $sql_param);
        $list = $result;

        if(empty($list)) {
            $return['msg'] = 'FALSE';
            $return['list'] = array();
        } else {
            $return['msg'] = 'TRUE';
            $return['list'] = $list;
        }

        return $return;
    }



    // 세무사무소 인터뷰 정보 api
    public function get_office_intrvwInf($params)
    {
        $return = array();

        $sql = "
                SELECT iv_officeQnA_idx, ob_office_idx, iv_officeQ, iv_officeA, iv_regDt, iv_uptDt, iv_regId, iv_uptId
                FROM tp.tbl_office_intrvw
                WHERE 1=1    
                ";

        if ($params['ob_office_idx']) {
            $sql .= " and  ob_office_idx = ?";
            $sql_param['ob_office_idx'] = $params['ob_office_idx'];
        }
        //fn_log($sql);

        $result = $this->commondao->get_query($sql, $sql_param);
        $list = $result;

        if(empty($list)) {
            $return['msg'] = 'FALSE';
            $return['list'] = array();
        } else {
            $return['msg'] = 'TRUE';
            $return['list'] = $list;
        }

        return $return;
    }







    // 시도 리스트
    public function get_sdg_sido_list()
    {
        $return = array();
        $where = array();

        $sql = "
                    SELECT sdg_sido_no, sdg_sido_nm
                    FROM tp.tbl_sidogu
                    group by sdg_sido_no, sdg_sido_nm;
                ";
        $result = $this->commondao->get_query($sql, $where);
        //fn_log($result);

        if (empty($result)) {
            $return['msg'] = 'error';
            $return['data'] = array();
        } else {
            $return['msg'] = 'success';
            $return['data'] = $result;
        }

        return $return;
    }


    // 시도별 구군 리스트
    public function get_gu_list_data($params){
        $return = array();
        $sql_param = array();

        $sql = "
                SELECT sdg_gu_no, sdg_gu_nm
                FROM tp.tbl_sidogu
                where 1 = 1
        ";

        if($params['sdg_sido_no']){
            $sql .= ' and sdg_sido_no = ? ';
            $sql_param['sdg_sido_no'] = $params['sdg_sido_no'];
        }

        $result = $this->commondao->get_query($sql, $sql_param);
        //print_r($result);

        if (empty($result)) {
            $return['msg'] = 'FALSE';
            $return['list'] = array();
        } else {
            $return['msg'] = 'TRUE';
            $return['list'] = $result;
        }

        return $return;
   }


    /**
     * @param $params
     */

    // 비밀번호 초기화
    public function set_pwdInit_data($params)
   {
       $return = array();

       try{
           $this->db2->trans_begin();

           if($params['ob_office_idx']) {
               $initPwd = '11111@11111';
               $sql_params['ac_pwd'] = password_hash($initPwd, PASSWORD_DEFAULT);
               $where['ob_office_idx'] = $params['ob_office_idx'];
           }
           $tableNm = 'tbl_office_accnt';
           $result = $this->commondao->update_table($tableNm, $sql_params, $where);

           if($result == 0){ except('데이터 처리에 오류가 있습니다.', true);}
           if($result < 0){ except('데이터 처리에 실패 하였습니다.', true);}

           if(empty($result)){
               $return['msg'] = 'FALSE';
               $return['data'] = array();
           }else{
               $return['msg'] = 'TRUE';
               $return['data'] = $result;
           }

           $this->db2->trans_commit();
       }
       catch(Exception $e){
           if (!empty($e->getCode())) $this->db2->trans_rollback();
           $return['msg'] = 'FALSE';
           $return['data'] = $e->getMessage();
       }
        return $return;
   }



   // 세무사무소 시도정보
   public function get_office_sidoInf($ob_sido){
        $return = array();
        $sql_params = array();

       $sql = "
                SELECT sdg_gu_no, sdg_gu_nm
                FROM tp.tbl_sidogu
                where 1 = 1
        ";

        if($ob_sido){
            $sql .= ' and sdg_sido_no = ? ';
            $sql_params['sdg_sido_no'] = $ob_sido;
        }

        $result = $this->commondao->get_query($sql, $sql_params);
        if(empty($result)){
            $return['msg'] = 'FALSE';
            $return['data'] = array();
        }else{
            $return['msg'] = 'TRUE';
            $return['data'] = $result;
        }

        return $return;
   }


   // 세무사무소별 맴버쉽정보
    public function getMbrsvc_data($params){
        $return = array();
        $sql_params = array();

        $sql = "
                    SELECT ms.ms_mbr_idx, ms.ob_office_idx, ms.si_svcgds_idx, ms.ms_mbrgbn, ms.ms_joinDt, ms.ms_freeBeginDt, ms.ms_freeEndDt, ms.ms_mbrBeginDt, ms.ms_mbrEndDt, ms.ms_ttlAmt, ms.ms_monthAmt
                          ,ms.ms_ttlperiod, ms.ms_regDt, ms.ms_uptDt, ms.ms_regId, ms.ms_uptId
                          ,sg.si_svcgdsNm, sg.si_svcgds_amt, sg.si_svc_period
                    FROM tp.tbl_mbrship ms
                     left outer join tp.tbl_serivce_goods sg
                       on ms.si_svcgds_idx = sg.si_svcgds_idx
                       and sg.si_usegbn = 'Y'
                    WHERE 1=1                   
        ";

        if($params['ob_office_idx']){
            $sql .= ' and ms.ob_office_idx = ? ';
            $sql_params['ob_office_idx'] = $params['ob_office_idx'];
        }
        //fn_log('sql_params[\'ob_office_idx\'] - '.$sql_params['ob_office_idx']);

        $result = $this->commondao->get_query($sql, $sql_params);

        if(empty($result)){
            $return['msg'] = 'FALSE';
            $return['data'] = array();
        }else{
            $return['msg'] = 'TRUE';
            $return['data'] = $result[0];
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























}
