<?php
/**
 * Created by PhpStorm.
 * User: roens
 * Date: 2018/1/17 0017
 * Time: 01:34
 */
class Photography_model extends CI_Model {

    //获取十条摄影图志信息@to be done
    public function get_last_ten_entries()
    {
        $query = $this->db->get('entries', 10);
        return $query->result();
    }

}