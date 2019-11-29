<?php
defined('BASEPATH') OR exit('No direct script access allowed');
/**
 * @ description : 제휴사 컨트롤
 * @ author : prog106 <prog106@haomun.com>
 * @property hosptlbiz $hosptlbiz

 */
class Hosptl extends CI_Controller {

    // construct
    public function __construct() { // {{{
        parent::__construct();
        $this->load->model('biz/crm/v1/Hosptlbiz', 'hosptlbiz');

    } // }}}


    // 제휴처 리스트
    public function list() {
        $this->__login();
        $data = array();
        $param = array();

        //$params = json_decode(trim(file_post_contents('php://input')), true);
        $param['hb_hosptl_nm'] = $this->input->post('hb_hosptl_nm', true);
        $param['hb_addr'] = $this->input->post('hb_addr', true);
        $param['hb_tel'] = $this->input->post('hb_tel', true);
        $param['hb_state'] = $this->input->post('hb_state', true);

        $page = $this->input->post('per_page');

        //fn_log($params);
        //fn_log($page);

        if(empty($page)) $page = 1;
        $limit = 10;
        $offset = ($page -1) * $limit;

        $count = $this->hosptlbiz->get_hosptl_list_count($param);
        $data['srch_count'] = $count['cnt']['hosptl_srch_count'];
        $data['ttl_count'] = $count['ttl']['hosptl_ttl_count'];


        $list = $this->hosptlbiz->get_hosptl_list($param, $limit, $offset);
        //fn_log($list);
        $data['list'] = $list['data'];

        // 페이지 처리
        $this->load->library('pagination');
        $config["per_page"] = $limit;
        $config['base_url'] = '/crm/hosptl/list/';
        $config['total_rows'] = $data['srch_count'];
        $config['page_query_string'] = TRUE;
        $this->pagination->initialize($config);
        $data['pagination'] = $this->pagination->create_links();
        $data['per_page'] = $page;

        //print_r($count);

        $data['hb_hosptl_nm_param'] = $param['hb_hosptl_nm'];
        $data['hb_addr_param'] = $param['hb_addr'];
        $data['hb_tel_param'] = $param['hb_tel'];
        $data['hb_state_param'] = $param['hb_state'];

        load_admin_view('/crm/hosptl/list', $data);
    }


    public function desc() {
        $this->__login();
        $data=array();

        $data['sdg_sido_list'] = $this->hosptlbiz->get_sdg_sido_list();

        $param['hb_idx'] = $this->uri->segments[4];
        $data['hosptl_base'] = $this->hosptlbiz->get_hosptl_baseInf($param);
        //fn_log('data[\'hosptl_base\'][\'data\'][\'hb_sido\'] - '.$data['hosptl_base']['data']['hb_sido']);
        //print_r($data['hosptl_base']);
        //fn_log($data['hosptl_base']);

        $hb_sido = $data['hosptl_base']['data']['hb_sido'];
        $data['hosptl_gu_list'] = $this->hosptlbiz->get_hosptl_sidoInf($hb_sido);

        load_admin_view('crm/hosptl/desc', $data);
    }


    public function edt() {
        $this->__login();
        $data=array();

        $data['sdg_sido_list'] = $this->hosptlbiz->get_sdg_sido_list();
        $param['hb_idx'] = $this->uri->segments[4];
        $data['hosptl_base'] = $this->hosptlbiz->get_hosptl_baseInf($param);

        $hb_sido = $data['hosptl_base']['data']['hb_sido'];
        $data['hosptl_gu_list'] = $this->hosptlbiz->get_hosptl_sidoInf($hb_sido);


        load_admin_view('crm/hosptl/edt', $data);
    }



