<?php 
	include 'include/header.php';
	// include 'include/slider.php';
?>
<?php 

    if(isset($_GET['orderid']) && $_GET['orderid']=='order'){
       $customer_id = Session::get('customer_id');
       $store_order = $cart->store_order($customer_id);
       $delete_cart = $cart->delete_all_cart();
       header('Location:success.php');
    }
	
?>
<style>
    .box-right{
        width: 46%;
        border: 1px solid #666;
        float: right;
        padding: 4px;
        margin-top: 50px;
    }
    .box-left{
        width: 50%;
        border: 1px solid #666;
        float: left;
        padding: 4px;
        margin-top: 50px;
    }
    .submit_order{
        padding: 10px 70px;
        border: none;
        background: black;
        font-size: 25px;
        color: #fff;
        border-radius: 3px;
        text-align: center;
        cursor: pointer;
    }
    .section.group{
        margin-bottom:30px;
    }
</style>
<form action="" method="post">
 <div class="main">
    <div class="content">
    	<div class="section group" >
            <div class="content_top">
                <div class="heading">
                <h3>THANH TOÁN OFFLINE</h3>
                </div>
                <div class="clear"></div>
                <div class="box-right">
                <table class="tblone">
            <?php 
                $id = Session::get('customer_id');
                $get_customer = $customer->show_customer($id);
                if($get_customer){
                    while($result = $get_customer->fetch_assoc()){
   
            ?>
                <tr>
                    <td>Tên</td>
                    <td>:</td>
                    <td><?php echo $result['name'] ?></td>
                </tr>
                <tr>
                    <td>Địa chỉ</td>
                    <td>:</td>
                    <td><?php echo $result['address'] ?></td>
                </tr>
                <tr>
                    <td>Thành phố</td>
                    <td>:</td>
                    <td><?php echo $result['city'] ?></td>
                </tr>
                <tr>
                    <td>Zip-Code</td>
                    <td>:</td>
                    <td><?php echo $result['zipcode'] ?></td>
                </tr>
                <tr>
                    <td>SĐT</td>
                    <td>:</td>
                    <td><?php echo $result['phone'] ?></td>
                </tr>
                <tr>
                    <td>Email</td>
                    <td>:</td>
                    <td><?php echo $result['email'] ?></td>
                </tr>
                
                <?php
                        }
                    }
                ?>
            </table>
                </div>
                <div class="box-left">
                <div class="cartpage">
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
                                <th width="5%">Stt</th>
								<th width="25%">Tên sản phẩm</th>
								<th width="20%">Giá</th>
								<th width="15%">Số lượng</th>
								<th width="20%">Tổng cộng</th>
							</tr>
							<?php
								$get_cart = $cart->get_cart();
								if($get_cart){
									$subtotal=0;
                                    $i=0;
									while($result = $get_cart->fetch_assoc()){
                                        $i++
							 ?>
							<tr>
                                <td><?php echo $i ?></td>
								<td><?php echo $result['productName'] ?></td>
								<td><?php echo $result['price'].' '."VNĐ" ?></td>
								<td>
									<?php echo $result['quantity'] ?>
								</td>
								<td><?php 
								$total = $result['quantity'] *$result['price'];
								echo $total.' '."VNĐ" ?></td>
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
											echo $subtotal.' '."VNĐ";
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
												echo $price_total.' '."VNĐ";
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
					
                </div>
            </div>

 		</div>
         <center> <a href="?orderid=order" class="submit_order">ĐẶT HÀNG</a></center>
 	</div>
   
</div>
</form>
<?php 
	include 'include/footer.php'
?>

