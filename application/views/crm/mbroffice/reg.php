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
                        <div class="table_top"><!-- table_top start -->
                            <div class="left_opt">
                                <h4>기본정보</h4>
                            </div>
                        </div><!-- table_top end -->


                        <form class="form form-horizontal" id="formReg" name="formReg" method="post"  enctype="multipart/form-data">
                            <input type="hidden" name="ob_office_idx" id="ob_office_idx" value='<?=$ob_office_idx?>'>


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
                                    <th scope="row" rowspan="4">법인로고</th>
                                    <td rowspan="4">
                                        <div>
                                            <?if($office_base['data']['ob_logo']){?>
                                            <img src ='/uploads/files/<?=$office_base['data']['ob_logo']?>' id='ob_logo' name='ob_logo' >
                                            <?}else{?>
                                                <img src ='' id='ob_logo' name='ob_logo' >
                                            <?}?>
                                        </div>
                                    </td>
                                </tr>
                                <tr>
                                    <th scope="row">세무사무소명</th>
                                    <td><input type="text" id="ob_officeNm" name="ob_officeNm" class="w100p" value="<?=$office_base->ob_officeNm?>"/></td>
                                    <th scope="row">설립년도</th>
                                    <td><input type="text" id="datepicker1" name="ob_bltDt" class="w100p" value="<?=$office_base->ob_bltDt?>"/></td>
                                </tr>
                                <tr>
                                    <th scope="row">보유인력</th>
                                    <td><input type="text" id="ob_wrkrNum" name="ob_wrkrNum" class="w100p" value="<?=$office_base->ob_wrkrNum?>"/></td>
                                    <th scope="row">이메일</th>
                                    <td><input type="text" id="ob_email" name="ob_email" class="w100p" value="<?=$office_base->ob_email?>"/></td>
                                </tr>
                                <tr>
                                    <th scope="row">대표</th>
                                    <td><input type="text" id="ob_ceoNm" name="ob_ceoNm" class="w100p" value="<?=$office_base->ob_ceoNm?>"/></td>
                                    <th scope="row">연락처</th>
                                    <td><input type="text" id="ob_tel" name="ob_tel" class="w100p" value="<?=$office_base->ob_tel?>"/></td>
                                </tr>
                                <tr>
                                    <th scope="row"><label for="mb_photo">아이디</label></th>
                                    <td colspan="1">
                                        <input type="text" style="width:60%;" id="ac_id" name="ac_id" value="<?=$office_base->ac_id?>" />
                                        <a href="javascript: fn_id_dup_chk();" id="idDupVal">[ID 중복체크]</a>
                                    </td>
                                    <th scope="row"><label for="mb_photo">아이디명</label></th>
                                    <td colspan="1">
                                        <input type="text" style="width:100%;" id="ac_nm" name="ac_nm" value="<?=$office_base->ac_nm?>" />
                                    </td>
                                    <th scope="row"><label for="mb_photo">비밀번호</label></th>
                                    <td colspan="1">
                                        <input type="text" style="width:60%;" id="ac_pwd" name="ac_pwd" value="<?=$office_base->ac_pwd?>" />
                                        <a href="javascript: fn_pwd_init();">[비밀번호 초기화]</a>
                                    </td>
                                </tr>
                                <tr style="display: none">
                                    <th scope="row"><label for="mb_photo">기존이미지</label></th>
                                    <td colspan="5"><input type="text" id="ob_logo_bak" name="ob_logo_bak" class="w50p" value="<?=$office_base->ob_filePath?>/<?=$office_base->ob_logo?>"/></td>
                                </tr>
                                <tr style="display: ">
                                    <th scope="row"><label for="mb_photo">사업자번호</label></th>
                                    <td colspan="5"><input type="text" id="ob_bizNum" name="ob_bizNum" class="w50p" value="<?=$office_base->ob_bizNum?>"/></td>
                                </tr>
                                <tr>
                                    <th scope="row"><label for="mb_photo">파일첨부</label></th>
                                    <td colspan="5">
                                        <input type="file" id="document-file" name="document-file" value="" />
                                    </td>
                                </tr>

                                <tr>
                                    <th scope="row" rowspan="2" class="v-top"><label for="mb-adrs">주소</label></th>
                                    <td colspan="5">
                                        <input type="text"  id='ob_zip' name="ob_zip" maxlength=4   value="<?=$office_base->ob_zip?>" style="width:100px;" />
                                        <span class="in_btn"><a href="#" onclick="execDaumPostcode()" class="link_type" id="srchZip">우편번호검색</a></span>
                                    </td>
                                </tr>
                                <tr>
                                    <td colspan="5">
                                        <input type="text" id="roadAddress" name="mb_addr0" value="<?=$office_base->mb_addr0?>" style="display:none;"/>
                                        <input type="text" style="width:35%;" id="jibunAddress" name="ob_addr"  value="<?=$office_base->ob_addr?>" readonly="readonly;"/>
                                        <input type="text" style="width:35%;" id="mb_addr2" name="ob_addr_desc"  value="<?=$office_base->ob_addr_desc?>" />
                                    </td>
                                </tr>

                                <tr>
                                    <th scope="row"  class="v-top"><label for="mb-adrs">지도좌표</label></th>
                                    <td>
                                        <input type="text"  id='ob_latitud' name="ob_latitud"   value="<?=$office_base->ob_latitud?>" style="width:45%;" readonly/>
                                 &nbsp;&nbsp;
                                        <input type="text"  id='ob_longtitud' name="ob_longtitud"   value="<?=$office_base->ob_longtitud?>" style="width:45%;" readonly/>
                                    </td>
                                    <td colspan="4">
                                        <div class="btn btn-primary btn_search btn-xs" >
                                            <a href="javascript:btn_search_titud(this.formReg,'ob_latitud','ob_longtitud','ob_addr');" style="color:white;">지도좌표 검색</a>
                                        </div>
                                    </td>
                                </tr>
                                <tr>
                                    <th scope="row" rowspan="1" class="v-top"><label for="mb-adrs">시도구군</label></th>
                                    <td colspan="5">
                                        <select id="sdg_sido_no" name='sdg_sido_no' class="w40p svcgds_inf" title="" style="float:left; width:30%;">
                                            <option value=''>선택하세요</option>
                                            <?
                                            foreach($sdg_sido_list['data'] as $k => $v) {
                                                ?>
                                                <option value='<?=$v['sdg_sido_no']?>' ><?=$v['sdg_sido_nm']?></option>
                                                <?
                                            }
                                            ?>
                                        </select>
                                        <select id="sdg_gu_no" name='sdg_gu_no' class="w40p svcgds_inf" title="" style="float:left; width:30%;">
                                            <option value=''>선택하세요</option>
                                        </select>
                                    </td>
                                </tr>


                                <tr>
                                    <th scope="row"><label for="mb_photo">소개의말</label></th>
                                    <td colspan="5"><textarea cols="20" rows="10" class="memo_box" id="ob_memo"  name="ob_memo" ><?=$office_base->ob_memo?></textarea></td>
                                </tr>
                                <tr>
                                    <th scope="row"><label for="mb_photo">상태</label></th>
                                    <td colspan="1">
                                        <select id="ob_state" name='ob_state' class="w50p" title="상태선택">
                                            <option value=''>상태선택</option>
                                            <option value='R' selected>대기</option>
                                            <option value='N' >미승인</option>
                                            <option value='Y' >승인</option>
                                        </select>
                                    </td>
                                    <td colspan="4">

                                </tr>

                            </table>
                    </div>


                    <div class="row2">
                        <div class="col-md-11"></div>
                        <div class="col-md-1">
                            <div class="btn_cls" >

                                    <div class="btn btn-warning btn_search btn-xs" >
                                        <a href="javascript:set_office_reg();" style="color:white;">저 장</a>
                                    </div>

                            </div>
                        </div>
                    </div>

                    <!-- //회원유형 -->
                </form>









                <!-- 서비스정보 -->
                <form class="form form-horizontal" id="formReg2" name="formReg2" method="post"  enctype="multipart/form-data">
                    <input type="hidden" name="ms_mbr_idx" id="ms_mbr_idx" value='<?=$ms_mbr_idx?>'>

                <div class="table_area" id="svc_inf"><!-- table_area start -->
                    <div class="table_top"><!-- table_top start -->
                        <div class="left_opt">
                            <h4>서비스정보</h4>
                        </div>
                    </div><!-- table_top end -->
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
                            <th scope="row"><label for="md_contact_person">서비스명</label></th>
                            <td>
                                <select id="si_svcgds_idx" name='si_svcgds_idx' class="w100p svcgds_inf" title="">
                                    <option value=''>선택하세요</option>
                                    <?
                                    //print_r($svcgds_list);
                                    foreach($svcgds_list as $k => $v) {
                                        fn_log('k - '.$k,"svcgds_list");
                                        fn_log('v - '.$v,"svcgds_list2");
                                    ?>
                                    <option value='<?=$v['si_svcgds_idx']?>' ><?=$v['si_svcgdsNm']?></option>
                                   <?
                                    }
                                    ?>
                                </select>
                            </td>
                            <th scope="row"><label for="ms_joinDt">저장일자</label></th>
                            <td>
                                <input type="text" id="datepicker2" name="ms_joinDt" class="w100p"  value="<?=$ms_joinDt?>"/>
                            </td>
                            <th scope="row"><label for="md_contact_email">회원유형</label></th>
                            <td>
                                <select id="ms_mbrgbn" name='ms_mbrgbn' class="w100p" title="">
                                    <option value=''>선택하세요</option>
                                    <option value='Y' >유료회원</option>
                                    <option value='N' >무료회원</option>
                                </select>
                            </td>
                        </tr>
                        <tr>
                            <th scope="row"><label for="ms_ttlAmt">서비스금액</label></th>
                            <td>
                                <input type="text" id="ms_ttlAmt" name="ms_ttlAmt" class="w100p svcgds_inf num_only_comma" value="<?=$ms_ttlAmt?>" onkeyup="" />
                            </td>

                            <th scope="row"><label for="ms_freeBeginDt">무료시작일</label></th>
                            <td>
                                <input type="text" id="datepicker3" name="ms_freeBeginDt" class="w100p"  value="<?=$ms_freeBeginDt?>"/>
                            </td>
                            <th scope="row"><label for="ms_freeEndDt">무료만료일</label></th>
                            <td>
                                <input type="text" id="datepicker4" name="ms_freeEndDt" class="w100p" value="<?=$ms_freeEndDt?>"/>
                            </td>
                        </tr>
                        <tr>
                            <th scope="row"><label for="ms_ttlperiod">서비스기간</label></th>
                            <td>
                                <input type="text" id="ms_ttlperiod" name="ms_ttlperiod" class="w100p svcgds_inf"  value="<?=$ms_ttlperiod?>"/>
                            </td>

                            <th scope="row"><label for="ms_mbrBeginDt">제휴시작일</label></th>
                            <td>
                                <input type="text" id="datepicker5" name="ms_mbrBeginDt" class="w100p"  value="<?=$ms_mbrBeginDt?>"/>
                            </td>
                            <th scope="row"><label for="ms_mbrEndDt">제휴만료일</label></th>
                            <td>
                                <input type="text" id="datepicker6" name="ms_mbrEndDt" class="w100p"  value="<?=$ms_mbrEndDt?>"/>
                            </td>
                        </tr>
                        </tbody>
                    </table>
                </div>

                <? if($this->openssl_mem->aes_decrypt($this->session->userdata('user_grade'))>=7){ ?>

                    <div class="row2">
                        <div class="col-md-11"></div>
                        <div class="col-md-1">
                            <div class="btn_cls" >
                                <button class="btn btn-warning btn_search btn-xs" onclick="javascript: set_office_svcinf_reg();">
                                    저 장
                                </button>
                            </div>
                        </div>
                    </div>



                <? } ?>
                <!-- //서비스정보 -->
                </form>




                <!-- 주요약력 -->
                <div class="table_area"><!-- table_area start -->
                    <div class="table_top"><!-- table_top start -->
                        <div class="left_opt">
                            <h4>주요 약력</h4>
                        </div>
                    </div><!-- table_top end -->
                    <table class="list">
                        <colgroup>
                            <col width="15%" />
                            <col width="70%" />
                            <col width="15%" />
                        </colgroup>
                        <thead>
                        <tr>
                            <th scope="col">일자</th>
                            <th scope="col">이력사항</th>
                            <th scope="col">수정|삭제</th>
                        </tr>
                        </thead>
                        <tbody id="profileList">
                        <?php
                        if($office_profile){
                            foreach($office_profile as $row){
                                ?>
                                <tr>
                                    <td><?=$row['pf_date']?></td>
                                    <td><?=$row['pf_desc']?></td>
                                    <td>
                                        <a href="javascript: fn_set_office_profile_proc('EDT','<?=$row['ob_office_idx']?>','<?=$row['pf_profile_idx']?>')">수정</a>|
                                        <a href="javascript: fn_set_office_profile_proc('DEL','<?=$row['ob_office_idx']?>','<?=$row['pf_profile_idx']?>')">삭제</a>
                                    </td>
                                </tr>
                                <?php
                            }
                        }else{
                            echo "<td colspan=3></td>";
                        }
                        ?>
                        </tbody>
                    </table>
                    <table>
                        <colgroup>
                            <col width="15%" />
                            <col width="70%" />
                            <col width="15%" />
                        </colgroup>
                        <tbody>
                        <tr>
                            <td scope="col"><input type="text" id="datepicker7" name="pf_date" class="w100p"  value="<?=$pf_date?>"/></td>
                            <td scope="col"><input type="text" id="pf_desc" name="pf_desc" class="w100p"  value="<?=$pf_desc?>"/></td>
                            <td scope="col">

                                <div class="row2">
                                    <div class="col-md-11"></div>
                                    <div class="col-md-1">
                                        <div class="btn_cls" >
                                            <button class="btn btn-warning btn_search btn-xs" onclick="javascript: fn_reg_office_profile_proc('INS','<?=$row['ob_office_idx']?>','');">
                                                저 장
                                            </button>
                                        </div>
                                    </div>
                                </div>

                            </td>
                        </tr>
                        </tbody>
                    </table>
                </div>
                <!-- //주요약력 -->







                <!-- 소속 세무사 -->
                <div class="table_area"><!-- table_area start -->
                    <div class="table_top"><!-- table_top start -->
                        <div class="left_opt">
                            <h4>소속 세무사</h4>
                        </div>
                    </div><!-- table_top end -->
                    <table class="list">
                        <colgroup>
                            <col width="10%" />
                            <col width="15%" />
                            <col width="20%" />
                            <col width="40%" />
                            <col width="15%" />
                        </colgroup>
                        <thead>
                        <tr>
                            <th scope="col">이름</th>
                            <th scope="col">학력</th>
                            <th scope="col">분야</th>
                            <th scope="col">주요경력</th>
                            <th scope="col">수정|삭제</th>
                        </tr>
                        </thead>
                        <tbody id="taxAccntList">
                            <td scope="col" colspan="5"></td>
                        </tbody>
                    </table>
                    <table>
                        <colgroup>
                            <col width="10%" />
                            <col width="15%" />
                            <col width="20%" />
                            <col width="40%" />
                            <col width="15%" />
                        </colgroup>
                        <tbody>
                        <tr>
                            <td scope="col"><input type="text" id="at_taxAccntNm" name="at_taxAccntNm" class="w100p"  value="<?=$at_taxAccntNm?>"/></td>
                            <td scope="col"><input type="text" id="at_eduLvl" name="at_eduLvl" class="w100p"  value="<?=$at_eduLvl?>"/></td>
                            <td scope="col"><input type="text" id="at_jobfield" name="at_jobfield" class="w100p"  value="<?=$at_jobfield?>"/></td>
                            <td scope="col"><input type="text" id="at_Profile" name="at_Profile" class="w100p"  value="<?=$at_Profile?>"/></td>
                            <td scope="col">

                                <div class="row2">
                                    <div class="col-md-11"></div>
                                    <div class="col-md-1">
                                        <div class="btn_cls" >
                                            <button class="btn btn-warning btn_search btn-xs" onclick="javascript: fn_reg_taxAccnt_proc();">
                                                저 장
                                            </button>
                                        </div>
                                    </div>
                                </div>


                            </td>
                        </tr>
                        </tbody>
                    </table>
                </div>
                <!-- //소속 세무사 -->








                <!-- 주요 거래처 -->
                <div class="table_area"><!-- table_area start -->
                    <div class="table_top"><!-- table_top start -->
                        <div class="left_opt">
                            <h4>주요 거래처</h4>
                        </div>
                    </div><!-- table_top end -->
                    <table class="list">
                        <colgroup>
                             <col width="15%" />
                            <col width="30%" />
                            <col width="40%" />
                            <col width="15%" />
                        </colgroup>
                        <thead>
                        <tr>
                            <th scope="col">거래처명</th>
                            <th scope="col">분야</th>
                            <th scope="col">주요내역</th>
                            <th scope="col">수정|삭제</th>
                        </tr>
                        </thead>
                        <tbody id="clientList">
                        <td scope="col" colspan="4"></td>
                        </tbody>
                    </table>
                    <table>
                        <colgroup>
                            <col width="15%" />
                            <col width="30%" />
                            <col width="40%" />
                            <col width="15%" />
                        </colgroup>
                        <tbody>
                        <tr>
                            <td scope="col"><input type="text" id="mc_clientNm" name="mc_clientNm" class="w100p"  value="<?=$mc_clientNm?>"/></td>
                            <td scope="col"><input type="text" id="mc_fieldgbn" name="mc_fieldgbn" class="w100p"  value="<?=$mc_fieldgbn?>"/></td>
                            <td scope="col"><input type="text" id="mc_wrkdesc" name="mc_wrkdesc" class="w100p"  value="<?=$mc_wrkdesc?>"/></td>
                            <td scope="col">


                                <div class="row2">
                                    <div class="col-md-11"></div>
                                    <div class="col-md-1">
                                        <div class="btn_cls" >
                                            <button class="btn btn-warning btn_search btn-xs" onclick="javascript: fn_reg_client_proc();">
                                                저 장
                                            </button>
                                        </div>
                                    </div>
                                </div>


                            </td>
                        </tr>
                        </tbody>
                    </table>
                </div>
                <!-- //주요 거래처 -->






                <!-- 전문 분야 -->
                <div class="table_area"><!-- table_area start -->
                    <div class="table_top"><!-- table_top start -->
                        <div class="left_opt">
                            <h4>전문 분야</h4>
                        </div>
                    </div><!-- table_top end -->
                    <table class="list">
                        <colgroup>
                            <col width="85%" />
                            <col width="15%" />
                        </colgroup>
                        <thead>
                        <tr>
                            <th scope="col">전문분야</th>
                            <th scope="col">수정|삭제</th>
                        </tr>
                        </thead>
                        <tbody id="wrkfieldList">
                        <td scope="col" colspan="2"></td>
                        </tbody>
                    </table>
                    <table>
                        <colgroup>
                            <col width="85%" />
                            <col width="15%" />
                        </colgroup>
                        <tbody>
                        <tr>
                            <td scope="col"><input type="text" id="mf_wrkfieldNm" name="mf_wrkfieldNm" class="w100p"  value="<?=$mf_wrkfieldNm?>"/></td>
                            <td scope="col">

                                <div class="row2">
                                    <div class="col-md-11"></div>
                                    <div class="col-md-1">
                                        <div class="btn_cls" >
                                            <button class="btn btn-warning btn_search btn-xs" onclick="javascript: fn_reg_wrkfield_proc();">
                                                저 장
                                            </button>
                                        </div>
                                    </div>
                                </div>


                            </td>
                        </tr>
                        </tbody>
                    </table>
                </div>
                <!-- //전문 분야 -->





                <!-- 미니인터뷰 -->
                <div class="table_area"><!-- table_area start -->
                    <div class="table_top"><!-- table_top start -->
                        <div class="left_opt">
                            <h4>미니인터뷰</h4>
                        </div>
                    </div><!-- table_top end -->
                    <table class="list">
                        <colgroup>
                            <col width="42%" />
                            <col width="43%" />
                            <col width="15%" />
                        </colgroup>
                        <thead>
                        <tr>
                            <th scope="col">문의</th>
                            <th scope="col">답변</th>
                            <th scope="col">수정|삭제</th>
                        </tr>
                        </thead>
                        <tbody id="intrvwList">
                        <td scope="col" colspan="3"></td>
                        </tbody>
                    </table>
                    <table>
                        <colgroup>
                            <col width="42%" />
                            <col width="43%" />
                            <col width="15%" />
                        </colgroup>
                        <tbody>
                        <tr>
                            <td scope="col"><textarea id="iv_officeQ" name="iv_officeQ" class="w100p" rows="10" cols="100" style="height:100px; "><?=$iv_officeQ?></textarea></td>
                            <td scope="col"><textarea id="iv_officeA" name="iv_officeA" class="w100p" rows="10" cols="100" style="height:100px; "><?=$iv_officeA?></textarea></td>
                            <td scope="col">

                                <div class="row2">
                                    <div class="col-md-11"></div>
                                    <div class="col-md-1">
                                        <div class="btn_cls" >
                                            <button class="btn btn-warning btn_search btn-xs" onclick="javascript: fn_reg_intrvw_proc();">
                                                저 장
                                            </button>
                                        </div>
                                    </div>
                                </div>


                            </td>
                        </tr>
                        </tbody>
                    </table>
                </div>
                <!-- //미니인터뷰 -->



        </div>
        <hr class='hr-double'>
    </div>
