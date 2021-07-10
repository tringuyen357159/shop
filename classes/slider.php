
<?php 
    $filepath = realpath(dirname(__FILE__));
    require_once($filepath.'/../lib/database.php');
    require_once($filepath.'/../helpers/format.php');
?>
<?php 
    class slider{

        private $db;
        private $fm;

        public function __construct()
        {
            $this->db = new Database();
            $this->fm = new Format();
        }
        
        //THÊM
        public function store_slider($data,$files){
            $sliderName = mysqli_real_escape_string($this->db->link, $data['sliderName']);
            $type = mysqli_real_escape_string($this->db->link, $data['type']);

            $permited = array('jpg', 'jpeg', 'png', 'gif');
            $file_name = $_FILES['image']['name'];
            $file_size = $_FILES['image']['size'];
            $file_temp = $_FILES['image']['tmp_name'];

            $div = explode('.',$file_name);
            $file_ext = strtolower(end($div));
            $unique_image = substr(md5(time()),0,10).'.'.$file_ext;
            $upload_image = "uploads/".$unique_image; 

            if($sliderName == "" || $type == "" || $file_name == ""){
                $alert = "<span class='error'>Không được bỏ trống</span>";
                return $alert;
            }else{
                move_uploaded_file($file_temp,$upload_image);
                $query = "INSERT INTO tb_slider(sliderName,type,image) VALUES
                ('$sliderName','$type','$unique_image') ";
                $result = $this->db->insert($query);

                if($result){
                    $alert = "<span class='success'>Thêm slider thành công</span>";
                    return $alert;
                }else {
                    $alert = "<span class='error'>Thêm slider thất bại</span>";
                    return $alert;
                }
            }
        }

        //LIST
        public function show_slider(){
            $query = "SELECT * FROM  tb_slider ORDER BY sliderId DESC";
            $result = $this->db->select($query);
            return $result;
        }

        //EDIT
        public function edit_slider($id){
            $query = "SELECT * FROM  tb_slider WHERE sliderId = '$id' ";
            $result = $this->db->select($query);
            return $result;
        }

        //UPDATE
        public function update_slider($data,$files, $id){
            $sliderName = mysqli_real_escape_string($this->db->link, $data['sliderName']);
            $type = mysqli_real_escape_string($this->db->link, $data['type']);
            $id = mysqli_real_escape_string($this->db->link, $id);

            $permited = array('jpg', 'jpeg', 'png', 'gif');
            $file_name = $_FILES['image']['name'];
            $file_size = $_FILES['image']['size'];
            $file_temp = $_FILES['image']['tmp_name'];

            $div = explode('.',$file_name);
            $file_ext = strtolower(end($div));
            $unique_image = substr(md5(time()),0,10).'.'.$file_ext;
            $upload_image = "uploads/".$unique_image; //tạo biến đến thư mục chứa ảnh với tên ảnh

            if($sliderName == "" || $type == "" ){
                $alert = "<span class='error'>Không được bỏ trống</span>";
                return $alert;
            }else{
                if(!empty($file_name)){
                    //NEU NGUOI DUNG CHON ANH
                    if($file_size > 204800){
                        $alert = "<span class='error'>Vui lòng chọn ảnh có kích thước nhỏ hơn 2M</span>";
                        return $alert;
                    }
                    else if(in_array($file_ext,$permited) === false){
                        $alert = "<span class='error'>Chọn sai ảnh</span>";
                        return $alert;
                    }
                    move_uploaded_file($file_temp,$upload_image);
                    $query = "UPDATE tb_slider SET
                    sliderName = '$sliderName',
                    type = '$type',
                    image = '$unique_image'
                    WHERE sliderId = '$id' ";
                }else{
                    //NEU NGUOI DUNG KHONG CHON ANH
                    $query = "UPDATE tb_slider SET
                    sliderName = '$sliderName',
                    type = '$type'
                    WHERE sliderId = '$id' ";
                }
                $result = $this->db->update($query);
                if($result){
                    $alert = "<span class='success'>Sửa slider thành công</span>";
                    return $alert;
                }else {
                    $alert = "<span class='error'>Sửa slider thất bại</span>";
                    return $alert;
                }
            }
        }
        //DELETE
        public function delete_slider($id){
            $query = "DELETE FROM  tb_slider WHERE sliderId = '$id' ";
            $result = $this->db->delete($query);
            if($result){
                $alert = "<span class='success'>Xoá slider thành công</span>";
                return $alert;
            }else {
                $alert = "<span class='error'>Xoá slider thất bại</span>";
                return $alert;
            }
        }

        public function get_slider(){
            $query = "SELECT * FROM  tb_slider WHERE type ='1' ORDER BY sliderId DESC";
            $result = $this->db->select($query);
            return $result;
        }
    }
?>