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
                <div class="active_menu_middle_image">
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
            <div class="col-md-3 col-sm-3 col-xs-12 sortirovka">
                <div class="row">
                    <form method="post" action="/<?=$lang?>/<?=$this->session->userdata('side')?>/clans/filtr">
                        <input class="search_klan" name="frameworks" list="frameworks" placeholder="<?=$this->lang->line('s_name')?>" >
                        <datalist id="frameworks">
                            <?php
                            foreach ($clan as $clans) {
                                echo "<option value='" . $clans->name_clan . "'>";
                            }
                            ?>
                        </datalist>						
                        <p><?=$this->lang->line('adv')?></p>
                        <div class="vibor_game">
                            <select name="search_data">
                                <option value="" disabled selected style='display:none;'><?=$this->lang->line('sort')?></option>
                                <option value="1"><?=$this->lang->line('asc')?></option>
                                <option value="2"><?=$this->lang->line('dsc')?></option>
                                <option value="3"><?=$this->lang->line('col_mem')?></option>
                            </select>
                        </div>
                        <div class="vibor_game">
                            <select name="search_game">
                                <option value=""><?=$this->lang->line('all_games')?></option>
                                <?php
                                $q = $this->db->get('favorite_games');
                                $games = $q->result();
                                foreach ($games as $value) {
                                    echo "<option value='".$value->games_id."'>".$value->games_name."</option>";
                                }
                                ?>
                            </select>
                        </div>
                        <!--<div class="vibor_game">
                            <select>
                                <option>Все типы кланов</option>
                                <option>Хорошие</option>
                                <option>Плохие</option>
                            </select>
                        </div>
                        <div class="vibor_game">
                            <select>
                                <option>Все страны</option>
                                <option>Украина</option>
                                <option>Россия</option>
                            </select>

                        </div>-->
                        <input type="submit" class="button_players" value="<?=$this->lang->line('appl')?>">
                    </form>
                </div> 
            </div>
            <?php
            if(isset($mem)){
                for($i=0;$i<count($mem);$i++){
                    foreach ($mem[$i] as $clans) {
                        ?>
                        <div class="col-md-9 col-sm-9 col-xs-12 players">
                            <div class="row">
                                <a href="/<?= $lang ?>/<?= $this->session->userdata('side'); ?>/clan/<?= $clans->clan_id ?>">
                                    <div class="player_avatar2"></div>
                                </a>
                                <div class="info_vivod">
                                    <p>
                                        <a href="/<?= $lang ?>/<?= $this->session->userdata('side'); ?>/clan/<?= $clans->clan_id ?>"><?= $clans->name_clan ?></a>
                                    </p>
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
                                    <p><?= $this->lang->line('lead') ?>: <a
                                            href='/<?= $lang ?>/<?= $this->session->userdata('side') . "/privat_info/" . $leader[0]->user_id ?>'><?= $leader[0]->username ?></a>
                                    </p>
                                </div>
                                <div class="group_buttons2">
                                    <?php
                                    $this->db->where('id_clan', $clans->clan_id);
                                    $this->db->where('id_user', $this->session->userdata('id'));
                                    $us = $this->db->count_all_results('members_clan');
                                    if ($us == 0) {
                                        ?>
                                        <input type="button" class="button_players zayavk"
                                               value="<?= $this->lang->line('leavapp') ?>"
                                               data-info="<?= $clans->clan_id ?>">
                                    <?php } else {
                                        echo '<input type="button" class="button_players"  value="' . $this->lang->line('inclan') . '" >';
                                    }
                                    ?>
                                    <input type="button" class="button_players add_favor"
                                           value="<?= $this->lang->line('add_liked') ?>" data-info="<?= $clans->clan_id ?>">
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
                        <?php
                    }
                }
            }
            else {
                foreach ($clan as $clans) {
                    ?>
                    <div class="col-md-9 col-sm-9 col-xs-12 players">
                        <div class="row">
                            <a href="/<?= $lang ?>/<?= $this->session->userdata('side'); ?>/clan/<?= $clans->clan_id ?>">
                                <div class="player_avatar2"></div>
                            </a>
                            <div class="info_vivod">
                                <p>
                                    <a href="/<?= $lang ?>/<?= $this->session->userdata('side'); ?>/clan/<?= $clans->clan_id ?>"><?= $clans->name_clan ?></a>
                                </p>
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
                                <p><?= $this->lang->line('lead') ?>: <a
                                        href='/<?= $lang ?>/<?= $this->session->userdata('side') . "/privat_info/" . $leader[0]->user_id ?>'><?= $leader[0]->username ?></a>
                                </p>
                            </div>
                            <div class="group_buttons2">
                                <?php
                                $this->db->where('id_clan', $clans->clan_id);
                                $this->db->where('id_user', $this->session->userdata('id'));
                                $us = $this->db->count_all_results('members_clan');
                                if ($us == 0) {
                                    ?>
                                    <input type="button" class="button_players zayavk"
                                           value="<?= $this->lang->line('leavapp') ?>"
                                           data-info="<?= $clans->clan_id ?>">
                                <?php } else {
                                    echo '<input type="button" class="button_players"  value="' . $this->lang->line('inclan') . '" >';
                                }
                                ?>
                                <input type="button" class="button_players add_favor"
                                       value="<?= $this->lang->line('add_liked') ?>" data-info="<?= $clans->clan_id ?>">
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
                    <?php
                }
            }
            ?>



        </div>
    </div>
    
    <div class="container paginat2">
        <?php echo $this->pagination->create_links(); ?>
    </div>
</div>
<script>
    $('.zayavk').click(function () {
        var clan = $(this).data('info');
        $.ajax({
            url: '/clans/whant_clan',
            method: 'post',
            data: {id_user:<?= $this->session->userdata('id') ?>, id_clan:clan},
            success: function () {
                alert("<?=$this->lang->line('send_clan')?>");
            }
        });
    })
</script>
<script>
$('.add_favor').click(function(){
    var id = $(this).data('info');
    $.ajax({
            url: '/privat/clans',
            method: 'POST',
            data: {id_clan:id},
            success: function () {
                alert('<?=$this->lang->line('add_clan')?>');
            }
        });
})
</script>