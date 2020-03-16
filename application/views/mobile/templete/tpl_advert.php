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