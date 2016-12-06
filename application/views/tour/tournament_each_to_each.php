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
                            if($tourn[0]->type_tour == 1){
                                $type = "tournament_out";
                            }
                            else{
                                $type = "tournament_each_to_each";
                            }
                            $datas = strtotime($tourn[0]->date_finish);
                            $now = time();
                           
                            if($datas < $now ){
                                $link1 = "<a href='/".$lang."/".$this->session->userdata('side')."/".$type."/".$this->uri->segment(4)."'>Турнирная таблица</a>";
                                $link2 = "<a href='/".$lang."/".$this->session->userdata('side')."/tournament_match/".$this->uri->segment(4)."'>Матчи</a>";
                            }
                            else{
                                $link1 = "Турнирная таблица";
                                $link2 = "Матчи";
                                
                            }
                            
                            ?>
                            <li><a href="/<?=$lang?>/<?=$this->session->userdata('side')?>/tournament/<?=$this->uri->segment(4)?>">Команды участники</a></li>
                            <li><?=$link1?></li>
                            <li><?=$link2?></li>
                        </ul>
                    </div>
                </div>

                <div class="news_header">
                    <div class="col-md-5 col-sm-12 col-xs-12 left">
<!--                        <p>nickname</p>-->
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
                        <div class="liked"><p>избранное</p></div>
                    </div>
                    <div class="col-md-12 col-sm-12 col-xs-12">
                        <h3><?=$tourn[0]->name_tour?></h3>
                    </div>
                </div>
                <div class="col-md-12 col-sm-12 col-xs-12">
                    <img src="/images/tournament/<?=$tourn[0]->img_tour?>">
                </div>
                <div class="col-md-12 col-sm-12 col-xs-12 news_text">
                    <h5><?=$tourn[0]->descr_tour?></h5>
                </div>
                <div class="block_tabl_tyrnir">
                    <div class="col-md-12 col-sm-12 col-xs-12">
                        <div class="noiminovanie">
                            <h5>Таблица турнира</h5>
                            <ul>
                                <li>П</li>
                                <li>В</li>
                                <li>И</li>
                            </ul>
                        </div>
                    </div>
                    <?php
                    //var_dump($command);
                    $a = 0;
                    $b = 0;
                    foreach($coms as $coma){
                        $cou_comm = $cou_command;
                        
                    ?>
                    <div class="col-md-12 col-sm-12 col-xs-12">
                        <div class="line_tabl">
                            <div class="spisok-ychasnikov-turnir">
                                <span><?=++$a?></span>
                                <div class="avatar_tour2"></div>
                               
                                <p><?=$coma->name_command?></p>
                                
                            </div>
                           
                            <div class="sigranie-igri">
                               <?php
                               $this->db->select('*');
                               $this->db->from('tour_each');
                               $this->db->join('command','command.id_command=tour_each.fail','left');
                               $this->db->where('tour_each.id_tour',$this->uri->segment(4));
                               $this->db->where('result',$coma->id_command);
                               $qwert = $this->db->get();
                               $cou1 = count($qwert->result());
                               foreach($qwert->result() as $res){
                               ?>
                                <div class="igra_win">
                                    <div class="podskazka_win">
                                        <p><span>Победа над - </span><?=$res->name_command?></p>
                                    </div>
                                </div>
                               <?php }
                               
                               $this->db->select('*');
                               $this->db->from('tour_each');
                               $this->db->join('command','command.id_command=tour_each.result','left');
                               $this->db->where('tour_each.id_tour',$this->uri->segment(4));
                               $this->db->where('fail',$coma->id_command);
                               $qwert = $this->db->get();
                               $cou2 = count($qwert->result());
                               foreach($qwert->result() as $res){
                               ?>
                                <div class="igra_defeat">
                                    <div class="podskazka_defeat">
                                        <p><span>Поражение от - </span><?=$res->name_command?> </p>
                                    </div>
                                </div>
                               <?php } 
                               
                               $cou_comm = $cou_comm-1-($cou1+$cou2);
                               //echo $cou_comm;
                               for($o=0;$o<$cou_comm;$o++){
                               ?>
                                <div class="igra"></div>
                               <?php } ?>
                            </div>
                            <div class="itog1"><p><?=$cou2?></p></div>
                            <div class="itog2"><p><?=$cou1?></p></div>
                            <div class="itog3"><p><?=$cou1+$cou2?></p></div>
                        </div>
                    </div>
                   <?php
                   
                    }?>

                </div>

                <div class="col-md-12 col-sm-12 col-xs-12 social_turnir">
                    <div class="social_icon">
                        <ul>
                            <!--***************************************************FACEBOOK*****************************************************************************************************-->
                                <div id="fb-root"></div>
                                <meta property="og:url"           content="<?=base_url() . $lang.'/'.$this->session->userdata('side').'/tournament_each_to_each/'.$tourn[0]->tour_id?> />
                                <meta property="og:type"          content="website" />
                                <meta property="og:title"         content="<?=$tourn[0]->name_tour?>" />
                                <meta property="og:image"         content="<?=base_url().'images/tournament/'.$tourn[0]->img_tour?>" />
                                <a id="share" href="http://www.facebook.com/sharer.php?u=<?=base_url() . $lang .'/'.$this->session->userdata('side').'/tournament_each_to_each/'.$tourn[0]->tour_id ?>" onclick="window.open(this.href, this.target, 'width= 500,height=600,scrollbars=1,top=150,left=' + (window.screen.width / 2 - 250));return false;">
                                    <div class="fb"></div>
                                </a>
                                <!--------************************************************************************************************************************************-->
                                <!--***************************************************VK*****************************************************************************************************-->
                                <script type="text/javascript" src="http://vk.com/js/api/share.js?94" charset="windows-1251"></script>

                                <!-- Put this script tag to the place, where the Share button will be -->
                                <a href="http://vk.com/share.php?url=<?=base_url() . $lang .'/'.$this->session->userdata('side').'/tournament_each_to_each/'.$tourn[0]->tour_id.'&title='.$segment.'&image='.base_url().'images/tournament/'.$tourn[0]->img_tour?>&noparse=true"><div class="vk"></div></a>

                                <!--**********************************************************************************************************************************************************-->                               
                                <!--***************************************************TWITTER*****************************************************************************************************-->
                                    <a href="https://twitter.com/share?url=<?=base_url() . $lang .'/'.$this->session->userdata('side').'/tournament_each_to_each/'.$tourn[0]->tour_id.'&text='.$segment ?>"  ><div class="tv"></div></a> 
                                <!--------************************************************************************************************************************************-->
                                <!--***************************************************GOOGLE+*****************************************************************************************************-->                                
                                
                                <a href="https://plus.google.com/share?url=<?=base_url() . $lang .'/'.$this->session->userdata('side') .'/tournament_each_to_each/'.$tourn[0]->tour_id?>" onclick="javascript:window.open(this.href,'', 'menubar=no,toolbar=no,resizable=yes,scrollbars=yes,height=600,width=600'); return false;"><div class="gl"></div></a>

                                <!--------************************************************************************************************************************************-->
                                
                        </ul>
                    </div>
                </div>

            </div>

        </div>
    </div>	
</div>
</div>