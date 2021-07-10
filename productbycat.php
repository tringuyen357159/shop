<?php 
	include 'include/header.php'; 
?>
<?php
	if(!isset($_GET['catid']) || $_GET['catid']==null){
		echo "<script>window.location = '404.php'</script>";
	}else{
		$id = $_GET['catid'];
	}

	// if ($_SERVER['REQUEST_METHOD'] === 'POST'){
	// 	$catName = $_POST['catName'];
	// 	$update_cat = $cat->update_category($catName, $id);
	// }
 ?>
 <div class="main">
    <div class="content">
		<?php 
		  	$cat_name = $product->get_product_by_cat_name($id);
			  if($cat_name){
				  while($result_name = $cat_name->fetch_assoc()){

		  ?>
    	<div class="content_top">
    		<div class="heading">
    		<h3>Danh mục: <?php echo $result_name['catName'] ?></h3>
    		</div>
    		<div class="clear"></div>
			<?php 
				 }
				}
				?>
    	</div>
	      <div class="section group">
		  <?php 
		  	$productbycat = $product->get_productbycat($id);
			  if($productbycat){
				  while($result = $productbycat->fetch_assoc()){

		  ?>
				<div class="grid_1_of_4 images_1_of_4">
					 <a href="details.php?productid=<?php echo $result['productId'] ?>"><img src="admin/uploads/<?php echo $result['image'] ?>" alt="" /></a>
					 <h2><?php echo $result['productName'] ?></h2>
					 <p><?php echo $fm->textShorten($result['description'],50) ?></p>
					 <p><span class="price"><?php echo $result['price'].' '."đ" ?></span></p>
				     <div class="button"><span><a href="details.php?productid=<?php echo $result['productId'] ?>" class="details">Chi tiết</a></span></div>
				</div>
				<?php 
				 }
				}else
				{
					echo "Không có sản phẩm";
				}
				?>
			</div>

	
	
    </div>
 </div>
 <?php 
	include 'include/footer.php'
?>