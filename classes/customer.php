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
	private $db2;
	private $fm;
	public function __construct()
	{
		$database = new Database();
		$this->db = $database->data->tbl_customer;
		$this->db2 = $database->data->tbl_news;
		$this->fm = new Format();
	}
	public function insert_customer($data)
	{
		$name =  $this->fm->validation($data['name']);
		$city = $this->fm->validation($data['city']);
		$zipcode = $this->fm->validation($data['zipcode']);
		$email = $this->fm->validation($data['email']);
		$address = $this->fm->validation($data['address']);
		$country = $this->fm->validation($data['country']);
		$phone = $this->fm->validation($data['phone']);
		$password = $this->fm->validation($data['password']);

		if ($name == "" || $city == "" || $zipcode == "" || $email == "" || $address == "" || $country == "" || $phone == "" || $password == "") {
			$alert = "<span class='error'>Không được để trống</span>";
			return $alert;
		} else {
			$check_email = $this->db->findOne(['email' => $email]);
			$result_check = $this->db->select($check_email);
			if ($result_check) {
				$alert = "<span class='error'>Địa chỉ Email đã tồn tại ? Hãy điền Email khác </span>";
				return $alert;
			} else {
				$result = $this->db->insertOne(['name' => $name, 'city' => $city, 'zipcode' => $zipcode, 'email' => $email, 'address' => $address, 'country' => $country, 'phone' => $phone, 'password' => md5($password)]);
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
			//$check_login = "SELECT * FROM tbl_customer WHERE email='$email' AND password='$password' ";
			$result_check = $this->db->findOne(['email' => $email, 'password' => $password]);
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
		//$query = "SELECT * FROM tbl_customer,tbl_customerrank WHERE tbl_customer.RankCID=tbl_customerrank.RankCID and customer_id='$id'";
		$result = $this->db->findOne(['_id' => new MongoDB\BSON\ObjectId($id)]);
		return $result;
	}
	public function show_all_customers($search)
	{
		if ($search == "") {
			$result = $this->db->find();
		} else {
			$result = $this->db->find(array('name' => array('$regex' => $search)));
		}
		//$query = "SELECT * FROM tbl_customer";

		return $result;
	}
	public function show_user_profile()
	{
		$user_tungtrang = 10;
		if (!isset($_GET['page'])) {
			$page = 1;
		} else {
			$page = $_GET['page'];
		}
		$tung_trang = ($page - 1) * $user_tungtrang;
		$query = "SELECT * FROM tbl_customer LIMIT $tung_trang,$user_tungtrang";
		$result = $this->db->select($query);
		return $result;
	}

	public function show_news($type)
	{
		//$query = "SELECT * FROM `tbl_news` WHERE newsType='$type'";
		$result = $this->db2->fine(['newsType' => $type]);
		return $result;
	}
	public function getdatafromcsv()
	{
		$row = 1;
		if (($handle = fopen("C:\\xampp\\htdocs\\shop_watch\\classes\\KhachHangDacBiet.csv", "r")) !== FALSE) {
		  while (($data = fgetcsv($handle, 1000, ",")) !== FALSE) {
			$num = count($data);
			echo "<p> $num fields in line $row: <br /></p>\n";
			$row++;
			for ($c=0; $c < $num; $c++) {
				echo $data[$c] . "<br />\n";
			}
		  }
		  fclose($handle);
		}
	}
	public function update_customers($data, $id)
	{
		$name =  $this->fm->validation($data['name']);
		$zipcode = $this->fm->validation($data['zipcode']);
		$email = $this->fm->validation($data['email']);
		$address = $this->fm->validation($data['address']);
		$phone = $this->fm->validation($data['phone']);

		if ($name == "" || $zipcode == "" || $email == "" || $address == "" || $phone == "") {
			$alert = "<span class='error'>Không được để trống</span>";
			return $alert;
		} else {
			//$query = "update tbl_customer SET name='$name',zipcode='$zipcode',email='$email',address='$address',phone='$phone' WHERE customer_id ='$id'";
			$result = $this->db->updateOne(['_id' => new MongoDB\BSON\ObjectId($id)], ['$set' => ['name' => $name, 'zipcode' => $zipcode, 'email' => $email, 'address' => $address, 'phone' => $phone]]);
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