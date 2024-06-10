<?php
include( "config.php" );
ob_start();
$pagesetting = basename( $_SERVER[ 'PHP_SELF' ] );
if ( isset( $_SESSION[ 'id' ] ) ) {
  $customerchechlogin_id = $_SESSION[ 'id' ];
} else {
  $customerchechlogin_id = "0";
  header( "Location:login.php" );
  ob_end_flush();
}

$customerchechlogin_sql = "select * from users WHERE id=$customerchechlogin_id";
$customerchechlogin_resu = mysqli_query( $link, $customerchechlogin_sql );
$customerchechlogin_row = mysqli_fetch_array( $customerchechlogin_resu );

if ( isset( $_REQUEST[ 'edit' ] ) ) {
  $id = $_REQUEST[ 'edit' ];
} else {
  $id = 0;
}
$sql_cms = "select * from spl_invoice WHERE estimate_id=$id";
$result_cms = mysqli_query( $link, $sql_cms );
$row_cms = mysqli_fetch_array( $result_cms );
?>
<?php
if ( isset( $_REQUEST[ 'edit' ] ) ) {
  $sub = "update";
  $sub2 = "تحديث";
} else {
  $sub = "add";
  $sub2 = "يحفظ";
}
if ( isset( $_REQUEST[ 'del' ] ) ) {
  $del = $_REQUEST[ 'del' ];
  $query = "delete from invoice_item WHERE estimate_item_id=$del";
  mysqli_query( $link, $query );
  header( "Location:invoice_form.php?edit=" . $id );
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
<?php
include( "include/head.php" );


?>
</head>
<body>
<!-- Main Wrapper -->
<div class="main-wrapper"> 
  
  <!-- Header -->
  <?php include("include/header.php");?>
  <!-- /Header --> 
  
  <!-- Sidebar -->
  <?php include("include/sidebar.php");?>
  <!-- /Sidebar --> 
  
  <!-- Page Wrapper -->
  <div class="page-wrapper"> 
    
    <!-- Page Content -->
    <div class="content container-fluid"> 
      
      <!-- Page Header -->
      <div class="page-header">
        <div class="row">
          <div class="col-sm-12">
            <h3 class="page-title">
              <?php
              $result_lang = mysqli_query( $link, $invoice_language_sql );
              while ( $list_lang = mysqli_fetch_array( $result_lang ) ) {
                if ( $list_lang[ 'lang_id' ] == '116' ) {
                  if ( $lang_cat == 'en' ) {
                    echo $list_lang[ 'english' ];
                  } else {
                    echo $list_lang[ 'arabic' ];
                  }
                }
              }
              ?>
            </h3>
            <ul class="breadcrumb">
              <li class="breadcrumb-item"><a href="index.php">
                <?php
                $result_lang = mysqli_query( $link, $invoice_language_sql );
                while ( $list_lang = mysqli_fetch_array( $result_lang ) ) {
                  if ( $list_lang[ 'lang_id' ] == '2' ) {
                    if ( $lang_cat == 'en' ) {
                      echo $list_lang[ 'english' ];
                    } else {
                      echo $list_lang[ 'arabic' ];
                    }
                  }
                }
                ?>
                </a></li>
              <li class="breadcrumb-item active">
                <?php
                $result_lang = mysqli_query( $link, $invoice_language_sql );
                while ( $list_lang = mysqli_fetch_array( $result_lang ) ) {
                  if ( $list_lang[ 'lang_id' ] == '116' ) {
                    if ( $lang_cat == 'en' ) {
                      echo $list_lang[ 'english' ];
                    } else {
                      echo $list_lang[ 'arabic' ];
                    }
                  }
                }
                ?>
              </li>
            </ul>
          </div>
        </div>
      </div>
      <!-- /Page Header -->
      
      <div class="row">
        <div class="col-sm-12">
          <form method="post" action="add_calender_meeting.php">
            <div class="row">
              <div class="col-sm-8 col-md-8">
                <div class="form-group">
                  <label>
                    <?php
                    $result_lang = mysqli_query( $link, $invoice_language_sql );
                    while ( $list_lang = mysqli_fetch_array( $result_lang ) ) {
                      if ( $list_lang[ 'lang_id' ] == '3' ) {
                        if ( $lang_cat == 'en' ) {
                          echo $list_lang[ 'english' ];
                        } else {
                          echo $list_lang[ 'arabic' ];
                        }
                      }
                    }
                    ?>
                    <span class="text-danger">*</span></label>
                  <select class="form-control selectpicker" data-show-subtext="true" data-live-search="true" name="client[]" multiple>
                    <option>
                    <?php
                    $result_lang = mysqli_query( $link, $invoice_language_sql );
                    while ( $list_lang = mysqli_fetch_array( $result_lang ) ) {
                      if ( $list_lang[ 'lang_id' ] == '73' ) {
                        if ( $lang_cat == 'en' ) {
                          echo $list_lang[ 'english' ];
                        } else {
                          echo $list_lang[ 'arabic' ];
                        }
                      }
                    }
                    ?>
                    </option>
                    <?php
                    $sqlclient = "select * from clients WHERE status='1'";
                    $resultclient = mysqli_query( $link, $sqlclient );
                    while ( $listclient = mysqli_fetch_array( $resultclient ) ) {
                      ?>
                    <option value="<?php echo $listclient['client_id'];?>" <?php if($row_cms['client'] == $listclient['client_id']){?>selected<?php } ?> ><?php echo $listclient['fullname'];?></option>
                    <?php } ?>
                  </select>
                </div>
              </div>
              
              <div class="col-sm-6 col-md-4">
                <div class="form-group">
                  <label>
                    <?php
                    $result_lang = mysqli_query( $link, $invoice_language_sql );
                    while ( $list_lang = mysqli_fetch_array( $result_lang ) ) {
                      if ( $list_lang[ 'lang_id' ] == '111' ) {
                        if ( $lang_cat == 'en' ) {
                          echo $list_lang[ 'english' ];
                        } else {
                          echo $list_lang[ 'arabic' ];
                        }
                      }
                    }
                    ?>
                    <span class="text-danger">*</span></label>
                  <input class="form-control" value="<?php echo $row_cms['meeting_propsal'];?>" name="meeting_propsal" type="text">
                </div>
              </div>
				<div class="col-sm-6 col-md-3">
                <div class="form-group">
                  <label>
                    <?php
                    $result_lang = mysqli_query( $link, $invoice_language_sql );
                    while ( $list_lang = mysqli_fetch_array( $result_lang ) ) {
                      if ( $list_lang[ 'lang_id' ] == '112' ) {
                        if ( $lang_cat == 'en' ) {
                          echo $list_lang[ 'english' ];
                        } else {
                          echo $list_lang[ 'arabic' ];
                        }
                      }
                    }
                    ?>
                    <span class="text-danger">*</span></label>
                  <input class="form-control" value="<?php echo $row_cms['location'];?>" name="location" type="text">
                </div>
              </div>
				<div class="col-sm-6 col-md-3">
                <div class="form-group">
                  <label>
                    <?php
                    $result_lang = mysqli_query( $link, $invoice_language_sql );
                    while ( $list_lang = mysqli_fetch_array( $result_lang ) ) {
                      if ( $list_lang[ 'lang_id' ] == '84' ) {
                        if ( $lang_cat == 'en' ) {
                          echo $list_lang[ 'english' ];
                        } else {
                          echo $list_lang[ 'arabic' ];
                        }
                      }
                    }
                    ?>
                    <span class="text-danger">*</span></label>
					<div class="cal-icon">
                  <input class="form-control datetimepicker" value="<?php echo $row_cms['location'];?>" name="update" type="text">
					</div>
                </div>
              </div>
              <div class="col-sm-6 col-md-3">
                <div class="form-group">
                  <label>
                    <?php
                    $result_lang = mysqli_query( $link, $invoice_language_sql );
                    while ( $list_lang = mysqli_fetch_array( $result_lang ) ) {
                      if ( $list_lang[ 'lang_id' ] == '113' ) {
                        if ( $lang_cat == 'en' ) {
                          echo $list_lang[ 'english' ];
                        } else {
                          echo $list_lang[ 'arabic' ];
                        }
                      }
                    }
                    ?> <span class="text-danger">*</span>
                  </label>
                 
                    <input class="form-control" value="<?php echo $row_cms['start_time'];?>" name="start_time" type="time" required>
                  
                </div>
              </div>
              <div class="col-sm-6 col-md-3">
                <div class="form-group">
                  <label>
                    <?php
                    $result_lang = mysqli_query( $link, $invoice_language_sql );
                    while ( $list_lang = mysqli_fetch_array( $result_lang ) ) {
                      if ( $list_lang[ 'lang_id' ] == '114' ) {
                        if ( $lang_cat == 'en' ) {
                          echo $list_lang[ 'english' ];
                        } else {
                          echo $list_lang[ 'arabic' ];
                        }
                      }
                    }
                    ?> <span class="text-danger">*</span>
                  </label>
                 
                    <input class="form-control" value="<?php echo $row_cms['end_time'];?>" name="end_time" type="time" required>
                  
                </div>
              </div>
              
              <div class="col-md-12">
                <label><?php
                    $result_lang = mysqli_query( $link, $invoice_language_sql );
                    while ( $list_lang = mysqli_fetch_array( $result_lang ) ) {
                      if ( $list_lang[ 'lang_id' ] == '50' ) {
                        if ( $lang_cat == 'en' ) {
                          echo $list_lang[ 'english' ];
                        } else {
                          echo $list_lang[ 'arabic' ];
                        }
                      }
                    }
                    ?></label>
                <textarea class="form-control trapcon" name="description" required></textarea>
              </div>
            </div>
            <div class="row invoice-body" id="myTable">
              <div class="col-md-12 col-sm-12"> </div>
            </div>
            <div class="submit-section">
              <input type="hidden" name="call_submit" value="<?php echo $row_cms['estimate_id'];?>">
              <!--button class="btn btn-primary submit-btn m-r-10">Save & Send</button-->
              <button class="btn btn-primary submit-btn" type="submit" name="call_submit"><?php $result_lang=mysqli_query($link,$invoice_language_sql);while($list_lang=mysqli_fetch_array($result_lang)){
if($list_lang['lang_id']=='36'){if($lang_cat =='en'){echo $list_lang['english'];}else{echo $list_lang['arabic'];} } } ?></button>
            </div>
          </form>
        </div>
      </div>
    </div>
    <!-- /Page Content --> 
    
  </div>
  <!-- /Page Wrapper --> 
  
</div>
<!-- /Main Wrapper --> 

<!-- jQuery --> 

<script src="assets\js\jquery-3.5.1.min.js"></script> 
<script type="text/javascript" src="assets\js\jquery.richtext.js"></script>
<!-- Bootstrap Core JS --> 
<script src="assets\js\popper.min.js"></script> 
<script src="assets\js\bootstrap.min.js"></script> 

<!-- Slimscroll JS --> 
<script src="assets\js\jquery.slimscroll.min.js"></script> 

<!-- Select2 JS --> 
<script src="assets\js\select2.min.js"></script> 

<!-- Datatable JS --> 
<script src="assets\js\jquery.dataTables.min.js"></script> 
<script src="assets\js\dataTables.bootstrap4.min.js"></script> 

<!-- Datetimepicker JS --> 
<script src="assets\js\moment.min.js"></script> 
<script src="assets\js\bootstrap-datetimepicker.min.js"></script> 
<script src="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-select/1.13.3/js/bootstrap-select.js"></script> 
<!-- Custom JS --> 
<script src="assets\js\app.js"></script> 
<script>
	 $(document).ready(function() {
            $('.trapcon').richText();
        });		
	$(document).ready(function() {

  update_amounts();
  $('.qty').change(function() {
    update_amounts();
  });
});


function update_amounts() {
  var sum = 0.0;
  $('#myTable .single-row').each(function() {
    var qty = $(this).find('.qty').val();
    var price = $(this).find('.price').val();
	 
    var amount = parseFloat(qty) * parseFloat(price);
    amount = isNaN(amount) ? 0 : amount;
    sum += amount;
    $(this).find('.amount').text('' + amount);
    $(this).find('.amount').val('' + amount);
	
  });
  //just update the total to sum  
  $('.total').text(sum);
  $('.total').val(sum);
	
	
	$('.taxen').change(function () {
var select=$(this).find(':selected').val();        
var tax = $('#tax').val(sum * select / 100);
		var tax = (sum * select / 100);
	$('.subtotal').text(sum + tax);
	$('.subtotal').val(sum + tax);	
}).change();
  	
}

			
function showCat(sel) {
	var city_id = sel.options[sel.selectedIndex].value;  
	$("#output11").html( "" );
	 if (city_id.length > 0 ) { 
 
	 $.ajax({
			type: "POST",
			url: "client_filter_script.php",
			data: "city_id="+city_id,
			cache: false,
			beforeSend: function () { 
				$('#output11').html('<img src="loader.gif" alt="" width="24" height="24">');
			},
			success: function(html) {    
				$("#output11").html( html );
			}
		});
	} 
}
			
$('.extra-fields-customer').click(function() {
  $('.customer_records').clone().appendTo('.customer_records_dynamic');
  $('.customer_records_dynamic .customer_records').addClass('single remove');
  $('.single .extra-fields-customer').remove();
  $('.single').append('<a href="#" class="remove-fieldkar btn-remove-customer"><i class="fa fa-minus-circle"></i></a>');
  $('.customer_records_dynamic > .single').attr("class", "AlLRevenues remove");

  $('.customer_records_dynamic input').each(function() {
    var count = 0;
    var fieldname = $(this).attr("name");
    $(this).attr('name', fieldname + count);
    count++;
  });

});

$(document).on('click', '.remove-fieldkar', function(e) {
  $(this).parent('.remove').remove();
  e.preventDefault();
});


</script> 
<script>	
$(document).ready(function(){
$("#user_search").keyup(function(){
var search = $(this).val();
$.ajax({
url : 'prod_acction.php',
method:'post',
data:{query:search},
success:function(response){
$("#table-data").html(response);
}
});
});
});

			
			
			
</script>
</body>
</html>