<!-- ส่วนของ Header -->
<?php echo view('template/header'); ?>

<!-- ส่วนของ Navbar -->
<?php echo view('template/navbar/navbar_admin'); ?>
<!-- ส่วนของ Sidebar -->
<?php echo view('template/sidebar/sidebar_admin'); ?>
  <!-- /.Main Sidebar Container -->

<!-- Content Wrapper. Contains page content -->
  <div class="content-wrapper">
    
    <!-- ส่วนของ content_header -->
    <?php echo view('template/content_header'); ?>

    <!-- Main content -->
    <section class="content">
      <div class="container-fluid">

      <?php if (session()->getFlashdata('success')): ?>
            <div class="alert alert-success text-center"><?php echo session()->getFlashdata('success'); ?></div>
        <?php endif ?>

        <?php if (session()->getFlashdata('error')): ?>
            <div class="alert alert-danger text-left"><?php echo session()->getFlashdata('error'); ?></div>
        <?php endif ?>

        <?php if (isset($validation)): ?>
            <div class="alert alert-danger text-left"><i class="fe fe-alert-circle fs-16"></i> <?php echo $validation->listErrors(); ?></div>
        <?php endif ?>
    
      <div class="card">

        <div class="card-header">
          <h3 class="card-title"><?=$title['1'];?><?=trim($user['user_prefix']).$user['user_fname']." ".$user['user_lname']?></h3>
        </div>

        <div class="card-body">

          <form action="<?=base_url('index.php/admin/updateprofile_super')?>" name="profile" id="profile" method="post" autocomplete="off"  enctype="multipart/form-data">


            <div class="form-group row">
              <label for="user_prefix" class="col-sm-3 col-form-label">รูปปัจจุบัน</label>
              <div class="col-sm-9">
                <?php if($user['user_profile'] != ""){ ?>
                  <img class="profile-user-img img-fluid img-circle" src="<?=base_url()?>/uploads/profile/<?=$user['user_profile'];?>" />
                <?php }else{ ?>
                  <img class="profile-user-img img-fluid img-circle" src="<?=base_url('img/spt_logo.png')?>" />
                <?php } ?>
              </div>
            </div>

            <div class="form-group row">
              <label for="user_prefix" class="col-sm-3 col-form-label">เลือกรูปประจำตัว <cite class="req-text">*</cite></label>
              <div class="col-sm-9">
                <div class="input-group" style="max-width:500px;">
                  <div class="custom-file">
                    <input type="file" class="custom-file-input" id="user_profile" name="user_profile" accept="image/*">
                    <label class="custom-file-label" for="user_profile">เลือกรูป</label>
                  </div>
                </div>
              </div>
            </div>

            <div class="form-group row">
              <label for="user_prefix" class="col-sm-3 col-form-label">คำนำหน้า <cite class="req-text">*</cite></label>
              <div class="col-sm-9">
                <select name="user_prefix" id="user_prefix" class="form-control" style="max-width:250px;" required>
                  <option value="">-------กรุณาเลือก-------</option>
                  <?php foreach($prefix as $v){ ?>
                  <option value="<?=$v['prefix_title']?>" <?php if($v['prefix_title'] == trim($user['user_prefix'])){ echo 'selected'; }?> ><?=$v['prefix_title']?></option>
                  <?php } ?>
                </select>
              </div>
            </div>

            <div class="form-group row">
              <label for="user_fname" class="col-sm-3 col-form-label">ชื่อ (ภาษาไทย) <cite class="req-text">*</cite></label>
              <div class="col-sm-9">
              <input value="<?=$user['user_fname']?>" style="max-width:300px;" type="text" class="form-control" id="user_fname" name="user_fname" placeholder="เช่น คุณครู" required>
              </div>
            </div>
            
            <div class="form-group row">
              <label for="user_lname" class="col-sm-3 col-form-label">นามสกุล (ภาษาไทย) <cite class="req-text">*</cite></label>
              <div class="col-sm-9">
              <input value="<?=$user['user_lname']?>" style="max-width:300px;" type="text" class="form-control" id="user_lname" name="user_lname" placeholder="เช่น ใจดี" required>
              </div>
            </div>

            <div class="form-group row">
              <label for="user_idcard" class="col-sm-3 col-form-label">หมายเลขบัตรประชาชน</label>
              <div class="col-sm-9" style="margin-top: 7px;">
                <?=$user['user_idcard']?>
            </div>
            </div>

            <div class="form-group row">
              <label for="user_email" class="col-sm-3 col-form-label">อีเมล์ <cite class="req-text">*</cite></label>
              <div class="col-sm-9">
                <input value="<?=$user['user_email']?>" style="max-width:300px;" type="email" class="form-control" id="user_email" name="user_email" placeholder="" required>
              </div>
            </div>

            <div class="form-group row">
              <label for="user_phone" class="col-sm-3 col-form-label">หมายเลขโทรศัพท์ <cite class="req-text">*</cite></label>
              <div class="col-sm-9">
              <input value="<?=$user['user_phone']?>" style="max-width:250px;" type="text" class="form-control" id="user_phone" name="user_phone" placeholder="099-xxxxxxx" data-inputmask='"mask": "999-9999999"' data-mask required>
              </div>
            </div>

            <div class="form-group row">
              <div class="offset-sm-3 col-sm-9">
                <input value="<?=$user['user_id']?>" type="hidden" id="user_id" name="user_id" >
                <button type="submit" id="btn-submit" class="btn btn-primary"><i class="far fa-check-circle"></i> บันทึกข้อมูล</button>
                <button type="reset" class="btn btn-warning"><i class="fas fa-redo-alt"></i> ยกเลิก</button>
              </div>
            </div>

          </form>

        </div>
        <!-- /.card-body -->

      </div>

      </div><!-- /.container-fluid -->
    </section>
    <!-- /.content -->
  </div>
  <!-- /.content-wrapper -->

  <!-- ส่วนของ script -->
  <?php echo view('template/script'); ?>

<script>

$(function () {
  
  $('[data-mask]').inputmask()

})

$(document).on('click', '#btn-submit', function(e) {
    e.preventDefault();
    swal({
      title: "ยืนยันการแก้ไขข้อมูล?",
      text: "หากท่านยืนยันการแก้ไข้อมูลให้กด OK เพื่อยืนยันข้อมูล",
      icon: "warning",
      buttons: true,
      primaryMode: true,
    })
    .then((updateprofile_super) => {
      if(updateprofile_super){
        $('#profile').submit();
      }
    });
});

$(document).ready(function () {
  bsCustomFileInput.init();
});


</script>


    <!-- ส่วนของ Footer -->
    <?php echo view('template/footer'); ?>