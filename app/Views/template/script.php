
  <footer class="main-footer">
    <strong><a href="<?php echo lang('Constant.webKuru');?>"><?php echo lang('Constant.webTitle_full');?></a> : <?php echo lang('Constant.webAuth_Obec_Short');?> </strong>
    <div class="float-right d-none d-sm-inline-block">
      <b>Version</b> <?php echo lang('Constant.webVersion');?>
    </div>
  </footer>

  <aside class="control-sidebar control-sidebar-dark">
  </aside>
</div>
<!-- ./wrapper -->

<script src="<?=base_url()?>/plugins/jquery/jquery.min.js"></script>
<script src="<?=base_url()?>/plugins/jquery-ui/jquery-ui.min.js"></script>
<script>
  $.widget.bridge('uibutton', $.ui.button)
</script>
<script src="<?=base_url()?>/plugins/bootstrap/js/bootstrap.bundle.min.js"></script>
<script src="<?=base_url()?>/plugins/moment/moment.min.js"></script>
<script src="<?=base_url()?>/plugins/daterangepicker/daterangepicker.js"></script>
<script src="<?=base_url()?>/plugins/tempusdominus-bootstrap-4/js/tempusdominus-bootstrap-4.min.js"></script>
<script src="<?=base_url()?>/plugins/bs-custom-file-input/bs-custom-file-input.min.js"></script>
<script src="<?=base_url()?>/plugins/inputmask/jquery.inputmask.min.js"></script>
<script src="<?=base_url()?>/plugins/summernote/summernote-bs4.min.js"></script>
<script src="<?=base_url()?>/plugins/overlayScrollbars/js/jquery.overlayScrollbars.min.js"></script>
<script src="<?=base_url()?>/dist/js/adminlte.js?v=3.2.0"></script>
<script src="<?=base_url()?>/dist/js/pages/dashboard.js"></script>
<script src="<?=base_url()?>/plugins/select2/js/select2.min.js"></script>
<script src="<?=base_url()?>/plugins/bootstrap-switch/js/bootstrap-switch.min.js"></script>
<script src="<?=base_url()?>/dist/js/custom.js"></script>
<!-- date-range-picker -->
<script src="<?=base_url()?>/plugins/datepicker/js/bootstrap-datepicker.min.js"></script>

<script src="<?=base_url()?>/plugins/sweetalert3/sweetalert.min.js"></script>
<!--<script src="https://unpkg.com/sweetalert/dist/sweetalert.min.js"></script>-->
<!--<script src="<?=base_url()?>/plugins/sweetalert3/sweetalert3.js"></script>-->

<!--<script src="//cdn.datatables.net/1.13.1/js/jquery.dataTables.min.js"></script>-->

<script type="text/javascript">
  $(document).ready(function ($) {

    /*$('input').iCheck({
      checkboxClass: 'icheckbox_minimal-red',
      radioClass: 'iradio_minimal-red'
    });*/

  $("input[data-bootstrap-switch]").each(function(){
    $(this).bootstrapSwitch('state', $(this).prop('checked'));
  });
});
</script>
