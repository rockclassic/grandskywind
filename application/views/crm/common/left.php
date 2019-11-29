<nav id='main-nav'>
    <div class='navigation'>
        <ul class='nav nav-stacked'>
            <?
            // 2018-06-18 기존 메뉴를 수정함(등급별 노출, 둥) by.jeromc
            $user_grade=  $this->openssl_mem->aes_decrypt($this->session->userdata('user_grade'));

            foreach($_menu as $k => $v) {
                $in = '';
                if(!in_array($user_grade,$v['grade'])) continue;
                if( array_key_exists($_class."/".$_method,$v['sub'])) {
                    $this->session->set_userdata('main_title',$v['name']);
                    $this->session->set_userdata('main_icon',$v['icon']);
                    $in = 'in';
                }

                ?>
                <li>
                    <a class="dropdown-collapse <?=$in?>" href="#">
                        <i class='icon-<?=$v['icon']?>'></i>
                        <span><?=$v['name']?></span>
                        <i class='icon-angle-down angle-down'></i>
                    </a>
                    <?
                    $CI =& get_instance();

                    if(!empty($v['sub'])) {
                        ?>
                        <ul class='nav nav-stacked <?=$in?>'>
                            <?
                            foreach($v['sub'] as $kk => $vv) {
                                if(!in_array($user_grade,$vv['grade'])) continue;

                                $active = '';
                                if($_class."/".$_method == $kk){
                                    $this->session->set_userdata('title',$vv['title']);
                                    $active = 'active';
                                }
                                if(isset($vv['no_show']) && $vv['no_show']=="Y") continue;
                                ?>
                                <li class='<?=$active?>'>
                                    <!--a href='/dashboard/<?=$k?>/<?=$kk?>'-->
                                    <a href='/crm/<?=$kk?>'>
                                        <i class='icon-caret-right'></i>
                                        <span><?=$vv['title']?></span>
                                    </a>
                                </li>
                                <?
                            }
                            ?>
                        </ul>
                        <?
                    }
                    ?>
                </li>
                <?
            }
            ?>
        </ul>
    </div>
</nav>


