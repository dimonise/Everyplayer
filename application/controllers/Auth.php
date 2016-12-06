<?php

/**
 * Description of Auth
 *
 * @author Димон
 */
class Auth extends CI_Controller {

    function __construct() {
        parent::__construct();
        $this->load->model('lang_model');
        $data['lang'] = $this->lang_model->index();
    }

    public function index() {

        $data['lang'] = $this->lang_model->index();
        $this->load->view('ci_auth/creat_user', $data);
    }

    public function creat_user_soc() {
        $data['lang'] = $this->lang_model->index();
        
        $token = $this->input->post('token');
        $this->load->library('ulogin');
        $this->load->library('uauth');
        $result = file_get_contents('http://ulogin.ru/token.php?token=' . $token .
                '&host=' . $_SERVER['HTTP_HOST']);
        $datas = $result ? json_decode($result, true) : array();
        $this->db->where('user_soc_id', $datas['uid']);
        $side = $this->session->userdata('side');
        $coun = $this->db->count_all_results('users');
        $aa = $this->db->get('users');

        if ($coun > 0) {
            foreach ($aa->result() as $val) {
                if ($datas['uid'] == $val->user_soc_id) {
                    $arr = array(
                        'user' => $val->first_name,
                        'username' => $val->username,
                        'email' => $val->email,
                        'uid' => $val->user_soc_id,
                        'id' => $val->user_id,
                        'side'=>$val->side
                    );
                    $this->session->set_userdata($arr);
                    redirect(base_url() . $data['lang'] . '/home/' . $this->session->userdata('side'), 'refresh');
                }
            }
        } else {
            $s = "1234567890!@#$%^&*()abvgdegziyklmnoprstufieABVGDEGZIYKLMNOPRSTUFIE";
            $g = substr($s, rand(0, strlen($s)), 25);

            $opt = array(
                'ip_address' => $_SERVER['REMOTE_ADDR'],
                'activation_code' => $g,
                'first_name' => $datas['first_name'],
                'last_name' => $datas['last_name'],
                'bdate' => $datas['bdate'],
                'country' => $datas['country'],
                'city' => $datas['city'],
                'sex' => $datas['sex'],
                'side' => $side,
                'email' => $datas['email'],
                'password' => md5($datas['uid']),
                'username' => $datas['nickname'],
                'user_soc_id' => $datas['uid'],
                'active' => 1,
                'side'=>$this->session->userdata('side')
            );
            $this->db->insert('users', $opt);

            redirect(base_url() . $data['lang'] . '/home/' . $side, 'refresh');
        }
    }

    public function creat_user() {
        $data['lang'] = $this->input->post('lang');
        $this->load->model('lang_model');
        $this->lang_model->index($data['lang']);

        $this->load->library('form_validation');
        $this->form_validation->set_rules('first_name', $this->lang->line('create_user_fname_label'), 'required');
        $this->form_validation->set_rules('nick', $this->lang->line('create_user_lname_label'), 'required');
        $this->form_validation->set_rules('email', $this->lang->line('create_user_email_label'), 'valid_email|required');
        $this->form_validation->set_rules('password', $this->lang->line('create_user_password_label'), 'min_length[8]|required|alpha_numeric|matches[re_pass]');
        $this->form_validation->set_rules('re_pass', $this->lang->line('create_user_password_confirm_label'), 'min_length[8]|required|alpha_numeric');



        if ($data['lang'] == 'ru') {
            $this->form_validation->set_message('required', $this->lang->line('form_validation_required'));
            $this->form_validation->set_message('matches', $this->lang->line('form_validation_matches'));
        }


        if ($this->form_validation->run() == FALSE) {

            $error = strip_tags(validation_errors());
            $res['error'] = '1';
            $res['msg'] = "ERROR \n" . $error;
            echo json_encode($res);
        } else {
//User existence check
            $side = $this->session->userdata('side');
            $this->db->where('email', $this->input->post('email'));
            $co = $this->db->count_all_results('users');
            if ($co > 0) {
                $res['error'] = '1';
                $res['msg'] = $this->lang->line('issue');
                echo json_encode($res);
//                $this->load->view('ci_auth/creat_user', $data);
            } else {
                $like_games = '';
                $lgame = $this->input->post('like_game');

                for ($i = 0; $i < count($lgame); $i++) {
                    $like_games .= $lgame[$i] . "/";
                }

                if ($data['lang']) {
                    $this->load->helper('trans_helper');
                    $username = transliterate($this->input->post('nick'));
                } else {
                    $username = $this->input->post('nick');
                }
                $s = "1234567890!@#$%^&*()abvgdegziyklmnoprstufieABVGDEGZIYKLMNOPRSTUFIE";
                $g = substr($s, rand(0, strlen($s)), 25);
                $bdate = $this->input->post('bday') . '.' . $this->input->post('bmonth') . '.' . $this->input->post('byear');
                $side = $this->session->userdata('side');
                $opt = array(
                    'ip_address' => $_SERVER['REMOTE_ADDR'],
                    'activation_code' => $g,
                    'first_name' => $this->input->post('first_name'),
                    'sex' => $this->input->post('gender'),
                    'bdate' => $bdate,
                    'country' => $this->input->post('country'),
                    'city' => $this->input->post('city'),
                    'email' => $this->input->post('email'),
                    'descr' => $this->input->post('descr'),
                    'password' => md5($this->input->post('password')),
                    'username' => $username,
                    'like_games' => $like_games,
                    'side'=>$side
                );

                $this->db->insert('users', $opt);
                //recive activation code to email user

                $to = $this->input->post('email');
                $code = base_url() . 'auth/activation/' . $g;
                $message = $this->lang->line('email_act_code') . "<br> " . $code;
				
				
                $this->email->from('everyplayer@game.com', 'Admin');
                $this->email->to($to);
                $this->email->subject('Activation account');
                $this->email->message($message);

                $this->email->send();
                $res['msg'] = $this->lang->line('go_pass');
                echo json_encode($res);
            }
        }
    }

