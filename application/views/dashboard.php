<main class="main">
  <!-- Breadcrumb-->
  <ol class="breadcrumb">
    <li class="breadcrumb-item">Dashboard</li>
  </ol>
  <div class="container-fluid">
    <div class="animated fadeIn">
      <div class="row">
        <?php
          if($role == ROLE_ADMIN || $role == ROLE_MANAGER)
          {
        ?>  
        <div class="col-12 col-lg-3">
          <div class="card">
            <div class="card-body p-3 d-flex align-items-center">
              <i class="nav-icon icon-user bg-primary p-3 font-2xl mr-3"></i>
              <div>
                <div class="text-value-sm text-primary"><?php echo $userInfo;  ?></div>
                <div class="text-muted text-uppercase font-weight-bold small">Users</div>
              </div>
            </div>
            <div class="card-footer px-3 py-2">
              <a class="btn-block text-muted d-flex justify-content-between align-items-center" href="<?php echo base_url(); ?>userlist">
                <span class="small font-weight-bold">View More</span>
                <i class="fa fa-angle-right"></i>
              </a>
            </div>
          </div>
        </div>
        <?php
          }
          if($role == ROLE_ADMIN)
          {
        ?> 
        <div class="col-12 col-lg-3">
          <div class="card">
            <div class="card-body p-3 d-flex align-items-center">
              <i class="nav-icon icon-puzzle bg-warning p-3 font-2xl mr-3"></i>
              <div>
                <div class="text-value-sm text-warning"><?php echo $serviceInfo;  ?></div>
                <div class="text-muted text-uppercase font-weight-bold small">Services</div>
              </div>
            </div>
            <div class="card-footer px-3 py-2">
              <a class="btn-block text-muted d-flex justify-content-between align-items-center" href="<?php echo base_url(); ?>servicelist">
                <span class="small font-weight-bold">View More</span>
                <i class="fa fa-angle-right"></i>
              </a>
            </div>
          </div>
        </div>
        <div class="col-12 col-lg-3">
          <div class="card">
            <div class="card-body p-3 d-flex align-items-center">
              <i class="nav-icon icon-tag bg-danger p-3 font-2xl mr-3"></i>
              <div>
                <div class="text-value-sm text-danger"><?php echo $stageInfo;  ?></div>
                <div class="text-muted text-uppercase font-weight-bold small">Stages</div>
              </div>
            </div>
            <div class="card-footer px-3 py-2">
              <a class="btn-block text-muted d-flex justify-content-between align-items-center" href="<?php echo base_url(); ?>stagelist">
                <span class="small font-weight-bold">View More</span>
                <i class="fa fa-angle-right"></i>
              </a>
            </div>
          </div>
        </div>        
        <?php
          }
          if($role == ROLE_EMPLOYEE)
          {
        ?>         
        <div class="col-12 col-lg-3">
          <div class="card">
            <div class="card-body p-3 d-flex align-items-center">
              <i class="nav-icon icon-people bg-info p-3 font-2xl mr-3"></i>
              <div>
                <div class="text-value-sm text-info"><?php echo $customerInfo;  ?></div>
                <div class="text-muted text-uppercase font-weight-bold small">Customers</div>
              </div>
            </div>
            <div class="card-footer px-3 py-2">
              <a class="btn-block text-muted d-flex justify-content-between align-items-center" href="<?php echo base_url(); ?>customerlist">
                <span class="small font-weight-bold">View More</span>
                <i class="fa fa-angle-right"></i>
              </a>
            </div>
          </div>
        </div>
        <?php
          }
        ?>
      </div>
    </div>
  </div>
</main>
</div>