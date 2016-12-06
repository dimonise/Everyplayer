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
                <?php
                foreach ($news as $new) {
                    ?>     
                    <div class="otstyp_klan">
                        <div class="col-md-9 col-sm-9 col-xs-12 players_in_klan">
                            <div class="row">
                                <div class="news1">

                                    <div class="news_header">
                                        <div class="col-md-6 col-sm-12 col-xs-12 left">
                                            <p><?= $new->author_news; ?></p>
                                            <?php
                                            $arrr = explode(" ", $new->datas_news);
                                            $arr = explode(":", $arrr[1]);
                                            $ar = explode("-", $arrr[0]);
                                            $this->load->helper('trans_helper');
                                            $name = str_replace(' ', '_', $new->title_news);
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
                                            echo '<p>' . $ar[2] . ' ' . $datas . ' ' . $arr[0] . ':' . $arr[1] . '</p>';
                                            ?>
                                        </div>
                                        <div class="col-md-6 col-sm-12 col-xs-12 right">
                                            <div class="comments"><p><?php
                                                    $this->db->where('id_trek', $new->news_id);
                                                    echo $this->db->count_all_results('komm_clan') . " ";
                                                    ?><?= $this->lang->line('coms'); ?></p></div>
                                            <!--<div class="liked" onclick="like(<?= $new->news_id ?>)"><p><?= $this->lang->line('liked'); ?></p></div>-->
                                        </div>
                                        <div class="col-md-12 col-sm-12 col-xs-12">
                                            <?php
                                            if ($lang == 'en') {
                                                ?>                                
                                                <h3><?= $new->title_en ?></h3>
                                                <?php
                                            } else {
                                                echo "<h3>" . $new->title_news . "</h3>";
                                            }
                                            ?>
                                        </div>
                                    </div>
                                    <div class="col-md-12 col-sm-12 col-xs-12">
                                        <img src="<?php echo base_url(); ?>images/clans/<?= $new->img_news; ?>">
                                    </div>
                                    <div class="col-md-12 col-sm-12 col-xs-12 news_text">
    <?php
    if ($lang != 'en') {
        ?>                              
                                            <h5><?= $new->text_news; ?></h5>
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
                                                <meta property="og:url"           content="<?= base_url() . $lang . '/' . $this->session->userdata('side') . '/news_clan/' . $new->clan_id . '/' . $new->news_id ?> />
                                                      <meta property="og:type"          content="website" />
                                                      <meta property="og:title"         content="<?= $new->title_news ?>" />
                                                <meta property="og:image"         content="<?= base_url() . 'images/clans/' . $new->img_news ?>" />
                                                <a id="share" href="http://www.facebook.com/sharer.php?u=<?= base_url() . $lang . '/' . $this->session->userdata('side') . '/news_clan/' . $new->clan_id . '/' . $new->news_id ?>" onclick="window.open(this.href, this.target, 'width= 500,height=600,scrollbars=1,top=150,left=' + (window.screen.width / 2 - 250));return false;">
                                                    <div class="fb"></div>
                                                </a>
                                                <!--------************************************************************************************************************************************-->
                                                <!--***************************************************VK*****************************************************************************************************-->
                                                <script type="text/javascript" src="http://vk.com/js/api/share.js?94" charset="windows-1251"></script>

                                                <!-- Put this script tag to the place, where the Share button will be -->
                                                <a href="http://vk.com/share.php?url=<?= base_url() . $lang . '/' . $this->session->userdata('side') . '/news_clan/' . $new->clan_id . '/' . $new->news_id . '&title=' . $segment . '&image=' . base_url() . 'images/clans/' . $new->img_news ?>&noparse=true"><div class="vk"></div></a>

                                                <!--**********************************************************************************************************************************************************-->                               
                                                <!--***************************************************TWITTER*****************************************************************************************************-->
                                                <a href="https://twitter.com/share?url=<?= base_url() . $lang . '/' . $this->session->userdata('side') . '/news_clan/' . $new->clan_id . '/' . $new->news_id . '&text=' . $segment ?>"  ><div class="tv"></div></a> 
                                                <!--------************************************************************************************************************************************-->
                                                <!--***************************************************GOOGLE+*****************************************************************************************************-->                                

                                                <a href="https://plus.google.com/share?url=<?= base_url() . $lang . '/' . $this->session->userdata('side') . '/news_clan/' . $new->clan_id . '/' . $new->news_id ?>" onclick="javascript:window.open(this.href, '', 'menubar=no,toolbar=no,resizable=yes,scrollbars=yes,height=600,width=600'); return false;"><div class="gl"></div></a>

                                                <!--------************************************************************************************************************************************-->

                                            </ul>
                                        </div>
                                    </div>
                                    <div class="col-md-6 col-sm-6 col-xs-12 button-center">
                                        <input class="button_news spoiler" type="button" value="<?= $this->lang->line('expand'); ?>">
                                        <a href="/<?= $lang ?>/black/news_clan/<?= $this->uri->segment(4) ?>/<?= $new->news_id ?>/<?= $segment ?>"><input class="button_news" type="button" value="<?= $this->lang->line('more'); ?>"></a>
                                    </div>
                                    <hr>
                                    <hr>
                                </div>
                            </div>
                        </div>
                    </div>
    <?php
}
?>
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
                    url: '/clans/get_next_three',
                    method: 'POST',
                    data: {"startFrom": startFrom, clan_id:<?= $this->uri->segment(4) ?>},
                    beforeSend: function () {
                        inProgress = true;
                    }
                }).done(function (data) {
                    data = jQuery.parseJSON(data);
                    if (data.length > 0) {
                        $.each(data, function (index, data) {
                            var segment = urlLit(data.title_news, 0);
                            var lang = '<?= $lang ?>';
                            if (lang === 'en') {
                                title = data.title_en;
                                texts = data.text_en;
                            } else {
                                title = data.title_news;
                                texts = data.text_news;
                            }
                            $.ajax({
                                url: '/clans/count_comm',
                                method: 'POST',
                                data: {id: data.news_id},
                                success: function (html) {
                                    $(".scroll-pane").append("<div class='otstyp_klan'><div class='col-md-9 col-sm-9 col-xs-12 players_in_klan'><div class='row'><div class='news1'><div class='news_header'><div class='col-md-6 col-sm-12 col-xs-12 left'><p>" + data.author_news + "</p><?php
echo '<p>' . $ar[2] . ' ' . $datas . ' ' . $arr[0] . ':' . $arr[1] . '</p>';
?></div><div class='col-md-6 col-sm-12 col-xs-12 right'><div class='comments'><p>" + html + " <?= $this->lang->line('coms'); ?></p></div><div class='liked'><p><?= $this->lang->line('liked'); ?></p></div></div><div class='col-md-12 col-sm-12 col-xs-12'><h3>" + title + "</h3></div></div><div class='col-md-12 col-sm-12 col-xs-12'><img src='<?php echo base_url(); ?>images/news/" + data.img_news + "'></div><div class='col-md-12 col-sm-12 col-xs-12 news_text'><h5>" + texts + "</h5></div><div class='col-md-6 col-sm-6 col-xs-12'><div class='social_icon'><ul><div id='fb-root'></div><meta property='og:url'  content='<?= base_url() . $lang ?>/<?= $this->session->userdata('side') ?>/news_clan/" + data.news_id + "'><meta property='og:type'  content='website'><meta property='og:title'  content='" + data.title_news + "'><meta property='og:image'  content='<?php echo base_url(); ?>images/clans/" + data.img_news + "'><a id='share' href='http://www.facebook.com/sharer.php?u=<?= base_url() . $lang ?>/<?= $this->session->userdata('side') ?>/news_clan/" + data.news_id + "' onclick='window.open(this.href, this.target, 'width= 500,height=600,scrollbars=1,top=150,left=' + (window.screen.width / 2 - 250));return false;'><div class='fb'></div></a><a href='http://vk.com/share.php?url=<?= base_url() . $lang ?>/<?= $this->session->userdata('side') ?>/news_clan/" + data.news_id + "&title=" + data.title_news + "&image=<?php echo base_url(); ?>images/news/" + data.img_news + "&noparse=true'><div class='vk'></div></a><a href='https://twitter.com/share?url=<?= base_url() . $lang ?>/<?= $this->session->userdata('side') ?>/news_clan/" + data.news_id + "&text=<?= $segment ?>'><div class='tv'></div></a><a href='https://plus.google.com/share?url=<?= base_url() . $lang ?>/<?= $this->session->userdata('side') ?>/news_clan/" + data.news_id + "' onclick='javascript:window.open(this.href,'','menubar=no,toolbar=no,resizable=yes,scrollbars=yes,height=600,width=600'); return false;'><div class='gl'></div></a></ul></div></div><div class='col-md-6 col-sm-6 col-xs-12 button-center'><input class='button_news spoiler' type='button' value='<?= $this->lang->line('expand'); ?>'><a href='/<?= $lang ?>/<?= $this->session->userdata('side') ?>/news/" + data.news_id + "/" + segment + "'><input class='button_news' type='button' value='<?= $this->lang->line('more'); ?>'></a></div><hr><hr></div></div></div></div>");
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
    $(document).ready(function () {
        $('.news').on('click', '.spoiler', function () {
            var bbb = $(this).parent().parent().find('.news_text h5').css('max-height');
            console.log(bbb);
            if (bbb === '60px') {
                $(this).parent().parent().find('.news_text h5').css('max-height', '100%');
            } else {
                $(this).parent().parent().find('.news_text h5').css('max-height', '60px');
            }
        })
    })
</script>
<script>
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
</script>