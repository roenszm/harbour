<?php
/**
 * Created by PhpStorm.
 * User: roens
 * Time: 2018-1-15 09:58:29
 */

defined('BASEPATH') OR exit('No direct script access allowed');

class Essay extends CI_Controller {

    public function __construct() {
        parent::__construct();

    }
    //文字首页
    public function index() {
        $this->load->model("Essay_model");
        $data['active_navbar'] = "navbar-essay";
        $data['essay_list'] = $this->Essay_model->get_list(20,1,array());
        $this->load->view('essay/index',$data);
    }
    //文字编写页
    public function add_page() {
        $data['active_navbar'] = "navbar-essay";
        $this->load->view('essay/publish',$data);
    }
    //保存文章
    public function save() {
        $this->load->model("Essay_model");
        $ret = $this->Essay_model->save_record();
        log_message("info",json_encode($ret));
        echo json_encode($ret);
    }
}
