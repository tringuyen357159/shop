<?php include 'inc/header.php';?>
<?php include 'inc/sidebar.php';?>
<?php include '../classes/brand.php'; ?>
<?php
    $brand = new brand();
    if(!isset($_GET['brandid']) || $_GET['brandid']==null){
        echo "<script>window.location = 'brandlist.php'</script>";
    }else{
        $id = $_GET['brandid'];
    }

    if ($_SERVER['REQUEST_METHOD'] === 'POST'){
        $brandName = $_POST['brandName'];
        $update_brand = $brand->update_brand($brandName, $id);
    }
 ?>
        <div class="grid_10">
            <div class="box round first grid">
                <h2>Sửa thương hiệu</h2>
               <div class="block copyblock"> 
               <?php if(isset($update_brand)){
                        echo $update_brand;
               } ?>
                <?php
                    $getBrandName = $brand->edit_brand($id);
                    if($getBrandName){
                        while($result = $getBrandName->fetch_assoc()){
                            
                ?>
                 <form method="POST" action="">
                    <table class="form">					
                        <tr>
                            <td>
                                <input type="text" value="<?php echo $result['brandName'] ?>" placeholder="Tên thương hiệu" class="medium" name="brandName"/>
                            </td>
                        </tr>
						<tr> 
                            <td>
                                <input type="submit" name="submit" Value="Upate" />
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