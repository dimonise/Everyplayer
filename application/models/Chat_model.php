<?php
/**
 * Статусы пользователей чата
 *  1 - друг
 *  2 - заблокирован
 *  3 - клан
 *  4 - личная переписка
 *  5 - группы
 *  6 - пользователи группы
 *  7 - пользователь кланов
*/

defined('BASEPATH') OR exit('No direct script access allowed');

class Chat_model extends CI_Model  {
    private $userId;
    function __construct()
    {
        $this->userId = $this->session->userdata('id');
    }

    public function get_room_id()
    {
        $count = 0;
        $result = $this->db->query('SELECT room_id FROM `chat`  ORDER BY room_id DESC LIMIT 1')->result();
        if($result){
            $count = $result[0]->room_id;
        }
        $count++;
        return $count;
    }

    public function get_chat_user($type)
    {
        $resRooms = $this->db->query('SELECT `room_id`  FROM chat WHERE user_id='.$this->userId.' AND `type`IN('.$type.')')->result();
        $idRooms='0';
        foreach ($resRooms as $val){
            $idRooms.=','.$val->room_id;
        }
        return $this->db->query('SELECT *  FROM chat WHERE  room_id IN('.$idRooms.') AND user_id!='.$this->userId)->result();
    }

    /**
     * Update friends and clans
     * */
    public function update_chat()
    {
        $roomId = $this->get_room_id();

        $resUser = $this->get_chat_user('1,3');
        $idClans = '0';
        $idUsers = '0';
        foreach ($resUser as $value){
            if($value->type == 3){
                $idClans.=','.$value->user_id;
            }elseif ($value->type == 1){
                $idUsers.=','.$value->user_id;
            }

        }
        $result = $this->db->query('SELECT members_clan.id_clan, clans.name_clan FROM members_clan 
                                    LEFT JOIN clans ON members_clan.id_clan = clans.clan_id  
                                    WHERE members_clan.active_clan =1 AND members_clan.id_user ='.$this->userId.' AND members_clan.id_clan NOT IN ('.$idClans.')')->result();

        if($result){
            foreach ($result as $value){
                if(!empty($value->name_clan)){
                    $opt = [
                        'room_id'=>$roomId,
                        'type'=>3,
                        'user_id'=>$value->id_clan,
                        'name'=>''
                    ];
                    $this->db->insert('chat', $opt);
                    $opt = [
                        'room_id'=>$roomId,
                        'type'=>3,
                        'user_id'=>$this->userId,
                        'name'=>''
                    ];
                    $this->db->insert('chat', $opt);
                    $roomId++;
                }

            }
        }
        /**
         * Обновляем друзей
         */
        $result = $this->db->query('SELECT friend_id FROM friends WHERE user_id='.$this->userId.' AND friend_id NOT IN ('.$idUsers.') AND friend_status=1')->result();
        if($result){
            foreach ($result as $value){
                $opt = [
                    'room_id'=>$roomId,
                    'type'=>1,
                    'user_id'=>$value->friend_id,
                    'name'=>''
                ];
                $this->db->insert('chat', $opt);
                $opt = [
                    'room_id'=>$roomId,
                    'type'=>1,
                    'user_id'=>$this->userId,
                    'name'=>''
                ];
                $this->db->insert('chat', $opt);
                $roomId++;
            }
        }



    }

    public function add_private_user($id)
    {
        if($id == $this->userId){
            return false;
        }
        $resUser = $this->get_chat_user('1,4');
        $roomId = $this->get_room_id();
        foreach ($resUser as $value)
        {
            if($value->user_id == $id){
                return false;
            }
        }

        $opt = [
            'room_id'=>$roomId,
            'type'=>4,
            'user_id'=>$id,
            'name'=>''
        ];
        $this->db->insert('chat', $opt);

        $opt = [
            'room_id'=>$roomId,
            'type'=>4,
            'user_id'=>$this->userId,
            'name'=>''
        ];
        return $this->db->insert('chat', $opt);
    }

    public function add_group($name)
    {
        $resUser = $this->get_chat_user('5');
        $roomId = $this->get_room_id();
        $name = trim($name);
        foreach ($resUser as $value)
        {
            if($value->name == $name){
                return false;
            }
        }

        $opt = [
            'room_id'=>$roomId,
            'type'=>5,
            'user_id'=>$this->userId,
            'name'=>$name,
        ];
        $this->db->insert('chat', $opt);
        return $roomId;
    }

    public function add_user_to_group($idUser, $idGroup)
    {
        $resultUser = $this->db->query('SELECT  room_id FROM chat WHERE room_id='.$idGroup.' AND  user_id ='.$idUser.' AND `type`=6')->result();
        if(!$resultUser){
            $opt = [
                'room_id'=>$idGroup,
                'type'=>6,
                'user_id'=>$idUser,
                'name'=>'',
            ];
            $this->db->insert('chat', $opt);
            return $this->db->insert_id();
        }
        return false;

    }
    public function remove_user_to_group($idUser, $idGroup)
    {
        $resultUser = $this->db->query('SELECT  room_id FROM chat WHERE room_id='.$idGroup.' AND  user_id ='.$idUser.' AND `type`=6')->result();
        if($resultUser){
            return $this->db->delete('chat', ['room_id'=>$idGroup, 'user_id'=>$idUser]);
        }
        return false;

    }

    public function add_message($text, $roomId)
    {
        $resultUser = $this->db->query('SELECT room_id FROM chat WHERE room_id='.$roomId.' AND user_id='.$this->userId)->result();
        if($resultUser){
            $opt = [
                'room_id'=>$roomId,
                'user_id'=>$this->userId,
                'mess'=>$text,
                'create_date'=>time(),
                'status'=>0,

            ];
            $this->db->insert('chat_mess', $opt);
            return $this->db->insert_id();
        }
        return false;
    }

    public function get_message($id, $idLast)
    {

        return $this->db->query('SELECT chat_mess.*, users.username, users.avatar FROM chat_mess
                                 LEFT JOIN `users` ON chat_mess.user_id = users.user_id 
                                 WHERE chat_mess.room_id ='.$id.' AND chat_mess.status!=3 AND chat_mess.chat_mess_id>'.$idLast)->result();

    }

    public function get_all_user()
    {
        $resUser = $this->get_chat_user('1,4');
        $roomId = '0';
        foreach ($resUser as $value)
        {
            $roomId.=','.$value->room_id;
        }
        return $this->db->query('SELECT  chat.*, users.username FROM chat
                                 LEFT JOIN `users` ON chat.user_id = users.user_id  
                                 WHERE chat.room_id IN('.$roomId.') AND chat.user_id!='.$this->userId)->result();
    }

    public function get_all_group()
    {
        $result = $this->db->query('SELECT  `room_id` FROM chat  WHERE chat.type IN(5,6) AND chat.user_id='.$this->userId)->result();

        if($result){
            $id='0';
            foreach ($result as $value)
            {
                $id.=','.$value->room_id;
            }
            return $this->db->query('SELECT  * FROM chat  WHERE chat.type=5 AND  chat.room_id IN('.$id.')')->result();
        }
        return false;
    }

    public function get_all_clans()
    {
        $result = $this->db->query('SELECT  `room_id` FROM chat  WHERE chat.type IN(3) AND chat.user_id='.$this->userId)->result();

        if($result){
            $id='0';
            foreach ($result as $value)
            {
                $id.=','.$value->room_id;
            }
            return $this->db->query('SELECT chat.*, clans.name_clan FROM chat 
                                    LEFT JOIN clans ON chat.user_id = clans.clan_id  WHERE chat.type=3 AND  chat.room_id IN('.$id.')')->result();
        }
        return false;
    }

    public function remove_message($id)
    {
        return $this->db->delete('chat_mess', ['chat_mess_id'=>$id, 'user_id'=>$this->userId]);
    }

    public function remove_group($id)
    {
        $r = $this->db->query('SELECT  * FROM chat  WHERE chat.type=5 AND chat.user_id='.$this->userId.' AND room_id='.$id)->result();
        if($r){
            $this->db->delete('chat', ['room_id'=>$id]);
            return $this->db->delete('chat_mess', ['room_id'=>$id]);

        }
        return false;
    }
    public function get_user_group($id)
    {
        $r = $this->db->query('SELECT  * FROM chat  WHERE  chat.user_id='.$this->userId.' AND room_id='.$id)->result();
        if($r){
            return $this->db->query('SELECT  chat.user_id, users.username FROM chat
                                     LEFT JOIN `users` ON chat.user_id = users.user_id   
                                     WHERE chat.type IN(6,5) AND  chat.room_id='.$id)->result();

        }
        return false;
    }

}
