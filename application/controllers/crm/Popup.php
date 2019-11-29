<?php
defined('BASEPATH') OR exit('No direct script access allowed');
/**
 * @ description : 세무사 관련
 * @ author : jeromc
 * @property Userbiz $userbiz
 */
class Popup extends CI_Controller {

    // construct
    public function __construct() { // {{{
        parent::__construct();
        $this->load->model('biz/crm/v1/Userbiz', 'userbiz');
    } // }}}

    // 제휴신청  by.jeromc 2018-11-09
    public function find_addr() { // {{{
        $this->__login_chk();
        $data = array();

        $params = $this->input->post();
        $index = $this->input->get();

        $data['addr']=$params[$index['addr']];
        $data['x']=$index['x'];
        $data['y']=$index['y'];
//        fn_log($data);

        $this->load->view('crm/popup/find_addr', $data);
    } // }}}


    public function makeImg()
    {
        $params = json_decode(trim(file_get_contents('php://input')), true);
        if (isset($params["data"])) {
            $imageData = $params['data'];

            $imageData = str_replace(' ', '+', $imageData);
            $filteredData = substr($imageData, strpos($imageData, ",") + 1);
            $unencodedData = base64_decode($filteredData);

//          $filename = APPPATH.'/uploads/map_img/test.jpg';
            $filename = 'uploads' . '/map_img/' . date('Y')  . date('m') .'_'.$params['id'].'.jpg' ;


            fn_log($filename);
            $file = fopen($filename, 'w+');
            fwrite($file, $unencodedData);
            fclose($file);

            $img=imagecreatefrompng($filename);
            imagejpeg($img,$filename);

            $data['msg']= 'success';

        }else{
            $data['msg']= 'fail';
        }
        echo json_encode($data);
    }


    private function __login_chk() { // {{{
        if(defined('USER_ID') && $this->session->userdata('auth_flag')=="Y"&& $this->session->userdata('first') == "N") {

        }elseif(defined('USER_ID') && $this->session->userdata('auth_flag')=="Y"&& $this->session->userdata('first') == "Y"){
            redirect('/crm/login/change_pwd', 'refresh');
            die;
        }else{
            redirect('/crm/login', 'refresh');
            die;
        }
    } // }}}

}
?>
