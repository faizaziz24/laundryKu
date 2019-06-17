
    <main class="main">
        <!-- Breadcrumb-->
        <ol class="breadcrumb">
          <li class="breadcrumb-item"><a href="<?php echo base_url(); ?>userlist">Users</a></li>
          <li class="breadcrumb-item active">Login History</li>
        </ol>

        <div class="container-fluid">
          <div class="animated fadeIn">
            <!-- /.card-->
            <div class="row">
              <!-- /.col-->
              <div class="col-lg-12">
                <div class="card">
                  <div class="card-header">
                    <i class="fa fa-user-o"></i>Track Login History ( <?= !empty($userInfo) ? $userInfo->name." : ".$userInfo->email : "All users" ?> )</div>
                  <div class="card-body">
                    <form action="<?php echo base_url() ?>loginhistory" method="POST" id="searchList">
                      <div class="row">
                        <div class="form-group col-lg-4">
                          <div class="form-group row">
                            <label class="col-md-4 col-form-label" for="date-input">From Date</label>
                            <div class="col-md-8">
                              <input class="form-control" id="fromDate" type="date" name="fromDate" value="<?php echo $fromDate; ?>" placeholder="date" autocomplete="off">
                            </div>
                          </div>
                        </div>
                        <div class="form-group col-lg-3">
                          <div class="form-group row">
                            <label class="col-md-4 col-form-label" for="date-input">to Date</label>
                            <div class="col-md-8">
                              <input class="form-control" id="toDate" type="date" name="toDate" value="<?php echo $toDate; ?>" placeholder="date" autocomplete="off">
                            </div>
                          </div>
                        </div>
                        <div class="form-group col-lg-3">
                          <div class="input-group">
                            <input id="searchText" type="text" name="searchText" value="<?php echo $searchText; ?>" class="form-control" placeholder="Search Text"/>
                          </div>
                        </div>
                        <div class="form-group col-lg-1">
                          <button class="btn btn-block btn-primary searchList"><i class="fa fa-search"></i></button>
                        </div>
                        <div class="form-group col-lg-1">
                          <button class="btn btn-md btn-default btn-block pull-right resetFilters"><i class="fa fa-refresh" aria-hidden="true"></i></button>
                        </div>
                      </div>
                    </form>
                    <table class="table table-responsive-sm table-bordered">
                      <thead>
                        <tr class="text-center">
                          <th>Session Data</th>
                          <th>IP Address</th>
                          <th>User Agent</th>
                          <th>Agent Full String</th>
                          <th>Platform</th>
                          <th>Date-Time</th>
                        </tr>
                      </thead>
                      <tbody>
                        <?php
                        if(!empty($userRecords))
                        {
                            foreach($userRecords as $record)
                            {
                        ?>
                        <tr>
                          <td><?php echo $record->sessionData ?></td>
                          <td><?php echo $record->machineIp ?></td>
                          <td><?php echo $record->userAgent ?></td>
                          <td><?php echo $record->agentString ?></td>
                          <td><?php echo $record->platform ?></td>
                          <td><?php echo $record->createdDtm ?></td>
                        </tr>
                        <?php
                            }
                        }
                        ?>
                      </tbody>
                    </table>
                    <ul class="pagination">
                      <?php echo $this->pagination->create_links(); ?>
                    </ul>
                  </div>
                </div>
              </div>
              <!-- /.col-->
            </div>
          </div>
        </div>
    </main>
</div>
<script src="<?php echo base_url(); ?>assets/bootstrap-datepicker/dist/js/bootstrap-datepicker.min.js"></script>
<script type="text/javascript">
    jQuery(document).ready(function(){
        jQuery('ul.pagination li a').click(function (e) {
            e.preventDefault();            
            var link = jQuery(this).get(0).href;
            jQuery("#searchList").attr("action", link);
            jQuery("#searchList").submit();
        });

        jQuery('.datepicker').datepicker({
          autoclose: true,
          format : "dd-mm-yyyy"
        });
        jQuery('.resetFilters').click(function(){
          $(this).closest('form').find("input[type=text]").val("");
        })
    });
</script>