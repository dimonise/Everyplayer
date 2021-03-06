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

//$this->db->where('id_clans', $this->uri->segment(4));
//                                    $query = $this->db->get('clan_roles');
//                                    $roles = $query->result();
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
                <div class="active_menu_middle_image">
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
                        <div class="uzor_avatar"></div>
                        <img src="/images/clans/<?= $info[0]->logo_clan ?>">
                    </div>
                    <div class="nav_klan">
                        <ul>
                            <li><a href="/<?= $lang . '/' . $this->session->userdata('side') ?>/clan/<?= $this->uri->segment(4) ?>"><?= $this->lang->line('info_clan') ?></a></li>
                            <li><a href="/<?= $lang . '/' . $this->session->userdata('side') ?>/members/<?= $this->uri->segment(4) ?>"><?= $this->lang->line('members') ?></a></li>
                            
                            <?php
                            if ($this->session->userdata('id')) {
                                $us = $this->session->userdata('id');
                                $cl = $this->uri->segment(4);
                                $this->db->where('id_user', $us);
                                $this->db->where('id_clans', $cl);
                                $q = $this->db->get('clan_roles');
                                $rol = $q->result();
                                if ($rol != null) {
								?>
								<li><a href="/<?= $lang . '/' . $this->session->userdata('side') ?>/clan_news/<?= $this->uri->segment(4) ?>"><?= $this->lang->line('news_clan') ?></a></li>
                                <?php    if ($rol[0]->id_roles == 1 or $rol[0]->id_roles == 2) {
                                        ?>
                                        <li><a href="/<?= $lang . '/' . $this->session->userdata('side') ?>/recrute/<?= $this->uri->segment(4) ?>" style="color: #ff8700;"><?= $this->lang->line('recrute_clan') ?></a></li>
                                        <?php
                                    }
                                }
                            }
                            ?></ul>
                    </div>
                </div>
            </div>
            <div class="otstyp_klan">
                <div  class="col-md-9 col-sm-9 col-xs-12 tab_otstyp">
                    <div class="row">
                        <!-- Nav tabs -->
                        <ul class="nav nav-tabs tabs-left noselect">
                            <li class="active first"><a href="#tab_first" data-toggle="tab"><?= $this->lang->line('members') ?></a></li>
                            <li class="second"><a href="#tab_second " data-toggle="tab"><?= $this->lang->line('request') ?></a></li>
                        </ul>
                        <div class="tab-content">
                            <div class="tab-pane active tab1" id="tab_first">
                                <?php
                                foreach ($users as $user) {
                                    $dbirth = strtotime($user->bdate);
                                    $now = time();
                                    $age_sec = $now - $dbirth;
                                    $age_years = floor($age_sec / 31536000);

                                    $this->db->where('id_med', $user->medal);
                                    $med = $this->db->get('medal');
                                    $medals = $med->result();
                                    ?>
                                    <div class="col-md-12 col-sm-12 col-xs-12 players_in_klan">
                                        <div class="row">
                                            <div class="player_avatar" style=" background-image: url(<?php
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
                                                    <?php
                                                    $this->db->select('*');
                                                    $this->db->from('members_clan');
                                                    $this->db->join('clan_roles', 'clan_roles.id_user = members_clan.id_user', 'left');
                                                    $this->db->join('user_roles', 'user_roles.number_role = clan_roles.id_roles', 'left');
                                                    $this->db->where('id_clan', $this->uri->segment(4));
                                                    $this->db->where('members_clan.active_clan', 1);
                                                    $this->db->where('members_clan.id_user', $user->user_id);
                                                    $a = $this->db->get();
                                                    $medal = $a->result();
                                                    ?>
                                                    <img src="/images/medal/<?= $medal[0]->img ?>" title=" <?php
                                                    if ($lang == 'en') {
                                                        echo $medal[0]->desc_role_en;
                                                    } else {
                                                        echo $medal[0]->desc_role;
                                                    }
                                                    ?>">
                                                    <?php if (@$medals[0]->medal_img) { ?>
                                                        <p class='nagradi'><img src='/images/medal/<?= $medals[0]->medal_img ?>' title='<?= @$medals[0]->medal_name?>'></p>
                                                    <?php } 
                                                        if($user->premium == 1){                    
?>
                                <p class='nagradi'><img src='/images/medal/gold.png' title="Premium" class="golden"></p>
                          <?php
                            }
                            
                            
                            ?>
                                                </div>
                                            </div>
                                            <?php
                                            $this->db->where('id_clans', $this->uri->segment(4));
                                            $this->db->where('id_user', $this->session->userdata('id'));
                                            $query = $this->db->get('clan_roles');
                                            $roles = $query->result();
//                                            echo $roles[0]->id_user . '==' . $this->session->userdata('id');
                                            if ($roles[0]->id_user == $this->session->userdata('id')) {
                                                $this->db->where('id_user', $user->user_id);
                                                $qwer = $this->db->get('clan_roles');
                                                $rolik = $qwer->result();

                                                if ($lang == 'en') {
                                                    $sentr = 'sentry';
                                                    $mas = 'master';
                                                    $leg = 'legionnaire';
                                                } else {
                                                    $sentr = 'часовой';
                                                    $mas = 'мастер';
                                                    $leg = 'легионер';
                                                }
                                                ?> 

                                                <div class="reit_player">
                                                    <input type="button" class="button_players role" data-user="<?= $user->user_id ?>" <?php
                                                if ($rolik[0]->id_roles == 4) {
                                                    echo "style='color:#ff8700;'";
                                                }
                                                ?> data-role="4" value="<?= $sentr ?> " >
                                                    <input type="button" class="button_players role" data-user="<?= $user->user_id ?>" <?php
                                                    if ($rolik[0]->id_roles == 3) {
                                                        echo "style='color:#ff8700;'";
                                                    }
                                                    ?>data-role="3" value="<?= $leg ?>">
                                                    <input type="button" class="button_players role" data-user="<?= $user->user_id ?>" <?php
                                                    if ($rolik[0]->id_roles == 2) {
                                                        echo "style='color:#ff8700;'";
                                                    }
                                                    ?>data-role="2" value="<?= $mas ?>">
                                                </div>
                                                <div class="iskluchenie_buttons">
                                                    <input type="button" class="button_players del_clan" data-user="<?= $user->user_id ?>" value="<?= $this->lang->line('ex_clan') ?>">
                                                </div>
    <?php } ?>
                                            <hr>
                                            <hr>
                                        </div>
                                    </div>
<?php } ?>
                            </div>
                            <div class="tab-pane tab2" id="tab_second">
                                <?php
                                foreach ($recrut as $recruts) {
                                    $dbirth = strtotime($recruts->bdate);
                                    $now = time();
                                    $age_sec = $now - $dbirth;
                                    $age_years = floor($age_sec / 31536000);

                                    $this->db->where('id_med', $recruts->medal);
                                    $med = $this->db->get('medal');
                                    $medals = $med->result();
                                    ?>
                                    <div class="col-md-12 col-sm-12 col-xs-12 players_in_klan">
                                        <div class="row">
                                            <div class="player_avatar" style="background-image: url(<?php
                                    if (!empty($user->avatar)) {
                                        echo '/images/avatar/' . $recruts->avatar;
                                    } else {
                                        echo '/images/avatar/avatar.jpg';
                                    }
                                    ?>);"></div>
                                            <div class="info_vivod">
                                                <p><?= $recruts->first_name ?></p>
                                                <p><?= $recruts->username ?></p>
                                                <p>г. <?= $recruts->city ?> (<?= $recruts->gmt ?>)</p>
                                                <p><?= $age_years . " " . GetYearWord($age_years, $age, $old); ?></p>
                                                <div class="nagradi">
    <!--                                                    <img src="/images/clans/shit.png">-->
    <?php if (@$medals[0]->medal_img) { ?>
                                                        <p class='nagradi'><img src='/images/medal/<?= $medals[0]->medal_img ?>'></p>
    <?php } if($recruts->premium == 1){                    
?>
                                <p class='nagradi'><img src='/images/medal/gold.png' title="Premium" class="golden"></p>
                          <?php
                            }
                            
                            
                            ?>
                                                </div>
                                            </div>
                                            <div class="liked_games">
                                                    <?php
                                                    $ar = explode('/', $recruts->like_games);
                                                    for ($i = 0; $i < count($ar); $i++) {
                                                        $this->db->where('games_name', $ar[$i]);
                                                        $img = $this->db->get('favorite_games');
                                                        $images = $img->result();
                                                        //var_dump($images);
                                                        if ($ar[$i] != null) {
                                                            ?>
                                                        <img src="/images/games/<?= @$images[0]->games_img ?>">
                                                        <?php
                                                    }
                                                }
                                                ?>
                                            </div>
                                                <?php
                                                if ($roles[0]->id_user == $this->session->userdata('id')) {
                                                    ?>
                                                <div class = "group_buttons">
                                                    <input type = "button" class = "button_players click_mes" value = "<?= $this->lang->line('mess') ?>">
                                                    <input type = "button" class = "button_players" value = "<?= $this->lang->line('add_liked') ?>">
                                                    <input type = "button" class = "button_players add_clan" data-user="<?= $recruts->user_id ?>" value = "<?= $this->lang->line('take') ?>" >
                                                </div>
    <?php } ?>
                                            <hr>
                                            <hr>
                                        </div>
                                    </div>
    <?php
}
?>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>	
    <div class="container paginat2">
<?php echo $this->pagination->create_links(); ?>
    </div>
</div>
</div>

<script>
    $('.add_clan').click(function () {
        $.ajax({
            url: '/clans/add_recrute',
            method: 'post',
            data: {id_user: $(this).data('user'), id_clan:<?= $this->uri->segment(4) ?>},
            success: function () {
                alert("<?= $this->lang->line('us_ad_clan') ?>");
                location.reload();
            }
        });
    })
</script>
<script>
    $('.role').click(function () {
        var posada = $(this).val();
        $.ajax({
            url: '/clans/add_role',
            method: 'post',
            data: {id_user: $(this).data('user'), id_clan:<?= $this->uri->segment(4) ?>, id_role: $(this).data('role')},
            success: function () {
                alert("<?= $this->lang->line('us_ad_posad') ?> '" + posada + "'");
                location.reload();
            }
        });
    })
</script>
<script>
    $('.del_clan').click(function () {
        $.ajax({
            url: '/clans/delet_from_clan',
            method: 'post',
            data: {id_user: $(this).data('user'), id_clan:<?= $this->uri->segment(4) ?>},
            success: function () {
                alert("<?= $this->lang->line('us_del_clan') ?>");
                location.reload();
            }
        });
    })
</script>