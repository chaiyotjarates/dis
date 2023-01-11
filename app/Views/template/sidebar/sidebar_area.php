<?php
    $uri = new \CodeIgniter\HTTP\URI(current_url());
    $uri_one = '';
	$uri_two = '';
	$uri_tree = '';
	$uri_four = '';
	$uri_five = '';
	$uri_six = '';
    if($uri->getTotalSegments() > 0 && $uri->getSegment(1))
        $uri_one = $uri->getSegment(1);
    if($uri->getTotalSegments() > 1 && $uri->getSegment(2))
	    $uri_two = $uri->getSegment(2);
    if($uri->getTotalSegments() > 2 && $uri->getSegment(3))
	    $uri_tree = $uri->getSegment(3);
    if($uri->getTotalSegments() > 3 && $uri->getSegment(4))
	    $uri_four = $uri->getSegment(4);
    if($uri->getTotalSegments() > 4 && $uri->getSegment(5))
	    $uri_five = $uri->getSegment(5);
    if($uri->getTotalSegments() > 5 && $uri->getSegment(6))
	    $uri_six = $uri->getSegment(6);
?>
<!-- Main Sidebar Container -->
<aside class="main-sidebar sidebar-dark-primary elevation-4">
  <!-- Brand Logo -->
  <a href="<?=base_url('index.php')?>" class="brand-link navbar-primary navbar-dark">
    <img src="<?=base_url()?>/img/<?php echo lang('Constant.webLogoCycle');?>" alt="คุรุชนคนคุณธรรม Logo" class="brand-image img-circle" style="opacity: .8">
    <span class="brand-text font-weight-light"><?php echo lang('Constant.webTitle_short_eng');?> <?php echo lang('Constant.webVersion');?></span>
  </a>

  <!-- Sidebar -->
  <div class="sidebar">
    <!-- Sidebar user panel (optional) -->
    <div class="user-panel mt-3 pb-3 mb-3 d-flex">
      <div class="image">
          <?php if(session()->get('imgProfile') != ""){ ?>
          <img class="img-circle" src="<?=base_url()?>/uploads/profile/<?=session()->get('imgProfile');?>" height="30px;" />
          <?php }else{ ?>
          <img class="img-circle" src="<?=base_url('img/spt_logo.png')?>" height="30px;" />
          <?php } ?>       
      </div>
      <div class="pull-left info">
				<i class="fa fa-circle text-success"></i><font color="#FFFFFF"> Online </font><font color="#009900"><?=number_format($useronline);?></font>
      </div>
      <!--<div class="info">
        <a href="<?=base_url()?>" class="d-block"><?=session()->get('fullname')?></a>
      </div>-->
    </div>

    <!-- Sidebar Menu -->
    <nav class="mt-2">
      <ul class="nav nav-pills nav-sidebar flex-column" data-widget="treeview" role="menu" data-accordion="false">
        <!-- Add icons to the links using the .nav-icon class
              with font-awesome or any other icon font library -->

        <li class="nav-item">
          <a href="<?=base_url()?>/dashboard" class="nav-link <?php if($uri_two=='area' and empty($uri_tree)): echo "active"; endif;?>">
            <i class="nav-icon far fa-house-user"></i>
            <p>หน้าหลัก</p>
          </a>
        </li>


        <li class="nav-header">ข้อมูลส่วนตัว</li>
        <li class="nav-item">
          <a href="<?=base_url(session()->get('checktype').'/profile')?>" class="nav-link <?php if(isset($uri_tree)): if($uri_tree=='profile'): echo "active"; endif; endif; ?>">
            <i class="nav-icon fas fa-user"></i>
            <p>แก้ไขข้อมูลส่วนตัว</p>
          </a>
        </li>
        <li class="nav-item">
          <a href="<?=base_url(session()->get('checktype').'/changePassword')?>" class="nav-link <?php if(isset($uri_tree)): if($uri_tree=='changePassword'): echo "active"; endif; endif; ?>">
            <i class="nav-icon far fa-key"></i>
            <p>เปลี่ยนรหัสผ่าน</p>
          </a>
        </li>
        <li class="nav-item">
          <a href="<?=base_url()?>/logout" class="nav-link">
            <i class="nav-icon fas fa-sign-out-alt"></i>
            <p>ออกจากระบบ</p>
          </a>
        </li>

      </ul>
    </nav>
    <!-- /.sidebar-menu -->
  </div>
  <!-- /.sidebar -->
</aside> 