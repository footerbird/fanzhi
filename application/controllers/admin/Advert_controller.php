<?php
class Advert_controller extends CI_Controller {
    
    public function __construct()
    {
        parent::__construct();
        // Your own constructor code
        if(in_array($_SERVER["REMOTE_ADDR"],$this->config->item('forbid_ips'))){
            die("Your IP Address is forbiden to view this page!");
        }
    }
    
    public function advert_list(){//广告列表
        $page = trim($this->input->get('page'));//得到页码
        if(empty($page)) $page = 1;//默认页码为1
        
        //加载广告模型类
        $this->load->model('admin/Advert_model','advert');
        //get_advertCount方法得到广告总数
        $count = $this->advert->get_advertCount();
        
        $page_size = 20;//单页记录数
        $offset = ($page-1)*$page_size;//偏移量
        switch($page){
            case 1:
                $num_links = 4;//num_links选中页右边的个数
                break;
            case 2:
                $num_links = 3;
                break;
            case ceil($count/$page_size):
                $num_links = 4;
                break;
            case ceil($count/$page_size)-1:
                $num_links = 3;
                break;
            default:
                $num_links = 2;
                break;
        }
        
        $this->load->library('pagination');
        $config['base_url'] = base_url().'admin';
        $config['total_rows'] = $count;
        $config['per_page'] = $page_size;// $pagesize每页条数
        $config['num_links'] = $num_links;//设置选中页左右两边的页数
        
        $config['full_tag_open'] = '<ul class="pagination">';
        $config['full_tag_close'] = '</ul>';
        $config['first_tag_open'] = '<li class="paginate_button first">';
        $config['first_tag_close'] = '</li>';
        $config['last_tag_open'] = '<li class="paginate_button last">';
        $config['last_tag_close'] = '</li>';
        $config['next_tag_open'] = '<li class="paginate_button next">';
        $config['next_tag_close'] = '</li>';
        $config['prev_tag_open'] = '<li class="paginate_button previous">';
        $config['prev_tag_close'] = '</li>';
        $config['num_tag_open'] = '<li class="paginate_button">';
        $config['num_tag_close'] = '</li>';
        $config['cur_tag_open'] = ' <li class="paginate_button active"><a>'; // 当前页开始样式   
        $config['cur_tag_close'] = '</a></li>'; 
        $config['first_link'] = '首页'; // 第一页显示   
        $config['last_link'] = '尾页'; // 最后一页显示   
        $config['next_link'] = '下一页'; // 下一页显示   
        $config['prev_link'] = '上一页'; // 上一页显示 
        
        $this->pagination->initialize($config);
        $data['page_count'] = $count;
        $data['page_size'] = $page_size;
        
        //get_advertList方法到广告列表信息
        $advert_list = $this->advert->get_advertList($offset,$page_size);
        $data['advert_list'] = $advert_list;
        
        $this->load->view('admin/advert_list',$data);
    }
    
    public function advert_update(){//广告编辑初始页
        
        //加载广告模型类
        $this->load->model('admin/Advert_model','advert');
        
        $ad_id = trim($this->input->get('ad_id'));//得到广告编号
        if(!empty($ad_id)){
            $data['operate'] = 'update';
            //get_advertDetail方法得到广告详情
            $advert = $this->advert->get_advertDetail($ad_id);
            if(empty($advert)){
                $heading = '404 Page Not Found';
                $message = 'The page you requested was not found.';
                show_error($message, 404, $heading );
                exit;
            }
            $data['advert'] = $advert;
        }else{
            $data['operate'] = 'add';
        }
        
        $this->load->view('admin/advert_update',$data);
    }
    
    public function advert_update_do(){//广告编辑
        
        $operate = trim($this->input->get_post('operate'));//得到操作
        $ad_id = trim($this->input->get_post('ad_id'));//广告编号
        $ad_name = trim($this->input->get_post('ad_name'));//广告标题
        $author_id = 1;//默认作者编号
        $ad_desc = trim($this->input->get_post('ad_desc'));//广告介绍
        $ad_type = trim($this->input->get_post('ad_type'));//广告类型，image/video
        $ad_address = trim($this->input->get_post('ad_address'));//广告地址
        $video_poster = trim($this->input->get_post('video_poster'));//视频海报
        $ad_link = trim($this->input->get_post('ad_link'));//广告链接
        $ad_status = trim($this->input->get_post('ad_status'));//广告状态
        $ad_remark = trim($this->input->get_post('ad_remark'));//广告备注
        $create_time = date("Y-m-d H:i:s", time());//创建时间
        $deadline_time = date("Y-m-d H:i:s", strtotime("+1 year"));//有效截止日期
        //加载广告模型类
        $this->load->model('admin/Advert_model','advert');
        if($operate == 'add'){//添加
            //add_advertOne方法添加一条广告记录
            $addStatus = $this->advert->add_advertOne($ad_name,$author_id,$ad_desc,$ad_type,$ad_address,$video_poster,$ad_link,$ad_status,$ad_remark,$create_time,$deadline_time);
            if($addStatus){
                $data['state'] = 'success';
                $data['msg'] = '添加成功';
            }else{
                $data['state'] = 'failed';
                $data['msg'] = '添加失败，请重试';
            }
        }else{//修改
            //edit_advertOne方法修改广告信息
            $updateStatus = $this->advert->edit_advertOne($ad_id,$ad_name,$author_id,$ad_desc,$ad_type,$ad_address,$video_poster,$ad_link,$ad_status,$ad_remark,$create_time,$deadline_time);
            if($updateStatus){
                $data['state'] = 'success';
                $data['msg'] = '修改成功';
            }else{
                $data['state'] = 'failed';
                $data['msg'] = '修改失败，请重试';
            }
        }
        
        echo json_encode($data);
    }
    
    public function upload_advertMaterial(){//上传广告素材
        $fileUpload = $_FILES['file'];
        $result = upload_files_temp($fileUpload,'uploads/files/advert');
        $result['url'] = '/'.$result['url'];
        echo json_encode($result);
    }
    
    public function advert_delete_do(){//广告删除
        
        $ad_id = trim($this->input->get_post('ad_id'));//广告编号
        //加载广告模型类
        $this->load->model('admin/Advert_model','advert');
        //del_advertOne方法删除一条广告记录
        $delStatus = $this->advert->del_advertOne($ad_id);
        if($delStatus){
            $data['state'] = 'success';
            $data['msg'] = '删除成功';
        }else{
            $data['state'] = 'failed';
            $data['msg'] = '删除失败，请重试';
        }
        
        echo json_encode($data);
    }
    
}
?>