<?php

defined('BASEPATH') OR exit('No direct script access allowed');

class Admin extends CI_Controller {

    function __construct() {
        parent::__construct();
        $this->load->library('grocery_CRUD');
    }

///////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////
/////////// *** add and editing slider show  *** ///////////////////////////////////////////////////////////////////////////////////
    public function slider() {
        $crud = new grocery_CRUD();
        $crud->set_language("russian");
        $crud->display_as('img', 'Изображение')->display_as('source', 'Ссылка');
        $crud->set_table('slider')->set_subject('Слайдер');
        $crud->columns('img', 'source');
        $crud->add_fields('img', 'source');
        $crud->edit_fields('img', 'source');
        $crud->set_field_upload('img', 'images/slider/');
        $output = $crud->render();
        $this->_example_output($output);
    }

/////////////////////// *** add and editing news *** ////////////////////////////////////////////////////////////////////////////     
    public function news() {
        $crud = new grocery_CRUD();
        $crud->set_language("russian");
        $crud->set_table("news");
        $crud->display_as('title_news', 'Заголовок')->
                display_as('title_en', 'Заголовок английский')->
                display_as('author_news', 'Автор новости')->
                display_as('datas_news', 'Дата новости')->
                display_as('text_news', 'Текст новости')->
                display_as('text_en', 'Текст новости английский')->
                display_as('img_news', 'Картинка новости для заголовка');
        $crud->set_field_upload('img_news', 'images/news/');
        $output = $crud->render();
        $this->_example_output($output);
    }

/////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////   
/////////////////////// *** add and editing gides *** ////////////////////////////////////////////////////////////////////////////     
    public function gides() {
        $crud = new grocery_CRUD();
//$crud->set_theme('datatables');
        $crud->set_language("russian");
        $crud->set_table("gides");
        $crud->display_as('cat_gides', 'Категория гайда')->
                display_as('title_gides', 'Заголовок')->
                display_as('title_en', 'Заголовок английский')->
                display_as('author_gides', 'Автор гайда')->
                display_as('datas_gides', 'Дата гайда')->
                display_as('text_gides', 'Текст гайда')->
                display_as('text_en', 'Текст гайда английский')->
                display_as('img_gides', 'Картинка гайда для заголовка')->
                display_as('video_gide', 'Видео гайда');
        $crud->field_type('video_gide', 'text');
        $crud->set_field_upload('img_gides', 'images/gides/');
        $crud->set_subject('Гайд');
        $crud->set_relation('cat_gides', 'favorite_games', 'games_name');
        $output = $crud->render();
        $this->_example_output($output);
    }

/////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////   
/////////////////////// *** add and editing tournament's *** ////////////////////////////////////////////////////////////////////////////     
    public function tour() {
        $crud = new grocery_CRUD();
//$crud->set_theme('datatables');
        $crud->set_language("russian");
        $crud->set_table("tournament");
        $crud->display_as('cat_tour', 'Дисциплина турнира')->
                display_as('type_tour', 'Тип турнира')->
                display_as('name_tour', 'Заголовок')->
                display_as('title_en', 'Заголовок английский')->
                display_as('descr_tour', 'Описание')->
                display_as('text_en', 'Описание английский')->
                display_as('first', 'За первое место (только цифры)')->
                display_as('second', 'За второе место (только цифры)')->
                display_as('three', 'За третье место (только цифры)')->
                display_as('img_tour', 'Картинка турнира')->
//                display_as('count_command', 'Количество команд')->
                display_as('pay_tour', 'Стоимость турнира')->
                display_as('pay_tour_prem', 'Стоимость турнира для подписчиков')->
                display_as('for_who', 'Для кого')->
                display_as('date_start', 'Дата первого этапа')->
                display_as('date_finish', 'Дата конца набора в турнир')->
                display_as('date_finish_all', 'Дата конца турнира');

        $crud->set_relation('cat_tour', 'favorite_games', 'games_name');
        $crud->set_relation('for_who', 'for_who_tour', 'the_who');
        $crud->set_relation('type_tour', 'type_tour', 'cat_tour');
        $crud->set_field_upload('img_tour', 'images/tournament/');
        $crud->field_type('first', 'integer');
        $crud->field_type('second', 'integer');
        $crud->field_type('three', 'integer');
       // $crud->field_type('count_command', 'dropdown', array('1' => '4', '2' => '8'));
        $crud->set_subject('Турнир');

        $output = $crud->render();
        $this->_example_output($output);
    }

///////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////// 
/////////////////////// *** add and editing tournament's *** ////////////////////////////////////////////////////////////////////////////     
    public function tour_out_fly() {
        $crud = new grocery_CRUD();
//$crud->set_theme('datatables');
        $crud->set_language("russian");
        $crud->set_table("tour_out");
        $crud->display_as('id_tour', 'Турнир')->
                display_as('quarterfinal', 'Четверть финал')->
                display_as('semifinal', 'Полуфинал')->
                display_as('final', 'Финал')->
                display_as('vinner', 'Победитель');

        $crud->set_relation('id_tour', 'tournament', 'name_tour');
        $crud->set_subject('Команды');

        $output = $crud->render();
        $this->_example_output($output);
    }

///////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////// 
/////////////////////// *** add and editing tournament's *** ////////////////////////////////////////////////////////////////////////////    
    public function save_table_out_fly() {
        $quart['first_quart'] = $this->input->post('first_quart');
        $quart1 = explode('$$', $quart['first_quart']);
        $quart['first_quart'] = $quart1[0];
        $quart['first_quart_logo'] = $quart1[1];

        $quart['second_quart'] = $this->input->post('second_quart');
        $quart1 = explode('$$', $quart['second_quart']);
        $quart['second_quart'] = $quart1[0];
        $quart['second_quart_logo'] = $quart1[1];

        $quart['third_quart'] = $this->input->post('third_quart');
        $quart1 = explode('$$', $quart['third_quart']);
        $quart['third_quart'] = $quart1[0];
        $quart['third_quart_logo'] = $quart1[1];

        $quart['fourth_quart'] = $this->input->post('fourth_quart');
        $quart1 = explode('$$', $quart['fourth_quart']);
        $quart['fourth_quart'] = $quart1[0];
        $quart['fourth_quart_logo'] = $quart1[1];

        $quart['fifth_quart'] = $this->input->post('fifth_quart');
        $quart1 = explode('$$', $quart['fifth_quart']);
        $quart['fifth_quart'] = @$quart1[0];
        $quart['fifth_quart_logo'] = @$quart1[1];

        $quart['sixth_quart'] = $this->input->post('sixth_quart');
        $quart1 = explode('$$', $quart['sixth_quart']);
        $quart['sixth_quart'] = @$quart1[0];
        $quart['sixth_quart_logo'] = @$quart1[1];

        $quart['seventh_quart'] = $this->input->post('seventh_quart');
        $quart1 = explode('$$', $quart['seventh_quart']);
        $quart['seventh_quart'] = @$quart1[0];
        $quart['seventh_quart_logo'] = @$quart1[1];

        $quart['eighth_quart'] = $this->input->post('eighth_quart');
        $quart1 = explode('$$', $quart['eighth_quart']);
        $quart['eighth_quart'] = @$quart1[0];
        $quart['eighth_quart_logo'] = @$quart1[1];

        $semi['first_semi'] = $this->input->post('first_semi');
        $quart1 = explode('$$', $semi['first_semi']);
        $semi['first_semi'] = @$quart1[0];
        $semi['first_semi_logo'] = @$quart1[1];

        $semi['second_semi'] = $this->input->post('second_semi');
        $quart1 = explode('$$', $semi['second_semi']);
        $semi['second_semi'] = @$quart1[0];
        $semi['second_semi_logo'] = @$quart1[1];

        $semi['third_semi'] = $this->input->post('third_semi');
        $quart1 = explode('$$', $semi['third_semi']);
        $semi['third_semi'] = @$quart1[0];
        $semi['third_semi_logo'] = @$quart1[1];

        $semi['fourth_semi'] = $this->input->post('fourth_semi');
        $quart1 = explode('$$', $semi['fourth_semi']);
        $semi['fourth_semi'] = @$quart1[0];
        $semi['fourth_semi_logo'] = @$quart1[1];

        $fin['first_fin'] = $this->input->post('first_fin');
        $quart1 = explode('$$', $fin['first_fin']);
        $fin['first_fin'] = @$quart1[0];
        $fin['first_fin_logo'] = @$quart1[1];

        $fin['second_fin'] = $this->input->post('second_fin');
        $quart1 = explode('$$', $fin['second_fin']);
        $fin['second_fin'] = @$quart1[0];
        $fin['second_fin_logo'] = @$quart1[1];

        $vin['first_vin'] = $this->input->post('first_vin');
        $quart1 = explode('$$', $vin['first_vin']);
        $vin['first_vin'] = @$quart1[0];
        $vin['first_vin_logo'] = @$quart1[1];

        $quart['first_q'] = $this->input->post('first_q');
        $quart['second_q'] = $this->input->post('second_q');
        $quart['third_q'] = $this->input->post('third_q');
        $quart['fourth_q'] = $this->input->post('fourth_q');
        $quart['fifth_q'] = $this->input->post('fifth_q');
        $quart['sixth_q'] = $this->input->post('sixth_q');
        $quart['seventh_q'] = $this->input->post('seventh_q');
        $quart['eighth_q'] = $this->input->post('eighth_q');
        $semi['first_s'] = $this->input->post('first_s');
        $semi['second_s'] = $this->input->post('second_s');
        $semi['third_s'] = $this->input->post('third_s');
        $semi['fourth_s'] = $this->input->post('fourth_s');
        $fin['first_f'] = $this->input->post('first_f');
        $fin['second_f'] = $this->input->post('second_f');
        $vin['first_v'] = $this->input->post('first_v');

        $tour = $this->input->post('tourn');

        $qwart = serialize($quart);
        $sem = serialize($semi);
        $fi = serialize($fin);
        $vi = serialize($vin);

        $data = array('id_tour' => $tour, 'quarterfinal' => $qwart, 'semifinal' => $sem, 'final' => $fi, 'vinner' => $vi);
        $this->db->insert('tour_out', $data);
        redirect(base_url() . '/admin/tour_out_fly', 'refresh');
    }

