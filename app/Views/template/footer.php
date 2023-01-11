
<script>
  $(function() {
    $('[data-mask]').inputmask()
    $("input[data-bootstrap-switch]").each(function() {
      $(this).bootstrapSwitch('state', $(this).prop('checked'));
    })
  });

  $(document).ready(function() {
      var timeout = 2000; // in miliseconds (3*1000)
      $('.alert').delay(timeout).fadeOut(1200);
  });
</script>
</body>
</html>