    public function set_hosptl_edt(){
        $this->__login();
        $data=array();

        $param['hb_idx'] = $this->input->post('hb_idx', true);
        $param['hb_hosptl_nm'] = $this->input->post('hb_hosptl_nm', true);
        $param['hb_zip_num'] = $this->input->post('hb_zip_num', true);
        $param['hb_addr'] = $this->input->post('hb_addr', true);
        $param['hb_addr_desc'] = $this->input->post('hb_addr_desc', true);

        //$param['hb_sido'] = $this->input->post('hb_sido', true);
        //$param['hb_gu'] = $this->input->post('hb_gu', true);
        $param['hb_sido'] = $this->input->post('sdg_sido_no', true);
        $param['hb_gu'] = $this->input->post('sdg_gu_no', true);

        $param['hb_latitude'] = $this->input->post('hb_latitude', true);
        $param['hb_longtitude'] = $this->input->post('hb_longtitude', true);
        $param['hb_tel'] = $this->input->post('hb_tel', true);
        $param['hb_intro'] = $this->input->post('hb_intro', true);
        $param['hb_img_bak'] = $this->input->post('hb_img_bak', true);
        $param['hb_memo'] = $this->input->post('hb_memo', true);
        $param['hb_mdcalsubjct_cd'] = $this->input->post('hb_mdcalsubjct_cd', true);
        $param['hb_hosptl_gbn'] = $this->input->post('hb_hosptl_gbn', true);
        $param['hb_reserv_gbn'] = $this->input->post('hb_reserv_gbn', true);
        $param['hb_accpt_gbn'] = $this->input->post('hb_accpt_gbn', true);
        $param['hb_estmate_gbn'] = $this->input->post('hb_estmate_gbn', true);
        $param['hb_state'] = $this->input->post('hb_state', true);
        //fn_log($param);

        $uploaded_files = $_FILES;
        if($uploaded_files['document-file']['name'] != '')
        {
            //fn_log($_FILES);
            unset($_FILES);
            $uploaded_file_count = @count($uploaded_files['document-file']['name']);

            //fn_log($uploaded_file_count,"uploaded_file_count");
            //echo 'uploaded_file_count - '.$uploaded_file_count."<br>";

            $upload_config = Array(
                'upload_path' => './uploads/files/',
                'allowed_types' => 'gif|jpg|jpeg|png',
                'max_size' => '10240'
            );

            $this->load->library('upload');
            $this->upload->initialize($upload_config);

            if($uploaded_file_count>1) {
                for ($i = 0; $i < $uploaded_file_count; $i++) {
                    if ($uploaded_files['document-file']['name'][$i] == null) continue;

                    $_FILES['userfile']['name'] = $uploaded_files['document-file']['name'][$i];
                    $_FILES['userfile']['type'] = $uploaded_files['document-file']['type'][$i];
                    $_FILES['userfile']['tmp_name'] = $uploaded_files['document-file']['tmp_name'][$i];
                    $_FILES['userfile']['error'] = $uploaded_files['document-file']['error'][$i];
                    $_FILES['userfile']['size'] = $uploaded_files['document-file']['size'][$i];

                    if (!$this->upload->do_upload()) {
                        echo $this->upload->display_errors();
                    }
                }
            }else{
                $_FILES['userfile']['name'] = $uploaded_files['document-file']['name'];
                $_FILES['userfile']['type'] = $uploaded_files['document-file']['type'];
                $_FILES['userfile']['tmp_name'] = $uploaded_files['document-file']['tmp_name'];
                $_FILES['userfile']['error'] = $uploaded_files['document-file']['error'];
                $_FILES['userfile']['size'] = $uploaded_files['document-file']['size'];

                if (!$this->upload->do_upload()) {
                    echo $this->upload->display_errors();
                }
                else{
                    $data = array('upload_data' => $this->upload->data());
                }
                //fn_log(print_r($data));


                $param['file_ext'] = $data['upload_data']['file_ext'];
                $param['file_name'] = $data['upload_data']['file_name'];
                $param['file_path'] = $data['upload_data']['file_path'];
                $param['image_width'] = $data['upload_data']['image_width'];
                $param['image_height'] = $data['upload_data']['image_height'];

            }
            //fn_log('param[\'file_name\'] - '.$param['file_name'].'<br>');
            //fn_log('param[\'file_path\'] - '.$param['file_path'].'<br>');

            /**/
            $filename = $param['file_name'];
            $source_path = $param['file_path'] . $filename;
            $target_path = $param['file_path'];
            $config_manip = array(
                'image_library' => 'gd2',
                'source_image' => $source_path,
                'new_image' => $target_path,
                'maintain_ratio' => TRUE,
                'create_thumb' => TRUE,
                'thumb_marker' => '_thumb',
                'width' => 100,
                'height' => 100
            );
            $this->load->library('image_lib', $config_manip);
            if (!$this->image_lib->resize()) {
                echo $this->image_lib->display_errors();
            }
            $this->image_lib->clear();

        }

        $data = $this->hosptlbiz->set_hosptl_edt_data($param);
        echo json_encode($data);
    }



