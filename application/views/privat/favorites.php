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
                        <div class="uzor_avatar"></div>
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
                <div  class="col-md-9 col-sm-9 col-xs-12 tab_otstyp">
                    <div class="row">
                        <!-- Nav tabs -->
                        <ul class="nav nav-tabs tabs-left noselect">
                            <li class="active first"><a href="#tab_first" data-toggle="tab"><?= $this->lang->line('gamer') ?></a></li>
                            <li class="second"><a href="#tab_second" data-toggle="tab"><?= $this->lang->line('clans') ?></a></li>
                            <li class="third"><a href="#tab_third" data-toggle="tab"><?= $this->lang->line('turnam') ?></a></li>
                            <li class="fourth"><a href="#tab_fourth" data-toggle="tab"><?= $this->lang->line('news') ?></a></li>
                            <li class="fifth"><a href="#tab_fifth" data-toggle="tab"><?= $this->lang->line('gides') ?></a></li>
                        </ul>
                        <div class="tab-content">
                            <div class="tab-pane active tab1" id="tab_first">
                                <?php
                                foreach ($player as $players) {
                                    $dbirth = strtotime($players->bdate);
                                    $now = time();
                                    $age_sec = $now - $dbirth;
                                    $age_years = floor($age_sec / 31536000);

                                    $this->db->where('id_med', $players->medal);
                                    $med = $this->db->get('medal');
                                    $medals = $med->result();

                                    $games = substr($players->like_games, 0, -1);
                                    $ar = explode('/', $games);
                                    $res = array();
                                    for ($i = 0; $i < count($ar); $i++) {
                                        $this->db->where('games_name', $ar[$i]);
                                        $query = $this->db->get('favorite_games');
                                        $res[] = $query->result();
                                    }
                                    ?>
                                    <div class="col-md-12 col-sm-12 col-xs-12 players_in_klan">
                                        <div class="row">
                                            <div class="player_avatar" style=" background-image: url(<?php
                                            if (!empty($players->avatar)) {
                                                echo '/images/avatar/' . $players->avatar;
                                            } else {
                                                echo '/images/avatar/avatar.jpg';
                                            }
                                            ?>);"></div>
                                            <div class="info_vivod">
                                                <p><?= $players->first_name ?></p>
                                                <p><?= $players->username ?></p>
                                                <p>г. <?= $players->city ?> (<?= $players->gmt ?>)</p>
                                                <p><?= $age_years . " " . GetYearWord($age_years, $age, $old); ?></p>
                                                <div class="nagradi">
                                                    <?php if (@$medals[0]->medal_img) { ?>
                                                        <p class='nagradi'><img src='/images/medal/<?= $medals[0]->medal_img ?>'></p>
                                                    <?php } ?>
                                                </div>
                                            </div>

                                            <div class="liked_games">
                                                <?php
                                                if (!empty($res[0])) {
                                                    for ($i = 0; $i < count($res); $i++) {

                                                        echo "<img src='/images/games/" . $res[$i][0]->games_img . "'>";
                                                    }
                                                }
                                                ?>
                                            </div>
                                            <div class="group_buttons">
                                                <input type="button" class="button_players click_mes" value="<?= $this->lang->line('mess') ?>">
                                                <input type="button" class="button_players del_players" data-info="<?= $players->id_player ?>" value="<?= $this->lang->line('del_liked') ?>">
                                                <input type="button" class="button_players friend2" data-friend="<?= $players->user_id ?>" value="<?= $this->lang->line('add_friend') ?>">
                                                <input type="hidden" id="friend" value="<?php echo $this->session->userdata('id'); ?>">
                                            </div>
                                            <hr>
                                            <hr>
                                        </div>
                                    </div>
                                <?php } ?>
                            </div>
                            <div class="tab-pane tab2" id="tab_second">
                                <?php
                                foreach ($clans as $clan) {
                                    ?>
                                    <div class="col-md-12 col-sm-12 col-xs-12 players_in_klan">
                                        <div class="row">
                                            <a href="/<?= $lang ?>/<?= $this->session->userdata('side'); ?>/clan/<?= $clan->clan_id ?>">
                                                <div class="player_avatar2" style="background-image: url(/images/clans/<?= $clan->logo_clan ?>);background-size: cover;background-position: center;"></div>
                                            </a>
                                            <div class="info_vivod">
                                                <p><a href="/<?= $lang ?>/<?= $this->session->userdata('side'); ?>/clan/<?= $clan->clan_id ?>"><?= $clan->name_clan ?></a></p>
                                                <?php
                                                $this->db->where('id_clan', $clan->clan_id);
                                                $this->db->where('active_clan', 1);
                                                $count = $this->db->count_all_results('members_clan');
                                                ?>
                                                <p><?= $this->lang->line('members') ?>: <?= $count ?> </p>
                                                <?php
                                                $this->db->select('*');
                                                $this->db->from('clan_roles');
                                                $this->db->join('users', 'users.user_id = clan_roles.id_user', 'left');
                                                $this->db->where('clan_roles.id_clans', $clan->clan_id);
                                                $this->db->where('clan_roles.id_roles', 1);
                                                $leader = $this->db->get();
                                                $leader = $leader->result();
                                                ?>
                                                <p><?= $this->lang->line('lead') ?>: <?= $leader[0]->username ?></p>
                                            </div>
                                            <div class="group_buttons2">
                                                <input type="button" class="button_players del_clan" data-info="<?= $clan->clan_id ?>" value="<?= $this->lang->line('del_liked') ?>">
                                            </div>
                                            <div class="liked_games2">
                                                <?php
                                                $this->db->select('*');
                                                $this->db->from('link_games_clans');
                                                $this->db->join('favorite_games', 'favorite_games.games_id = link_games_clans.id_games', 'left');
                                                $this->db->where('link_games_clans.id_clans', $clan->clan_id);
                                                $query = $this->db->get();

                                                foreach ($query->result() as $res) {
                                                    ?>
                                                    <img src="/images/games/<?= $res->games_img ?>">
                                                <?php } ?>

                                            </div>
                                            <hr>
                                            <hr>
                                        </div>
                                    </div>
                                <?php } ?>
                            </div>
                            <div class="tab-pane tab3" id="tab_third">
                                <div class="col-md-12 col-sm-12 col-xs-12 players_in_klan">
                                    <div class="row">
                                        <div class="line_naimenovaniya">
                                            <div class="naimen1">
                                                <p><?= $this->lang->line('tour_pr_pr') ?></p>
                                            </div>
                                            <div class="naimen2">
                                                <p><?= $this->lang->line('datas') ?></p>
                                            </div>
                                            <div class="naimen3">
                                                <p><?= $this->lang->line('pize') ?></p>
                                            </div>
                                        </div>
                                        <?php
                                        foreach ($tourn as $tour) {
                                            ?>
                                            <div class="line_privat">
                                                <div class="privat_block1">
                                                    <div class="avatar_tour2" style="background-image: url(/images/tournament/<?= $tour->img_tour ?>);background-size: cover;background-position: center;"></div>
                                                    <p><?= $tour->name_tour ?></p>
                                                </div>
                                                <div class="privat_block2">
                                                    <p><?= $tour->date_start ?></p>
                                                </div>
                                                <div class="privat_block3">
                                                    <p><?= $tour->first + $tour->second + $tour->three ?> руб</p>
                                                </div>
                                            </div>
                                        <?php }
                                        ?>
                                    </div>
                                </div>

                            </div>
                            <div class="tab-pane tab4" id="tab_fourth">
                                <div class="col-md-12 col-sm-12 col-xs-12 players_in_klan">
                                    <div class="row">
                                        <?php
                                        foreach ($news as $new) {
                                            ?>
                                            <div class="news1">
                                                <div class="news_header">
                                                    <div class="col-md-6 col-sm-12 col-xs-12 left">
                                                        <p><?= $new->author_news ?></p>
                                                        <?php
                                                        $arrr = explode(" ", $new->datas_news);
                                                        $arr = explode(":", $arrr[1]);
                                                        $ar = explode("-", $arrr[0]);
                                                        $this->load->helper('trans_helper');
                                                        $name = str_replace(' ', '_', $new->title_news);
                                                        $name = str_replace('&', '_', $name);
                                                        $name = str_replace('(', '_', $name);
                                                        $name = str_replace(')', '_', $name);
                                                        $name = str_replace("'", '_', $name);
                                                        $name = str_replace('"', '_', $name);
                                                        $segment = mb_strtolower(transliterate($name));
                                                        if ($lang == 'en') {
                                                            $datass = $month_array_en[$ar[1]];
                                                        } else {

                                                            $datass = $month_array_rus[$ar[1]];
                                                        }
                                                        echo "<p>" . $ar[2] . ' ' . $datass . ' ' . $arr[0] . ':' . $arr[1] . "</p>";
                                                        ?>
                                                    </div>
                                                    <div class="col-md-6 col-sm-12 col-xs-12 right">
                                                        <div class="comments"><p><?php
                                                    $this->db->where('id_trek', $new->news_id);
                                                    echo $this->db->count_all_results('komm_news') . " ";
                                                        ?><?= $this->lang->line('coms'); ?></p></div>
                                                    </div>
                                                    <div class="col-md-12 col-sm-12 col-xs-12">
                                                        <h3><a href="/<?= $lang ?>/black/news/<?= $new->news_id ?>/<?= $segment ?>"><?php
                                                            if ($lang == 'en') {
                                                                echo $new->title_en;
                                                            } else {
                                                                echo $new->title_news;
                                                            }
                                                        ?></a></h3>
                                                    </div>
                                                </div>
                                                <div class="col-md-12 col-sm-12 col-xs-12">
                                                    <a href="/<?= $lang ?>/black/news/<?= $new->news_id ?>/<?= $segment ?>"><img src="<?php echo base_url(); ?>images/news/<?= $new->img_news; ?>"></a>
                                                </div>
                                                <div class="col-md-12 col-sm-12 col-xs-12 news_text">
                                                    <?php
                                                    if ($lang != 'en') {
                                                        ?>                              
                                                        <h5><?= $new->text_news; ?></h5>
                                                        <?php
                                                    } else {
                                                        echo "<h5>" . $new->text_en . "</h5>";
                                                    }
                                                    ?>
                                                </div>
                                                <div class="col-md-6 col-sm-6 col-xs-12">
                                                    <div class="social_icon">
                                                        <ul>
                                                            <!--***************************************************FACEBOOK*****************************************************************************************************-->
                                                            <div id="fb-root"></div>
                                                            <meta property="og:url"           content="<?= base_url() . $lang ?>/<?= $this->session->userdata('side') ?>/news/<?= $new->news_id ?>" />
                                                            <meta property="og:type"          content="website" />
                                                            <meta property="og:title"         content="<?= $new->title_news; ?>" />
                                                            <meta property="og:image"         content="<?php echo base_url(); ?>images/news/<?= $new->img_news; ?>" />
                                                            <a id="share" href="http://www.facebook.com/sharer.php?u=<?= base_url() . $lang ?>/<?= $this->session->userdata('side') ?>/news/<?= $new->news_id ?>" onclick="window.open(this.href, this.target, 'width= 500,height=600,scrollbars=1,top=150,left=' + (window.screen.width / 2 - 250));return false;">
                                                                <div class="fb"></div>
                                                            </a>
                                                            <!--------************************************************************************************************************************************-->
                                                            <!--***************************************************VK*****************************************************************************************************-->
                                                            <script type="text/javascript" src="http://vk.com/js/api/share.js?94" charset="windows-1251"></script>

                                                            <!-- Put this script tag to the place, where the Share button will be -->
                                                            <a href="http://vk.com/share.php?url=<?= base_url() . $lang ?>/<?= $this->session->userdata('side') ?>/news/<?= $new->news_id ?>&title=<?= $segment ?>&image=<?php echo base_url(); ?>images/news/<?= $new->img_news; ?>&noparse=true"><div class="vk"></div></a>

                                                            <!--**********************************************************************************************************************************************************-->                               
                                                            <!--***************************************************TWITTER*****************************************************************************************************-->
                                                            <a href="https://twitter.com/share?url=<?= base_url() . $lang ?>/<?= $this->session->userdata('side') ?>/news/<?= $new->news_id ?>&text=<?= $segment ?>"  ><div class="tv"></div></a> 
                                                            <!--------************************************************************************************************************************************-->
                                                            <!--***************************************************GOOGLE+*****************************************************************************************************-->                                

                                                            <a href="https://plus.google.com/share?url=<?= base_url() . $lang ?>/<?= $this->session->userdata('side') ?>/news/<?= $new->news_id ?>" onclick="javascript:window.open(this.href,
                                                                            '', 'menubar=no,toolbar=no,resizable=yes,scrollbars=yes,height=600,width=600');
                                                                    return false;"><div class="gl"></div></a>

                                                            <!--------************************************************************************************************************************************-->

                                                        </ul>
                                                    </div>
                                                </div>
                                                <div class="col-md-6 col-sm-6 col-xs-12 button-center">
                                                    <input class="button_news spoiler" type="button" value="<?= $this->lang->line('expand') ?>">
                                                    <input class="button_news_privat del_news" type="button" data-info="<?= $new->news_id ?>" value="<?= $this->lang->line('del_liked') ?>">
                                                </div>
                                                <hr>
                                                <hr>
                                            </div>
    <?php
}
?>
                                    </div>
                                </div>
                            </div>
                            <div class="tab-pane tab5" id="tab_fifth">
                                <div class="col-md-12 col-sm-12 col-xs-12 players_in_klan">
                                    <div class="row">
