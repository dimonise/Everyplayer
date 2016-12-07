<?php

defined('BASEPATH') OR exit('No direct script access allowed');

class Privat extends CI_Controller
{

    var $dataz = array();

    function __construct()
    {
        parent::__construct();
        $this->dataz['month_array_rus'] = array("01" => "января",
            "02" => "февраля",
            "03" => "марта",
            "04" => "апреля",
            "05" => "мая",
            "06" => "июня",
            "07" => "июля",
            "08" => "августа",
            "09" => "сентября",
            "10" => "октября",
            "11" => "ноября",
            "12" => "декабря");
        $this->dataz['month_array_en'] = array("01" => "january",
            "02" => "february",
            "03" => "march",
            "04" => "april",
            "05" => "may",
            "06" => "june",
            "07" => "jule",
            "08" => "august",
            "09" => "september",
            "10" => "october",
            "11" => "november",
            "12" => "december");
        $this->load->model('lang_model');
        $this->dataz['lang'] = $this->lang_model->index();
    }

    public function favorites($param = null)
    {
        $data['title'] = 'Everyplayer - Privat Favorites';
        $this->load->model('home_model');
        $this->load->model('privat_model');
        $this->load->model('gides_model');
        $data['lang'] = $this->dataz['lang'];
        $arr = array('side' => $this->uri->segment(2));
        $this->session->set_userdata($arr);
        $data['month_array_en'] = $this->dataz['month_array_en'];
        $data['month_array_rus'] = $this->dataz['month_array_rus'];
        //$data['name_tour'] = $this->tour_model->get_tour_name();
        $id_boss = $this->session->userdata('id');
        $data['slider'] = $this->home_model->get_slider();
        $data['tourn'] = $this->privat_model->get_tours($id_boss);
        $data['news'] = $this->privat_model->get_news($id_boss);
        $data['player'] = $this->privat_model->get_players($id_boss);
        $data['gides'] = $this->privat_model->get_gides($id_boss);
        $data['clans'] = $this->privat_model->get_clans($id_boss);
        $this->load->view('header', $data);
        $this->load->view('heading', $data);
        $this->load->view('privat/favorites', $data);
        $this->load->view('footer', $data);
    }

    public function players()
    {
        $id_player = $this->input->post('id_player');
        $id_boss = $this->session->userdata('id');
        $dat = array('id_boss' => $id_boss, 'id_player' => $id_player);
        $this->db->insert('favorite_players', $dat);
    }

    public function del_players()
    {
        $id_player = $this->input->post('id_player');
        $id_boss = $this->input->post('id_boss');
        $this->db->where('id_boss', $id_boss);
        $this->db->where('id_player', $id_player);
        $this->db->delete('favorite_players');
        //print_r($this->db->queries);
    }

    public function clans()
    {
        $id_clan = $this->input->post('id_clan');
        $id_boss = $this->session->userdata('id');
        $dat = array('id_boss' => $id_boss, 'id_clan' => $id_clan);
        $this->db->insert('favorite_clans', $dat);
    }

    public function del_clans()
    {
        $id_clan = $this->input->post('id_clan');
        $id_boss = $this->input->post('id_boss');
        $this->db->where('id_boss', $id_boss);
        $this->db->where('id_clan', $id_clan);
        $this->db->delete('favorite_clans');
        //print_r($this->db->queries);
    }

    public function tour()
    {
        $id_clan = $this->input->post('id_tour');
        $id_boss = $this->session->userdata('id');

        $dat = array('id_boss' => $id_boss, 'id_tour' => $id_clan);
        $this->db->insert('favorite_tour', $dat);
    }

    public function news()
    {
        $id_news = $this->input->post('id_news');
        $id_boss = $this->session->userdata('id');

        $dat = array('id_boss' => $id_boss, 'id_news' => $id_news);
        $this->db->insert('favorite_news', $dat);
    }

    public function del_news()
    {
        $id_news = $this->input->post('id_news');
        $id_boss = $this->input->post('id_boss');
        $this->db->where('id_boss', $id_boss);
        $this->db->where('id_news', $id_news);
        $this->db->delete('favorite_news');
        //print_r($this->db->queries);
    }

    public function gides()
    {
        $id_gides = $this->input->post('id_gides');
        $id_boss = $this->session->userdata('id');

        $dat = array('id_boss' => $id_boss, 'id_gides' => $id_gides);
        $this->db->insert('favorite_gides', $dat);
    }

    public function del_gides()
    {
        $id_gides = $this->input->post('id_gides');
        $id_boss = $this->input->post('id_boss');
        $this->db->where('id_boss', $id_boss);
        $this->db->where('id_gides', $id_gides);
        $this->db->delete('favorite_gides');
    }

