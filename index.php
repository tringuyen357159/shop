<?php 
	include 'include/header.php';
	include 'include/slider.php';
?>
 <div class="main">
    <div class="content">
    	<div class="content_top">
    		<div class="heading">
    		<h3>Sản phẩm nổi bậc</h3>
    		</div>
    		<div class="clear"></div>
    	</div>
	      <div class="section group">
		    <?php 
		  		$getproduct = $product->get_product();
					if($getproduct){
						while($result = $getproduct->fetch_assoc()){
		   ?>
				<div class="grid_1_of_4 images_1_of_4">
					 <a href="details.php?productid=<?php echo $result['productId'] ?>"><img src="admin/uploads/<?php echo $result['image'] ?>" alt="" /></a>
					 <h2><?php echo $result['productName'] ?></h2>
					 <p><?php echo $fm->textShorten($result['description'],50) ?></p>
					 <p><span class="price"><?php echo $result['price']."VNĐ" ?></span></p>
				     <div class="button"><span><a href="details.php?productid=<?php echo $result['productId'] ?>" class="details">Chi tiết</a></span></div>
				</div>
			<?php
						}
					}
			?>
			</div>
			<div class="content_bottom">
    		<div class="heading">
    		<h3>Sản phẩm mới</h3>
    		</div>
    		<div class="clear"></div>
    	</div>
			<div class="section group">
			<?php 
		  		$getproduct_new = $product->get_product_new();
					if($getproduct_new){
						while($result_new = $getproduct_new->fetch_assoc()){
		   ?>
				<div class="grid_1_of_4 images_1_of_4">
					 <a href="details.php?productid=<?php echo $result_new['productId'] ?>"><img src="admin/uploads/<?php echo $result_new['image'] ?>" alt="" /></a>
					 <h2><?php echo $result_new['productName'] ?></h2>
					 <p><span class="price"><?php echo $result_new['price']."VNĐ" ?></span></p>
				     <div class="button"><span><a href="details.php?productid=<?php echo $result_new['productId'] ?>" class="details">Chi tiết</a></span></div>
				</div>
			<?php
						}
					}
			?>
			</div>
			<div>
				<?php
					$get_all_product = $product->get_all_product();
					$product_count = mysqli_num_rows($get_all_product);
					$product_button = $product_count/2;
					$i = 1;
					echo '<p>Trang :</p>';
					for($i = 1;$i<=$product_button;$i++){
						echo '<a style="margin:0 5px;" href="index.php?trang='.$i.'">'.$i.'</a>';			
					}
				?>
			</div>
			
    </div>
 </div>
<?php 
	include 'include/footer.php'
?>

 
