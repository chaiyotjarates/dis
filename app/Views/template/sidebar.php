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
<aside class="main-sidebar sidebar-dark-pink elevation-4">
  <!-- Brand Logo -->
  <a href="<?=base_url('index.php')?>" class="brand-link navbar-pink navbar-dark">
    <img src="<?=base_url()?>/img/moral-obec-1.png" alt="คุรุชนคนคุณธรรม Logo" class="brand-image" style="opacity: .8">
    <span class="brand-text font-weight-light">คุรุชนคนคุณธรรม</span>
  </a>

  <!-- Sidebar -->
  <div class="sidebar">
    <!-- Sidebar user panel (optional) -->
    <div class="user-panel mt-3 pb-3 mb-3 d-flex">
      <div class="image">
        <?php if(session()->get('imgProfile') != ""){ ?>
          <img src="<?=base_url()?>/uploads/profile/<?=session()->get('imgProfile')?>" class="img-circle elevation-2" alt="<?=session()->get('fullname')?>">
        <?php }else{ ?>
          <img src="<?=base_url('uploads/profile/no_image.jpg')?>" class="img-circle elevation-2" alt="<?=session()->get('fullname')?>">
        <?php } ?>
      </div>
      <div class="info">
        <a href="javascript:void(0)" class="d-block"><?=session()->get('fullname')?></a>
      </div>
    </div>

    <!-- Sidebar Menu -->
    <nav class="mt-2">
      <ul class="nav nav-pills nav-sidebar flex-column" data-widget="treeview" role="menu" data-accordion="false">
        <!-- Add icons to the links using the .nav-icon class
              with font-awesome or any other icon font library -->

        <li class="nav-item">
          <a href="<?=base_url()?>/dashboard" class="nav-link <?php if($uri_two=='school' and empty($uri_tree)): echo "active"; endif;?>">
            <i class="nav-icon far fa-house-user"></i>
            <p>หน้าหลัก</p>
          </a>
        </li>

        <?php
          if(session()->get('role') == 'admin'):

            echo view('template/sidebar/sidebar_admin');

          elseif(session()->get('role') == 'obec'):

            echo view('template/sidebar/sidebar_obec');

          elseif(session()->get('role') == 'cluster'):

            echo view('template/sidebar/sidebar_cluster');

          elseif(session()->get('role') == 'area'):

            echo view('template/sidebar/sidebar_area');

          elseif(session()->get('role') == 'school'):

            echo view('template/sidebar/sidebar_school');

          elseif(session()->get('role') == 'teacher'):

            echo view('template/sidebar/sidebar_teacher');

          endif;
        ?>

        <li class="nav-header">ข้อมูลส่วนตัว</li>
        <li class="nav-item">
          <a href="<?=base_url(session()->get('role').'/profile')?>" class="nav-link <?php if(isset($uri_tree)): if($uri_tree=='profile'): echo "active"; endif; endif; ?>">
            <i class="nav-icon fas fa-user"></i>
            <p>แก้ไขข้อมูลส่วนตัว</p>
          </a>
        </li>
        <li class="nav-item">
          <a href="<?=base_url(session()->get('role').'/changePassword')?>" class="nav-link <?php if(isset($uri_tree)): if($uri_tree=='changePassword'): echo "active"; endif; endif; ?>">
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