<?php
foreach ($gides as $gide) {
    ?>
                                            <div class="news1">
                                                <div class="news_header">
                                                    <div class="col-md-6 col-sm-12 col-xs-12 left">
                                                        <p><?= $gide->author_gides ?></p>
    <?php
    $arrr = explode(" ", $gide->datas_gides);
    $arr = explode(":", $arrr[1]);
    $ar = explode("-", $arrr[0]);
    $this->load->helper('trans_helper');
    $name = str_replace(' ', '_', $gide->title_gides);
    $name = str_replace('&', '_', $name);
    $name = str_replace('(', '_', $name);
    $name = str_replace(')', '_', $name);
    $name = str_replace("'", '_', $name);
    $name = str_replace('"', '_', $name);
    $segment = mb_strtolower(transliterate($name));
    if ($lang == 'en') {
        $datass = $month_array_en[$ar[1]];
    } else {

        $datass = $month_array_rus[$ar[1]];
    }
    echo "<p>" . $ar[2] . ' ' . $datass . ' ' . $arr[0] . ':' . $arr[1] . "</p>";
    ?>
                                                    </div>
                                                    <div class="col-md-6 col-sm-12 col-xs-12 right">
                                                        <div class="comments"><p><?php
                                                    $this->db->where('id_trek', $gide->gides_id);
                                                    echo $this->db->count_all_results('komm_gides') . " ";
                                                    ?><?= $this->lang->line('comms'); ?></p></div>
                                                    </div>
                                                    <div class="col-md-12 col-sm-12 col-xs-12">
                                                        <h3><a href="/<?= $lang ?>/black/news/<?= $gide->gides_id ?>/<?= $segment ?>"><?php
                                                            if ($lang == 'en') {
                                                                echo $gide->title_en;
                                                            } else {
                                                                echo $gide->title_gides;
                                                            }
    ?></a></h3>
                                                    </div>
                                                </div>
                                                <div class="col-md-12 col-sm-12 col-xs-12">
                                                                <?php
                                                                if ($gide->img_gides != null) {
                                                                    echo '<a href="/' . $lang . '/' . $this->session->userdata('side') . '/gide_one/' . $gide->gides_id . '/' . $segment . '"><img src="' . base_url() . 'images/gides/' . $gide->img_gides . '"></a>';
                                                                } else {
                                                                    echo $gide->video_gide;
                                                                }
                                                                ?>

                                                </div>
                                                <div class="col-md-12 col-sm-12 col-xs-12 news_text">
                                                    <?php
                                                    if ($lang != 'en') {
                                                        ?>                              
                                                        <h5><?= $gide->text_gides; ?></h5>
                                                        <?php
                                                    } else {
                                                        echo "<h5>" . $gide->text_en . "</h5>";
                                                    }
                                                    ?>
                                                </div>
                                                <div class="col-md-6 col-sm-6 col-xs-12">
                                                    <div class="social_icon">
                                                        <ul>
                                                            <!--***************************************************FACEBOOK*****************************************************************************************************-->
                                                            <div id="fb-root"></div>
                                                            <meta property="og:url"           content="<?= base_url() . $lang ?>/<?= $this->session->userdata('side') ?>/gide_one/<?= $gide->gides_id ?>" />
                                                            <meta property="og:type"          content="website" />
                                                            <meta property="og:title"         content="<?= $gide->title_gides; ?>" />
                                                            <meta property="og:image"         content="<?php echo base_url(); ?>images/gides/<?= $gide->img_gides; ?>" />
                                                            <a id="share" href="http://www.facebook.com/sharer.php?u=<?= base_url() . $lang ?>/<?= $this->session->userdata('side') ?>/gide_one/<?= $gide->gides_id ?>" onclick="window.open(this.href, this.target, 'width= 500,height=600,scrollbars=1,top=150,left=' + (window.screen.width / 2 - 250));return false;">
                                                                <div class="fb"></div>
                                                            </a>
                                                            <!--------************************************************************************************************************************************-->
                                                            <!--***************************************************VK*****************************************************************************************************-->
                                                            <script type="text/javascript" src="http://vk.com/js/api/share.js?94" charset="windows-1251"></script>

                                                            <!-- Put this script tag to the place, where the Share button will be -->
                                                            <a href="http://vk.com/share.php?url=<?= base_url() . $lang ?>/<?= $this->session->userdata('side') ?>/gide_one/<?= $gide->gides_id ?>&title=<?= $segment ?>&image=<?php echo base_url(); ?>images/gides/<?= $gide->img_gides; ?>&noparse=true"><div class="vk"></div></a>

                                                            <!--**********************************************************************************************************************************************************-->                               
                                                            <!--***************************************************TWITTER*****************************************************************************************************-->
                                                            <a href="https://twitter.com/share?url=<?= base_url() . $lang ?>/<?= $this->session->userdata('side') ?>/gide_one/<?= $gide->gides_id ?>&text=<?= $segment ?>"  ><div class="tv"></div></a> 
                                                            <!--------************************************************************************************************************************************-->
                                                            <!--***************************************************GOOGLE+*****************************************************************************************************-->                                

                                                            <a href="https://plus.google.com/share?url=<?= base_url() . $lang ?>/<?= $this->session->userdata('side') ?>/gide_one/<?= $gide->gides_id ?>" onclick="javascript:window.open(this.href,
                                                                            '', 'menubar=no,toolbar=no,resizable=yes,scrollbars=yes,height=600,width=600');
                                                                    return false;"><div class="gl"></div></a>

                                                            <!--------************************************************************************************************************************************-->

                                                        </ul>
                                                    </div>
                                                </div>
                                                <div class="col-md-6 col-sm-6 col-xs-12 button-center">
                                                    <input class="button_news spoiler" type="button" value="<?= $this->lang->line('expand'); ?>">
                                                    <input class="button_news_privat del_gides" type="button" data-info="<?= $gide->gides_id ?>" value="<?= $this->lang->line('del_liked'); ?>">
                                                </div>
                                                <hr>
                                                <hr>
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

        </div>



    </div>
