<?php
/**
 * @ description : Code biz
 * @ author : prog106 <prog106@haomun.com>
 */
class Hosptlbiz extends CI_Model
{
    public function __construct()
    {
        parent::__construct();

        //$this->load->database();
        $this->db2 = $this->load->database('insertdb', TRUE);
        $this->load->model('dao/Commondao', 'commondao');

        date_default_timezone_set('Asia/Seoul');
    }

    //제휴병원 리스트
    public function get_hosptl_list($param, $limit, $offset)
    {
        $return = array();
        $where = array();

        if($this->openssl_mem->aes_decrypt($this->session->userdata('user_grade')) <= 6){
            $where['ob_office_idx'] = $this->session->userdata('office_idx');
        }

        $sql = "
                SELECT	  hb_idx,
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
                      f_get_mdcalsubjct_data(hb_mdcalsubjct_cd,'#') as hb_mdcalsubjct_cd_v,
                      hb_hosptl_gbn,
                      hb_reserv_gbn,
                      hb_accpt_gbn,
                      hb_estmate_gbn,
                      hb_state,
                      hb_regdt,
                      hb_uptdt,
                      hb_regid,
                      hb_uptid
                FROM tbl_hosptl_base
                WHERE 1=1    
                ";

        if ($param['hb_hosptl_nm'] != "") {
            $where['hb_hosptl_nm'] = $param['hb_hosptl_nm'];
        }
        if ($param['hb_addr'] != "") {
            $where['hb_addr'] = $param['hb_addr'];
        }
        if ($param['hb_tel'] != "") {
            $where['hb_tel'] = $param['hb_tel'];
        }
        if ($param['hb_state'] != "") {
            $where['hb_state'] = $param['hb_state'];
        }
        //fn_log($param);

        foreach ($where as $k => $v) {
            if ($k == 'hb_addr') {
                if (!empty($v)) $sql .= " AND (hb_addr LIKE '%" . $v . "%' OR hb_addr_desc LIKE '%" . $v . "%' )";
            } else if ($k == 'hb_hosptl_nm') {
                if (!empty($v)) $sql .= " AND " . $k . " like '%" . $v . "%'";
            } else if ($k == 'hb_idx') {
                if (!empty($v)) $sql .= " AND ob.hb_idx = '" . $v . "'";
            } else {
                if (!empty($v)) $sql .= " AND " . $k . " = '" . $v . "'";
            }
        }
        $sql .= " ORDER BY hb_idx DESC";
        $sql .= " LIMIT " . $limit . " OFFSET " . $offset;

        //fn_log($sql);
        $result = $this->commondao->get_query($sql, $where);
        $return['msg'] = 'success';
        $return['data'] = $result;
        return $return;

    }

