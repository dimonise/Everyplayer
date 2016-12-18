<?php

defined('BASEPATH') OR exit('No direct script access allowed');

class Players extends CI_Controller
{

    function __construct()
    {
        parent::__construct();
        $this->load->model('lang_model');
        $this->dataz['lang'] = $this->lang_model->index();
    }

    public function index()
    {
        $data['title'] = 'Everyplayer - Players';
        $this->load->model('home_model');
        $this->load->model('players_model');
        $data['lang'] = $this->dataz['lang'];
        $arr = array('side' => $this->uri->segment(2));
        $this->session->set_userdata($arr);
        $data['slider'] = $this->home_model->get_slider();

        $data['get_gamers'] = $this->players_model->get_gamers();

        $data['favor_all'] = $this->players_model->get_filter_games();
        $data['favor'] = $this->players_model->get_favor_games(1);
        $data['get_gmt'] = $this->players_model->get_gmt();

        $this->load->view('header', $data);
        $this->load->view('heading', $data);
        $this->load->view('players', $data);
        $this->load->view('footer', $data);
    }

    public function get_next_three($param = null)
    {

        $this->load->model('players_model');
        $data['get_next'] = $this->players_model->get_ten_next($this->input->post('startFrom'), $param);
        echo $param;
        echo $data['get_next'];
    }

    public function additional()
    {
        $lang = $this->dataz['lang'];
        $user_bdate = $this->input->post('user_bdate');
        $user_likegames = $this->input->post('user_likegames');
        $user_medal = $this->input->post('medal');
        $dbirth = strtotime($user_bdate);
        $now = time();
        $age_sec = $now - $dbirth;
        $data['age_years'] = floor($age_sec / 31536000);

        $games = substr($user_likegames, 0, -1);
        $ar = explode('/', $games);
        $res = array();
        for ($i = 0; $i < count($ar); $i++) {
            $this->db->where('games_name', $ar[$i]);
            $query = $this->db->get('favorite_games');
            $data['res'][] = $query->result();

        }
        $this->db->where('id_med', $user_medal);
        $med = $this->db->get('medal');
        $data['medal'] = $med->result();

        if ($lang != 'en') {
            $age = 'лет';
            $old = 'года';
        } else {
            $age = 'years';
            $old = 'years';
        }

        function GetYearWord($int, $age, $old)
        {

            if ($int > 20) {
                $int = substr($int, -1);
            }
            switch ($int) {
                case 0:
                    return $age;
                    break;
                case 1:
                    return 'год';
                    break;
                case ($int >= 2 && $int <= 4):
                    return $old;
                    break;
                case ($int >= 10 && $int <= 20):
                    return $age;
                    break;
                default:
                    return $age;
                    break;
            }
        }

        $data['age_str'] = GetYearWord($data['age_years'], $age, $old);
        echo json_encode($data);

    }

    public function search_gamers_games($param = null)
    {
        $arr = array('side' => $this->uri->segment(2));
        $this->session->set_userdata($arr);
        $data['title'] = 'Everyplayer - Search Players';
        $this->load->model('home_model');
        $this->load->model('players_model');
        $data['lang'] = $this->dataz['lang'];

        $data['slider'] = $this->home_model->get_slider();
        // $data['get_gamers'] = $this->players_model->get_gamers();
        ////////////////pagination//////////////////////////////
        $this->load->library('pagination');

        $config['base_url'] = base_url() . $data['lang'] . "/" . $this->session->userdata('side') . "/players";
        $config['total_rows'] = $this->players_model->count_for_pag();
        $config['per_page'] = 6;
        $config['full_tag_open'] = '<ul>';
        $config['full_tag_close'] = '</ul>';
        $config['num_tag_open'] = '<li>';
        $config['num_tag_close'] = '</li>';
        $config['cur_tag_open'] = '<li>';
        $config['cur_tag_close'] = '</li>';
        $config['first_link'] = '<<';
        $config['last_link'] = '>>';
        $config['next_link'] = ' »';
        $config['prev_link'] = '« ';
        $config['num_links'] = 3;


        $this->pagination->initialize($config);

        $data['get_gamers'] = $this->players_model->get_gamers_search($config['per_page'], $this->uri->segment(6), $param);
        ///////////////////////////////////////////////////
        $data['favor_all'] = $this->players_model->get_filter_games();
        $data['favor'] = $this->players_model->get_favor_games(1);
        $data['get_gmt'] = $this->players_model->get_gmt();

      //  var_dump($data['crit']);
        $this->load->view('header', $data);
        $this->load->view('heading', $data);
        $this->load->view('players', $data);
        $this->load->view('footer', $data);
    }