    public function reg_hosptl_img(){
        $this->__login();
        $data = array();

        $param['hb_idx'] = $this->input->post('hb_idx', true);
        $param['hi_main_gbn'] = $this->input->post('hi_main_gbn', true);

        $uploaded_files = $_FILES;
        if($uploaded_files['document-file2']['name'] != '')
        {
            //fn_log($_FILES);
            unset($_FILES);
            $uploaded_file_count = @count($uploaded_files['document-file2']['name']);

            fn_log($uploaded_file_count,"uploaded_file_count");
            //echo 'uploaded_file_count - '.$uploaded_file_count."<br>";

            $upload_config = Array(
                'upload_path' => './uploads/files/',
                'allowed_types' => 'gif|jpg|jpeg|png',
                'max_size' => '10240'
            );

            $this->load->library('upload');
            $this->upload->initialize($upload_config);

            if($uploaded_file_count>1) {
                for ($i = 0; $i < $uploaded_file_count; $i++) {
                    if ($uploaded_files['document-file2']['name'][$i] == null) continue;

                    $_FILES['userfile']['name'] = $uploaded_files['document-file2']['name'][$i];
                    $_FILES['userfile']['type'] = $uploaded_files['document-file2']['type'][$i];
                    $_FILES['userfile']['tmp_name'] = $uploaded_files['document-file2']['tmp_name'][$i];
                    $_FILES['userfile']['error'] = $uploaded_files['document-file2']['error'][$i];
                    $_FILES['userfile']['size'] = $uploaded_files['document-file2']['size'][$i];

                    if (!$this->upload->do_upload()) {
                        echo $this->upload->display_errors();
                    }
                }
            }else{
                $_FILES['userfile']['name'] = $uploaded_files['document-file2']['name'];
                $_FILES['userfile']['type'] = $uploaded_files['document-file2']['type'];
                $_FILES['userfile']['tmp_name'] = $uploaded_files['document-file2']['tmp_name'];
                $_FILES['userfile']['error'] = $uploaded_files['document-file2']['error'];
                $_FILES['userfile']['size'] = $uploaded_files['document-file2']['size'];

                if (!$this->upload->do_upload()) {
                    echo $this->upload->display_errors();
                }
                else{
                    $data = array('upload_data2' => $this->upload->data());
                }
                //fn_log(print_r($data));

                $param['file_ext'] = $data['upload_data2']['file_ext'];
                $param['file_name'] = $data['upload_data2']['file_name'];
                $param['file_path'] = $data['upload_data2']['file_path'];
                $param['image_width'] = $data['upload_data2']['image_width'];
                $param['image_height'] = $data['upload_data2']['image_height'];
            }
            //fn_log('param[\'file_name\'] - '.$param['file_name'].'<br>');
            //fn_log('param[\'file_path\'] - '.$param['file_path'].'<br>');

            $filename = $param['file_name'];
            $source_path = $param['file_path'] . $filename;
            $target_path = $param['file_path'];
            $config_manip = array(
                'image_library' => 'gd2',
                'source_image' => $source_path,
                'new_image' => $target_path,
                'maintain_ratio' => TRUE,
                'create_thumb' => TRUE,
                'thumb_marker' => '_thumb',
                'width' => 150,
                'height' => 150
            );
            $this->load->library('image_lib', $config_manip);
            if (!$this->image_lib->resize()) {
                echo $this->image_lib->display_errors();
            }
            $this->image_lib->clear();

        }

        $data = $this->hosptlbiz->reg_hosptl_img_data($param);

        echo json_encode($data);

    }



    public function reg_treatmnt_time()
    {
        $this->__login();
        $data = array();

        $param = json_decode(trim(file_get_contents('php://input')), true);
        /*
        $param['hb_idx'] = $this->input->post('hb_idx', true);
        $param['mt_days'] = $this->input->post('mt_days', true);
        $param['gbn'] = $this->input->post('gbn', true);  //weekday, weekdnd, lunchtime
        $param['mt_begin_hour'] = $this->input->post('mt_begin_hour', true);
        $param['mt_bigin_minute'] = $this->input->post('mt_bigin_minute', true);
        $param['mt_end_hour'] = $this->input->post('mt_end_hour', true);
        $param['mt_end_minute'] = $this->input->post('mt_end_minute', true);
        $param['mt_dayoff_gbn'] = $this->input->post('mt_dayoff_gbn', true);
        */
        //print_r($param);

        $data = $this->hosptlbiz->reg_treatmnt_time_data($param);

        echo json_encode($data);
    }