    /* Здесь сделать выбор команд в зависимости от турнира */

    function sel_comm() {
        $id_tour = $this->input->post('id_turr');
        $this->db->where('id_tour', $id_tour);
        $count = $this->db->count_all_results('tour_out');
        if ($count > 0) {
            $this->db->where('id_tour', $id_tour);
            $query = $this->db->get('tour_out');
            $res_tour = $query->result(); //данные турнира

            $this->db->where('id_tour', $id_tour);
            $query_comm = $this->db->get('command');
            //print_r($this->db->queries);
            $res_comm = $query_comm->result();


            $quart = unserialize($res_tour[0]->quarterfinal);
            $semi = unserialize($res_tour[0]->semifinal);
            $fin = unserialize($res_tour[0]->final);
            $vin = unserialize($res_tour[0]->vinner);


            echo '<div class="scroll-block"><div class="turnir_table"><div class="column1"><div class="ychasniki">
                    <div class="ychasnik1">';
            if ($quart['first_quart'] == "") {
                echo '<select name="first_quart" class="sels">
                        <option value="">Выбрать команду</option>';

                foreach ($res_comm as $comm) {
                    echo '<option value="' . $comm->name_command . '$$' . $comm->logo_command . '">' . $comm->name_command . '</option>';
                }
                echo '</select>';
            } else {
                echo '<input type="text" value="' . $quart['first_quart'] . '" name="first_quart" class="inp"><input type="hidden" value="' . $quart['first_quart_logo'] . '" name="first_quart_logo">';
            }
            echo '<div class="schet1">
		<input name="first_q" value="' . $quart['first_q'] . '" placeholder="счет">
		</div>
		</div>
	    <div class="ychasnik2">';
            if ($quart['second_quart'] == "") {
                echo '<select name="second_quart" class="sels">
                        <option value="">Выбрать команду</option>';

                foreach ($res_comm as $comm) {
                    echo '<option value="' . $comm->name_command . '$$' . $comm->logo_command . '">' . $comm->name_command . '</option>';
                }
                echo '</select>';
            } else {
                echo '<input type="text" value="' . $quart['second_quart'] . '" name="second_quart" class="inp"><input type="hidden" value="' . $quart['second_quart_logo'] . '" name="second_quart_logo">';
            }
            echo '<div class="schet2">
		  <input name="second_q" value="' . $quart['second_q'] . '" placeholder="счет">
		  </div>
		</div>
		</div>
		<div class="ychasniki">
                    <div class="ychasnik1">';
            if ($quart['third_quart'] == "") {
                echo '<select name="third_quart" class="sels">
                            <option value="">Выбрать команду</option>';
                foreach ($res_comm as $comm) {
                    echo '<option value="' . $comm->name_command . '$$' . $comm->logo_command . '">' . $comm->name_command . '</option>';
                }
                echo '</select>';
            } else {
                echo '<input type="text" value="' . $quart['third_quart'] . '" name="third_quart" class="inp"><input type="hidden" value="' . $quart['third_quart_logo'] . '" name="third_quart_logo">';
            }
            echo '<div class="schet1">
		<input name="third_q" value="' . $quart['third_q'] . '" placeholder="счет">
		</div>
		</div>
		<div class="ychasnik2">';

            if ($quart['fourth_quart'] == "") {
                echo '<select name="fourth_quart" class="sels">
                        <option value="">Выбрать команду</option>';
                foreach ($res_comm as $comm) {
                    echo '<option value="' . $comm->name_command . '$$' . $comm->logo_command . '">' . $comm->name_command . '</option>';
                }
                echo '</select>';
            } else {
                echo '<input type="text" value="' . $quart['fourth_quart'] . '" name="fourth_quart" class="inp"><input type="hidden" value="' . $quart['fourth_quart_logo'] . '" name="fourth_quart_logo">';
            }
            echo '<div class="schet2">
		<input name="fourth_q" value="' . $quart['fourth_q'] . '" placeholder="счет">
		</div>
		</div>
		</div>
                <div class="ychasniki">
		<div class="ychasnik1">';
            if ($quart['fifth_quart'] == "") {
                echo '<select name = "fifth_quart" class="sels">
<option value = "">Выбрать команду</option>';
                foreach ($res_comm as $comm) {
                    echo '<option value = "' . $comm->name_command . '$$' . $comm->logo_command . '">' . $comm->name_command . '</option>';
                }
                echo '</select>';
            } else {
                echo '<input type="text" value="' . $quart['fifth_quart'] . '" name="fifth_quart" class="inp"><input type="hidden" value="' . $quart['fifth_quart_logo'] . '" name="fifth_quart_logo">';
            }
            echo '<div class = "schet1">
<input name = "fifth_q" value = "' . $quart['fifth_q'] . '" placeholder = "счет">
</div>
</div>
<div class = "ychasnik2">';
            if ($quart['sixth_quart'] == "") {
                echo '<select name = "sixth_quart" class="sels">
<option value = "">Выбрать команду</option>';
                foreach ($res_comm as $comm) {
                    echo '<option value = "' . $comm->name_command . '$$' . $comm->logo_command . '">' . $comm->name_command . '</option>';
                }
                echo '</select>';
            } else {
                echo '<input type="text" value="' . $quart['sixth_quart'] . '" name="sixth_quart" class="inp"><input type="hidden" value="' . $quart['sixth_quart_logo'] . '" name="sixth_quart_logo">';
            }
            echo '<div class = "schet2">
<input name = "sixth_q" value = "' . $quart['sixth_q'] . '" placeholder = "счет">
</div>
</div>
</div>
<div class = "ychasniki">
<div class = "ychasnik1">';
            if ($quart['seventh_quart'] == "") {
                echo '<select name = "seventh_quart" class="sels">
<option value = "">Выбрать команду</option>';
                foreach ($res_comm as $comm) {
                    echo '<option value = "' . $comm->name_command . '$$' . $comm->logo_command . '">' . $comm->name_command . '</option>';
                }
                echo '</select>';
            } else {
                echo '<input type="text" value="' . $quart['seventh_quart'] . '" name="seventh_quart" class="inp"><input type="hidden" value="' . $quart['seventh_quart_logo'] . '" name="seventh_quart_logo">';
            }
            echo '<div class = "schet1">
<input name = "seventh_q" value = "' . $quart['seventh_q'] . '" placeholder = "счет">
</div>
</div>
<div class = "ychasnik2">';
            if ($quart['eighth_quart'] == "") {
                echo '<select name = "eighth_quart" class="sels">
<option value = "">Выбрать команду</option>';
                foreach ($res_comm as $comm) {
                    echo '<option value = "' . $comm->name_command . '$$' . $comm->logo_command . '">' . $comm->name_command . '</option>';
                }
                echo '</select>';
            } else {
                echo '<input type="text" value="' . $quart['eighth_quart'] . '" name="eighth_quart" class="inp"><input type="hidden" value="' . $quart['eighth_quart_logo'] . '" name="eighth_quart_logo">';
            }
            echo '<div class = "schet2">
<input name = "eighth_q" value = "' . $quart['eighth_quart'] . '" placeholder = "счет">
</div>
</div></div></div>';
            echo'            <div class = "column2">

            </div>
            <div class = "column3">
            <div class = "ychasniki_top">
            <div class = "ychasnik1">';
            if ($semi['first_semi'] == "") {
                echo' <select name = "first_semi" class="sels">
            <option value = "">Выбрать команду</option>';
                foreach ($res_comm as $comm) {
                    echo '<option value = "' . $comm->name_command . '$$' . $comm->logo_command . '">' . $comm->name_command . '</option>';
                }
                echo '</select>';
            } else {
                echo '<input type="text" value="' . $semi['first_semi'] . '" name="first_semi" class="inp"><input type="hidden" value="' . $semi['first_semi_logo'] . '" name="first_semi_logo">';
            }
            echo '<div class = "schet1">
            <input name = "first_s" value = "' . $semi['first_s'] . '" placeholder = "счет">
            </div>
            </div>
            <div class = "ychasnik2">';
            if ($semi['second_semi'] == "") {
                echo '<select name = "second_semi" class="sels">
            <option value = "">Выбрать команду</option>';
                foreach ($res_comm as $comm) {
                    echo '<option value = "' . $comm->name_command . '$$' . $comm->logo_command . '">' . $comm->name_command . '</option>';
                }
                echo '</select>';
            } else {
                echo '<input type="text" value="' . $semi['second_semi'] . '" name="second_semi" class="inp"><input type="hidden" value="' . $semi['second_semi_logo'] . '" name="second_semi_logo">';
            }
            echo '<div class = "schet2">
            <input name = "second_s" value = "' . $semi['second_s'] . '" placeholder = "счет">
            </div>
            </div>
            </div>
            <div class = "ychasniki_bottom">
            <div class = "ychasnik1">';
            if ($semi['third_semi'] == "") {
                echo '<select name = "third_semi" class="sels">
            <option value = "">Выбрать команду</option>';
                foreach ($res_comm as $comm) {
                    echo '<option value = "' . $comm->name_command . '$$' . $comm->logo_command . '">' . $comm->name_command . '</option>';
                }
                echo '</select>';
            } else {
                echo '<input type="text" value="' . $semi['third_semi'] . '" name="third_semi" class="inp"><input type="hidden" value="' . $semi['third_semi_logo'] . '" name="third_semi_logo">';
            }
            echo'     <div class = "schet1">
            <input name = "third_s" value = "' . $semi['third_s'] . '" placeholder = "счет">
            </div>
            </div>
            <div class = "ychasnik2">';
            if ($semi['fourth_semi'] == "") {
                echo '<select name = "fourth_semi" class="sels">
            <option value = "">Выбрать команду</option>';
                foreach ($res_comm as $comm) {
                    echo '<option value = "' . $comm->name_command . '$$' . $comm->logo_command . '">' . $comm->name_command . '</option>';
                }
                echo '</select>';
            } else {
                echo '<input type="text" value="' . $semi['fourth_semi'] . '" name="fourth_semi" class="inp"><input type="hidden" value="' . $semi['fourth_semi_logo'] . '" name="fourth_semi_logo">';
            }
            echo '<div class = "schet2">
            <input name = "fourth_s" value = "' . $semi['fourth_s'] . '" placeholder = "счет">
            </div>
            </div>
            </div>
            </div>';

            echo '<div class="column4"></div>
        <div class="column5">
	<div class="ychasniki">
	<div class="ychasnik1">';
            if ($fin['first_fin'] == "") {
                echo '<select name="first_fin" class="sels">
                       <option value="">Выбрать команду</option>';
                foreach ($res_comm as $comm) {
                    echo '<option value="' . $comm->name_command . '$$' . $comm->logo_command . '">' . $comm->name_command . '</option>';
                }
                echo '</select>';
            } else {
                echo '<input type="text" value="' . $fin['first_fin'] . '" name="first_fin" class="inp"><input type="hidden" value="' . $fin['first_fin_logo'] . '" name="first_fin_logo">';
            }
            echo '<div class = "schet1">
            <input name = "first_f" value = "' . $fin['first_f'] . '" placeholder = "счет">
            </div>
            </div>
            <div class = "ychasnik2">';
            if ($fin['second_fin'] == "") {
                echo '<select name = "second_fin" class="sels">
            <option value = "">Выбрать команду</option>';
                foreach ($res_comm as $comm) {
                    echo '<option value = "' . $comm->name_command . '$$' . $comm->logo_command . '">' . $comm->name_command . '</option>';
                }
                echo '</select>';
            } else {
                echo '<input type="text" value="' . $fin['second_fin'] . '" name="second_fin" class="inp"><input type="hidden" value="' . $fin['second_fin_logo'] . '" name="second_fin_logo">';
            }
            echo '<div class = "schet2">
            <input name = "second_f" value = "' . $fin['second_f'] . '" placeholder = "счет">
            </div>
            </div>
            </div>
            </div>
            <div class = "column6"></div>
            <div class = "column7">
            <div class = "ychasniki">
            <div class = "ychasnik1">';
            if ($vin['first_vin'] == "") {
                echo '<select name = "first_vin" class="sels">
            <option value = "">Выбрать команду</option>';
                foreach ($res_comm as $comm) {
                    echo '<option value = "' . $comm->name_command . '$$' . $comm->logo_command . '">' . $comm->name_command . '</option>';
                }
                echo '</select>';
            } else {
                echo '<input type="text" value="' . $vin['first_vin'] . '" name="first_vin" class="inp"><input type="hidden" value="' . $vin['first_vin_logo'] . '" name="first_vin_logo">';
            }
            echo '<div class = "schet1">
            <input name = "first_v" value = "' . $vin['first_v'] . '" placeholder = "счет">
            </div>
            </div>
            </div>
            </div>';
            echo '<div class = "podpisi_grup">
            <div class = "podpisi">
            <p>четвертьфинал</p>
            </div>
            <div class = "podpisi">
            <p>полуфинал</p>
            </div>
            <div class = "podpisi">
            <p>финал</p>
            </div>
            <div class = "podpisi">
            <p>победитель</p>
            </div>
            </div>
            </div>
            </div></div>';
        }
    }

