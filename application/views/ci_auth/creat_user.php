<?php
/**
 *
 * @author Димон
 * 18.07.2016
 */
echo validation_errors();
//var_dump($lang);
echo form_open($lang."/auth/creat_user");
?>
<p>
    <?php echo form_label($lname = $this->lang->line('who_are_you'), 'first_name'); ?> <br />
    <?php
    
    $a = $this->db->get('user_type');
    $opt_rus = array();
    foreach($a->result() as $key=>$val){
        if($lang == 'ru')
        $options[$val->type] = $val->type;
    else {
        $options[$val->type_en] = $val->type_en;
    }
    }
    ?>
    <?php echo form_dropdown('type', $options); ?>
</p>
<p>
    <?php echo form_label($lname = $this->lang->line('create_user_fname_label'), 'first_name'); ?> <br />
    <?php echo form_input('first_name', set_value('first_name')); ?>
</p>

<p>

    <?php echo form_label($lname = $this->lang->line('create_user_lname_label'), 'last_name'); ?> <br />
    <?php echo form_input('last_name', set_value('last_name')); ?>
</p>

<p>
    <?php echo form_label($lname = $this->lang->line('create_user_email_label'), 'email'); ?> <br />
    <?php echo form_input('email', set_value('email')); ?>
</p>

<p>
    <?php 
    $place = "placeholder='".$this->lang->line('place_phone')."'";
    echo form_label($lname = $this->lang->line('create_user_phone_label'), 'phone'); ?> <br />
    <?php echo form_input('phone', set_value('phone'), $place); ?>
</p>

<p>
    <?php echo form_label($lname = $this->lang->line('create_user_password_label'), 'password'); ?> <br />
    <?php echo form_password('password', ''); ?>
</p>

<p>
    <?php echo form_label($lname = $this->lang->line('create_user_password_confirm_label'), 'password_confirm'); ?> <br />
    <?php echo form_password('password_confirm', ''); ?>
</p>


<p><?php echo form_submit('submit',$this->lang->line('create_user_submit_btn')); ?></p>

<?php echo form_close(); ?>