<?php

defined('BASEPATH') OR exit('No direct script access allowed');

class Tour_model extends CI_Model {

    function get_tour($id) {
        $this->db->where('tour_id', $id);
        $query = $this->db->get('tournament');
        return $query->result();
    }
    function get_friends() {
        $this->db->select('*');
        $this->db->from('friends');
        $this->db->join('users', 'users.user_id = friends.friend_id', 'left');
        $this->db->where('friends.user_id', $this->session->userdata('id'));
        $this->db->where('friends.friend_status', 1);
        $query = $this->db->get();
        return $query->result();
    }
    function get_command($param) {
        $this->db->where('id_tour', $param);
        $query = $this->db->get('command');
        return $query->result();
    }
    function get_tours($tour_id=null) {
        if($tour_id!=null){
            $this->db->where('tour_id',$tour_id);
        }
        $this->db->order_by('date_finish_all', 'desc');
        $this->db->limit(3);
        $query = $this->db->get('tournament');
        return $query->result();
    }
    function get_data($param) {
        $this->db->where('tour_id',$param);
        $query = $this->db->get('tournament');
        return $query->result();
    }
    function get_ten_next($startFrom) {
        
        $this->db->order_by('date_finish_all', 'desc');
        $this->db->limit(3,$startFrom);
        $query = $this->db->get('tournament');
        //print_r($this->db->queries);
        $articles = array();
        foreach ($query->result() as $row) {
            $articles[] = $row;
        }
        return json_encode($articles);
    }
    function get_tour_name() {
        $this->db->select('tour_id, name_tour');
        $this->db->from('tournament');
         $query = $this->db->get();
        return $query->result();
    }
    function get_tours_game($tour_id) {
        $this->db->where('cat_tour',$tour_id);
        $this->db->order_by('date_finish_all', 'desc');
        $this->db->limit(3);
        $query = $this->db->get('tournament');
        
        return $query->result();
    }
    function get_command_tour_out($param) {
        $this->db->where('id_tour',$param);
        $query = $this->db->get('tour_out');
        return $query->result(); 
    }
    function get_command_tour_each($param) {
        $this->db->select('*');
        $this->db->from('command');
        $this->db->join('tour_each', 'tour_each.first = command.id_command', 'left');
        $this->db->where('tour_each.id_tour',$param);
        $this->db->group_by('first');
        $query = $this->db->get();
        return $query->result(); 
    }
    function get_tour_comm($param){
        $this->db->where('id_tour',$param);
        
        $query = $this->db->get('command');
        return $query->result(); 
    }
    function get_command_tour_each_count($param) {
        
        $this->db->where('id_tour',$param);
        
        $query = $this->db->get('command');
        return count($query->result()); 
    }
     function get_command_tour_match($param) {
       
       $this->db->where('id_tour',$param);
       $this->db->order_by('datas', 'desc');
       $query = $this->db->get('tour_each');
        return $query->result(); 
    }
    function get_command_tour_match_filtr($id_tour, $filtr) {
       
       $this->db->where('id_tour',$id_tour);
       if($filtr == 2){
           $this->db->where('result !=', 0);
       }
       else{
           $this->db->where('result', 0);
       }
       $this->db->order_by('datas', 'desc');
       $query = $this->db->get('tour_each');
        return $query->result(); 
    }
}
