<div class="container registr">
    <div class="row">
        <div class="registr_center">
            <img src="/images/up_registr.png" alt="">
            <h3><?=$this->lang->line('reg_hed')?> </h3>
            <!--<p><?=$this->lang->line('reg_txt')?></p>-->
            <form name="reg" id="reg" method="post">
            <div class="border-top">
                <input class="name" type="text" value="" placeholder="<?=$this->lang->line('create_user_fname_label')?>" name="first_name" required>
                <div class="border-top-bottom"></div>
            </div>
            <div class="border-top">
                <input class="nikname" type="text" value="" placeholder="<?=$this->lang->line('nik')?>" name="nick" required>
                <div class="border-top-bottom"></div>
            </div>
            <div class="flex-container">
                <div class="border-top-select">
                    <div class="select_day">
                        <select name="bday" required >
                            <option disabled selected="selected"><?=$this->lang->line('d')?></option>
                            <?php
                            for($i=1;$i<32;$i++){
                            echo "<option value='$i'>$i</option>";
                            }
                            ?>
                        </select>
                    </div>
                    <div class="border-bottom-select"></div>
                </div>
                <div class="border-top-select2">
                    <div class="select_month" >
                        <select name="bmonth" required>
                            <option disabled selected="selected"><?=$this->lang->line('mo')?></option>
                            <?php
                            for($i=1;$i<13;$i++)
                            {
                                if($i<=9){$d=0;}else{$d='';}
                            if ($lang == 'en') {
                                echo "<option value='$d$i'>".$month_array_en[$d.$i]."</option>";
                            } else {

                               echo "<option value='$d$i'>".$month_array_rus[$d.$i]."</option>";
                            }
                            }
                            ?>
                        </select>
                    </div>
                    <div class="border-bottom-select2"></div>
                </div>
                <div class="border-top-select">
                    <div class="select_year">
                        <select name="byear" required>
                            <option disabled selected="selected"><?=$this->lang->line('y')?></option>
                            <?php
                            for ($i = 1950; $i < 2016; $i++) {
                                echo "<option value='$i'>$i</option>";
                            }
                            ?>
                        </select>
                    </div>
                    <div class="border-bottom-select"></div>
                </div>
            </div>

					<div class="radio">
						<div class="man">
                            <input id="male" type="radio" name="gender" value="2" checked="checked">
						    <label for="male"><?=$this->lang->line('m')?></label>
						</div>
						<div class="wooman">
							<input id="male2" type="radio" name="gender" value="1">
						    <label for="male2"><?=$this->lang->line('f')?></label>
						</div>
					</div>

            <div class="flex-container">
                <div class="border-top3">
                    <input class="country" type="text" value="" placeholder="<?=$this->lang->line('country')?>" name="country" required></input>
                    <div class="border-bottom3"></div>
                </div>
                <div class="border-top3">
                    <input class="city" type="text" value="" placeholder="<?=$this->lang->line('city')?>" name="city" required></input>
                    <div class="border-bottom3"></div>
                </div>

            </div>
            <div class="border-top">
                <input class="mail" type="email" value="" placeholder="<?=$this->lang->line('create_user_email_label')?>" name="email" required></input>
                <div class="border-top-bottom"></div>
            </div>
            <div class="border-top">
                <?php echo form_error('password'); ?>
                <input class="pass" type="password" value="" placeholder="<?=$this->lang->line('login_password_label')?>" name="password" required></input>
                <div class="border-top-bottom"></div>
            </div>
            <div class="border-top">
                <?php echo form_error('re_pass'); ?>
                <input class="pass" type="password" value="" placeholder="<?=$this->lang->line('create_user_validation_password_confirm_label')?>" name="re_pass" required></input>
                <div class="border-top-bottom"></div>
            </div>
            <h5><?=$this->lang->line('reg_mid')?></h5>
				<div class="no-select">
                <link rel="stylesheet" href="//cdnjs.cloudflare.com/ajax/libs/select2/4.0.1/css/select2.min.css">
                <script src="//cdnjs.cloudflare.com/ajax/libs/select2/4.0.1/js/select2.min.js"></script>
					<script>$(document).ready(function(){
  
  //Select2
  $(".limitedNumbSelect2").select2({
        
    placeholder: "<?=$this->lang->line('reg_gam')?>"
    })
});
</script>
			<div class="border-multi">
                <select class="limitedNumbSelect2" multiple="true" name="like_game[]">
						    <?php 
                                foreach($favor_all as $fav){
                                    echo "<option value='".$fav->games_name."'>".$fav->games_name."</option>";
                                    echo "<br>";
                                                        
                                }
                            ?> 
                </select>
			    <div class="border-bottom-multi"></div>
            </div>

				</div>
            <div class="border-top-text">
                <div class="info">
                    <textarea name="descr" placeholder="<?=$this->lang->line('kd')?>"></textarea>
                </div>
                <div class="border-bottom-text"></div>
            </div>
            <div class="checkbox">
                <div class="checkboxAgree">
                    <input type="checkbox" style="transform: scale(2)" name="" value="">
                    <label for=""><?=$this->lang->line('agree')?></label>
                </div>
            </div>

            <input type="hidden" value="<?=$lang?>" name="lang">
            <input class="button_black_regist" type="button" value="<?=$this->lang->line('registr')?>">
            </form>
            <div class="social_registr">
                <h6><?=$this->lang->line('reg_soc')?></h6>
                <ul id="uLogin">
                    <?php echo $user; ?>
                    <p class="fb" data-uloginbutton="facebook"></p>
                    <p class="vk" data-uloginbutton="vkontakte"></p>

                </ul>
                <div class="border-bottom"></div>
            </div>
        </div>
    </div>	
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

$('.button_black_regist').click(function(){
     $.ajax({
                type: "post",
                dataType:"json",
                url: "/auth/creat_user",
                data: $('#reg').serialize(),
                success: function (data) {
            if(data.error==1){
        alert(data.msg);
            }
            else{
                alert(data.msg);
                location.href='/<?=$lang?>/home/<?=$this->session->userdata('side')?>';
            }
                }
            })
})
</script>