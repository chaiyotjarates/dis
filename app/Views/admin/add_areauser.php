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
          <h3 class="card-title"><?=$title['1'];?></h3>
        </div>
        
        <div class="card-body">

          <form action="<?=base_url('index.php/admin/save_areauser')?>" name="save_areauser" id="save_areauser" method="post" autocomplete="off" enctype="multipart/form-data">


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
              <label for="user_prefix" class="col-sm-3 col-form-label">เขตตรวจราชการ <cite class="req-text">*</cite></label>
              <div class="col-sm-9">
                <select name="user_clus" id="user_clus" class="form-control" style="max-width:250px;" required>
                  <option value="">----เลือกเขตตรวจราชการ----</option>
                  <?php foreach($cluster as $v){ ?>
                  <option value="<?=$v['clus_id']?>" ><?=$v['clus_name']?></option>
                  <?php } ?>
                </select>
              </div>
            </div>

            <div class="form-group row">
              <label for="user_prefix" class="col-sm-3 col-form-label">เขตพื้นที่การศึกษา <cite class="req-text">*</cite></label>
              <div class="col-sm-9">
                <select name="user_area" id="user_area" class="form-control" style="max-width:250px;" required>
                  <option value="">-------เลือกเขตพื้นที่ฯ------</option>
                </select>
              </div>
            </div>

            <div class="form-group row">
              <label for="user_prefix" class="col-sm-3 col-form-label">คำนำหน้า <cite class="req-text">*</cite></label>
              <div class="col-sm-9">
                <select name="user_prefix" id="user_prefix" class="form-control" style="max-width:250px;" required>
                  <option value="">-------กรุณาเลือก-------</option>
                  <?php foreach($prefix as $v){ ?>
                  <option value="<?=$v['prefix_title']?>" ><?=$v['prefix_title']?></option>
                  <?php } ?>
                </select>
              </div>
            </div>

            <div class="form-group row">
              <label for="user_fname" class="col-sm-3 col-form-label">ชื่อ (ภาษาไทย) <cite class="req-text">*</cite></label>
              <div class="col-sm-9">
              <input  style="max-width:300px;" type="text" class="form-control" id="user_fname" name="user_fname" placeholder="เช่น คุณครู" required>
              </div>
            </div>
            
            <div class="form-group row">
              <label for="user_lname" class="col-sm-3 col-form-label">นามสกุล (ภาษาไทย) <cite class="req-text">*</cite></label>
              <div class="col-sm-9">
              <input  style="max-width:300px;" type="text" class="form-control" id="user_lname" name="user_lname" placeholder="เช่น ใจดี" required>
              </div>
            </div>

            <div class="form-group row">
              <label for="user_idcard" class="col-sm-3 col-form-label">หมายเลขบัตรประชาชน <cite class="req-text">*</cite></label>
              <div class="input-group col-sm-4 mb-4" >
              <input type="text" name="user_idcard" id="user_idcard" class="form-control" placeholder="หมายเลขบัตรประชาชน" data-inputmask='"mask": "9999999999999"' data-mask>
                <div class="input-group-append">
                  <div class="input-group-text">
                    <span class="far fa-id-card"></span>
                  </div>
					      </div>
			        </div>
			      </div>
			
            <div class="col-sm-6 offset-sm-3" id="id-card-error" style="color: red;margin-bottom: 5px;margin-top: -25px;"></div>
            <div class="form-group row">
              <label for="user_idcard" class="col-sm-3 col-form-label">รหัสผ่าน <cite class="req-text">*</cite></label>
              <div class="col-sm-9" >
                <input  style="max-width:300px;" type="text" class="form-control" id="password" name="password" placeholder="" required>
            </div>
            </div>

            <div class="form-group row">
              <label for="user_email" class="col-sm-3 col-form-label">อีเมล์ <cite class="req-text">*</cite></label>
              <div class="col-sm-9">
                <input  style="max-width:300px;" type="email" class="form-control" id="user_email" name="user_email" placeholder="" required>
              </div>
            </div>

            <div class="form-group row">
              <label for="user_phone" class="col-sm-3 col-form-label">หมายเลขโทรศัพท์ <cite class="req-text">*</cite></label>
              <div class="col-sm-9">
              <input  style="max-width:250px;" type="text" class="form-control" id="user_phone" name="user_phone" placeholder="099-xxxxxxx" data-inputmask='"mask": "999-9999999"' data-mask required>
              </div>
            </div>

            <div class="form-group row">
              <label for="user_prefix" class="col-sm-3 col-form-label">สิทธ์การใช้งาน <cite class="req-text">*</cite></label>
              <div class="col-sm-9">
                <select name="user_role" id="user_role" class="form-control" style="max-width:250px;" required>
                  <option value="">----เลือกสิทธิ์การใช้งาน----</option>
                  <option value="Admin" >ผู้ดูแลระบบ</option>
                  <option value="User" >สมาชิก</option>
                </select>
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
    .then((save_areauser) => {
      if(save_areauser){
        var x = chkDigitPid();
        if(x != false){
        $('#save_areauser').submit();
		}
      }
    });
});

function chkDigitPid() {
    var p_iPID = $("#user_idcard").val();
    var total = 0;
    var iPID;
    var chk;
    var Validchk;
    iPID = p_iPID.replace(/-/g, "");
    Validchk = iPID.substr(12, 1);
    var j = 0;
    var pidcut;
    for (var n = 0; n < 12; n++) {
        pidcut = parseInt(iPID.substr(j, 1));
        total = (total + ((pidcut) * (13 - n)));
        j++;
    }

    chk = 11 - (total % 11);

    if (chk == 10) {
        chk = 0;
    } else if (chk == 11) {
        chk = 1;
    }

    if (chk == Validchk) {
      $("#id-card-error").html('');
    } else {
      $("#id-card-error").html('หมายเลขประจำตัวประชาชนไม่ถูกต้อง');
      return false;
    }

}

$(document).ready(function(){
        //เลือกเขตพื้นที่ฯจากเขตตรวจฯ
        $('#user_clus').change(function() {
            var code = $(this).val();
            $.ajax({
            url: "<?php echo base_url('/register/areaSearch');?>",
            type: "POST",
            dataType: "json",
            data: {
                "code": code
            },
            async: true,
            success: function(data) {
                var html = '';
                var i;
                html += '<option value="">เลือกเขตพื้นที่ฯ</option>';
                for (i = 0; i < data.length; i++) {
                html += '<option value=' + data[i].area_code + '>' + data[i].area_name + '</option>';
                }
                $('#user_area').html(html);
                //$('#sch_id').html('<option value="">เลือกโรงเรียน</option>');
            }
            });
            return false;
        });
});

</script>

    <!-- ส่วนของ Footer -->
    <?php echo view('template/footer'); ?>