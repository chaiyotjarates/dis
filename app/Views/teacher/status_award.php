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
                    <h3 class="card-title">สถานะการส่งผลงาน คุรุชนคนคุณธรรม</h3>
                </div>
                <!-- /.card-header -->
                <!-- form start -->
                
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
                            <label for="old_password" class="col-sm-2 col-form-label">สถานะปัจจุบัน</label>
                            <div class="col-sm-5 status<?php if($award['status']=='waiting'): echo '-wait'; endif; ?>-award" style="margin-top: 7px;">
                                <?php if($award['status']=='waiting'): echo 'รอการตรวจสอบ'; endif; ?>
                            </div>
                        </div>
                        <div class="form-group row">
                            <label for="old_password" class="col-sm-2 col-form-label">ชื่อ-นามสกุล ผู้ส่ง</label>
                            <div class="col-sm-5" style="margin-top: 7px;">
                                <?=session()->get('fullname')?>
                            </div>
                        </div>
                        <div class="form-group row">
                            <label for="url" class="col-sm-2 col-form-label">วัน/เวลาที่ส่ง</label>
                            <div class="col-sm-10" style="margin-top: 7px;">
                                <?=$award['datetime']?>
                            </div>
                        </div>
                        <div class="form-group row">
                            <label for="url" class="col-sm-2 col-form-label">ลิ้งค์</label>
                            <div class="col-sm-10" style="margin-top: 7px;">
                                <a class="btn btn-info" target="blank" href="<?=$award['url']?>"><i class="fas fa-link"></i> เปิดอ่าน</a>
                            </div>
                        </div>
                    </div>
                    <!-- /.card-body -->
                    <div class="card-footer">

                        <?php if($award['status'] == 'waiting'): ?>
                            <a class="btn btn-danger btn-cancel float-right">ยกเลิกการส่งผลงาน</a>
                        <?php endif; ?>  

                    </div>
                    <!-- /.card-footer -->

                    <!-- cancel Award Modal -->
                    <div id="deleteModal" class="modal fade">
                        <div class="modal-dialog modal-sm" role="document">
                            <div class="modal-content">
                                <div class="modal-header">
                                    <h6 class="tx-14 mg-b-0 tx-uppercase tx-inverse tx-bold"><i
                                            class="fe fe-alert-circle"></i> แจ้งเตือน</h6>
                                    <button type="button" class="close" data-bs-dismiss="modal"
                                        aria-label="Close">
                                        <span aria-hidden="true">&times;</span>
                                    </button>
                                </div>
                                <div class="modal-body">
                                    <p>ข้อมูลเกี่ยวกับการส่งผลงานจะถูกยกเลิกทันที ยืนยันการยกเลิกข้อมูลนี้</p>
                                </div><!-- modal-body -->
                                <div class="modal-footer">
                                    <a href="<?=base_url(session()->get('role').'/cancelAward')?>"
                                        class="btn btn-primary">ยกเลิกทันที</a>
                                    <button type="button" class="btn btn-secondary btn-cancel-hide"
                                        data-bs-dismiss="modal">ยกเลิก</button>
                                </div>
                            </div>
                        </div><!-- modal-dialog -->
                    </div><!-- modal -->
                
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
  <script>
$(document).ready(function(){
    $('.btn-cancel').on('click',function(){
        $('#deleteModal').modal('show');
    });
    $('.btn-cancel-hide').on('click',function(){
        $('#deleteModal').modal('hide');
    });
});
</script>
 