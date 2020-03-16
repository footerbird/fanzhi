<!-- Add "fixed" class to make the sidebar fixed always to the browser viewport. -->
<!-- Adding class "toggle-others" will keep only one menu item open at a time. -->
<!-- Adding class "collapsed" collapse sidebar root elements and show only icons. -->
<div class="sidebar-menu toggle-others fixed">
  
  <div class="sidebar-menu-inner">  
    
    <header class="logo-env">
      
      <!-- logo -->
      <div class="logo">
        <a href="<?php echo base_url(); ?>/admin" class="logo-expanded">
          <img src="/htdocs/admin/images/logo@2x.png?<?php echo CACHE_TIME; ?>" width="80" alt="" />
        </a>
        
        <a href="<?php echo base_url(); ?>/admin" class="logo-collapsed">
          <img src="/htdocs/admin/images/logo-collapsed@2x.png?<?php echo CACHE_TIME; ?>" width="40" alt="" />
        </a>
      </div>
      
      <!-- This will toggle the mobile menu and will be visible only on mobile devices -->
      <div class="mobile-menu-toggle visible-xs">
        <a href="#" data-toggle="mobile-menu">
          <i class="fa-bars"></i>
        </a>
      </div>
      
    </header>
        
    
        
    <ul id="main-menu" class="main-menu">
      <!-- add class "multiple-expanded" to allow multiple submenus to open -->
      <!-- class "auto-inherit-active-class" will automatically add "active" class for parent elements who are marked already with class "active" -->
      
      <li class="active">
        <a href="<?php echo base_url(); ?>/admin">
          <i class="linecons-star"></i>
          <span class="title">广告管理</span>
        </a>
      </li>
    </ul>
        
  </div>
  
</div>