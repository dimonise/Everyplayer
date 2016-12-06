<?php
defined('BASEPATH') OR exit('No direct script access allowed');

$this->db->where('id_clans', $this->uri->segment(4));
$query = $this->db->get('clan_roles');
$roles = $query->result();
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
            <div class="scroll-pane">
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
									<li><a href="/<?= $lang . '/' . $this->session->userdata('side') ?>/clan_news/<?= $this->uri->segment(4) ?>" style="color: #ff8700;"><?= $this->lang->line('news_clan') ?></a></li>
                                      <?php  if ($rol[0]->id_roles == 1 or $rol[0]->id_roles == 2) {
                                            ?>
                                            <li><a href="/<?= $lang . '/' . $this->session->userdata('side') ?>/recrute/<?= $this->uri->segment(4) ?>"><?= $this->lang->line('recrute_clan') ?></a></li>
                                            <a href="/<?= $lang ?>/<?= $this->session->userdata('side'); ?>/create_news/<?= $this->uri->segment(4) ?>"> <input type="button" name="sozdat_klan" value="Создать новость"></a>
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
                    <div class="col-md-9 col-sm-9 col-xs-12 players_privat">
                        <div class="row">
                            <div class="creat_clan">
                                <form id="im" action="/clans/new_news/<?= $this->uri->segment(4) ?>" method="post" enctype="multipart/form-data">
                                <h4><?=$this->lang->line('cr_news')?></h4>
                                <div class="name_clan">
                                    <p><?=$this->lang->line('nam_news')?></p>
                                    <input type="text" name="name_news" placeholder="Введите название новости"></input>
                                </div>
                                <div class="name_clan">
                                    <p><?=$this->lang->line('nam_news_en')?></p>
                                    <input type="text" name="name_news_en" placeholder="Enter the title news"></input>
                                </div>
                                <div class="opisanie_clan">
                                    <p><?=$this->lang->line('des_news')?></p>
                                    <textarea name="opisanie_news" placeholder="Введите описание новости"></textarea>
                                </div>
                                <div class="opisanie_clan">
                                    <p><?=$this->lang->line('des_news_en')?></p>
                                    <textarea name="opisanie_news_en" placeholder="Enter thу text news"></textarea>
                                </div>
                                <div class="creat_vibor_img">
                                    <p><?=$this->lang->line('im_news')?></p>
                                    
                                        <input type="button" name="creat_vibor_img" class="creat_vibor_img" value="<?=$this->lang->line('se')?>">
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
                                                url: '/clans/img_news',
                                                type: 'POST',
                                                data: data,
                                                cache: false,
                                                dataType: 'json',
                                                processData: false, // Не обрабатываем файлы (Don't process the files)
                                                contentType: false, // Так jQuery скажет серверу что это строковой запрос
                                                success: function (respond) {

                                                    // Если все ОК
                                                    $(".imka").html("<img src='/images/news/" + respond.path + "'>");
                                                    $("path").val(respond.path);

                                                }
                                            })
                                        }
                                    </script>

                                    <input type="hidden" name="path" id="path" value=""> 
                                    <section class="imka"></section>
                                </div>
                                <input type="submit" name="save_creat_clan" value="<?=$this->lang->line('save')?>">
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
