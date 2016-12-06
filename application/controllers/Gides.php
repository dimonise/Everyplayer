<?php

defined('BASEPATH') OR exit('No direct script access allowed');

class Gides extends CI_Controller {

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

    public function black() {
        $data['title'] = 'Everyplayer - Gides';
        $this->load->model('home_model');
        $this->load->model('players_model');
        $this->load->model('gides_model');
        $data['lang'] = $this->dataz['lang'];
        $arr = array('side' => $this->uri->segment(2));
        $this->session->set_userdata($arr);

        $data['month_array_en'] = $this->dataz['month_array_en'];
        $data['month_array_rus'] = $this->dataz['month_array_rus'];

        $data['slider'] = $this->home_model->get_slider();
        $data['gides'] = $this->gides_model->get_gides();

        $data['favor_all'] = $this->players_model->get_favor_games();
        $data['favor'] = $this->players_model->get_favor_games(1);
        $this->load->view('header', $data);
        $this->load->view('heading', $data);
        $this->load->view('gides_black', $data);
        $this->load->view('footer', $data);
    }

    public function get_next_three() {
        $data['title'] = 'Everyplayer';
        $this->load->model('gides_model');
        $data['get_next'] = $this->gides_model->get_ten_next($this->input->post('startFrom'));
        echo $data['get_next'];
    }

    public function get_next_search() {
        $param = $this->uri->segment(3);
        $data['title'] = 'Everyplayer';
        $this->load->model('gides_model');
        $data['get_next'] = $this->gides_model->get_ten_search($this->input->post('startFrom'), $param);
        echo $data['get_next'];
    }

    public function new_komm() {

        $datas['lang'] = $this->dataz['lang'];
        $id_con = $this->input->post('id_con');
        $text = $this->input->post('text');
        $user = $this->input->post('user');
        $id_author = $this->session->userdata('id');
        $this->load->model('gides_model');
        $komm = $this->gides_model->komm($id_con, $user, $text, $id_author);

        redirect(base_url() . $datas['lang'] . '/black/gide_one/' . $id_con, 'refresh');
    }

    public function komm_komm() {

        $datas['lang'] = $this->dataz['lang'];
        $id_con = $this->input->post('id_con');
        $id_prev_komm = $this->input->post('id_prev_komm');
        $text = $this->input->post('text');
        $user = $this->input->post('user');
        $id_author = $this->session->userdata('id');
        $this->load->model('gides_model');
        $this->gides_model->komm_komm($id_con, $id_prev_komm, $user, $text, $id_author);

        redirect(base_url() . $datas['lang'] . '/black/gide_one/' . $id_con, 'refresh');
    }

    public function add_like() {
        $id_user = $this->input->post('id_user');
        $id_news = $this->input->post('id_news');
        $this->load->model('gides_model');
        $data = $this->gides_model->add_like($id_news, $id_user);
        if ($data == false) {
            echo 'false';
        } else {
            echo $data;
        }
    }

    public function count_comm() {
        $data['lang'] = $this->dataz['lang'];
        $this->load->model('home_model');
        $id = $this->input->post('id');
        $this->load->model('gides_model');
        $dat['comm'] = $this->gides_model->count_comm($id);
        
        $data['news'] = $this->gides_model->get_data($id);
        $data['month_array_en'] = $this->dataz['month_array_en'];
        $data['month_array_rus'] = $this->dataz['month_array_rus'];

        $this->db->where('games_id', $data['news'][0]->cat_gides);
        $gets = $this->db->get('favorite_games');
        $dat['im'] = $gets->result();
       
        $arrr = explode(" ", $data['news'][0]->datas_gides);

        $arr = explode(":", $arrr[1]);
        $ar = explode("-", $arrr[0]);
        $dat['day'] = $ar[2];

        if ($data['lang'] == 'en') {
            $dat['mon'] = $data['month_array_en'][$ar[1]];
        } else {

            $dat['mon'] = $data['month_array_rus'][$ar[1]];
        }
        $dat['year'] = $ar[0];
        $dat['tim'] = $arrr[1];
        
        echo json_encode($dat);
    }

    public function search_games_gides($param = null) {

        $data['title'] = 'Everyplayer - Search Gides';
        $this->load->model('home_model');
        $this->load->model('gides_model');
        $this->load->model('players_model');
        $data['lang'] = $this->dataz['lang'];
        $data['month_array_en'] = $this->dataz['month_array_en'];
        $data['month_array_rus'] = $this->dataz['month_array_rus'];
        $data['slider'] = $this->home_model->get_slider();

        $data['gides'] = $this->gides_model->get_gides_search($param);

        $data['favor_all'] = $this->players_model->get_favor_games();
        $data['favor'] = $this->players_model->get_favor_games(1);

        $this->load->view('header', $data);
        $this->load->view('heading', $data);
        $this->load->view('gides_black', $data);
        $this->load->view('footer', $data);
    }

    public function one() {
        $data['lang'] = $this->dataz['lang'];
        $this->load->model('home_model');
        $this->load->model('gides_model');
        $data['month_array_en'] = $this->dataz['month_array_en'];
        $data['month_array_rus'] = $this->dataz['month_array_rus'];
        $id = $this->uri->segment(4);
        $data['slider'] = $this->home_model->get_slider();
        $arr = array('side' => $this->uri->segment(2));
        $this->session->set_userdata($arr);
        $data['gide'] = $this->gides_model->get_one_gides($id);

        $data['title'] = 'Everyplayer-Gide for ' . $this->uri->segment(5);
        $data['komm'] = $this->gides_model->get_komm($id);
        $data['count_like'] = $this->gides_model->count_like($id);
        $data['count_comm'] = $this->gides_model->count_comm($id);

        $this->load->view('header', $data);
        $this->load->view('heading', $data);
        $this->load->view('gide', $data);
        $this->load->view('footer', $data);
    }

    public function ban_user() {
        $user_id = $this->input->post('id_user');
        $dat = array('user_id' => $user_id);
        $data = array('id_author' => $user_id);
        $id_con = $this->input->post('id_con');
        $this->db->insert('user_ban', $dat);
        $this->db->delete('komm_gides', $data);
        $this->db->delete('komm_komm_gides', $data);
    }

    public function del_kom() {
        $kom_id = $this->input->post('id_komm');
        $this->db->delete('komm_gides', array('id_komm' => $kom_id));
        $id_con = $this->input->post('id_con');
    }

    public function del_komm() {
        $kom_id = $this->input->post('id_komm');
        $this->db->delete('komm_komm_gides', array('id_komm_komm' => $kom_id));
        $id_con = $this->input->post('id_con');
    }

}
