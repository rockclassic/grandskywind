<div class="row" id="content-wrapper">
    <div class="col-xs-12">
        <? $this->load->view('crm/common/top'); ?>
        <div class='row'>
            <div class='col-sm-12'>
                <div class='box bordered-box muted-border' style='margin-bottom:0;'>
                    <div class='box-header muted-background' style="height:30px;padding: 0px">
                        <div class='title'  ><?=$this->session->userdata('title')?>  </div>
                    </div>

                    <div class='box-content' style="border-bottom: 0;">
                        <form class="form form-horizontal" action="/crm/operation/point" method="post" id="search_form" name="search_form">

                            <table width=100% height=100% cellpadding=0 cellspacing=0 style = 'margin: -20px 0px 0px 0px; '>
                                <tr>
                                    <td align=center valign=middle >

                                        <div class="table_area mt0"><!-- table_area start -->
                                            <!-- 회원유형 -->

                                                <div class="box_gray"> <!-- box wrap -->
                                                    <table class="write">
                                                        <tbody>
                                                        <div class="right_opt">
                                                            <!--<p class="fs11"><span class="essential">*</span> 항목은 필수값입니다.</p>-->
                                                        </div>
                                                        <tr>
                                                            <th scope="row" width="13%" ><!--<span class="essential">*</span>-->세무사무소명</th>
                                                            <td colspan=2 style='text-align:left; '>
                                                                <input type="text" title="세무사무소명" id="ob_officeNm" name="ob_officeNm" class="w100p" maxlength="" value="<?=$ob_officeNm_param?>" />
                                                            </td>
                                                            <th scope="row"><!--<span class="essential">*</span>-->주소</th>
                                                            <td colspan=2>
                                                                <input type="text" title="주소" id="ob_addr" name="ob_addr" class="w100p" maxlength="" value="<?=$ob_addr_param?>"/>
                                                            </td>
                                                        </tr>
                                                        <tr>
                                                            <th scope="row" width="13%" ><label for="sel_prd"><!--<span class="essential">*</span>-->연락처</label></th>
                                                            <td colspan=2>
                                                                <input type="text" title="연락처 입력" id="ob_tel" name="ob_tel" class="w100p" maxlength="" value="<?=$ob_tel_param?>"/>
                                                            </td>
                                                            <th scope="row"><label for="prj_state">상태</label></th>
                                                            <td colspan=2 style='text-align:left; '>
                                                                <select id="ob_state" name='ob_state' style="width: 45%" title="상태선택">
                                                                    <option value=''>상태선택</option>
                                                                        <option value='R' <?=($ob_state_param=='R') ?' selected':''?> >대기</option>
                                                                        <option value='N' <?=($ob_state_param=='N') ?' selected':''?> >미승인</option>
                                                                        <option value='Y' <?=($ob_state_param=='Y') ?' selected':''?> >승인</option>
                                                                </select>
                                                                &nbsp;&nbsp; <select id="orderby" name='orderby' style="width: 45%" title="상태선택">
                                                                    <option value='sum_amount' <?=($orderby=='sum_amount') ?' selected':''?> >가용포인트 </option>
                                                                    <option value='sum_amount_week' <?=($orderby=='sum_amount_week') ?' selected':''?> >7일 소멸 포인트 </option>
                                                                    <option value='t_amount' <?=($orderby=='t_amount') ?' selected':''?> >총적립 포인트 </option>
                                                                    <option value='p_idx' <?=($orderby=='p_idx') ?' selected':''?> >최근가입</option>
                                                                </select>


                                                            </td>
                                                        </tr>

                                                        </tbody>
                                                    </table>

                                                    <div class="col-md-10" style="width:80%;float: left">

                                                    </div>
                                                    <div class="col-md-1" style="width:10%;float: left">
                                                        <button class="btn btn-primary btn_search btn-xs">
                                                            <i class="icon-search"></i>
                                                            검   색
                                                        </button>
                                                    </div>
                                                    <div class="col-md-1" style="width:10%;float: left">

                                                </div> <!-- //box wrap -->

                                            <!-- //회원유형 -->
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

                                        <!-- 회원내역 -->
                                        <div class="table_area "><!-- table_area start -->

                                            <form id="form_prj_inf" name="form_prj_mpr_inf"  method='post' enctype="multipart/form-data" action="">
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
                                                    <caption>조회된 리스트</caption>
                                                    <colgroup>
                                                        <col width="80px" />
                                                        <col width="80px" />
                                                        <col  />
                                                        <col width="150px" />
                                                        <col width="150px" />
                                                        <col width="150px" />
                                                        <col width="150px" />
                                                        <col width="100px" />
                                                        <col width="80px" />
                                                    </colgroup>
                                                    <thead>
                                                    <tr>
                                                        <th scope="col" class="text-center">순위</th>
                                                        <th scope="col" class="text-center">세무사번호</th>
                                                        <th scope="col" class="text-center">세무사무소명</th>
                                                        <th scope="col" class="text-center">총적립 포인트</th>
                                                        <th scope="col" class="text-center">총사용(소멸)포인트</th>
                                                        <th scope="col" class="text-center">가용 포인트</th>
                                                        <th scope="col" class="text-center">7일 이내 소멸예정</th>
                                                        <th scope="col" class="text-center">사용구분</th>
                                                        <th scope="col" class="text-center">관리</th>
                                                    </tr>
                                                    </thead>
                                                    <tbody id="ContentsArea">
                                                    <?
                                                    foreach($list as $k => $v) {
                                                        switch($v['ob_state']) {
                                                            case "R": $ob_state_v = "대기"; break;
                                                            case "N": $ob_state_v = "미승인"; break;
                                                            case "Y": $ob_state_v = "승인"; break;
                                                        }

                                                        ?>
                                                    <tr>
                                                        <td><?=$v['ranking']?></td>
                                                        <td style="text-align: center"><?=$v['ob_office_idx']?></td>
                                                        <td style="text-align: center"><?=$v['ob_officeNm']?></td>
                                                        <td style="background: #ECECEC;text-align: right"><?=number_format($v['t_amount'])?> P</td>
                                                        <td style="background: #ECECEC;text-align: right"><?=number_format($v['used_amount'])?> P</td>
                                                        <td style="background: #ECECEC;text-align: right"><?=number_format($v['sum_amount'])?> P</td>
                                                        <td style="background: #ECECEC;text-align: right"><?=number_format($v['sum_amount_week'])?> P</td>
                                                        <td><?=$ob_state_v?></td>
                                                        <td align="center"><a href="/crm/operation/point_detail/<?=$v['ob_office_idx']?>?t_per_page=<?=$per_page?>" class="btn btn-primary btn-xs">보기</a></td>
                                                    </tr>
                                                        <?
                                                    }
                                                    ?>

                                                    </tbody>
                                                </table>


                                                <div style="padding-top:10px; padding-bottom:0px;">
                                                    <?=$pagination?>
                                                </div>


                                            </form>
                                        </div><!-- table_area end -->


                                        <iframe width=0 height=0 id="iframe" name="iframe" style="display:none;"></iframe>
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


<script language="javascript">

    function set_rank(id){

        <?if($this->openssl_mem->aes_decrypt($this->session->userdata('user_grade'))<=6){?>
        toastr.error('관리자 외에는 변경할 수 없습니다.');
        <?}else{?>
        var answer =fn_only_number($("#answer_"+id).val());
        var sado =fn_only_number($("#sado_"+id).val());
        var choice =fn_only_number($("#choice_"+id).val());

        if(sado>0) {
            var url = '/crm/operation/set_rank';
            var data = {'ob_office_idx': id, 'ob_choice_rank': choice, 'ob_answer_rank': answer, 'ob_sado_rank': sado};
            showSpinner();
            ajax_post(url, data, function (ret) {
                if (ret.msg == 'success') {
                    toastr.success('진행 상태가 변경되었습니다.');
                    hideSpinner();
                    location.reload();
                } else {
                    toastr.error('error : ' + ret.data);
                    hideSpinner();
                }
            });
        }else if(sado=="NaN") {
            toastr.error('숫자만 입력해 주세요');
        }else{
            toastr.error('사도랭킹이 0보다 적을 수 없습니다.');
        }
        <?}?>
    }
</script>
