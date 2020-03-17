<!DOCTYPE html>
<html>

    <head>
    <?php include_once('templete/pub_head.php') ?>
    </head>

    <body style="background-color: #1b1b1f;">
    <div class="header"></div>
    <div class="container" style="overflow: hidden;">
        <input type="hidden" id="advert_page" value="5" />
        <div class="swiper-container advert-swiper" id="advert_container">

            <div class="swiper-wrapper">
                <?php foreach ($advert_list as $advert){ ?>
                <!-------------slide----------------->
                <section class="swiper-slide swiper-slide-v">
                    <?php if($advert->ad_type == 'image'){ ?>
                    <img class="banner" src="<?php echo $advert->ad_address; ?>" />
                    <?php }else if($advert->ad_type == 'iframe'){ ?>
                    <iframe src="<?php echo $advert->ad_address; ?>" frameborder="0" class="banner" width="100%" height="100%"></iframe>
                    <?php }else{ ?>
                    <video class="banner" src="<?php echo $advert->ad_address; ?>" poster="<?php echo $advert->video_poster; ?>" type="video/mp4" loop="loop" preload="load" muted webkit-playsinline="true" playsinline="true" x-webkit-airplay="true" x5-video-player-type="h5" x5-video-player-fullscreen="portraint">当前浏览器不支持</video>
                    <?php } ?>
                    <div class="swiper-mask">
                        <div class="share-info" style="bottom: 80px;">
                            <?php if(!empty($advert->ad_link)){ ?>
                            <a href="<?php echo $advert->ad_link; ?>" target="_parent" class="tag tag-visit">访问</a>
                            <?php } ?>
                        </div>
                        <?php if($advert->ad_type == 'video'){ ?>
                        <div class="video-play"></div>
                        <?php } ?>
                    </div>
                </section>
                <?php } ?>
            </div>
            
            <div class="swiper-pagination"></div>
        </div>
        
    </div>

    <?php include_once('templete/pub_foot.php') ?>
    <script>
    window.onload = function(){
        
    }
    
    $(function(){
        var mySwiper = new Swiper ('#advert_container', {
            effect: 'coverflow',
            speed: 500,
            direction: 'vertical',
            coverflowEffect: {
                rotate: 50,
                stretch: 0,
                depth: 100,
                modifier: 1,
                slideShadows : true
            }
        })
        mySwiper.on('slideNextTransitionStart',function(){//开始向下切换
            var current_page = parseInt($("#advert_page").val());
            $.ajax({
                type:"post",
                url:"/Index_controller/get_advertAjax_tpl",
                async:true,
                data:{
                    page: current_page+1
                },
                success:function(html){
                    mySwiper.appendSlide(html);
                    $("#advert_page").val(current_page+1);
                }
            });
        })
        
        $(document).on("click",".swiper-mask",function(){
            var $mask = $(this);
            var $video_play = $mask.find(".video-play");
            if($video_play.length > 0){
                if($video_play.is(":hidden")){//如果是播放状态
                    $mask.siblings("video")[0].pause();
                    $mask.find(".video-play").show();
                }else{
                    //先把其他视频暂停
                    var $other_swiper = $mask.parent().siblings(".swiper-slide");
                    $other_swiper.each(function(){
                        var $this = $(this);
                        if($this.find(".video-play").length > 0){
                            $this.find("video")[0].pause();
                            $this.find(".video-play").show();
                        }
                    })
                    
                    $mask.siblings("video")[0].play();
                    $mask.find(".video-play").hide();
                }
            }
        })
        
    })
    
    </script>
    </body>
</html>
