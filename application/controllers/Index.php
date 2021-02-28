<?php
/**
 * Created by PhpStorm.
 * User: roens
 * Date: 2015/8/4
 * Time: 17:54
 */
defined('BASEPATH') OR exit('No direct script access allowed');

class Index extends CI_Controller
{

    /**
     * Index Page for this controller.
     *
     * Maps to the following URL
     *        http://example.com/index.php/welcome
     *    - or -
     *        http://example.com/index.php/welcome/index
     *    - or -
     * Since this controller is set as the default controller in
     * config/routes.php, it's displayed at http://example.com/
     *
     * So any other public methods not prefixed with an underscore will
     * map to /Index.php/welcome/<method_name>
     * @see http://codeigniter.com/user_guide/general/urls.html
     */

    public function __construct()
    {
        parent::__construct();

    }

    public function index()
    {
        $data['active_navbar'] = "navbar-main";
        $this->load->view('main/index', $data);
    }

    //验证登录
    public function login()
    {

        $ret = array(
            "err_code" => 0,
            "err_msg" => "登录成功！"
        );
        $this->load->library("functions");
        $match = $this->functions->email_validate($this->input->post("user_email"));
        //log_message("info", "email match result:" . $match);
        if (!$match) {
            $ret = array(
                "err_code" => 1,
                "err_msg" => "邮箱格式有误，请检查！"
            );
        }

        $this->load->model("User_model");
        $row = $this->User_model->query_login_user();
        log_message("info", "【info】login check result:" . json_encode($row));
        if (!$row) {
            $ret = array(
                "err_code" => 1,
                "err_msg" => "邮箱或密码错误，请重试！"
            );
        }

        //写入session和cookie
        //保持登录则时间较长，不保持登录则时间较短
        $keep_login = ($this->input->post("keep_login")=="on"?1:0);


        echo json_encode($ret);
    }
}
