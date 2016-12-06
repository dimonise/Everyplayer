<?php

defined('BASEPATH') OR exit('No direct script access allowed');

class Players_model extends CI_Model {

    function get_gamers() {
        $this->db->where('active', 1);
        $this->db->where('first_name !=', 'Admin');
        $this->db->where('last_name !=', 'istrator');
        $this->db->order_by('top', 'desc');
        $this->db->limit(6);
        $query = $this->db->get('users');
        return $query->result();
    }

    function count_for_pag() {
        return $this->db->count_all_results('users');
    }

    function get_favor_games($limit = null) {
        if ($limit != null) {
            $this->db->limit(5);
        }
        $query = $this->db->get('favorite_games');
        return $query->result();
    }
    function get_filter_games() {

        $query = $this->db->get('achi_games');
        return $query->result();
    }
    function get_gmt() {

        $query = $this->db->get('gmt');
        return $query->result();
    }

    function get_gamers_search($num, $offset, $param) {
        $this->db->where('games_id', $param);
        $quer = $this->db->get('favorite_games');
        $games = $quer->result();

        $this->db->where('active', 1);
        $this->db->where('first_name !=', 'Admin');
        $this->db->where('last_name !=', 'istrator');
        $this->db->like('like_games', $games[0]->games_name);
        $this->db->order_by('datas', 'desc');
        $this->db->limit($num, $offset);
        $query = $this->db->get('users');
        return $query->result();
    }

    function search( $game, $gmt, $age, $sex) {

        $this->db->where('id_ach_game', $game);
        $quer = $this->db->get('achi_games');
        $games = $quer->result();

        //var_dump($games);
        if (empty($games[0]->game_name)) {
            $games = 'x';
        } else {
            $games = $games[0]->game_name;
        }
        if (empty($gmt)) {
            $gmt = 'x';
        } else {
            $gmt = $gmt;
        }
        if (empty($age)) {
            $age = 'x';
        } else {
            $age = $age;
        }
        if (!is_numeric($sex)) {
            $sex = 'x';
        } else {
            $sex = $sex;
        }

        $where = "active='1' and (gmt='$gmt' or sex='$sex' or  bdate like '%$age%' or like_games like '%$games%')";

        $this->db->where($where);
        $this->db->where('first_name !=', 'Admin');
        $this->db->where('last_name !=', 'istrator');
        $this->db->order_by('datas', 'desc');

        $query = $this->db->get('users');
        //print_r($this->db->queries);
        return $query->result();
    }
////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////
function get_ten_next($startFrom, $param=null) {

     
		$this->db->where('active', 1);
        $this->db->where('first_name !=', 'Admin');
        $this->db->where('last_name !=', 'istrator');
		if($param!=null){
		$this->db->where('games_id', $param);
        $quer = $this->db->get('favorite_games');
        $games = $quer->result();
		$this->db->like('like_games', $games[0]->games_name);
		}
        $this->db->order_by('top', 'desc');
        $this->db->limit(3,$startFrom);
        $query = $this->db->get('users');
        //print_r($this->db->queries);
		$articles = array();
        foreach ($query->result() as $row) {
            $articles[] = $row;
        }
        return json_encode($articles);
    }







}
