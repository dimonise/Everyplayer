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
    <div class="news-top-bg row">
        <div class="picLeft"></div>
        <div class="picRight"></div>
        <div class="news">
            <div class="faq_block">
                <div class="col-md-12 col-sm-12 col-xs-12">
                    <h3>F.A.Q</h3>
                    <?php
                    if ($lang == 'en') {
                    ?>
                    <p><?=$faq[0]->text_en?></p>
                    <?php
                    }
                    else{
                        echo $faq[0]->text;
                    }
                    ?>
                </div>
            </div>


            <div class="col-md-6 col-sm-6 col-xs-12">
                <div class="social_icon">
                    <ul>
                         <!--***************************************************FACEBOOK*****************************************************************************************************-->
                                <div id="fb-root"></div>
                                <meta property="og:url"           content="<?= base_url() . $lang ?>/<?= $this->session->userdata('side') ?>/faq" />
                                <meta property="og:type"          content="website" />
                                <meta property="og:title"         content="F.A.Q" />
                                <meta property="og:image"         content="" />
                                <a id="share" href="http://www.facebook.com/sharer.php?u=<?= base_url() . $lang ?>/<?= $this->session->userdata('side') ?>/faq/" onclick="window.open(this.href, this.target, 'width= 500,height=600,scrollbars=1,top=150,left=' + (window.screen.width / 2 - 250));return false;">
                                    <div class="fb"></div>
                                </a>
                                <!--------************************************************************************************************************************************-->
                                <!--***************************************************VK*****************************************************************************************************-->
                                <script type="text/javascript" src="http://vk.com/js/api/share.js?94" charset="windows-1251"></script>

                                <!-- Put this script tag to the place, where the Share button will be -->
                                <a href="http://vk.com/share.php?url=<?= base_url() . $lang ?>/<?= $this->session->userdata('side') ?>/faq&title=F.A.Q&noparse=true"><div class="vk"></div></a>

                                <!--**********************************************************************************************************************************************************-->                               
                                <!--***************************************************TWITTER*****************************************************************************************************-->
                                    <a href="https://twitter.com/share?url=<?= base_url() . $lang ?>/<?= $this->session->userdata('side') ?>/faq&text=F.A.Q"  ><div class="tv"></div></a> 
                                <!--------************************************************************************************************************************************-->
                                <!--***************************************************GOOGLE+*****************************************************************************************************-->                                
                                
                                <a href="https://plus.google.com/share?url=<?= base_url() . $lang ?>/<?= $this->session->userdata('side') ?>/faq" onclick="javascript:window.open(this.href,
                                                '', 'menubar=no,toolbar=no,resizable=yes,scrollbars=yes,height=600,width=600');
                                        return false;"><div class="gl"></div></a>

                                <!--------************************************************************************************************************************************-->
                               
                    </ul>
                </div>
            </div>

        </div>
    </div>	
</div>

</div>
