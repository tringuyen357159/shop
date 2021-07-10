<?php 
	include 'include/header.php';
	include 'include/slider.php';
?>
 <div class="main">
    <div class="content">
    	<div class="content_top">
    		<div class="heading">
    		<h3>IPHONE MỚI NHẤT</h3>
    		</div>
    		<div class="clear"></div>
    	</div>
	      <div class="section group">
		  <?php 
			 	$getapple = $product->get_apple_product();
				 if($getapple){
					 while($result_apple = $getapple->fetch_assoc()){	
			 ?>
				<div class="grid_1_of_4 images_1_of_4">
					 <a href="details.php?productid=<?php echo $result_apple['productId'] ?>"><img src="admin/uploads/<?php echo $result_apple['image'] ?>" alt="" /></a>
					 <h2><?php echo $result_apple['productName'] ?></h2>
					 <p><?php echo $fm->textShorten($result_apple['description'],50) ?></p>
					 <p><span class="price"><?php echo $result_apple['price'].' '."VNĐ" ?></span></p>
				     <div class="button"><span><a href="details.php?productid=<?php echo $result_apple['productId'] ?>" class="details">Chi tiết</a></span></div>
				</div>
				<?php 
						}
					}
			   ?>	
			</div>
			<div class="content_bottom">
    		<div class="heading">
    		<h3>CANON MỚI NHẤT</h3>
    		</div>
    		<div class="clear"></div>
    	</div>
			<div class="section group">
			<?php 
			 	$getcanon = $product->get_sony_brand();
				 if($getcanon){
					 while($result_sony = $getcanon->fetch_assoc()){	
			 ?>
				<div class="grid_1_of_4 images_1_of_4">
					 <a href="details.php?productid=<?php echo $result_sony['productId'] ?>"><img src="admin/uploads/<?php echo $result_sony['image'] ?>" alt="" /></a>
					 <h2><?php echo $result_sony['productName'] ?></h2>
					 <p><?php echo $fm->textShorten($result_sony['description'],50) ?></p>
					 <p><span class="price"><?php echo $result_sony['price'].' '."VNĐ" ?></span></p>
				     <div class="button"><span><a href="details.php?productid=<?php echo $result_sony['productId'] ?>" class="details">Chi tiết</a></span></div>
				</div>
				<?php 
						}
					}
			   ?>	
			</div>
    </div>
 </div>
<?php 
	include 'include/footer.php'
?>
