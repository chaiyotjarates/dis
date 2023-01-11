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
                    <h3 class="card-title">แบบฟอร์มการส่งผลงาน คุรุชนคนคุณธรรม</h3>
                </div>
                <!-- /.card-header -->
                <!-- form start -->
                <form class="form-horizontal" action="<?php echo base_url(session()->get('role').'/insertAward'); ?>" method="post" name="submit-insertAward"
              id="submit-insertAward">
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

                        <div class="row">
                            <div class="col-md-12">
                                <div class="info-box bg-warning">
                                <span class="info-box-icon"><i class="far fa-bookmark"></i></span>

                                <div class="info-box-content">
                                    <span class="info-box-text">เกณฑ์การส่งผลงาน</span>
                                    <span class="info-box-number">อ่านรายละเอียดก่อนส่งผลงาน <a href="javascript:void(0)">คลิกเพื่ออ่าน</a></span>
                                </div>
                                <!-- /.info-box-content -->
                                </div>
                                <!-- /.info-box -->
                            </div>
                            <!-- /.col -->
                            <div class="col-md-12">
                                <div class="info-box bg-danger">
                                <span class="info-box-icon"><i class="fas fa-comments"></i></span>

                                <div class="info-box-content">
                                    <span class="info-box-text">โปรดอ่าน</span>
                                    <span class="info-box-number">การส่งลิ้งค์เพื่อส่งผลงาน จำเป็นต้องเปิดสิทธิ์ของ Url ให้สามารถเข้าถึงได้</span>
                                </div>
                                <!-- /.info-box-content -->
                                </div>
                                <!-- /.info-box -->
                            </div>
                            <!-- /.col -->
                            </div>   
                        
                        <div class="form-group row">
                            <label for="old_password" class="col-sm-2 col-form-label">ชื่อ-นามสกุล ผู้ส่ง</label>
                            <div class="col-sm-5" style="margin-top: 7px;">
                                <?=session()->get('fullname')?>
                            </div>
                        </div>
                        <div class="form-group row">
                            <label for="url" class="col-sm-2 col-form-label">ลิ้งค์ผลงาน</label>
                            <div class="col-sm-10">
                                <input type="text" class="form-control" name="url" id="url" placeholder="เช่น https://drive.google.com/file/d/1I2sM6AbOfT......" required>
                                <cite>เพื่อไม่เสียสิทธิ์ในการส่งผลงาน กรุณาตรวจสอบสิทธิ์การเข้าถึงลิ้งค์ก่อนกดส่งข้อมูล</cite>
                            </div>
                        </div>
                    </div>
                    <!-- /.card-body -->
                    <div class="card-footer">
                        <button type="submit" class="btn btn-info">ส่งข้อมูลตอนนี้</button>
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
 