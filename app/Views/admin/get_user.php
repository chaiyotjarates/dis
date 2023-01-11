<!-- ส่วนของ Header -->
<?php echo view('template/header'); ?>

<link href="<?=base_url()?>/plugins/datatables/buttons.bootstrap.min.css" rel="stylesheet" type="text/css" />
<link href="<?=base_url()?>/plugins/datatables/extensions/Buttons/css/buttons.dataTables.css" rel="stylesheet" type="text/css" />
<link href="<?=base_url()?>/plugins/datatables/dataTables.bootstrap.css" rel="stylesheet" type="text/css" />
<link href="<?=base_url()?>/plugins/datatables/extensions/TableTools/css/dataTables.tableTools.css" rel="stylesheet" type="text/css" />
<link href="<?=base_url()?>/plugins/datatables/jquery.dataTables.css" rel="stylesheet" type="text/css" />
<link rel="stylesheet" type="text/css" href="<?=base_url()?>/vendors/tables/datatable/dataTables.bootstrap4.min.css">
<link rel="stylesheet" type="text/css" href="<?=base_url()?>/vendors/tables/datatable/datatables.min.css">

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
    
<!-- Default box -->
<div class="card">
    <div class="card-header">
        <h3 class="card-title"><?=$title['1'];?></h3>
    </div>
    <div class="card-body p-2">
    <table id="example1" class="table table-bordered table-striped responsive" style="width:100%">
            <thead>
                <tr>
                    <th style="width: 5%" class="text-center">
                        #
                    </th>
                    <th >
                        ชื่อ - สกุล
                    </th>
                    <th style="width: 15%" class="text-center">
                        เบอร์โทร
                    </th>
                    <th style="width: 10%" class="text-center">
                        สิทธิ์
                    </th>
                    <th style="width: 15%" class="text-center">
                        สถานะ
                    </th>
                    <th style="width: 15%" class="text-center">
                        ตัวเลือก
                    </th>
                </tr>
            </thead>
            <tbody>
                <?php $i=1; foreach($user as $k => $v){ 

				        ?>
                <tr >
                    <td class="text-center" style="vertical-align: top;">
					           <?=$i;?>
					          </td>
                    <td style="vertical-align: top;">
					           <?=$v['user_prefix'].$v['user_fname']." ".$v['user_lname'];?>
                    </td>
                    <td style="vertical-align: top;">
					           <?=$v['user_phone'];?>
                    </td>
                    <td style="vertical-align: top;" class="text-center">
					           <?=$v['user_role'];?>
                    </td>
                    <td style="vertical-align: top;" class="text-center">
                      <?php if($v['user_status']=="ไม่อนุมัติ" || $v['user_status']=="รอดำเนินการ"){?>
					             <input type="checkbox" name="my-checkbox" data-id="<?=$v['user_id'];?>" id="switch<?=$i;?>" data-bootstrap-switch data-off-color="success" checked="true" data-on-color="danger" data-on-text="OFF" data-off-text="ON">
                      <?php }else{ ?>
					             <input type="checkbox" data-id="<?=$v['user_id'];?>" name="my-checkbox" id="switch<?=$i;?>"  data-bootstrap-switch data-off-color="danger" checked="true" data-on-color="success" data-on-text="ON" data-off-text="OFF">
                      <?php } ?>
					          </td>
                    <td class="text-center" style="vertical-align: top;">
							       <a href="<?=base_url('index.php/admin/getprofile_user/'.$v['user_id'])?>" class="btn btn-success btn-sm"><i class="fas fa-search-plus"></i>
							       </a>
        							<?php if($v['user_id'] == session()->get('user_id') or session()->get('checktype')=='admin'){?>
        							<a href="<?=base_url('index.php/admin/editprofile_user/'.$v['user_id'])?>" class="btn btn-primary btn-sm"><i class="fas fa-edit"></i>
        							</a>
        							<a onclick="deleteUser('<?=$v['user_id']?>')" class="btn btn-danger btn-sm" href="#"><i class="fa fa-trash"></i>
        							</a>
        							<?php } ?>
                    </td>
                </tr>
                <?php $i++;} ?>
            </tbody>
        </table>
    </div>
    <!-- /.card-body -->
    </div>
    <!-- /.card -->



     </div><!-- /.container-fluid -->
    </section>
    <!-- /.content -->
  </div>
  <!-- /.content-wrapper -->

  <!-- ส่วนของ script -->
  <?php echo view('template/script'); ?>

    <!-- /.Script -->
    <script src="<?=base_url()?>/plugins/datatables/js/jquery.dataTables.min.js" type="text/javascript"></script>
    <script src="<?=base_url()?>/plugins/datatables-bs4/js/dataTables.bootstrap4.min.js" type="text/javascript"></script>
    <script src="<?=base_url()?>/plugins/datatables/extensions/Buttons/js/dataTables.buttons.min.js" type="text/javascript"></script>
    <script src="<?=base_url()?>/plugins/datatables/extensions/Buttons/js/buttons.bootstrap4.min.js" type="text/javascript"></script>
    <script src="<?=base_url()?>/plugins/datatables/js/jszip.min.js" type="text/javascript"></script>
    <script src="<?=base_url()?>/plugins/datatables/extensions/Buttons/js/buttons.html5.min.js" type="text/javascript"></script>
    <script src="<?=base_url()?>/plugins/datatables/extensions/Buttons/js/buttons.print.min.js" type="text/javascript"></script>
    <script src="<?=base_url()?>/plugins/datatables/extensions/Buttons/js/buttons.colVis.min.js" type="text/javascript"></script>
    <script src="<?=base_url()?>/plugins/datatables/extensions/Responsive/js/dataTables.responsive.min.js" type="text/javascript"></script>
    <!--<script src="https://cdn.datatables.net/responsive/2.2.9/js/dataTables.responsive.min.js" type="text/javascript"></script>-->
    <!-- pdf thai-->
	  <script src="<?=base_url()?>/dist/js/pdfmake.min.js" type="text/javascript"></script>
	  <script src="<?=base_url()?>/dist/js/vfs_fonts.js" type="text/javascript"></script>
    <!-- /pdf thai-->

