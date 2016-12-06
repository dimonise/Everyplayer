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
                    </div>
                </div>
                <div class="news_header">
                    <div class="col-md-5 col-sm-12 col-xs-12 left">

                        <?php
                        $arrr = explode(" ", $tourn[0]->date_start);
                        $arr = explode(":", $arrr[1]);
                        $ar = explode("-", $arrr[0]);
                        $this->load->helper('trans_helper');
                                $name = str_replace(' ', '_', $tourn[0]->name_tour);
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
                        echo "<p>" . $ar[2] . ' ' . $datas . ' ' . $arr[0] . ':' . $arr[1] . "</p>";
                        ?>
                    </div>
                    <div class="col-md-7 col-sm-12 col-xs-12 right">
<!--                        <div class="chleni"><p>участников</p></div>
                        <div class="comments"><p>коментарии</p></div>-->
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
                    <img src="/images/tournament/<?= $tourn[0]->img_tour ?>">
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
                </div>
                <div class="ychasniki_marg_top">
                    <div class="col-md-3 col-sm-3 col-xs-12">

                        <div class="fonds">
                            <p><?= $this->lang->line('pize') ?></p>
                            <ul>
                                <li>1 - $<?= $tourn[0]->first ?></li>
                                <li>2 - $<?= $tourn[0]->second ?></li>
                                <li>3 - $<?= $tourn[0]->three ?></li>
                            </ul>
                            <?php
                            if($datas_all<$now){
                                echo '<p>'.$this->lang->line('tur_end').'</p>';
                            }
                            else{
                            ?>
                            <h5><?= $this->lang->line('t_st') ?></h5>
                            <?php } ?>
                        </div>

                    </div>
                    <div class="col-md-9 col-sm-9 col-xs-12">
                        <div class="next_game">
                            <select class="game_filtr">
                                <option value=""><?= $this->lang->line('all_games') ?></option>
                                <option value="1"><?= $this->lang->line('up_g') ?></option>
                                <option value="2"><?= $this->lang->line('pl_g') ?></option>
                            </select>
                        </div>
                    </div>
                    <section>
                    <?php
                    foreach ($comm as $coma) {
                        ?>
                        <div class="col-md-9 col-sm-9 col-xs-12 ychasniki-right">
                            <div class="komandi_turnira">
                                <div class="komanda1">
                                    <?php
                                    $this->db->where('id_command', $coma->first);
                                    $q = $this->db->get('command');
                                    $query = $q->result();
                                    ?>
                                    <p><?= $query[0]->name_command ?></p>
                                    <div class="avatar_komanda1" style="background-image:url(/images/tournament/<?= $query[0]->logo_command ?>)"></div>
                                </div>
                                <div class="protiv">vs</div>
                                <div class="komanda2">
                                    <?php
                                    $this->db->where('id_command', $coma->second);
                                    $q = $this->db->get('command');
                                    $query = $q->result();
                                    ?>
                                    <p><?= $query[0]->name_command ?></p>
                                    <div class="avatar_komanda2" style="background-image:url(/images/tournament/<?= $query[0]->logo_command ?>)"></div>
                                </div>
                                <div class="data_game">
                                    <?php
                                    $arrrr = str_replace('T', ' ', $coma->datas);

                                    $arrr = explode(" ", $arrrr);
                                    $arr = explode(":", $arrr[1]);
                                    $ar = explode("-", $arrr[0]);
                                    if ($lang == 'en') {
                                        $datas = $month_array_en[$ar[1]];
                                    } else {

                                        $datas = $month_array_rus[$ar[1]];
                                    }
                                    echo "<p>" . $ar[2] . ' ' . $datas . ' ' . $arr[0] . ':' . $arr[1] . "</p>";
                                    ?>
                                    <!--<p><?= $coma->datas ?></p>-->
                                </div>
                            </div>
                        </div>
                    <?php } ?>
                        </section>
                    <div class="col-md-12 col-sm-12 col-xs-12 social_turnir">
                        <div class="social_icon">
                            <ul>
                                <!--***************************************************FACEBOOK*****************************************************************************************************-->
                                <div id="fb-root"></div>
                                <meta property="og:url"           content="<?=base_url() . $lang.'/'.$this->session->userdata('side').'/tournament_match/'.$tourn[0]->tour_id?> />
                                <meta property="og:type"          content="website" />
                                <meta property="og:title"         content="<?=$tourn[0]->name_tour?>" />
                                <meta property="og:image"         content="<?=base_url().'images/tournament/'.$tourn[0]->img_tour?>" />
                                <a id="share" href="http://www.facebook.com/sharer.php?u=<?=base_url() . $lang .'/'.$this->session->userdata('side').'/tournament_match/'.$tourn[0]->tour_id ?>" onclick="window.open(this.href, this.target, 'width= 500,height=600,scrollbars=1,top=150,left=' + (window.screen.width / 2 - 250));return false;">
                                    <div class="fb"></div>
                                </a>
                                <!--------************************************************************************************************************************************-->
                                <!--***************************************************VK*****************************************************************************************************-->
                                <script type="text/javascript" src="http://vk.com/js/api/share.js?94" charset="windows-1251"></script>

                                <!-- Put this script tag to the place, where the Share button will be -->
                                <a href="http://vk.com/share.php?url=<?=base_url() . $lang .'/'.$this->session->userdata('side').'/tournament_match/'.$tourn[0]->tour_id.'&title='.$segment.'&image='.base_url().'images/tournament/'.$tourn[0]->img_tour?>&noparse=true"><div class="vk"></div></a>

                                <!--**********************************************************************************************************************************************************-->                               
                                <!--***************************************************TWITTER*****************************************************************************************************-->
                                    <a href="https://twitter.com/share?url=<?=base_url() . $lang .'/'.$this->session->userdata('side').'/tournament_match/'.$tourn[0]->tour_id.'&text='.$segment ?>"  ><div class="tv"></div></a> 
                                <!--------************************************************************************************************************************************-->
                                <!--***************************************************GOOGLE+*****************************************************************************************************-->                                
                                
                                <a href="https://plus.google.com/share?url=<?=base_url() . $lang .'/'.$this->session->userdata('side') .'/tournament_match/'.$tourn[0]->tour_id?>" onclick="javascript:window.open(this.href,'', 'menubar=no,toolbar=no,resizable=yes,scrollbars=yes,height=600,width=600'); return false;"><div class="gl"></div></a>

                                <!--------************************************************************************************************************************************-->
                                
                            </ul>
                        </div>
                    </div>
                </div>
            </div>

        </div>
    </div>	
</div>

</div>

<script>
    $('.game_filtr').change(function () {
        if ($(this).val() == 0) {
            location.reload();
        } else {
            $.ajax({
                url: '/tour/sel_match',
                method: 'POST',
                data: {filtr: $(this).val(), id_tour:<?= $this->uri->segment(4) ?>},
                success: function (html) {

                $("section").html(html);

                }
            })
        }
    })
</script>