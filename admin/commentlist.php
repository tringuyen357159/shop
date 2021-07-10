<?php include 'inc/header.php';?>
<?php include 'inc/sidebar.php';?>
<?php require('../classes/customer.php') ?>
<?php require_once('../helpers/format.php') ?>
<?php
    $customer = new customer();
    $fm = new Format();
    if(isset($_GET['deletecommentid']) || $_GET['deletecommentid']!=null){
		$id = $_GET['deletecommentid'];
		$delete_comment = $customer->delete_comment($id);
    }
 ?>
<div class="grid_10">
    <div class="box round first grid">
        <h2>Danh sách slider</h2>
        <div class="block"> 
		<?php if(isset($delete_comment)){
                    echo $delete_comment;
               	}?>  
            <table class="data display datatable" id="example">
			<thead>
				<tr>
					<th>Stt</th>
					<th>Tên </th>
					<th>Nội dung</th>
					<th>Id sản phẩm</th>
					<th>Hành động</th>
				</tr>
			</thead>
			<tbody>
			<?php 	
				$show = $customer->show_comment();
				if($show){
					$i = 0;
					while($result = $show->fetch_assoc()){
						$i++;	
			?>
				<tr class="odd gradeX">
					<td><?php echo $i ?></td>
					<td><?php echo $result['commentName'] ?></td>
					<td><?php echo $fm->textShorten($result['content'],50) ?></td>		
					<td > <?php echo $result['productId'] ?></td>
				<td><a onclick="return confirm('Bạn có chắc chắn muốn xoá?')" href="?deletecommentid=<?php echo $result['commentId'] ?>">Xoá</a>
				</td>
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
