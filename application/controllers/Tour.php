<?php

defined('BASEPATH') OR exit('No direct script access allowed');

class Tour extends CI_Controller {

    var $dataz = array();

    function __construct() {
        parent::__construct();
        $this->dataz['month_array_rus'] = array("01" => "января",
            "02" => "февраля",
            "03" => "марта",
            "04" => "апреля",
            "05" => "мая",
            "06" => "июня",
            "07" => "июля",
            "08" => "августа",
            "09" => "сентября",
            "10" => "октября",
            "11" => "ноября",
            "12" => "декабря");
        $this->dataz['month_array_en'] = array("01" => "january",
            "02" => "february",
            "03" => "march",
            "04" => "april",
            "05" => "may",
            "06" => "june",
            "07" => "jule",
            "08" => "august",
            "09" => "september",
            "10" => "october",
            "11" => "november",
            "12" => "december");
        $this->load->model('lang_model');
        $this->dataz['lang'] = $this->lang_model->index();
    }

    public function tournaments() {
        $data['title'] = 'Everyplayer - Tournaments List';
        $this->load->model('home_model');
        $this->load->model('players_model');
        $this->load->model('tour_model');
        $data['lang'] = $this->dataz['lang'];
        $arr = array('side' => $this->uri->segment(2));
        $this->session->set_userdata($arr);
        $data['month_array_en'] = $this->dataz['month_array_en'];
        $data['month_array_rus'] = $this->dataz['month_array_rus'];
        $data['name_tour'] = $this->tour_model->get_tour_name();

        $data['slider'] = $this->home_model->get_slider();
        $data['tour'] = $this->tour_model->get_tours();

        $data['favor_all'] = $this->players_model->get_favor_games();

        $this->load->view('header', $data);
        $this->load->view('heading', $data);
        $this->load->view('tour/tournaments', $data);
        $this->load->view('footer', $data);
    }

    public function tournament($param) {
        $data['title'] = 'Everyplayer - Tournament';
        $data['month_array_en'] = $this->dataz['month_array_en'];
        $data['month_array_rus'] = $this->dataz['month_array_rus'];
        $arr = array('side' => $this->uri->segment(2));
        $this->session->set_userdata($arr);
        $this->load->model('home_model');
        $data['slider'] = $this->home_model->get_slider();
        $data['lang'] = $this->dataz['lang'];
        $this->load->model('tour_model');
        $data['tourn'] = $this->tour_model->get_tour($param);
        $data['users'] = $this->tour_model->get_friends();
        $data['command'] = $this->tour_model->get_command($param);
        $this->load->view('header', $data);
        $this->load->view('heading', $data);
        $this->load->view('tour/tournament', $data);
        $this->load->view('footer', $data);
    }

    public function new_command($param) {
        $datas['lang'] = $this->dataz['lang'];
        $name = $this->input->post('name_command');
        $leader = $this->session->userdata('id');
        $players = $this->input->post('players');
        $member = array();
        for ($i = 0; $i < count($players); $i++) {
            $member[] = $players[$i];
        }
        $member[] = $leader;
        $config['upload_path'] = './images/tournament/';
        $config['allowed_types'] = 'png|jpg';
        $this->load->library('upload');
        $this->upload->initialize($config);
        if (!$this->upload->do_upload()) {
            $error = array('error' => $this->upload->display_errors());
            var_dump($error);
        } else {
            $data = array('upload_data' => $this->upload->data()); //данные по файлу
            $path = $data['upload_data']['file_name']; //имя файла
            $dat = array("id_tour" => $param, "name_command" => $name, "logo_command" => $path);
            $this->db->insert('command', $dat);
            $id_comm = $this->db->insert_id();
            for ($i = 0; $i < count($member); $i++) {
                $mem = array('id_comm' => $id_comm, 'id_user' => $member[$i]);
                $this->db->insert('members_command', $mem);
            }
            redirect(base_url() . $datas['lang'] . '/' . $this->session->userdata('side') . '/tournament/' . $param, 'refresh');
        }
    }

    public function dates() {
        $datas['lang'] = $this->input->post('lang');
        $id = $this->input->post('id');
        $this->load->model('tour_model');
        $arr = array('side' => $this->uri->segment(2));
        $this->session->set_userdata($arr);

        $get_data = $this->tour_model->get_data($id);
        $data['month_array_en'] = $this->dataz['month_array_en'];
        $data['month_array_rus'] = $this->dataz['month_array_rus'];
        $arrr = explode(" ", $get_data[0]->date_start);
        $arr = explode(":", $arrr[1]);
        $ar = explode("-", $arrr[0]);
        $dat['day'] = $ar[2];

        if ($datas['lang'] == 'en') {
            $dat['mon'] = $data['month_array_en'][$ar[1]];
        } else {

            $dat['mon'] = $data['month_array_rus'][$ar[1]];
        }
        $dat['year'] = $ar[0];
        $dat['tim'] = $arrr[1];
        echo json_encode($dat);
    }