    public function myclans($param)
    {
        $data['title'] = 'Everyplayer - Privat My Clans';
        $this->load->model('home_model');
        $this->load->model('privat_model');
        $this->load->model('gides_model');
        $data['lang'] = $this->dataz['lang'];
        $arr = array('side' => $this->uri->segment(2));
        $this->session->set_userdata($arr);
        $data['month_array_en'] = $this->dataz['month_array_en'];
        $data['month_array_rus'] = $this->dataz['month_array_rus'];
        //$data['name_tour'] = $this->tour_model->get_tour_name();
        $id_boss = $this->session->userdata('id');
        $data['slider'] = $this->home_model->get_slider();
        ////////////////pagination//////////////////////////////
        $this->load->library('pagination');
        $this->load->model('clans_model');

        if (!$this->uri->segment(5)) {
            $offset = 0;
        } else {
            $offset = $this->uri->segment(5);
        }
        $config['base_url'] = base_url() . $data['lang'] . "/" . $this->session->userdata('side') . "/privat_clans/";
        $config['total_rows'] = $this->clans_model->count_for_pag_search_my_clan($this->session->userdata('id'));
        $config['per_page'] = 6;
        $config['full_tag_open'] = '<ul>';
        $config['full_tag_close'] = '</ul>';
        $config['num_tag_open'] = '<li>';
        $config['num_tag_close'] = '</li>';
        $config['cur_tag_open'] = '<li>';
        $config['cur_tag_close'] = '</li>';
        $config['first_link'] = '<<';
        $config['last_link'] = '>>';
        $config['next_link'] = ' »';
        $config['prev_link'] = '« ';
        $config['num_links'] = 3;
        $this->pagination->initialize($config);
        $data['clan'] = $this->clans_model->get_my_clans($config['per_page'], $offset, $this->session->userdata('id'));
        ///////////////////////////////////////////////////
        $this->load->view('header', $data);
        $this->load->view('heading', $data);
        $this->load->view('privat/clans', $data);
        $this->load->view('footer', $data);
    }

    public function info($param)
    {
        $data['title'] = 'Everyplayer - Privat Info';
        $this->load->model('home_model');
        $this->load->model('privat_model');
        $this->load->model('players_model');
        $data['lang'] = $this->dataz['lang'];
        $arr = array('side' => $this->uri->segment(2));
        $this->session->set_userdata($arr);
        $data['month_array_en'] = $this->dataz['month_array_en'];
        $data['month_array_rus'] = $this->dataz['month_array_rus'];
        //$data['gmt'] = $this->players_model->get_gmt();
        $data['slider'] = $this->home_model->get_slider();

        $data['info'] = $this->privat_model->get_info($param);
        $data['achiev'] = $this->privat_model->get_achi($this->uri->segment(4));

        $this->load->view('header', $data);
        $this->load->view('heading', $data);
        if ($this->session->userdata('id') == $this->uri->segment(4)) {
            $this->load->view('privat/privat', $data);
        } else {
            $this->load->view('privat/privat_noname', $data);
        }
        $this->load->view('footer', $data);
    }

    public function avatar()
    {
        $this->load->model('lang_model');
        $datas['lang'] = $this->lang_model->index();
        $config['upload_path'] = './images/avatar/';
        $config['allowed_types'] = 'png|jpg';
        $this->load->library('upload');
        $this->upload->initialize($config);

        if (!$this->upload->do_upload()) {
            $error = array('error' => $this->upload->display_errors());
            echo $error['error'];
        } else {
            $data = array('upload_data' => $this->upload->data());
            $path = $data['upload_data']['file_name'];
            $user_id = $this->input->post('user_id');


            $this->load->model('privat_model');
            $this->privat_model->save_ava($user_id, $path);

            redirect(base_url() . $datas['lang'] . '/' . $this->session->userdata('side') . '/privat_info/' . $user_id, 'refresh');
        }
    }