    public function treatmnt_time_list(){
        $this->__login();
        $params = json_decode(trim(file_get_contents('php://input')), true);

        $params['hb_idx'] = trim($params['hb_idx']);
        $data = $this->hosptlbiz->get_treatmnt_time_list_data($params);

        echo json_encode($data);
    }


    public function set_treatmnt_time(){
        $this->__login();
        $params = json_decode(trim(file_get_contents('php://input')), true);

        $params['procgbn'] = trim($params['procgbn']);
        $params['mt_idx'] = trim($params['mt_idx']);
        $params['hb_idx'] = trim($params['hb_idx']);

        $data = $this->hosptlbiz->set_treatmnt_time_data($params);

        echo json_encode($data);
    }


    public function hosptl_img_list(){
        $this->__login();
        $params = json_decode(trim(file_get_contents('php://input')), true);

        $params['hb_idx'] = trim($params['hb_idx']);
        $data = $this->hosptlbiz->get_hosptl_img_list_data($params);

        echo json_encode($data);
    }



    public function set_hosptl_img()
    {
        $this->__login();
        $params = json_decode(trim(file_get_contents('php://input')), true);

        $params['procgbn'] = trim($params['procgbn']);
        $params['hi_idx'] = trim($params['hi_idx']);
        $params['hb_idx'] = trim($params['hb_idx']);

        $data = $this->hosptlbiz->set_hosptl_img_data($params);
        echo json_encode($data);
    }


    public function mdcalsubjct_popup_list(){
        $this->__login();
        $params = json_decode(trim(file_get_contents('php://input')), true);

        $data = $this->hosptlbiz->mdcalsubjct_popup_list_data();
        echo json_encode($data);
    }


    public function profield_popup_list(){
        $this->__login();
        $params = json_decode(trim(file_get_contents('php://input')), true);

        $data = $this->hosptlbiz->profield_popup_list_data();
        echo json_encode($data);
    }



    public function theme_popup_list(){
        $this->__login();
        $params = json_decode(trim(file_get_contents('php://input')), true);

        $data = $this->hosptlbiz->ptheme_popup_list_data();
        echo json_encode($data);
    }



    public function reg_main_doctr(){
        $this->__login();
        $data = array();

        $param['hb_idx'] = $this->input->post('hb_idx', true);
        $param['md_dctr_nm'] = $this->input->post('md_dctr_nm', true);
        $param['md_mdcalsubjct_nm'] = $this->input->post('md_mdcalsubjct_nm', true);
        $param['md_mdcalsubjct_cd'] = $this->input->post('md_mdcalsubjct_cd', true);
        $param['md_profield_nm'] = $this->input->post('md_profield_nm', true);
        $param['md_profield_cd'] = $this->input->post('md_profield_cd', true);

        $uploaded_files = $_FILES;
        if($uploaded_files['document-file3']['name'] != '')
        {
            //fn_log($_FILES);
            unset($_FILES);
            $uploaded_file_count = @count($uploaded_files['document-file3']['name']);

            fn_log($uploaded_file_count,"uploaded_file_count");
            //echo 'uploaded_file_count - '.$uploaded_file_count."<br>";

            $upload_config = Array(
                'upload_path' => './uploads/files/',
                'allowed_types' => 'gif|jpg|jpeg|png',
                'max_size' => '10240'
            );

            $this->load->library('upload');
            $this->upload->initialize($upload_config);

            if($uploaded_file_count>1) {
                for ($i = 0; $i < $uploaded_file_count; $i++) {
                    if ($uploaded_files['document-file3']['name'][$i] == null) continue;

                    $_FILES['userfile']['name'] = $uploaded_files['document-file3']['name'][$i];
                    $_FILES['userfile']['type'] = $uploaded_files['document-file3']['type'][$i];
                    $_FILES['userfile']['tmp_name'] = $uploaded_files['document-file3']['tmp_name'][$i];
                    $_FILES['userfile']['error'] = $uploaded_files['document-file3']['error'][$i];
                    $_FILES['userfile']['size'] = $uploaded_files['document-file3']['size'][$i];

                    if (!$this->upload->do_upload()) {
                        echo $this->upload->display_errors();
                    }
                }
            }else{
                $_FILES['userfile']['name'] = $uploaded_files['document-file3']['name'];
                $_FILES['userfile']['type'] = $uploaded_files['document-file3']['type'];
                $_FILES['userfile']['tmp_name'] = $uploaded_files['document-file3']['tmp_name'];
                $_FILES['userfile']['error'] = $uploaded_files['document-file3']['error'];
                $_FILES['userfile']['size'] = $uploaded_files['document-file3']['size'];

                if (!$this->upload->do_upload()) {
                    echo $this->upload->display_errors();
                }
                else{
                    $data = array('upload_data2' => $this->upload->data());
                }
                //fn_log(print_r($data));

                $param['file_ext'] = $data['upload_data2']['file_ext'];
                $param['file_name'] = $data['upload_data2']['file_name'];
                $param['file_path'] = $data['upload_data2']['file_path'];
                $param['image_width'] = $data['upload_data2']['image_width'];
                $param['image_height'] = $data['upload_data2']['image_height'];
            }
            //fn_log('param[\'file_name\'] - '.$param['file_name'].'<br>');
            //fn_log('param[\'file_path\'] - '.$param['file_path'].'<br>');

            $filename = $param['file_name'];
            $source_path = $param['file_path'] . $filename;
            $target_path = $param['file_path'];
            $config_manip = array(
                'image_library' => 'gd2',
                'source_image' => $source_path,
                'new_image' => $target_path,
                'maintain_ratio' => TRUE,
                'create_thumb' => TRUE,
                'thumb_marker' => '_thumb',
                'width' => 150,
                'height' => 150
            );
            $this->load->library('image_lib', $config_manip);
            if (!$this->image_lib->resize()) {
                echo $this->image_lib->display_errors();
            }
            $this->image_lib->clear();

        }

        $data = $this->hosptlbiz->reg_main_doctr_data($param);

        echo json_encode($data);
    }




