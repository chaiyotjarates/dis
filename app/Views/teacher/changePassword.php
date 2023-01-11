<!-- ส่วนของ Header -->
<?php echo view('template/header'); ?>
<!-- ส่วนของ Navbar -->
<?php echo view('template/navbar'); ?>
<!-- ส่วนของ Sidebar -->
<?php echo view('template/sidebar'); ?>

<!-- Content Wrapper. Contains page content -->
  <div class="content-wrapper">
    
    <!-- ส่วนของ content_header -->
    <?php echo view('template/content_header'); ?>

    <!-- Main content -->
    <section class="content">
      <div class="container-fluid">
        <!-- Small boxes (Stat box) -->
        <div class="row">
          
        <div class="col-md-12">
            <div class="card card-info">
                <div class="card-header">
                    <h3 class="card-title">แบบฟอร์มการตั้งรหัสผ่านใหม่</h3>
                </div>
                <!-- /.card-header -->
                <!-- form start -->
                <form class="form-horizontal" action="<?php echo base_url(session()->get('role').'/updatePassword'); ?>" method="post" name="submit-form-updatePassword"
              id="submit-form-updatePassword">
                    <?= csrf_field(); ?>
                    <div class="card-body">

                        <?php if (session()->getFlashdata('success')): ?>
                            <div class="alert alert-success text-left"><?php echo session()->getFlashdata('success'); ?></div>
                        <?php endif ?>

                        <?php if (session()->getFlashdata('error')): ?>
                            <div class="alert alert-danger text-left"><?php echo session()->getFlashdata('error'); ?></div>
                        <?php endif ?>

                        <?php if (isset($validation)): ?>
                            <div class="alert alert-danger text-left"><i class="fe fe-alert-circle fs-16"></i> <?php echo $validation->listErrors(); ?></div>
                        <?php endif ?>
                        
                        <div class="form-group row">
                            <label for="old_password" class="col-sm-2 col-form-label">รหัสผ่านปัจจุบัน</label>
                            <div class="col-sm-5">
                            <input type="password" class="form-control" name="old_password" id="old_password">
                            </div>
                        </div>
                        <div class="form-group row">
                            <label for="new_password" class="col-sm-2 col-form-label">รหัสผ่านใหม่</label>
                            <div class="col-sm-5">
                            <input type="password" class="form-control" name="new_password" id="new_password" placeholder="">
                            </div>
                        </div>
                        <div class="form-group row">
                            <label for="conf_password" class="col-sm-2 col-form-label">รหัสผ่านใหม่อีกครั้ง</label>
                            <div class="col-sm-5">
                            <input type="password" class="form-control" name="conf_password" id="conf_password" placeholder="">
                            </div>
                        </div>
                    </div>
                    <!-- /.card-body -->
                    <div class="card-footer">
                        <button type="submit" class="btn btn-info">บันทึกรหัสผ่านใหม่</button>
                        <button type="reset" class="btn btn-default float-right">ยกเลิก</button>
                    </div>
                    <!-- /.card-footer -->
                </form>
            </div>
        </div>

        </div>
        <!-- /.row -->
      </div><!-- /.container-fluid -->
    </section>
    <!-- /.content -->
  </div>
  <!-- /.content-wrapper -->

  <!-- ส่วนของ Footer -->
  <?php echo view('template/footer'); ?>
