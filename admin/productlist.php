<?php include 'inc/header.php';?>
<?php include 'inc/sidebar.php';?>
<?php require('../classes/product.php') ?>
<?php require_once('../helpers/format.php') ?>
<?php
    $product = new product();
	$fm = new Format();
    if(isset($_GET['deleteid']) || $_GET['deleteid']!=null){
		$id = $_GET['deleteid'];
		$delete_product = $product->delete_product($id);
    }
 ?>

<div class="grid_10">
    <div class="box round first grid">
        <h2>Danh sách sản phẩm</h2>
        <div class="block">  
		<?php if(isset($delete_product)){
                    echo $delete_product;
               	}?> 
            <table class="data display datatable" id="example">
			<thead>
				<tr>
					<th>Stt</th>
					<th>Tên sản phẩm</th>
					<th>Mô tả</th>
					<th>Loại</th>
					<th>Ảnh </th>
					<th>Giá</th>
					<th>Danh mục</th>
					<th>Thương hiệu</th>
					<th>Hành động</th>
				</tr>
			</thead>
			<tbody>
			<?php 	
				$show = $product->show_product();
				if($show){
					$i = 0;
					while($result = $show->fetch_assoc()){
						$i++;	
			?>
				<tr class="odd gradeX">
					<td><?php echo $i ?></td>
					<td><?php echo $result['productName'] ?></td>
					<td><?php echo $fm->textShorten($result['description'],20) ?></td>
					<td > <?php 
					 if($result['type']==1){
						echo "Nổi bậc";
					}else
						echo "Không nổi bậc";
					 ?></td>
					<td><img src="uploads/<?php echo $result['image'] ?>" alt="" style="height: 50px;width: 50px;" > </td>
					<td > <?php echo $result['price'] ?></td>
					<td><?php echo $result['catName'] ?></td>
					<td><?php echo $result['brandName'] ?></td>
					<td><a href="productedit.php?productid=<?php echo $result['productId'] ?>">Sửa</a> || <a
						onclick="return confirm('Bạn có chắc chắn muốn xoá?')" href="?deleteid=<?php echo $result['productId'] ?>">Xoá</a></td>
				</tr>
			<?php 
					}
				}
			?>
			</tbody>
		</table>

       </div>
    </div>
</div>

<script type="text/javascript">
    $(document).ready(function () {
        setupLeftMenu();
        $('.datatable').dataTable();
		setSidebarHeight();
    });
</script>
<?php include 'inc/footer.php';?>
