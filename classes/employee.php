<?php
	$filepath = realpath(dirname(__FILE__));
	include_once ($filepath.'/../lib/database.php');
	include_once ($filepath.'/../helpers/format.php');
?>



<?php 
	/**
	* 
	*/
	class employee
	{
		private $db;
		private $fm;
		public function __construct()
		{
			$this->db = new Database();
			$this->fm = new Format();
		}
public function insert_employee($data){
			
			$adminName = mysqli_real_escape_string($this->db->link, $data['adminName']);
			$adminEmail = mysqli_real_escape_string($this->db->link, $data['adminEmail']);

			$adminUser = mysqli_real_escape_string($this->db->link, $data['adminUser']);
			$adminPass = md5(mysqli_real_escape_string($this->db->link, $data['adminPass']));
			
			 //mysqli gọi 2 biến. (catName and link) biến link -> gọi conect db từ file db
			
			// kiểm tra hình ảnh và lấy hình ảnh cho vào folder upload
			
			if($adminName =="" || $adminEmail == "" || $adminUser == "" || $adminPass == "" ){
				$alert = "<span class='error'>Không được để trống</span>";
				return $alert;
			}else{
				$query = "INSERT INTO tbl_admin(adminName,adminEmail,adminUser,adminPass,RankId) VALUES('$adminName','$adminEmail','$adminUser','$adminPass','2') ";
				$result = $this->db->insert($query);
				if($result){
					$alert = "<span class='success'>Thêm nhân viên thành công</span>";
					return $alert;
				}else {
					$alert = "<span class='error'>Thêm nhân viên thất bại</span>";
					return $alert;
				}
			}
		}
		public function list_employee()
		{
			$query = "SELECT * FROM `tbl_admin` WHERE RankId='2'";
			$result = $this->db->select($query);
			return $result;
		}
        public function del_employee($id)
		{
			$query = "DELETE FROM tbl_admin where adminId = '$id' ";
			$result = $this->db->delete($query);
			if($result){
				$alert = "<span class='success'>Xóa nhân viên thành công</span>";
				return $alert;
			}else {
				$alert = "<span class='error'>Xóa nhân viên thất bại</span>";
				return $alert;
			}
		}
        public function update_employee($data,$id)
		{
			$adminName = mysqli_real_escape_string($this->db->link, $data['adminName']);
			$adminEmail = mysqli_real_escape_string($this->db->link, $data['adminEmail']);

			$adminUser = mysqli_real_escape_string($this->db->link, $data['adminUser']);
			$adminPass = md5(mysqli_real_escape_string($this->db->link, $data['adminPass']));
			$id = mysqli_real_escape_string($this->db->link, $id);
			if(empty($adminName)&&empty($adminEmail)&&empty($adminUser)&&empty($adminPass)){
				$alert = "<span class='error'>Không được để trống</span>";
				return $alert;
			}else{
				$query = "UPDATE tbl_admin SET adminName= '$adminName',adminEmail='$adminEmail',adminUser='$adminUser',adminPass='$adminPass' WHERE adminId = '$id' ";
				$result = $this->db->update($query);
				if($result){
					$alert = "<span class='success'>Cập nhật nhân viên thành công</span>";
					return $alert;
				}else {
					$alert = "<span class='error'>Cập nhật nhân viên không thành công</span>";
					return $alert;
				}
			}

		}
        public function getemployeebyId($id)
		{
			$query = "SELECT * FROM tbl_admin where adminId = '$id' ";
			$result = $this->db->select($query);
			return $result;
		}
	}
 ?>