    //제휴병원 리스트 카운트
    public function get_hosptl_list_count($param)
    {
        $return = array();
        $where = array();

        $sql0 = "
                SELECT count(*) as hosptl_ttl_count
                FROM tbl_hosptl_base
                WHERE 1=1    
                ";

        $result0 = $this->commondao->get_query($sql0, '');
        $result_ttl_v = $result0[0];


        $sql = "
                SELECT count(*) as hosptl_srch_count
                FROM tbl_hosptl_base
                WHERE 1=1    
                ";

        if ($param['hb_hosptl_nm'] != "") {
            $where['hb_hosptl_nm'] = $param['hb_hosptl_nm'];
        }
        if ($param['hb_addr'] != "") {
            $where['hb_addr'] = $param['hb_addr'];
        }
        if ($param['hb_tel'] != "") {
            $where['hb_tel'] = $param['hb_tel'];
        }
        if ($param['hb_state'] != "") {
            $where['hb_state'] = $param['hb_state'];
        }

        foreach ($where as $k => $v) {
            if ($k == 'hb_addr') {
                if (!empty($v)) $sql .= " AND (hb_addr LIKE '%" . $v . "%' OR hb_addr_desc LIKE '%" . $v . "%' )";
            } else if ($k == 'hb_hosptl_nm') {
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




    // 제휴병원 기본정보 api
    public function get_hosptl_baseInf($param)
    {
        $return = array();

        $sql = "
                SELECT	  hb_idx,
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
                          hb_hosptl_gbn,
                          hb_reserv_gbn,
                          hb_accpt_gbn,
                          hb_estmate_gbn,
                          hb_state,
                          hb_regdt,
                          hb_uptdt,
                          hb_regid,
                          hb_uptid
                FROM tbl_hosptl_base
                WHERE 1=1    
                ";

        if($param['hb_idx']){
            $sql .= ' and  hb_idx = ? ';
            $sql_param['hb_idx'] = $param['hb_idx'];
        }
        $result = $this->commondao->get_query($sql, $sql_param);

        foreach ($result as $k => $v) {
            //print_r($k);
            //print_r($v);
            $result[0]['hb_tel'] = $this->openssl_mem->aes_decrypt($v['hb_tel']);
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



    // 시도정보
    public function get_hosptl_sidoInf($hb_sido){
        $return = array();
        $sql_params = array();

        $sql = "
                SELECT sdg_gu_no, sdg_gu_nm
                FROM tbl_sidogu
                where 1 = 1
        ";

        if($hb_sido){
            $sql .= ' and sdg_sido_no = ? ';
            $sql_params['sdg_sido_no'] = $hb_sido;
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



    //병원정보 수정
    public function set_hosptl_edt_data($param)
    {
        $return = array();
        $sql_param = array();
        $sql_param2 = array();

        try {
            $this->db2->trans_begin();

            if($param['hb_idx']){ $sql_param['hb_idx'] = $param['hb_idx']; }
            if($param['hb_hosptl_nm']){ $sql_param['hb_hosptl_nm'] = $param['hb_hosptl_nm']; }
            if($param['hb_zip_num']){ $sql_param['hb_zip_num'] = $param['hb_zip_num']; }
            if($param['hb_addr']){ $sql_param['hb_addr'] = $param['hb_addr']; }
            if($param['hb_addr_desc']){ $sql_param['hb_addr_desc'] = $param['hb_addr_desc']; }
            if($param['hb_sido']){ $sql_param['hb_sido'] = $param['hb_sido']; }
            if($param['hb_gu']){ $sql_param['hb_gu'] = $param['hb_gu']; }
            if($param['hb_latitude']){ $sql_param['hb_latitude'] = $param['hb_latitude']; }
            if($param['hb_longtitude']){ $sql_param['hb_longtitude'] = $param['hb_longtitude']; }
            if($param['hb_tel']){ $sql_param['hb_tel'] = $this->openssl_mem->aes_encrypt(fn_only_number($param['hb_tel'])); }
            if($param['hb_intro']){ $sql_param['hb_intro'] = $param['hb_intro']; }
            if($param['file_name']){ $sql_param['hb_img'] = $param['file_name']; }
            if($param['image_width']){ $sql_param['hb_img_width'] = $param['image_width']; }
            if($param['image_height']){ $sql_param['hb_img_height'] = $param['image_height']; }
            if($param['file_path']){ $sql_param['hb_img_path'] = $param['file_path']; }
            if($param['hb_memo']){ $sql_param['hb_memo'] = $param['hb_memo']; }
            if($param['hb_mdcalsubjct_cd']){ $sql_param['hb_mdcalsubjct_cd'] = $param['hb_mdcalsubjct_cd']; }
            if($param['hb_hosptl_gbn']){ $sql_param['hb_hosptl_gbn'] = $param['hb_hosptl_gbn']; }
            if($param['hb_reserv_gbn']){ $sql_param['hb_reserv_gbn'] = $param['hb_reserv_gbn']; }
            if($param['hb_accpt_gbn']){ $sql_param['hb_accpt_gbn'] = $param['hb_accpt_gbn']; }
            if($param['hb_estmate_gbn']){ $sql_param['hb_estmate_gbn'] = $param['hb_estmate_gbn']; }
            if($param['hb_state']){ $sql_param['hb_state'] = $param['hb_state']; }
            $sql_param['hb_uptdt'] = YMD_HIS;
            $sql_param['hb_uptid'] = $this->session->userdata('user_id');
            //fn_log('param - '.$param);

            $where['hb_idx'] = $param['hb_idx'];

            $tableNm = 'tbl_hosptl_base';
            $result = $this->commondao->update_table($tableNm, $sql_param, $where);

            if ($result == 0 || $result < 0) except('데이터 저장이 실패하였습니다.', true);
            $this->_save_admin($param['hb_idx'], "병원정보 수정 - " . json_encode($sql_param,JSON_UNESCAPED_UNICODE));

            $return['msg'] = 'TRUE';
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


    public function reg_treatmnt_time_data($param){
        $return = array();
        $sql_param = array();

        try{
            $this->db2->trans_begin();

            $sql0 = " SELECT f_chk_weekdata_exist('".$param['hb_idx']."','".$param['mt_days']."') as dupd_week ";
            $result0 = $this->commondao->get_query($sql0, $sql_param);
            $dupd_week = $result0[0]['dupd_week'];
            fn_log($sql0);

            if($dupd_week == 'TRUE'){
                //except('이미 등록된 요일입니다 기존요일을 삭제후 등록해주세요',true);

                $return['msg'] = 'DUP';
                $return['data'] = $result0;
            }
            else
            {
                $sql_param['hb_idx'] = $param['hb_idx'];
                $sql_param['mt_days'] = $param['mt_days'];

                if($param['gbn'] == 'weekday'){         //weekday, weekdnd, lunchtime
                    $sql_param['mt_weekday_gbn'] = '평일';
                }
                elseif($param['gbn'] == 'weekend'){
                    $sql_param['mt_weekday_gbn'] = '주말';
                }
                elseif($param['gbn'] == 'lunchtime'){
                    $sql_param['mt_weekday_gbn'] = '점심';
                    $sql_param['mt_lunchtime_gbn'] = 'Y';
                }

                $sql_param['mt_begin_hour'] = $param['mt_begin_hour'];
                $sql_param['mt_bigin_minute'] = $param['mt_bigin_minute'];
                $sql_param['mt_end_hour'] = $param['mt_end_hour'];
                $sql_param['mt_end_minute'] = $param['mt_end_minute'];

                if(((int)$param['mt_begin_hour'] == 12 && (int)$param['mt_bigin_minute'] >= 0) || (int)$param['mt_begin_hour'] > 12 ){
                    $sql_param['mt_begin_ampm'] = 'pm';
                }else{
                    $sql_param['mt_begin_ampm'] = 'am';
                }
                if(((int)$param['mt_end_hour'] == 12 && (int)$param['mt_end_minute'] >= 0) || (int)$param['mt_end_hour'] > 12 ){
                    $sql_param['mt_end_ampm'] = 'pm';
                }else{
                    $sql_param['mt_end_ampm'] = 'am';
                }

                if( $param['mt_dayoff_gbn'] != 'Y'){ $param['mt_dayoff_gbn'] = 'N'; }
                $sql_param['mt_dayoff_gbn'] = $param['mt_dayoff_gbn'];
                $sql_param['mt_regdt'] = YMD_HIS;
                $sql_param['mt_regid'] = $this->session->userdata('user_id');
                //print_r($sql_param);

                $tblNm = 'tbl_treatmnt_time';
                $result = $this->commondao->insert_table($tblNm, $sql_param);

                $this->_save_admin($result, "제휴병원 신규저장 - " . json_encode($sql_param,JSON_UNESCAPED_UNICODE));

                if($result == 0){ except('데이터처리에 오류가 있습니다',true); }
                if($result < 0){ except('데이터처리에 실패하였습니다', true); }

                $return['msg'] = 'TRUE';
                $return['data'] = $result;

                $this->db2->trans_commit();

            }
        }
        catch(Exception $e){
            if (!empty($e->getCode())) $this->db2->trans_rollback();
            $return['msg'] = 'FALSE';
            $return['data'] = $e->getMessage();
        }

        return $return;
    }




    public function get_treatmnt_time_list_data($params){
        $return = array();

        $sql = "
                SELECT	  mt_idx,
                          hb_idx,
                          mt_weekday_gbn,
                          mt_days,
                          f_get_week_data(mt_days,'#') mt_days_v,
                          mt_lunchtime_gbn,
                          mt_begin_ampm,
                          mt_begin_hour,
                          mt_bigin_minute,
                          mt_end_ampm,
                          mt_end_hour,
                          mt_end_minute,
                          mt_dayoff_gbn,
                          mt_regdt,
                          mt_uptdt,
                          mt_regid,
                          mt_uptid
                FROM tbl_treatmnt_time
                WHERE 1=1    
            ";

        if ($params['hb_idx']) {
            $sql .= " and  hb_idx = ?";
            $sql_param['hb_idx'] = $params['hb_idx'];
        }
        fn_log($sql);

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



    public function set_treatmnt_time_data($params){
        $return = array();
        $sql_param = array();
        $where = array();

        try{
            $this->db2->trans_begin();

            $sql = " delete from  tbl_treatmnt_time where 1=1 ";

            if($params['mt_idx']) {
                $where['mt_idx'] = $params['mt_idx'];
            }

            if($params['hb_idx']) {
                $where['hb_idx'] = $params['hb_idx'];
            }

            $tableNm = 'tbl_treatmnt_time';
            $result = $this->commondao->delete_table($tableNm, $where);

            if($result == 0 ){ except("데이터 처리에 오류가 있습니다", true); }
            if($result < 0 ){ except("데이터 처리에 실패하였습니다", true); }

            $return['msg'] = 'TRUE';
            $return['data'] = $result;

            $this->db2->trans_commit();

            $this->_save_admin( $params['mt_idx'].','. $params['hb_idx'], '요일별 진료시간 삭제');
        }
        catch(Exception $e){
            if(!empty($e->getCode())){ $this->db2->trans_rollback(); }

            $return['msg'] = 'FALSE';
            $return['data'] = $e->getMessage();
        }

        return $return;
    }





    public function set_hosptl_img_data($params){
        $return = array();
        $sql_param = array();
        $where = array();

        try{
            $this->db2->trans_begin();

            if($params['hi_idx']){
                $where['hi_idx'] = $params['hi_idx'];
            }
            if($params['hb_idx']){
                $where['hb_idx'] = $params['hb_idx'];
            }

            if($params['procgbn'] == 'DEL') {
                $tableNm = 'tbl_hosptl_img';
                $result = $this->commondao->delete_table($tableNm, $where);
            }
            
            if($result == 0){ except("데이터 처리에 실패하였습니다", true); }
            if($result < 0){ except("데이터 처리중 오류가 발생하였습니다", true); }
            
            if(empty($result)){
                $return['msg'] = 'FALSE';
                $return['data'] = array();
            } 
            else{
                $return['msg'] = 'TRUE';
                $return['data'] = $result;
            }   
            
            $this->db2->trans_commit();
            
            $this->_save_admin($params['hi_idx'].','. $params['hb_idx'],"병원 이미지 삭제처리");
        }
        catch (Exception $e){
            if(!empty($e->getCode())){ $this->db2->trans_rollback(); }

            $return['msg'] = 'FALSE';
            $return['data'] = $e->getMessage();
        }

        return $return;
    }





    public function reg_hosptl_img_data($param){
        $return = array();
        $sql_param = array();

        try{
            $this->db2->trans_begin();

            if($param['hi_main_gbn']){
                $sql_param['hi_main_gbn'] = $param['hi_main_gbn'];
            }
            if($param['file_name']){
                $sql_param['hi_img'] = $param['file_name'];
            }
            if($param['file_path']){
                $sql_param['hi_img_path'] = $param['file_path'];
            }
            if($param['image_width']){
                $sql_param['hi_img_width'] = $param['image_width'];
            }
            if($param['image_height']){
                $sql_param['hi_img_height'] = $param['image_height'];
            }
            if($param['hb_idx']){
                $sql_param['hb_idx'] = $param['hb_idx'];
            }
            $sql_param['hi_regdt'] = YMD_HIS;
            $sql_param['hi_regid'] = $this->session->userdata('user_id');


            $tableNm = 'tbl_hosptl_img';
            $result = $this->commondao->insert_table($tableNm, $sql_param);

            if($result == 0){ except("데이터 처리에 실패하였습니다", true);}
            if($result < 0){ except("데이터 처리중 오류가 발생하였습니다", true);}

            $return['msg'] = 'TRUE';
            $return['data'] = $result;

            $this->db2->trans_commit();

            $this->_save_admin($result,'병원이미지 저장 - '. json_encode($sql_param, JSON_UNESCAPED_UNICODE));
          }
        catch(Exception $e){
            if(!empty($e->getCode())){ $this->db2->trans_rollback(); }

            $return['msg'] = 'FALSE';
            $return['data'] = $e->getMessage();
        }

        return $return;

    }



    public function get_hosptl_img_list_data($params){
        $return = array();
        $sql_param = array();
        $where = array();

        $sql = " 
                 SELECT  hi_idx,
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
                where 1=1
              ";

        if($params['hb_idx']){
            $sql .= " and  hb_idx = ? ";
            $sql_param['hb_idx'] = $params['hb_idx'];
        }

        $result = $this->commondao->get_query($sql, $sql_param);
        $list = $result;

        if(empty($list)){
           $return['msg'] = "FALSE";
           $return['list'] = array();
        }
        else{
           $return['msg'] = "TRUE";
           $return['list'] = $list;
        }

        return $return;

    }



    public function mdcalsubjct_popup_list_data(){
        $return = array();
        $sql_param = array();

        $sql = " SELECT  info_title, info_value 
                 FROM infos
                 WHERE info_tag = 'mdcalsubjct' ";

        $result = $this->commondao->get_query($sql, $sql_param);
        $list = $result;

        if(empty($list)){
            $return['msg'] = 'FALSE';
            $return['list'] = array();
        }else{
            $return['msg'] = 'TRUE';
            $return['list'] = $list;
        }

        return $return;
    }



    public function profield_popup_list_data(){
        $return = array();
        $sql_param = array();

        $sql = " SELECT  info_title, info_value 
                 FROM infos
                 WHERE info_tag = 'profield' ";

        $result = $this->commondao->get_query($sql, $sql_param);
        $list = $result;

        if(empty($list)){
            $return['msg'] = 'FALSE';
            $return['list'] = array();
        }else{
            $return['msg'] = 'TRUE';
            $return['list'] = $list;
        }

        return $return;
    }



    public function ptheme_popup_list_data(){
        $return = array();
        $sql_param = array();

        $sql = " SELECT  info_title, info_value 
                 FROM infos
                 WHERE info_tag = 'theme' ";

        $result = $this->commondao->get_query($sql, $sql_param);
        $list = $result;

        if(empty($list)){
            $return['msg'] = 'FALSE';
            $return['list'] = array();
        }else{
            $return['msg'] = 'TRUE';
            $return['list'] = $list;
        }

        return $return;
    }





    public function reg_main_doctr_data($param){
        $return = array();
        $sql_param = array();

        try{
            $this->db2->trans_begin();

            if($param['file_name']){ $sql_param['md_img'] = $param['file_name']; }
            if($param['file_path']){ $sql_param['md_img_path'] = $param['file_path']; }
            if($param['image_width']){ $sql_param['md_img_width'] = $param['image_width']; }
            if($param['image_height']){ $sql_param['md_img_height'] = $param['image_height']; }
            if($param['hb_idx']){ $sql_param['hb_idx'] = $param['hb_idx']; }
            if($param['md_dctr_nm']){ $sql_param['md_dctr_nm'] = $param['md_dctr_nm']; }
            if($param['md_mdcalsubjct_nm']){ $sql_param['md_mdcalsubjct_nm'] = $param['md_mdcalsubjct_nm']; }
            if($param['md_mdcalsubjct_cd']){ $sql_param['md_mdcalsubjct_cd'] = $param['md_mdcalsubjct_cd']; }
            if($param['md_profield_nm']){ $sql_param['md_profield_nm'] = $param['md_profield_nm']; }
            if($param['md_profield_cd']){ $sql_param['md_profield_cd'] = $param['md_profield_cd']; }
            $sql_param['md_regdt'] = YMD_HIS;
            $sql_param['md_regid'] = $this->session->userdata('user_id');


            $tableNm = 'tbl_main_doctr';
            $result = $this->commondao->insert_table($tableNm, $sql_param);

            if($result == 0){except("데이터 처리가 실패하였습니다", true); }
            if($result == 0){except("데이터 처리중 오류가 발생하였습니다", true); }

            $return["msg"] = "TRUE";
            $return['data'] = $result;

            $this->db2->trans_commit();

            $this->_save_admin($result, '주요의료진 등록처리 - '.json_encode($param, JSON_UNESCAPED_UNICODE));
        }
        catch(Exception $e){
            if(!empty($e->getCode())){ $this->db2->trans_rollback(); }

            $return["msg"] = "FALSE";
            $return['data'] = $e->getMessage();
        }

        return $return;

    }



    public function main_doctr_list_data($params){
        $return = array();
        $sql_param = array();

        $sql = "
                SELECT	  md_idx,
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
                    WHERE 1 = 1
              ";

        if($params['hb_idx']) {
            $sql .= " and hb_idx = ?  ";
            $sql_param['hb_idx'] = $params['hb_idx'];
        }

        $result = $this->commondao->get_query($sql, $sql_param);
        $list = $result;

        if(empty($list)){
            $return['msg'] = 'FALSE';
            $return['list'] = array();
        }else{
            $return['msg'] = 'TRUE';
            $return['list'] = $list;
        }

        return $return;
    }



    public function set_main_doctr_data($param){
        $return = array();
        $data = array();
        $sql_param = array();
        $where = array();

        try{
            $this->db2->trans_begin();

            if($param['file_name']){ $sql_param['md_img'] = $param['file_name']; }
            if($param['file_path']){ $sql_param['md_img_path'] = $param['file_path']; }
            if($param['image_width']){ $sql_param['md_img_width'] = $param['image_width']; }
            if($param['image_height']){ $sql_param['md_img_height'] = $param['image_height']; }
            //if($param['hb_idx']){ $sql_param['hb_idx'] = $param['hb_idx']; }
            if($param['md_dctr_nm']){ $sql_param['md_dctr_nm'] = $param['md_dctr_nm']; }
            if($param['md_mdcalsubjct_nm']){ $sql_param['md_mdcalsubjct_nm'] = $param['md_mdcalsubjct_nm']; }
            if($param['md_mdcalsubjct_cd']){ $sql_param['md_mdcalsubjct_cd'] = $param['md_mdcalsubjct_cd']; }
            if($param['md_profield_nm']){ $sql_param['md_profield_nm'] = $param['md_profield_nm']; }
            if($param['md_profield_cd']){ $sql_param['md_profield_cd'] = $param['md_profield_cd']; }
            $sql_param['md_regdt'] = YMD_HIS;
            $sql_param['md_regid'] = $this->session->userdata('user_id');

            if($param['md_idx']){ $where['md_idx'] = $param['md_idx']; }
            if($param['hb_idx']){ $where['hb_idx'] = $param['hb_idx']; }

            $tableNm = 'tbl_main_doctr';

            if($param['procgbn'] == 'DEL'){
                $result = $this->commondao->delete_table($tableNm, $where);
            }
            elseif($param['procgbn'] == 'EDT'){
                $result = $this->commondao->update_table($tableNm, $sql_param, $where);
            }

            if($result == 0 ){ except('데이터 처리가 실패하였습니다', true); }
            if($result < 0 ){ except('데이터 처리중 오류가 발생하였습니다', true); }

            $return['msg'] = "TRUE";
            $return['data'] = $result;

            $this->db2->trans_commit();

            if($param['procgbn'] == 'DEL'){
                $this->_save_admin($param['md_idx'].','.$param['hb_idx'],'주요의료진 삭제처리');
            }
            elseif($param['procgbn'] == 'EDT'){
                $this->_save_admin($param['md_idx'].','.$param['hb_idx'],'주요의료진 변경처리 - '.json_encode($sql_param, JSON_UNESCAPED_UNICODE));
            }
        }
        catch (Exception $e){
            if(!empty($e->getCode())){ $this->db2->trans_rollback(); }

            $return['msg'] = "FALSE";
            $return['data'] = $e->getMessage();
        }

        return $return;
    }



    public function reg_hosptl_medcalsubjct_data($params){
        $return = array();
        $sql_param = array();

        try{
            $this->db2->trans_begin();

            if($params['hb_mdcalsubjct_cd']){ $sql_param['hb_mdcalsubjct_cd'] = $params['hb_mdcalsubjct_cd']; }
            if($params['hb_idx']){ $where['hb_idx'] = $params['hb_idx']; }
            $sql_param['hb_uptdt'] = YMD_HIS;
            $sql_param['hb_uptid'] = $this->session->userdata('user_id');

            $tableNm = 'tbl_hosptl_base';
            $result = $this->commondao->update_table($tableNm, $sql_param, $where );

            if($result == 0 ){ except('데이터처리가 실패하였습니다', true); }
            if($result < 0 ){ except('데이터처리중 오류가 발생하였습니다', true); }

            $return['msg'] = 'TRUE';
            $return['data'] = $result;

            $this->db2->trans_commit();

            $this->_save_admin($params['hb_idx'],'병원 진료과목 변경처리 - '. json_encode($sql_param), JSON_UNESCAPED_UNICODE);
        }
        catch(Exception $e){
            if(!empty($e->getCode())){ $this->db2->trans_rollback(); }

            $return['msg'] = 'FALSE';
            $return['data'] = $e->getMessage();
        }

        return $return;
    }




    public function get_hosptl_medcalsubjct_list_data($params){
        $return = array();
        $sql_param = array();

        $sql = "
                SELECT	hb_idx,
                        hb_mdcalsubjct_cd,
                        f_get_mdcalsubjct_data(ifnull(hb_mdcalsubjct_cd,''),'#') AS hb_mdcalsubjct_nm,
                        hb_theme_cd
                FROM tbl_hosptl_base
                WHERE 1=1
                    AND IFNULL(hb_mdcalsubjct_cd,'') <> ''
        ";

        if($params['hb_idx']){
            $sql .= " and hb_idx = ?  ";
            $sql_param['hb_idx'] = $params['hb_idx'];
        }

        $result = $this->commondao->get_query($sql, $sql_param);
        $list = $result;

        if(!empty($list)){
            $return['msg'] = 'TRUE';
            $return['list'] = $list;
        }
        else{
            $return['msg'] = 'FALSE';
            $return['list'] = array();
        }

        return $return;
    }




    public function del_hosptl_medcalsubjct_data($params)
    {
        $return = array();
        $sql_param = array();
        $where = array();

        try{
            $this->db2->trans_begin();

            if($params['hb_idx']){ $where['hb_idx'] = $params['hb_idx']; }
            $sql_param['hb_mdcalsubjct_cd'] = '';
            $sql_param['hb_uptdt'] = YMD_HIS;
            $sql_param['hb_uptid'] = $this->session->userdata('user_id');

            $tableNm = 'tbl_hosptl_base';
            $result = $this->commondao->update_table($tableNm, $sql_param, $where);

            if($result == 0 ){ except('데이터 처리가 실패하였습니다', true); }
            if($result < 0 ){ except('데이터 처리중 오류가 발생하였습니다', true); }

            $return['msg'] = 'TRUE';
            $return['data'] = $result;

            $this->db2->trans_commit();

            $this->_save_admin($params['hb_idx'],'병원 진료과목 삭제처리 - '. json_encode( $sql_param, JSON_UNESCAPED_UNICODE));
        }
        catch (Exception $e){
            if(!empty($e->getCode())){ $this->db2->trans_rollback(); }

            $return['msg'] = 'FALSE';
            $return['data'] = $e->getMessage();
        }

        return $return;
    }




    public function reg_hosptl_profield_data($params){
        $return = array();
        $sql_param = array();

        try{
            $this->db2->trans_begin();

            if($params['hb_profield_cd']){ $sql_param['hb_profield_cd'] = $params['hb_profield_cd']; }
            if($params['hb_idx']){ $where['hb_idx'] = $params['hb_idx']; }
            $sql_param['hb_uptdt'] = YMD_HIS;
            $sql_param['hb_uptid'] = $this->session->userdata('user_id');

            $tableNm = 'tbl_hosptl_base';
            $result = $this->commondao->update_table($tableNm, $sql_param, $where );

            if($result == 0 ){ except('데이터처리가 실패하였습니다', true); }
            if($result < 0 ){ except('데이터처리중 오류가 발생하였습니다', true); }

            $return['msg'] = 'TRUE';
            $return['data'] = $result;

            $this->db2->trans_commit();

            $this->_save_admin($params['hb_idx'],'병원 전문분야 변경처리 - '. json_encode($sql_param), JSON_UNESCAPED_UNICODE);
        }
        catch(Exception $e){
            if(!empty($e->getCode())){ $this->db2->trans_rollback(); }

            $return['msg'] = 'FALSE';
            $return['data'] = $e->getMessage();
        }

        return $return;
    }




    public function get_hosptl_profield_list_data($params){
        $return = array();
        $sql_param = array();

        $sql = "
                SELECT	hb_idx,
                        hb_profield_cd,
                        f_get_profield_data(ifnull(hb_profield_cd,''),'#') AS hb_profield_nm
                 FROM tbl_hosptl_base
                WHERE 1=1
                    AND IFNULL(hb_profield_cd,'') <> ''
        ";

        if($params['hb_idx']){
            $sql .= " and hb_idx = ?  ";
            $sql_param['hb_idx'] = $params['hb_idx'];
        }

        $result = $this->commondao->get_query($sql, $sql_param);
        $list = $result;

        if(!empty($list)){
            $return['msg'] = 'TRUE';
            $return['list'] = $list;
        }
        else{
            $return['msg'] = 'FALSE';
            $return['list'] = array();
        }

        return $return;
    }




    public function del_hosptl_profield_data($params)
    {
        $return = array();
        $sql_param = array();
        $where = array();

        try{
            $this->db2->trans_begin();

            if($params['hb_idx']){ $where['hb_idx'] = $params['hb_idx']; }
            $sql_param['hb_profield_cd'] = '';
            $sql_param['hb_uptdt'] = YMD_HIS;
            $sql_param['hb_uptid'] = $this->session->userdata('user_id');

            $tableNm = 'tbl_hosptl_base';
            $result = $this->commondao->update_table($tableNm, $sql_param, $where);

            if($result == 0 ){ except('데이터 처리가 실패하였습니다', true); }
            if($result < 0 ){ except('데이터 처리중 오류가 발생하였습니다', true); }

            $return['msg'] = 'TRUE';
            $return['data'] = $result;

            $this->db2->trans_commit();

            $this->_save_admin($params['hb_idx'],'병원 전문분야 삭제처리 - '. json_encode( $sql_param, JSON_UNESCAPED_UNICODE));
        }
        catch (Exception $e){
            if(!empty($e->getCode())){ $this->db2->trans_rollback(); }

            $return['msg'] = 'FALSE';
            $return['data'] = $e->getMessage();
        }

        return $return;
    }








    public function reg_hosptl_theme_data($params){
        $return = array();
        $sql_param = array();

        try{
            $this->db2->trans_begin();

            if($params['hb_theme_cd']){ $sql_param['hb_theme_cd'] = $params['hb_theme_cd']; }
            if($params['hb_idx']){ $where['hb_idx'] = $params['hb_idx']; }
            $sql_param['hb_uptdt'] = YMD_HIS;
            $sql_param['hb_uptid'] = $this->session->userdata('user_id');

            $tableNm = 'tbl_hosptl_base';
            $result = $this->commondao->update_table($tableNm, $sql_param, $where );

            if($result == 0 ){ except('데이터처리가 실패하였습니다', true); }
            if($result < 0 ){ except('데이터처리중 오류가 발생하였습니다', true); }

            $return['msg'] = 'TRUE';
            $return['data'] = $result;

            $this->db2->trans_commit();

            $this->_save_admin($params['hb_idx'],'병원 테마구분 변경처리 - '. json_encode($sql_param), JSON_UNESCAPED_UNICODE);
        }
        catch(Exception $e){
            if(!empty($e->getCode())){ $this->db2->trans_rollback(); }

            $return['msg'] = 'FALSE';
            $return['data'] = $e->getMessage();
        }

        return $return;
    }




    public function get_hosptl_theme_list_data($params){
        $return = array();
        $sql_param = array();

        $sql = "
                SELECT	hb_idx,
                        hb_theme_cd,
                        f_get_theme_data(ifnull(hb_theme_cd,''),'#') AS hb_theme_nm
                 FROM tbl_hosptl_base
                WHERE 1=1
                    AND IFNULL(hb_theme_cd,'') <> ''
        ";

        if($params['hb_idx']){
            $sql .= " and hb_idx = ?  ";
            $sql_param['hb_idx'] = $params['hb_idx'];
        }

        $result = $this->commondao->get_query($sql, $sql_param);
        $list = $result;

        if(!empty($list)){
            $return['msg'] = 'TRUE';
            $return['list'] = $list;
        }
        else{
            $return['msg'] = 'FALSE';
            $return['list'] = array();
        }

        return $return;
    }




    public function del_hosptl_theme_data($params)
    {
        $return = array();
        $sql_param = array();
        $where = array();

        try{
            $this->db2->trans_begin();

            if($params['hb_idx']){ $where['hb_idx'] = $params['hb_idx']; }
            $sql_param['hb_theme_cd'] = '';
            $sql_param['hb_uptdt'] = YMD_HIS;
            $sql_param['hb_uptid'] = $this->session->userdata('user_id');

            $tableNm = 'tbl_hosptl_base';
            $result = $this->commondao->update_table($tableNm, $sql_param, $where);

            if($result == 0 ){ except('데이터 처리가 실패하였습니다', true); }
            if($result < 0 ){ except('데이터 처리중 오류가 발생하였습니다', true); }

            $return['msg'] = 'TRUE';
            $return['data'] = $result;

            $this->db2->trans_commit();

            $this->_save_admin($params['hb_idx'],'병원 테마구분 삭제처리 - '. json_encode( $sql_param, JSON_UNESCAPED_UNICODE));
        }
        catch (Exception $e){
            if(!empty($e->getCode())){ $this->db2->trans_rollback(); }

            $return['msg'] = 'FALSE';
            $return['data'] = $e->getMessage();
        }

        return $return;
    }


    
    //병원정보 등록
    public function set_hosptl_reg_data($param)
    {
        $return = array();
        $sql_param = array();
        $sql_param2 = array();

        try {
            $this->db2->trans_begin();

            if($param['hb_idx']){ $sql_param['hb_idx'] = $param['hb_idx']; }
            if($param['hb_hosptl_nm']){ $sql_param['hb_hosptl_nm'] = $param['hb_hosptl_nm']; }
            if($param['hb_zip_num']){ $sql_param['hb_zip_num'] = $param['hb_zip_num']; }
            if($param['hb_addr']){ $sql_param['hb_addr'] = $param['hb_addr']; }
            if($param['hb_addr_desc']){ $sql_param['hb_addr_desc'] = $param['hb_addr_desc']; }
            if($param['hb_sido']){ $sql_param['hb_sido'] = $param['hb_sido']; }
            if($param['hb_gu']){ $sql_param['hb_gu'] = $param['hb_gu']; }
            if($param['hb_latitude']){ $sql_param['hb_latitude'] = $param['hb_latitude']; }
            if($param['hb_longtitude']){ $sql_param['hb_longtitude'] = $param['hb_longtitude']; }
            if($param['hb_tel']){ $sql_param['hb_tel'] = $this->openssl_mem->aes_encrypt(fn_only_number($param['hb_tel'])); }
            if($param['hb_intro']){ $sql_param['hb_intro'] = $param['hb_intro']; }
            if($param['file_name']){ $sql_param['hb_img'] = $param['file_name']; }
            if($param['image_width']){ $sql_param['hb_img_width'] = $param['image_width']; }
            if($param['image_height']){ $sql_param['hb_img_height'] = $param['image_height']; }
            if($param['file_path']){ $sql_param['hb_img_path'] = $param['file_path']; }
            if($param['hb_memo']){ $sql_param['hb_memo'] = $param['hb_memo']; }
            if($param['hb_mdcalsubjct_cd']){ $sql_param['hb_mdcalsubjct_cd'] = $param['hb_mdcalsubjct_cd']; }
            if($param['hb_hosptl_gbn']){ $sql_param['hb_hosptl_gbn'] = $param['hb_hosptl_gbn']; }
            if($param['hb_reserv_gbn']){ $sql_param['hb_reserv_gbn'] = $param['hb_reserv_gbn']; }
            if($param['hb_accpt_gbn']){ $sql_param['hb_accpt_gbn'] = $param['hb_accpt_gbn']; }
            if($param['hb_estmate_gbn']){ $sql_param['hb_estmate_gbn'] = $param['hb_estmate_gbn']; }
            if($param['hb_state']){ $sql_param['hb_state'] = $param['hb_state']; }
            $sql_param['hb_uptdt'] = YMD_HIS;
            $sql_param['hb_uptid'] = $this->session->userdata('user_id');
            //fn_log('param - '.$param);

            //$where['hb_idx'] = $param['hb_idx'];

            $tableNm = 'tbl_hosptl_base';
            $result = $this->commondao->insert_table($tableNm, $sql_param);

            if ($result == 0 || $result < 0) except('데이터 저장이 실패하였습니다.', true);
            $this->_save_admin($param['hb_idx'], "병원정보 저장 - " . json_encode($sql_param,JSON_UNESCAPED_UNICODE));

            $return['msg'] = 'TRUE';
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







































































    // 시도 리스트
    public function get_sdg_sido_list()
    {
        $return = array();
        $where = array();

        $sql = "
                    SELECT sdg_sido_no, sdg_sido_nm
                    FROM tbl_sidogu
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
                FROM tbl_sidogu
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
