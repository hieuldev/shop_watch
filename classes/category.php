<?php

$filepath = realpath(dirname(__FILE__));
include_once($filepath . '/../lib/database.php');
include_once($filepath . '/../helpers/format.php');
?>

<?php
/**
 * 
 */
class category
{
	private $db;
	private $db2;
	private $fm;
	public function __construct()
	{
		$database = new Database();
		$this->db = $database->data->tbl_category;
		$this->db2 = $database->data->tbl_product;
		$this->fm = new Format();
	}
	public function insert_category($catName)
	{
		$catName = $this->fm->validation($catName); //gọi ham validation từ file Format để ktra
		
		//mysqli gọi 2 biến. (catName and link) biến link -> gọi conect db từ file db

		if (empty($catName)) {
			$alert = "<span class='error'>Danh mục không được để trống</span>";
			return $alert;
		} else {

			$result = $this->db->findOne(['catName'=>$catName]);
			if ($result != false) {
				$alert = "<span class='error'>Danh mục sản phẩm đã tồn tại";
				return $alert;
			} else {
				$result = $this->db->insertOne(['catName'=>$catName]);
				if ($result) {
					$alert = "<span class='success'>Thêm danh mục sản phẩm thành công</span>";
					return $alert;
				} else {
					$alert = "<span class='error'>Thêm danh mục sản phẩm thất bại</span>";
					return $alert;
				}
			}
		}
	}
	public function show_category()
	{
		$result = $this->db->find();
		return $result;
	}
	public function update_category($catName, $id)
	{
		$catName = $this->fm->validation($catName); //gọi ham validation từ file Format để ktra
		$id = $this->fm->validation($id);
		if (empty($catName)) {
			$alert = "<span class='error'>Danh mục không được để trống</span>";
			return $alert;
		} else {
			$result = $this->db->updateOne(['_id'=>new MongoDB\BSON\ObjectId($id)],['$set'=>['catName'=>$catName]]);
			if ($result) {
				$alert = "<span class='success'>Cập nhật danh mục thành công</span>";
				return $alert;
			} else {
				$alert = "<span class='error'>Cập nhật danh mục không thành công</span>";
				return $alert;
			}
		}
	}
	public function del_category($id)
	{
		$result = $this->db->deleteOne(['_id'=>new MongoDB\BSON\ObjectId($id)]);
		if ($result) {
			$alert = "<span class='success'>Xóa danh mục thành công</span>";
			return $alert;
		} else {
			$alert = "<span class='success'>Xóa danh mục không thành công</span>";
			return $alert;
		}
	}
	public function getcatbyId($id)
	{
		$result = $this->db->findOne(['_id'=>new MongoDB\BSON\ObjectId($id)]);
		return $result;
	}
	public function show_category_fontend()
	{
		//$query = "SELECT * FROM tbl_category order by catId desc ";
		$result = $this->db->find();
		return $result;
	}
	public function get_product_by_cat($id)
	{
		$sp_tungtrang = 8;
		if (!isset($_GET['page'])) {
			$page = 1;
		} else {
			$page = $_GET['page'];
		}
		$tung_trang = ($page - 1) * $sp_tungtrang;
		//$query = "SELECT * FROM tbl_product where catId = '$id' order by catId desc LIMIT $tung_trang,$sp_tungtrang";
		$result = $this->db2->find(['catId'=>$id]);
		return $result;
	}
	public function select_product_by_cat($id)
	{
		//$query = "SELECT COUNT(*) FROM tbl_product where catId = '$id'";
		$result = $this->db2->count(['catId'=>$id]);
		return $result;
	}
	public function get_name_by_cat($id)
	{
		$query = "SELECT tbl_product.*,tbl_category.catName,tbl_category.catId 
					  FROM tbl_product,tbl_category 
					  WHERE tbl_product.catId = tbl_category.catId
					  AND tbl_product.catId ='$id' LIMIT 1 ";
		$result = $this->db->select($query);
		return $result;
	}
}
?>