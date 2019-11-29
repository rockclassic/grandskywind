<div class="row" id="content-wrapper">
    <div class="col-xs-12">
        <? $this->load->view('crm/common/top'); ?>
        <div class='row'>
            <div class='col-sm-12'>
                <div class='box bordered-box red-border' style='margin-bottom:0;'>
                    <div class='box-header muted-background' style="height: 30px;padding: 0px">
                        <div class='title'><?=$this->session->userdata('title')?></div>
                    </div>
                    <div class='box-content' style="border-bottom: 0;">
                        <form class="form form-horizontal" action="/crm/board/writeProc" method="post" id="frm">
                            <div class="form-group" style="margin-bottom: 0; display: flex; align-items: center;padding: 0px 19px" >
                                <div class="col-md-1 write"><label>제 목</label></div>
                                <div class="col-md-2"><input type="text" name="subject" id="subject" value="<?=$list['nt_title']?>" class="form-control "></div>
                                <div class="col-md-1">
                                <label><input type="checkbox" id="top_show" name="top_show" <?=($list['nt_cate_gbn'])? "checked":""?>>긴급공지</label>
                                </div>
                                <div class="col-md-1">
                                    <label>
                                        <input type="checkbox" id="show_yn" name="show_yn" <?=($list['nt_show_gbn'])? "checked":""?>>
                                        노출</label>
                                </div>
                                <div class="col-md-1 write">구분</div>
                                <div class="col-md-1 ">
                                    <select id="targt_gbn" name="targt_gbn"  style="width: 100%">
                                        <option value="ALL" <?=$list['nt_targt_gbn']=="ALL"?"selected":""?>>전체</option>
                                        <option value="USR"  <?=$list['nt_targt_gbn']=="USR"?"selected":""?>>사용자</option>
                                        <option value="OFF"  <?=$list['nt_targt_gbn']=="OFF"?"selected":""?>>세무사</option>
                                    </select>
                                </div>
                                <div class="col-md-2"></div>
                                <div class="col-md-1">
                                    <a  class="btn btn-warning editor_action btn-xs">
                                        <i class="icon-file"></i>
                                        저장
                                    </a>
                                </div>
                                <div class="col-md-1">
                                    <a  class="btn btn-success btn-xs" href="/crm/board/<?=$flag?>?per_page=<?=$per_page;?>">
                                        게시판
                                    </a>
                                </div>
                            </div>


                    </div>

                    <div class='box-content box-no-padding'>
                        <div class='responsive-table'>

                            <input type="hidden" name="srl" value="<?=$srl;?>" />
                            <input type="hidden" name="flag" value="<?=$flag;?>" />
                            <input type="hidden" name="per_page" value="<?=$per_page;?>" />
                            <table width="100%" height="700px" border="0" cellSpacing="2" cellPadding="0" style="padding-left:0px;background-color:#fff">
                                <tbody>

                                <tr style="background-color:#EFEFEF;border-style:solid;border-width:0px;border-color: #EFEFEF ">
                                    <td align="right" style="background-color:#fff;border-style:solid;border-width:1px;border-color: #EFEFEF;padding: 0px;position: absolute;width:100% ">

											<textarea name="MCONT" id="MCONT" rows="10" cols="100" style="width:100%; height:650px; " class="cont">
												<?  if(isset($list['nt_content'])) echo str_replace('"', '\'', preg_replace('/\s\s+/', ' ', $list['nt_content']))?>
											</textarea>
                                        <!--input type="button" onclick="submitContents(this);" value="서버로 내용 전송" /-->

                                    </td>
                                </tr>
                                </tbody>
                            </table>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <hr class='hr-double'>
    </div>
</div>


<?

?>
<script type="text/javascript" src="/assets/smarteditor/js/HuskyEZCreator.js" charset="utf-8"></script>
<script type="text/javascript">
    var oEditors = [];
    nhn.husky.EZCreator.createInIFrame({
        oAppRef: oEditors,
        elPlaceHolder: "MCONT",
        sSkinURI: "/assets/smarteditor/SmartEditor2Skin.html",
        fCreator: "createSEditor2"
    });

    //게시물 작성(수정) by.jeromc 2018-06-27
    $('.editor_action').click(function() {
        if(!$("#subject").val()){
            toastr.error('제목을 작성해 주세요.');
            $("#subject").focus();
            return ;
        }
        if(!confirm('저장하시겠습니까?')) return false;
        oEditors.getById["MCONT"].exec("UPDATE_CONTENTS_FIELD", []);	// 에디터의 내용이 textarea에 적용됩니다.
        var strtmp=document.getElementById("MCONT").value;
        document.getElementById("MCONT").value=strtmp.replace(/[\']/gi,"`");
        var strtmp=document.getElementById("MCONT").value;
        var string= $('#frm').serialize();
        $("#frm").submit();
    });

</script>
