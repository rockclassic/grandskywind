<div class="row" id="content-wrapper">
    <div class="col-xs-12">
        <? $this->load->view('crm/common/top'); ?>
        <div class='row'>
            <div class='col-sm-12'>
                <div class='box bordered-box muted-border' style='margin-bottom:0;'>
                    <div class='box-header muted-background' style="height:30px;padding: 0px">
                        <div class='title'><?=$this->session->userdata('title')?> </div>
                    </div>


                    <div class='box-content' style="border-bottom: 0;" id="admin_display">
                        <form class="form form-horizontal" action="/crm/operation/log" method="get" id="search_form">
                            <table width=100% height=100% cellpadding=0 cellspacing=0 style = 'margin: -20px 0px 0px 0px; '>
                                <tr>
                                    <td align=center valign=middle >

                                        <div class="table_area mt0"><!-- table_area start -->
                                            <div class="box_gray"> <!-- box wrap -->
                                                <table class="write">
                                                    <tbody>
                                                    <div class="right_opt">
                                                        <!--<p class="fs11"><span class="essential">*</span> 항목은 필수값입니다.</p>-->
                                                    </div>

                                                    <tr>
                                                        <th scope="row" width="20%" >
                                                            <label for="sdate">검색시작일</label>
                                                        </th>
                                                        <td colspan=2>
                                                            <input type="text" id="sdate" name="sdate" class="w50p"  value="<?=$sdate?>"/>
                                                        </td>
                                                        <th scope="row" width="20%" >
                                                            <label for="edate">검색마지막일</label>
                                                        </th>
                                                        <td colspan=2>
                                                            <input type="text" id="edate" name="edate" class="w50p"  value="<?=$edate?>"/>
                                                        </td>
                                                    </tr>

                                                    </tbody>
                                                </table>
                                                <div class="row2">
                                                    <div class="col-md-10" style="width:80%;float: left">

                                                    </div>
                                                    <div class="col-md-1" style="width:10%;float: left">
                                                        <button class="btn btn-primary btn_search btn-xs">
                                                            <i class="icon-search"></i>
                                                            검색
                                                        </button>
                                                    </div>
                                                    <div class="col-md-1" style="width:10%;float: left">

                                                    </div>

                                                </div>
                                            </div> <!-- //box wrap -->
                                        </div>

                                    </td>

                                </tr>
                            </table>

                        </form>
                    </div>

                    <div class='box-content box-no-padding'>
                        <div class='responsive-table' style="margin-left:20px; margin-right:20px;">


                            <table width=100% height=100% cellpadding=0 cellspacing=0>
                                <tr>
                                    <td align=center valign=middle >
                                        <div class="table_area2 "><!-- table_area start -->
                                            <input type="hidden" name="page" id="page" value="1">

                                            <div class="table_top" style="margin-top:20px;" ><!-- table_top start -->
                                                <div class="left_opt">
                                                    <span class="title_cmt"> 조회 <?=number_format($count)?> 건</span>
                                                </div>
                                                <ul class="right_opt">
                                                    <!--                                                        <li class="sbtn"><a href="javascript:void $.fn.excel_download();"><span class="ico_download">Excel 다운로드</span></a></li>-->
                                                </ul>
                                            </div><!-- table_top end -->

                                            <table class="list over-list">
                                                <thead>
                                                <tr>
                                                    <th class="text-center" width="80px">번호</th>
                                                    <th class="text-center" width="150px">로그일자</th>
                                                    <th class="text-center" width="80px">idx</th>

                                                    <th class="text-center">로그내용</th>
                                                    <th class="text-center" width="100px">ip</th>
                                                    <th class="text-center" width="100px">관리</th>
                                                    <th class="text-center" width="80px">상세보기</th>
                                                </tr>
                                                </thead>
                                                <tbody>
                                                <?
                                                foreach($list as $k => $v) {
                                                    ?>
                                                    <tr style="height: 20px">
                                                        <td align="center"><?=$v['admin_log_srl']?></td>
                                                        <td align="center"><?=$v['action_date']?></td>
                                                        <td align="center"><?=$v['user_srl']?></td>
                                                        <td align="center" class="s-str"  title="<?=$v['action_comment']?>"><?=$v['action_comment']?></td>
                                                        <td align="center" class="s-str" ><?=$v['user_log_ip_address']?></td>
                                                        <td align="center" class="s-str" title="<?=$v['admin_id']?>"><?=$v['admin_id']?></td>
                                                        <td align="center "><a onclick="popup_open('<?=$v['admin_log_srl']?>')" class="btn btn-primary btn-xs">보기</a></td>
                                                    </tr>
                                                <?}?>


                                                </tbody>
                                            </table>


                                            <div style="padding-top:10px; padding-bottom:0px;">
                                                <?=$pagination?>
                                            </div>
                                        </div><!-- table_area end -->
                                    </td>

                                </tr>
                            </table>


                        </div>
                    </div>
                </div>
            </div>
        </div>
        <hr class='hr-double'>
    </div>
