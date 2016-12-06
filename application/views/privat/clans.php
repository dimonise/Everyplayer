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
                                <a href="/<?= $lang ?>/<?= $this->session->userdata('side'); ?>/create_clan/<?= $this->session->userdata('id'); ?>"> <input type="button" name="sozdat_klan" value="Создать клан"></a>
                            </ul>
                        </div>

                    </div>
                </div>
                <div class="otstyp_klan">
                    <?php
                    foreach ($clan as $clans) {
                        ?>
                        <div class="col-md-9 col-sm-9 col-xs-12 players_privat">
                            <div class="row">
                                <a href="/<?= $lang ?>/<?= $this->session->userdata('side'); ?>/clan/<?= $clans->id_clan ?>">
                                    <div class="player_avatar2" style="background-image: url(/images/clans/<?= $clans->logo_clan ?>);background-size: cover;background-position: center;"></div>
                                </a>
                                <div class="info_vivod">
                                    <p><a href="/<?= $lang ?>/<?= $this->session->userdata('side'); ?>/clan/<?= $clans->clan_id ?>"><?= $clans->name_clan ?></a></p>
                                    <?php
                                    $this->db->where('id_clan', $clans->clan_id);
                                    $this->db->where('active_clan', 1);
                                    $count = $this->db->count_all_results('members_clan');
                                    ?>
                                    <p><?= $this->lang->line('members') ?>: <?= $count ?> </p>
                                    <?php
                                    $this->db->select('*');
                                    $this->db->from('clan_roles');
                                    $this->db->join('users', 'users.user_id = clan_roles.id_user', 'left');
                                    $this->db->where('clan_roles.id_clans', $clans->clan_id);
                                    $this->db->where('clan_roles.id_roles', 1);
                                    $leader = $this->db->get();
                                    $leader = $leader->result();
                                    ?>
                                    <p><?= $this->lang->line('lead') ?>: <?= $leader[0]->username ?></p>
                                </div>
                                <div class="group_buttons2">
                                    <input type="button" class="button_players del_clan"  value="<?= $this->lang->line('out_clan') ?>" data-info="<?= $clans->clan_id ?>">
                                </div>
                                <div class="liked_games2">
                                    <?php
                                    $this->db->select('*');
                                    $this->db->from('link_games_clans');
                                    $this->db->join('favorite_games', 'favorite_games.games_id = link_games_clans.id_games', 'left');
                                    $this->db->where('link_games_clans.id_clans', $clans->clan_id);
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

            </div>



        </div>
    </div>	
</div>
</div>
<script>
    $('.del_clan').click(function () {
        $.ajax({
            url: '/clans/delet_from_clan',
            method: 'post',
            data: {id_user: <?= $this->session->userdata('id') ?>, id_clan: $(this).data('info')},
            success: function () {
                alert("Вы покинули клан");
                location.reload();
            }
        });
    })
</script>