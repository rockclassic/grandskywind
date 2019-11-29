<div class="row" id="content-wrapper">
    <div class="col-xs-12">
        <? $this->load->view('crm/common/top');

        $f_color="#fff";
        if($list['em_state']=="R"){
            $em_state_str="대기";
            $s_color="#8dc7f3";
        }else if($list['em_state']=="Y"){
            $em_state_str="완료";
            $s_color="#d23535";
        }else if($list['em_state']=="N"){
            $em_state_str="취소";
            $s_color="#232527";
        }else{
            $em_state_str="기타";
            $f_color="#000";
            $s_color="#f1eaea";
        }
        ?>
        <div class='row'>
            <div class='col-sm-12'>
                <div class='box bordered-box muted-border' style='margin-bottom:0;'>
                    <div class='box-header muted-background' style="height:30px;padding: 0px">
                        <div class='title'><?=$this->session->userdata('title')?> </div>
                    </div>


                    <div class='box-content' style="border-bottom: 0;" id="admin_display">
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
                                                            <th scope="row"><label for="em_regDt">신청일자</label></th>
                                                            <td colspan=2>
                                                                <input type="text" name="em_regDt" id="em_regDt" value="<?=$list['em_regDt']?>" class="w50p" readonly/>
                                                                <label for="em_state_str">&nbsp;&nbsp;&nbsp;견적 진행&nbsp;&nbsp;  </label> <input type="text" name="em_state_str" id="em_state_str" value="<?=$em_state_str?>     " class="w30p" style="background-color: <?=$s_color?>;color:<?=$f_color?>;text-align: right" readonly/>
                                                            </td>
                                                            <th scope="row"><label for="em_estmtReqNm">신청자</label></th>
                                                            <td colspan=2 style='text-align:left; '>
                                                                <input type="text" name="em_estmtReqNm" id="em_estmtReqNm" value="<?=$list['em_estmtReqNm']?>" class="w50p" readonly/>
                                                            </td>

                                                        </tr>
                                                        <tr>
                                                            <th scope="row"><label for="em_c1"><?=$list['em_c1'][0]?></label></th>
                                                            <td colspan=2 style='text-align:left; '>
                                                                <input type="text" name="em_c1" id="em_c1" value="<?=$list['em_c1'][1]?>" class="w100p" readonly/>
                                                            </td>
                                                            <th scope="row" width="13%" >
                                                                <label for="em_tel">연락처</label>
                                                            </th>
                                                            <td colspan=2>
                                                                <?if($this->openssl_mem->aes_decrypt($this->session->userdata('user_grade'))>6){?>
                                                                <input type="text" id="em_tel" name="em_tel" class="w50p"  value="<?=$this->openssl_mem->aes_decrypt($list['em_tel'])?>" readonly/>
                                                                <?}else{?>
                                                                    관리자만 볼 수 있습니다.
                                                                <?}?>
                                                            </td>
                                                        </tr>

                                                        <?
                                                        $ind=1;
                                                        for($i=2;$i<10;$i++){
                                                            if (is_array($list['em_c'.$i])&&$list['em_c'.$i][1] ){
                                                                if($ind%2==1){?>
                                                             <tr>
                                                                <th scope="row"><label for="em_c<?=$i?>"><?=$list['em_c'.$i][0]?></label></th>
                                                               <td colspan=2 style='text-align:left; '>
                                                                    <input type="text" name="em_c<?=$i?>" id="em_c<?=$i?>" value="<?=$list['em_c'.$i][1]?>" class="w100p" readonly/>
                                                               </td>
                                                                <?}else{ ?>
                                                                    <th scope="row"><label for="em_c<?=$i?>"><?=$list['em_c'.$i][0]?></label></th>
                                                                    <td colspan=2 style='text-align:left; '>
                                                                        <input type="text" name="em_c<?=$i?>" id="em_c<?=$i?>" value="<?=$list['em_c'.$i][1]?>" class="w100p" readonly/>
                                                                    </td>
                                                                    </tr>

                                                                <?}
                                                                $ind++;
                                                            }
                                                        }
                                                        if($ind%2==0){
                                                            echo"<td colspan='3' >&nbsp;</td></tr>";
                                                        }
                                                        ?>

                                                        <tr>
                                                            <th scope="row"><label for="em_memo">문의사항</label></th>
                                                            <td colspan=5 style='text-align:left; '>
                                                                <textarea name="em_memo" id="em_memo"  style="height: 70px" class="w100p" readonly><?=$list['em_memo']?></textarea>
                                                            </td>

                                                        </tr>


                                                        </tbody>
                                                    </table>
                                                    <div class="row2">
                                                        <div class="col-md-10" style="text-align: left;width:80%;float: left">**답변은 가장 최근 작성부터 상위에 노출됩니다.</div>
                                                        <div class="col-md-1" style="width:10%;float: left">
                                                            <button class="btn btn-warning btn-xs" id="btn_answer" name="btn_answer" >
                                                                <i class="icon-file"></i>
                                                                견적답변
                                                            </button>
                                                        </div>
                                                        <div class="col-md-1" style="width:10%;float: left">
                                                            <button class="btn btn-primary btn-xs" id="btn_estimate" name="btn_estimate" >
                                                                <i class="icon-file"></i>
                                                                견적리스트
                                                            </button>
                                                        </div>

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
                                                        <th class="text-center" width="150px">견적답변일자</th>
                                                        <th class="text-center">센터명</th>
                                                        <th class="text-center" width="180px">연락처</th>
                                                        <th class="text-center" width="150px">견적금액</th>
                                                        <th class="text-center" width="100px">답변상태</th>
                                                        <th class="text-center" width="100px">상태변경</th>
                                                        <th class="text-center" width="100px">상세내역</th>
                                                    </tr>
                                                    </thead>
                                                    <tbody>
                                                    <?
                                                    foreach($rsp as $k => $v) {
                                                        ?>
                                                        <tr>
                                                            <td align="center"><?=$v['rs_estmtRsp_idx']?></td>
                                                            <td align="center"><?=$v['rs_regdt']?></td>
                                                            <td align="center"><?=$v['hb_hosptl_nm']?></td>
                                                            <td align="center"><?=$this->openssl_mem->aes_decrypt($v['hb_tel'])?></td>
                                                            <td align="center" style="text-align: right"><?=number_format($v['rs_estmt_amt'])?>원</td>
                                                            <td align="center"><select name="state_<?=$v['rs_estmtRsp_idx']?>" id="state_<?=$v['rs_estmtRsp_idx']?>"  class="w100p">
                                                                    <option value="R" <?=($v['rs_state']=="R")?' selected':''?>>대기</option>
                                                                    <option value="Y" <?=($v['rs_state']=="Y")?' selected':''?>>완료</option>
                                                                    <option value="N" <?=($v['rs_state']=="N")?' selected':''?>>취소</option>
                                                                </select>
                                                            </td>

                                                            <td align="center "><a onclick="chg_state('<?=$v['rs_estmtRsp_idx']?>')" class="btn btn-warning btn-xs">상태변경</a></td>
                                                            <td align="center"><a onclick="popup_open('<?=$v['rs_estmtRsp_idx']?>')" class="btn btn-primary btn-xs">보기</a></td>
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
<input type="hidden" value="<?=$srl?>" id="em_estmtReq_idx"/>
<script>

    function chg_state(id){

        var state=$("#state_"+id).val();

        var url = '/crm/trade/update_rs_state';
        var data = {'rs_estmtRsp_idx':id,'rs_state':state};
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

    function popup_open(id){


        var url = '/crm/trade/get_estimate_answer';
        var data = {'rs_estmtRsp_idx':id};
        showSpinner();
        ajax_post(url, data, function(ret) {
            if(ret.msg == 'success') {

                $("#sms_title").html('<i class="icon-tags"></i> 견적 답변 상세 정보 ['+ret.data.ob_officeNm+']');

                $("#sms_tilte1").show();
                $("#sms_tilte1").html('견적금액');
                $("#sms_tilte2").html("답변내용");
                if(ret.data.rs_estmt_amt>0) {
                    $("#message1").val(formatnumber(ret.data.rs_estmt_amt, '3') + '원');
                }else{
                    $("#message1").val ('0원');
                }
                $('#message1').height('30px'); //설정
                $('#message1').css("border","1px solid #d5d5d5"); //설정
                $("#message2").val(ret.data.rs_estmt_memo);
                $('#message1').attr("readonly",true); //설정
                $('#message2').attr("readonly",true); //설정
                $('.sms_popup_submit').hide();
                $('.sms_popup').show();
                hideSpinner();
            } else {
                alert('error : '+ret.data);
                hideSpinner();
            }
        });


    }


    $('#btn_answer').click(function(){
        <?if($list['em_state']=="R"){?>
        $("#sms_title").html('<i class="icon-tags"></i> 견적 답변 저장');
        $("#sms_tilte1").show();
        $("#sms_tilte1").html("견적금액(숫자만 입력)");
        $("#sms_tilte2").html("견적내용");
        $("#message1").val('');
        $("#message2").val('');
        $('#message1').show(); //설정
        $('#message1').height('30px'); //설정
        $('#message1').css("border","1px solid #d5d5d5"); //설정
        $('#message1').attr("readonly",false); //설정
        $('#message2').attr("readonly",false); //설정
        $('.sms_popup_submit').show();
        $('.sms_popup').show();
        <?}else{?>
        toastr.error('본 견적은 <?= $em_state_str?> 상태이므로 더 이상 견적의 답변을 할 수 없습니다. ');
        <?}?>

    });

    $("#btn_estimate").click(function(){
      location.href="/crm/trade/estimate?per_page=<?=$t_per_page?>";

    });

    $('.sms_popup_submit').click(function(){
        if(!$("#message2").val()){ alert("입력내용은 필수 입니다. 확인해 주세요. "); $("#message2").focus(); return false;}
        if(!confirm('전송하시겠습니까?')) return false;
        var url = '/crm/trade/set_estimate_answer';
        var data = {'rs_estmt_amt':$("#message1").val(),'rs_estmt_memo':$("#message2").val(),'em_estmtReq_idx':$("#em_estmtReq_idx").val()};
        showSpinner();
        ajax_post(url, data, function(ret) {
            if(ret.msg == 'success') {
                toastr.success('저장 되었습니다.');
                hideSpinner();
            } else {
                toastr.error('error : '+ret.data);
                hideSpinner();
            }
            $('.sms_popup').hide();
            location.reload();
        });

    });
</script>