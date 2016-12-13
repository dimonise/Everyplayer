<?php
defined('BASEPATH') OR exit('No direct script access allowed');
//var_dump($this->session->userdata('side'));
?>
<script>(function (d, s, id) {
        var js, fjs = d.getElementsByTagName(s)[0];
        if (d.getElementById(id))
            return;
        js = d.createElement(s);
        js.id = id;
        js.src = "//connect.facebook.net/ru_RU/sdk.js#xfbml=1&version=v2.8";
        fjs.parentNode.insertBefore(js, fjs);
    }(document, 'script', 'facebook-jssdk'));</script>
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
        <div class="news">
            <div class="scroll-pane">

                <?php
                foreach ($news as $new) {
                    ?>		

                    <div class="news1">
                        <div class="news_header">
                            <div class="col-md-6 col-sm-12 col-xs-12 left">

                                <!--<p><?= $new->author_news; ?></p>-->

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
                                <div class="comments">
	                                <p><?php
	                                        $this->db->where('id_trek', $new->news_id);
	                                        echo $this->db->count_all_results('komm_news') . " ";
	                                        ?>
	                                 </p>
                                </div>
                                <div class="liked" onclick="like(<?= $new->news_id ?>)">
                                	<p>&nbsp;</p>
                                </div>
                            </div>
                            <div class="col-md-12 col-sm-12 col-xs-12">
                                <?php
                                if ($lang == 'en') {
                                
?>                                
                                <h3> <a href="/<?= $lang ?>/<?= $this->session->userdata('side') ?>/news/<?= $new->news_id ?>/<?= $segment ?>"><?= $new->title_en ?></a></h3>
                                <?php
                }
                else{
				?>
                   <h3> <a href="/<?= $lang ?>/<?= $this->session->userdata('side') ?>/news/<?= $new->news_id ?>/<?= $segment ?>"><?=$new->title_news?></h3>
               <?php }
                ?>
                            </div>
                        </div>
                        <div class="col-md-12 col-sm-12 col-xs-12">
                            <img src="<?php echo base_url(); ?>images/news/<?= $new->img_news; ?>">
                        </div>

                        <div class="col-md-12 col-sm-12 col-xs-12 news_text">
                           <?php
                           if ($lang != 'en') {
                                
?>                              
                            <h5><?= $new->text_news; ?></h5>
                            <?php
                }
                else{
                   echo  "<h3>".$new->text_en."</h3>";
                }
                ?>
                        </div>
                        <div class="col-md-6 col-sm-6 col-xs-12">
                            <div class="social_icon">
                                <ul> <!--***************************************************FACEBOOK*****************************************************************************************************-->
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
                        <div class="col-md-6 col-sm-6 col-xs-12 button-center">
                            <input class="button_news spoiler" type="button" value="<?= $this->lang->line('expand'); ?>">
                            <a href="/<?= $lang ?>/<?= $this->session->userdata('side') ?>/news/<?= $new->news_id ?>/<?= $segment ?>"><input class="button_news" type="button" value="<?= $this->lang->line('more'); ?>"></a>
                        </div>
                        <hr>
                        <hr>
                    </div>

<?php } ?>
            </div>
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
                    url: '/home/get_next_three',
                    method: 'POST',
                    data: {"startFrom": startFrom},
                    beforeSend: function () {
                        inProgress = true;
                    }
                }).done(function (data) {

                    data = jQuery.parseJSON(data);

                    if (data.length > 0) {
                        $.each(data, function (index, data) {

                            var segment = urlLit(data.title_news, 0);


                            $.ajax({
                                url: '/home/count_comm',
                                method: 'POST',
                                dataType: 'json',
                                data: {id: data.news_id},
                                success: function (html) {
var lang = '<?=$lang?>';
if(lang === 'en'){
    title = data.title_en;
    texts = data.text_en;
}
else{
    title = data.title_news;
    texts = data.text_news;
}
                                    $(".scroll-pane").append("<div class='news1'><div class='news_header'><div class='col-md-6 col-sm-12 col-xs-12 left'><p>" + html.day + " " + html.mon + " " + html.year + " " + html.tim + "</p></div><div class='col-md-6 col-sm-12 col-xs-12 right'><div class='comments'><p>" + html.comm + "</p></div><div class='liked' onclick='like(" + data.news_id + ")'><p>&nbsp;</p></div></div><div class='col-md-12 col-sm-12 col-xs-12'><h3>" + title + "</h3></div></div><div class='col-md-12 col-sm-12 col-xs-12'><img src='<?php echo base_url(); ?>images/news/" + data.img_news + "'></div><div class='col-md-12 col-sm-12 col-xs-12 news_text'><h5>" + texts + "</h5></div><div class='col-md-6 col-sm-6 col-xs-12'><div class='social_icon'><ul><div id='fb-root'></div><meta property='og:url'  content='<?= base_url() . $lang ?>/<?= $this->session->userdata('side') ?>/news/"+data.news_id+"'><meta property='og:type'  content='website'><meta property='og:title'  content='"+data.title_news+"'><meta property='og:image'  content='<?php echo base_url(); ?>images/news/"+data.img_news+"'><a id='share' href='http://www.facebook.com/sharer.php?u=<?= base_url() . $lang ?>/<?= $this->session->userdata('side') ?>/news/"+data.news_id+"' onclick='window.open(this.href, this.target, 'width= 500,height=600,scrollbars=1,top=150,left=' + (window.screen.width / 2 - 250));return false;'><div class='fb'></div></a><a href='http://vk.com/share.php?url=<?= base_url() . $lang ?>/<?= $this->session->userdata('side') ?>/news/"+data.news_id+"&title="+data.title_news+"&image=<?php echo base_url(); ?>images/news/"+data.img_news+"&noparse=true'><div class='vk'></div></a><a href='https://twitter.com/share?url=<?= base_url() . $lang ?>/<?= $this->session->userdata('side') ?>/news/"+data.news_id+"&text=<?=$segment?>'><div class='tv'></div></a><a href='https://plus.google.com/share?url=<?= base_url() . $lang ?>/<?= $this->session->userdata('side') ?>/news/"+data.news_id+"' onclick='javascript:window.open(this.href,'','menubar=no,toolbar=no,resizable=yes,scrollbars=yes,height=600,width=600'); return false;'><div class='gl'></div></a></ul></div></div><div class='col-md-6 col-sm-6 col-xs-12 button-center'><input class='button_news spoiler' type='button' value='<?= $this->lang->line('expand'); ?>'><a href='/<?= $lang ?>/<?=$this->session->userdata('side')?>/news/" + data.news_id + "/" + segment + "'><input class='button_news' type='button' value='<?= $this->lang->line('more'); ?>'></a></div><hr><hr></div>");

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
            url: '/privat/news',
            method: 'POST',
            data: {id_news: x},
            success: function () {
                /*alert('<?= $this->lang->line('news_liked'); ?>');*/
            }
        });
    }
</script>