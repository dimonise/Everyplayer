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
                            </ul>
                        </div>

                    </div>
                </div>
                <div class="otstyp_klan">
                    <div class="col-md-9 col-sm-9 col-xs-12 players_privat">
                        <div class="row">
                            <div class="creat_clan">
                                <h4><?= $this->lang->line('cr_clan') ?></h4>
                                <form id="down_ava" action="/privat/save_clan/<?= $this->session->userdata('id') ?>" enctype="multipart/form-data" method="post">
                                    <input type="button" name="creat_vibor_img" class="creat_vibor_img" value="<?= $this->lang->line('se') ?>">
                                    <input id="userfile" name="userfile" type="file" style="position:absolute; top:-999px; visibility:hidden" accept="image/*"/>

                                    <script>
                                        var input = document.querySelector("#userfile");
                                        var btn = document.querySelector(".creat_vibor_img");
                                        btn.onclick = function () {
                                            input.click();
                                        };
                                    </script>
                                    <script>
                                        var input = document.querySelector("input[type='file']");
                                        input.onchange = function () {

                                            event.stopPropagation(); // Остановка происходящего
                                            event.preventDefault();  // Полная остановка происходящего
                                            $("#path").val(this.value);

                                            // Создадим данные формы и добавим в них данные файлов из files

                                            var data = new FormData();
                                            data.append('userfile', input.files[0]);
                                            // Отправляем запрос

                                            $.ajax({
                                                url: '/privat/img_cla',
                                                type: 'POST',
                                                data: data,
                                                cache: false,
                                                dataType: 'json',
                                                processData: false, // Не обрабатываем файлы (Don't process the files)
                                                contentType: false, // Так jQuery скажет серверу что это строковой запрос
                                                success: function (respond) {

                                                    // Если все ОК
                                                    $(".imka").html("<img src='/images/clans/" + respond.path + "'>");
                                                    $("path").val(respond.path);

                                                }
                                            })
                                        }
                                    </script>

                                    <input type="hidden" name="path" id="path" value=""> 
                                    <section class="imka"></section>
                                    <div class="name_clan">
                                        <p><?= $this->lang->line('name_clan') ?></p>
                                        <input type="text" name="name_clan" placeholder="<?= $this->lang->line('name_clan') ?>"></input>
                                    </div>
                                    <div class="opisanie_clan">
                                        <p><?= $this->lang->line('des_clan') ?></p>
                                        <textarea name="opisanie_clan" placeholder="<?= $this->lang->line('des_clan') ?>"></textarea>
                                    </div>
                                    <div class="games_clan">
                                        <p><?= $this->lang->line('gam_clan') ?></p>
                                        <div class="no-select">
                                            <div class="select_game_clan">
                                                <link rel="stylesheet" href="//cdnjs.cloudflare.com/ajax/libs/select2/4.0.1/css/select2.min.css">
                                                <script src="//cdnjs.cloudflare.com/ajax/libs/select2/4.0.1/js/select2.min.js"></script>
                                                <script src="/js/selection.js"></script>
                                                <select class="limitedNumbSelect2" multiple="true" name="game[]">
                                                    <?php
                                                    $query = $this->db->get('favorite_games');
                                                    foreach ($query->result() as $game) {
                                                        ?>
                                                        <option value="<?= $game->games_id ?>"><?= $game->games_name ?></option>
                                                        <?php
                                                    }
                                                    ?>             
                                                </select>
                                            </div>
                                        </div>
                                    </div>
                                    <input type="submit" name="save_creat_clan" value="<?= $this->lang->line('save') ?>">
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