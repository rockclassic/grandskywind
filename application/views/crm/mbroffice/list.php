<div class="row" id="content-wrapper">
    <div class="col-xs-12">
        <? $this->load->view('crm/common/top'); ?>
        <div class='row'>
            <div class='col-sm-12'>
                <div class='box bordered-box muted-border' style='margin-bottom:0;'>
                    <div class='box-header muted-background' style="height:30px;padding: 0px">
                        <div class='title'  ><?=$this->session->userdata('title')?> 리스트 </div>
                    </div>

                    <div class='box-content' style="border-bottom: 0;">
                        <form class="form form-horizontal" action="/crm/mbroffice/list" method="post" id="search_form" name="search_form">

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
                                                                <select id="ob_state" name='ob_state' class="w50p" title="상태선택">
                                                                    <option value=''>상태선택</option>
                                                                        <option value='R' <?=($ob_state_param=='R') ?' selected':''?> >대기</option>
                                                                        <option value='N' <?=($ob_state_param=='N') ?' selected':''?> >미승인</option>
                                                                        <option value='Y' <?=($ob_state_param=='Y') ?' selected':''?> >승인</option>
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
                                                            <a href="javascript:get_office_srch();" style="color:#fff">검   색</a>
                                                        </button>
                                                    </div>
                                                    <div class="col-md-1" style="width:10%;float: left">

                                                    <? if($this->openssl_mem->aes_decrypt($this->session->userdata('user_grade'))>=7){ ?>

                                                    <div class="col-md-1">
                                                        <a href="/crm/mbroffice/reg?per_page=<?=$per_page?>" class="btn btn-warning btn-xs">
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
                                                        <span class="title_cmt"> 조회세무사 [<strong class="fc_blue" id="total_cnt"><?=$srch_count?></strong>건] / 전체세무사 [<strong class="fc_blue" id="all_total_cnt"><?=$ttl_count?></strong>건]</span>
                                                    </div>

                                                    <? } ?>

                                                    <!--
                                                    <ul class="right_opt">
                                                        <li class="sbtn"><a href="javascript:void $.fn.excel_download();"><span class="">Excel 다운로드</span></a></li>
                                                    </ul>
                                                    -->
                                                </div><!-- table_top end -->

                                                <table class="list over-list">
                                                    <caption>조회된 세무사현황 리스트</caption>
                                                    <colgroup>
                                                        <col width="80px" />
                                                        <col width="120px" />
                                                        <col width="150px" />
                                                        <col width="80px" />
                                                        <col  />
                                                        <col width="150px" />
                                                        <col width="150px" />
                                                        <col width="100px" />
                                                        <col width="100px" />
                                                        <col width="80px" />
                                                        <col width="80px" />
                                                    </colgroup>
                                                    <thead>
                                                    <tr>
                                                        <th scope="col" class="text-center">고유번호</th>
                                                        <th scope="col" class="text-center">서비스명</th>
                                                        <th scope="col" class="text-center">세무사무소명</th>
                                                        <th scope="col" class="text-center">보유인력</th>
                                                        <th scope="col" class="text-center">주소</th>
                                                        <th scope="col" class="text-center">연락처</th>
                                                        <th scope="col" class="text-center">등록일자</th>
                                                        <th scope="col" class="text-center">시작일자</th>
                                                        <th scope="col" class="text-center">만료일자</th>
                                                        <th scope="col" class="text-center">사용구분</th>
                                                        <th scope="col" class="text-center">관리</th>
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
                                                        <td><?=$v['ob_office_idx']?></td>
                                                        <td><?=$v['si_svcgdsNm']?></td>
                                                        <td style="text-align: center"><?=$v['ob_officeNm']?></td>
                                                        <td style="text-align: right"><?=number_format($v['ob_wrkrNum'])?> 명</td>
                                                        <td style="text-align: center"><?=$v['ob_addr'].' '.$v['ob_addr_desc']?></td>
                                                        <td><?=$this->openssl_mem->aes_decrypt($v['ob_tel'])?></td>
                                                        <td><?=$v['ob_regDt']?></td>
                                                        <td><?=$v['ms_mbrBeginDt']?></td>
                                                        <td><?=$v['ms_mbrEndDt']?></td>
                                                        <td><?=$ob_state_v?></td>
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

    $(document).ready(function() {



    });



    function get_office_srch_bak(){
        var url = '/crm/mbroffice/list';

        var ob_officeNm = $("#ob_officeNm").val();
        var ob_addr = $("#ob_addr").val();
        var ob_tel = $("#ob_tel").val();
        var ob_state = $('#ob_state option:selected').val();
        // var data = $('#search_form').serialize();

        /*var data = new Object();
        data.ob_officeNm = ob_officeNm;
        data.ob_addr = ob_addr;
        data.ob_tel = ob_tel;
        data.ob_state = ob_state;*/

        var data = {
            "ob_officeNm" : ob_officeNm,
            "ob_addr" : ob_addr,
            "ob_tel" : ob_tel,
            "ob_state" : ob_state
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


    function get_office_srch(){
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

        $('#search_form').attr({action:'/crm/mbroffice/list', method:'post'}).submit();
    }





</script>




<?
/*

    <div class="navi_wrap">
        <div class="navi">
            회원관리
        </div>
    </div>
    <div class="main_search">
        <div class="search_content">
            <form action="/dashboard/user/" method="get" id="search_form">
            <table>
                <tbody><tr>
                    <td class="summary" colspan="10">
                    </td>
                </tr>
                <tr>
                    <td class="title">상세검색</td>
                    <td>
                        <select name="search_key">
<?
$select = array(
    'USER.user_email1' => '이메일(@앞자리)',
    'USER.user_email' => '이메일 전체',
    'USER.user_name' => '이름',
    'UPHONE.user_auth_phone_2' => '핸드폰 가운데',
    'UPHONE.user_auth_phone_3' => '핸드폰 마지막',
);
foreach($select as $k => $v) {
    echo '<option value="'.$k.'"';
    if($search_key == $k) echo ' selected';
    echo '>'.$v.'</option>';
}
?>
                        </select>
                    </td>
                    <td><input type="text" name="search_val" value="<?=$search_val?>" class=""></td>
                    <td class="title"></td>
                    <td>
                    </td>
                    <td></td>
                    <td><button class="btn_search">검색</button></td>
                </tr>
            </tbody></table>
            </form>
        </div>
    </div>
    <div class="main_content">
        <div class="content_navi">
        . 회원수 : <?=number_format($count)?>건
        </div>
        <div class="content" id="company_list">
            <table>
                <thead>
                <tr>
                    <td rowspan="2">PK</td>
                    <td rowspan="2">이메일</td>
                    <td rowspan="2">이름</td>
                    <td rowspan="2">핸드폰</td>
                    <td rowspan="2">Google OTP</td>
                    <td colspan="6">인증</td>
                    <td rowspan="2">가입일시</td>
                </tr>
                <tr>
                    <td>핸드폰</td>
                    <td>이메일</td>
                    <td>실명</td>
                    <td>신분증</td>
                    <td>개인계약서</td>
                    <td>거주지</td>
                </tr>
                </thead>
                <tbody>
<?
foreach($list as $k => $v) {
?>
                <tr>
                    <td><?=$v['user_srl']?></td>
                    <td><a href="/dashboard/user/detail/<?=$v['user_srl']?>"><?=$v['user_email']?></a></td>
                    <td><?=$v['user_name']?></td>
                    <td><?=$v['user_phone']?></td>
                    <td><?=$v['user_auth_otp']?></td>
                    <td><?=$v['user_auth_phone']?></td>
                    <td><?=$v['user_auth_email']?></td>
                    <td><?=$v['user_auth_name']?></td>
                    <td><?=$v['user_auth_idcard']?></td>
                    <td><?=$v['user_auth_pledge']?></td>
                    <td><?=$v['user_auth_resident']?></td>
                    <td><?=$v['user_date']?></td>
                </tr>
<?
}
?>
                </tbody>
            </table>
        </div>
        <div class="page"><?=$pagination?></div>
    </div>
<script>
$(document).ready(function() {
});
</script>
*/
?>