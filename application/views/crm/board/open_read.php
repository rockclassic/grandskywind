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
    <link href="/assets/stylesheets/admin.css" media="all" rel="stylesheet" type="text/css" />
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
    console.log("#11");
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
<body class='contrast-muted login contrast-background' style="background: #fff !important; ">

<div class="row" id="content-wrapper">
    <div class="col-xs-12">
        <div class='row'>
            <div class='col-sm-12'>
                <div class='box bordered-box red-border' style='margin-bottom:0;'>
                    <div class='box-header muted-background' style="height: 30px;padding: 0px">
                        <div class='title'>&nbsp;&nbsp;공지사항</div>
                    </div>
                    <div class='box-content' style="border-bottom: 1px solid #dddddd;padding: 15px">
                        <div class="form-group" style="margin-bottom: 5px; display: flex; align-items: center;padding: 0px 15px" >
                            <div style="font-size: 15px;width: 100%;color: #000" class="s-str"><?=$list['nt_title']?></div>
                            </div>
                        </div>
                    </div>

                    <div class='box-content box-no-padding'>
                        <div class='responsive-table'>
                            <pre style="overflow: auto;padding: 10px">
                                        <?  if(isset($list['nt_content'])) echo str_replace('"', '\'', preg_replace('/\s\s+/', ' ', $list['nt_content']))?>
                                </pre>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

</body>

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
<style>
    img{max-width: 95%;}
    body{max-width: 100%;max-height: 100%;}
</style>
</html>
