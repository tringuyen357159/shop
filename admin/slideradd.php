<?php include 'inc/header.php';?>
<?php include 'inc/sidebar.php';?>
<?php include '../classes/slider.php' ?>
<?php
    $slider = new slider();
    if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['submit'])){
        $store_slider = $slider->store_slider($_POST,$_FILES);
    }
 ?>
<div class="grid_10">
    <div class="box round first grid">
        <h2>Thêm slider</h2>
    <div class="block">   
            <?php if(isset($store_slider)){
                        echo $store_slider;
               } ?>            
         <form action="slideradd.php" method="post" enctype="multipart/form-data">
            <table class="form">     
                <tr>
                    <td>
                        <label>Tên</label>
                    </td>
                    <td>
                        <input type="text" name="sliderName" placeholder="Nhập tên" class="medium" />
                    </td>
                </tr>           
    
                <tr>
                    <td>
                        <label> Ảnh</label>
                    </td>
                    <td>
                        <input type="file" name="image"/>
                    </td>
                </tr>
                <tr>
                    <td>
                        <label>Loại</label>
                    </td>
                    <td>
                    <select id="select" name="type">
                            <option>Chọnn loại</option>
                            <option value="1">On</option>
                            <option value="0">Off</option>
                        </select>
                    </td>
                </tr>   
				<tr>
                    <td></td>
                    <td>
                        <input type="submit" name="submit" Value="Lưu" />
                    </td>
                </tr>
            </table>
            </form>
        </div>
    </div>
</div>
<!-- Load TinyMCE -->
<script src="js/tiny-mce/jquery.tinymce.js" type="text/javascript"></script>
<script type="text/javascript">
    $(document).ready(function () {
        setupTinyMCE();
        setDatePicker('date-picker');
        $('input[type="checkbox"]').fancybutton();
        $('input[type="radio"]').fancybutton();
    });
</script>
<!-- Load TinyMCE -->
<?php include 'inc/footer.php';?>