    public function main_doctr_list(){
        $this->__login();
        $params = json_decode(trim(file_get_contents('php://input')), true);

        $data = $this->hosptlbiz->main_doctr_list_data($params);

        echo json_encode($data);
    }




    public function set_main_doctr(){
        $this->__login();
        $data=array();

        $param['hb_idx'] = $this->input->post('hb_idx', true);
        $param['md_idx'] = $this->input->post('md_idx', true);
        $param['procgbn'] = $this->input->post('procgbn', true);
        $param['md_dctr_nm'] = $this->input->post('md_dctr_nm_'.$param['md_idx'], true);
        $param['md_mdcalsubjct_nm'] = $this->input->post('md_mdcalsubjct_nm_'.$param['md_idx'], true);
        $param['md_mdcalsubjct_cd'] = $this->input->post('md_mdcalsubjct_cd_'.$param['md_idx'], true);
        $param['md_profield_nm'] = $this->input->post('md_profield_nm_'.$param['md_idx'], true);
        $param['md_profield_cd'] = $this->input->post('md_profield_cd_'.$param['md_idx'], true);

        //print_r($param);
        //print_r($this->input->post('md_profield_cd_'.$param['md_idx'], true));

        $uploaded_files = $_FILES;
        if($uploaded_files['document-file_'.$param['md_idx']]['name'] != '')
        {
            //fn_log($_FILES);
            unset($_FILES);
            $uploaded_file_count = @count($uploaded_files['document-file_'.$param['md_idx']]['name']);

            //fn_log($uploaded_file_count,"uploaded_file_count");
            //echo 'uploaded_file_count - '.$uploaded_file_count."<br>";

            $upload_config = Array(
                'upload_path' => './uploads/files/',
                'allowed_types' => 'gif|jpg|jpeg|png',
                'max_size' => '10240'
            );

            $this->load->library('upload');
            $this->upload->initialize($upload_config);

            if($uploaded_file_count>1) {
                for ($i = 0; $i < $uploaded_file_count; $i++) {
                    if ($uploaded_files['document-file_'.$param['md_idx']]['name'][$i] == null) continue;

                    $_FILES['userfile']['name'] = $uploaded_files['document-file_'.$param['md_idx']]['name'][$i];
                    $_FILES['userfile']['type'] = $uploaded_files['document-file_'.$param['md_idx']]['type'][$i];
                    $_FILES['userfile']['tmp_name'] = $uploaded_files['document-file_'.$param['md_idx']]['tmp_name'][$i];
                    $_FILES['userfile']['error'] = $uploaded_files['document-file_'.$param['md_idx']]['error'][$i];
                    $_FILES['userfile']['size'] = $uploaded_files['document-file_'.$param['md_idx']]['size'][$i];

                    if (!$this->upload->do_upload()) {
                        echo $this->upload->display_errors();
                    }
                }
            }else{
                $_FILES['userfile']['name'] = $uploaded_files['document-file_'.$param['md_idx']]['name'];
                $_FILES['userfile']['type'] = $uploaded_files['document-file_'.$param['md_idx']]['type'];
                $_FILES['userfile']['tmp_name'] = $uploaded_files['document-file_'.$param['md_idx']]['tmp_name'];
                $_FILES['userfile']['error'] = $uploaded_files['document-file_'.$param['md_idx']]['error'];
                $_FILES['userfile']['size'] = $uploaded_files['document-file_'.$param['md_idx']]['size'];

                if (!$this->upload->do_upload()) {
                    echo $this->upload->display_errors();
                }
                else{
                    $data = array('upload_data' => $this->upload->data());
                }
                //fn_log(print_r($data));


                $param['file_ext'] = $data['upload_data']['file_ext'];
                $param['file_name'] = $data['upload_data']['file_name'];
                $param['file_path'] = $data['upload_data']['file_path'];
                $param['image_width'] = $data['upload_data']['image_width'];
                $param['image_height'] = $data['upload_data']['image_height'];

            }

            $filename = $param['file_name'];
            $source_path = $param['file_path'] . $filename;
            $target_path = $param['file_path'];
            $config_manip = array(
                'image_library' => 'gd2',
                'source_image' => $source_path,
                'new_image' => $target_path,
                'maintain_ratio' => TRUE,
                'create_thumb' => TRUE,
                'thumb_marker' => '_thumb',
                'width' => 100,
                'height' => 100
            );
            $this->load->library('image_lib', $config_manip);
            if (!$this->image_lib->resize()) {
                echo $this->image_lib->display_errors();
            }
            $this->image_lib->clear();

        }

        $data = $this->hosptlbiz->set_main_doctr_data($param);
        echo json_encode($data);
    }



