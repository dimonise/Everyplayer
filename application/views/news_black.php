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
</div>
<div class="container">
    <div class="news-top-bg row">
        <div class="picLeft"></div>
        <div class="picRight"></div>
            <div class="news_in bg-rep">
                <div class="news1">
                    <div class="news_in_header">
                        <div class="col-md-6 col-sm-12 col-xs-12 left">
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
                        <div class="star_in" onclick="like(<?= $news[0]->news_id ?>)"><p><?= $this->lang->line('liked'); ?></p></div>
                        <div class="liked_in" ><p><span class="lik"><?= $count_like[0]->caunt ?></span><?= $this->lang->line('like'); ?></p></div>
                    </div>
                    <div class="col-md-4 col-sm-4 col-xs-12">
                        <div class="social_icon">
                            <ul>
                                <!--***************************************************FACEBOOK*****************************************************************************************************-->
                                <div id="fb-root"></div>
                                <meta property="og:url"           content="<?= base_url() . $lang ?>/<?= $this->session->userdata('side') ?>/news/<?= $news[0]->news_id ?>" />
                                <meta property="og:type"          content="website" />
                                <meta property="og:title"         content="<?= $news[0]->title_news; ?>" />
                                <meta property="og:image"         content="<?php echo base_url(); ?>images/news/<?= $news[0]->img_news; ?>" />
                                <a id="share" href="http://www.facebook.com/sharer.php?u=<?= base_url() . $lang ?>/<?= $this->session->userdata('side') ?>/news/<?= $news[0]->news_id ?>" onclick="window.open(this.href, this.target, 'width= 500,height=600,scrollbars=1,top=150,left=' + (window.screen.width / 2 - 250));return false;">
                                    <div class="fb"></div>
                                </a>
                                <!--------************************************************************************************************************************************-->
                                <!--***************************************************VK*****************************************************************************************************-->
                                <script type="text/javascript" src="http://vk.com/js/api/share.js?94" charset="windows-1251"></script>

                                <!-- Put this script tag to the place, where the Share button will be -->
                                <a href="http://vk.com/share.php?url=<?= base_url() . $lang ?>/<?= $this->session->userdata('side') ?>/news/<?= $news[0]->news_id ?>&title=<?=$segment?>&image=<?php echo base_url(); ?>images/news/<?= $news[0]->img_news; ?>&noparse=true"><div class="vk"></div></a>

                                <!--**********************************************************************************************************************************************************-->
                                <!--***************************************************TWITTER*****************************************************************************************************-->
                                    <a href="https://twitter.com/share?url=<?= base_url() . $lang ?>/<?= $this->session->userdata('side') ?>/news/<?= $news[0]->news_id ?>&text=<?=$segment?>"  ><div class="tv"></div></a>
                                <!--------************************************************************************************************************************************-->
                                <!--***************************************************GOOGLE+*****************************************************************************************************-->

                                <a href="https://plus.google.com/share?url=<?= base_url() . $lang ?>/<?= $this->session->userdata('side') ?>/news/<?= $news[0]->news_id ?>" onclick="javascript:window.open(this.href,
                                                '', 'menubar=no,toolbar=no,resizable=yes,scrollbars=yes,height=600,width=600');
                                        return false;"><div class="gl"></div></a>

                                <!--------************************************************************************************************************************************-->
                                </ul>
                        </div>
                    </div>
                    <hr>
                    <hr>
                </div>

            </div>
            <div class="koment">
            <div class="scroll-pane">
                <div>
                    <div class="col-md-12 col-sm-12 col-xs-12">
                        <h3><?= $this->lang->line('coms'); ?></h3>
                    </div>

                    <?php
                    if ($this->session->userdata('id'))
                    {

                        $this->db->where('user_id', $this->session->userdata('id'));
                        $query = $this->db->count_all_results('user_ban');

                        if ($query < 1)
                            {
                            ?>
                                <form action="/home/new_komm" method="post">
                                    <div class="napisat_koment">
                                        <textarea name="text"></textarea>
                                        <input type="hidden" value="<?php echo $this->session->userdata('username'); ?>" name="user">
                                        <input type="hidden" value="<?php echo $news[0]->news_id; ?>" name="id_con">
                                    </div>

                                    <div>
                                        <input type="submit" class="button_koment" value="<?php echo $this->lang->line('send_komm'); ?>">
                                    </div>
                                </form>
                            <?php
                            }
                    }
                    ?>




                    <?php
                    foreach ($komm as $val)
                    {
                    ?>
                        <div class="row main-comment">

                            <div class="col-md-2 comment-img">
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

                            <div class="col-md-8 comment-txt">
                                <?= "<p>" . $val->author . "</p><p>" . $val->datas . "</p>"; ?>
                                <p><?= $val->text; ?></p>

                                <?php




                                    if ($this->session->userdata('last_name') == 'istrator') {
                                    ?>
                                        <!--<p><input type="button" value="<?=$this->lang->line('add_ban')?>" onclick="ban(<?= $user[0]->user_id ?>,<?= $news[0]->news_id; ?>)"></p>-->
                                        <p><input type="button" value="<?=$this->lang->line('del_com')?>" onclick="del_kom(<?= $val->id_komm ?>,<?= $news[0]->news_id; ?>)"></p>
                                <?php
                                }
                                ?>


                                <div class="otpravit_koment" id="target" data-infa="<?php echo $val->id_komm; ?>"></div>

                                <?php
                                $this->load->model('news_model');
                                $komm = $this->news_model->get_komm_komm($val->id_komm);

                                foreach ($komm as $vall)
                                {
                                ?>
                                    <div class="row reply-main-comment">
                                        <div class="col-md-2 reply-comment-img">
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
                                        <div class="col-md-10 reply-comment-txt">
                                            <?= "<p>" . $vall->author_k . "</p><p>" . $vall->datas_k . "</p>"; ?>
                                            <p><?= $vall->text_k; ?></p>

                                            <?php
                                            if ($this->session->userdata('last_name') == 'istrator') {
                                                ?>
                                                <!--<p><input type="button" value="<?=$this->lang->line('add_ban')?>" onclick="ban(<?= $user[0]->user_id ?>,<?= $news[0]->news_id; ?>)"></p>-->
                                                <p><input type="button" value="<?=$this->lang->line('del_com')?>" onclick="del_komm(<?= $vall->id_komm_komm ?>,<?= $news[0]->news_id; ?>)"></p>
                                            <?php } ?>


                                        </div>

                                    </div>

                                <?php
                                }
                                ?>

                            </div>

                        </div>



                    <?php
                    }
                    ?>



                </div>
            </div>
        </div>
    </div>
    </div>

    <script>

        $( ".otpravit_koment" ).click(function() {
            var prev_id = $(this).data("infa");

            //alert(prev_id);
            $(this).replaceWith('<form action="/home/komm_komm" method="post"><div class="napisat_koment"><textarea class="komentar1" name="text"></textarea></div><input type="hidden" value="<?php echo $this->session->userdata('username'); ?>" name="user"><input type="hidden" value="<?php echo @$news[0]->news_id; ?>" name="id_con"><input type="hidden" value="' + prev_id + '" name="id_prev_komm"><div><input type="submit" class="button_koment" value="<?php echo $this->lang->line('repl'); ?>"></div></form>');
        });



        function del_komm(x, y)
        {

            alert(x);
            /*
            $.ajax({
                type: "post",
                url: "/home/del_komm",
                data: {id_komm: x, id_con: y},
                success: function () {
                    alert("<?=$this->lang->line('del_comm')?>");
                    location.href = "<?= base_url() . $lang . '/' . $this->session->userdata('side') . '/news/' ?>" + y;
                }
            });*/
        }



        /*** подсчет лайков***/
