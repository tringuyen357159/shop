
<?php 
    $filepath = realpath(dirname(__FILE__));
    require_once($filepath.'/../lib/session.php');
    Session::checkLogin();
    require_once($filepath.'/../lib/database.php');
    require_once($filepath.'/../helpers/format.php');
?>
<?php 
    class adminlogin{

        private $db;
        private $fm;

        public function __construct()
        {
            $this->db = new Database();
            $this->fm = new Format();
        }

        public function storeLogin($adminUser,$adminPass){
            $adminUser = $this->fm->validation($adminUser);
            $adminPass = $this->fm->validation($adminPass);

            $adminUser = mysqli_real_escape_string($this->db->link, $adminUser);
            $adminPass = mysqli_real_escape_string($this->db->link, $adminPass);

            if(empty($adminUser) || empty($adminPass)){
                $alert = "Vui lòng nhập tên đăng nhập và mật khẩu";
                return $alert;
            }else{
                $query = "SELECT * FROM tb_admin WHERE adminUser = '$adminUser' AND adminPass = '$adminPass' LIMIT 1";
                $result = $this->db->select($query);

                if($result != false){
                    $value = $result->fetch_assoc();
                    Session::set('adminlogin', true);
                    Session::set('adminId', $value['adminId']);
                    Session::set('adminUser', $value['adminUser']);
                    Session::set('adminName', $value['adminName']);
                    header('Location:index.php');
                }else{
                    $alert = "Tên đăng nhập hoặc mật khẩu sai";
                    return $alert;
                }
            }
        }
    }
?>