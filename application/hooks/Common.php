<?php

// 모바일 기기 체크
function mobilecheck() { // {{{
    $CI =& get_instance();
    $CI->load->library('Mobile_Detect');
    // 모바일 기기일 경우 1 아니면 Null
    if(!empty($CI->mobile_detect->isMobile())) define("ISMOBILE", $CI->mobile_detect->isMobile());
} // }}}

?>
