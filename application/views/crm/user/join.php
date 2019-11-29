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
                        <form class="form form-horizontal" action="/crm/user/join" method="get" id="search_form">
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
                                                                    <option value="jr_officeNm" <?=($search_key=='jr_officeNm') ?' selected':''?> >세무사무소명</option>
                                                                    <option value="jr_reqNm" <?=($search_key=="jr_reqNm")?' selected':''?> >신청자명</option>
                                                                    <option value="jr_tel" <?=($search_key=="jr_tel") ?' selected':''?> >연락처</option>
                                                                </select>
                                                            </th>
                                                            <td colspan=2>
                                                                <input type="text" placeholder="검색 " name="search_val" id="search_val" value="<?=$search_val?>" class="w100p">
                                                            </td>
                                                            <th scope="row"><label for="search_jr_state">진행상태</label></th>
                                                            <td colspan=2 style='text-align:left; '>
                                                                <select name="search_jr_state" id="search_jr_state" class="w50p">
                                                                    <option value="ALL" <?=($search_jr_state=='ALL') ?' selected':''?> >전체</option>
                                                                    <option value="R" <?=($search_jr_state=="R")?' selected':''?> >답변대기</option>
                                                                    <option value="Y" <?=($search_jr_state=="Y") ?' selected':''?> >답변완료</option>
                                                                    <option value="N" <?=($search_jr_state=="N")?' selected':''?> >취소</option>

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
                                                        <th class="text-center" width="80px">번호</th>
                                                        <th class="text-center" >세무사무소명</th>
                                                        <th class="text-center" width="150px">신청자명</th>
                                                        <th class="text-center" width="120px">신청일자</th>
                                                        <th class="text-center" width="180px">연락처</th>
                                                        <th class="text-center" width="100px">진행상태</th>
                                                        <th class="text-center" width="80px">관리</th>
                                                    </tr>
                                                    </thead>
                                                    <tbody>
                                                    <?
                                                    foreach($list as $k => $v) {
                                                        ?>
                                                        <tr>
                                                            <td align="center"><?=$v['jr_joinReq_idx']?></td>
                                                            <td align="center"><?=$v['jr_officeNm']?></td>
                                                            <td align="center"><?=$v['jr_reqNm']?></td>
                                                            <td align="center"><?=fn_ymd($v['jr_regDt'])?></td>
                                                            <td align="center"><?=$this->openssl_mem->aes_decrypt($v['jr_tel'])?></td>
                                                            <td align="center">
                                                                <select name="state_<?=$v['jr_joinReq_idx']?>" id="state_<?=$v['jr_joinReq_idx']?>"  class="w100p">
                                                                    <option value="R" <?=($v['jr_state']=="R")?' selected':''?>>대기</option>
                                                                    <option value="Y" <?=($v['jr_state']=="Y")?' selected':''?>>완료</option>
                                                                    <option value="N" <?=($v['jr_state']=="N")?' selected':''?>>취소</option>
                                                                </select>
                                                            </td>

                                                            <td align="center "><a onclick="chg_state('<?=$v['jr_joinReq_idx']?>')" class="btn btn-warning btn-xs">저장</a></td>

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

    function chg_state(id){

     var state=$("#state_"+id).val();

        var url = '/crm/user/set_join_answer';
        var data = {'jr_joinReq_idx':id,'jr_state':state};
        showSpinner();
        ajax_post(url, data, function(ret) {
            if(ret.msg == 'success') {
                toastr.success('진행 상태가 변경되었습니다.');
                hideSpinner();
            } else {
                toastr.error('error : '+ret.data);
                hideSpinner();
            }
        });
    }
</script>