/*
        $('.liked_in').click(function () {
            $.ajax({
                type: "post",
                url: "/home/add_like",
                data: {
                    id_user: <?= $this->session->userdata('id') ?>
                    id_news: <?= $news[0]->news_id ?>
                },
                success: function (html) {
                    if (html == 'false') {
                        alert('<?=$this->lang->line('vote_alr')?>');
                    } else {
                        $('.lik').text(html);
                        alert('<?=$this->lang->line('vote')?>');
                    }
                }
            });
        })
 */
/*
        function ban(x, y) {
            $.ajax({
                type: "post",
                url: "/home/ban_user",
                data: {id_user: x, id_con: y},
                success: function () {
                    alert("<?=$this->lang->line('ban')?>");
                    location.href = "<?= base_url() . $lang . '/' . $this->session->userdata('side') . '/news/' ?>" + y;
                }
            });
        }
        function del_kom(x, y) {
            $.ajax({
                type: "post",
                url: "/home/del_kom",
                data: {id_komm: x, id_con: y},
                success: function () {
                    alert("<?=$this->lang->line('del_comm')?>");
                    location.href = "<?= base_url() . $lang . '/' . $this->session->userdata('side') . '/news/' ?>" + y;
                }
            });
        }
        */
    </script>

<script>/*
    function like(x) {

        $.ajax({
            url: '/privat/news',
            method: 'POST',
            data: {id_news: x},
            success: function () {
                alert('<?=$this->lang->line('news_liked')?>');
            }
        });
    }*/
</script>