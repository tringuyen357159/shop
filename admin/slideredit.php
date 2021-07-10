<?php include 'inc/header.php';?>
<?php include 'inc/sidebar.php';?>
<?php include '../classes/slider.php' ?>
<?php
    $slider = new slider();
    if(!isset($_GET['sliderid']) || $_GET['sliderid']==null){
        echo "<script>window.location = 'sliderlist.php'</script>";
    }else{
        $id = $_GET['sliderid'];
    }

    if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['submit'])){
        $update_slider = $slider->update_slider($_POST,$_FILES,$id);
    }
 ?>
<div class="grid_10">
    <div class="box round first grid">
        <h2>Sửa slider</h2>
    <div class="block">   
            <?php if(isset($update_slider)){
                        echo $update_slider;
               } ?> 
            <?php
                $getslider = $slider->edit_slider($id);
                if($getslider){
                    while($result_slider = $getslider->fetch_assoc()){
                        
            ?>               
         <form action="" method="post" enctype="multipart/form-data">
            <table class="form">     
                <tr>
                    <td>
                        <label>Tên</label>
                    </td>
                    <td>
                        <input type="text" name="sliderName" class="medium" value="<?php echo $result_slider['sliderName'] ?>"/>
                    </td>
                </tr>           
    
                <tr>
                    <td>
                        <label> Ảnh</label>
                    </td>
                    <td>
                        <img src="uploads/<?php echo $result_slider['image'] ?>" alt="" style="height: 70px;width: 70px;" > 
                        <input type="file" name="image" value="<?php echo $result_slider['image'] ?>"/>
                    </td>
                </tr>
                <tr>
                    <td>
                        <label>Loại</label>
                    </td>
                    <td>
                        <select name="type" id="">
                        <option>Chọnn loại</option>
                            <?php 
                                if($result_slider['type']== 1){
                            ?>
                                    <option selected value="1">On</option>
                                    <option value="0">Off</option>
                            <?php 
                                }else{
                            ?>
                                    <option value="1">On</option>
                                    <option selected value="0">Off</option>
                            <?php 
                                }
                            ?>
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
            <?php 
                    }
                }
                ?>
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