    public function get_next_three() {
        $data['title'] = 'Everyplayer';
        $this->load->model('tour_model');
        $data['get_next'] = $this->tour_model->get_ten_next($this->input->post('startFrom'));
        echo $data['get_next'];
    }

    public function name_tour() {
        $this->load->model('lang_model');
        $data['lang'] = $this->lang_model->index($this->input->post('lang'));
        $data['title'] = 'Everyplayer - Tournaments List';
        $this->load->model('home_model');
        $this->load->model('players_model');
        $this->load->model('tour_model');
        $data['lang'] = $this->input->post('lang');
        $data['month_array_en'] = $this->dataz['month_array_en'];
        $data['month_array_rus'] = $this->dataz['month_array_rus'];
        $data['name_tour'] = $this->tour_model->get_tour_name();
        $tour_id = $this->input->post('id_tour');
        $data['slider'] = $this->home_model->get_slider();
        $tour = $this->tour_model->get_tours($tour_id);

        $data['favor_all'] = $this->players_model->get_favor_games();

        echo '<div class="news1"><div class="news_header"><div class="col-md-6 col-sm-12 col-xs-12 left">';
        $arrr = explode(" ", $tour[0]->date_start);
        $arr = explode(":", $arrr[1]);
        $ar = explode("-", $arrr[0]);
        $this->load->helper('trans_helper');
        $name = str_replace(' ', '_', $tour[0]->name_tour);
        $name = str_replace('&', '_', $name);
        $name = str_replace('(', '_', $name);
        $name = str_replace(')', '_', $name);
        $name = str_replace("'", '_', $name);
        $name = str_replace('"', '_', $name);
        $segment = mb_strtolower(transliterate($name));

        if ($data["lang"] == 'en') {
            $datas = $data['month_array_en'][$ar[1]];
        } else {

            $datas = $data['month_array_rus'][$ar[1]];
        }
        echo '<p>' . $ar[2] . ' ' . $datas . ' ' . $arr[0] . ':' . $arr[1] . '</p>';
        if ($tour[0]->for_who == 1) {
            $who = "Для всех / For all";
        }
        if ($tour[0]->for_who == 2) {
            $who = "Премиум / Premium";
        }
        echo '</div><div class="col-md-6 col-sm-12 col-xs-12 right"><div class="prem" ><p>' . $who . '</p></div>
                                    <div class="prem" ><p>' . $tour[0]->pay_tour . '</p></div><div class="liked"><p>' . $this->lang->line("liked") . '</p></div></div><div class="col-md-12 col-sm-12 col-xs-12">';
        echo '<h3>';

        if ($data['lang'] == 'en') {
            ?>                                
            <h3><?= $tour[0]->title_en ?></h3>
            <?php
        } else {
            echo "<h3>" . $tour[0]->name_tour . "</h3>";
        }
                            echo       '</div>
                        </div>
                        <div class="col-md-12">
                        <img src="' . base_url() . 'images/tournament/' . $tour[0]->img_tour . '">
                            </div>
                        <div class="col-md-12 news_text">';
        if ($data['lang'] != 'en') {
            ?>                              
            <h5><?= $tour[0]->descr_tour; ?></h5>
            <?php
        } else {
            echo "<h3>" . $tour[0]->text_en . "</h3>";
        }
        echo '</div>
                        <div class="col-md-6 col-sm-6 col-xs-12">
                            <div class="social_icon">
                                <ul>
                                      <!--***************************************************FACEBOOK*****************************************************************************************************-->
                                <div id="fb-root"></div>
                                <meta property="og:url"           content="' . base_url() . $data['lang'] . '/' . $this->session->userdata('side') . '/tournament/' . $tour[0]->tour_id . ' />
                                <meta property="og:type"          content="website" />
                                <meta property="og:title"         content="' . $tour[0]->name_tour . '" />
                                <meta property="og:image"         content="' . base_url() . 'images/tournament/' . $tour[0]->img_tour . '" />
                                <a id="share" href="http://www.facebook.com/sharer.php?u=' . base_url() . $data['lang'] . '/' . $this->session->userdata('side') . '/tournament/' . $tour[0]->tour_id . '" onclick="window.open(this.href, this.target, "width= 500,height=600,scrollbars=1,top=150,left=" + (window.screen.width / 2 - 250));return false;">
                                    <div class="fb"></div>
                                </a>
                                <!--------************************************************************************************************************************************-->
                                <!--***************************************************VK*****************************************************************************************************-->
                                <script type="text/javascript" src="http://vk.com/js/api/share.js?94" charset="windows-1251"></script>

                                <!-- Put this script tag to the place, where the Share button will be -->
                                <a href="http://vk.com/share.php?url=' . base_url() . $data['lang'] . '/' . $this->session->userdata('side') . '/tournament/' . $tour[0]->tour_id . '&title=' . $segment . '&image=' . base_url() . 'images/tournament/' . $tour[0]->img_tour . '&noparse=true"><div class="vk"></div></a>

                                <!--**********************************************************************************************************************************************************-->                               
                                <!--***************************************************TWITTER*****************************************************************************************************-->
                                    <a href="https://twitter.com/share?url=' . base_url() . $data['lang'] . '/' . $this->session->userdata('side') . '/tournament/' . $tour[0]->tour_id . '&text=' . $segment . '"  ><div class="tv"></div></a> 
                                <!--------************************************************************************************************************************************-->
                                <!--***************************************************GOOGLE+*****************************************************************************************************-->                                
                                
                                <a href="https://plus.google.com/share?url=' . base_url() . $data['lang'] . '/' . $this->session->userdata('side') . '/tournament/' . $tour[0]->tour_id . '" onclick="javascript:window.open(this.href,
                                                "", "menubar=no,toolbar=no,resizable=yes,scrollbars=yes,height=600,width=600");
                                        return false;"><div class="gl"></div></a>

