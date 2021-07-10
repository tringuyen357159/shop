<?php include 'inc/header.php';?>
<?php include 'inc/sidebar.php';?>
<?php include '../classes/category.php' ?>
<?php
    $cat = new category();
    if ($_SERVER['REQUEST_METHOD'] === 'POST'){
        $catName = $_POST['catName'];
        $store_cat = $cat->store_category($catName);
    }
 ?>
        <div class="grid_10">
            <div class="box round first grid">
                <h2>Thêm danh mục</h2>
               <div class="block copyblock"> 
               <?php if(isset($store_cat)){
                        echo $store_cat;
               } ?>
                 <form method="POST" action="catadd.php">
                    <table class="form">					
                        <tr>
                            <td>
                                <input type="text" placeholder="Tên sản phẩm" class="medium" name="catName"/>
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