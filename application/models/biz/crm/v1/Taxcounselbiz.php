<?php
/**
 * @ description : Code biz
 * @ author : prog106 <prog106@haomun.com>
 */
class Taxcounselbiz extends CI_Model
{
    public function __construct()
    {
        parent::__construct();

        //$this->load->database();
        $this->db2 = $this->load->database('insertdb', TRUE);
        $this->load->model('dao/Commondao', 'commondao');

        date_default_timezone_set('Asia/Seoul');
    }


    public function get_taxcounselList_count($param)
    {
        $return = array();
        $where = array();

        $sql0 = "
                SELECT count(*) as taxcounsel_ttl_count
                FROM tp.tbl_taxlawcounsel_req
                WHERE 1=1    
                ";
        $result0 = $this->commondao->get_query($sql0, '');
        $result_ttl_v = $result0[0];


        $sql = "
                SELECT count(*) as taxcounsel_count
                FROM tp.tbl_taxlawcounsel_req
                WHERE 1=1    
                ";
        if ($param['tr_nm'] != "") {
            $where['tr_nm'] = $param['tr_nm'];
        }
        if ($param['tr_tel'] != "") {
            $where['tr_tel'] = $param['tr_tel'];
        }
        if ($param['tr_cate1'] != "") {
            $where['tr_cate1'] = $param['tr_cate1'];
        }
        if ($param['tr_cate2'] != "") {
            $where['tr_cate2'] = $param['tr_cate2'];
        }


        foreach ($where as $k => $v) {
            if ($k == 'tr_nm') {
                if (!empty($v)) $sql .= " AND " . $k . " like '%" . $v . "%'";
            } elseif($k == 'tr_tel') {
                if (!empty($v)) $sql .= " AND " . $k . " = '" . $this->openssl_mem->aes_encrypt($v) . "'";
            }else {
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



    public function get_taxcounsel_list($param, $limit, $offset)
    {
        $return = array();
        $where = array();

        $sql = "
                SELECT tr_taxcunselreq_idx, tr_nm, tr_tel, tr_cate1, tr_cate2, tr_title, tr_content, tr_state, tr_show_gbn, tr_pwd, tr_regDt, tr_uptDt, tr_regId, tr_uptId
                FROM tp.tbl_taxlawcounsel_req
                WHERE 1=1    
                ";

        if ($param['tr_nm'] != "") {
            $where['tr_nm'] = $param['tr_nm'];
        }
        if ($param['tr_tel'] != "") {
            $where['tr_tel'] = $param['tr_tel'];
        }
        if ($param['tr_cate1'] != "") {
            $where['tr_cate1'] = $param['tr_cate1'];
        }
        if ($param['tr_cate2'] != "") {
            $where['tr_cate2'] = $param['tr_cate2'];
        }
        //fn_log($param);

        foreach ($where as $k => $v) {
            if ($k == 'tr_nm') {
                if (!empty($v)) $sql .= " AND " . $k . " like '%" . $v . "%'";
            } elseif($k == 'tr_tel') {
                if (!empty($v)) $sql .= " AND " . $k . " = '" . $this->openssl_mem->aes_encrypt($v) . "'";
            }else {
                if (!empty($v)) $sql .= " AND " . $k . " = '" . $v . "'";
            }
        }
        $sql .= " ORDER BY tr_taxcunselreq_idx DESC";
        $sql .= " LIMIT " . $limit . " OFFSET " . $offset;

        //fn_log($sql);
        $result = $this->commondao->get_query($sql, $where);
        $return['msg'] = 'success';
        $return['data'] = $result;
        return $return;

    }



    public function get_taxlaw_counsel_inf($taxcounsel_num){
        $return = array();

        $sql = "
                    SELECT  rq.tr_taxcunselreq_idx, rq.tr_nm, rq.tr_tel, rq.tr_cate1, rq.tr_cate2, rq.tr_title, rq.tr_content, rq.tr_state, rq.tr_show_gbn, rq.tr_pwd, rq.tr_regDt, rq.tr_uptDt, rq.tr_regId, rq.tr_uptId
                            ,rs.tp_taxcunselrsp_idx, rs.tp_comp, rs.tp_mgr, rs.tp_tel, rs.tp_content, rs.tp_state, rs.tp_regDt
                    FROM tp.tbl_taxlawcounsel_req rq
                      left outer join tbl_taxlawcounsel_rsp rs
                        on rq.tr_taxcunselreq_idx = rs.tr_taxcunselreq_idx
                    where 1=1 
             ";

        if($taxcounsel_num){
            $sql .= " and rq.tr_taxcunselreq_idx = ? ";
            $sql_params['tr_taxcunselreq_idx'] = $taxcounsel_num;
        }

        $result = $this->commondao->get_query($sql, $sql_params);
        $return["msg"] = 'TRUE';
        $return['data'] = $result[0];

        return $return;
    }



    public function set_taxcunselrsp_data($params)
    {
        $params['tr_taxcunselreq_idx'] = trim($params['tr_taxcunselreq_idx']);
        $params['tp_taxcunselrsp_idx'] = trim($params['tp_taxcunselrsp_idx']);
        $params['procgbn'] = trim($params['procgbn']);
        $params['tp_regDt'] = trim($params['tp_regDt']);
        $params['tp_comp'] = trim($params['tp_comp']);
        $params['tp_mgr'] = trim($params['tp_mgr']);
        $params['tp_tel'] = trim($params['tp_tel']);
        $params['tp_content'] = trim($params['tp_content']);
        $params['tp_state'] = trim($params['tp_state']);
        //fn_log($params);

        try {
            $this->db2->trans_begin();

            if ($params['procgbn'] == 'EDT') {
                if ($params['tp_regDt']) {
                    $sql_param['tp_regDt'] = $params['tp_regDt'];
                }
                if ($params['tp_comp']) {
                    $sql_param['tp_comp'] = $params['tp_comp'];
                }
                if ($params['tp_mgr']) {
                    $sql_param['tp_mgr'] = $params['tp_mgr'];
                }
                if ($params['tp_tel']) {
                    $sql_param['tp_tel'] = $params['tp_tel'];
                }
                if ($params['tp_content']) {
                    $sql_param['tp_content'] = $params['tp_content'];
                }
                if ($params['tp_state']) {
                    $sql_param['tp_state'] = $params['tp_state'];
                }
                $sql_param['tp_uptDt'] = YMD_HIS;
                $sql_param['tp_uptId'] = $this->session->userdata('user_id');

                if ($params['tr_taxcunselreq_idx']) {
                    $where['tr_taxcunselreq_idx'] = $params['tr_taxcunselreq_idx'];
                }
                if ($params['tp_taxcunselrsp_idx']) {
                    $where['tp_taxcunselrsp_idx'] = $params['tp_taxcunselrsp_idx'];
                }

                $tblNm = 'tbl_taxlawcounsel_rsp';
                $result = $this->commondao->update_table($tblNm, $sql_param, $where);
            }
            else {     //INS
                if ($params['tp_regDt']) {
                    $sql_param2['tp_regDt'] = $params['tp_regDt'];
                }
                if ($params['tp_comp']) {
                    $sql_param2['tp_comp'] = $params['tp_comp'];
                }
                if ($params['tp_mgr']) {
                    $sql_param2['tp_mgr'] = $params['tp_mgr'];
                }
                if ($params['tp_tel']) {
                    $sql_param2['tp_tel'] = $params['tp_tel'];
                }
                if ($params['tp_content']) {
                    $sql_param2['tp_content'] = $params['tp_content'];
                }
                if ($params['tp_state']) {
                    $sql_param2['tp_state'] = $params['tp_state'];
                }
                $sql_param2['tp_regDt'] = YMD_HIS;
                $sql_param2['tp_regId'] = $this->session->userdata('user_id');
                if ($params['tr_taxcunselreq_idx']) {
                    $sql_param2['tr_taxcunselreq_idx'] = $params['tr_taxcunselreq_idx'];
                }

                $tblNm2 = 'tbl_taxlawcounsel_rsp';
                $result = $this->commondao->insert_table($tblNm2, $sql_param2);
            }

            if ($result == 0) except('데이터 처리에 오류가 있습니다.', true);
            if ($result < 0) except('데이터 처리에 실패하였습니다.', true);

            $return['msg'] = 'TRUE';
            $return['data'] = $result;

            //fn_log('sql_param - '.$sql_param);
            //fn_log('sql_param2 - '.$sql_param2);

            $this->db2->trans_commit();


            if($params['procgbn'] == 'EDT'){
                $this->_save_admin($params['tr_taxcunselreq_idx'].','.$params['tp_taxcunselrsp_idx'], "세무법무상담관리 수정 - " . json_encode($sql_param,JSON_UNESCAPED_UNICODE));
            } else {
                $this->_save_admin($result, "세무법무상담관리 저장 - " . json_encode($sql_param2,JSON_UNESCAPED_UNICODE));
            }


        }catch (Exception $e) {
            if (!empty($e->getCode())) $this->db2->trans_rollback();
            $return['msg'] = 'FALSE';
            $return['data'] = $e->getMessage();
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
