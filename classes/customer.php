
<?php 
     $filepath = realpath(dirname(__FILE__));
     require_once($filepath.'/../lib/database.php');
     require_once($filepath.'/../helpers/format.php');
?>
<?php 
    class customer{

        private $db;
        private $fm;

        public function __construct()
        {
            $this->db = new Database();
            $this->fm = new Format();
        }
        
        public function store_customer($data){
            $name = mysqli_real_escape_string($this->db->link, $data['name']);
            $address = mysqli_real_escape_string($this->db->link, $data['address']);
            $city = mysqli_real_escape_string($this->db->link, $data['city']);
            $country = mysqli_real_escape_string($this->db->link, $data['country']);
            $zipcode = mysqli_real_escape_string($this->db->link, $data['zipcode']);
            $phone = mysqli_real_escape_string($this->db->link, $data['phone']);
            $email = mysqli_real_escape_string($this->db->link, $data['email']);
            $password = mysqli_real_escape_string($this->db->link, md5($data['password']));

            if($name == "" ||  $address == "" || $city == "" || $country == "" 
                || $zipcode == "" || $phone == "" || $email == "" || $password == ""){
                $alert = "<span class='error'>Không được bỏ trống</span>";
                return $alert;
            }else{
                $check_email = "SELECT * FROM tb_customer WHERE email= '$email' LIMIT 1";
                $result_check = $this->db->select($check_email);
                if($result_check){
                    $alert = "<span class='error'>Email đã tồn tại </span>";
                    return $alert;
                }else{
                    $query = "INSERT INTO tb_customer(name,address,city,country,zipcode,phone,email,password) VALUES
                    ('$name','$address','$city','$country','$zipcode','$phone','$email','$password') ";
                    $result = $this->db->insert($query);
    
                    if($result){
                        $alert = "<span class='success'>Đăng ký thành công</span>";
                        return $alert;
                    }else {
                        $alert = "<span class='error'>Đăng ký thất bại</span>";
                        return $alert;
                    }
                }
            }
        }

        public function login_customer($data){
            $email = mysqli_real_escape_string($this->db->link, $data['email']);
            $password = mysqli_real_escape_string($this->db->link, md5($data['password']));
            if($email == "" || $password == ""){
                $alert = "<span class='error'>Không được bỏ trống</span>";
                return $alert;
            }else{
                $check_email = "SELECT * FROM tb_customer WHERE email= '$email' AND password = '$password' LIMIT 1";
                $result_check = $this->db->select($check_email);
                if($result_check != false){
                    $value = $result_check->fetch_assoc();
                    Session::set('customer_login',true);
                    Session::set('customer_id',$value['id']);
                    Session::set('customer_name',$value['name']);
                    header('Location:order.php');
                }else{
                    $alert = "<span class='error'>Password hoặc email sai</span>";
                    return $alert;
                }
            }
        }

       public function show_customer($id){
            $query = "SELECT * FROM tb_customer WHERE id= '$id' LIMIT 1";
            $result = $this->db->select($query);
            return $result;
       }

       public function update_customer($data,$id){
            $name = mysqli_real_escape_string($this->db->link, $data['name']);
            $address = mysqli_real_escape_string($this->db->link, $data['address']);
            $city = mysqli_real_escape_string($this->db->link, $data['city']);
            $zipcode = mysqli_real_escape_string($this->db->link, $data['zipcode']);
            $phone = mysqli_real_escape_string($this->db->link, $data['phone']);
            $email = mysqli_real_escape_string($this->db->link, $data['email']);
    

            if($name == "" ||  $address == "" || $city == "" || $zipcode == "" || $phone == "" || $email == "" ){
                $alert = "<span class='error'>Không được bỏ trống</span>";
                return $alert;
            }else{
                $query = "UPDATE tb_customer SET name = '$name',address = ' $address',city = '$city',
                zipcode = '$zipcode',phone = '$phone',email = '$email' WHERE id = '$id'";
                $result = $this->db->update($query);

                if($result){
                    $alert = "<span class='success'>Sửa thông tin thành công</span>";
                    return $alert;
                }else {
                    $alert = "<span class='error'>Sửa thông tin thất bại</span>";
                    return $alert;
                }
                
            }
       }

       public function store_commnet($id){
           $commentName = $_POST['commentName'];
           $comment = $_POST['content'];
           $productId = $id;
           if($commentName == '' || $comment == ''){
                $alert = "<span class='error'>Không được bỏ trống</span>";
                return $alert;
           }else{
                $query = "INSERT INTO tb_comment(commentName,content,productId) VALUES
                ('$commentName','$comment','$productId') ";
                $result = $this->db->insert($query);

                if($result){
                    $alert = "<span class='success'>Bình luận sẽ được admin kiểm duyệt</span>";
                    return $alert;
                }else {
                    $alert = "<span class='error'>Bình luận thất bại</span>";
                    return $alert;
                }
           }
       }

       public function show_comment(){
            $query = "SELECT * FROM tb_comment ORDER BY commentId DESC";
            $result = $this->db->select($query);
            return $result;
       }

       public function delete_comment($id){
            $query = "DELETE FROM  tb_comment WHERE commentId = '$id' ";
            $result = $this->db->delete($query);
            if($result){
                $alert = "<span class='success'>Xoá bình luận thành công</span>";
                return $alert;
            }else {
                $alert = "<span class='error'>Xoá bình luận thất bại</span>";
                return $alert;
            }
       }

       public function store_feedback($data,$id){
            $name = mysqli_real_escape_string($this->db->link, $data['name']);
            $email = mysqli_real_escape_string($this->db->link, $data['email']);
            $phone = mysqli_real_escape_string($this->db->link, $data['phone']);
            $content = mysqli_real_escape_string($this->db->link, $data['content']);
            if($name == '' || $email == '' || $phone == '' || $content == ''){
                $alert = "<span class='error'>Không được bỏ trống</span>";
                return $alert;
           }else{
                $query = "INSERT INTO tb_feedback(name,email,phone,content,customerId) VALUES
                ('$name','$email','$phone','$content','$id') ";
                $result = $this->db->insert($query);
                if($result){
                    $alert = "<span class='success'>Gửi phản hồi thành công</span>";
                    return $alert;
                }else {
                    $alert = "<span class='error'>Gửi phản hồi thất bại</span>";
                    return $alert;
                }
           }
       }

       public function show_feedback(){
        $query = "SELECT * FROM tb_feedback ORDER BY id DESC";
        $result = $this->db->select($query);
        return $result;
   }

   public function delete_feedback($id){
        $query = "DELETE FROM  tb_feedback WHERE id = '$id' ";
        $result = $this->db->delete($query);
        if($result){
            $alert = "<span class='success'>Xoá phản hồi thành công</span>";
            return $alert;
        }else {
            $alert = "<span class='error'>Xoá phản hồi thất bại</span>";
            return $alert;
        }
   }
    }
?>