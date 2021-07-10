<?php include 'inc/header.php';?>
<?php include 'inc/sidebar.php';?>
<?php include '../classes/category.php' ?>
<?php
    $cat = new category();
    if(!isset($_GET['catid']) || $_GET['catid']==null){
        echo "<script>window.location = 'catlist.php'</script>";
    }else{
        $id = $_GET['catid'];
    }

    if ($_SERVER['REQUEST_METHOD'] === 'POST'){
        $catName = $_POST['catName'];
        $update_cat = $cat->update_category($catName, $id);
    }
 ?>
        <div class="grid_10">
            <div class="box round first grid">
                <h2>Sửa danh mục</h2>
               <div class="block copyblock"> 
               <?php if(isset($update_cat)){
                        echo $update_cat;
               } ?>
                <?php
                    $getCatName = $cat->edit_category($id);
                    if($getCatName){
                        while($result = $getCatName->fetch_assoc()){
                            
                ?>
                 <form method="POST" action="">
                    <table class="form">					
                        <tr>
                            <td>
                                <input type="text" value="<?php echo $result['catName'] ?>" placeholder="Tên sản phẩm" class="medium" name="catName"/>
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