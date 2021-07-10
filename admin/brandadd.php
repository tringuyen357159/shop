<?php include 'inc/header.php';?>
<?php include 'inc/sidebar.php';?>
<?php include '../classes/brand.php' ?>
<?php
    $brand = new brand();
    if ($_SERVER['REQUEST_METHOD'] === 'POST'){
        $brandName = $_POST['brandName'];
        $store_brand = $brand->store_brand($brandName);
    }
 ?>
        <div class="grid_10">
            <div class="box round first grid">
                <h2>Thêm thương hiệu</h2>
               <div class="block copyblock"> 
               <?php if(isset($store_brand)){
                        echo $store_brand;
               } ?>
                 <form method="POST" action="brandadd.php">
                    <table class="form">					
                        <tr>
                            <td>
                                <input type="text" placeholder="Tên thương hiệu" class="medium" name="brandName"/>
                            </td>
                        </tr>
						<tr> 
                            <td>
                                <input type="submit" name="submit" Value="Save" />
                            </td>
                        </tr>
                    </table>
                    </form>
                </div>
            </div>
        </div>
<?php include 'inc/footer.php';?>