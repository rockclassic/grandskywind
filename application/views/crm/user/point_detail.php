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
                            <table width=100% height=100% cellpadding=0 cellspacing=0 style = 'margin: -20px 0px 0px 0px; '>
                                <tr>
                                    <td align=center valign=middle >

                                        <div class="table_area mt0"><!-- table_area start -->
                                            <!-- 회원유형 -->

                                                <div class="box_gray"> <!-- box wrap -->
                                                    <table class="write">
                                                        <tbody>
                                                        <tr>
                                                            <td style='text-align:left; width: 180px'>
                                                                <select id="p_dtype" name='p_dtype' style="width: 90%" title="상태선택">
                                                                    <option value=''>포인트 구분 </option>
                                                                    <?foreach ($p_dtype_array as $k => $v){?>
                                                                        <option value='<?=$k?>' ><?=$v?></option>
                                                                    <?}?>
                                                                </select>&nbsp;
                                                            </td>
                                                            <td style='text-align:left; width: 200px'>
                                                                <input type="text" placeholder="포인트(0보다 큼)" id="amount" name="amount" style="width: 90%" value=""/>
                                                            </td>
                                                            <td style='text-align:left; width: 200px'>
                                                                <input type="text" placeholder="만료일(숫자,t)" id="expiredDt" name="expiredDt" style="width: 90%" value=""/>
                                                            </td>
                                                            <td style='text-align:left; '>
                                                                <input type="text" placeholder="메모" id="p_memo" name="p_memo" style="width: 100%" value=""/>
                                                            </td>
                                                            <td style='text-align:left; width: 100px'>
                                                                <button class="btn btn-warning  btn-xs" onclick="set_point('<?=$ob_office_idx?>')">
                                                                    <i class="icon-file"></i>
                                                                    저 장
                                                                </button>
                                                            </td>
                                                            <td style='text-align:left; width: 120px'>
                                                                <button class="btn btn-primary btn-xs" id="btn_estimate" name="btn_estimate" >
                                                                    <i class="icon-file"></i>
                                                                    포인트 리스트
                                                                </button>
                                                            </td>
                                                        </tr>
                                                        </tbody>
                                                    </table>
                                                </div>
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

                                        <!-- 회원내역 -->
                                        <div class="table_area "><!-- table_area start -->

                                            <form id="form_prj_inf" name="form_prj_mpr_inf"  method='post' enctype="multipart/form-data" action="">
                                                <input type="hidden" name="page" id="page" value="1">


                                                <div class="table_top" style="margin-top:20px;" ><!-- table_top start -->
                                                    <div class="left_opt">
                                                        <span class="title_cmt"> 조회 <?=number_format($count)?> 건 </span>
                                                    </div>
                                                    <ul class="right_opt">
                                                        <?=$sum_point['ob_officeNm']." :: 총적립 포인트 : ".number_format($sum_point['t_amount'])."P , 총사용 포인트 : ".number_format($sum_point['used_amount'])."P , 가용 포인트 : ".number_format($sum_point['sum_amount'])."P"?>&nbsp;&nbsp;&nbsp;
                                                    </ul>
                                                </div><!-- table_top end -->

                                                <table class="list over-list">
                                                    <caption>조회된 리스트</caption>
                                                    <colgroup>
                                                        <col width="80px" />
                                                        <col width="150px" />
                                                        <col width="150px" />
                                                        <col width="150px" />
                                                        <col  />
                                                        <col width="180px" />
                                                        <col width="180px" />

                                                    </colgroup>
                                                    <thead>
                                                    <tr>
                                                        <th scope="col" class="text-center">번호</th>
                                                        <th scope="col" class="text-center">구분</th>
                                                        <th scope="col" class="text-center">적립포인트</th>
                                                        <th scope="col" class="text-center">사용포인트 </th>
                                                        <th scope="col" class="text-center">메모</th>
                                                        <th scope="col" class="text-center">등록일자</th>
                                                        <th scope="col" class="text-center">만료일자</th>

                                                    </tr>
                                                    </thead>
                                                    <tbody id="ContentsArea">

                                                    <?foreach($list as $k => $v) {?>

                                                    <tr>
                                                        <td><?=$k+(($per_page-1)*10)+1?></td>
                                                        <td style="text-align: center"><?=$p_dtype_array[$v['p_dtype']]?></td>
                                                        <td style="background: #ECECEC;text-align: right"><?=number_format($v['amount'])?> P</td>
                                                        <td style="background: #ECECEC;text-align: right"><?=number_format($v['used_amount'])?> P</td>
                                                        <td><?=$v['p_memo']?></td>
                                                        <td style="background: #fff;text-align: center"><?=$v['p_regDt']?> </td>
                                                        <td style="background: #fff;text-align: center"><?=$v['expiredDt']?> </td>



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

    $("#btn_estimate").click(function(){
        location.href="/crm/operation/point?per_page=<?=$t_per_page?>";

    });

    function set_point(id){

        <?if($this->openssl_mem->aes_decrypt($this->session->userdata('user_grade'))<=6){?>
         toastr.error('관리자 외에는 변경할 수 없습니다.');
        <?}else{?>
        console.log($("#amount").val());
        var amount =fn_only_number($("#amount").val());
        var p_dtype =$("#p_dtype").val();
        var p_memo =$("#p_memo").val();
        var expiredDt =$("#expiredDt").val();
        console.log(amount);
        if(amount<=0){
            toastr.error("포인트는 0보다 적을 수 없습니.");
            $("#amount").focus();
            return;
        }
        if(!p_dtype){
            toastr.error("포인트 구분은 선택해 주서야 합니다.");
            $("#p_dtype").focus();
            return;
        }
        if(amount>0) {
           var url = '/crm/operation/set_point';
           var data = {'ob_office_idx': id, 'amount': amount, 'p_dtype': p_dtype, 'p_memo': p_memo, 'expiredDt': expiredDt};
           showSpinner();
           ajax_post(url, data, function (ret) {
               if (ret.msg == 'success') {
                   toastr.success('진행 상태가 변경되었습니다.');
                   hideSpinner();
                   location.href="/crm/operation/point_detail/"+id;
               } else {
                   toastr.error('error : ' + ret.data);
                   hideSpinner();
               }
           });
        }else if(sado=="NaN") {
           toastr.error('숫자만 입력해 주세요');
        }else{
           toastr.error('포인트는 0보다 적을 수 없습니다.');
        }
        <?}?>
    }
</script>
