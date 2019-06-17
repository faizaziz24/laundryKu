<?php
$customerId = $customerInfo->customerId;
$name = $customerInfo->name;
$address = $customerInfo->address;
$mobile = $customerInfo->mobile;
?>
<main class="main">
<!-- Breadcrumb-->
<ol class="breadcrumb">
  <li class="breadcrumb-item"><a href="<?php echo base_url(); ?>customerlist">Customers</a></li>
  <li class="breadcrumb-item active">Edit Customer</li>
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
              <form action="<?php echo base_url(); ?>editcustomer" method="post" role="form" id="editCustomer">
                  <div class="card-body">
                    <div class="form-group row">
                      <label class="col-md-3 col-form-label" for="fname">Name</label>
                      <div class="col-md-9">
                        <input type="text" class="form-control required" value="<?php echo $name; ?>" id="fname" name="fname" maxlength="128">
                        <input type="hidden" value="<?php echo $customerId; ?>" name="customerId" id="customerId" />  
                      </div>
                    </div>
                    <div class="form-group row">
                      <label class="col-md-3 col-form-label" for="mobile">Mobile</label>
                      <div class="col-md-9">
                        <input type="text" class="form-control" id="mobile" placeholder="Mobile Number" name="mobile" value="<?php echo $mobile; ?>" maxlength="10">
                      </div>
                    </div>
                    <div class="form-group row">
                      <label class="col-md-3 col-form-label" for="address">Address</label>
                      <div class="col-md-9">
                        <input type="text" class="form-control" id="address" placeholder="Address" name="address" value="<?php echo $address; ?>">
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
<script src="<?php echo base_url(); ?>assets/js/edit-old.js" type="text/javascript"></script>