    public function reg_hosptl_medcalsubjct(){
        $this->__login();
        $data = array();

        $params = json_decode(trim(file_get_contents('php://input')), true);
        $params['hb_mdcalsubjct_cd'] = trim($params['hb_mdcalsubjct_cd']);
        $params['hb_idx'] = trim($params['hb_idx']);

        $data = $this->hosptlbiz->reg_hosptl_medcalsubjct_data($params);

        echo json_encode($data);
    }



    public function get_hosptl_medcalsubjct_list(){
        $this->__login();
        //$data = array();

        $params = json_decode(trim(file_get_contents('php://input')), true);
        $params['hb_idx'] = trim($params['hb_idx']);

        $data = $this->hosptlbiz->get_hosptl_medcalsubjct_list_data($params);

        echo json_encode($data);
    }



    public function del_hosptl_medcalsubjct(){
        $this->__login();

        $params = json_decode(trim(file_get_contents('php://input')), true);
        $params['hb_idx'] = trim($params['hb_idx']);

        $data = $this->hosptlbiz->del_hosptl_medcalsubjct_data($params);

        echo json_encode($data);
    }




    public function reg_hosptl_profield(){
        $this->__login();
        $data = array();

        $params = json_decode(trim(file_get_contents('php://input')), true);
        $params['hb_mdcalsubjct_cd'] = trim($params['hb_mdcalsubjct_cd']);
        $params['hb_idx'] = trim($params['hb_idx']);

        $data = $this->hosptlbiz->reg_hosptl_profield_data($params);

        echo json_encode($data);
    }



    public function get_hosptl_profield_list(){
        $this->__login();
        //$data = array();

        $params = json_decode(trim(file_get_contents('php://input')), true);
        $params['hb_idx'] = trim($params['hb_idx']);

        $data = $this->hosptlbiz->get_hosptl_profield_list_data($params);

        echo json_encode($data);
    }



    public function del_hosptl_profield(){
        $this->__login();

        $params = json_decode(trim(file_get_contents('php://input')), true);
        $params['hb_idx'] = trim($params['hb_idx']);

        $data = $this->hosptlbiz->del_hosptl_profield_data($params);

        echo json_encode($data);
    }



    public function reg_hosptl_theme(){
        $this->__login();
        $data = array();

        $params = json_decode(trim(file_get_contents('php://input')), true);
        $params['hb_theme_cd'] = trim($params['hb_theme_cd']);
        $params['hb_idx'] = trim($params['hb_idx']);

        $data = $this->hosptlbiz->reg_hosptl_theme_data($params);

        echo json_encode($data);
    }



    public function get_hosptl_theme_list(){
        $this->__login();
        //$data = array();

        $params = json_decode(trim(file_get_contents('php://input')), true);
        $params['hb_idx'] = trim($params['hb_idx']);

        $data = $this->hosptlbiz->get_hosptl_theme_list_data($params);

        echo json_encode($data);
    }



