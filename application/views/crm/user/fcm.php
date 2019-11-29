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
                        <form class="form form-horizontal" action="/crm/operation/fcm" method="get" id="search_form">
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
                                                        <a onclick="chg_display();" class="btn btn-warning btn-xs" id="s_open">
                                                            <i class="icon-file"></i>
                                                            FCM 전송창
                                                        </a>
                                                    </div>

                                                </div>
                                            </div> <!-- //box wrap -->
                                        </div>

                                    </td>

                                </tr>
                            </table>

                        </form>
                    </div>
                    <div class='box-content' style="border-bottom: 0;display: none" id="new_admin">
                        <table width=100% height=100% cellpadding=0 cellspacing=0 style = 'margin: -20px 0px 0px 0px; '>
                            <tr>
                                <td align=center valign=middle >

                                    <div class="table_area mt0"><!-- table_area start -->
                                        <div class="box_gray"> <!-- box wrap -->
                                            <table class="write">
                                                <tbody>
                                                <tr>
                                                    <th scope="row" width="13%" >
                                                        회원구분
                                                    </th>
                                                    <td width="20%" >
                                                        <select id="f_send_idx" name="f_send_idx" class="w100p">
                                                            <option value="user">고객</option>
                                                            <option value="partner">세무사</option>
                                                        </select>
                                                    </td>
                                                    <th scope="row" width="13%" >
                                                        메모
                                                    </th>
                                                    <td>
                                                        <input type="text" placeholder="메모" name="f_memo" id="f_memo" value="" class="w100p">
                                                    </td>
                                                </tr>
                                                <tr>
                                                    <th scope="row" width="13%" >
                                                        타이틀
                                                    </th>
                                                    <td colspan="3">
                                                        <input type="text" placeholder="타이틀" name="f_title" id="f_title" value="" class="w100p">
                                                    </td>
                                                </tr>
                                                <tr>
                                                    <th scope="row" width="13%" >
                                                        전송 메세지
                                                    </th>
                                                    <td colspan="3">
                                                        <textarea name="f_send_msg" id="f_send_msg" value="" class="w100p" style="height: 100px"> </textarea>
                                                    </td>
                                                </tr>
                                                </tbody>
                                            </table>
                                            <div class="row2">
                                                <div class="col-md-10">

                                                </div>
                                                <div class="col-md-1">
                                                    <button class="btn btn-warning btn_search btn-xs" id="s_save">
                                                        <i class="icon-file"></i>
                                                        FCM 전송
                                                    </button>
                                                </div>
                                                <div class="col-md-1">

                                                </div>

                                            </div>
                                        </div> <!-- //box wrap -->
                                    </div>

                                </td>

                            </tr>
                        </table>
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
                                                    <th class="text-center" width="180px">전송일자</th>
                                                    <th class="text-center" width="150px">수신자</th>

                                                    <th class="text-center">전송내용</th>
                                                    <th class="text-center" width="300px">전송결과</th>
                                                    <th class="text-center" width="80px">상세보기</th>
                                                </tr>
                                                </thead>
                                                <tbody>
                                                <?
                                                foreach($list as $k => $v) {


                                                        if(is_array(json_decode($v['f_send_idx']))) {

                                                            $f_send_idx_tmp=json_decode($v['f_send_idx']);
                                                            $f_send_idx= count($f_send_idx_tmp)."명에게 전송";

                                                        }else{
                                                            $f_send_idx_tmp= json_decode($v['f_send_idx']);
                                                            $f_send_idx= $f_send_idx_tmp;
                                                        }

                                                    ?>
                                                    <tr style="height: 20px">
                                                        <td align="center"><?=$v['f_idx']?></td>
                                                        <td align="center"><?=$v['f_sendDt']?></td>
                                                        <td align="center" class="s-str"  title="<?=$f_send_idx_tmp?>"> <?=$f_send_idx?></td>
                                                        <td align="center" class="s-str" ><?=$v['f_title']?></td>
                                                        <td align="center" class="s-str" title="<?=$v['f_ret']?>"><?=$v['f_ret']?></td>
                                                        <td align="center "><a onclick="popup_open('<?=$v['f_idx']?>')" class="btn btn-primary btn-xs">보기</a></td>
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
        $("#sms_title").html('<i class="icon-tags"></i> Fcm 전송 상세 내역');
        $("#idx").val(id);
        $("#sms_tilte1").show();

        $("#sms_tilte2").html("전송결과");

        $('#message1').css("border","1px solid #d5d5d5"); //설정
        $('#message1').attr("readonly",true); //설정
        $('#message2').attr("readonly",true); //설정



        var url = '/crm/operation/get_fcm_one';
        var data = {'f_idx':id};
        showSpinner();
        ajax_post(url, data, function(ret) {
            console.log(ret);
            if(ret.msg == 'success') {
                $("#sms_tilte1").html(ret.data.f_title);
                $("#message1").val(ret.data.f_send_msg);
                $("#message2").val(ret.data.f_ret);
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