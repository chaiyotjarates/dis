<!-- ส่วนของ Header -->
<?php echo view('template/header'); ?>
<!-- ส่วนของ Navbar -->
<?php echo view('template/navbar/navbar_school'); ?>
<!-- ส่วนของ Sidebar -->
<?php echo view('template/sidebar/navbar_school'); ?>

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

            <form action="<?=base_url('school/insertUser')?>" name="addUser" id="addUser" method="post" enctype="multipart/form-data" autocomplete="off">
            
                <div class="card card-info">

                    <div class="card-header">
                    <h3 class="card-title"><?=$title['1'];?></h3>
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
                        <label for="user_profile" class="col-sm-3 col-form-label">เลือกรูปประจำตัว</label>
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
                            <label for="user_idcard" class="col-sm-3 col-form-label">เลขบัตรประชาชน <cite class="req-text">*</cite></label>
                            <div class="col-sm-2">
                                <input value="" type="text" class="form-control" id="user_idcard" name="user_idcard" placeholder="9999999999999" data-inputmask='"mask": "9999999999999"' data-mask required>
                            </div>
                        </div>

                        <div class="form-group row">
                        <label for="user_prefix" class="col-sm-3 col-form-label">คำนำหน้า <cite class="req-text">*</cite></label>
                        <div class="col-sm-9">
                            <select name="user_prefix" id="user_prefix" class="form-control" style="max-width:250px;" required>
                            <option value="">-------กรุณาเลือก-------</option>
                            <?php foreach($prefix as $v){ ?>
                            <option value="<?=$v['prefix_title']?>" <?php if(set_value('user_prefix')==$v['prefix_title']): echo 'selected'; endif; ?> ><?=$v['prefix_title']?></option>
                            <?php } ?>
                            </select>
                        </div>
                        </div>

                        <div class="form-group row">
                        <label for="user_fname" class="col-sm-3 col-form-label">ชื่อ (ภาษาไทย) <cite class="req-text">*</cite></label>
                        <div class="col-sm-9">
                        <input value="<?= set_value('user_fname'); ?>" style="max-width:300px;" type="text" class="form-control" id="user_fname" name="user_fname" placeholder="เช่น คุณครู" required>
                        </div>
                        </div>
                        
                        <div class="form-group row">
                        <label for="user_lname" class="col-sm-3 col-form-label">นามสกุล (ภาษาไทย) <cite class="req-text">*</cite></label>
                        <div class="col-sm-9">
                        <input value="<?= set_value('user_lname'); ?>" style="max-width:300px;" type="text" class="form-control" id="user_lname" name="user_lname" placeholder="เช่น ใจดี" required>
                        </div>
                        </div>

                        <div class="form-group row">
                            <label for="sch_code" class="col-sm-3 col-form-label">โรงเรียน <cite class="req-text">*</cite></label>
                            <div class="col-sm-5">
                                <select name="sch_code" id="sch_code" class="form-control" required>
                                    <option value="">เลือกโรงเรียน</option>
                                    <?php foreach ($school as $c) { ?>
                                    <option value="<?=$c['sch_id']?>" <?php if(set_value('sch_code')==$c['sch_id']): echo 'selected'; endif; ?> ><?=$c['sch_name']." (".$c['sch_code'].")"?></option>
                                    <?php } ?>
                                </select>
                            </div>
                        </div>

                        <div class="form-group row">
                            <label for="user_address" class="col-sm-3 col-form-label">ที่อยู่ </label>
                            <div class="col-sm-6">
                            <input value="<?= set_value('user_address'); ?>" type="text" class="form-control" id="user_address" name="user_address" placeholder="บ้านเลขที่ หมู่ที่ ห้องที่ ถนน">
                            </div>
                        </div>

                        <div class="form-group row">
                            <label for="user_prov" class="col-sm-3 col-form-label">จังหวัด </label>
                            <div class="col-sm-9">
                                <select name="user_prov" id="user_prov" class="form-control" style="max-width:350px;">
                                <option value="">เลือกจังหวัด</option>
                                <?php foreach ($prov as $c) { ?>
                                <option value="<?=$c['code']?>" ><?=$c['name']?></option>
                                <?php } ?>
                                </select>
                            </div>
                        </div>

                        <div class="form-group row">
                            <label for="user_amp" class="col-sm-3 col-form-label">อำเภอ </label>
                            <div class="col-sm-9">
                                <select name="user_amp" id="user_amp" class="form-control" style="max-width:350px;">
                                <option value="">เลือกอำเภอ</option>
                                </select>
                            </div>
                        </div>

                        <div class="form-group row">
                            <label for="user_tumbon" class="col-sm-3 col-form-label">ตำบล </label>
                            <div class="col-sm-9">
                                <select name="user_tumbon" id="user_tumbon" class="form-control" style="max-width:350px;">
                                <option value="">เลือกตำบล</option>
                                </select>
                            </div>
                        </div>

                        <div class="form-group row">
                            <label for="user_post" class="col-sm-3 col-form-label">รหัสไปรษณีย์</label>
                            <div class="col-sm-2">
                                <input value="" type="text" class="form-control" id="user_post" name="user_post" placeholder="99999" data-inputmask='"mask": "99999"' data-mask>
                            </div>
                        </div>

                            <div class="form-group row">
                            <label for="user_email" class="col-sm-3 col-form-label">อีเมล์</label>
                            <div class="col-sm-9">
                                <input value="<?= set_value('user_email'); ?>" style="max-width:300px;" type="email" class="form-control" id="user_email" name="user_email" placeholder="">
                            </div>
                        </div>

                            <div class="form-group row">
                            <label for="user_phone" class="col-sm-3 col-form-label">หมายเลขโทรศัพท์</label>
                            <div class="col-sm-9">
                            <input value="<?= set_value('user_phone'); ?>" style="max-width:250px;" type="text" class="form-control" id="user_phone" name="user_phone" placeholder="099-xxxxxxx" data-inputmask='"mask": "999-9999999"' data-mask>
                            </div>
                        </div>

                        <div class="form-group row">
                            <label for="user_LineId" class="col-sm-3 col-form-label">ที่อยู่ LineID </label>
                            <div class="col-sm-2">
                            <input value="<?= set_value('user_LineId'); ?>" type="text" class="form-control" id="user_LineId" name="user_LineId" >
                            </div>
                        </div>

                        <div class="form-group row">
                            <label for="user_facebook" class="col-sm-3 col-form-label">ที่อยู่ Facebook </label>
                            <div class="col-sm-2">
                            <input value="<?= set_value('user_facebook'); ?>" type="text" class="form-control" id="user_facebook" name="user_facebook" >
                            </div>
                        </div>

                        <div class="form-group row">
                            <label for="user_twitter" class="col-sm-3 col-form-label">ที่อยู่ Twitter </label>
                            <div class="col-sm-2">
                            <input value="<?= set_value('user_twitter'); ?>" type="text" class="form-control" id="user_twitter" name="user_twitter" >
                            </div>
                        </div>

                        <div class="form-group row">
                            <label for="user_tiktok" class="col-sm-3 col-form-label">ที่อยู่ Tiktok </label>
                            <div class="col-sm-2">
                            <input value="<?= set_value('user_tiktok'); ?>" type="text" class="form-control" id="user_tiktok" name="user_tiktok" >
                            </div>
                        </div>

                        <div class="form-group row">
                            <label for="user_IG" class="col-sm-3 col-form-label">ที่อยู่ Instragram </label>
                            <div class="col-sm-2">
                                <input value="<?= set_value('user_IG'); ?>" type="text" class="form-control" id="user_IG" name="user_IG" >
                            </div> 
                        </div>

                        <div class="form-group row">
                            <label for="user_password" class="col-sm-3 col-form-label">รหัสผ่าน <cite class="req-text">*</cite></label>
                            <div class="col-sm-9">
                                <input value="<?= set_value('user_password'); ?>" type="text" style="max-width:250px;" class="form-control" id="user_password" name="user_password" >
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
    <!-- ส่วนของ Footer -->
    <?php echo view('template/footer'); ?>
 