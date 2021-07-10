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
    	<div class="section group">
            <div class="content_top">
                <div class="heading">
                <h3>PROFILE</h3>
                </div>
                <div class="clear"></div>
            </div>
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
                <tr ><td colspan="3"><a href="editprofile.php">Cập nhật</a></td></tr>
            </table>
 		</div>
 	</div>
</div>
<?php 
	include 'include/footer.php'
?>