    public function search()
    {
        $game = $this->input->post('all_games');
        $gmt = $this->input->post('gmt');
        $age = $this->input->post('age') * 31536000;
        $ach = '';
        switch ($game) {
            case 1:
                $ach = $this->input->post('first');
                break;
            case 2:
                $ach = $this->input->post('second');;
                break;
            case 3:
                $ach = $this->input->post('third');
                break;
            case 4:
                $ach = $this->input->post('four');
                break;
            case 5:
                $ach = $this->input->post('five');
                break;
            case 6:
                $ach = $this->input->post('six');
                break;
            case 7:
                $ach = $this->input->post('seven');
                break;
            case 8:
                $ach = $this->input->post('eight');
                break;
            case 9:
                $ach = $this->input->post('nine');
                break;
            case 10: ;
                $ach = $this->input->post('ten');
                break;
            case 11:
                $ach = $this->input->post('elev');
                break;
            case 12:
                $ach = $this->input->post('tvel');
                break;
            case 13:
                $ach = $this->input->post('thot');
                break;
        }
if(!empty($age)) {
    $dbirth = date('Y', time() - $age);
}
else{
    $dbirth = "";
}
        $sex = $this->input->post('sex');
        $arr = array('side' => $this->uri->segment(2));
        $this->session->set_userdata($arr);
        $data['title'] = 'Everyplayer - Search Players';
        $this->load->model('home_model');
        $this->load->model('players_model');
        $data['lang'] = $this->dataz['lang'];

        $data['slider'] = $this->home_model->get_slider();


        $data['get_gamers'] = $this->players_model->search($game, $ach, $gmt, $dbirth, $sex);
        //var_dump($data['get_gamers']);
        ///////////////////////////////////////////////////
        $data['favor_all'] = $this->players_model->get_filter_games();
        $data['favor'] = $this->players_model->get_favor_games(1);
        $data['get_gmt'] = $this->players_model->get_gmt();

        $this->load->view('header', $data);
        $this->load->view('heading', $data);
        $this->load->view('players_s', $data);
        $this->load->view('footer', $data);
    }

    public function mailbox()
    {
        $theme = $this->input->post('theme');
        $text = $this->input->post('text');
        $kto = $this->session->userdata('id');
        $komu = $this->input->post('komu');

        if ($theme == '') {
            echo "Поле ТЕМА должно быть заполнено!";
            exit();
        }
        if ($text == '') {
            echo "Поле СООБЩЕНИЕ должно быть заполнено!";
            exit();
        }
        if ($kto == null) {
            echo "Для отправки сообщений Вы должны быть зарегистрированным пользователем!";
            exit();
        }
        $data = array(
            "id_user_outer" => $kto,
            "id_user_inner" => $komu,
            "theme" => $theme,
            "text" => $text
        );
        $this->db->insert('mailer', $data);
        echo "Ваше сообщение успешно отправлено!";
    }

