<?php
/**
 * Created by PhpStorm.
 * User: Roens
 * Date: 2021/2/28 0028
 * Time: 21:17
 */

defined('BASEPATH') OR exit('No direct script access allowed');

/*
 * 用于放置一些所有请求都需要处理的逻辑，例如登录状态检测
 * */

class BaseController extends CI_Controller
{

    public function __construct()
    {
        parent::__construct();
        log_message('info', "【info】session user_id:" . $this->session->userdata('user_id'));
        //登录状态检测
        if (!$this->session->has_userdata('user_id')) {
            $userdata = $this->input->cookie(array('harbour_user_id', 'harbour_user_email'));
            log_message('info', "【info】cookie data:" . json_encode($userdata));

            /*if (get_cookie('effecthub_user')&&get_cookie('effecthub_password')) {
                $user = $this->encrypt->decode(get_cookie('effecthub_user'));
                $password = $this->encrypt->decode(get_cookie('effecthub_password'));
                $this->load->model('user_model');
                $this->user_model->id = $user;
                $this->user_model->password = $password;
                $valid_user = $this->user_model->check_user_login();
                if ($valid_user!==null) {
                    $this->session->set_userdata($valid_user);
                }
            }*/
        }
    }
}