    function upd_tour() {
        $tourn = $this->input->post('tourn');
        $quart['first_quart'] = $this->input->post('first_quart');
        $quart['first_q'] = $this->input->post('first_q');
        $quart['second_quart'] = $this->input->post('second_quart');
        $quart['second_q'] = $this->input->post('second_q');
        $quart['third_quart'] = $this->input->post('third_quart');
        $quart['third_q'] = $this->input->post('third_q');
        $quart['fourth_quart'] = $this->input->post('fourth_quart');
        $quart['fourth_q'] = $this->input->post('fourth_q');
        $quart['fifth_quart'] = $this->input->post('fifth_quart');
        $quart['fifth_q'] = $this->input->post('fifth_q');
        $quart['sixth_quart'] = $this->input->post('sixth_quart');
        $quart['sixth_q'] = $this->input->post('sixth_q');
        $quart['seventh_quart'] = $this->input->post('seventh_quart');
        $quart['seventh_q'] = $this->input->post('seventh_q');
        $quart['eighth_quart'] = $this->input->post('eighth_quart');
        $quart['eighth_q'] = $this->input->post('eighth_q');
        $semi['first_semi'] = $this->input->post('first_semi');
        $semi['first_s'] = $this->input->post('first_s');
        $semi['second_semi'] = $this->input->post('second_semi');
        $semi['second_s'] = $this->input->post('second_s');
        $semi['third_semi'] = $this->input->post('third_semi');
        $semi['third_s'] = $this->input->post('third_s');
        $semi['fourth_semi'] = $this->input->post('fourth_semi');
        $semi['fourth_s'] = $this->input->post('fourth_s');
        $fin['first_fin'] = $this->input->post('first_fin');
        $fin['first_f'] = $this->input->post('first_f');
        $fin['second_fin'] = $this->input->post('second_fin');
        $fin['second_f'] = $this->input->post('second_f');
        $vin['first_vin'] = $this->input->post('first_vin');
        $vin['first_v'] = $this->input->post('first_v');

        if ($this->input->post('first_quart_logo')) {
            $quart['first_quart_logo'] = $this->input->post('first_quart_logo');
        } else {
            @$quart1 = explode('$$', $quart['first_quart']);
            $quart['first_quart'] = @$quart1[0];
            $quart['first_quart_logo'] = @$quart1[1];
        }
        if ($this->input->post('second_quart_logo')) {
            $quart['second_quart_logo'] = $this->input->post('second_quart_logo');
        } else {
            @$quart1 = explode('$$', $quart['second_quart']);
            $quart['second_quart'] = @$quart1[0];
            $quart['second_quart_logo'] = @$quart1[1];
        }
        if ($this->input->post('third_quart_logo')) {
            $quart['third_quart_logo'] = $this->input->post('third_quart_logo');
        } else {
            @$quart1 = explode('$$', $quart['third_quart']);
            $quart['third_quart'] = @$quart1[0];
            $quart['third_quart_logo'] = @$quart1[1];
        }
        if ($this->input->post('fourth_quart_logo')) {
            $quart['fourth_quart_logo'] = $this->input->post('fourth_quart_logo');
        } else {
            @$quart1 = explode('$$', $quart['fourth_quart']);
            $quart['fourth_quart'] = @$quart1[0];
            $quart['fourth_quart_logo'] = @$quart1[1];
        }
        if ($this->input->post('fifth_quart_logo')) {
            $quart['fifth_quart_logo'] = $this->input->post('fifth_quart_logo');
        } else {
            @$quart1 = explode('$$', $quart['fifth_quart']);
            $quart['fifth_quart'] = @$quart1[0];
            $quart['fifth_quart_logo'] = @$quart1[1];
        }
        if ($this->input->post('sixth_quart_logo')) {
            $quart['sixth_quart_logo'] = $this->input->post('sixth_quart_logo');
        } else {
            @$quart1 = explode('$$', $quart['sixth_quart']);
            $quart['sixth_quart'] = @$quart1[0];
            $quart['sixth_quart_logo'] = @$quart1[1];
        }
        if ($this->input->post('seventh_quart_logo')) {
            $quart['seventh_quart_logo'] = $this->input->post('seventh_quart_logo');
        } else {
            @$quart1 = explode('$$', $quart['seventh_quart']);
            $quart['seventh_quart'] = @$quart1[0];
            $quart['seventh_quart_logo'] = @$quart1[1];
        }
        if ($this->input->post('eighth_quart_logo')) {
            $quart['eighth_quart_logo'] = $this->input->post('eighth_quart_logo');
        } else {
            @$quart1 = explode('$$', $quart['eighth_quart']);
            $quart['eighth_quart'] = @$quart1[0];
            $quart['eighth_quart_logo'] = @$quart1[1];
        }
        if ($this->input->post('first_semi_logo')) {
            $semi['first_semi_logo'] = $this->input->post('first_semi_logo');
        } else {
            @$quart1 = explode('$$', $semi['first_semi']);
            $semi['first_semi'] = @$quart1[0];
            $semi['first_semi_logo'] = @$quart1[1];
        }
        if ($this->input->post('second_semi_logo')) {
            $semi['second_semi_logo'] = $this->input->post('second_semi_logo');
        } else {
            @$quart1 = explode('$$', $semi['second_semi']);
            $semi['second_semi'] = @$quart1[0];
            $semi['second_semi_logo'] = @$quart1[1];
        }
        if ($this->input->post('third_semi_logo')) {
            $semi['third_semi_logo'] = $this->input->post('third_semi_logo');
        } else {
            @$quart1 = explode('$$', $semi['third_semi']);
            $semi['third_semi'] = @$quart1[0];
            $semi['third_semi_logo'] = @$quart1[1];
        }
        if ($this->input->post('fourth_semi_logo')) {
            $semi['fourth_semi_logo'] = $this->input->post('fourth_semi_logo');
        } else {
            @$quart1 = explode('$$', $semi['fourth_semi']);
            $semi['fourth_semi'] = @$quart1[0];
            $semi['fourth_semi_logo'] = @$quart1[1];
        }
        if ($this->input->post('first_fin_logo')) {
            $fin['first_fin_logo'] = $this->input->post('first_fin_logo');
        } else {
            @$quart1 = explode('$$', $fin['first_fin']);
            $fin['first_fin'] = @$quart1[0];
            $fin['first_fin_logo'] = @$quart1[1];
        }
        if ($this->input->post('second_fin_logo')) {
            $fin['second_fin_logo'] = $this->input->post('second_fin_logo');
        } else {
            @$quart1 = explode('$$', $fin['second_fin']);
            $fin['second_fin'] = @$quart1[0];
            $fin['second_fin_logo'] = @$quart1[1];
        }
        if ($this->input->post('first_vin_logo')) {
            $vin['first_vin_logo'] = $this->input->post('first_vin_logo');
        } else {
            @$quart1 = explode('$$', $vin['first_vin']);
            $vin['first_vin'] = @$quart1[0];
            $vin['first_vin_logo'] = @$quart1[1];
        }





        $qwart = serialize($quart);
        $sem = serialize($semi);
        $fi = serialize($fin);
        $vi = serialize($vin);

        $data = array('quarterfinal' => $qwart, 'semifinal' => $sem, 'final' => $fi, 'vinner' => $vi);
        $this->db->where('id_tour', $tourn);
        $this->db->update('tour_out', $data);
    }

