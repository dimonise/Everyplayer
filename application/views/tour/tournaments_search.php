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
            <div class="active_menu_middle_image">
                <img src="<?php echo base_url(); ?>images/black_image1.png">
                <div class="black_line"><p><?= $this->lang->line('turnam'); ?></p></div>
            </div>
        </div>
    </div>
</div>
<div class="container">
    <div class="row">
        <div class="news">
            <div class="scroll-pane">
                <div class="col-md-12 col-sm-12 col-xs-12">
                    <div class="vibor_head">
                        <div class="flex-container2">
                            <div class="vibor_game2">
                                <select id="name_tour" name="name_tour" onchange="name_tour()">
                                    <option value="0">Все турниры</option>
                                    <?php
                                    foreach($name_tour as $nt){
                                        ?>
                                    <option value="<?=$nt->tour_id?>"><?=$nt->name_tour?></option>
                                    <?php } ?> 
                                </select>
                            </div>
                            <div class="vibor_game2">
                                <select id="game_tour" name="game_tour" onchange="game_tour()">
                                    <option value="0">Все игры</option>
                                    <?php
                                    foreach($favor_all as $gt){
                                        ?>
                                    <option value="<?=$gt->games_name?>"><?=$gt->games_name?></option>
                                    <?php } ?>
                                </select>
                            </div>

                        </div>
                    </div>
                </div>

                <?php
                foreach ($tour as $new) {
                    ?>		

                    <div class="news1">
                        <div class="news_header">
                            <div class="col-md-6 col-sm-12 col-xs-12 left">
                                <?php
                                $arrr = explode(" ", $new->date_start);
                                $arr = explode(":", $arrr[1]);
                                $ar = explode("-", $arrr[0]);
                                $this->load->helper('trans_helper');
                                $name = str_replace(' ', '_', $new->name_tour);
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
                                <div class="liked"><p>избранное</p></div>
                            </div>
                            <div class="col-md-12 col-sm-12 col-xs-12">
                                <h3><?= $new->name_tour; ?></h3>
                            </div>
                        </div>
                        <div class="col-md-12 col-sm-12 col-xs-12">
                            <?php
                            echo '<img src="' . base_url() . 'images/tournament/' . $new->img_tour . '">';
                            ?></div>
                        <div class="col-md-12 col-sm-12 col-xs-12 news_text">
                            <h5><?= $new->descr_tour; ?></h5>
                        </div>
                        <div class="col-md-6 col-sm-6 col-xs-12">
                            <div class="social_icon">
                                <ul>
                                     <!--***************************************************FACEBOOK*****************************************************************************************************-->
                                <div id="fb-root"></div>
                                <meta property="og:url"           content="<?= base_url() . $lang ?>/<?= $this->session->userdata('side') ?>/tournament/<?= $new->tour_id ?>" />
                                <meta property="og:type"          content="website" />
                                <meta property="og:title"         content="<?= $new->name_tour; ?>" />
                                <meta property="og:image"         content="<?php echo base_url(); ?>images/tournament/<?= $new->img_tour; ?>" />
                                <a id="share" href="http://www.facebook.com/sharer.php?u=<?= base_url() . $lang ?>/<?= $this->session->userdata('side') ?>/tournament/<?= $new->tour_id ?>" onclick="window.open(this.href, this.target, 'width= 500,height=600,scrollbars=1,top=150,left=' + (window.screen.width / 2 - 250));return false;">
                                    <div class="fb"></div>
                                </a>
                                <!--------************************************************************************************************************************************-->
                                <!--***************************************************VK*****************************************************************************************************-->
                                <script type="text/javascript" src="http://vk.com/js/api/share.js?94" charset="windows-1251"></script>

                                <!-- Put this script tag to the place, where the Share button will be -->
                                <a href="http://vk.com/share.php?url=<?= base_url() . $lang ?>/<?= $this->session->userdata('side') ?>/tournament/<?= $new->tour_id ?>&title=<?=$segment?>&image=<?php echo base_url(); ?>images/tournament/<?= $new->img_tour; ?>&noparse=true"><div class="vk"></div></a>

                                <!--**********************************************************************************************************************************************************-->                               
                                <!--***************************************************TWITTER*****************************************************************************************************-->
                                    <a href="https://twitter.com/share?url=<?= base_url() . $lang ?>/<?= $this->session->userdata('side') ?>/tournament/<?= $new->tour_id ?>&text=<?=$segment?>"  ><div class="tv"></div></a> 
                                <!--------************************************************************************************************************************************-->
                                <!--***************************************************GOOGLE+*****************************************************************************************************-->                                
                                
                                <a href="https://plus.google.com/share?url=<?= base_url() . $lang ?>/<?= $this->session->userdata('side') ?>/tournament/<?= $new->tour_id ?>" onclick="javascript:window.open(this.href,
                                                '', 'menubar=no,toolbar=no,resizable=yes,scrollbars=yes,height=600,width=600');
                                        return false;"><div class="gl"></div></a>

                                <!--------************************************************************************************************************************************-->
                                
                                </ul>
                            </div>
                        </div>
                        <div class="col-md-6 col-sm-6 col-xs-12 button-center">
                            <input class="button_news spoiler" type="button" value="<?= $this->lang->line('expand'); ?>">
                            <a href="/<?= $lang ?>/black/tournament/<?= $new->tour_id ?>/<?= $segment ?>"><input class="button_news" type="button" value="<?= $this->lang->line('more'); ?>"></a>
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

                var cou;
                $.ajax({
                    url: <?php
if ($this->uri->segment(3) == 'tournaments') {
    ?>'/tour/get_next_three'<?php
} else {
    echo "'/tour/get_next_search'";
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

                            var segment = urlLit(data.name_tour, 0);


                            $.ajax({
                                url: '/tour/dates',
                                method: 'POST',
                                dataType:'json',
                                data: {id: data.tour_id},
                                success: function (html) {
                                  
                                        var taba = "<img src='<?php echo base_url(); ?>images/tournament/" + data.img_tour + "'>";
                                    
                                    $(".scroll-pane").append("<div class='news1'><div class='news_header'><div class='col-md-6 col-sm-12 col-xs-12 left'><p>"+html.day+" "+html.mon+" "+html.year+" "+html.tim+"</p></div><div class='col-md-6 col-sm-12 col-xs-12 right'><div class='liked'><p>избранное</p></div></div></div><div class='col-md-12 col-sm-12 col-xs-12'><h3>" + data.name_tour + "</h3></div></div><div class='col-md-12 col-sm-12 col-xs-12'>" + taba + "</div><div class='col-md-12 col-sm-12 col-xs-12 news_text'><h5>" + data.descr_tour + "</h5></div><div class='col-md-6 col-sm-6 col-xs-12'><div class='social_icon'><ul><div id='fb-root'></div><meta property='og:url'  content='<?= base_url() . $lang ?>/<?= $this->session->userdata('side') ?>/tournament/"+data.tour_id+"'><meta property='og:type'  content='website'><meta property='og:title'  content='"+data.name_tour+"'><meta property='og:image'  content='<?php echo base_url(); ?>images/tournament/"+data.img_tour+"'><a id='share' href='http://www.facebook.com/sharer.php?u=<?= base_url() . $lang ?>/<?= $this->session->userdata('side') ?>/tournament/"+data.tour_id+"' onclick='window.open(this.href, this.target, 'width= 500,height=600,scrollbars=1,top=150,left=' + (window.screen.width / 2 - 250));return false;'><div class='fb'></div></a><a href='http://vk.com/share.php?url=<?= base_url() . $lang ?>/<?= $this->session->userdata('side') ?>/tournament/"+data.tour_id+"&title="+data.name_tour+"&image=<?php echo base_url(); ?>images/tournament/"+data.img_tour+"&noparse=true'><div class='vk'></div></a><a href='https://twitter.com/share?url=<?= base_url() . $lang ?>/<?= $this->session->userdata('side') ?>/tournament/"+data.tour_id+"&text=<?=$segment?>'><div class='tv'></div></a><a href='https://plus.google.com/share?url=<?= base_url() . $lang ?>/<?= $this->session->userdata('side') ?>/tournament/"+data.tour_id+"' onclick='javascript:window.open(this.href,'','menubar=no,toolbar=no,resizable=yes,scrollbars=yes,height=600,width=600'); return false;'><div class='gl'></div></a></ul></div></div><div class='col-md-6 col-sm-6 col-xs-12 button-center'><input class='button_news spoiler' type='button' value='<?= $this->lang->line('expand'); ?>'><a href='/<?= $lang ?>/<?=$this->session->userdata('side')?>/tournament/" + data.tour_id + "/" + segment + "'><input class='button_news' type='button' value='<?= $this->lang->line('more'); ?>'></a></div><hr><hr></div>");

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
    function name_tour(){
        var val = $('#name_tour').val();
        if(val === '0'){
            location.reload();
        }
        else{
        $.ajax({
                                url: '/tour/name_tour',
                                method: 'POST',
                                dataType:'json',
                                data: {id_tour: val},
                                success: function (html) {
                                    
                                }
                            })
                        }
    }
    function game_tour(){
        var val = $('#game_tour').val();
        if(val === '0'){
            location.reload();
        }
        else{
        $.ajax({
                                url: '/tour/game_tour',
                                method: 'POST',
                                dataType:'json',
                                data: {id_game: val},
                                success: function (html) {
                                    
                                }
                            })
                        }
    }
    </script>