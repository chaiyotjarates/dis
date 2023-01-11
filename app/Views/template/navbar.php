  <!-- Navbar -->
  <nav class="main-header navbar navbar-expand navbar-pink navbar-dark">
    <!-- Left navbar links -->
    <ul class="navbar-nav">
      <li class="nav-item">
        <a class="nav-link" data-widget="pushmenu" href="#" role="button"><i class="fas fa-bars"></i></a>
      </li>
      <li class="nav-item d-none d-sm-inline-block">
        <a href="https://moral.obec.go.th/" class="nav-link"><i class="fas fa-link fa-fw"></i> โรงเรียนคุณธรรม สพฐ.</a>
      </li>
    </ul>

    <!-- Right navbar links -->
    <ul class="navbar-nav ml-auto">

      <li class="nav-item">
        <a class="nav-link" href="#" role="button">
          <?php
            if(session()->get('checktype') == 'admin'):
              echo ' ผู้ดูแลระบบ ';
            elseif(session()->get('checktype') == 'obec'):
              echo ' เจ้าหน้าที่ สพฐ. ';
            elseif(session()->get('checktype') == 'cluster'):
              echo ' เขตตรวจราชการ ';
            elseif(session()->get('checktype') == 'area'):
              echo session()->get('areaName').' ('.session()->get('areaCode').')';
            elseif(session()->get('checktype') == 'school'):
              echo 'โรงเรียน : '.session()->get('schoolName').' ('.session()->get('schoolCode').')';
            elseif(session()->get('checktype') == 'teacher'):
              echo ' ครู รร. ';
              echo session()->get('schoolName').' ('.session()->get('schoolCode').')';
            else:
              echo ' บุคคลทั่วไป';
            endif; 

          ?>
        </a>
      </li>

      <li class="nav-item">
        <a class="nav-link" data-widget="fullscreen" href="#" role="button">
          <i class="fas fa-expand-arrows-alt"></i>
        </a>
      </li>
      <li class="nav-item">
        <a class="nav-link" data-widget="control-sidebar" data-controlsidebar-slide="true" href="#" role="button">
          <i class="fas fa-th-large"></i>
        </a>
      </li>
    </ul>
  </nav>
  <!-- /.navbar -->