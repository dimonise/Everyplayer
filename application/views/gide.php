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
                <div class="active_menu_middle_image">
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
                <div class="news1">
                    <div class="news_in_header">
                        <div class="col-md-6 col-sm-12 col-xs-12 left">
                            <!--<p><?= $gide[0]->author_gides ?></p>-->
                            <p><?php
                                $arrr = explode(" ", $gide[0]->datas_gides);
                                $arr = explode(":", $arrr[1]);
                                $ar = explode("-", $arrr[0]);
                                $this->load->helper('trans_helper');
                                $name = str_replace(' ', '_', $gide[0]->title_gides);
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
                                <h3><?= $gide[0]->title_en ?></h3>
                                <?php
                }
                else{
                   echo  "<h3>".$gide[0]->title_gides."</h3>";
                }
                ?>
                        </div>
                    </div>
                    <div class="col-md-12 col-sm-12 col-xs-12">
                         <?php
                                                                   
                            if($gide[0]->img_gides != null){
                           echo  '<img src="'.base_url().'images/gides/'.$gide[0]->img_gides.'">';
                            }
                            else{
                                echo $gide[0]->video_gide;
                            }
                                    ?></div>
                        <!--<img src="/images/gides/<?= $gide[0]->img_gides ?>">-->
                    </div>
                    <div class="col-md-12 col-sm-12 col-xs-12 news_in_text">
                        <?php
                           if ($lang != 'en') {
                                
?>                              
                            <h5><?= $gide[0]->text_gides; ?></h5>
                            <?php
                }
                else{
                   echo  "<h3>".$gide[0]->text_en."</h3>";
                }
                ?>
                    </div>
                   
                   
                    <div class="col-md-8 col-sm-8 col-xs-12">
                        <div class="comments_in"><p><span><?=$count_comm?></span><?= $this->lang->line('coms'); ?></p></div>
                        <div class="star_in" onclick="like(<?= $gide[0]->gides_id ?>)"><p><?= $this->lang->line('liked'); ?></p></div>
                        <div class="liked_in"><p><span class="lik"><?=$count_like[0]->caunt?></span><?= $this->lang->line('like'); ?></p></div>
                    </div>
                    <div class="col-md-4 col-sm-4 col-xs-12">
                        <div class="social_icon">
                            <ul>
                                <!--***************************************************FACEBOOK*****************************************************************************************************-->
                                <div id="fb-root"></div>
                                <meta property="og:url"           content="<?= base_url() . $lang ?>/<?= $this->session->userdata('side') ?>/gide_one/<?= $gide[0]->gides_id ?>" />
                                <meta property="og:type"          content="website" />
                                <meta property="og:title"         content="<?= $gide[0]->title_gides; ?>" />
                                <meta property="og:image"         content="<?php echo base_url(); ?>images/gides/<?= $gide[0]->img_gides; ?>" />
                                <a id="share" href="http://www.facebook.com/sharer.php?u=<?= base_url() . $lang ?>/<?= $this->session->userdata('side') ?>/gide_one/<?= $gide[0]->gides_id ?>" onclick="window.open(this.href, this.target, 'width= 500,height=600,scrollbars=1,top=150,left=' + (window.screen.width / 2 - 250));return false;">
                                    <div class="fb"></div>
                                </a>
                                <!--------************************************************************************************************************************************-->
                                <!--***************************************************VK*****************************************************************************************************-->
                                <script type="text/javascript" src="http://vk.com/js/api/share.js?94" charset="windows-1251"></script>

                                <!-- Put this script tag to the place, where the Share button will be -->
                                <a href="http://vk.com/share.php?url=<?= base_url() . $lang ?>/<?= $this->session->userdata('side') ?>/gide_one/<?= $gide[0]->gides_id ?>&title=<?=$segment?>&image=<?php echo base_url(); ?>images/gides/<?= $gide[0]->img_gides; ?>&noparse=true"><div class="vk"></div></a>

                                <!--**********************************************************************************************************************************************************-->                               
                                <!--***************************************************TWITTER*****************************************************************************************************-->
                                    <a href="https://twitter.com/share?url=<?= base_url() . $lang ?>/<?= $this->session->userdata('side') ?>/gide_one/<?= $gide[0]->gides_id ?>&text=<?=$segment?>"  ><div class="tv"></div></a> 
                                <!--------************************************************************************************************************************************-->
                                <!--***************************************************GOOGLE+*****************************************************************************************************-->                                
                                
                                <a href="https://plus.google.com/share?url=<?= base_url() . $lang ?>/<?= $this->session->userdata('side') ?>/gide_one/<?= $gide[0]->gides_id ?>" onclick="javascript:window.open(this.href,
                                                '', 'menubar=no,toolbar=no,resizable=yes,scrollbars=yes,height=600,width=600');
                                        return false;"><div class="gl"></div></a>

                                <!--------************************************************************************************************************************************-->
                                
                            </ul>
                        </div>
                    </div>

                </div>

            </div>
            <div class="row">
            <div class="koment">
            <div class="scroll-pane">
                <div>
                    <div class="col-md-12 col-sm-12 col-xs-12">
                        <h3><?= $this->lang->line('coms'); ?></h3>
                    </div>
                    <?php
                   
                    if ($this->session->userdata('id')) {
                         $this->db->where('user_id', $this->session->userdata('id'));
                        $query = $this->db->count_all_results('user_ban');

                        if ($query < 1) {
                        ?>
                        <div class="napisat_koment">
                            <form action="/gides/new_komm" method="post">
                                <textarea name="text"></textarea>
                                <input type="hidden" value="<?php echo $this->session->userdata('username'); ?>" name="user">
                                <input type="hidden" value="<?php echo $gide[0]->gides_id; ?>" name="id_con">
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
                                    $this->db->where('user_id',$val->id_author);
                                    $query = $this->db->get('users');
                                    $user = $query->result();

                                    if(!empty($user[0]->avatar)){
                                        echo '/images/avatar/'.$user[0]->avatar;
                                    }
                                    else{
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
                                        <p><input type="button" value="<?=$this->lang->line('add_ban')?>" onclick="ban(<?= $user[0]->user_id ?>,<?= $gide[0]->gides_id; ?>)"></p>
                                        <p><input type="button" value="<?=$this->lang->line('del_com')?>" onclick="del_kom(<?= $val->id_komm ?>,<?= $gide[0]->gides_id; ?>)"></p>
                                        <?php
                                        } if ($this->session->userdata('id')) {
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
                                    $this->load->model('gides_model');
                                    $komm = $this->gides_model->get_komm_komm($val->id_komm);

                                    foreach ($komm as $vall) {
                                        ?>
                                        <div class="pod_koment">
                                            <div class="col-md-2 col-sm-2 avatar_width2">
                                                <div class="row">
                                                    <div class="avatar2" style=" background-image: url(<?php
                                    $this->db->where('user_id',$vall->id_author);
                                    $query = $this->db->get('users');
                                    $user = $query->result();

                                    if(!empty($user[0]->avatar)){
                                        echo '/images/avatar/'.$user[0]->avatar;
                                    }
                                    else{
                                        echo '/images/avatar/avatar.jpg';
                                    }
                                    ?>);"></div>
                                                </div>
                                            </div>
                                            <div class="col-md-8 col-sm-8">
                                                <div class="row">
                                                    <div>
                                                        <?= "<p>" . $vall->author_k . "</p><p>" . $vall->datas_k . "</p>"; ?>
                                                    </div>
                                                    <div class="vivod_pod_koment">
                                                        <p><?= $vall->text_k; ?></p>
                                                        <?php
                                        if($this->session->userdata('last_name')=='istrator'){
                                        ?>
                                                        <p><input type="button" value="<?=$this->lang->line('add_ban')?>" onclick="ban(<?= $user[0]->user_id ?>,<?= $gide[0]->gides_id; ?>)"></p>
                                                        <p><input type="button" value="<?=$this->lang->line('del_com')?>" onclick="del_komm(<?= $vall->id_komm_komm ?>,<?= $gide[0]->gides_id; ?>)"></p>
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
    </div>
    <script>
        /*** ответ на комментарий ***/
        $('.otpravit_koment').click(function () {
            var prev_id = $(this).data("infa");
            $(this).replaceWith('<form action="/gides/komm_komm" method="post"><div class="napisat_koment"><textarea class="komentar1" name="text"></textarea></div><input type="hidden" value="<?php echo $this->session->userdata('username'); ?>" name="user"><input type="hidden" value="<?php echo @$gide[0]->gides_id; ?>" name="id_con"><input type="hidden" value="' + prev_id + '" name="id_prev_komm"><div><input type="submit" class="button_koment" value="<?php echo $this->lang->line('repl'); ?>"></div></form>');
        })
    
    /*** подсчет лайков***/
    $('.liked_in').click(function(){
         $.ajax({
                    type: "post",
                    url: "/gides/add_like",
                    data: {
                        id_user: <?=$this->session->userdata('id')?>,
                        id_news: <?=$gide[0]->gides_id?>,
                    },
                    success: function (html) {
                        if(html == 'false'){
                            alert('<?=$this->lang->line('vote_alr')?>');
                        }
                        else{ 
                        $('.lik').text(html);
                        alert('<?=$this->lang->line('vote')?>');
        }
                    }
                });
    })
    
    function ban(x, y) {
            $.ajax({
                type: "post",
                url: "/gides/ban_user",
                data: {id_user: x, id_con: y},
                success: function () {
                    alert("<?=$this->lang->line('ban')?>");
                    location.href = "<?= base_url() . $lang . '/' . $this->session->userdata('side') . '/gide_one/' ?>" + y;
                }
            });
        }
        function del_kom(x, y) {
            $.ajax({
                type: "post",
                url: "/gides/del_kom",
                data: {id_komm: x, id_con: y},
                success: function () {
                    alert("<?=$this->lang->line('del_comm')?>");
                    location.href = "<?= base_url() . $lang . '/' . $this->session->userdata('side') . '/gide_one/' ?>" + y;
                }
            });
        }
        function del_komm(x, y) {
            $.ajax({
                type: "post",
                url: "/gides/del_komm",
                data: {id_komm: x, id_con: y},
                success: function () {
                    alert("<?=$this->lang->line('del_comm')?>");
                    location.href = "<?= base_url() . $lang . '/' . $this->session->userdata('side') . '/gide_one/' ?>" + y;
                }
            });
        }
    
    
    </script>
    <script>
    function like(x) {

        $.ajax({
            url: '/privat/gides',
            method: 'POST',
            data: {id_gides: x},
            success: function () {
                alert('<?=$this->lang->line('gide_liked')?>');
            }
        });
    }
</script>