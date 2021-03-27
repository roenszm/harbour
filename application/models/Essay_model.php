<?php

/**
 * Created by PhpStorm.
 * User: roens
 * Date: 2018-6-16 16:51:44
 */
class Essay_model extends CI_Model
{
    //获取文章列表页
    /*
     * @param: per_page 每页数量
     * @param: page 查询页数，从1开始
     * @param: params 查询参数及条件 array()
     */
    public function get_list($per_page, $page, $params)
    {
        $sql = "select e.id, e.title, e.subtitle, u.username, e.user_id, e.type, e.category_id, ec.`name` category_name,
                case
                when timestampdiff(second, e.update_time, now()) < 60 then '刚刚'
                when timestampdiff(second, e.update_time, now()) < (60*60) then concat(round(timestampdiff(second, e.update_time, now())/60),\"分钟前\")
                when timestampdiff(second, e.update_time, now()) < (24*60*60) then concat(round(timestampdiff(second, e.update_time, now())/(60*60)),\"小时前\")
                when timestampdiff(second, e.update_time, now()) < (7*24*60*60) then concat(round(timestampdiff(second, e.update_time, now())/(24*60*60)),\"天前\")
                else e.update_time 
				end status_time
                from essay_info e
                left join user u on u.id=e.user_id
                left join essay_category ec on e.category_id=ec.id
                where e.active=1
                order by e.update_time desc";
        if ($page < 1) {
            $page = 1;
        }
        $offset = ($page - 1) * $per_page;
        $limit = $per_page;
        $sql .= " limit " . $offset . "," . $limit;
        //echo $sql;
        $query = $this->db->query($sql);
        return $query->result_array();

    }

    //获取条件下的文章总数
    public function get_count($params)
    {
        $this->db->where($params);
        return $this->db->count_all_results('essay_info');

    }

    //获取文章分类
    public function get_category()
    {
        return $this->db->get('essay_category')->result_array();
    }

    //保存一篇新独立文章
    public function save_new($params)
    {
        $datetime = date('Y-m-d H:i:s');
        $essay = array(
            'user_id' => $params['user_id'],
            'title' => $params['title'],
            'subtitle' => $params['subtitle'],
            'create_time' => $datetime,
            //'modify_time' => $datetime,
            'update_time' => $datetime,
            'type' => $params['type'],
            'category_id' => $params['category'],
            'active' => $params['active']
        );
        if ($params['active'] == 1) {
            $essay['publish_time'] = $datetime;
            $essay['recent_publish_time'] = $datetime;
        }
        //要分别写入两表，采用事务，任意一张表发生写入错误时即回滚
        $this->db->trans_start();
        if (!$this->db->insert("essay_info", $essay)) {
            $err = $this->db->error();
            log_message("error", "【DBerror】code:" . $err["code"] . ";message:" . $err["message"]);
            $ret = array(
                "err_code" => $err["code"],
                "err_msg" => "保存文章失败！"
            );
        } else {
            $essay_id = $this->db->insert_id();
            $chapter = array(
                'essay_id' => $essay_id,
                'chapter_title' => $params['title'],
                'chapter_subtitle' => $params['subtitle'],
                'chapter_content' => $params['content'],
                'create_time' => $datetime,
                //'modify_time' => $datetime,
                'active' => $params['active'],
                'user_id' => $params['user_id'],
                'index' => 1
            );
            if ($params['active'] == 1) {
                $chapter['publish_time'] = $datetime;
                $chapter['recent_publish_time'] = $datetime;
            }
            if (!$this->db->insert("essay_chapter", $chapter)) {
                $err = $this->db->error();
                log_message("error", "【DBerror】code:" . $err["code"] . ";message:" . $err["message"]);
                $ret = array(
                    "err_code" => $err["code"],
                    "err_msg" => "保存文章失败！"
                );
            } else {
                $chapter_id = $this->db->insert_id();
                $ret = array(
                    "err_code" => 0,
                    "err_msg" => "保存文章成功！",
                    "id" => $chapter_id
                );
            }
        }
        $this->db->trans_complete();
        return $ret;

    }

    //获取essay_info文章的章节数
    public function get_chapter_num($params)
    {
        $this->db->where($params);
        return $this->db->count_all_results("essay_chapter");
    }

    //按照id获得essay_info的一条记录
    public function get_essay($id)
    {
        $sql = "select e.*, ec.`name` category_name, u.username
                from essay_info e
                left join essay_category ec on ec.id = e.category_id
                left join user u on u.id = e.user_id
                where e.id=" . $id;
        $query = $this->db->query($sql);
        return $query->row_array();
    }

    //获取essay_id的第一篇chapter详细内容
    public function get_first_chapter($id)
    {
        $sql = "select ec.*, u.username
                from essay_chapter ec
                left join user u on u.id = ec.user_id
                where ec.`index`=1 and ec.essay_id=".$id;
        $query = $this->db->query($sql);
        return $query->row_array();

    }

    //获取章节文章的文章章节信息,不包含章节内容
    public function get_chapter_info($id)
    {

    }

}