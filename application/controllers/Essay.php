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
        $essay_count = $this->Essay_model->get_count(array('active' => 1));
        $data['total_page'] = intval(ceil($essay_count / 10));
        if (($data['total_page'] > 0 && $page > $data['total_page']) || $page < 1) {
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
                $this->load->library('functions');
                $content = $this->functions->filter_content($content);
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

    //文章详情页，如果是独立文章则直接显示文章内容，是章节文章显示章节 2021.3.9
    public function info($id = 0)
    {
        $data['active_navbar'] = "navbar-essay";
        if ($id <= 0) {
            show_404();
        } else {
            $this->load->model('Essay_model');
            //是否有权限查看文章（是否是管理员，文章是否公开）
            $data['essay_info'] = $this->Essay_model->get_essay($id);
            $pri = $this->session->userdata('user_pri');
            if ($pri <> 0) {
                if (count($data['essay_info']) > 0 && $data['essay_info']['active'] <> 1) {
                    show_error("暂无内容，文章被设为隐藏，或者你无权查看。");
                    return;
                }
            }

            //获取一个文章的章节数
            $data['chapter_num'] = $this->Essay_model->get_chapter_num(array('essay_id' => $id, 'active' => 1));
            if ($data['chapter_num'] == 1) {

                $data['essay_content'] = $this->Essay_model->get_first_chapter($id);
                if ($pri <> 0 && $data['essay_content']['active'] <> 1) {
                    show_error("暂无内容，文章被设为隐藏，或者你无权查看。");
                    return;
                }

                $this->load->view('essay/chapter_content', $data);

            } else if ($data['chapter_num'] > 1) {

            }

        }
    }

}
