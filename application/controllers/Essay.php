<?php
/**
 * Created by PhpStorm.
 * User: roens
 * Time: 2018-1-15 09:58:29
 */
require('BaseController.php');

defined('BASEPATH') OR exit('No direct script access allowed');

class Essay extends BaseController
{

    public function __construct()
    {
        parent::__construct();

    }

    //文字首页
    public function index($page = 1)
    {
        $this->load->model('Essay_model');
        $data['active_navbar'] = "navbar-essay";
        $data['essay_list'] = $this->Essay_model->get_list(10, $page, array());
        $essay_count = $this->Essay_model->get_count(array());
        $data['total_page'] = intval(ceil($essay_count / 10));
        if ($page > $data['total_page']) {
            show_404();
        } else {
            $data['page'] = $page;
            log_message('info', "【info】total essay count:" . $essay_count . " total page:" . $data['total_page']);
            $this->load->view('essay/index', $data);
        }

    }

    //文字编写页
    public function add_page()
    {
        $data['active_navbar'] = "navbar-essay";
        $this->load->model('Essay_model');
        $data['essay_category'] = $this->Essay_model->get_category();

        $this->load->view('essay/publish', $data);
    }

    //保存一篇新文章  2021.3.3
    public function save()
    {
        $ret = array(
            'err_code' => 0,
            'err_msg' => "保存文章成功！"
        );

        if (!$this->session->has_userdata('user_id')) {
            $ret = array(
                'err_code' => 1,
                'err_msg' => "当前不处于登录状态！请登录后重试。"
            );
        } else {
            $user_id = $this->session->userdata('user_id');
            $title = $this->input->post('title');
            $content = $this->input->post('content');
            if (empty($title) || empty($content)) {
                //log_message("error", "title or content is empty");
                $ret = array(
                    'err_code' => 1,
                    'err_msg' => "标题或内容为空"
                );
            } else {

                $params = array(
                    'title' => $title,
                    'content' => $content,
                    'user_id' => $user_id,
                    'subtitle' => $this->input->post('sub_title'),
                    'active' => $this->input->post('active'),
                    'category' => $this->input->post('category'),
                    'type' => $this->input->post('type')
                );
                $this->load->model('Essay_model');
                $ret = $this->Essay_model->save_new($params);
            }
        }

        echo json_encode($ret);
    }
}
