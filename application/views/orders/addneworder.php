
<main class="main">
<!-- Breadcrumb-->
<ol class="breadcrumb">
  <li class="breadcrumb-item active">Transaction</li>
</ol>

<div class="container-fluid">
  <div class="animated fadeIn">
    <!-- /.card-->
    <div class="row">
      <!-- /.col-->
      <div class="col-lg-6">

        <div class="card">
          <div class="card-header">
            <strong>Transaction</strong> Form</div>
            <?php $this->load->helper("form"); ?>
              <form action="<?php echo base_url(); ?>saveneworder" method="post" role="form" id="addOrder">
                  <div class="card-body was-validated">
                    <div class="form-group row">
                      <label class="col-md-3 col-form-label" for="cusrole">Customer</label>
                      <div class="col-md-9">
                        <select class="form-control required" id="cusrole" name="cusrole">
                          <option value="">Select Customer</option>
                          <?php
                          if(!empty($cusroles))
                          {
                              foreach ($cusroles as $rl)
                              {
                                  ?>
                                  <option value="<?php echo $rl->customerId ?>" <?php if($rl->customerId == set_value('name')) {echo "selected=selected";} ?>><?php echo $rl->name ?></option>
                                  <?php
                              }
                          }
                          ?>
                        </select>
                      </div>
                    </div>
                    <div class="form-group row">
                      <label class="col-md-3 col-form-label" for="svcrole">Service</label>
                      <div class="col-md-9">
                        <select class="form-control required" id="svcrole" name="svcrole">
                          <option value="">Select Service</option>
                          <?php
                          if(!empty($svcroles))
                          {
                              foreach ($svcroles as $rl)
                              {
                                  ?>
                                  <option value="<?php echo $rl->serviceId ?>" <?php if($rl->serviceId == set_value('service')) {echo "selected=selected";} ?>>Rp.<?php echo $rl->price ?>,00 - <?php echo $rl->service ?></option>
                                  <?php
                              }
                          }
                          ?>
                        </select>
                      </div>
                    </div>
                    <div class="form-group row">
                      <label class="col-md-3 col-form-label" for="weight">Weight</label>
                      <div class="col-md-2">
                        <input type="number" class="form-control required" value="<?php echo set_value('weight'); ?>" id="weight" name="weight" min="1" max="99">
                      </div>
                      <label class="col-md-3 col-form-label"">kg</label>
                    </div>
                    <div class="form-group row">
                      <label class="col-md-3 col-form-label" for="memo">Memo</label>
                      <div class="col-md-9">
                         <textarea class="form-control required" id="memo" name="memo" rows="9" placeholder="Memo.."><?php echo set_value('memo'); ?></textarea>
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