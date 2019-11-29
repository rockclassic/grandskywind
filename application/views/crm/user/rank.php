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
                        <form class="form form-horizontal" action="/crm/operation/rank" method="post" id="search_form" name="search_form">

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
                                                                &nbsp;&nbsp;
                                                                <select id="orderby" name='orderby' style="width: 45%" title="상태선택">
                                                                    <option value='ob_sado_rank' <?=($orderby=='ob_sado_rank') ?' selected':''?> >사도랭킹</option>
                                                                    <option value='ob_answer_rank' <?=($orderby=='ob_answer_rank') ?' selected':''?> >답변랭킹</option>
                                                                    <option value='ob_choice_rank' <?=($orderby=='ob_choice_rank') ?' selected':''?> >초이스랭킹</option>

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
                                                    <caption>조회된 세무사현황 리스트</caption>
                                                    <colgroup>
                                                        <col width="80px" />
                                                        <col  />
                                                        <col width="100px" />
                                                        <col width="100px" />
                                                        <col width="100px" />
                                                        <col width="150px" />
                                                        <col width="150px" />
                                                        <col width="100px" />
                                                        <col width="100px" />
                                                        <col width="80px" />
                                                        <col width="100px" />
                                                        <col width="100px" />
                                                        <col width="100px" />
                                                        <col width="80px" />
                                                        <col width="80px" />
                                                    </colgroup>
                                                    <thead>
                                                    <tr>
                                                        <th scope="col" class="text-center">순위</th>

                                                        <th scope="col" class="text-center">세무사무소명</th>
                                                        <th scope="col" class="text-center">시도</th>
                                                        <th scope="col" class="text-center">구</th>

                                                        <th scope="col" class="text-center">연락처</th>
                                                        <th scope="col" class="text-center">서비스명</th>
                                                        <th scope="col" class="text-center">등록일자</th>
                                                        <th scope="col" class="text-center">시작일자</th>
                                                        <th scope="col" class="text-center">만료일자</th>
                                                        <th scope="col" class="text-center">사용구분</th>
                                                        <th scope="col" class="text-center">답변랭킹 </th>
                                                        <th scope="col" class="text-center">초이스랭킹</th>
                                                        <th scope="col" class="text-center">사도랭킹</th>
                                                        <th scope="col" class="text-center">관리</th>
                                                        <th scope="col" class="text-center">상세정보</th>
                                                    </tr>
                                                    </thead>
                                                    <tbody id="ContentsArea">
                                                    <?
                                                    foreach($list as $k => $v) {
                                                        //ob.ob_office_idx, ob.ob_officeNm, ob.ob_bizNum, ob.ob_bltDt, ob.ob_wrkrNum, ob.ob_email, ob.ob_ceoNm, ob.ob_tel, ob.ob_logo, ob.ob_filePath
                                                        //ob.ob_zip, ob.ob_addr, ob.ob_addr_desc, ob.ob_memo, ob.ob_latitud, ob.ob_longtitud, ob.ob_state, ob.ob_regDt, ob.ob_uptDt, ob.ob_regId, ob.ob_uptId
                                                        //sg.si_svcgdsNm, sg.si_svcgds_amt, ms.ms_mbrBeginDt, ms.ms_mbrEndDt

                                                        switch($v['ob_state']) {
                                                            case "R": $ob_state_v = "대기"; break;
                                                            case "N": $ob_state_v = "미승인"; break;
                                                            case "Y": $ob_state_v = "승인"; break;
                                                        }

                                                        ?>
                                                    <tr>
                                                        <td><?=$v['ranking']?></td>
                                                        <td style="text-align: center"><?=$v['ob_officeNm']?></td>
                                                        <td style="text-align: center"><?=$v['sdg_sido_nm']?> </td>
                                                        <td style="text-align: center"><?=$v['sdg_gu_nm']?> </td>
                                                         <td><?=$this->openssl_mem->aes_decrypt($v['ob_tel'])?></td>
                                                        <td><?=$v['si_svcgdsNm']?></td>
                                                        <td><?=$v['ob_regDt']?></td>
                                                        <td><?=$v['ms_mbrBeginDt']?></td>
                                                        <td><?=$v['ms_mbrEndDt']?></td>
                                                        <td><?=$ob_state_v?></td>
                                                        <td style="background: #ECECEC"><input style="text-align: right;width: 90%;border: 0px;background: #ECECEC" value="<?=number_format($v['ob_answer_rank'])?>" id="answer_<?=$v['ob_office_idx']?>" readonly/> P</td>
                                                        <td style="background: #ECECEC"><input style="text-align: right;width: 90%;border: 0px;background: #ECECEC" value="<?=number_format($v['ob_choice_rank'])?>" id="choice_<?=$v['ob_office_idx']?>" readonly/> P</td>
                                                        <td style="background: #ECECEC"><input style="text-align: right;width: 90%;border: 0px;background: #ECECEC" value="<?=number_format($v['ob_sado_rank'])?>" id="sado_<?=$v['ob_office_idx']?>"/> P</td>
                                                        <td align="center"><a onclick="set_rank('<?=$v['ob_office_idx']?>');" class="btn btn-warning btn-xs">저장</a></td>
                                                        <td align="center"><a href="/crm/mbroffice/desc/<?=$v['ob_office_idx']?>?per_page=<?=$per_page?>" class="btn btn-primary btn-xs">보기</a></td>
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
