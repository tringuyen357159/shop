<?php include 'inc/header.php';?>
<?php include 'inc/sidebar.php';?>	
<?php
	$filepath = realpath(dirname(__FILE__));
	require_once($filepath.'/../classes/cart.php');
	require_once($filepath.'/../helpers/format.php');

?>
<?php
	 $cart = new cart();
	 if(isset($_GET['shiftid'])){
		$id = $_GET['shiftid'];
		$time = $_GET['time'];
		$price = $_GET['price'];
		$shifted = $cart->shifted($id,$time,$price);
	 }
	 if(isset($_GET['deleteid'])){
		$id = $_GET['deleteid'];
		$time = $_GET['time'];
		$price = $_GET['price'];
		$delete_shifted = $cart->delete_shifted($id,$time,$price);
	 }
 ?>
        <div class="grid_10">
            <div class="box round first grid">
                <h2>Inbox</h2>
                <div class="block">   
				<?php 
					if(isset($shifted)){
						$shifted;
					}
				?>   
				<?php 
					if(isset($delete_shifted)){
						$delete_shifted;
					}
				?>     
                    <table class="data display datatable" id="example">
					<thead>
						<tr>
							<th>Stt</th>
							<th>Sản phẩm</th>
							<th>Số lượng</th>
							<th>Giá</th>
							<th>Id Khách hàng</th>
							<th>Địa chỉ</th>
							<th>Thời gian</th>
							<th>Hành động</th>
						</tr>
					</thead>
					<tbody>
						<?php
							$cart = new cart();
							$fm = new Format();
							$get_inbox = $cart->get_inbox();
							if($get_inbox){
								$i = 0;
								while($result = $get_inbox->fetch_assoc()){	
									$i++	;					
						 ?>
						<tr class="odd gradeX">
							<td><?php echo $i ?></td>
							<td><?php echo $result['productName'] ?></td>
							<td><?php echo $result['quantity'] ?></td>
							<td><?php echo $result['price'].' '."VNĐ" ?></td>
							<td><?php echo $result['customerId'] ?></td>
							<td><a href="customer.php?customerid=<?php echo $result['customerId'] ?>">Khách hàng</a></td>
							<td><?php echo $fm->formatDate($result['date_order']) ?></td>
							<td>
								<?php
									if($result['status'] == 0){								
								 ?>
								 	<a href="?shiftid=<?php echo $result['id'] ?>&price=<?php echo $result['price'] ?>
									&time=<?php echo $result['date_order'] ?>">Đang xử lý</a>
								 <?php 
									}else if($result['status'] == 1){
										echo 'Đã xử lý';
									}else{
								 ?>
									<a href="?deleteid=<?php echo $result['id'] ?>&price=<?php echo $result['price'] ?>
									&time=<?php echo $result['date_order'] ?>">Xoá</a>
								<?php 
									}
								?>
							</td>
						</tr>
						<?php 
								}
							}
						?>
					</tbody>
				</table>
               </div>
            </div>
        </div>
<script type="text/javascript">
    $(document).ready(function () {
        setupLeftMenu();

        $('.datatable').dataTable();
        setSidebarHeight();
    });
</script>
<?php include 'inc/footer.php';?>
