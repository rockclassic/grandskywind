<?php
defined('BASEPATH') OR exit('No direct script access allowed');
/**
 * @ description : Crontab 스케쥴용
 * @ author : jeromc
 * @property Cronbiz $cronbiz
 */
class Cron extends CI_Controller {

    var $parameter;
    // construct
    public function __construct() {
        parent::__construct();
        $this->load->model('biz/api/v1/Cronbiz', 'cronbiz');
        $this->parameter  = array(

            // 1. 테스트를 위한 샘플
            'check_sample' => array( // {{{
                'method_comment' => '1. 테스트를 위한 샘플',
            ), // }}}
            // 2. 포인트 소멸 새벽 12:10분에 실행
            'check_destroy_point' => array( // {{{
                'method_comment' => '2. 포인트 소멸',
            ), // }}}


        );
    }

    // _remap for batch
    public function _remap($method) { // {{{
        $method = 'func_'.$method;
        $params = array();
        if($this->router->fetch_method() != 'sample') {
            $params = parameter_check($this->parameter[$this->router->fetch_method()], $this->input->post());
        }
        $params = func_get_arg(1); // for batch
        if(method_exists($this, $method)) return call_user_func_array(array($this, $method), $params);
        echo show_deny();
    } // }}}




    // 1. 테스트를 위한 샘플
    private function func_check_sample() { // {{{
        print_r("\n".YMD_HIS."\n");
       echo $this->cronbiz->check_sample();
    } // }}}

    // 2. 포인트 소멸 새벽
    private function func_check_destroy_point() { // {{{
        print_r("\n start :: ".YMD_HIS."\n");
        echo $this->cronbiz->check_destroy_point();
        print_r("\n end   :: ".YMD_HIS."\n");
    } // }}}


}
?>
