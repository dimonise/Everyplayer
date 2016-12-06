<!DOCTYPE html>
<html>
    <head>
        <title>Администратор</title>
        <meta charset="utf-8" />
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <link href="/css/style_b.css" type="text/css" rel="stylesheet">
        <?php
//            if($this->session->userdata('id')){
//                
//            $this->db->where('id',$this->session->userdata('id'));
//            $cou = $this->db->count_all_results('users');
        $cou = 1;
        if ($cou > 0) {
            ?>
            <?php foreach ($css_files as $file): ?>
                <link type="text/css" rel="stylesheet" href="<?php echo $file; ?>" />
            <?php endforeach; ?>
            <?php foreach ($js_files as $file): ?>
                <script src="<?php echo $file; ?>"></script>
            <?php endforeach; ?>
            <style type='text/css'>
                body
                {
                    font-family: Arial;
                    font-size: 14px;
                }
                a {
                    color: blue;
                    text-decoration: none;
                    font-size: 14px;
                }
                a:hover
                {
                    text-decoration: underline;
                    color:red;
                }
            </style>
            <script>
                $(function () {
                    $("#tabs").tabs({
                        heightStyle: "auto"
                    });
                });


            </script>
        </head>
        <body>
            <div>
                <a href='<?php echo site_url('/admin/slider') ?>'>Слайдер</a> |
                <a href='<?php echo site_url('/admin/games') ?>'>Игры</a> |
                <a href='<?php echo site_url('/admin/news') ?>'>Новости</a> | 
                <a href='<?php echo site_url('/admin/gides') ?>'>Гайды</a> | 
                <a href='<?php echo site_url('/admin/tour') ?>'>Турниры</a> |
                <a href='<?php echo site_url('/admin/tour_out_fly') ?>'>Турнирные таблицы на вылет (графическое заполнение)</a> |
                <a href='<?php echo site_url('/admin/tour_each') ?>'>Матчи</a> |
                <a href='<?php echo site_url('/admin/clans') ?>'>Кланы</a> |
                <a href='<?php echo site_url('/admin/users') ?>'>Пользователи</a> |
                <a href='<?php echo site_url('/admin/prem') ?>'>Цена подписки</a> |
                <a href='<?php echo site_url('/admin/rate') ?>'>Цена и время для рейтинга</a> |
                <a href='<?php echo site_url('/admin/medal') ?>'>Медали (список)</a> |
                <a href='<?php echo site_url('/admin/faq') ?>'>F.A.Q</a> |
                <a href='<?php echo site_url('/admin/about') ?>'>О нас</a> |
                <a href='<?php echo site_url('/admin/rules') ?>'>Правила</a> |
                <a href='<?php echo site_url('/admin/footer') ?>'>Редактор футера</a> |
                <a href='<?php echo site_url('/auth/logout') ?>'>Выход на сайт</a> |
            </div>
            <div style='height:20px;'></div> 
            <?php
            if ($this->uri->segment(2) == 'tour_each') {
                echo '<style>
#tourn {
margin-left: 45%;
}
.flexigrid{
display:none;
}
.hed{
text-align:center;
text-decoration:underline;
padding:10px;
color:red;
font-size:20px;
}
</style>';
                echo '<form action="/admin/save_each_match" method="post" class="ff">
<h2 class="hed">Сначала выбрать турнир!</h2>
<select id="tourn" name="tourn" onchange="sel_tourney()">
<option value="">Выбрать турнир</option>';
                
                $qq = $this->db->get('tournament');
                foreach ($qq->result() as $tt) {
                    echo "<option value='" . $tt->tour_id . "'>" . $tt->name_tour . "</option>";
                }
                echo '</select><section class="each"></section></form><section class="taba_res"></section>';
            }
            if ($this->uri->segment(2) == 'tour_out_fly') {
                $query = $this->db->get('command');
                echo '<style>
.scroll-block{
    width: 100% !important;
    margin-left: 10%;
    }
.ychasniki select{
    margin-top:10px;
    margin-left:10px;
} 
.ychasniki input{
    width: 35px;
    margin: 10px 0px 0px 8px;
} 
.ychasniki_bottom select{
    margin-top:10px;
    margin-left:10px;
} 
.ychasniki_bottom input{
    width: 35px;
    margin: 10px 0px 0px 8px;
} 
.ychasniki_top select{
    margin-top:10px;
    margin-left:10px;
} 
.ychasniki_top input{
    width: 35px;
    margin: 10px 0px 0px 8px;
} 
.save{
position: absolute;
    top: 88%;
    left: 91%;
    height: 50px;
    color: coral;
    background: black;
}
.save1{
position: absolute;
    top: 78%;
    left: 91%;
    height: 50px;
    color: coral;
    background: black;
}
#tourn{
margin-left: 45%;
}
.hed{
text-align:center;
text-decoration:underline;
padding:10px;
color:red;
font-size:20px;
}
.flexigrid{
display:none;
}
.inp {
    width: 150px !important;
    margin: 10px 0px 0px 8px;
    }