    public function del_hosptl_theme(){
        $this->__login();

        $params = json_decode(trim(file_get_contents('php://input')), true);
        $params['hb_idx'] = trim($params['hb_idx']);

        $data = $this->hosptlbiz->del_hosptl_theme_data($params);

        echo json_encode($data);
    }



    public function reg() {
        $this->__login();
        $data=array();

        $data['sdg_sido_list'] = $this->hosptlbiz->get_sdg_sido_list();

        $param['hb_idx'] = $this->uri->segments[4];
        //$data['hosptl_base'] = $this->hosptlbiz->get_hosptl_baseInf($param);

        $hb_sido = $data['hosptl_base']['data']['hb_sido'];
        $data['hosptl_gu_list'] = $this->hosptlbiz->get_hosptl_sidoInf($hb_sido);

        load_admin_view('crm/hosptl/reg', $data);
    }



    public function set_hosptl_reg(){
        $this->__login();
        $data=array();

        $param['hb_idx'] = $this->input->post('hb_idx', true);
        $param['hb_hosptl_nm'] = $this->input->post('hb_hosptl_nm', true);
        $param['hb_zip_num'] = $this->input->post('hb_zip_num', true);
        $param['hb_addr'] = $this->input->post('hb_addr', true);
        $param['hb_addr_desc'] = $this->input->post('hb_addr_desc', true);

        //$param['hb_sido'] = $this->input->post('hb_sido', true);
        //$param['hb_gu'] = $this->input->post('hb_gu', true);
        $param['hb_sido'] = $this->input->post('sdg_sido_no', true);
        $param['hb_gu'] = $this->input->post('sdg_gu_no', true);

        $param['hb_latitude'] = $this->input->post('hb_latitude', true);
        $param['hb_longtitude'] = $this->input->post('hb_longtitude', true);
        $param['hb_tel'] = $this->input->post('hb_tel', true);
        $param['hb_intro'] = $this->input->post('hb_intro', true);
        $param['hb_img_bak'] = $this->input->post('hb_img_bak', true);
        $param['hb_memo'] = $this->input->post('hb_memo', true);
        $param['hb_mdcalsubjct_cd'] = $this->input->post('hb_mdcalsubjct_cd', true);
        $param['hb_hosptl_gbn'] = $this->input->post('hb_hosptl_gbn', true);
        $param['hb_reserv_gbn'] = $this->input->post('hb_reserv_gbn', true);
        $param['hb_accpt_gbn'] = $this->input->post('hb_accpt_gbn', true);
        $param['hb_estmate_gbn'] = $this->input->post('hb_estmate_gbn', true);
        $param['hb_state'] = $this->input->post('hb_state', true);
        //fn_log($param);

        $uploaded_files = $_FILES;
        if($uploaded_files['document-file']['name'] != '')
        {
            //fn_log($_FILES);
            unset($_FILES);
            $uploaded_file_count = @count($uploaded_files['document-file']['name']);

            //fn_log($uploaded_file_count,"uploaded_file_count");
            //echo 'uploaded_file_count - '.$uploaded_file_count."<br>";

            $upload_config = Array(
                'upload_path' => './uploads/files/',
                'allowed_types' => 'gif|jpg|jpeg|png',
                'max_size' => '10240'
            );

            $this->load->library('upload');
            $this->upload->initialize($upload_config);

            if($uploaded_file_count>1) {
                for ($i = 0; $i < $uploaded_file_count; $i++) {
                    if ($uploaded_files['document-file']['name'][$i] == null) continue;

                    $_FILES['userfile']['name'] = $uploaded_files['document-file']['name'][$i];
                    $_FILES['userfile']['type'] = $uploaded_files['document-file']['type'][$i];
                    $_FILES['userfile']['tmp_name'] = $uploaded_files['document-file']['tmp_name'][$i];
                    $_FILES['userfile']['error'] = $uploaded_files['document-file']['error'][$i];
                    $_FILES['userfile']['size'] = $uploaded_files['document-file']['size'][$i];

                    if (!$this->upload->do_upload()) {
                        echo $this->upload->display_errors();
                    }
                }
            }else{
                $_FILES['userfile']['name'] = $uploaded_files['document-file']['name'];
                $_FILES['userfile']['type'] = $uploaded_files['document-file']['type'];
                $_FILES['userfile']['tmp_name'] = $uploaded_files['document-file']['tmp_name'];
                $_FILES['userfile']['error'] = $uploaded_files['document-file']['error'];
                $_FILES['userfile']['size'] = $uploaded_files['document-file']['size'];

                if (!$this->upload->do_upload()) {
                    echo $this->upload->display_errors();
                }
                else{
                    $data = array('upload_data' => $this->upload->data());
                }
                //fn_log(print_r($data));


                $param['file_ext'] = $data['upload_data']['file_ext'];
                $param['file_name'] = $data['upload_data']['file_name'];
                $param['file_path'] = $data['upload_data']['file_path'];
                $param['image_width'] = $data['upload_data']['image_width'];
                $param['image_height'] = $data['upload_data']['image_height'];

            }
            //fn_log('param[\'file_name\'] - '.$param['file_name'].'<br>');
            //fn_log('param[\'file_path\'] - '.$param['file_path'].'<br>');

            /**/
            $filename = $param['file_name'];
            $source_path = $param['file_path'] . $filename;
            $target_path = $param['file_path'];
            $config_manip = array(
                'image_library' => 'gd2',
                'source_image' => $source_path,
                'new_image' => $target_path,
                'maintain_ratio' => TRUE,
                'create_thumb' => TRUE,
                'thumb_marker' => '_thumb',
                'width' => 100,
                'height' => 100
            );
            $this->load->library('image_lib', $config_manip);
            if (!$this->image_lib->resize()) {
                echo $this->image_lib->display_errors();
            }
            $this->image_lib->clear();

        }

        $data = $this->hosptlbiz->set_hosptl_reg_data($param);
        echo json_encode($data);
    }


























