    public function get_filtr($id_uri=null)
    {
        if($id_uri == null) {
            $id_game = $this->input->post('id_game');
        }
        else{
            $id_game = $id_uri;
        }
        $lang = $this->dataz['lang'];
        $this->db->select('*');
        $this->db->from('har_value');
        $this->db->where('id_ach_game', $id_game);
        $this->db->group_by('id_har');
        $res = $this->db->get();
        $z = $this->db->get('ach_game_har');
        $x = $z->result();
        switch ($id_game) {
            case 1:


                foreach ($res->result() as $val) {

                    $this->db->where('id_har', $val->id_har);
                    $this->db->group_by('id_har');
                    $q = $this->db->get('ach_game_har');

                    $w = $q->result();
                    $this->db->where('id_har', $w[0]->id_har);
                    $this->db->where('id_ach_game', $id_game);
                    $e = $this->db->get('har_value');

                    echo "<div style='color:white;margin-right:15px; '>";
                    if ($lang == 'en') {
                        echo $w[0]->har_en;
                    } else {
                        echo $w[0]->har;
                    }
                    echo "<input type='hidden' value='" . $w[0]->id_har . "' name='id_har[]'></div>";
                    echo "<select name='first[]' class='first'><option value=''>".$this->lang->line('opt')."</option>";
                    foreach ($e->result() as $wq) {
                        if ($lang == 'en') {
                            echo "<option value='" . $wq->id_val . "'>" . $wq->value_en . "</option>";
                        } else {
                            echo "<option value='" . $wq->id_val . "'>" . $wq->value . "</option>";
                        }
                    }
                    echo '</select>';
                }
                break;
            case 2:
                ?>
                <script>
                    $(function () {
                        $("#slider-range").slider({
                            range: true,
                            min: 0,
                            max: 10000,
                            values: [1, 10000],
                            slide: function (event, ui) {
                                $("#amount").val(ui.values[0] + " - " + ui.values[1]);
                            }
                        });
                        $("#amount").val($("#slider-range").slider("values", 0) + " - " + $("#slider-range").slider("values", 1));
                    });
                </script>
                <script>
                    $(function () {
                        $("#slider-range1").slider({
                            range: true,
                            min: 0,
                            max: 10000,
                            values: [1, 10000],
                            slide: function (event, ui) {
                                $("#amount1").val(ui.values[0] + " - " + ui.values[1]);
                            }
                        });
                        $("#amount1").val($("#slider-range1").slider("values", 0) + " - " + $("#slider-range1").slider("values", 1));
                    });
                </script>
                <script>
                    $(function () {
                        $("#slider-range2").slider({
                            range: true,
                            min: 0,
                            max: 50000,
                            values: [1, 50000],
                            slide: function (event, ui) {
                                $("#amount2").val(ui.values[0] + " - " + ui.values[1]);
                            }
                        });
                        $("#amount2").val($("#slider-range2").slider("values", 0) + " - " + $("#slider-range2").slider("values", 1));
                    });
                </script>
                <?php
                foreach ($res->result() as $val) {
                    echo "<div style='color:white;margin-right:15px;' >";
                    if ($lang == 'en') {
                        echo '<label for="amount">' . $x[3]->har_en . '</label>';

                    } else {
                        echo '<label for="amount">' . $x[3]->har . '</label>';
                    }
                    echo '<input type="text" id="amount" name="second[]" readonly style="border:0; color:#f6931f; font-weight:bold;width:40%">';
                    echo "<input type='hidden' value='" . $x[3]->id_har . "' name='id_har[]'></div>";
                    echo '<div id="slider-range"></div>';
                    //<input type='text' value='' name='second[]'>

                    echo "<div style='color:white;margin-right:15px;' >";
                    if ($lang == 'en') {
                        echo '<label for="amount1">' . $x[4]->har_en . '</label>';
                    } else {
                        echo '<label for="amount1">' . $x[4]->har . '</label>';
                    }
                    echo '<input type="text" id="amount1" name="second[]" readonly style="border:0; color:#f6931f; font-weight:bold;width:40%">';
                    echo "<input type='hidden' value='" . $x[4]->id_har . "' name='id_har[]'></div>";
                    echo '<div id="slider-range1"></div>';
                    //<input type='text' value='' name='second[]'>

                    echo "<div style='color:white;margin-right:15px;' >";
                    if ($lang == 'en') {
                        echo '<label for="amount2">' . $x[6]->har_en . '</label>';
                    } else {
                        echo '<label for="amount2">' . $x[6]->har . '</label>';
                    }
                    echo '<input type="text" id="amount2" name="second[]" readonly style="border:0; color:#f6931f; font-weight:bold;width:40%">';
                    echo "<input type='hidden' value='" . $x[6]->id_har . "' name='id_har[]'></div>";
                    echo '<div id="slider-range2"></div>';
                    //<input type='text' value='' name='second[]'>";


                    $this->db->where('id_har', $val->id_har);
                    $this->db->group_by('id_har');
                    $q = $this->db->get('ach_game_har');

                    $w = $q->result();
                    $this->db->where('id_har', $w[0]->id_har);
                    $this->db->where('id_ach_game', $id_game);
                    $e = $this->db->get('har_value');

                    echo "<div style='color:white;margin-right:15px; '>";
                    if ($lang == 'en') {
                        echo $w[0]->har_en;
                    } else {
                        echo $w[0]->har;
                    }
                    echo "</div>";
                    echo "<input type='hidden' value='" . $w[0]->id_har . "' name='id_har[]'>";
                    echo "<select name='second[]'><option value=''>". $this->lang->line('opt'). "</option>";
                    foreach ($e->result() as $wq) {
                        echo "<option value='" . $wq->id_val . "'>";
                        if ($lang == 'en') {
                            echo $wq->value_en;
                        } else {
                            echo $wq->value;
                        }
                        echo "</option>";
                    }
                    echo "</select>";
                }
                break;
            case 3:
                ?>
                <script>
                    $(function () {
                        $("#slider-range").slider({
                            range: true,
                            min: 0,
                            max: 20000,
                            values: [1, 20000],
                            slide: function (event, ui) {
                                $("#amount").val(ui.values[0] + " - " + ui.values[1]);
                            }
                        });
                        $("#amount").val($("#slider-range").slider("values", 0) + " - " + $("#slider-range").slider("values", 1));
                    });
                </script>
                <script>
                    $(function () {
                        $("#slider-range1").slider({
                            range: true,
                            min: 0,
                            max: 100,
                            values: [1, 100],
                            slide: function (event, ui) {
                                $("#amount1").val(ui.values[0] + " - " + ui.values[1]);
                            }
                        });
                        $("#amount1").val($("#slider-range1").slider("values", 0) + " - " + $("#slider-range1").slider("values", 1));
                    });
                </script>
                <script>
                    $(function () {
                        $("#slider-range2").slider({
                            range: true,
                            min: 0,
                            max: 100,
                            values: [1, 100],
                            slide: function (event, ui) {
                                $("#amount2").val(ui.values[0] + " - " + ui.values[1]);
                            }
                        });
                        $("#amount2").val($("#slider-range2").slider("values", 0) + " - " + $("#slider-range2").slider("values", 1));
                    });
                </script>
                <script>
                    $(function () {
                        $("#slider-range3").slider({
                            range: true,
                            min: 0,
                            max: 200000,
                            values: [1, 200000],
                            slide: function (event, ui) {
                                $("#amount3").val(ui.values[0] + " - " + ui.values[1]);
                            }
                        });
                        $("#amount3").val($("#slider-range3").slider("values", 0) + " - " + $("#slider-range3").slider("values", 1));
                    });
                </script>
                <?php
                foreach ($res->result() as $val) {
                    echo "<div style='color:white;margin-right:15px;'>";
                    if ($lang == 'en') {
                        echo '<label for="amount">' . $x[7]->har_en . '</label>';
                    } else {
                        echo '<label for="amount">' . $x[7]->har . '</label>';
                    }
                    echo '<input type="text" id="amount" name="third[]" readonly style="border:0; color:#f6931f; font-weight:bold;width:40%">';
                    echo "<input type='hidden' value='" . $x[7]->id_har . "' name='id_har[]'></div>";
                    echo '<div id="slider-range"></div>';

                    echo "<div style='color:white;margin-right:15px;'>";
                    if ($lang == 'en') {
                        echo '<label for="amount1">' . $x[8]->har_en . '</label>';
                    } else {
                        echo '<label for="amount1">' . $x[8]->har . '</label>';
                    }
                    echo '<input type="text" id="amount1" name="third[]" readonly style="border:0; color:#f6931f; font-weight:bold;width:40%">';
                    echo "<input type='hidden' value='" . $x[8]->id_har . "' name='id_har[]'></div>";
                    echo '<div id="slider-range1"></div>';

                    echo "<div style='color:white;margin-right:15px;'>";
                    if ($lang == 'en') {
                        echo '<label for="amount2">' . $x[9]->har_en . '</label>';;
                    } else {
                        echo '<label for="amount2">' . $x[9]->har . '</label>';
                    }
                    echo '<input type="text" id="amount2" name="third[]" readonly style="border:0; color:#f6931f; font-weight:bold;width:40%">';
                    echo "<input type='hidden' value='" . $x[9]->id_har . "' name='id_har[]'></div>";
                    echo '<div id="slider-range2"></div>';

                    echo "<div style='color:white;margin-right:15px;'>";
                    if ($lang == 'en') {
                        echo '<label for="amount3">' . $x[10]->har_en . '</label>';
                    } else {
                        echo '<label for="amount3">' . $x[10]->har . '</label>';
                    }
                    echo '<input type="text" id="amount3" name="third[]" readonly style="border:0; color:#f6931f; font-weight:bold;width:40%">';
                    echo "<input type='hidden' value='" . $x[10]->id_har . "' name='id_har[]'></div>";
                    echo '<div id="slider-range3"></div>';

                    $this->db->where('id_har', $val->id_har);
                    $this->db->group_by('id_har');
                    $q = $this->db->get('ach_game_har');

                    $w = $q->result();
                    $this->db->where('id_har', $w[0]->id_har);
                    $this->db->where('id_ach_game', $id_game);
                    $e = $this->db->get('har_value');

                    echo "
<div style='color:white;margin-right:15px; '>";
                    if ($lang == 'en') {
                        echo $x[11]->har_en;
                    } else {
                        echo $x[11]->har;
                    }
                    echo "
</div>";
                    echo "<input type='hidden' value='" . $x[11]->id_har . "' name='id_har[]'><select name='third[]'>
                    <option value=''>".$this->lang->line('opt')."</option>";
                    foreach ($e->result() as $wq) {
                        echo "
    <option value='" . $wq->id_val . "'>";
                        if ($lang == 'en') {
                            echo $wq->value_en;
                        } else {
                            echo $wq->value;
                        }
                        echo "
    </option>
    ";
                    }
                    echo '</select>';
                }
                break;
            case 4:
                ?>
                <script>
                    $(function () {
                        $("#slider-range").slider({
                            range: true,
                            min: 0,
                            max: 10000,
                            values: [1, 10000],
                            slide: function (event, ui) {
                                $("#amount").val(ui.values[0] + " - " + ui.values[1]);
                            }
                        });
                        $("#amount").val($("#slider-range").slider("values", 0) + " - " + $("#slider-range").slider("values", 1));
                    });
                </script>
                <script>
                    $(function () {
                        $("#slider-range1").slider({
                            range: true,
                            min: 0,
                            max: 3000,
                            values: [1, 3000],
                            slide: function (event, ui) {
                                $("#amount1").val(ui.values[0] + " - " + ui.values[1]);
                            }
                        });
                        $("#amount1").val($("#slider-range1").slider("values", 0) + " - " + $("#slider-range1").slider("values", 1));
                    });
                </script>
                <?php
                echo "
<div style='color:white;margin-right:15px;'>";
                if ($lang == 'en') {
                    echo '<label for="amount">' . $x[12]->har_en . '</label>';
                } else {
                    echo '<label for="amount">' . $x[12]->har . '</label>';
                }
                echo '<input type="text" id="amount" name="four[]" readonly style="border:0; color:#f6931f; font-weight:bold;width:40%">';
                echo "<input type='hidden' value='" . $x[12]->id_har . "' name='id_har[]'></div>";
                echo '<div id="slider-range"></div>';

                echo "<div style='color:white;margin-right:15px;'>";
                if ($lang == 'en') {
                    echo '<label for="amount1">' . $x[13]->har_en . '</label>';
                } else {
                    echo '<label for="amount1">' . $x[13]->har . '</label>';
                }
                echo '<input type="text" id="amount1" name="four[]" readonly style="border:0; color:#f6931f; font-weight:bold;width:40%">';
                echo "<input type='hidden' value='" . $x[13]->id_har . "' name='id_har[]'></div>";
                echo '<div id="slider-range1"></div>';

                foreach ($res->result() as $val) {

                    $this->db->where('id_har', $val->id_har);
                    $this->db->group_by('id_har');
                    $q = $this->db->get('ach_game_har');

                    $w = $q->result();

                    $this->db->where('id_har', $w[0]->id_har);
                    $this->db->where('id_ach_game', $id_game);
                    $e = $this->db->get('har_value');

                    echo "
<div style='color:white;margin-right:15px; '>";
                    if ($lang == 'en') {
                        echo $w[0]->har_en;
                    } else {
                        echo $w[0]->har;
                    }
                    echo "
</div>";
                    echo "<input type='hidden' value='" . $w[0]->id_har . "' name='id_har[]'><select name='four[]'>
                    <option value=''>".$this->lang->line('opt')."</option>";
                    foreach ($e->result() as $wq) {
                        echo "
    <option value='" . $wq->id_val . "'>";
                        if ($lang == 'en') {
                            echo $wq->value_en;
                        } else {
                            echo $wq->value;
                        }
                        echo "
    </option>
    ";
                    }
                    echo '</select>';
                }
                break;
            case 5:
                ?>
                <script>
                    $(function () {
                        $("#slider-range").slider({
                            range: true,
                            min: 0,
                            max: 40000,
                            values: [1, 40000],
                            slide: function (event, ui) {
                                $("#amount").val(ui.values[0] + " - " + ui.values[1]);
                            }
                        });
                        $("#amount").val($("#slider-range").slider("values", 0) + " - " + $("#slider-range").slider("values", 1));
                    });
                </script>

                <?php
                echo "
<div style='color:white;margin-right:15px;'>";
                if ($lang == 'en') {
                    echo '<label for="amount">' . $x[15]->har_en . '</label>';
                } else {
                    echo '<label for="amount">' . $x[15]->har . '</label>';
                }
                echo '<input type="text" id="amount" name="five[]" readonly style="border:0; color:#f6931f; font-weight:bold;width:40%">';
                echo "<input type='hidden' value='" . $x[15]->id_har . "' name='id_har[]'></div>";
                echo '<div id="slider-range"></div>';

                foreach ($res->result() as $val) {

                    $this->db->where('id_har', $val->id_har);
                    $this->db->group_by('id_har');
                    $q = $this->db->get('ach_game_har');
//print_r($this->db->queries);
                    $w = $q->result();

                    $this->db->where('id_har', $w[0]->id_har);
                    $this->db->where('id_ach_game', $id_game);
                    $e = $this->db->get('har_value');

                    echo "
<div style='color:white;margin-right:15px; '>";
                    if ($lang == 'en') {
                        echo $w[0]->har_en;
                    } else {
                        echo $w[0]->har;
                    }
                    echo "
</div>";
                    echo "<input type='hidden' value='" . $w[0]->id_har . "' name='id_har[]'><select name='five[]'>
                    <option value=''>".$this->lang->line('opt')."</option>";
                    foreach ($e->result() as $wq) {
                        echo "
    <option value='" . $wq->id_val . "'>";
                        if ($lang == 'en') {
                            echo $wq->value_en;
                        } else {
                            echo $wq->value;
                        }
                        echo "
    </option>
    ";
                    }
                    echo '</select>';
                }
                break;
            case 6:
                ?>
                <script>
                    $(function () {
                        $("#slider-range").slider({
                            range: true,
                            min: 0,
                            max: 10000,
                            values: [1, 10000],
                            slide: function (event, ui) {
                                $("#amount").val(ui.values[0] + " - " + ui.values[1]);
                            }
                        });
                        $("#amount").val($("#slider-range").slider("values", 0) + " - " + $("#slider-range").slider("values", 1));
                    });
                </script>

                <?php
                echo "
<div style='color:white;margin-right:15px;'>";
                if ($lang == 'en') {
                    echo '<label for="amount">' . $x[12]->har_en . '</label>';
                } else {
                    echo '<label for="amount">' . $x[12]->har . '</label>';
                }
                echo '<input type="text" id="amount" name="six[]" readonly style="border:0; color:#f6931f; font-weight:bold;width:40%">';
                echo "<input type='hidden' value='" . $x[12]->id_har . "' name='id_har[]'></div>";
                echo '<div id="slider-range"></div>';

                foreach ($res->result() as $val) {

                    $this->db->where('id_har', $val->id_har);
                    $this->db->group_by('id_har');
                    $q = $this->db->get('ach_game_har');
//print_r($this->db->queries);
                    $w = $q->result();

                    $this->db->where('id_har', $w[0]->id_har);
                    $this->db->where('id_ach_game', $id_game);
                    $e = $this->db->get('har_value');

                    echo "
<div style='color:white;margin-right:15px; '>";
                    if ($lang == 'en') {
                        echo $w[0]->har_en;
                    } else {
                        echo $w[0]->har;
                    }
                    echo "
</div>";
                    echo "<input type='hidden' value='" . $w[0]->id_har . "' name='id_har[]'><select name='six[]'>
                    <option value=''>".$this->lang->line('opt')."</option>";
                    foreach ($e->result() as $wq) {
                        echo "
    <option value='" . $wq->id_val . "'>";
                        if ($lang == 'en') {
                            echo $wq->value_en;
                        } else {
                            echo $wq->value;
                        }
                        echo "
    </option>
    ";
                    }
                    echo '</select>';
                }
                break;
            case 7:
                ?>
                <script>
                    $(function () {
                        $("#slider-range").slider({
                            range: true,
                            min: 0,
                            max: 20000,
                            values: [1, 20000],
                            slide: function (event, ui) {
                                $("#amount").val(ui.values[0] + " - " + ui.values[1]);
                            }
                        });
                        $("#amount").val($("#slider-range").slider("values", 0) + " - " + $("#slider-range").slider("values", 1));
                    });
                </script>

                <?php
                echo "
<div style='color:white;margin-right:15px;'>";
                if ($lang == 'en') {
                    echo '<label for="amount">' . $x[12]->har_en . '</label>';
                } else {
                    echo '<label for="amount">' . $x[12]->har . '</label>';
                }
                echo '<input type="text" id="amount" name="seven[]" readonly style="border:0; color:#f6931f; font-weight:bold;width:40%">';
                echo "<input type='hidden' value='" . $x[12]->id_har . "' name='id_har[]'></div>";
                echo '<div id="slider-range"></div>';

                foreach ($res->result() as $val) {

                    $this->db->where('id_har', $val->id_har);
                    $this->db->group_by('id_har');
                    $q = $this->db->get('ach_game_har');
//print_r($this->db->queries);
                    $w = $q->result();

                    $this->db->where('id_har', $w[0]->id_har);
                    $this->db->where('id_ach_game', $id_game);
                    $e = $this->db->get('har_value');

                    echo "
<div style='color:white;margin-right:15px; '>";
                    if ($lang == 'en') {
                        echo $w[0]->har_en;
                    } else {
                        echo $w[0]->har;
                    }
                    echo "
</div>";
                    echo "<input type='hidden' value='" . $w[0]->id_har . "' name='id_har[]'><select name='seven[]'>";
                    echo "<option value=''>".$this->lang->line('opt')."</option>";
                    foreach ($e->result() as $wq) {
                        echo "
    <option value='" . $wq->id_val . "'>";
                        if ($lang == 'en') {
                            echo $wq->value_en;
                        } else {
                            echo $wq->value;
                        }
                        echo "
    </option>
    ";
                    }
                    echo '</select>';
                }
                break;
            case 8:
                ?>
                <script>
                    $(function () {
                        $("#slider-range").slider({
                            range: true,
                            min: 0,
                            max: 1000,
                            values: [1, 1000],
                            slide: function (event, ui) {
                                $("#amount").val(ui.values[0] + " - " + ui.values[1]);
                            }
                        });
                        $("#amount").val($("#slider-range").slider("values", 0) + " - " + $("#slider-range").slider("values", 1));
                    });
                </script>

                <?php
                echo "
<div style='color:white;margin-right:15px;'>";
                if ($lang == 'en') {
                    echo '<label for="amount">' . $x[12]->har_en . '</label>';
                } else {
                    echo '<label for="amount">' . $x[12]->har . '</label>';
                }
                echo '<input type="text" id="amount" name="eight[]" readonly style="border:0; color:#f6931f; font-weight:bold;width:40%">';
                echo "<input type='hidden' value='" . $x[12]->id_har . "' name='id_har[]'></div>";
                echo '<div id="slider-range"></div>';

                foreach ($res->result() as $val) {

                    $this->db->where('id_har', $val->id_har);
                    $this->db->group_by('id_har');
                    $q = $this->db->get('ach_game_har');
//print_r($this->db->queries);
                    $w = $q->result();

                    $this->db->where('id_har', $w[0]->id_har);
                    $this->db->where('id_ach_game', $id_game);
                    $e = $this->db->get('har_value');

                    echo "
<div style='color:white;margin-right:15px; '>";
                    if ($lang == 'en') {
                        echo $w[0]->har_en;
                    } else {
                        echo $w[0]->har;
                    }
                    echo "
</div>";
                    echo "<input type='hidden' value='" . $w[0]->id_har . "' name='id_har[]'><select name='eight[]'>";
                    echo "<option value=''>".$this->lang->line('opt')."</option>";
                    foreach ($e->result() as $wq) {
                        echo "
    <option value='" . $wq->id_val . "'>";
                        if ($lang == 'en') {
                            echo $wq->value_en;
                        } else {
                            echo $wq->value;
                        }
                        echo "
    </option>
    ";
                    }
                    echo '</select>';
                }
                break;
            case 9:
                ?>
                <script>
                    $(function () {
                        $("#slider-range").slider({
                            range: true,
                            min: 0,
                            max: 5000,
                            values: [1, 5000],
                            slide: function (event, ui) {
                                $("#amount").val(ui.values[0] + " - " + ui.values[1]);
                            }
                        });
                        $("#amount").val($("#slider-range").slider("values", 0) + " - " + $("#slider-range").slider("values", 1));
                    });
                </script>

                <?php
                echo "
<div style='color:white;margin-right:15px;'>";
                if ($lang == 'en') {
                    echo '<label for="amount">' . $x[25]->har_en . '</label>';
                } else {
                    echo '<label for="amount">' . $x[25]->har . '</label>';
                }
                echo '<input type="text" id="amount" name="nine[]" readonly style="border:0; color:#f6931f; font-weight:bold;width:40%">';
                echo "<input type='hidden' value='" . $x[25]->id_har . "' name='id_har[]'></div>";
                echo '<div id="slider-range"></div>';

                foreach ($res->result() as $val) {

                    $this->db->where('id_har', $val->id_har);
                    $this->db->group_by('id_har');
                    $q = $this->db->get('ach_game_har');
//print_r($this->db->queries);
                    $w = $q->result();

                    $this->db->where('id_har', $w[0]->id_har);
                    $this->db->where('id_ach_game', $id_game);
                    $e = $this->db->get('har_value');

                    echo "
<div style='color:white;margin-right:15px; '>";
                    if ($lang == 'en') {
                        echo $w[0]->har_en;
                    } else {
                        echo $w[0]->har;
                    }
                    echo "
</div>";
                    echo "<input type='hidden' value='" . $w[0]->id_har . "' name='id_har[]'><select name='nine[]'>";
                    echo "<option value=''>".$this->lang->line('opt')."</option>";
                    foreach ($e->result() as $wq) {
                        echo "
    <option value='" . $wq->id_val . "'>";
                        if ($lang == 'en') {
                            echo $wq->value_en;
                        } else {
                            echo $wq->value;
                        }
                        echo "
    </option>
    ";
                    }
                    echo '</select>';
                }
                break;
            case 10:  ?>
                <script>
                    $(function () {
                        $("#slider-range").slider({
                            range: true,
                            min: 0,
                            max: 20000,
                            values: [1, 20000],
                            slide: function (event, ui) {
                                $("#amount").val(ui.values[0] + " - " + ui.values[1]);
                            }
                        });
                        $("#amount").val($("#slider-range").slider("values", 0) + " - " + $("#slider-range").slider("values", 1));
                    });
                </script>

                <?php
                echo "
<div style='color:white;margin-right:15px;'>";
                if ($lang == 'en') {
                    echo '<label for="amount">' . $x[34]->har_en . '</label>';
                } else {
                    echo '<label for="amount">' . $x[34]->har . '</label>';
                }
                echo '<input type="text" id="amount" name="ten[]" readonly style="border:0; color:#f6931f; font-weight:bold;width:40%">';
                echo "<input type='hidden' value='" . $x[34]->id_har . "' name='id_har[]'></div>";
                echo '<div id="slider-range"></div>';

                foreach ($res->result() as $val) {

                    $this->db->where('id_har', $val->id_har);
                    $this->db->group_by('id_har');
                    $q = $this->db->get('ach_game_har');
//print_r($this->db->queries);
                    $w = $q->result();

                    $this->db->where('id_har', $w[0]->id_har);
                    $this->db->where('id_ach_game', $id_game);
                    $e = $this->db->get('har_value');

                    echo "
<div style='color:white;margin-right:15px; '>";
                    if ($lang == 'en') {
                        echo $w[0]->har_en;
                    } else {
                        echo $w[0]->har;
                    }
                    echo "
</div>";
                    echo "<input type='hidden' value='" . $w[0]->id_har . "' name='id_har[]'><select name='ten[]'>
                    <option value=''>".$this->lang->line('opt')."</option>";
                    foreach ($e->result() as $wq) {
                        echo "
    <option value='" . $wq->id_val . "'>";
                        if ($lang == 'en') {
                            echo $wq->value_en;
                        } else {
                            echo $wq->value;
                        }
                        echo "
    </option>
    ";
                    }
                    echo '</select>';
                }

                break;
            case 11: ;
                ?>
                <script>
                    $(function () {
                        $("#slider-range").slider({
                            range: true,
                            min: 0,
                            max: 65,
                            values: [1, 65],
                            slide: function (event, ui) {
                                $("#amount").val(ui.values[0] + " - " + ui.values[1]);
                            }
                        });
                        $("#amount").val($("#slider-range").slider("values", 0) + " - " + $("#slider-range").slider("values", 1));
                    });
                </script>
                <script>
                    $(function () {
                        $("#slider-range1").slider({
                            range: true,
                            min: 0,
                            max: 20,
                            values: [1, 20],
                            slide: function (event, ui) {
                                $("#amount1").val(ui.values[0] + " - " + ui.values[1]);
                            }
                        });
                        $("#amount1").val($("#slider-range1").slider("values", 0) + " - " + $("#slider-range1").slider("values", 1));
                    });
                </script>
                <?php
                echo "
<div style='color:white;margin-right:15px;'>";
                if ($lang == 'en') {
                    echo '<label for="amount">' . $x[18]->har_en . '</label>';
                } else {
                    echo '<label for="amount">' . $x[18]->har . '</label>';
                }
                echo '<input type="text" id="amount" name="elev[]" readonly style="border:0; color:#f6931f; font-weight:bold;width:40%">';
                echo "<input type='hidden' value='" . $x[18]->id_har . "' name='id_har[]'></div>";
                echo '<div id="slider-range"></div>';

                echo "<div style='color:white;margin-right:15px;'>";
                if ($lang == 'en') {
                    echo '<label for="amount1">' . $x[26]->har_en . '</label>';
                } else {
                    echo '<label for="amount1">' . $x[26]->har . '</label>';
                }
                echo '<input type="text" id="amount1" name="elev[]" readonly style="border:0; color:#f6931f; font-weight:bold;width:40%">';
                echo "<input type='hidden' value='" . $x[26]->id_har . "' name='id_har[]'></div>";
                echo '<div id="slider-range1"></div>';

                foreach ($res->result() as $val) {

                    $this->db->where('id_har', $val->id_har);
                    $this->db->group_by('id_har');
                    $q = $this->db->get('ach_game_har');

                    $w = $q->result();

                    $this->db->where('id_har', $w[0]->id_har);
                    $this->db->where('id_ach_game', $id_game);
                    $e = $this->db->get('har_value');

                    echo "
<div style='color:white;margin-right:15px; '>";
                    if ($lang == 'en') {
                        echo $w[0]->har_en;
                    } else {
                        echo $w[0]->har;
                    }
                    echo "
</div>";
                    echo "<input type='hidden' value='" . $w[0]->id_har . "' name='id_har[]'><select name='elev[]'>
                    <option value=''>".$this->lang->line('opt')."</option>";
                    foreach ($e->result() as $wq) {
                        echo "
    <option value='" . $wq->id_val . "'>";
                        if ($lang == 'en') {
                            echo $wq->value_en;
                        } else {
                            echo $wq->value;
                        }
                        echo "
    </option>
    ";
                    }
                    echo '</select>';
                }
                break;
            case 12:
                foreach ($res->result() as $val) {

                    $this->db->where('id_har', $val->id_har);
                    $this->db->group_by('id_har');
                    $q = $this->db->get('ach_game_har');

                    $w = $q->result();
                    $this->db->where('id_har', $w[0]->id_har);
                    $this->db->where('id_ach_game', $id_game);
                    $e = $this->db->get('har_value');

                    echo "<div style='color:white;margin-right:15px; '>";
                    if ($lang == 'en') {
                        echo $w[0]->har_en;
                    } else {
                        echo $w[0]->har;
                    }
                    echo "<input type='hidden' value='" . $w[0]->id_har . "' name='id_har[]'></div>";
                    echo "<select name='tvel[]' class='first'><option value=''>".$this->lang->line('opt')."</option>";
                    foreach ($e->result() as $wq) {
                        if ($lang == 'en') {
                            echo "<option value='" . $wq->id_val . "'>" . $wq->value_en . "</option>";
                        } else {
                            echo "<option value='" . $wq->id_val . "'>" . $wq->value . "</option>";
                        }
                    }
                    echo '</select>';
                }
                break;
            case 13:
                ?>
                <script>
                    $(function () {
                        $("#slider-range").slider({
                            range: true,
                            min: 1,
                            max: 110,
                            values: [1, 110],
                            slide: function (event, ui) {
                                $("#amount").val(ui.values[0] + " - " + ui.values[1]);
                            }
                        });
                        $("#amount").val($("#slider-range").slider("values", 0) + " - " + $("#slider-range").slider("values", 1));
                    });
                </script>
                <script>
                    $(function () {
                        $("#slider-range1").slider({
                            range: true,
                            min: 1,
                            max: 10000,
                            values: [1, 10000],
                            slide: function (event, ui) {
                                $("#amount1").val(ui.values[0] + " - " + ui.values[1]);
                            }
                        });
                        $("#amount1").val($("#slider-range1").slider("values", 0) + " - " + $("#slider-range1").slider("values", 1));
                    });
                </script>
                <script>
                    $(function () {
                        $("#slider-range2").slider({
                            range: true,
                            min: 1,
                            max: 10000,
                            values: [1, 10000],
                            slide: function (event, ui) {
                                $("#amount2").val(ui.values[0] + " - " + ui.values[1]);
                            }
                        });
                        $("#amount2").val($("#slider-range2").slider("values", 0) + " - " + $("#slider-range2").slider("values", 1));
                    });
                </script>
                <?php

                    echo "<div style='color:white;margin-right:15px;' >";
                    if ($lang == 'en') {
                        echo '<label for="amount">' . $x[18]->har_en . '</label>';

                    } else {
                        echo '<label for="amount">' . $x[18]->har . '</label>';
                    }
                    echo '<input type="text" id="amount" name="thot[]" readonly style="border:0; color:#f6931f; font-weight:bold;width:40%">';
                    echo "<input type='hidden' value='" . $x[18]->id_har . "' name='id_har[]'></div>";
                    echo '<div id="slider-range"></div>';
                    //<input type='text' value='' name='second[]'>

                    echo "<div style='color:white;margin-right:15px;' >";
                    if ($lang == 'en') {
                        echo '<label for="amount1">' . $x[31]->har_en . '</label>';
                    } else {
                        echo '<label for="amount1">' . $x[31]->har . '</label>';
                    }
                    echo '<input type="text" id="amount1" name="thot[]" readonly style="border:0; color:#f6931f; font-weight:bold;width:40%">';
                    echo "<input type='hidden' value='" . $x[31]->id_har . "' name='id_har[]'></div>";
                    echo '<div id="slider-range1"></div>';
                    //<input type='text' value='' name='second[]'>

                    echo "<div style='color:white;margin-right:15px;' >";
                    if ($lang == 'en') {
                        echo '<label for="amount2">' . $x[32]->har_en . '</label>';
                    } else {
                        echo '<label for="amount2">' . $x[32]->har . '</label>';
                    }
                    echo '<input type="text" id="amount2" name="thot[]" readonly style="border:0; color:#f6931f; font-weight:bold;width:40%">';
                    echo "<input type='hidden' value='" . $x[32]->id_har . "' name='id_har[]'></div>";
                    echo '<div id="slider-range2"></div>';
                    //<input type='text' value='' name='second[]'>";

                    foreach ($res->result() as $val) {
                    $this->db->where('id_har', $val->id_har);
                    $this->db->group_by('id_har');
                    $q = $this->db->get('ach_game_har');

                    $w = $q->result();
                    $this->db->where('id_har', $w[0]->id_har);
                    $this->db->where('id_ach_game', $id_game);
                    $e = $this->db->get('har_value');

                    echo "<div style='color:white;margin-right:15px; '>";
                    if ($lang == 'en') {
                        echo $w[0]->har_en;
                    } else {
                        echo $w[0]->har;
                    }
                    echo "</div>";
                    echo "<input type='hidden' value='" . $w[0]->id_har . "' name='id_har[]'>";
                    echo "<select name='thot[]'><option value=''>". $this->lang->line('opt'). "</option>";
                    foreach ($e->result() as $wq) {
                        echo "<option value='" . $wq->id_val . "'>";
                        if ($lang == 'en') {
                            echo $wq->value_en;
                        } else {
                            echo $wq->value;
                        }
                        echo "</option>";
                    }
                    echo "</select>";
                }
                break;
        }


    }

}
