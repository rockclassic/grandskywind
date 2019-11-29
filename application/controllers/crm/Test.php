<?php
defined('BASEPATH') OR exit('No direct script access allowed');
/**
 * @ description : Test Controller
 * @ author : jeromc
 * @property Testbiz $testbiz
 */
class Test extends CI_Controller {

    // construct
    public function __construct() { // {{{
        parent::__construct();
    } // }}}

    public function pwd(){
        $user_password=$this->input->get('pwd', true);
        echo $user_password."<br>";
        echo password_hash($user_password, PASSWORD_DEFAULT);
    }
    // test list
    public function get_list() { // {{{

        $params = json_decode(trim(file_get_contents('php://input')), true);
        $this->load->model('biz/api/v1/testbiz', 'testbiz');
        $return['list'] = $this->testbiz->get_value($params);  //get_query
        $return['msg']="success";
        $return['params']=$params;
        echo json_encode($return);
    } // }}}

    public function chg_grade(){
        $grade=$this->input->get('grade_xsas', true);
        $this->session->set_userdata('user_grade', $this->openssl_mem->aes_encrypt($grade));
    }

    public function point(){
        //fn_point_save($office_id, $amount,$user_id,$expire_days=365,$dtype=190,$memo=null)
        echo "<br><br>";
        print_r(fn_point(1));
        echo "1<br><br>";
//        $ret=fn_point_save(1, 1500,'',100,'190','테스트 적립');
//        print_r($ret);
        echo "<br><br>";
        print_r(fn_point(1));
        echo "<br><br>";
        $ret=fn_point_use(1, 1400,'',100,'190','테스트 적립');
        print_r($ret);
        echo "<br><br>";
        print_r(fn_point(1));


    }
}
?>
