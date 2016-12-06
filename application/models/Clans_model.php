<?php

defined('BASEPATH') OR exit('No direct script access allowed');

class Clans_model extends CI_Model
{

    function get_clans($num, $offset)
    {
        $this->db->limit($num, $offset);
        $query = $this->db->get('clans');
        return $query->result();
    }

    function get_info($id_clan = null)
    {
        $this->db->where('clan_id', $id_clan);
        $query = $this->db->get('clans');
        // print_r($this->db->queries);
        return $query->result();
    }

    function get_users($id_clan)
    {
        $this->db->select('*');
        $this->db->from('members_clan');
        $this->db->join('users', 'users.user_id = members_clan.id_user', 'left');
        $this->db->where('members_clan.id_clan', $id_clan);
        $this->db->where('members_clan.active_clan', 1);
        $query = $this->db->get();
        return $query->result();
    }

    function get_users_clan($num, $offset, $id_clan)
    {
        $this->db->select('*');
        $this->db->from('members_clan');
        $this->db->join('users', 'users.user_id = members_clan.id_user', 'left');
        $this->db->where('members_clan.id_clan', $id_clan);
        $this->db->where('members_clan.active_clan', 1);
        $this->db->limit($num, $offset);
        $query = $this->db->get();
        return $query->result();
    }

    function get_recrut($num, $offset, $id_clan)
    {
        $this->db->select('*');
        $this->db->from('members_clan');
        $this->db->join('users', 'users.user_id = members_clan.id_user', 'left');
        $this->db->where('members_clan.id_clan', $id_clan);
        $this->db->where('members_clan.active_clan', 0);
        $this->db->limit($num, $offset);
        $query = $this->db->get();
        return $query->result();
    }

    function get_games()
    {
        $query = $this->db->get('favorite_games');
        return $query->result();
    }

    function count_for_pag($id_clan)
    {
        $this->db->where('members_clan.id_clan', $id_clan);
        $this->db->where('members_clan.active_clan', 1);
        return $this->db->count_all_results('members_clan');
    }

    function count_for_pag_recrute($id_clan)
    {
        $this->db->where('members_clan.id_clan', $id_clan);
        $this->db->where('members_clan.active_clan', 0);
        return $this->db->count_all_results('members_clan');
    }

    function get_news($param)
    {
        $this->db->where('clan_id', $param);
        $this->db->order_by('datas_news', 'desc');
        $this->db->limit(3);
        $query = $this->db->get('news_clan');
        return $query->result();
    }

    function get_ten_next($startFrom, $param)
    {
        $this->db->where('clan_id', $param);
        $this->db->order_by('datas_news', 'desc');
        $this->db->limit(3, $startFrom);
        $query = $this->db->get('news_clan');
        $articles = array();
        foreach ($query->result() as $row) {
            $articles[] = $row;
        }
        return json_encode($articles);
    }

    function count_comm($id)
    {
        $this->db->where('id_trek', $id);
        return $this->db->count_all_results('komm_clan');
    }

    function get_one_news($id)
    {
        $this->db->where('news_id', $id);
        $query = $this->db->get('news_clan');
        return $query->result();
    }

    function komm($id_con, $user, $text, $id_author)
    {
        $datas = date('d.m.Y h:i', time());
        $data = array(
            'id_trek' => $id_con,
            'author' => $user,
            'id_author' => $id_author,
            'text' => $text,
            'datas' => $datas,
        );
        $this->db->insert('komm_clan', $data);
    }

    function get_komm($idd)
    {
        $this->db->select('*');
        $this->db->from('komm_clan');
        $this->db->where('komm_clan.id_trek', $idd);
        $this->db->order_by('komm_clan.datas', 'desc');
        $query = $this->db->get();
        return $query->result();
    }

    function get_komm_komm($idd)
    {
        $this->db->select('*');
        $this->db->from('komm_komm_clan');
        $this->db->where('id_kommm', $idd);
        $this->db->order_by('datas_k', 'desc');
        $query = $this->db->get();
        return $query->result();
    }

