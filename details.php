<?php 
	include 'include/header.php';
	// include 'include/slider.php';
?>
<?php 
	$product = new product();
	
    if(!isset($_GET['productid']) || $_GET['productid']==null){
        echo "<script>window.location = '404.php'</script>";
    }else{
        $id = $_GET['productid'];
    }

	if($_SERVER['REQUEST_METHOD'] == 'POST' && isset($_POST['submit'])){
		$quantity = $_POST['quantity'];
		$add_cart = $cart->add_cart($id,$quantity);
	}

	if($_SERVER['REQUEST_METHOD'] == 'POST' && isset($_POST['comment_submit'])){
		$comment = $customer->store_commnet($id);
	}
?>
 <div class="main">
    <div class="content">
    	<div class="section group">
		<?php 
			$get_product_detail = $product->get_detail($id);
			if($get_product_detail){
				while($result_detail = $get_product_detail->fetch_assoc()){	
		?>
				<div class="cont-desc span_1_of_2">				
					<div class="grid images_3_of_2">
					<img src="admin/uploads/<?php echo $result_detail['image'] ?>" alt="" />
					</div>
				<div class="desc span_3_of_2">
					<h2><?php echo $result_detail['productName'] ?></h2>
					<p><?php echo $fm->textShorten($result_detail['description'],100) ?></p>					
					<div class="price">
						<p>Price: <span><?php echo $result_detail['price'].' '.'VNĐ' ?></span></p>
						<p>Category: <span><?php echo $result_detail['catName'] ?></span></p>
						<p>Brand:<span><?php echo $result_detail['brandName'] ?></span></p>
					</div>
				<div class="add-cart">
					<form action="" method="post">
						<input type="number" class="buyfield" name="quantity" value="1"  min= '1'/>
						<input type="submit" class="buysubmit" name="submit" value="Mua Ngay"/>
						<br>
						<?php 
							if(isset($add_cart)){
								echo "sản phẩm đã tồn tại";
							}
						 ?>
					</form>				
				</div>
			</div>
			<div class="product-desc">
			<h2>Product Details</h2>
			<?php echo$result_detail['description'] ?>
	    </div>
				
	</div>
	<?php 
			}
		}
	?>
				<div class="rightsidebar span_3_of_1">
					<h2>Danh mục</h2>
					<ul>
					<?php
						$get_cat = $cat->get_category();
						if($get_cat){
							while($result_cat = $get_cat->fetch_assoc()){
					 ?>
				      <li><a href="productbycat.php?catid=<?php echo $result_cat['catId'] ?>"><?php echo $result_cat['catName'] ?></a></li>
					  <?php
							}
						}
					   ?>
    				</ul>
    	
 				</div>
 		</div>
 	</div>
	<div class="comment">
		<dic class="row">
			<div class="col-md-8">
				<h5>Ý kiến sản phẩm: </h5>
				<?php 
					if(isset($comment)){
						echo $comment;
					}
				?>
				<form action="" method="post">
					<p><input type="text" class="form-control" name="commentName" placeholder="Tên"></p>
					<p><textarea rows="5" style="resize: none;"  class="form-control" name="content" placeholder="Bình luận"></textarea></p>
					<p><input type="submit" name="comment_submit" class="btn btn-success" value="Gửi"></p>
				</form>
			</div>
		</dic>
	</div>
</div>
<?php 
	include 'include/footer.php'
?>