    function del_tour() {
        $tourn = $this->input->post('id_tour');
        $this->db->where('tour_id', $tourn);
        $this->db->delete('tournament');

        $this->db->where('id_tour', $tourn);
        $this->db->delete('tour_out');

        $this->db->where('id_tour', $tourn);
        $this->db->delete('command');
    }

    function sel_new() {
        $tourn = $this->input->post('id_turr');
        $this->db->where('id_tour', $tourn);
        $query = $this->db->get('command');
        echo '<div class="scroll-block"><div class="turnir_table"><div class="column1">
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
							</div></div>';
    }

    /////////////////////// *** add and editing tournament's *** ////////////////////////////////////////////////////////////////////////////     

    public
            function clans() {
        $crud = new grocery_CRUD();
//$crud->set_theme('datatables');
        $crud->set_language("russian");
        $crud->set_table("clans");
        $crud->display_as('name_clan', 'Заголовок')->
                display_as('logo_clan', 'Логотип')->
                display_as('descr_clan', 'Описание')->
                display_as('title_en', 'Заголовок английский')->
                display_as('datas', 'Дата создания')->
                display_as('text_en', 'Описание английский')->
                display_as('games_clan', 'Игры клана')->
                display_as('date_finish_all', 'Дата конца турнира');
        $crud->set_relation_n_n('games_clan', 'link_games_clans', 'favorite_games', 'id_clans', 'id_games', 'games_name');
        $crud->set_field_upload('logo_clan', 'images/clans/');
        $crud->set_subject('Кланы');

        $output = $crud->render();
        $this->_example_output($output);
    }

/////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////  
    function tour_each() {
        $crud = new grocery_CRUD();
//$crud->set_theme('datatables');
        $crud->set_language("russian");

        $crud->set_table("tour_each");
        $crud->display_as('id_tour', 'Турнир')->
                display_as('first', 'Первая команда (Кто)')->
                display_as('second', 'Вторая команда (с Кем)')->
                display_as('result', 'Победитель');

        $crud->set_relation('id_tour', 'tournament', 'name_tour', array('type_tour' => '2'));
        $crud->set_relation('first', 'command', 'name_command');
        $crud->set_relation('second', 'command', 'name_command');
        $crud->set_relation('result', 'command', 'name_command');
        $crud->set_subject('Команды');

        $output = $crud->render();
        $this->_example_output($output);
    }

