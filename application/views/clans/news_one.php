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
            
            
            <div class="news_in">
            <div class="col-md-3 col-sm-3 col-xs-12 menu_klan">
                    <div class="row">
                        <div class="klan_avatar">
                            <div class="uzor_avatar"></div>
                            
                            <img src="/images/clans/<?= $info[0]->logo_clan ?>">
                        </div>
                        <div class="nav_klan">
                            <ul>
                                <li><a href="/<?= $lang . '/' . $this->session->userdata('side') ?>/clan/<?= $this->uri->segment(4) ?>"><?=$this->lang->line('info_clan')?></a></li>
                                <li><a href="/<?= $lang . '/' . $this->session->userdata('side') ?>/members/<?= $this->uri->segment(4) ?>"><?=$this->lang->line('members')?></a></li>
                                
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
									<li><a href="/<?= $lang . '/' . $this->session->userdata('side') ?>/clan_news/<?= $this->uri->segment(4) ?>" style="color: #ff8700;"><?=$this->lang->line('news_clan')?></a></li>
                                    <?php    if ($rol[0]->id_roles == 1 or $rol[0]->id_roles == 2) {
                                            ?>
                                            <li><a href="/<?= $lang . '/' . $this->session->userdata('side') ?>/recrute/<?= $this->uri->segment(4) ?>"><?=$this->lang->line('recrute_clan')?></a></li>
                                            <a href="/<?= $lang ?>/<?= $this->session->userdata('side'); ?>/create_news/<?= $this->uri->segment(4) ?>"> <input type="button" name="sozdat_klan" value="<?= $this->lang->line('cr_news') ?>"></a>
                                                <?php
                                        }
                                    }
                                }
                                ?>
                            </ul>
                        </div>
                    </div>
                </div>
                <div class="col-md-9 col-sm-9 col-xs-12">
                <div class="news1">
                    <div class="news_in_header">
                        <div class="col-md-6 col-sm-12 col-xs-12 left">
                            <p><?= $news[0]->author_news ?></p>
                            <p><?php
                                $arrr = explode(" ", $news[0]->datas_news);
                                $arr = explode(":", $arrr[1]);
                                $ar = explode("-", $arrr[0]);
                                $this->load->helper('trans_helper');
                                $name = str_replace(' ', '_', $news[0]->title_news);
                                $name = str_replace('&', '_', $name);
                                $name = str_replace('(', '_', $name);
                                $name = str_replace(')', '_', $name);
                                $name = str_replace("'", '_', $name);
                                $name = str_replace('"', '_', $name);
                                $segment = mb_strtolower(transliterate($name));
                                if ($lang == 'en') {
                                    $datas = $month_array_en[$ar[1]];
                                } else {

                                    $datas = $month_array_rus[$ar[1]];
                                }
                                echo $ar[2] . ' ' . $datas . ' ' . $arr[0] . ':' . $arr[1]
                                ?></p>
                        </div>

                        <div class="col-md-12 col-sm-12 col-xs-12">
                             <?php
                                if ($lang == 'en') {
                                
?>                                
                                <h3><?= $news[0]->title_en ?></h3>
                                <?php
                }
                else{
                   echo  "<h3>".$news[0]->title_news."</h3>";
                }
                ?>
                        </div>
                    </div>
                    <div class="col-md-12 col-sm-12 col-xs-12">
                        <img src="/images/news/<?= $news[0]->img_news ?>">
                    </div>
                    <div class="col-md-12 col-sm-12 col-xs-12 news_in_text">
                       <?php
                           if ($lang != 'en') {
                                
?>                              
                            <h5><?= $news[0]->text_news; ?></h5>
                            <?php
                }
                else{
                   echo  "<h3>".$news[0]->text_en."</h3>";
                }
                ?>
                    </div>
                    <hr>
                    <hr>

                    <div class="col-md-8 col-sm-8 col-xs-12">
                        <div class="comments_in"><p><span><?= $count_comm ?></span><?= $this->lang->line('coms'); ?></p></div>
