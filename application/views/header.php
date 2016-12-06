<?php
defined('BASEPATH') OR exit('No direct script access allowed');

?>
<!DOCTYPE html>
<html style="height: 100%;">
    <head>
        <meta http-equiv="Content-Type" content="text/html; charset=utf-8">
        <title><?php echo $title; ?></title>
        <meta name="keywords" content="" />
        <meta name="description" content="" />
        <meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1">

        <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.6/css/bootstrap.min.css" integrity="sha384-1q8mTJOASx8j1Au+a5WDVnPi2lkFfwwEAa8hDDdjZlpLegxhjVME1fgjWPGmkzs7" crossorigin="anonymous">
        <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.6/css/bootstrap-theme.min.css" integrity="sha384-fLW2N01lMqjakBkx3l/M9EahuwpSfeNvV63J5ezn3uZzapT0u7EYsXMjQV+0En5r" crossorigin="anonymous">
        <script src="https://code.jquery.com/jquery-2.2.4.min.js" integrity="sha256-BbhdlvQf/xTY9gja0Dq3HiwQF8LaCRTXxZKRutelT44="   crossorigin="anonymous"></script>
        <script src="https://code.jquery.com/ui/1.11.4/jquery-ui.min.js" integrity="sha256-xNjb53/rY+WmG+4L6tTl9m6PpqknWZvRt0rO1SRnJzw=" crossorigin="anonymous"></script>
        <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.6/js/bootstrap.min.js" integrity="sha384-0mSbJDEHialfmuBBQP6A4Qrprq5OVfW37PRR3j5ELqxss1yVqOtnepnHVP9aJ7xS" crossorigin="anonymous"></script>

        <script src="<?php echo base_url(); ?>js/myselect.js"></script>
        <script>
            $(function () {
                $('select').selectbox();
            });
        </script>
        <link href="<?php
        if (!$this->uri->segment(1) || $this->session->userdata('side')=='black' ) {
            echo base_url();
            ?>css/style_b.css
                  <?php
              } else {
                  echo base_url() . "css/style_w.css";
              }
              ?>" type="text/css" rel="stylesheet">
        <link href="<?php echo base_url(); ?>css/animate.min.css" type="text/css" rel="stylesheet">
        <link href="<?php echo base_url(); ?>css/animate.css" type="text/css" rel="stylesheet">
        <?php
        if (!$this->uri->segment(1) || $this->session->userdata('side')=='black' ) {?>
        <link href="<?php echo base_url(); ?>css/media_b.css" rel="stylesheet">
        <?php } 
        else{
        ?>
        <link href="<?php echo base_url(); ?>css/media_w.css" rel="stylesheet">
        <?php } ?>
        <link href="<?php echo base_url(); ?>css/reset.css" type="text/css" rel="stylesheet">

        <link type="text/css" rel="stylesheet" href="<?php echo base_url(); ?>css/jquery.jscrollpane.css"/>
        <script type="text/javascript" src="<?php echo base_url(); ?>js/jquery.mousewheel.js"></script>
        <script type="text/javascript" src="<?php echo base_url(); ?>js/jquery.jscrollpane.js"></script>
        

    </head>
    <body  <?php if (!$this->uri->segment(1)) { ?> class="bg-index" <?php } ?> >