    function sel_tour_each() {
        $id_tour = $this->input->post('id_tour');

        $this->db->where('id_tour', $id_tour);
        $query = $this->db->get('command');
        echo "<div style='width:100%'><h3 style='margin: auto;width: 19%;margin-top: 25px;'>Выбрать команды для участия в матче</h3><table style='margin:auto;margin-top:25px'>";
        echo ""
        . "<th style='color:blue'>Первая команда</th>"
        . "<th style='color:blue'>Вторая команда</th>"
        . "<th style='color:blue'>Дата и время матча</th><tr>"
        . "<td>"
        . "<select name='first'>"
        . "<option value=''>Выбрать команду</option>";

        foreach ($query->result() as $comm) {
            echo "<option value='" . $comm->id_command . "'>" . $comm->name_command . "</option>";
        }
        echo "</select></td>";
        echo "<td>"
        . "<select name='second'>"
        . "<option value=''>Выбрать команду</option>";
        foreach ($query->result() as $comm) {
            echo "<option value='" . $comm->id_command . "'>" . $comm->name_command . "</option>";
        }
        echo "</select>"
        . "</td>"
        . "<td>"
        . "<input type='datetime-local' value='' placeholder='дата матча' name='datas'>"
        . "</td>"
        . "</tr>"
        . "<tr>"
        . "<td colspan='3' style='text-align:center'>"
        . "<input type='button' value='сохранить матч' class='sub' onclick='save_match()'>"
        . "</td>"
        . "</tr>"
        . "</table>"
        . "</div>";

        $this->db->select('*');
        $this->db->from('tour_each');
        $this->db->where('tour_each.id_tour', $id_tour);
        $query = $this->db->get();
        $querys = $query->result();
        if (!$query->result()) {
            echo "  ";
        }
        echo "<section class='sect'>";
        echo "<table style='margin-left:36%'>";
        foreach ($query->result() as $comm) {
            $this->db->where('id_command', $comm->first);
            $q = $this->db->get('command');
            $qw = $q->result();

            echo "<tr><td style='border:1px solid black;height:20px'>" . $qw[0]->name_command . "</td>";

            $this->db->where('id_command', $comm->second);
            $q = $this->db->get('command');
            $qw = $q->result();
            echo "<td style='border:1px solid black;height:20px'>" . $qw[0]->name_command . "</td>";

            $ar = str_replace('T', ' ', $comm->datas);
            echo "<td style='border:1px solid black;height:20px'>" . $ar . "</td>";

            if ($comm->result == '0') {
                $this->db->where('id_tour', $comm->id_tour);
                $q = $this->db->get('command');
                echo "<td style='border:1px solid black;height:20px;'><select  class='vin' data-info='" . $comm->id . "' style='background-color:#7fff00;'><option value=''>Выбрать победителя</option>";
                foreach ($q->result() as $qw) {
                    echo "<option value='" . $qw->id_command . "'>" . $qw->name_command . "</option>";
                }
                echo "</select></td>";
            } else {
                $this->db->where('id_command', $comm->result);

                $q = $this->db->get('command');
                $qw = $q->result();
                echo "<td style='border:1px solid black;height:20px'>" . $qw[0]->name_command . "</td>";
            }


            if ($comm->fail == '0') {
                $this->db->where('id_tour', $comm->id_tour);
                $q = $this->db->get('command');
                echo "<td style='border:1px solid black;height:20px;'><select  class='lose' data-info='" . $comm->id . "' style='background-color:#7fff00;'><option value=''>Выбрать проигравшего</option>";
                foreach ($q->result() as $qw) {
                    echo "<option value='" . $qw->id_command . "'>" . $qw->name_command . "</option>";
                }
                echo "</select></td>";
            } else {
                $this->db->where('id_command', $comm->fail);

                $q = $this->db->get('command');
                $qw = $q->result();
                echo "<td style='border:1px solid black;height:20px'>" . $qw[0]->name_command . "</td>";
            }
            echo "</td><td style='border:1px solid black;height:20px'><a href='#' onclick='dell(" . $comm->id . ")'>Удалить</a></td></tr>";
        }
        echo "</table>";
        echo "</section>";
        echo "<script>
                    $('.vin').change(function(){
                 var id_pare = $(this).data('info');
                     $.ajax({
                                url: '/admin/save_vinner',
                                method: 'POST',
                                data: {id_vin:$(this).val(),id_pare:id_pare},
                                success: function (html) {
                                
                                   alert('Победитель определен!');
                                
                                }
                            })
               
       })
       </script>";
        echo "<script>
                $('.lose').change(function(){
                 var id_pares = $(this).data('info');
                            $.ajax({
                                url: '/admin/save_loser',
                                method: 'POST',
                                data: {id_vin:$(this).val(),id_pare:id_pares},
                                success: function (html) {
                                
                                   alert('Проигравший определен!');
                                
                                }
                            })
                         })
                         </script >";
        echo "<script>
                function dell(x){
                 
                            $.ajax({
                                url: '/admin/del_match',
                                method: 'POST',
                                data: {id_match:x,id_tour:$id_tour},
                                success: function (html) {
                                
                                   alert('Матч удален!');
                                $('.sect').html(html);
                                }
                            })
                            }
                         </script >";
    }

