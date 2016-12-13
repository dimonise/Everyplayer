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
            <div class="scroll-pane">
                <div class="col-md-12 col-sm-12 col-xs-12">
                    <div class="vibor_head">
                        <div class="flex-container2">
                            <div class="vibor_game2">
                                <select onchange="sel_gides()" id="game">
                                    <option><?= $this->lang->line('sel_games') ?></option>
                                    <?php
                                    foreach ($favor_all as $fav_all) {
                                        echo "<option value='" . $fav_all->games_id . "'>" . $fav_all->games_name . "</option>";
                                    }
                                    ?>
                                </select>
                            </div>
                            <div class="vivod_liked_games">
                                <?php
                                foreach ($favor as $fav) {
                                    echo "<a href='/" . $lang . "/" . $this->session->userdata('side') . "/gide/" . $fav->games_id . "'><img src='/images/games/" . $fav->games_img . "' ></a>";
                                }
                                ?>
                            </div>
                        </div>
                    </div>
                </div>

                <?php
                foreach ($gides as $new) {
                    ?>		

                    <div class="news1">
                        <div class="news_header">
                            <div class="col-md-6 col-sm-12 col-xs-12 left">
                                <!--<p><?= $new->author_gides; ?></p>-->
                                
                                <?php
                                $arrr = explode(" ", $new->datas_gides);
                                $arr = explode(":", $arrr[1]);
                                $ar = explode("-", $arrr[0]);
                                $this->load->helper('trans_helper');
                                $name = str_replace(' ', '_', $new->title_gides);
                                $name = str_replace('&', '_', $name);
                                $name = str_replace('(', '_', $name);
                                $name = str_replace(')', '_', $name);
                                $name = str_replace("'", '_', $name);
                                $name = str_replace('"', '_', $name);
                                $name = str_replace('!', '_', $name);
                                $segment = mb_strtolower(transliterate($name));

                                if ($lang == 'en') {
                                    $datas = $month_array_en[$ar[1]];
                                } else {

                                    $datas = $month_array_rus[$ar[1]];
                                }
                                echo '<p>' . $ar[2] . ' ' . $datas . ' ' . $arr[0] . ':' . $arr[1] . '</p>';
                                ?>

                            </div>
                            <div class="col-md-6 col-sm-12 col-xs-12 right">
                                <div class="comments"><p><?php
                                        $this->db->where('id_trek', $new->gides_id);
                                        echo $this->db->count_all_results('komm_gides') . " ";
                                        ?></p></div>
                                <div class="liked" onclick="like(<?= $new->gides_id ?>)"><p >&nbsp;</p></div>
                            </div>
                            <div class="col-md-12 col-sm-12 col-xs-12">
                                <?php
								$this->db->where('games_id', $new->cat_gides);
								$gets = $this->db->get('favorite_games');
								$im = $gets->result();
								echo "<img src='/images/games/".$im[0]->games_img."' style='height:50px;width:50px;float:left;'>";
                                if ($lang == 'en') {
                                    ?>                                
                                    <h3 style="text-align: left; padding-left: 60px;"><a href='/<?= $lang ?>/<?= $this->session->userdata('side') ?>/gide_one/<?= $new->gides_id ?>/<?= $segment ?>'><?= $new->title_en ?></a></h3>
                                    <?php
                                } else {
								?>
                                    <h3 style="text-align: left; padding-left: 60px;"><a href='/<?= $lang ?>/<?= $this->session->userdata('side') ?>/gide_one/<?= $new->gides_id ?>/<?= $segment ?>'><?=$new->title_gides?></a></h3>
                               <?php }
                                ?>
                            </div>
                        </div>
                        <div class="col-md-12 col-sm-12 col-xs-12">
                            <?php
                            if ($new->img_gides != null) {
                                echo '<img src="' . base_url() . 'images/gides/' . $new->img_gides . '">';
                            } else {
                                echo $new->video_gide;
                            }
                            ?></div>
                        <div class="col-md-12 col-sm-12 col-xs-12 gides_text">
                            <?php
                            if ($lang != 'en') {
                                ?>                              
                                <h5><p><?= $new->text_gides; ?></p></h5>
                                <?php
                            } else {
                                echo "<h3>" . $new->text_en . "</h3>";
                            }
                            ?>
                        </div>
                        <div class="col-md-6 col-sm-6 col-xs-12">
                            <div class="social_icon">
                                <ul>
                                    <!--***************************************************FACEBOOK*****************************************************************************************************-->
                                    <div id="fb-root"></div>
                                    <meta property="og:url"           content="<?= base_url() . $lang ?>/<?= $this->session->userdata('side') ?>/gide_one/<?= $new->gides_id ?>" />
                                    <meta property="og:type"          content="website" />
                                    <meta property="og:title"         content="<?= $new->title_gides; ?>" />
                                    <meta property="og:image"         content="<?php echo base_url(); ?>images/gides/<?= $new->img_gides; ?>" />
                                    <a id="share" href="http://www.facebook.com/sharer.php?u=<?= base_url() . $lang ?>/<?= $this->session->userdata('side') ?>/gide_one/<?= $new->gides_id ?>" onclick="window.open(this.href, this.target, 'width= 500,height=600,scrollbars=1,top=150,left=' + (window.screen.width / 2 - 250));return false;">
                                        <div class="fb"></div>
                                    </a>
                                    <!--------************************************************************************************************************************************-->
                                    <!--***************************************************VK*****************************************************************************************************-->
                                    <script type="text/javascript" src="http://vk.com/js/api/share.js?94" charset="windows-1251"></script>

                                    <!-- Put this script tag to the place, where the Share button will be -->
                                    <a href="http://vk.com/share.php?url=<?= base_url() . $lang ?>/<?= $this->session->userdata('side') ?>/gide_one/<?= $new->gides_id ?>&title=<?= $segment ?>&image=<?php echo base_url(); ?>images/gides/<?= $new->img_gides; ?>&noparse=true"><div class="vk"></div></a>

                                    <!--**********************************************************************************************************************************************************-->                               
                                    <!--***************************************************TWITTER*****************************************************************************************************-->
                                    <a href="https://twitter.com/share?url=<?= base_url() . $lang ?>/<?= $this->session->userdata('side') ?>/gide_one/<?= $new->gides_id ?>&text=<?= $segment ?>"  ><div class="tv"></div></a> 
                                    <!--------************************************************************************************************************************************-->
                                    <!--***************************************************GOOGLE+*****************************************************************************************************-->                                

                                    <a href="https://plus.google.com/share?url=<?= base_url() . $lang ?>/<?= $this->session->userdata('side') ?>/gide_one/<?= $new->gides_id ?>" onclick="javascript:window.open(this.href,
                                                    '', 'menubar=no,toolbar=no,resizable=yes,scrollbars=yes,height=600,width=600');
                                            return false;"><div class="gl"></div></a>

                                    <!--------************************************************************************************************************************************-->

                                </ul>
                            </div>
                        </div>
                        <div class="col-md-6 col-sm-6 col-xs-12 button-center">
                            <input class="button_news spoiler" type="button" value="<?= $this->lang->line('expand'); ?>">
                            <a href="/<?= $lang ?>/<?= $this->session->userdata('side') ?>/gide_one/<?= $new->gides_id ?>/<?= $segment ?>"><input class="button_news" type="button" value="<?= $this->lang->line('more'); ?>"></a>
                        </div>
                        <hr>
                        <hr>
                    </div>

