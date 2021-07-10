
<?php 
     $filepath = realpath(dirname(__FILE__));
     require_once($filepath.'/../lib/database.php');
     require_once($filepath.'/../helpers/format.php');
?>
<?php 
    class cart{

        private $db;
        private $fm;

        public function __construct()
        {
            $this->db = new Database();
            $this->fm = new Format();
        }
        
        public function add_cart($id,$quantity){
            $quantity = mysqli_real_escape_string($this->db->link, $quantity);
            $id = mysqli_real_escape_string($this->db->link, $id);
            $sessionId = session_id();

            $query = "SELECT * FROM tb_product WHERE productId = '$id'";
            $result = $this->db->select($query)->fetch_assoc();
            $image = $result['image'];
            $productName = $result['productName'];
            $price = $result['price'];

            $check_cart = "SELECT * FROM tb_cart WHERE productId = '$id' AND sessionId = '$sessionId'";
            $check =  $this->db->select($check_cart);
            if(mysqli_num_rows($check)>0){
                $alert = "Sản phẩm đã tồn tại!!";
                return $alert;
            }else{ 
                $query_cart = "INSERT INTO tb_cart(productId,sessionId,productName,price,quantity,image) VALUES
                ('$id','$sessionId','$productName','$price','$quantity','$image') ";
                $result_cart = $this->db->insert($query_cart);

                if($result_cart){
                    header('Location:cart.php');
                }else {
                    header('Location:404.php');
                }
            }
        }

        public function get_cart(){
            $sessionId = session_id();
            $query = "SELECT * FROM  tb_cart WHERE sessionId = '$sessionId'";
            $result = $this->db->select($query);
            return $result;
        }

        public function update_cart($cartId,$quantity){
            $quantity = mysqli_real_escape_string($this->db->link, $quantity);
            $cartId = mysqli_real_escape_string($this->db->link, $cartId);

            $query = "UPDATE tb_cart SET quantity = '$quantity' WHERE cartId = '$cartId' ";
            $result = $this->db->update($query);
            if($result){
                header('Location:cart.php');
            }else {
                $alert = "<span class='error'>Cập nhật số lượng thất bại</span>";
                return $alert;
            }
        }

        public function delete_cart($cartId){
            $query = "DELETE FROM tb_cart  WHERE cartId = '$cartId' ";
            $result = $this->db->delete($query);
            if($result){
                header('Location:cart.php');
                $alert = "<span class='success'>Huỷ giỏ hàng thành công</span>";
                return $alert;
            }else {
                $alert = "<span class='error'>Huỷ giỏ hàng thất bại</span>";
                return $alert;
            }
        }

        public function check_cart(){
            $sessionId = session_id();
            $query = "SELECT * FROM tb_cart WHERE sessionId = '$sessionId'";
            $result = $this->db->select($query);
            return $result;
        }
       
        public function delete_all_cart(){
            $sessionId = session_id();
            $query = "DELETE FROM tb_cart WHERE sessionId = '$sessionId'";
            $result = $this->db->select($query);
            return $result;
        }

        public function store_order($customer_id){
            $sessionId = session_id();
            $query = "SELECT * FROM tb_cart WHERE sessionId = '$sessionId'";
            $get_product = $this->db->select($query);
            if($get_product){
                while($result = $get_product->fetch_assoc()){
                    $productId = $result['productId'];
                    $productName = $result['productName'];
                    $quantity = $result['quantity'];
                    $price = $result['price']*$quantity;
                    $image = $result['image'];
                    $customer_id = $customer_id;
                    $query_order = "INSERT INTO tb_order(productId,productName,customerId,quantity,price,image) VALUES
                                    ('$productId','$productName','$customer_id','$quantity','$price','$image') ";
                    $result_order = $this->db->insert($query_order);
                }
            }
        }

        public function get_price($customer_id){
            $query = "SELECT price FROM tb_order WHERE customerId = '$customer_id' ";
            $get_price = $this->db->select($query);
            return $get_price;
        }

        public function get_cart_detail($customer_id){
            $query = "SELECT * FROM tb_order WHERE customerId = '$customer_id' ";
            $get_cart_detail = $this->db->select($query);
            return $get_cart_detail;
        }

        public function check_order($customer_id){
            $query = "SELECT * FROM tb_order WHERE customerId = '$customer_id' ";
            $get_cart_detail = $this->db->select($query);
            return $get_cart_detail;
        }

        public function get_inbox(){
            $query = "SELECT * FROM tb_order ORDER BY date_order";
            $get_inbox = $this->db->select($query);
            return $get_inbox;
        }

        public function shifted($id,$time,$price){
            $id = mysqli_real_escape_string($this->db->link, $id);
            $time = mysqli_real_escape_string($this->db->link, $time);
            $price = mysqli_real_escape_string($this->db->link, $price);
            $query = "UPDATE tb_order SET status = '1' WHERE id = '$id' AND date_order = '$time' AND price = '$price' ";
            $result = $this->db->update($query);
            if($result){
                $alert = "<span class='success'>Cập nhật đơn hàng thành công</span>";
                return $alert;
            }else {
                $alert = "<span class='error'>Cập nhật đơn hàng thất bại</span>";
                return $alert;
            }
        }
        public function delete_shifted($id,$time,$price){
            $id = mysqli_real_escape_string($this->db->link, $id);
            $time = mysqli_real_escape_string($this->db->link, $time);
            $price = mysqli_real_escape_string($this->db->link, $price);
            $query = "DELETE FROM tb_order WHERE id = '$id' AND date_order = '$time' AND price = '$price' ";
            $result = $this->db->delete($query);
            if($result){
                $alert = "<span class='success'>Xoá đơn hàng thành công</span>";
                return $alert;
            }else {
                $alert = "<span class='error'>Xoá đơn hàng thất bại</span>";
                return $alert;
            }
        }

        public function confirm_shifted($id,$time,$price){
            $id = mysqli_real_escape_string($this->db->link, $id);
            $time = mysqli_real_escape_string($this->db->link, $time);
            $price = mysqli_real_escape_string($this->db->link, $price);
            $query = "UPDATE tb_order SET status = '2' WHERE customerId = '$id' AND date_order = '$time' AND price = '$price' ";
            $result = $this->db->update($query);
            if($result){
                $alert = "<span class='success'>Cập nhật đơn hàng thành công</span>";
                return $alert;
            }else {
                $alert = "<span class='error'>Cập nhật đơn hàng thất bại</span>";
                return $alert;
            }
        }
    }
?>