<script type="text/javascript">

$(document).ready(function() {

   pdfMake.fonts = {
    THSarabun: {
    normal: 'THSarabun.ttf',
    bold: 'THSarabun-Bold.ttf',
    italics: 'THSarabun-Italic.ttf',
    bolditalics: 'THSarabun-BoldItalic.ttf'
  }
  }
      var aoColumns1 = [
                            /* 0 */ { "bSortable": false , 'aTargets': [ 0 ], "responsivePriority": [1] },
                            /* 5 */ { "bSortable": true , 'aTargets': [ 1 ]},
                            /* 6 */ { "bSortable": true , 'aTargets': [ 1 ]},
                            /* 6 */ { "bSortable": true , 'aTargets': [ 1 ]},
                            /* 6 */ { "bSortable": true , 'aTargets': [ 1 ]},
                            /* 6 */ { "bSortable": true , 'aTargets': [ 1 ]},

                                ]
              oTable1 = $("#example1").dataTable({
              "aoColumns": aoColumns1,
              "aLengthMenu": [25,50,75,100,125,150,175,200],
              "responsive" : true,
              "dom" : 'lBfrtip',
              "pagingType": "full_numbers",
              "language": {
                "sProcessing": "กำลังดำเนินการ...",
                "sLengthMenu": "แสดง_MENU_ แถว",
                "sZeroRecords": "ไม่พบข้อมูล",
                "sInfo": "แสดง _START_ ถึง _END_ จาก _TOTAL_ แถว",
                "sInfoEmpty": "แสดง 0 ถึง 0 จาก 0 แถว",
                "sInfoFiltered": "(กรองข้อมูล _MAX_ ทุกแถว)",
                "sInfoPostFix": "",
                "sSearch": "ค้นหา:",
                "sUrl": "",
                "oPaginate": {
                  "sFirst": "เริ่มต้น",
                  "sPrevious": "ก่อนหน้า",
                  "sNext": "ถัดไป",
                  "sLast": "สุดท้าย"
                  }
              },
              "buttons": [
                {"extend" : 'copy', text: 'คัดลอก'}, 
                {"extend":'csv','charset': 'utf-8','bom': true,"exportOptions" : {columns: ':visible'},"filename" : 'รายชื่อผู้เข้ารับการพัฒนา' , text: 'ไฟล์ CSV'},
                {"extend" : 'excel','charset': 'utf-8','bom': true,"exportOptions" : {columns: ':visible'},"filename" : 'รายชื่อผู้เข้ารับการพัฒนา', text: 'ไฟล์ Excel'}, 
                { // กำหนดพิเศษเฉพาะปุ่ม pdf
                "extend": 'pdf', // ปุ่มสร้าง pdf ไฟล์
                "filename" : 'รายชื่อผู้เข้ารับการพัฒนา', 
                "text" : 'ไฟล์ PDF',
                "pageSize": 'A4',   // ขนาดหน้ากระดาษเป็น A4            
                "customize":function(doc){ // ส่วนกำหนดเพิ่มเติม ส่วนนี้จะใช้จัดการกับ pdfmake
                // กำหนด style หลัก
                  doc.defaultStyle = {
                  font:'THSarabun',
                  fontSize:16                                 
                  };
                } // สิ้นสุดกำหนดพิเศษปุ่ม pdf
                },
                ,{"extend" : 'print',"title" : '<?=$title['1']?>' ,text: 'พิมพ์'},
              ],
         });


});

//$(document).ready(function() { 
	var II = "<?php echo $i;?>";
	//alert(II);
	for (i = 0; i < II ; i++) {
	$('#switch'+i).on('switchChange.bootstrapSwitch', function (event, state) {
		event.preventDefault();
		var USERID = $(this).data('id');
		//if ($(this).bootstrapSwitch('state')) {     
			//alert(USERID);
			$.ajax({
				method: 'POST',
				url: "<?=base_url('index.php/admin/upstatus_user')?>",
				data: {'my_checkbox_value': USERID},
				//dataType: 'json',
				//cache: false,
				success: function(data){
					//console.log(data);
					//return data;
					//alert('Status changed successfully.');
          <?php session()->setFlashdata('success', '<i class="fe fe-check-circle fs-16"></i> แก้ไขข้อมูลสำเร็จแล้ว');?>
					location.href = "<?=base_url('index.php/admin/get_user')?>";
				}
			});
		//}else {
         //   alert("sssssssssssss");
		//}
	});
	} // for
//});

function deleteUser(UserID){
  swal({
    title: "ยืนยันการลบข้อมูล?",
    text: "หากท่านยืนยันจะลบให้กด OK เพื่อยืนยันข้อมูล",
    icon: "warning",
    buttons: true,
    primaryMode: true,
  })
  .then((delmy_user) => {
    if(delmy_user){
      location.href = "<?=base_url();?>/admin/delmy_user/" + UserID;
    }
  });
}

</script>


    <!-- ส่วนของ Footer -->
    <?php echo view('template/footer'); ?>
