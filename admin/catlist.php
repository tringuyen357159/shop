<?php include 'inc/header.php';?>
<?php include 'inc/sidebar.php';?>
<?php 
	include '../classes/category.php'
?>
<?php
    $cat = new category();
    if(isset($_GET['deleteid']) || $_GET['deleteid']!=null){
		$id = $_GET['deleteid'];
		$delete_cat = $cat->delete_category($id);
    }
 ?>
        <div class="grid_10">
            <div class="box round first grid">
                <h2>Danh sách sản phẩm</h2>
                <div class="block">  
				<?php if(isset($delete_cat)){
                    echo $delete_cat;
               	}?>      
                    <table class="data display datatable" id="example">
					<thead>
						<tr>
							<th>Stt</th>
							<th>Tên danh mục</th>
							<th>Hành động</th>
						</tr>
					</thead>
					<tbody>
					<?php 	
						$show = $cat->show_category();
						if($show){
							$i = 0;
							while($result = $show->fetch_assoc()){
								$i++;	
					?>
						<tr class="odd gradeX">
							<td><?php echo $i ?></td>
							<td><?php echo $result['catName'] ?></td>
							<td><a href="catedit.php?catid=<?php echo $result['catId'] ?>">Sửa</a> || <a
							onclick="return confirm('Bạn có chắc chắn muốn xoá?')" href="?deleteid=<?php echo $result['catId'] ?>">Xoá</a></td>
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

