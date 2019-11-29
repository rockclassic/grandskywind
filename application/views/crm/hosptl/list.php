

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
                        <form class="form form-horizontal" action="/crm/hosptl/list" method="post" id="search_form" name="search_form">

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
                                                            <th scope="row" width="13%" ><!--<span class="essential">*</span>-->제휴병원명</th>
                                                            <td colspan=2 style='text-align:left; '>
                                                                <input type="text" title="제휴병원명" id="hb_hosptl_nm" name="hb_hosptl_nm" class="w100p" maxlength="" value="<?=$hb_hosptl_nm_param?>" />
                                                            </td>
                                                            <th scope="row"><!--<span class="essential">*</span>-->주소</th>
                                                            <td colspan=2>
                                                                <input type="text" title="주소" id="hb_addr" name="hb_addr" class="w100p" maxlength="" value="<?=$hb_addr_param?>"/>
                                                            </td>
                                                        </tr>
                                                        <tr>
                                                            <th scope="row" width="13%" ><label for="sel_prd"><!--<span class="essential">*</span>-->연락처</label></th>
                                                            <td colspan=2>
                                                                <input type="text" title="연락처 입력" id="hb_tel" name="hb_tel" class="w100p" maxlength="" value="<?=$hb_tel_param?>"/>
                                                            </td>
                                                            <th scope="row"><label for="hb_state">상태</label></th>
                                                            <td colspan=2 style='text-align:left; '>
                                                                <select id="hb_state" name='hb_state' class="w50p" title="상태선택">
                                                                    <option value=''>상태선택</option>
                                                                        <option value='R' <?=($hb_state_param=='R') ?' selected':''?> >대기</option>
                                                                        <option value='N' <?=($hb_state_param=='N') ?' selected':''?> >미승인</option>
                                                                        <option value='Y' <?=($hb_state_param=='Y') ?' selected':''?> >승인</option>
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
                                                            <a href="javascript:get_hosptl_srch();" style="color:#fff">검   색</a>
                                                        </button>
                                                    </div>
                                                    <div class="col-md-1" style="width:10%;float: left">

                                                    <? if($this->openssl_mem->aes_decrypt($this->session->userdata('user_grade'))>=7){ ?>

                                                    <div class="col-md-1">
                                                        <a href="/crm/hosptl/reg?per_page=<?=$per_page?>" class="btn btn-warning btn-xs">
                                                            <i class="icon-file"></i>
                                                            신규등록
                                                        </a>
                                                    </div>

                                                    <? } ?>

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

                                                    <? if($this->openssl_mem->aes_decrypt($this->session->userdata('user_grade'))>=7){ ?>

                                                    <div class="left_opt">
                                                        <span class="title_cmt"> 조회병원 [<strong class="fc_blue" id="total_cnt"><?=$srch_count?></strong>건] / 전체병원 [<strong class="fc_blue" id="all_total_cnt"><?=$ttl_count?></strong>건]</span>
                                                    </div>

                                                    <? } ?>

                                                    <!--
                                                    <ul class="right_opt">
                                                        <li class="sbtn"><a href="javascript:void $.fn.excel_download();"><span class="">Excel 다운로드</span></a></li>
                                                    </ul>
                                                    -->
                                                </div><!-- table_top end -->

                                                <table class="list over-list">
                                                    <caption>조회된 병원현황 리스트</caption>
                                                    <colgroup>
                                                        <col width="80px" />
                                                        <col width="150px" />
                                                        <col width="150px"  />
                                                        <col width="100px" />
                                                        <col width="100px" />

                                                        <col width="200px" />
                                                        <col width="60px" />
                                                        <col width="60px" />
                                                        <col width="60px" />
                                                        <col width="60px" />

                                                        <col width="60px" />
                                                        <col width="60px" />
                                                    </colgroup>
                                                    <thead>
                                                    <tr>
                                                        <th scope="col" class="text-center">고유번호</th>
                                                        <th scope="col" class="text-center">병원명</th>
                                                        <th scope="col" class="text-center">간략주소</th>
                                                        <th scope="col" class="text-center">연락처</th>
                                                        <th scope="col" class="text-center">등록일자</th>

                                                        <th scope="col" class="text-center">진료과목</th>
                                                        <th scope="col" class="text-center">병원구분</th>
                                                        <th scope="col" class="text-center">예약구분</th>
                                                        <th scope="col" class="text-center">접수구분</th>
                                                        <th scope="col" class="text-center">견적구분</th>

                                                        <th scope="col" class="text-center">상태구분</th>
                                                        <th scope="col" class="text-center">관리</th>
                                                    </tr>
                                                    </thead>
                                                    <tbody id="ContentsArea">
                                                    <?
                                                    foreach($list as $k => $v) {
                                                        // hb_idx,hb_hosptl_nm,hb_zip_num,hb_addr,hb_addr_desc,hb_sido,hb_gu,hb_latitude,hb_longtitude,hb_tel,hb_intro,hb_img,hb_img_path,hb_img_width,hb_img_height,hb_memo,
                                                        // hb_mdcalsubjct_cd,hb_hosptl_gbn,hb_reserv_gbn,hb_accpt_gbn,hb_estmate_gbn,hb_state,
                                                        // hb_regdt,hb_uptdt,hb_regid,hb_uptid

                                                        switch($v['hb_hosptl_gbn']) {
                                                            case "T": $hb_hosptl_gbn_v = "치과병원"; break;
                                                            case "B": $hb_hosptl_gbn_v = "성형병원"; break;
                                                            case "E": $hb_hosptl_gbn_v = "기타병원"; break;
                                                        }
                                                        switch($v['hb_reserv_gbn']) {
                                                            case "N": $hb_reserv_gbn_v = "예약불가"; break;
                                                            case "Y": $hb_reserv_gbn_v = "예약가능"; break;
                                                        }
                                                        switch($v['hb_accpt_gbn']) {
                                                            case "N": $hb_accpt_gbn_v = "접수불가"; break;
                                                            case "Y": $hb_accpt_gbn_v = "접수가능"; break;
                                                        }
                                                        switch($v['hb_estmate_gbn']) {
                                                            case "N": $hb_estmate_gbn_v = "견적불가"; break;
                                                            case "Y": $hb_estmate_gbn_v = "견적가능"; break;
                                                        }
                                                        switch($v['hb_state']) {
                                                            case "R": $hb_state_v = "대기"; break;
                                                            case "N": $hb_state_v = "미승인"; break;
                                                            case "Y": $hb_state_v = "승인"; break;
                                                        }
                                                        ?>
                                                    <tr>
                                                        <td><?=$v['hb_idx']?></td>
                                                        <td><?=$v['hb_hosptl_nm']?></td>
                                                        <td style="text-align: center"><?=$v['hb_sido']?> <?=$v['hb_gu']?></td>
                                                        <td style="text-align: right"><?=$this->openssl_mem->aes_decrypt($v['hb_tel'])?> </td>
                                                        <td style="text-align: center"><?=$v['hb_regdt']?> </td>
                                                        <td><?=$v['hb_mdcalsubjct_cd_v']?></td>
                                                        <td><?=$hb_hosptl_gbn_v?></td>
                                                        <td><?=$hb_reserv_gbn_v?></td>
                                                        <td><?=$hb_accpt_gbn_v?></td>
                                                        <td><?=$hb_estmate_gbn_v?></td>
                                                        <td><?=$hb_state_v?></td>
                                                        <td align="center"><a href="/crm/hosptl/desc/<?=$v['hb_idx']?>?per_page=<?=$per_page?>" class="btn btn-primary btn-xs">보기</a></td>
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

    $(document).ready(function() {



    });



    function get_hosptl_srch_bak(){
        var url = '/crm/hosptl/list';

        var hb_hosptl_nm = $("#hb_hosptl_nm").val();
        var hb_addr = $("#hb_addr").val();
        var hb_tel = $("#hb_tel").val();
        var hb_state = $('#hb_state option:selected').val();
        // var data = $('#search_form').serialize();

        /*var data = new Object();
        data.ob_officeNm = ob_officeNm;
        data.ob_addr = ob_addr;
        data.ob_tel = ob_tel;
        data.ob_state = ob_state;*/

        var data = {
            "hb_hosptl_nm" : hb_hosptl_nm,
            "hb_addr" : hb_addr,
            "hb_tel" : hb_tel,
            "hb_state" : hb_state
        }
        console.log(data);

        ajax_post(url, data, function(ret) {
            if(ret.msg == 'success') {
                alert('처리되었습니다.');
                console.log(ret);
            } else {
                alert('error : '+ret.data);
            }
        });

    }


    function get_hosptl_srch(){
        /*
        $.ajax({
            url:'/crm/mbroffice/list',
            type:'post',
            data:$("#search_form").serialize(),
            dataType: "json",
            contenttype = 'application/json; charset=utf-8',
            async: false,
            error: function(xhr, status, errorThrown){
                alert("1."+errorThrown+"\n2."+status+"\n3."+xhr.statusText+'\n4.'+xhr.status );
            },
            success:function(data){

            }
        });
        */

        $('#search_form').attr({action:'/crm/hosptl/list', method:'post'}).submit();
    }





</script>





