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
                        <form class="form form-horizontal" action="/crm/operation/infos" method="get" id="search_form">
                            <table width=100% height=100% cellpadding=0 cellspacing=0 style = 'margin: -20px 0px 0px 0px; '>
                                <tr>
                                    <td align=center valign=middle >

                                        <div class="table_area mt0"><!-- table_area start -->
                                            <div class="box_gray"> <!-- box wrap -->
                                                <table class="write">
                                                    <tbody>
                                                    <tr>
                                                        <th scope="row" style="width:10%" >
                                                            <label for="sdate">태그</label>
                                                        </th>
                                                        <td style="width:50%">
                                                            <select name="search_info_tag" id="search_info_tag" style="width: 200px">
                                                                <option value=""> 전 체 </option>
                                                                <?foreach ($info_tag_array as $k => $v){
                                                                    $tag=$v['info_title'];
                                                                    $value=$v['info_value'];
                                                                    if($tag==$search_info_tag) {
                                                                        echo "<option value='$tag' selected> $value</option>";
                                                                    }else{
                                                                        echo "<option value='$tag'> $value</option>";
                                                                    }
                                                                }?>
                                                            </select>
                                                        </td>

                                                        <td style="width:10%">
                                                            <button class="btn btn-primary btn_search btn-xs">
                                                                <i class="icon-search"></i>
                                                                검색
                                                            </button>
                                                        </td>
                                                        <td style="width:10%;text-align: right">
                                                            <a onclick="chg_display();" class="btn btn-warning btn-xs" id="s_open">
                                                                <i class="icon-file"></i>
                                                                신규
                                                            </a>
                                                        </td>
                                                        <td style="width:10%">
                                                        </td>
                                                    </tr>

                                                    </tbody>
                                                </table>
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
                                                        tag
                                                    </th>
                                                    <td width="20%" >

                                                        <select name="info_tag" id="info_tag" class="w50p">
                                                            <?foreach ($info_tag_array as $k => $v){
                                                                $tag=$v['info_title'];
                                                                $value=$v['info_value'];
                                                                if($tag==$search_info_tag) {
                                                                    echo "<option value='$tag' selected> $value</option>";
                                                                }else{
                                                                    echo "<option value='$tag'> $value</option>";
                                                                }
                                                            }?>
                                                        </select>
                                                        <input type="text" placeholder="아이디" name="info_srl" id="info_srl" value="" class="w50p" readonly>

                                                    </td>
                                                    <th scope="row" width="13%" >
                                                        사용유무
                                                    </th>
                                                    <td>
                                                        <select id="info_yn" name="info_yn" class="w100p">
                                                            <option value="Y">사용</option>
                                                            <option value="N">사용안함</option>
                                                        </select>
                                                    </td>
                                                </tr>
                                                <tr>
                                                    <th scope="row" width="13%" >
                                                        타이틀
                                                    </th>
                                                    <td colspan="3">
                                                        <input type="text" placeholder="타이틀" name="info_title" id="info_title" value="" class="w100p">

                                                    </td>
                                                </tr>
                                                <tr>
                                                    <th scope="row" width="13%" >
                                                        value
                                                    </th>
                                                    <td colspan="3">
                                                        <input type="text" placeholder="내용" name="info_value" id="info_value" value="" class="w100p">
                                                    </td>
                                                </tr>
                                                </tbody>
                                            </table>
                                            <div class="row2">
                                                <div class="col-md-9">

                                                </div>
                                                <div class="col-md-1">
                                                    <button class="btn btn-warning btn_search btn-xs" id="s_save">
                                                        <i class="icon-file"></i>
                                                        저장
                                                    </button>
                                                </div>
                                                <div class="col-md-1">
                                                    <a onclick="init_input();" class="btn btn-danger btn-xs" id="i_open">
                                                        <i class="icon-eraser"></i>
                                                        초기화
                                                    </a>

                                                </div>
                                                <div class="col-md-1">
                                                    <a onclick="chg_display();" class="btn btn-close btn-xs" id="s_open">
                                                        <i style="color:#000" class="icon-windows"></i>
                                                        닫기
                                                    </a>
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
                                                    <th class="text-center" width="180px">tag</th>
                                                    <th class="text-center">title</th>
                                                    <th class="text-center" width="150px">value</th>
                                                    <th class="text-center" width="80px">사용유무</th>
                                                    <th class="text-center" width="180px">생성일</th>
                                                    <th class="text-center" width="80px">관리</th>
                                                </tr>
                                                </thead>
                                                <tbody>
                                                <?
                                                foreach($list as $k => $v) {?>
                                                    <tr style="height: 20px">
                                                        <td align="center"><?=$v['info_srl']?></td>
                                                        <td align="center"><?=$v['info_tag']?></td>
                                                        <td align="center"><?=$v['info_title']?></td>
                                                        <td align="center"><?=$v['info_value']?></td>
                                                        <td align="center"><?=$v['info_yn']?></td>
                                                        <td align="center"><?=$v['info_date']?></td>
                                                        <td align="center "><a onclick="popup_open('<?=$v['info_srl']?>')" class="btn btn-primary btn-xs">수정</a></td>
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

    function init_input(){
        $("#info_yn").val('');
        // $("#info_tag").val('infos_tag');
        $("#info_title").val('');
        $("#info_srl").val('');
        $("#info_value").val('');
    }

    //수정창  view show/hide
    function chg_display() {
        init_input();
        if ( $("#new_admin").css("display") == "none" ){
            $("#new_admin").show();
            $("#s_open").hide();
        }else{
            $("#new_admin").hide();
            $("#s_open").show();
        }
    }


    $('#s_save').click(function(){
        if(!$("#info_tag").val()){ toastr.error("태그는 필수 입니다. 확인해 주세요. "); $("#info_tag").focus(); return false;}
        if(!$("#info_title").val()){ toastr.error("타이틀은 필수 입니다. 확인해 주세요. "); $("#info_title").focus(); return false;}
        if(!$("#info_value").val()){ toastr.error("value는 필수 입니다. 확인해 주세요. "); $("#info_value").focus(); return false;}
        if(!confirm('전송하시겠습니까?')) return false;
        var url = '/crm/operation/set_infos';
        var data = {'info_yn':$("#info_yn").val(),'info_tag':$("#info_tag").val(),'info_title':$("#info_title").val(),'info_srl':$("#info_srl").val(),'info_value':$("#info_value").val()};
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
        init_input();
        $("#new_admin").show();
        $("#s_open").hide();
        var url = '/crm/operation/get_infos_one';
        var data = {'info_srl':id};
        showSpinner();
        ajax_post(url, data, function(ret) {
            if(ret.msg == 'success') {
                $("#info_yn").val(ret.data.info_yn);
                $("#info_tag").val(ret.data.info_tag);
                $("#info_title").val(ret.data.info_title);
                $("#info_value").val(ret.data.info_value);
                $("#info_srl").val(ret.data.info_srl);
                $("#new_admin").show();
                $("#s_open").hide();
                hideSpinner();
            } else {
                alert('error : '+ret.data);
                hideSpinner();
            }
        });
    }
</script>