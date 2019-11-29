<?php  if ( ! defined('BASEPATH')) exit('No direct script access allowed');
/**
 * @ description : load view with common body +(header, left, bottom)
 * @ author : prog106 <prog106@haomun.com>
 */
if(!function_exists('load_stock_view')) {
    function load_stock_view($view_file, $data=array()) { // {{{
        $CI =& get_instance();
        $data['view_file'] = $view_file;
        $CI->load->view('stock/common/body',$data);
        //$CI->output->enable_profiler(true);
    } // }}}
}

if(!function_exists('load_admin_view')) {
    function load_admin_view($view_file, $data = array()) { // {{{
        $CI =& get_instance();
        $data['_class'] = $CI->router->fetch_class();
        $data['_method'] = $CI->router->fetch_method();
        $data['_menu'] = array(

            'operation' => array(
                'name' => '운영설정 관리',
                'icon' => 'dashboard',
                'grade' => array(1,2,3,4,5,6,7,8,9),
                'sub' => array(
                    'operation/user_setting' => array('title'=>'관리자계정관리','grade' => array(8,9),'no_show'=>'N'),
                    'operation/fcm' => array('title'=>'Fcm 발송','grade' => array(8,9),'no_show'=>'N'),
                    'operation/log' => array('title'=>'Log Control','grade' => array(8,9),'no_show'=>'N'),
                    'operation/user_fee' =>array('title'=>'회원별 수수료 정보','grade' => array(8,9),'no_show'=>'Y'),
                    'operation/infos' =>array('title'=>'정보 관리','grade' => array(8,9),'no_show'=>'N'),

                ),
            ),
            'Hosptl' => array(
                'name' => '제휴병원 관리',
                'icon' => 'user',
                'grade' => array(1,2,3,4,5,6,7,8,9),
                'sub' => array(
                    'hosptl/list' => array('title'=>'제휴병원목록','grade' => array(1,2,3,4,5,6,7,8,9),'no_show'=>'N'),
                    'hosptl/reg' => array('title'=>'제휴병원등록','grade' => array(7,8,9),'no_show'=>'N'),

                ),
            ),

            'trade' => array(
                'name' => '견적현황 관리',
                'icon' => 'tasks',
                'grade' => array(1,2,3,4,5,6,7,8,9),
                'sub' => array(
                    'trade/estimate' => array('title'=>'견적요청관리','grade' => array(1,2,3,4,5,6,7,8,9),'no_show'=>'N'),
                ),
            ),

            'board' => array(
                'name' => '고객센터',
                'icon' => 'table',
                'grade' => array(1,2,3,4,5,6,7,8,9),
                'sub' => array(
                    'board/notice' => array('title'=>'공지사항','grade' => array(1,2,3,4,5,6,7,8,9),'no_show'=>'N'),
                    'board/editor' => array('title'=>'공지사항 Editor','grade' => array(8,9),'no_show'=>'Y'),
                    'board/read' => array('title'=>'공지사항 ','grade' => array(1,2,3,4,5,6,7,8,9),'no_show'=>'Y'),
                    'board/ask' =>array('title'=>'1:1문의','grade' => array(7,8,9),'no_show'=>'N'),
                ),
            ),
        );
        $data['view_file'] = $view_file;
        $CI->load->view('crm/common/body',$data);
        //$CI->output->enable_profiler(true);
    } // }}}
}



