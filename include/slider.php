<div class="header_bottom">
		<div class="header_bottom_left">
			<div class="section group">
			<?php 
			 	$getdell = $product->get_dell();
				 if($getdell){
					 while($result_dell = $getdell->fetch_assoc()){	
			 ?>
				<div class="listview_1_of_2 images_1_of_2">
					<div class="listimg listimg_2_of_1">
						 <a href="details.php?productid=<?php echo $result_dell['productId'] ?>"> <img src="admin/uploads/<?php echo $result_dell['image'] ?>" alt="" /></a>
					</div>
				    <div class="text list_2_of_1">
						<h2>DELL</h2>
						<p><?php echo $result_dell['productName'] ?></p>
						<div class="button"><span><a href="details.php?productid=<?php echo $result_dell['productId'] ?>">Thêm giỏ hàng</a></span></div>
				   </div>
			   </div>
			   <?php 
						}
					}
			   ?>	
			   <?php 
			 	$getsamsung = $product->get_samsung();
				 if($getsamsung){
					 while($result_samsung = $getsamsung->fetch_assoc()){	
			 ?>		
				<div class="listview_1_of_2 images_1_of_2">
					<div class="listimg listimg_2_of_1">
						  <a href="details.php?productid=<?php echo $result_samsung['productId'] ?>"><img src="admin/uploads/<?php echo $result_samsung['image'] ?>" alt="" / ></a>
					</div>
					<div class="text list_2_of_1">
						  <h2>SAMSUNG</h2>
						  <p><?php echo $result_samsung['productName'] ?></p>
						  <div class="button"><span><a href="details.php?productid=<?php echo $result_samsung['productId'] ?>">Thêm giỏ hàng</a></span></div>
					</div>
				</div>
				<?php 
						}
					}
			   ?>	
			</div>
			<div class="section group">
			<?php 
			 	$getsony = $product->get_sony();
				 if($getsony){
					 while($result_sony = $getsony->fetch_assoc()){	
			 ?>		
				<div class="listview_1_of_2 images_1_of_2">
					<div class="listimg listimg_2_of_1">
						 <a href="details.php?productid=<?php echo $result_sony['productId'] ?>"> <img src="admin/uploads/<?php echo $result_sony['image'] ?>" alt="" /></a>
					</div>
				    <div class="text list_2_of_1">
						<h2>SONY</h2>
						<p><?php echo $result_sony['productName'] ?></p>
						<div class="button"><span><a href="details.php?productid=<?php echo $result_sony['productId'] ?>">Thêm giỏ hàng</a></span></div>
				   </div>
				   <?php 
						}
					}
			   ?>	
			   </div>	
			   <?php 
			 	$getapple = $product->get_apple();
				 if($getapple){
					 while($result_apple = $getapple->fetch_assoc()){	
			 ?>			
				<div class="listview_1_of_2 images_1_of_2">
					<div class="listimg listimg_2_of_1">
						  <a href="details.php?productid=<?php echo $result_apple['productId'] ?>"><img src="admin/uploads/<?php echo $result_apple['image'] ?>" alt="" /></a>
					</div>
					<div class="text list_2_of_1">
						  <h2>APPLE</h2>
						  <p><?php echo $result_apple['productName'] ?></p>
						  <div class="button"><span><a href="details.php?productid=<?php echo $result_apple['productId'] ?>">Thêm giỏ hàng</a></span></div>
					</div>
				</div>
				<?php 
						}
					}
			   ?>	
			</div>
		  <div class="clear"></div>
		</div>
			 <div class="header_bottom_right_images">
		   <!-- FlexSlider -->
             
			<section class="slider">
				  <div class="flexslider">
					<ul class="slides">
						<?php
							$get_slider = $slider->get_slider();
							if($get_slider){
								while($result_slider = $get_slider->fetch_assoc()){		
						 ?>
						<li><img src="admin/uploads/<?php echo $result_slider['image'] ?>" alt=""/></li>
						<?php 
								}
							}
						?>
				    </ul>
				  </div>
	      </section>
<!-- FlexSlider -->
	    </div>
	  <div class="clear"></div>
  </div>	