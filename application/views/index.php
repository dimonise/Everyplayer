<?php
defined('BASEPATH') OR exit('No direct script access allowed');
if($this->session->userdata('username')){
    redirect($this->session->userdata('lang').'/home/'.$this->session->userdata('side'));
    }
?>      
        <!--<div class="black_side">
            <div class="subcontainer">
                <a href="<?php echo base_url();?><?php echo $lang;?>/home/black"><input class="button_black" type="button" value="dark side"></a>
            </div>
        </div>
        <div class="white_side">
            <div class="subcontainer">
                <a href="<?php echo base_url();?><?php echo $lang;?>/home/light"><input class="button_white" type="button" value="bright side"></a>
            </div>
        </div>-->

        <div class="selectYourSideBlock">
            <div class="selectYourSideBlock-left">
                <a href="<?php echo base_url();?><?php echo $lang;?>/home/black"><input class="button_black" type="button" value="dark side"></a>
            </div>
            <div class="selectYourSideBlock-right">
                <a href="<?php echo base_url();?><?php echo $lang;?>/home/light"><input class="button_white" type="button" value="bright side"></a>
            </div>
        </div>
        
    </body>
</html>       