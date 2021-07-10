<?php 
	include 'include/header.php';
	
?>
<?php 
	$login_check = Session::get('customer_login');
    if($login_check==false){
       header('Location:login.php');
    }
?>
<style>
    h3.payment{
        text-align: center;
        font-size: 20px;
        font-weight: bold;

    }
    .wrapper_method{
        text-align: center;
        width: 550px;
        margin: 0 auto;
        border:0.5px solid #666;
        padding: 20px;
        background: #eeac94;
    }

    .wrapper_method a {
        padding: 10px;
        background: black;
        color: #fff;
        border-radius: 5px;
    }
    .wrapper_method h3{
        margin-bottom: 30px;
    }
</style>
 <div class="main">
    <div class="content">
    	<div class="section group">
            <div class="content_top">
                <div class="heading">
                <h3>THANH TOÁN</h3>
                </div>
                <div class="clear"></div>
                <div class="wrapper_method">
                    <h3 class="payment">CHỌN PHƯƠNG THỨC THANH TOÁN</h3>
                    <a href="onlinepayment.php">Online</a>
                    <a href="offlinepayment.php">Offline</a>
                </div>
            </div>
            
 		</div>
 	</div>
</div>
<?php 
	include 'include/footer.php'
?>

