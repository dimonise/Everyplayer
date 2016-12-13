<?php

defined('BASEPATH') OR exit('No direct script access allowed');

class Players_model extends CI_Model
{

    function get_gamers()
    {
        $this->db->where('active', 1);
        $this->db->where('first_name !=', 'Admin');
        $this->db->where('last_name !=', 'istrator');
        $this->db->order_by('top', 'desc');
        $this->db->limit(6);
        $query = $this->db->get('users');
        return $query->result();
    }

    function count_for_pag()
    {
        return $this->db->count_all_results('users');
    }

    function get_favor_games($limit = null)
    {
        if ($limit != null) {
            $this->db->limit(5);
        }
        $query = $this->db->get('achi_games');
        return $query->result();
    }

    function get_filter_games()
    {

        $query = $this->db->get('achi_games');
        return $query->result();
    }

    function get_gmt()
    {

        $query = $this->db->get('gmt');
        return $query->result();
    }

    function get_gamers_search($num, $offset, $param)
    {
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

    function search($game, $ach, $gmt, $age, $sex)
    {
        $this->db->where('id_ach_game', $game);
        $quer = $this->db->get('achi_games');
        $gamess = $quer->result();

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


        $add_where = '';
        if ($gmt != 'x' or $age != 'x' or $sex != 'x') {
            $add_where = "and active='1' and first_name !='Admin' and last_name!='istrator' and (gmt='$gmt' or sex='$sex' or  bdate like '%$age%')";
        }


        if (empty($gamess[0]->game_name)) {

            $filtr = array();
            $where = "active='1' and first_name !='Admin' and last_name!='istrator' $add_where";
            $this->db->where($where);
            $users = $this->db->get('users');
            $idd = $users->result();
            for ($i = 0; $i < count($users->result()); $i++) {
                $this->db->where('user_id', $idd[$i]->user_id);
                $userz = $this->db->get('users');
                $filtr[] = $userz->result();
            }
            return $filtr;


        } else {
            /*фильтры в зависимости от типа игры*/
            switch ($gamess[0]->id_ach_game) {
                case 1:

                    $crit = array(0 => 'region', 1 => 'rank', 2 => 'hero');
                    for ($i = 0; $i < count($ach); $i++) {
                        if (!empty($ach[$i])) {
                            $this->db->where($crit[$i], $ach[$i]);
                        }
                    }
                    $query = $this->db->get('achi_heart');
                    $result = $query->result();
                    $filtr = array();
                    for ($x = 0; $x < count($result); $x++) {
                        $where = "user_id=" . $result[$x]->user_id . "  $add_where";
                        $this->db->where($where);
                        $users = $this->db->get('users');

                        $filtr[] = $users->result();
                    }

                    return $filtr;
                    break;
                case 2:
                    if (!empty($ach[0])) {
                        $first = explode(' - ', $ach[0]);
                    }
                    if (!empty($ach[1])) {
                        $second = explode(' - ', $ach[1]);
                    }
                    if (!empty($ach[2])) {
                        $third = explode(' - ', $ach[2]);
                    }
                    if (!empty($ach[3])) {
                        $four = 'and role=' . $ach[3];
                    } else {
                        $four = null;
                    }
                    $where = "select *  from `achi_dota2` where `priv_mmp` between '$first[0]' and '$first[1]' and `com_mmp` between '$second[0]' and  '$second[1]' and `time_game` between  '$third[0]' and '$third[1]' $four";

                    $query = $this->db->query($where);
                    $result = $query->result();
//                    echo "<pre>";
//                    print_r($this->db->queries);
                    $filtr = array();
                    for ($x = 0; $x < count($result); $x++) {
                        $where = "user_id=" . $result[$x]->user_id . "  $add_where";
                        $this->db->where($where);
                        $users = $this->db->get('users');
                        $filtr[] = $users->result();
                    }


                    return $filtr;

                    break;
                case 3:
                    if (!empty($ach[0])) {
                        $first = explode(' - ', $ach[0]);
                    }
                    if (!empty($ach[1])) {
                        $second = explode(' - ', $ach[1]);
                    }
                    if (!empty($ach[2])) {
                        $third = explode(' - ', $ach[2]);
                    }
                    if (!empty($ach[3])) {
                        $four = explode(' - ', $ach[3]);
                    }
                    if (!empty($ach[4])) {
                        $five = 'and tank=' . $ach[4];
                    } else {
                        $five = null;
                    }
                    $where = "select *  from `achi_wot` where `priv_rank` between '$first[0]' and '$first[1]' and `perc_win` between '$second[0]' and  '$second[1]' and `perc_shoot` between  '$third[0]' and '$third[1]' and `avg_dam` between  '$four[0]' and '$four[1]' $five";

                    $query = $this->db->query($where);
                    $result = $query->result();
//                    echo "<pre>";
//                    print_r($this->db->queries);
                    $filtr = array();
                    for ($x = 0; $x < count($result); $x++) {
                        $where = "user_id=" . $result[$x]->user_id . "  $add_where";
                        $this->db->where($where);
                        $users = $this->db->get('users');
                        $filtr[] = $users->result();
                    }


                    return $filtr;

                    break;
                case 4:
                    if (!empty($ach[0])) {
                        $first = explode(' - ', $ach[0]);
                    }
                    if (!empty($ach[1])) {
                        $second = explode(' - ', $ach[1]);
                    }
                    if (!empty($ach[2])) {
                        $three = 'and role=' . $ach[2];
                    } else {
                        $three = null;
                    }
                    if (!empty($ach[3])) {
                        $four = ' and device=' . $ach[3];
                    } else {
                        $four = null;
                    }
                    $where = "select *  from `achi_parag` where `count_gam` between '$first[0]' and '$first[1]' and `elo` between '$second[0]' and  '$second[1]' $three $four";

                    $query = $this->db->query($where);
                    $result = $query->result();
//                    echo "<pre>";
//                    print_r($this->db->queries);
                    $filtr = array();
                    for ($x = 0; $x < count($result); $x++) {
                        $where = "user_id=" . $result[$x]->user_id . "  $add_where";
                        $this->db->where($where);
                        $users = $this->db->get('users');
                        $filtr[] = $users->result();
                    }

                    return $filtr;

                    break;
                case 5:
                    if (!empty($ach[0])) {
                        $first = explode(' - ', $ach[0]);
                    }
                    if (!empty($ach[1])) {
                        $second = 'and role=' . $ach[1];
                    } else {
                        $second = null;
                    }
                    if (!empty($ach[2])) {
                        $three = ' and rank=' . $ach[2];
                    } else {
                        $three = null;
                    }

                    $where = "select *  from `achi_cs` where `count_gam` between '$first[0]' and '$first[1]'  $second $three";

                    $query = $this->db->query($where);
                    $result = $query->result();
//                    echo "<pre>";
//                    print_r($this->db->queries);
                    $filtr = array();
                    for ($x = 0; $x < count($result); $x++) {
                        $where = "user_id=" . $result[$x]->user_id . "  $add_where";
                        $this->db->where($where);
                        $users = $this->db->get('users');
                        $filtr[] = $users->result();
                    }

                    return $filtr;
                    break;
                case 6:
                    if (!empty($ach[0])) {
                        $first = explode(' - ', $ach[0]);
                    }
                    if (!empty($ach[1])) {
                        $second = 'and rank=' . $ach[1];
                    } else {
                        $second = null;
                    }
                    if (!empty($ach[2])) {
                        $three = ' and role=' . $ach[2];
                    } else {
                        $three = null;
                    }
                    if (!empty($ach[3])) {
                        $four = ' and type_gam=' . $ach[3];
                    } else {
                        $four = null;
                    }
                    $where = "select *  from `achi_lol` where `count_gam` between '$first[0]' and '$first[1]'  $second $three $four";

                    $query = $this->db->query($where);
                    $result = $query->result();
//                    echo "<pre>";
//                    print_r($this->db->queries);
                    $filtr = array();
                    for ($x = 0; $x < count($result); $x++) {
                        $where = "user_id=" . $result[$x]->user_id . "  $add_where";
                        $this->db->where($where);
                        $users = $this->db->get('users');
                        $filtr[] = $users->result();
                    }

                    return $filtr;
                    break;
                case 7:
                    if (!empty($ach[0])) {
                        $first = explode(' - ', $ach[0]);
                    }
                    if (!empty($ach[1])) {
                        $second = 'and rank=' . $ach[1];
                    } else {
                        $second = null;
                    }
                    if (!empty($ach[2])) {
                        $three = ' and role=' . $ach[2];
                    } else {
                        $three = null;
                    }
                    if (!empty($ach[3])) {
                        $four = ' and type_gam=' . $ach[3];
                    } else {
                        $four = null;
                    }
                    $where = "select *  from `achi_hs` where `count_gam` between '$first[0]' and '$first[1]'  $second $three $four";

                    $query = $this->db->query($where);
                    $result = $query->result();
//                    echo "<pre>";
//                    print_r($this->db->queries);
                    $filtr = array();
                    for ($x = 0; $x < count($result); $x++) {
                        $where = "user_id=" . $result[$x]->user_id . "  $add_where";
                        $this->db->where($where);
                        $users = $this->db->get('users');
                        $filtr[] = $users->result();
                    }

                    return $filtr;
                    break;
                case 8:
                    if (!empty($ach[0])) {
                        $first = explode(' - ', $ach[0]);
                    }
                    if (!empty($ach[1])) {
                        $second = 'and rank=' . $ach[1];
                    } else {
                        $second = null;
                    }
                    if (!empty($ach[2])) {
                        $three = ' and tank=' . $ach[2];
                    } else {
                        $three = null;
                    }
                    if (!empty($ach[3])) {
                        $four = ' and killer=' . $ach[3];
                    } else {
                        $four = null;
                    }
                    if (!empty($ach[4])) {
                        $five = ' and support=' . $ach[4];
                    } else {
                        $five = null;
                    }
                    if (!empty($ach[5])) {
                        $six = ' and guard=' . $ach[5];
                    } else {
                        $six = null;
                    }
                    $where = "select *  from `achi_hs` where `count_gam` between '$first[0]' and '$first[1]'  $second $three $four $five $six";

                    $query = $this->db->query($where);
                    $result = $query->result();
//                    echo "<pre>";
//                    print_r($this->db->queries);
                    $filtr = array();
                    for ($x = 0; $x < count($result); $x++) {
                        $where = "user_id=" . $result[$x]->user_id . "  $add_where";
                        $this->db->where($where);
                        $users = $this->db->get('users');
                        $filtr[] = $users->result();
                    }

                    return $filtr;
                    break;

            }

        }


    }

////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////
    function get_ten_next($startFrom, $param = null)
    {


        $this->db->where('active', 1);
        $this->db->where('first_name !=', 'Admin');
        $this->db->where('last_name !=', 'istrator');
        if ($param != null) {
            $this->db->where('games_id', $param);
            $quer = $this->db->get('favorite_games');
            $games = $quer->result();
            $this->db->like('like_games', $games[0]->games_name);
        }
        $this->db->order_by('top', 'desc');
        $this->db->limit(3, $startFrom);
        $query = $this->db->get('users');
        //print_r($this->db->queries);
        $articles = array();
        foreach ($query->result() as $row) {
            $articles[] = $row;
        }
        return json_encode($articles);
    }


}
