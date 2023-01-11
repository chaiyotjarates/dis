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

        <div class="row">
          
            <div class="col-md-12">
                
                    <div class="card card-info">

                        <div class="card-header">
                            <h3 class="card-title">สมาชิกของโรงเรียน <?=session()->get('fullname')?></h3>
                        </div>
        
                        <div class="card-body">

                            <?php if (session()->getFlashdata('success')): ?>
                                <div class="alert alert-success text-center"><?php echo session()->getFlashdata('success'); ?></div>
                            <?php endif; ?>

                            <?php if (session()->getFlashdata('error')): ?>
                                <div class="alert alert-danger text-left"><?php echo session()->getFlashdata('error'); ?></div>
                            <?php endif; ?>

                            <?php if (isset($validation)): ?>
                                <div class="alert alert-danger text-left"><i class="fe fe-alert-circle fs-16"></i> <?php echo $validation->listErrors(); ?></div>
                            <?php endif; ?>

                            <table id="tb" class="display" style="width:100%">
                                <thead>
                                    <tr>
                                        <th>#</th>
                                        <th>ชื่อ-สกุล</th>
                                        <th>โรงเรียน</th>
                                        <th>ตัวเลือก</th>
                                    </tr>
                                </thead>
                            </table>

                        </div> 
                        <!-- /.card-body -->

                        <div class="card-footer">
                            
                        </div>
                        <!-- /.card-footer -->

                    </div>

            </div>

        </div>
        <!-- /.row -->

      </div>

    </section>
    <!-- /.content -->

</div>
<!-- /.content-wrapper -->

    <!-- ส่วนของ script -->
    <?php echo view('template/script'); ?>

 
<script>
    $(document).ready(function() {
        var t = $('#tb').DataTable({
            processing: true,
            serverSide: true,
            ajax: '<?=base_url(session()->get("checktype")."/listTeachersData")?>',

            columnDefs: [
                { 
                    searchable: false,
                    orderable: false,
                    targets: 0,
                },
            ],
            order: [[1, 'asc']],
        });

        t.on( 'draw.dt', function () {
            var PageInfo = $('#tb').DataTable().page.info();
            t.column(0, { page: 'current' }).nodes().each( function (cell, i) {
                cell.innerHTML = i + 1 + PageInfo.start;
            } );
        } );

    });
</script>
<!-- ส่วนของ Footer -->
<?php echo view('template/footer'); ?>
   