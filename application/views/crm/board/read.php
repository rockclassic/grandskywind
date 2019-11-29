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
                         <div class="form-group" style="margin-bottom: 0; display: flex; align-items: center;padding: 0px 19px" >
                                <div class="col-md-1 write"><label>제 목</label></div>
                                <div class="col-md-7"><input type="text" name="subject" id="subject" value="<?=$list['nt_title']?>" class="form-control " readonly></div>
                                <div class="col-md-1 write"><label>읽 음 </label></div>
                                <div class="col-md-2"><input type="text" name="subject" id="subject" value="<?=$list['nt_read_count']?>" class="form-control " readonly></div>

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
                                <pre style="overflow: auto;padding: 10px">
                                        <?  if(isset($list['nt_content'])) echo str_replace('"', '\'', preg_replace('/\s\s+/', ' ', $list['nt_content']))?>
                                </pre>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <hr class='hr-double'>
    </div>
</div>