    function del_match() {
        $id_tour = $this->input->post('id_tour');
        $id_match = $this->input->post('id_match');
        $this->db->where('id', $id_match);
        $this->db->delete('tour_each');

        $this->db->select('*');
        $this->db->from('tour_each');
        $this->db->where('tour_each.id_tour', $id_tour);
        $query = $this->db->get();
        $querys = $query->result();
        if (!$query->result()) {
            echo "  ";
        }
        echo "<table style='margin-left:36%'>";
        foreach ($query->result() as $comm) {
            $this->db->where('id_command', $comm->first);
            $q = $this->db->get('command');
            $qw = $q->result();

            echo "<tr><td style='border:1px solid black;height:20px'>" . $qw[0]->name_command . "</td>";

            $this->db->where('id_command', $comm->second);
            $q = $this->db->get('command');
            $qw = $q->result();
            echo "<td style='border:1px solid black;height:20px'>" . $qw[0]->name_command . "</td>";

            $ar = str_replace('T', ' ', $comm->datas);
            echo "<td style='border:1px solid black;height:20px'>" . $ar . "</td>";

            if ($comm->result == '0') {
                $this->db->where('id_tour', $comm->id_tour);
                $q = $this->db->get('command');
                echo "<td style='border:1px solid black;height:20px;'><select  class='vin' data-info='" . $comm->id . "' style='background-color:#7fff00;'><option value=''>Выбрать победителя</option>";
                foreach ($q->result() as $qw) {
                    echo "<option value='" . $qw->id_command . "'>" . $qw->name_command . "</option>";
                }
                echo "</select></td>";
            } else {
                $this->db->where('id_command', $comm->result);

                $q = $this->db->get('command');
                $qw = $q->result();
                echo "<td style='border:1px solid black;height:20px'>" . $qw[0]->name_command . "</td>";
            }


            if ($comm->fail == '0') {
                $this->db->where('id_tour', $comm->id_tour);
                $q = $this->db->get('command');
                echo "<td style='border:1px solid black;height:20px;'><select  class='lose' data-info='" . $comm->id . "' style='background-color:#7fff00;'><option value=''>Выбрать проигравшего</option>";
                foreach ($q->result() as $qw) {
                    echo "<option value='" . $qw->id_command . "'>" . $qw->name_command . "</option>";
                }
                echo "</select></td>";
            } else {
                $this->db->where('id_command', $comm->fail);

                $q = $this->db->get('command');
                $qw = $q->result();
                echo "<td style='border:1px solid black;height:20px'>" . $qw[0]->name_command . "</td>";
            }
            echo "</td><td style='border:1px solid black;height:20px'><a href='#' onclick='dell(" . $comm->id . ")'>Удалить</a></td></tr>";
        }
        echo "</table>";
    }

    function save_each_match() {
        $id_tour = $this->input->post('tourn');
        $first = $this->input->post('first');
        $second = $this->input->post('second');
        $datas = $this->input->post('datas');
        $dat = array('id_tour' => $id_tour, 'first' => $first, 'second' => $second, 'datas' => $datas);

        $this->db->insert('tour_each', $dat);
        $id = $this->db->insert_id();
        $this->db->select('*');
        $this->db->from('tour_each');
        //$this->db->where('id_tour', $id_tour);
        $this->db->where('id', $id);
        $query = $this->db->get();

        echo "<table style='margin-left:36%'>";
        $comm = $query->result();
        $this->db->where('id_command', $comm[0]->first);
        $q = $this->db->get('command');
        $qw = $q->result();
        echo "<tr><td style='border:1px solid black;height:20px'>" . $qw[0]->name_command . "</td>";


        $comm = $query->result();
        $this->db->where('id_command', $comm[0]->second);
        $q = $this->db->get('command');
        $qw = $q->result();
        echo "<td style='border:1px solid black;height:20px'>" . $qw[0]->name_command . "</td>";

        $comm = $query->result();
        $ar = str_replace('T', ' ', $comm[0]->datas);
        echo "<td style='border:1px solid black;height:20px'>" . $ar . "</td>";

        $comm = $query->result();
        $this->db->where('id_tour', $comm[0]->id_tour);

        $q = $this->db->get('command');
        echo "<td style='border:1px solid black;height:20px;'><select  class='vin' data-info='" . $comm[0]->id . "'><option value=''>Выбрать победителя</option>";
        foreach ($q->result() as $qw) {
            echo "<option value='" . $qw->id_command . "'>" . $qw->name_command . "</option>";
        }
        echo "</select></td>";

        $comm = $query->result();
        $this->db->where('id_tour', $comm[0]->id_tour);

        $q = $this->db->get('command');
        echo "<td style='border:1px solid black;height:20px;'><select  class='lose' data-info='" . $comm[0]->id . "'><option value=''>Выбрать проигравшего</option>";
        foreach ($q->result() as $qw) {
            echo "<option value='" . $qw->id_command . "'>" . $qw->name_command . "</option>";
        }
        echo "</select></td></tr>";

        echo "</table>";
        echo "<script>
                    $('.vin').change(function(){
                 var id_pare = $(this).data('info');
                     $.ajax({
                                url: '/admin/save_vinner',
                                method: 'POST',
                                data: {id_vin:$(this).val(),id_pare:id_pare},
                                success: function (html) {
                                
                                   alert('Победитель определен!');
                                
                                }
                            })
               
       })
       </script>";
        echo "<script>
                $('.lose').change(function(){
                 var id_pares = $(this).data('info');
                            $.ajax({
                                url: '/admin/save_loser',
                                method: 'POST',
                                data: {id_vin:$(this).val(),id_pare:id_pares},
                                success: function (html) {
                                
                                   alert('Проигравший определен!');
                                
                                }
                            })
                         })
                         </script >";
        echo "<script>
                function dell(x){
                 
                            $.ajax({
                                url: '/admin/del_match',
                                method: 'POST',
                                data: {id_match:x,id_tour:$id_tour},
                                success: function (html) {
                                
                                   alert('Матч удален!');
                                $('.sect').html(html);
                                }
                            })
                            }
                         </script >";
    }

    function save_vinner() {
        $id_vin = $this->input->post('id_vin');
        $id_pare = $this->input->post('id_pare');
        $dat = array('result' => $id_vin);
        $this->db->where('id', $id_pare);
        $this->db->update('tour_each', $dat);
    }

