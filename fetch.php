<?php
include( "config.php" );
$lang_cat =$_SESSION['lang'];
if ( isset( $_POST[ 'query' ] ) || isset( $_POST[ 'customer' ] ) || isset( $_POST[ 'phone_user' ] ) || isset( $_POST[ 'from_search' ] ) || isset( $_POST[ 'to_search' ] ) ) {
  $customer = '';
  $cusphone = '';
if(isset($_POST['nameid'])){
	$rate = $_POST['nameid'];
}

  $sql_admin = "select * from invoice_setting WHERE user_type='1'";
  $result_admin = mysqli_query( $link, $sql_admin );
  $list_admin = mysqli_fetch_array( $result_admin );

  $search_employe = $_POST[ 'query' ];
  if ( $_POST[ 'customer' ] && $rate=='nameid') {
$cusphone = '';
    $customer = 'client=' . $_POST[ 'customer' ] . " AND";
  }
  if ( $_POST[ 'phone_user' ] && $rate=='valueid' ) {
    $customer = '';
    $cusphone = $_POST[ 'phone_user' ];
    $SQLcustphone = "select * from clients WHERE phone='$cusphone'";
    $Ressultphone = mysqli_query( $link, $SQLcustphone );
    $listphone = mysqli_fetch_array( $Ressultphone );
    $customer = 'client=' . $listphone[ 'client_id' ] . " AND";
  }

  if ( $_REQUEST[ 'from_search' ] != '' && $_REQUEST[ 'to_search' ] != '' ) {
    $from_search = $_REQUEST[ 'from_search' ];
    $to_search = $_REQUEST[ 'to_search' ];

    $bwch = "AND estimate_date between '" . $from_search . "' AND '" . $to_search . "'";
  } else {
    $bwch = '';
  }

  ?>
<thead>
  <tr>
                  <th><?php $result_lang=mysqli_query($link,$invoice_language_sql);while($list_lang=mysqli_fetch_array($result_lang)){
if($list_lang['lang_id']=='62'){if($lang_cat =='en'){echo $list_lang['english'];}else{echo $list_lang['arabic'];} } } ?></th>
                  <th><?php $result_lang=mysqli_query($link,$invoice_language_sql);while($list_lang=mysqli_fetch_array($result_lang)){
if($list_lang['lang_id']=='3'){if($lang_cat =='en'){echo $list_lang['english'];}else{echo $list_lang['arabic'];} } } ?></th>
                  <th><?php $result_lang=mysqli_query($link,$invoice_language_sql);while($list_lang=mysqli_fetch_array($result_lang)){
if($list_lang['lang_id']=='63'){if($lang_cat =='en'){echo $list_lang['english'];}else{echo $list_lang['arabic'];} } } ?></th>
                  <th><?php $result_lang=mysqli_query($link,$invoice_language_sql);while($list_lang=mysqli_fetch_array($result_lang)){
if($list_lang['lang_id']=='64'){if($lang_cat =='en'){echo $list_lang['english'];}else{echo $list_lang['arabic'];} } } ?></th>
                  <th><?php $result_lang=mysqli_query($link,$invoice_language_sql);while($list_lang=mysqli_fetch_array($result_lang)){
if($list_lang['lang_id']=='65'){if($lang_cat =='en'){echo $list_lang['english'];}else{echo $list_lang['arabic'];} } } ?></th>
                  <th><?php $result_lang=mysqli_query($link,$invoice_language_sql);while($list_lang=mysqli_fetch_array($result_lang)){
if($list_lang['lang_id']=='102'){if($lang_cat =='en'){echo $list_lang['english'];}else{echo $list_lang['arabic'];} } } ?></th>
                  <th class="text-right"><?php $result_lang=mysqli_query($link,$invoice_language_sql);while($list_lang=mysqli_fetch_array($result_lang)){
if($list_lang['lang_id']=='22'){if($lang_cat =='en'){echo $list_lang['english'];}else{echo $list_lang['arabic'];} } } ?></th>
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
      <span class="badge bg-inverse-warning"><?php $result_lang=mysqli_query($link,$invoice_language_sql);while($list_lang=mysqli_fetch_array($result_lang)){
if($list_lang['lang_id']=='67'){if($lang_cat =='en'){echo $list_lang['english'];}else{echo $list_lang['arabic'];} } } ?></span>
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
    echo number_format(( $totalSum * $listestimate[ 'tax' ] / 100 ) + $totalSum,2, '.', ',');
    ?></td>
    <td><div class="dropdown action-label"> <a class="btn btn-white btn-sm btn-rounded dropdown-toggle" href="#" data-toggle="dropdown" aria-expanded="false">
        <?php if($listestimate['status'] == '2'){?>
        <i class="fa fa-dot-circle-o text-success"></i> <?php $result_lang=mysqli_query($link,$invoice_language_sql);while($list_lang=mysqli_fetch_array($result_lang)){
if($list_lang['lang_id']=='61'){if($lang_cat =='en'){echo $list_lang['english'];}else{echo $list_lang['arabic'];} } } ?></a>
        <?php } else {?>
        <i class="fa fa-dot-circle-o text-danger"></i> <?php $result_lang=mysqli_query($link,$invoice_language_sql);while($list_lang=mysqli_fetch_array($result_lang)){
if($list_lang['lang_id']=='68'){if($lang_cat =='en'){echo $list_lang['english'];}else{echo $list_lang['arabic'];} } } ?></a>
        <?php } ?>
        </a>
        <div class="dropdown-menu dropdown-menu-right"> <a class="dropdown-item" href="#" data-toggle="modal" data-target="#approve_leave<?php echo $estimate_id;?>"><i class="fa fa-dot-circle-o text-info"></i> <?php $result_lang=mysqli_query($link,$invoice_language_sql);while($list_lang=mysqli_fetch_array($result_lang)){
if($list_lang['lang_id']=='68'){if($lang_cat =='en'){echo $list_lang['english'];}else{echo $list_lang['arabic'];} } } ?></a> <a class="dropdown-item" href="#" data-toggle="modal" data-target="#approve_leave<?php echo $estimate_id;?>"><i class="fa fa-dot-circle-o text-success"></i> <?php $result_lang=mysqli_query($link,$invoice_language_sql);while($list_lang=mysqli_fetch_array($result_lang)){
if($list_lang['lang_id']=='61'){if($lang_cat =='en'){echo $list_lang['english'];}else{echo $list_lang['arabic'];} } } ?></a> </div>
      </div>
      <div class="modal custom-modal fade" id="approve_leave<?php echo $estimate_id;?>" role="dialog">
        <div class="modal-dialog modal-dialog-centered">
          <div class="modal-content">
            <div class="modal-body">
              <div class="form-header">
                <h3><?php $result_lang=mysqli_query($link,$invoice_language_sql);while($list_lang=mysqli_fetch_array($result_lang)){
if($list_lang['lang_id']=='69'){if($lang_cat =='en'){echo $list_lang['english'];}else{echo $list_lang['arabic'];} } } ?></h3>
                <p><?php $result_lang=mysqli_query($link,$invoice_language_sql);while($list_lang=mysqli_fetch_array($result_lang)){
if($list_lang['lang_id']=='33'){if($lang_cat =='en'){echo $list_lang['english'];}else{echo $list_lang['arabic'];} } } ?></p>
              </div>
              <div class="modal-btn delete-action">
                <div class="row">
                  <div class="col-6"> <a href="invoice.php?aprove=<?php echo $estimate_id;?>" class="btn btn-primary continue-btn"><?php $result_lang=mysqli_query($link,$invoice_language_sql);while($list_lang=mysqli_fetch_array($result_lang)){
if($list_lang['lang_id']=='70'){if($lang_cat =='en'){echo $list_lang['english'];}else{echo $list_lang['arabic'];} } } ?></a> </div>
                  <div class="col-6"> <a href="invoice.php?decline=<?php echo $estimate_id;?>" class="btn btn-primary cancel-btn"><?php $result_lang=mysqli_query($link,$invoice_language_sql);while($list_lang=mysqli_fetch_array($result_lang)){
if($list_lang['lang_id']=='71'){if($lang_cat =='en'){echo $list_lang['english'];}else{echo $list_lang['arabic'];} } } ?></a> </div>
                </div>
              </div>
            </div>
          </div>
        </div>
      </div></td>
    <td class="text-right"><div class="dropdown dropdown-action"> <a href="#" class="action-icon dropdown-toggle" data-toggle="dropdown" aria-expanded="false"><i class="material-icons">more_vert</i></a>
        <div class="dropdown-menu dropdown-menu-right">
			<a class="dropdown-item" href="invoice_form.php?edit=<?php echo $estimate_id;?>"><i class="fa fa-pencil m-r-5"></i> <?php $result_lang=mysqli_query($link,$invoice_language_sql);while($list_lang=mysqli_fetch_array($result_lang)){
if($list_lang['lang_id']=='37'){if($lang_cat =='en'){echo $list_lang['english'];}else{echo $list_lang['arabic'];} } } ?></a> 
			<a class="dropdown-item" href="invoice_view.php?gen=<?php echo $estimate_id;?>" target="_blank"><i class="fa fa-eye m-r-5"></i><?php $result_lang=mysqli_query($link,$invoice_language_sql);while($list_lang=mysqli_fetch_array($result_lang)){
if($list_lang['lang_id']=='72'){if($lang_cat =='en'){echo $list_lang['english'];}else{echo $list_lang['arabic'];} } } ?></a>
			<a class="dropdown-item" href="#" data-toggle="modal" data-target="#delete_estimate<?php echo $estimate_id;?>"><i class="fa fa-trash-o m-r-5"></i> <?php $result_lang=mysqli_query($link,$invoice_language_sql);while($list_lang=mysqli_fetch_array($result_lang)){
if($list_lang['lang_id']=='34'){if($lang_cat =='en'){echo $list_lang['english'];}else{echo $list_lang['arabic'];} } } ?></a> </div>
      </div></td>
  </tr>
<div class="modal custom-modal fade" id="delete_estimate<?php echo $estimate_id;?>" role="dialog">
  <div class="modal-dialog modal-dialog-centered">
    <div class="modal-content">
      <div class="modal-body">
        <div class="form-header">
          <h3><?php $result_lang=mysqli_query($link,$invoice_language_sql);while($list_lang=mysqli_fetch_array($result_lang)){
if($list_lang['lang_id']=='34'){if($lang_cat =='en'){echo $list_lang['english'];}else{echo $list_lang['arabic'];} } } ?></h3>
          <p><?php $result_lang=mysqli_query($link,$invoice_language_sql);while($list_lang=mysqli_fetch_array($result_lang)){
if($list_lang['lang_id']=='33'){if($lang_cat =='en'){echo $list_lang['english'];}else{echo $list_lang['arabic'];} } } ?></p>
        </div>
        <div class="modal-btn delete-action">
          <div class="row">
            <div class="col-6"> <a href="invoice.php?del=<?php echo $estimate_id;?>" class="btn btn-primary continue-btn"><?php $result_lang=mysqli_query($link,$invoice_language_sql);while($list_lang=mysqli_fetch_array($result_lang)){
if($list_lang['lang_id']=='34'){if($lang_cat =='en'){echo $list_lang['english'];}else{echo $list_lang['arabic'];} } } ?></a> </div>
            <div class="col-6"> <a href="javascript:void(0);" data-dismiss="modal" class="btn btn-primary cancel-btn"><?php $result_lang=mysqli_query($link,$invoice_language_sql);while($list_lang=mysqli_fetch_array($result_lang)){
if($list_lang['lang_id']=='22'){if($lang_cat =='en'){echo $list_lang['english'];}else{echo $list_lang['arabic'];} } } ?></a> </div>
          </div>
        </div>
      </div>
    </div>
  </div>
</div>
<?php $k++; } ?>
</tbody>
<?php } ?>
