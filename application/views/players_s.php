<?php
defined('BASEPATH') OR exit('No direct script access allowed');
if ($lang != 'en') {
    $age = 'лет';
    $old = 'года';
} else {
    $age = 'years';
    $old = 'years';
}

function GetYearWord($int, $age, $old)
{

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
        case ($int >= 2 && $int <= 4):
            return $old;
            break;
        case ($int >= 10 && $int <= 20):
            return $age;
            break;
        default:
            return $age;
            break;
    }
}

?>
<script src="https://code.jquery.com/ui/1.12.1/jquery-ui.js"></script>
<link rel="stylesheet" href="//code.jquery.com/ui/1.12.1/themes/base/jquery-ui.css">

<div class="container images_for_black">
    <div class="row">
        <div class="flex-container">
            <a href="/<?= $lang . '/' . $this->session->userdata('side') ?>/players">
                <div class="active_menu_middle_image">
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
    <div class="news-top-bg row">
        <div class="picLeft"></div>
        <div class="picRight"></div>
        <div class="news">
            <div class="scroll-pane">
                <div class="col-md-3 col-sm-3 col-xs-12 sortirovka">
                    <div class="row">
                        <p><?= $this->lang->line('sort_games') ?></p>
                        <div class="vivod_liked_games">
                            <?php
                            foreach ($favor as $fav) {
                                echo "<a href='/" . $lang . "/" . $this->session->userdata('side') . "/player/search_gamers_games/" . $fav->games_id . "'><img src='/images/games/" . $fav->games_img . "' ></a>";
                            }
                            ?>
                        </div>
                        <form action="/<?= $lang . "/" . $this->session->userdata('side') ?>/player/search"
                              method="post">
                            <div class="vibor_game">
                                <select name="all_games" id="all_games">
                                    <option value="" value="" disabled selected
                                            style='display:none;'><?= $this->lang->line('sel_games') ?></option>
                                    <?php
                                    $fgam = $this->input->post('all_games');
                                    foreach ($favor_all as $fav_all) {
                                        echo "<option value='" . $fav_all->id_ach_game . "'";
                                        if (!empty($fgam) and $fgam == $fav_all->id_ach_game) {
                                            echo "selected='selected'";
                                        }
                                        echo " >" . $fav_all->game_name . "</option>";
                                    }
                                    ?>
                                </select>
                            </div>
                            <div class="vibor_game filtr"></div>
                            <!--                            <p>--><?//= $this->lang->line('timez') ?><!--</p>-->
                            <div class="vibor_game">
                                <select name="gmt">
                                    <option value="" disabled selected
                                            style='display:none;'><?= $this->lang->line('timez') ?></option>
                                    <?php
                                    $fgmt = $this->input->post('gmt');
                                    foreach ($get_gmt as $gmt) {
                                        echo "<option value='" . $gmt->gmt . "'";
                                        if (!empty($fgmt) and $fgmt == $gmt->gmt) {
                                            echo "selected='selected'";
                                        }
                                        echo " >" . $gmt->gmt . "</option>";
                                    }
                                    ?>
                                </select>
                            </div>
                            <div class="vibor_game">
                                <select name="age">
                                    <option value="" disabled selected
                                            style='display:none;'><?= $this->lang->line('age') ?></option>
                                    <?php
                                    $fage = $this->input->post('age');
                                    for ($i = 10; $i < 61; $i++) {
                                        echo "<option value='$i'";
                                        if (!empty($fage) and $fage == $i) {
                                            echo "selected='selected'";
                                        }
                                        echo ">$i</option>";
                                    }
                                    ?>
                                </select>
                            </div>
                            <div class="vibor_game">
                                <?php
                                $fsex = $this->input->post('sex');
                                ?>
                                <select name="sex">
                                    <option value="" disabled selected
                                            style='display:none;'><?= $this->lang->line('sex') ?></option>
                                    <option value="2" <?php if (!empty($fsex) and $fsex == 2) {
                                        echo "selected='selected'";
                                    } ?>><?= $this->lang->line('m') ?></option>
                                    <option value="1" <?php if (!empty($fsex) and $fsex == 1) {
                                        echo "selected='selected'";
                                    } ?>><?= $this->lang->line('f') ?></option>
                                </select>
                            </div>
                            <input type="submit" class="button_players" value="<?= $this->lang->line('appl') ?>">
                        </form>
                    </div>
                </div>
                <?php

                foreach ($get_gamers as $user) {
                    $dbirth = strtotime($user[0]->bdate);
                    $now = time();
                    $age_sec = $now - $dbirth;
                    $age_years = floor($age_sec / 31536000);

                    $games = substr($user[0]->like_games, 0, -1);
                    $ar = explode('/', $games);
                    $res = array();
                    for ($i = 0; $i < count($ar); $i++) {
                        $this->db->where('games_name', $ar[$i]);
                        $query = $this->db->get('favorite_games');
                        $res[] = $query->result();
                    }
                    $this->db->where('id_med', $user[0]->medal);
                    $med = $this->db->get('medal');
                    $medal = $med->result();
                    ?>
                    <div class="col-md-9 col-sm-9 col-xs-12 players">
                        <div class="row">
                            <a href='/<?= $lang ?>/<?= $this->session->userdata('side') . "/privat_info/" . $user[0]->user_id ?>'>
                                <div class="player_avatar" style=" background-image: url(<?php
                                if (!empty($user[0]->avatar)) {
                                    echo '/images/avatar/' . $user[0]->avatar;
                                } else {
                                    echo '/images/avatar/avatar.jpg';
                                }
                                ?>);"></div>
                            </a>
                            <div class="info_vivod">
                                <p>
                                    <a href='/<?= $lang ?>/<?= $this->session->userdata('side') . "/privat_info/" . $user[0]->user_id ?>'><?= $user[0]->first_name ?></a>
                                </p>
                                <p><?= $user[0]->username ?></p>
                                <p>г. <?= $user[0]->city ?> (<?= $user[0]->gmt ?>)</p>
                                <p><?= $age_years . " " . GetYearWord($age_years, $age, $old); ?></p>
                                <?php

                                if (@$medal[0]->medal_img) { ?>
                                    <p class='nagradi'><img src='/images/medal/<?= $medal[0]->medal_img ?>'
                                                            title="<?= $medal[0]->medal_name ?>"></p>
                                <?php }
                                if ($user[0]->premium == 1) {
                                    ?>
                                    <p class='nagradi'><img src='/images/medal/gold.png' title="Premium" class="golden">
                                    </p>
                                    <?php
                                }


                                ?>
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
                                <input type="button" class="button_players click_mes" data-infa="<?= $user[0]->user_id ?>"
                                       value="<?= $this->lang->line('mess') ?>">
                                <input type="button" class="button_players add_to_privat_player"
                                       value="<?= $this->lang->line('add_liked') ?>" data-info="<?= $user[0]->user_id ?>">
                                <input type="button" class="button_players friend2" data-friend="<?= $user[0]->user_id ?>"
                                       value="<?= $this->lang->line('add_friend') ?>">
                                <input type="hidden" id="friend" value="<?php echo $this->session->userdata('id'); ?>">
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
<?php
if ($this->uri->segment(3) == 'players') {
    ?>
    <script>
        $(document).ready(function () {
            var ava;
            var inProgress = false;
            var startFrom = 3;

            function urlLit(w, v) {
                var tr = 'a b v g d e ["zh","j"] z i y k l m n o p r s t u f h c ch sh ["shh","shch"] ~ y ~ e yu ya ~ ["jo","e"]'.split(' ');
                var ww = '';
                w = w.toLowerCase();
                for (i = 0; i < w.length; ++i) {
                    cc = w.charCodeAt(i);
                    ch = (cc >= 1072 ? tr[cc - 1072] : w[i]);
                    if (ch.length < 3)
                        ww += ch;
                    else
                        ww += eval(ch)[v];
                }
                return (ww.replace(/[^a-zA-Z0-9\-]/g, '-').replace(/[-]{2,}/gim, '-').replace(/^\-+/g, '').replace(/\-+$/g, ''));
            }

            $(window).scroll(function () {
                if ($(window).scrollTop() + ($(window).height() * 1.8) >= $(document).height() && !inProgress) {

                    var title;
                    var texts;
                    $.ajax({
                        url: '/players/get_next_three',
                        method: 'POST',
                        data: {"startFrom": startFrom},
                        beforeSend: function () {
                            inProgress = true;
                        }
                    }).done(function (data) {

                        data = jQuery.parseJSON(data);

                        if (data.length > 0) {
                            $.each(data, function (index, data) {

                                if (data.avatar != '') {
                                    ava = '/images/avatar/' + data.avatar;
                                }
                                else {
                                    ava = '/images/avatar/avatar.jpg';
                                }
                                $.ajax({
                                    type: "post",
                                    url: "/players/additional",
                                    dataType: "json",
                                    data: {user_bdate: data.bdate, user_likegames: data.like_games, medal: data.medal},
                                    success: function (html) {


                                        if (html.medal.length > 0) {
                                            var txt = "<p class='nagradi'><img src='/images/medal/" + html.medal[0].medal_img + "' title='" + html.medal[0].medal_name + "'></p>";
                                        }
                                        else {
                                            var txt = "";
                                        }

                                        if (data.premium == 1) {
                                            var txtprem = " <p class='nagradi'><img src='/images/medal/gold.png' title='Premium' class='golden'></p";
                                        }
                                        else {
                                            var txtprem = "";
                                        }

                                        for (var i = 0; i < html.res.length; i++) {
                                            var txtgame = "<img src='/images/games/" + html.res[i][0].games_img + "' title='" + html.res[i][0].games_name + "'>";
                                            console.log(html.res[i][0].games_img);
                                        }


                                        $(".scroll-pane").append("<div class='col-md-9 col-sm-9 col-xs-12 players'><div class='row'><a href='/<?= $lang ?>/<?= $this->session->userdata('side') ?>'/privat_info/" + data.user_id + "'><div class='player_avatar' style='background-image: url(" + ava + ")'></div></a><div class='info_vivod'><p><a href='/<?= $lang ?>/<?= $this->session->userdata('side') ?>'/privat_info/" + data.user_id + "'>" + data.first_name + "</a></p><p>" + data.username + "</p><p>г. " + data.city + " (" + data.gmt + ")</p><p>" + html.age_years + " " + html.age_str + "</p>" + txt + txtprem + "<div class='liked_games'>" + txtgame + "</div><div class='group_buttons'><input type='button' class='button_players click_mes' data-infa='" + data.user_id + "' value='<?= $this->lang->line('mess') ?>'><input type='button' class='button_players add_to_privat_player' value='<?= $this->lang->line('add_liked') ?>' onclick='fav(" + data.user_id + ")'><input type='button' class='button_players friend2'  onclick='frend(" + data.user_id + ",<?php echo $this->session->userdata('id'); ?>)' value='<?= $this->lang->line('add_friend') ?>'></div><hr><hr></div></div>");


                                    }
                                });


                            });
                        }
                    });
                    inProgress = false;
                    startFrom += 3;
                }
            });

        });

    </script>
    <?php
}
?>
<script>
    function frend(x, y) {


        if (x != 0) {
            $.ajax({
                type: "post",
                url: "/privat/add_friend",
                data: {fre: y, bos: x},
                success: function (html) {


                    location.reload();
                }
            });
        }
    }
    function fav(x) {

        $.ajax({
            url: '/privat/players',
            method: 'POST',
            data: {id_player: x},
            success: function () {

            }
        });
    }

