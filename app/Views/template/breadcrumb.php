<!-- <ol class="breadcrumb float-sm-right">
    <li class="breadcrumb-item"><a href="#">Home</a></li>
    <li class="breadcrumb-item active">Dashboard v1</li>
</ol> -->
<?php
$previous = "javascript:history.go(-1)";
if(isset($_SERVER['HTTP_REFERER'])) {
    $previous = $_SERVER['HTTP_REFERER'];
}
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

<?php if($uri_tree !=''){?>
<div class="buttons" style="float:right">
<a href="<?=$previous?>"  class="btn btn-warning"><i class="fas fa-arrow-left"></i> ย้อนกลับ</a>

<?php if(session()->get('checktype') == 'admin'){?>

<?php if($uri_tree =='add_year' || $uri_tree =='edit_year' || $uri_tree =='list_year'){?>
<a href="<?=base_url('index.php/admin/add_year')?>" class="btn bg-blue"><i class="fas fa-plus"></i> เพิ่มปีการศึกษาใหม่</a>
<?php } ?>

<?php if($uri_tree =='add_cate' || $uri_tree =='edit_cate' || $uri_tree =='list_cate'){?>
<a href="<?=base_url('index.php/admin/add_cate')?>" class="btn bg-blue"><i class="fas fa-plus"></i> เพิ่มชุดการประเมินใหม่</a>
<?php } ?>

<?php if($uri_tree =='add_config' || $uri_tree =='edit_config' || $uri_tree =='list_config'){?>
<a href="<?=base_url('index.php/admin/add_config')?>" class="btn bg-blue"><i class="fas fa-plus"></i> กำหนดการประเมินใหม่</a>
<?php } ?>

<?php if($uri_tree =='add_eval' || $uri_tree =='edit_eval' || $uri_tree =='list_eval'){?>
<a href="<?=base_url('index.php/admin/add_eval')?>" class="btn bg-blue"><i class="fas fa-plus"></i> เพิ่มโรงเรียนรับประเมินใหม่</a>
<?php } ?>

<?php if($uri_tree =='admin_user' || $uri_tree =='getprofile_admin' || $uri_tree =='editprofile_admin'){?>
<a href="<?=base_url('index.php/admin/add_adminuser')?>" class="btn bg-blue"><i class="fas fa-plus"></i> เพิ่มผู้ใช้ใหม่</a>
<?php } ?>

<?php if($uri_tree =='super_user' || $uri_tree =='getprofile_super' || $uri_tree =='editprofile_super'){?>
<a href="<?=base_url('index.php/admin/add_superuser')?>" class="btn bg-blue"><i class="fas fa-plus"></i> เพิ่มกรรมการใหม่</a>
<?php } ?>

<?php if($uri_tree =='cluster_user' || $uri_tree =='getprofile_cluster' || $uri_tree =='editprofile_cluster'){?>
<a href="<?=base_url('index.php/admin/add_clusteruser')?>" class="btn bg-blue"><i class="fas fa-plus"></i> เพิ่มผู้ใช้ใหม่</a>
<?php } ?>

<?php if($uri_tree =='area_user' || $uri_tree =='getprofile_area' || $uri_tree =='editprofile_area'){?>
<a href="<?=base_url('index.php/admin/add_areauser')?>" class="btn bg-blue"><i class="fas fa-plus"></i> เพิ่มผู้ใช้ใหม่</a>
<?php } ?>

<?php if($uri_tree =='get_user' || $uri_tree =='getprofile_user' || $uri_tree =='editprofile_user'){?>
<a href="<?=base_url('index.php/admin/add_user')?>" class="btn bg-blue"><i class="fas fa-plus"></i> เพิ่มผู้ใช้ใหม่</a>
<?php } ?>

<?php if(($uri_tree =='con_add_tsite'  && $this->uri->segment(3)=='3' ) || ($uri_tree =='con_edit_tsite'  && $this->uri->segment(3)=='3' ) || ($uri_tree =='con_tsite'  && $this->uri->segment(3)=='3' )){?>
<a href="<?=base_url('index.php/admin/con_add_tsite/3')?>" class="btn bg-blue"><i class="fas fa-plus"></i> จัดการประเมินใหม่</a>
<?php } ?>

<?php if(($uri_tree =='con_add_tsite'  && $this->uri->segment(3)=='4' ) || ($uri_tree =='con_edit_tsite'  && $this->uri->segment(3)=='4' ) || ($uri_tree =='con_tsite'  && $this->uri->segment(3)=='4' )){?>
<a href="<?=base_url('index.php/admin/con_add_tsite/4')?>" class="btn bg-blue"><i class="fas fa-plus"></i> จัดการฝึกงานใหม่</a>
<?php } ?>

<?php } ?>

<?php if(session()->get('checktype') == 'cluster'){?>

<?php } ?>

<?php if(session()->get('checktype') == 'area'){?>

<?php if($uri_tree =='area_user' || $uri_tree =='getprofilearea' || $uri_tree =='editprofilearea'){?>
<a href="<?=base_url('index.php/area/add_areauser')?>" class="btn bg-blue"><i class="fas fa-plus"></i> เพิ่มผู้ใช้ใหม่</a>
<?php } ?>

<?php if($uri_tree =='getuser' || $uri_tree =='getprofileuser' || $uri_tree =='editprofileuser'){?>
<a href="<?=base_url('index.php/area/add_user')?>" class="btn bg-blue"><i class="fas fa-plus"></i> เพิ่มผู้ใช้ใหม่</a>
<?php } ?>

<?php if($uri_tree =='list_fileeval'){?>
<a href="<?=base_url('index.php/area/add_eval');?>" class="btn btn-primary" ><i class="fas fa-upload"></i>&nbsp;ส่งผลงานโรงเรียน</a>
<?php } ?>

<?php } ?>

<?php if(session()->get('checktype') == 'school'){?>

<?php if($uri_tree =='list_fileeval'){?>
<a href="<?=base_url('index.php/user/add_fileeval/'.$this->session->userdata('sch_id'));?>" class="btn btn-primary" ><i class="fas fa-upload"></i>&nbsp;ส่งผลงาน</a>
<?php } ?>

<?php } ?>


</div>
<?php } ?>


