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
        <div class="news-top-bg row">
            <div class="picLeft"></div>
            <div class="picRight"></div>
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
                                <li>
                                    <a href="/<?= $lang ?>/<?= $this->session->userdata('side'); ?>/privat_friends/<?= $this->session->userdata('id'); ?>"><?= $this->lang->line('friend_pr') ?></a>
                                </li>
                                <li>
                                    <a href="/<?= $lang ?>/<?= $this->session->userdata('side'); ?>/privat_achievements/<?= $this->session->userdata('id'); ?>"><?= $this->lang->line('achi_pr') ?></a>
                                </li>
                                <li>
                                    <a href="/<?= $lang ?>/<?= $this->session->userdata('side'); ?>/privat_clans/<?= $this->session->userdata('id'); ?>"><?= $this->lang->line('clans_pr') ?></a>
                                </li>
                                <li>
                                    <a href="/<?= $lang ?>/<?= $this->session->userdata('side'); ?>/privat_tour/<?= $this->session->userdata('id'); ?>"><?= $this->lang->line('tour_pr') ?></a>
                                </li>
                                <li><a href=""><?= $this->lang->line('mes_pr') ?></a></li>
                                <li>
                                    <a href="/<?= $lang ?>/<?= $this->session->userdata('side'); ?>/privat_favorites/<?= $this->session->userdata('id'); ?>"><?= $this->lang->line('fav_pr') ?></a>
                                </li>
                                <li>
                                    <a href="/<?= $lang ?>/<?= $this->session->userdata('side'); ?>/privat_premium/<?= $this->session->userdata('id'); ?>"><?= $this->lang->line('fav_prem') ?></a>
                                </li>
                            </ul>
                        </div>

                    </div>
                </div>
                <div class="otstyp_klan">
                    <div class="col-md-9 col-sm-9 col-xs-12 players_in_klan">
                        <div class="row">
                            <div class="news1">
                                <div class="privat_winners">
                                    <p><?= $this->lang->line('achi_my') ?></p>
                                    <?php
                                    $query_name = array();
                                    $query_names = array();
                                    $query_val = array();
                                    $query_valik = array();
                                    $query_game = array();
                                    $a = 0;
                                    foreach ($achiev as $ach) {
                                        $this->db->where('id_har', $ach->id_crit);
                                        $query_name_har = $this->db->get('ach_game_har');
                                        if (!isset($delimiter)) {
                                            $delimiter = $ach->game;
                                        } else {
                                            if ($delimiter != $ach->game) {
                                                $query_valik = array();
                                                $query_names = array();
                                                $delimiter = $ach->game;
                                                $a++;
                                            }
                                        }
                                        if ($ach->val_crit == 0) {
                                            $harak = $ach->val_crit_text;
                                            $query_valik[] = $harak;
                                        } else {
                                            $harak = $ach->val_crit;
                                            $this->db->where('id_val', $harak);
                                            $query_val_har = $this->db->get('har_value');
                                            $query_vall = $query_val_har->result();
                                            if ($lang == 'en') {
                                                $query_valik[] = $query_vall[0]->value_en;
                                            } else {
                                                $query_valik[] = $query_vall[0]->value;
                                            }
                                        }
                                        $query_game[] = $ach->game_img;
                                        $query_names[] = $query_name_har->result();
                                        $query_val[$a] = $query_valik;
                                        $query_name[$a] = $query_names;
                                    }
                                    $query_game = array_unique($query_game);
                                    $query_game = array_values($query_game);
                                    //                                    echo "<pre>";
                                    //                                    var_dump($query_name);

                                    for ($i = 0; $i < count($query_game); $i++) {
                                        ?>
                                        <div class="line_games">
                                            <img src="/images/games/<?= $query_game[$i] ?>">
                                            <p><span><?php
                                                    for ($y = 0; $y < count($query_val[$i]); $y++) {
                                                        if ($lang == 'en') {
                                                            echo $query_name[$i][$y][0]->har_en . " - " . $query_val[$i][$y] . " / ";
                                                        } else {
                                                            echo $query_name[$i][$y][0]->har . " - " . $query_val[$i][$y] . " / ";
                                                        }
                                                    }
                                                    ?></span></p>
                                            <div class="privat8_edit">
                                                <!--<p class="edit" data-edit="<?= $ach->id_achi ?>"><?= strtolower($this->lang->line('chan')) ?></p>-->
                                                <p class="del"
                                                   data-del="<?= $ach->game ?>"><?= $this->lang->line('del') ?></p>
                                            </div>
                                        </div>
                                        <?php
                                    }
                                    ?>
                                    <input class="privat8_button" type="button" name=""
                                           value="+ <?= $this->lang->line('achi_ad') ?>">
                                    <form id="new_game" method="post">
                                        <div class="privat8_edit_game">
                                            <select class="new_game" name="new_game">
                                                <option disabled
                                                        selected="selected"><?= $this->lang->line('game') ?></option>

                                                <?php
                                                $query = $this->db->get('achi_games');
                                                foreach ($query->result() as $game) {
                                                    echo "<option value='" . $game->id_ach_game . "'>" . $game->game_name . "</option>";
                                                }
                                                ?>
                                            </select>
                                        </div>
                                        <input type="hidden" value="<?= $this->session->userdata('id') ?>"
                                               name="id_user">
                                        <input type="hidden" value="<?= $lang ?>" name="lang">
                                        <section id="new_info"></section>
                                        <input class="privat8_button2 new" type="button" name=""
                                               value="<?= $this->lang->line('save') ?>">
                                    </form>
                                    <form class="edit_game" method="post">

                                    </form>

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
    $('#new_game').hide();
    $('.edit_game').hide();
    $('.privat8_button').click(function () {
        $('.edit_game').hide();
        $('#new_game').show();
    })
    $('.edit').click(function () {
        $('#new_game').hide();
        var id_ach = $(this).data('edit');
        $.ajax({
            url: '/privat/edit_ach',
            method: 'POST',
            data: {id_ach: id_ach, lang: '<?= $lang ?>'},
            success: function (html) {
                $('.edit_game').show();
                $('.edit_game').html(html);
            }
        });
    })
    $('.new').click(function () {
        $.ajax({
            url: '/privat/new_ach',
            method: 'POST',
            data: $('form').serialize(),
            success: function () {
                location.reload();
            }
        });
    })

    $('.del').click(function () {
        var id_ach = $(this).data('del');
        $.ajax({
            url: '/privat/del_ach',
            method: 'POST',
            data: {id_ach: id_ach},
            success: function () {
                location.reload();
            }
        });
    })
</script>
<script>
    $('.new_game').change(function () {
        $.ajax({
            url: '/privat/sel_ach',
            method: 'POST',
            data: {id_ach: $(this).val(), lang: '<?= $lang ?>'},
            success: function (html) {
                $('#new_info').html(html);
            }
        });
    })
</script>