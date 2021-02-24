<?php
/**
 * Created by PhpStorm.
 * User: roens
 * Date: 2018-6-16 16:51:44
 */
class Essay_model extends CI_Model {

    //保存一篇新文章
    public function save_record() {

        log_message("debug","begin saving an essay record");
        $title = $this->input->post("title");
        $content = $this->input->post("content");
        $sub_title = $this->input->post("sub_title");
        $active = $this->input->post("active");
        //后端验证
        if (empty($title)||empty($content)) {
            log_message("error","title or content is empty");
            $ret = array(
                "err_code" => 1,
                "err_msg" => "标题或内容为空"
            );
            return $ret;
        }
        //组织插入数据
        $data = array(
            "title" => $title,
            "content" => $content,
            "sub_title"=> $sub_title,
            "active" => $active,
            "create_time" => date('Y-m-d H:i:s'),
            "update_time" => date('Y-m-d H:i:s'),
        );
        if (!$this->db->insert("essay_content",$data)) {
            $err = $this->db->error();
            log_message("error","code:".$err["code"].";message:".$err["message"]);
            $ret = array(
                "err_code" => $err["code"],
                "err_msg" => "保存文章失败！"
            );
        } else {
            $id = $this->db->insert_id();
            $ret = array(
                "err_code" => 0,
                "err_msg" => "新建文章成功！",
                "id" => $id
            );
        }
        return $ret;
    }

    //获取文章列表页
    /*
     * @param: per_page 每页数量
     * @param: page 查询页数，从1开始
     * @param: params 查询参数及条件 array()
     */
    public function get_list($per_page,$page,$params) {
        $sql = "select ec.id, ec.title, ec.sub_title, u.username,
                case
                when timestampdiff(second, ec.create_time, now()) < 60 then '刚刚'
                when timestampdiff(second, ec.create_time, now()) < (60*60) then concat('约',round(timestampdiff(second, ec.create_time, now())/60),'分钟前')
                when timestampdiff(second, ec.create_time, now()) < (24*60*60) then concat('约',round(timestampdiff(second, ec.create_time, now())/(60*60)),'小时前')
                when timestampdiff(second, ec.create_time, now()) < (7*24*60*60) then concat('约',round(timestampdiff(second, ec.create_time, now())/(24*60*60)),'天前')
                else ec.create_time
				end create_time
                from essay_content ec
                left join user u on u.id=ec.user_id
                where ec.active=1";
        if ($page < 1) {
            $page = 1;
        }
        $offset = ($page - 1) * $per_page;
        $limit = $per_page;
        $sql .= " limit ". $offset . ",". $limit;
        //echo $sql;
        $query = $this->db->query($sql);
        return $query->result_array();

    }

    //获取条件下的文章总数
    public function get_count($params){
        $this->db->where("active", 1);
        return $this->db->count_all_results("essay_content");

    }

}