    public function activation() {
        $code = $this->uri->segment(3);
        $this->db->where('activation_code', $code);
        $query = $this->db->get('users');

        foreach ($query->result() as $val) {
            $data = array(
                'active' => 1
            );
            $this->db->where('user_id', $val->user_id);
            $this->db->update('users', $data);
            $dat = array('id_user'=>$val->user_id, 'count_gold'=>1);
            $this->db->insert('golden', $dat);
        }
        redirect(base_url(), 'refresh');
    }

    public function checklogin() {
       
        $data['lang'] = $this->input->post('lang');
        $this->load->model('lang_model');
        $this->lang_model->index($data['lang']);
        $login = $this->input->post('email');
        $password = md5($this->input->post('password'));
        if (!empty($login) && isset($login)) {
            $this->db->where('email', $login);
            $a = $this->db->get('users');

            if ($a->num_rows() > 0) {
                foreach ($a->result() as $val) {
                    if ($val->password == $password) {
                        $arr = array(
                            'user' => $val->first_name,
                            'username' => $val->username,
                            'last_name'=> $val->last_name,
                            'email' => $val->email,
                            'uid' => $val->user_soc_id,
                            'id' => $val->user_id,
                            'lang'=>$data['lang'],
                            'side'=>$val->side
                        );
                        $this->session->set_userdata($arr);
                       
                        $ar = array(
                            'last_login' => time()
                        );
                        $this->db->where('user_id', $val->user_id);
                        $this->db->update('users', $ar);
                       redirect(base_url() . $data['lang'] . '/home/' . $this->session->userdata('side'), 'refresh');
                    } else {

                        $this->forgot_view();
                    }
                }
            } else {

                $this->forgot_view();
            }
        } else {

            $this->forgot_view();
        }
    }

    public function forgot_view() {
        $this->load->model('lang_model');
        $data['lang'] = $this->lang_model->index();
        $data['title'] = 'Everyplayer - Восстановление пароля';

//select slider
        $this->load->model('home_model');
        $data['slider'] = $this->home_model->get_slider();

//        $data['class'] = 'class="main_parol"';
        $data['side'] = $this->session->userdata('side');
        $this->load->library('Ulogin');
        $this->load->library('Uauth');

        $data['user'] = $this->ulogin->get_html();
        $data['outp'] = $this->uauth->userdata();

        $this->load->view('header', $data);
        $this->load->view('heading', $data);
        $this->load->view('forgot', $data);
        $this->load->view('footer');
    }

    public function forgot() {
        $data['lang'] = $this->input->post('lang');
        $this->load->model('lang_model');
        $this->lang_model->index($data['lang']);

        $to = $this->input->post('email');
        $this->load->library('form_validation');
        $this->form_validation->set_rules('email', $this->lang->line('create_user_email_label'), 'valid_email|required');
        if ($this->form_validation->run() != FALSE) {

            $s = "1234lmnoprstufie567890!@#KLMNOPRST$%()abvgdegziykABVGDEGZIYUFIE";

            $g = substr($s, rand(0, strlen($s)), 10);

            if (strlen($g) < 8) {
                $g = substr($s, rand(0, strlen($s)), 10);
                $this->forgot();
            } else {

                $message = $this->lang->line('email_new_password_revo') . " " . $g;
                $this->email->from('everyplayer@game.com', 'Admin');
                $this->email->to($to);
                $this->email->subject('Forgot password');
                $this->email->message($message);
                $this->email->send();

                $arr = array(
                    'password' => md5($g)
                );
                $this->db->where('email', $to);
                $this->db->update('users', $arr);

                echo "<script> alert('" . $this->lang->line('go_pass_fog') . "'); location.href='/'</script>";
            }
        }
    }

    public function logout() {
        $this->session->sess_destroy();
        redirect(base_url(), 'refresh');
    }

}
