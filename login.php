<?php include("config.php");
$ip = $_SERVER['REMOTE_ADDR'];
$sess=session_id();	
$numlistlogincheck=mysqli_query($link,"select * from login_check WHERE ip='$ip' order by id DESC");
$login_row=mysqli_fetch_array($numlistlogincheck);
$kadtime = strtotime($login_row['create_date']);
//echo time();
if (time() - $kadtime > 900) {
    mysqli_query( $link,"delete from login_check WHERE ip='$ip'");
}
?>
<!DOCTYPE html>
<html>
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0, user-scalable=0">
        <meta name="description" content="Smarthr - Bootstrap Admin Template">
		<meta name="keywords" content="admin, estimates, bootstrap, business, corporate, creative, management, minimal, modern, accounts, invoice, html5, responsive, CRM, Projects">
        <meta name="author" content="Dreamguys - Bootstrap Admin Template">
        <meta name="robots" content="noindex, nofollow">
        <title>تسجيل الدخول - فاتورة التاريخ</title>
		
		<!-- Favicon -->
        <link rel="shortcut icon" type="image/x-icon" href="fevicon.png">
		
		<!-- Bootstrap CSS -->
        <link rel="stylesheet" href="assets\css\bootstrap.min.css">
		
		<!-- Fontawesome CSS -->
        <link rel="stylesheet" href="assets\css\font-awesome.min.css">
		
		<!-- Main CSS -->
        <link rel="stylesheet" href="assets\css\style.css">
		 <script src='https://www.google.com/recaptcha/api.js'></script>
		<!-- HTML5 shim and Respond.js IE8 support of HTML5 elements and media queries -->
		<!--[if lt IE 9]>
			<script src="assets/js/html5shiv.min.js"></script>
			<script src="assets/js/respond.min.js"></script>
		<![endif]-->
    </head>
    <body class="account-page">
	
		<!-- Main Wrapper -->
        <div class="main-wrapper">
			<div class="account-content">
				
				<div class="container">
				
					<!-- Account Logo -->
					<div class="account-logo">
						
					</div>
					<!-- /Account Logo -->

					<div class="account-box">
						<div class="account-wrapper">
							<h3 class="account-title">تسجيل الدخول</h3>
							<p class="account-subtitle">الوصول إلى لوحة القيادة الخاصة بنا</p>
							<?php if(mysqli_num_rows($numlistlogincheck) >= 3){?>
<div class="body bg-gray">
	<div style='background:#fff; color:red; text-align:center; line-height:45px; font-weight:bold;'>المستخدم الخاص بك هو الحظر. يرجى الاتصال بخدمة العملاء الخاصة بك.</div>
</div>
<?php } else { ?>
							<?php
if( isset($_SESSION['ERRMSG_ARR']) && is_array($_SESSION['ERRMSG_ARR']) && count($_SESSION['ERRMSG_ARR']) >0 ) {
foreach($_SESSION['ERRMSG_ARR'] as $msg) {
echo "<div style='background: #f55145; color: #fff; text-align: center; line-height: 22px; font-weight: bold; width: 100%; font-size: 13px; margin: 17px auto; padding: 5px; margin-top: -20px;'>".$msg."</div>";  
}
unset($_SESSION['ERRMSG_ARR']); }?>
							<!-- Account Form -->
							<form method="post" id="login_form" name="login_form" action="script/memLog.php">
							<div class="form-group">
								<input type="hidden" name="account_type" value="27">
							
							</div>
								<div class="form-group">
									<label>عنوان بريد الكتروني</label>
									<input class="form-control" name="email" type="email">
								</div>
								<div class="form-group">
									<div class="row">
										<div class="col">
											<label>كلمه السر</label>
										</div>
										<!--div class="col-auto">
											<a class="text-muted" href="forgot-password.html">
												Forgot password?
											</a>
										</div-->
									</div>
									<input class="form-control" name="password" type="password">
								</div>
								
<!--
								<div class="form-group">
				
				<div class="g-recaptcha concap" data-sitekey="6Lc3y1QlAAAAAJdTcuywP1FHMz3g2-ru9qK_Rhff" data-callback="verifyRecaptchaCallback" data-expired-callback="expiredRecaptchaCallback"></div>
                            <input class="form-control d-none" data-recaptcha="true" required data-error="Please complete the Captcha">
                            <div class="help-block with-errors" style="margin: auto;"></div>
				</div>
-->
								
								<div class="form-group text-center">
									<button class="btn btn-primary account-btn" type="submit" name="button">تسجيل الدخول</button>
								</div>
								
							</form>
							<!-- /Account Form -->
						<?php } ?>	
						</div>
					</div>
				</div>
			</div>
        </div>
		<!-- /Main Wrapper -->
		
		<!-- jQuery -->
        <script src="assets\js\jquery-3.5.1.min.js"></script>
		
		<!-- Bootstrap Core JS -->
        <script src="assets\js\popper.min.js"></script>
        <script src="assets\js\bootstrap.min.js"></script>
		
		<!-- Custom JS -->
		<script src="assets\js\app.js"></script>
		<script>
$(function () {

    window.verifyRecaptchaCallback = function (response) {
        $('input[data-recaptcha]').val(response).trigger('change')
    }

    window.expiredRecaptchaCallback = function () {
        $('input[data-recaptcha]').val("").trigger('change')
    }

    $('#login_form').validator();

    $('#login_form').on('submit', function (e) {
        if (!e.isDefaultPrevented()) {
            var url = "script/memLog.php";

            $.ajax({
                type: "POST",
                url: url,
                data: $(this).serialize(),
                success: function (data) {
                    var messageAlert = 'alert-' + data.type;
                    var messageText = data.message;

                    var alertBox = '<div class="alert ' + messageAlert + ' alert-dismissable"><button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>' + messageText + '</div>';
                    if (messageAlert && messageText) {
                        $('#login_form').find('.messages').html(alertBox);
                        $('#login_form')[0].reset();
                        grecaptcha.reset();
                    }
                }
            });
            return false;
        }
    })
});

</script>
    </body>
</html>