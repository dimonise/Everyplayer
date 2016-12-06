<?php

defined('BASEPATH') OR exit('No direct script access allowed');

class Privat_model extends CI_Model {

    function get_players($id_boss) {
        $this->db->select('*');
        $this->db->from('favorite_players');
        $this->db->join('users', 'users.user_id=favorite_players.id_player', 'left');
        $this->db->where('id_boss', $id_boss);
        //$this->db->order_by('datas', 'desc');
        //$this->db->limit($num, $offset);
        $query = $this->db->get();
        return $query->result();
    }

    function get_clans($id_boss) {
        $this->db->select('*');
        $this->db->from('favorite_clans');
        $this->db->join('clans', 'clans.clan_id=favorite_clans.id_clan', 'left');
        $this->db->where('id_boss', $id_boss);
        //$this->db->order_by('datas', 'desc');
        //$this->db->limit($num, $offset);
        $query = $this->db->get();
        return $query->result();
    }

    function get_matches($id_boss) {
        $queryz = array();
        $this->db->where('id_user', $id_boss);
        $this->db->group_by('id_comm');
        $query = $this->db->get('members_command'); // получаем в каких командах наш пользователь
        //var_dump($query->result());
        foreach ($query->result() as $res) {
            $this->db->where('id_command', $res->id_comm);
            $query = $this->db->get('command');
            $qwer = $query->result();

            $this->db->where('tour_id', $qwer[0]->id_tour);
            $this->db->group_by('tour_id');
            $quer = $this->db->get('tournament');
            $queryz[] = $quer->result();
        }
        return $queryz;
    }

    function get_tours($id_boss) {
        $this->db->select('*');
        $this->db->from('favorite_tour');
        $this->db->join('tournament', 'tournament.tour_id=favorite_tour.id_tour', 'left');
        $this->db->where('id_boss', $id_boss);
        $query = $this->db->get();
        return $query->result();
    }

    function get_news($id_boss) {
        $this->db->select('*');
        $this->db->from('favorite_news');
        $this->db->join('news', 'news.news_id=favorite_news.id_news', 'left');
        $this->db->where('id_boss', $id_boss);
        $query = $this->db->get();
//        print_r($this->db->queries);
        return $query->result();
    }

    function get_gides($id_boss) {
        $this->db->select('*');
        $this->db->from('favorite_gides');
        $this->db->join('gides', 'gides.gides_id=favorite_gides.id_gides', 'left');
        $this->db->where('id_boss', $id_boss);
        $query = $this->db->get();
        return $query->result();
    }

    function get_info($id_boss) {
        $this->db->where('user_id', $id_boss);
        $query = $this->db->get('users');
        return $query->result();
    }

    function save_ava($user_id, $path) {
        $data = array(
            'avatar' => $path,
        );

        $this->db->where('user_id', $user_id);
        $this->db->update('users', $data);
    }

    function get_friends($param) {
        $this->db->select('*');
        $this->db->from('friends');
        $this->db->join('users', 'users.user_id = friends.friend_id', 'left');
        $this->db->where('friends.user_id', $param);
        $this->db->order_by('friends.friend_status', 'asc');
        $query = $this->db->get();
        return $query->result();
    }

    function get_achi($param) {
        $this->db->select('*');
        $this->db->from('achi');
        //$this->db->join('favorite_games', 'favorite_games.games_id = achi.game', 'left');
        $this->db->join('achi_games', 'achi_games.id_ach_game = achi.game', 'left');
        $this->db->where('achi.user_id', $param);
        $query = $this->db->get();
        return $query->result();
    }

    function ed_ach($param) {
        $this->db->where('id_achi', $param);
        $query = $this->db->get('achi');
        //print_r($this->db->queries);
        return $query->result();
    }

    function save_clan($user_id, $path, $game = array(), $name_clan, $opisanie_clan, $lang) {
        if ($lang == 'en') {
            $title = 'title_en';
            $text = 'text_en';
        } else {
            $title = 'name_clan';
            $text = 'descr_clan';
        }
       
        $dat = array("$title" => $name_clan, 'logo_clan' => $path, "$text" => $opisanie_clan);
        $this->db->insert('clans', $dat);
        $id_clan = $this->db->insert_id();
        for ($i = 0; $i < count($game); $i++) {
            $data = array('id_games' => $game[$i], 'id_clans' => $id_clan);
            $this->db->insert('link_games_clans', $data);
        }
        $datas = array("id_clan"=>$id_clan, "id_user"=>$user_id, "active_clan"=>1);
        $this->db->insert('members_clan', $datas);
        $datar = array("id_clans"=>$id_clan, "id_user"=>$user_id, "id_roles"=>1);
        $this->db->insert('clan_roles', $datar);
        
    }

    function get_prem(){
        $query = $this->db->get('pay_prem');
        return $query->result();
    }
}
