<!-- ส่วนของ Header -->
<?php echo view('template/header'); ?>
<!-- ส่วนของ Navbar -->
<?php echo view('template/navbar/navbar_admin'); ?>
<!-- ส่วนของ Sidebar -->
<?php echo view('template/sidebar/sidebar_admin'); ?>

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
          <h3 class="card-title"><?=$title['1'];?></h3>
        </div>

        <div class="card-body">

          <form action="<?=base_url('admin/update_year')?>" name="update_year" id="update_year" method="post" autocomplete="off" enctype="multipart/form-data">

            <div class="form-group row">
              <label for="user_fname" class="col-sm-3 col-form-label">ปีการศึกษา <cite class="req-text">*</cite></label>
              <div class="col-sm-9">
              <input  style="max-width:300px;" type="text" class="form-control" id="y_name" name="y_name"  value="<?=$year['y_name']?>" required>
              </div>
            </div>
			      <input value="<?=$year['y_id']?>" type="hidden" name="y_id" id="y_id">
            <div class="form-group row">
              <div class="offset-sm-3 col-sm-9">
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
        title: "ยืนยันการบันทึกข้อมูล?",
        text: "หากท่านยืนยันการบันทึกข้อมูลให้กด OK เพื่อยืนยันข้อมูล",
        icon: "warning",
        buttons: true,
        primaryMode: true,
      })
      .then((update_year) => {
        if(update_year){
         // var x = chkDigitPid();
         // if(x != false){
          $('#update_year').submit();
  		//}
        }
      });
  });

  </script>
  <!-- ส่วนของ Footer -->
  <?php echo view('template/footer'); ?>