            <div class="row" id="content-wrapper">
                <!-- 본문 내용 -->
                <div class='col-xs-12'>
                    <div class='page-header page-header-with-buttons'>
                        <h1 class='pull-left'>
                            <i class='icon-dashboard'></i>
                            <span>Dashboard</span>
                        </h1>
                        <div class='pull-right'>
                            <div class='btn-group'>
                            </div>
                        </div>
                    </div>


                    <div class='row'>
                        <div class='col-md-12'>
                            <div class='box'>
                                <div class='box-header'>
                                    <div class='title'>
                                        <div class='icon-inbox' style="color:#666"></div>
                                       Today Info
                                   </div>                  </div>

                                <div class='row'>
                                    <div class='col-sm-4' >
                                        <div class='box-content box-statistic notice-box' style="    padding: 2px 19px 2px 19px;overflow-y: auto">
                                            <?foreach ($notice as $k => $v){?>
                                            <div class='row title' style="margin-left: -15px;margin-right: -15px;cursor: pointer " onclick="go_notice(<?=$v['nt_notice_idx']?>);">
                                                <div class='col-sm-8 s-str' style="width: 66.6%; float: left;padding-left: 0px"><?=$v['nt_title']?></div>
                                                <div class='col-sm-4 dt-style'   style="width: 33.3%; float: left"><?=substr($v['nt_regDt'],0,10)?></div>
                                            </div>
                                            <?}?>
                                            <div class='text-info icon-bullhorn align-right'></div>
                                        </div>

                                    </div>
                                    <div class='col-sm-4'>
                                        <div class='box-content box-statistic' style="cursor: pointer"  onclick="location.href='/crm/trade/estimate'">
                                            <small>견적 의뢰</small>
                                            <h3 class='title text-success'><?=$cnt[0]['req_cnt']?>건</h3>
                                            <div class='text-success icon-external-link align-right'></div>
                                        </div>
                                        <div class='box-content box-statistic' style="cursor: pointer"  onclick="location.href='/crm/mbroffice/list'">
                                            <small>신규 가입 세무사</small>
                                            <h3 class='title text-warning'><?=$cnt[0]['user_cnt']?>명</h3>
                                            <div class='text-warning icon-user align-right'></div>
                                        </div>



                                    </div>
                                    <div class='col-sm-4'>
                                        <div class='box-content box-statistic' style="cursor: pointer"  onclick="location.href='/crm/trade/estimate'">
                                            <small>요청 연결  </small>
                                            <h3 class='title text-primary'><?=$cnt[0]['rsp_cnt']?>건</h3>
                                            <div class='text-primary icon-magnet align-right'></div>
                                        </div>
                                    </div>
                                    <div class='col-sm-4'>
                                        <div class='box-content box-statistic' style="cursor: pointer"  onclick="location.href='/crm/board/ask'">
                                            <small>고객 문의 (미처리/문의)</small>
                                            <h3 class='title text-danger'><?=$cnt[0]['ans_cnt']?> / <?=$cnt[0]['ask_cnt']?>건</h3>
                                            <div class='text-danger icon-comment align-right'></div>
                                        </div>
                                    </div>

                                </div>
                            </div>
                        </div>
                    </div>

                    <div class='row'>
                        <div class='col-md-12'>
                            <div class='box'>
                                <div class='row'>


                                    <div class='col-sm-4' >
                                        <div class='title' style="padding: 5px 15px;cursor: pointer"  onclick="location.href='/crm/trade/estimate'">
                                            <div class='icon-list-alt' style="color:#666"></div>
                                            견적 의뢰
                                        </div>
                                        <div  style="height:140px;" class=" box-content box-statistic str3-1">
                                            <?foreach ($req as $k => $v){?>
                                            <div class='title2'>
                                                <div class='row' style="margin: 0px;padding-bottom: 10px;cursor: pointer"  onclick="location.href='/crm/trade/estimate'">
                                                    <div class='col-sm-8 s-str' style="width: 66.6%; float: left"><?=$v['em_c1']?></div>
                                                    <div class='col-sm-4 dt-style' style="width: 33.3%; float: left "><?=substr($v['em_regDt'],0,10)?></div>
                                                </div>
                                            </div>
                                            <?}?>
                                        </div>
                                    </div>

                                    <div class='col-sm-4'>
                                        <div class='title' style="padding: 5px 15px;cursor: pointer"  onclick="location.href='/crm/trade/estimate'">
                                            <div class='icon-list-alt' style="color:#666"></div>
                                            견적 답변
                                        </div>
                                        <div  style="height:140px;" class=" box-content box-statistic str3-2">
                                            <?foreach ($rsp as $k => $v){?>
                                                <div class='title2'>
                                                    <div class='row' style="margin: 0px;padding-bottom: 10px;cursor: pointer"  onclick="location.href='/crm/trade/estimate'">
                                                        <div class='col-sm-8 s-str' style="width: 66.6%; float: left"><?=$v['ob_officeNm']?></div>
                                                        <div class='col-sm-4 dt-style' style="width: 33.3%; float: left "><?=substr($v['rs_regDt'],0,10)?></div>
                                                    </div>
                                                </div>
                                            <?}?>
                                        </div>
                                    </div>
                                    <div class='col-sm-4' >
                                        <div class='title' style="padding: 10px;">
                                            &nbsp;
                                        </div>
                                        <div style="height: 140px;padding-left: 0px" class="str3 str_wrap">

                                            <a href="#">
                                                <img src="/assets/images/ad/ad01.jpg" style="height: 140px">
                                            </a>
                                            <a href="#">
                                                <img src="/assets/images/ad/ad02.jpg" style="height: 140px">
                                            </a>
                                            <a href="#">
                                                <img src="/assets/images/ad/ad03.jpg" style="height: 140px">
                                            </a>
                                            <a href="#">
                                                <img src="/assets/images/ad/ad04.jpg" style="height: 140px">
                                            </a>
                                        </div>
                                    </div>



                                </div>
                            </div>
                        </div>
                    </div>

                </div>
            </div>


            <style>
                .str { font-size: 0; !important;}
                .str3-1 { background:none !important;}
                .str3-2 { background:none !important;}
                .str3 .str_item {
                    font-size:0;
                    line-height:0
                }
                .str3 img { opacity:1}
                .str3 img:hover { opacity:0.7}
                .str3.str_wrap.str_active {
                    background:#fff;
                }
                @media (max-width: 380px) {
                    .dt-style{display:none}
                }

            </style>
            <script>
                $(window).load(function() {
                    $('.str3-1').liMarquee({
                        direction: 'up',
                        loop: -1,
                        scrolldelay: 0,
                        scrollamount: 30,
                        circular: true,
                        hoverstop:true,
                        drag: false
                    });
                    $('.str3-2').liMarquee({
                        direction: 'up',
                        loop: -1,
                        scrolldelay: 0,
                        scrollamount: 30,
                        circular: true,
                        hoverstop:true,
                        drag: false
                    });
                     $('.str3').liMarquee({
                        direction: 'left',
                        loop: -1,
                        scrolldelay: 0,
                        scrollamount: 45,
                        circular: true,
                        hoverstop:true,
                        drag: true
                    });
                })
                function go_notice(no) {
                    self.location.href="/crm/board/read/notice/"+no;

                }
            </script>