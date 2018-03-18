<?php
  $main_menu=mysqli_query($con,"SELECT * FROM `main_menu` ORDER BY display_order ASC");
$sub_menu=mysqli_query($con,"SELECT * FROM `sub_menu` WHERE main_menu_id='".$data_main_menu->id."' ORDER BY main_menu_id,display_order ASC");
?>
 <!-- Left side column. contains the logo and sidebar -->
  <aside class="main-sidebar">
    <!-- sidebar: style can be found in sidebar.less -->
    <section class="sidebar">
      <!-- Sidebar user panel (optional) -->
      <!--<div class="user-panel">
        <div class="pull-left image">
          <img src="dist/img/user2-160x160.jpg" class="img-circle" alt="User Image">
        </div>
        <div class="pull-left info">
          <p>Alexander Pierce</p>
          <a href="#"><i class="fa fa-circle text-success"></i> Online</a>
        </div>
      </div>-->
      <!-- search form (Optional) -->

      <!--<form action="#" method="get" class="sidebar-form">
        <div class="input-group">
          <input type="text" name="q" class="form-control" placeholder="Search...">
              <span class="input-group-btn">
                <button type="submit" name="search" id="search-btn" class="btn btn-flat"><i class="fa fa-search"></i>
                </button>
              </span>
        </div>
      </form>-->
      <!-- /.search form -->

      <!-- Sidebar Menu -->
      <ul class="sidebar-menu">
        <li class="header">HEADER</li>
        <!-- Optionally, you can add icons to the links -->
        
        <li <?php echo (basename($_SERVER['PHP_SELF'])=='deskboard.php')?'class="active"':''; ?>><a href="<?php echo BUILDER_URL; ?>"><i class="fa fa-dashboard"></i> <span>Dashboard</span></a></li>
      <!--  <li><a href="#"><i class="fa fa-link"></i> <span>Another Link</span></a></li>-->
        
    <li <?php echo (basename($_SERVER['PHP_SELF'])=='manage_project.php')?'class="active"':''; ?>><a href="<?php echo BUILDER_URL;?>manage_project.php"><i class="fa fa-folder-open"></i> <span>Project</span></a></li>
    <li <?php echo (basename($_SERVER['PHP_SELF'])=='manage_section.php')?'class="active"':''; ?>><a href="<?php echo BUILDER_URL;?>manage_section.php"><i class="fa fa-th-large Try it
"></i> <span>Section</span></a></li>
    <li <?php echo (basename($_SERVER['PHP_SELF'])=='manage_page.php')?'class="active"':''; ?>><a href="<?php echo BUILDER_URL;?>manage_page.php"><i class="fa fa-file-code-o  Try it
"></i> <span>Page</span></a></li>
  </ul>
</li>




      <!-- /.sidebar-menu -->
    </section>
    <!-- /.sidebar -->
  </aside>