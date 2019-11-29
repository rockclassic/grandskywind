<!DOCTYPE html>
<html lang="kr">
<head>
    <!-- MSIE 호환성 보기 (최신 브라우저) -->
    <meta http-equiv="X-UA-Compatible" content="IE=Edge">
<!--    <meta name="viewport" content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0"/>-->
    <meta name="viewport" content=" initial-scale=0.1, maximum-scale=1, user-scalable=1">
    <title>sysinfo</title>
    <meta name="description" content="sysinfo" />

    <!-- Schema.org markup for Google+ -->
    <meta itemprop="name" content="sysinfo">
    <meta itemprop="description" content="sysinfo">
    <meta itemprop="image" content="/assets/images/meta_icons/apple-touch-icon-144x144.png">

    <!-- Twitter Card data -->
    <meta name="twitter:card" content="sysinfo">
    <meta name="twitter:site" content=“@mediplan”>
    <meta name="twitter:title" content="sysinfo">
    <meta name="twitter:description" content="sysinfo">
    <meta name="twitter:creator" content=“@mediplan”>
    <meta name="twitter:image:src" content="/assets/images/meta_icons/apple-touch-icon-144x144.png">

    <!-- Open Graph data -->
    <meta property="og:title" content="sysinfo" />
    <meta property="og:type" content="article" />
    <meta property="og:url" content="http://www.mediplan.com/" />
    <meta property="og:image" content="/assets/images/meta_icons/apple-touch-icon-144x144.png" />
    <meta property="og:description" content="sysinfo" />
    <meta property="og:site_name" content="sysinfo" />

    <link href='/assets/images/meta_icons/favicon.ico' rel='shortcut icon' type='image/x-icon'>
    <link href='/assets/images/meta_icons/apple-touch-icon.png' rel='apple-touch-icon-precomposed'>
    <link href='/assets/images/meta_icons/apple-touch-icon-57x57.png' rel='apple-touch-icon-precomposed' sizes='57x57'>
    <link href='/assets/images/meta_icons/apple-touch-icon-72x72.png' rel='apple-touch-icon-precomposed' sizes='72x72'>
    <link href='/assets/images/meta_icons/apple-touch-icon-114x114.png' rel='apple-touch-icon-precomposed' sizes='114x114'>
    <link href='/assets/images/meta_icons/apple-touch-icon-144x144.png' rel='apple-touch-icon-precomposed' sizes='144x144'>
<!-- / START - page related stylesheets [optional] -->
    <link href="/assets/stylesheets/plugins/bootstrap_daterangepicker/bootstrap-daterangepicker.css" media="all" rel="stylesheet" type="text/css" />
    <link href="/assets/stylesheets/plugins/bootstrap_datetimepicker/bootstrap-datetimepicker.min.css" media="all" rel="stylesheet" type="text/css" />
    <link href="/assets/stylesheets/plugins/fullcalendar/fullcalendar.css" media="all" rel="stylesheet" type="text/css" />
    <link href="/assets/stylesheets/plugins/common/bootstrap-wysihtml5.css" media="all" rel="stylesheet" type="text/css" />
<!--// marquee -->
    <link href="/assets/marquee/css/liMarquee.css" rel="stylesheet" type="text/css">

<!-- / END - page related stylesheets [optional] -->
<!-- / bootstrap [required] -->
<link href="/assets/stylesheets/bootstrap/bootstrap.css" media="all" rel="stylesheet" type="text/css" />
<!-- / theme file [required] -->
<link href="/assets/stylesheets/light-theme.css" media="all" id="color-settings-body-color" rel="stylesheet" type="text/css" />
<!-- / coloring file [optional] (if you are going to use custom contrast color) -->
<link href="/assets/stylesheets/theme-colors.css" media="all" rel="stylesheet" type="text/css" />
<!-- / demo file [not required!] -->
<link href="/assets/stylesheets/demo.css" media="all" rel="stylesheet" type="text/css" />
<link href="/assets/toastr/toastr.min.css" media="all" rel="stylesheet" type="text/css" />


    <link href="/assets/stylesheets/admin.css" media="all" rel="stylesheet" type="text/css" />