    function komm_komm($id_con, $id_prev_komm, $user, $text, $id_author)
    {
        $datas = date('d.m.Y h:i', time());
        $data = array(
            'id_trek' => $id_con,
            'id_kommm' => $id_prev_komm,
            'author_k' => $user,
            'id_author' => $id_author,
            'text_k' => $text,
            'datas_k' => $datas,
        );
        $this->db->insert('komm_komm_clan', $data);
    }

    function count_like($id)
    {
        $this->db->select_sum('caunt');
        $this->db->where('id_news', $id);
        $query = $this->db->get('liked_clan');
        $summ_old = $query->result();
        return $summ_old;
    }

    function add_like($id_news, $id_user)
    {
        $this->db->where('id_news', $id_news);
        $this->db->where('id_user', $id_user);
        $find = $this->db->count_all_results('liked_clan');
        if ($find == 0) {
            $this->db->select_sum('caunt');
            $this->db->where('id_news', $id_news);
            $query = $this->db->get('liked_clan');
            $summ_old = $query->result();
            $summ_new = $summ_old[0]->caunt + 1;
            $arr = array(
                'id_news' => $id_news,
                'id_user' => $id_user,
                'caunt' => 1);
            $this->db->insert('liked_clan', $arr);
            return $summ_new;
        } else {
            return false;
        }
    }

    function get_filter_clans($num, $offset, $search_name = null, $search_data = null, $search_game = null)
    {
        if ($search_game != null) {

            $this->db->select('*');
            $this->db->from('link_games_clans');
            $this->db->join('clans', 'clans.clan_id = link_games_clans.id_clans', 'left');
            $this->db->where('link_games_clans.id_games', $search_game);
            $this->db->limit($num, $offset);
            $query = $this->db->get();
            return $query->result();
        }

        if ($search_name != null) {
            $this->db->where('name_clan', $search_name);
            $this->db->limit($num, $offset);
            $query = $this->db->get('clans');
            return $query->result();
        }
        if ($search_data != null and $search_data == '1') {
            $this->db->order_by('datas', 'DESC');
            $this->db->limit($num, $offset);
            $query = $this->db->get('clans');
            return $query->result();
        }
        if ($search_data != null and $search_data == '2') {
            $this->db->order_by('datas', 'ASC');
            $this->db->limit($num, $offset);
            $query = $this->db->get('clans');
            return $query->result();
        }
        if ($search_data != null and $search_data == '3') {
            $cou = array();
            $query = $this->db->get('clans');
            foreach ($query->result() as $clans) {
                $this->db->where('id_clan', $clans->clan_id);
                $cou[$clans->clan_id][] = $this->db->count_all_results('members_clan');
            }
            arsort($cou);
            $ff = array();
            foreach ($cou as $key=>$value) {
                $this->db->where('clan_id',$key);
                $this->db->limit($num, $offset);
                $query = $this->db->get('clans');
                $ff[] = $query->result();
            }
            return $ff;
        }
        //return $query->result();
    }

    function count_for_pag_search_clan($search_name = null, $search_data = null, $search_game = null)
    {
        if ($search_name != null) {
            $this->db->where('name_clan', $search_name);
        }
        if ($search_data != null and $search_data == '1') {
            $this->db->order_by('datas', 'DESC');
        }
        if ($search_data != null and $search_data == '2') {
            $this->db->order_by('datas', 'ASC');
        }
        if ($search_game != null) {
            $this->db->like('games_clan', $search_game);
        }
        return $this->db->count_all_results('clans');
    }

    function count_for_pag_search_my_clan($id_user)
    {
        $this->db->where('id_clan', $id_user);
        return $this->db->count_all_results('members_clan');
    }

    function get_my_clans($num, $offset, $id_user)
    {

        $this->db->select('*');
        $this->db->from('members_clan');
        $this->db->join('clans', 'clans.clan_id = members_clan.id_clan', 'left');
        $this->db->where('members_clan.id_user', $id_user);
        $this->db->where('members_clan.active_clan', 1);
        $this->db->limit($num, $offset);
        $query = $this->db->get();
        //print_r($this->db->queries);
        return $query->result();
    }

}
