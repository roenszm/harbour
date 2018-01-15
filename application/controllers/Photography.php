<?php
/**
 * Created by PhpStorm.
 * User: zhaomin
 * Time: 2018-1-15 09:58:29
 */

defined('BASEPATH') OR exit('No direct script access allowed');

class Photography extends CI_Controller {

    public function __construct() {
        parent::__construct();

    }
    public function index() {
        $data['active_navbar'] = "navbar-photography";
        $this->load->view('photography/index',$data);
    }
}
