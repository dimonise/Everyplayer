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
                        <!--<p><?= $tourn ?></p>-->
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
                            $datass = $month_array_en[$ar[1]];
                        } else {

                            $datass = $month_array_rus[$ar[1]];
                        }
                        echo "<p>" . $ar[2] . ' ' . $datass . ' ' . $arr[0] . ':' . $arr[1] . "</p>";
                        ?>

                    </div>
                    <div class="col-md-7 col-sm-12 col-xs-12 right">
                        <div class="liked" data-info="<?= $tourn[0]->tour_id ?>"><p><?= $this->lang->line('liked') ?></p></div>
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
                            if ($datas < $now) {
                                $classs = 'prinats';
                                $finish1 = "<p>" . $this->lang->line('team_req') . "</p>";
                                $finish2 = "<p>" . $this->lang->line('tour_end') . " - " . $tourn[0]->date_finish_all . "</p>";
                            } else {
                                $classs = 'prinat';
                                $finish1 = "<p>" . $this->lang->line('team_end') . " - " . $tourn[0]->date_finish . "</p>";
                                $finish2 = "<p>" . $this->lang->line('tour_end') . " - " . $tourn[0]->date_finish_all . "</p>";
                            }
                            if ($datas_all < $now) {
                                $finish2 = "<p>" . $this->lang->line('tur_end') . "</p>";
                            }
                            $this->db->where('id_who', $tourn[0]->for_who);
                            $q = $this->db->get('for_who_tour');
                            $q = $q->result();
                            ?>

                            <input type="button" class="<?= $classs ?>" value="<?= $q[0]->the_who ?>"  disabled="disabled">
                            <input type="button" class="<?= $classs ?>" value="<?= $tourn[0]->pay_tour ?>"  disabled="disabled">
                            <input type="button" class="<?= $classs ?>" value="<?= $this->lang->line('forprem') ?><?= $tourn[0]->pay_tour_prem ?>"  disabled="disabled">
                            <input type="button" class="<?= $classs ?>" value="<?= $this->lang->line('part') ?>" <?php if (!$this->session->userdata('id')) {
                                echo "disabled";
                            }
if($this->session->userdata('id')){							
                            if($tourn[0]->for_who == 2){
                                $this->db->where('user_id', $this->session->userdata('id'));
                                $qwe = $this->db->get('users');
                                $resus = $qwe->result();
                                if($resus[0]->premium == 0){
                                     echo "disabled";
                                }
                            }
							}
                            ?>>
                            <p></p>
                            <p></p>
<?= $finish1 ?>
<?= $finish2 ?>


                        </div>

                    </div>

                    <div class="col-md-9 col-sm-9 col-xs-12 ychasniki-right">
                        <?php
                        foreach ($command as $mem) {
                            ?>
                            <div class="ychasniki-tyrnira">
                                <div class="vivod_avatar_tyrnira">
                                    <div class="avatar-tyrnira" style="background-image: url(/images/tournament/<?= $mem->logo_command ?>);background-size: cover;background-position: center;"></div>
                                    <p><?= $mem->name_command ?></p>
                                </div>
                                <div class="spisok-ychasnikov">
                                    <ul>
                                        <?php
                                        $this->db->select('*');
                                        $this->db->from('members_command');
                                        $this->db->join('users', 'users.user_id = members_command.id_user', 'left');
                                        $this->db->where('members_command.id_comm', $mem->id_command);
                                        $member = $this->db->get();
                                        foreach ($member->result() as $value) {
                                            $this->db->where('id_med', $value->medal);
                                            $med = $this->db->get('medal');
                                            $medal = $med->result();
                                            ?>
                                            <li><div class="avatar_tour2" style="background-image: url(/images/avatar/<?= $value->avatar ?>);background-size: cover;background-position: center;"></div>
                                                <?php if (@$medal[0]->medal_img) { ?>
                                                    <p class='nagradi'><img src='/images/medal/<?= $medal[0]->medal_img ?>'></p>
                                            <?php } ?>
                                                <p><?= $value->username ?></p></li>
    <?php }
    ?>
                                    </ul>
                                </div>
                            </div>
<?php } ?>
                    </div>

                    <div class="col-md-12 col-sm-12 col-xs-12 social_turnir">
                        <div class="social_icon">
                            <ul>
                                <!--***************************************************FACEBOOK*****************************************************************************************************-->
                                <div id="fb-root"></div>
                                <meta property="og:url"           content="<?= base_url() . $lang . '/' . $this->session->userdata('side') . '/tournament/' . $tourn[0]->tour_id ?> />
                                      <meta property="og:type"          content="website" />
                                      <meta property="og:title"         content="<?= $tourn[0]->name_tour ?>" />
                                <meta property="og:image"         content="<?= base_url() . 'images/tournament/' . $tourn[0]->img_tour ?>" />
                                <a id="share" href="http://www.facebook.com/sharer.php?u=<?= base_url() . $lang . '/' . $this->session->userdata('side') . '/tournament/' . $tourn[0]->tour_id ?>" onclick="window.open(this.href, this.target, 'width= 500,height=600,scrollbars=1,top=150,left=' + (window.screen.width / 2 - 250)); return false;">
                                    <div class="fb"></div>
                                </a>
                                <!--------************************************************************************************************************************************-->
                                <!--***************************************************VK*****************************************************************************************************-->
                                <script type="text/javascript" src="http://vk.com/js/api/share.js?94" charset="windows-1251"></script>

                                <!-- Put this script tag to the place, where the Share button will be -->
                                <a href="http://vk.com/share.php?url=<?= base_url() . $lang . '/' . $this->session->userdata('side') . '/tournament/' . $tourn[0]->tour_id . '&title=' . $segment . '&image=' . base_url() . 'images/tournament/' . $tourn[0]->img_tour ?>&noparse=true"><div class="vk"></div></a>

                                <!--**********************************************************************************************************************************************************-->                               
                                <!--***************************************************TWITTER*****************************************************************************************************-->
                                <a href="https://twitter.com/share?url=<?= base_url() . $lang . '/' . $this->session->userdata('side') . '/tournament/' . $tourn[0]->tour_id . '&text=' . $segment ?>"  ><div class="tv"></div></a> 
                                <!--------************************************************************************************************************************************-->
                                <!--***************************************************GOOGLE+*****************************************************************************************************-->                                

                                <a href="https://plus.google.com/share?url=<?= base_url() . $lang . '/' . $this->session->userdata('side') . '/tournament/' . $tourn[0]->tour_id ?>" onclick="javascript:window.open(this.href, '', 'menubar=no,toolbar=no,resizable=yes,scrollbars=yes,height=600,width=600'); return false;"><div class="gl"></div></a>

                                <!--------************************************************************************************************************************************-->

                            </ul>
                        </div>
                    </div>
                </div>
            </div>

        </div>
    </div>	