<!--    <link href="/assets/stylesheets/master.css" media="all" rel="stylesheet" type="text/css" />-->
<!--    <link href="/assets/stylesheets/layout.css" media="all" rel="stylesheet" type="text/css" />-->

    <link rel="stylesheet" href="/assets/stylesheets/jquery/jquery-ui.css" type="text/css" />


    <!--[if lt IE 9]>
<script src="/assets/javascripts/ie/html5shiv.js" type="text/javascript"></script>
<script src="/assets/javascripts/ie/respond.min.js" type="text/javascript"></script>
<![endif]-->
<!-- / jquery [required] -->
<script src="/assets/javascripts/jquery/jquery.min.js" type="text/javascript"></script>
<script src="/assets/javascripts/jquery/jquery.number.min.js" type="text/javascript"></script>
<!-- / jquery mobile (for touch events) -->
<script src="/assets/javascripts/jquery/jquery.mobile.custom.min.js" type="text/javascript"></script>
<!-- / jquery migrate (for compatibility with new jquery) [required] -->
<script src="/assets/javascripts/jquery/jquery-migrate.min.js" type="text/javascript"></script>
<!-- / jquery ui -->
<script src="/assets/javascripts/jquery/jquery-ui.min.js" type="text/javascript"></script>
<!-- / jQuery UI Touch Punch -->
<script src="/assets/javascripts/plugins/jquery_ui_touch_punch/jquery.ui.touch-punch.min.js" type="text/javascript"></script>
<!-- / bootstrap [required] -->
<script src="/assets/javascripts/bootstrap/bootstrap.js" type="text/javascript"></script>
<!-- / modernizr -->
<script src="/assets/javascripts/plugins/modernizr/modernizr.min.js" type="text/javascript"></script>
<!-- / retina -->
<!--<script src="/assets/javascripts/plugins/retina/retina.js" type="text/javascript"></script>-->
<!-- / theme file [required] -->
<script src="/assets/javascripts/theme.js" type="text/javascript"></script>
<!-- / demo file [not required!] -->
<script src="/assets/javascripts/common.js" type="text/javascript"></script>
<!-- / START - page related files and scripts [optional] -->
<script src="/assets/javascripts/plugins/flot/excanvas.js" type="text/javascript"></script>
<script src="/assets/javascripts/plugins/flot/flot.min.js" type="text/javascript"></script>
<script src="/assets/javascripts/plugins/flot/flot.resize.js" type="text/javascript"></script>
<script src="/assets/javascripts/plugins/common/moment.min.js" type="text/javascript"></script>
<script src="/assets/javascripts/plugins/bootstrap_daterangepicker/bootstrap-daterangepicker.js" type="text/javascript"></script>
<script src="/assets/javascripts/plugins/bootstrap_datetimepicker/bootstrap-datetimepicker.js" type="text/javascript"></script>
<script src="/assets/javascripts/plugins/bootbox/bootbox.min.js" type="text/javascript"></script>
<script src="/assets/javascripts/plugins/slimscroll/jquery.slimscroll.min.js" type="text/javascript"></script>
<script src="/assets/javascripts/plugins/timeago/jquery.timeago.js" type="text/javascript"></script>
<script src="/assets/javascripts/plugins/common/wysihtml5.min.js" type="text/javascript"></script>
<script src="/assets/javascripts/plugins/common/bootstrap-wysihtml5.js" type="text/javascript"></script>
<script src="/assets/javascripts/plugins/fullcalendar/fullcalendar.min.js" type="text/javascript"></script>
<script src="/assets/javascripts/plugins/bootbox/bootbox.min.js" type="text/javascript"></script>
    <script src="/assets/javascripts/jquery/jquery.form.min.js" type="text/javascript"></script>
    <? if(defined('HTTPS_SET') && HTTPS_SET=="on"){?>
        <script src="https://ssl.daumcdn.net/dmaps/map_js_init/postcode.v2.js"></script>
    <?}else{?>
        <script src="http://dmaps.daum.net/map_js_init/postcode.v2.js"></script>
        <script charset="UTF-8" type="text/javascript" src="http://t1.daumcdn.net/postcode/api/core/180928/1538455030985/180928.js"></script>
    <?}?>
    <script src="/static/js/util.js"></script>
    <script src="/static/js/jquery.form.min.js"></script>

    <!--// marquee -->
