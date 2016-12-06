<div class="container registr">
    <div class="row">
        <div class="vostan">
            <img src="/images/up_registr.png" alt="">
            <h3><?=$this->lang->line('fog')?></h3>
            <p><?=$this->lang->line('fog_txt')?></p>
            <div class="border-top-vostan">
                <form action="/auth/forgot" method="post">
                <input class="name_vostan" type="text" value=""  placeholder="Nikname">
                <div class="border-top-bottom"></div>
            </div>
            <div class="border-top-vostan">
                <input class="mail_vostan" type="email" value="" name="email" placeholder="<?=$this->lang->line('index_email_th')?>">
               <input type="hidden" value="<?=$lang?>" name="lang">
                <div class="border-top-bottom"></div>
            </div>
            <input class="button_black_vostan" type="submit" value="<?=$this->lang->line('more_forgot')?>">
            </form>
        </div>
    </div>	
</div>
