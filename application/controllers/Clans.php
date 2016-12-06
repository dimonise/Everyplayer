<?php

defined('BASEPATH') OR exit('No direct script access allowed');

class Clans extends CI_Controller {

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
		$arr = array('side' => $this->uri->segment(2));
        $this->session->set_userdata($arr);
    }

    public function info($param) {
        $data['title'] = 'Everyplayer - Clan';
		$arr = array('side' => $this->uri->segment(2));
        $this->session->set_userdata($arr);
        $this->load->model('home_model');
        $data['slider'] = $this->home_model->get_slider();
        $data['lang'] = $this->dataz['lang'];
        $this->load->model('clans_model');
        $data['info'] = $this->clans_model->get_info($param);
        $data['games'] = $this->clans_model->get_games();
        $data['users'] = $this->clans_model->get_users($param);
        $this->load->view('header', $data);
        $this->load->view('heading', $data);
        $this->load->view('clans/info', $data);
        $this->load->view('footer', $data);
    }

    public function recrute() {
        $data['title'] = 'Everyplayer - Clan Recruting';
		$arr = array('side' => $this->uri->segment(2));
        $this->session->set_userdata($arr);
        $this->load->model('home_model');
        $data['slider'] = $this->home_model->get_slider();
        $data['lang'] = $this->dataz['lang'];
        $this->load->model('clans_model');
        $data['info'] = $this->clans_model->get_info($this->uri->segment(4));
        //////////////// pagination issue users //////////////////////////////
        $this->load->library('pagination');
        if (!$this->uri->segment(5)) {
            $start = 0;
        } else {
            $start = $this->uri->segment(5);
        }
        $config['base_url'] = base_url() . $data['lang'] . "/" . $this->session->userdata('side') . "/recrute/" . $this->uri->segment(4);
        $config['total_rows'] = $this->clans_model->count_for_pag($this->uri->segment(4));
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
        $data['recrut'] = $this->clans_model->get_recrut($config['per_page'], $start, $this->uri->segment(4));
        ///////////////////////////////////////////////////
        //////////////// pagination for recrute //////////////////////////////
        $this->load->library('pagination');
        if (!$this->uri->segment(5)) {
            $start = 0;
        } else {
            $start = $this->uri->segment(5);
        }
        $config['base_url'] = base_url() . $data['lang'] . "/" . $this->session->userdata('side') . "/recrute/" . $this->uri->segment(4);
        $config['total_rows'] = $this->clans_model->count_for_pag($this->uri->segment(4));
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
        $data['users'] = $this->clans_model->get_users_clan($config['per_page'], $start, $this->uri->segment(4));
        ///////////////////////////////////////////////////
        $this->load->view('header', $data);
        $this->load->view('heading', $data);
        $this->load->view('clans/recrut', $data);
        $this->load->view('footer', $data);
    }

    public function add_recrute() {
        $id_user = $this->input->post('id_user');
        $id_clan = $this->input->post('id_clan');
        $add = array('active_clan' => 1);
        $this->db->where('id_clan', $id_clan);
        $this->db->where('id_user', $id_user);
        $this->db->update('members_clan', $add);
        $add_role = array('id_clans' => $id_clan, 'id_user' => $id_user, 'id_roles' => 4);
        $this->db->insert('clan_roles', $add_role);
    }

    public function add_role() {
        $id_user = $this->input->post('id_user');
        $id_clan = $this->input->post('id_clan');
        $id_role = $this->input->post('id_role');
        $add = array('id_roles' => $id_role);
        $this->db->where('id_clans', $id_clan);
        $this->db->where('id_user', $id_user);
        $this->db->update('clan_roles', $add);
    }

    public function delet_from_clan() {
        $id_user = $this->input->post('id_user');
        $id_clan = $this->input->post('id_clan');
        $this->db->where('id_clan', $id_clan);
        $this->db->where('id_user', $id_user);
        $this->db->delete('members_clan');
        $this->db->where('id_clans', $id_clan);
        $this->db->where('id_user', $id_user);
        $this->db->delete('clan_roles');
    }

    public function whant_clan() {
        $user_id = $this->input->post('id_user');
        $clan_id = $this->input->post('id_clan');
        $add = array('id_clan' => $clan_id, 'id_user' => $user_id);
        $this->db->insert('members_clan', $add);
    }

    public function members_clan() {
        $data['title'] = 'Everyplayer - Clan Members';
		$arr = array('side' => $this->uri->segment(2));
        $this->session->set_userdata($arr);
        $this->load->model('home_model');
        $data['slider'] = $this->home_model->get_slider();
        $data['lang'] = $this->dataz['lang'];
        $this->load->model('clans_model');
        $data['info'] = $this->clans_model->get_info($this->uri->segment(4));
        ////////////////pagination//////////////////////////////
        $this->load->library('pagination');
        if (!$this->uri->segment(5)) {
            $start = 0;
        } else {
            $start = $this->uri->segment(5);
        }
        $config['base_url'] = base_url() . $data['lang'] . "/" . $this->session->userdata('side') . "/members/" . $this->uri->segment(4);
        $config['total_rows'] = $this->clans_model->count_for_pag($this->uri->segment(4));
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
        $data['users'] = $this->clans_model->get_users_clan($config['per_page'], $start, $this->uri->segment(4));
        ///////////////////////////////////////////////////
        //$data['users'] = $this->clans_model->get_users_clan($param);
        $this->load->view('header', $data);
        $this->load->view('heading', $data);
        $this->load->view('clans/members_clan', $data);
        $this->load->view('footer', $data);
    }

    public function get_info() {
        $id_clan = $this->input->post('id_clan');
        $this->load->model('clans_model');
        $data = $this->clans_model->get_info($id_clan);
        $result['name_clan'] = $data[0]->name_clan;
        $result['descr_clan'] = $data[0]->descr_clan;
//        $ar = explode(' ', $data[0]->games_clan);
//        $games = '';
//        for ($i = 0; $i < count($ar); $i++) {
//            $this->db->where('games_id', $ar[$i]);
//            $query = $this->db->get('favorite_games');
//            $res = $query->result();
//            $games .='<li class="select2-selection__choice" title=' . $res[0]->games_name . '><span class="select2-selection__choice__remove" role="presentation">×</span>' . $res[0]->games_name . '</li>';
//        }
//        $result['clans_game'] = $games;
        echo json_encode($result);
    }

    public function get_games() {
        $data = $this->clans_model->get_games();
        foreach ($data as $a) {
            echo $a->games_name;
        }
    }

    public function update_clan_info($param) {
        $datas['lang'] = $this->dataz['lang'];
        $name_clan = $this->input->post('name_clan');
        $descr_clan = $this->input->post('descr_clan');
        $games_clan = $this->input->post('games_clan');
        $games = "";
        for ($i = 0; $i < count($games_clan); $i++) {
            $games .= $games_clan[$i] . " ";
        }
        $games = trim($games);
        $dat = array("name_clan" => $name_clan, "descr_clan" => $descr_clan, "games_clan" => $games);
        $this->db->where('clan_id', $param);
        $this->db->update('clans', $dat);
        redirect(base_url() . $datas['lang'] . '/' . $this->session->userdata('side') . '/clan/' . $param, 'refresh');
    }

    public function update_avatar($param) {
        $datas['lang'] = $this->dataz['lang'];
        $config['upload_path'] = './images/clans/';
        $config['allowed_types'] = 'png|jpg';
        $this->load->library('upload');
        $this->upload->initialize($config);
        if (!$this->upload->do_upload()) {
            $error = array('error' => $this->upload->display_errors());
            var_dump($error);
        } else {
            $data = array('upload_data' => $this->upload->data());
            $path = $data['upload_data']['file_name'];
            $dat = array("logo_clan" => $path);
            $this->db->where('clan_id', $param);
            $this->db->update('clans', $dat);
            redirect(base_url() . $datas['lang'] . '/' . $this->session->userdata('side') . '/clan/' . $param, 'refresh');
        }
    }

    public function glova($param) {
        $datas['lang'] = $this->dataz['lang'];
        $creator = $this->session->userdata('id');
        $new_creator = $this->input->post('usery');
        $new = array('id_roles' => 1);
        $this->db->where('id_clans', $param);
        $this->db->where('id_user', $new_creator);
        $this->db->update('clan_roles', $new);
        $old = array('id_roles' => 2);
        $this->db->where('id_clans', $param);
        $this->db->where('id_user', $creator);
        $this->db->update('clan_roles', $old);
        redirect(base_url() . $datas['lang'] . '/' . $this->session->userdata('side') . '/clan/' . $param, 'refresh');
    }

    public function news($param = null) {
        $data['title'] = 'Everyplayer - News';
		$arr = array('side' => $this->uri->segment(2));
        $this->session->set_userdata($arr);
        $this->load->model('home_model');
        $data['slider'] = $this->home_model->get_slider();
        $data['lang'] = $this->dataz['lang'];
        $data['month_array_en'] = $this->dataz['month_array_en'];
        $data['month_array_rus'] = $this->dataz['month_array_rus'];
        $this->load->model('clans_model');
        $data['info'] = $this->clans_model->get_info($this->uri->segment(4));
        $data['news'] = $this->clans_model->get_news($param);
        $this->load->view('header', $data);
        $this->load->view('heading', $data);
        $this->load->view('clans/news', $data);
        $this->load->view('footer', $data);
    }

    public function get_next_three() {
        $param = $this->input->post('clan_id');
        $data['title'] = 'Everyplayer';
        $this->load->model('clans_model');
        $data['get_next'] = $this->clans_model->get_ten_next($this->input->post('startFrom'), $param);
        echo $data['get_next'];
    }

    public function count_comm() {
        $id = $this->input->post('id');
        $this->load->model('clans_model');
        echo $this->clans_model->count_comm($id);
    }

    public function new_komm() {
        $datas['lang'] = $this->dataz['lang'];
        $id_con = $this->input->post('id_con');
        $id_cla = $this->input->post('id_cla');
        $text = $this->input->post('text');
        $user = $this->input->post('user');
        $id_author = $this->session->userdata('id');
        $this->load->model('clans_model');
        $komm = $this->clans_model->komm($id_con, $user, $text, $id_author);
        redirect(base_url() . $datas['lang'] . '/black/news_clan/'.$id_cla.'/'. $id_con, 'refresh');
    }

    public function komm_komm() {
        $datas['lang'] = $this->dataz['lang'];
        $id_con = $this->input->post('id_con');
        $id_prev_komm = $this->input->post('id_prev_komm');
        $text = $this->input->post('text');
        $user = $this->input->post('user');
        $id_author = $this->session->userdata('id');
        $this->load->model('clans_model');
        $this->clans_model->komm_komm($id_con, $id_prev_komm, $user, $text, $id_author);
        redirect(base_url() . $datas['lang'] . '/black/news_clan/' . $id_con, 'refresh');
    }

    public function add_like() {
        $id_user = $this->input->post('id_user');
        $id_news = $this->input->post('id_news');
        $this->load->model('clans_model');
        $data = $this->clans_model->add_like($id_news, $id_user);
        if ($data == false) {
            echo 'false';
        } else {
            echo $data;
        }
    }

    public function news_one_black($param) {
        $data['title'] = 'Everyplayer-News Clan';
		$arr = array('side' => $this->uri->segment(2));
        $this->session->set_userdata($arr);
        $data['lang'] = $this->dataz['lang'];
        $this->load->model('home_model');
        $this->load->model('clans_model');
        $data['month_array_en'] = $this->dataz['month_array_en'];
        $data['month_array_rus'] = $this->dataz['month_array_rus'];
        $id = $this->uri->segment(5);
        $data['slider'] = $this->home_model->get_slider();
        $data['news'] = $this->clans_model->get_one_news($id);
        $data['info'] = $this->clans_model->get_info($this->uri->segment(4));
        $data['komm'] = $this->clans_model->get_komm($id);
        $data['count_like'] = $this->clans_model->count_like($id);
        $data['count_comm'] = $this->clans_model->count_comm($id);
        $this->load->view('header', $data);
        $this->load->view('heading', $data);
        $this->load->view('clans/news_one', $data);
        $this->load->view('footer', $data);
    }

  

    public function search() {
        $data['title'] = 'Everyplayer-Search Clan';
		$arr = array('side' => $this->uri->segment(2));
        $this->session->set_userdata($arr);
        $data['lang'] = $this->dataz['lang'];
        $this->load->model('home_model');
        $this->load->model('clans_model');
        $data['slider'] = $this->home_model->get_slider();
        ////////////////pagination//////////////////////////////
        $this->load->library('pagination');
       
        $config['base_url'] = base_url() . $data['lang'] . "/" . $this->session->userdata('side') . "/search_clan";
        $config['total_rows'] = $this->clans_model->count_for_pag_search_clan();
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
        $data['clan'] = $this->clans_model->get_clans($config['per_page'], $this->uri->segment(4));
        ///////////////////////////////////////////////////
        //$data['clan'] = $this->clans_model->get_clans();
        $this->load->view('header', $data);
        $this->load->view('heading', $data);
        $this->load->view('clans/search', $data);
        $this->load->view('footer', $data);
    }

    public function filtr() {
        $data['title'] = 'Everyplayer-Search Clans';
		$arr = array('side' => $this->uri->segment(2));
        $this->session->set_userdata($arr);
        $data['lang'] = $this->dataz['lang'];
        $this->load->model('home_model');
        $this->load->model('clans_model');
        $data['slider'] = $this->home_model->get_slider();
        $search_name = $this->input->post('frameworks');
        $search_data = $this->input->post('search_data');
        $search_game = $this->input->post('search_game');
        ////////////////pagination//////////////////////////////
        $this->load->library('pagination');
       
        $config['base_url'] = base_url() . $data['lang'] . "/" . $this->session->userdata('side') . "/clans/filtr";
        $config['total_rows'] = $this->clans_model->count_for_pag_search_clan($search_name,$search_data,$search_game);
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
        if($search_data == 3){
            $data['mem'] = $this->clans_model->get_filter_clans($config['per_page'], $this->uri->segment(4),$search_name,$search_data,$search_game);
           // var_dump($data['mem']);
        }
        else {
            $data['clan'] = $this->clans_model->get_filter_clans($config['per_page'], $this->uri->segment(4), $search_name, $search_data, $search_game);
        }
            ///////////////////////////////////////////////////
       // $data['clan'] = $this->clans_model->get_filter_clans($search_name,$search_data,$search_game);
        $this->load->view('header', $data);
        $this->load->view('heading', $data);
        $this->load->view('clans/search', $data);
        $this->load->view('footer', $data);
    }
    public function my_clans() {
         $data['title'] = 'Everyplayer-My Clans';
		 $arr = array('side' => $this->uri->segment(2));
        $this->session->set_userdata($arr);
        $data['lang'] = $this->dataz['lang'];
        $this->load->model('home_model');
        $this->load->model('clans_model');
        $data['slider'] = $this->home_model->get_slider();
        $search_name = $this->input->post('frameworks');
        $search_data = $this->input->post('search_data');
        $search_game = $this->input->post('search_game');
        ////////////////pagination//////////////////////////////
        $this->load->library('pagination');
       
        $config['base_url'] = base_url() . $data['lang'] . "/" . $this->session->userdata('side') . "/clans/my_clans";
        $config['total_rows'] = $this->clans_model->count_for_pag_search_my_clan($this->session->userdata('id'));
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
        
        $data['clan'] = $this->clans_model->get_my_clans($config['per_page'], $this->uri->segment(4),$this->session->userdata('id'));
        ///////////////////////////////////////////////////
       // $data['clan'] = $this->clans_model->get_filter_clans($search_name,$search_data,$search_game);
        $this->load->view('header', $data);
        $this->load->view('heading', $data);
        $this->load->view('clans/my_clans', $data);
        $this->load->view('footer', $data);
    }
    public function creat_news($param) {
		$arr = array('side' => $this->uri->segment(2));
        $this->session->set_userdata($arr);
        $data['title'] = 'Everyplayer - Clan Creat News';
        $this->load->model('home_model');
        $data['slider'] = $this->home_model->get_slider();
        $data['lang'] = $this->dataz['lang'];
        $this->load->model('clans_model');
        $data['info'] = $this->clans_model->get_info($param);
        
        $this->load->view('header', $data);
        $this->load->view('heading', $data);
        $this->load->view('clans/creat_news', $data);
        $this->load->view('footer', $data);
    }
    public function img_news() {
        $config['upload_path'] = './images/news/';
        $config['allowed_types'] = 'png|jpg';
        $this->load->library('upload');
        $this->upload->initialize($config);

        if (!$this->upload->do_upload()) {
            $error = array('error' => $this->upload->display_errors());
            echo $error['error'];
        } else {
            $data = array('upload_data' => $this->upload->data());
            $path = array("path"=>$data['upload_data']['file_name']);
        }
        echo json_encode( $path );
    }
    public function new_news($param) {
        $datas['lang'] = $this->dataz['lang'];
        $name_rus = $this->input->post('name_news');
        $name_en = $this->input->post('name_news_en');
        $opisanie_news = $this->input->post('opisanie_news');
        $opisanie_news_en = $this->input->post('opisanie_news_en');
        $path = $this->input->post('path');
        $ar = explode('\\',$path);
        $path = $ar[2];
        $this->db->where('user_id', $this->session->userdata('id'));
        $get = $this->db->get('users');
        $user = $get->result();
        $data = array('clan_id'=>$param, 'author_news'=>$user[0]->username, 'title_news'=>$name_rus, 'title_en'=>$name_en, 'text_news'=>$opisanie_news, 'text_en'=>$opisanie_news_en, 'img_news'=>$path);
        $this->db->insert('news_clan', $data);
        redirect(base_url() . $datas['lang'] . '/' . $this->session->userdata('side') . '/clan_news/' . $param, 'refresh');
        
    }
}
