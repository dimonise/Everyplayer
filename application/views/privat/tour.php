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
    <div class="row">
        <div class="news">
            <div class="col-md-3 col-sm-3 col-xs-12 menu_klan">
                <div class="row">
                    <div class="klan_avatar">
                        <div class="uzor_avatar"></div>
                        <?php
                        $id_boss = $this->session->userdata('id');
                        $this->db->where('user_id', $id_boss);
                        $query = $this->db->get('users');
                        $result = $query->result();
                        $this->load->helper('trans_helper');

                        if (!empty($result[0]->avatar)) {
                            $img = '/images/avatar/' . $result[0]->avatar;
                        } else {
                            $img = '/images/avatar/avatar.jpg';
                        }
                        ?>
                        <img src="<?= $img ?>">
                    </div>
                    <div class="nav_klan">
                        <ul>
                            <li><a href="/<?= $lang ?>/<?= $this->session->userdata('side'); ?>/privat_friends/<?= $this->session->userdata('id'); ?>"><?= $this->lang->line('friend_pr') ?></a></li>
                            <li><a href="/<?= $lang ?>/<?= $this->session->userdata('side'); ?>/privat_achievements/<?= $this->session->userdata('id'); ?>"><?= $this->lang->line('achi_pr') ?></a></li>
                            <li><a href="/<?= $lang ?>/<?= $this->session->userdata('side'); ?>/privat_clans/<?= $this->session->userdata('id'); ?>"><?= $this->lang->line('clans_pr') ?></a></li>
                            <li><a href="/<?= $lang ?>/<?= $this->session->userdata('side'); ?>/privat_tour/<?= $this->session->userdata('id'); ?>"><?= $this->lang->line('tour_pr') ?></a></li>
                            <li><a href=""><?= $this->lang->line('mes_pr') ?></a></li>
                            <li><a href="/<?= $lang ?>/<?= $this->session->userdata('side'); ?>/privat_favorites/<?= $this->session->userdata('id'); ?>"><?= $this->lang->line('fav_pr') ?></a></li>
                            <li><a href="/<?= $lang ?>/<?= $this->session->userdata('side'); ?>/privat_premium/<?= $this->session->userdata('id'); ?>"><?= $this->lang->line('fav_prem') ?></a></li>
                        </ul>
                    </div>

                </div>
            </div>
            <div class="otstyp_klan">
                <div class="col-md-9 col-sm-9 col-xs-12 players_privat">
                    <div class="row">
                        <div class="line_naimenovaniya">
                            <div class="naimen1">
                                <p><?= $this->lang->line('tour_pr_pr') ?></p>
                            </div>
                            <div class="naimen2">
                                <p><?= $this->lang->line('datas') ?></p>
                            </div>
                            <div class="naimen3">
                                <p><?= $this->lang->line('pize') ?></p>
                            </div>
                        </div>
                        <?php
                        foreach ($tours as $tour) {
                            $name = str_replace(' ', '_', $tour[0]->name_tour);
                            $name = str_replace('&', '_', $name);
                            $name = str_replace('(', '_', $name);
                            $name = str_replace(')', '_', $name);
                            $name = str_replace("'", '_', $name);
                            $name = str_replace('"', '_', $name);
                            $segment = mb_strtolower(transliterate($name));
                            ?>

                            <div class="line_privat">
                                <div class="privat_block1">
                                    <div class="avatar_tour2" style="background-image: url(/images/tournament/<?= $tour[0]->img_tour ?>);background-size: cover;background-position: center;"></div>
                                    <p><a href="/<?= $lang ?>/<?= $this->session->userdata('side') ?>/tournament/<?= $tour[0]->tour_id ?>/<?= $segment ?>"><?= $tour[0]->name_tour ?></a></p>
                                </div>
                                <div class="privat_block2">
                                    <?php
                                    $arrr = explode(" ", $tour[0]->date_start);
                                    $arr = explode(":", $arrr[1]);
                                    $ar = explode("-", $arrr[0]);

                                    if ($lang == 'en') {
                                        $datas = $month_array_en[$ar[1]];
                                    } else {

                                        $datas = $month_array_rus[$ar[1]];
                                    }
                                    echo '<p>' . $ar[2] . ' ' . $datas . ' ' . $ar[0] . '</p>';
                                    ?>

                                </div>
                                <div class="privat_block3">
                                    <p><?= $tour[0]->first + $tour[0]->second + $tour[0]->three ?> руб</p>
                                </div>
                            </div>
                        <?php } ?>
                    </div>
                </div>
            </div>

        </div>



    </div>
</div>	
</div>
