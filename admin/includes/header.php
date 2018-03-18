<style type="text/css">
@media (max-width:767px) {
 .skin-blue .main-header .navbar .dropdown-menu li.divider {
  background-color: #eee;
 }
 .skin-blue .main-header .navbar .dropdown-menu li a {
  color:#777;
 }
 .skin-blue .main-header .navbar .dropdown-menu li a:hover {
  background:#367fa9;
  color:#fff;
 }
}
.table-responsive {overflow-x: visible;}
</style>
<!-- Main Header -->
  <header class="main-header">
    <!-- Logo -->
    <a href="index2.html" class="logo">
      <!-- mini logo for sidebar mini 50x50 pixels -->
      <span class="logo-mini"><b>RJ</b></span>
      <!-- logo for regular state and mobile devices -->
      <span class="logo-lg"><b><?php echo SITE_NAME; ?></b></span>
    </a>

    <!-- Header Navbar -->
    <nav class="nav navbar navbar-static-top" role="navigation">
      
      <!-- Sidebar toggle button-->
      <a href="#" class="sidebar-toggle" data-toggle="offcanvas" role="button">
        <span class="sr-only">Toggle navigation</span>
      </a>
      <!-- Navbar Right Menu -->
      <div class="navbar-custom-menu">
        <ul class="nav navbar-nav">
          <!-- User Account Menu -->
          <li class="dropdown user user-menu">
            <!-- Menu Toggle Button -->
            <a href="#" class="dropdown-toggle" data-toggle="dropdown">
              <!-- The user image in the navbar-->
              <img src="dist/img/user2-160x160.jpg" class="user-image" alt="User Image">
              <!-- hidden-xs hides the username on small devices so only the image appears. -->
              <span class="hidden-xs"><?php echo (isset($_SESSION['ADMIN_SESS_USERNAME'])!='')?ucfirst($_SESSION['ADMIN_SESS_USERNAME']):''; ?></span>
            </a>
            <ul class="dropdown-menu" style="width:auto;padding: 5px 0;">
              <li><a href="#"><i class="fa fa-user"></i> Profile</a></li>
              
              <li><a href="logout.php"><i class="fa fa-power-off"></i> Logout</a></li>
            </ul>
          </li>

      

          <!-- Control Sidebar Toggle Button -->
          <!--<li>
            <a href="#" data-toggle="control-sidebar"><i class="fa fa-gears"></i></a>
          </li>-->
        </ul>
      </div>
    </nav>
  </header>