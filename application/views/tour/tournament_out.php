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
            <div class="active_menu_middle_image">
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
            <div class="news1">
                <div class="col-md-12 col-sm-12 col-xs-12">
                    <div class="nav-turnir">
                        <ul>
                           <ul>
                            <?php
                            if ($tourn[0]->type_tour == 1) {
                                $type = "tournament_out";
                            } else {
                                $type = "tournament_each_to_each";
                            }
                            $datas = strtotime($tourn[0]->date_finish);
                            $now = time();
                            $datas_all = strtotime($tourn[0]->date_finish_all);

                            if ($datas < $now) {
                                $link1 = "<a href='/" . $lang . "/" . $this->session->userdata('side') . "/" . $type . "/" . $this->uri->segment(4) . "'>" . $this->lang->line('taba') . "</a>";
                                $link2 = "<a href='/" . $lang . "/" . $this->session->userdata('side') . "/tournament_match/" . $this->uri->segment(4) . "'>" . $this->lang->line('match') . "</a>";
                            } else {
                                $link1 = $this->lang->line('taba');
                                $link2 = $this->lang->line('match');
                            }
                            ?>
                            <li><a href="/<?= $lang ?>/<?= $this->session->userdata('side') ?>/tournament/<?= $this->uri->segment(4) ?>"><?= $this->lang->line('team') ?></a></li>
                            <li><?= $link1 ?></li>
                            <li><?= $link2 ?></li>
                        </ul>
                        </ul>
                    </div>
                </div>
                <div class="news_header">
                    <div class="col-md-5 col-sm-12 col-xs-12 left">
                         <?php
                        $arrr = explode(" ", $tourn[0]->date_start);
                        $arr = explode(":", $arrr[1]);
                        $ar = explode("-", $arrr[0]);
                        if ($lang == 'en') {
                            $datas = $month_array_en[$ar[1]];
                        } else {

                            $datas = $month_array_rus[$ar[1]];
                        }
                        echo "<p>" . $ar[2] . ' ' . $datas . ' ' . $arr[0] . ':' . $arr[1] . "</p>";
                        ?>
                    </div>
                    <div class="col-md-7 col-sm-12 col-xs-12 right">
                        <div class="liked"><p><?= $this->lang->line('liked') ?></p></div>
                    </div>
                    <div class="col-md-12 col-sm-12 col-xs-12">
                        <?php
                        if ($lang == 'en') {
                            ?>                                
                            <h3><?= $tourn[0]->title_en ?></h3>
                            <?php
                        } else {
                            echo "<h3>" . $tourn[0]->name_tour . "</h3>";
                        }
                        ?>
                    </div>
                </div>
                <div class="col-md-12 col-sm-12 col-xs-12">
                    <img src="/images/tournament/<?=$tourn[0]->img_tour?>">
                </div>
                <div class="col-md-12 col-sm-12 col-xs-12 news_text">
                    <?php
                    if ($lang != 'en') {
                        ?>                              
                        <h5><?= $tourn[0]->descr_tour; ?></h5>
                        <?php
                    } else {
                        echo "<h5>" . $tourn[0]->text_en . "</h5>";
                    }
                    ?>
                    <h5><?=$this->lang->line('taba_out');?></h5>
                </div>
                <?php
                $comm = array();
                $comm = unserialize($command[0]->quarterfinal);
                $comm2 = array();
                $comm2 = unserialize($command[0]->semifinal);
                $comm3 = array();
                $comm3 = unserialize($command[0]->final);
                $comm4 = array();
                $comm4 = unserialize($command[0]->vinner);
                
              //  var_dump($comm5->logo);
                ?>
                <div class="scroll-block">
                    <div class="turnir_table">
                        <div class="column1">
                            <div class="ychasniki">
                                <div class="ychasnik1" data-title="<?=$comm['first_quart']?>">
                                    <div class="avatar_tour" style="background-image: url(/images/tournament/<?=@$comm['first_quart_logo']?>)"></div>
                                    <p><?=$comm['first_quart']?></p>
                                    <div class="schet1">
                                        <p><?=$comm['first_q']?></p>
                                    </div>
                                </div>
                                <div class="ychasnik2" data-title="<?=$comm['second_quart']?>">
                                    <div class="avatar_tour" style="background-image: url(/images/tournament/<?=@$comm['second_quart_logo']?>)"></div>
                                    <p><?=$comm['second_quart']?></p>
                                    <div class="schet2">
                                        <p><?=$comm['second_q']?></p>
                                    </div>
                                </div>
                            </div>
                            <div class="ychasniki">
                                <div class="ychasnik1" data-title="<?=$comm['third_quart']?>">
                                    <div class="avatar_tour" style="background-image: url(/images/tournament/<?=@$comm['third_quart_logo']?>)"></div>
                                    <p><?=$comm['third_quart']?></p>
                                    <div class="schet1">
                                        <p><?=$comm['third_q']?></p>
                                    </div>
                                </div>
                                <div class="ychasnik2" data-title="<?=$comm['fourth_quart']?>">
                                    <div class="avatar_tour" style="background-image: url(/images/tournament/<?=@$comm['fourth_quart_logo']?>)"></div>
                                    <p><?=$comm['fourth_quart']?></p>
                                    <div class="schet2">
                                        <p><?=$comm['fourth_q']?></p>
                                    </div>
                                </div>
                            </div>
                            <div class="ychasniki">
                                <div class="ychasnik1" data-title="<?=$comm['fifth_quart']?>">
                                    <div class="avatar_tour" style="background-image: url(/images/tournament/<?=@$comm['fifth_quart_logo']?>)"></div>
                                    <p><?=$comm['fifth_quart']?></p>
                                    <div class="schet1">
                                        <p><?=$comm['fifth_q']?></p>
                                    </div>
                                </div>
                                <div class="ychasnik2" data-title="<?=$comm['sixth_quart']?>">
                                    <div class="avatar_tour" style="background-image: url(/images/tournament/<?=@$comm['sixth_quart_logo']?>)"></div>
                                    <p><?=$comm['sixth_quart']?></p>
                                    <div class="schet2">
                                        <p><?=$comm['sixth_q']?></p>
                                    </div>
                                </div>
                            </div>
                            <div class="ychasniki">
                                <div class="ychasnik1" data-title="<?=$comm['seventh_quart']?>">
                                    <div class="avatar_tour" style="background-image: url(/images/tournament/<?=@$comm['seventh_quart_logo']?>)"></div>
                                    <p><?=$comm['seventh_quart']?></p>
                                    <div class="schet1">
                                        <p><?=$comm['seventh_q']?></p>
                                    </div>
                                </div>
                                <div class="ychasnik2" data-title="<?=$comm['eighth_quart']?>">
                                    <div class="avatar_tour" style="background-image: url(/images/tournament/<?=@$comm['eighth_quart_logo']?>)"></div>
                                    <p><?=$comm['eighth_quart']?></p>
                                    <div class="schet2">
                                        <p><?=$comm['eighth_q']?></p>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="column2">
                            <div class="ugolok_all">
                                <div class="ugolok1"></div>
                                <div class="ugolok2"></div>
                            </div>
                            <div class="ugolok_all2">
                                <div class="ugolok3"></div>
                                <div class="ugolok4"></div>
                            </div>
                            <div class="ugolok_all3">
                                <div class="ugolok1"></div>
                                <div class="ugolok2"></div>
                            </div>
                            <div class="ugolok_all4">
                                <div class="ugolok3"></div>
                                <div class="ugolok4"></div>
                            </div>
                        </div>
                        <div class="column3">
                            <div class="ychasniki_top">
                                <div class="ychasnik1" data-title="<?=$comm2['first_semi']?>">
                                    <div class="avatar_tour" style="background-image: url(/images/tournament/<?=@$comm2['first_semi_logo']?>)"></div>
                                    <p><?=$comm2['first_semi']?></p>
                                    <div class="schet1">
                                        <p><?=$comm2['first_s']?></p>
                                    </div>
                                </div>
                                <div class="ychasnik2" data-title="<?=$comm2['second_semi']?>">
                                    <div class="avatar_tour" style="background-image: url(/images/tournament/<?=@$comm2['second_semi_logo']?>)"></div>
                                    <p><?=$comm2['second_semi']?></p>
                                    <div class="schet2">
                                        <p><?=$comm2['second_s']?></p>
                                    </div>
                                </div>
                            </div>
                            <div class="ychasniki_bottom">
                                <div class="ychasnik1" data-title="<?=$comm2['third_semi']?>">
                                    <div class="avatar_tour" style="background-image: url(/images/tournament/<?=@$comm2['third_semi_logo']?>)"></div>
                                    <p><?=$comm2['third_semi']?></p>
                                    <div class="schet1">
                                        <p><?=$comm2['third_s']?></p>
                                    </div>
                                </div>
                                <div class="ychasnik2" data-title="<?=$comm2['fourth_semi']?>">
                                    <div class="avatar_tour" style="background-image: url(/images/tournament/<?=@$comm2['fourth_semi_logo']?>)"></div>
                                    <p><?=$comm2['fourth_semi']?></p>
                                    <div class="schet2">
                                        <p><?=$comm2['fourth_s']?></p>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="column4">
                            <div class="ugolok_all5">
                                <div class="ugolok_big"></div>
                                <div class="ugolok_little"></div>
                            </div>
                            <div class="ugolok_all6">
                                <div class="ugolok_big2"></div>
                                <div class="ugolok_little2"></div>
                            </div>
                        </div>
                        <div class="column5">
                            <div class="ychasniki">
                                <div class="ychasnik1" data-title="<?=$comm3['first_fin']?>">
                                    <div class="avatar_tour" style="background-image: url(/images/tournament/<?=@$comm3['first_fin_logo']?>)"></div>
                                    <p><?=$comm3['first_fin']?></p>
                                    <div class="schet1">
                                        <p><?=$comm3['first_f']?></p>
                                    </div>
                                </div>
                                <div class="ychasnik2" data-title="<?=$comm3['second_fin']?>">
                                    <div class="avatar_tour" style="background-image: url(/images/tournament/<?=@$comm3['second_fin_logo']?>)"></div>
                                    <p><?=$comm3['second_fin']?></p>
                                    <div class="schet2">
                                        <p><?=$comm3['second_f']?></p>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="column6">
                            <div class="ugolok_all7">
                                <div class="ugolok_big3"></div>
                                <div class="ugolok_little3"></div>
                            </div>
                        </div>
                        <div class="column7">
                            <div class="ychasniki">
                                <div class="ychasnik1" data-title="<?=$comm4['first_vin']?>">
                                    <div class="avatar_tour" style="background-image: url(/images/tournament/<?=@$comm4['first_vin_logo']?>)"></div>
                                    <p><?=$comm4['first_vin']?></p>
                                    <div class="schet1">
                                        <p><?=$comm4['first_v']?></p>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="podpisi_grup">
                            <div class="podpisi">
                                <p><?= $this->lang->line('qwart') ?></p>
                            </div>
                            <div class="podpisi">
                                <p><?= $this->lang->line('semi') ?></p>
                            </div>
                            <div class="podpisi">
                                <p><?= $this->lang->line('fin') ?></p>
                            </div>
                            <div class="podpisi">
                                <p><?= $this->lang->line('vin') ?></p>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>


    </div>
</div>	
</div>