<?php } ?>
            </div>


        </div>
    </div>	
</div>

<script>
    $(document).ready(function () {
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
            return(ww.replace(/[^a-zA-Z0-9\-]/g, '-').replace(/[-]{2,}/gim, '-').replace(/^\-+/g, '').replace(/\-+$/g, ''));
        }

        $(window).scroll(function () {
            if ($(window).scrollTop() + ($(window).height() * 1.8) >= $(document).height() && !inProgress) {
                var title;
                var texts;
                $.ajax({
                    url: <?php
if ($this->uri->segment(3) == 'gides') {
    ?>'/gides/get_next_three'<?php
} else {
    echo "'/gides/get_next_search'";
}
?>,
                            method: 'POST',
                    data: {"startFrom": startFrom},
                    beforeSend: function () {
                        inProgress = true;
                    }
                }).done(function (data) {

                    data = jQuery.parseJSON(data);

                    if (data.length > 0) {
                        $.each(data, function (index, data) {

                            var segment = urlLit(data.title_gides, 0);


                            $.ajax({
                                url: '/gides/count_comm',
                                method: 'POST',
                                dataType: 'json',
                                data: {id: data.gides_id},
                                success: function (html) {
var lang = '<?=$lang?>';
if(lang === 'en'){
    title = data.title_en;
    texts = data.text_en;
}
else{
    title = data.title_gides;
    texts = data.text_gides;
}
console.log(html);
                                    if (data.img_gides !== ' ') {
                                        var taba = "<img src='<?php echo base_url(); ?>images/gides/" + data.img_gides + "'>";
                                    } else {
                                        var taba = data.video_gide;
                                    }
                                    $(".scroll-pane").append("<div class='news1'><div class='news_header'><div class='col-md-6 col-sm-12 col-xs-12 left'><p>" + data.author_gides + "</p><p>" + html.day + " " + html.mon + " " + html.year + " " + html.tim + "</p></div><div class='col-md-6 col-sm-12 col-xs-12 right'><div class='comments'><p>" + html.comm + "</p></div><div class='liked' onclick='like(" + data.gides_id + ")'><p>&nbsp;</p></div></div><div class='col-md-12 col-sm-12 col-xs-12'><img src='/images/games/"+html.im[0].games_img+"' style='height:50px;width:50px;float:left;'><h3 style='text-align: left; padding-left: 60px;'>" + title + "</h3></div></div><div class='col-md-12 col-sm-12 col-xs-12'>" + taba + "</div><div class='col-md-12 col-sm-12 col-xs-12 news_text'><h5>" + texts + "</h5></div><div class='col-md-6 col-sm-6 col-xs-12'><div class='social_icon'><ul><div id='fb-root'></div><meta property='og:url'  content='<?= base_url() . $lang ?>/<?= $this->session->userdata('side') ?>/gide_one/" + data.gides_id + "'><meta property='og:type'  content='website'><meta property='og:title'  content='" + data.title_gides + "'><meta property='og:image'  content='<?php echo base_url(); ?>images/gide_one/" + data.img_gides + "'><a id='share' href='http://www.facebook.com/sharer.php?u=<?= base_url() . $lang ?>/<?= $this->session->userdata('side') ?>/gide_one/" + data.gides_id + "' onclick='window.open(this.href, this.target, 'width= 500,height=600,scrollbars=1,top=150,left=' + (window.screen.width / 2 - 250));return false;'><div class='fb'></div></a><a href='http://vk.com/share.php?url=<?= base_url() . $lang ?>/<?= $this->session->userdata('side') ?>/gide_one/" + data.gides_id + "&title=" + data.title_gides + "&image=<?php echo base_url(); ?>images/gides/" + data.img_gides + "&noparse=true'><div class='vk'></div></a><a href='https://twitter.com/share?url=<?= base_url() . $lang ?>/<?= $this->session->userdata('side') ?>/gide_one/" + data.gides_id + "&text=<?= $segment ?>'><div class='tv'></div></a><a href='https://plus.google.com/share?url=<?= base_url() . $lang ?>/<?= $this->session->userdata('side') ?>/gide_one/" + data.gides_id + "' onclick='javascript:window.open(this.href,'','menubar=no,toolbar=no,resizable=yes,scrollbars=yes,height=600,width=600'); return false;'><div class='gl'></div></a></ul></div></div><div class='col-md-6 col-sm-6 col-xs-12 button-center'><input class='button_news spoiler' type='button' value='<?= $this->lang->line('expand'); ?>'><a href='/<?= $lang ?>/<?= $this->session->userdata('side') ?>/gide_one/" + data.gides_id + "/" + segment + "'><input class='button_news' type='button' value='<?= $this->lang->line('more'); ?>'></a></div><hr><hr></div>");

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
<script>
    function sel_gides() {
        var id_game = $("#game").val();
        location.href = "/<?= $lang ?>/<?= $this->session->userdata('side') ?>/gide/" + id_game;
    }
</script>
<script>
    $(document).ready(function () {
        $('.news').on('click', '.spoiler', function () {
            var bbb = $(this).parent().parent().find('.news_text h5').css('max-height');
            
            if (bbb === '60px') {
                $(this).parent().parent().find('.news_text h5').css('max-height', '100%');
				$(this).val('<?=$this->lang->line('spand')?>');
            } else {
                $(this).parent().parent().find('.news_text h5').css('max-height', '60px');
				$(this).val('<?=$this->lang->line('expand')?>');
            }
        })
    })
</script>
<script>
    function like(x) {

        $.ajax({
            url: '/privat/gides',
            method: 'POST',
            data: {id_gides: x},
            success: function () {
                /*alert('Гайд добавлен в избранное');*/
            }
        });
    }
</script>