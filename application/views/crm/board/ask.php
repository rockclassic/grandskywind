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
                        <form class="form form-horizontal" action="/crm/board/ask" method="get" id="search_form">

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
                                                            <th scope="row" width="13%" ><label for="search_val">검색키워드</label></th>
                                                            <td colspan=2>
                                                                <input type="text" placeholder="검색조건 안됨" name="search_val" id="search_val" value="<?=$search_val?>" class="w100p">
                                                            </td>
                                                            <th scope="row"><label for="prj_state">답변유무</label></th>
                                                            <td colspan=2 style='text-align:left; '>
                                                                <select name="search_ar_state" class="w50p">
                                                                    <option value="ALL" <?=($search_ar_state=='ALL') ?' selected':''?> >전체</option>
                                                                    <option value="R" <?=($search_ar_state=="R")?' selected':''?> >답변대기</option>
                                                                    <option value="Y" <?=($search_ar_state=="Y") ?' selected':''?> >답변완료</option>

                                                                </select>
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
                                                        <th class="text-center" width="80px">고유번호</th>
                                                        <th class="text-center" width="120px">고객명</th>
                                                        <th class="text-center">문의내용</th>
                                                        <th class="text-center" width="180px">등록일</th>
                                                        <th class="text-center" width="100px">답변유뮤</th>
                                                        <th class="text-center" width="80px">관리</th>
                                                    </tr>
                                                    </thead>
                                                    <tbody>
                                                    <?
                                                    foreach($list as $k => $v) {

                                                        if($v['ar_state']=="Y") {
                                                            $targt_gbn = "답변완료";
                                                        }else{
                                                            $targt_gbn="답변대기";
                                                        }

                                                        ?>
                                                        <tr>
                                                            <td align="center"><?=$v['ar_ask_idx']?></td>
                                                            <td align="center"><?=$v['ar_reqNm']?></td>
                                                            <td align="left" class="s-str"><?=$v['ar_ask']?></td>
                                                            <td align="center"><?=$v['ar_regDt']?></td>
                                                            <td align="center"><?=$targt_gbn?></td>

                                                            <td align="center "><a onclick="popup_open('<?=$v['ar_ask_idx']?>','<?=$this->openssl_mem->aes_decrypt($v['ar_tel'])?>')" class="btn btn-primary btn-xs">보기</a></td>

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

<script>

    function popup_open(id,ar_tel){
        $("#sms_title").html('<i class="icon-tags"></i> 1:1문의 상세 정보 [ '+ar_tel+' ]');
        $("#sms_tilte2").html("답변 내용");
        $("#idx").val(id);

        var url = '/crm/board/get_ask_answer';
        var data = {'type':'answer','ar_ask_idx':$("#idx").val()};
        showSpinner();
        ajax_post(url, data, function(ret) {
            if(ret.msg == 'success') {
                $("#message1").val(ret.data.ar_ask);
                $("#message2").val(ret.data.ar_answer);
                $('.sms_popup').toggle();
                hideSpinner();
            } else {
                alert('error : '+ret.data);
                hideSpinner();
            }
        });
    }

    $('.sms_popup_submit').click(function(){

        if(!$("#message2").val()){ alert("입력내용은 필수 입니다. 확인해 주세요. "); $("#message2").focus(); return false;}
        if(!confirm('전송하시겠습니까?')) return false;
        var url = '/crm/board/set_ask_answer';
        var data = {'ar_ask_idx':$("#idx").val(),'ar_answer':$("#message2").val()};
        showSpinner();
        ajax_post(url, data, function(ret) {
            if(ret.msg == 'success') {
                toastr.success('저장 되었습니다.');
                hideSpinner();
                location.reload();
            } else {
                toastr.error('error : '+ret.data);
                hideSpinner();
            }
            $('.sms_popup').hide();
        });

    });
</script>