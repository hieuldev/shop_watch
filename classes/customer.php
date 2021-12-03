<?php
$filepath = realpath(dirname(__FILE__));
include_once($filepath . '/../lib/database.php');
include_once($filepath . '/../helpers/format.php');
?>


 
<?php
/**
 * 
 */
class customer
{
	private $db;
	private $fm;
	public function __construct()
	{
		$this->db = new Database();
		$this->fm = new Format();
	}
	public function insert_customer($data)
	{
		$name = mysqli_real_escape_string($this->db->link, $data['name']);
		$city = mysqli_real_escape_string($this->db->link, $data['city']);
		$zipcode = mysqli_real_escape_string($this->db->link, $data['zipcode']);
		$email = mysqli_real_escape_string($this->db->link, $data['email']);
		$address = mysqli_real_escape_string($this->db->link, $data['address']);
		$country = mysqli_real_escape_string($this->db->link, $data['country']);
		$phone = mysqli_real_escape_string($this->db->link, $data['phone']);
		$password = mysqli_real_escape_string($this->db->link, md5($data['password']));

		if ($name == "" || $city == "" || $zipcode == "" || $email == "" || $address == "" || $country == "" || $phone == "" || $password == "") {
			$alert = "<span class='error'>Không được để trống</span>";
			return $alert;
		} else {
			$check_email = "SELECT * FROM tbl_customer WHERE email='$email' LIMIT 1";
			$result_check = $this->db->select($check_email);
			if ($result_check) {
				$alert = "<span class='error'>Địa chỉ Email đã tồn tại ? Hãy điền Email khác </span>";
				return $alert;
			} else {
				$query = "INSERT INTO tbl_customer(name,address,city,country,zipcode,phone,email,password) VALUES('$name','$address','$city','$country','$zipcode','$phone','$email','$password') ";
				$result = $this->db->insert($query);
				if ($result) {
					$alert = "<span class='success'>Thêm khách hàng thành công</span>";
					return $alert;
				} else {
					$alert = "<span class='error'>Thêm khách hàng không thành công</span>";
					return $alert;
				}
			}
		}
	}
	public function login_customer($data)
	{
		$email =  $data['email'];
		$password = md5($data['password']);
		if ($email == '' || $password == '') {
			$alert = "<span class='error'>Email và Pasword không được để trống</span>";
			return $alert;
		} else {
			$check_login = "SELECT * FROM tbl_customer WHERE email='$email' AND password='$password' ";
			$result_check = $this->db->select($check_login);
			if ($result_check) {
				$value = $result_check->fetch_assoc();
				Session::set('customer_login', true);
				Session::set('customer_id', $value['customer_id']);
				Session::set('customer_name', $value['name']);
				header('Location:index.php');
			} else {
				$alert = "<span class='error'>Email và password không trùng khớp</span>";
				return $alert;
			}
		}
	}
	public function show_customers($id)
	{
		$query = "SELECT * FROM tbl_customer,tbl_customerrank WHERE tbl_customer.RankCID=tbl_customerrank.RankCID and customer_id='$id'";
		$result = $this->db->select($query);
		return $result;
	}
	public function show_all_customers()
	{
		$query = "SELECT * FROM tbl_customer";
		$result = $this->db->select($query);
		return $result;
	}
	public function show_user_profile()
	{
		$user_tungtrang=10;
             if(!isset($_GET['page']))
            {
                $page=1;
            }
            else
            {
                $page=$_GET['page'];
            }
            $tung_trang=($page-1)*$user_tungtrang;
		$query = "SELECT * FROM tbl_customer LIMIT $tung_trang,$user_tungtrang";
		$result = $this->db->select($query);
		return $result;
	}
	
	public function show_news($type)
	{
		$query = "SELECT * FROM `tbl_news` WHERE newsType='$type'";
		$result = $this->db->select($query);
		return $result;
	}
	public function update_customers($data, $id)
	{
		$name = mysqli_real_escape_string($this->db->link, $data['name']);
		$zipcode = mysqli_real_escape_string($this->db->link, $data['zipcode']);
		$email = mysqli_real_escape_string($this->db->link, $data['email']);
		$address = mysqli_real_escape_string($this->db->link, $data['address']);
		$phone = mysqli_real_escape_string($this->db->link, $data['phone']);

		if ($name == "" || $zipcode == "" || $email == "" || $address == "" || $phone == "") {
			$alert = "<span class='error'>Không được để trống</span>";
			return $alert;
		} else {
			$query = "update tbl_customer SET name='$name',zipcode='$zipcode',email='$email',address='$address',phone='$phone' WHERE customer_id ='$id'";
			$result = $this->db->insert($query);
			if ($result) {
				$alert = "<span class='success'>Khách hàng được cập nhật thành công</span>";
				return $alert;
			} else {
				$alert = "<span class='error'>Khách hàng được cập nhật không thành công</span>";
				return $alert;
			}
		}
	}
}
?>