<!DOCTYPE html>
<html>
<head>
<?php include_once('templete/pub_head.php') ?>
<link rel="stylesheet" href="/htdocs/admin/js/dropzone/css/dropzone.css?<?php echo CACHE_TIME; ?>">
</head>
<body class="page-body">

  <div class="page-container"><!-- add class "sidebar-collapsed" to close sidebar by default, "chat-visible" to make chat appear always -->
      
    <?php include_once('templete/sidebar.php') ?>
    
    <div class="main-content">
      
      <?php include_once('templete/navbar.php') ?>
      
      <div class="page-title">
        
        <div class="title-env">
          <h1 class="title">广告编辑</h1>
        </div>
        
          <div class="breadcrumb-env">
          
            <ol class="breadcrumb bc-1">
              <li><a href="<?php echo base_url(); ?>/admin"><i class="fa-home"></i>首页</a></li>
              <li><a href="<?php echo base_url(); ?>/admin">广告管理</a></li>
              <li class="active"><strong>广告编辑</strong></li>
            </ol>
                
        </div>
          
      </div>
      <!-- Table Styles -->
      <div class="row">
        <div class="col-md-12">
        
          <div class="panel panel-default">
            
            <div class="panel-body">
                <form role="form" class="form-horizontal" id="sForm">
                    <div class="form-group">
                        <label class="col-sm-2 control-label">广告标题</label>
                        <div class="col-sm-4">
                            <input type="text" class="form-control" name="ad_name" id="ad_name" required="required" placeholder="请输入广告标题" value="<?php if(isset($advert)){ echo $advert->ad_name; }else{ echo '默认标题'; } ?>">
                        </div>
                        <label class="col-sm-2 control-label">广告类型</label>
                        <div class="col-sm-4">
                            <select class="form-control" name="ad_type" id="ad_type">
                                <option value="image" <?php if(isset($advert) && ($advert->ad_type == 'image')){ echo 'selected'; } ?>>图片</option>
                                <option value="video" <?php if(isset($advert) && ($advert->ad_type == 'video')){ echo 'selected'; } ?>>视频</option>
                            </select>
                        </div>
                    </div>
                    <div class="form-group-separator"></div>
                    <div class="form-group">
                        <label class="col-sm-2 control-label">广告介绍</label>
                        <div class="col-sm-10">
                            <input type="text" class="form-control" name="ad_desc" id="ad_desc" required="required" placeholder="请输入广告介绍" value="<?php if(isset($advert)){ echo $advert->ad_desc; } ?>">
                        </div>
                    </div>
                    <div class="form-group-separator"></div>
                    <div class="form-group">
                        <label class="col-sm-2 control-label">广告素材</label>
                        <div class="col-sm-4">
                            <div id="materialDropzone" class="droppable-area">
                              Drop Files Here
                            </div>
                            <input type="hidden" name="ad_address" id="ad_address" value="<?php if(isset($advert)){ echo $advert->ad_address; } ?>">
                            <?php if(isset($advert) && ($advert->ad_type == 'image')){ echo '<img id="ad_address_preview" src="'.$advert->ad_address.'" width="140" height="140" class="ml20" />'; } ?>
                            <?php if(isset($advert) && ($advert->ad_type == 'video')){ echo '<video id="ad_address_preview" src="'.$advert->ad_address.'" type="video/mp4" width="140" height="140" class="ml20" style="vertical-align: middle;" />'; } ?>
                        </div>
                        <label class="col-sm-2 control-label">视频海报</label>
                        <div class="col-sm-4">
                            <div id="posterDropzone" class="droppable-area">
                              Drop Poster Here
                            </div>
                            <input type="hidden" name="video_poster" id="video_poster" value="<?php if(isset($advert)){ echo $advert->video_poster; } ?>">
                            <?php if(isset($advert) && ($advert->ad_type == 'video')){ echo '<img id="video_poster_preview" src="'.$advert->video_poster.'" width="140" height="140" class="ml20" />'; } ?>
                        </div>
                    </div>
                    <div class="form-group-separator"></div>
                    <div class="form-group">
                        <label class="col-sm-2 control-label">广告状态</label>
                        <div class="col-sm-10">
                            <label class="radio-inline">
                                <input name="ad_status" type="radio" value="1" <?php if(!isset($advert) || $advert->ad_status == '1'){ echo 'checked="checked"'; } ?>>
                                正常
                            </label>
                            <label class="radio-inline">
                                <input name="ad_status" type="radio" value="0" <?php if(isset($advert) && $advert->ad_status == '0'){ echo 'checked="checked"'; } ?>>
                                未激活
                            </label>
                        </div>
                    </div>
                    <div class="form-group-separator"></div>
                    <div class="form-group">
                        <label class="col-sm-2 control-label">广告点击链接</label>
                        <div class="col-sm-10">
                            <input type="text" class="form-control" name="ad_link" id="ad_link" required="required" placeholder="请输入广告点击链接" value="<?php if(isset($advert)){ echo $advert->ad_link; } ?>">
                        </div>
                    </div>
                    <div class="form-group-separator"></div>
                    <div class="form-group">
                        <label class="col-sm-2 control-label"></label>
                        <div class="col-sm-10">
                            <input type="button" class="btn btn-orange" id="submitBtn" onclick="form_submit()" value="提交">
                            <a href="<?php echo base_url(); ?>admin" class="btn btn-white btn-sm ">返回</a>
                        </div>
                    </div>
                    <input type="hidden" name="ad_id" value="<?php if(isset($advert)){ echo $advert->ad_id; } ?>">
                    <input type="hidden" name="operate" value="<?php echo $operate; ?>">
                </form>
            </div>
            
          </div>
          
        </div>
      </div>
      
      <?php include_once('templete/copyright.php') ?>
    </div>
    
  </div>
  
  
  
