<?php 
	include 'include/header.php';
	// include 'include/slider.php';
?>
<?php

	if(isset($_GET['cartid'])){
		$cartId = $_GET['cartid'];
		$delete_cart = $cart->delete_cart($cartId);
	}

	if($_SERVER['REQUEST_METHOD'] == 'POST' && isset($_POST['submit'])){
		$cartId = $_POST['cartId'];
		$quantity = $_POST['quantity'];
		if($quantity <= 0){
			$delete_cart = $cart->delete_cart($cartId);
		}else{
			$update_cart = $cart->update_cart($cartId,$quantity);
		}
	}
?>
<?php 
	if(!isset($_GET['id'])){
		echo "<meta http-equiv='refresh' content='0;URL=?id=live'>";
	}
?>
 <div class="main">
    <div class="content">
    	<div class="cartoption">		
			<div class="cartpage">
			    	<h2>Giỏ hàng của bạn</h2>

					<?php if(isset($update_cart)){
						echo $update_cart;
					}
					 ?>
					 <?php if(isset($delete_cart)){
						echo $delete_cart;
					}
					 ?>
						<table class="tblone">
							<tr>
								<th width="20%">Tên sản phẩm</th>
								<th width="10%">Ảnh</th>
								<th width="15%">Giá</th>
								<th width="25%">Số lượng</th>
								<th width="20%">Tổng cộng</th>
								<th width="10%">Hành động</th>
							</tr>
							<?php
								$get_cart = $cart->get_cart();
								if($get_cart){
									$subtotal=0;
									while($result = $get_cart->fetch_assoc()){
							 ?>
							<tr>
								<td><?php echo $result['productName'] ?></td>
								<td><img src="admin/uploads/<?php echo $result['image'] ?>" alt=""/></td>
								<td><?php echo $result['price'] ?></td>
								<td>
									<form action="" method="post">
										<input type="hidden" name="cartId" min='0' value="<?php echo $result['cartId'] ?>"/>
										<input type="number" name="quantity" min='0' value="<?php echo $result['quantity'] ?>"/>
										<input type="submit" name="submit" value="Update"/>
									</form>
								</td>
								<td><?php 
								$total = $result['quantity'] *$result['price'];
								echo $total ?></td>
								<td><a onclick="return confirm('Bạn có chắc chắn muốn xoá?')" href="?cartid=<?php echo $result['cartId'] ?>">Xoá</a></td>
							</tr>
							<?php 
										$subtotal = $subtotal + $total; 
									}
								}
							?>
							
						</table>
						<?php 
							$check = $cart->check_cart();
							if($check){			
						?>
						<table style="float:right;text-align:left;" width="40%">
							<tr>
								<th>Tổng cộng : </th>
								<td><?php if($get_cart){
											echo $subtotal;
											Session::set("sum",$subtotal);
										}else
											echo 0;  
									?></td>
							</tr>
							<tr>
								<th>Thuế : </th>
								<td>10%</td>
							</tr>
							<tr>
								<th>Tổng tiền :</th>
								<td><?php if($get_cart){
												$vat = $subtotal *0.1;
												$price_total = $subtotal + $vat;
												echo $price_total;
											}else
												echo 0; 
								 ?></td>
							</tr>
					   </table>
					   <?php 
							}else{
								echo "Giỏ hàng trống.Vui lòng mua sản phẩm!!";
							}

					   ?>
					</div>
					<div class="shopping">
						<div class="shopleft">
							<a href="index.php"> <img src="images/shop.png" alt="" /></a>
						</div>
						<div class="shopright">
							<a href="payment.php"> <img src="images/check.png" alt="" /></a>
						</div>
					</div>
    	</div>  	
       <div class="clear"></div>
    </div>
 </div>
<?php 
	include 'include/footer.php'
?>

