<?php include 'inc/header.php';?>
<?php include 'inc/sidebar.php';?>
<?php require('../classes/category.php'); ?>
<?php require('../classes/brand.php'); ?>
<?php require('../classes/product.php'); ?>
<?php
    $product = new product();
    if(!isset($_GET['productid']) || $_GET['productid']==null){
        echo "<script>window.location = 'productlist.php'</script>";
    }else{
        $id = $_GET['productid'];
    }
    if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['submit'])){
        $update_product = $product->update_product($_POST,$_FILES,$id);
    }
 ?>
<div class="grid_10">
    <div class="box round first grid">
        <h2>Sửa sản phẩm</h2>
        <div class="block">     
            <?php if(isset($update_product)){
                    echo $update_product;
               } ?>  
                <?php
                    $getproductName = $product->edit_product($id);
                    if($getproductName){
                        while($result_product = $getproductName->fetch_assoc()){
                            
                ?>        
         <form action="" method="post" enctype="multipart/form-data">
            <table class="form">
               
                <tr>
                    <td>
                        <label>Tên sản phẩm</label>
                    </td>
                    <td>
                        <input type="text" name="productName" class="medium" value="<?php echo $result_product['productName'] ?>" />
                    </td>
                </tr>
				<tr>
                    <td>
                        <label>Danh mục</label>
                    </td>
                    <td>
                        <select id="select" name="category">
                            <option>Chọn danh mục</option>
                           
                            <?php 
                                $cat = new category();
                                $catlist = $cat->show_category();
                                if($catlist){
                                    while($result = $catlist->fetch_assoc()){
                                        
                            ?>
                            <option
                              <?php if($result['catId']==$result_product['catId']) {
                                  echo 'selected';
                              }
                               ?>          
                             value="<?php echo $result['catId'] ?>"><?php echo $result['catName'] ?></option>
                            <?php 
                                    }
                                }
                            ?>
                        </select>
                    </td>
                </tr>
				<tr>
                    <td>
                        <label>Thương hiệu</label>
                    </td>
                    <td>
                        <select id="select" name="brand">
                            <option>Chọn thương hiệu</option>
                            
                            <?php 
                                $brand = new brand();
                                $brandlist = $brand->show_brand();
                                if($brandlist){
                                    while($result = $brandlist->fetch_assoc()){
                                        
                            ?>
                            <option
                            <?php if($result['brandId']==$result_product['brandId']) {
                                  echo 'selected';
                              }
                               ?>     
                             value="<?php echo $result['brandId'] ?>"><?php echo $result['brandName'] ?></option>
                            <?php 
                                    }
                                }
                            ?>
                        </select>
                    </td>
                </tr>
				
				 <tr>
                    <td style="vertical-align: top; padding-top: 9px;">
                        <label>Mô tả</label>
                    </td>
                    <td>
                        <textarea class="tinymce" name="description" ><?php echo $result_product['description'] ?></textarea>
                    </td>
                </tr>
				<tr>
                    <td>
                        <label>Giá</label>
                    </td>
                    <td>
                        <input type="text" class="medium" name="price" value="<?php echo $result_product['price'] ?>"/>
                    </td>
                </tr>
            
                <tr>
                    <td>
                        <label>ẢNh</label>
                    </td>
                    <td>
                    <img src="uploads/<?php echo $result_product['image'] ?>" alt="" style="height: 50px;width: 50px;" > 
                        <input type="file" name="image" value="<?php echo $result_product['image'] ?>"/>
                    </td>
                </tr>
				
				<tr>
                    <td>
                        <label>Loại sản phẩm</label>
                    </td>
                    <td>
                        <select id="select" name="type">
                            <option>Chọnn loại</option>
                            <?php 
                                if($result_product['type']== 1){
                            ?>
                                    <option selected value="1">Nổi bậc</option>
                                    <option value="2">Không nổi bậc</option>
                            <?php 
                                }else{
                            ?>
                                    <option value="1">Nổi bậc</option>
                                    <option selected value="2">Không nổi bậc</option>
                            <?php 
                                }
                            ?>
                        </select>
                    </td>
                </tr>

				<tr>
                    <td></td>
                    <td>
                        <input type="submit" name="submit" Value="Lưu" />
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
<!-- Load TinyMCE -->
<script src="js/tiny-mce/jquery.tinymce.js" type="text/javascript"></script>
<script type="text/javascript">
    $(document).ready(function () {
        setupTinyMCE();
        setDatePicker('date-picker');
        $('input[type="checkbox"]').fancybutton();
        $('input[type="radio"]').fancybutton();
    });
</script>
<!-- Load TinyMCE -->
<?php include 'inc/footer.php';?>


