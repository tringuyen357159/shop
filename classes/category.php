
<?php 
     $filepath = realpath(dirname(__FILE__));
     require_once($filepath.'/../lib/database.php');
     require_once($filepath.'/../helpers/format.php');
?>
<?php 
    class category{

        private $db;
        private $fm;

        public function __construct()
        {
            $this->db = new Database();
            $this->fm = new Format();
        }
        
        //THÊM
        public function store_category($catName){
            $catName = $this->fm->validation($catName);
            $catName = mysqli_real_escape_string($this->db->link, $catName);

            if(empty($catName)){
                $alert = "<span class='error'>Không được bỏ trống</span>";
                return $alert;
            }else{
                $query = "INSERT INTO tb_category(catName) VALUES('$catName') ";
                $result = $this->db->insert($query);

                if($result){
                    $alert = "<span class='success'>Thêm danh mục thành công</span>";
                    return $alert;
                }else {
                    $alert = "<span class='error'>Thêm danh mục thất bại</span>";
                    return $alert;
                }
            }
        }

        //LIST
        public function show_category(){
            $query = "SELECT * FROM  tb_category ORDER BY catId DESC";
            $result = $this->db->select($query);
            return $result;
        }

        //EDIT
        public function edit_category($id){
            $query = "SELECT * FROM  tb_category WHERE catId = '$id' ";
            $result = $this->db->select($query);
            return $result;
        }

        //UPDATE
        public function update_category($catName, $id){
            $catName = $this->fm->validation($catName);
            $catName = mysqli_real_escape_string($this->db->link, $catName);
            $id = mysqli_real_escape_string($this->db->link, $id);

            if(empty($catName)){
                $alert = "<span class='error'>Không được bỏ trống</span>";
                return $alert;
            }else{
                $query = "UPDATE tb_category SET catName = '$catName' WHERE catId = '$id' ";
                $result = $this->db->update($query);
                if($result){
                    $alert = "<span class='success'>Sửa danh mục thành công</span>";
                    return $alert;
                }else {
                    $alert = "<span class='error'>Sửa danh mục thất bại</span>";
                    return $alert;
                }
            }
        }
        //DELETE
        public function delete_category($id){
            $query = "DELETE FROM  tb_category WHERE catId = '$id' ";
            $result = $this->db->delete($query);
            if($result){
                $alert = "<span class='success'>Xoá danh mục thành công</span>";
                return $alert;
            }else {
                $alert = "<span class='error'>Xoá danh mục thất bại</span>";
                return $alert;
            }
        }

        public function get_category(){
            $query = "SELECT * FROM  tb_category ORDER BY catId DESC";
            $result = $this->db->select($query);
            return $result;
        }

        
    }
?>