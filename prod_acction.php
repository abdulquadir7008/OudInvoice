<?php
include("config.php");
$lang_cat =$_SESSION['lang'];
$output = '';
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
if($list_lang['lang_id']=='45'){if($lang_cat =='en'){echo $list_lang['english'];}else{echo $list_lang['arabic'];} } } ?></th>
                <th><?php $result_lang=mysqli_query($link,$invoice_language_sql);while($list_lang=mysqli_fetch_array($result_lang)){
if($list_lang['lang_id']=='46'){if($lang_cat =='en'){echo $list_lang['english'];}else{echo $list_lang['arabic'];} } } ?></th>
                <th><?php $result_lang=mysqli_query($link,$invoice_language_sql);while($list_lang=mysqli_fetch_array($result_lang)){
if($list_lang['lang_id']=='38'){if($lang_cat =='en'){echo $list_lang['english'];}else{echo $list_lang['arabic'];} } } ?></th>
                <th><?php $result_lang=mysqli_query($link,$invoice_language_sql);while($list_lang=mysqli_fetch_array($result_lang)){
if($list_lang['lang_id']=='47'){if($lang_cat =='en'){echo $list_lang['english'];}else{echo $list_lang['arabic'];} } } ?></th>
                <th><?php $result_lang=mysqli_query($link,$invoice_language_sql);while($list_lang=mysqli_fetch_array($result_lang)){
if($list_lang['lang_id']=='48'){if($lang_cat =='en'){echo $list_lang['english'];}else{echo $list_lang['arabic'];} } } ?></th>
             
                <th><?php $result_lang=mysqli_query($link,$invoice_language_sql);while($list_lang=mysqli_fetch_array($result_lang)){
if($list_lang['lang_id']=='49'){if($lang_cat =='en'){echo $list_lang['english'];}else{echo $list_lang['arabic'];} } } ?></th>
				 <th><?php $result_lang=mysqli_query($link,$invoice_language_sql);while($list_lang=mysqli_fetch_array($result_lang)){
if($list_lang['lang_id']=='50'){if($lang_cat =='en'){echo $list_lang['english'];}else{echo $list_lang['arabic'];} } } ?></th> 
                <th class="text-right"><?php $result_lang=mysqli_query($link,$invoice_language_sql);while($list_lang=mysqli_fetch_array($result_lang)){
if($list_lang['lang_id']=='22'){if($lang_cat =='en'){echo $list_lang['english'];}else{echo $list_lang['arabic'];} } } ?></th>
              </tr>
            </thead>
            <tbody>
            <div class="row staff-grid-row">
            
            <?php