<!--    <script src="http://code.jquery.com/jquery-1.11.3.min.js" type="text/javascript"></script>-->
    <script src="/assets/marquee/js/jquery.liMarquee.js" type="text/javascript"></script>
    <script src="/assets/toastr/toastr.min.js" type="text/javascript"></script>
    <script type="text/javascript" src="https://openapi.map.naver.com/openapi/v3/maps.js?clientId=uM2XupCoWF1KRFPpHZkZ&submodules=geocoder"></script>

    <?
//check_login();
?>
</head>
<!--<body class='contrast-red'>-->
<!--<body class='contrast-muted'>-->
<!--<body class='contrast-fb'>-->
<body class='contrast-sea-blue' style="min-width: 1024px">

<header>
    <nav class='navbar navbar-default'>

        <a class='navbar-brand' href='/crm/' style="vertical-align: center;margin-right: 20px"> </a>

        <a class='navbar-brand' href='/crm/' style="vertical-align: center">sysinfo</a>
        <a class='toggle-nav btn pull-left' href='#'>
            <i class='icon-reorder' style="color:white;"></i>
        </a>
        <!-- sms전송 팝업::Start -->
<!--        <div class="sms_popup" style="display: none;  z-index: 9999;position: fixed; width: 40%;left: 50%;margin-left: -20%; top: 30%;margin-top: -150px;  overflow: auto; background: #ffffff; border: 1px solid #e6e6e6; width: 600px;">-->
        <div class="sms_popup" style="display: none;  z-index: 9999;position: absolute;width: 600px;left: 50%;top: 150%;margin-left: -250px;overflow: auto; background: #ffffff; border: 1px solid #e6e6e6;">

            <div class="sms_popup_header" style="display: flex; align-items: center; justify-content: space-between; text-align: right; background: #013c69;">
                <p style="margin: 0; color: #ffffff; padding: 5px 15px; font-size: 16px;" id="sms_title">SMS 전송</p>
                <button class="sms_popup_close" style="background: none; border: 0; font-size: 24px; color: #ffffff; padding: 5px 15px;"><i class="icon-remove" style="font-size: 20px"></i></button>
            </div>
            <input type="hidden" name="idx" id="idx" style="resize: none;  padding: 0 0 0 10px;"/>
            <div class="sms_popup_body" style="padding: 10px 20px; text-align: left;">
                <p style="width: 100%; margin-bottom: 5px; text-align: left; font-weight: bold;display: none" id="sms_tilte1">입력 내용</p>
                <textarea name="message1" id="message1" style="resize: none; height: 160px; width: 100%; padding: 10px 0 0 10px; border : 0px solid #fff" readonly></textarea>

            </div>
            <div class="sms_popup_body" style="padding: 20px; text-align: center;">
                <p style="width: 100%; margin-bottom: 5px; text-align: left; font-weight: bold;"  id="sms_tilte2">입력 내용</p>
                <textarea name="message2" id="message2" style="resize: none; height: 160px; width: 100%; padding: 10px 0 0 10px;"></textarea>
            </div>


            <div class="sms_popup_footer" style="text-align: center; padding: 0 20px 20px;">
                <button class="sms_popup_submit" style="width: 100px; padding: 8px 0; border: 0; background: #333333; color: #ffffff;">전송</button>
            </div>
        </div>
        <!-- sms전송 팝업::End -->

        <ul class='nav'>
            <li class='dropdown dark user-menu'>
                <a class='dropdown-toggle' data-toggle='dropdown' href='#'>
                    <i class="icon-cog" style="color:white"></i>
                    <span class='user-name' style="color:white"><?=$this->session->userdata('user_name')?> &nbsp;(<?=$this->openssl_mem->aes_decrypt(USER_ID)?>)</span>
                    <b class='caret'> </b>
                    <span style="padding: 0 15px;height: 40px" id="timeLeft"></span>
                </a>

                <ul class='dropdown-menu'>
                    <li>
                            <a href="/crm/login/logout"><i class='icon-signout'></i> 로그아웃</a>
                    </li>
                    <li>
                        <a href="/crm/login/change_pwd"><i class='icon-signout'></i> 비번변경</a>
                    </li>

                </ul>
            </li>
        </ul>

    </nav>

    <div class="Loading_spinner_wrap">
        <div class="Loading_spinner">
            <span style="font-size: 50px">T</span>
            <span style="font-size: 40px">O</span>
            <span style="font-size: 35px">D</span>
            <span style="font-size: 45px">A</span>
            <span style="font-size: 35px">Y</span>
            &nbsp;&nbsp;
            <span style="font-size: 45px">P</span>
            <span style="font-size: 40px">L</span>
            <span style="font-size: 50px">A</span>
            <span style="font-size: 45px">N</span>
        </div>
    </div>
    
