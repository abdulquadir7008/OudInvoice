<?php
include( "config.php" );
$lang_cat = $_SESSION[ 'lang' ];
if ( isset( $_POST[ 'query' ] ) ) {
  $search = $_POST[ 'query' ];

  ?>
<thead>
  <tr>
    <th style="width: 30px;">#</th>
    <th>Arabic</th>
    <th>English</th>
    <th class="text-right">عمل</th>
  </tr>
</thead>
<tbody>
  <?php
  $k = 1;
  $SQDepart = "select * from invoice_language WHERE arabic LIKE '%$search%' or english LIKE '%$search%'";
  $ResultDepart = mysqli_query( $link, $SQDepart );
	if(mysqli_num_rows($ResultDepart) >0){
  while ( $ListDepart = mysqli_fetch_array( $ResultDepart ) ) {
    ?>
  <tr>
    <td><?php echo $k;?></td>
    <td><?php echo $ListDepart['arabic'];?></td>
    <th><?php echo $ListDepart['english'];?></th>
    <td class="text-right"><div class="dropdown dropdown-action"> <a href="#" class="action-icon dropdown-toggle" data-toggle="dropdown" aria-expanded="false"><i class="material-icons">more_vert</i></a>
        <div class="dropdown-menu dropdown-menu-right"> <a class="dropdown-item" href="#" data-toggle="modal" data-target="#edit_department<?php echo $ListDepart['lang_id'];?>"><i class="fa fa-pencil m-r-5"></i> تعديل</a> <a class="dropdown-item" href="#" data-toggle="modal" data-target="#delete_department<?php echo $ListDepart['lang_id'];?>"><i class="fa fa-trash-o m-r-5"></i> حذف</a> </div>
      </div></td>
  </tr>
  
  <!-- Delete Department Modal -->
<div class="modal custom-modal fade" id="delete_department<?php echo $ListDepart['lang_id'];?>" role="dialog">
  <div class="modal-dialog modal-dialog-centered">
    <div class="modal-content">
      <div class="modal-body">
        <div class="form-header">
          <h3>حذف القسم</h3>
          <p>هل أنت متأكد من أنك تريد الحذف؟</p>
        </div>
        <div class="modal-btn delete-action">
          <div class="row">
            <div class="col-6"> <a href="language_setting.php?del=<?php echo $ListDepart['lang_id'];?>" class="btn btn-primary continue-btn">حذف</a> </div>
            <div class="col-6"> <a href="javascript:void(0);" data-dismiss="modal" class="btn btn-primary cancel-btn">يلغي</a> </div>
          </div>
        </div>
      </div>
    </div>
  </div>
</div>
<!-- /Delete Department Modal --> 

<!-- Edit Department Modal -->
<div id="edit_department<?php echo $ListDepart['lang_id'];?>" class="modal custom-modal fade" role="dialog">
  <div class="modal-dialog modal-dialog-centered" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title">تحرير الفئات</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close"> <span aria-hidden="true">&times;</span> </button>
      </div>
      <div class="modal-body">
        <form method="post" action="language_setting.php">
          <div class="form-group" dir="rtl">
            <label style="float: right;">عربى <span class="text-danger">*</span></label>
            <input class="form-control" maxlength="40" name="arabic" type="text" value="<?php echo $ListDepart['arabic'];?>">
          </div>
          <div class="form-group">
            <label>English <span class="text-danger">*</span></label>
            <input class="form-control" maxlength="40" name="english" type="text" value="<?php echo $ListDepart['english'];?>">
          </div>
          <div class="submit-section">
            <input type="hidden" name="lang_id" value="<?php echo $ListDepart['lang_id'];?>">
            <button class="btn btn-primary submit-btn" name="update" type="submit">تحديث</button>
          </div>
        </form>
      </div>
    </div>
  </div>
</div>
<!-- /Edit Department Modal -->

<?php $k++; } } else { echo "<tr style='background:#fff;'><td colspan='5' style='padding:30px 20px 20px 20px;'><h4 align='center'>No data</h4></td></tr>";} ?>
</tbody>

<?php
}


?>
