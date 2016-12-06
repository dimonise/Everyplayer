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

                            </div>
                            <?php
                            $id_boss = $this->uri->segment(4);
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

                        </div>
                        <div class="nav_klan">
                            <?php
                            if($this->session->userdata('id')){
                            if($this->session->userdata('id')!= $this->uri->segment(4)){
                            ?>
                            <input type="button" class="nav_klan_but add_to_privat_player" value="<?=$this->lang->line('add_liked')?>" data-info="<?= $info[0]->user_id ?>">
                            <input type="button" class="nav_klan_but friend2" data-friend="<?=$info[0]->user_id?>" value="<?=$this->lang->line('add_friend')?>">
                            <input type="hidden" id="friend" value="<?php echo $this->session->userdata('id'); ?>">
                            <?php }} ?>
                        </div>

                    </div>
                </div>
                <div class="otstyp_klan">
                    <div class="col-md-9 col-sm-9 col-xs-12 players_in_klan">
                        <div class="row">
                            <div class="news1">
                                <div class="privat_dannie">
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
                                    <div class="privat_all">
                                        <p><?= $info[0]->descr ?></p>
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
                                    <div class="privat_winners">
                                        <p><?= $this->lang->line('achi_my') ?></p>
                                        <?php
                                        foreach ($achiev as $ach) {
                                            ?>
                                            <div class="line_games">
                                                <img src="/images/games/<?= $ach->games_img ?>">
                                                <p><span><?php
                                                        $answ = unserialize($ach->game_info);

                                                        foreach ($answ as $key => $ans) {
                                                            echo $key . '-' . $ans . '  ';
                                                        }
                                                        ?></span></p>

                                            </div>
                                            <?php
                                        }
                                        ?>

                                    </div>
                                    <div class="privat_kontakt_info">
                                        <p><?= $this->lang->line('coninf') ?>:</p>
                                        <p>
                                            <?php
                                            if ($info[0]->shows == 1) {
                                                echo $info[0]->descr;
                                                ?>
                                            <div class="social_icon">
                                                <ul>
                                                    <a href="<?= $info[0]->facebook ?>"><div class="fb"></div></a>
                                                    <a href="<?= $info[0]->vk ?>"><div class="vk"></div></a>
                                                    <a href="<?= $info[0]->twitter ?>"><div class="tv"></div></a>
                                                    <a href="<?= $info[0]->google ?>"><div class="gl"></div></a>
                                                </ul>
                                            </div>
                                            <?php
                                        } else {
                                            echo $this->lang->line('hid');
                                        }
                                        ?>
                                        </p>
                                    </div>
                                    <div class="privat_liked_game">
                                        <?php
                                        $games = substr($info[0]->like_games, 0, -1);
                                        $ar = explode('/', $games);
                                        $res = array();
                                        for ($i = 0; $i < count($ar); $i++) {
                                            $this->db->where('games_name', $ar[$i]);
                                            $query = $this->db->get('favorite_games');
                                            $res[] = $query->result();
                                        }
                                        ?>
                                        <p><?= $this->lang->line('reg_gam') ?></p>
                                        <div class="liked_games_privat">
                                            <?php
                                            if (!empty($res[0])) {
                                                for ($i = 0; $i < count($res); $i++) {

                                                    echo "<img src='/images/games/" . $res[$i][0]->games_img . "'>";
                                                }
                                            }
                                            ?>
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
</div>
<script>
    $('.friend2').click(function(){
    var friend = $(this).siblings('#friend').val();
    var boss = $(this).data('friend');
     $.ajax({
            type: "post",
            url: "/privat/add_friend",
            data: {fre: friend, bos:boss},
            success: function (html) {

                alert('<?=$this->lang->line('req_friend')?>');
                
            }
        });
})
$('.add_to_privat_player').click(function(){
    var id = $(this).data('info');
    $.ajax({
            url: '/privat/players',
            method: 'POST',
            data: {id_player:id},
            success: function () {
                alert('<?=$this->lang->line('ads_user')?>');
            }
        });
})
</script>