    function save_loser() {
        $id_vin = $this->input->post('id_vin');
        $id_pare = $this->input->post('id_pare');
        $dat = array('fail' => $id_vin);
        $this->db->where('id', $id_pare);
        $this->db->update('tour_each', $dat);
    }

/////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////
///////////////////// *** editing F.A.Q *** ////////////////////////////////////////////////////////////////////////////    
//
    public function faq() {
        $crud = new grocery_CRUD();
        $crud->set_language("russian");

        $this->load->config('grocery_crud');
        $crud->set_table("faq");

        $crud->display_as('text', 'Текст')->display_as('text_en', 'Текст английский');
        $crud->unset_add();
        $crud->set_subject('F.A.Q');

        $output = $crud->render();
        $this->_example_output($output);
    }
/////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////
///////////////////// *** editing about *** ////////////////////////////////////////////////////////////////////////////    
//
    public function about() {
        $crud = new grocery_CRUD();
        $crud->set_language("russian");

        $this->load->config('grocery_crud');
        $crud->set_table("about");

        $crud->display_as('text', 'Текст')->display_as('text_en', 'Текст английский');
        $crud->unset_add();
        $crud->set_subject('about');

        $output = $crud->render();
        $this->_example_output($output);
    }

    /////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////
///////////////////// *** editing rules *** ////////////////////////////////////////////////////////////////////////////    
//
    public function rules() {
        $crud = new grocery_CRUD();
        $crud->set_language("russian");

        $this->load->config('grocery_crud');
        $crud->set_table("rules");

        $crud->display_as('text', 'Текст')->display_as('text_en', 'Текст английский');
        $crud->unset_add();
        $crud->set_subject('rules');

        $output = $crud->render();
        $this->_example_output($output);
    }
    
    ///////////////////// *** editing premium *** ////////////////////////////////////////////////////////////////////////////    
//
    public function prem() {
        $crud = new grocery_CRUD();
        $crud->set_language("russian");

        $this->load->config('grocery_crud');
        $crud->set_table("pay_prem");

        $crud->display_as('cost_month', 'Цена подписки за месяц')->display_as('cost_half', 'Цена подписки за полгода')->display_as('cost_year', 'Цена подписки за год');
        $crud->unset_add();
        $crud->set_subject('pay_prem');

        $output = $crud->render();
        $this->_example_output($output);
    }
      ///////////////////// *** editing rating *** ////////////////////////////////////////////////////////////////////////////    
//
    public function rate() {
        $crud = new grocery_CRUD();
        $crud->set_language("russian");

        $this->load->config('grocery_crud');
        $crud->set_table("cost_rate");

        $crud->display_as('rate', 'Время в топе (дни)')->display_as('cost', 'Количество "монет" (целое число)');
        $crud->unset_add();
        $crud->set_subject('cost_rate');

        $output = $crud->render();
        $this->_example_output($output);
    }
	
	
	///////////////////// *** editing footer *** ////////////////////////////////////////////////////////////////////////////    
//
    public function footer() {
        $crud = new grocery_CRUD();
        $crud->set_language("russian");

        $this->load->config('grocery_crud');
        $crud->set_table("footer");

        $crud->display_as('text_left', 'Cсылки левая часть')->display_as('text_center', 'Cсылки центральная часть');
        $crud->unset_add();
        $crud->set_subject('Footer text');

        $output = $crud->render();
        $this->_example_output($output);
    }
	
	
	
	
	
//    function mix_upload($post_array, $primary_key) {
//        $this->load->helper('mp_helper');
//
//        $info = getMP3data('media/mix/' . $post_array['source']);
//
//        $data = array(
//            'format' => substr($post_array['source'], -3) . ', ' . @$info['bitrate'],
//            'duration' => @$info['duration_str'],
//            'size_of_file' => round(@$info['filesize'] / 1048627, 2),
//            'type_of_file' => 'audio/' . substr($post_array['source'], -3)
//        );
//
//        $this->db->where('id', $primary_key);
//        $this->db->update('mix', $data);
//
//        return true;
//    }
//
///////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////
/////////////////////// *** add and editing library *** ////////////////////////////////////////////////////////////////////////////      
//    public function library() {
//        $id = urldecode($this->uri->segment(3));
//
//        $crud = new grocery_CRUD();
//        $crud->set_language("russian");
//        if (isset($id) and ! empty($id)) {
//
//            $quest = "(liter LIKE '$id%') OR (liter_en LIKE '$id%')";
//            $crud->where($quest);
//            $crud->set_table('library')->set_subject('Библиотека');
//            $output = $crud->render();
//        } else {
//            $crud->set_table('library')->set_subject('Библиотека');
//            $output = $crud->render();
//        }
//        $this->_example_output($output);
//    }
//
///////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////
/////////////////////// *** add and editing poster *** ////////////////////////////////////////////////////////////////////////////      
//    public function poster() {
//
//
//        $crud = new grocery_CRUD();
//        $crud->set_language("russian");
//        $crud->set_table('poster');
//        $crud->set_relation_n_n('link', 'id_us_id_poster', 'users', 'poster_id', 'user_id', 'username');
//        $crud->display_as('name', 'Название афиши')->
//                display_as('name_en', 'Название афиши англ.')->
//                display_as('text', 'Текст афиши')->
//                display_as('text_en', 'Текст афиши англ.')->
//                display_as('link', 'Кто играет')->
//                display_as('data_show', 'Дата мероприятия')->
//                display_as('style', 'Стиль')->
//                display_as('place', 'Место мероприятия')->
//                display_as('place_en', 'Место мероприятия англ.')->
//                display_as('adress', 'Адрес мероприятия')->
//                display_as('adress_en', 'Адрес мероприятия англ.')->
//                display_as('site', 'Сайт мероприятия')->
//                display_as('phone', 'Телефон')->
//                display_as('img', 'Изображение афиши')->
//                display_as('price', 'Стоимость');
//        $crud->set_field_upload('img', 'imgs/poster/');
//        $crud->set_relation_n_n('style', 'link_styles_poster', 'styles', 'id_poster', 'id_style', 'text');
//        $output = $crud->render();
//        $this->_example_output($output);
//    }
//
///////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////
/////////////////////// *** add and editing dictionary *** ////////////////////////////////////////////////////////////////////////////  
    public function games() {
       
        $crud = new grocery_CRUD();
        $crud->set_language("russian");
        $crud->set_table("favorite_games");
        $crud->set_field_upload('games_img', 'images/games/');
        $crud->display_as('games_name', 'Название игры')->
                display_as('games_img', 'Иконка игры');
        $output = $crud->render();
        $this->_example_output($output);
    }

///////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////
///////////////////////// *** add and editing dictionary *** ////////////////////////////////////////////////////////////////////////////  
    public function medal() {
       
        $crud = new grocery_CRUD();
        $crud->set_language("russian");
        $crud->set_table("medal");
        $crud->set_field_upload('medal_img', 'images/medal/');
        $crud->display_as('medal_name', 'Название медали')->
                display_as('medal_img', 'Иконка медали');
        $output = $crud->render();
        $this->_example_output($output);
    }

///////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////
/////////////////////// *** add and editing users *** ////////////////////////////////////////////////////////////////////////////  

