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
			$database=new Database();
            $this->db=$database->data->tbl_admin;
			$this->fm = new Format();
		}
public function insert_employee($data){
			
			$adminName = $this->fm->validation($data['adminName']);
			$adminEmail = $this->fm->validation($data['adminEmail']);

			$adminUser = $this->fm->validation($data['adminUser']);
			$adminPass = md5($this->fm->validation($data['adminPass']));
			$check = $this->db->findOne(['adminUser'=>$adminUser]);
			 //mysqli gọi 2 biến. (catName and link) biến link -> gọi conect db từ file db
			
			// kiểm tra hình ảnh và lấy hình ảnh cho vào folder upload
			
			if($adminName =="" || $adminEmail == "" || $adminUser == "" || $adminPass == "" ){
				$alert = "<span class='error'>Không được để trống</span>";
				return $alert;
			}else if($check)
            {
                $alert = "<span class='error'>User đã tồn tại</span>";
				return $alert;
}
    
    else{
                
				$result = $this->db->insertOne(['adminName'=>$adminName,'adminEmail'=>$adminEmail,'adminUser'=>$adminUser,'adminPass'=>$adminPass,'RankId'=>'2']);
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
			$result = $this->db->find();
			return $result;
		}
        public function del_employee($id)
		{
			$result = $this->db->deleteOne(['_id'=>new MongoDB\BSON\ObjectId($id)]);
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
			$adminName = $this->fm->validation($data['adminName']);
			$adminEmail = $this->fm->validation($data['adminEmail']);

			$adminUser = $this->fm->validation($data['adminUser']);
			$adminPass = md5($this->fm->validation($data['adminPass']));
            $id=$this->fm->validation($id);
			if(empty($adminName)&&empty($adminEmail)&&empty($adminUser)&&empty($adminPass)){
				$alert = "<span class='error'>Không được để trống</span>";
				return $alert;
			}else{
				$result = $this->db->updateOne(['_id'=>new MongoDB\BSON\ObjectId($id)],['$set'=>['adminName'=>$adminName,'adminEmail'=>$adminEmail,'adminUser'=>$adminUser,'adminPass'=>$adminPass]]);
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
			$result = $this->db->findOne(['_id'=>new MongoDB\BSON\ObjectId($id)]);
			return $result;
		}
	}
 ?>