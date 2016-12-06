<?php
defined('BASEPATH') OR exit('No direct script access allowed');
?>

<div class="bg-black" <?php if($this->uri->segment(3) == 'registration'){echo "style='background-size:cover'";}?>>
    <header>
        <div class="container-fluid">
        </div>
        <div class="container-fluid">
            <div class="row">
                <nav class="nav_black">
                    <a href="/<?= $lang ?>/home/<?= $this->session->userdata('side'); ?>"><div class="logo_black"></div></a>
                    <div class="gam"></div>
                    <div class="container navigation">
                        <div class="row">
                            <ul>
                                <a href="/<?= $lang ?>/home/<?= $this->session->userdata('side'); ?>"><li><?= $this->lang->line('home'); ?></li></a>
                                <a href="/<?= $lang ?>/<?= $this->session->userdata('side'); ?>/faq"><li><?= $this->lang->line('faq'); ?></li></a>
                                <a href="/<?= $lang ?>/<?= $this->session->userdata('side'); ?>/about"><li><?= $this->lang->line('advertise'); ?></li></a>
                                <a href="/<?= $lang ?>/<?= $this->session->userdata('side'); ?>/rules"><li><?= $this->lang->line('rules'); ?></li></a>
                                <select onchange="perehod()" id="perehod">
                                    <option value="" disabled selected style='display:none;'><?= $this->lang->line('clans'); ?></option>
                                    <option value="1"><?= $this->lang->line('sclans'); ?></option>
                                    <option value="2"><?= $this->lang->line('mclans'); ?></option>

                                </select>
                            </ul>
                            <div class="nav-right">
                                <select  id="lang">
                                    <option value="ru" <?php if ($this->uri->segment(1) == 'ru') {
    echo "selected";
} ?>>RU</option>
                                    <option value="en" <?php if ($this->uri->segment(1) == 'en') {
    echo "selected";
} ?>>ENG</option>
                                </select>
<?php
if (!$this->session->userdata('id')) {
    ?>
                                    <a href="/<?= $lang ?>/<?= $this->session->userdata('side') ?>/login"><li><?= $this->lang->line('login_submit_btn'); ?></li></a>
                                    <a href="/<?= $lang ?>/<?= $this->session->userdata('side') ?>/registration"><li><?= $this->lang->line('registr'); ?></li></a>
                                    <?php
                                } else {
                                    echo "<a href='/$lang/" . $this->session->userdata('side') . "/privat_info/" . $this->session->userdata('id') . "'><li>" . $this->session->userdata('username') . "</li></a>";
                                    echo "<a href='/auth/logout'><li>" . $this->lang->line('exit') . "</li></a>";
                                }
                                ?>
                            </div>
                        </div>
                    </div>

                </nav>

            </div>
        </div>
    </header>
    <?php
    if ($this->uri->segment(3) != 'registration' && $this->uri->segment(3) != 'login' && $this->uri->segment(2) != 'creat_user' && $this->uri->segment(1) != 'auth') {
        ?>
        <div class="container">
            <div class="row">
                <div id="carousel-example-generic" class="carousel slide" data-ride="carousel">
                    <!-- Indicators -->
                    <ol class="carousel-indicators">
                        <li data-target="#carousel-example-generic" data-slide-to="0" class="active"></li>
                        <?php
                        for ($i = 1; $i < count($slider); $i++) {
                            echo '<li data-target="#carousel-example-generic" data-slide-to="' . $i . '"></li>';
                        }
                        ?> 
                    </ol>

                    <!-- Wrapper for slides -->
                    <div class="carousel-inner">

                        <?php
                        foreach ($slider as $slide) {
                            ?>
                            <div class="item <?php if ($slide->slide_id == 1) {
                        echo "active";
                    } ?>">
                                <div class="slide1">
                                    <a href="<?php echo $slide->source; ?>">
                                        <img src="<?php echo base_url(); ?>images/slider/<?php echo $slide->img; ?>">
                                    </a>
                                </div>
                            </div>
    <?php } ?>

                    </div>
                </div>
            </div>
        </div>
        <?php
    }
    ?>
    <script>
        function perehod() {
            var link = $("#perehod").val();
            if (link == 1) {
                location.href = "/<?= $lang ?>/<?= $this->session->userdata('side'); ?>/search_clan";
            }
            if (link == 2) {
                location.href = "/<?= $lang ?>/<?= $this->session->userdata('side'); ?>/my_clans";
            }
        }

        $(document).ready(function () {
            var page = '<?= $this->uri->segment(2) ?>';
            if (page != 'home') {
                $('#carousel-example-generic').remove();
                $('.images_for_black').css('margin-top', '-20px');
            }
        })
    </script>
    <?php
    if ($this->session->userdata('id')) {
        $this->db->where('user_id', $this->session->userdata('id'));
        $qwer = $this->db->get('users');
        $prem = $qwer->result();
        if (strtotime($prem[0]->data_premium) < time()) {
            $dat = array('premium' => 0, 'data_premium' => '');
            $this->db->where('user_id', $this->session->userdata('id'));
            $this->db->update('users', $dat);
        }
    }
    
   
    
    ?>