    public function edit_info()
    {
        $this->load->model('lang_model');
        $datas['lang'] = $this->lang_model->index($this->input->post('lang'));
        $data['month_array_en'] = $this->dataz['month_array_en'];
        $data['month_array_rus'] = $this->dataz['month_array_rus'];
        $id_user = $this->input->post('id_user');
        $this->db->where('user_id', $id_user);
        $query = $this->db->get('users');
        $res = $query->result();
        $ar = explode('.', $res[0]->bdate);
        echo '<script>
		jQuery(function(){			
		jQuery("select").selectbox();
		});
	</script><div class="privat_dannie2"><form action="/privat/save_info" method="post"><div class="privat_input_grup">
								<div class="privat_lich_dannie">
									<p>';
        echo $this->lang->line('pdata');
        echo '</p>
								</div>
								<input class="privat_input1" type="text" name="first_name" list="frameworks" placeholder="Имя" value="' . $res[0]->first_name . '">
								<input class="privat_input1" type="text" name="username" list="frameworks" placeholder="Ник" value="' . $res[0]->username . '">
								<input class="privat_input1" type="email" name="email" list="frameworks" placeholder="Email" value="' . $res[0]->email . '">
							</div>
							<div class="privat_data_rogdeniya">
								<p>';
        echo $this->lang->line('bd_pr');
        echo '</p>
								<div class="vibor_chislo">
									<select name="bdate_d">';
        echo "<option value='$ar[0]' selected>$ar[0]</option>";

        for ($i = 1; $i < 32; $i++) {
            echo "<option value='$i'>$i</option>";
        }

        echo '								</select>
								</div>
								<div class="vibor_mesyac">
									<select name="bdate_m">';
        if ($datas['lang'] == 'en') {
            $month = $data['month_array_en'][$ar[1]];
        } else {
            $month = $data['month_array_rus'][$ar[1]];
        }
        echo "<option value='$ar[1]' selected>$month</option>";
        for ($i = 1; $i < 13; $i++) {
            if ($i <= 9) {
                $d = 0;
            } else {
                $d = '';
            }
            if ($datas['lang'] == 'en') {
                echo "<option value='$d$i'>" . $data['month_array_en'][$d . $i] . "</option>";
            } else {

                echo "<option value='$d$i'>" . $data['month_array_rus'][$d . $i] . "</option>";
            }
        }
        echo '								</select>
								</div>
								<div class="vibor_god">
									<select name="bdate_y">';
        echo "<option value='$ar[2]' selected>$ar[2]</option>";
        for ($i = 1950; $i < 2020; $i++) {
            echo "<option value='$i'>$i</option>";
        }
        echo '								</select>
								</div>
								<div class="vibor_pol">
									<select name="sex">
											<option>';
        echo $this->lang->line('sex');
        echo '</option>';
        if ($res[0]->sex == 2) {
            $sex = $this->lang->line('m');
        } else {
            $sex = $this->lang->line('f');
        }
        echo "<option value='" . $res[0]->sex . "' selected>" . $sex . "</option>";
        echo '										<option>';
        echo $this->lang->line('m');
        echo '</option>
											<option>';
        echo $this->lang->line('f');
        echo '</option>
									</select>
								</div>
								<div class="vibor_strana">
									<input class="privat_input1" type="text" name="country" list="frameworks" placeholder="' . $this->lang->line('country') . '" value="' . $res[0]->country . '">
								</div>
								<div class="vibor_gorod">
									<input class="privat_input1" type="text" name="city" list="frameworks" placeholder="' . $this->lang->line('city') . '" value="' . $res[0]->city . '">
								</div>
								<div class="vibor_chas_poyas">
									<select name="gmt">
											<option>' . $this->lang->line('timez') . '</option>';
        if ($res[0]->gmt) {
            echo "<option value='" . $res[0]->gmt . "' selected>" . $res[0]->gmt . "</option>";
        }
        $quer = $this->db->get('gmt');
        foreach ($quer->result() as $qw) {
            echo '<option value="' . $qw->gmt . '">' . $qw->gmt . '</option>';
        }

        echo '								</select>
								</div>
								<div class="vibor_storoni">
									<select name="side">
											<option>' . $this->lang->line('sels') . '</option>';
        //echo "<option value='" . $res[0]->side . "' selected>" . $res[0]->side . "</option>";
        echo '										<option value="black">Темная сторона / Dark Side</option>
											<option value="light">Светлая сторона / Bright Side</option>
									</select>
								</div>
								<div class="privat_lich_information">
                                                                
									<p>' . $this->lang->line('coninf') . '</p>
								</div>
								
							</div>
                                                        <p>' . $this->lang->line('descr') . '</p>
                                                        <textarea name="descr">' . $res[0]->descr . '</textarea><br> 
                                                        <label for="show">' . $this->lang->line('showcont') . '</label><input type="checkbox" name="show" value="1" id="show">     							<input class="privat_input1" type="text" name="facebook" list="frameworks" placeholder="Facebook" value="' . $res[0]->facebook . '">
								<input class="privat_input1" type="text" name="vk" list="frameworks" placeholder="Vkontakte" value="' . $res[0]->vk . '">
								<input class="privat_input1" type="email" name="twitter" list="frameworks" placeholder="Twitter" value="' . $res[0]->twitter . '">
                                                                <input class="privat_input1" type="email" name="google" list="frameworks" placeholder="Google+" value="' . $res[0]->google . '">
                                                                
							<div class="privat_lich_information">
								<p>' . $this->lang->line('abme') . '</p>
							</div>
                                                        <textarea name="about">' . $res[0]->about . '</textarea>
							<input class="privat_input1" type="text" name="frameworks" list="frameworks" placeholder="' . $this->lang->line('prime') . '" value="' . $res[0]->prime . '">
								<input class="privat_input1" type="text" name="education" list="frameworks" placeholder="' . $this->lang->line('educ') . '" value="' . $res[0]->education . '">
								<input class="privat_input1" type="text" name="occupation" list="frameworks" placeholder="' . $this->lang->line('occup') . '" value="' . $res[0]->occupation . '">
								<input type="submit" class="privat_save" value="' . $this->lang->line('save') . '">
                                                                </form>
                                                                </div>';
    }

    public function save_info()
    {
        $user_id = $this->session->userdata('id');
        $first_name = $this->input->post('first_name');
        $username = $this->input->post('username');
        $email = $this->input->post('email');
        $bdate = $this->input->post('bdate_d') . '.' . $this->input->post('bdate_m') . '.' . $this->input->post('bdate_y');
        $sex = $this->input->post('sex');
        $country = $this->input->post('country');
        $city = $this->input->post('city');
        $gmt = $this->input->post('gmt');
        $side = $this->input->post('side');
        $facebook = $this->input->post('facebook');
        $vk = $this->input->post('vk');
        $twitter = $this->input->post('twitter');
        $google = $this->input->post('google');
//        $linkedin = $this->input->post('linkedin');
        $prime = $this->input->post('prime');
        $edu = $this->input->post('education');
        $occ = $this->input->post('occupation');
        $datas['lang'] = $this->lang_model->index();
        if ($this->input->post('show')) {
            $show = $this->input->post('show');
        } else {
            $show = 0;
        }
        $descr = $this->input->post('descr');
        $about = $this->input->post('about');
        $data = array('first_name' => $first_name,
            'username' => $username,
            'email' => $email,
            'bdate' => $bdate,
            'sex' => $sex,
            'country' => $country,
            'city' => $city,
            'gmt' => $gmt,
            'side' => $side,
            'facebook' => $facebook,
            'vk' => $vk,
            'twitter' => $twitter,
            'google' => $google,
//            'linkedin' => $linkedin,
            'prime' => $prime,
            'education' => $edu,
            'occupation' => $occ,
            'shows' => $show,
            'descr' => $descr,
            'about' => $about);
        $ar = array('side' => $side);
        $this->session->set_userdata($ar);
        $this->db->where('user_id', $user_id);
        $this->db->update('users', $data);
        redirect(base_url() . $datas['lang'] . '/' . $this->session->userdata('side') . '/privat_info/' . $user_id, 'refresh');
    }