</div>	
</div>

</div>

<script>
    $('.del_players').click(function () {
        var id_player = $(this).data('info');
        var id_boss = <?= $this->session->userdata('id'); ?>;

        $.ajax({
            url: '/privat/del_players',
            method: 'POST',
            data: {id_boss: id_boss, id_player: id_player},
            success: function (html) {
                alert('<?= $this->lang->line('del_us_fav') ?>');
                location.reload();
            }
        });
    })
</script> 
<script>
    $('.del_clan').click(function () {
        var id_clan = $(this).data('info');
        var id_boss = <?= $this->session->userdata('id'); ?>;

        $.ajax({
            url: '/privat/del_clans',
            method: 'POST',
            data: {id_boss: id_boss, id_clan: id_clan},
            success: function (html) {
                alert('<?= $this->lang->line('del_cl_fav') ?>');
                location.reload();
            }
        });
    })
</script> 
<script>
    $(document).ready(function () {
        $('.news').on('click', '.spoiler', function () {
            var bbb = $(this).parent().parent().find('.news_text h5').css('max-height');
            console.log(bbb);
            if (bbb === '60px') {
                $(this).parent().parent().find('.news_text h5').css('max-height', '100%');
            } else {
                $(this).parent().parent().find('.news_text h5').css('max-height', '60px');
            }
        })
    })
</script>
<script>
    $('.del_news').click(function () {
        var id_news = $(this).data('info');
        var id_boss = <?= $this->session->userdata('id'); ?>;

        $.ajax({
            url: '/privat/del_news',
            method: 'POST',
            data: {id_boss: id_boss, id_news: id_news},
            success: function (html) {
                alert('<?= $this->lang->line('del_ne_fav') ?>');
                location.reload();
            }
        });
    })
</script> 
<script>
    $('.del_gides').click(function () {
        var id_gides = $(this).data('info');
        var id_boss = <?= $this->session->userdata('id'); ?>;

        $.ajax({
            url: '/privat/del_gides',
            method: 'POST',
            data: {id_boss: id_boss, id_gides: id_gides},
            success: function (html) {
                alert('<?= $this->lang->line('del_gi_fav') ?>');
                location.reload();
            }
        });
    })
    $('.friend2').click(function () {
        var friend = $(this).siblings('#friend').val();
        var boss = $(this).data('friend');
        $.ajax({
            type: "post",
            url: "/privat/add_friend",
            data: {fre: friend, bos: boss},
            success: function (html) {

                alert('<?= $this->lang->line('req_friend') ?>');
                location.reload();
            }
        });
    })
</script> 