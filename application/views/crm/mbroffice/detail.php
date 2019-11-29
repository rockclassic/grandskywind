<div class="row" id="content-wrapper">
    <div class="col-xs-12">
        <? $this->load->view('crm/common/top', array('_method' => 'index')); ?>
        <div class="row">
            <div class="col-sm-6">
                <div class="box">
                    <div class='box-header muted-background'>
                        <div class='title'><?=$this->session->userdata('title')?> 상세</div>
                    </div>
                    <div class="box-content" style="height: 400px">
                        <form class="form form-horizontal" style="margin-bottom: 0;" id="admin_info" name="admin_info">
                            <div class="form-group">
                                <label class="col-md-2 control-label">아이디(이메일)</label>
                                <div class="col-md-10">
                                    <input type="hidden" class="control-info" id="user_srl" name="user_srl" value="<?=$info['user_srl']?>"/>
                                    <input class="control-info" id="user_email" name="user_email" value="<?=$info['user_email']?>"/>
                                </div>
                            </div>
                            <div class="form-group">
                                <label class="col-md-2 control-label">이름</label>
                                <div class="col-md-10">
                                    <input class="control-info" id="user_name" name="user_name" value="<?=$info['user_name']?>" />
                                </div>
                            </div>
                            <div class="form-group">
                                <label class="col-md-2 control-label">전화번호</label>
                                <div class="col-md-10">
                                    <input class="control-info" id="user_phone" name="user_phone" value="<?=$info['user_phone']?>" />
                                </div>
                            </div>
                            <div class="form-group">
                                <label class="col-md-2 control-label">회원상태</label>
                                <div class="col-md-10">
                                    <?
                                    switch($info['user_grade']) {
                                        case 0: $_label = "danger"; $status="접속불가"; break;
                                        default: $_label = "primary"; $status="접속가능"; break;
                                    }
                                    ?>
                                    <span class="label label-<?=$_label?>"><?=$status?></span>
                                </div>
                            </div>
                            <div class="form-group">
                                <label class="col-md-2 control-label">관리자등</label>
                                <div class="col-md-10">

                                    <select id="user_grade"  name="user_grade" class="form-control" style="width:30%">
                                        <option value="">로그인제한</option>
                                        <?
                                        foreach($admin_grade_infos as $k) {

                                            ?>
                                            <option value="<?=$k['info_value']?>"<?=($info['user_grade'] == $k['info_value'])?' selected':''?>><?=$k['info_title']?></option>
                                            <?
                                        }
                                        ?>
                                    </select>

                                    <span class="label label-<?=$_level?>"><?=$info['user_level']?></span>
                                </div>
                            </div>

                            <div class="form-group">
                                <label class="col-md-2 control-label">비밀번호</label>
                                <div class="col-md-10">
                                    <button class="btn btn-primary btn-xs"  name="change_pw" id="change_pw">비밀번호 초기화</button>
                                </div>
                            </div>
                            <div class="form-group">
                                <label class="col-md-2 control-label">가입일시</label>
                                <div class="col-md-10">
                                    <label class="control-info"><?=$info['user_date']?></label>
                                </div>
                            </div>
                            <div class="form-group">
                                <div class="col-md-8">
                                </div>
                                <div class="col-md-1">
                                                <span class='input-group-btn'>
                                                    <button class='btn btn-default' type='button' id="reset_btn" name="reset_btn">
                                                    초기화
                                                    </button>
                                                </span>
                                </div>
                                <div class="col-md-1">
                                                <span class='input-group-btn'>
                                                    <button class='btn btn-success' type='button' id="save_info_btn" name="save_info_btn">
                                                    저장
                                                    </button>
                                                </span>
                                </div>


                                <div class="col-md-2">
                                                <span class='input-group-btn'>
                                                    <button class='btn btn-warning' type='button' id="user_admin_btn" name="user_admin_btn">
                                                        관리자관리
                                                    </button>
                                                </span>
                                </div>
                            </div>

                        </form>
                    </div>
                </div>
            </div>
            <div class="col-sm-6">
                <div class="box">
                    <div class='box-header orange-background'>
                        <div class='title'>관리자 메모(최근 50개)</div>
                    </div>
                    <div class="box-content timeline" style="height: 400px">
                        <div class='box-toolbox box-toolbox-top'>
                            <div class='tab-content'>
                                <form id="admin_log" name="admin_log">
                                    <input type="hidden" name="user_srl" value="<?=$info['user_srl']?>">
                                    <div class='form-group' style="margin-bottom:0px;">
                                        <div class='input-group controls-group'>
                                            <input value="" placeholder="관리자 메모..." class="form-control" name="comment" type="text" />
                                            <span class='input-group-btn'>
                                                        <button class='btn btn-success' type='button' id="save_log">
                                                            <i class='icon-plus'></i>
                                                        </button>
                                                    </span>
                                        </div>
                                    </div>
                                </form>
                            </div>
                        </div>
                        <div class='col-sm-12 scrollable' data-scrollable-height='320px' data-scrollable-start='top' style="height: 320px;overflow-y: scroll;">
                            <ol class='list-unstyled'>
                                <?
                                foreach($admin as $k => $v) {
                                    ?>
                                    <li style="padding-bottom:5px;">
                                        <div class='icon orange-background'>
                                            <i class='icon-plane'></i>
                                        </div>
                                        <div class='title'>
                                            <?=$v['a']?>
                                        </div>
                                        <div class='content' style="margin-top:-4px;">
                                            <?=$v['a']?>
                                            <small class='text-muted'><?=$v['b']?></small><br>
                                            <?=$v['c']?>
                                        </div>
                                    </li>
                                    <?
                                }
                                ?>
                            </ol>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div class='row'>
            <div class='col-sm-12'>
                <div class='box bordered-box sea-blue-border'>
                    <div class='box-header blue-background'>
                        <div class='title'>상세 정보</div>
                        <!-- div class='actions'>
                            <a class="btn box-collapse btn-xs btn-link" href="#"><i></i></a>
                        </div -->
                    </div>
                    <div class="box-content">
                        <div class="tabbable tabs-left">
                            <ul class="nav nav-tabs">
                                <li class="active">
                                    <a data-toggle='tab' href='#balance'>
                                        견적답변
                                    </a>
                                </li>
                                <li class="">
                                    <a data-toggle='tab' data-cont='account' href='#account'>
                                        계정정보
                                    </a>
                                </li>
                                <li class="">
                                    <a data-toggle='tab' data-cont='charge' href='#charge'>
                                        충전 내역
                                    </a>
                                </li>
                                <li class="">
                                    <a data-toggle='tab' href='#customer'>
                                        1:1문의 내역
                                    </a>
                                </li>
                                <li class="">
                                    <a data-toggle='tab' href='#login'>
                                        로그인 내역
                                    </a>
                                </li>
                                <li class="">
                                    <a data-toggle='tab' data-cont="admin" href='#admin'>
                                        시스템 로그
                                    </a>
                                </li>
                            </ul>
                            <div class="tab-content">
                                <div class="tab-pane active" id="balance">
                                    <div class='box-content box-no-padding scrollable' data-scrollable-height='600' data-scrollable-start='top'>
                                        <div class='responsive-table' style="height: 260px;overflow-y: scroll;">
                                            <table class='table table-striped' style='margin-bottom:0;'>
                                                <thead>
                                                <tr>
                                                    <th class="text-center">A</th>
                                                    <th class="text-center">B</th>
                                                    <th class="text-center">C</th>
                                                </tr>
                                                </thead>
                                                <tbody>
                                                <?
                                                foreach($login as $k => $v) {
                                                    ?>
                                                    <tr>
                                                        <td align="right"><?=$v['a']?></td>
                                                        <td align="right"><?=$v['b']?></td>
                                                        <td align="right"><?=$v['c']?></td>
                                                    </tr>
                                                    <?
                                                }
                                                ?>
                                                </tbody>
                                            </table>
                                        </div>
                                    </div>
                                </div>
                                <div class="tab-pane" id="account">
                                    <div class='box-content box-no-padding scrollable' data-scrollable-height='600' data-scrollable-start='top'>
                                        <div class='responsive-table' id="account_detail" style="height: 260px;overflow-y: scroll;">
                                        </div>
                                    </div>
                                </div>
                                <div class="tab-pane" id="charge">
                                    <div class='box-content box-no-padding scrollable' data-scrollable-height='600' data-scrollable-start='top'>
                                        <div class='responsive-table' id="charge_detail" style="height: 260px;overflow-y: scroll;">
                                        </div>
                                    </div>
                                </div>
                                <div class="tab-pane" id="customer">
                                    <div class='box-content box-no-padding scrollable' data-scrollable-height='600' data-scrollable-start='top'>
                                        <div class='responsive-table' id="customer_detail" style="height: 260px;overflow-y: scroll;">
                                            <table class='table' style='margin-bottom:0'>
                                                <thead>
                                                <tr>
                                                    <th class="text-center">문의종류</th>
                                                    <th class="text-center">제목</th>
                                                    <th class="text-center">처리상태</th>
                                                    <th class="text-center">접수일시</th>
                                                    <th class="text-center">답변일시</th>
                                                    <th class="text-center">보기</th>
                                                </tr>
                                                </thead>
                                                <tbody>
                                                <?php

                                                foreach ($custom_list as $k => $v){
                                                    ?>
                                                    <tr>
                                                        <td align="center"><?=$v['a']?></td>
                                                        <td align="center"><?=$v['b']?></td>
                                                        <td align="center"><?=$v['c']?></td>
                                                        <td align="center"><?=$v['d']?></td>
                                                        <td align="center"><?=$v['e']?></td>
                                                        <td align="center"> <button type="button" style="display: block; margin-bottom: 10px;" class="btn btn-primary btn-xs modal_btn" data-toggle="modal" data-target="<?=$v['a']?>">보기</button></td>

                                                    </tr>


                                                    <?

                                                }
                                                ?>


                                                </tbody>
                                            </table>
                                        </div>
                                    </div>
                                </div>
                                <div class="tab-pane" id="login">
                                    <div class='box-content box-no-padding scrollable' data-scrollable-height='600' data-scrollable-start='top'>
                                        <div class='responsive-table' style="height: 260px;overflow-y: scroll;">
                                            <table class='table' style='margin-bottom:0;'>
                                                <thead>
                                                <tr>
                                                    <th class="text-center">1차 성공여부</th>
                                                    <th class="text-center">2차 성공여부</th>
                                                    <th class="text-center">로그인 아이피</th>
