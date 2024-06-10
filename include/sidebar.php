<div class="sidebar" id="sidebar">
  <div class="sidebar-inner slimscroll">
    <div id="sidebar-menu" class="sidebar-menu">
      <ul>
        <li class="menu-title"> <span>Main</span> </li>
        

		  
		  
			  <?php if($customerchechlogin_row['account_type'] == '1' || $primiaryRole == 'hr' && $customerchechlogin_row[ 'account_type' ] == $counterID){?>
		  <li><a href="index.php"><i class="la la-dashboard"></i> <span>
<?php $result_lang=mysqli_query($link,$invoice_language_sql);while($list_lang=mysqli_fetch_array($result_lang)){
if($list_lang['lang_id']=='2'){	if($lang_cat =='en'){echo $list_lang['english'];}else{echo $list_lang['arabic'];} } } ?></span></a></li>
		  <?php }else{ ?>
			   <li><a href="emloyee-dashboard.php"> 
<?php $result_lang=mysqli_query($link,$invoice_language_sql);while($list_lang=mysqli_fetch_array($result_lang)){
if($list_lang['lang_id']=='2'){	if($lang_cat =='en'){echo $list_lang['english'];}else{echo $list_lang['arabic'];} } } ?></a></li>
			  <?php } ?>
           
         
     
        

		  
        <?php
        if ( $primiaryRole == 'hr' && $customerchechlogin_row[ 'account_type' ] == $counterID ) {
          ?>
		  <li><a href="users.php"><i class="la la-users"></i> <span><?php $result_lang=mysqli_query($link,$invoice_language_sql);while($list_lang=mysqli_fetch_array($result_lang)){
if($list_lang['lang_id']=='3'){	if($lang_cat =='en'){echo $list_lang['english'];}else{echo $list_lang['arabic'];} } } ?></span></a></li>
		  <li class="submenu">
								<a href="#"><i class="la la-rocket"></i> <span> <?php $result_lang=mysqli_query($link,$invoice_language_sql);while($list_lang=mysqli_fetch_array($result_lang)){
if($list_lang['lang_id']=='4'){	if($lang_cat =='en'){echo $list_lang['english'];}else{echo $list_lang['arabic'];} } } ?></span> <span class="menu-arrow"></span></a>
								<ul style="display: none;">
									<li><a href="ac-categories.php"><?php $result_lang=mysqli_query($link,$invoice_language_sql);while($list_lang=mysqli_fetch_array($result_lang)){
if($list_lang['lang_id']=='5'){	if($lang_cat =='en'){echo $list_lang['english'];}else{echo $list_lang['arabic'];} } } ?></a></li>
									<li><a href="products.php"><?php $result_lang=mysqli_query($link,$invoice_language_sql);while($list_lang=mysqli_fetch_array($result_lang)){
if($list_lang['lang_id']=='6'){	if($lang_cat =='en'){echo $list_lang['english'];}else{echo $list_lang['arabic'];} } } ?></a></li>
								</ul>
							</li>
		  
       <!-- country start  -->
		  
		  
		  <li class="submenu">
								<a href="#"><i class="la la-map-marked"></i> <span> <?php $result_lang=mysqli_query($link,$invoice_language_sql);while($list_lang=mysqli_fetch_array($result_lang)){
if($list_lang['lang_id']=='130'){	if($lang_cat =='en'){echo $list_lang['english'];}else{echo $list_lang['arabic'];} } } ?></span> <span class="menu-arrow"></span></a>
								<ul style="display: none;">
									<li><a href="add_country.php"><?php $result_lang=mysqli_query($link,$invoice_language_sql);while($list_lang=mysqli_fetch_array($result_lang)){
if($list_lang['lang_id']=='21'){	if($lang_cat =='en'){echo $list_lang['english'];}else{echo $list_lang['arabic'];} } } ?></a></li>
									<li><a href="add_city.php"><?php $result_lang=mysqli_query($link,$invoice_language_sql);while($list_lang=mysqli_fetch_array($result_lang)){
if($list_lang['lang_id']=='20'){	if($lang_cat =='en'){echo $list_lang['english'];}else{echo $list_lang['arabic'];} } } ?></a></li>
								</ul>
							</li>
		  
		  <!--  Country end -->
		  
		 
		  
		  <li class="submenu">
								<a href="#"><i class="la la-file-invoice"></i> <span><?php $result_lang=mysqli_query($link,$invoice_language_sql);while($list_lang=mysqli_fetch_array($result_lang)){
if($list_lang['lang_id']=='7'){	if($lang_cat =='en'){echo $list_lang['english'];}else{echo $list_lang['arabic'];} } } ?>  </span> <span class="menu-arrow"></span></a>
								<ul style="display: none;">
									<li><a href="invoice.php"><?php $result_lang=mysqli_query($link,$invoice_language_sql);while($list_lang=mysqli_fetch_array($result_lang)){
if($list_lang['lang_id']=='8'){	if($lang_cat =='en'){echo $list_lang['english'];}else{echo $list_lang['arabic'];} } } ?></a></li>
									<li><a href="payments.php"><?php $result_lang=mysqli_query($link,$invoice_language_sql);while($list_lang=mysqli_fetch_array($result_lang)){
if($list_lang['lang_id']=='9'){	if($lang_cat =='en'){echo $list_lang['english'];}else{echo $list_lang['arabic'];} } } ?></a></li>
									<li><a href="taxes.php">
										<?php $result_lang=mysqli_query($link,$invoice_language_sql);while($list_lang=mysqli_fetch_array($result_lang)){
if($list_lang['lang_id']=='10'){	if($lang_cat =='en'){echo $list_lang['english'];}else{echo $list_lang['arabic'];} } } ?></a></li>
								</ul>
							</li>
		  <li> <a href="meeting_list.php"><i class="la la-headphones"></i> <span><?php $result_lang=mysqli_query($link,$invoice_language_sql);while($list_lang=mysqli_fetch_array($result_lang)){
if($list_lang['lang_id']=='117'){	if($lang_cat =='en'){echo $list_lang['english'];}else{echo $list_lang['arabic'];} } } ?></span></a> </li>
		<li>
							<?php if($lang_cat =='en'){?>
							<a href="lang.php?lang=ar" class="dropdown-item"><img src="assets\img\flags\fr1.png" alt="" height="20"> <span>عربى</span></a>
							<?php } else {?>
							<a href="lang.php?lang=en" class="dropdown-item"><img src="assets\img\flags\us.png" alt="" height="20"> <span>English</span></a>
							<?php } ?>
						</li>  
		  
        <?php } ?>
		  <?php if($customerchechlogin_row['account_type'] == '1'){?>
        <li> <a href="settings.php"><i class="la la-cog"></i> <span>Settings</span></a> </li>
		  <?php } ?>
      </ul>
    </div>
  </div>
</div>
