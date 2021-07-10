<?php 
	include 'include/header.php';
	include 'include/slider.php';
?>
<?php 
	$id = Session::get('customer_id');
	if($_SERVER['REQUEST_METHOD'] == 'POST' && isset($_POST['submit'])){
		$feedback = $customer->store_feedback($_POST,$id);
	}
?>
 <div class="main">
    <div class="content">
    	<div class="support">
  			<div class="support_desc">
  				<h3>Hỗ trợ</h3>
  			</div>
  				<img src="web/images/contact.png" alt="" />
  			<div class="clear"></div>
  		</div>
    	<div class="section group">
				<div class="col span_2_of_3">
				  <div class="contact-form">
				  	<h2>LIÊN HỆ VỚI CHÚNG TÔI</h2>
					  <?php if(isset($feedback)){
						  echo $feedback;
						} 
						?>
					    <form action="" method="post">
					    	<div>
						    	<span><label>TÊN</label></span>
						    	<span><input type="text" value="" name="name" placeholder="Nhập tên"></span>
						    </div>
						    <div>
						    	<span><label>E-MAIL</label></span>
						    	<span><input type="text" value="" name="email" placeholder="Nhập email"></span>
						    </div>
						    <div>
						     	<span><label>SĐT</label></span>
						    	<span><input type="text" value="" name="phone" placeholder="Nhập số điện thoại"></span>
						    </div>
						    <div>
						    	<span><label>NỘI DUNG</label></span>
						    	<span><textarea name="content" placeholder="Nhập nội dung"> </textarea></span>
						    </div>
						   <div>
						   		<span><input type="submit" value="GỬI" name="submit"></span>
						  </div>
					    </form>
				  </div>
  				</div>
				<!-- <div class="col span_1_of_3">
      			<div class="company_address">
				     	<h2>Thông tin :</h2>
						    	<p>500 Lorem Ipsum Dolor Sit,</p>
						   		<p>22-56-2-9 Sit Amet, Lorem,</p>
						   		<p>USA</p>
				   		<p>Phone:(00) 222 666 444</p>
				   		<p>Fax: (000) 000 00 00 0</p>
				 	 	<p>Email: <span>info@mycompany.com</span></p>
				   		<p>Follow on: <span>Facebook</span>, <span>Twitter</span></p>
				   </div>
				 </div> -->
			  </div>    	
    </div>
 </div>

<?php 
	include 'include/footer.php'
?>
