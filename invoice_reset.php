<?php
include( "config.php" );
if ( isset( $_POST[ 'reset' ] ) ) {
  $sql_admin = "select * from invoice_setting WHERE user_type='1'";
  $result_admin = mysqli_query( $link, $sql_admin );
  $list_admin = mysqli_fetch_array( $result_admin );

  $from_search = '';
  $to_search = '';
  $bwch = '';
  $search_employe = '';

  $customer = '';


  ?>
<thead>
  <tr>
    <th>Invoice Number</th>
    <th>User</th>
    <th>Created Date</th>
    <th>Due Date</th>
    <th>Amount</th>
    <th>Payment Status</th>
    <th class="text-right">Action</th>
  </tr>
</thead>
<tbody>
  <?php
  $k = 1;
  $SQLestimate = "select * from spl_invoice WHERE $customer status LIKE '%$search_employe%' $bwch order by estimate_id DESC";
  $Resultestimate = mysqli_query( $link, $SQLestimate );
  while ( $listestimate = mysqli_fetch_array( $Resultestimate ) ) {
    $clientid = $listestimate[ 'client' ];
    $myOriginalDate = str_replace( '/', '-', $listestimate[ 'expire_date' ] );
    $curdate_holiday = strtotime( date( "d-m-Y" ) );
    $holiday = strtotime( $myOriginalDate );
    $estimate_id = $listestimate[ 'estimate_id' ];
    $sqlclients = "select * from clients WHERE client_id='$clientid'";
    $resultclients = mysqli_query( $link, $sqlclients );
    $listclients = mysqli_fetch_array( $resultclients );


    ?>
  <tr>
    <td><a href="invoice_form.php?edit=<?php echo $estimate_id;?>"><?php echo $list_admin['invocie_prifix'];?>-000<?php echo $estimate_id;?></a></td>
    <td><?php echo $listclients['fullname'];?></td>
    <td><?php echo $listestimate['estimate_date'];?></td>
    <td><?php echo $listestimate['expire_date'];?>
      <?php if($curdate_holiday > $holiday){?>
      <span class="badge bg-inverse-warning">Expired</span>
      <?php }?></td>
    <td><?php
    $totalSum = '0';
    $itemtotal = '';
    $sqlitem = "select * from invoice_item WHERE etimate_id='$estimate_id'";
    $resultitemprice = mysqli_query( $link, $sqlitem );
    while ( $listitem = mysqli_fetch_array( $resultitemprice ) ) {
      $itemtotal = $listitem[ 'qty' ] * $listitem[ 'unitcost' ];
      $totalSum += $itemtotal;

    }
    echo( $totalSum * $listestimate[ 'tax' ] / 100 ) + $totalSum;
    ?></td>
    <td><div class="dropdown action-label"> <a class="btn btn-white btn-sm btn-rounded dropdown-toggle" href="#" data-toggle="dropdown" aria-expanded="false">
        <?php if($listestimate['status'] == '2'){?>
        <i class="fa fa-dot-circle-o text-success"></i> Paid</a>
        <?php } else {?>
        <i class="fa fa-dot-circle-o text-danger"></i> Pending</a>
        <?php } ?>
        </a>
        <div class="dropdown-menu dropdown-menu-right"> <a class="dropdown-item" href="#" data-toggle="modal" data-target="#approve_leave<?php echo $estimate_id;?>"><i class="fa fa-dot-circle-o text-info"></i> Pending</a> <a class="dropdown-item" href="#" data-toggle="modal" data-target="#approve_leave<?php echo $estimate_id;?>"><i class="fa fa-dot-circle-o text-success"></i> Paid</a> </div>
      </div>
      <div class="modal custom-modal fade" id="approve_leave<?php echo $estimate_id;?>" role="dialog">
        <div class="modal-dialog modal-dialog-centered">
          <div class="modal-content">
            <div class="modal-body">
              <div class="form-header">
                <h3>Leave Approve</h3>
                <p>Are you sure want to approve for this leave?</p>
              </div>
              <div class="modal-btn delete-action">
                <div class="row">
                  <div class="col-6"> <a href="invoice.php?aprove=<?php echo $estimate_id;?>" class="btn btn-primary continue-btn">Payment accept</a> </div>
                  <div class="col-6"> <a href="invoice.php?decline=<?php echo $estimate_id;?>" class="btn btn-primary cancel-btn">Payment pending</a> </div>
                </div>
              </div>
            </div>
          </div>
        </div>
      </div></td>
    <td class="text-right"><div class="dropdown dropdown-action"> <a href="#" class="action-icon dropdown-toggle" data-toggle="dropdown" aria-expanded="false"><i class="material-icons">more_vert</i></a>
        <div class="dropdown-menu dropdown-menu-right"> <a class="dropdown-item" href="invoice_form.php?edit=<?php echo $estimate_id;?>"><i class="fa fa-pencil m-r-5"></i> Edit</a> <a class="dropdown-item" href="#" data-toggle="modal" data-target="#delete_estimate<?php echo $estimate_id;?>"><i class="fa fa-trash-o m-r-5"></i> Delete</a> </div>
      </div></td>
  </tr>
<div class="modal custom-modal fade" id="delete_estimate<?php echo $estimate_id;?>" role="dialog">
  <div class="modal-dialog modal-dialog-centered">
    <div class="modal-content">
      <div class="modal-body">
        <div class="form-header">
          <h3>Delete Estimate</h3>
          <p>Are you sure want to delete?</p>
        </div>
        <div class="modal-btn delete-action">
          <div class="row">
            <div class="col-6"> <a href="invoice.php?del=<?php echo $estimate_id;?>" class="btn btn-primary continue-btn">Delete</a> </div>
            <div class="col-6"> <a href="javascript:void(0);" data-dismiss="modal" class="btn btn-primary cancel-btn">Cancel</a> </div>
          </div>
        </div>
      </div>
    </div>
  </div>
</div>
<?php $k++; } ?>
</tbody>
<?php } ?>