    public function mytour($param)
    {
        $data['title'] = 'Everyplayer - Privat Tournaments';
        $this->load->model('home_model');
        $this->load->model('privat_model');
        $data['lang'] = $this->dataz['lang'];
        $arr = array('side' => $this->uri->segment(2));
        $this->session->set_userdata($arr);
        $data['month_array_en'] = $this->dataz['month_array_en'];
        $data['month_array_rus'] = $this->dataz['month_array_rus'];
        //$data['gmt'] = $this->players_model->get_gmt();
        $data['slider'] = $this->home_model->get_slider();

        $data['tours'] = $this->privat_model->get_matches($param);
        $this->load->view('header', $data);
        $this->load->view('heading', $data);
        $this->load->view('privat/tour', $data);
        $this->load->view('footer', $data);
    }

    public function friends($param)
    {
        $data['title'] = 'Everyplayer - Privat Tournaments';
        $this->load->model('home_model');
        $this->load->model('privat_model');
        $data['lang'] = $this->dataz['lang'];
        $arr = array('side' => $this->uri->segment(2));
        $this->session->set_userdata($arr);
        $data['month_array_en'] = $this->dataz['month_array_en'];
        $data['month_array_rus'] = $this->dataz['month_array_rus'];
        //$data['gmt'] = $this->players_model->get_gmt();
        $data['slider'] = $this->home_model->get_slider();

        $data['friends'] = $this->privat_model->get_friends($param);
        $this->load->view('header', $data);
        $this->load->view('heading', $data);
        $this->load->view('privat/friends', $data);
        $this->load->view('footer', $data);
    }

    public function add_friend()
    {
        $fre = $this->input->post('fre');
        $bos = $this->input->post('bos');
        $data = array('user_id' => $bos, 'friend_id' => $fre);
        $this->db->insert('friends', $data);
        $data = array('user_id' => $fre, 'friend_id' => $bos);
        $this->db->insert('friends', $data);
    }

    public function act_friend()
    {
        $idus = $this->input->post('us_id');
        $id_boss = $this->session->userdata('id');

        $data = array('friend_status' => 1);

        $this->db->where('friend_id', $idus);
        $this->db->where('user_id', $id_boss);
        $this->db->update('friends', $data);
    }

    public function del_friend()
    {
        $idus = $this->input->post('us_id');
        $id_boss = $this->session->userdata('id');
        $this->db->where('friend_id', $idus);
        $this->db->where('user_id', $id_boss);
        $this->db->delete('friends');
    }

    /*------- вывод достижений  --*/
    public function achievements($param)
    {
        $data['title'] = 'Everyplayer - Privat Achievements';
        $this->load->model('home_model');
        $this->load->model('privat_model');
        $data['lang'] = $this->dataz['lang'];
        $arr = array('side' => $this->uri->segment(2));
        $this->session->set_userdata($arr);
        $data['month_array_en'] = $this->dataz['month_array_en'];
        $data['month_array_rus'] = $this->dataz['month_array_rus'];
        //$data['gmt'] = $this->players_model->get_gmt();
        $data['slider'] = $this->home_model->get_slider();

        $data['achiev'] = $this->privat_model->get_achi($param);
        $this->load->view('header', $data);
        $this->load->view('heading', $data);
        $this->load->view('privat/achievements', $data);
        $this->load->view('footer', $data);
    }

