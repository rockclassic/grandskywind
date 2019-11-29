<!DOCTYPE html>
<html>
<head>


    <!-- MSIE 호환성 보기 (최신 브라우저) -->
    <meta http-equiv="X-UA-Compatible" content="IE=Edge">
    <meta name="viewport" content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0"/>
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
    
    <!-- / END - page related stylesheets [optional] -->
    <!-- / bootstrap [required] -->
    <link href="/assets/stylesheets/bootstrap/bootstrap.css" media="all" rel="stylesheet" type="text/css" />
    <!-- / theme file [required] -->
    <link href="/assets/stylesheets/light-theme.css" media="all" id="color-settings-body-color" rel="stylesheet" type="text/css" />
    <!-- / coloring file [optional] (if you are going to use custom contrast color) -->
    <link href="/assets/stylesheets/theme-colors.css" media="all" rel="stylesheet" type="text/css" />
    <!-- / demo file [not required!] -->
    <link href="/assets/stylesheets/demo.css" media="all" rel="stylesheet" type="text/css" />
    <!--[if lt IE 9]>
      <script src="/assets/javascripts/ie/html5shiv.js" type="text/javascript"></script>
      <script src="/assets/javascripts/ie/respond.min.js" type="text/javascript"></script>
    <![endif]-->
<script>
function ajax_post(url, data, callback, callback_done, callback_fail, datatype){
    console.log("#14");
    console.log(data);
    if(!datatype) {
        var contenttype = 'application/json; charset=utf-8';
        datatype = 'json';
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
            if(callback_done) callback_done(ret);
        })
        .fail(function(){
            if(callback_fail) callback_fail();
        });
}
</script>
<style>
    .admin_login_logo:hover {
        color: #ffffff;
    }
</style>
</head>
<body class='contrast-muted login contrast-background'>
<div class='middle-container'>
    <div class='middle-row'>
        <div class='middle-wrapper'>
            <div class='login-container-header'>
                <div class='container'>
                    <div class='row'>
                        <div class='col-sm-12'>
                            <div class='text-center'>
                                <a class="admin_login_logo" href="/crm/login"><h1 style="color: #ffffff;">Today Plan :: 사업을 도와줘!</h1></a>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class='login-container'>
                <div class='container'>
                    <div class='row'>
                        <div class='col-sm-4 col-sm-offset-4'>
                            <h1 class='text-center title'>비밀번호 변경</h1>
                            <form name="content_form" id="content_form"  name="content_form" class='validate-form'>
                                <div class='form-group'>
                                    <div class='controls with-icon-over-input'>기존 비밀번호
                                        <input value="" placeholder="기존 비밀번호" class="form-control" data-rule-required="true" name="admin_pw1" id="admin_pw1" type="password" />

                                    </div>
                                </div>
                                <div class='form-group'>
                                    <div class='controls with-icon-over-input'> 새 비밀번호
                                        <input value="" placeholder="새 비밀번호" class="form-control" data-rule-required="true" name="admin_pw2" id="admin_pw2" type="password" />
                                        <h6>(비번은 영문,숫자,특수문자(!@$%^&* 만 허용)를 사용하여 6~16자까지, 영문은 대소문자를 구분합니다.)</h6>
                                    </div>
                                </div>
                                <!-- div class='checkbox'>
                                  <label for='remember_me'>
                                    <input id='remember_me' name='remember_me' type='checkbox' value='1'>
                                    Remember me
                                  </label>
                                </div -->
                                <button class='btn btn-block btn_search'>변경</button>
                            </form>
                            <!-- div class='text-center'>
                              <hr class='hr-normal'>
                              <a href='forgot_password.html'>Forgot your password?</a>
                            </div -->
                        </div>
                    </div>
                </div>
            </div>
            <!-- div class='login-container-footer'>
              <div class='container'>
                <div class='row'>
                  <div class='col-sm-12'>
                    <div class='text-center'>
                      <a href='sign_up.html'>
                        <i class='icon-user'></i>
                        New to Flatty?
                        <strong>Sign up</strong>
                      </a>
                    </div>
                  </div>
                </div>
              </div>
            </div -->
        </div>
    </div>
