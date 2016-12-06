<?php

defined('BASEPATH') OR exit('No direct script access allowed');

class Home_model extends CI_Model {

    function get_news() {
        $this->db->order_by('datas_news', 'desc');
        $this->db->limit(3);
        $query = $this->db->get('news');
        return $query->result();
    }

    function get_slider() {
        $query = $this->db->get('slider');
        return $query->result();
    }

    function get_ten_next($startFrom) {
        $this->db->order_by('datas_news', 'desc');
        $this->db->limit(3,$startFrom);
        $query = $this->db->get('news');
        $articles = array();
        foreach ($query->result() as $row) {
            $articles[] = $row;
        }
        return json_encode($articles);
    }
    function get_data($param) {
        $this->db->where('news_id',$param);
        $query = $this->db->get('news');
        return $query->result();
    }
}