<!--                                                    <th class="text-center">접속기기</th>-->
                                                    <th class="text-center">로그인일시</th>
                                                </tr>
                                                </thead>
                                                <tbody>
                                                <?
                                                foreach($login as $k => $v) {
                                                    $device = json_decode($v['user_login_device'], true);
                                                    //$device = $device['HTTP_USER_AGENT'];
                                                    $device = explode("like Gecko) ", $device['HTTP_USER_AGENT']);
                                                    $device = $device[1];
                                                    ?>
                                                    <tr>
                                                        <td align="center"><?=$v['a']?></td>
                                                        <td align="center"><?=$v['b']?></td>
                                                        <td align="center"><?=$v['c']?></td>
<!--                                                        <td align="center">--><?//=$device?><!--</td>-->
                                                        <td align="center"><?=$v['d']?></td>
                                                    </tr>
                                                    <?
                                                }
                                                ?>
                                                </tbody>
                                            </table>
                                        </div>
                                    </div>
                                </div>
                                <div class="tab-pane" id="admin">
                                    <div class='box-content box-no-padding scrollable' data-scrollable-height='600' data-scrollable-start='top'>
                                        <div class='responsive-table' id="admin_detail" style="height: 260px;overflow-y: scroll;">
                                        </div>
                                    </div>
                                </div>



                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
