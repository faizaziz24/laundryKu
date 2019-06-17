<?php
$orderId    = $orderInfo->orderId;
$stageId  = $orderInfo->stageId;
$stageId    = $orderInfo->stageId;
$cusname    = $orderInfo->name;
$weight     = $orderInfo->weight;
$cost       = $orderInfo->cost;
$memo       = $orderInfo->memo;
?>

<main class="main">
<!-- Breadcrumb-->
<ol class="breadcrumb">
  <li class="breadcrumb-item"><a href="<?php echo base_url(); ?>orderlist">Order List</a></li>
  <li class="breadcrumb-item active">Edit Order</li>
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
              <form role="form" action="<?php echo base_url() ?>editorder" method="post" id="editOrder" role="form">
                  <div class="card-body">
                          <div class="form-group row">
                            <label class="col-md-3 col-form-label" for="cusname">Name</label>
                            <div class="col-md-9">
                              <input type="text" class="form-control required" value="<?php echo $cusname; ?>" id="cusname" name="cusname" disabled>
                              <input type="hidden" value="<?php echo $orderId; ?>" name="orderId" id="orderId" />  
                            </div>
                          </div>                          
                          <div class="form-group row">
                            <label class="col-md-3 col-form-label" for="weight">Weight</label>
                            <div class="col-md-9">
                              <input type="text" class="form-control" id="weight" placeholder="weight Number" name="weight" value="<?php echo $weight; ?> kg" disabled>
                            </div>
                          </div>
                          <div class="form-group row">
                            <label class="col-md-3 col-form-label" for="memo">Memo</label>
                            <div class="col-md-9">
                               <textarea class="form-control" id="memo" name="memo" rows="9" placeholder="Memo.." disabled="disabled"><?php echo $memo; ?></textarea>
                            </div>
                          </div>
                          <div class="form-group row">
                            <label class="col-md-3 col-form-label" for="weight">Cost</label>
                            <div class="col-md-9">
                              <input type="text" class="form-control" id="weight" placeholder="weight Number" name="weight" value="Rp. <?php echo $weight*$cost; ?>" disabled>
                            </div>
                          </div>
                          <div class="form-group row">
                            <label class="col-md-3 col-form-label" for="stgrole">Role</label>
                            <div class="col-md-9">
                              <select class="form-control" id="stgrole" name="stgrole">
                                <?php
                                if(!empty($stages))
                                {
                                    foreach ($stages as $stg)
                                    {
                                        ?>
                                        <option value="<?php echo $stg->stageId; ?>" <?php if($stg->stageId == $stageId) {echo "selected=selected";} ?>><?php echo $stg->stage ?></option>
                                        <?php
                                    }
                                }
                                ?>
                              </select>
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