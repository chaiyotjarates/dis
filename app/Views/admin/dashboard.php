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


        <div class="card card-timeline px-2 border-none"> 
          <ul class="bs4-order-tracking"> 
            <li class="step <?php if(strtotime($DateNow)>=strtotime($config['co_date_start']) &  strtotime($DateNow)<=strtotime($config['co_date_end'])){ echo "active";}?>"> <div><i class="fas fa-user"></i></div> รับสมัคร <br>(<?=DateThai($config['co_date_start'])?> - <?=DateThai($config['co_date_end'])?>)</li> 
            <li class="step <?php if(strtotime($DateNow)>=strtotime($config['co_areascore_start']) &  strtotime($DateNow)<=strtotime($config['co_areascore_end'])){ echo "active";}?>"> <div><i class="fas fa-bread-slice"></i></div> เขตฯประเมิน <br>(<?=DateThai($config['co_areascore_start'])?> - <?=DateThai($config['co_areascore_end'])?>)</li> 
            <li class="step <?php if(strtotime($DateNow)>=strtotime($config['co_clusscore_start']) &  strtotime($DateNow)<=strtotime($config['co_clusscore_end'])){ echo "active";}?>"> <div><i class="fas fa-truck"></i></div> เขตฯตรววประเมิน <br>(<?=DateThai($config['co_clusscore_start'])?> - <?=DateThai($config['co_clusscore_end'])?>)</li> 
            <li class="step <?php if(strtotime($DateNow)>=strtotime($config['co_datenote_start']) &  strtotime($DateNow)<=strtotime($config['co_datescore_end'])){ echo "active";}?>"> <div><i class="fas fa-birthday-cake"></i></div> สพฐ.ประเมิน <br>(<?=DateThai($config['co_datenote_start'])?> - <?=DateThai($config['co_datescore_end'])?>)</li> 
          </ul> 
          <div class="text-center text-danger mb-1">ประกาศผล ( <?=DateThai($config['co_datepublish']);?> )</div>
          <div class="text-center mb-2">ระยะเวลาดำเนินโครงการ ( <?=DateThai($config['co_date_start']);?> - <?=DateThai($config['co_datepublish']);?> )</div>
          <!--<h5 class="text-center"><b>ความก้าวหน้า</b>. การดำเนินการ!</h5>-->
        </div>

        
        <!-- Small boxes (Stat box) -->
        <div class="row">
          <div class="col-lg-3 col-6">
            <!-- small box -->
            <div class="small-box bg-info">
              <div class="inner">
                <h3><?=$teacher?></h3>

                <p>สมาชิกในโรงเรียน</p>
              </div>
              <div class="icon">
                <i class="ion ion-bag"></i>
              </div>
              <a href="<?=base_url(session()->get('checktype').'/users')?>" class="small-box-footer">ดูข้อมูล <i class="fas fa-arrow-circle-right"></i></a>
            </div>
          </div>
          <!-- ./col -->
          <div class="col-lg-3 col-6">
            <!-- small box -->
            <div class="small-box bg-success">
              <div class="inner">
                <h3><?=$confirm?></h3>

                <p>สมาชิกรอยืนยัน</p>
              </div>
              <div class="icon">
                <i class="ion ion-stats-bars"></i>
              </div>
              <a href="<?=base_url(session()->get('checktype').'/confirmUser')?>" class="small-box-footer">ดูข้อมูล <i class="fas fa-arrow-circle-right"></i></a>
            </div>
          </div>
          <!-- ./col -->
          <div class="col-lg-3 col-6">
            <!-- small box -->
            <div class="small-box bg-warning">
              <div class="inner">
                <h3><?=$award?></h3>

                <p>สมาชิกส่งผลงานแล้ว</p>
              </div>
              <div class="icon">
                <i class="ion ion-person-add"></i>
              </div>
              <a href="<?=base_url(session()->get('checktype').'/award')?>" class="small-box-footer">ดูข้อมูล <i class="fas fa-arrow-circle-right"></i></a>
            </div>
          </div>
          <!-- ./col -->
          <div class="col-lg-3 col-6">
            <!-- small box -->
            <div class="small-box bg-danger">
              <div class="inner">
                <h3><?=$awardall?></h3>

                <p>ผลงานทั้งหมด</p>
              </div>
              <div class="icon">
                <i class="ion ion-pie-graph"></i>
              </div>
              <a href="javascript:void(0)" class="small-box-footer">ดูข้อมูล <i class="fas fa-arrow-circle-right"></i></a>
            </div>
          </div>
          <!-- ./col -->
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