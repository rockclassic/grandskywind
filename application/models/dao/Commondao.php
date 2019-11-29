<?php
/**
 * @ description : Common Dao
 * @ author : jeromc
 */
class Commondao extends CI_Model {

    public function __construct() { // {{{
        parent::__construct();
    } // }}}

    // 저장하기
    public function insert_table($table, $sql_param) { // {{{
        $this->db2 = $this->load->database('insertdb', TRUE);
        $this->db2->set($sql_param);
        $this->db2->insert($table);
//        fn_log($this->db2->last_query(),'insert_table');
        $return = $this->db2->insert_id();
        $this->db2->close();
        return $return;
    } // }}}

    // batch 저장하기
    public function insert_batch_table($table, $sql_param) { // {{{
        $this->db2 = $this->load->database('insertdb', TRUE);
        $this->db2->insert_batch($table, $sql_param);
//        fn_log($this->db2->last_query(),'insert_batch_table');
        $return = true;
        $this->db2->close();
        return $return;
    } // }}}

    // 업데이트
    public function update_table($table, $sql_param, $where) { // {{{
        $this->db2 = $this->load->database('insertdb', TRUE);
        $this->db2->set($sql_param);
        $this->db2->where($where);
        $this->db2->update($table);
//        fn_log($this->db2->last_query(),'update_table');
        $return = $this->db2->affected_rows();
        $this->db2->close();
        return $return;
    } // }}}

    // query + parameter insert query
    public function insert_query($sql, $param) { // {{{
        $this->db2 = $this->load->database('insertdb', TRUE);
        $this->db2->query($sql, $param);
//        fn_log($this->db2->last_query(),'insert_query1');
        $return = $this->db2->insert_id();
        $this->db2->close();
        return $return;
    } // }}}

    // query + parameter update query
    public function update_query($sql, $param) { // {{{
        $this->db2 = $this->load->database('insertdb', TRUE);
        $this->db2->query($sql, $param);
//        fn_log($this->db2->last_query(),'update_query1');
        $return = $this->db2->affected_rows();
        $this->db2->close();
        return $return;
    } // }}}

    // 삭제
    public function delete_table($table, $where) { // {{{
        $this->db2 = $this->load->database('insertdb', TRUE);
        $this->db2->delete($table, $where);
//        fn_log($this->db2->last_query(),'delete_table');
        $return = $this->db2->affected_rows();
        $this->db2->close();
        return $return;
    } // }}}

    // 가져오기
    public function get_table($table, $where,$order=null) { // {{{
        $this->load->database();
        $this->db->where($where);
        if($order) $this->db->order_by($order);
        $result = $this->db->get($table);
//        fn_log($this->db->last_query(),'get_table1');
        return $result->result_array();
    } // }}}

    // query + parameter
    public function get_query($sql, $param) { // {{{
        $this->load->database();
        $result = $this->db->query($sql, $param);
//        fn_log($this->db->last_query(),'get_query1');
        return $result->result_array();
    } // }}}





}
