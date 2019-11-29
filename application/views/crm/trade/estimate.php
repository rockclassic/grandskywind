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
                        <form class="form form-horizontal" action="/crm/trade/estimate" method="get" id="search_form">
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
                                                                    <option value="em_estmtReqNm" <?=($search_key=="em_estmtReqNm")?' selected':''?> >신청자명</option>
                                                                    <option value="em_tel" <?=($search_key=="em_tel") ?' selected':''?> >연락처</option>
                                                                </select>
                                                            </th>
                                                            <td colspan=2>
                                                                <input type="text" placeholder="검색 " name="search_val" id="search_val" value="<?=$search_val?>" class="w100p">
                                                            </td>
                                                            <th scope="row"><label for="search_jr_state">카테고리 구분</label></th>
                                                            <td colspan=2 style='text-align:left; '>
                                                                <select name="search_em_type" id="search_em_type" class="w50p">
                                                                    <option value="ALL" <?=($search_em_type=="ALL")?' selected':''?> >전체</option>

                                                                    <?foreach ($infos_array as $k => $v){?>
                                                                        <option value="<?=$v['info_value']?>" <?=($v['info_value']==$search_em_type) ?' selected':''?> ><?=$v['info_title']?></option>
                                                                    <?}?>
                                                                </select>
                                                            </td>

                                                        </tr>
                                                        <tr>
                                                            <th scope="row" width="13%" >
                                                                <label for="sdate">검색시작일</label>
                                                            </th>
                                                            <td colspan=2>
                                                                <input type="text" id="sdate" name="sdate" class="w50p"  value="<?=$sdate?>"/>
                                                            </td>
                                                            <th scope="row" width="13%" >
                                                                <label for="edate">검색마지막일</label>
                                                            </th>
                                                            <td colspan=2>
                                                                <input type="text" id="edate" name="edate" class="w50p"  value="<?=$edate?>"/>
                                                            </td>
                                                        </tr>

                                                        </tbody>
                                                    </table>
                                                    <div class="row2">
                                                        <div class="col-md-10" style="text-align: left">
                                                            <label for="chk_only">자기 답변 견적만 검색하기</label> <input type="checkbox" id="chk_only" name="chk_only"  <?=($chk_only=="on") ?' checked':''?>/>
                                                            <label for="chk_only_y">자기 완료 답변 견적만 검색하기</label> <input type="checkbox" id="chk_only_y" name="chk_only_y"  <?=($chk_only_y=="on") ?' checked':''?>/>
                                                        </div>
                                                    <div class="col-md-1">
                                                        <button class="btn btn-primary btn_search btn-xs">
                                                            <i class="icon-search"></i>
                                                            검색
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
                                                        <th class="text-center" width="180px">신청일자</th>
                                                        <th class="text-center" width="150px">신청자명</th>
                                                        <th class="text-center" width="150px">연락처</th>
                                                        <th class="text-center" >카테고리구분</th>

                                                        <th class="text-center" width="80px">견적개수</th>
                                                        <th class="text-center" width="100px">견적상태</th>
                                                        <th class="text-center" width="100px">상태변경</th>
                                                        <th class="text-center" width="100px">상세내역</th>
                                                    </tr>
                                                    </thead>
                                                    <tbody>
                                                    <?
                                                    foreach($list as $k => $v) {?>
                                                        <tr>
                                                            <td align="center"><?=$v['em_estmtReq_idx']?></td>
                                                            <td align="center"><?=$v['em_regDt']?></td>
                                                            <td align="center"><?=$v['em_estmtReqNm']?></td>
                                                            <?if($this->openssl_mem->aes_decrypt($this->session->userdata('user_grade'))<=6){?>
                                                                <td align="center">...</td>
                                                            <?}else{?>
                                                            <td align="center"><?=$this->openssl_mem->aes_decrypt($v['em_tel'])?></td>
                                                            <?}?>
                                                            <td align="center"><?=$v['em_c1']?></td>
                                                            <td align="right" style="text-align: right"> <?=number_format($v['em_cnt'])?> 건</td>
                                                            <td align="center">
                                                                <select name="state_<?=$v['em_estmtReq_idx']?>" id="state_<?=$v['em_estmtReq_idx']?>"  class="w100p">
                                                                    <option value="R" <?=($v['em_state']=="R")?' selected':''?>>대기</option>
                                                                    <option value="Y" <?=($v['em_state']=="Y")?' selected':''?>>완료</option>
                                                                    <option value="N" <?=($v['em_state']=="N")?' selected':''?>>취소</option>
                                                                </select>
                                                            </td>

                                                            <td align="center "><a onclick="chg_state('<?=$v['em_estmtReq_idx']?>')" class="btn btn-warning btn-xs">상태변경</a></td>

                                                            <td align="center "><a href="/crm/trade/detail/<?=$v['em_estmtReq_idx']?>?t_per_page=<?=$per_page?>" class="btn btn-primary btn-xs">보기</a></td>
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
        <?if($this->openssl_mem->aes_decrypt($this->session->userdata('user_grade'))<=6){?>
        toastr.error('관리자 외에는 변경할 수 없습니다.');
    <?}else{?>
        var state=$("#state_"+id).val();

        var url = '/crm/trade/update_em_state';
        var data = {'em_estmtReq_idx':id,'em_state':state};
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
        <?}?>
    }

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