    /*-- сохранение нового достижения --*/
    public function new_ach()
    {
        $id_user = $this->input->post('id_user');
        $id_game = $this->input->post('new_game');

        $datas['lang'] = $this->input->post('lang');

        if ($id_game == 1) {
            $id_har = $this->input->post('id_har');
            $first = $this->input->post('first');

            $dataz = array();
            $data = array();
            /*--- сохраняем в общую таблицу ---*/
            for($i = 0; $i < 3; $i++) {
                $dataz['user_id'] = $id_user;
                $dataz['game'] = $id_game;
                $dataz['id_crit'] = $id_har[$i];
                $dataz['val_crit'] = $first[$i];
                $this->db->insert('achi', $dataz);
            }
            /*--- сохраняем в индивидуальную таблицу ---*/
            $data['user_id'] = $id_user;
            $data['region'] = $first[0];
            $data['rank'] = $first[1];
            $data['hero'] = $first[2];
            $this->db->insert('achi_heart', $data);

        }
        if ($id_game == 2) {
            $id_har = $this->input->post('id_har');
            $second = $this->input->post('second');
            $dataz = array();
            $data = array();
            /*--- сохраняем в общую таблицу ---*/
            for ($i = 0; $i < 3; $i++) {
                $dataz['user_id'] = $id_user;
                $dataz['game'] = $id_game;
                $dataz['id_crit'] = $id_har[$i];
                $dataz['val_crit_text'] = $second[$i];
                $this->db->insert('achi', $dataz);
            }
            $dataz['val_crit_text'] = 0;
            $dataz['id_crit'] = $id_har[3];
            $dataz['val_crit'] = $second[3];
            $this->db->insert('achi', $dataz);
            /*--------------------------------------*/
            $data['user_id'] = $id_user;
            $data['priv_mmp'] = $second[0];
            $data['com_mmp'] = $second[1];
            $data['time_game'] = $second[2];
            $data['role'] = $second[3];
            $this->db->insert('achi_dota2', $data);
        }

        if ($id_game == 3) {
            $id_har = $this->input->post('id_har');
            $third = $this->input->post('third');
            $dataz = array();
            $data = array();
            /*--- сохраняем в общую таблицу ---*/
            for ($i = 0; $i < 4; $i++) {

                $dataz['user_id'] = $id_user;
                $dataz['game'] = $id_game;
                $dataz['id_crit'] = $id_har[$i];
                $dataz['val_crit_text'] = $third[$i];
                $this->db->insert('achi', $dataz);
            }
            $dataz['val_crit_text'] = 0;
            $dataz['id_crit'] = $id_har[4];
            $dataz['val_crit'] = $third[4];
            $this->db->insert('achi', $dataz);
            /*--------------------------------------*/
            $data['user_id'] = $id_user;
            $data['priv_rank'] = $third[0];
            $data['perc_win'] = $third[1];
            $data['perc_shoot'] = $third[2];
            $data['avg_dam'] = $third[3];
            $data['tank'] = $third[4];
            $this->db->insert('achi_wot', $data);
        }
        if ($id_game == 4) {
            $id_har = $this->input->post('id_har');
            $four = $this->input->post('four');
            for ($i = 0; $i < 2; $i++) {
                $dataz = array();
                $dataz['user_id'] = $id_user;
                $dataz['game'] = $id_game;
                $dataz['id_crit'] = $id_har[$i];
                $dataz['val_crit_text'] = $four[$i];
                $this->db->insert('achi', $dataz);
            }
            for ($i = 2; $i < 4; $i++) {
                $dataz['val_crit_text'] = 0;
                $dataz['id_crit'] = $id_har[$i];
                $dataz['val_crit'] = $four[$i];
                $this->db->insert('achi', $dataz);
            }
        }
        if ($id_game == 5) {
            $id_har = $this->input->post('id_har');
            $five = $this->input->post('five');
            $dataz = array();
            $dataz['user_id'] = $id_user;
            $dataz['game'] = $id_game;
            $dataz['id_crit'] = $id_har[0];
            $dataz['val_crit_text'] = $five[0];
            $this->db->insert('achi', $dataz);
            for ($i = 1; $i < 3; $i++) {
                $dataz['id_crit'] = $id_har[$i];
                $dataz['val_crit'] = $five[$i];
                $this->db->insert('achi', $dataz);
            }
        }
        if ($id_game == 6) {
            $id_har = $this->input->post('id_har');
            $six = $this->input->post('six');
            $dataz = array();
            $dataz['user_id'] = $id_user;
            $dataz['game'] = $id_game;
            $dataz['id_crit'] = $id_har[0];
            $dataz['val_crit_text'] = $six[0];
            $this->db->insert('achi', $dataz);
            for ($i = 1; $i < 4; $i++) {
                $dataz['id_crit'] = $id_har[$i];
                $dataz['val_crit'] = $six[$i];
                $this->db->insert('achi', $dataz);
            }
        }
        if ($id_game == 7) {
            $id_har = $this->input->post('id_har');
            $seven = $this->input->post('seven');
            $dataz = array();
            $dataz['user_id'] = $id_user;
            $dataz['game'] = $id_game;
            $dataz['id_crit'] = $id_har[0];
            $dataz['val_crit_text'] = $seven[0];
            $this->db->insert('achi', $dataz);
            for ($i = 1; $i < 4; $i++) {
                $dataz['id_crit'] = $id_har[$i];
                $dataz['val_crit'] = $seven[$i];
                $this->db->insert('achi', $dataz);
            }
        }
    }

