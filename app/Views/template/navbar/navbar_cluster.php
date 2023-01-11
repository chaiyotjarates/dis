<nav class="main-header navbar navbar-expand navbar-info navbar-dark ">
    <!-- Left navbar links -->
    <ul class="navbar-nav">
      <li class="nav-item">
        <a class="nav-link" data-widget="pushmenu" href="#" role="button"><i class="fas fa-bars"></i></a>
      </li>
	    <li class="nav-item">
        <a href="<?=base_url('index.php')?>" class="navbar-brand" >
        <i class="fa fa-globe"></i>
        </a>
	    </li>
    </ul>

    <!-- Right navbar links -->
    <ul class="navbar-nav ml-auto">
      <!-- Notifications Dropdown Menu -->
      <li class="nav-item dropdown">
        <a class="nav-link" data-toggle="dropdown" href="#"><label style="vertical-align: bottom;">
        <?php
            if(session()->get('checktype') == 'admin'):
              //echo ' ผู้ดูแลระบบ ';
              echo session()->get('fullname');
            elseif(session()->get('checktype') == 'obec'):
              //echo ' เจ้าหน้าที่ สพฐ. ';
              echo session()->get('fullname');
            elseif(session()->get('checktype') == 'cluster'):
              //echo ' เขตตรวจราชการ ';
              echo session()->get('fullname');
            elseif(session()->get('checktype') == 'area'):
            //  echo session()->get('areaName').' ('.session()->get('areaCode').')';
            //echo ' เขตพื้นที่ฯ ';
              echo session()->get('fullname');
            elseif(session()->get('checktype') == 'school'):
//              echo 'โรงเรียน : '.session()->get('schoolName').' ('.session()->get('schoolCode').')';
              echo session()->get('fullname');
            elseif(session()->get('checktype') == 'teacher'):
              //echo ' ครู รร. ';
              //echo session()->get('schoolName').' ('.session()->get('schoolCode').')';
              echo session()->get('fullname');
            else:
              echo ' บุคคลทั่วไป ';
            endif; 

          ?>
          <?php if(session()->get('imgProfile') != ""){ ?>
          <img class="img-circle" src="<?=base_url()?>/uploads/profile/<?=session()->get('imgProfile');?>" height="30px;" />
          <?php }else{ ?>
          <img class="img-circle" src="<?=base_url('img/spt_logo.png')?>" height="30px;" />
          <?php } ?>   
        </a>
        
        <div class="dropdown-menu dropdown-menu-lg dropdown-menu-right">
          <span class="dropdown-item dropdown-header bg-info">ข้อมูลส่วนตัว (Profile)</span>
           <div class="dropdown-divider"></div>
          <a href="<?=base_url('index.php')?>" class="dropdown-item"><i class="fas fa-home mr-2"></i> หน้าแรกเว็บไซต์</a>
		      <div class="dropdown-divider"></div>
          <a href="<?=base_url(session()->get('checktype').'/profile')?>" class="dropdown-item">
            <i class="fas fa-user-edit mr-2"></i> แก้ไขข้อมูลส่วนตัว
          </a>
          <div class="dropdown-divider"></div>
          <a href="<?=base_url(session()->get('checktype').'/changePassword')?>" class="dropdown-item">
            <i class="fas fa-key mr-2"></i> เปลี่ยนรหัสผ่าน
          </a>
          <div class="dropdown-divider"></div>
          <a href="<?=base_url()?>/logout" class="dropdown-item dropdown-footer">
            <i class="fas fa-sign-out-alt mr-2"></i> ออกจากระบบ
          </a>
        </div>
      </li>
    </ul>
</nav>