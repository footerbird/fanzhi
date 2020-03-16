<?php
class Advert_model extends CI_Model {
    
    public function __construct()
    {
        parent::__construct();
    }
    
    public function get_advertList($start,$length){//广告列表页面,输出前$length条数
        $sql = "select * from advert_info"
            ." where 1 = 1 ";
        $sql = $sql." order by create_time desc limit ".$start.",".$length;
        $query = $this->db->query($sql);
        return $query->result();
    }
    
    public function get_advertCount(){//广告总数
        $sql = "select count(*) as total from advert_info";
        $query = $this->db->query($sql);
        return $query->row()->total;
    }
    
    public function get_advertDetail($ad_id){//广告详情页面,传入ad_id
        $sql = "select * from advert_info where ad_id = ".$ad_id;
        $query = $this->db->query($sql);
        return $query->row();
    }
    
    public function add_advertOne($ad_name,$author_id,$ad_desc,$ad_type,$ad_address,$video_poster,$ad_link,$ad_status,$ad_remark,$create_time,$deadline_time){//新增一条广告记录
        $sql = "insert into advert_info(ad_name,author_id,ad_desc,ad_type,ad_address,video_poster,ad_link,ad_status,ad_remark,create_time,deadline_time"
            .")values('".$ad_name."','".$author_id."','".$ad_desc."','".$ad_type."','".$ad_address."','".$video_poster."','".$ad_link."','".$ad_status."','".$ad_remark."','".$create_time."','".$deadline_time."')";
        $query = $this->db->query($sql);
        return $query;
    }
    
    public function edit_advertOne($ad_id,$ad_name,$author_id,$ad_desc,$ad_type,$ad_address,$video_poster,$ad_link,$ad_status,$ad_remark,$create_time,$deadline_time){//修改广告信息
        $sql = "update advert_info set"
            ." ad_name='".$ad_name
            ."', author_id='".$author_id
            ."', ad_desc='".$ad_desc
            ."', ad_type='".$ad_type
            ."', ad_address='".$ad_address
            ."', video_poster='".$video_poster
            ."', ad_link='".$ad_link
            ."', ad_status='".$ad_status
            ."', ad_remark='".$ad_remark
            ."', create_time='".$create_time
            ."', deadline_time='".$deadline_time
            ."' where ad_id=".$ad_id;
        $query = $this->db->query($sql);
        return $query;
    }
    
    public function del_advertOne($ad_id){//删除广告信息
        $sql = "delete from advert_info"
            ." where ad_id=".$ad_id;
        $query = $this->db->query($sql);
        return $query;
    }
    
}
?>