<?php
/**
 * Created by PhpStorm.
 * User: zhaomin
 * Date: 2015/8/4
 * Time: 17:54
 */
defined('BASEPATH') OR exit('No direct script access allowed');

class Index extends CI_Controller {

    /**
     * Index Page for this controller.
     *
     * Maps to the following URL
     * 		http://example.com/index.php/welcome
     *	- or -
     * 		http://example.com/index.php/welcome/index
     *	- or -
     * Since this controller is set as the default controller in
     * config/routes.php, it's displayed at http://example.com/
     *
     * So any other public methods not prefixed with an underscore will
     * map to /Index.php/welcome/<method_name>
     * @see http://codeigniter.com/user_guide/general/urls.html
     */

    public function __construct() {
        parent::__construct();
        $this->load->helper('url');
    }
    public function index($r=2) {
        $data['r'] = $r;
        $this->load->view('main/index',$data);
    }
}