$sql_city = "SELECT * FROM ac_category WHERE catname LIKE '%$search%'";
              $result_cms2 = mysqli_query( $link, $sql_city );
              $rowcity_col = mysqli_fetch_array( $result_cms2 );
             $citysearch = $rowcity_col[ 'ac_cat_id' ];
            $SQDepart = "select * from project LEFT JOIN ac_category ON project.client=ac_category.ac_cat_id WHERE  project_name LIKE '%$search%' or product_code LIKE '%$search%' or price LIKE '%$search%' or client='$citysearch' order by id DESC";
            $ResultDepart = mysqli_query( $link, $SQDepart );
	if(mysqli_num_rows($ResultDepart) >0){
            while ( $ListDepart = mysqli_fetch_array( $ResultDepart ) ) {
				if($ListDepart['sts']=='1'){
              ?>
            <tr>
              <td> <a href="">
                  <?php if($ListDepart['image']!='') { ?>
                  <img src="uploads/<?php echo $ListDepart['image'];?>" alt="" width="70">
                  <?php } else{ ?>
                  <img class="inline-block" src="assets\img\user.jpg" alt="user" width="70">
                  <?php } ?>
                  </a></td>
              <td><?php echo $ListDepart['project_name'];?></td>
              <td><?php echo $ListDepart['catname'];?></td>
              <td><?php echo number_format($ListDepart['price'],2, '.', ',');?></td>
              <td><?php echo $ListDepart['product_code'];?></td>
              <td><?php echo $ListDepart['product_weight'];?></td>
				<td><?php echo substr($ListDepart['description'], 0, 70);?></td>
              <td class="text-right"><div class="dropdown dropdown-action"> <a href="#" class="action-icon dropdown-toggle" data-toggle="dropdown" aria-expanded="false"><i class="material-icons">more_vert</i></a>
                  <div class="dropdown-menu dropdown-menu-right"> <a class="dropdown-item" href="#" data-toggle="modal" data-target="#edit_client<?php echo $ListDepart['id'];?>"><i class="fa fa-pencil m-r-5"></i> <?php $result_lang=mysqli_query($link,$invoice_language_sql);while($list_lang=mysqli_fetch_array($result_lang)){
if($list_lang['lang_id']=='37'){if($lang_cat =='en'){echo $list_lang['english'];}else{echo $list_lang['arabic'];} } } ?></a> <a class="dropdown-item" href="#" data-toggle="modal" data-target="#delete_client<?php echo $ListDepart['id'];?>"><i class="fa fa-trash-o m-r-5"></i> <?php $result_lang=mysqli_query($link,$invoice_language_sql);while($list_lang=mysqli_fetch_array($result_lang)){
if($list_lang['lang_id']=='34'){if($lang_cat =='en'){echo $list_lang['english'];}else{echo $list_lang['arabic'];} } } ?></a> </div>
                </div></td>
            </tr>
            <div id="edit_client<?php echo $ListDepart['id'];?>" class="modal custom-modal fade" role="dialog">
              <div class="modal-dialog modal-dialog-centered modal-lg" role="document">
                <div class="modal-content">
                  <div class="modal-header">
                    <h5 class="modal-title"><?php $result_lang=mysqli_query($link,$invoice_language_sql);while($list_lang=mysqli_fetch_array($result_lang)){
if($list_lang['lang_id']=='51'){if($lang_cat =='en'){echo $list_lang['english'];}else{echo $list_lang['arabic'];} } } ?></h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close"> <span aria-hidden="true">&times;</span> </button>
                  </div>
                  <div class="modal-body">
                    <form method="post" action="products.php" enctype="multipart/form-data">
                      <?php if($ListDepart['image']!='') { ?>
                      <div class="profile-img-wrap edit-img"> <img class="inline-block" src="uploads/<?php echo $ListDepart['image'];?>" width="100" /> </div>
                      <?php } ?>
                      <div class="row">
                        <div class="col-md-6">
                          <div class="form-group">
                            <label class="col-form-label"><?php $result_lang=mysqli_query($link,$invoice_language_sql);while($list_lang=mysqli_fetch_array($result_lang)){
if($list_lang['lang_id']=='46'){if($lang_cat =='en'){echo $list_lang['english'];}else{echo $list_lang['arabic'];} } } ?> <span class="text-danger">*</span></label>
                            <input class="form-control" name="project_name" value="<?php echo $ListDepart['project_name'];?>" type="text" required>
                          </div>
                        </div>
						  <div class="col-md-6">
                          <div class="form-group">
                            <label class="col-form-label"><?php $result_lang=mysqli_query($link,$invoice_language_sql);while($list_lang=mysqli_fetch_array($result_lang)){
if($list_lang['lang_id']=='38'){if($lang_cat =='en'){echo $list_lang['english'];}else{echo $list_lang['arabic'];} } } ?>  <span class="text-danger">*</span></label>
                            <br>
                            <select class="form-control" onChange="showCityedtit(this);" data-show-subtext="true" data-live-search="true" name="client">
                              <option><?php $result_lang=mysqli_query($link,$invoice_language_sql);while($list_lang=mysqli_fetch_array($result_lang)){
if($list_lang['lang_id']=='52'){if($lang_cat =='en'){echo $list_lang['english'];}else{echo $list_lang['arabic'];} } } ?></option>
                              <?php
                      $leave_tbl2_sql = "select * from ac_category WHERE status='1'";
                      $leave_tbl2_result = mysqli_query( $link, $leave_tbl2_sql );
                      while ( $leave_tbl2_row = mysqli_fetch_array( $leave_tbl2_result ) ) {
                        ?>
                      <option value="<?php echo $leave_tbl2_row['ac_cat_id'];?>" <?php if($leave_tbl2_row['ac_cat_id']==$ListDepart['client']){?>selected<?php } ?> ><?php echo $leave_tbl2_row['catname'];?></option>
                      <?php } ?>
                            </select>
                          </div>
							  
                        </div>
						</div>
						
						<div class="row">
				  <div class="col-sm-4">
                  <div class="form-group">
                    <label><?php $result_lang=mysqli_query($link,$invoice_language_sql);while($list_lang=mysqli_fetch_array($result_lang)){
if($list_lang['lang_id']=='47'){if($lang_cat =='en'){echo $list_lang['english'];}else{echo $list_lang['arabic'];} } } ?></label>
                    <input class="form-control" name="price" type="text" value="<?php echo $ListDepart['price'];?>">
                  </div>
                </div>
				<div class="col-sm-4">
                  <div class="form-group">
                    <label><?php $result_lang=mysqli_query($link,$invoice_language_sql);while($list_lang=mysqli_fetch_array($result_lang)){
if($list_lang['lang_id']=='48'){if($lang_cat =='en'){echo $list_lang['english'];}else{echo $list_lang['arabic'];} } } ?></label>
                    <input class="form-control" name="product_code" type="text" value="<?php echo $ListDepart['product_code'];?>">
                  </div>
                </div>
				  
				  <div class="col-sm-4">
                  <div class="form-group">
                    <label><?php $result_lang=mysqli_query($link,$invoice_language_sql);while($list_lang=mysqli_fetch_array($result_lang)){
if($list_lang['lang_id']=='49'){if($lang_cat =='en'){echo $list_lang['english'];}else{echo $list_lang['arabic'];} } } ?></label>
                    <input class="form-control" name="product_weight" type="text" value="<?php echo $ListDepart['product_weight'];?>">
                  </div>
                </div>
				</div>
                        <div class="row">
							<div class="col-md-12">
                          <div class="form-group">
                            <label class="col-form-label"><?php $result_lang=mysqli_query($link,$invoice_language_sql);while($list_lang=mysqli_fetch_array($result_lang)){
if($list_lang['lang_id']=='50'){if($lang_cat =='en'){echo $list_lang['english'];}else{echo $list_lang['arabic'];} } } ?></label>
                            <textarea class="form-control" name="description"><?php echo $ListDepart['description'];?></textarea>
                          </div>

                        </div>
                        <div class="col-md-12">
                          <div class="form-group">
                            <label class="col-form-label"><?php $result_lang=mysqli_query($link,$invoice_language_sql);while($list_lang=mysqli_fetch_array($result_lang)){
if($list_lang['lang_id']=='45'){if($lang_cat =='en'){echo $list_lang['english'];}else{echo $list_lang['arabic'];} } } ?></label>
                            <input class="form-control" name="image" type="file">
                            <input type="hidden" name="hiddenimage" value="<?php echo $ListDepart['image'];?>" />
                          </div>
                        </div>
                        
                        
                        
                        
                      </div>
                      <div class="submit-section">
                        <input type="hidden" name="id" value="<?php echo $ListDepart['id'];?>">
                        <button type="submit" name="update" class="btn btn-primary submit-btn"><?php $result_lang=mysqli_query($link,$invoice_language_sql);while($list_lang=mysqli_fetch_array($result_lang)){
if($list_lang['lang_id']=='31'){if($lang_cat =='en'){echo $list_lang['english'];}else{echo $list_lang['arabic'];} } } ?></button>
                      </div>
                    </form>
                  </div>
                </div>
              </div>
            </div>
            <div class="modal custom-modal fade" id="delete_client<?php echo $ListDepart['id'];?>" role="dialog">
              <div class="modal-dialog modal-dialog-centered">
                <div class="modal-content">
                  <div class="modal-body">
                    <div class="form-header">
                      <h3><?php $result_lang=mysqli_query($link,$invoice_language_sql);while($list_lang=mysqli_fetch_array($result_lang)){
if($list_lang['lang_id']=='53'){if($lang_cat =='en'){echo $list_lang['english'];}else{echo $list_lang['arabic'];} } } ?></h3>
                      <p><?php $result_lang=mysqli_query($link,$invoice_language_sql);while($list_lang=mysqli_fetch_array($result_lang)){
if($list_lang['lang_id']=='33'){if($lang_cat =='en'){echo $list_lang['english'];}else{echo $list_lang['arabic'];} } } ?></p>
                    </div>
                    <div class="modal-btn delete-action">
                      <div class="row">
                        <div class="col-6"> <a href="products.php?del=<?php echo $ListDepart['id'];?>" class="btn btn-primary continue-btn"><?php $result_lang=mysqli_query($link,$invoice_language_sql);while($list_lang=mysqli_fetch_array($result_lang)){
if($list_lang['lang_id']=='34'){if($lang_cat =='en'){echo $list_lang['english'];}else{echo $list_lang['arabic'];} } } ?></a> </div>
                        <div class="col-6"> <a href="javascript:void(0);" data-dismiss="modal" class="btn btn-primary cancel-btn"><?php $result_lang=mysqli_query($link,$invoice_language_sql);while($list_lang=mysqli_fetch_array($result_lang)){
if($list_lang['lang_id']=='22'){if($lang_cat =='en'){echo $list_lang['english'];}else{echo $list_lang['arabic'];} } } ?></a> </div>
                      </div>
                    </div>
                  </div>
                </div>
              </div>
            </div>
            <?php  }} } else {echo "<tr style='background:#fff;'><td colspan='7' style='padding:30px 20px 20px 20px;'><h4 align='center'>No data</h4></td></tr>";} ?>
            </tbody>
            
            </tbody>
	
<?php }
	

?>