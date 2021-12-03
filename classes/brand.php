<?php
	$filepath = realpath(dirname(__FILE__));
	include_once ($filepath.'/../lib/database.php');
	include_once ($filepath.'/../helpers/format.php');
?>



<?php 
	class brand
	{
		private $db;
		private $fm;
		public function __construct()
		{
			$database=new Database();
            $this->db=$database->data->tbl_brand;
			$this->fm = new Format();
		}
        
		public function insert_brand($data){
			$brandName = $this->fm->validation($data['brandName']); //gọi ham validation để ktra có rỗng hay ko để ktra
            $topBrand = $this->fm->validation($data['type']);
			
			if(empty($brandName)&&empty($$topBrand)){
				$alert = "<span class='error'>Không được để trống</span>";
				return $alert;
			}
            else{
                $result=$this->db->findOne(['brandName'=>$brandName]);
                if($result)
                {
                    $alert= "<span class='error'>Danh mục sản phẩm đã tồn tại";
                    return $alert;
                    
                }
                else{
				$result =$this->db->insertOne(['brandName'=>$brandName,'topBrand'=>$topBrand]);
				if($result){
					$alert = "<span class='success'>Thêm thương hiệu thành công</span>";
					return $alert;
				}else {
					$alert = "<span class='error'>Thêm thương hiệu không thành công</span>";
					return $alert;
				}}
			}
		}
		public function show_brand()
		{
			$result = $this->db->find();
			return $result;
		}
		public function getbrandbyId($id)
		{
			$result = $this->db->findOne(['_id'=>new MongoDB\BSON\ObjectId($id)]);
			return $result;
		}
		public function update_brand($data,$id)
		{ 
			$brandName = $this->fm->validation($data['brandName']); //gọi ham validation từ file Format để ktra
            $topBrand = $this->fm->validation($data['type']);
            $id = $this->fm->validation($id);
			//$id = mysqli_real_escape_string($this->db->link, $id);
			if(empty($brandName)){
				$alert = "<span class='error'>Không được để trống</span>";
				return $alert;
			}else{
				$result = $this->db->updateOne(['_id'=>new MongoDB\BSON\ObjectId($id)],['$set'=>['brandName'=>$brandName,'topBrand'=>$topBrand]]);
				if($result){
					$alert = "<span class='success'>Cập nhật thương hiệu thành công</span>";
					return $alert;
				}else {
					$alert = "<span class='error'>Cập nhật thương hiệu không thành công</span>";
					return $alert;
				}
			}

		}
		public function del_brand($id)
		{
//			$query = "DELETE FROM tbl_brand where brandId = '$id' ";
			$result = $this->db->deleteOne(['_id'=>new MongoDB\BSON\ObjectId($id)]);
			if($result){
				$alert = "<span class='success'>Xóa thương hiệu thành công</span>";
				return $alert;
			}else {
				$alert = "<span class='error'>Xóa thương hiệu thất bại</span>";
				return $alert;
			}
		}
//		public function show_topbrand()
//		{
//			$query = "SELECT * FROM tbl_brand where topBrand=1 order by brandId desc ";
//			$result = $this->db->select($query);
//			return $result;
//		}
        
        
        
		
	}
 ?>