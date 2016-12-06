<div class="container registr">
		<div class="row">
			<div class="registr_center">
				<img src="/images/up_registr.png" alt="">
				<p><?=$this->lang->line('log_txt')?></p>
                                <form method="post" action="/auth/checklogin">
				<div class="border-top">
					<input class="name" type="text" value="" name="email" placeholder="<?=$this->lang->line('index_email_th')?>:">
					<div class="border-top-bottom"></div>
				</div>
				<div class="border-top">
					<input class="pass" type="password" value="" name="password" placeholder="<?=$this->lang->line('login_password_label')?>">
					<div class="border-top-bottom"></div>
                                        <input type="hidden" value="<?=$lang?>" name="lang">
				</div>
                                
				<a href="/<?=$lang?>/auth/checklogin"><h6><?=$this->lang->line('forgot_password_heading')?></h6></a>
				<input class="button_black_regist" type="submit" value="<?=$this->lang->line('login_heading')?>"></form>
				<a href="/<?=$lang?>/<?=$this->session->userdata('side')?>/registration"><h5><?=$this->lang->line('registr')?></h5></a>
			</div>
                    <ul id="uLogin">
                    <?php echo $user; ?>
                    <p class="fb" data-uloginbutton="facebook"></p>
                    <p class="vk" data-uloginbutton="vkontakte"></p>

                </ul>
		</div>	
	</div>
<script> 
 $(document).ready(function () {
        $('.ulogin-buttons-container').hide();
    });
    $("#uLogin p").click(function () {
        var imgS = $(this).attr('data-uloginbutton');
        
        $('.ulogin-buttons-container > div[data-uloginbutton = ' + imgS + ']').click();
    });
    </script>