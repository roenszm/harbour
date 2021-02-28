<?php

/**
 * Created by PhpStorm.
 * User: roens
 * Date: 2021/2/26 0026
 * Time: 20:41
 */
class User_model extends CI_Model
{
    //按照登录信息查找用户
    function query_login_user()
    {
        $email = $this->input->post('user_email');
        $password = $this->input->post('user_password');

        $password_md5 = md5($password);
        //log_message("info", "【info】md5 password:" . $password_md5);
        $this->db->where(array('email' => $email, 'password' => $password_md5));
        $query = $this->db->get('user');
        return $query->row();

    }


}