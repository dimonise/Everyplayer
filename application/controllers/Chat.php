<?php

defined('BASEPATH') OR exit('No direct script access allowed');

class Chat extends CI_Controller {

    function __construct() {
        parent::__construct();
        $this->load->model('lang_model');
        $this->dataz['lang'] = $this->lang_model->index();
        if(!$this->session->userdata('id')){
            redirect(base_url() . $this->dataz['lang'] . '/black/login/' , 'refresh');
        }
    }

    public function index($id = null) {
        $data['title'] = 'Everyplayer - Chat';
        $this->load->model('home_model');
        $this->load->model('chat_model');
        $data['lang'] = $this->dataz['lang'];
        $this->chat_model->update_chat();
        if($id!==null){
            $this->chat_model->add_private_user($id);
        }
        $data['chatUser'] = $this->chat_model->get_all_user();
        $data['chatGroup'] = $this->chat_model->get_all_group();
        $data['chatClan'] = $this->chat_model->get_all_clans();
//        $data['chatMess'] = $this->chat_model->get_message();
        $data['slider'] = $this->home_model->get_slider();

        $this->load->view('header', $data);
        $this->load->view('heading', $data);
        $this->load->view('chat/index', $data);
        $this->load->view('footer', $data);
    }

    public function  ajax_get_message()
    {
        $id = $this->input->post('room_id');
        $idLast = $this->input->post('last_id');
        $this->load->model('chat_model');
        echo json_encode($this->chat_model->get_message($id, $idLast));
    }

    public function ajax_add_group()
    {
        $name = $this->input->post('name');
        $this->load->model('chat_model');
        $id = $this->chat_model->add_group($name);
        if($id===false){
            echo json_encode(['room_id'=>0, 'name'=>$name]);
        }
        echo json_encode(['room_id'=>$id, 'name'=>$name]);

    }

    public function ajax_add_user_group()
    {
        $idUser = $this->input->post('user_id');
        $idGroup = $this->input->post('room_id');
        $this->load->model('chat_model');

        echo json_encode($this->chat_model->add_user_to_group($idUser, $idGroup));

    }

    public function ajax_send_message()
    {
        $mess = $this->input->post('mess');
        $idChat = $this->input->post('id_chat');
        $this->load->model('chat_model');
        echo json_encode( $this->chat_model->add_message( $mess, $idChat));

    }

    public function ajax_remove_message()
    {
        $idChat = $this->input->post('mess_id');
        $this->load->model('chat_model');
        echo json_encode( $this->chat_model->remove_message( $idChat));

    }

    public function ajax_remove_group()
    {
        $idChat = $this->input->post('room_id');
        $this->load->model('chat_model');
        echo json_encode( $this->chat_model->remove_group( $idChat));

    }

    public function ajax_remove_user_group()
    {
        $idUser = $this->input->post('user_id');
        $idGroup = $this->input->post('room_id');
        $this->load->model('chat_model');

        echo json_encode($this->chat_model->remove_user_to_group($idUser, $idGroup));

    }

    public function ajax_get_user_group()
    {
        $idChat = $this->input->post('room_id');
        $this->load->model('chat_model');
        echo json_encode( $this->chat_model->get_user_group( $idChat));

    }


}