</header>

<style>
    #wrapper{min-width:1024px}
 #message, #send_no, #callback_no {
     outline: none;
 }

 #send_no:focus {
     box-shadow: 0 0 8px #dce1e5;
     border-bottom: 0;
 }

 #callback_no:focus {
     box-shadow: 0 0 8px #dce1e5;
     border-bottom: 0;
 }
 
 .Loading_spinner_wrap {
     position: fixed;
     display: none;
     top: 0;
     left: 0;
     width: 100vw; 
     height: 100vh; 
     background: RGBA(0,0,0,0.9); 
     z-index: 9998;
 }

.Loading_spinner {
    font-size: 30px;
    font-weight: bold;
    text-align: center;
    position: absolute;
    top: 50%;
    left: 50%;
    transform: translate(-50%, -50%);
    color: #ffffff;
}

 .Loading_spinner span {
     display: inline-block;
     animation: loadingAnimation .9s infinite alternate;
 }

 .Loading_spinner span:nth-child(2){
     animation-delay: .2s;
 }

 .Loading_spinner span:nth-child(3){
     animation-delay: .3s;
 }

 .Loading_spinner span:nth-child(4){
     animation-delay: .4s;
 }

 .Loading_spinner span:nth-child(5){
     animation-delay: .5s;
 }

 .Loading_spinner span:nth-child(6){
     animation-delay: .6s;
 }

 .Loading_spinner span:nth-child(7){
     animation-delay: .7s;
 }

 .Loading_spinner span:nth-child(8){
     animation-delay: .8s;
 }

 @keyframes loadingAnimation {
     0%, 100% {
         transform: translateY(0);
     }

     50% {
         transform: translateY(15px);
     }
 }

    .icon-tags{
        font-size: 16px;
    }
</style>

<script>
    function showSpinner(){
        $('.Loading_spinner_wrap').show();
    }

    function hideSpinner(){
        $('.Loading_spinner_wrap').hide();
    }

    $('.sms_popup_close').click(function(){
        $("#sms_title").html('');
        $("#idx").val('');
        $("#message1").val('');
        $("#message2").val('');
        $('.sms_popup').hide();
    });

    function winopen(url, target, width, height) {
        var option = 'width='+width+', height='+height;
        window.open(url, target, option);
    }
    function ajax_post(url, data, callback, callback_done, callback_fail, datatype){
        showSpinner();
        var contenttype = 'application/json; charset=utf-8';
        if(!datatype) {
            datatype = 'JSON';
        }
        $.ajax({
            'url': url,
            'type': 'POST',
            'dataType': datatype,
            'contentType': contenttype,
            'processData': false,
            'data': JSON.stringify(data),
            'success': callback
        })
            .done(function(ret){
                hideSpinner();
                if(callback_done) callback_done(ret);
            })
            .fail(function(){
                hideSpinner();
                if(callback_fail) callback_fail();
            });
    }

    function winopen(url, target, width, height) {
        var option = 'width='+width+', height='+height;
        window.open(url, target, option);
    }


</script>
<div id='wrapper'>
    <!-- 메뉴시작 -->
    <div id='main-nav-bg'></div>
    <? $this->load->view('crm/common/left'); ?>
    <!-- 메뉴끝 -->
    <section id='content'>
        <div class='container'>
        <!-- 본문 내용 -->