</div>

<!--ПОПАП ПРИНЯТЬ УЧАСТИЕ-->
<div id="popup_prinat">
    <div class="container">
        <div class="row">
            <button class="close" title="Закрыть" onclick="document.getElementById('popup_prinat').style.display = 'none';">
                <img alt="" src="/images/close.png">
            </button>
            <div class="popup_podlogka2">
                <h4><?= $this->lang->line('r_team') ?></h4>
                <form method="post" action="/tour/new_command/<?= $this->uri->segment(4) ?>" enctype="multipart/form-data">
                    <input type="text" class="popup_input" placeholder="<?= $this->lang->line('name_team') ?>" value="" name="name_command">
                    <div class="avatar_moder_pop">

                        <h4><?= $this->lang->line('avat') ?></h4>
                        <img src="/images/klan_avatar.png">
                        <input id="userfile" name="userfile" type="file" style="position:absolute; top:-999px; visibility:hidden" accept="image/*"/>
                        <input class="vibor_fail" type="button" value="<?= $this->lang->line('s_fil') ?>" id="edit_avatar">
                        <script>
                            var input = document.querySelector("#userfile");
                            var btn = document.querySelector("#edit_avatar");
                            btn.onclick = function () {
                                input.click();
                            };
                        </script>
<!--                        <script>
                            var input = document.querySelector("input[type='file']");
                            input.onchange = function () {
                                this.form.submit();
                            }
                        </script>-->
                        <!--                    <div class="ssilka_moder_pop">
                                                <p>или</p>
                                                <input type="text" class="ssilka_na_fail" placeholder="укажите ссылку на файл" value="">
                                                <input class="popup_button2" type="button" value="Сохранить">
                                            </div>-->

                    </div>
                    <div class="smena_glovi">
                        <h4><?= $this->lang->line('ad_pl') ?></h4>
                        <div class="no-select">
                            <link rel="stylesheet" href="//cdnjs.cloudflare.com/ajax/libs/select2/4.0.1/css/select2.min.css">
                            <script src="//cdnjs.cloudflare.com/ajax/libs/select2/4.0.1/js/select2.min.js"></script>
                            <script src="/js/selection.js"></script>
                            <div class="select-prinat">
                                <select class="limitedNumbSelect4" multiple="true" name="players[]">
                                    <?php
                                    foreach ($users as $friend) {
                                        ?> 
                                        <option value="<?= $friend->friend_id ?>"><?= $friend->username ?></option>
<?php } ?>        
                                </select>
                            </div>

                            <input class="oplata" type="submit" value="<?= $this->lang->line('pay_t') ?>">
                            </form>
                        </div>
                    </div>

            </div>

        </div>
    </div>
</div>
</div>
<!--КОНЕЦ ПОПАП ПРИНЯТЬ УЧАСТИЕ-->
<div class="cover"></div>
<script type="text/javascript">
                            var res = true;
                            $('.gam').on('click', function () {
                                if (res == true) {
                                    $(this).parents().addClass('active');
                                    res = false;
                                } else {
                                    $(this).parents().removeClass('active');
                                    res = true;
                                }
                            })
</script>
<script>
    $(function () {
        $(".prinat").click(function () {
            $(".cover").css('display', 'block');
        })
    })
</script>
<script>
    $(function () {
        $(".close").click(function () {
            $(".cover").css('display', 'none');
        })
    })
</script>

<script>
    /**ДЛЯ Принятия в клан**/

    $(function () {
        $(".prinat").click(function () {
            $("#popup_prinat").css('display', 'block');
        })
    })
</script>
<script>
    $('.liked').click(function () {
        var id = $(this).data('info');
        $.ajax({
            url: '/privat/tour',
            method: 'POST',
            data: {id_tour: id},
            success: function () {
                alert('Турнир добавлен в избранное');
            }
        });
    })
</script>