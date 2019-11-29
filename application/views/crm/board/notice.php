<div class="row" id="content-wrapper">
    <div class="col-xs-12">
        <? $this->load->view('crm/common/top'); ?>
        <div class='row'>
            <div class='col-sm-12'>
                <div class='box bordered-box muted-border' style='margin-bottom:0;'>
                    <div class='box-header muted-background' style="height:30px;padding: 0px">
                        <div class='title'><?=$this->session->userdata('title')?> </div>
                    </div>


                    <div class='box-content' style="border-bottom: 0;" id="admin_display">
                        <form class="form form-horizontal" action="/crm/board/notice" method="get" id="search_form">

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
                                                            <th scope="row" width="13%" ><label for="search_val">검색키워드</label></th>
                                                            <td colspan=2>
                                                                <input type="text" placeholder="검색조건 안됨" name="search_val" id="search_val" value="<?=$search_val?>" class="w100p">
                                                            </td>
                                                            <th scope="row"><label for="prj_state">노출유무</label></th>
                                                            <td colspan=2 style='text-align:left; '>
                                                                <select name="search_show_yn" class="w50p">
                                                                    <option value="-1" <?=($search_show_yn=='-1') ?' selected':''?> >전체</option>
                                                                    <option value="0" <?=($search_show_yn=="0")?' selected':''?> >미노출</option>
                                                                    <option value="1" <?=($search_show_yn=="1") ?' selected':''?> >노출</option>
                                                                </select>
                                                            </td>

                                                        </tr>
                                                        </tbody>
                                                    </table>
                                                    <div class="row2">
                                                        <div class="col-md-10" style="width:80%;float: left;">
&nbsp;
                                                        </div>
                                                    <div class="col-md-1" style="width:10%;float: left;">
                                                        <button class="btn btn-primary btn_search btn-xs">
                                                            <i class="icon-search"></i>
                                                            검색
                                                        </button>
                                                    </div>
                                                    <div class="col-md-1" style="width:10%;float: left;">
                                                        <a href="/crm/board/editor/notice/?per_page=<?=$per_page?>" class="btn btn-warning btn-xs">
                                                            <i class="icon-file"></i>
                                                            신규등록
                                                        </a>
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
                                                        <th class="text-center" style="width: 80px;">고유번호</th>
                                                        <th class="text-center">제목</th>
                                                        <th class="text-center" style="width: 80px;">분류</th>
                                                        <th class="text-center" style="width: 80px;">대상자</th>
                                                        <th class="text-center" style="width: 80px;">읽음</th>
                                                        <th class="text-center" style="width: 100px;">작성자</th>
                                                        <th class="text-center" style="width: 200px;">등록일</th>
                                                        <th class="text-center" style="width: 80px;">노출유뮤</th>
                                                        <?if($user_grade>=9){?>
                                                        <th class="text-center" style="width: 80px;">관리</th>
                                                        <?}?>
                                                    </tr>
                                                    </thead>
                                                    <tbody>
                                                    <?
                                                    foreach($list as $k => $v) {
                                                        switch($v['nt_cate_gbn']) {
                                                            case 0: $top_show = "일반"; break;
                                                            case 1: $top_show = "긴급"; break;
                                                        }
                                                        switch($v['nt_show_gbn']) {
                                                            case 0: $show_yn = "미노출"; break;
                                                            case 1: $show_yn = "노출"; break;
                                                        }

                                                        switch($v['nt_targt_gbn']) {
                                                            case "ALL": $targt_gbn = "전체"; break;
                                                            case "USR": $targt_gbn = "사용자"; break;
                                                            case "OFF": $targt_gbn = "세무사"; break;
                                                        }

                                                        ?>
                                                        <tr>
                                                            <td align="center"><?=$v['nt_notice_idx']?></td>
                                                            <td align="left"><a href="/crm/board/read/notice/<?=$v['nt_notice_idx']?>?per_page=<?=$per_page?>" ><?=$v['nt_title']?></a></td>
                                                            <td align="center"><?=$top_show?></td>
                                                            <td align="center"><?=$targt_gbn?></td>
                                                            <td align="center"><?=$v['nt_read_count']?></td>
                                                            <td align="center"><?=$v['nt_regId']?></td>
                                                            <td align="center"><?=$v['nt_uptDt']?></td>
                                                            <td align="center"><?=$show_yn?></td>
                                                            <?if($user_grade>=9){?>
                                                            <td align="center "><a href="/crm/board/editor/notice/<?=$v['nt_notice_idx']?>?per_page=<?=$per_page?>" class="btn btn-primary btn-xs">보기</a></td>
                                                        <?}?>
                                                        </tr>
                                                        <?
                                                    }
                                                    ?>


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

<?

if($user_grade<9){
?>

<style>
    #admin_display{
        display: none;
    }
</style>
<?}?>