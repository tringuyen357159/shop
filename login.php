<?php 
	include 'include/header.php';
?>
<?php
    if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['submit'])){
        $store_customer = $customer->store_customer($_POST);
    }
 ?>

<?php
    if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['login'])){
        $login_customer = $customer->login_customer($_POST);
    }
 ?>
 <?php 
	$login_check = Session::get('customer_login');
	if($login_check==true){
		header('Location:order.php');
	}
 ?>
 <div class="main">
    <div class="content">
    	 <div class="login_panel">
        	<h3>ĐĂNG NHẬP</h3>
        	<form action="" method="post">
                	<input name="email" type="text"  class="field" placeholder="Email">
                    <input name="password" type="password"  class="field" placeholder="Mật khẩu">
                
                 <!-- <p class="note">If you forgot your passoword just enter your email and click <a href="#">here</a></p> -->
                    <div class="buttons"><div><input type="submit" name="login" class="grey" value="ĐĂNG NHẬP" style="padding: 10px 15px;
				font-size: 15px;
				font-weight: bold;
				color: #fff;
				cursor: pointer;
				background: #3f4040;
				border-radius: 4px;"></input></div></div>
				 </form>
                    </div>
    	<div class="register_account">
    		<h3>ĐĂNG KÝ</h3>
			<?php
				if(isset($store_customer)){
					echo $store_customer;
				}
			 ?>
    		<form action="" method="post">
		   			 <table>
		   				<tbody>
						<tr>
						<td>
							<div>
							<input type="text" name="name" placeholder="Nhập tên" >
							</div>
							
							<div>
							   <input type="text" name="city" placeholder="Nhập thành phố" >
							</div>
							
							<div>
								<input type="text" name="zipcode" placeholder="Nhập mã Zip" >
							</div>
							<div>
								<input type="text" name="email" placeholder="Nhập Email" >
							</div>
		    			 </td>
		    			<td>
						<div>
							<input type="text" name="address" placeholder="Nhập địa chỉ" >
						</div>
		    		<div>
						<select id="country" name="country" onchange="change_country(this.value)" class="frm-field required">
							<option value="null">Chọn miền</option>         
							<option value="hcm">Hồ Chí Minh</option>
							<option value="dn">Đà Nẵng</option>
							<option value="hn">Hà Nội</option>
							<option value="bd">Bình Dương</option>
							<option value="nv">Nghệ An</option>
							<option value="brvt">Bà Rịa Vũng Tàu</option>
							<option value="qb">Quảng Bình</option>
							<option value="h">Huế</option>
		         </select>
				 </div>		        
	
		           <div>
		          <input type="text" name="phone" placeholder="Nhập SĐT">
		          </div>
				  
				  <div>
					<input name="password" placeholder="Nhập mật khẩu" type="password" style="padding: 7px;
    					margin-top: 4px;width: 340px;">
				</div>
		    	</td>
		    </tr> 
		    </tbody></table> 
		   <div class="search"><div><input type="submit" name="submit" class="grey" value="TẠO TÀI KHOẢN" style="padding: 10px 15px;
				font-size: 15px;
				font-weight: bold;
				color: #fff;
				cursor: pointer;
				background: #3f4040;
				border-radius: 4px;"></input></div></div>
		    <!-- <p class="terms">By clicking 'Create Account' you agree to the <a href="#">Terms &amp; Conditions</a>.</p> -->
		    <div class="clear"></div>
		    </form>
    	</div>  	
       <div class="clear"></div>
    </div>
 </div>
 <?php 
	include 'include/footer.php'
?>
