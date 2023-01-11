<!-- ส่วนของ Header -->
<?php echo view('template/header'); ?>
<!-- ส่วนของ Navbar -->
<?php echo view('template/navbar/navbar_school'); ?>
<!-- ส่วนของ Sidebar -->
<?php echo view('template/sidebar/sidebar_school'); ?>

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

            <form action="<?=base_url('school/updateProfile')?>" name="profile" id="profile" method="post" enctype="multipart/form-data" autocomplete="off">
            
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
                            <img class="profile-user-img img-fluid img-circle" src="<?=base_url('img/spt_logo.png')?>" />
                        </div>
                        </div>

                        <!--<div class="form-group row">
                        <label for="user_profile" class="col-sm-3 col-form-label">เลือกรูปประจำตัว <cite class="req-text">*</cite></label>
                        <div class="col-sm-9">
                            <div class="input-group" style="max-width:500px;">
                            <div class="custom-file">
                                <input type="file" class="custom-file-input" id="user_profile" name="user_profile" accept="image/*">
                                <label class="custom-file-label" for="user_profile">เลือกรูป</label>
                            </div>
                            </div>
                        </div>
                        </div>-->

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
                            <label for="area_code" class="col-sm-3 col-form-label">เขตพื้นที่ฯ <cite class="req-text">*</cite></label>
                            <div class="col-sm-5">
                            <select name="area_code" id="area_code" class="form-control" required>
                                <option value="">เลือกเขตพื้นที่การศึกษา</option>
                                <?php foreach ($area as $c) { ?>
                                <option value="<?=$c['area_code']?>" <?php if($c['area_code']==$user['user_area']){ echo "selected";}?>><?=$c['area_name']." (".$c['area_code'].")"?></option>
                                <?php } ?>
                            </select>
                            </div>
                        </div>
                        <div class="form-group row">
                            <label for="sch_code" class="col-sm-3 col-form-label">โรงเรียน <cite class="req-text">*</cite></label>
                            <div class="col-sm-5">
                                <select name="sch_code" id="sch_code" class="form-control" required>
                                    <option value="">เลือกโรงเรียน</option>
                                    <?php foreach ($school as $c) { ?>
                                    <option value="<?=$c['sch_id']?>" <?php if($c['sch_id']==$user['sch_id']){ echo "selected";}?>><?=$c['sch_name']." (".$c['sch_code'].")"?></option>
                                    <?php } ?>
                                </select>
                            </div>
                        </div>

