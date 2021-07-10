
<?php 
    $filepath = realpath(dirname(__FILE__));
    require_once($filepath.'/../lib/database.php');
    require_once($filepath.'/../helpers/format.php');
?>
<?php 
    class brand{

        private $db;
        private $fm;

        public function __construct()
        {
            $this->db = new Database();
            $this->fm = new Format();
        }
        
        //THÊM
        public function store_brand($brandName){
            $brandName = $this->fm->validation($brandName);
            $brandName = mysqli_real_escape_string($this->db->link, $brandName);

            if(empty($brandName)){
                $alert = "<span class='error'>Không được bỏ trống</span>";
                return $alert;
            }else{
                $query = "INSERT INTO tb_brand(brandName) VALUES('$brandName') ";
                $result = $this->db->insert($query);

                if($result){
                    $alert = "<span class='success'>Thêm thương hiệu thành công</span>";
                    return $alert;
                }else {
                    $alert = "<span class='error'>Thêm thương hiệu thất bại</span>";
                    return $alert;
                }
            }
        }

        //LIST
        public function show_brand(){
            $query = "SELECT * FROM  tb_brand ORDER BY brandId DESC";
            $result = $this->db->select($query);
            return $result;
        }

        //EDIT
        public function edit_brand($id){
            $query = "SELECT * FROM  tb_brand WHERE brandId = '$id' ";
            $result = $this->db->select($query);
            return $result;
        }

        //UPDATE
        public function update_brand($brandName, $id){
            $brandName = $this->fm->validation($brandName);
            $brandName = mysqli_real_escape_string($this->db->link, $brandName);
            $id = mysqli_real_escape_string($this->db->link, $id);

            if(empty($brandName)){
                $alert = "<span class='error'>Không được bỏ trống</span>";
                return $alert;
            }else{
                $query = "UPDATE tb_brand SET brandName = '$brandName' WHERE brandId = '$id' ";
                $result = $this->db->update($query);
                if($result){
                    $alert = "<span class='success'>Sửa thương hiệu thành công</span>";
                    return $alert;
                }else {
                    $alert = "<span class='error'>Sửa thương hiệu thất bại</span>";
                    return $alert;
                }
            }
        }
        //DELETE
        public function delete_brand($id){
            $query = "DELETE FROM  tb_brand WHERE brandId = '$id' ";
            $result = $this->db->delete($query);
            if($result){
                $alert = "<span class='success'>Xoá thương hiệu thành công</span>";
                return $alert;
            }else {
                $alert = "<span class='error'>Xoá thương hiệu thất bại</span>";
                return $alert;
            }
        }
    }
?>