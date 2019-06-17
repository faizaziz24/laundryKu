    <footer class="app-footer">
      <div>
        <a href="<?php echo base_url(); ?>dashboard">laundryKu</a>
        <span>&copy; 2019</span>
      </div>
      <div class="ml-auto">
        <span>Powered by</span>
        <a href="https://github.com/faizaziz24">faiz_aziz24</a>
      </div>
    </footer>
    <script src="<?php echo base_url(); ?>assets/bootstrap/dist/js/bootstrap.min.js"></script>
    <script src="<?php echo base_url(); ?>assets/js/common.js" type="text/javascript"></script>    
    <script src="<?php echo base_url(); ?>assets/js/jquery.validate.js" type="text/javascript"></script>
    <script src="<?php echo base_url(); ?>assets/js/validation.js" type="text/javascript"></script>
    <script type="text/javascript">
        var windowURL = window.location.href;
        pageURL = windowURL.substring(0, windowURL.lastIndexOf('/'));
        var x= $('a[href="'+pageURL+'"]');
            x.addClass('active');
            x.parent().addClass('active');
        var y= $('a[href="'+windowURL+'"]');
            y.addClass('active');
            y.parent().addClass('active');
    </script>
    <!-- CoreUI and necessary plugins-->
    <script src="<?php echo base_url(); ?>assets/vendors/jquery/js/jquery.min.js"></script>
    <script src="<?php echo base_url(); ?>assets/vendors/popper.js/js/popper.min.js"></script>
    <script src="<?php echo base_url(); ?>assets/vendors/bootstrap/js/bootstrap.min.js"></script>
    <script src="<?php echo base_url(); ?>assets/vendors/pace-progress/js/pace.min.js"></script>
    <script src="<?php echo base_url(); ?>assets/vendors/perfect-scrollbar/js/perfect-scrollbar.min.js"></script>
    <script src="<?php echo base_url(); ?>assets/vendors/@coreui/coreui/js/coreui.min.js"></script>
    <!-- Plugins and scripts required by this view-->
    <script src="<?php echo base_url(); ?>assets/vendors/chart.js/js/Chart.min.js"></script>
    <script src="<?php echo base_url(); ?>assets/vendors/@coreui/coreui-plugin-chartjs-custom-tooltips/js/custom-tooltips.min.js"></script>
    <script src="<?php echo base_url(); ?>assets/js/main.js"></script>
    <script src="<?php echo base_url(); ?>assets/js/ckeditor/ckeditor.js"></script>
    <script>
      CKEDITOR.replace('editor1');
    </script>
  </body>
</html>