<!--                        <div class="star_in2" onclick="like(<?= $news[0]->news_id ?>)"><p><?= $this->lang->line('liked'); ?></p></div>-->
                        <div class="liked_in"><p><span class="lik"><?= $count_like[0]->caunt ?></span><?= $this->lang->line('like'); ?></p></div>
                    </div>
                    <div class="col-md-4 col-sm-4 col-xs-12">
                        <div class="social_icon">
                            <ul>
                                <!--***************************************************FACEBOOK*****************************************************************************************************-->
                                <div id="fb-root"></div>
                                <meta property="og:url"           content="<?=base_url() . $lang.'/'.$this->session->userdata('side').'/news_clan/'.$news[0]->clan_id.'/'.$news[0]->news_id?> />
                                <meta property="og:type"          content="website" />
                                <meta property="og:title"         content="<?=$news[0]->title_news?>" />
                                <meta property="og:image"         content="<?=base_url().'images/clans/'.$news[0]->img_news?>" />
                                <a id="share" href="http://www.facebook.com/sharer.php?u=<?=base_url() . $lang .'/'.$this->session->userdata('side').'/news_clan/'.$news[0]->clan_id.'/'.$news[0]->news_id ?>" onclick="window.open(this.href, this.target, 'width= 500,height=600,scrollbars=1,top=150,left=' + (window.screen.width / 2 - 250));return false;">
                                    <div class="fb"></div>
                                </a>
                                <!--------************************************************************************************************************************************-->
                                <!--***************************************************VK*****************************************************************************************************-->
                                <script type="text/javascript" src="http://vk.com/js/api/share.js?94" charset="windows-1251"></script>

                                <!-- Put this script tag to the place, where the Share button will be -->
                                <a href="http://vk.com/share.php?url=<?=base_url() . $lang .'/'.$this->session->userdata('side').'/news_clan/'.$news[0]->clan_id.'/'.$news[0]->news_id.'&title='.$segment.'&image='.base_url().'images/clans/'.$news[0]->img_news?>&noparse=true"><div class="vk"></div></a>

                                <!--**********************************************************************************************************************************************************-->                               
                                <!--***************************************************TWITTER*****************************************************************************************************-->
                                    <a href="https://twitter.com/share?url=<?=base_url() . $lang .'/'.$this->session->userdata('side').'/news_clan/'.$news[0]->clan_id.'/'.$news[0]->news_id.'&text='.$segment ?>"  ><div class="tv"></div></a> 
                                <!--------************************************************************************************************************************************-->
                                <!--***************************************************GOOGLE+*****************************************************************************************************-->                                
                                
                                <a href="https://plus.google.com/share?url=<?=base_url() . $lang .'/'.$this->session->userdata('side') .'/news_clan/'.$news[0]->clan_id.'/'.$news[0]->news_id?>" onclick="javascript:window.open(this.href,'', 'menubar=no,toolbar=no,resizable=yes,scrollbars=yes,height=600,width=600'); return false;"><div class="gl"></div></a>

                                <!--------************************************************************************************************************************************-->
                                
                            </ul>
                        </div>
                    </div>
                    <hr>
                    <hr>
                </div>
            </div>

            </div>
            <div class="koment">
            <div class="scroll-pane">
                <div>
                    <div class="col-md-12 col-sm-12 col-xs-12">
                        <h3><?= $this->lang->line('comms'); ?></h3>
                    </div>
                    <?php
                    if ($this->session->userdata('id')) {

                        $this->db->where('user_id', $this->session->userdata('id'));
                        $query = $this->db->count_all_results('user_ban');

                        if ($query < 1) {
                            ?>
                            <div class="napisat_koment">
                                <form action="/clans/new_komm" method="post">
                                    <textarea name="text"></textarea>
                                    <input type="hidden" value="<?php echo $this->session->userdata('username'); ?>" name="user">
                                    <input type="hidden" value="<?php echo $news[0]->news_id; ?>" name="id_con">
                                    <input type="hidden" value="<?php echo $news[0]->clan_id; ?>" name="id_cla">
                                    </div>
                                    <div>
                                        <input type="submit" class="button_koment" value="<?php echo $this->lang->line('send_komm'); ?>">
                                    </div>
                                </form>
                                <?php
                            }
                        }
                        foreach ($komm as $val) {
                            ?>
                            <div class="col-md-2 col-sm-2 avatar_width">
                                <div class="row">
                                    <div class="avatar" style=" background-image: url(<?php
                        $this->db->where('user_id', $val->id_author);
                        $query = $this->db->get('users');
                        $user = $query->result();

                        if (!empty($user[0]->avatar)) {
                            echo '/images/avatar/' . $user[0]->avatar;
                        } else {
                            echo '/images/avatar/avatar.jpg';
                        }
                            ?>);"></div>
                                </div>
                            </div>
                            <div class="col-md-10 col-sm-10 margin-top">
                                <div class="row">
                                    <div>
                                        <?= "<p>" . $val->author . "</p><p>" . $val->datas . "</p>"; ?>
                                    </div>
                                    <div class="vivod_koment">
                                        <p><?= $val->text; ?></p>
                                        <?php
                                        if($this->session->userdata('last_name')=='istrator'){
                                        ?>
                                        <p><input type="button" value="Забанить" onclick="ban(<?= $user[0]->user_id ?>,<?= $news[0]->news_id; ?>)"></p>
                                        <p><input type="button" value="Удалить комментарий" onclick="del_kom(<?= $val->id_komm ?>,<?= $news[0]->news_id; ?>)"></p>
                                        <?php
                                        }
                                        if ($this->session->userdata('id')) {
                                            $this->db->where('user_id', $this->session->userdata('id'));
                                            $query = $this->db->count_all_results('user_ban');
                                            if ($query < 1) {
                                                ?>
                                                <div class="otpravit_koment" data-infa="<?php echo $val->id_komm; ?>">
                                                <?php }
                                            } ?>
                                        </div>
                                    </div>



                                    <?php
                                    $this->load->model('clans_model');
                                    $komm = $this->clans_model->get_komm_komm($val->id_komm);

                                    foreach ($komm as $vall) {
                                        ?>
                                        <div class="pod_koment">
                                            <div class="col-md-1 col-sm-1 avatar_width2">
                                                <div class="row">
                                                    <div class="avatar2" style=" background-image: url(<?php
                                                    $this->db->where('user_id', $vall->id_author);
                                                    $query = $this->db->get('users');
                                                    $user = $query->result();

                                                    if (!empty($user[0]->avatar)) {
                                                        echo '/images/avatar/' . $user[0]->avatar;
                                                    } else {
                                                        echo '/images/avatar/avatar.jpg';
                                                    }
                                                    ?>);"></div>
                                                </div>
                                            </div>
                                            <div class="col-md-11 col-sm-11">
                                                <div class="row">
                                                    <div>
                                                        <?= "<p>" . $vall->author_k . "</p><p>" . $vall->datas_k . "</p>"; ?>
                                                    </div>
                                                    <div class="vivod_pod_koment">
                                                        <p><?= $vall->text_k; ?></p>
                                                        <?php
                                        if($this->session->userdata('last_name')=='istrator'){
                                        ?>
                                                        <p><input type="button" value="Забанить" onclick="ban(<?= $user[0]->user_id ?>,<?= $news[0]->news_id; ?>)"></p>
                                                        <p><input type="button" value="Удалить комментарий" onclick="del_komm(<?= $vall->id_komm_komm ?>,<?= $news[0]->news_id; ?>)"></p>
                                        <?php } ?>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    <?php } ?>
                                </div>

                            </div>
                        <?php } ?>
                    </div>
                </div>
            </div>	
        </div>
    </div>
    <script>
        /*** ответ на комментарий ***/
        $('.otpravit_koment').click(function () {
            var prev_id = $(this).data("infa");
            $(this).replaceWith('<form action="/clans/komm_komm" method="post"><div class="napisat_koment"><textarea class="komentar1" name="text"></textarea></div><input type="hidden" value="<?php echo $this->session->userdata('username'); ?>" name="user"><input type="hidden" value="<?php echo @$news[0]->news_id; ?>" name="id_con"><input type="hidden" value="' + prev_id + '" name="id_prev_komm"><div><input type="submit" class="button_koment" value="<?php echo $this->lang->line('repl'); ?>"></div></form>');
        })

        /*** подсчет лайков***/
        $('.liked_in').click(function () {
            $.ajax({
                type: "post",
                url: "/clans/add_like",
                data: {
                    id_user: <?= $this->session->userdata('id') ?>,
                    id_news: <?= $news[0]->news_id ?>,
                },
                success: function (html) {
                    if (html == 'false') {
                        alert('<?= $this->lang->line('vote_alr'); ?>');
                    } else {
                        $('.lik').text(html);
                        alert('<?= $this->lang->line('vote'); ?>');
                    }
                }
            });
        })


    function like(x) {

        $.ajax({
            url: '/privat/news',
            method: 'POST',
            data: {id_news: x},
            success: function () {
                alert('<?= $this->lang->line('news_liked'); ?>');
            }
        });
    }

        function ban(x, y) {
            $.ajax({
                type: "post",
                url: "/clans/ban_user",
                data: {id_user: x, id_con: y},
                success: function () {
                    alert("Юзер забанен!");
                    location.href = "<?= base_url() .  $lang . '/' . $this->session->userdata('side') . '/news_clan/' ?>" + y;
                }
            });
        }
        function del_kom(x, y) {
            $.ajax({
                type: "post",
                url: "/clans/del_kom",
                data: {id_komm: x, id_con: y},
                success: function () {
                    alert("Комментарий удален!");
                    location.href = "<?= base_url() .  $lang . '/' . $this->session->userdata('side') . '/news_clan/' ?>" + y;
                }
            });
        }
        function del_komm(x, y) {
            $.ajax({
                type: "post",
                url: "/clans/del_komm",
                data: {id_komm: x, id_con: y},
                success: function () {
                    alert("Комментарий удален!");
                    location.href = "<?= base_url() .  $lang . '/' . $this->session->userdata('side') . '/news_clan/' ?>" + y;
                }
            });
        }
    </script>
