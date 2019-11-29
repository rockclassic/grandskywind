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
                        <form class="form form-horizontal" action="/crm/operation/user_setting" method="get" id="search_form">
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
                                                            <th scope="row" width="13%" >
                                                                <select name="search_key" id="search_key" class="w100p">
                                                                    <option value="hc_id" <?=($search_key=='hc_id')?' selected':''?> >아이디</option>
                                                                    <option value="hc_nm" <?=($search_key=="hc_nm")?' selected':''?> >관리자명</option>

                                                                </select>
                                                            </th>
                                                            <td colspan=2>
                                                                <input type="text" placeholder="검색 " name="search_val" id="search_val" value="<?=$search_val?>" class="w100p">
                                                            </td>
                                                            <th scope="row"><label for="search_jr_state">진행상태</label></th>
                                                            <td  style='text-align:left; '>
                                                                <select name="search_state" id="search_state" class="w100p">
                                                                    <option value="ALL" <?=($search_state=='ALL') ?' selected':''?> >사용유무</option>
                                                                    <option value="Y" <?=($search_state=="Y") ?' selected':''?> >사용</option>
                                                                    <option value="N" <?=($search_state=="N")?' selected':''?> >차단</option>

                                                                </select>
                                                            </td>
                                                            <td  style='text-align:left; '>
                                                                <select name="search_grade" id="search_grade" class="w100p">
                                                                    <option value="ALL" <?=($search_grade=='ALL') ?' selected':''?> >회원등급</option>
                                                                    <?foreach ($infos_array as $k => $v){?>
                                                                        <option value="<?=$v['info_value']?>" <?=($v['info_value']==$search_grade) ?' selected':''?> ><?=$v['info_title']?></option>
                                                                    <?}?>
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
                                                        <a onclick="chg_display();" class="btn btn-warning btn-xs" id="s_open">
                                                            <i class="icon-file"></i>
                                                            신규추가
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
                                                           아이디
                                                        </th>
                                                        <td colspan=1>
                                                            <input type="text" placeholder="아이디 " name="s_hc_id" id="s_hc_id" value="" class="w100p">
                                                        </td>
                                                        <th scope="row" width="13%" >
                                                            이름
                                                        </th>
                                                        <td colspan=1>
                                                            <input type="text" placeholder="이름 " name="s_hc_nm" id="s_hc_nm" value="" class="w100p">
                                                        </td>
                                                        <th scope="row"><label for="s_ac_grade">사용유무</label></th>
                                                        <td  style='text-align:left; '>
                                                            <select name="s_hc_state" id="s_hc_state" class="w100p">
                                                                <option value="Y"  >사용</option>
                                                                <option value="N"  >차단</option>

                                                            </select>
                                                        </td>
                                                        <th scope="row"><label for="s_hc_grade">등급</label></th>
                                                        <td  style='text-align:left; '>
                                                            <select name="s_hc_grade" id="s_hc_grade" class="w100p">
                                                                <?foreach ($infos_array as $k => $v){?>
                                                                    <option value="<?=$v['info_value']?>"  ><?=$v['info_title']?></option>
                                                                <?}?>
                                                            </select>
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
                                                            신규계정저장
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
                                                        <th class="text-center" >아이디</th>
                                                        <th class="text-center" width="150px">이름</th>
                                                        <th class="text-center" width="150px">사용자 등급</th>
                                                        <th class="text-center" width="150px">사용유무</th>
                                                        <th class="text-center" width="150px">등록일자</th>
                                                        <th class="text-center" width="120px">저장</th>
                                                        <th class="text-center" width="120px">비밀번호 초기화</th>
                                                    </tr>
                                                    </thead>
                                                    <tbody>
                                                    <?
                                                    foreach($list as $k => $v) {
                                                        ?>
                                                        <tr>
                                                            <td align="center"><?=$v['hc_idx']?></td>
                                                            <td align="center"><?=$v['hc_id']?></td>
                                                            <td align="center"><?=$v['hc_nm']?></td>
                                                            <td align="center">
                                                                <select name="grade_<?=$v['hb_idx']?>" id="grade_<?=$v['hb_idx']?>"  class="w100p">
                                                                    <?foreach ($infos_array as $kk => $vv){?>
                                                                        <option value="<?=$vv['info_value']?>" <?=($vv['info_value']==$v['ac_grade']) ?' selected':''?> ><?=$vv['info_title']?></option>
                                                                    <?}?>
                                                                </select>
                                                            </td>
                                                            <td align="center">
                                                                <select name="state_<?=$v['hc_idx']?>" id="state_<?=$v['hc_idx']?>"  class="w100p">
                                                                    <option value="Y" <?=($v['hc_state']=="Y")?' selected':''?>>사용</option>
                                                                    <option value="N" <?=($v['hc_state']=="N")?' selected':''?>>차단</option>
                                                                </select>
                                                            </td>
                                                            <td align="center"><?=$v['hc_regdt']?></td>
                                                            <td align="center "><a onclick="chg_state('<?=$v['hc_idx']?>')" class="btn btn-warning btn-xs">저장</a></td>
                                                            <td align="center "><a onclick="chg_pwd('<?=$v['hc_idx']?>')" class="btn btn-success btn-xs">초기화</a></td>
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

    //신규 계정 view show/hide
    function chg_display() {

        if ( $("#new_admin").css("display") == "none" ){
            $("#s_hc_id").val('');
            $("#s_hc_nm").val('');
            $("#s_hc_state").val('Y');
            $("#s_hc_grade").val('9');
            $("#new_admin").show();
            $("#s_open").hide();
        }else{
            $("#s_hc_id").val('');
            $("#s_hc_nm").val('');
            $("#s_hc_state").val('Y');
            $("#s_hc_grade").val('9');
            $("#new_admin").hide();
            $("#s_open").show();
        }
    }

    //신규계정저장
    $('#s_save').click(function(){
        if(!$("#s_hc_id").val()){ toastr.error("아이디는 필수 입니다. 확인해 주세요. "); $("#s_hc_id").focus(); return false;}
        if(!$("#s_hc_nm").val()){ toastr.error("이름은 필수 입니다. 확인해 주세요. "); $("#s_hc_nm").focus(); return false;}
        if(!confirm('전송하시겠습니까?')) return false;
        var url = '/crm/operation/set_admin';
        var data = {'hc_idx':'','hc_id':$("#s_hc_id").val(),'hc_nm':$("#s_hc_nm").val(),'hc_state':$("#s_hc_state").val(),'hc_grade':$("#s_hc_grade").val()};
        showSpinner();
        ajax_post(url, data, function(ret) {
            if(ret.msg == 'success') {
                toastr.success('신규 계정이 추가되었습니다.');
                hideSpinner();
                location.reload();
            } else {
                toastr.error('error : '+ret.data);
                hideSpinner();
            }
        });

    });

    //업데이트
    function chg_state(id){
     var state=$("#state_"+id).val();
     var grade=$("#grade_"+id).val();
        var url = '/crm/operation/set_admin';
        var data = {'hc_idx':id,'hc_state':state,'hc_grade':grade};
        showSpinner();
        ajax_post(url, data, function(ret) {
            if(ret.msg == 'success') {
                toastr.success('정보가 변경되었습니다.');
                hideSpinner();
            } else {
                toastr.error('error : '+ret.data);
                hideSpinner();
            }
        });
    }
    //비번 초기화
    function chg_pwd(id) {
        var url = '/crm/operation/set_admin';
        var data = {'hc_idx':id,'hc_pwd':'Y'};
        showSpinner();
        ajax_post(url, data, function(ret) {
            if(ret.msg == 'success') {
                toastr.success('정보가 변경되었습니다.');
                hideSpinner();
            } else {
                toastr.error('error : '+ret.data);
                hideSpinner();
            }
        });
    }
</script>