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

          <form action="<?=base_url('index.php/admin/save_config')?>" name="save_config" id="save_config" method="post" autocomplete="off" enctype="multipart/form-data">

            <div class="form-group row">
              <label for="sch_id" class="col-sm-4 col-form-label">ปีการศึกษา <cite class="req-text">*</cite></label>
              <div class="col-sm-8">
                <select name="co_year" id="co_year" class="form-control" style="max-width:250px;" required>
                  <option value="">กรุณาเลือก</option>
                  <?php foreach($year as $x){ ?>
                  <option value="<?=$x['y_name']?>" ><?=$x['y_name']?></option>
                  <?php } ?>
                </select>
              </div>
            </div>

            <div class="form-group row">
              <label for="user_fname" class="col-sm-4 col-form-label">รายละเอียด <cite class="req-text">*</cite></label>
              <div class="col-sm-6">
              <input  type="text" class="form-control" id="co_title" name="co_title"  required>
              </div>
            </div>
   
            <div class="form-group row">
              <label for="user_fname" class="col-sm-4 ">วันเริ่มโครงการ <cite class="req-text">*</cite></label>
              <div class="col-sm-3">
                  <div class="input-group date">
                    <input type="text" class="form-control float-right" id="co_date_start" name="co_date_start" >
                    <div class="input-group-prepend">
                      <span class="input-group-text"><i class="far fa-calendar"></i></span>
                    </div>
                  </div>
			        </div>
            </div>

            <div class="form-group row">
              <label for="user_fname" class="col-sm-4 ">วันสิ้นสุดโครงการ <cite class="req-text">*</cite></label>
              <div class="col-sm-3">
                  <div class="input-group date">
                    <input type="text" class="form-control float-right" id="co_date_end" name="co_date_end" >
                    <div class="input-group-prepend">
                      <span class="input-group-text"><i class="far fa-calendar"></i></span>
                    </div>
                  </div>
			        </div>
            </div>

            <div class="form-group row">
              <label for="user_fname" class="col-sm-4 ">วันเขตฯพื้นที่ฯเริ่มการประเมิน <cite class="req-text">*</cite></label>
              <div class="col-sm-3">
                  <div class="input-group date">
                    <input type="text" class="form-control float-right" id="co_areascore_start" name="co_areascore_start" >
                    <div class="input-group-prepend">
                      <span class="input-group-text"><i class="far fa-calendar"></i></span>
                    </div>
                  </div>
			        </div>
            </div>

            <div class="form-group row">
              <label for="user_fname" class="col-sm-4 ">วันเขตพื้นที่ฯสิ้นสุดการประเมิน <cite class="req-text">*</cite></label>
              <div class="col-sm-3">
                  <div class="input-group date">
                    <input type="text" class="form-control float-right" id="co_areascore_end" name="co_areascore_end" >
                    <div class="input-group-prepend">
                      <span class="input-group-text"><i class="far fa-calendar"></i></span>
                    </div>
                  </div>
			        </div>
            </div>               


            <div class="form-group row">
              <label for="user_fname" class="col-sm-4 ">วันเขตตรวจราชการเริ่มการประเมิน <cite class="req-text">*</cite></label>
              <div class="col-sm-3">
                  <div class="input-group date">
                    <input type="text" class="form-control float-right" id="co_clusscore_start" name="co_clusscore_start" >
                    <div class="input-group-prepend">
                      <span class="input-group-text"><i class="far fa-calendar"></i></span>
                    </div>
                  </div>
			        </div>
            </div>

            <div class="form-group row">
              <label for="user_fname" class="col-sm-4 ">วันเขตตรวจราชการสิ้นสุดการให้คะแนน <cite class="req-text">*</cite></label>
              <div class="col-sm-3">
                  <div class="input-group date">
                    <input type="text" class="form-control float-right" id="co_clusscore_end" name="co_clusscore_end" >
                    <div class="input-group-prepend">
                      <span class="input-group-text"><i class="far fa-calendar"></i></span>
                    </div>
                  </div>
			        </div>
            </div>                
            
            <div class="form-group row">
              <label for="user_fname" class="col-sm-4 ">วัน สพฐ.ตั้งคณะกรรมกรประเมิน <cite class="req-text">*</cite></label>
              <div class="col-sm-3">
                  <div class="input-group date">
                    <input type="text" class="form-control float-right" id="co_datenote_start" name="co_datenote_start" >
                    <div class="input-group-prepend">
                      <span class="input-group-text"><i class="far fa-calendar"></i></span>
                    </div>
                  </div>
			        </div>
            </div>

            <div class="form-group row">
              <label for="user_fname" class="col-sm-4 ">วัน สพฐ.สิ้นสุดตั้งคณะกรรมกรประเมิน <cite class="req-text">*</cite></label>
              <div class="col-sm-3">
                  <div class="input-group date">
                    <input type="text" class="form-control float-right" id="co_datenote_end" name="co_datenote_end" >
                    <div class="input-group-prepend">
                      <span class="input-group-text"><i class="far fa-calendar"></i></span>
                    </div>
                  </div>
			        </div>
            </div>  

            <div class="form-group row">
              <label for="user_fname" class="col-sm-4 ">วัน สพฐ.เริ่มการประเมิน <cite class="req-text">*</cite></label>
              <div class="col-sm-3">
                  <div class="input-group date">
                    <input type="text" class="form-control float-right" id="co_datescore_start" name="co_datescore_start" >
                    <div class="input-group-prepend">
                      <span class="input-group-text"><i class="far fa-calendar"></i></span>
                    </div>
                  </div>
			        </div>
            </div>

            <div class="form-group row">
              <label for="user_fname" class="col-sm-4 ">วัน สพฐ.สิ้นสุดการให้คะแนน <cite class="req-text">*</cite></label>
              <div class="col-sm-3">
                  <div class="input-group date">
                    <input type="text" class="form-control float-right" id="co_datescore_end" name="co_datescore_end" >
                    <div class="input-group-prepend">
                      <span class="input-group-text"><i class="far fa-calendar"></i></span>
                    </div>
                  </div>
			        </div>
            </div>            

            <div class="form-group row">
              <label for="user_fname" class="col-sm-4 ">วันประกาศผล <cite class="req-text">*</cite></label>
              <div class="col-sm-3">
                  <div class="input-group date">
                    <input type="text" class="form-control float-right" id="co_datepublish" name="co_datepublish" >
                    <div class="input-group-prepend">
                      <span class="input-group-text"><i class="far fa-calendar"></i></span>
                    </div>
                  </div>
			        </div>
            </div>              

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
  $(document).on('click', '#btn-submit', function(e) {
      e.preventDefault();
      swal({
        title: "ยืนยันการบันทึกข้อมูล?",
        text: "หากท่านยืนยันการบันทึกข้อมูลให้กด OK เพื่อยืนยันข้อมูล",
        icon: "warning",
        buttons: true,
        primaryMode: true,
      })
      .then((save_config) => {
        if(save_config){
         // var x = chkDigitPid();
         // if(x != false){
          $('#save_config').submit();
  		//}
        }
      });
  });

  $(document).ready(function () {
    bsCustomFileInput.init();
  });

  $(function () {
    $('[data-mask]').inputmask()
    $('.input-group.date').datepicker({format: "yyyy-mm-dd"}); 
  })

  $(document).ready(function () {
    bsCustomFileInput.init();
  });
  </script>
  <!-- ส่วนของ Footer -->
  <?php echo view('template/footer'); ?>
