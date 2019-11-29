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
                        <form class="form form-horizontal" action="/crm/taxcounsel/list" method="post" id="search_form" name="search_form">

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
                                                            <th scope="row" width="13%" >신청자명</th>
                                                            <td colspan=2 style='text-align:left; '>
                                                                <input type="text" title="신청자명" id="tr_nm" name="tr_nm" class="w100p" maxlength="" value="<?=$srch_param['tr_nm']?>" />
                                                            </td>
                                                            <th scope="row"><label for="tr_cate">세무 카테고리구분</label></th>
                                                            <td colspan=2 style='text-align:left; '>
                                                                <select id="tr_cate1" name='tr_cate1' class="w100p" title="상태선택">
                                                                    <option value=''>카테고리 선택</option>
                                                                    <option value='법인세' <?=($srch_param['tr_cate1']=='법인세') ?' selected':''?> >법인세</option>
                                                                    <option value='소득세' <?=($srch_param['tr_cate1']=='소득세') ?' selected':''?> >소득세</option>
                                                                    <option value='부가세신고' <?=($srch_param['tr_cate1']=='부가세신고') ?' selected':''?> >부가세신고</option>
                                                                    <option value='종합소득세신고' <?=($srch_param['tr_cate1']=='종합소득세신고') ?' selected':''?> >종합소득세신고</option>
                                                                    <option value='연말정산' <?=($srch_param['tr_cate1']=='연말정산') ?' selected':''?> >연말정산</option>
                                                                    <option value='급여관리' <?=($srch_param['tr_cate1']=='급여관리') ?' selected':''?> >급여관리</option>
                                                                    <option value='상속,증여,양도' <?=($srch_param['tr_cate1']=='상속,증여,양도') ?' selected':''?> >상속,증여,양도</option>
                                                                    <option value='지방세' <?=($srch_param['tr_cate1']=='지방세') ?' selected':''?> >지방세</option>
                                                                    <option value='종합부동산세' <?=($srch_param['tr_cate1']=='종합부동산세') ?' selected':''?> >종합부동산세</option>
                                                                    <option value='원천세4대보험' <?=($srch_param['tr_cate1']=='원천세4대보험') ?' selected':''?> >원천세4대보험</option>
                                                                    <option value='프리랜서사업자' <?=($srch_param['tr_cate1']=='프리랜서사업자') ?' selected':''?> >프리랜서사업자</option>
                                                                    <option value='종교인소득비영리법인' <?=($srch_param['tr_cate1']=='종교인소득비영리법인') ?' selected':''?> >종교인소득비영리법인</option>
                                                                    <option value='기타' <?=($srch_param['tr_cate1']=='기타') ?' selected':''?> >기타</option>
                                                                </select>
                                                            </td>
                                                        </tr>
                                                        <tr>
                                                            <th scope="row" width="13%" ><label for="sel_prd">연락처</label></th>
                                                            <td colspan=2>
                                                                <input type="text" title="연락처 입력" id="tr_tel" name="tr_tel" class="w100p" maxlength="" value="<?=$srch_param['tr_tel']?>"/>
                                                            </td>
                                                            <th scope="row"><label for="tr_cate">법무 카테고리구분</label></th>
                                                            <td colspan=2 style='text-align:left; '>
                                                                <select id="tr_cate2" name='tr_cate2' class="w100p" title="상태선택">
                                                                    <option value=''>카테고리 선택</option>
                                                                    <option value='상속,증여세' <?=($srch_param['tr_cate2']=='상속,증여세') ?' selected':''?> >상속,증여세</option>
                                                                    <option value='조세불복' <?=($srch_param['tr_cate2']=='조세불복') ?' selected':''?> >조세불복</option>
                                                                    <option value='세무조사' <?=($srch_param['tr_cate2']=='세무조사') ?' selected':''?> >세무조사</option>
                                                                    <option value='회생파산' <?=($srch_param['tr_cate2']=='회생파산') ?' selected':''?> >회생파산</option>
                                                                    <option value='기타' <?=($srch_param['tr_cate2']=='기타') ?' selected':''?> >기타</option>
                                                                </select>
                                                            </td>
                                                        </tr>

                                                        </tbody>
                                                    </table>


                                                    <div class="row2">
                                                        <div class="col-md-10" style="width:80%;float: left">

                                                        </div>

                                                        <div class="col-md-1" style="width:10%;float: left">

                                                        </div>
                                                        <div class="col-md-1" style="width:10%;float: left">
                                                            <button class="btn btn-primary btn_search btn-xs">
                                                                <i class="icon-search"></i>
                                                                <a href="javascript:get_office_srch();" style="color:#fff">검   색</a>
                                                            </button>
                                                        </div>

                                                    </div>
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
                                                        <span class="title_cmt"> 조회세무사 [<strong class="fc_blue" id="total_cnt"><?=$srch_count?></strong>건] / 전체세무사 [<strong class="fc_blue" id="all_total_cnt"><?=$ttl_count?></strong>건]</span>
                                                    </div>
                                                    <!--
                                                    <ul class="right_opt">
                                                        <li class="sbtn"><a href="javascript:void $.fn.excel_download();"><span class="">Excel 다운로드</span></a></li>
                                                    </ul>
                                                    -->
                                                </div><!-- table_top end -->

                                                <table class="list over-list">
                                                    <caption>조회된 세무사현황 리스트</caption>
                                                    <colgroup>
                                                        <col width="30px" />
                                                        <col width="50px" />
                                                        <col width="40px" />
                                                        <col width="40px" />
                                                        <col width="60px" />
                                                        <col width="60px" />
                                                        <col width="150px" />
                                                        <col width="30px" />
                                                        <col width="30px" />
                                                    </colgroup>
                                                    <thead>
                                                    <tr>
                                                        <th scope="col" class="text-center">고유번호</th>
                                                        <th scope="col" class="text-center">등록일자</th>
                                                        <th scope="col" class="text-center">상담자명</th>
                                                        <th scope="col" class="text-center">연락처</th>
                                                        <th scope="col" class="text-center">카테고리1</th>
                                                        <th scope="col" class="text-center">카테고리2</th>
                                                        <th scope="col" class="text-center">문의제목</th>
                                                        <th scope="col" class="text-center">진행상태</th>
                                                        <th scope="col" class="text-center">관리</th>
                                                    </tr>
                                                    </thead>
                                                    <tbody id="ContentsArea">
                                                    <?
                                                    foreach($list as $k => $v) {
                                                        //ob.ob_office_idx, ob.ob_officeNm, ob.ob_bizNum, ob.ob_bltDt, ob.ob_wrkrNum, ob.ob_email, ob.ob_ceoNm, ob.ob_tel, ob.ob_logo, ob.ob_filePath
                                                        //ob.ob_zip, ob.ob_addr, ob.ob_addr_desc, ob.ob_memo, ob.ob_latitud, ob.ob_longtitud, ob.ob_state, ob.ob_regDt, ob.ob_uptDt, ob.ob_regId, ob.ob_uptId
                                                        //sg.si_svcgdsNm, sg.si_svcgds_amt, ms.ms_mbrBeginDt, ms.ms_mbrEndDt

                                                        switch($v['tr_state']) {
                                                            case "R": $tr_state_v = "대기"; break;
                                                            case "N": $tr_state_v = "미승인"; break;
                                                            case "Y": $tr_state_v = "승인"; break;
                                                        }

                                                        ?>
                                                    <tr>
                                                        <td><?=$v['tr_taxcunselreq_idx']?></td>
                                                        <td><?=$v['tr_regDt']?></td>
                                                        <td><?=$v['tr_nm']?></td>
                                                        <td><?=$this->openssl_mem->aes_decrypt($v['tr_tel'])?></td>
                                                        <td><?=$v['tr_cate1']?></td>
                                                        <td><?=$v['tr_cate2']?></td>
                                                        <td><?=$v['tr_title']?></td>
                                                        <td><?=$tr_state_v?></td>
                                                        <td align="center"><a href="/crm/taxcounsel/desc/<?=$v['tr_taxcunselreq_idx']?>?per_page=<?=$per_page?>" class="btn btn-primary btn-xs">보기</a></td>
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
        var url = '/crm/taxcounsel/list';

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

        $('#search_form').attr({action:'/crm/taxcounsel/list', method:'post'}).submit();
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