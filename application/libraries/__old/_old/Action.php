<?php
/**
 * @ description : Action Library action 관련 라이브러리
 * @ author : serendip <serendip@inkomaro.com>
**/
class Action {

    public function __construct()
    {
        $this->CI =& get_instance();
        $this->CI->load->model('biz/action_invbiz','action_invbiz');
        $this->CI->load->model('biz/action_salebiz','action_salebiz');
        $this->CI->load->model('biz/action_cancelbiz','action_cancelbiz');
    }

    public function action($act_code, $params){ // {{{
        $result = array(
            'result' => 'nok',
            'msg' => 'invalid',
        );
        if(empty($act_code) || !defined('USER_ID') || !defined('USER_NAME')){
            return $result;
        }
        $user_id = USER_ID;
        $user_name = USER_NAME;
        $act_code = strtoupper($act_code);
        // biz 모델 정의
        if(strpos($act_code, 'INV') === 0) 
            $biz = $this->CI->action_invbiz;
        elseif(strpos($act_code, 'SALE') === 0)
            $biz = $this->CI->action_salebiz;
        elseif(strpos($act_code, 'CANCEL') === 0)
            $biz = $this->CI->action_cancelbiz;
        else
            return $result;

        // 함수 이름
        $var_function = 'action_'.strtolower($act_code);

        // biz에 함수 선언되어 있는지
        if(method_exists($biz, $var_function)){
            // params에 중복 정의되어있는데, 값이 다른 경우 fail
            if(isset($params['act_code'])   && $params['act_code']  !== $act_code)  return $result;
            if(isset($params['user_id'])    && $params['user_id']   !== $user_id)   return $result;
            if(isset($params['user_name'])  && $params['user_name'] !== $user_name) return $result;

            $params['act_code'] = $act_code;
            $params['user_id'] = $user_id;
            $params['user_name'] = $user_name;

            return $biz->$var_function($params);
        }else{
            // 함수가 정의되어 있지 않은 경우
            debug("ERROR");
            return $result;
        }
    } // }}}
}
?>
