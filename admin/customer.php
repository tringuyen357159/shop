<?php include 'inc/header.php';?>
<?php include 'inc/sidebar.php';?>
<?php include '../classes/category.php' ?>
<?php 
    $filepath = realpath(dirname(__FILE__));
	require_once($filepath.'/../classes/customer.php');
	require_once($filepath.'/../helpers/format.php');
?>
<?php
    $customer = new customer();
    if(!isset($_GET['customerid']) || $_GET['customerid']==null){
        echo "<script>window.location = 'inbox.php'</script>";
    }else{
        $id = $_GET['customerid'];
    }
 ?>
        <div class="grid_10">
            <div class="box round first grid">
                <h2>Sửa danh mục</h2>
               <div class="block copyblock"> 
                <?php
                    $get_customer = $customer->show_customer($id);
                    if($get_customer){
                        while($result = $get_customer->fetch_assoc()){
                            
                ?>
                 <form method="POST" action="">
                    <table class="form">					
                        <tr>
                            <td>Tên</td>
                            <td>:</td>
                            <td>
                                <input type="text" readonly value="<?php echo $result['name'] ?>"    class="medium" />
                            </td>
                        </tr>
                        <tr>
                            <td>Sđt</td>
                            <td>:</td>
                            <td>
                                <input type="text" readonly value="<?php echo $result['phone'] ?>"    class="medium" />
                            </td>
                        </tr>
                        <tr>
                            <td>Thành phố</td>
                            <td>:</td>
                            <td>
                                <input type="text" readonly value="<?php echo $result['city'] ?>"    class="medium" />
                            </td>
                        </tr>
                        <tr>
                            <td>Miền</td>
                            <td>:</td>
                            <td>
                                <input type="text" readonly value="<?php echo $result['country'] ?>"    class="medium" />
                            </td>
                        </tr>
                        <tr>
                            <td>Zip-code</td>
                            <td>:</td>
                            <td>
                                <input type="text" readonly value="<?php echo $result['zipcode'] ?>"    class="medium" />
                            </td>
                        </tr>
                        <tr>
                            <td>Email</td>
                            <td>:</td>
                            <td>
                                <input type="text" readonly value="<?php echo $result['email'] ?>"    class="medium" />
                            </td>
                        </tr>
                        <tr>
                            <td>Địa chỉ</td>
                            <td>:</td>
                            <td>
                                <input type="text" readonly value="<?php echo $result['address'] ?>"    class="medium" />
                            </td>
                        </tr>
                    </table>
                    </form>
                <?php 
                    }
                }
                ?>
                </div>
            </div>
        </div>
<?php include 'inc/footer.php';?>