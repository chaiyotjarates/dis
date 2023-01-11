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
        <!-- Small boxes (Stat box) -->
        <div class="row">
          
        <div class="col-md-12">

            <form action="<?=base_url('admin/updateProfile')?>" name="profile" id="profile" method="post" enctype="multipart/form-data" autocomplete="off">
            
                <div class="card card-info">

                    <div class="card-header">
                    <h3 class="card-title">ข้อมูลส่วนตัวของ <?=session()->get('fullname')?></h3>
                    </div>
    
                    <div class="card-body">

                        <?php if (session()->getFlashdata('success')): ?>
                            <div class="alert alert-success text-center"><?php echo session()->getFlashdata('success'); ?></div>
                        <?php endif ?>

                        <?php if (session()->getFlashdata('error')): ?>
                            <div class="alert alert-danger text-left"><?php echo session()->getFlashdata('error'); ?></div>
                        <?php endif ?>

                        <?php if (isset($validation)): ?>
                            <div class="alert alert-danger text-left"><i class="fe fe-alert-circle fs-16"></i> <?php echo $validation->listErrors(); ?></div>
                        <?php endif ?>

                        <div class="form-group row">
                        <label for="user_prefix" class="col-sm-3 col-form-label">รูปปัจจุบัน</label>
                        <div class="col-sm-9">
                            <?php if(session()->get('imgProfile') != ""){ ?>
                            <img class="profile-user-img img-fluid img-circle" src="<?=base_url()?>/uploads/profile/<?=$user['user_profile'];?>" />
                            <?php }else{ ?>
                            <img class="profile-user-img img-fluid img-circle" src="<?=base_url('img/spt_logo.png')?>" />
                            <?php } ?>
                        </div>
                        </div>

                        <div class="form-group row">
                        <label for="user_profile" class="col-sm-3 col-form-label">เลือกรูปประจำตัว <cite class="req-text">*</cite></label>
                        <div class="col-sm-9">
                            <div class="input-group" style="max-width:500px;">
                            <div class="custom-file">
                                <input type="file" class="custom-file-input" id="user_profile" name="user_profile" accept="image/*">
                                <label class="custom-file-label" for="user_profile">เลือกรูป</label>
                            </div>
                            </div>
                        </div>
                        </div>
                        <input type="hidden" class="custom-file-input" id="user_profile" name="user_profile" accept="image/*" value="">

                        <div class="form-group row">
                        <label for="user_idcard" class="col-sm-3 col-form-label">ชื่อผู้ใช้งาน</label>
                        <div class="col-sm-9" style="margin-top: 7px;">
                            <?=$user['user_idcard']?>
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


                    </div> 
                    <!-- /.card-body -->

                    <div class="card-footer">
                        <button type="submit" class="btn btn-info"><i class="far fa-check-circle"></i> บันทึกข้อมูล</button>
                        <button type="reset" class="btn btn-default float-right"><i class="fas fa-redo-alt"></i> ยกเลิก</button>
                    </div>
                    <!-- /.card-footer -->

                </div>

            </form>

        </div>

        </div>
        <!-- /.row -->
      </div><!-- /.container-fluid -->
    </section>
    <!-- /.content -->
  </div>
  <!-- /.content-wrapper -->

  <!-- ส่วนของ script -->
  <?php echo view('template/script'); ?>
 
    <script>
        $(document).ready(function(){


            //เลือกเขตพื้นที่ฯจากเขตตรวจฯ
            $('#clus_code').change(function() {
                var code = $(this).val();
                $.ajax({
                url: "<?php echo base_url('/admin/areaSearch');?>",
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
                    $('#area_code').html(html);
                    $('#sch_code').html('<option value="">เลือกโรงเรียน</option>');
                }
                });
                return false;
            });

            //เลือกโรงเรียนจากเขตฯ
            $('#area_code').change(function() {
                var code = $(this).val();
                $.ajax({
                url: "<?php echo base_url('/admin/schoolSearch');?>",
                type: "POST",
                dataType: "json",
                data: {
                    "code": code
                },
                async: true,
                success: function(data) {
                    var html = '';
                    var i;
                    html += '<option value="">เลือกโรงเรียน</option>';
                    for (i = 0; i < data.length; i++) {
                    html += '<option value=' + data[i].sch_code + '>' + data[i].sch_name + '</option>';
                    }
                    $('#sch_code').html(html);
                }
                });
                return false;
            });

        });
    </script>
  <!-- ส่วนของ Footer -->
  <?php echo view('template/footer'); ?>