<?php include_once('templete/pub_foot.php') ?>
<script src="/htdocs/admin/js/dropzone/dropzone.min.js?<?php echo CACHE_TIME; ?>"></script>
<script type="text/javascript">
function form_submit(){
    if($("#ad_type").val() == ""){
        toastr.error("广告类型不能为空");
        return;
    }
    if($("#ad_address").val() == ""){
        toastr.error("广告素材不能为空");
        return;
    }
    
    $("#sForm").ajaxForm({
        url:'/admin/Advert_controller/advert_update_do',
        type:'post',
        dataType:'json',
        beforeSubmit:function () {
        },
        success:function (data) {
            if(data.state == "success"){
                location.href = "<?php echo base_url(); ?>/admin";
            }else{
                toastr.error(data.msg);
            }
        },
        error:function(jqXHR, textStatus, errorThrown){
            toastr.error("程序异常："+errorThrown+"<br>请联系管理员");
        }
    }).submit();
}
$(function(){
    $("#materialDropzone").dropzone({
        url: '/admin/Advert_controller/upload_advertMaterial',
        //maxFiles: 1,//这里设置 Dropzone 最多可以处理多少文件，该文件数量指的是多次上传文件的总和,超出就会报error
        maxFilesize: 5,
        maxFilesize: 120, //MB
        acceptedFiles: ".jpeg,.jpg,.gif,.png,.JPEG,.JPG,.GIF,.PNG,.mp4",
        success: function(file,res){
            var result = eval('('+res+')');
            if(result.state == 'success'){
                $("#ad_address").val(result.url);
                if($("#ad_address_preview").length == 1){
                    $("#ad_address_preview").remove();
                }
                $("#materialDropzone").after('<span id="ad_address_preview">'+result.url+'</span>');
            }else{
                toastr.error("上传失败，请重试");
            }
        },
        error: function(file,res){
            toastr.error("上传失败，请重试");
        },
        addedfile: function(file){}//阻止默认行为
    });
    
    $("#posterDropzone").dropzone({
        url: '/admin/Advert_controller/upload_advertMaterial',
        //maxFiles: 1,//这里设置 Dropzone 最多可以处理多少文件，该文件数量指的是多次上传文件的总和,超出就会报error
        maxFilesize: 5,
        acceptedFiles: ".jpeg,.jpg,.gif,.png,.JPEG,.JPG,.GIF,.PNG",
        success: function(file,res){
            var result = eval('('+res+')');
            if(result.state == 'success'){
                $("#video_poster").val(result.url);
                if($("#video_poster_preview").length == 1){
                    $("#video_poster_preview").attr("src",result.url);
                }else{
                    $("#posterDropzone").after('<img id="video_poster_preview" src="'+result.url+'" width="140" height="140" class="ml20" />');
                }
            }else{
                toastr.error("上传失败，请重试");
            }
        },
        error: function(file,res){
            toastr.error("上传失败，请重试");
        },
        addedfile: function(file){}//阻止默认行为
    });
})
</script>
</body>
</html>