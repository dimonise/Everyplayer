<?php

defined('BASEPATH') OR exit('No direct script access allowed');

class Main_model extends CI_Model {
    function faq(){
        $query = $this->db->get('faq');
        return $query->result();
    }
    function about(){
        $query = $this->db->get('about');
        return $query->result();
    }
    function rules(){
        $query = $this->db->get('rules');
        return $query->result();
    }
}