</div>



            <script src="/assets/javascripts/jquery/jquery.form.min.js" type="text/javascript"></script>
            <? if(defined('HTTPS_SET') && HTTPS_SET=="on"){?>
                <script src="https://ssl.daumcdn.net/dmaps/map_js_init/postcode.v2.js"></script>
            <?}else{?>
                <script src="http://dmaps.daum.net/map_js_init/postcode.v2.js"></script>
                <script charset="UTF-8" type="text/javascript" src="http://t1.daumcdn.net/postcode/api/core/180928/1538455030985/180928.js"></script>
            <?}?>

<script language="javascript">

    $(document).ready(function() {
        $('.num_only').css('imeMode','disabled').keypress(function(event) {
            if(event.which && (event.which < 48 || event.which > 57) ) {
                event.preventDefault();
            }
        }).keyup(function(){
            if( $(this).val() != null && $(this).val() != '' ) {
                $(this).val( $(this).val().replace(/[^0-9]/g, '') );
            }
        }).blur(function(){
            if( $(this).val() != null && $(this).val() != '' ) {
                $(this).val( $(this).val().replace(/[^0-9]/g, '') );
            }
        });

        $('.num_only_comma').css('imeMode','disabled').keypress(function(event) {
            if(event.which && (event.which < 48 || event.which > 57) ) {
                event.preventDefault();
            }
        }).keyup(function(){
            if( $(this).val() != null && $(this).val() != '' ) {
                //var tmps = $(this).val().replace(/[^0-9]/g, '');
                var tmps = $(this).val().replace(/[^0-9]/g, '');
                var tmps2 = tmps.replace(/(\d)(?=(\d\d\d)+(?!\d))/g, "$1,");
                $(this).val(tmps2);
            }
        }).blur(function() {
            if ($(this).val() != null && $(this).val() != '') {
                //var tmps = $(this).val().replace(/[^0-9]/g, '');
                var tmps = $(this).val().replace(/[^0-9]/g, '');
                var tmps2 = tmps.replace(/(\d)(?=(\d\d\d)+(?!\d))/g, "$1,");
                $(this).val(tmps2);
            }
        });

    });

    $(function() {
        $( "#datepicker1, #datepicker2, #datepicker3, #datepicker4, #datepicker5, #datepicker6, #datepicker7, #datepicker8" ).datepicker({
            dateFormat: 'yy-mm-dd',
            monthNames: ['1월','2월','3월','4월','5월','6월','7월','8월','9월','10월','11월','12월'],
            monthNamesShort: ['1월','2월','3월','4월','5월','6월','7월','8월','9월','10월','11월','12월'],
            dayNames: ['일','월','화','수','목','금','토'],
            dayNamesShort: ['일','월','화','수','목','금','토'],
            dayNamesMin: ['일','월','화','수','목','금','토'],
        });
    });

    function execDaumPostcode() {
        new daum.Postcode({
            oncomplete: function(data) {
                var fullRoadAddr = data.roadAddress; // 도로명 주소 변수
                var extraRoadAddr = ''; // 도로명 조합형 주소 변수

                if(data.bname !== '' && /[동|로|가]$/g.test(data.bname)){
                    extraRoadAddr += data.bname;
                }
                if(data.buildingName !== '' && data.apartment === 'Y'){
                    extraRoadAddr += (extraRoadAddr !== '' ? ', ' + data.buildingName : data.buildingName);
                }
                // 도로명, 지번 조합형 주소가 있을 경우, 괄호까지 추가한 최종 문자열을 만든다.
                if(extraRoadAddr !== ''){
                    extraRoadAddr = ' (' + extraRoadAddr + ')';
                }
                // 도로명, 지번 주소의 유무에 따라 해당 조합형 주소를 추가한다.
                if(fullRoadAddr !== ''){
                    fullRoadAddr += extraRoadAddr;
                }
                // 우편번호와 주소 정보를 해당 필드에 넣는다.
                document.getElementById('ob_zip').value = data.zonecode; //5자리 새우편번호 사용
                document.getElementById('roadAddress').value = fullRoadAddr;
                document.getElementById('jibunAddress').value = data.address;
                //document.getElementById('jibunAddress').value = fullRoadAddr;

                // 사용자가 '선택 안함'을 클릭한 경우, 예상 주소라는 표시를 해준다.
                if(data.autoRoadAddress) {
                    //예상되는 도로명 주소에 조합형 주소를 추가한다.
                    var expRoadAddr = data.autoRoadAddress + extraRoadAddr;
                    //document.getElementById('guide').innerHTML = '(예상 도로명 주소 : ' + expRoadAddr + ')';

                } else if(data.autoJibunAddress) {
                    var expJibunAddr = data.autoJibunAddress;
                    //document.getElementById('guide').innerHTML = '(예상 지번 주소 : ' + expJibunAddr + ')';

                } else {
                    //document.getElementById('guide').innerHTML = '';
                }
            }
        }).open();
    }


    function ajaxForm_post(url, formId){
        //if(!datatype) {
            var contenttype = 'application/json; charset=utf-8';
            var datatype = 'json';
        //}

        $("#"+formId).ajaxForm({
            'url': url,
            'enctype': 'multipart/form-data',
            'dataType': datatype,
            'contentType': contenttype,
            'processData': false,
            error : function(request, status, error){
                alert("code:"+request.status+"\n"+"message:"+request.responseText+"\n"+"error:"+error);
            },
            success : function(result){
                //alert(result.data);
                $('#ob_office_idx').val(result.data);

                location.href = '/crm/mbroffice/edt/'+$('#ob_office_idx').val();
                //location.href = '/crm/mbroffice/list';
            }
        });
        $("#"+formId).submit();
    }


    function set_office_reg(){
        var url = '/crm/mbroffice/office_reg';
        var formId = 'formReg';
        var pwd = $('#ac_pwd').val();
        var rtn = 'true';

        //var rtn = fn_id_dup_chk();
        //if(rtn == 'false') {
        //    return false;
        //}
        var idDupVal = $('#idDupVal').text();
        //alert(idDupVal);
        if(idDupVal == '[ID 중복체크]') {
            toastr.info('아이디 중복체크를 해주세요');
            $("#ac_id").select();
            //rtn = 'false';
            return false;
        }

        if(!chkPwd( pwd.replace(/(^\s*)|(\s*$)/gi, ""))){
            //$('#ac_pwd').val('');
            $('#ac_pwd').select();
            //rtn = 'false';
            return false;
         }

        //if(rtn != 'false'){
            ajaxForm_post(url, formId);
        //}

    }


    function fn_id_dup_chk(){
        var url = '/crm/mbroffice/idDupChk';

        var ac_id = $("#ac_id").val();
        if(ac_id == ''){
            toastr.info('아이디를 입력하여주세요');
            $("#ac_id").focus();
            return false;
        }
        var data = {
            "ac_id" : ac_id
        }
        console.log(data);

        ajax_post(url, data, function(ret) {
            if(ret.msg == 'FALSE') {
                //alert('error : '+ret.data);
                toastr.info('기존에 사용중인 아이디 입니다');
                $("#ac_id").select();
                return false;
            } else {
                toastr.info('사용이가능한 아이디 입니다');
                $('#idDupVal').text('ID 중복체크 완료');
                console.log(ret);
                return true;
            }
        });
    }


    function fn_pwd_init() {
        var ob_office_idx = $('#ob_office_idx').val();
        if(ob_office_idx == '' || !ob_office_idx){
            toastr.info('세무사무소 기본정보를 저장하지 않으셨습니다');
            return false;
        }

        var result = confirm('비밀번호를 초기화 하시겠습니까');
        if(result) {
            var url = '/crm/mbroffice/pwdInit';
            var data = {
                "ob_office_idx" : ob_office_idx
            }
            console.log(data);
            ajax_post(url, data, function(ret) {
                if(ret.msg == 'TRUE') {
                    toastr.info('비밀번호가 초기화 되었습니다');
                } else {
                    toastr.info('비밀번호가 초기화가 실패하였습니다');
                    console.log(ret);
                }
            });

        } else {
        }
    }


    function chkPwd(str){
        var pw = str;
        var num = pw.search(/[0-9]/g);
        var eng = pw.search(/[a-z]/ig);
        var spe = pw.search(/[`~!@@#$%^&*|₩₩₩'₩";:₩/?]/gi);

        if(pw.length < 10 || pw.length > 20){
            alert("비밀번호는 10자리 ~ 20자리 이내로 입력해주세요.");
            return false;
        }
        if(pw.search(/₩s/) != -1){
            alert("비밀번호는 공백없이 입력해주세요.");
            return false;
        }
        if( (num < 0 && eng < 0) || (eng < 0 && spe < 0) || (spe < 0 && num < 0) ){
            alert("비밀번호는 영문,숫자, 특수문자 중 2가지 이상을 혼합하여 입력해주세요.");
            return false;
        }
        return true;
    }





    $('#svc_inf').on({
        'change' : function(event){
                var fields = $(this).parents('form:eq(0),body').find('button,input,textarea,select');
                var index = fields.index(this);
                var objNm = fields.eq(index +0).prop('name');

                if(objNm == 'si_svcgds_idx'){
                    var si_svcgds_idx = $("#si_svcgds_idx option:selected").val();
                    //alert(sb);

                    var url = '/crm/mbroffice/mbrsvc';
                    var data = {
                        "si_svcgds_idx" : si_svcgds_idx
                    }
                    console.log(data);

                    ajax_post(url, data, function(ret) {
                        if(ret.msg == 'TRUE') {
                            ret.si_svcgds_idx
                            //ret.si_svcgdsNm
                            $('#ms_ttlAmt').val(ret.si_svcgds_amt);
                            $('#ms_ttlperiod').val(ret.si_svc_period);
                            $("#ms_mbrgbn").val("Y");

                            if ($('#ms_ttlAmt').val() != null && $('#ms_ttlAmt').val() != '') {
                                var tmps = $('#ms_ttlAmt').val().replace(/[^0-9]/g, '');
                                var tmps2 = tmps.replace(/(\d)(?=(\d\d\d)+(?!\d))/g, "$1,");
                                $('#ms_ttlAmt').val(tmps2);
                            }

                            var ms_mbrBeginDt = $('#datepicker5').val();
                            var ms_mbrEndDt_v = '';
                            if(ms_mbrBeginDt != ''){
                                //alert(ret.si_svc_period);
                                ms_mbrEndDt_v = dateAddDel(ms_mbrBeginDt, ret.si_svc_period, 'd');
                                $('#datepicker6').val(ms_mbrEndDt_v);
                            }

                            console.log(ret);
                        } else {
                            alert('error : '+ret.data);
                        }
                    });

                }
        },
        //"keyup" : function(){...},
        //"keydown" : function(){...},
        //"blur" : function(){...}
    },'.svcgds_inf');


    function set_office_svcinf_reg()
    {
        var ob_office_idx = $('#ob_office_idx').val();
        if(ob_office_idx == '' || !ob_office_idx){
            toastr.info('세무사무소 기본정보를 저장하지 않으셨습니다');
            return false;
        }

        var url = '/crm/mbroffice/regMbrsvc';

        var ms_mbr_idx = $('#ms_mbr_idx').val();
        var si_svcgds_idx = $("#si_svcgds_idx option:selected").val(); //selectbox
        var ms_joinDt = $('#datepicker2').val();
        var ms_mbrgbn = $("#ms_mbrgbn option:selected").val(); //selectbox
        var ms_ttlAmt = $('#ms_ttlAmt').val().replace(/,/gi, '');
        var ms_ttlperiod = $('#ms_ttlperiod').val();
        var ms_freeBeginDt = $('#datepicker3').val();
        var ms_freeEndDt = $('#datepicker4').val();
        var ms_mbrBeginDt = $('#datepicker5').val();
        var ms_mbrEndDt = $('#datepicker6').val();

        var data = {
            "ob_office_idx" : ob_office_idx,
            "ms_mbr_idx" : ms_mbr_idx,
            "si_svcgds_idx" : si_svcgds_idx,
            "ms_joinDt" : ms_joinDt,
            "ms_mbrgbn" : ms_mbrgbn,
            "ms_ttlAmt" : ms_ttlAmt,
            "ms_ttlperiod" : ms_ttlperiod,
            "ms_freeBeginDt" : ms_freeBeginDt,
            "ms_freeEndDt" : ms_freeEndDt,
            "ms_mbrBeginDt" : ms_mbrBeginDt,
            "ms_mbrEndDt" : ms_mbrEndDt

        }
        console.log(data);

        ajax_post(url, data, function(ret) {
            if(ret.msg == 'TRUE') {
                toastr.info('세무사무소 서비스정보를 저장하였습니다');
                console.log(ret);
            } else {
                alert('error : '+ret.data);
            }
        });
    }


    function fn_reg_office_profile_proc(procgbn,ob_office_idx,etc)
    {
        var ob_office_idx = $('#ob_office_idx').val();
        if(ob_office_idx == '' || !ob_office_idx){
            toastr.info('세무사무소 기본정보를 저장하지 않으셨습니다');
            return false;
        }

        var url = '/crm/mbroffice/regOfficeProfile';
        var pf_date = $('#datepicker7').val();
        var pf_desc = $('#pf_desc').val();

        var data = {
            "pf_date" : pf_date,
            "pf_desc" : pf_desc,
            "ob_office_idx" : ob_office_idx
        }
        console.log(data);

        ajax_post(url, data, function(ret) {
            if(ret.msg == 'TRUE') {
                toastr.info('세무사무소 프로필정보를 저장하였습니다');
                console.log(ret);

                fn_get_office_profile_list(ob_office_idx);
            } else {
                alert('error : '+ret.data);
            }
        });
    }


    function fn_get_office_profile_list(ob_office_idx)
    {
        var url = '/crm/mbroffice/office_profile_list';
        var data = {
            "ob_office_idx" : ob_office_idx
        }
        console.log(data);

        ajax_post(url, data, function(ret) {
            if(ret.msg == 'TRUE') {
                var strHtml = "";
                var strHtml2 = '';

                $('#datepicker7').val('');
                $('#pf_desc').val('');

                if(ret.list.length>0){
                    for(i=0;i<ret.list.length;i++){
                        strHtml += "<tr>";
                        strHtml += "    <td><input type=\"text\" name=\"pf_date_"+ret.list[i].pf_profile_idx+"\" id=\"pf_date_"+ret.list[i].pf_profile_idx+"\" value='"+ ret.list[i].pf_date +"' style='width:100%; border:1px;'></td>\n";
                        strHtml += "    <td><input type=\"text\" name=\"pf_desc_"+ret.list[i].pf_profile_idx+"\" id=\"pf_desc_"+ ret.list[i].pf_profile_idx +"\" value='"+ ret.list[i].pf_desc +"' style='width:100%; border:1px;'></td>\n";
                        strHtml += "    <td>\n";
                        strHtml += "       <a href=\"javascript: fn_set_office_profile_proc('EDT','"+ret.list[i].ob_office_idx+"','"+ret.list[i].pf_profile_idx+"')\">수정</a>|\n";
                        strHtml += "       <a href=\"javascript: fn_set_office_profile_proc('DEL','"+ret.list[i].ob_office_idx+"','"+ret.list[i].pf_profile_idx+"')\">삭제</a>\n";
                        strHtml += "    </td>\n";
                        strHtml += "</tr>";
                    }
                }
                $('#profileList').html(strHtml);
                console.log(ret);
            }
            else {
                //alert('error : '+ret.data);
                strHtml2 += "<tr>";
                strHtml2 += "    <td></td>\n";
                strHtml2 += "    <td></td>\n";
                strHtml2 += "    <td></td>\n";
                strHtml2 += "</tr>";
                $('#profileList').html(strHtml2);
            }
        });
    }


    function fn_set_office_profile_proc(procgbn, ob_office_idx, pf_profile_idx)
    {
        var ob_office_idx = $('#ob_office_idx').val();
        if(ob_office_idx == '' || !ob_office_idx){
            toastr.info('세무사무소 기본정보를 저장하지 않으셨습니다');
            return false;
        }

        var url = '/crm/mbroffice/procOfficeProfile';
        var curr_pf_date = $('#pf_date_'+pf_profile_idx).val();  //update
        var curr_pf_desc = $('#pf_desc_'+pf_profile_idx).val();

        var data = {
            "procgbn" : procgbn,
            "ob_office_idx" : ob_office_idx,
            "pf_profile_idx" : pf_profile_idx,
            "curr_pf_date" : curr_pf_date,
            "curr_pf_desc" : curr_pf_desc
        }
        var procgbn_v = '';
        if(procgbn == 'EDT') {
            procgbn_v = '수정';
        }else {
            procgbn_v = '삭제';
        }
        console.log(data);

        ajax_post(url, data, function(ret) {
            if(ret.msg == 'TRUE') {
                toastr.info('세무사무소 프로필정보를 '+procgbn_v+'하였습니다');
                console.log(ret);

                fn_get_office_profile_list(ob_office_idx);
            } else {
                alert('error : '+ret.data);
            }
        });
    }



    function fn_reg_taxAccnt_proc()
    {
        var ob_office_idx = $('#ob_office_idx').val();
        if(ob_office_idx == '' || !ob_office_idx){
            toastr.info('세무사무소 기본정보를 저장하지 않으셨습니다');
            return false;
        }

        var url = '/crm/mbroffice/reg_office_taxaccnt';
        var at_taxAccntNm = $('#at_taxAccntNm').val();
        var at_eduLvl = $('#at_eduLvl').val();
        var at_jobfield = $('#at_jobfield').val();
        var at_Profile = $('#at_Profile').val();

        var data = {
            "at_taxAccntNm" : at_taxAccntNm,
            "at_eduLvl" : at_eduLvl,
            "at_jobfield" : at_jobfield,
            "at_Profile" : at_Profile,
            "ob_office_idx" : ob_office_idx
        }
        console.log(data);

        ajax_post(url, data, function(ret) {
            if(ret.msg == 'TRUE') {
                toastr.info('세무사무소 직원정보를 저장하였습니다');
                console.log(ret);

                fn_get_office_taxAccnt_list(ob_office_idx);
            } else {
                alert('error : '+ret.data);
            }
        });
    }


    function fn_get_office_taxAccnt_list(ob_office_idx)
    {
        var url = '/crm/mbroffice/office_taxAccnt_list';
        var data = {
            "ob_office_idx" : ob_office_idx
        }
        console.log(data);

        ajax_post(url, data, function(ret) {
            if(ret.msg == 'TRUE') {
                var strHtml = "";
                var strHtml2 = '';

                $('#at_taxAccntNm').val('');
                $('#at_eduLvl').val('');
                $('#at_jobfield').val('');
                $('#at_Profile').val('');

                //at_taxAccnt_idx, ob_office_idx, at_taxAccntNm, at_eduLvl, at_jobfield, at_Profile, at_wrkgbn, at_regDt, at_uptDt, at_regId, at_uptId
                if(ret.list.length>0){
                    for(i=0;i<ret.list.length;i++){
                        strHtml += "<tr>";
                        strHtml += "    <td><input type=\"text\" name=\"at_taxAccntNm_"+ret.list[i].at_taxAccnt_idx+"\" id=\"at_taxAccntNm_"+ret.list[i].at_taxAccnt_idx+"\" value='"+ ret.list[i].at_taxAccntNm +"' style='width:100%; border:1px;'></td>\n";
                        strHtml += "    <td><input type=\"text\" name=\"at_eduLvl_"+ret.list[i].at_taxAccnt_idx+"\" id=\"at_eduLvl_"+ ret.list[i].at_taxAccnt_idx +"\" value='"+ ret.list[i].at_eduLvl +"' style='width:100%; border:1px;'></td>\n";
                        strHtml += "    <td><input type=\"text\" name=\"at_jobfield_"+ret.list[i].at_taxAccnt_idx+"\" id=\"at_jobfield_"+ ret.list[i].at_taxAccnt_idx +"\" value='"+ ret.list[i].at_jobfield +"' style='width:100%; border:1px;'></td>\n";
                        strHtml += "    <td><input type=\"text\" name=\"at_Profile_"+ret.list[i].at_taxAccnt_idx+"\" id=\"at_Profile_"+ ret.list[i].at_taxAccnt_idx +"\" value='"+ ret.list[i].at_Profile +"' style='width:100%; border:1px;'></td>\n";
                        strHtml += "    <td>\n";
                        strHtml += "       <a href=\"javascript: fn_set_office_taxAccnt_proc('EDT','"+ret.list[i].ob_office_idx+"','"+ret.list[i].at_taxAccnt_idx+"')\">수정</a>|\n";
                        strHtml += "       <a href=\"javascript: fn_set_office_taxAccnt_proc('DEL','"+ret.list[i].ob_office_idx+"','"+ret.list[i].at_taxAccnt_idx+"')\">삭제</a>\n";
                        strHtml += "    </td>\n";
                        strHtml += "</tr>";
                    }
                }
                $('#taxAccntList').html(strHtml);
                console.log(ret);
            }
            else {
                //alert('error : '+ret.data);
                strHtml2 += "<tr>";
                strHtml2 += "    <td></td>\n";
                strHtml2 += "    <td></td>\n";
                strHtml2 += "    <td></td>\n";
                strHtml2 += "    <td></td>\n";
                strHtml2 += "    <td></td>\n";
                strHtml2 += "</tr>";
                $('#taxAccntList').html(strHtml2);
            }
        });
    }



    function fn_set_office_taxAccnt_proc(procgbn, ob_office_idx, at_taxAccnt_idx)
    {
        var ob_office_idx = $('#ob_office_idx').val();
        if(ob_office_idx == '' || !ob_office_idx){
            toastr.info('세무사무소 기본정보를 저장하지 않으셨습니다');
            return false;
        }

        var url = '/crm/mbroffice/procOfficeTaxAccnt';
        var at_taxAccntNm = $('#at_taxAccntNm_'+at_taxAccnt_idx).val();  //update
        var at_eduLvl = $('#at_eduLvl_'+at_taxAccnt_idx).val();
        var at_jobfield = $('#at_jobfield_'+at_taxAccnt_idx).val();
        var at_Profile = $('#at_Profile_'+at_taxAccnt_idx).val();


        var data = {
            "procgbn" : procgbn,
            "ob_office_idx" : ob_office_idx,
            "at_taxAccnt_idx" : at_taxAccnt_idx,
            "at_taxAccntNm" : at_taxAccntNm,
            "at_eduLvl" : at_eduLvl,
            "at_jobfield" : at_jobfield,
            "at_Profile" : at_Profile
        }
        var procgbn_v = '';
        if(procgbn == 'EDT') {
            procgbn_v = '수정';
        }else {
            procgbn_v = '삭제';
        }
        console.log(data);

        ajax_post(url, data, function(ret) {
            if(ret.msg == 'TRUE') {
                toastr.info('세무사무소 직원정보를 '+procgbn_v+'하였습니다');
                console.log(ret);

                fn_get_office_taxAccnt_list(ob_office_idx);
            } else {
                alert('error : '+ret.data);
            }
        });
    }















    function fn_reg_client_proc()
    {
        var ob_office_idx = $('#ob_office_idx').val();
        if(ob_office_idx == '' || !ob_office_idx){
            toastr.info('세무사무소 기본정보를 저장하지 않으셨습니다');
            return false;
        }

        var url = '/crm/mbroffice/reg_office_client';
        var mc_clientNm = $('#mc_clientNm').val();
        var mc_fieldgbn = $('#mc_fieldgbn').val();
        var mc_wrkdesc = $('#mc_wrkdesc').val();

        var data = {
            "mc_clientNm" : mc_clientNm,
            "mc_fieldgbn" : mc_fieldgbn,
            "mc_wrkdesc" : mc_wrkdesc,
            "ob_office_idx" : ob_office_idx
        }
        console.log(data);

        ajax_post(url, data, function(ret) {
            if(ret.msg == 'TRUE') {
                toastr.info('세무사무소 직원정보를 저장하였습니다');
                console.log(ret);

                fn_get_office_client_list(ob_office_idx);
            } else {
                alert('error : '+ret.data);
            }
        });
    }




    function fn_get_office_client_list(ob_office_idx)
    {
        var url = '/crm/mbroffice/office_client_list';
        var data = {
            "ob_office_idx" : ob_office_idx
        }
        console.log(data);

        ajax_post(url, data, function(ret) {
            if(ret.msg == 'TRUE') {
                var strHtml = "";
                var strHtml2 = '';

                $('#mc_clientNm').val('');
                $('#mc_fieldgbn').val('');
                $('#mc_wrkdesc').val('');

                if(ret.list.length>0){
                    for(i=0;i<ret.list.length;i++){
                        strHtml += "<tr>";
                        strHtml += "    <td><input type=\"text\" name=\"mc_clientNm_"+ret.list[i].mc_client_idx+"\" id=\"mc_clientNm_"+ret.list[i].mc_client_idx+"\" value='"+ ret.list[i].mc_clientNm +"' style='width:100%; border:1px;'></td>\n";
                        strHtml += "    <td><input type=\"text\" name=\"mc_fieldgbn_"+ret.list[i].mc_client_idx+"\" id=\"mc_fieldgbn_"+ ret.list[i].mc_client_idx +"\" value='"+ ret.list[i].mc_fieldgbn +"' style='width:100%; border:1px;'></td>\n";
                        strHtml += "    <td><input type=\"text\" name=\"mc_wrkdesc_"+ret.list[i].mc_client_idx+"\" id=\"mc_wrkdesc_"+ ret.list[i].mc_client_idx +"\" value='"+ ret.list[i].mc_wrkdesc +"' style='width:100%; border:1px;'></td>\n";
                        strHtml += "    <td>\n";
                        strHtml += "       <a href=\"javascript: fn_set_office_client_proc('EDT','"+ret.list[i].ob_office_idx+"','"+ret.list[i].mc_client_idx+"')\">수정</a>|\n";
                        strHtml += "       <a href=\"javascript: fn_set_office_client_proc('DEL','"+ret.list[i].ob_office_idx+"','"+ret.list[i].mc_client_idx+"')\">삭제</a>\n";
                        strHtml += "    </td>\n";
                        strHtml += "</tr>";
                    }
                }
                $('#clientList').html(strHtml);
                console.log(ret);
            }
            else {
                //alert('error : '+ret.data);
                strHtml2 += "<tr>";
                strHtml2 += "    <td></td>\n";
                strHtml2 += "    <td></td>\n";
                strHtml2 += "    <td></td>\n";
                strHtml2 += "    <td></td>\n";
                strHtml2 += "</tr>";
                $('#clientList').html(strHtml2);
            }
        });
    }




    function fn_set_office_client_proc(procgbn, ob_office_idx, mc_client_idx)
    {
        var ob_office_idx = $('#ob_office_idx').val();
        if(ob_office_idx == '' || !ob_office_idx){
            toastr.info('세무사무소 기본정보를 저장하지 않으셨습니다');
            return false;
        }

        var url = '/crm/mbroffice/procOfficeClient';
        var mc_clientNm = $('#mc_clientNm_'+mc_client_idx).val();  //update
        var mc_fieldgbn = $('#mc_fieldgbn_'+mc_client_idx).val();
        var mc_wrkdesc = $('#mc_wrkdesc_'+mc_client_idx).val();

        var data = {
            "procgbn" : procgbn,
            "ob_office_idx" : ob_office_idx,
            "mc_client_idx" : mc_client_idx,
            "mc_clientNm" : mc_clientNm,
            "mc_fieldgbn" : mc_fieldgbn,
            "mc_wrkdesc" : mc_wrkdesc
        }
        var procgbn_v = '';
        if(procgbn == 'EDT') {
            procgbn_v = '수정';
        }else {
            procgbn_v = '삭제';
        }
        console.log(data);

        ajax_post(url, data, function(ret) {
            if(ret.msg == 'TRUE') {
                toastr.info('세무사무소 프로필정보를 '+procgbn_v+'하였습니다');
                console.log(ret);

                fn_get_office_client_list(ob_office_idx);
            } else {
                alert('error : '+ret.data);
            }
        });
    }













    function fn_reg_wrkfield_proc()
    {
        var ob_office_idx = $('#ob_office_idx').val();
        if(ob_office_idx == '' || !ob_office_idx){
            toastr.info('세무사무소 기본정보를 저장하지 않으셨습니다');
            return false;
        }

        var url = '/crm/mbroffice/reg_office_wrkfield';
        var mf_wrkfieldNm = $('#mf_wrkfieldNm').val();

        var data = {
            "mf_wrkfieldNm" : mf_wrkfieldNm,
            "ob_office_idx" : ob_office_idx
        }
        console.log(data);

        ajax_post(url, data, function(ret) {
            if(ret.msg == 'TRUE') {
                toastr.info('세무사무소 전문분야정보를 저장하였습니다');
                console.log(ret);

                fn_get_office_wrkfield_list(ob_office_idx);
            } else {
                alert('error : '+ret.data);
            }
        });
    }




    function fn_get_office_wrkfield_list(ob_office_idx)
    {
        var url = '/crm/mbroffice/office_wrkfield_list';
        var data = {
            "ob_office_idx" : ob_office_idx
        }
        console.log(data);

        ajax_post(url, data, function(ret) {
            if(ret.msg == 'TRUE') {
                var strHtml = "";
                var strHtml2 = '';

                $('#mf_wrkfieldNm').val('');

                if(ret.list.length>0){
                    for(i=0;i<ret.list.length;i++){
                        strHtml += "<tr>";
                        strHtml += "    <td><input type=\"text\" name=\"mf_wrkfieldNm_"+ret.list[i].mf_wrkfield_idx+"\" id=\"mf_wrkfieldNm_"+ ret.list[i].mf_wrkfield_idx +"\" value='"+ ret.list[i].mf_wrkfieldNm +"' style='width:100%; border:1px;'></td>\n";
                        strHtml += "    <td>\n";
                        strHtml += "       <a href=\"javascript: fn_set_office_wrkfield_proc('EDT','"+ret.list[i].ob_office_idx+"','"+ret.list[i].mf_wrkfield_idx+"')\">수정</a>|\n";
                        strHtml += "       <a href=\"javascript: fn_set_office_wrkfield_proc('DEL','"+ret.list[i].ob_office_idx+"','"+ret.list[i].mf_wrkfield_idx+"')\">삭제</a>\n";
                        strHtml += "    </td>\n";
                        strHtml += "</tr>";
                    }
                }
                $('#wrkfieldList').html(strHtml);
                console.log(ret);
            }
            else {
                //alert('error : '+ret.data);
                strHtml2 += "<tr>";
                strHtml2 += "    <td></td>\n";
                strHtml2 += "    <td></td>\n";
                strHtml2 += "</tr>";
                $('#wrkfieldList').html(strHtml2);
            }
        });
    }





    function fn_set_office_wrkfield_proc(procgbn, ob_office_idx, mf_wrkfield_idx)
    {
        var ob_office_idx = $('#ob_office_idx').val();
        if(ob_office_idx == '' || !ob_office_idx){
            toastr.info('세무사무소 기본정보를 저장하지 않으셨습니다');
            return false;
        }

        var url = '/crm/mbroffice/procOfficeWrkfield';
        var mf_wrkfieldNm = $('#mf_wrkfieldNm_'+mf_wrkfield_idx).val();  //update

        var data = {
            "procgbn" : procgbn,
            "ob_office_idx" : ob_office_idx,
            "mf_wrkfield_idx" : mf_wrkfield_idx,
            "mf_wrkfieldNm" : mf_wrkfieldNm
        }
        var procgbn_v = '';
        if(procgbn == 'EDT') {
            procgbn_v = '수정';
        }else {
            procgbn_v = '삭제';
        }
        console.log(data);

        ajax_post(url, data, function(ret) {
            if(ret.msg == 'TRUE') {
                toastr.info('세무사무소 전문분야정보를 '+procgbn_v+'하였습니다');
                console.log(ret);

                fn_get_office_wrkfield_list(ob_office_idx);
            } else {
                alert('error : '+ret.data);
            }
        });
    }








    function fn_reg_intrvw_proc()
    {
        var ob_office_idx = $('#ob_office_idx').val();
        if(ob_office_idx == '' || !ob_office_idx){
            toastr.info('세무사무소 기본정보를 저장하지 않으셨습니다');
            return false;
        }

        var url = '/crm/mbroffice/reg_office_intrvw';
        var iv_officeQ = $('#iv_officeQ').val();
        var iv_officeA = $('#iv_officeA').val();

        var data = {
            "iv_officeQ" : iv_officeQ,
            "iv_officeA" : iv_officeA,
            "ob_office_idx" : ob_office_idx
        }
        console.log(data);

        ajax_post(url, data, function(ret) {
            if(ret.msg == 'TRUE') {
                toastr.info('세무사무소 인터뷰정보를 저장하였습니다');
                console.log(ret);

                fn_get_office_intrvw_list(ob_office_idx);
            } else {
                alert('error : '+ret.data);
            }
        });
    }




    function fn_get_office_intrvw_list(ob_office_idx)
    {
        var url = '/crm/mbroffice/office_intrvw_list';
        var data = {
            "ob_office_idx" : ob_office_idx
        }
        console.log(data);

        ajax_post(url, data, function(ret) {
            if(ret.msg == 'TRUE') {
                var strHtml = "";
                var strHtml2 = '';

                $('#iv_officeQ').val('');
                $('#iv_officeA').val('');

                if(ret.list.length>0){
                    for(i=0;i<ret.list.length;i++){
                        strHtml += "<tr>";
                        strHtml += "    <td><textarea name=\"iv_officeQ_"+ret.list[i].iv_officeQnA_idx+"\" id='iv_officeQ_"+ ret.list[i].iv_officeQnA_idx +"'  class='w100p' rows='10' cols='100' style='height:70px; '>"+ ret.list[i].iv_officeQ +"</textarea></td>\n";
                        strHtml += "    <td><textarea name=\"iv_officeA_"+ret.list[i].iv_officeQnA_idx+"\" id='iv_officeA_"+ ret.list[i].iv_officeQnA_idx +"'  class='w100p' rows='10' cols='100' style='height:70px; '>"+ ret.list[i].iv_officeA +"</textarea></td>\n";
                        strHtml += "    <td>\n";
                        strHtml += "       <a href=\"javascript: fn_set_office_intrvw_proc('EDT','"+ret.list[i].ob_office_idx+"','"+ret.list[i].iv_officeQnA_idx+"')\">수정</a>|\n";
                        strHtml += "       <a href=\"javascript: fn_set_office_intrvw_proc('DEL','"+ret.list[i].ob_office_idx+"','"+ret.list[i].iv_officeQnA_idx+"')\">삭제</a>\n";
                        strHtml += "    </td>\n";
                        strHtml += "</tr>";
                    }
                }
                $('#intrvwList').html(strHtml);
                console.log(ret);
            }
            else {
                //alert('error : '+ret.data);
                strHtml2 += "<tr>";
                strHtml2 += "    <td></td>\n";
                strHtml2 += "    <td></td>\n";
                strHtml2 += "    <td></td>\n";
                strHtml2 += "</tr>";
                $('#intrvwList').html(strHtml2);
            }
        });
    }







    function fn_set_office_intrvw_proc(procgbn, ob_office_idx, iv_officeQnA_idx)
    {
        var ob_office_idx = $('#ob_office_idx').val();
        if(ob_office_idx == '' || !ob_office_idx){
            toastr.info('세무사무소 기본정보를 저장하지 않으셨습니다');
            return false;
        }

        var url = '/crm/mbroffice/procOfficeIntrvw';
        var iv_officeQ = $('#iv_officeQ_'+iv_officeQnA_idx).val();  //update
        var iv_officeA = $('#iv_officeA_'+iv_officeQnA_idx).val();  //update

        var data = {
            "procgbn" : procgbn,
            "ob_office_idx" : ob_office_idx,
            "iv_officeQnA_idx" : iv_officeQnA_idx,
            "iv_officeQ" : iv_officeQ,
            "iv_officeA" : iv_officeA
        }
        var procgbn_v = '';
        if(procgbn == 'EDT') {
            procgbn_v = '수정';
        }else {
            procgbn_v = '삭제';
        }
        console.log(data);

        ajax_post(url, data, function(ret) {
            if(ret.msg == 'TRUE') {
                toastr.info('세무사무소 인터뷰정보를 '+procgbn_v+'하였습니다');
                console.log(ret);

                fn_get_office_intrvw_list(ob_office_idx);
            } else {
                alert('error : '+ret.data);
            }
        });
    }


    $(function () {
       $('#sdg_sido_no').change(function () {
           //alert(this.value);

           var url = '/crm/mbroffice/get_gu_list';
           var sdg_sido_no = this.value;
           //alert(sdg_sido_no );

           var data = {
               "sdg_sido_no" : sdg_sido_no,
           }
           console.log(data);

           ajax_post(url, data, function(ret) {
               console.log('ret - '+ret);
               if(ret.msg == 'TRUE') {
                   fn_get_gu_list(ret);
               } else {
                   alert('error : '+ret);
               }
           });


       }) ;
    });


    function fn_get_gu_list(ret){
        //var ret = result.data;
        if(ret.msg == 'TRUE') {
            var strHtml = "";
            var strHtml2 = '';

            $('#sdg_gu_no').val('');
            strHtml += "<option value=''>선택하세요</option>";
            if(ret.list.length>0){
                for(i=0;i<ret.list.length;i++){
                    strHtml += "<option value='"+ ret.list[i].sdg_gu_no +"'>"+ ret.list[i].sdg_gu_nm +"</option>";
                }
            }
            $('#sdg_gu_no').html(strHtml);
            console.log(ret);
        }
        else {
            $('#sdg_gu_no').html('');
            strHtml2 += "<option value=''>선택하세요</option>";
            $('#sdg_gu_no').html(strHtml2);
        }
    }




    function dateAddDel(sDate, nNum, type) {
        var yy = Number(parseInt(sDate.substr(0, 4), 10));
        var mm = Number(parseInt(sDate.substr(5, 2), 10));
        var dd = Number(parseInt(sDate.substr(8), 10));

        if (type == "d") {
            d = new Date(yy, mm - 1, dd + Number(nNum));
        }
        else if (type == "m") {
            d = new Date(yy, mm - 1, dd + (Number(nNum) * 31));
        }
        else if (type == "y") {
            d = new Date(yy + Number(nNum), mm - 1, dd);
        }

        yy = d.getFullYear();
        mm = d.getMonth() + 1; mm = (mm < 10) ? '0' + mm : mm;
        dd = d.getDate(); dd = (dd < 10) ? '0' + dd : dd;

        return '' + yy + '-' +  mm  + '-' + dd;
    }

    // 좌표 검색 popup
    function btn_search_titud(frm,x,y,addr) {// form name, x,y 좌표 id, addr name

            if($( "input[name$="+addr+"]" ).val()) {
                var url = "/crm/popup/find_addr?x=" + x + "&y=" + y + "&addr=" + addr;
                var title = "find_addr";
                var status = "toolbar=no,directories=no,scrollbars=no,resizable=no,status=no,menubar=no,width=500, height=500, top=0,left=20";
                var wif=  window.open("", title, status); //window.open(url,title,status); window.open 함수에 url을 앞에와 같이
                //인수로  넣어도 동작에는 지장이 없으나 form.action에서 적용하므로 생략
                //가능합니다.
                frm.target = title;                    //form.target 이 부분이 빠지면 form값 전송이 되지 않습니다.
                frm.action = url;                    //form.action 이 부분이 빠지면 action값을 찾지 못해서 제대로 된 팝업이 뜨질 않습니다.
                frm.method = "post";
                frm.submit();
            }else{
                toastr.error('주소를 먼저 검색해 주세요.');
            }
    }

</script>



