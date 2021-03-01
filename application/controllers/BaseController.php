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

        //登录状态检测
        log_message('info', "【info】session user_id:" . $this->session->userdata('user_id'));
        if (!$this->session->has_userdata('user_id')) {
            $userdata = $this->input->cookie(array('harbour_user_id', 'harbour_user_email'));
//            log_message('info', "【info】cookie data:" . json_encode($userdata));
            if ($userdata['harbour_user_id'] && $userdata['harbour_user_email']) {
                $this->load->library('encrypt');
                $user_id = $this->encrypt->decode($userdata['harbour_user_id']);
                $email = $this->encrypt->decode($userdata['harbour_user_email']);
                log_message('info', "【info】decoded cookie data:" . $user_id . " " . $email);
                //校验cookie用户信息是否有效
                $this->load->model('User_model');
                $row = $this->User_model->query_cookie_user($user_id, $email);
                log_message('info', "【info】check cookie data:" . json_encode($row));
                //用cookie信息更新session用户会话信息
                if ($row) {
                    $userdata = array(
                        'user_id' => $row->id,
                        'user_name' => $row->username,
                        'user_email' => $row->email,
                        'user_is_verify' => $row->is_verify,
                        'user_pri' => $row->priority
                    );
                    $this->session->set_userdata($userdata);
                }
            }
        }
    }
}