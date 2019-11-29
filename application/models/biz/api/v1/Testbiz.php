<?php
/**
 * @ description : Test model
 * @ author : jeromc
 * @property Commondao $commondao
 * @property Openssl_mem $openssl_mem
 */
class Testbiz extends CI_Model {

    public function __construct() { // {{{
        parent::__construct();
        $this->load->model('dao/Commondao','commondao');
    } // }}}


    public function set_value($sql_param) { // {{{
        $return = array();
        try {
            $this->db->trans_begin();
            $result = $this->commondao->insert_table('testdb', $sql_param);
            if($result == 0) except('데이터 저장에 오류가 있습니다.', true);
            if($result < 0) except('데이터 저장에 실패하였습니다.', true);
            $return['msg'] = 'success';
            $return['data'] = $result;
            $this->db->trans_commit();
        } catch (Exception $e) {
            if(!empty($e->getCode())) $this->db->trans_rollback();
            $return['msg'] = 'error';
            $return['data'] = $e->getMessage();
        }
        return $return;
    } // }}}

    public function set_value_query($sql_param) { // {{{
        $return = array();
        $param = array();
        try {
            $this->db->trans_begin();
            $sql="INSERT INTO testdb (`key`, `value`) VALUES (?, ?)";
            $param=array($sql_param['key'],$sql_param['value']);

            $result = $this->commondao-> insert_query($sql, $param);;
            if($result == 0) except('데이터 저장에 오류가 있습니다.', true);
            if($result < 0) except('데이터 저장에 실패하였습니다.', true);
            $return['msg'] = 'success';
            $return['data'] = $result;
            $this->db->trans_commit();
        } catch (Exception $e) {
            if(!empty($e->getCode())) $this->db->trans_rollback();
            $return['msg'] = 'error';
            $return['data'] = $e->getMessage();
        }
        return $return;
    } // }}}


    public function update_value($sql_param,$where) { // {{{
        $return = array();
        try {
            $this->db->trans_begin();
            $result = $this->commondao->update_table('testdb', $sql_param, $where);

            if($result == 0) except('데이터 저장에 오류가 있습니다.', true);
            if($result < 0) except('데이터 저장에 실패하였습니다.', true);
            $return['msg'] = 'success';
            $return['data'] = $result;
            $this->db->trans_commit();
        } catch (Exception $e) {
            if(!empty($e->getCode())) $this->db->trans_rollback();
            $return['msg'] = 'error';
            $return['data'] = $e->getMessage();
        }
        return $return;
    } // }}}

    public function update_value_query($sql_param,$where) { // {{{
        $return = array();
        try {
            $this->db->trans_begin();
            $sql="UPDATE testdb SET `key` = ?, `value` = ? where idx=?";
            $param=array($sql_param['key'],$sql_param['value'],$where);
            $result = $this->commondao->update_query($sql, $param);

            if($result == 0) except('데이터 저장에 오류가 있습니다.', true);
            if($result < 0) except('데이터 저장에 실패하였습니다.', true);
            $return['msg'] = 'success';
            $return['data'] = $result;
            $this->db->trans_commit();
        } catch (Exception $e) {
            if(!empty($e->getCode())) $this->db->trans_rollback();
            $return['msg'] = 'error';
            $return['data'] = $e->getMessage();
        }
        return $return;
    } // }}}

    public function get_value($idx){//{{{

        $return = array();
        $where = array();

        if($where['idx'])$where['idx']=$idx;
        $result = $this->commondao->get_table('testdb', $where);
        $return['msg'] = 'success';
        $return['data'] = $result;
        return $return;
    }// }}}

    public function get_value_query($idx) { // {{{
        $return = array();
        $where = array();

        $sql = "SELECT
                    *
                FROM testdb
                WHERE idx = ?
                ORDER BY idx DESC
                LIMIT 50;
        ";
        $where['idx']=$idx;

        fn_log($where);
        $result = $this->commondao->get_query($sql, $where);
        $return['msg'] = 'success';
        $return['data'] = $result;
        return $return;
    } // }}}


    // 시도주소 가져오는 쿼리 by.jeromc 2018-11-01
    public function set_addr($in){
        return $this->commondao->insert_table('tbl_sidogu', $in);

    }
}