    public function get_gu_list(){
        $this->__login();
        $params = json_decode(trim(file_get_contents('php://input')), true);
        $params['sdg_sido_no'] = trim($params['sdg_sido_no']);
        //fn_log('sdg_sido_no[\'sdg_sido_no\'] - '.$params['sdg_sido_no']);

        $data = $this->hosptlbiz->get_gu_list_data($params);
        //fn_log('get_gu_list_data - '.$data);
        //print_r($data);

        echo json_encode($data);
    }





// 로그인 여부 체크
    private function __login() { // {{{
        if(defined('USER_ID')&&$this->session->userdata('auth_flag')=="N"){
            redirect('/crm/login', 'refresh');
            die;
        }elseif(defined('USER_ID')&&$this->session->userdata('first')=="Y"){
            redirect('/crm/login', 'refresh');
            die;
        }elseif(!defined('USER_ID')) {
            redirect('/crm/login', 'refresh');
            die;
        }
    } // }}}




































    public function apiresult(){
        $params = json_decode(trim(file_get_contents('php://input')), true);

        return $params ;

    }


    public function apireq()
    {
        $data = array(); // 새로운 배열
        $data['from'] = trim('SDFSDFF');
        $data['to'] = trim('SDFSDFSDF');
        $data = json_encode($data); // $data 배열을 json 형식으로 변환


        $token = "LrMgyJaOG8spYK2PbRoqsdZvlcXSxWe95awF1a";
        $headers = array('Content-Type: application/json',"Auth-Key: $token");

        $curl_url = "http://api.medicalplan.me/crm/hosptl/apiresult";

        $curl = curl_init($curl_url);
        curl_setopt($curl,CURLOPT_USERAGENT,'Mozilla/5.0 (compatible; with PHP');
        curl_setopt($curl, CURLOPT_HEADER, 0);
        curl_setopt($curl, CURLOPT_ENCODING, '');
        curl_setopt($curl, CURLOPT_CUSTOMREQUEST, 'PATCH'); // 보통 쓰지 않지만 특별히 제공측에서 원하는 경우 타입을 써줌.
        curl_setopt($curl, CURLOPT_HTTPHEADER, $headers);
        curl_setopt($curl, CURLOPT_POSTFIELDS, $data);
        curl_setopt($curl, CURLOPT_FOLLOWLOCATION, 1);
        curl_setopt($curl,CURLOPT_RETURNTRANSFER,1);
        curl_setopt($curl,CURLOPT_NOSIGNAL,1);
        curl_setopt($curl, CURLOPT_SSL_VERIFYPEER, false);

        //print_r($curl);

        $result = curl_exec($curl);
        $result = json_decode($result, true); // json 형식으로 가져온 값을 배열로 변환
        print_r($result);
    }



    public function phpinfo(){

        echo phpinfo();
    }




















}
?>