</div>
<style type="text/css">
    table {table-layout: fixed; /*테이블 내에서 <td>의 넓이,높이를 고정한다.*/}
    table td {
        width:100%;
        overflow: hidden;
        text-overflow:ellipsis;
        white-space:nowrap;
    }
</style>
<script>

    //fcm전송  view show/hide
    function chg_display() {

        if ( $("#new_admin").css("display") == "none" ){
            $("#f_send_idx").val('user');
            $("#f_send_msg").val('');
            $("#f_memo").val('');
            $("#new_admin").show();
            $("#s_open").hide();
        }else{
            $("#f_send_idx").val('user');
            $("#f_send_msg").val('');
            $("#f_memo").val('');
            $("#new_admin").hide();
            $("#s_open").show();
        }
    }

    //fcm 전송
    $('#s_save').click(function(){
        if(!$("#f_send_idx").val()){ toastr.error("회원타입은 필수 입니다. 확인해 주세요. "); $("#s_ac_id").focus(); return false;}
        if(!$("#f_send_msg").val()){ toastr.error("전송 메세지는 필수 입니다. 확인해 주세요. "); $("#s_ac_nm").focus(); return false;}
        if(!confirm('전송하시겠습니까?')) return false;
        var url = '/crm/operation/send_fcm';
        var data = {'f_send_idx':$("#f_send_idx").val(),'f_send_msg':$("#f_send_msg").val(),'f_memo':$("#f_memo").val(),'f_title':$("#f_title").val()};
        showSpinner();
        ajax_post(url, data, function(ret) {
            if(ret.msg == 'success') {
                toastr.success('전송되었습니다.');
                hideSpinner();
                location.reload();
            } else {
                toastr.error('error : '+ret.data);
                hideSpinner();
            }
        });

    });

    // 상세보기
    function popup_open(id){
        $("#sms_title").html('<i class="icon-tags"></i> Log 상세 내역');
        $("#idx").val(id);
        $("#sms_tilte1").show();



        $('#message1').css("border","1px solid #d5d5d5"); //설정
        $('#message1').attr("readonly",true); //설정
        $('#message1').height('30px'); //설정
        $('#message2').attr("readonly",true); //설정



        var url = '/crm/operation/get_log_one';
        var data = {'admin_log_srl':id};
        showSpinner();
        ajax_post(url, data, function(ret) {
            console.log(ret);
            if(ret.msg == 'success') {
                $("#sms_tilte1").html("ID : "+ret.data.admin_log_srl);
                $("#sms_tilte2").html("log 내용 ["+ret.data.user_srl+"]");
                $("#message1").val(ret.data.user_log_ip_address);
                $("#message2").val(ret.data.action_comment);
                $('.sms_popup_submit').hide();
                $('.sms_popup').show();
                hideSpinner();
            } else {
                alert('error : '+ret.data);
                hideSpinner();
            }
        });
    }
    //달력
    $(function() {
        $( "#sdate, #edate" ).datepicker({
            dateFormat: 'yy-mm-dd',
            monthNames: ['1월','2월','3월','4월','5월','6월','7월','8월','9월','10월','11월','12월'],
            monthNamesShort: ['1월','2월','3월','4월','5월','6월','7월','8월','9월','10월','11월','12월'],
            dayNames: ['일','월','화','수','목','금','토'],
            dayNamesShort: ['일','월','화','수','목','금','토'],
            dayNamesMin: ['일','월','화','수','목','금','토'],
        });
    });
</script>