<?php

defined('BASEPATH') OR exit('No direct script access allowed');

class Main extends CI_Controller {

    public function index() {
        $this->load->model('lang_model');
        $data['lang'] = $this->lang_model->index();
        
        $data['title'] = 'Everyplayer';

        $this->load->view('header', $data);
        $this->load->view('index', $data);
       
    }
    public function faq() {
        $this->load->model('lang_model');
        $data['lang'] = $this->lang_model->index();
        $arr = array('side' => $this->uri->segment(2));
        $this->session->set_userdata($arr);
        $this->load->model('home_model');
        $data['slider'] = $this->home_model->get_slider();
        $data['title'] = 'Everyplayer F.A.Q';
        $this->load->model('main_model');
        $data['faq'] = $this->main_model->faq();
        $this->load->view('header', $data);
        $this->load->view('heading', $data);
        $this->load->view('faq', $data);
        $this->load->view('footer', $data);
    }
    public function about() {
        $this->load->model('lang_model');
        $data['lang'] = $this->lang_model->index();
        $arr = array('side' => $this->uri->segment(2));
        $this->session->set_userdata($arr);
        $this->load->model('home_model');
        $data['slider'] = $this->home_model->get_slider();
        $data['title'] = 'Everyplayer About Us';
        $this->load->model('main_model');
        $data['faq'] = $this->main_model->about();
        $this->load->view('header', $data);
        $this->load->view('heading', $data);
        $this->load->view('about', $data);
        $this->load->view('footer', $data);
    }
    public function rules() {
        $this->load->model('lang_model');
        $data['lang'] = $this->lang_model->index();
        $arr = array('side' => $this->uri->segment(2));
        $this->session->set_userdata($arr);
        $this->load->model('home_model');
        $data['slider'] = $this->home_model->get_slider();
        $data['title'] = 'Everyplayer Rules';
        $this->load->model('main_model');
        $data['faq'] = $this->main_model->rules();
        $this->load->view('header', $data);
        $this->load->view('heading', $data);
        $this->load->view('rules', $data);
        $this->load->view('footer', $data);
    }
}
