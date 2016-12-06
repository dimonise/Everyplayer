<?php

defined('BASEPATH') OR exit('No direct script access allowed');

class Home extends CI_Controller {

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
        $data['title'] = 'Everyplayer';
        $this->load->model('home_model');
        $data['lang'] = $this->dataz['lang'];
        $arr = array('side' => $this->uri->segment(3));
        $this->session->set_userdata($arr);

        $data['month_array_en'] = $this->dataz['month_array_en'];
        $data['month_array_rus'] = $this->dataz['month_array_rus'];

        $data['slider'] = $this->home_model->get_slider();
        $data['news'] = $this->home_model->get_news();

        $this->load->view('header', $data);
        $this->load->view('heading', $data);
        $this->load->view('black', $data);
        $this->load->view('footer', $data);
    }

    public function count_comm() {
        $data['lang'] = $this->dataz['lang'];
        $id = $this->input->post('id');
        $this->load->model('news_model');
        $this->load->model('home_model');
        $dat['comm'] = $this->news_model->count_comm($id);
        $data['news'] = $this->home_model->get_data($id);
        $data['month_array_en'] = $this->dataz['month_array_en'];
        $data['month_array_rus'] = $this->dataz['month_array_rus'];
        
        
       
        $arrr = explode(" ", $data['news'][0]->datas_news);
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

    public function get_next_three() {
        $data['title'] = 'Everyplayer';
        $this->load->model('home_model');
        $data['get_next'] = $this->home_model->get_ten_next($this->input->post('startFrom'));
        echo $data['get_next'];
    }

//    public function light() {
//        $data['title'] = 'Everyplayer';
//        $this->load->model('home_model');
//        $data['lang'] = $this->dataz['lang'];
//        $arr = array('side' => 'light');
//
//        $this->session->set_userdata($arr);
//        $data['month_array_en'] = $this->dataz['month_array_en'];
//        $data['month_array_rus'] = $this->dataz['month_array_rus'];
//
//        $data['slider'] = $this->home_model->get_slider();
//        $data['news'] = $this->home_model->get_news();
//
//        $this->load->view('header', $data);
//        $this->load->view('heading', $data);
//        $this->load->view('light', $data);
//        $this->load->view('footer', $data);
//    }

    public function news_black() {
        $data['lang'] = $this->dataz['lang'];
        $this->load->model('home_model');
        $this->load->model('news_model');
        $data['month_array_en'] = $this->dataz['month_array_en'];
        $data['month_array_rus'] = $this->dataz['month_array_rus'];
        $id = $this->uri->segment(4);
        $data['slider'] = $this->home_model->get_slider();

        $data['news'] = $this->news_model->get_one_news($id);

        $data['title'] = 'Everyplayer-News Black';
        $data['komm'] = $this->news_model->get_komm($id);
        $data['count_like'] = $this->news_model->count_like($id);
        $data['count_comm'] = $this->news_model->count_comm($id);

        $this->load->view('header', $data);
        $this->load->view('heading', $data);
        $this->load->view('news_black', $data);
        $this->load->view('footer', $data);
    }

    public function new_komm() {

        $datas['lang'] = $this->dataz['lang'];
        $id_con = $this->input->post('id_con');
        $text = $this->input->post('text');
        $user = $this->input->post('user');
        $id_author = $this->session->userdata('id');
        $this->load->model('news_model');
        $komm = $this->news_model->komm($id_con, $user, $text, $id_author);

        redirect(base_url() . $datas['lang'] . '/black/news/' . $id_con, 'refresh');
    }

    public function komm_komm() {

        $datas['lang'] = $this->dataz['lang'];
        $id_con = $this->input->post('id_con');
        $id_prev_komm = $this->input->post('id_prev_komm');
        $text = $this->input->post('text');
        $user = $this->input->post('user');
        $id_author = $this->session->userdata('id');
        $this->load->model('news_model');
        $this->news_model->komm_komm($id_con, $id_prev_komm, $user, $text, $id_author);

        redirect(base_url() . $datas['lang'] . '/black/news/' . $id_con, 'refresh');
    }

    public function add_like() {
        $id_user = $this->input->post('id_user');
        $id_news = $this->input->post('id_news');
        $this->load->model('news_model');
        $data = $this->news_model->add_like($id_news, $id_user);
        if ($data == false) {
            echo 'false';
        } else {
            echo $data;
        }
    }

    public function registration() {
        $data['lang'] = $this->dataz['lang'];
        $data['title'] = 'Everyplayer-Registration';

        $data['month_array_en'] = $this->dataz['month_array_en'];
        $data['month_array_rus'] = $this->dataz['month_array_rus'];
        $arr = array('side' => $this->uri->segment(2));
        $this->session->set_userdata($arr);
        $this->load->library('Ulogin');
        $this->load->library('Uauth');

        $data['user'] = $this->ulogin->get_html();
        $data['outp'] = $this->uauth->userdata();
        $this->load->model('players_model');
        $data['favor_all'] = $this->players_model->get_favor_games();
        
        $this->load->view('header', $data);
        $this->load->view('heading', $data);
        $this->load->view('registration', $data);
        $this->load->view('footer', $data);
    }

    public function login() {
        $data['lang'] = $this->dataz['lang'];
        $data['title'] = 'Everyplayer-Login';
        $arr = array('side' => $this->uri->segment(2));
        $this->load->library('Ulogin');
        $this->load->library('Uauth');
        $data['user'] = $this->ulogin->get_html();
        $data['outp'] = $this->uauth->userdata();
        $this->session->set_userdata($arr);
        $this->load->view('header', $data);
        $this->load->view('heading', $data);
        $this->load->view('login', $data);
        $this->load->view('footer', $data);
    }

    public function ban_user() {
        $user_id = $this->input->post('id_user');
        $dat = array('user_id' => $user_id);
        $data = array('id_author' => $user_id);
        $id_con = $this->input->post('id_con');
        $this->db->insert('user_ban', $dat);
        $this->db->delete('komm_news', $data);
        $this->db->delete('komm_komm_news', $data);
    }

    public function del_kom() {
        $kom_id = $this->input->post('id_komm');
        $this->db->delete('komm_news', array('id_komm'=>$kom_id));
        $id_con = $this->input->post('id_con');
        
    }

    public function del_komm() {
        $kom_id = $this->input->post('id_komm');
        $this->db->delete('komm_komm_news', array('id_komm_komm'=>$kom_id));
        $id_con = $this->input->post('id_con');
        
    }

}
