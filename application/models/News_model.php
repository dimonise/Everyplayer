<?php

defined('BASEPATH') OR exit('No direct script access allowed');

class News_model extends CI_Model {

    function get_one_news($id) {
        $this->db->where('news_id', $id);
        $query = $this->db->get('news');
        return $query->result();
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

        $this->db->insert('komm_news', $data);
    }

    function get_komm($idd) {
        $this->db->select('*');
        $this->db->from('komm_news');
        $this->db->where('komm_news.id_trek', $idd);
        $this->db->order_by('komm_news.datas', 'desc');
        $query = $this->db->get();
        return $query->result();
    }

    function get_komm_komm($idd) {
        $this->db->select('*');
        $this->db->from('komm_komm_news');
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

        $this->db->insert('komm_komm_news', $data);
    }

    function count_comm($id) {
        $this->db->where('id_trek', $id);
        return $this->db->count_all_results('komm_news');
    }
function count_like($id) {
        $this->db->select_sum('caunt');
        $this->db->where('id_news',$id);
        $query = $this->db->get('liked_news');
        $summ_old = $query->result();
        
        return $summ_old;
    }
    function add_like($id_news, $id_user) {
        $this->db->where('id_news',$id_news);
        $this->db->where('id_user',$id_user);
        $find = $this->db->count_all_results('liked_news');
        if($find == 0){
        $this->db->select_sum('caunt');
        $this->db->where('id_news',$id_news);
        $query = $this->db->get('liked_news');
        $summ_old = $query->result();
       
        $summ_new = $summ_old[0]->caunt+1;
        
        $arr = array(
            'id_news'=>$id_news,
            'id_user'=>$id_user,
            'caunt'=>1);
        $this->db->insert('liked_news',$arr);
        return $summ_new;
        }
        else{
            return false;
        }
    }

}
