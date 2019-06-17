    <main class="main">
        <!-- Breadcrumb-->
        <ol class="breadcrumb">
          <li class="breadcrumb-item">Finished Orders</li>
        </ol>

        <div class="container-fluid">
          <div class="animated fadeIn">
            <!-- /.card-->
            <div class="row">
              <!-- /.col-->
              <div class="col-lg-12">
                <div class="card">
                  <div class="card-header">
                    <i class="nav-icon icon-layers"></i>Finished Order List Table</div>
                  <div class="card-body">
                    <div class="form-group row">
                      <div class="col-md-12">
                        <form action="<?php echo base_url() ?>finishedorderlist" method="POST" id="searchList">
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
                            <th>Service</th>
                            <th>Weight</th>                             
                            <th>Price</th>                   
                            <th>Cost</th>               
                            <th>Memo</th>  
                            <th>Created On</th>                  
                            <th>Stage</th>
                        </tr>
                      </thead>
                      <tbody>
                        <?php
                        if(!empty($orderRecords))
                        {
                            $count=0; foreach($orderRecords as $record)
                            {
                        ?>
                        <tr>
                            <td><?php echo ++$count ?></td>
                            <td><?php echo $record->name ?></td>
                            <td><?php echo $record->service ?></td>
                            <td><?php echo $record->weight ?> kg</td>
                            <td>Rp. <?php echo $record->cost ?></td>
                            <td>Rp. <?php echo $record->weight * $record->cost ?></td>
                            <td><?php echo $record->memo ?></td>
                            <td><?php echo $record->stage ?></td>
                            <td><?php echo date("d-m-Y", strtotime($record->createdDtm)) ?></td>
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
            jQuery("#searchList").attr("action", baseURL + "orderlist/" + value);
            jQuery("#searchList").submit();
        });
    });
</script>