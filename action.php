<?php
include("config.php");
$lang_cat =$_SESSION['lang'];
if(isset($_POST['query'])){
	$search = $_POST['query'];
	
              $sql_city = "SELECT * FROM state_add WHERE sname LIKE '%$search%'";
              $result_cms2 = mysqli_query( $link, $sql_city );
              $rowcity_col = mysqli_fetch_array( $result_cms2 );
             $citysearch = $rowcity_col[ 'state_id' ];
	?>
<thead>
              <tr>
                <th><?php $result_lang=mysqli_query($link,$invoice_language_sql);while($list_lang=mysqli_fetch_array($result_lang)){
if($list_lang['lang_id']=='16'){if($lang_cat =='en'){echo $list_lang['english'];}else{echo $list_lang['arabic'];} } } ?></th>
                <th><?php $result_lang=mysqli_query($link,$invoice_language_sql);while($list_lang=mysqli_fetch_array($result_lang)){
if($list_lang['lang_id']=='128'){if($lang_cat =='en'){echo $list_lang['english'];}else{echo $list_lang['arabic'];} } } ?></th>
                <th><?php $result_lang=mysqli_query($link,$invoice_language_sql);while($list_lang=mysqli_fetch_array($result_lang)){
if($list_lang['lang_id']=='18'){if($lang_cat =='en'){echo $list_lang['english'];}else{echo $list_lang['arabic'];} } } ?></th>
                <th><?php $result_lang=mysqli_query($link,$invoice_language_sql);while($list_lang=mysqli_fetch_array($result_lang)){
if($list_lang['lang_id']=='19'){if($lang_cat =='en'){echo $list_lang['english'];}else{echo $list_lang['arabic'];} } } ?></th>
                <th><?php $result_lang=mysqli_query($link,$invoice_language_sql);while($list_lang=mysqli_fetch_array($result_lang)){
if($list_lang['lang_id']=='20'){if($lang_cat =='en'){echo $list_lang['english'];}else{echo $list_lang['arabic'];} } } ?></th>
                <th><?php $result_lang=mysqli_query($link,$invoice_language_sql);while($list_lang=mysqli_fetch_array($result_lang)){
if($list_lang['lang_id']=='21'){if($lang_cat =='en'){echo $list_lang['english'];}else{echo $list_lang['arabic'];} } } ?></th>
                <th class="text-right"><?php $result_lang=mysqli_query($link,$invoice_language_sql);while($list_lang=mysqli_fetch_array($result_lang)){
if($list_lang['lang_id']=='22'){if($lang_cat =='en'){echo $list_lang['english'];}else{echo $list_lang['arabic'];} } } ?></th>
              </tr>
            </thead>

	<tbody>
            <div class="loaddata"> </div>
            <div class="row staff-grid-row">
            
            <?php

            $SQDepart = "select * from clients WHERE fullname LIKE '%$search%' or email LIKE '%$search%' or phone LIKE '%$search%' or city='$citysearch' or instaid LIKE '%$search%' order by client_id DESC";
            $ResultDepart = mysqli_query( $link, $SQDepart );
	if(mysqli_num_rows($ResultDepart) >0){
            while ( $ListDepart = mysqli_fetch_array( $ResultDepart ) ) {
				if($ListDepart['status']=='1'){
              ?>
            <tr>
              <td><h2 class="table-avatar"><a href=""><?php echo $ListDepart['fullname'];?></a></h2></td>
              <td><?php echo $ListDepart['instaid'];?></td>
              <td><?php echo $ListDepart['phone'];?></td>
              <td><?php echo substr($ListDepart['address'], 0, 70);?></td>
              <td><?php
              $city2_id = $ListDepart[ 'city' ];
              $sql_city = "SELECT * FROM state_add WHERE state_id= '$city2_id'";
              $result_cms2 = mysqli_query( $link, $sql_city );
              $rowcity_col = mysqli_fetch_array( $result_cms2 );
              echo $rowcity_col[ 'sname' ];
              ?></td>
              <td><?php
              $country_id123 = $ListDepart[ 'country_id' ];
              $sql_country = "SELECT * FROM country WHERE country_id= '$country_id123'";
              $rescountry = mysqli_query( $link, $sql_country );
              $rowcountry = mysqli_fetch_array( $rescountry );
              echo $rowcountry[ 'cname' ];
              ?></td>
              <td class="text-right"><div class="dropdown dropdown-action"> <a href="#" class="action-icon dropdown-toggle" data-toggle="dropdown" aria-expanded="false"><i class="material-icons">more_vert</i></a>
                  <div class="dropdown-menu dropdown-menu-right"> <a class="dropdown-item" href="#" data-toggle="modal" data-target="#edit_client<?php echo $ListDepart['client_id'];?>"><i class="fa fa-pencil m-r-5"></i> 
<?php $result_lang=mysqli_query($link,$invoice_language_sql);while($list_lang=mysqli_fetch_array($result_lang)){
if($list_lang['lang_id']=='37'){if($lang_cat =='en'){echo $list_lang['english'];}else{echo $list_lang['arabic'];} } } ?></a> <a class="dropdown-item" href="#" data-toggle="modal" data-target="#delete_client<?php echo $ListDepart['client_id'];?>"><i class="fa fa-trash-o m-r-5"></i> <?php $result_lang=mysqli_query($link,$invoice_language_sql);while($list_lang=mysqli_fetch_array($result_lang)){
if($list_lang['lang_id']=='34'){if($lang_cat =='en'){echo $list_lang['english'];}else{echo $list_lang['arabic'];} } } ?></a> <a href="invoice_form.php?user=<?php echo $ListDepart['client_id'];?>" class="dropdown-item"><i class="fa fa-file-o m-r-5"></i><?php $result_lang=mysqli_query($link,$invoice_language_sql);while($list_lang=mysqli_fetch_array($result_lang)){
if($list_lang['lang_id']=='23'){if($lang_cat =='en'){echo $list_lang['english'];}else{echo $list_lang['arabic'];} } } ?></a> </div>
                </div></td>
            </tr>
            <div id="edit_client<?php echo $ListDepart['client_id'];?>" class="modal custom-modal fade" role="dialog">
              <div class="modal-dialog modal-dialog-centered modal-lg" role="document">
                <div class="modal-content">
                  <div class="modal-header">
                    <h5 class="modal-title"><?php $result_lang=mysqli_query($link,$invoice_language_sql);while($list_lang=mysqli_fetch_array($result_lang)){
if($list_lang['lang_id']=='24'){if($lang_cat =='en'){echo $list_lang['english'];}else{echo $list_lang['arabic'];} } } ?></h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close"> <span aria-hidden="true">&times;</span> </button>
                  </div>
                  <div class="modal-body">
                    <form method="post" action="users.php" enctype="multipart/form-data">
                      <?php if($ListDepart['image']!='') { ?>
                      <div class="profile-img-wrap edit-img"> <img class="inline-block" src="uploads/<?php echo $ListDepart['image'];?>" width="100" /> </div>
                      <?php } ?>
                      <div class="row">
                        <div class="col-md-6">
                          <div class="form-group">
                            <label class="col-form-label"><?php $result_lang=mysqli_query($link,$invoice_language_sql);while($list_lang=mysqli_fetch_array($result_lang)){
if($list_lang['lang_id']=='25'){if($lang_cat =='en'){echo $list_lang['english'];}else{echo $list_lang['arabic'];} } } ?> <span class="text-danger">*</span></label>
                            <input class="form-control" name="fullname" value="<?php echo $ListDepart['fullname'];?>" type="text" required>
                          </div>
                        </div>
                        <div class="col-md-6">
                          <div class="form-group">
                            <label class="col-form-label"><?php $result_lang=mysqli_query($link,$invoice_language_sql);while($list_lang=mysqli_fetch_array($result_lang)){
if($list_lang['lang_id']=='17'){if($lang_cat =='en'){echo $list_lang['english'];}else{echo $list_lang['arabic'];} } } ?> <span class="text-danger">*</span></label>
                            <input class="form-control floating" name="email" type="email" value="<?php echo $ListDepart['email'];?>">
                          </div>
                        </div>
                        <div class="col-md-6">
                          <div class="form-group">
                            <label class="col-form-label"><?php $result_lang=mysqli_query($link,$invoice_language_sql);while($list_lang=mysqli_fetch_array($result_lang)){
if($list_lang['lang_id']=='18'){if($lang_cat =='en'){echo $list_lang['english'];}else{echo $list_lang['arabic'];} } } ?> </label>
                            <input class="form-control" name="phone" type="text" value="<?php echo $ListDepart['phone'];?>">
                          </div>
                        </div>
                        <div class="col-md-6">
                          <div class="form-group">
                            <label class="col-form-label"><?php $result_lang=mysqli_query($link,$invoice_language_sql);while($list_lang=mysqli_fetch_array($result_lang)){
if($list_lang['lang_id']=='26'){if($lang_cat =='en'){echo $list_lang['english'];}else{echo $list_lang['arabic'];} } } ?></label>
                            <input class="form-control" name="image" type="file">
                            <input type="hidden" name="hiddenimage" value="<?php echo $ListDepart['image'];?>" />
                          </div>
                        </div>
                        <div class="col-md-6">
                          <div class="form-group">
                            <label class="col-form-label"><?php $result_lang=mysqli_query($link,$invoice_language_sql);while($list_lang=mysqli_fetch_array($result_lang)){
if($list_lang['lang_id']=='21'){if($lang_cat =='en'){echo $list_lang['english'];}else{echo $list_lang['arabic'];} } } ?> <span class="text-danger">*</span></label>
                            <br>
                            <select class="select form-control" onChange="showCityedtit(this);" data-show-subtext="true" data-live-search="true" name="country_id">
                              <option><?php $result_lang=mysqli_query($link,$invoice_language_sql);while($list_lang=mysqli_fetch_array($result_lang)){
if($list_lang['lang_id']=='27'){if($lang_cat =='en'){echo $list_lang['english'];}else{echo $list_lang['arabic'];} } } ?></option>
                              <?php
                              $leave_tbl2_sql = "select * from country";
                              $leave_tbl2_result = mysqli_query( $link, $leave_tbl2_sql );
                              while ( $leave_tbl2_row = mysqli_fetch_array( $leave_tbl2_result ) ) {
                                ?>
                              <option value="<?php echo $leave_tbl2_row['country_id'];?>" <?php if($leave_tbl2_row['country_id']==$country_id123){?>selected<?php } ?>><?php echo $leave_tbl2_row['cname'];?></option>
                              <?php } ?>
                            </select>
                          </div>
                        </div>
                        <div class="col-md-6">
                          <div class="form-group">
                            <label class="col-form-label"><?php $result_lang=mysqli_query($link,$invoice_language_sql);while($list_lang=mysqli_fetch_array($result_lang)){
if($list_lang['lang_id']=='20'){if($lang_cat =='en'){echo $list_lang['english'];}else{echo $list_lang['arabic'];} } } ?> <span class="text-danger">*</span></label>
                            <select class="select form-control outputkor" name="city">
                              <option><?php $result_lang=mysqli_query($link,$invoice_language_sql);while($list_lang=mysqli_fetch_array($result_lang)){
if($list_lang['lang_id']=='28'){if($lang_cat =='en'){echo $list_lang['english'];}else{echo $list_lang['arabic'];} } } ?></option>
                              <?php
                              $sql = "SELECT * FROM state_add WHERE country_id= '$country_id123' ORDER BY sname ASC";
                              $result_cms2 = mysqli_query( $link, $sql );
                              while ( $row_cms2 = mysqli_fetch_array( $result_cms2 ) ) {
                                ?>
                              <option value="<?php echo $row_cms2["state_id"]; ?>" <?php if($row_cms2["state_id"]==$ListDepart['city']){?>selected<?php } ?> ><?php echo $row_cms2["sname"]; ?></option>
                              <?php } ?>
                            </select>
                          </div>
                        </div>
                        <div class="col-md-12">
                          <div class="form-group">
                            <label class="col-form-label"><?php $result_lang=mysqli_query($link,$invoice_language_sql);while($list_lang=mysqli_fetch_array($result_lang)){
if($list_lang['lang_id']=='29'){if($lang_cat =='en'){echo $list_lang['english'];}else{echo $list_lang['arabic'];} } } ?></label>
                            <textarea class="form-control" name="address"><?php echo $ListDepart['address'];?></textarea>
                          </div>
                        </div>
                        <div class="col-md-12">
                          <div class="form-group">
                            <label class="col-form-label"><?php $result_lang=mysqli_query($link,$invoice_language_sql);while($list_lang=mysqli_fetch_array($result_lang)){
if($list_lang['lang_id']=='30'){if($lang_cat =='en'){echo $list_lang['english'];}else{echo $list_lang['arabic'];} } } ?></label>
                            <textarea class="form-control" name="comment"><?php echo $ListDepart['comment'];?></textarea>
                          </div>
                        </div>
                      </div>
                      <div class="submit-section">
                        <input type="hidden" name="client_id" value="<?php echo $ListDepart['client_id'];?>">
                        <button type="submit" name="update" class="btn btn-primary submit-btn"><?php $result_lang=mysqli_query($link,$invoice_language_sql);while($list_lang=mysqli_fetch_array($result_lang)){
if($list_lang['lang_id']=='31'){if($lang_cat =='en'){echo $list_lang['english'];}else{echo $list_lang['arabic'];} } } ?></button>
                      </div>
                    </form>
                  </div>
                </div>
              </div>
            </div>
            <div class="modal custom-modal fade" id="delete_client<?php echo $ListDepart['client_id'];?>" role="dialog">
              <div class="modal-dialog modal-dialog-centered">
                <div class="modal-content">
                  <div class="modal-body">
                    <div class="form-header">
                      <h3>Delete Client</h3>
                      <p>Are you sure want to delete?</p>
                    </div>
                    <div class="modal-btn delete-action">
                      <div class="row">
                        <div class="col-6"> <a href="users.php?del=<?php echo $ListDepart['client_id'];?>" class="btn btn-primary continue-btn">Delete</a> </div>
                        <div class="col-6"> <a href="javascript:void(0);" data-dismiss="modal" class="btn btn-primary cancel-btn">Cancel</a> </div>
                      </div>
                    </div>
                  </div>
                </div>
              </div>
            </div>
            <?php } } } else {echo "<tr style='background:#fff;'><td colspan='7' style='padding:30px 20px 20px 20px;'><h4 align='center'>No data</h4></td></tr>";}  ?>
            </tbody>
	
<?php }
	

?>