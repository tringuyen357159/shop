<?php include 'inc/header.php';?>
<?php include 'inc/sidebar.php';?>
<?php require('../classes/customer.php') ?>
<?php require_once('../helpers/format.php') ?>
<?php
    $customer = new customer();
    $fm = new Format();
    if(isset($_GET['deletefeedbackid']) || $_GET['deletefeedbackid']!=null){
		$id = $_GET['deletefeedbackid'];
		$delete_feedback = $customer->delete_feedback($id);
    }
 ?>
<div class="grid_10">
    <div class="box round first grid">
        <h2>Danh sách slider</h2>
        <div class="block"> 
		<?php if(isset($delete_feedback)){
                    echo $delete_feedback;
               	}?>  
            <table class="data display datatable" id="example">
			<thead>
				<tr>
					<th>Stt</th>
					<th>Tên</th>
                    <th>Email</th>
					<th>Nội dung</th>
					<th>Sđt</th>
					<th>Hành động</th>
				</tr>
			</thead>
			<tbody>
			<?php 	
				$show = $customer->show_feedback();
				if($show){
					$i = 0;
					while($result = $show->fetch_assoc()){
						$i++;	
			?>
				<tr class="odd gradeX">
					<td><?php echo $i ?></td>
					<td><?php echo $result['name'] ?></td>
                    <td><?php echo $result['email'] ?></td>
					<td><?php echo $fm->textShorten($result['content'],50) ?></td>		
					<td > <?php echo $result['phone'] ?></td>
				<td><a onclick="return confirm('Bạn có chắc chắn muốn xoá?')" href="?deletefeedbackid=<?php echo $result['id'] ?>">Xoá</a>
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
