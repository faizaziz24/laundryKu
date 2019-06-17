
<main class="main">
<!-- Breadcrumb-->
<ol class="breadcrumb">
  <li class="breadcrumb-item"><a href="<?php echo base_url(); ?>customerlist">Customers</a></li>
  <li class="breadcrumb-item active">Add Customer</li>
</ol>

<div class="container-fluid">
  <div class="animated fadeIn">
    <!-- /.card-->
    <div class="row">
      <!-- /.col-->
      <div class="col-lg-6">

        <div class="card">
          <div class="card-header">
            <strong>Customer</strong> Form</div>
            <?php $this->load->helper("form"); ?>
              <form action="<?php echo base_url(); ?>savenewcustomer" method="post" role="form" id="addCustomer">
                  <div class="card-body">
                    <div class="form-group row">
                      <label class="col-md-3 col-form-label" for="fname">Name</label>
                      <div class="col-md-9">
                        <input type="text" class="form-control required" value="<?php echo set_value('fname'); ?>" id="fname" name="fname" maxlength="128">
                      </div>
                    </div>
                    <div class="form-group row">
                      <label class="col-md-3 col-form-label" for="mobile">Mobile</label>
                      <div class="col-md-9">
                        <input type="text" class="form-control required digits" id="mobile" value="<?php echo set_value('mobile'); ?>" name="mobile" maxlength="13">
                      </div>
                    </div>
                    <div class="form-group row">
                      <label class="col-md-3 col-form-label" for="address">Address</label>
                      <div class="col-md-9">
                        <input type="text" class="form-control required" id="address" value="<?php echo set_value('address'); ?>" name="address">
                      </div>
                    </div>
                  </div>
                  <div class="card-footer">
                    <input type="submit" class="btn btn-primary" value="Submit" />
                    <input type="reset" class="btn btn-default" value="Reset" />
                  </div>
              </form>
        </div>

      </div>
      <!-- /.col-->
      <div class="col-lg-6">
            <?php
                $this->load->helper('form');
                $error = $this->session->flashdata('error');
                if($error)
                {
            ?>
            <div class="alert alert-danger alert-dismissable">
                <button type="button" class="close" data-dismiss="alert" aria-hidden="true">×</button>
                <?php echo $this->session->flashdata('error'); ?>                    
            </div>
            <?php } ?>
            <?php  
                $success = $this->session->flashdata('success');
                if($success)
                {
            ?>
            <div class="alert alert-success alert-dismissable">
                <button type="button" class="close" data-dismiss="alert" aria-hidden="true">×</button>
                <?php echo $this->session->flashdata('success'); ?>
            </div>
            <?php } ?>
            
            <?php echo validation_errors('<div class="alert alert-danger alert-dismissable">', ' <button type="button" class="close" data-dismiss="alert" aria-hidden="true">×</button></div>'); ?>
      </div>
    </div>
  </div>
</div>
</main>
</div>

<script src="<?php echo base_url(); ?>assets/js/add-new.js" type="text/javascript"></script>