    public function users() {


        $crud = new grocery_CRUD();
        $crud->set_language("russian");
        $crud->set_table("users");
        $crud->columns(array('username','first_name','last_name','bdate', 'country', 'city', 'sex', 'data_premium',
                             'active', 'avatar', 'datas', 'side', 'like_games', 'descr', 'gmt', 'prime', 'education', 'occupation', 'about','medal'));
        
        $crud->display_as('username', 'Никнейм')->
                display_as('first_name', 'Имя')->
                display_as('last_name', 'Фамилия')->
                display_as('bdate', 'Дата рождения')->
                display_as('country', 'Страна')->
                display_as('city', 'Город')->
                display_as('sex', 'Пол')->
                display_as('active', 'Подтверждение почты')->
                display_as('avatar', 'Аватар')->
                display_as('datas', 'Дата регистрации')->
                display_as('side', 'Сторона')->
                display_as('like_games', 'Любимые игры')->
                display_as('descr', 'Дополнительные данные')->
                display_as('gmt', 'Часовой пояс')->
                display_as('prime', 'Прайм тайм')->
                display_as('education', 'Образование')->
                display_as('occupation', 'Род деятельности')->
                display_as('medal', 'Награды сайта')->
                display_as('data_premium', 'Окончание срока подписки')->
                display_as('about', 'О себе');
       // $crud->field_type('data_premium', 'datetime');
        $crud->set_relation('medal', 'medal', 'medal_name');
        $crud->add_fields('username','first_name','last_name','bdate', 'country', 'city', 'sex', 'data_premium',
                             'active', 'avatar', 'datas', 'side', 'like_games', 'descr', 'gmt', 'prime', 'education', 'occupation', 'about','medal');
        $crud->edit_fields('username','first_name','last_name','bdate', 'country', 'city', 'sex', 'data_premium',
                             'active', 'avatar', 'datas', 'side', 'like_games', 'descr', 'gmt', 'prime', 'education', 'occupation', 'about','medal');
        $output = $crud->render();
        $this->_example_output($output);
    }

//    /////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////
/////////////////////// *** add and editing news *** ////////////////////////////////////////////////////////////////////////////     
//    public function news() {
//        $crud = new grocery_CRUD();
//        $crud->set_language("russian");
//        $crud->set_table("news");
//        $crud->display_as('title', 'Заголовок')->
//                display_as('short_des', 'Короткое описание (до 240 символов!)')->
//                display_as('text', 'Текст новости')->
//                display_as('img', 'Картинка новости для главной страницы');
//        $crud->set_field_upload('img', 'imgs/news/');
//        $output = $crud->render();
//        $this->_example_output($output);
//    }
//
///////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////
/////////////////////// *** add and editing videos *** ////////////////////////////////////////////////////////////////////////////     
//    public function video() {
//        $crud = new grocery_CRUD();
//        $crud->set_language("russian");
//        $crud->set_table("video");
//        $crud->display_as('name', 'Название видео')->
//                display_as('poster', 'Заставка видео')->
//                display_as('user', 'Пользователь')->
//                display_as('source', 'Файл видео (150Мb max!)')->
//                display_as('description', 'Описание')->
//                display_as('datas', 'Дата добавления видео (автоматически)');
//        $crud->set_field_upload('source', 'videos/');
//        $crud->set_field_upload('poster', 'videos/poster/');
//        $crud->add_fields('name', 'poster', 'user', 'source', 'description');
//        $crud->edit_fields('name', 'poster', 'user', 'source', 'description');
//        $output = $crud->render();
//        $this->_example_output($output);
//    }
//
/////////////////////// *** add and editing competitions *** ////////////////////////////////////////////////////////////////////////////     
//    public function competition() {
//        $crud = new grocery_CRUD();
//        $crud->set_language("russian");
//        $crud->set_table("competition");
//        $crud->display_as('name_con', 'Заголовок')->
//                display_as('start', 'Дата начала конкурса')->
//                display_as('finish', 'Дата окончания конкурса')->
//                display_as('kto', 'Кто проводит')->
//                display_as('text', 'Текст конкурса')->
//                display_as('img', 'Картинка для конкурса');
//        $crud->set_field_upload('img', 'imgs/competition/');
//        $output = $crud->render();
//        $this->_example_output($output);
//    }
//
///////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////
///////////////////////// *** add and editing Competition Entries *** ////////////////////////////////////////////////////////////////////////////     
//    public function competitions() {
//        $crud = new grocery_CRUD();
//        $crud->set_language("russian");
//        $crud->set_table("konkurs");
//        $crud->display_as('name_con', 'Заголовок конкурса')->
//                display_as('author', 'Автор трека')->
//                display_as('name_track', 'Название трека')->
//                display_as('rang', 'Призовое место');
//        $crud->columns(array('name_con','author','name_track','rang'));  
//        $crud->edit_fields('name_con','author','name_track','rang');
//        $crud->unset_add();
//        $output = $crud->render();
//        $this->_example_output($output);
//    }
//
///////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////
///////////////////////// *** add and editing news *** ////////////////////////////////////////////////////////////////////////////     
//    public function forum() {
//        $crud = new grocery_CRUD();
//        $crud->set_language("russian");
//        $crud->set_table("forum");
//        $crud->display_as('title', 'Заголовок')->
//                display_as('short_des', 'Короткое описание (до 240 символов!)')->
//                display_as('text', 'Текст темы')->
//                display_as('img', 'Картинка темы для главной страницы');
//        $crud->set_field_upload('img', 'imgs/forum/');
//        $crud->set_relation('user_id', 'users', 'username');
//        $crud->columns(array('title','user_id','short_des','text','img','datas'));  
//        $crud->edit_fields('title','user_id','short_des','text','img');
//        $crud->add_fields('title','user_id','short_des','text','img');
//        $output = $crud->render();
//        $this->_example_output($output);
//    }
//
///////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////
/////////////////////// *** editing terms of use *** ////////////////////////////////////////////////////////////////////////////  
//    public function terms() {
//        $crud = new grocery_CRUD();
//        $crud->set_language("russian");
//        $crud->set_table("terms");
//         $crud->display_as('text', 'Текст')->display_as('text_en', 'Текст английский');
//         $crud->unset_add();
//         $output = $crud->render();
//        $this->_example_output($output);
//    }
/////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////
/////////////////////// *** editing advertising  *** ////////////////////////////////////////////////////////////////////////////  
//    public function adver() {
//        $crud = new grocery_CRUD();
//        $crud->set_language("russian");
//         $crud->set_table("price");
//         $crud->display_as('text', 'Русское описание')->
//                display_as('text_en', 'Описание на английском')->
//                display_as('url', 'Файл прайса');
//         $crud->set_field_upload('url','./price/');
//       $crud->unset_add();
//         $output = $crud->render();
//        $this->_example_output($output);
//    }
//
//
//
//
//    public function adver_save() {
//         $config['upload_path'] = './price/';
//           $config['allowed_types'] = 'csv';
//            $this->load->library('upload');
//            $this->upload->initialize($config);
//
//            if (!$this->upload->do_upload()) {
//                $error = array('error' => $this->upload->display_errors());
//                var_dump($error);
//            } else {
//                $data = array('upload_data' => $this->upload->data());
//    }
//    }
//    ///////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////
//    ///////////////////// *** editing vip *** ////////////////////////////////////////////////////////////////////////////  
//    public function vip() {
//        $crud = new grocery_CRUD();
//        $crud->set_language("russian");
//        $crud->set_table("cost_vip");
//         $crud->display_as('cost', 'Цена VIP')->
//                display_as('term', 'Срок VIP');
//         $crud->unset_add();
//         $output = $crud->render();
//        $this->_example_output($output);
//    }
//    
// ///////////////////// *** editing vip *** ////////////////////////////////////////////////////////////////////////////  
//    public function type_user() {
//        $id = urldecode($this->uri->segment(3));
//
//        $crud = new grocery_CRUD();
//        $crud->set_language("russian");
//        $crud->set_table("user_type");
//        $crud->display_as('type', 'Русский вариант')->
//                display_as('type_en', 'Английский вариант');
//        $output = $crud->render();
//        $this->_example_output($output);
//    }
//    
///////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////
///////////////////// *** main function view CRUDE *** ////////////////////////////////////////////////////////////////////////////  
    function _example_output($output) {

        $this->load->view("admin/example", $output);
    }

/////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////
}