    public function edit_ach()
    {
        $this->load->model('lang_model');
        $datas['lang'] = $this->lang_model->index($this->input->post('lang'));
        $id_ach = $this->input->post('id_ach');
        $this->load->model('privat_model');
        $data = $this->privat_model->ed_ach($id_ach);
        echo '<script>
		jQuery(function(){			
		jQuery("select").selectbox();
		});
	</script><div class="privat8_edit_game">
                                        <select class="eda">';
        $query = $this->db->get('favorite_games');
        foreach ($query->result() as $game) {
            if ($game->games_id == $data[0]->game) {
                echo "<option value='" . $game->games_id . "' selected='selected'>" . $game->games_name . "</option>";
            }
            echo "<option value='" . $game->games_id . "'>" . $game->games_name . "</option>";
        }

        echo '                      </select>
                                    </div>
                                    <input class="privat8_text ed_text" type="text" id="ed_text" placeholder="' . $this->lang->line('inf_game') . '" value="' . $data[0]->game_info . '">
                                    <input class="privat8_button2 ed" type="button" name="" data-edit="' . $id_ach . '" value="' . $this->lang->line('save') . '">';
        echo " <script>$('.ed').click(function(){
                        var id_ach = $(this).data('edit');
                    $.ajax({
                            url: '/privat/save_ed_ach',
                            method: 'POST',
                            data: {id_ach:id_ach, id_game:$('.eda').val(), text:$('.ed_text').val()},
                            success: function () {
                              location.reload();
                            }
                        });
                })</script>";
    }

    public function save_ed_ach()
    {
        $id_ach = $this->input->post('id_ach');
        $id_game = $this->input->post('id_game');
        $text = $this->input->post('text');
        $data = array('game' => $id_game, 'game_info' => $text);
        $this->db->where('id_achi', $id_ach);
        $this->db->update('achi', $data);
    }

    public function del_ach()
    {
        $id_ach = $this->input->post('id_ach');

        $this->db->where('game', $id_ach);
        $this->db->delete('achi');
    }

    /*-------------------  вывод полей достижений для заполнения ---------------------*/
    public function sel_ach()
    {
        $this->load->model('lang_model');
        $datas['lang'] = $this->lang_model->index($this->input->post('lang'));
        $id_game = $this->input->post('id_ach');
        $this->db->select('*');
        $this->db->from('har_value');
        $this->db->where('id_ach_game', $id_game);
        $this->db->group_by('id_har');
        $res = $this->db->get();
        $z = $this->db->get('ach_game_har');
        $x = $z->result();

        if ($id_game == 1) {
            foreach ($res->result() as $val) {

                $this->db->where('id_har', $val->id_har);
                $this->db->group_by('id_har');
                $q = $this->db->get('ach_game_har');

                $w = $q->result();
                $this->db->where('id_har', $w[0]->id_har);
                $this->db->where('id_ach_game', $id_game);
                $e = $this->db->get('har_value');

                echo "<div style='color:white;margin-right:15px; '>";
                if ($datas['lang'] == 'en') {
                    echo $w[0]->har_en;
                } else {
                    echo $w[0]->har;
                }
                echo "<input type='hidden' value='" . $w[0]->id_har . "' name='id_har[]'></div>";
                echo "<select name='first[]' class='first'>";
                foreach ($e->result() as $wq) {
                    if ($datas['lang'] == 'en') {
                        echo "<option value='" . $wq->id_val . "'>" . $wq->value_en . "</option>";
                    } else {
                        echo "<option value='" . $wq->id_val . "'>" . $wq->value . "</option>";
                    }
                }
                echo '</select>';
            }
        }
        if ($id_game == 2) {

            foreach ($res->result() as $val) {

                echo "<div style='color:white;margin-right:15px;' >";
                if ($datas['lang'] == 'en') {
                    echo $x[3]->har_en;
                } else {
                    echo $x[3]->har;
                }
                echo "<input type='hidden' value='" . $x[3]->id_har . "' name='id_har[]'></div><input type='text' value='' name='second[]'><div style='color:white;margin-right:15px;' >";
                if ($datas['lang'] == 'en') {
                    echo $x[4]->har_en;
                } else {
                    echo $x[4]->har;
                }
                echo "<input type='hidden' value='" . $x[4]->id_har . "' name='id_har[]'></div><input type='text' value='' name='second[]'><div style='color:white;margin-right:15px;' >";
                if ($datas['lang'] == 'en') {
                    echo $x[6]->har_en;
                } else {
                    echo $x[6]->har;
                }
                echo "<input type='hidden' value='" . $x[6]->id_har . "' name='id_har[]'></div><input type='text' value='' name='second[]'>";


                $this->db->where('id_har', $val->id_har);
                $this->db->group_by('id_har');
                $q = $this->db->get('ach_game_har');

                $w = $q->result();
                $this->db->where('id_har', $w[0]->id_har);
                $this->db->where('id_ach_game', $id_game);
                $e = $this->db->get('har_value');

                echo "<div style='color:white;margin-right:15px; '>";
                if ($datas['lang'] == 'en') {
                    echo $w[0]->har_en;
                } else {
                    echo $w[0]->har;
                }
                echo "</div>";
                echo "<input type='hidden' value='" . $w[0]->id_har . "' name='id_har[]'><select name='second[]'>";
                foreach ($e->result() as $wq) {
                    echo "<option value='" . $wq->id_val . "'>";
                    if ($datas['lang'] == 'en') {
                        echo $wq->value_en;
                    } else {
                        echo $wq->value;
                    }
                    echo "</option>";
                }
                echo '</select>';
            }
        }
        if ($id_game == 3) {

            foreach ($res->result() as $val) {

                echo "<div style='color:white;margin-right:15px;' >";
                if ($datas['lang'] == 'en') {
                    echo $x[7]->har_en;
                } else {
                    echo $x[7]->har;
                }
                echo "<input type='hidden' value='" . $x[7]->id_har . "' name='id_har[]'></div><input type='text' value='' name='third[]'><div style='color:white;margin-right:15px;' >";
                if ($datas['lang'] == 'en') {
                    echo $x[8]->har_en;
                } else {
                    echo $x[8]->har;
                }
                echo "<input type='hidden' value='" . $x[8]->id_har . "' name='id_har[]'></div><input type='text' value='' name='third[]'><div style='color:white;margin-right:15px;' >";
                if ($datas['lang'] == 'en') {
                    echo $x[9]->har_en;
                } else {
                    echo $x[9]->har;
                }
                echo "<input type='hidden' value='" . $x[9]->id_har . "' name='id_har[]'></div><input type='text' value='' name='third[]'>";
                echo "<div style='color:white;margin-right:15px;' >";
                if ($datas['lang'] == 'en') {
                    echo $x[10]->har_en;
                } else {
                    echo $x[10]->har;
                }
                echo "<input type='hidden' value='" . $x[10]->id_har . "' name='id_har[]'></div><input type='text' value='' name='third[]'>";


                $this->db->where('id_har', $val->id_har);
                $this->db->group_by('id_har');
                $q = $this->db->get('ach_game_har');

                $w = $q->result();
                $this->db->where('id_har', $w[0]->id_har);
                $this->db->where('id_ach_game', $id_game);
                $e = $this->db->get('har_value');

                echo "<div style='color:white;margin-right:15px; '>";
                if ($datas['lang'] == 'en') {
                    echo $x[11]->har_en;
                } else {
                    echo $x[11]->har;
                }
                echo "</div>";
                echo "<input type='hidden' value='" . $x[11]->id_har . "' name='id_har[]'><select name='third[]'>";
                foreach ($e->result() as $wq) {
                    echo "<option value='" . $wq->id_val . "'>";
                    if ($datas['lang'] == 'en') {
                        echo $wq->value_en;
                    } else {
                        echo $wq->value;
                    }
                    echo "</option>";
                }
                echo '</select>';
            }
        }
        if ($id_game == 4) {
            echo "<div style='color:white;margin-right:15px;' >";
            if ($datas['lang'] == 'en') {
                echo $x[12]->har_en;
            } else {
                echo $x[12]->har;
            }
            echo "<input type='hidden' value='" . $x[12]->id_har . "' name='id_har[]'></div><input type='text' value='' name='four[]'><div style='color:white;margin-right:15px;' >";
            if ($datas['lang'] == 'en') {
                echo $x[13]->har_en;
            } else {
                echo $x[13]->har;
            }
            echo "<input type='hidden' value='" . $x[13]->id_har . "' name='id_har[]'></div><input type='text' value='' name='four[]'>";
            foreach ($res->result() as $val) {

                $this->db->where('id_har', $val->id_har);
                $this->db->group_by('id_har');
                $q = $this->db->get('ach_game_har');

                $w = $q->result();

                $this->db->where('id_har', $w[0]->id_har);
                $this->db->where('id_ach_game', $id_game);
                $e = $this->db->get('har_value');

                echo "<div style='color:white;margin-right:15px; '>";
                if ($datas['lang'] == 'en') {
                    echo $w[0]->har_en;
                } else {
                    echo $w[0]->har;
                }
                echo "</div>";
                echo "<input type='hidden' value='" . $w[0]->id_har . "' name='id_har[]'><select name='four[]'>";
                foreach ($e->result() as $wq) {
                    echo "<option value='" . $wq->id_val . "'>";
                    if ($datas['lang'] == 'en') {
                        echo $wq->value_en;
                    } else {
                        echo $wq->value;
                    }
                    echo "</option>";
                }
                echo '</select>';
            }
        }
        if ($id_game == 5) {

            echo "<div style='color:white;margin-right:15px;' >";
            if ($datas['lang'] == 'en') {
                echo $x[15]->har_en;
            } else {
                echo $x[15]->har;
            }
            echo "<input type='hidden' value='" . $x[15]->id_har . "' name='id_har[]'></div><input type='text' value='' name='five[]'>";
            foreach ($res->result() as $val) {

                $this->db->where('id_har', $val->id_har);
                $this->db->group_by('id_har');
                $q = $this->db->get('ach_game_har');
                //print_r($this->db->queries);
                $w = $q->result();

                $this->db->where('id_har', $w[0]->id_har);
                $this->db->where('id_ach_game', $id_game);
                $e = $this->db->get('har_value');

                echo "<div style='color:white;margin-right:15px; '>";
                if ($datas['lang'] == 'en') {
                    echo $w[0]->har_en;
                } else {
                    echo $w[0]->har;
                }
                echo "</div>";
                echo "<input type='hidden' value='" . $w[0]->id_har . "' name='id_har[]'><select name='five[]'>";
                foreach ($e->result() as $wq) {
                    echo "<option value='" . $wq->id_val . "'>";
                    if ($datas['lang'] == 'en') {
                        echo $wq->value_en;
                    } else {
                        echo $wq->value;
                    }
                    echo "</option>";
                }
                echo '</select>';
            }
        }
        /*---------------------------------------------------------------------------------------*/
        if ($id_game == 6) {

            echo "<div style='color:white;margin-right:15px;' >";
            if ($datas['lang'] == 'en') {
                echo $x[12]->har_en;
            } else {
                echo $x[12]->har;
            }
            echo "<input type='hidden' value='" . $x[12]->id_har . "' name='id_har[]'></div><input type='text' value='' name='six[]'>";
            foreach ($res->result() as $val) {

                $this->db->where('id_har', $val->id_har);
                $this->db->group_by('id_har');
                $q = $this->db->get('ach_game_har');
                //print_r($this->db->queries);
                $w = $q->result();

                $this->db->where('id_har', $w[0]->id_har);
                $this->db->where('id_ach_game', $id_game);
                $e = $this->db->get('har_value');

                echo "<div style='color:white;margin-right:15px; '>";
                if ($datas['lang'] == 'en') {
                    echo $w[0]->har_en;
                } else {
                    echo $w[0]->har;
                }
                echo "</div>";
                echo "<input type='hidden' value='" . $w[0]->id_har . "' name='id_har[]'><select name='six[]'>";
                foreach ($e->result() as $wq) {
                    echo "<option value='" . $wq->id_val . "'>";
                    if ($datas['lang'] == 'en') {
                        echo $wq->value_en;
                    } else {
                        echo $wq->value;
                    }
                    echo "</option>";
                }
                echo '</select>';
            }
        }
        if ($id_game == 7) {

            echo "<div style='color:white;margin-right:15px;' >";
            if ($datas['lang'] == 'en') {
                echo $x[12]->har_en;
            } else {
                echo $x[12]->har;
            }
            echo "<input type='hidden' value='" . $x[12]->id_har . "' name='id_har[]'></div><input type='text' value='' name='seven[]'>";
            foreach ($res->result() as $val) {

                $this->db->where('id_har', $val->id_har);
                $this->db->group_by('id_har');
                $q = $this->db->get('ach_game_har');
                //print_r($this->db->queries);
                $w = $q->result();

                $this->db->where('id_har', $w[0]->id_har);
                $this->db->where('id_ach_game', $id_game);
                $e = $this->db->get('har_value');

                echo "<div style='color:white;margin-right:15px; '>";
                if ($datas['lang'] == 'en') {
                    echo $w[0]->har_en;
                } else {
                    echo $w[0]->har;
                }
                echo "</div>";
                echo "<input type='hidden' value='" . $w[0]->id_har . "' name='id_har[]'><select name='seven[]'>";
                foreach ($e->result() as $wq) {
                    echo "<option value='" . $wq->id_val . "'>";
                    if ($datas['lang'] == 'en') {
                        echo $wq->value_en;
                    } else {
                        echo $wq->value;
                    }
                    echo "</option>";
                }
                echo '</select>';
            }
        }
    }

    public function creat_clan($param)
    {
        $data['title'] = 'Everyplayer - Privat Creat Clan';
        $this->load->model('home_model');
        $this->load->model('privat_model');

        $data['lang'] = $this->dataz['lang'];
        $arr = array('side' => $this->uri->segment(2));
        $this->session->set_userdata($arr);
        $data['month_array_en'] = $this->dataz['month_array_en'];
        $data['month_array_rus'] = $this->dataz['month_array_rus'];

        $id_boss = $this->session->userdata('id');
        $data['slider'] = $this->home_model->get_slider();

        //$data['clans'] = $this->privat_model->get_clans($id_boss);

        $this->load->view('header', $data);
        $this->load->view('heading', $data);
        $this->load->view('privat/creat_clan', $data);
        $this->load->view('footer', $data);
    }

    public function img_cla()
    {
        $config['upload_path'] = './images/clans/';
        $config['allowed_types'] = 'png|jpg';
        $this->load->library('upload');
        $this->upload->initialize($config);

        if (!$this->upload->do_upload()) {
            $error = array('error' => $this->upload->display_errors());
            echo $error['error'];
        } else {
            $data = array('upload_data' => $this->upload->data());
            $path = array("path" => $data['upload_data']['file_name']);
        }
        echo json_encode($path);
    }

    public function save_clan($param)
    {
        $user_id = $param;
        $name_clan = $this->input->post('name_clan');
        $opisanie_clan = $this->input->post('opisanie_clan');
        $game = $this->input->post('game');

        $this->load->model('lang_model');
        $datas['lang'] = $this->lang_model->index();
        $path = $this->input->post('path');
        $ar = explode('\\', $path);
        $path = $ar[2];


        $this->load->model('privat_model');
        $this->privat_model->save_clan($user_id, $path, $game, $name_clan, $opisanie_clan, $datas['lang']);

        redirect(base_url() . $datas['lang'] . '/' . $this->session->userdata('side') . '/privat_clans/' . $user_id, 'refresh');
    }

    public function premium($param)
    {

        $data['title'] = 'Everyplayer - Privat Subscription';
        $this->load->model('home_model');
        $this->load->model('privat_model');
        $data['lang'] = $this->dataz['lang'];
        $arr = array('side' => $this->uri->segment(2));
        $this->session->set_userdata($arr);
        $data['month_array_en'] = $this->dataz['month_array_en'];
        $data['month_array_rus'] = $this->dataz['month_array_rus'];
        //$data['gmt'] = $this->players_model->get_gmt();
        $data['slider'] = $this->home_model->get_slider();
        $data['prem'] = $this->privat_model->get_prem();
        $this->load->view('header', $data);
        $this->load->view('heading', $data);
        $this->load->view('privat/premium', $data);
        $this->load->view('footer', $data);
    }

    public function in_prem()
    {
        $user = $this->input->post('id_user');
        $prem = $this->input->post('prem');
        $now = time();
        $datas_month = $now + (30 * 86400);
        $datas_half = $now + (183 * 86400);
        $datas_year = $now + (365 * 86400);
        $datas_month = date('Y-m-d h:i:s', $datas_month);
        $datas_half = date('Y-m-d h:i:s', $datas_half);
        $datas_year = date('Y-m-d h:i:s', $datas_year);
        if ($prem == 1) {
            $dat = array('data_premium' => $datas_month, 'premium' => 1);
            $this->db->where('user_id', $user);
            $this->db->update('users', $dat);
        }
        if ($prem == 6) {
            $dat = array('data_premium' => $datas_half, 'premium' => 1);
            $this->db->where('user_id', $user);
            $this->db->update('users', $dat);
        }
        if ($prem == 12) {
            $dat = array('data_premium' => $datas_year, 'premium' => 1);
            $this->db->where('user_id', $user);
            $this->db->update('users', $dat);
        }
    }

    public function in_top()
    {
        $user = $this->input->post('id_user');
        $prem = $this->input->post('top');
        $end_time = $this->input->post('end_time');
        $now = time();
        $end_times = $now + ($end_time * 86400);
        $end_timess = date('Y-m-d h:i:s', $end_times);

        $dat = array('top' => 1, 'data_top' => $end_timess);
        $this->db->where('user_id', $user);
        $this->db->update('users', $dat);

        $this->db->where('id_user', $user);
        $get = $this->db->get('golden');
        $ge = $get->result();
        $old = $ge[0]->count_gold;
        $new = $old - $prem;
        $da = date('Y-m-d h:i:s', time());
        $dats = array('count_gold' => $new, 'datas' => $da);
        $this->db->where('id_user', $user);
        $this->db->update('golden', $dats);
    }
}
