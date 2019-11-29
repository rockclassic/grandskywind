<?php
defined('BASEPATH') OR exit('No direct script access allowed');

/**
 * Editorfileupload class
 *
 * Copyright (c) CIBoard <www.ciboard.co.kr>
 *
 * @author CIBoard (develop@ciboard.co.kr)
 */

/**
 * 에디터를 통해 파일을 업로드하는 controller 입니다.
 */

class Editorfileupload extends CI_Controller//CB_Controller
{

    /**
     * 모델을 로딩합니다
     */
    protected $models = array('Editor_image');

    /**
     * 헬퍼를 로딩합니다
     */
    protected $helpers = array('array','url');

    function __construct()
    {
        parent::__construct();
        $this->load->library('upload');
    }


    /**
     * 스마트 에디터를 통해 이미지를 업로드하는 컨트롤러입니다.
     */
    public function smarteditor()
    {
        // 이벤트 라이브러리를 로딩합니다
       // $eventname = 'event_editorfileupload_smarteditor';
        //$this->load->event($eventname);

        // 이벤트가 존재하면 실행합니다
        //Events::trigger('before', $eventname);

        $this->_init();
        $upload_path='uploads/editor/' . date('Y') . '/' . date('m') . '/';
	
        if (isset($_FILES)
            && isset($_FILES['files'])
            && isset($_FILES['files']['name'])
            && isset($_FILES['files']['name'][0])) {

            $uploadconfig = array(
                'upload_path' => $upload_path,
                'allowed_types' => 'jpg|jpeg|png|gif',
                'max_size' => 10 * 1024,
                'encrypt_name' => true,
            );

            $this->upload->initialize($uploadconfig);
            $_FILES['userfile']['name'] = $_FILES['files']['name'][0];
            $_FILES['userfile']['type'] = $_FILES['files']['type'][0];
            $_FILES['userfile']['tmp_name'] = $_FILES['files']['tmp_name'][0];
            $_FILES['userfile']['error'] = $_FILES['files']['error'][0];
            $_FILES['userfile']['size'] = $_FILES['files']['size'][0];


            if ($this->upload->do_upload()) {
                $filedata = $this->upload->data();
                $image_url = site_url('uploads' . '/editor/' . date('Y') . '/' . date('m') . '/' .  $filedata['file_name']);
                $info = new stdClass();
                $info->oriname = $filedata['orig_name'];
                $info->name = $filedata['orig_name'];//element('file_name', $filedata);
                $info->size = intval($filedata['file_size'] * 1024);
                $info->type = 'image/' . str_replace('.', '', $filedata['file_ext']);
                $info->url = $image_url;
                $info->width = $filedata['image_width']
                    ? $filedata['image_width'] : 0;
                $info->height = $filedata['image_height']
                    ? $filedata['image_height'] : 0;

                $return['files'][0] = $info;
                exit(json_encode($return));

            } else {
                exit($this->upload->display_errors());
            }
        }
    }


    /**
     * CK 에디터를 통해 이미지를 업로드하는 컨트롤러입니다.
     */
    public function ckeditor()
    {
        // 이벤트 라이브러리를 로딩합니다
        $eventname = 'event_editorfileupload_ckeditor';
        $this->load->event($eventname);

        // 이벤트가 존재하면 실행합니다
        Events::trigger('before', $eventname);

        $this->_init();

        $mem_id = (int) $this->member->item('mem_id');

        $upload_path = 'uploads' . '/editor/' . date('Y') . '/' . date('m') . '/';

        $uploadconfig = array(
            'upload_path' => $upload_path,
            'allowed_types' => 'jpg|jpeg|png|gif',
            'max_size' => 10 * 1024,
            'encrypt_name' => true,
        );

        if (isset($_FILES)
            && isset($_FILES['upload'])
            && isset($_FILES['upload']['name'])) {

            $this->upload->initialize($uploadconfig);
            $_FILES['userfile']['name'] = $_FILES['upload']['name'];
            $_FILES['userfile']['type'] = $_FILES['upload']['type'];
            $_FILES['userfile']['tmp_name'] = $_FILES['upload']['tmp_name'];
            $_FILES['userfile']['error'] = $_FILES['upload']['error'];
            $_FILES['userfile']['size'] = $_FILES['upload']['size'];

            if ($this->upload->do_upload()) {

                // 이벤트가 존재하면 실행합니다
                //Events::trigger('doupload', $eventname);

                $filedata = $this->upload->data();
                $fileupdate = array(
                    'mem_id' => $mem_id,
                    'eim_originname' =>$filedata['orig_name'],
                    'eim_filename' => date('Y') . '/' . date('m') . '/' . $filedata['file_name'],
                    'eim_filesize' => intval($filedata['file_size'] * 1024),
                    'eim_width' => $filedata['image_width'] ? $filedata['image_width'] : 0,
                    'eim_height' => $filedata['image_height'] ? $filedata['image_height'] : 0,
                    'eim_type' => str_replace('.', '', $filedata['file_ext']),
                    'eim_datetime' => date('Y-m-d H:i:s'),
                    'eim_ip' => $this->input->ip_address(),
                );
                $image_url = site_url('/uploads' . '/editor/' . date('Y') . '/' . date('m') . '/' . $filedata['file_name']);

                echo "<script>window.parent.CKEDITOR.tools.callFunction("
                    . $this->input->get('CKEditorFuncNum', null, '') . ", '"
                    . $image_url . "', '업로드완료');</script>";
            } else {
                echo $this->upload->display_errors();
            }
        }
    }


    public function _init()
    {

        $upload_path = 'uploads' . '/editor/';
        if (is_dir($upload_path) === false) {
            mkdir($upload_path, 0777,true);
            $file = $upload_path . 'index.php';
            $f = @fopen($file, 'w');
            @fwrite($f, '');
            @fclose($f);
            @chmod($file, 0777);
        }
        $upload_path .= date('Y') . '/';
        if (is_dir($upload_path) === false) {
            mkdir($upload_path, 0777,true);
            $file = $upload_path . 'index.php';
            $f = @fopen($file, 'w');
            @fwrite($f, '');
            @fclose($f);
            @chmod($file, 0777);
        }
        $upload_path .= date('m') . '/';
        if (is_dir($upload_path) === false) {
            mkdir($upload_path, 0777,true);
            $file = $upload_path . 'index.php';
            $f = @fopen($file, 'w');
            @fwrite($f, '');
            @fclose($f);
            @chmod($file, 0777);
        }
    }
}
