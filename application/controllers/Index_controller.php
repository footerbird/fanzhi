<?php
class Index_controller extends CI_Controller {
    
    public function __construct()
    {
        parent::__construct();
        // Your own constructor code
        if(in_array($_SERVER["REMOTE_ADDR"],$this->config->item('forbid_ips'))){
            die("Your IP Address is forbiden to view this page!");
        }
    }
    
    public function index(){//亚色主页
        //加载广告模型类
        $this->load->model('mobile/Advert_model','advert');
        //get_advertList方法得到广告列表
        $advert_list = $this->advert->get_advertList(0,10);
        $data['advert_list'] = $advert_list;
        
        $seo = array(
            'seo_title'=>'',
            'seo_keywords'=>'',
            'seo_description'=>''
        );
        $data['seo'] = json_decode(json_encode($seo));
        
        $data['styles'] = array(
            '/htdocs/mobile/dist/css/swiper.min.css?'.CACHE_TIME,
            '/htdocs/mobile/dist/css/animate.min.css?'.CACHE_TIME
        );
        $data['scripts'] = array(
            '/htdocs/mobile/dist/js/swiper.min.js?'.CACHE_TIME,
            '/htdocs/mobile/dist/js/swiper.animate.min.js?'.CACHE_TIME,
            '/htdocs/mobile/dist/js/jquery.form.min.js?'.CACHE_TIME
        );
        
        $this->load->view('mobile/advert_list',$data);
    }

    public function get_advertAjax_tpl(){//获取新的广告信息（模板加載）
        
        $page = $this->input->get_post('page');//得到页码
        $page = $page?$page:1;
        $page_size = 1;//单页记录数
        $offset = ($page-1)*$page_size;//偏移量

        //加载广告模型类
        $this->load->model('mobile/Advert_model','advert');
        //get_advertList方法得到广告列表
        $advert_list = $this->advert->get_advertList($offset,$page_size);//获取一条广告
        $data['advert_list'] = $advert_list;
        
        $this->load->view('mobile/templete/tpl_advert',$data);
    }
    
}
?>