
<div class="header">
			
				<!-- Logo -->
                <div class="header-left">
                    <a href="" class="logo">
						<img src="images\oudlogo-invoice.png" width="56" alt="Splendid CRM">
					</a>
                </div>
				<!-- /Logo -->
				
				<a id="toggle_btn" href="javascript:void(0);">
					<span class="bar-icon">
						<span></span>
						<span></span>
						<span></span>
					</span>
				</a>
				
				<!-- Header Title -->
                <div class="page-title-box">
					
                </div>
				<!-- /Header Title -->
				
				<a id="mobile_btn" class="mobile_btn" href="#sidebar"><i class="fa fa-bars"></i></a>
				
				<!-- Header Menu -->
				<ul class="nav user-menu">
				
					<!-- Search -->
					<li class="nav-item">
						<div class="top-nav-search">
							<a href="javascript:void(0);" class="responsive-search">
								<i class="fa fa-search"></i>
						   </a>
							<form action="search.html">
								<input class="form-control" type="text" placeholder="Search here">
								<button class="btn" type="submit"><i class="fa fa-search"></i></button>
							</form>
						</div>
					</li>
					<!-- /Search -->
				
					<!-- Flag -->
					<li class="nav-item dropdown has-arrow flag-nav">
						<a class="nav-link dropdown-toggle" data-toggle="dropdown" href="#" role="button">
							<?php if($lang_cat =='en'){?>
							<img src="assets\img\flags\us.png" alt="" height="20"> <span>English</span>
							<?php } else {?>
							<img src="assets\img\flags\fr1.png" alt="" height="20"> <span>عربى</span>
							<?php } ?>
						</a>
						<div class="dropdown-menu dropdown-menu-right">
							<a href="lang.php?lang=ar" class="dropdown-item">
								<img src="assets\img\flags\fr1.png" alt="" height="16">عربى 
							</a>
							<a href="lang.php?lang=en" class="dropdown-item">
								<img src="assets\img\flags\us.png" alt="" height="16">English  
							</a>
							
							
						</div>
					</li>
					<!-- /Flag -->
				
					<!-- Notifications -->
					<?php
					
        if ( $primiaryRole == 'hr' && $customerchechlogin_row[ 'account_type' ] == $counterID ) {
          ?>
					<li class="nav-item dropdown">
						<a href="#" class="dropdown-toggle nav-link" data-toggle="dropdown">
							<i class="fa fa-bell-o"></i> <span class="badge badge-pill">
							<?php
							$notification_sql = "select * from personal_info WHERE status='0'";
								$notification_result = mysqli_query($link, $notification_sql);
									

									$notification_sql2 = "select * from emegency_contact WHERE status='0'";
										$notification_result2 = mysqli_query($link, $notification_sql2);
											

												$notification_sql3 = "select * from bank_details WHERE status='0'";
													$notification_result3 = mysqli_query($link, $notification_sql3);
														
							?>
							<?php echo mysqli_num_rows($notification_result) + mysqli_num_rows($notification_result2) + mysqli_num_rows($notification_result3);?>
							</span>
						</a>
						<div class="dropdown-menu notifications">
							<div class="topnav-dropdown-header">
								<span class="notification-title">
<?php $result_lang=mysqli_query($link,$invoice_language_sql);while($list_lang=mysqli_fetch_array($result_lang)){
if($list_lang['lang_id']=='11'){	if($lang_cat =='en'){echo $list_lang['english'];}else{echo $list_lang['arabic'];} } } ?>
									</span>
								<a href="javascript:void(0)" class="clear-noti"> امسح الكل </a>
							</div>
							<div class="noti-content">
								<ul class="notification-list">
									
									<?php while($notification_row = mysqli_fetch_array( $notification_result )){
										$employessID = $notification_row['profile_id'];
											$leave_tbl2_sql="select * from users where id='$employessID'";
												$leave_tbl2_result=mysqli_query($link,$leave_tbl2_sql);
													$leave_tbl2_row=mysqli_fetch_array($leave_tbl2_result);
									?>
									<li class="notification-message">
										<a href="datachange.php">
											<div class="media">
												<span class="avatar">
													<img alt="" src="uploads/<?php echo $leave_tbl2_row['image'];?>">
												</span>
												<div class="media-body">
													<p class="noti-details"><span class="noti-title"><?php echo $leave_tbl2_row['fullname'];?></span> طلب <span class="noti-title">تحديث المعلومات الشخصية </span></p>
													<p class="noti-time"><span class="notification-time"></span></p>
												</div>
											</div>
										</a>
									</li>
									<?php } ?>
									
									
									<?php while($notification_row2 = mysqli_fetch_array( $notification_result2 )){
										$employessID2 = $notification_row2['profile_id'];
											$leave_tbl2_sql="select * from users where id='$employessID2'";
												$leave_tbl2_result=mysqli_query($link,$leave_tbl2_sql);
													$leave_tbl2_row=mysqli_fetch_array($leave_tbl2_result);
									?>
									<li class="notification-message">
										<a href="bank_details_request.php">
											<div class="media">
												<span class="avatar">
													<img alt="" src="uploads/<?php echo $leave_tbl2_row['image'];?>">
												</span>
												<div class="media-body">
													<p class="noti-details"><span class="noti-title"><?php echo $leave_tbl2_row['fullname'];?></span> طلب <span class="noti-title">تحديث جهات الاتصال في حالات الطوارئ </span></p>
													<p class="noti-time"><span class="notification-time"></span></p>
												</div>
											</div>
										</a>
									</li>
									<?php } ?>
									
									
									<?php while($notification_row3 = mysqli_fetch_array( $notification_result3 )){
										$employessID3 = $notification_row3['profile_id'];
											$leave_tbl2_sql="select * from users where id='$employessID3'";
												$leave_tbl2_result=mysqli_query($link,$leave_tbl2_sql);
													$leave_tbl2_row=mysqli_fetch_array($leave_tbl2_result);
									?>
									<li class="notification-message">
										<a href="employee-emergency-contact.php">
											<div class="media">
												<span class="avatar">
													<img alt="" src="uploads/<?php echo $leave_tbl2_row['image'];?>">
												</span>
												<div class="media-body">
													<p class="noti-details"><span class="noti-title"><?php echo $leave_tbl2_row['fullname'];?></span> طلب <span class="noti-title">تحديث المعلومات المصرفية </span></p>
													<p class="noti-time"><span class="notification-time"></span></p>
												</div>
											</div>
										</a>
									</li>
									<?php } ?>
									
									
									
								</ul>
							</div>
							<div class="topnav-dropdown-footer">
								<a href="activities.html">عرض جميع الإخطارات</a>
							</div>
						</div>
					</li>
					<?php } ?>
					<!-- /Notifications -->
					
					<!-- Message Notifications -->
					
					<!-- /Message Notifications -->

					<li class="nav-item dropdown has-arrow main-drop">
						<a href="#" class="dropdown-toggle nav-link" data-toggle="dropdown">
							<span class="user-img">
							
							<?php if($customerchechlogin_row['image']!='') { ?>
                      <img src="uploads/<?php echo $customerchechlogin_row['image'];?>" />
                      <?php } else{ ?>
					  <img src="assets\img\user.jpg" alt="user">
									<?php } ?>
							<span class="status online"></span></span>
							<span><?php echo ucwords($customerchechlogin_row['fullname']);?></span>
						</a>
						<div class="dropdown-menu">
							<a class="dropdown-item" href="profile.php">
