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
          <a href="<?=base_url()?>/dashboard" class="nav-link <?php if($uri_two=='admin' and empty($uri_tree)): echo "active"; endif;?>">
            <i class="nav-icon far fa-house-user"></i>
            <p>หน้าหลัก</p>
          </a>
        </li>
        <?php if(session()->get('user_role') != "Admin"){ ?>
        <li class="nav-item <?php if($uri_two=='admin' && $uri_tree=='list_year' or $uri_tree=='add_year' or $uri_tree=='edit_year' or $uri_tree=='list_tsite' or $uri_tree=='add_tsite' or $uri_tree=='edit_tsite' or $uri_tree=='list_config' or $uri_tree=='add_config' or $uri_tree=='edit_config' or $uri_tree=='list_posuper' or $uri_tree=='add_posuper' or $uri_tree=='edit_posuper' or $uri_tree=='list_poadmin' or $uri_tree=='add_poadmin' or $uri_tree=='edit_poadmin' or $uri_tree=='list_potrainer' or $uri_tree=='add_potrainer' or $uri_tree=='edit_potrainer' or $uri_tree=='list_cate' or $uri_tree=='add_cate' or $uri_tree=='edit_cate' or $uri_tree=='list_eval' or $uri_tree=='add_eval' or $uri_tree=='edit_eval' or $uri_tree=='list_fileeval' or $uri_tree=='add_fileeval' or $uri_tree=='edit_fileeval' or $uri_tree=='list_levelsuper'  or $uri_tree=='edit_levelsuper'  or $uri_tree=='add_levelsuper' ) {echo 'has-treeview menu-open'; }?>">
            <a href="#" class="nav-link <?php if($uri_two=='admin' && $uri_tree=='list_year' or $uri_tree=='add_year' or $uri_tree=='edit_year' or $uri_tree=='list_tsite' or $uri_tree=='add_tsite' or $uri_tree=='edit_tsite' or $uri_tree=='list_config' or $uri_tree=='add_config' or $uri_tree=='edit_config' or $uri_tree=='list_posuper' or $uri_tree=='add_posuper' or $uri_tree=='edit_posuper' or $uri_tree=='list_poadmin' or $uri_tree=='add_poadmin' or $uri_tree=='edit_poadmin' or $uri_tree=='list_potrainer' or $uri_tree=='add_potrainer' or $uri_tree=='edit_potrainer' or $uri_tree=='list_cate' or $uri_tree=='add_cate' or $uri_tree=='edit_cate' or $uri_tree=='list_eval' or $uri_tree=='add_eval' or $uri_tree=='edit_eval' or $uri_tree=='list_fileeval' or $uri_tree=='add_fileeval' or $uri_tree=='edit_fileeval' or $uri_tree=='list_levelsuper'  or $uri_tree=='edit_levelsuper'  or $uri_tree=='add_levelsuper'){ echo 'active'; }?>">
              <i class="nav-icon fas fa-cogs"></i>
              <p>ตั้งค่าระบบ</p>
			        <i class="right fas fa-angle-left"></i>
			      </a>
            <ul class="nav  nav-treeview ">
            <li class="nav-item ">
                <a href="<?=base_url('index.php/admin/list_year');?>" class="nav-link <?php  if($uri_two=='admin' && $uri_tree=='list_year' or $uri_tree=='add_year' or $uri_tree=='edit_year'){ echo 'active'; }?>">
                  <i class="fas fa-angle-right "></i>
					        <p>ปีการศึกษา</p>
                </a>
            </li>
            <li class="nav-item ">
                <a href="<?=base_url('index.php/admin/list_config');?>" class="nav-link <?php  if($uri_two=='admin' && $uri_tree=='list_config' or $uri_tree=='add_config' or $uri_tree=='edit_config'){ echo 'active'; }?>">
                  <i class="fas fa-angle-right "></i>
					        <p>กำหนดการประเมิน</p>
                </a>
              </li>
            <!--<li class="nav-item ">
                <a href="<?=base_url('index.php/admin/list_cate');?>" class="nav-link <?php  if($uri_two=='admin' && $uri_tree=='list_cate' or $uri_tree=='add_cate' or $uri_tree=='edit_cate'){ echo 'active'; }?>">
                  <i class="fas fa-angle-right "></i>
					        <p>ชุดการประเมิน</p>
                </a>
            </li>
            <li class="nav-item ">
                <a href="<?=base_url('index.php/admin/list_eval');?>" class="nav-link <?php  if($uri_two=='admin' && $uri_tree=='list_eval' or $uri_tree=='add_eval' or $uri_tree=='edit_eval'){ echo 'active'; }?>">
                  <i class="fas fa-angle-right "></i>
					        <p>โรงเรียนรับประเมิน</p>
                </a>
            </li>
            <li class="nav-item ">
                <a href="<?=base_url('index.php/admin/list_fileeval');?>" class="nav-link <?php  if($uri_two=='admin' && $uri_tree=='list_fileeval' or $uri_tree=='add_fileeval' or $uri_tree=='edit_fileeval'){ echo 'active'; }?>">
                  <i class="fas fa-angle-right "></i>
					        <p>เอกสารประกอบ</p>
                </a>
            </li>-->
			      </ul>
		    </li>

        <li class="nav-item <?php if($uri_two=='admin'  && $uri_tree=='admin_user' or $uri_tree=='admin_user' or $uri_tree=='get_user' or $uri_tree=='getprofile_admin' or $uri_tree=='editprofile_admin' or $uri_tree=='editprofile_area' or $uri_tree=='getprofile_admin' or $uri_tree=='editprofile_admin' or $uri_tree=='getprofile_user' or $uri_tree=='editprofile_user' or $uri_tree=='add_adminuser' or $uri_tree=='add_adminuser' or $uri_tree=='add_user' or $uri_tree=='super_user' or $uri_tree=='getprofile_super' or $uri_tree=='editprofile_super' or $uri_tree=='add_superuser' or $uri_tree=='admin_user' or $uri_tree=='getprofileadmin' or $uri_tree=='editprofile_admin' or $uri_tree=='add_adminuser' or $uri_tree=='trainer_user' or $uri_tree=='getprofile_trainer' or $uri_tree=='editprofile_trainer' or $uri_tree=='add_traineruser' or $uri_tree=='area_user' or $uri_tree=='getprofile_area' or $uri_tree=='editprofile_area' or $uri_tree=='add_areauser' or $uri_tree=='cluster_user' or $uri_tree=='getprofile_cluster' or $uri_tree=='editprofile_cluster' or $uri_tree=='add_clusteruser'){ echo 'has-treeview menu-open'; }?>">
            <a href="#" class="nav-link <?php if($uri_two=='admin'  && $uri_tree=='admin_user' or $uri_tree=='admin_user' or $uri_tree=='get_user' or $uri_tree=='getprofile_admin' or $uri_tree=='editprofile_admin' or  $uri_tree=='getprofile_admin' or $uri_tree=='editprofile_admin' or $uri_tree=='getprofile_user' or $uri_tree=='editprofile_user' or $uri_tree=='add_adminuser' or $uri_tree=='add_adminuser' or $uri_tree=='add_user' or $uri_tree=='super_user' or $uri_tree=='getprofile_super' or $uri_tree=='editprofile_super' or $uri_tree=='add_superuser' or $uri_tree=='admin_user' or $uri_tree=='getprofile_admin' or $uri_tree=='editprofile_admin' or $uri_tree=='add_adminuser' or $uri_tree=='trainer_user' or $uri_tree=='getprofile_trainer' or $uri_tree=='editprofile_trainer' or $uri_tree=='add_traineruser' or $uri_tree=='area_user' or $uri_tree=='getprofile_area' or $uri_tree=='editprofile_area' or $uri_tree=='add_areauser' or $uri_tree=='cluster_user' or $uri_tree=='getprofile_cluster' or $uri_tree=='editprofile_cluster' or $uri_tree=='add_clusteruser'){ echo 'active'; }?>">
              <i class="nav-icon fas fa-user"></i>
              <p>จัดการผู้ใช้งาน</p>
              <i class="right fas fa-angle-left"></i>
            </a>
            <ul class="nav  nav-treeview ">
              <li class="nav-item ">
                <a href="<?=base_url('index.php/admin/admin_user')?>" class="nav-link <?php if($uri_two=='admin'  && $uri_tree=='admin_user' or $uri_tree=='getprofile_admin' or $uri_tree=='editprofile_admin' or $uri_tree=='add_adminuser' ){ echo 'active'; }?>">
                  <i class="fas fa-angle-right "></i>
                  <p>ผู้ดูแลระบบ</p>
                </a>
              </li>
              <!--<li class="nav-item">
                <a href="<?=base_url('index.php/admin/super_user')?>" class="nav-link <?php if($uri_two=='admin'  && $uri_tree=='super_user' or $uri_tree=='getprofile_super' or $uri_tree=='editprofile_super' or $uri_tree=='add_superuser'){ echo 'active'; }?>">
                  <i class="fas fa-angle-right "></i>
                  <p>กรรมการประเมิน</p>
                </a>
              </li>-->
              <li class="nav-item">
                <a href="<?=base_url('index.php/admin/cluster_user')?>" class="nav-link <?php if($uri_two=='admin'  && $uri_tree=='cluster_user' or $uri_tree=='getprofile_cluster' or $uri_tree=='editprofile_cluster' or $uri_tree=='add_clusteruser'){ echo 'active'; }?>">
                  <i class="fas fa-angle-right "></i>
                  <p>ผู้ใช้งานเขตตรวจฯ</p>
                </a>
              </li>
              <li class="nav-item">
                <a href="<?=base_url('index.php/admin/area_user')?>" class="nav-link <?php if($uri_two=='admin'  && $uri_tree=='area_user' or $uri_tree=='getprofile_area' or $uri_tree=='editprofile_area' or $uri_tree=='add_areauser'){ echo 'active'; }?>">
                  <i class="fas fa-angle-right "></i>
                  <p>ผู้ใช้งานเขตฯ</p>
                </a>
              </li>
              <li class="nav-item">
                <a href="<?=base_url('index.php/admin/get_user')?>" class="nav-link <?php if($uri_two=='admin'  && $uri_tree=='get_user' or $uri_tree=='getprofile_user' or $uri_tree=='editprofile_user' or $uri_tree=='add_user'){ echo 'active'; }?>">
                  <i class="fas fa-angle-right "></i>
                  <p>ผู้ใช้งานโรงเรียน</p>
                </a>
              </li>
            </ul>
          </li>

          <!--<li class="nav-item <?php if($uri_two=='admin'  && $uri_tree=='con_super' or $uri_tree=='con_add_super' or $uri_tree=='con_add_onesuper' or $uri_tree=='con_edit_super' or $uri_tree=='con_admin' or $uri_tree=='con_add_admin' or $uri_tree=='con_edit_admin' or $uri_tree=='con_sch' or $uri_tree=='con_add_sch' or $uri_tree=='con_edit_sch' or $uri_tree=='con_tsite' or $uri_tree=='con_add_tsite' or $uri_tree=='con_edit_tsite' ){ echo 'has-treeview menu-open'; }?>">
            <a href="#" class="nav-link <?php if($uri_two=='admin'  && $uri_tree=='con_super' or $uri_tree=='con_add_super' or $uri_tree=='con_add_onesuper' or $uri_tree=='con_edit_super' or $uri_tree=='con_admin' or $uri_tree=='con_add_admin' or $uri_tree=='con_edit_admin' or $uri_tree=='con_sch' or $uri_tree=='con_add_sch' or $uri_tree=='con_edit_sch' or $uri_tree=='con_tsite' or $uri_tree=='con_add_tsite' or $uri_tree=='con_edit_tsite' ){ echo 'active'; }?>">
              <i class="nav-icon fas fa-edit"></i>
              <p>จัดการประเมิน</p>
              <i class="right fas fa-angle-left"></i>
            </a>
            <ul class="nav  nav-treeview ">
               <li class="nav-item">
                <a href="<?=base_url('index.php/admin/con_super')?>" class="nav-link <?php if($uri_two=='admin'  && ($uri_tree=='con_super' ) or ($uri_tree=='con_add_super' ) or ($uri_tree=='con_add_onesuper' ) or ($uri_tree=='con_edit_super' )){ echo 'active'; }?>">
                  <i class="fas fa-angle-right "></i>
                  <p>กรรมการประเมิน</p>
                </a>
              </li>
               <li class="nav-item">
                <a href="<?=base_url('index.php/admin/con_sch')?>" class="nav-link <?php if($uri_two=='admin'  && ($uri_tree=='con_sch' ) or ($uri_tree=='con_add_sch' ) or ($uri_tree=='con_edit_sch' )){ echo 'active'; }?>">
                  <i class="fas fa-angle-right "></i>
                  <p>โรงเรียนรับประเมิน</p>
                </a>
            </ul>
          </li>
          <?php } ?>


        <li class="nav-item <?php if($uri_two=='admin'  &&  $uri_tree=='get_uparea' or $uri_tree=='get_upsch' or $uri_tree=='get_upper' or $uri_tree=='detail_upper' or $uri_tree=='edit_upper' or $uri_tree=='add_upper' ){ echo 'has-treeview menu-open'; }?>">
            <a href="#" class="nav-link <?php if($uri_two=='admin'  && $uri_tree=='get_uparea' or $uri_tree=='get_upsch' or $uri_tree=='get_upper' or $uri_tree=='detail_upper' or $uri_tree=='edit_upper' or $uri_tree=='add_upper' ){ echo 'active'; }?>">
              <i class="nav-icon fas fa-upload"></i>
              <p>รายการส่งผลงาน</p>
              <i class="right fas fa-angle-left"></i>
            </a>
            <ul class="nav  nav-treeview ">
              <li class="nav-item ">
                <a href="<?=base_url('index.php/admin/get_uparea')?>" class="nav-link <?php if($uri_two=='admin'  && ($uri_tree=='get_uparea' ) or ($uri_tree=='get_upsch' ) or ($uri_tree=='get_upper' ) or ($uri_tree=='detail_upper' ) or ($uri_tree=='edit_upper' ) ){ echo 'active'; }?>">
                  <i class="fas fa-angle-right "></i>
                  <p>รายเขตพื้นที่</p>
                </a>
              </li>
            </ul>
          </li>

         <li class="nav-item <?php if($uri_two=='admin'  && $uri_tree=='get_as' or $uri_tree=='edit_as' or $uri_tree=='add_as' or $uri_tree=='list_add_as' or $uri_tree=='detail_as' or $uri_tree=='get_ascate' or $uri_tree=='edit_ascate' or $uri_tree=='add_ascate' or $uri_tree=='detail_ascate' ){ echo 'has-treeview menu-open'; }?>">
            <a href="#" class="nav-link <?php if($uri_two=='admin'  && $uri_tree=='get_as' or $uri_tree=='edit_as' or $uri_tree=='get_ascate'  or $uri_tree=='add_as' or $uri_tree=='list_add_as' or $uri_tree=='detail_as' or $uri_tree=='edit_ascate' or $uri_tree=='add_ascate' or $uri_tree=='detail_ascate' ){ echo 'active'; }?>">
              <i class="nav-icon fas fa-check"></i>
              <p>บันทึกการประเมิน</p>
              <i class="right fas fa-angle-left"></i>
            </a>
            <ul class="nav  nav-treeview ">
              <li class="nav-item ">
                <a href="<?=base_url('index.php/admin/get_as/1')?>" class="nav-link <?php if($uri_two=='admin'  && ($uri_tree=='get_as' && $uri_four=='1' ) or ($uri_tree=='edit_as' && $uri_four=='1' ) or ($uri_tree=='add_as' && $uri_four=='1' ) or ($uri_tree=='list_add_as' && $uri_four=='1' ) or ($uri_tree=='detail_as' && $uri_four=='1' ) ){ echo 'active'; }?>">
                  <i class="fas fa-angle-right "></i>
                  <p>ระดับ สพฐ.</p>
                </a>
              </li>
              <li class="nav-item ">
                <a href="<?=base_url('index.php/admin/get_as/2')?>" class="nav-link <?php if($uri_two=='admin'  && ($uri_tree=='get_as' && $uri_four=='2' ) or ($uri_tree=='edit_as' && $uri_four=='2' ) or ($uri_tree=='add_as' && $uri_four=='2' ) or ($uri_tree=='list_add_as' && $uri_four=='2' ) or ($uri_tree=='detail_as' && $uri_four=='2' ) ){ echo 'active'; }?>">
                  <i class="fas fa-angle-right "></i>
                  <p>ระดับเขตตรวจฯ</p>
                </a>
              </li>
              <li class="nav-item ">
                <a href="<?=base_url('index.php/admin/get_as/3')?>" class="nav-link <?php if($uri_two=='admin'  && ($uri_tree=='get_as' && $uri_four=='3' ) or ($uri_tree=='edit_as' && $uri_four=='3' ) or ($uri_tree=='add_as' && $uri_four=='3' ) or ($uri_tree=='list_add_as' && $uri_four=='3' ) or ($uri_tree=='detail_as' && $uri_four=='2' ) ){ echo 'active'; }?>">
                  <i class="fas fa-angle-right "></i>
                  <p>ระดับเขตพื้นที่ฯ</p>
                </a>
              </li>
            </ul>
          </li>

         <li class="nav-item <?php if($uri_two=='admin'  && $uri_tree=='get_spas' or $uri_tree=='detail_spas' or $uri_tree=='get_spascate' or $uri_tree=='detail_spascate' ){ echo 'has-treeview menu-open'; }?>">
            <a href="#" class="nav-link <?php if($uri_two=='admin'  && $uri_tree=='get_spas' or $uri_tree=='detail_spas' or $uri_tree=='get_spascate' or $uri_tree=='detail_spascate'){ echo 'active'; }?>">
              <i class="nav-icon fas fa-graduation-cap"></i>
              <p>ผลการประเมิน</p>
              <i class="right fas fa-angle-left"></i>
            </a>
            <ul class="nav  nav-treeview ">
              <li class="nav-item ">
                <a href="<?=base_url('index.php/admin/get_spas/1');?>" class="nav-link <?php if($uri_two=='admin'  && ($uri_tree=='get_spas' && $uri_four=='1' )  or ($uri_tree=='detail_spas' && $uri_four=='1' ) ){ echo 'active'; }?>">
                  <i class="fas fa-angle-right "></i>
                <p>ระดับ สพฐ.</p>
                </a>
              </li>
              <li class="nav-item ">
                <a href="<?=base_url('index.php/admin/get_spas/2');?>" class="nav-link <?php if($uri_two=='admin'  && ($uri_tree=='get_spas' && $uri_four=='2' )  or ($uri_tree=='detail_spas' && $uri_four=='2' ) ){ echo 'active'; }?>">
                  <i class="fas fa-angle-right "></i>
                <p>ระดับเขตตรวจฯ</p>
                </a>
              </li>
              <li class="nav-item ">
                <a href="<?=base_url('index.php/admin/get_spas/3');?>" class="nav-link <?php if($uri_two=='admin'  && ($uri_tree=='get_spas' && $uri_four=='3' )  or ($uri_tree=='detail_spas' && $uri_four=='3' ) ){ echo 'active'; }?>">
                  <i class="fas fa-angle-right "></i>
                <p>ระดับเขตพื้นที่ฯ</p>
                </a>
              </li>
            </ul>
          </li>

        <li class="nav-item <?php if($uri_two=='admin'  &&  $uri_tree=='getp_spas'  or $uri_tree=='detailp_spas' or $uri_tree=='getp_spascate'  or $uri_tree=='detailp_spascate'){ echo 'has-treeview menu-open'; }?>">
            <a href="#" class="nav-link <?php if($uri_two=='admin'  && $uri_tree=='getp_spas'  or $uri_tree=='detailp_spas'  or $uri_tree=='getp_spascate'  or $uri_tree=='detailp_spascate'){ echo 'active'; }?>">
              <i class="nav-icon fas fa-print"></i>
              <p>พิมพ์ผลการประเมิน</p>
              <i class="right fas fa-angle-left"></i>
            </a>
            <ul class="nav  nav-treeview ">
              <li class="nav-item ">
                <a href="<?=base_url('index.php/admin/getp_spas/1')?>" class="nav-link <?php if($uri_two=='admin'  && ($uri_tree=='getp_spas' && $uri_four=='1' )  or ($uri_tree=='detailp_spas' ) ){ echo 'active'; }?>">
                  <i class="fas fa-angle-right "></i>
                  <p>ระดับ สพฐ.</p>
                </a>
              </li>
              <li class="nav-item ">
                <a href="<?=base_url('index.php/admin/getp_spas/2')?>" class="nav-link <?php if($uri_two=='admin'  && ($uri_tree=='getp_spas' && $uri_four=='2' )  or ($uri_tree=='detailp_spas' && $uri_four=='2') ){ echo 'active'; }?>">
                  <i class="fas fa-angle-right "></i>
                  <p>ระดับเขตตรวจฯ</p>
                </a>
              </li>
              <li class="nav-item ">
                <a href="<?=base_url('index.php/admin/getp_spas/3')?>" class="nav-link <?php if($uri_two=='admin'  && ($uri_tree=='getp_spas' && $uri_four=='3' )  or ($uri_tree=='detailp_spas' && $uri_four=='3') ){ echo 'active'; }?>">
                  <i class="fas fa-angle-right "></i>
                  <p>ระดับเขตพื้นที่ฯ</p>
                </a>
              </li>
            </ul>
          </li>

        <li class="nav-item <?php if($uri_two=='admin'  &&  $uri_tree=='report' ){ echo 'has-treeview menu-open'; }?>">
            <a href="#" class="nav-link <?php if($uri_two=='admin'  && $uri_tree=='report'){ echo 'active'; }?>">
              <i class="nav-icon fa fa-download"></i>
              <p>รายงาน</p>
              <i class="right fas fa-angle-left"></i>
            </a>
            <ul class="nav  nav-treeview ">
              <li class="nav-item ">
                <a href="<?=base_url('index.php/admin/report')?>" class="nav-link <?php if($uri_two=='admin'  && ($uri_tree=='report' ) ){ echo 'active'; }?>">
                  <i class="fas fa-angle-right "></i>
                  <p>รายงาน</p>
                </a>
              </li>
            </ul>
          </li>

      <li class="nav-item <?php if($uri_two=='admin'  && $uri_tree=='admin_login' or $uri_tree=='supervis_login' or $uri_tree=='trainer_login'  or $uri_tree=='user_login' or $uri_tree=='area_login'){ echo 'has-treeview menu-open'; }?>">
            <a href="#" class="nav-link <?php if($uri_two=='admin'  && $uri_tree=='admin_login' or $uri_tree=='supervis_login'  or $uri_tree=='trainer_login'  or $uri_tree=='user_login' or $uri_tree=='area_login'){ echo 'active'; }?>">
              <i class="nav-icon fas fa-wifi"></i>
              <p>ข้อมูลเข้าระบบ</p>
              <i class="right fas fa-angle-left"></i>
            </a>
            <ul class="nav  nav-treeview ">
              <li class="nav-item ">
                <a href="<?=base_url('index.php/admin/admin_login')?>" class="nav-link <?php if($uri_two=='admin'  && $uri_tree=='admin_login' ){ echo 'active'; }?>">
                  <i class="fas fa-angle-right "></i>
                  <p>ผู้ดูแลระบบ</p>
                </a>
              </li>
              <li class="nav-item">
                <a href="<?=base_url('index.php/admin/supervis_login')?>" class="nav-link <?php if($uri_two=='admin'  && $uri_tree=='supervis_login' ){ echo 'active'; }?>">
                  <i class="fas fa-angle-right "></i>
                  <p>กรรมการประเมิน</p>
                </a>
              </li>
              <li class="nav-item">
                <a href="<?=base_url('index.php/admin/area_login')?>" class="nav-link <?php if($uri_two=='admin'  && $uri_tree=='area_login' ){ echo 'active'; }?>">
                  <i class="fas fa-angle-right "></i>
                  <p>ผู้ใช้งานเขตฯ</p>
                </a>
              </li>
              <li class="nav-item">
                <a href="<?=base_url('index.php/admin/user_login')?>" class="nav-link <?php if($uri_two=='admin'  && $uri_tree=='user_login' ){ echo 'active'; }?>">
                  <i class="fas fa-angle-right "></i>
                  <p>ผู้ใช้งานโรงเรียน</p>
                </a>
              </li>
            </ul>
          </li>-->

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