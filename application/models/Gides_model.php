<?php

defined('BASEPATH') OR exit('No direct script access allowed');

class Gides_model extends CI_Model {

    function get_gides() {
        $this->db->order_by('datas_gides', 'desc');
        $this->db->limit(3);
        $query = $this->db->get('gides');
        return $query->result();
    }

     function get_one_gides($id) {
        $this->db->where('gides_id', $id);
        $query = $this->db->get('gides');
        return $query->result();
    }
    
    function get_ten_next($startFrom) {

// Получаем 3 статьи, начиная с последней отображенной
        $this->db->order_by('datas_gides', 'desc');
        $this->db->limit(3, $startFrom);
        $query = $this->db->get('gides');
        $articles = array();
        foreach ($query->result() as $row) {
            $articles[] = $row;
        }

// Превращаем массив статей в json-строку для передачи через Ajax-запрос
        return json_encode($articles);
    }
 function get_ten_search($startFrom,$param) {

// Получаем 10 статей, начиная с последней отображенной
     $this->db->where('cat_gides', $param);
        $this->db->order_by('datas_gides', 'desc');
        $this->db->limit(3, $startFrom);
        $query = $this->db->get('gides');
//$res = mysqli_query($db, "SELECT * FROM `articles` ORDER BY `article_id` DESC LIMIT {$startFrom}, 10");
// Формируем массив со статьями
        $articles = array();
        foreach ($query->result() as $row) {
            $articles[] = $row;
        }

// Превращаем массив статей в json-строку для передачи через Ajax-запрос
        return json_encode($articles);
    }
    function komm($id_con, $user, $text, $id_author) {

        $datas = date('d.m.Y h:i', time());

        $data = array(
            'id_trek' => $id_con,
            'author' => $user,
            'id_author' => $id_author,
            'text' => $text,
            'datas' => $datas,
        );

        $this->db->insert('komm_gides', $data);
    }

    function get_komm($idd) {
        $this->db->select('*');
        $this->db->from('komm_gides');
        $this->db->where('komm_gides.id_trek', $idd);
        $this->db->order_by('komm_gides.datas', 'desc');
        $query = $this->db->get();
        return $query->result();
    }

    function get_komm_komm($idd) {
        $this->db->select('*');
        $this->db->from('komm_komm_gides');
        $this->db->where('id_kommm', $idd);
        $this->db->order_by('datas_k', 'desc');
        $query = $this->db->get();
        return $query->result();
    }

    function komm_komm($id_con, $id_prev_komm, $user, $text, $id_author) {
        $datas = date('d.m.Y h:i', time());

        $data = array(
            'id_trek' => $id_con,
            'id_kommm' => $id_prev_komm,
            'author_k' => $user,
            'id_author' => $id_author,
            'text_k' => $text,
            'datas_k' => $datas,
        );

        $this->db->insert('komm_komm_gides', $data);
    }

    function count_comm($id) {
        $this->db->where('id_trek', $id);
        return $this->db->count_all_results('komm_gides');
    }

    function count_like($id) {
        $this->db->select_sum('caunt');
        $this->db->where('id_gides', $id);
        $query = $this->db->get('liked_gides');
        $summ_old = $query->result();

        return $summ_old;
    }

    function add_like($id_news, $id_user) {
        $this->db->where('id_gides', $id_news);
        $this->db->where('id_user', $id_user);
        $find = $this->db->count_all_results('liked_gides');
        if ($find == 0) {
            $this->db->select_sum('caunt');
            $this->db->where('id_gides', $id_news);
            $query = $this->db->get('liked_gides');
            $summ_old = $query->result();

            $summ_new = $summ_old[0]->caunt + 1;

            $arr = array(
                'id_gides' => $id_news,
                'id_user' => $id_user,
                'caunt' => 1);
            $this->db->insert('liked_gides', $arr);
            return $summ_new;
        } else {
            return false;
        }
    }

     function get_gides_search($param) {
        $this->db->where('cat_gides', $param);
        $this->db->order_by('datas_gides', 'desc');
        $this->db->limit(3);
        $query = $this->db->get('gides');
        return $query->result();
    }
    function get_data($param) {
        $this->db->where('gides_id',$param);
        $query = $this->db->get('gides');
        return $query->result();
    }
}