.sels{
background-color:#7fff00;
}  
</style>
<form action="/admin/save_table_out_fly" method="post" class="f">
<h2 class="hed">Сначала выбрать турнир!</h2>
<select id="tourn" name="tourn" onchange="selcomm()">
<option value="">Выбрать турнир</option>';
                $this->db->where('type_tour', 1);
                $qq = $this->db->get('tournament');
                foreach ($qq->result() as $tt) {
                    echo "<option value='" . $tt->tour_id . "'>" . $tt->name_tour . "</option>";
                }
                echo '</select>
                    <div id="taba"><div class="scroll-block"><div class="turnir_table"><div class="column1">
									<div class="ychasniki">
										<div class="ychasnik1">
											
											<select name="first_quart">
                                                                                        <option value="">Выбрать команду</option>';
                foreach ($query->result() as $comm) {
                    echo '<option value="' . $comm->name_command . '$$' . $comm->logo_command . '">' . $comm->name_command . '</option>';
                }
                echo '</select>
											<div class="schet1">
												<input name="first_q" value="" placeholder="счет">
											</div>
										</div>
										<div class="ychasnik2">
											
											<select name="second_quart">
                                                                                        <option value="">Выбрать команду</option>';
                foreach ($query->result() as $comm) {
                    echo '<option value="' . $comm->name_command . '$$' . $comm->logo_command . '">' . $comm->name_command . '</option>';
                }
                echo '</select>
											<div class="schet2">
												<input name="second_q" value="" placeholder="счет">
											</div>
										</div>
									</div>
									<div class="ychasniki">
										<div class="ychasnik1">
											
											<select name="third_quart">
                                                                                        <option value="">Выбрать команду</option>';
                foreach ($query->result() as $comm) {
                    echo '<option value="' . $comm->name_command . '$$' . $comm->logo_command . '">' . $comm->name_command . '</option>';
                }
                echo '</select>
											<div class="schet1">
												<input name="third_q" value="" placeholder="счет">
											</div>
										</div>
										<div class="ychasnik2">
											
											<select name="fourth_quart">
                                                                                        <option value="">Выбрать команду</option>';
                foreach ($query->result() as $comm) {
                    echo '<option value="' . $comm->name_command . '$$' . $comm->logo_command . '">' . $comm->name_command . '</option>';
                }
                echo '</select>
											<div class="schet2">
												<input name="fourth_q" value="" placeholder="счет">
											</div>
										</div>
									</div>
									<div class="ychasniki">
										<div class="ychasnik1">
											
											<select name="fifth_quart">
                                                                                        <option value="">Выбрать команду</option>';
                foreach ($query->result() as $comm) {
                    echo '<option value="' . $comm->name_command . '$$' . $comm->logo_command . '">' . $comm->name_command . '</option>';
                }
                echo '</select>
											<div class="schet1">
												<input name="fifth_q" value="" placeholder="счет">
											</div>
										</div>
										<div class="ychasnik2">
											
											<select name="sixth_quart">
                                                                                        <option value="">Выбрать команду</option>';
                foreach ($query->result() as $comm) {
                    echo '<option value="' . $comm->name_command . '$$' . $comm->logo_command . '">' . $comm->name_command . '</option>';
                }
                echo '</select>
											<div class="schet2">
												<input name="sixth_q" value="" placeholder="счет">
											</div>
										</div>
									</div>
									<div class="ychasniki">
										<div class="ychasnik1">
											
											<select name="seventh_quart">
                                                                                        <option value="">Выбрать команду</option>';
                foreach ($query->result() as $comm) {
                    echo '<option value="' . $comm->name_command . '$$' . $comm->logo_command . '">' . $comm->name_command . '</option>';
                }
                echo '</select>
											<div class="schet1">
												<input name="seventh_q" value="" placeholder="счет">
											</div>
										</div>
										<div class="ychasnik2">
											
											<select name="eighth_quart">
                                                                                        <option value="">Выбрать команду</option>';
                foreach ($query->result() as $comm) {
                    echo '<option value="' . $comm->name_command . '$$' . $comm->logo_command . '">' . $comm->name_command . '</option>';
                }
                echo '</select>
											<div class="schet2">
												<input name="eighth_q" value="" placeholder="счет">
											</div>
										</div>
									</div>
							</div>
							<div class="column2">
								
							</div>
							<div class="column3">
									<div class="ychasniki_top">
										<div class="ychasnik1">
											
											<select name="first_semi">
                                                                                        <option value="">Выбрать команду</option>';
                foreach ($query->result() as $comm) {
                    echo '<option value="' . $comm->name_command . '$$' . $comm->logo_command . '">' . $comm->name_command . '</option>';
                }
                echo '</select>
											<div class="schet1">
												<input name="first_s" value="" placeholder="счет">
											</div>
										</div>
										<div class="ychasnik2">
											
											<select name="second_semi">
                                                                                        <option value="">Выбрать команду</option>';
                foreach ($query->result() as $comm) {
                    echo '<option value="' . $comm->name_command . '$$' . $comm->logo_command . '">' . $comm->name_command . '</option>';
                }
                echo '</select>
											<div class="schet2">
												<input name="second_s" value="" placeholder="счет">
											</div>
										</div>
									</div>
									<div class="ychasniki_bottom">
										<div class="ychasnik1">
											
											<select name="third_semi">
                                                                                        <option value="">Выбрать команду</option>';
                foreach ($query->result() as $comm) {
                    echo '<option value="' . $comm->name_command . '$$' . $comm->logo_command . '">' . $comm->name_command . '</option>';
                }
                echo '</select>
											<div class="schet1">
												<input name="third_s" value="" placeholder="счет">
											</div>
										</div>
										<div class="ychasnik2">
											
											<select name="fourth_semi">
                                                                                        <option value="">Выбрать команду</option>';
                foreach ($query->result() as $comm) {
                    echo '<option value="' . $comm->name_command . '$$' . $comm->logo_command . '">' . $comm->name_command . '</option>';
                }
                echo '</select>
											<div class="schet2">
												<input name="fourth_s" value="" placeholder="счет">
											</div>
										</div>
									</div>
								</div>
								<div class="column4">
									
								</div>
								<div class="column5">
									<div class="ychasniki">
										<div class="ychasnik1">
											
											<select name="first_fin" >
                                                                                        <option value="">Выбрать команду</option>';
                foreach ($query->result() as $comm) {
                    echo '<option value="' . $comm->name_command . '$$' . $comm->logo_command . '">' . $comm->name_command . '</option>';
                }
                echo '</select>
											<div class="schet1">
												<input name="first_f" value="" placeholder="счет">
											</div>
										</div>
										<div class="ychasnik2">
											
											<select name="second_fin" >
                                                                                        <option value="">Выбрать команду</option>';
                foreach ($query->result() as $comm) {
                    echo '<option value="' . $comm->name_command . '$$' . $comm->logo_command . '">' . $comm->name_command . '</option>';
                }
                echo '</select>
											<div class="schet2">
												<input name="second_f" value="" placeholder="счет">
											</div>
										</div>
									</div>
								</div>
								<div class="column6">
									
								</div>
								<div class="column7">
									<div class="ychasniki">
										<div class="ychasnik1">
											<select name="first_vin" >
                                                                                        <option value="">Выбрать команду</option>';
                foreach ($query->result() as $comm) {
                    echo '<option value="' . $comm->name_command . '$$' . $comm->logo_command . '">' . $comm->name_command . '</option>';
                }
                echo '</select>
											<div class="schet1">
												<input name="first_v" value="" placeholder="счет">
											</div>
										</div>
									</div>
								</div>
								<div class="podpisi_grup">
									<div class="podpisi">
										<p>четвертьфинал</p>
									</div>
									<div class="podpisi">
										<p>полуфинал</p>
									</div>
									<div class="podpisi">
										<p>финал</p>
									</div>
									<div class="podpisi">
										<p>победитель</p>
									</div>
								</div>
							</div>
							</div></div><input type="submit" value="сохранить" class="save"></form>';
            }
        }
        echo "<script>"
        . "function selcomm(){"
        . "var id_tur = $('#tourn').val();"
        . "$.ajax({
                                url: '/admin/sel_comm',
                                method: 'POST',
                                data: {id_turr: id_tur},
                                success: function (html) {
                                if(html != ''){
                                    $('#taba').html(html);
                                    $('.save').hide();
                                    $('.f').append('<input type=\'button\' value=\'обновить\' class=\'save\' onclick=\'update_tour()\'>');
                                    $('.f').append('<input type=\'button\' value=\'удалить турнир\' class=\'save1\' onclick=\'del_tour('+id_tur+')\'>');
                                }
                                else{
                                $.ajax({
                                url: '/admin/sel_new',
                                method: 'POST',
                                data: {id_turr: id_tur},
                                success: function (html) {
                                $('#taba').html(html);
}
                                })
}
                                }
                            })"
        . "}"
        . "function update_tour(){"
        . "var id_tur = $('#tourn').val();"
        . "$.ajax({
                                url: '/admin/upd_tour',
                                method: 'POST',
                                data: $('.f').serialize(),
                                success: function (html) {
                                
                                   alert('Обновление турнира успешно!');
                                
                                }
                            })"
        . "}"
        . "function del_tour(x){"
        . "var id_tur = $('#tourn').val();"
        . "$.ajax({
                                url: '/admin/del_tour',
                                method: 'POST',
                                data: {id_tour:id_tur},
                                success: function (html) {
                                
                                   alert('Удаление турнира успешно!');
                                
                                }
                            })"
        . "}"
        . "function sel_tourney(){"
        . "var id_tur = $('#tourn').val();"
        . "$.ajax({
                                url: '/admin/sel_tour_each',
                                method: 'POST',
                                data: {id_tour:id_tur},
                                success: function (html) {
                                
                                   $('.each').html(html);
                                $('.taba_res').html('');
                                }
                            })"
        . "}"
        . "function save_match(){"
        . "$.ajax({
                                url: '/admin/save_each_match',
                                method: 'POST',
                                data: $('.ff').serialize(),
                                success: function (html) {
                                
                                   $('.taba_res').append(html);
                                
                                }
                            })"
        . "}"
        . " $('.vin').change(function(){"
//        . "$.ajax({
//                                url: '/admin/save_vinner',
//                                method: 'POST',
//                                data: {id_vin:$(this).val()},
//                                success: function (html) {
//                                
//                                   alert('Победитель определен!');
//                                
//                                }
//                            })"
                ."console.log('gggg')"
        . "})"
        . "</script>";

        echo $output;
        ?>


    </body>
</html>
