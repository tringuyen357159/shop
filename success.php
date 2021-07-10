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
    h2.success_order{
        text-align: center;
        color: red;
    }
    p.success_note{
        text-align: center;
        padding: 8px;
        font-size: 17px;
    }
</style>
 <div class="main">
    <div class="content">
    	<div class="section group" >
        <div class="content_top">
               
                <h2 class="success_order">THANH TOÁN THÀNH CÔNG</h2>
                <?php 
                    $customer_id = Session::get('customer_id');
                    $get_price = $cart->get_price($customer_id);
                    if($get_price){
                        $amount = 0;
                        while($result = $get_price->fetch_assoc()){
                            $price = $result['price'];
                            $amount = $amount + $price;
                        }
                    }
                 ?>
                <p class="success_note">Giá tổng cộng bạn mua từ website chúng tôi: <?php  $vat = $amount *0.1;
                echo $total = $vat + $amount; ?> VNĐ</p>
                <p class="success_note">Chúng tôi sẽ liên hệ sớm nhất có thể.Vui lòng Chi tiết đơn hàng  <a href="orderdetails.php">tại đây</a></p>
                </div>
                <div class="clear"></div>
            </div>
 		</div>
 	</div>
</div>
<?php 
	include 'include/footer.php'
?>

