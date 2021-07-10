
<?php 
    $filepath = realpath(dirname(__FILE__));
    require_once($filepath.'/../lib/database.php');
    require_once($filepath.'/../helpers/format.php');
?>
<?php 
    class product{

        private $db;
        private $fm;

        public function __construct()
        {
            $this->db = new Database();
            $this->fm = new Format();
        }
        
        //THÊM
        public function store_product($data,$files){

            $productName = mysqli_real_escape_string($this->db->link, $data['productName']);
            $category = mysqli_real_escape_string($this->db->link, $data['category']);
            $brand = mysqli_real_escape_string($this->db->link, $data['brand']);
            $description = mysqli_real_escape_string($this->db->link, $data['description']);
            $price = mysqli_real_escape_string($this->db->link, $data['price']);
            $type = mysqli_real_escape_string($this->db->link, $data['type']);
            
            $permited = array('jpg', 'jpeg', 'png', 'gif');
            $file_name = $_FILES['image']['name'];
            $file_size = $_FILES['image']['size'];
            $file_temp = $_FILES['image']['tmp_name'];

            $div = explode('.',$file_name);
            $file_ext = strtolower(end($div));
            $unique_image = substr(md5(time()),0,10).'.'.$file_ext;
            $upload_image = "uploads/".$unique_image; //tạo biến đến thư mục chứa ảnh với tên ảnh

            if($productName == "" ||  $category == "" || $brand == "" || $description == "" || $price == "" || $type == "" || $file_name == ""){
                $alert = "<span class='error'>Không được bỏ trống</span>";
                return $alert;
            }else{
                move_uploaded_file($file_temp,$upload_image);
                $query = "INSERT INTO tb_product(productName,catId,brandId,description,type,price,image) VALUES
                ('$productName','$category','$brand','$description','$type','$price','$unique_image') ";
                $result = $this->db->insert($query);

                if($result){
                    $alert = "<span class='success'>Thêm sản phẩm thành công</span>";
                    return $alert;
                }else {
                    $alert = "<span class='error'>Thêm sản phẩm thất bại</span>";
                    return $alert;
                }
            }
        }

        //LIST
        public function show_product(){
            $query = "SELECT tb_product.*, tb_category.catName, tb_brand.brandName
            FROM  tb_product INNER JOIN tb_category ON tb_category.catId = tb_product.catId
                             INNER JOIN tb_brand ON tb_brand.brandId = tb_product.brandId
            ORDER BY tb_product.productId DESC";
            $result = $this->db->select($query);
            return $result;
        }

        //EDIT
        public function edit_product($id){
            $query = "SELECT * FROM  tb_product WHERE productId = '$id' ";
            $result = $this->db->select($query);
            return $result;
        }

        //UPDATE
        public function update_product($data,$files, $id){
            $productName = mysqli_real_escape_string($this->db->link, $data['productName']);
            $category = mysqli_real_escape_string($this->db->link, $data['category']);
            $brand = mysqli_real_escape_string($this->db->link, $data['brand']);
            $description = mysqli_real_escape_string($this->db->link, $data['description']);
            $price = mysqli_real_escape_string($this->db->link, $data['price']);
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

            if($productName == "" ||  $category == "" || $brand == "" || $description == "" || $price == "" || $type == "" ){
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
                    $query = "UPDATE tb_product SET
                    productName = '$productName',
                    catId = '$category',
                    brandId = '$brand',
                    description = '$description',
                    type = '$type',
                    price = '$price',
                    image = '$unique_image'
                    WHERE productId = '$id' ";
                }else{
                    //NEU NGUOI DUNG KHONG CHON ANH
                    $query = "UPDATE tb_product SET
                    productName = '$productName',
                    catId = '$category',
                    brandId = '$brand',
                    description = '$description',
                    type = '$type',
                    price = '$price'
                    WHERE productId = '$id' ";
                }
                $result = $this->db->update($query);
                if($result){
                    $alert = "<span class='success'>Sửa sản phẩm thành công</span>";
                    return $alert;
                }else {
                    $alert = "<span class='error'>Sửa sản phẩm thất bại</span>";
                    return $alert;
                }
            }
        }
        //DELETE
        public function delete_product($id){
            $query = "DELETE FROM tb_product  WHERE productId = '$id' ";
            $result = $this->db->delete($query);
            if($result){
                $alert = "<span class='success'>Xoá sản phẩm thành công</span>";
                return $alert;
            }else {
                $alert = "<span class='error'>Xoá sản phẩm thất bại</span>";
                return $alert;
            }
        }
        
        //END BACKEND
        //START FRONTEND
        public function get_product(){
            $query = "SELECT * FROM  tb_product WHERE type = '1' ";
            $result = $this->db->select($query);
            return $result;
        }

        public function get_product_new(){
            $sp = 2;
            if(!isset($_GET['trang'])){
                $trang = 1;
            }else{
                $trang = $_GET['trang'];
            }
            $tung_trang = ($trang - 1) *$sp;
            $query = "SELECT * FROM  tb_product ORDER BY productId DESC LIMIT $tung_trang,$sp";
            $result = $this->db->select($query);
            return $result;
        }

        public function get_all_product(){
            $query = "SELECT * FROM  tb_product ORDER BY productId DESC ";
            $result = $this->db->select($query);
            return $result;
        }

        public function get_detail($id){
            $query = "SELECT tb_product.*, tb_category.catName, tb_brand.brandName
            FROM  tb_product INNER JOIN tb_category ON tb_category.catId = tb_product.catId
                             INNER JOIN tb_brand ON tb_brand.brandId = tb_product.brandId
            WHERE tb_product.productId ='$id'";
            $result = $this->db->select($query);
            return $result;
        }

        public function get_dell(){
            $query = "SELECT * FROM  tb_product WHERE brandId= '3' ORDER BY productId DESC limit 1";
            $result = $this->db->select($query);
            return $result;
        }

        public function get_dell_brand(){
            $query = "SELECT * FROM  tb_product WHERE brandId= '3' ORDER BY productId DESC limit 4";
            $result = $this->db->select($query);
            return $result;
        }

        public function get_sony(){
            $query = "SELECT * FROM  tb_product WHERE brandId= '6' ORDER BY productId DESC limit 1";
            $result = $this->db->select($query);
            return $result;
        }
        public function get_sony_brand(){
            $query = "SELECT * FROM  tb_product WHERE brandId= '6' ORDER BY productId DESC limit 4";
            $result = $this->db->select($query);
            return $result;
        }
        public function get_samsung(){
            $query = "SELECT * FROM  tb_product WHERE brandId= '4' ORDER BY productId DESC limit 1";
            $result = $this->db->select($query);
            return $result;
        }

        public function get_samsung_brand(){
            $query = "SELECT * FROM  tb_product WHERE brandId= '4' ORDER BY productId DESC limit 4";
            $result = $this->db->select($query);
            return $result;
        }
        public function get_apple(){
            $query = "SELECT * FROM  tb_product WHERE brandId= '5' ORDER BY productId DESC limit 1";
            $result = $this->db->select($query);
            return $result;
        }

        public function get_apple_product(){
            $query = "SELECT * FROM  tb_product WHERE brandId= '5' ORDER BY productId DESC limit 4";
            $result = $this->db->select($query);
            return $result;
        }

        public function get_productbycat($id){
            $query = "SELECT * FROM  tb_product  WHERE catId = '$id' ORDER BY catId DESC LIMIT 8";
            $result = $this->db->select($query);
            return $result;
        }

        public function get_product_by_cat_name($id){
            $query = "SELECT tb_product.*, tb_category.catName,tb_category.catId
            FROM tb_product,tb_category  WHERE tb_product.catId = tb_category.catId 
            AND tb_product.catId = '$id' LIMIT 1";
            $result = $this->db->select($query);
            return $result;
        }

        public function search_product($tukhoa){
            $tukhoa = $this->fm->validation($tukhoa);
            $query = "SELECT * FROM  tb_product WHERE productName LIKE '%$tukhoa%'";
            $result = $this->db->select($query);
            return $result;
        }
    }
?>