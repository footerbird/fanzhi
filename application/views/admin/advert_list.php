<!DOCTYPE html>
<html>
<head>
<?php include_once('templete/pub_head.php') ?>
<link rel="stylesheet" href="/htdocs/admin/js/datatables/dataTables.bootstrap.css?<?php echo CACHE_TIME; ?>">
</head>
<body class="page-body">

  <div class="page-container"><!-- add class "sidebar-collapsed" to close sidebar by default, "chat-visible" to make chat appear always -->
      
    <?php include_once('templete/sidebar.php') ?>
    
    <div class="main-content">
      
      <?php include_once('templete/navbar.php') ?>
      
      <div class="page-title">
        
        <div class="title-env">
          <h1 class="title">广告列表</h1>
        </div>
        
          <div class="breadcrumb-env">
          
            <ol class="breadcrumb bc-1">
              <li><a href="<?php echo base_url(); ?>/admin"><i class="fa-home"></i>首页</a></li>
              <li><a href="<?php echo base_url(); ?>/admin">广告管理</a></li>
              <li class="active"><strong>广告列表</strong></li>
            </ol>
                
        </div>
          
      </div>
      <!-- Table Styles -->
      <div class="row">
        <div class="col-md-12">
        
          <div class="panel panel-default">
            
            <div class="panel-body">
              
              <div class="dataTables_wrapper form-inline dt-bootstrap">
                
                <div class="row">
                  <div class="col-xs-12">
                      <a href="<?php echo base_url(); ?>/admin/advert_update" class="btn btn-secondary btn-sm fl-r ml20">添加广告</a>
                  </div>
                </div>
                
                <table cellspacing="0" class="table table-small-font table-bordered table-striped">
                  <thead>
                    <tr>
                      <th data-priority="1">编号</th>
                      <th data-priority="1">类型</th>
                      <th data-priority="1">介绍</th>
                      <th data-priority="1">点击链接</th>
                      <th data-priority="1">广告状态</th>
                      <th data-priority="1">创建时间</th>
                      <th data-priority="1">操作</th>
                    </tr>
                  </thead>
                  <tbody class="middle-align">
                    <?php foreach ($advert_list as $advert){ ?>
                    <tr id="record_<?php echo $advert->ad_id; ?>">
                        <td><?php echo $advert->ad_id; ?></td>
                        <td><?php echo $advert->ad_type; ?></td>
                        <td width="200" title="<?php echo $advert->ad_desc; ?>"><div class="w200 ellip"><?php echo $advert->ad_desc; ?></div></td>
                        <td width="300" title="<?php echo $advert->ad_link; ?>"><?php echo $advert->ad_link; ?></td>
                        <td><?php echo ($advert->ad_status == 1)?'正常':'<span style="color:#f00;">未激活</span>'; ?></td>
                        <td><?php echo $advert->create_time; ?></td>
                        <td>
                            <a href="<?php echo base_url(); ?>/admin/advert_update?ad_id=<?php echo $advert->ad_id; ?>" class="btn btn-orange btn-sm btn-icon icon-left">查看</a>
                            <a href="javascript:;" onclick="advert_del(<?php echo $advert->ad_id; ?>)" class="btn btn-danger btn-sm btn-icon icon-left">删除</a>
                        </td>
                    </tr>
                    <?php } ?>
                    <?php if(count($advert_list) == 0){ ?>
                    <tr>
                        <td colspan="7">未搜索到相应结果</td>
                    </tr>
                    <?php } ?>
                  </tbody>
                </table>
                
                <div class="row">
                  <div class="col-xs-6">
                    <div class="dataTables_info">共<?php echo $page_count; ?>条记录，
                      <label>每页显示 <?php echo $page_size; ?> 条记录</label>
                    </div>
                  </div>
                  <div class="col-xs-6">
                    <div class="dataTables_paginate paging_simple_numbers">
                      <?php echo $this->pagination->create_links(); ?>
                    </div>
                  </div>
                </div>
                
              </div>
              
            </div>
            
          </div>
          
        </div>
      </div>
      
      <?php include_once('templete/copyright.php') ?>
    </div>
    
  </div>
  
  
  
<?php include_once('templete/pub_foot.php') ?>
<script type="text/javascript">
function advert_del(id){
    $.ajax({
        type:"post",
        url:"/admin/Advert_controller/advert_delete_do",
        async:true,
        data:{
            ad_id: id
        },
        dataType:'json',
        success:function(data){
            if(data.state == 'success'){
                $("#record_"+id).remove();
                toastr.success("删除成功");
            }else{
                toastr.error("程序异常：<br>请联系管理员");
            }
        },
        error:function(jqXHR, textStatus, errorThrown){
            toastr.error("程序异常："+errorThrown+"<br>请联系管理员");
        }
    });
}
$(function(){
    
})
</script>
</body>
</html>
