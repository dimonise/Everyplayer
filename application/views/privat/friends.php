<?php
defined('BASEPATH') OR exit('No direct script access allowed');
if ($lang != 'en') {
    $age = 'лет';
    $old = 'года';
} else {
    $age = 'years';
    $old = 'years';
}

function GetYearWord($int, $age, $old) {

    if ($int > 20) {
        $int = substr($int, -1);
    }
    switch ($int) {
        case 0:
            return $age;
            break;
        case 1:
            return 'год';
            break;
        case ( $int >= 2 && $int <= 4 ):
            return $old;
            break;
        case ( $int >= 10 && $int <= 20 ):
            return $age;
            break;
        default:
            return $age;
            break;
    }
}
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
</div>
<div class="container">
    <div class="row">
        <div class="news">
            <div class="col-md-3 col-sm-3 col-xs-12 menu_klan">
                <div class="row">
                    <div class="klan_avatar">
                        <div class="uzor_avatar" ></div>
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
                <?php
                foreach ($friends as $user) {
                    $dbirth = strtotime($user->bdate);
                    $now = time();
                    $age_sec = $now - $dbirth;
                    $age_years = floor($age_sec / 31536000);
                    $this->db->where('id_med', $user->medal);
                    $med = $this->db->get('medal');
                    $medals = $med->result();
                    ?>
                    <div class="col-md-9 col-sm-9 col-xs-12 players_in_klan">
                        <div class="row">
                            <div class="player_avatar" style="background-image: url(<?php
                            if (!empty($user->avatar)) {
                                echo '/images/avatar/' . $user->avatar;
                            } else {
                                echo '/images/avatar/avatar.jpg';
                            }
                            ?>);"></div>
                            <div class="info_vivod">
                                <p><?= $user->first_name ?></p>
                                <p><?= $user->username ?></p>
                                <p>г. <?= $user->city ?> (<?= $user->gmt ?>)</p>
                                <p><?= $age_years . " " . GetYearWord($age_years, $age, $old); ?></p>
                                <div class="nagradi">
                                    <?php if (@$medals[0]->medal_img) { ?>
                                        <p class='nagradi'><img src='/images/medal/<?= $medals[0]->medal_img ?>'></p>
                                    <?php } ?>

                                </div>

                            </div>

                            <div class="liked_games">
                                <img src="/images/liked_game1.png">

                            </div>
                            <div class="group_buttons">
                                <input type="button" class="button_players click_mes" value="<?= $this->lang->line('mess') ?>">
                                <input type="button" class="button_players" value="<?= $this->lang->line('add_liked') ?>">
                                <?php
                                if ($user->friend_status == 0) {
                                    ?>
                                    <input type="button" class="button_players no_friend_add" data-add="<?= $user->friend_id ?>" value="<?= $this->lang->line('add_friend') ?>">
                                    <?php
                                } else {
                                    ?>
                                    <input type="button" class="button_players friend_delete" data-del="<?= $user->friend_id ?>" value="<?= $this->lang->line('del_friend') ?>">
                                    <?php
                                }
                                ?>
                            </div>
                            <hr>
                            <hr>
                        </div>
                    </div>
                <?php } ?>
            </div>
        </div>
    </div>	
</div>

</div>
<script>
    $('.no_friend_add').click(function () {
        var idus = $(this).data('add');
        $.ajax({
            type: "post",
            url: "/privat/act_friend",
            data: {us_id: idus},
            success: function (html) {
                alert('<?= $this->lang->line('added_fr') ?>');
                location.reload();
            }
        });
    })
</script>
<script>
    $('.friend_delete').click(function () {
        var idus = $(this).data('del');
        $.ajax({
            type: "post",
            url: "/privat/del_friend",
            data: {us_id: idus},
            success: function (html) {
                alert('<?= $this->lang->line('del_fr') ?>');
                location.reload();
            }
        });
    })
</script>