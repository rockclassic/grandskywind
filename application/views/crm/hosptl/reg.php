<div class="row" id="content-wrapper">
    <div class="col-xs-12">
        <? $this->load->view('crm/common/top'); ?>
        <div class='row'>
            <div class='col-sm-12'>
                <div class='box bordered-box muted-border' style='margin-bottom:0;'>
                    <div class='box-header muted-background' style="height:30px;padding: 0px">
                        <div class='title'  > 제휴병원 상세정보  </div>
                    </div>

                    <div class='box-content' style="border-bottom: 0;">
                        <div class="table_top"><!-- table_top start -->
                            <div class="left_opt">
                                <h4>기본정보</h4>
                            </div>
                        </div><!-- table_top end -->

                        <!--
                        <?='date(\'w\') - '.date('w')?><br>
                        <?='date(\'w\') - '.date('w',strtotime(date("Y-m-d")))?>
                        -->

                        <form class="form form-horizontal" id="formReg" name="formReg" method="post"  enctype="multipart/form-data">
                            <input type="hidden" name="hb_idx" id="hb_idx" value='<?=$hosptl_base['data']['hb_idx']?>'>
                            <input type="hidden" id="hb_img_width" name="hb_img_width" class="w100p" value="<?=$hosptl_base['data']['hb_img_width']?>">
                            <input type="hidden" id="hb_img_height" name="hb_img_height" class="w100p" value="<?=$hosptl_base['data']['hb_img_height']?>">


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
                                        <th scope="row">병원명</th>
                                        <td><input type="text" id="hb_hosptl_nm" name="hb_hosptl_nm" class="w100p" value="<?=$hosptl_base['data']['hb_hosptl_nm']?>"/></td>
                                        <th scope="row">병원구분</th>
                                        <td >
                                            <label><input type="radio" name="hb_hosptl_gbn" id="hb_hosptl_gbn_T" class='pay_type' value='T' <?if( $hosptl_base['data']['hb_hosptl_gbn'] == 'T' ) echo(' checked '); ?> />치과병원</label> &nbsp;
                                            <label><input type="radio" name="hb_hosptl_gbn" id="hb_hosptl_gbn_B" class='pay_type' value='B' <?if( $hosptl_base['data']['hb_hosptl_gbn'] == 'B' ) echo(' checked '); ?>/>성형병원</label> &nbsp;
                                            <label><input type="radio" name="hb_hosptl_gbn" id="hb_hosptl_gbn_E" class='pay_type' value='E' <?if( $hosptl_base['data']['hb_hosptl_gbn'] == 'E' ) echo(' checked '); ?>/>기타병원</label>
                                        </td>
                                        <th scope="row">연락처</th>
                                        <td><input type="text" id="hb_tel" name="hb_tel" class="w100p" value="<?=$hosptl_base['data']['hb_tel']?>"/></td>
                                    </tr>
                                    <tr>
                                        <th scope="row">예약여부</th>
                                        <td>
                                            <select id="hb_reserv_gbn" name='hb_reserv_gbn' class="w100p" title="상태선택">
                                                <option value=''>상태선택</option>
                                                <option value='N'  <?=(trim($hosptl_base['data']['hb_reserv_gbn'])=='N') ?' selected':''?> >예약불가</option>
                                                <option value='Y'  <?=(trim($hosptl_base['data']['hb_reserv_gbn'])=='Y') ?' selected':''?> >예약가능</option>
                                            </select>
                                        </td>
                                        <th scope="row">접수여부</th>
                                        <td>
                                            <select id="hb_accpt_gbn" name='hb_accpt_gbn' class="w100p" title="상태선택">
                                                <option value=''>상태선택</option>
                                                <option value='N'  <?=(trim($hosptl_base['data']['hb_accpt_gbn'])=='N') ?' selected':''?> >접수불가</option>
                                                <option value='Y'  <?=(trim($hosptl_base['data']['hb_accpt_gbn'])=='Y') ?' selected':''?> >접수가능</option>
                                            </select>
                                        </td>
                                        <th scope="row">견적여부</th>
                                        <td>
                                            <select id="hb_estmate_gbn" name='hb_estmate_gbn' class="w100p" title="상태선택">
                                                <option value=''>상태선택</option>
                                                <option value='N'  <?=(trim($hosptl_base['data']['hb_estmate_gbn'])=='N') ?' selected':''?> >견적불가</option>
                                                <option value='Y'  <?=(trim($hosptl_base['data']['hb_estmate_gbn'])=='Y') ?' selected':''?> >견적가능</option>
                                            </select>
                                        </td>
                                    </tr>
                                    <tr>
                                        <th scope="row" rowspan="2" class="v-top"><label for="mb-adrs">주소</label></th>
                                        <td colspan="5">
                                            <input type="text"  id='hb_zip_num' name="hb_zip_num" maxlength=4   value="<?=$hosptl_base['data']['hb_zip_num']?>" style="width:100px;" />
                                            <span class="in_btn"><a href="#" onclick="execDaumPostcode()" class="link_type" id="srchZip">우편번호검색</a></span>
                                        </td>
                                    </tr>
                                    <tr>
                                        <td colspan="5">
                                            <input type="text" id="roadAddress" name="mb_addr0" value="$hosptl_base['data']['hb_addr']" style="display:none;"/>
                                            <input type="text" style="width:35%;" id="jibunAddress" name="hb_addr"  value="<?=$hosptl_base['data']['hb_addr']?>" readonly="readonly;"/>
                                            <input type="text" style="width:35%;" id="mb_addr2" name="hb_addr_desc"  value="<?=$hosptl_base['data']['hb_addr_desc']?>" />
                                        </td>
                                    </tr>
                                    <tr>
                                        <th scope="row"  class="v-top"><label for="mb-adrs">지도좌표</label></th>
                                        <td>
                                            <input type="text"  id='hb_latitude' name="hb_latitude"   value="<?=$hosptl_base['data']['hb_latitude']?>" style="width:45%;" />
                                            &nbsp;&nbsp;
                                            <input type="text"  id='hb_longtitude' name="hb_longtitude"   value="<?=$hosptl_base['data']['hb_longtitude']?>" style="width:45%;" />
                                        </td>
                                        <td colspan="4">
                                            <div class="btn btn-primary btn_search btn-xs" >
                                                <a href="javascript:btn_search_titud(this.formReg,'hb_latitude','hb_longtitude','hb_addr');" style="color:white;">지도좌표 검색</a>
                                            </div>
                                        </td>
                                    </tr>
                                    <tr>
                                        <th scope="row" rowspan="1" class="v-top"><label for="mb-adrs">시도구군</label></th>
                                        <td colspan="5">
                                            <select id="sdg_sido_no" name='sdg_sido_no' class="w40p svcgds_inf" title="" style="float:left; width:30%;margin-right:5px;">
                                                <option value=''>선택하세요</option>
                                                <?
                                                foreach($sdg_sido_list['data'] as $k => $v) {
                                                    ?>
                                                    <option value='<?=$v['sdg_sido_no']?>'  <?=(trim($hosptl_base['data']['hb_sido'])==trim($v['sdg_sido_no'])) ?' selected':''?> ><?=$v['sdg_sido_nm']?></option>
                                                    <?
                                                }
                                                ?>
                                            </select>
                                            <?// echo "hosptl_base['data']['hb_gu'] - ".$hosptl_base['data']['hb_gu']."<br>";  ?>
                                            <select id="sdg_gu_no" name='sdg_gu_no' class="w40p svcgds_inf" title="" style="float:left; width:30%;">
                                                <option value=''>선택하세요</option>
                                                <?
                                                //if(trim($hosptl_base['data']['hb_sido']) != '' && trim($hosptl_base['data']['hb_gu']) == ''){
                                                if(trim($hosptl_base['data']['hb_sido']) != ''){
                                                    foreach($hosptl_gu_list['data'] as $k => $v) {
                                                        ?>
                                                        <option value='<?=$v['sdg_gu_no']?>'  <?=(trim($hosptl_base['data']['hb_gu'])==trim($v['sdg_gu_no'])) ?' selected':''?> ><?=$v['sdg_gu_nm']?></option>
                                                        <?
                                                    }
                                                }
                                                ?>
                                            </select>
                                        </td>
                                    </tr>

                                    <tr>
                                        <th scope="row" rowspan="2" style="height:150px;">병원이미지</th>
                                        <td rowspan="2">
                                            <div>
                                                <img src ='/uploads/files/<?=$hosptl_base['data']['hb_img']?>' id='hb_img' name='hb_img' >
                                            </div>
                                        </td>
                                    </tr>
                                    <tr style="display: none">
                                        <th scope="row"><label for="hb_img">기존이미지</label></th>
                                        <td colspan="5"><input type="text" id="hb_img_bak" name="hb_img_bak" class="w50p" value="<?=$hosptl_base['data']['hb_img_path']?><?=$hosptl_base['data']['hb_img']?>"/></td>
                                    </tr>
                                    <tr>
                                        <th scope="row"><label for="hb_img">파일첨부</label></th>
                                        <td colspan="5">
                                            <input type="file" id="document-file" name="document-file" value="" />
                                        </td>
                                    </tr>

                                    <tr>
                                        <th scope="row"><label for="mb_photo">병원소개</label></th>
                                        <td colspan="5"><textarea cols="20" rows="5" class="memo_box" id="hb_intro"  name="hb_intro" ><?=$hosptl_base['data']['hb_intro']?></textarea></td>
                                    </tr>
                                    <tr>
                                        <th scope="row"><label for="mb_photo">부가정보</label></th>
                                        <td colspan="5"><textarea cols="20" rows="5" class="memo_box" id="hb_memo"  name="hb_memo" ><?=$hosptl_base['data']['hb_memo']?></textarea></td>
                                    </tr>
                                    <tr>
                                        <th scope="row"><label for="mb_photo">상태</label></th>
                                        <td colspan="1">
                                            <select id="hb_state" name='hb_state' class="w100p" title="상태선택">
                                                <option value=''>상태선택</option>
                                                <option value='R'  <?=(trim($hosptl_base['data']['hb_state'])=='R') ?' selected':''?> >대기</option>
                                                <option value='N'  <?=(trim($hosptl_base['data']['hb_state'])=='N') ?' selected':''?> >미승인</option>
                                                <option value='Y'  <?=(trim($hosptl_base['data']['hb_state'])=='Y') ?' selected':''?> >승인</option>
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

                                        <? if($this->openssl_mem->aes_decrypt($this->session->userdata('user_grade'))>=7){ ?>

                                        <button class="btn btn-warning btn_search btn-xs" >
                                            <a href="javascript:set_hosptl_reg();" style="color:white;">저 장</a>
                                        </button>

                                        <? } ?>

                                    </div>
                                </div>
                            </div>

                            <!-- //회원유형 -->
                        </form>






                        <!-- 요일별 진료시간 설정 -->
                        <div class="table_area"><!-- table_area start -->
                            <div class="table_top"><!-- table_top start -->
                                <div class="left_opt">
                                    <h4>요일별 진료시간</h4>
                                </div>
                            </div><!-- table_top end -->
                            <table class="list">
                                <colgroup>
                                    <col width="40%" />
                                    <col width="45%" />
                                    <col width="15%" />
                                </colgroup>
                                <thead>
                                <tr>
                                    <th scope="col">요일</th>
                                    <th scope="col">진료시간/휴무여부</th>
                                    <th scope="col">삭제</th>
                                </tr>
                                </thead>
                                <tbody id="treatmnt_time_list">
                                <td scope="col" colspan="5"></td>
                                </tbody>
                            </table>
                            <table>
                                <colgroup>
                                    <col width="40%" />
                                    <col width="50%" />
                                    <col width="10%" />
                                </colgroup>
                                <tbody>
                                <tr>
                                    <td scope="col">
                                        <label id="week_weekday_nm" style="width: 60px; "><input type="checkbox" name="week_weekday" id="week_weekday" value="weekday" class='itemd' />평일</label>
                                        <label id="weekdayall_week_mon_nm" style="width: 50px; "><input type="checkbox" name="weekdayall_week_mon" id="weekdayall_week_mon" value="1" class='itemd' />월</label>
                                        <label id="weekdayall_week_tue_nm" style="width: 50px; "><input type="checkbox" name="weekdayall_week_tue" id="weekdayall_week_tue" value="2" class='itemd' />화</label>
                                        <label id="weekdayall_week_wen_nm" style="width: 50px; "><input type="checkbox" name="weekdayall_week_wen" id="weekdayall_week_wen" value="3" class='itemd' />수</label>
                                        <label id="weekdayall_week_thu_nm" style="width: 50px; "><input type="checkbox" name="weekdayall_week_thu" id="weekdayall_week_thu" value="4" class='itemd' />목</label>
                                        <label id="weekdayall_week_fri_nm" style="width: 50px; "><input type="checkbox" name="weekdayall_week_fri" id="weekdayall_week_fri" value="5" class='itemd' />금</label>
                                        <!--
                                        <label id="end_sat_nm" style="width: 50px; "><input type="checkbox" name="all_end_sat" id="all_end_sat" value="sat" class='itemd' />토</label>
                                        <label id="end_sun_nm" style="width: 50px; "><input type="checkbox" name="all_end_sun" id="all_end_sun" value="sun" class='itemd' />일</label>
                                        -->
                                    </td>
                                    <td scope="col">
                                        <select id="mt_begin_hour_0" name='mt_begin_hour_0'  style='width:20%;' title="시간선택">
                                            <option value=''>시간선택</option>
                                            <option value='09'>09</option>
                                            <option value='10'>10</option>
                                            <option value='11'>11</option>
                                            <option value='12'>12</option>
                                            <option value='13'>13</option>
                                            <option value='14'>14</option>
                                            <option value='15'>15</option>
                                            <option value='16'>16</option>
                                            <option value='17'>17</option>
                                            <option value='18'>18</option>
                                            <option value='19'>19</option>
                                            <option value='20'>20</option>
                                            <option value='21'>21</option>
                                            <option value='22'>22</option>
                                            <option value='23'>23</option>
                                            <option value='00'>00</option>
                                        </select>
                                        <select id="mt_bigin_minute_0" name='mt_bigin_minute_0'  style='width:20%;' title="분선택">
                                            <option value=''>분선택</option>
                                            <option value='00'>00</option>
                                            <option value='30'>30</option>
                                        </select>
                                        ~
                                        <select id="mt_end_hour_0" name='mt_end_hour_0'  style='width:20%;' title="시간선택">
                                            <option value=''>시간선택</option>
                                            <option value='09'>09</option>
                                            <option value='10'>10</option>
                                            <option value='11'>11</option>
                                            <option value='12'>12</option>
                                            <option value='13'>13</option>
                                            <option value='14'>14</option>
                                            <option value='15'>15</option>
                                            <option value='16'>16</option>
                                            <option value='17'>17</option>
                                            <option value='18'>18</option>
                                            <option value='19'>19</option>
                                            <option value='20'>20</option>
                                            <option value='21'>21</option>
                                            <option value='22'>22</option>
                                            <option value='23'>23</option>
                                            <option value='00'>00</option>
                                        </select>
                                        <select id="mt_end_minute_0" name='mt_end_minute_0'  style='width:20%;' title="분선택">
                                            <option value=''>분선택</option>
                                            <option value='00'>00</option>
                                            <option value='30'>30</option>
                                        </select>
                                    </td>
                                    <td scope="col">
                                         <label id="cmp_itemd_0_nm" style="width: 80px; "><input type="checkbox" name="mt_dayoff_gbn_0" id="mt_dayoff_gbn_0" value="Y" class='itemd' />휴무구분</label>

                                    </td>

                                    <td scope="col">

                                        <div class="row2">
                                            <div class="col-md-11"></div>
                                            <div class="col-md-1">
                                                <div class="btn_cls" >
                                                    <button class="btn btn-warning btn_search btn-xs" onclick="javascript: fn_reg_treatmnt_time('weekday','_0');">
                                                        저 장
                                                    </button>
                                                </div>
                                            </div>
                                        </div>

                                    </td>
                                </tr>

                                <tr>
                                    <td scope="col">
                                        <label id="week_weekday_nm" style="width: 60px; "><input type="checkbox" name="weekend_weekend" id="weekend_weekend" value="weekday" class='itemd' />주말</label>
                                        <label id="weekendall_end_sat_nm" style="width: 50px; "><input type="checkbox" name="weekendall_end_sat" id="weekendall_end_sat" value="6" class='itemd' />토</label>
                                        <label id="weekendall_end_sun_nm" style="width: 50px; "><input type="checkbox" name="weekendall_end_sun" id="weekendall_end_sun" value="0" class='itemd' />일</label>
                                    </td>
                                    <td scope="col">
                                        <select id="mt_begin_hour_1" name='mt_begin_hour_1'  style='width:20%;' title="시간선택">
                                            <option value=''>시간선택</option>
                                            <option value='09'>09</option>
                                            <option value='10'>10</option>
                                            <option value='11'>11</option>
                                            <option value='12'>12</option>
                                            <option value='13'>13</option>
                                            <option value='14'>14</option>
                                            <option value='15'>15</option>
                                            <option value='16'>16</option>
                                            <option value='17'>17</option>
                                            <option value='18'>18</option>
                                            <option value='19'>19</option>
                                            <option value='20'>20</option>
                                            <option value='21'>21</option>
                                            <option value='22'>22</option>
                                            <option value='23'>23</option>
                                            <option value='00'>00</option>
                                        </select>
                                        <select id="mt_bigin_minute_1" name='mt_bigin_minute_1'  style='width:20%;' title="분선택">
                                            <option value=''>분선택</option>
                                            <option value='00'>00</option>
                                            <option value='30'>30</option>
                                        </select>
                                        ~
                                        <select id="mt_end_hour_1" name='mt_end_hour_1'  style='width:20%;' title="시간선택">
                                            <option value=''>시간선택</option>
                                            <option value='09'>09</option>
                                            <option value='10'>10</option>
                                            <option value='11'>11</option>
                                            <option value='12'>12</option>
                                            <option value='13'>13</option>
                                            <option value='14'>14</option>
                                            <option value='15'>15</option>
                                            <option value='16'>16</option>
                                            <option value='17'>17</option>
                                            <option value='18'>18</option>
                                            <option value='19'>19</option>
                                            <option value='20'>20</option>
                                            <option value='21'>21</option>
                                            <option value='22'>22</option>
                                            <option value='23'>23</option>
                                            <option value='00'>00</option>
                                        </select>
                                        <select id="mt_end_minute_1" name='mt_end_minute_1'  style='width:20%;' title="분선택">
                                            <option value=''>분선택</option>
                                            <option value='00'>00</option>
                                            <option value='30'>30</option>
                                        </select>
                                    </td>
                                    <td scope="col">
                                        <label id="cmp_itemd_0_nm" style="width: 80px; "><input type="checkbox" name="mt_dayoff_gbn_1" id="mt_dayoff_gbn_1" value="Y" class='itemd' />휴무구분</label>

                                    </td>

                                    <td scope="col">

                                        <div class="row2">
                                            <div class="col-md-11"></div>
                                            <div class="col-md-1">
                                                <div class="btn_cls" >
                                                    <button class="btn btn-warning btn_search btn-xs" onclick="javascript: fn_reg_treatmnt_time('weekend','_1');">
                                                        저 장
                                                    </button>
                                                </div>
                                            </div>
                                        </div>

                                    </td>
                                </tr>

                                <tr>
                                    <td scope="col">
                                        <label id="week_weekday_nm" style="width: 100px; ">점심시간</label>
                                    </td>
                                    <td scope="col">
                                        <select id="mt_begin_hour_2" name='mt_begin_hour_2'  style='width:20%;' title="시간선택">
                                            <option value=''>시간선택</option>
                                            <option value='09'>09</option>
                                            <option value='10'>10</option>
                                            <option value='11'>11</option>
                                            <option value='12'>12</option>
                                            <option value='13'>13</option>
                                            <option value='14'>14</option>
                                            <option value='15'>15</option>
                                            <option value='16'>16</option>
                                            <option value='17'>17</option>
                                            <option value='18'>18</option>
                                            <option value='19'>19</option>
                                            <option value='20'>20</option>
                                            <option value='21'>21</option>
                                            <option value='22'>22</option>
                                            <option value='23'>23</option>
                                            <option value='00'>00</option>
                                        </select>
                                        <select id="mt_bigin_minute_2" name='mt_bigin_minute_2'  style='width:20%;' title="분선택">
                                            <option value=''>분선택</option>
                                            <option value='00'>00</option>
                                            <option value='30'>30</option>
                                        </select>
                                        ~
                                        <select id="mt_end_hour_2" name='mt_end_hour_2'  style='width:20%;' title="시간선택">
                                            <option value=''>시간선택</option>
                                            <option value='09'>09</option>
                                            <option value='10'>10</option>
                                            <option value='11'>11</option>
                                            <option value='12'>12</option>
                                            <option value='13'>13</option>
                                            <option value='14'>14</option>
                                            <option value='15'>15</option>
                                            <option value='16'>16</option>
                                            <option value='17'>17</option>
                                            <option value='18'>18</option>
                                            <option value='19'>19</option>
                                            <option value='20'>20</option>
                                            <option value='21'>21</option>
                                            <option value='22'>22</option>
                                            <option value='23'>23</option>
                                            <option value='00'>00</option>
                                        </select>
                                        <select id="mt_end_minute_2" name='mt_end_minute_2'  style='width:20%;' title="분선택">
                                            <option value=''>분선택</option>
                                            <option value='00'>00</option>
                                            <option value='30'>30</option>
                                        </select>
                                    </td>
                                    <td scope="col">

                                    </td>

                                    <td scope="col">

                                        <div class="row2">
                                            <div class="col-md-11"></div>
                                            <div class="col-md-1">
                                                <div class="btn_cls" >
                                                    <button class="btn btn-warning btn_search btn-xs" onclick="javascript: fn_reg_treatmnt_time('lunchtime','_2');">
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
                        <!-- //요일별 진료시간 설정 -->






                        <!-- 병원 이미지 설정 -->
                        <div class="table_area" style=""><!-- table_area start -->
                            <form class="form form-horizontal" id="formRegImg" name="formRegImg" method="post"  enctype="multipart/form-data">
                            <input type="hidden" name="hb_idx" id="hb_idx" value='<?=$hosptl_base['data']['hb_idx']?>'>

                            <div class="table_top"><!-- table_top start -->
                                <div class="left_opt">
                                    <h4>병원 이미지</h4>
                                </div>
                            </div><!-- table_top end -->
                            <table class="list">
                                <colgroup>
                                    <col width="40%" />
                                    <col width="45%" />
                                    <col width="15%" />
                                </colgroup>
                                <thead>
                                <tr>
                                    <th scope="col">기존이미지</th>
                                    <th scope="col">기존이미지 파일</th>
                                    <th scope="col">삭제</th>
                                </tr>
                                </thead>
                                <tbody id="hosptl_img_list">
                                <td scope="col" colspan="5"></td>
                                </tbody>
                            </table>
                            <table>
                                <colgroup>
                                    <col width="40%" />
                                    <col width="50%" />
                                    <col width="10%" />
                                </colgroup>
                                <tbody>
                                <tr>
                                    <td scope="col">
                                        <div>파일업로드</div>
                                    </td>
                                    <td scope="col">
                                        <input type="file" id="document-file2" name="document-file2" value="" />
                                    </td>
                                    <td scope="col">
                                        <label id="hi_main_gbn_nm" style="width: 80px; "><input type="checkbox" name="hi_main_gbn" id="hi_main_gbn" value="Y" class='itemd' />메인구분</label>

                                    </td>
                                    <td scope="col">
                                        <div class="row2">
                                            <div class="col-md-11"></div>
                                            <div class="col-md-1">
                                                <div class="btn_cls" >
                                                    <button class="btn btn-warning btn_search btn-xs" id="reg_hosptl_img">
                                                        저 장
                                                    </button>
                                                </div>
                                            </div>
                                        </div>

                                    </td>
                                </tr>
                                </tbody>
                            </table>
                            </form>
                        </div>
                        <!-- //병원 이미지 설정 -->






                        <!-- 주요 의료진 설정 -->
                        <div class="table_area" style=""><!-- table_area start -->
                            <form class="form form-horizontal" id="formRegDctr" name="formRegDctr" method="post"  enctype="multipart/form-data">
                                <input type="hidden" name="hb_idx" id="hb_idx" value='<?=$hosptl_base['data']['hb_idx']?>'>
                                <input type="hidden" name="procgbn" id="procgbn" value=''>
                                <input type="hidden" name="md_idx" id="md_idx" value=''>


                                <div class="table_top"><!-- table_top start -->
                                    <div class="left_opt">
                                        <h4>주요 의료진</h4>
                                    </div>
                                </div><!-- table_top end -->
                                <table class="list">
                                    <colgroup>
                                        <col width="25%" />
                                        <col width="10%" />
                                        <col width="25%" />
                                        <col width="25%" />
                                        <col width="15%" />
                                    </colgroup>
                                    <thead>
                                    <tr>
                                        <th scope="col">이미지</th>
                                        <th scope="col">의사명</th>
                                        <th scope="col">진료과목</th>
                                        <th scope="col">전문분야</th>
                                        <th scope="col">수정|삭제</th>
                                    </tr>
                                    </thead>
                                    <tbody id="main_doctr_list">
                                    <td scope="col" colspan="5"></td>
                                    </tbody>
                                </table>
                                <table>
                                    <colgroup>
                                        <col width="25%" />
                                        <col width="10%" />
                                        <col width="25%" />
                                        <col width="25%" />
                                        <col width="15%" />
                                    </colgroup>
                                    <tbody>
                                    <tr>
                                        <td scope='col'>
                                            <input type='file' id='document-file3' name='document-file3' value='' />
                                        </td>
                                        <td scope='col'>
                                            <input type='text' id='md_dctr_nm' name='md_dctr_nm' class='w90p' value=''/>
                                        </td>
                                        <td scope='col'>
                                            <input type='text' id='md_mdcalsubjct_nm' name='md_mdcalsubjct_nm' class='w60p' value=''/>
                                            <input type='text' id='md_mdcalsubjct_cd' name='md_mdcalsubjct_cd' class='w20p' value=''/>
                                            <div class="btn btn-primary btn-xs" id='md_mdcalsubjct_cd_btn' name='md_mdcalsubjct_cd_btn' >
                                                <div style="color:white;">검 색</div>
                                            </div>
                                        </td>
                                        <td scope='col'>
                                            <input type='text' id='md_profield_nm' name='md_profield_nm' class='w60p' value=''/>
                                            <input type='text' id='md_profield_cd' name='md_profield_cd' class='w20p' value=''/>
                                            <div class="btn btn-primary btn-xs" id='md_profield_cd_btn' name='md_profield_cd_btn' >
                                                <div style="color:white;">검 색</div>
                                            </div>
                                        </td>
                                        <td scope="col">
                                            <div class="row2" style="float:right;">
                                                <div class="col-md-11"></div>
                                                <div class="col-md-1">
                                                    <div class="btn_cls" >
                                                        <button class="btn btn-warning btn_search btn-xs" id="reg_main_doctr">
                                                            저 장
                                                        </button>
                                                    </div>
                                                </div>
                                            </div>

                                        </td>
                                    </tr>
                                    </tbody>
                                </table>
                            </form>
                        </div>
                        <!-- //주요 의료진 설정 -->




                        <!--진료과목 팝업 리스트 -->
                        <div class="mdcalsubjct_popup layer" style="display: none;  z-index: 9999;position: absolute;width:600px; height:600px; left: 50%;top: ;margin-left: -250px;overflow: hidden; background: #ffffff; border: 1px solid #e6e6e6;">
                            <div class="mdcalsubjct_popup_header" style="display: flex; align-items: center; justify-content: space-between; text-align: right; background: #013c69;">
                                <p style="margin: 0; color: #ffffff; padding: 5px 15px; font-size: 16px;" id="mdcalsubjct_title">진료과목 선택</p>
                                <button class="mdcalsubjct_popup_close" style="background: none; border: 0; font-size: 24px; color: #ffffff; padding: 5px 15px;"><i class="icon-remove" style="font-size: 20px"></i></button>
                            </div>

                            <div class="table_top" style='margin-top:10px;'><!-- table_top start -->
                                <div class="left_opt">
                                    <h4>* 진료과목 목록 (다중선택 가능)</h4>
                                </div>
                            </div><!-- table_top end -->
                            <div style="margin-left:15px; overflow-y: scroll; height:480px;">
                                <table class="list" style='width:98%;' >
                                    <colgroup>
                                        <col width="35%" />
                                        <col width="65%" />
                                    </colgroup>
                                    <thead>
                                    <tr>
                                        <th scope="col">선택</th>
                                        <th scope="col">진료과목</th>
                                    </tr>
                                    </thead>
                                    <tbody id="mdcalsubjct_popup_list">
                                    <td scope="col" colspan="2"></td>
                                    </tbody>
                                </table>
                            </div>

                            <div class="mdcalsubjct_popup_footer" style="text-align: right; padding: 0 20px 20px;">
                                <button class="mdcalsubjct_popup_submit" style="width: 100px; padding: 8px 0; border: 0; background: #333333; color: #ffffff;">저장</button>
                            </div>
                        </div>
                        <!--//진료과목 팝업 리스트 -->





                        <!--전문분야 팝업 리스트 -->
                        <div class="profield_popup layer" style="display: none;  z-index: 9999;position: absolute;width:600px; height:600px; left: 50%;top: ;margin-left: -250px;overflow: hidden; background: #ffffff; border: 1px solid #e6e6e6;">
                            <div class="profield_popup_header" style="display: flex; align-items: center; justify-content: space-between; text-align: right; background: #013c69;">
                                <p style="margin: 0; color: #ffffff; padding: 5px 15px; font-size: 16px;" id="profield_title">전문분야 선택</p>
                                <button class="profield_popup_close" style="background: none; border: 0; font-size: 24px; color: #ffffff; padding: 5px 15px;"><i class="icon-remove" style="font-size: 20px"></i></button>
                            </div>

                            <div class="table_top" style='margin-top:10px;'><!-- table_top start -->
                                <div class="left_opt">
                                    <h4>* 전문분야 목록 (다중선택 가능)</h4>
                                </div>
                            </div><!-- table_top end -->
                            <div style="margin-left:15px; overflow-y: scroll; height:480px;">
                                <table class="list" style='width:98%;' >
                                    <colgroup>
                                        <col width="35%" />
                                        <col width="65%" />
                                    </colgroup>
                                    <thead>
                                    <tr>
                                        <th scope="col">선택</th>
                                        <th scope="col">전문분야</th>
                                    </tr>
                                    </thead>
                                    <tbody id="profield_popup_list">
                                    <td scope="col" colspan="2"></td>
                                    </tbody>
                                </table>
                            </div>

                            <div class="profield_popup_footer" style="text-align: right; padding: 0 20px 20px;">
                                <button class="profield_popup_submit" style="width: 100px; padding: 8px 0; border: 0; background: #333333; color: #ffffff;">저장</button>
                            </div>
                        </div>
                        <!--//전문분야 팝업 리스트 -->





                        <!--테마구분 팝업 리스트 -->
                        <div class="theme_popup layer" style="display: none;  z-index: 9999;position: absolute;width:600px; height:600px; left: 50%;top: ;margin-left: -250px;overflow: hidden; background: #ffffff; border: 1px solid #e6e6e6;">
                            <div class="theme_popup_header" style="display: flex; align-items: center; justify-content: space-between; text-align: right; background: #013c69;">
                                <p style="margin: 0; color: #ffffff; padding: 5px 15px; font-size: 16px;" id="theme_title">테마구분 선택</p>
                                <button class="theme_popup_close" style="background: none; border: 0; font-size: 24px; color: #ffffff; padding: 5px 15px;"><i class="icon-remove" style="font-size: 20px"></i></button>
                            </div>

                            <div class="table_top" style='margin-top:10px;'><!-- table_top start -->
                                <div class="left_opt">
                                    <h4>* 테마구분 목록 (다중선택 가능)</h4>
                                </div>
                            </div><!-- table_top end -->
                            <div style="margin-left:15px; overflow-y: scroll; height:480px;">
                                <table class="list" style='width:98%;' >
                                    <colgroup>
                                        <col width="35%" />
                                        <col width="65%" />
                                    </colgroup>
                                    <thead>
                                    <tr>
                                        <th scope="col">선택</th>
                                        <th scope="col">테마구분</th>
                                    </tr>
                                    </thead>
                                    <tbody id="theme_popup_list">
                                    <td scope="col" colspan="2"></td>
                                    </tbody>
                                </table>
                            </div>

                            <div class="theme_popup_footer" style="text-align: right; padding: 0 20px 20px;">
                                <button class="theme_popup_submit" style="width: 100px; padding: 8px 0; border: 0; background: #333333; color: #ffffff;">저장</button>
                            </div>
                        </div>
                        <!--//테마구분 팝업 리스트 -->





                        <!-- 병원 진료과목 설정 -->
                        <div class="table_area" style=""><!-- table_area start -->
                            <form class="form form-horizontal" id="formReg_mdcalsubjct" name="formReg_mdcalsubjct" method="post"  enctype="multipart/form-data">
                                <input type="hidden" name="hb_idx" id="hb_idx" value='<?=$hosptl_base['data']['hb_idx']?>'>

                                <div class="table_top"><!-- table_top start -->
                                    <div class="left_opt">
                                        <h4>병원 진료과목</h4>
                                    </div>
                                </div><!-- table_top end -->
                                <table class="list">
                                    <colgroup>
                                        <col width="85%" />
                                        <col width="15%" />
                                    </colgroup>
                                    <thead>
                                    <tr>
                                        <th scope="col">진료과목</th>
                                        <th scope="col">삭제</th>
                                    </tr>
                                    </thead>
                                    <tbody id="hosptl_medcalsubjct_list">
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
                                        <td scope='col'>
                                            <input type='text' id='hb_mdcalsubjct_nm' name='hb_mdcalsubjct_nm' class='w60p' value=''/>
                                            <input type='text' id='hb_mdcalsubjct_cd' name='hb_mdcalsubjct_cd' class='w20p' value=''/>
                                            <div class="btn btn-primary btn-xs" id='hb_mdcalsubjct_cd_btn' name='hb_mdcalsubjct_cd_btn' onclick="mdcalsubjct_srch('hosptl')" >
                                                <div style="color:white;">검 색</div>
                                            </div>
                                        </td>
                                        <td scope="col">
                                            <div class="row2" style="float:right;">
                                                <div class="col-md-11"></div>
                                                <div class="col-md-1">
                                                    <div class="btn_cls" >
                                                        <div class="btn btn-warning btn_search btn-xs" id="reg_hosptl_medcalsubjct">
                                                            저 장
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>

                                        </td>
                                    </tr>
                                    </tbody>
                                </table>
                            </form>
                        </div>
                        <!-- //병원 진료과목 설정 -->






                        <!-- 병원 전문분야 설정 -->
                        <div class="table_area" style=""><!-- table_area start -->
                            <form class="form form-horizontal" id="formReg_profield" name="formReg_profield" method="post"  enctype="multipart/form-data">
                                <input type="hidden" name="hb_idx" id="hb_idx" value='<?=$hosptl_base['data']['hb_idx']?>'>

                                <div class="table_top"><!-- table_top start -->
                                    <div class="left_opt">
                                        <h4>병원 전문분야</h4>
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
                                        <th scope="col">삭제</th>
                                    </tr>
                                    </thead>
                                    <tbody id="hosptl_profield_list">
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
                                        <td scope='col'>
                                            <input type='text' id='hb_profield_nm' name='hb_profield_nm' class='w60p' value=''/>
                                            <input type='text' id='hb_profield_cd' name='hb_profield_cd' class='w20p' value=''/>
                                            <div class="btn btn-primary btn-xs" id='hb_profield_cd_btn' name='hb_profield_cd_btn' onclick="profield_srch('hosptl')" >
                                                <div style="color:white;">검 색</div>
                                            </div>
                                        </td>
                                        <td scope="col">
                                            <div class="row2" style="float:right;">
                                                <div class="col-md-11"></div>
                                                <div class="col-md-1">
                                                    <div class="btn_cls" >
                                                        <div class="btn btn-warning btn_search btn-xs" id="reg_hosptl_profield">
                                                            저 장
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>

                                        </td>
                                    </tr>
                                    </tbody>
                                </table>
                            </form>
                        </div>
                        <!-- //병원 전문분야 설정 -->





                        <!-- 병원 테마구분 설정 -->
                        <div class="table_area" style=""><!-- table_area start -->
                            <form class="form form-horizontal" id="formReg_theme" name="formReg_theme" method="post"  enctype="multipart/form-data">
                                <input type="hidden" name="hb_idx" id="hb_idx" value='<?=$hosptl_base['data']['hb_idx']?>'>

                                <div class="table_top"><!-- table_top start -->
                                    <div class="left_opt">
                                        <h4>병원 테마구분</h4>
                                    </div>
                                </div><!-- table_top end -->
                                <table class="list">
                                    <colgroup>
                                        <col width="85%" />
                                        <col width="15%" />
                                    </colgroup>
                                    <thead>
                                    <tr>
                                        <th scope="col">테마구분</th>
                                        <th scope="col">삭제</th>
                                    </tr>
                                    </thead>
                                    <tbody id="hosptl_theme_list">
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
                                        <td scope='col'>
                                            <input type='text' id='hb_theme_nm' name='hb_theme_nm' class='w60p' value=''/>
                                            <input type='text' id='hb_theme_cd' name='hb_theme_cd' class='w20p' value=''/>
                                            <div class="btn btn-primary btn-xs" id='hb_theme_cd_btn' name='hb_theme_cd_btn' onclick="theme_srch('hosptl')" >
                                                <div style="color:white;">검 색</div>
                                            </div>
                                        </td>
                                        <td scope="col">
                                            <div class="row2" style="float:right;">
                                                <div class="col-md-11"></div>
                                                <div class="col-md-1">
                                                    <div class="btn_cls" >
                                                        <div class="btn btn-warning btn_search btn-xs" id="reg_hosptl_theme">
                                                            저 장
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>

                                        </td>
                                    </tr>
                                    </tbody>
                                </table>
                            </form>
                        </div>
                        <!-- //병원 테마구분 설정 -->

























































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

                    $("#hb_img").each(function() {
                        // 모드가 0이면 두 변 중 더 긴 변의 길이가 제한에 걸리도록 합니다.
                        // 모드가 1이면 가로 길이가 제한에 걸리도록 합니다.
                        // 모드가 2이면 세로 길이가 제한에 걸리도록 합니다.
                        var mode = 0;
                        var restrict_length = 180;

                        // 이미지를 가져옵니다.
                        var img = new Image();
                        img.src = $(this).attr("src");

                        // 현재 이미지의 비율을 저장해 둡니다.
                        var ratio = img.width / img.height; // 비율

                        // 모드를 확인한 후에 세로를 기준으로 줄일 것인지 가로를 기준으로 줄일 것인지 결정합니다.
                        if((mode == 0 && img.width > img.height) || mode == 1) {
                            // 가로 길이가 제한보다 긴 경우에만 작동합니다.
                            if(img.width > restrict_length) {
                                var newheight = Math.round(restrict_length / ratio);
                                $(this).attr({width:restrict_length, height:newheight});  // 폭과 높이를 새로 지정
                            }
                        } else {
                            // 세로 길이가 제한보다 긴 경우에만 작동합니다.
                            if(img.height > restrict_length) {
                                var newwidth = Math.round(restrict_length * ratio);
                                $(this).attr({width:newwidth, height:restrict_length});  // 폭과 높이를 새로 지정
                            }
                        }
                    });


                    var hb_idx = $('#hb_idx').val();
                    //fn_get_treatmnt_time_list(hb_idx);
                    //fn_hosptl_img_list(hb_idx);
                    //fn_main_doctr_list(hb_idx);
                    //fn_get_hosptl_medcalsubjct_list(hb_idx);
                    //fn_get_hosptl_profield_list(hb_idx);

                });


                function set_hosptl_reg(){
                    var url = '/crm/hosptl/set_hosptl_reg';
                    var formId = 'formReg';

                    ajaxForm_post(url, formId);
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
                            if(result.msg == 'TRUE') {
                                toastr.info('기본정보가 등록되었습니다');
                                location.href = '/crm/hosptl/desc/'+result.data;
                            }
                        }
                    });
                    $("#"+formId).submit();
                }


                function fn_reg_hosptl_img(){
                    var url = '/crm/hosptl/reg_hosptl_img';
                    var formId = 'formRegImg';

                    ajaxForm_post_img(url, formId);
                }


                function ajaxForm_post_img(url, formId){
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
                            if(result.msg == 'TRUE') {
                                toastr.info('병원이미지가 등록되었습니다');

                                var hb_idx = $('#hb_idx').val();
                                fn_hosptl_img_list(hb_idx);
                            }
                        }
                    });
                    //$("#"+formId).submit();
                }




                function fn_hosptl_img_list(hb_idx)
                {
                    var url = '/crm/hosptl/hosptl_img_list';
                    var data = {
                        "hb_idx" : hb_idx
                    }
                    console.log(data);

                    ajax_post(url, data, function(ret) {
                        if(ret.msg == 'TRUE') {
                            var strHtml = "";
                            var strHtml2 = '';
                            var hi_main_gbn_v =  '';

                            if(ret.list.length>0){
                                for(i=0;i<ret.list.length;i++){

                                    if(ret.list[i].hi_main_gbn == 'Y' ) {
                                        hi_main_gbn_v = ' [메인이미지]';
                                    }else{
                                        hi_main_gbn_v = '';
                                    }

                                    var fileNm_arr = ret.list[i].hi_img.split('.');
                                    var fileNm = fileNm_arr[0];
                                    var fileExt = fileNm_arr[1];
                                    var fileThumbNm = fileNm+'_thumb.'+ fileExt;

                                    strHtml += "<tr>";
                                    strHtml += "    <td><img src ='/uploads/files/"+ fileThumbNm +"' id='hb_img_"+ ret.list[i].hi_idx +"' name='hb_img_"+ ret.list[i].hi_idx +"' class='thumb_img' ></td>\n";
                                    strHtml += "    <td>\n";
                                    strHtml +=              fileThumbNm ;
                                    strHtml +=              hi_main_gbn_v ;
                                    strHtml += "   </td>\n";
                                    strHtml += "    <td>\n";
                                    strHtml += "       <a href=\"javascript: fn_set_hosptl_img('DEL','"+ret.list[i].hi_idx+"','"+ret.list[i].hb_idx+"')\">삭제</a>\n";
                                    strHtml += "    </td>\n";
                                    strHtml += "</tr>";
                                }
                            }
                            $('#hosptl_img_list').html(strHtml);
                            console.log(ret);
                        }
                        else {
                            //alert('error : '+ret.data);
                            strHtml2 += "<tr>";
                            strHtml2 += "    <td></td>\n";
                            strHtml2 += "    <td></td>\n";
                            strHtml2 += "    <td></td>\n";
                            strHtml2 += "</tr>";
                            $('#hosptl_img_list').html(strHtml2);
                        }
                    });
                }



                function fn_set_hosptl_img(procgbn, hi_idx, hb_idx)
                {
                    var hb_idx_v = $('#hb_idx').val();
                    if(hb_idx_v == '' || !hb_idx_v){
                        toastr.info('제휴병원 기본정보를 저장하지 않으셨습니다');
                        return false;
                    }

                    var url = '/crm/hosptl/set_hosptl_img';
                    var data = {
                        "procgbn" : procgbn,
                        "hi_idx" : hi_idx,
                        "hb_idx" : hb_idx
                    }
                    var procgbn_v = '';
                    procgbn_v = '삭제';
                    console.log(data);

                    ajax_post(url, data, function(ret) {
                        if(ret.msg == 'TRUE') {
                            toastr.info('병원 이미지 정보를 '+procgbn_v+' 하였습니다');
                            console.log(ret);

                            fn_hosptl_img_list(hb_idx);
                        } else {
                            //alert('error : '+ret.data);
                        }
                    });




                }




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
                            document.getElementById('hb_zip_num').value = data.zonecode; //5자리 새우편번호 사용
                            document.getElementById('roadAddress').value = fullRoadAddr;
                            document.getElementById('jibunAddress').value = data.address;

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




                $(function() {
                    $('#reg_hosptl_img').click(function(e){
                        fn_reg_hosptl_img();
                        console.log('fn_reg_hosptl_img');
                    });
                })



                $(function() {
                    $('input:checkbox[id="week_weekday"]').click(function(e){
                        //alert('curr : '+$(this).attr('id'));
                        //alert( $('input:checkbox[id="'+$(this).attr('id')+'"]').is(':checked') );

                        $sel_obj_id = $(this).attr('id');
                        $sel_obj_ischk = $('input:checkbox[id="'+$sel_obj_id+'"]').is(':checked');
                        $sel_obj_value = $('input:checkbox[id="'+$sel_obj_id+'"]').val();

                        $checked_state = false;
                        //alert($sel_obj_ischk);
                        //alert($sel_obj_id);

                        if($sel_obj_ischk == true){
                            $('input:checkbox[id*="week_"]').each(function(){
                                $next_obj_id = $(this).attr('id');
                                $next_obj_val = $('input:checkbox[id="'+$(this).attr('id')+'"]').is(':checked');

                                if($next_obj_id != $sel_obj_id){
                                    $('input:checkbox[id="'+$next_obj_id+'"]').attr('checked',true);
                                    $('label[id="'+$next_obj_id+'_nm"]').css('color','blue');

                                }
                            });
                        }else{
                            $('input:checkbox[id*="week_"]').each(function(){
                                $next_obj_id = $(this).attr('id');
                                $next_obj_val = $('input:checkbox[id="'+$(this).attr('id')+'"]').is(':checked');

                                if($next_obj_id != $sel_obj_id){
                                    $('input:checkbox[id="'+$next_obj_id+'"]').attr('checked',false);
                                    $('label[id="'+$next_obj_id+'_nm"]').css('color','black');

                                }
                            });
                        }
                    });
                })



                $(function() {
                    $('input:checkbox[id*="weekdayall_"]').click(function(e){
                        //alert('curr : '+$(this).attr('id'));
                        //alert( $('input:checkbox[id="'+$(this).attr('id')+'"]').is(':checked') );

                        $sel_obj_id = $(this).attr('id');
                        $sel_obj_ischk = $('input:checkbox[id="'+$sel_obj_id+'"]').is(':checked');
                        $sel_obj_value = $('input:checkbox[id="'+$sel_obj_id+'"]').val();
                        var chkd_cnt = 0;

                        $('input:checkbox[id*="weekdayall_"]').each(function(){
                            $next_obj_id = $(this).attr('id');
                            $next_obj_val = $('input:checkbox[id="'+$(this).attr('id')+'"]').is(':checked');

                            if($next_obj_val == true){
                                chkd_cnt = chkd_cnt + 1;
                            }
                        });

                        if(chkd_cnt <= 0){
                            $('input:checkbox[id="week_weekday"]').attr('checked',false);
                        }else{
                            $('input:checkbox[id="week_weekday"]').attr('checked',true);
                        }
                    });
                })




                $(function() {
                    $('input:checkbox[id="weekend_weekend"]').click(function(e){
                        //alert('curr : '+$(this).attr('id'));
                        //alert( $('input:checkbox[id="'+$(this).attr('id')+'"]').is(':checked') );

                        $sel_obj_id = $(this).attr('id');
                        $sel_obj_ischk = $('input:checkbox[id="'+$sel_obj_id+'"]').is(':checked');
                        $sel_obj_value = $('input:checkbox[id="'+$sel_obj_id+'"]').val();

                        $checked_state = false;
                        //alert($sel_obj_ischk);
                        //alert($sel_obj_id);

                        if($sel_obj_ischk == true){
                            $('input:checkbox[id*="end_"]').each(function(){
                                $next_obj_id = $(this).attr('id');
                                $next_obj_val = $('input:checkbox[id="'+$(this).attr('id')+'"]').is(':checked');

                                if($next_obj_id != $sel_obj_id){
                                    $('input:checkbox[id="'+$next_obj_id+'"]').attr('checked',true);
                                    $('label[id="'+$next_obj_id+'_nm"]').css('color','blue');

                                }
                            });
                        }else{
                            $('input:checkbox[id*="end_"]').each(function(){
                                $next_obj_id = $(this).attr('id');
                                $next_obj_val = $('input:checkbox[id="'+$(this).attr('id')+'"]').is(':checked');

                                if($next_obj_id != $sel_obj_id){
                                    $('input:checkbox[id="'+$next_obj_id+'"]').attr('checked',false);
                                    $('label[id="'+$next_obj_id+'_nm"]').css('color','black');

                                }
                            });
                        }
                    });
                })



                $(function() {
                    $('input:checkbox[id*="weekendall_"]').click(function(e){
                        //alert('curr : '+$(this).attr('id'));
                        //alert( $('input:checkbox[id="'+$(this).attr('id')+'"]').is(':checked') );

                        $sel_obj_id = $(this).attr('id');
                        $sel_obj_ischk = $('input:checkbox[id="'+$sel_obj_id+'"]').is(':checked');
                        $sel_obj_value = $('input:checkbox[id="'+$sel_obj_id+'"]').val();
                        var chkd_cnt = 0;

                        $('input:checkbox[id*="weekendall_"]').each(function(){
                            $next_obj_id = $(this).attr('id');
                            $next_obj_val = $('input:checkbox[id="'+$(this).attr('id')+'"]').is(':checked');

                            if($next_obj_val == true){
                                chkd_cnt = chkd_cnt + 1;
                            }
                        });

                        if(chkd_cnt <= 0){
                            $('input:checkbox[id="weekend_weekend"]').attr('checked',false);
                        }else{
                            $('input:checkbox[id="weekend_weekend"]').attr('checked',true);
                        }
                    });
                })


                function fn_reg_treatmnt_time(gbn, seq_v){
                    var hb_idx = $('#hb_idx').val();
                    if(hb_idx == '' || !hb_idx){
                        toastr.info('제휴병원 기본정보를 저장하지 않으셨습니다');
                        return false;
                    }

                    var hb_idx = '';
                    var url = '/crm/hosptl/reg_treatmnt_time';
                    var chkd_list = '';
                    var commar = '';
                    var gbn_v = '';
                    var mt_begin_hour = '';
                    var mt_bigin_minute = '';
                    var mt_end_hour = '';
                    var mt_end_minute = '';
                    var mt_dayoff_gbn = '';

                    if(gbn == 'weekday') {
                        gbn_v = 'weekdayall_';
                    }
                    else if(gbn == 'weekend'){
                        gbn_v = 'weekendall_';
                    }

                    if(gbn == 'weekday' ||  gbn == 'weekend') {
                        $('input:checkbox[id*='+gbn_v+']').each(function(){
                            $next_obj_id = $(this).attr('id');
                            $next_obj_val = $('input:checkbox[id="'+$(this).attr('id')+'"]').is(':checked');

                            if($next_obj_val == true){
                                if(chkd_list != ''){ commar = '#'; }else{ commar = ''; }
                                chkd_list = chkd_list + commar + $(this).val();
                            }
                        });
                        //alert(chkd_list);
                    }

                    hb_idx = $('#hb_idx').val();
                    mt_begin_hour = $("#mt_begin_hour"+seq_v+" option:selected").val();
                    mt_bigin_minute = $("#mt_bigin_minute"+seq_v+" option:selected").val();
                    mt_end_hour = $("#mt_end_hour"+seq_v+" option:selected").val();
                    mt_end_minute = $("#mt_end_minute"+seq_v+" option:selected").val();
                    mt_dayoff_gbn = $("input:checkbox[id='mt_dayoff_gbn"+seq_v+"']:checked").val();    //mt_dayoff_gbn_1

                    var mt_days = chkd_list;
                    var data = {
                        "hb_idx" : hb_idx,
                        "mt_days" : mt_days,
                        "gbn" : gbn,
                        "mt_begin_hour" : mt_begin_hour,
                        "mt_bigin_minute" : mt_bigin_minute,
                        "mt_end_hour" : mt_end_hour,
                        "mt_end_minute" : mt_end_minute,
                        "mt_dayoff_gbn" : mt_dayoff_gbn
                    }
                    console.log(data);

                    ajax_post(url, data, function(ret) {
                        if(ret.msg == 'TRUE') {
                            toastr.info('제휴병원 요일별 진료시간 정보를 저장하였습니다');
                            console.log(ret);

                            fn_get_treatmnt_time_list(hb_idx);
                        }
                        else if(ret.msg == 'DUP') {
                            toastr.info('이미 등록된 요일입니다 기존요일을 삭제후 등록해주세요');
                            console.log(ret);
                        }
                        else{
                            alert('error : '+ret.data);
                        }
                    });



                }



                function fn_get_treatmnt_time_list(hb_idx)
                {
                    var url = '/crm/hosptl/treatmnt_time_list';
                    var data = {
                        "hb_idx" : hb_idx
                    }
                    console.log(data);

                    ajax_post(url, data, function(ret) {
                        if(ret.msg == 'TRUE') {
                            var strHtml = "";
                            var strHtml2 = '';
                            var weekday_lunchtime_gbn =  '';
                            var treatmnt_time = '';

                            if(ret.list.length>0){
                                for(i=0;i<ret.list.length;i++){
                                    if(ret.list[i].mt_weekday_gbn  == '점심') {
                                        weekday_lunchtime_gbn = '점심';
                                    }else{
                                        weekday_lunchtime_gbn = ret.list[i].mt_days_v;
                                    }
                                    if(ret.list[i].mt_dayoff_gbn  == 'Y') {
                                        treatmnt_time = '휴무';
                                    }else{
                                        treatmnt_time = ret.list[i].mt_begin_ampm + " "+ ret.list[i].mt_begin_hour +"시 "+ ret.list[i].mt_bigin_minute +"분"+ " ~ " + ret.list[i].mt_end_ampm + " "+ ret.list[i].mt_end_hour +"시 "+ ret.list[i].mt_end_minute+"분";
                                    }

                                    strHtml += "<tr>";
                                    strHtml += "    <td><input type=\"text\" name=\"mt_days_"+ret.list[i].mt_idx+"\" id=\"mt_days_"+ret.list[i].mt_idx+"\" value='"+ weekday_lunchtime_gbn  +"' style='width:100%; border:1px;'></td>\n";
                                    strHtml += "    <td>\n";
                                    strHtml +=              treatmnt_time ;
                                    strHtml += "   </td>\n";
                                    strHtml += "    <td>\n";
                                    strHtml += "       <a href=\"javascript: fn_set_treatmnt_time('DEL','"+ret.list[i].mt_idx+"','"+ret.list[i].hb_idx+"')\">삭제</a>\n";
                                    strHtml += "    </td>\n";
                                    strHtml += "</tr>";
                                }
                            }
                            $('#treatmnt_time_list').html(strHtml);
                            console.log(ret);
                        }
                        else {
                            //alert('error : '+ret.data);
                            strHtml2 += "<tr>";
                            strHtml2 += "    <td></td>\n";
                            strHtml2 += "    <td></td>\n";
                            strHtml2 += "    <td></td>\n";
                            strHtml2 += "</tr>";
                            $('#treatmnt_time_list').html(strHtml2);
                        }
                    });
                }


                function fn_set_treatmnt_time(procgbn, mt_idx, hb_idx)
                {
                    var hb_idx = $('#hb_idx').val();
                    if(hb_idx == '' || !hb_idx){
                        toastr.info('제휴병원 기본정보를 저장하지 않으셨습니다');
                        return false;
                    }

                    var url = '/crm/hosptl/set_treatmnt_time';
                    var mt_idx_v = $('#mt_days_'+mt_idx).val();

                    var data = {
                        "procgbn" : procgbn,
                        "mt_idx" : mt_idx,
                        "hb_idx" : hb_idx
                    }
                    var procgbn_v = '';
                    procgbn_v = '삭제';
                    console.log(data);

                    ajax_post(url, data, function(ret) {
                        if(ret.msg == 'TRUE') {
                            toastr.info('요일별 진료시간 정보를 '+procgbn_v+'하였습니다');
                            console.log(ret);

                            fn_get_treatmnt_time_list(hb_idx);
                        } else {
                            //alert('error : '+ret.data);
                        }
                    });
                }



                $(function() {
                    $('#md_mdcalsubjct_cd_btn').click(function(e){

                        var popH = $('#md_mdcalsubjct_cd_btn').offset().top;
                        $('.mdcalsubjct_popup').css('top',popH-200+'px');

                        fn_mdcalsubjct_popup_list('');
                        $(".mdcalsubjct_popup").show();
                    });

                    $('.mdcalsubjct_popup_close').click(function(e){
                        $(".mdcalsubjct_popup").hide();
                    });

                    $('.mdcalsubjct_popup_submit').click(function(e){
                        fn_set_mdcalsubjct_chkd_list();
                        $(".mdcalsubjct_popup").hide();
                    });
                })




                function fn_mdcalsubjct_popup_list(md_idx)
                {
                    if(md_idx == 'hosptl'){
                        $('#md_idx').val(md_idx);
                    }else{
                        $('#md_idx').val(md_idx);
                    }

                    var url = '/crm/hosptl/mdcalsubjct_popup_list';
                    var data = {
                        //"hb_idx" : hb_idx
                    }
                    console.log(data);

                    ajax_post(url, data, function(ret) {
                        if(ret.msg == 'TRUE') {
                            var strHtml = "";
                            var strHtml2 = '';

                            if(ret.list.length>0){
                                for(i=0;i<ret.list.length;i++){
                                    strHtml += "<tr>";
                                    strHtml += "    <td><input type=\"checkbox\" name=\"info_value_"+ret.list[i].info_value+"\" id=\"info_value_"+ret.list[i].info_value+"\" value='"+ ret.list[i].info_value  +"' style='width:100%; border:1px;'></td>\n";
                                    strHtml += "    <td>\n";
                                    strHtml += "       <div id='info_title_"+ ret.list[i].info_value +"'>"+ret.list[i].info_title+"</div>\n";
                                    strHtml += "    </td>\n";
                                    strHtml += "</tr>";
                                }
                            }
                            $('#mdcalsubjct_popup_list').html(strHtml);
                            console.log(ret);
                        }
                        else {
                            //alert('error : '+ret.data);
                            strHtml2 += "<tr>";
                            strHtml2 += "    <td></td>\n";
                            strHtml2 += "    <td></td>\n";
                            strHtml2 += "</tr>";

                            $('#mdcalsubjct_popup_list').html(strHtml2);
                        }
                    });
                }



                function fn_set_mdcalsubjct_chkd_list() {
                    var commar = '';
                    var chkd_list_nm = '';
                    var chkd_list_val = '';
                    var md_idx = $('#md_idx').val();

                    $('input:checkbox[id*=info_value_]').each(function(){
                        $next_obj_id = $(this).attr('id');
                        $next_obj_val = $('input:checkbox[id="'+$(this).attr('id')+'"]').is(':checked');

                        if($next_obj_val == true){
                            if(chkd_list_val != ''){ commar = '#'; }else{ commar = ''; }
                            chkd_list_val = chkd_list_val + commar + $(this).val();

                            if(chkd_list_nm != ''){ commar = '#'; }else{ commar = ''; }
                            chkd_list_nm = chkd_list_nm + commar + $('#info_title_'+$(this).val()).text();
                        }
                    });



                    if (md_idx != '' && md_idx != 'hosptl') {
                        $('#md_mdcalsubjct_nm_' + md_idx).val(chkd_list_nm);
                        $('#md_mdcalsubjct_cd_' + md_idx).val(chkd_list_val);
                    }
                    else if(md_idx == 'hosptl') {
                        $('#hb_mdcalsubjct_nm').val(chkd_list_nm);
                        $('#hb_mdcalsubjct_cd').val(chkd_list_val);
                    }
                    else{
                        $('#md_mdcalsubjct_nm').val(chkd_list_nm);
                        $('#md_mdcalsubjct_cd').val(chkd_list_val);
                    }

                    $('#md_idx').val('');
                }



                $(function() {
                    $('#md_profield_cd_btn').click(function(e){

                        var popH = $('#md_profield_cd_btn').offset().top;
                        $('.profield_popup').css('top',popH-200+'px');

                        fn_profield_popup_list('');
                        $(".profield_popup").show();
                    });

                    $('.profield_popup_close').click(function(e){
                        $(".profield_popup").hide();
                    });

                    $('.profield_popup_submit').click(function(e){
                        fn_set_profield_chkd_list();
                        $(".profield_popup").hide();
                    });

                    $('.theme_popup_close').click(function(e){
                        $(".theme_popup").hide();
                    });

                    $('.theme_popup_submit').click(function(e){
                        fn_set_theme_chkd_list();
                        $(".theme_popup").hide();
                    });
                })



















                function fn_profield_popup_list(md_idx)
                {
                    if(md_idx == 'hosptl'){
                        $('#md_idx').val(md_idx);
                    }else{
                        $('#md_idx').val(md_idx);
                    }

                    var url = '/crm/hosptl/profield_popup_list';
                    var data = {
                        //"hb_idx" : hb_idx
                    }
                    console.log(data);

                    ajax_post(url, data, function(ret) {
                        if(ret.msg == 'TRUE') {
                            var strHtml = "";
                            var strHtml2 = '';

                            if(ret.list.length>0){
                                for(i=0;i<ret.list.length;i++){
                                    strHtml += "<tr>";
                                    strHtml += "    <td><input type=\"checkbox\" name=\"info_value2_"+ret.list[i].info_value+"\" id=\"info_value2_"+ret.list[i].info_value+"\" value='"+ ret.list[i].info_value  +"' style='width:100%; border:1px;'></td>\n";
                                    strHtml += "    <td>\n";
                                    strHtml += "       <div id='info_title2_"+ ret.list[i].info_value +"'>"+ret.list[i].info_title+"</div>\n";
                                    strHtml += "    </td>\n";
                                    strHtml += "</tr>";
                                }
                            }
                            $('#profield_popup_list').html(strHtml);
                            console.log(ret);
                        }
                        else {
                            //alert('error : '+ret.data);
                            strHtml2 += "<tr>";
                            strHtml2 += "    <td></td>\n";
                            strHtml2 += "</tr>";
                            $('#profield_popup_list').html(strHtml2);
                        }
                    });
                }



                function fn_set_profield_chkd_list() {
                    var commar = '';
                    var chkd_list_nm = '';
                    var chkd_list_val = '';
                    var md_idx = $('#md_idx').val();

                    $('input:checkbox[id*=info_value2_]').each(function(){
                        $next_obj_id = $(this).attr('id');
                        $next_obj_val = $('input:checkbox[id="'+$(this).attr('id')+'"]').is(':checked');

                        if($next_obj_val == true){
                            if(chkd_list_val != ''){ commar = '#'; }else{ commar = ''; }
                            chkd_list_val = chkd_list_val + commar + $(this).val();

                            if(chkd_list_nm != ''){ commar = '#'; }else{ commar = ''; }
                            chkd_list_nm = chkd_list_nm + commar + $('#info_title2_'+$(this).val()).text();
                        }
                    });


                    if (md_idx != '' && md_idx != 'hosptl') {
                        $('#md_profield_nm_' + md_idx).val(chkd_list_nm);
                        $('#md_profield_cd_' + md_idx).val(chkd_list_val);
                    }
                    else if(md_idx == 'hosptl') {
                        $('#hb_profield_nm').val(chkd_list_nm);
                        $('#hb_profield_cd').val(chkd_list_val);
                    }
                    else{
                        $('#md_profield_nm').val(chkd_list_nm);
                        $('#md_profield_cd').val(chkd_list_val);
                    }

                    $('#md_idx').val('');
                }


                $(function() {
                    $('#reg_main_doctr').click(function(e){
                        fn_reg_main_doctr();

                    });
                })



                function fn_reg_main_doctr(){
                    var url = '/crm/hosptl/reg_main_doctr';
                    var formId = 'formRegDctr';

                    ajaxForm_post_doctr(url, formId);
                }


                function ajaxForm_post_doctr(url, formId){
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
                            if(result.msg == 'TRUE') {
                                toastr.info('주요 의료진이 등록되었습니다');

                                var hb_idx = $('#hb_idx').val();
                                fn_main_doctr_list(hb_idx);
                            }
                        }
                    });
                    //$("#"+formId).submit();
                }




                function fn_set_main_doctr_proc(procgbn, hb_idx, md_idx) {
                    var url = '/crm/hosptl/set_main_doctr';
                    var formId = 'formRegDctr';
                    //console.log('fn_set_main_doctr_proc');

                    ajaxForm_post_main_doctr(url, formId, procgbn, hb_idx, md_idx);
                }



                function ajaxForm_post_main_doctr(url, formId, procgbn,hb_idx,md_idx){
                    //if(!datatype) {
                    var contenttype = 'application/json; charset=utf-8';
                    var datatype = 'json';
                    var procgbn_v = '';
                    $('#procgbn').val(procgbn);
                    $('#md_idx').val(md_idx);
                    //}

                    if(procgbn == 'DEL'){
                        procgbn_v = '삭제';
                    }else if(procgbn == 'EDT'){
                        procgbn_v = '변경';
                    }
                    //alert($('#md_idx').val());

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
                            if(result.msg == 'TRUE') {
                                toastr.info('주요의료진 데이터가 '+procgbn_v+' 되었습니다');
                                fn_main_doctr_list(hb_idx);
                            }
                        }
                    });
                    $("#"+formId).submit();

                    $('#md_idx').val('');
                }





                function fn_main_doctr_list(hb_idx) {

                    var url = '/crm/hosptl/main_doctr_list';
                    var data = {
                        "hb_idx" : hb_idx
                    }
                    console.log(data);

                    ajax_post(url, data, function(ret) {
                        if(ret.msg == 'TRUE') {
                            var strHtml = "";
                            var strHtml2 = '';

                            if(ret.list.length>0){
                                for(i=0;i<ret.list.length;i++){

                                    var fileNm_arr = ret.list[i].md_img.split('.');
                                    var fileNm = fileNm_arr[0];
                                    var fileExt = fileNm_arr[1];
                                    var fileThumbNm = fileNm+'_thumb.'+ fileExt;

                                    //alert(ret.list[i].md_idx);

                                    strHtml += "<tr>";
                                    strHtml += "    <td scope='col'>";
                                    strHtml += "       <img src='/uploads/files/"+fileThumbNm+"' id='md_img_"+ ret.list[i].md_idx +"' name='md_img_"+ ret.list[i].md_idx +"' class='thumb_img' >";
                                    strHtml += "        <input type='file' id='document-file_"+ret.list[i].md_idx+"' name='document-file_"+ret.list[i].md_idx+"' value='"+ret.list[i].md_img+"' />";
                                    strHtml += "    </td>";
                                    strHtml += "    <td scope='col'>";
                                    strHtml += "        <input type='text' id='md_dctr_nm_"+ret.list[i].md_idx+"' name='md_dctr_nm_"+ret.list[i].md_idx+"' class='w90p' value='"+ret.list[i].md_dctr_nm+"'/>";
                                    strHtml += "    </td>";
                                    strHtml += "    <td scope='col'>";
                                    strHtml += "        <input type='text' id='md_mdcalsubjct_nm_"+ret.list[i].md_idx+"' name='md_mdcalsubjct_nm_"+ret.list[i].md_idx+"' class='w60p' value='"+ret.list[i].md_mdcalsubjct_nm+"'/>";
                                    strHtml += "        <input type='text' id='md_mdcalsubjct_cd_"+ret.list[i].md_idx+"' name='md_mdcalsubjct_cd_"+ret.list[i].md_idx+"' class='w20p' value='"+ret.list[i].md_mdcalsubjct_cd+"'/>";
                                    strHtml += "        <div class='btn btn-primary btn-xs' id='md_mdcalsubjct_cd_btn_"+ret.list[i].md_idx+"' name='md_mdcalsubjct_cd_btn_"+ret.list[i].md_idx+"' onclick=\"mdcalsubjct_srch('"+ret.list[i].md_idx+"')\" >";
                                    strHtml += "            <div style='color:white;'>검 색</div>";
                                    strHtml += "        </div>";
                                    strHtml += "    </td>";
                                    strHtml += "    <td scope='col'>";
                                    strHtml += "        <input type='text' id='md_profield_nm_"+ret.list[i].md_idx+"' name='md_profield_nm_"+ret.list[i].md_idx+"' class='w60p' value='"+ret.list[i].md_profield_nm+"'/>";
                                    strHtml += "        <input type='text' id='md_profield_cd_"+ret.list[i].md_idx+"' name='md_profield_cd_"+ret.list[i].md_idx+"' class='w20p' value='"+ret.list[i].md_profield_cd+"'/>";
                                    strHtml += "        <div class='btn btn-primary btn-xs' id='md_profield_cd_btn_"+ret.list[i].md_idx+"' name='md_profield_cd_btn_"+ret.list[i].md_idx+"' onclick=\"profield_srch('"+ret.list[i].md_idx+"')\" >";
                                    strHtml += "            <div style='color:white;'>검 색</div>";
                                    strHtml += "        </div>";
                                    strHtml += "    </td>";
                                    strHtml += "    <td>\n";
                                    strHtml += "       <a href=\"javascript:fn_set_main_doctr_proc('EDT','"+ret.list[i].hb_idx+"','"+ret.list[i].md_idx+"');\">수정</a>|\n";
                                    strHtml += "       <a href=\"javascript:fn_set_main_doctr_proc('DEL','"+ret.list[i].hb_idx+"','"+ret.list[i].md_idx+"');\">삭제</a>\n";
                                    strHtml += "    </td>\n";
                                    strHtml += "</tr>";
                                }
                            }
                            $('#main_doctr_list').html(strHtml);
                            console.log(ret);
                        }
                        else {
                            //alert('error : '+ret.data);
                            strHtml2 += "<tr>";
                            strHtml2 += "    <td></td>\n";
                            strHtml2 += "</tr>";
                            $('#main_doctr_list').html(strHtml2);
                        }
                    });
                }



                function mdcalsubjct_srch(md_idx){
                    var popH = $('#md_mdcalsubjct_cd_btn').offset().top;
                    $('.mdcalsubjct_popup').css('top',popH-200+'px');

                    fn_mdcalsubjct_popup_list(md_idx);
                    $(".mdcalsubjct_popup").show();

                }


                function profield_srch(md_idx){
                    var popH = $('#md_mdcalsubjct_cd_btn').offset().top;
                    $('.mdcalsubjct_popup').css('top',popH-200+'px');

                    fn_profield_popup_list(md_idx);
                    $(".profield_popup").show();

                }


                function theme_srch(md_idx){
                    var popH = $('#md_mdcalsubjct_cd_btn').offset().top;
                    $('.mdcalsubjct_popup').css('top',popH-200+'px');

                    fn_theme_popup_list(md_idx);
                    $(".theme_popup").show();

                }



                function fn_theme_popup_list(md_idx)
                {
                    if(md_idx == 'hosptl'){
                        $('#md_idx').val(md_idx);
                    }else{
                        $('#md_idx').val(md_idx);
                    }

                    var url = '/crm/hosptl/theme_popup_list';
                    var data = {
                        //"hb_idx" : hb_idx
                    }
                    console.log(data);

                    ajax_post(url, data, function(ret) {
                        if(ret.msg == 'TRUE') {
                            var strHtml = "";
                            var strHtml2 = '';

                            if(ret.list.length>0){
                                for(i=0;i<ret.list.length;i++){
                                    strHtml += "<tr>";
                                    strHtml += "    <td><input type=\"checkbox\" name=\"info_value3_"+ret.list[i].info_value+"\" id=\"info_value3_"+ret.list[i].info_value+"\" value='"+ ret.list[i].info_value  +"' style='width:100%; border:1px;'></td>\n";
                                    strHtml += "    <td>\n";
                                    strHtml += "       <div id='info_title3_"+ ret.list[i].info_value +"'>"+ret.list[i].info_title+"</div>\n";
                                    strHtml += "    </td>\n";
                                    strHtml += "</tr>";
                                }
                            }
                            $('#theme_popup_list').html(strHtml);
                            console.log(ret);
                        }
                        else {
                            //alert('error : '+ret.data);
                            strHtml2 += "<tr>";
                            strHtml2 += "    <td></td>\n";
                            strHtml2 += "    <td></td>\n";
                            strHtml2 += "</tr>";

                            $('#theme_popup_list').html(strHtml2);
                        }
                    });
                }


                function fn_set_theme_chkd_list() {
                    var commar = '';
                    var chkd_list_nm = '';
                    var chkd_list_val = '';
                    var md_idx = $('#md_idx').val();

                    $('input:checkbox[id*=info_value3_]').each(function(){
                        $next_obj_id = $(this).attr('id');
                        $next_obj_val = $('input:checkbox[id="'+$(this).attr('id')+'"]').is(':checked');

                        if($next_obj_val == true){
                            if(chkd_list_val != ''){ commar = '#'; }else{ commar = ''; }
                            chkd_list_val = chkd_list_val + commar + $(this).val();

                            if(chkd_list_nm != ''){ commar = '#'; }else{ commar = ''; }
                            chkd_list_nm = chkd_list_nm + commar + $('#info_title3_'+$(this).val()).text();
                        }
                    });

                    if(md_idx == 'hosptl') {
                        $('#hb_theme_nm').val(chkd_list_nm);
                        $('#hb_theme_cd').val(chkd_list_val);
                    }

                    $('#md_idx').val('');
                }




                $(function() {
                    $('#reg_hosptl_theme').click(function(e){
                        fn_reg_hosptl_theme();

                    });
                })


                function fn_reg_hosptl_theme()
                {
                    var hb_idx = $('#hb_idx').val();
                    if(hb_idx == '' || !hb_idx){
                        toastr.info('제휴병원 기본정보를 저장하지 않으셨습니다');
                        return false;
                    }
                    //alert('hb_idx - '+hb_idx);


                    var hb_theme_cd = $('#hb_theme_cd').val();
                    var url = '/crm/hosptl/reg_hosptl_theme';
                    var data = {
                        "hb_theme_cd" : hb_theme_cd,
                        "hb_idx" : hb_idx
                    }
                    console.log(data);

                    ajax_post(url, data, function(ret) {
                        if(ret.msg == 'TRUE') {
                            toastr.info('병원 테마구분정보를 등록하였습니다');
                            console.log(ret);

                            fn_get_hosptl_theme_list(hb_idx);
                        } else {
                            //alert('error : '+ret.data);
                        }
                    });
                }




                function fn_get_hosptl_theme_list(hb_idx) {
                    var url = '/crm/hosptl/get_hosptl_theme_list';
                    var data = {
                        "hb_idx" : hb_idx
                    }
                    console.log(data);

                    ajax_post(url, data, function(ret) {
                        if(ret.msg == 'TRUE') {
                            var strHtml = "";
                            var strHtml2 = '';

                            if(ret.list.length>0){
                                for(i=0;i<ret.list.length;i++){
                                    strHtml += "<tr>";
                                    strHtml += "    <td><input type=\"text\" name=\"hb_theme_nm_"+ret.list[i].hb_idx+"\" id=\"hb_theme_nm_"+ ret.list[i].hb_idx +"\" value='"+ ret.list[i].hb_theme_nm +"' style='width:100%; border:1px;'></td>\n";
                                    strHtml += "    <td>\n";
                                    strHtml += "       <a href=\"javascript: fn_del_hosptl_theme('DEL','"+ret.list[i].hb_idx+"')\">삭제</a>\n";
                                    strHtml += "    </td>\n";
                                    strHtml += "</tr>";
                                }
                            }
                            $('#hosptl_theme_list').html(strHtml);
                            console.log(ret);
                        }
                        else {
                            //alert('error : '+ret.data);
                            strHtml2 += "<tr>";
                            strHtml2 += "    <td></td>\n";
                            strHtml2 += "    <td></td>\n";
                            strHtml2 += "</tr>";
                            $('#hosptl_theme_list').html(strHtml2);
                        }
                    });
                }



                function fn_del_hosptl_theme()
                {
                    var hb_idx = $('#hb_idx').val();
                    if(hb_idx == '' || !hb_idx){
                        toastr.info('제휴병원 기본정보를 저장하지 않으셨습니다');
                        return false;
                    }

                    var url = '/crm/hosptl/del_hosptl_theme';
                    var data = {
                        "hb_idx" : hb_idx
                    }
                    var procgbn_v = '';
                    procgbn_v = '삭제';
                    console.log(data);

                    ajax_post(url, data, function(ret) {
                        if(ret.msg == 'TRUE') {
                            toastr.info('병원 테마구분 정보를 '+procgbn_v+'하였습니다');
                            console.log(ret);

                            fn_get_hosptl_theme_list(hb_idx);
                        } else {
                            //alert('error : '+ret.data);
                        }
                    });
                }






































                $(function() {
                    $('#reg_hosptl_medcalsubjct').click(function(e){
                        fn_reg_hosptl_medcalsubjct();

                    });
                })


                function fn_reg_hosptl_medcalsubjct()
                {
                    var hb_idx = $('#hb_idx').val();
                    if(hb_idx == '' || !hb_idx){
                        toastr.info('제휴병원 기본정보를 저장하지 않으셨습니다');
                        return false;
                    }
                    //alert('hb_idx - '+hb_idx);


                    var hb_mdcalsubjct_cd = $('#hb_mdcalsubjct_cd').val();
                    var url = '/crm/hosptl/reg_hosptl_medcalsubjct';
                    var data = {
                        "hb_mdcalsubjct_cd" : hb_mdcalsubjct_cd,
                        "hb_idx" : hb_idx
                    }
                    console.log(data);

                    ajax_post(url, data, function(ret) {
                        if(ret.msg == 'TRUE') {
                            toastr.info('병원 진료과목정보를 등록하였습니다');
                            console.log(ret);

                            fn_get_hosptl_medcalsubjct_list(hb_idx);
                        } else {
                            //alert('error : '+ret.data);
                        }
                    });
                }



                function fn_get_hosptl_medcalsubjct_list(hb_idx) {
                    var url = '/crm/hosptl/get_hosptl_medcalsubjct_list';
                    var data = {
                        "hb_idx" : hb_idx
                    }
                    console.log(data);

                    ajax_post(url, data, function(ret) {
                        if(ret.msg == 'TRUE') {
                            var strHtml = "";
                            var strHtml2 = '';

                            if(ret.list.length>0){
                                for(i=0;i<ret.list.length;i++){
                                    strHtml += "<tr>";
                                    strHtml += "    <td><input type=\"text\" name=\"hb_mdcalsubjct_nm_"+ret.list[i].hb_idx+"\" id=\"hb_mdcalsubjct_nm_"+ ret.list[i].hb_idx +"\" value='"+ ret.list[i].hb_mdcalsubjct_nm +"' style='width:100%; border:1px;'></td>\n";
                                    strHtml += "    <td>\n";
                                    strHtml += "       <a href=\"javascript: fn_del_hosptl_medcalsubjct('DEL','"+ret.list[i].hb_idx+"')\">삭제</a>\n";
                                    strHtml += "    </td>\n";
                                    strHtml += "</tr>";
                                }
                            }
                            $('#hosptl_medcalsubjct_list').html(strHtml);
                            console.log(ret);
                        }
                        else {
                            //alert('error : '+ret.data);
                            strHtml2 += "<tr>";
                            strHtml2 += "    <td></td>\n";
                            strHtml2 += "    <td></td>\n";
                            strHtml2 += "</tr>";
                            $('#hosptl_medcalsubjct_list').html(strHtml2);
                        }
                    });
                }

                
                
                function fn_del_hosptl_medcalsubjct()
                {
                    var hb_idx = $('#hb_idx').val();
                    if(hb_idx == '' || !hb_idx){
                        toastr.info('제휴병원 기본정보를 저장하지 않으셨습니다');
                        return false;
                    }

                    var url = '/crm/hosptl/del_hosptl_medcalsubjct';
                    var data = {
                        "hb_idx" : hb_idx
                    }
                    var procgbn_v = '';
                    procgbn_v = '삭제';
                    console.log(data);

                    ajax_post(url, data, function(ret) {
                        if(ret.msg == 'TRUE') {
                            toastr.info('병원 진료과목 정보를 '+procgbn_v+'하였습니다');
                            console.log(ret);

                            fn_get_hosptl_medcalsubjct_list(hb_idx);
                        } else {
                            //alert('error : '+ret.data);
                        }
                    });
                }



                $(function() {
                    $('#reg_hosptl_profield').click(function(e){
                        fn_reg_hosptl_profield();

                    });
                })


                function fn_reg_hosptl_profield()
                {
                    var hb_idx = $('#hb_idx').val();
                    if(hb_idx == '' || !hb_idx){
                        toastr.info('제휴병원 기본정보를 저장하지 않으셨습니다');
                        return false;
                    }
                    //alert('hb_idx - '+hb_idx);

                    var hb_profield_cd = $('#hb_profield_cd').val();
                    var url = '/crm/hosptl/reg_hosptl_profield';
                    var data = {
                        "hb_profield_cd" : hb_profield_cd,
                        "hb_idx" : hb_idx
                    }
                    console.log(data);

                    ajax_post(url, data, function(ret) {
                        if(ret.msg == 'TRUE') {
                            toastr.info('병원 진료과목정보를 등록하였습니다');
                            console.log(ret);

                            fn_get_hosptl_profield_list(hb_idx);
                        } else {
                            //alert('error : '+ret.data);
                        }
                    });
                }



                function fn_get_hosptl_profield_list(hb_idx) {
                    var url = '/crm/hosptl/get_hosptl_profield_list';
                    var data = {
                        "hb_idx" : hb_idx
                    }
                    console.log(data);

                    ajax_post(url, data, function(ret) {
                        if(ret.msg == 'TRUE') {
                            var strHtml = "";
                            var strHtml2 = '';

                            if(ret.list.length>0){
                                for(i=0;i<ret.list.length;i++){
                                    strHtml += "<tr>";
                                    strHtml += "    <td><input type=\"text\" name=\"hb_profield_nm_"+ret.list[i].hb_idx+"\" id=\"hb_profield_nm_"+ ret.list[i].hb_idx +"\" value='"+ ret.list[i].hb_profield_nm +"' style='width:100%; border:1px;'></td>\n";
                                    strHtml += "    <td>\n";
                                    strHtml += "       <a href=\"javascript: fn_del_hosptl_profield('DEL','"+ret.list[i].hb_idx+"')\">삭제</a>\n";
                                    strHtml += "    </td>\n";
                                    strHtml += "</tr>";
                                }
                            }
                            $('#hosptl_profield_list').html(strHtml);
                            console.log(ret);
                        }
                        else {
                            //alert('error : '+ret.data);
                            strHtml2 += "<tr>";
                            strHtml2 += "    <td></td>\n";
                            strHtml2 += "    <td></td>\n";
                            strHtml2 += "</tr>";
                            $('#hosptl_profield_list').html(strHtml2);
                        }
                    });
                }



                function fn_del_hosptl_profield()
                {
                    var hb_idx = $('#hb_idx').val();
                    if(hb_idx == '' || !hb_idx){
                        toastr.info('제휴병원 기본정보를 저장하지 않으셨습니다');
                        return false;
                    }

                    var url = '/crm/hosptl/del_hosptl_profield';
                    var data = {
                        "hb_idx" : hb_idx
                    }
                    var procgbn_v = '';
                    procgbn_v = '삭제';
                    console.log(data);

                    ajax_post(url, data, function(ret) {
                        if(ret.msg == 'TRUE') {
                            toastr.info('병원 진료과목 정보를 '+procgbn_v+'하였습니다');
                            console.log(ret);

                            fn_get_hosptl_profield_list(hb_idx);
                        } else {
                            //alert('error : '+ret.data);
                        }
                    });
                }






                $(function () {
                    $('#sdg_sido_no').change(function () {
                        //alert(this.value);

                        var url = '/crm/hosptl/get_gu_list';
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




            </script>