                                <!--------************************************************************************************************************************************-->
                                
                                </ul>
                            </div>
                        </div>
                        <div class="col-md-6 col-sm-6 col-xs-12 button-center">
                            <input class="button_news spoiler" type="button" value="' . $this->lang->line("expand") . '">
                            <a href="/' . $data["lang"] . '/' . $this->session->userdata('side') . '/tournament/' . $tour[0]->tour_id . '/' . $segment . '"><input class="button_news" type="button" value="' . $this->lang->line('more') . '"></a>
                        </div>
                        <hr>
                        <hr>
                    </div>';
    }

    public function game_tour() {
        $this->load->model('lang_model');
        $data['lang'] = $this->lang_model->index($this->input->post('lang'));

        $data['title'] = 'Everyplayer - Tournaments List';
        $this->load->model('home_model');
        $this->load->model('players_model');
        $this->load->model('tour_model');
        //$data['lang'] = $this->input->post('lang');

        $data['month_array_en'] = $this->dataz['month_array_en'];
        $data['month_array_rus'] = $this->dataz['month_array_rus'];
        $data['name_tour'] = $this->tour_model->get_tour_name();
        $id_game = $this->input->post('id_game');
        $data['slider'] = $this->home_model->get_slider();
        $tour = $this->tour_model->get_tours_game($id_game);

        $data['favor_all'] = $this->players_model->get_favor_games();
        foreach ($tour as $tours) {
            echo '<div class="news1"><div class="news_header"><div class="col-md-6 col-sm-12 col-xs-12 left">';
            $arrr = explode(" ", $tours->date_start);
            $arr = explode(":", $arrr[1]);
            $ar = explode("-", $arrr[0]);
            $this->load->helper('trans_helper');
            $name = str_replace(' ', '_', $tours->name_tour);
            $name = str_replace('&', '_', $name);
            $name = str_replace('(', '_', $name);
            $name = str_replace(')', '_', $name);
            $name = str_replace("'", '_', $name);
            $name = str_replace('"', '_', $name);
            $segment = mb_strtolower(transliterate($name));

            if ($data["lang"] == 'en') {
                $datas = $data['month_array_en'][$ar[1]];
            } else {

                $datas = $data['month_array_rus'][$ar[1]];
            }
            echo '<p>' . $ar[2] . ' ' . $datas . ' ' . $arr[0] . ':' . $arr[1] . '</p>';
            if ($tours->for_who == 1) {
                $who = "Для всех / For all";
            }
            if ($tours->for_who == 2) {
                $who = "Премиум / Premium";
            }
            echo '</div><div class="col-md-6 col-sm-12 col-xs-12 right"><div class="prem" ><p>' . $who . '</p></div>
                                    <div class="prem" ><p>' . $tours->pay_tour . '</p></div><div class="liked"><p>' . $this->lang->line('liked') . '</p></div></div><div class="col-md-12 col-sm-12 col-xs-12">';
            echo '<h3>';

            if ($data['lang'] == 'en') {
                ?>                                
                <h3><?= $tours->title_en ?></h3>
                <?php
            } else {
                echo "<h3>" . $tours->name_tour . "</h3>";
            }
                            echo       '</div>
                        </div>
                        <div class="col-md-12">
                        <img src="' . base_url() . 'images/tournament/' . $tours->img_tour . '">
                            </div>
                        <div class="col-md-12 news_text">';
            if ($data['lang'] != 'en') {
                ?>                              
                <h5><?= $tours->descr_tour; ?></h5>
                <?php
            } else {
                echo "<h3>" . $tours->text_en . "</h3>";
            }
            echo '</div>
                        <div class="col-md-6 col-sm-6 col-xs-12">
                            <div class="social_icon">
                                <ul>
                                     <!--***************************************************FACEBOOK*****************************************************************************************************-->
                                <div id="fb-root"></div>
                                <meta property="og:url"           content="' . base_url() . $data['lang'] . '/' . $this->session->userdata('side') . '/tournament/' . $tours->tour_id . ' />
                                <meta property="og:type"          content="website" />
                                <meta property="og:title"         content="' . $tours->name_tour . '" />
                                <meta property="og:image"         content="' . base_url() . 'images/tournament/' . $tours->img_tour . '" />
                                <a id="share" href="http://www.facebook.com/sharer.php?u=' . base_url() . $data['lang'] . '/' . $this->session->userdata('side') . '/tournament/' . $tours->tour_id . '" onclick="window.open(this.href, this.target, "width= 500,height=600,scrollbars=1,top=150,left=" + (window.screen.width / 2 - 250));return false;">
                                    <div class="fb"></div>
                                </a>
                                <!--------************************************************************************************************************************************-->
                                <!--***************************************************VK*****************************************************************************************************-->
                                <script type="text/javascript" src="http://vk.com/js/api/share.js?94" charset="windows-1251"></script>

                                <!-- Put this script tag to the place, where the Share button will be -->
                                <a href="http://vk.com/share.php?url=' . base_url() . $data['lang'] . '/' . $this->session->userdata('side') . '/tournament/' . $tours->tour_id . '&title=' . $segment . '&image=' . base_url() . 'images/tournament/' . $tours->img_tour . '&noparse=true"><div class="vk"></div></a>

                                <!--**********************************************************************************************************************************************************-->                               
                                <!--***************************************************TWITTER*****************************************************************************************************-->
                                    <a href="https://twitter.com/share?url=' . base_url() . $data['lang'] . '/' . $this->session->userdata('side') . '/tournament/' . $tours->tour_id . '&text=' . $segment . '"  ><div class="tv"></div></a> 
                                <!--------************************************************************************************************************************************-->
                                <!--***************************************************GOOGLE+*****************************************************************************************************-->                                
                                
                                <a href="https://plus.google.com/share?url=' . base_url() . $data['lang'] . '/' . $this->session->userdata('side') . '/tournament/' . $tours->tour_id . '" onclick="javascript:window.open(this.href,
                                                "", "menubar=no,toolbar=no,resizable=yes,scrollbars=yes,height=600,width=600");
                                        return false;"><div class="gl"></div></a>

                                <!--------************************************************************************************************************************************-->
                                
                                </ul>
                            </div>
                        </div>
                        <div class="col-md-6 col-sm-6 col-xs-12 button-center">
                            <input class="button_news spoiler" type="button" value="' . $this->lang->line("expand") . '">
                            <a href="/' . $data["lang"] . '/' . $this->session->userdata('side') . '/tournament/' . $tours->tour_id . '/' . $segment . '"><input class="button_news" type="button" value="' . $this->lang->line('more') . '"></a>
                        </div>
                        <hr>
                        <hr>
                    </div>';
        }
    }

    public function tournament_out($param) {
        $data['title'] = 'Everyplayer - Tournament';
        $data['month_array_en'] = $this->dataz['month_array_en'];
        $data['month_array_rus'] = $this->dataz['month_array_rus'];
        $this->load->model('home_model');
        $data['slider'] = $this->home_model->get_slider();
        $data['lang'] = $this->dataz['lang'];
        $this->load->model('tour_model');
        $arr = array('side' => $this->uri->segment(2));
        $this->session->set_userdata($arr);
        $data['tourn'] = $this->tour_model->get_tour($param);
//        $data['users'] = $this->tour_model->get_friends();
        $data['command'] = $this->tour_model->get_command_tour_out($param);
//        echo "<pre>";
//        var_dump($data['command']);
        $this->load->view('header', $data);
        $this->load->view('heading', $data);
        $this->load->view('tour/tournament_out', $data);
        $this->load->view('footer', $data);
    }

    public function tournament_each($param) {
        $data['title'] = 'Everyplayer - Tournament';
        $data['month_array_en'] = $this->dataz['month_array_en'];
        $data['month_array_rus'] = $this->dataz['month_array_rus'];
        $this->load->model('home_model');
        $data['slider'] = $this->home_model->get_slider();
        $data['lang'] = $this->dataz['lang'];
        $this->load->model('tour_model');
        $data['tourn'] = $this->tour_model->get_tour($param);
        $arr = array('side' => $this->uri->segment(2));
        $this->session->set_userdata($arr);
        $data['comm'] = $this->tour_model->get_command_tour_each($param);
        $data['cou_command'] = $this->tour_model->get_command_tour_each_count($param);
        $data['coms'] = $this->tour_model->get_tour_comm($param);
        $this->load->view('header', $data);
        $this->load->view('heading', $data);
        $this->load->view('tour/tournament_each_to_each', $data);
        $this->load->view('footer', $data);
    }

    public function tournament_match($param) {
        $data['title'] = 'Everyplayer - Tournament';
        $data['month_array_en'] = $this->dataz['month_array_en'];
        $data['month_array_rus'] = $this->dataz['month_array_rus'];
        $this->load->model('home_model');
        $data['slider'] = $this->home_model->get_slider();
        $data['lang'] = $this->dataz['lang'];
        $this->load->model('tour_model');
        $data['tourn'] = $this->tour_model->get_tour($param);
        $arr = array('side' => $this->uri->segment(2));
        $this->session->set_userdata($arr);
        $data['comm'] = $this->tour_model->get_command_tour_match($param);
        $data['cou_command'] = $this->tour_model->get_command_tour_each_count($param);
        $data['coms'] = $this->tour_model->get_tour_comm($param);
        $this->load->view('header', $data);
        $this->load->view('heading', $data);
        $this->load->view('tour/tournament_match', $data);
        $this->load->view('footer', $data);
    }

    public function sel_match() {
        $data['lang'] = $this->dataz['lang'];
        $this->load->model('tour_model');
        $id_tour = $this->input->post('id_tour');
        $filtr = $this->input->post('filtr');
        $arr = array('side' => $this->uri->segment(2));
        $this->session->set_userdata($arr);
        $dat = $this->tour_model->get_command_tour_match_filtr($id_tour, $filtr);
        foreach ($dat as $res) {
            echo '<div class="col-md-9 col-sm-9 col-xs-12 ychasniki-right">
                            <div class="komandi_turnira">
                                <div class="komanda1">';

            $this->db->where('id_command', $res->first);
            $q = $this->db->get('command');
            $query = $q->result();

            echo '<p>' . $query[0]->name_command . '</p>
                                    <div class="avatar_komanda1" style="background-image:url(/images/tournament/' . $query[0]->logo_command . ')"></div>
                                </div>
                                <div class="protiv">vs</div>
                                <div class="komanda2">';

            $this->db->where('id_command', $res->second);
            $q = $this->db->get('command');
            $query = $q->result();

            echo '<p>' . $query[0]->name_command . '</p>
                                    <div class="avatar_komanda2" style="background-image:url(/images/tournament/' . $query[0]->logo_command . ')"></div>
                                </div>
                                <div class="data_game">';
            $data['month_array_en'] = $this->dataz['month_array_en'];
            $data['month_array_rus'] = $this->dataz['month_array_rus'];
            $arrrr = str_replace('T', ' ', $res->datas);

            $arrr = explode(" ", $arrrr);
            $arr = explode(":", $arrr[1]);
            $ar = explode("-", $arrr[0]);
            if ($data["lang"] == 'en') {
                $datas = $data['month_array_en'][$ar[1]];
            } else {

                $datas = $data['month_array_rus'][$ar[1]];
            }
            echo "<p>" . $ar[2] . ' ' . $datas . ' ' . $arr[0] . ':' . $arr[1] . "</p>
                </div>
                </div>
                </div>";
        }
    }

}
