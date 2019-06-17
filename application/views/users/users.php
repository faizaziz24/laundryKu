    <main class="main">
        <!-- Breadcrumb-->
        <ol class="breadcrumb">
          <li class="breadcrumb-item">Users</li>
          <div class="ml-auto">
              <a class="btn btn-sm btn-success" href="<?php echo base_url(); ?>adduser"><i class="fa fa-plus"></i> New User</a>
          </div>
        </ol>

        <div class="container-fluid">
          <div class="animated fadeIn">
            <!-- /.card-->
            <div class="row">
              <!-- /.col-->
              <div class="col-lg-12">
                <div class="card">
                  <div class="card-header">
                    <i class="nav-icon icon-user"></i>User Table</div>
                  <div class="card-body">
                    <div class="form-group row">
                      <div class="col-md-12">
                        <form action="<?php echo base_url() ?>userlist" method="POST" id="searchList">
                            <div class="input-group">
                              <span class="input-group-prepend">
                                <button class="btn btn-primary searchList">
                                  <i class="fa fa-search"></i> Search</button>
                              </span>
                              <input class="form-control" type="text" name="searchText" value="<?php echo $searchText; ?>" placeholder="Search">
                            </div>
                        </form>
                      </div>
                    </div>
                    <table class="table table-responsive-sm table-bordered">
                      <thead>
                        <tr class="text-center">
                          <th data-field="id">No</th>
                            <th>Name</th>
                            <th>Email</th>
                            <th>Phone</th>
                            <th>Role</th>
                            <th>Created On</th>
                            <th>Action</th>
                        </tr>
                      </thead>
                      <tbody>
                        <?php
                        if(!empty($userRecords))
                        {
                            $count=0; foreach($userRecords as $record)
                            {
                        ?>
                        <tr>
                            <td><?php echo ++$count ?></td>
                            <td><?php echo $record->name ?></td>
                            <td><?php echo $record->email ?></td>
                            <td><?php echo $record->mobile ?></td>
                            <td><?php echo $record->role ?></td>
                            <td><?php echo date("d-m-Y", strtotime($record->createdDtm)) ?></td>
                            <td class="text-center">
                                <a class="btn btn-sm btn-primary" href="<?= base_url().'loginhistory/'.$record->userId; ?>" title="Login history"><i class="fa fa-history"></i></a> | 
                                <a class="btn btn-sm btn-info" href="<?php echo base_url().'editolduser/'.$record->userId; ?>" title="Edit"><i class="fa fa-pencil"></i></a>
                                <a class="btn btn-sm btn-danger deleteUser" href="userlist" data-userid="<?php echo $record->userId; ?>" title="Delete"><i class="fa fa-trash"></i></a>
                            </td>
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
<script type="text/javascript">
    jQuery(document).ready(function(){
        jQuery('ul.pagination li a').click(function (e) {
            e.preventDefault();            
            var link = jQuery(this).get(0).href;            
            var value = link.substring(link.lastIndexOf('/') + 1);
            jQuery("#searchList").attr("action", baseURL + "userlist/" + value);
            jQuery("#searchList").submit();
        });
    });
</script>