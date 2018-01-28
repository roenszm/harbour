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
        $data['active_navbar'] = "navbar-essay";
        $this->load->view('essay/index',$data);
    }
    //文字编写页
    public function add_page() {
        $data['active_navbar'] = "navbar-essay";
        $this->load->view('essay/new',$data);
    }
}
