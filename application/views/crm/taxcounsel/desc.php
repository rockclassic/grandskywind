<div class="row" id="content-wrapper">
    <div class="col-xs-12">
        <? $this->load->view('crm/common/top'); ?>
        <div class='row'>
            <div class='col-sm-12'>
                <div class='box bordered-box muted-border' style='margin-bottom:0;'>
                    <div class='box-header muted-background' style="height:30px;padding: 0px">
                        <div class='title'  > 세무사무소 저장  </div>
                    </div>

                    <div class='box-content' style="border-bottom: 0;">
                        <form class="form form-horizontal" id="formReg" name="formReg" method="post"  enctype="multipart/form-data">
                            <input type="hidden" name="tr_taxcunselreq_idx" id="tr_taxcunselreq_idx" value='<?=$taxlaw_counsel_inf['data']['tr_taxcunselreq_idx']?>'>


                            <div class="table_area" style="margin-top: 0px"><!-- table_area start -->
                                <!-- 회원정보 -->
                                <table class="write">
                                    <colgroup>
                                        <col width="11%" />
                                        <col width="22%" />
                                        <col width="11%" />
                                        <col width="22%" />
                                        <col width="11%" />
                                        <col width="23%" />
                                    </colgroup>
                                    <tbody>

                                    <tr>
                                        <th scope="row">등록일자</th>
                                        <td><input type="text" id="tr_regDt" name="tr_regDt" class="w100p" value="<?=$taxlaw_counsel_inf['data']['tr_regDt']?>"/></td>
                                        <th scope="row">신청자</th>
                                        <td><input type="text" id="tr_nm" name="tr_nm" class="w100p" value="<?=$taxlaw_counsel_inf['data']['tr_nm']?>"/></td>
                                        <th scope="row">연락처</th>
                                        <td><input type="text" id="tr_tel" name="tr_tel" class="w100p" value="<?=$this->openssl_mem->aes_decrypt($taxlaw_counsel_inf['data']['tr_tel'])?>"/></td>
                                    </tr>
                                    <tr>
                                        <th scope="row">카테고리구분1</th>
                                        <td><?=$taxlaw_counsel_inf['data']['tr_cate1']?></td>
                                        <th scope="row">카테고리구분2</th>
                                        <td><?=$taxlaw_counsel_inf['data']['tr_cate2']?></td>
                                        <th scope="row"><label for="mb_photo">비밀번호</label></th>
                                        <td colspan="1">
                                            <input type="text" style="width:60%;" id="tr_pwd" name="tr_pwd" value="<?//=$taxlaw_counsel_inf['data']['tr_pwd']?>" />
                                            <!--<a href="javascript: fn_pwd_init();">[비밀번호 초기화]</a>-->
                                        </td>
                                    </tr>
                                    <tr>
                                        <th scope="row"><label for="mb_photo">문의제목</label></th>
                                        <td colspan="5">
                                            <input type="text" style="width:100%;" id="tr_title" name="tr_title"  value="<?=$taxlaw_counsel_inf['data']['tr_title']?>" />
                                        </td>
                                    </tr>
                                    <tr>
                                        <th scope="row"><label for="mb_photo">문의사항</label></th>
                                        <td colspan="5"><textarea cols="20" rows="10" class="memo_box" id="tr_content"  name="tr_content" ><?=$taxlaw_counsel_inf['data']['tr_content']?></textarea></td>
                                    </tr>

                                </table>
                            </div>

                            <!-- //회원유형 -->



                            <input type="hidden" name="tp_taxcunselrsp_idx" id="tp_taxcunselrsp_idx" value='<?=$taxlaw_counsel_inf['data']['tp_taxcunselrsp_idx']?>'>
                            <input type="hidden" name="procgbn" id="procgbn" value=''>


                            <div class="table_area"><!-- table_area start -->
                                <!-- 회원정보 -->
                                <table class="write">
                                    <colgroup>
                                        <col width="11%" />
                                        <col width="22%" />
                                        <col width="11%" />
                                        <col width="22%" />
                                        <col width="11%" />
                                        <col width="23%" />
                                    </colgroup>
                                    <tbody>

                                    <tr>
                                        <th scope="row">등록일자</th>
                                        <td><input type="text" id="datepicker1" name="tp_regDt" class="w100p" value="<?=$taxlaw_counsel_inf['data']['tp_regDt']?>"/></td>
                                        <th scope="row"></th>
                                        <td></td>
                                        <th scope="row"></th>
                                        <td></td>
                                    </tr>
                                    <?
                                    if(!$taxlaw_counsel_inf['data']['tp_comp']){ $tp_comp_v = '오늘세무법무법인'; }else{ $tp_comp_v = $taxlaw_counsel_inf['data']['tp_comp'];}
                                    if(!$taxlaw_counsel_inf['data']['tp_mgr']){ $tp_mgr_v = $this->session->userdata('user_name'); }else{ $tp_mgr_v = $taxlaw_counsel_inf['data']['tp_mgr']; }
                                    //if(!$taxlaw_counsel_inf['data']['tp_tel']){ $tp_tel_v = '02-1111-2222'; }else{ $tp_tel_v = $taxlaw_counsel_inf['data']['tp_tel']; }
                                    ?>
                                    <tr>
                                        <th scope="row">세무법인명</th>
                                        <td><input type="text" id="tp_comp" name="tp_comp" class="w100p" value="<?=$tp_comp_v?>"/></td>
                                        <th scope="row">답변자명</th>
                                        <td><input type="text" id="tp_mgr" name="tp_mgr" class="w100p" value="<?=$tp_mgr_v?>"/></td>
                                        <th scope="row">연락처</th>
                                        <td colspan="1" >
                                            <input type="text" id="tp_tel" name="tp_tel" value="<?=$tp_tel_v?>" style="width:60%; display:none;"/>
                                        </td>
                                    </tr>

                                    <tr>
                                        <th scope="row"><label for="mb_photo">답변사항</label></th>
                                        <td colspan="5"><textarea cols="20" rows="10" id="tp_content"  name="tp_content" style="width:100%;" ><?=$taxlaw_counsel_inf['data']['tp_content']?></textarea></td>
                                    </tr>

                                    <tr>
                                        <th scope="row"><label for="mb_photo">상태</label></th>
                                        <td colspan="1">
                                            <select id="tp_state" name='tp_state' class="w50p" title="상태선택">
                                                <option value=''>상태선택</option>
                                                <option value='R'  <?=(trim($taxlaw_counsel_inf['data']['tp_state'])=='R') ?' selected':''?> >대기</option>
                                                <!--<option value='N'  <?=(trim($taxlaw_counsel_inf['data']['tp_state'])=='N') ?' selected':''?> >미승인</option>-->
                                                <option value='Y'  <?=(trim($taxlaw_counsel_inf['data']['tp_state'])=='Y') ?' selected':''?> >승인</option>
                                            </select>
                                        </td>
                                        <td colspan="4">

                                    </tr>

                                </table>
                            </div>

                            <div class="row2" style="padding-bottom: 30px">
                                <div class="col-md-10" style="width: 80%;float: left"></div>
                                <div class="col-md-1" style="width: 10%;float: left">
                                    <div class="btn btn-warning btn_search btn-xs" >
                                            <a  style="color:#fff" onclick="javascript: set_taxlawcounsel_save();">저 장</a>
                                    </div>
                                </div>
                                <div class="col-md-1" style="width: 10%;float: left"></div>
                            </div>
                            <!-- //회원유형 -->
                        </form>

                    </div>
                </div>
            </div>




            <script language="javascript">

                $(document).ready(function() {


                });

                $(function() {
                    $( "#datepicker1" ).datepicker({
                        dateFormat: 'yy-mm-dd',
                        monthNames: ['1월','2월','3월','4월','5월','6월','7월','8월','9월','10월','11월','12월'],
                        monthNamesShort: ['1월','2월','3월','4월','5월','6월','7월','8월','9월','10월','11월','12월'],
                        dayNames: ['일','월','화','수','목','금','토'],
                        dayNamesShort: ['일','월','화','수','목','금','토'],
                        dayNamesMin: ['일','월','화','수','목','금','토'],
                    });
                });



                function set_taxlawcounsel_save()
                {
                    var tr_taxcunselreq_idx = $('#tr_taxcunselreq_idx').val();
                    if(tr_taxcunselreq_idx == '' || !tr_taxcunselreq_idx){
                        toastr.info('세무법무상담요청을 저장하지 않으셨습니다');
                        return false;
                    }

                    var tp_taxcunselrsp_idx = $('#tp_taxcunselrsp_idx').val();
                    //if(tp_taxcunselrsp_idx == '' || !tp_taxcunselrsp_idx){
                    //    toastr.info('세무법무상담답변을 저장하지 않으셨습니다');
                    //    return false;
                    //}

                    var procgbn_v = '';
                    if(tp_taxcunselrsp_idx == '' || !tp_taxcunselrsp_idx){
                        $('#procgbn').val('INS');
                        procgbn_v = '등록';
                    }else {
                        $('#procgbn').val('EDT');
                        procgbn_v = '수정';
                    }

                    var url = '/crm/taxcounsel/set_taxcunselrsp';
                    //var data = {
                    //    "procgbn" : procgbn,
                    //    "tr_taxcunselreq_idx" : tr_taxcunselreq_idx,
                    //    "tp_taxcunselrsp_idx" : tp_taxcunselrsp_idx,
                    //}
                    //console.log(data);

                    var data = '';
                    ajax_post_serialdata(url, data, function(ret) {
                        if(ret.msg == 'TRUE') {
                            toastr.info('세무법무상담답변 정보를 '+procgbn_v+'하였습니다');
                            console.log(ret);
                        } else {
                            //alert('error : '+ret.data);
                        }
                    });
                }


                function ajax_post_serialdata(url, data, callback, callback_done, callback_fail, datatype){
                    showSpinner();
                    var contenttype = 'application/json; charset=utf-8';
                    if(!datatype) {
                        datatype = 'JSON';
                    }
                    $.ajax({
                        'url': url,
                        'type': 'POST',
                        'dataType': datatype,
                        //'contentType': contenttype,   //serialize()경우 안됨
                        'processData': false,
                        'data': $('#formReg').serialize(),
                        'success': callback
                    })
                        .done(function(ret){
                            hideSpinner();
                            if(callback_done) callback_done(ret);
                        })
                        .fail(function(){
                            hideSpinner();
                            if(callback_fail) callback_fail();
                        });
                }

            </script>



