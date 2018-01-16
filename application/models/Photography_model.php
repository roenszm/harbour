<?php
/**
 * Created by PhpStorm.
 * User: roens
 * Date: 2018/1/17 0017
 * Time: 01:34
 */
class Photography_model extends CI_Model {


    public function get_last_ten_entries()
    {
        $query = $this->db->get('entries', 10);
        return $query->result();
    }

}