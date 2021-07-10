<?php 
	include 'include/header.php';
	
?>
<?php 
	$login_check = Session::get('customer_login');
	if($login_check==false){
		header('Location:login.php');
	}
 ?>
<div class="main">
    <div class="content">
    	<div class="cartoption">		
			<div class="cartpage">
			    <div class="not_found">
                    Order Page
                </div>
			</div>
    	</div>  	
       <div class="clear"></div>
    </div>
 </div>
 <?php 
	include 'include/footer.php'
?>