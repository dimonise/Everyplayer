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
                            <li ><a href="" style="color: #ff8700;"><?=$this->lang->line('info_clan')?></a></li>
                            <li><a href="/<?= $lang . '/' . $this->session->userdata('side') ?>/members/<?= $this->uri->segment(4) ?>"><?=$this->lang->line('members')?></a></li>
                            
                            <?php
                            $rol = null;
                            if ($this->session->userdata('id')) {
                                $us = $this->session->userdata('id');
                                $cl = $this->uri->segment(4);
                                $this->db->where('id_user', $us);
                                $this->db->where('id_clans', $cl);
                                $q = $this->db->get('clan_roles');
                                $rol = $q->result();
                                if ($rol != null) {
								?>
								<li><a href="/<?= $lang . '/' . $this->session->userdata('side') ?>/clan_news/<?= $this->uri->segment(4) ?>"><?=$this->lang->line('news_clan')?></a></li>
								<?php
                                    if ($rol[0]->id_roles == 1 or $rol[0]->id_roles == 2) {
                                        ?>
                                        <li><a href="/<?= $lang . '/' . $this->session->userdata('side') ?>/recrute/<?= $this->uri->segment(4) ?>"><?=$this->lang->line('recrute_clan')?></a></li>
                                    <?php
                                    }
                                }
                            }
                            ?>
                        </ul>
                    </div>

                </div>
            </div>
            <div class="otstyp_klan">
                <div class="col-md-9 col-sm-9 col-xs-12 klan_info">
                    <div class="row">
                        <h3><?= $info[0]->name_clan ?></h3>
                        <?php
                        if ($rol != null) {
                            if ($rol[0]->id_user == $this->session->userdata('id') and $rol[0]->id_roles == 1) {
                                ?> 
                                <div class="pencil"></div>
                                <?php
                            }
                        }
                        ?>
                        <p>
<?= $info[0]->descr_clan ?>
                        </p>
                        <p><span><?=$this->lang->line('game_clan')?></span></p>
                        <div class="igri_klana">
                            <?php
                                $this->db->select('*');
                                $this->db->from('link_games_clans');
                                $this->db->join('favorite_games', 'favorite_games.games_id = link_games_clans.id_games', 'left');
                                $this->db->where('link_games_clans.id_clans', $this->uri->segment(4));
                                $query = $this->db->get();
                               
                               foreach($query->result() as $res){
                                ?>
                                <img src="/images/games/<?= $res->games_img ?>">
                               <?php } ?>
                        </div>
                        <?php
                        $this->db->where('id_clan',$this->uri->segment(4));
                            $this->db->where('id_user',$this->session->userdata('id'));
                            $us = $this->db->count_all_results('members_clan');
                            if($us == 0){
                       echo '<input class="zayavka" type="button" value="подать заявку">';
                            }
                            ?>
                    </div>
                </div>
            </div>
        </div>
    </div>	
</div>
<!--ПОПАП НАПИСАТЬ СООБЩЕНИЕ-->
<div id="popup_pencil">

    <div class="container">
        <div class="row">
            <button class="close" title="Закрыть" onclick="document.getElementById('popup_pencil').style.display = 'none';">
                <img alt="" src="/images/close.png">
            </button>
            <div class="popup_podlogka2">
                <h4>Информация клана</h4>
                <form id="topInfo" method="post" action="/clans/update_clan_info/<?= $this->uri->segment(4) ?>">
                    <input type="text" class="popup_input" placeholder="Название клана" value="" id="name_clan" name="name_clan">
                    <textarea class="popup_textarea" placeholder="Информация" id="descr_clan" name="descr_clan"></textarea>

                    <div class="no-select">
                        <link rel="stylesheet" href="//cdnjs.cloudflare.com/ajax/libs/select2/4.0.1/css/select2.min.css">
                        <script src="//cdnjs.cloudflare.com/ajax/libs/select2/4.0.1/js/select2.js"></script>
                        <script src="/js/selection.js"></script>
                        <script>
                $(document).ready(function () {
                    $(".limitedNumbSelect3").select2({
                    });
                })
                        </script>
                        <div class="favorit_games">
                            <select class="limitedNumbSelect3" multiple="true" name="games_clan[]" >

                                <?php
                                for ($i = 0; $i < count($arr); $i++) {
                                    $this->db->where('games_id', $arr[$i]);
                                    $query = $this->db->get('favorite_games');
                                    $res = $query->result();
                                    echo "<option value='" . $res[0]->games_id . "' selected>" . $res[0]->games_name . "</option>";
                                }
                                foreach ($games as $game) {
                                    echo '<option value="' . $game->games_id . '">' . $game->games_name . '</option>';
                                }
                                ?>
                            </select>
                        </div>
                    </div>
                    <input class="popup_button" type="submit" value="сохранить изменения">
                </form>
                <div class="avatar_moder_pop">
                    <form method="post" action="/clans/update_avatar/<?= $this->uri->segment(4) ?>" enctype="multipart/form-data">
                        <h4>Аватар</h4>
                        <img src="/images/clans/<?= $info[0]->logo_clan ?>">
                        <input id="userfile" name="userfile" type="file" style="position:absolute; top:-999px; visibility:hidden" accept="image/*"/>
                        <input class="vibor_fail" type="button" value="Выбрать фаил" id="edit_avatar">
                        <script>
                            var input = document.querySelector("#userfile");
                            var btn = document.querySelector("#edit_avatar");
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
                        <!-- <div class="ssilka_moder_pop">
                             <p>путь к файлу</p>
                             <input type="text" class="ssilka_na_fail"  value="">
                             <input class="popup_button2" type="button" value="Сохранить">
                             
                         </div>--></form>
                </div>
                <div class="smena_glovi">
                    <h4>Сменить главу клана</h4> 
                    <form action="/clans/glova/<?= $this->uri->segment(4) ?>" method="post">
                        <div class="vibor_players">
                            <select name="usery">
                                <option>укажите ссылку на профиль</option>
                                <?php
                                var_dump($users);
                                foreach ($users as $user) {
                                    echo "<option value='" . $user->user_id . "'>" . $user->username . "</option>";
                                }
                                ?>
                            </select>
                        </div>
                        <input class="popup_button3" type="submit" value="Сохранить">
                    </form>
                </div>

            </div>

        </div>
    </div>
</div>
<!--КОНЕЦ ПОПАП-->
<div class="cover"></div>

<script>
    $(function () {
        $(".pencil").click(function () {
            $(".cover").css('display', 'block');
        })
    })
</script>
<script>
    $(function () {
        $(".close").click(function () {
            $(".cover").css('display', 'none');
        })
    })
</script>

<script>
    /**ДЛЯ Редактирования КЛАНА**/
    $(function () {
        $(".pencil").click(function () {
            $("#popup_pencil").css('display', 'block');
            $.ajax({
                url: '/clans/get_info',
                method: 'post',
                dataType: "json",
                data: {id_clan:<?= $this->uri->segment(4) ?>},
                success: function (data) {
                    console.log(data.name_clan);
                    $('#name_clan').val(data.name_clan);
                    $('#descr_clan').text(data.descr_clan);

                }
            });
        })
    })
</script>

<script>
    $('.zayavka').click(function () {
        $.ajax({
            url: '/clans/whant_clan',
            method: 'post',
            data: {id_user:<?= $this->session->userdata('id') ?>, id_clan:<?= $this->uri->segment(4) ?>},
            success: function () {
                alert("Заявка на вступление в клан отправлена");
            }
        });
    })
</script>
<script>

</script>