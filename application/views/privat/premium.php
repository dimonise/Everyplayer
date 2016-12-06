<?php
defined('BASEPATH') OR exit('No direct script access allowed');

$id_boss = $this->session->userdata('id');
$this->db->where('user_id', $id_boss);
$query = $this->db->get('users');
$result = $query->result();

$old_date = getdate($result[0]->last_login);
$nows = getdate(time());
$teper = time();

var_dump($old_date['mon']);


if ($nows['mon'] != $old_date['mon']) {
    $this->db->where('id_user', $id_boss);
    $q = $this->db->get('golden');
    $w = $q->result();

    if ($result[0]->premium == 1) {
        $plus_gold = $w[0]->count_gold + 3;
    } else {
        $plus_gold = $w[0]->count_gold + 1;
    }
    $dd = array('count_gold' => $plus_gold);
    $this->db->where('id_user', $id_boss);
    $this->db->update('golden', $dd);
}



$this->db->where('user_id', $id_boss);
$d = array('last_login' => $teper);
$this->db->update('users', $d);
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
        <div class="news">
            <div class="col-md-3 col-sm-3 col-xs-12 menu_klan">
                <div class="row">
                    <div class="klan_avatar">
                        <div class="uzor_avatar"></div>
                        <?php
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
                            <div class="naimen2">
                                <p><?= $this->lang->line('mo') ?></p>

                            </div>
                            <div class="naimen2">
                                <p><?= $this->lang->line('hy') ?></p>
                            </div>
                            <div class="naimen2">
                                <p><?= $this->lang->line('y') ?></p>
                            </div>
                        </div>
                        <div class="line_naimenovaniya">
                            <div class="naimen2">
                                <p><?= $prem[0]->cost_month ?> руб.</p>

                            </div>
                            <div class="naimen2">
                                <p><?= $prem[0]->cost_half ?> руб.</p>
                            </div>
                            <div class="naimen2">
                                <p><?= $prem[0]->cost_year ?> руб.</p>
                            </div>
                        </div>
                        <div class="line_privat">
                            <form method="post" id="prem"> 
                                <div class="privat_block2">
                                    <input type="radio" name="sub" style="display:block !important" class="pre" value="<?= $prem[0]->cost_month ?>" data-info="1">
                                </div>
                                <div class="privat_block2">
                                    <input type="radio" name="sub" style="display:block !important" class="pre" value="<?= $prem[0]->cost_half ?>" data-info="6">

                                </div>
                                <div class="privat_block2">
                                    <input type="radio" name="sub" style="display:block !important" class="pre" value="<?= $prem[0]->cost_year ?>" data-info="12">
                                </div>
                                <input type="button" id="go_prem"  value="<?= $this->lang->line('save') ?>">    
                            </form>
                        </div>
                        <div class="line_privat">
                            <?php
                            $this->db->where('user_id', $this->session->userdata('id'));
                            $qwe = $this->db->get('users');
                            $res = $qwe->result();

                            if ($res[0]->premium == 1) {
                                echo "<p><img src='/images/medal/gold.png' title='Premium' class='golden'>Окончание срока действия подписки - " . $res[0]->data_premium . "</p>";
                            }
                            ?>
                        </div>
                        <div class="line_privat">
                            <?php
                            $this->db->where('id_user', $this->session->userdata('id'));
                            $get = $this->db->get('golden');
                            $re = $get->result();

                            $gets = $this->db->get('cost_rate');
                            $rec = $gets->result();
                            ?>
                            <h4 style="color:white"><?= $this->lang->line('one') ?><?= $re[0]->count_gold; ?><img src="/images/top.png" class="golden"><?= $this->lang->line('two') ?><?= $rec[0]->cost ?><?= $this->lang->line('three') ?><?= $rec[0]->rate ?><?= $this->lang->line('four') ?></h4> 
                            <?php
                            $this->db->where('id_user', $this->session->userdata('id'));
                            $get = $this->db->get('golden');
                            $ge = $get->result();
                            if ($ge[0]->count_gold >= $rec[0]->cost) {
                                ?>
                                <input type="button" id="go_top"  value="<?= $this->lang->line('vtop') ?>">    
                                <?php
                            } else {
                                echo "<p style='color:red'>" . $this->lang->line('not_pay') . "</p>";
                            }
                            ?>  


                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>	
</div>
<script>
    $('#go_prem').click(function () {
        $.ajax({
            url: '/privat/in_prem',
            method: 'POST',
            data: {id_user: <?= $this->session->userdata('id') ?>, prem: $('input:radio:checked').data('info')},
            success: function () {
                alert('<?= $this->lang->line('scc_sub') ?>');
            }
        });
    })

    $('#go_top').click(function () {
        $.ajax({
            url: '/privat/in_top',
            method: 'POST',
            data: {id_user: <?= $this->session->userdata('id') ?>, top: '<?= $rec[0]->cost ?>', end_time: '<?= $rec[0]->rate ?>'},
            success: function () {
                alert('<?= $this->lang->line('scc_top') ?>');
                location.reload();
            }
        });
    })
</script>