</script>
<script type="text/javascript">
    var res = true;
    $('.gam').on('click', function () {
        if (res == true) {
            $(this).parents().addClass('active');
            res = false;
        } else {
            $(this).parents().removeClass('active');
            res = true;
        }
    })
</script>
<script>
    $(document).ready(function () {
        $('.friend2').on('click', function () {

            var friend = $(this).siblings('#friend').val();
            var boss = $(this).data('friend');

            if (friend != 0) {
                $.ajax({
                    type: "post",
                    url: "/privat/add_friend",
                    data: {fre: friend, bos: boss},
                    success: function (html) {


                        location.reload();
                    }
                });
            }
        })
    })
    $('.add_to_privat_player').click(function () {
        var id = $(this).data('info');
        $.ajax({
            url: '/privat/players',
            method: 'POST',
            data: {id_player: id},
            success: function () {

            }
        });
    })
    $(".click_mes").click(function () {
        var komu = $(this).data('infa');
        var str = window.location.href;
        str = str.replace('players', 'chat');
        location.href = str + '/' + komu;
    })

</script>
<script>
    $('#all_games').change(function (){
        $.ajax({
            url: '/players/get_filtr',
            method: 'POST',
            data: {id_game: $(this).val()},
            success: function (html) {
                $('.filtr').html(html);
            }
        });
    })
</script>