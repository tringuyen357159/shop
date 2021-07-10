<?php 
	include 'include/header.php';
	// include 'include/slider.php';
?>
<?php 
     $customer_id = Session::get('customer_id');
    if($customer_id == null){
       header('Location:login.php');
    }
    $cart = new cart();
    if(isset($_GET['confirmid'])){
		$id = $_GET['confirmid'];
		$time = $_GET['time'];
		$price = $_GET['price'];
		$confirm_shifted = $cart->confirm_shifted($id,$time,$price);
	 }
	
?>
<style>

    .box-left{
        width: 100%;
        border: 1px solid #666;
        padding: 4px;
        margin-top: 50px;
    }
    
</style>
<form action="" method="post">
 <div class="main">
    <div class="content">
    	<div class="section group" >
            <div class="content_top">
                <div class="heading">
                <h3>CHI TIẾT THANH TOÁN</h3>
                </div>
                <div class="clear"></div>
                <div class="box-left">
                <div class="cartpage">
						<table class="tblone">
							<tr>
								<th width="15%">Tên sản phẩm</th>
                                <th width="10%">Ảnh</th>
								<th width="15%">Giá</th>
								<th width="10%">Số lượng</th>
                                <th width="15%">Trạng thái</th>
                                <th width="20%">Ngày đặt</th>
								<th width="25%">Tổng cộng</th>
							</tr>
							<?php
                                $customer_id = Session::get('customer_id');
								$get_cart = $cart->get_cart_detail($customer_id);
								if($get_cart){
									while($result = $get_cart->fetch_assoc()){
							 ?>
							<tr>
								<td><?php echo $result['productName'] ?></td>
                                <td><img src="admin/uploads/<?php echo $result['image'] ?>" alt=""/></td>
								<td><?php echo $result['price'].' '."VNĐ" ?></td>
								<td>
									<?php echo $result['quantity'] ?>
								</td>
                                <td> 
                                    <?php 
                                        if($result['status'] == '0'){
                                            echo 'Đang xử lý';
                                        } else if($result['status'] == '1'){
                                    ?>
                                        <a href="?confirmid=<?php echo $customer_id; ?>&price=<?php echo $result['price'] ?>&time=<?php echo $result['date_order'] ?>">Đã xử lý</a>
                                    <?php
                                        }else{
                                            echo 'Đã nhận';
                                        }
                                    ?>
                                </td>
                                <td><?php echo $fm->formatDate($result['date_order']) ?></td>
								<td>
                                    <?php 
                                        $total = $result['quantity'] * $result['price'];
                                        echo $total.' '."VNĐ"; 
                                    ?>
                                </td>
							</tr>
							<?php
                                    }
                                }
                             ?>
						</table>
					</div>
					
                </div>
            </div>

 		</div>
 	</div>
   
</div>
</form>
<?php 
	include 'include/footer.php'
?>