<!--                        <div class="form-group row">
                            <label for="user_address" class="col-sm-3 col-form-label">ที่อยู่ <cite class="req-text">*</cite></label>
                            <div class="col-sm-6">
                            <input value="<?=$user['user_address']?>" type="text" class="form-control" id="user_address" name="user_address" placeholder="บ้านเลขที่ หมู่ที่ ห้องที่ ถนน" required>
                            </div>
                        </div>

                        <div class="form-group row">
                            <label for="user_prov" class="col-sm-3 col-form-label">จังหวัด <cite class="req-text">*</cite></label>
                            <div class="col-sm-9">
                                <select name="user_prov" id="user_prov" class="form-control" style="max-width:350px;" required>
                                <option value="">เลือกจังหวัด</option>
                                <?php if($user['user_prov']){?>
                                <?php foreach ($prov as $c) { ?>
                                <option value="<?=$c['code']?>" <?php if($user['user_prov']==$c['code']){?> selected <?php } ?>><?=$c['name']?></option>
                                <?php } ?>
                                <?php } else {?>
                                <?php foreach ($prov as $c) { ?>
                                <option value="<?=$c['code']?>" ><?=$c['name']?></option>
                                <?php } ?>
                                <?php } ?>
                                </select>
                            </div>
                        </div>

                        <div class="form-group row">
                            <label for="user_amp" class="col-sm-3 col-form-label">อำเภอ <cite class="req-text">*</cite></label>
                            <div class="col-sm-9">
                                <select name="user_amp" id="user_amp" class="form-control" style="max-width:350px;" required>
                                <?php if($user['user_amp']){?>
                                <?php foreach ($amp as $d) { ?>
                                <option value="<?=$d['amphur_code']?>" <?php if($user['user_amp']==$d['amphur_code']){?> selected <?php } ?>><?=$d['name']?></option>
                                <?php } ?>
                                <?php } else {?>
                                <option value="">เลือกอำเภอ</option>
                                <?php } ?>
                                </select>
                            </div>
                        </div>

                        <div class="form-group row">
                            <label for="user_tumbon" class="col-sm-3 col-form-label">ตำบล <cite class="req-text">*</cite></label>
                            <div class="col-sm-9">
                                <select name="user_tumbon" id="user_tumbon" class="form-control" style="max-width:350px;" required>
                                <?php if($user['user_tumbon']){?>
                                <?php foreach ($tumbon as $e) { ?>
                                <option value="<?=$e['tumbon_code']?>" <?php if($user['user_tumbon']==$e['tumbon_code']){?> selected <?php } ?>><?=$e['name']?></option>
                                <?php } ?>
                                <?php } else {?>
                                <option value="">เลือกตำบล</option>
                                <?php } ?>
                                </select>
                            </div>
                        </div>

                            <div class="form-group row">
                            <label for="user_post" class="col-sm-3 col-form-label">รหัสไปรษณีย์ <cite class="req-text">*</cite></label>
                            <div class="col-sm-2">
                                <input value="<?=$user['user_post']?>" type="text" class="form-control" id="user_post" name="user_post" placeholder="99999" data-inputmask='"mask": "99999"' data-mask required>
                            </div>
                        </div>-->

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

                        <!--<div class="form-group row">
                            <label for="user_LineId" class="col-sm-3 col-form-label">ที่อยู่ LineID </label>
                            <div class="col-sm-2">
                            <input value="<?=$user['user_LineId']?>" type="text" class="form-control" id="user_LineId" name="user_LineId" >
                            </div>
                        </div>

                        <div class="form-group row">
                            <label for="user_facebook" class="col-sm-3 col-form-label">ที่อยู่ Facebook </label>
                            <div class="col-sm-2">
                            <input value="<?=$user['user_facebook']?>" type="text" class="form-control" id="user_facebook" name="user_facebook" >
                            </div>
                        </div>

                        <div class="form-group row">
                            <label for="user_twitter" class="col-sm-3 col-form-label">ที่อยู่ Twitter </label>
                            <div class="col-sm-2">
                            <input value="<?=$user['user_twitter']?>" type="text" class="form-control" id="user_twitter" name="user_twitter" >
                            </div>
                        </div>

                        <div class="form-group row">
                            <label for="user_tiktok" class="col-sm-3 col-form-label">ที่อยู่ Tiktok </label>
                            <div class="col-sm-2">
                            <input value="<?=$user['user_tiktok']?>" type="text" class="form-control" id="user_tiktok" name="user_tiktok" >
                            </div>
                        </div>

                        <div class="form-group row">
                            <label for="user_IG" class="col-sm-3 col-form-label">ที่อยู่ Instragram </label>
                            <div class="col-sm-2">
                                <input value="<?=$user['user_IG']?>" type="text" class="form-control" id="user_IG" name="user_IG" >
                            </div>
                        </div>-->

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
  
  <!-- ส่วนของ Footer -->
  <?php echo view('template/footer'); ?>
 
<script>
    $(document).ready(function(){


        //เลือกเขตพื้นที่ฯจากเขตตรวจฯ
        $('#clus_code').change(function() {
            var code = $(this).val();
            $.ajax({
            url: "https://moral.obec.go.th/kuru/school/areaSearch",
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
            }
            });
            return false;
        });

        //เลือกโรงเรียนจากเขตฯ
        $('#area_code').change(function() {
            var code = $(this).val();
            $.ajax({
            url: "https://moral.obec.go.th/kuru/school/schoolSearch",
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

        //เลือกอำเภอจากจังหวัด
        $('#user_prov').change(function() {
            var code = $(this).val();
            $.ajax({
                url: "https://moral.obec.go.th/kuru/school/amphurSearch",
                type: "POST",
                dataType: "json",
                data: {
                "code": code
                },
                async: true,
                success: function(data) {
                var html = '';
                var i;
                html += '<option value="">เลือกอำเภอ</option>';
                for (i = 0; i < data.length; i++) {
                    html += '<option value=' + data[i].amphur_code + '>' + data[i].name + '</option>';
                }
                $('#user_amp').html(html);
                $('#user_tumbon').html('<option value="">เลือกตำบล</option>');

                }
            });
            return false;
        });

        //เลือกตำบลจากอำเภอ
        $('#user_amp').change(function() {
            var code = $(this).val();
            $.ajax({
                url: "https://moral.obec.go.th/kuru/school/tumbonSearch",
                type: "POST",
                dataType: "json",
                data: {
                "code": code
                },
                async: true,
                success: function(data) {
                var html = ''; 
                var i;
                html += '<option value="">เลือกตำบล</option>';
                for (i = 0; i < data.length; i++) {
                    html += '<option value=' + data[i].tumbon_code + '>' + data[i].name + '</option>';
                }
                $('#user_tumbon').html(html);
                $('#user_post').val(data[0].zipcode);

                }
            });
            return false;
        });

    });
</script>