<script>
    $(document).ready(function() {
        $('#save_info_btn').click(function() {
            if(!confirm('저장 하시겠습니까?')) return false;
            var url = '/dashboard/user/set_admin_info';
            var data = $('#admin_info').serialize();
            ajax_post(url, data, function(ret) {
                if(ret.msg == 'success') {
                    alert('저장 되었습니다.');
                    if($('#user_srl').val()==undefined || $('#user_srl').val()==''){
                        self.location.href='/dashboard/user/admin_detail/'+ret.data;
                    }else {
                        self.location.reload();
                    }
                } else {
                    alert('error : '+ret.data);
                }
            });
        });

        $('#user_admin_btn').click(function() {
            self.location.href='/dashboard/user/admin_user';
        });
        $('#reset_btn').click(function() {
            self.location.href='/dashboard/user/admin_detail/';
        });


        $('#change_pw').click(function() {
            if(!confirm('비밀번호를 초기화 하시겠습니까?')) return false;
            var url = '/dashboard/user/reset_pw';
            var data = $('#admin_info').serialize();
            ajax_post(url, data, function(ret) {
                if(ret.msg == 'success') {
                    alert('변경 비번은 banco!2345입니다. 저장 되었습니다.');
                    self.location.reload();
                } else {
                    alert('error : '+ret.data);
                }
            });
        });
        $('#save_log').click(function() {
            if(!confirm('저장 하시겠습니까?')) return false;
            var url = '/crm/user/ax_log';
            var data = $('#admin_log').serialize();
            ajax_post(url, data, function(ret) {
                if(ret.msg == 'success') {
                    alert('저장 되었습니다.');
                    self.location.reload();
                } else {
                    alert('error : '+ret.data);
                }
            });
        });

    });
</script>
