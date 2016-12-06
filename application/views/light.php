<?php
defined('BASEPATH') OR exit('No direct script access allowed');
?>

<div class="container images_for_black">
    <div class="row">
        <div class="flex-container">
            <div class="image1">
                <img src="<?php echo base_url(); ?>images/black_image1.png">
                <div class="black_line"><p><?=$this->lang->line('gamer');?></p></div>
            </div>
            <div class="image1">
                <img src="<?php echo base_url(); ?>images/black_image1.png">
                <div class="black_line"><p><?=$this->lang->line('mclans');?></p></div>
            </div>
            <div class="image1">
                <img src="<?php echo base_url(); ?>images/black_image1.png">
                <div class="black_line"><p><?=$this->lang->line('sclans');?></p></div>
            </div>
            <div class="image1">
                <img src="<?php echo base_url(); ?>images/black_image1.png">
                <div class="black_line"><p><?=$this->lang->line('gides');?></p></div>
            </div>
            <div class="image1">
                <img src="<?php echo base_url(); ?>images/black_image1.png">
                <div class="black_line"><p><?=$this->lang->line('turnam');?></p></div>
            </div>
        </div>
    </div>
</div>

<div class="container">
    <div class="row">
        <div class="news">
        <div class="scroll-pane">
            <?php
            foreach ($news as $new) {
                ?>		

                <div class="news1">
                    <div class="news_header">
                        <div class="col-md-6 col-sm-12 col-xs-12 left">
                            <p><?= $new->author_news; ?></p>

                            <?php
                            $arrr = explode(" ", $new->datas_news);
                            $arr = explode(":", $arrr[1]);
                            $ar = explode("-", $arrr[0]);



                            if ($lang == 'en') {
                                $datas = $month_array_en[$ar[1]];
                            } else {

                                $datas = $month_array_rus[$ar[1]];
                            }
                            echo '<p>' . $ar[2] . ' ' . $datas . ' ' . $arr[0] . ':' . $arr[1] . '</p>';
                            ?>

                        </div>
                        <div class="col-md-6 col-sm-12 col-xs-12 right">
                            <div class="comments"><p><?=$this->lang->line('comms');?></p></div>
                            <div class="liked"><p><?=$this->lang->line('liked');?></p></div>
                        </div>
                        <div class="col-md-12 col-sm-12 col-xs-12">
                            <h3><?= $new->title_news; ?></h3>
                        </div>
                    </div>
                    <div class="col-md-12 col-sm-12 col-xs-12">
                        <img src="<?php echo base_url(); ?>images/news/<?= $new->img_news; ?>">
                    </div>
                    <div class="col-md-12 col-sm-12 col-xs-12 news_text">
                        <h5><?= $new->text_news; ?></h5>
                    </div>
                    <div class="col-md-6 col-sm-6 col-xs-12">
                        <div class="social_icon">
                            <ul>
                                <a href="https://www.facebook.com/"><div class="fb"></div></a>
                                <a href="https://vk.com/"><div class="vk"></div></a>
                                <a href="https://twitter.com/"><div class="tv"></div></a>
                                <a href="https://plus.google.com/"><div class="gl"></div></a>
                                <a href="https://www.instagram.com/"><div class="in"></div></a>
                            </ul>
                        </div>
                    </div>
                    <div class="col-md-6 col-sm-6 col-xs-12 button-center">
                        <input class="button_news spoiler" type="button" value="<?=$this->lang->line('expand');?>">
                        <input class="button_news" type="button" value="<?=$this->lang->line('more');?>">
                    </div>
                    <hr>
                    <hr>
                </div>

            <?php } ?>
        </div>
        </div>
    </div>	
</div>
<div class="container paginat2">
    <ul>

    </ul>
</div>
</div>

<script>
    $(document).ready(function () {

        var inProgress = false;
        var startFrom = 3;
        $(window).scroll(function () {
            if ($(window).scrollTop() + ($(window).height()*1.8) >= $(document).height() && !inProgress) {
                console.log($(window).scrollTop()+$(window).height());
                console.log($(document).height());
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
                            $(".scroll-pane").append("<div class='news1'><div class='news_header'><div class='col-md-6 col-sm-12 col-xs-12 left'><p>" + data.author_news + "</p><?php
            $arrr = explode(" ", $new->datas_news);
            $arr = explode(":", $arrr[1]);
            $ar = explode("-", $arrr[0]);
            if ($lang == 'en') {
                $datas = $month_array_en[$ar[1]];
            } else {
                $datas = $month_array_rus[$ar[1]];
            }
            echo '<p>' . $ar[2] . ' ' . $datas . ' ' . $arr[0] . ':' . $arr[1] . '</p>';
            ?></div><div class='col-md-6 col-sm-12 col-xs-12 right'><div class='comments'><p><?=$this->lang->line('comms');?></p></div><div class='liked'><p><?=$this->lang->line('liked');?></p></div></div><div class='col-md-12 col-sm-12 col-xs-12'><h3>" + data.title_news + "</h3></div></div><div class='col-md-12 col-sm-12 col-xs-12'><img src='<?php echo base_url(); ?>images/news/" + data.img_news + "'></div><div class='col-md-12 col-sm-12 col-xs-12 news_text'><h5>" + data.text_news + "</h5></div><div class='col-md-6 col-sm-6 col-xs-12'><div class='social_icon'><ul><a href='https://www.facebook.com/'><div class='fb'></div></a><a href='https://vk.com/'><div class='vk'></div></a><a href='https://twitter.com/'><div class='tv'></div></a><a href='https://plus.google.com/'><div class='gl'></div></a><a href='https://www.instagram.com/'><div class='in'></div></a></ul></div></div><div class='col-md-6 col-sm-6 col-xs-12 button-center'><input class='button_news spoiler' type='button' value='<?=$this->lang->line('expand');?>'><input class='button_news' type='button' value='<?=$this->lang->line('more');?>'></div><hr><hr></div>");
                        });

                        inProgress = false;
                        startFrom += 3;
                    }
                });
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
  /**Подключение скролла**/
  $(function()
     {
         $('.scroll-pane').jScrollPane();
     });
 </script>


