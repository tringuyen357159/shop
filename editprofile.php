<?php 
	include 'include/header.php';
	
?>
<?php 
	$login_check = Session::get('customer_login');
    if($login_check==false){
       header('Location:login.php');
    }
?>
<?php 
     $id = Session::get('customer_id');
    if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['save'])){
        $update_customer = $customer->update_customer($_POST,$id);
    }
 ?>
 <div class="main">
    <div class="content">
    	<div class="section group">
            <div class="content_top">
                <div class="heading">
                <h3>CẬP NHẬT PROFILE</h3>
                </div>
                <div class="clear"></div>
            </div>
            <form action="" method="post">
            <?php 
                if(isset($update_customer)){
                    echo $update_customer;
                }
            ?>
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
                    <td><input type="text" name="name" value="<?php echo $result['name'] ?>"></td>
                </tr>
                <tr>
                    <td>Địa chỉ</td>
                    <td>:</td>
                    <td><input type="text" name="address" value="<?php echo $result['address'] ?>"></td>
                    <td></td>
                </tr>
                <tr>
                    <td>Thành phố</td>
                    <td>:</td>
                    <td><input type="text" name="city" value="<?php echo $result['city'] ?>"></td>
                </tr>
                <tr>
                    <td>Zip-Code</td>
                    <td>:</td>
                    <td><input type="text" name="zipcode" value="<?php echo $result['zipcode'] ?>"></td>
                </tr>
                <tr>
                    <td>SĐT</td>
                    <td>:</td>
                    <td><input type="text" name="phone" value="<?php echo $result['phone'] ?>"></td>
                </tr>
                <tr>
                    <td>Email</td>
                    <td>:</td>
                    <td><input type="text" name="email" value="<?php echo $result['email'] ?>"></td>
                </tr>
                <tr ><td colspan="3"><input type="submit" name="save" id="" value="CẬP NHẬT" class="gray"></td></tr>
                <?php
                        }
                    }
                ?>
            </table>
            </form>
 		</div>
 	</div>
</div>
<?php 
	include 'include/footer.php'
?>

