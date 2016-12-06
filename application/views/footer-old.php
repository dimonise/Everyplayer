
<?php
defined('BASEPATH') OR exit('No direct script access allowed');

$qw = $this->db->get('footer');
				$re = $qw->result();
?>

<footer>
<!--
	<div class="container">
		<div class="row">
			<div class="col-md-4 col-sm-4 col-xs-12 left-footer">
				<p><?=$this->lang->line('soca')?></p>
				<?php 
				echo $re[0]->text_left;
				?>
				
				<div class="social_footer">
					<ul>
						<!--***************************************************FACEBOOK*****************************************************************************************************-->
                                <div id="fb-root"></div>
                                <meta property="og:url"           content="<?= base_url()?>" />
                                <meta property="og:type"          content="website" />
                                <meta property="og:title"         content="EVERYPLAYER" />
                                <meta property="og:image"         content="" />
                                <a id="share" href="http://www.facebook.com/sharer.php?u=<?= base_url()?>" onclick="window.open(this.href, this.target, 'width= 500,height=600,scrollbars=1,top=150,left=' + (window.screen.width / 2 - 250));return false;">
                                    <div class="fb2"></div>
                                </a>
                                <!--------************************************************************************************************************************************-->
                                <!--***************************************************VK*****************************************************************************************************-->
                                <script type="text/javascript" src="http://vk.com/js/api/share.js?94" charset="windows-1251"></script>

                                <!-- Put this script tag to the place, where the Share button will be -->
                                <a href="http://vk.com/share.php?url=<?= base_url()?>&title=EVERYPLAYER&noparse=true"><div class="vk2"></div></a>

                                <!--**********************************************************************************************************************************************************-->                               
                                <!--***************************************************TWITTER*****************************************************************************************************-->
                                    <a href="https://twitter.com/share?url=<?= base_url()?>&text=EVERYPLAYER"  ><div class="tv2"></div></a> 
                                <!--------************************************************************************************************************************************-->
                                <!--***************************************************GOOGLE+*****************************************************************************************************-->                                
                                
                                <a href="https://plus.google.com/share?url=<?= base_url()?>" onclick="javascript:window.open(this.href,
                                                '', 'menubar=no,toolbar=no,resizable=yes,scrollbars=yes,height=600,width=600');
                                        return false;"><div class="gl2"></div></a>

                                <!--------************************************************************************************************************************************-->
                               
					</ul>
				</div>
			</div>
			<div class="col-md-4 col-sm-4 col-xs-12 center-footer">
				<?php 
				echo $re[0]->text_center;
				?>
				
                                <a href="<?=base_url().$lang.'/'.$this->session->userdata('side').'/rules'?>"><p><span><?=$this->lang->line('ruless')?></span></p></a>
			</div>
			<div class="col-md-4 col-sm-4 col-xs-12 right-footer">
				<a href="/<?= $lang . '/' . $this->session->userdata('side') ?>/players"><p><?= $this->lang->line('gamer'); ?></p></a>
				 <a href="/<?= $lang ?>/<?= $this->session->userdata('side'); ?>/my_clans"><p><?= $this->lang->line('mclans'); ?></p></a>
				<a href="/<?= $lang ?>/<?= $this->session->userdata('side'); ?>/search_clan"><p><?= $this->lang->line('sclans'); ?></p></a>
				<a href="/<?= $lang . '/' . $this->session->userdata('side') ?>/gides"><p><?= $this->lang->line('gides'); ?></p></a>
				<a href="/<?= $lang . '/' . $this->session->userdata('side') ?>/tournaments"><p><?= $this->lang->line('turnam'); ?></p></a>
				<a href=""><img src="<?php echo base_url();?>images/eng_lang.png"></a>
				<a href=""><img src="<?php echo base_url();?>images/rus_lang.png"></a>
			</div>
		</div>
	</div>
	-->
</footer>
<script type="text/javascript">
var res=true;
	$('.gam').on('click', function(){
		if(res == true){
			$(this).parents().addClass('active');
			res=false;
		}else{
			$(this).parents().removeClass('active');
			res=true;
		}
	})
</script>
<script>
       $("#lang").change(function(){
           var side = '<?php echo $this->session->userdata('side');?>';
            location.href="/"+$('#lang').val()+"/home/"+side;
        })
        </script>
        <script>
    /**Подключение скролла**/
    $(function ()
    {
        $('.scroll-pane').jScrollPane();
    });
</script>
</body>
</html>
