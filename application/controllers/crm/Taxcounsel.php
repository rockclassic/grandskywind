<?php
defined('BASEPATH') OR exit('No direct script access allowed');
/**
 * @ description : 세무상담관리 컨트롤
 * @ author : prog106 <prog106@haomun.com>
 * @property Mdl_mbroffice $mdl_mbroffice

 */
class Taxcounsel extends CI_Controller {

    // construct
    public function __construct() { 
        parent::__construct();
        $this->load->model('biz/crm/v1/Taxcounselbiz', 'taxcounselbiz');

    }


    // 제휴처 리스트
    public function list() {
        $data = array();
        $param = array();

        //$params = json_decode(trim(file_get_contents('php://input')), true);
        $param['tr_nm'] = $this->input->post('tr_nm', true);
        $param['tr_tel'] = $this->input->post('tr_tel', true);
        $param['tr_cate1'] = $this->input->post('tr_cate1', true);
        $param['tr_cate2'] = $this->input->post('tr_cate2', true);

        $page = $this->input->get('per_page');

        //fn_log($params);
        //fn_log($page);

        if(empty($page)) $page = 1;
        $limit = 10;
        $offset = ($page -1) * $limit;

        $count = $this->taxcounselbiz->get_taxcounselList_count($param);
        $data['srch_count'] = $count['cnt']['taxcounsel_count'];
        $data['ttl_count'] = $count['ttl']['taxcounsel_ttl_count'];


        $list = $this->taxcounselbiz->get_taxcounsel_list($param, $limit, $offset);
        $data['list'] = $list['data'];

        // 페이지 처리
        $this->load->library('pagination');
        $config["per_page"] = $limit;
        $config['base_url'] = '/crm/taxcounsel/list/';
        $config['total_rows'] = $data['srch_count'];
        $config['page_query_string'] = TRUE;
        $this->pagination->initialize($config);
        $data['pagination'] = $this->pagination->create_links();
        $data['per_page'] = $page;

        //print_r($count);

        $data['srch_param'] = $param;
        $data['ob_officeNm_param'] = $param['ob_officeNm'];
        $data['ob_addr_param'] = $param['ob_addr'];
        $data['ob_tel_param'] = $param['ob_tel'];
        $data['ob_state_param'] = $param['ob_state'];


        load_admin_view('/crm/taxcounsel/list', $data);
    }



    public function desc() {
         $data=array();

        $param['taxcounsel_num'] = $this->uri->segments[4];
        $data['taxlaw_counsel_inf'] = $this->taxcounselbiz->get_taxlaw_counsel_inf($param['taxcounsel_num']);


        load_admin_view('crm/taxcounsel/desc', $data);
    }



    public function set_taxcunselrsp()
    {
        $tr_taxcunselreq_idx = $this->input->post('tr_taxcunselreq_idx', true);
        $tp_taxcunselrsp_idx = $this->input->post('tp_taxcunselrsp_idx', true);
        $procgbn = $this->input->post('procgbn', true);
        $tp_regDt = $this->input->post('tp_regDt', true);
        $tp_comp = $this->input->post('tp_comp', true);
        $tp_mgr = $this->input->post('tp_mgr', true);
        $tp_tel = $this->input->post('tp_tel', true);
        $tp_content = $this->input->post('tp_content', true);
        $tp_state = $this->input->post('tp_state', true);

        $params['tr_taxcunselreq_idx'] = $tr_taxcunselreq_idx;
        $params['tp_taxcunselrsp_idx'] = $tp_taxcunselrsp_idx;
        $params['procgbn'] = $procgbn;
        $params['tp_regDt'] = $tp_regDt;
        $params['tp_comp'] = $tp_comp;
        $params['tp_mgr'] = $tp_mgr;
        $params['tp_tel'] = $tp_tel;
        $params['tp_content'] = $tp_content;
        $params['tp_state'] = $tp_state;
        //fn_log($params);

        $result = $this->taxcounselbiz->set_taxcunselrsp_data($params);
        fn_log($result);

        echo json_encode($result);

    }










}
?>
