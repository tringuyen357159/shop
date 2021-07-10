<?php include 'inc/header.php';?>
<?php include 'inc/sidebar.php';?>
<?php require('../classes/slider.php') ?>
<?php require_once('../helpers/format.php') ?>
<?php
    $slider = new slider();
    if(isset($_GET['deleteid']) || $_GET['deleteid']!=null){
		$id = $_GET['deleteid'];
		$delete_slider = $slider->delete_slider($id);
    }
 ?>
<div class="grid_10">
    <div class="box round first grid">
        <h2>Danh sách slider</h2>
        <div class="block"> 
		<?php if(isset($delete_slider)){
                    echo $delete_slider;
               	}?>  
            <table class="data display datatable" id="example">
			<thead>
				<tr>
					<th>Stt</th>
					<th>Tên slider</th>
					<th>Ảnh</th>
					<th>Loại</th>
					<th>Hành động</th>
				</tr>
			</thead>
			<tbody>
			<?php 	
				$show = $slider->show_slider();
				if($show){
					$i = 0;
					while($result = $show->fetch_assoc()){
						$i++;	
			?>
				<tr class="odd gradeX">
					<td><?php echo $i ?></td>
					<td><?php echo $result['sliderName'] ?></td>
					<td><img src="uploads/<?php echo $result['image'] ?>" height="40px" width="60px"/></td>				
					<td > <?php 
					 if($result['type']==1){
						echo "Hiển thị";
					}else
						echo "Không hiển thị";
					 ?></td>
				<td><a href="slideredit.php?sliderid=<?php echo $result['sliderId'] ?>">Sửa</a> || <a
						onclick="return confirm('Bạn có chắc chắn muốn xoá?')" href="?deleteid=<?php echo $result['sliderId'] ?>">Xoá</a></>
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
