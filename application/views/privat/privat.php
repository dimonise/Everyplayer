<?php
defined('BASEPATH') OR exit('No direct script access allowed');
?>
<div class="container images_for_black">
    <div class="row">
        <div class="flex-container">
            <a href="/<?= $lang . '/' . $this->session->userdata('side') ?>/players">
                <div class="image1">
                    <img src="<?php echo base_url(); ?>images/black_image1.png">
                    <div class="black_line"><p><?= $this->lang->line('gamer'); ?></p></div>
                </div>
            </a>
            <a href="/<?= $lang ?>/<?= $this->session->userdata('side'); ?>/my_clans">
                <div class="image1">
                    <img src="<?php echo base_url(); ?>images/black_image1.png">
                    <div class="black_line"><p><?= $this->lang->line('mclans'); ?></p></div>
                </div>
            </a>
            <a href="/<?= $lang ?>/<?= $this->session->userdata('side'); ?>/search_clan">
                <div class="image1">
                    <img src="<?php echo base_url(); ?>images/black_image1.png">
                    <div class="black_line"><p><?= $this->lang->line('sclans'); ?></p></div>
                </div>
            </a>
            <a href="/<?= $lang . '/' . $this->session->userdata('side') ?>/gides">
                <div class="image1">
                    <img src="<?php echo base_url(); ?>images/black_image1.png">
                    <div class="black_line"><p><?= $this->lang->line('gides'); ?></p></div>
                </div>
            </a>
            <a href="/<?= $lang . '/' . $this->session->userdata('side') ?>/tournaments">
                <div class="image1">
                    <img src="<?php echo base_url(); ?>images/black_image1.png">
                    <div class="black_line"><p><?= $this->lang->line('turnam'); ?></p></div>
                </div>
            </a>
        </div>
    </div>
    <div class="container">
        <div class="row">
            <div class="news">
                <div class="col-md-3 col-sm-3 col-xs-12 menu_klan">
                    <div class="row">
                        <div class="klan_avatar">
                            <div class="uzor_avatar">
                                <div class="pencil3"></div> 
                            </div>
                            <?php
                            $id_boss = $this->session->userdata('id');
                            $this->db->where('user_id', $id_boss);
                            $query = $this->db->get('users');
                            $result = $query->result();

                            if (!empty($result[0]->avatar)) {
                                $img = '/images/avatar/' . $result[0]->avatar;
                            } else {
                                $img = '/images/avatar/avatar.jpg';
                            }
                            ?>
                            <img src="<?= $img ?>">
                            <form id="down_ava" action="/privat/avatar" enctype="multipart/form-data" method="post">
                                <input type="hidden" name="user_id" value="<?php echo $this->session->userdata('id'); ?>">
                                <input id="userfile" name="userfile" type="file" style="position:absolute; top:-999px; visibility:hidden" accept="image/*"/>
                            </form> 
                            <script>
                                var input = document.querySelector("#userfile");
                                var btn = document.querySelector(".pencil3");
                                btn.onclick = function () {
                                    input.click();
                                };
                            </script>
                            <script>
                                var input = document.querySelector("input[type='file']");
                                input.onchange = function () {
                                    this.form.submit();
                                }
                            </script>
                        </div>
                        <div class="nav_klan">
                            <ul>
                                <li><a href="/<?= $lang ?>/<?= $this->session->userdata('side'); ?>/privat_friends/<?= $this->session->userdata('id'); ?>"><?= $this->lang->line('friend_pr') ?></a></li>
                                <li><a href="/<?= $lang ?>/<?= $this->session->userdata('side'); ?>/privat_achievements/<?= $this->session->userdata('id'); ?>"><?= $this->lang->line('achi_pr') ?></a></li>
                                <li><a href="/<?= $lang ?>/<?= $this->session->userdata('side'); ?>/privat_clans/<?= $this->session->userdata('id'); ?>"><?= $this->lang->line('clans_pr') ?></a></li>
                                <li><a href="/<?= $lang ?>/<?= $this->session->userdata('side'); ?>/privat_tour/<?= $this->session->userdata('id'); ?>"><?= $this->lang->line('tour_pr') ?></a></li>
                                <li><a href=""><?= $this->lang->line('mes_pr') ?></a></li>
                                <li><a href="/<?= $lang ?>/<?= $this->session->userdata('side'); ?>/privat_favorites/<?= $this->session->userdata('id'); ?>"><?= $this->lang->line('fav_pr') ?></a></li>
                                <li><a href="/<?= $lang ?>/<?= $this->session->userdata('side'); ?>/privat_premium/<?= $this->session->userdata('id'); ?>"><?= $this->lang->line('fav_prem') ?></a></li>
                            </ul>
                        </div>

                    </div>
                </div>
                <div class="otstyp_klan">
                    <div class="col-md-9 col-sm-9 col-xs-12 players_in_klan">
                        <div class="row">
                            <div class="news1">
                                <div class="privat_dannie">
                                    <div class="pencil2"></div>
                                    <div class="privat_name2">
                                        <p><?= $this->lang->line('index_fname_th') ?>: <?= $info[0]->first_name ?></p>
                                    </div>
                                    <div class="privat_name_nick2">
                                        <p>Nickname: <?= $info[0]->username ?></p>
                                    </div>
                                    <div class="privat_email2">
                                        <p>Email: <?= $info[0]->email ?></p>
                                    </div>
                                    <div class="privat_rogdenie2">
                                        <?php
                                        $ar = explode(".", $info[0]->bdate);

                                        if ($lang == 'en') {
                                            $datass = $month_array_en[$ar[1]];
                                        } else {

                                            $datass = $month_array_rus[$ar[1]];
                                        }
                                        ?>
                                        <p><?= $this->lang->line('bd_pr') ?>: <?= $ar[0] ?> <?= $datass ?> <?= $ar[2] ?></p>
                                    </div>
                                    <div class="privat_pol2">
                                        <?php
                                        if ($info[0]->sex == 2) {
                                            $sex = $this->lang->line('m');
                                        } else {
                                            $sex = $this->lang->line('f');
                                            ;
                                        }
                                        ?>
                                        <p><?= $this->lang->line('sex') ?>: <?= $sex ?></p>
                                    </div>
                                    <div class="privat_strana2">
                                        <p><?= $this->lang->line('country') ?>: <?= $info[0]->country ?>		<span><?= $this->lang->line('city') ?>: <?= $info[0]->city ?></span></p>
                                    </div>
                                    <div class="privat_kontakt_info">
                                        <p><?= $this->lang->line('coninf') ?>:</p>
                                        <p>
                                            <?php
                                            if ($info[0]->shows == 1) {
                                                echo $info[0]->descr;
                                            } else {
                                                echo $this->lang->line('hid');
                                            }
                                            ?>
                                        </p>
                                    </div>
                                    <div class="social_icon">
                                        <ul>
                                            <a href="<?= $info[0]->facebook ?>"><div class="fb"></div></a>
                                            <a href="<?= $info[0]->vk ?>"><div class="vk"></div></a>
                                            <a href="<?= $info[0]->twitter ?>"><div class="tv"></div></a>
                                            <a href="<?= $info[0]->google ?>"><div class="gl"></div></a>
                                        </ul>
                                    </div>

                                    <div class="privat_o_sebe">
                                        <p><?= $this->lang->line('abme') ?>:</p>
                                        <p><?= $info[0]->about ?></p>
                                    </div>
                                    <div class="privat_praim_time">
                                        <p><?= $this->lang->line('prime') ?>: <?= $info[0]->prime ?></p>
                                    </div>
                                    <div class="privat_obrazovanie">
                                        <p><?= $this->lang->line('educ') ?>: <?= $info[0]->education ?></p>
                                    </div>
                                    <div class="privat_rod_deyat">
                                        <p><?= $this->lang->line('occup') ?>: <?= $info[0]->occupation ?></p>
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
    $('.pencil2').click(function () {
        $.ajax({
            url: '/privat/edit_info',
            method: 'POST',
            data: {id_user:<?= $this->session->userdata('id'); ?>, lang: '<?= $lang ?>'},
            success: function (html) {
                $('.news1').html(html);
            }
        });
    })
</script>