<?php $result_lang=mysqli_query($link,$invoice_language_sql);while($list_lang=mysqli_fetch_array($result_lang)){
if($list_lang['lang_id']=='12'){	if($lang_cat =='en'){echo $list_lang['english'];}else{echo $list_lang['arabic'];} } } ?>
								</a>
							<?php if($customerchechlogin_row['account_type'] == '1'){?>
							<a class="dropdown-item" href="settings.php">إعدادات</a>
							<?php } ?>
							<a class="dropdown-item" href="language_setting.php">
<?php $result_lang=mysqli_query($link,$invoice_language_sql);while($list_lang=mysqli_fetch_array($result_lang)){
if($list_lang['lang_id']=='100'){	if($lang_cat =='en'){echo $list_lang['english'];}else{echo $list_lang['arabic'];} } } ?>
								</a>
							<a class="dropdown-item" href="user-password-change.php">
<?php $result_lang=mysqli_query($link,$invoice_language_sql);while($list_lang=mysqli_fetch_array($result_lang)){
if($list_lang['lang_id']=='13'){	if($lang_cat =='en'){echo $list_lang['english'];}else{echo $list_lang['arabic'];} } } ?>
								</a>
							
							<a class="dropdown-item" href="logout.php">
								<?php $result_lang=mysqli_query($link,$invoice_language_sql);while($list_lang=mysqli_fetch_array($result_lang)){
if($list_lang['lang_id']=='14'){	if($lang_cat =='en'){echo $list_lang['english'];}else{echo $list_lang['arabic'];} } } ?>
								</a>
						</div>
					</li>
				</ul>
				<!-- /Header Menu -->
				
				<!-- Mobile Menu -->
				<div class="dropdown mobile-user-menu">
					<a href="#" class="nav-link dropdown-toggle" data-toggle="dropdown" aria-expanded="false"><i class="fa fa-ellipsis-v"></i></a>
					<div class="dropdown-menu dropdown-menu-right">
						<a class="dropdown-item" href="profile.php"><?php $result_lang=mysqli_query($link,$invoice_language_sql);while($list_lang=mysqli_fetch_array($result_lang)){
if($list_lang['lang_id']=='12'){	if($lang_cat =='en'){echo $list_lang['english'];}else{echo $list_lang['arabic'];} } } ?></a>
						<a class="dropdown-item" href="language_setting.php"><?php $result_lang=mysqli_query($link,$invoice_language_sql);while($list_lang=mysqli_fetch_array($result_lang)){
if($list_lang['lang_id']=='100'){	if($lang_cat =='en'){echo $list_lang['english'];}else{echo $list_lang['arabic'];} } } ?></a>
						<a class="dropdown-item" href="user-password-change.php"><?php $result_lang=mysqli_query($link,$invoice_language_sql);while($list_lang=mysqli_fetch_array($result_lang)){
if($list_lang['lang_id']=='13'){	if($lang_cat =='en'){echo $list_lang['english'];}else{echo $list_lang['arabic'];} } } ?></a>
						<a class="dropdown-item" href="logout.php"><?php $result_lang=mysqli_query($link,$invoice_language_sql);while($list_lang=mysqli_fetch_array($result_lang)){
if($list_lang['lang_id']=='14'){	if($lang_cat =='en'){echo $list_lang['english'];}else{echo $list_lang['arabic'];} } } ?></a>
					</div>
				</div>
				<!-- /Mobile Menu -->
				
            </div>