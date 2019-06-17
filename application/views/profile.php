<?php
$userId = $userInfo->userId;
$name = $userInfo->name;
$email = $userInfo->email;
$mobile = $userInfo->mobile;
$roleId = $userInfo->roleId;
$role = $userInfo->role;
?>

<main class="main">
<!-- Breadcrumb-->
<ol class="breadcrumb">
  <li class="breadcrumb-item"><a href="<?php echo base_url(); ?>dashboard">Dashboard</a></li>
  <li class="breadcrumb-item active">Edit Profile</li>
</ol>

<div class="container-fluid">
  <div class="animated fadeIn">
    <!-- /.card-->
    <div class="row">
      <!-- /.col-->
      <div class="col-lg-12">
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
      <div class="col-lg-5">
        <div class="card">
          <div class="card-header">
            <strong>Profile</strong> Form</div>
            <?php $this->load->helper("form"); ?>
              <form action="<?php echo base_url(); ?>updateprofile" method="post" role="form" id="editProfile">
                  <div class="card-body">
                    <div class="form-group row">
                      <label class="col-md-3 col-form-label" for="fname">Full Name</label>
                      <div class="col-md-9">
                        <input type="text" class="form-control required" id="fname" name="fname" placeholder="<?php echo $name; ?>" value="<?php echo set_value('fname', $name); ?>" maxlength="128">
                        <input type="hidden" value="<?php echo $userId; ?>" name="userId" id="userId" />  
                      </div>
                    </div>
                    <div class="form-group row">
                      <label class="col-md-3 col-form-label" for="mobile">Mobile</label>
                      <div class="col-md-9">
                        <input type="text" class="form-control digits" id="mobile" name="mobile" placeholder="<?php echo $mobile; ?>" value="<?php echo set_value('mobile', $mobile); ?>" maxlength="13">
                      </div>
                    </div>
                    <div class="form-group row">
                      <label class="col-md-3 col-form-label" for="email">E-mail</label>
                      <div class="col-md-9">
                        <input type="text" class="form-control" id="email" name="email" placeholder="<?php echo $email; ?>" value="<?php echo set_value('email', $email); ?>" disabled>
                      </div>
                    </div>
                  </div>
                  <div class="card-footer">
                    <input type="submit" class="btn btn-primary" value="Submit" />
                  </div>
              </form>
        </div>

      </div>
      <!-- /.col-->
      <div class="col-lg-7">
        <div class="card">
          <div class="card-header">
            <strong>Profile</strong> Form</div>
            <?php $this->load->helper("form"); ?>
              <form action="<?php echo base_url(); ?>changePassword" method="post" role="form" id="changepass">
                  <div class="card-body">
                    <div class="form-group row">
                      <label class="col-md-4 col-form-label" for="inputPassword1">Old Password</label>
                      <div class="col-md-8">
                        <input type="password" class="form-control required" id="inputOldPassword" placeholder="Old password" name="oldPassword" maxlength="20" >
                        <input type="hidden" value="<?php echo $userId; ?>" name="userId" id="userId" />  
                      </div>
                    </div>
                    <div class="form-group row">
                      <label class="col-md-4 col-form-label" for="inputPassword1">New Password</label>
                      <div class="col-md-8">
                        <input type="password" class="form-control required" id="inputPassword1" placeholder="New password" name="newPassword" maxlength="20" >
                      </div>
                    </div>
                    <div class="form-group row">
                      <label class="col-md-4 col-form-label" for="inputPassword2">Confirm New Password</label>
                      <div class="col-md-8">
                        <input type="password" class="form-control required" id="inputPassword2" placeholder="Confirm new password" name="cNewPassword" maxlength="20" >  
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
    </div>
  </div>
</div>
</main>
</div>
<script src="<?php echo base_url(); ?>assets/js/edit-old.js" type="text/javascript"></script>