</div>
    <!-- / jquery [required] -->
    <script src="/assets/javascripts/jquery/jquery.min.js" type="text/javascript"></script>
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
    <script src="/assets/javascripts/plugins/retina/retina.js" type="text/javascript"></script>
    <!-- / theme file [required] -->
    <script src="/assets/javascripts/theme.js" type="text/javascript"></script>
    <!-- / demo file [not required!] -->
    <script src="/assets/javascripts/demo.js" type="text/javascript"></script>
    <!-- / START - page related files and scripts [optional] -->
    <script src="/assets/javascripts/plugins/validate/jquery.validate.min.js" type="text/javascript"></script>
    <script src="/assets/javascripts/plugins/validate/additional-methods.js" type="text/javascript"></script>
    <!-- / END - page related files and scripts [optional] -->

<script>
    $(document).ready(function() {
        $('button').click(function() {
            if(!$('#admin_pw1').val()) {
                alert('기존 비밀번호를 입력해 주세요.');
                return false;
            }
            if(!$('#admin_pw2').val()) {
                alert('새 비밀번호를 입력해 주세요.');
                return false;
            }
            if(!post_check()){
                return false;
            }
            var url = '/crm/login/ax_change_pw/';
            // var data = $('#content_form').serialize();
            var data = {"admin_pw1":$('#admin_pw1').val(),"admin_pw2":$('#admin_pw2').val()};
            ajax_post(url, data, function(ret) {
                if(ret.msg == 'ok') {
                    // self.location.reload();
                    alert('비밀번호가 변경되었습니다.\r\n\r\n다시 로그인 해주세요.');
                    self.location.href="/crm/login/logout";
                } else {
                    alert(ret.msg);
                    //alert('로그인 정보가 일치하지 않습니다.\r\n\r\n다시 확인해 주세요.');
                }
            });
        });
    });

function post_check()
{

    // 비밀번호(패스워드) 유효성 체크 (문자, 숫자, 특수문자의 조합으로 6~16자리)
    var ObjUserPassword = document.content_form.admin_pw2;

    //if(ObjUserPassword.value != objUserPasswordRe.value)
    //{
    //  alert("입력하신 비밀번호와 비밀번호확인이 일치하지 않습니다");
    //  return false;
    //}

    if(ObjUserPassword.value.length<6) {
        alert("비밀번호는 영문,숫자,특수문자(!@$%^&* 만 허용)를 사용하여 6~16자까지, 영문은 대소문자를 구분합니다.");
        return false;
    }

    if(!ObjUserPassword.value.match(/([a-zA-Z0-9].*[!,@,#,$,%,^,&,*,?,_,~])|([!,@,#,$,%,^,&,*,?,_,~].*[a-zA-Z0-9])/)) {
        alert("비밀번호는 영문,숫자,특수문자(!@$%^&* 만 허용)를 사용하여 6~16자까지, 영문은 대소문자를 구분합니다.");
        return false;
    }

    //if(ObjUserID.value.indexOf(ObjUserPassword) > -1) {
    //  alert("비밀번호에 아이디를 사용할 수 없습니다.");
    //  return false;
    //}

    var SamePass_0 = 0; //동일문자 카운트
    var SamePass_1 = 0; //연속성(+) 카운드
    var SamePass_2 = 0; //연속성(-) 카운드

    for(var i=0; i < ObjUserPassword.value.length; i++) {
        var chr_pass_0 = ObjUserPassword.value.charAt(i);
        var chr_pass_1 = ObjUserPassword.value.charAt(i+1);

        //동일문자 카운트
        if(chr_pass_0 == chr_pass_1) {
            SamePass_0 = SamePass_0 + 1
        }

        var chr_pass_2 = ObjUserPassword.value.charAt(i+2);

        //연속성(+) 카운드
        if(chr_pass_0.charCodeAt(0) - chr_pass_1.charCodeAt(0) == 1 && chr_pass_1.charCodeAt(0) - chr_pass_2.charCodeAt(0) == 1) {
            SamePass_1 = SamePass_1 + 1
        }

        //연속성(-) 카운드
        if(chr_pass_0.charCodeAt(0) - chr_pass_1.charCodeAt(0) == -1 && chr_pass_1.charCodeAt(0) - chr_pass_2.charCodeAt(0) == -1) {
            SamePass_2 = SamePass_2 + 1
        }
    }
    if(SamePass_0 > 1) {
        alert("동일문자를 3번 이상 사용할 수 없습니다.");
        return false;
    }

    if(SamePass_1 > 1 || SamePass_2 > 1 ) {
        alert("연속된 문자열(123 또는 321, abc, cba 등)을\n 3자 이상 사용 할 수 없습니다.");
        return false;
    }
    return true;
}
</script>
</body>
</html>
