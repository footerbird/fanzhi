<?php
class Advert_model extends CI_Model {
    
    public function __construct()
    {
        parent::__construct();
    }
    
    public function get_advertList($start,$length){//广告列表页面,输出前$length条数
        $sql = "select * from advert_info where ad_status = 1 and deadline_time > now() order by create_time desc limit ".$start.",".$length;
        $query = $this->db->query($sql);
        
        return $query->result();
    }

}
?>
