<?php
	$filepath = realpath(dirname(__FILE__));
	include_once ($filepath.'/../lib/database.php');
	include_once ($filepath.'/../helpers/format.php');
?>

<?php 
	/**
	* 
	*/
	class product
	{
		private $db;
		private $fm;
		public function __construct()
		{
			$this->db = new Database();
			$this->fm = new Format();
		}

		public function insert_product($data,$files){
			
			$productName = mysqli_real_escape_string($this->db->link, $data['productName']);
			$product_code = mysqli_real_escape_string($this->db->link, $data['product_code']);

			$productQuantity = mysqli_real_escape_string($this->db->link, $data['productQuantity']);
			$category = mysqli_real_escape_string($this->db->link, $data['category']);
			$brand = mysqli_real_escape_string($this->db->link, $data['brand']);
			$product_desc = mysqli_real_escape_string($this->db->link, $data['product_desc']);
			$price = mysqli_real_escape_string($this->db->link, $data['price']);
			$type = mysqli_real_escape_string($this->db->link, $data['type']);
			 //mysqli gọi 2 biến. (catName and link) biến link -> gọi conect db từ file db
			
			// kiểm tra hình ảnh và lấy hình ảnh cho vào folder upload
			$permited = array('jpg','jpeg','png','gif');
			$file_name = $_FILES['image']['name'];
			$file_size = $_FILES['image']['size'];
			$file_temp = $_FILES['image']['tmp_name'];
			
			$div =explode('.', $file_name);
			$file_ext = strtolower(end($div));
			$unique_image = substr(md5(time()), 0,10).'.'.$file_ext;
			$uploaded_image = "uploads/".$unique_image;

			if($product_code =="" || $productName == "" || $productQuantity == "" || $category == "" || $brand == "" || $product_desc == "" || $price == "" || $type == "" || $file_name == ""){
				$alert = "<span class='error'>Không được để trống</span>";
				return $alert;
			}else{
				move_uploaded_file($file_temp, $uploaded_image);

				$query = "INSERT INTO tbl_product(productName,product_code,product_remain,productQuantity,catId,brandId,product_desc,price,type,image) VALUES('$productName','$product_code','$productQuantity','$productQuantity','$category','$brand','$product_desc','$price','$type','$unique_image') ";
				$result = $this->db->insert($query);
				if($result){
					$alert = "<span class='success'>Thêm sản phầm thành công</span>";
					return $alert;
				}else {
					$alert = "<span class='error'>Thêm sản phẩm thất bại</span>";
					return $alert;
				}
			}
		}
		public function insert_slider($data,$files)
		{
			$sliderName = mysqli_real_escape_string($this->db->link, $data['sliderName']);
			$type = mysqli_real_escape_string($this->db->link, $data['type']);
			 //mysqli gọi 2 biến. (catName and link) biến link -> gọi conect db từ file db
			
			// kiểm tra hình ảnh và lấy hình ảnh cho vào folder upload
			$permited  = array('jpg', 'jpeg', 'png', 'gif');

			$file_name = $_FILES['image']['name'];
			$file_size = $_FILES['image']['size'];
			$file_temp = $_FILES['image']['tmp_name'];

			$div = explode('.', $file_name);
			$file_ext = strtolower(end($div));
			// $file_current = strtolower(current($div));
			$unique_image = substr(md5(time()), 0, 10).'.'.$file_ext;
			$uploaded_image = "uploads/".$unique_image;


			if($sliderName=="" || $type==""){
				$alert = "<span class='error'>Không được để tr</span>";
				return $alert; 
			}else{
				if(!empty($file_name)){
					//Nếu người dùng chọn ảnh
					if ($file_size > 2048000) {

		    		 $alert = "<span class='success'>Dung lương ảnh phải dưới 2MB !</span>";
					return $alert;
				    } 
					elseif (in_array($file_ext, $permited) === false) 
					{
				     // echo "<span class='error'>You can upload only:-".implode(', ', $permited)."</span>";	
				    $alert = "<span class='success'>Bạn chỉ có thể đăng:-".implode(', ', $permited)."</span>";
					return $alert;
					}
					move_uploaded_file($file_temp,$uploaded_image);
					
					$query = "INSERT INTO tbl_slider(sliderName,type,slider_image) VALUES('$sliderName','$type','$unique_image') ";
					$result = $this->db->insert($query);
					if($result){
						$alert = "<span class='success'>Thêm Slider thành công</span>";
						return $alert;
					}else {
						$alert = "<span class='error'Thêm slider thất bại</span>";
						return $alert;
					}
				}
				
				
			}

		}
		public function show_slider(){
			$query = "SELECT * FROM tbl_slider where type='1' order by sliderId desc";
			$result = $this->db->select($query);
			return $result;
		}
		public function show_slider_list(){
			$query = "SELECT * FROM tbl_slider order by sliderId desc";
			$result = $this->db->select($query);
			return $result;
		}
		public function show_product_warehouse(){
			$query = 
			"SELECT tbl_product.*, tbl_warehouse.*

			 FROM tbl_product INNER JOIN tbl_warehouse ON tbl_product.productId = tbl_warehouse.productId
								
			 order by tbl_warehouse.sl_ngaynhap desc ";

		
			$result = $this->db->select($query);
			return $result;
		}
        public function importstatements($id){
			$query = 
			"SELECT product_code,productName,SUM(sl_nhap) as sl_nhap ,unit_price
			 FROM tbl_product INNER JOIN tbl_warehouse ON tbl_product.productId = tbl_warehouse.productId WHERE YEAR(tbl_warehouse.sl_ngaynhap)=YEAR(Now()) and MONTH(tbl_warehouse.sl_ngaynhap)='$id' GROUP by product_code  							
			 order by tbl_warehouse.sl_ngaynhap desc";

		
			$result = $this->db->select($query);
			return $result;
		}
        
		public function show_product()
		{
			$query = 
			"SELECT tbl_product.*, tbl_category.catName, tbl_brand.brandName

			 FROM tbl_product INNER JOIN tbl_category ON tbl_product.catId = tbl_category.catId
								INNER JOIN tbl_brand ON tbl_product.brandId = tbl_brand.brandId
			 order by tbl_product.productId desc ";

			// $query = "SELECT * FROM tbl_product order by productId desc ";
			$result = $this->db->select($query);
			return $result;
		}
		public function update_type_slider($id,$type){

			$type = mysqli_real_escape_string($this->db->link, $type);
			$query = "UPDATE tbl_slider SET type = '$type' where sliderId='$id'";
			$result = $this->db->update($query);
			return $result;
		}
		public function del_slider($id)
		{
			$query = "DELETE FROM tbl_slider where sliderId = '$id' ";
			$result = $this->db->delete($query);
			if($result){
				$alert = "<span class='success'>Xóa Slider thành công</span>";
				return $alert;
			}else {
				$alert = "<span class='success'>Xóa Slider thất bại</span>";
				return $alert;
			}
		}
		public function update_quantity_product($data,$files,$id){
			$product_more_quantity = mysqli_real_escape_string($this->db->link, $data['product_more_quantity']);
			$product_remain = mysqli_real_escape_string($this->db->link, $data['product_remain']);
			$unit_price=mysqli_real_escape_string($this->db->link, $data['unit_price']);
			if($product_more_quantity == ""){

				$alert = "<span class='error'>Không được để trống</span>";
				return $alert; 
			}else{
					$qty_total = $product_more_quantity + $product_remain;
					//Nếu người dùng không chọn ảnh
					$query = "UPDATE tbl_product SET
					
					product_remain = '$qty_total'

					WHERE productId = '$id'";
					
					}
					$query_warehouse = "INSERT INTO tbl_warehouse(productId,sl_nhap,unit_price) VALUES('$id','$product_more_quantity','$unit_price') ";
					$result_insert = $this->db->insert($query_warehouse);
					$result = $this->db->update($query);

					if($result){
						$alert = "<span class='success'>Thêm số lượng thành công</span>";
						return $alert;
					}else{
						$alert = "<span class='error'>Thêm số lượng không thành công</span>";
						return $alert;
					}
				
		}
		public function update_product($data,$files,$id){
	
			$productName = mysqli_real_escape_string($this->db->link, $data['productName']);
			$product_code = mysqli_real_escape_string($this->db->link, $data['product_code']);
			$productQuantity = mysqli_real_escape_string($this->db->link, $data['productQuantity']);
			$brand = mysqli_real_escape_string($this->db->link, $data['brand']);
			$category = mysqli_real_escape_string($this->db->link, $data['category']);
			$product_desc = mysqli_real_escape_string($this->db->link, $data['product_desc']);
			$price = mysqli_real_escape_string($this->db->link, $data['price']);
			$type = mysqli_real_escape_string($this->db->link, $data['type']);
			//Kiem tra hình ảnh và lấy hình ảnh cho vào folder upload
			$permited  = array('jpg', 'jpeg', 'png', 'gif');

			$file_name = $_FILES['image']['name'];
			$file_size = $_FILES['image']['size'];
			$file_temp = $_FILES['image']['tmp_name'];

			$div = explode('.', $file_name);
			$file_ext = strtolower(end($div));
			// $file_current = strtolower(current($div));
			$unique_image = substr(md5(time()), 0, 10).'.'.$file_ext;
			$uploaded_image = "uploads/".$unique_image;


			if($product_code == "" || $productName=="" || $productQuantity=="" || $brand=="" || $category=="" || $product_desc=="" || $price=="" || $type==""){
				$alert = "<span class='error'>Không được để trống</span>";
				return $alert; 
			}else{
				if(!empty($file_name)){
					//Nếu người dùng chọn ảnh
					if ($file_size > 20480) {

		    		 $alert = "<span class='success'>Dung lượng ảnh phải dưới 2MB !</span>";
					return $alert;
				    } 
					elseif (in_array($file_ext, $permited) === false) 
					{
				     // echo "<span class='error'>You can upload only:-".implode(', ', $permited)."</span>";	
				    $alert = "<span class='success'>Bạn chỉ có thể đăng:-".implode(', ', $permited)."</span>";
					return $alert;
					}
					move_uploaded_file($file_temp,$uploaded_image);
					$query = "UPDATE tbl_product SET
					productName = '$productName',
					product_code = '$product_code',
					productQuantity = '$productQuantity',
					brandId = '$brand',
					catId = '$category', 
					type = '$type', 
					price = '$price', 
					image = '$unique_image',
					product_desc = '$product_desc'
					WHERE productId = '$id'";
					
				}else{
					//Nếu người dùng không chọn ảnh
					$query = "UPDATE tbl_product SET

					productName = '$productName',
					product_code = '$product_code',
					productQuantity = '$productQuantity',
					brandId = '$brand',
					catId = '$category', 
					type = '$type', 
					price = '$price', 
					
					product_desc = '$product_desc'

					WHERE productId = '$id'";
					
				}
				$result = $this->db->update($query);
					if($result){
						$alert = "<span class='success'>Sản phẩm được cập nhật thành công</span>";
						return $alert;
					}else{
						$alert = "<span class='error'>Sản phẩm được cập nhật thất bại</span>";
						return $alert;
					}
				
			}

		}
		public function del_product($id)
		{
			$query = "DELETE FROM tbl_product where productId = '$id' ";
			$result = $this->db->delete($query);
			if($result){
				$alert = "<span class='success'>Sản phẩm được xóa thành công</span>";
				return $alert;
			}else {
				$alert = "<span class='success'>Sản phẩm được xóa thất bại</span>";
				return $alert;
			}
		}
		public function del_wlist($proid,$customer_id)
		{
			$query = "DELETE FROM tbl_wishlist where productId = '$proid' AND customer_id='$customer_id' ";
			$result = $this->db->delete($query);
			return $result;
		}
		public function getproductbyId($id)
		{
			$query = "SELECT * FROM tbl_product where productId = '$id' ";
			$result = $this->db->select($query);
			return $result;
		}		
		//Kết thúc Backend

		public function getproduct_featheread()
		{
            $sp_tungtrang=8;
             if(!isset($_GET['page']))
            {
                $page=1;
            }
            else
            {
                $page=$_GET['page'];
            }
            $tung_trang=($page-1)*$sp_tungtrang;
			$query = "SELECT * FROM tbl_product where type = '1' order by productId desc LIMIT $tung_trang,$sp_tungtrang ";
			$result = $this->db->select($query);
			return $result;
		}
		public function getproduct_new()
		{
            $sp_tungtrang=8;
             if(!isset($_GET['page']))
            {
                $page=1;
            }
            else
            {
                $page=$_GET['page'];
            }
            $tung_trang=($page-1)*$sp_tungtrang;
			$query = "SELECT * FROM tbl_product order by productId desc LIMIT $tung_trang,$sp_tungtrang ";
			$result = $this->db->select($query);
			return $result;
		}
        public function get_all_product()
		{
           
			$query = "SELECT * FROM tbl_product";
			$result = $this->db->select($query);
			return $result;
		}
		public function get_details($id)
		{
			$query = 
			"SELECT tbl_product.*, tbl_category.catName, tbl_brand.brandName

			 FROM tbl_product INNER JOIN tbl_category ON tbl_product.catId = tbl_category.catId
								INNER JOIN tbl_brand ON tbl_product.brandId = tbl_brand.brandId
			 WHERE tbl_product.productId = '$id'
			 ";

			$result = $this->db->select($query);
			return $result;
		}
		public function allproduct($catId)
		{
			$sp_tungtrang=4;
			if(!isset($_GET['page']))
		   {
			   $page=1;
		   }
		   else
		   {
			   $page=$_GET['page'];
		   }
		   $tung_trang=($page-1)*$sp_tungtrang;
		   $query = "SELECT * FROM `tbl_product` WHERE tbl_product.catId='$catId' order by productId desc LIMIT $tung_trang,$sp_tungtrang ";
		$result=$this->db->select($query);
		return $result;
		}
		public function topBrand($brandId)
		{
			$sp_tungtrang=4;
			if(!isset($_GET['page']))
		   {
			   $page=1;
		   }
		   else
		   {
			   $page=$_GET['page'];
		   }
		   $tung_trang=($page-1)*$sp_tungtrang;
			$query="SELECT * FROM `tbl_product` WHERE brandId='$brandId' LIMIT $tung_trang,$sp_tungtrang";
		$result=$this->db->select($query);
		return $result;
		}
		public function get_compare($customer_id)
		{
			$query = "SELECT * FROM tbl_compare where customer_id = '$customer_id' order by id desc";
			$result = $this->db->select($query);
			return $result;	
		}
		public function get_wishlist($customer_id)
		{
			$query = "SELECT * FROM tbl_wishlist where customer_id = '$customer_id' order by id desc";
			$result = $this->db->select($query);
			return $result;
		}
		public function insertCompare($productid, $customer_id)
		{
			$productid = mysqli_real_escape_string($this->db->link, $productid);
			$customer_id = mysqli_real_escape_string($this->db->link, $customer_id);
			
			$check_compare = "SELECT * FROM tbl_compare WHERE productId = '$productid' AND customer_id ='$customer_id'";
			$result_check_compare = $this->db->select($check_compare);

			if($result_check_compare){
				$msg = "<span class='error'>Sản phẩm đã được thêm vào so sánh</span>";
				return $msg;
			}else{

			$query = "SELECT * FROM tbl_product WHERE productId = '$productid'";
			$result = $this->db->select($query)->fetch_assoc();
			
			$productName = $result["productName"];
			$price = $result["price"];
			$image = $result["image"];

			
			
			$query_insert = "INSERT INTO tbl_compare(productId,price,image,customer_id,productName) VALUES('$productid','$price','$image','$customer_id','$productName')";
			$insert_compare = $this->db->insert($query_insert);

			if($insert_compare){
						$alert = "<span class='success'>Thêm sản phẩm vào so sánh thành công</span>";
						return $alert;
					}else{
						$alert = "<span class='error'>Thêm sản phẩm vào so sánh thất bại</span>";
						return $alert;
					}
			}

		}
		public function insertWishlist($productid, $customer_id)
		{
			$productid = mysqli_real_escape_string($this->db->link, $productid);
			$customer_id = mysqli_real_escape_string($this->db->link, $customer_id);
			
			$check_wlist = "SELECT * FROM tbl_wishlist WHERE productId = '$productid' AND customer_id ='$customer_id'";
			$result_check_wlist = $this->db->select($check_wlist);

			if($result_check_wlist){
				$msg = "<span class='error'>Thêm sản phẩm vào yêu thích thất bại</span>";
				return $msg;
			}else{

			$query = "SELECT * FROM tbl_product WHERE productId = '$productid'";
			$result = $this->db->select($query)->fetch_assoc();
			
			$productName = $result["productName"];
			$price = $result["price"];
			$image = $result["image"];

			
			
			$query_insert = "INSERT INTO tbl_wishlist(productId,price,image,customer_id,productName) VALUES('$productid','$price','$image','$customer_id','$productName')";
			$insert_wlist = $this->db->insert($query_insert);

			if($insert_wlist){
						$alert = "<span class='success'>Thêm sản phẩm vào yêu thích thành công</span>";
						return $alert;
					}else{
						$alert = "<span class='error'>Thêm sản phẩm vào yêu thích thất bại</span>";
						return $alert;
					}
			}
		}
		public function getproductbycat($catId)
		{
			$query = "SELECT COUNT(*) FROM tbl_product where catId='$catId'";
			$result = $this->db->select($query);
			return $result;
		}
		public function getproductbybrand($brandId)
		{
			$query = "SELECT COUNT(*) FROM tbl_product where brandId='$brandId'";
			$result = $this->db->select($query);
			return $result;
		}
		
		public function product_by_search($value){
			$query = "select DISTINCT COUNT(*) from tbl_brand, tbl_product, tbl_category WHERE tbl_brand.brandId=tbl_product.brandId and tbl_category.catId = tbl_product.catId AND(tbl_product.productName like N'%$value%' OR tbl_brand.brandName like N'%$value%' OR tbl_category.catName like N'%$value%')";
			$result = $this->db->select($query);
			return $result;
		}
		public function show_product_by_search($value){
			$sp_tungtrang=16;
			if(!isset($_GET['page']))
		   {
			   $page=1;
		   }
		   else
		   {
			   $page=$_GET['page'];
		   }
		   $tung_trang=($page-1)*$sp_tungtrang;
			$query = "select DISTINCT *from tbl_brand, tbl_product, tbl_category WHERE tbl_brand.brandId=tbl_product.brandId and tbl_category.catId = tbl_product.catId AND(tbl_product.productName like N'%$value%' OR tbl_brand.brandName like N'%$value%' OR tbl_category.catName like N'%$value%' ) LIMIT $tung_trang,$sp_tungtrang";
			$result = $this->db->select($query);
			return $result;
		}
        public function show_promotion(){
			$query = "SELECT * FROM `tbl_promotion`";
			$result = $this->db->select($query);
			return $result;
		}
        public function insert_promotion($data){
			
			$productId = mysqli_real_escape_string($this->db->link, $data['productId']);
			$PromotionPrice = mysqli_real_escape_string($this->db->link, $data['PromotionPrice']);

			$expiredTimeout = mysqli_real_escape_string($this->db->link, $data['expiredTimeout']);
			

			if($productId =="" || $PromotionPrice == "" || $expiredTimeout == "" ){
				$alert = "<span class='error'>Không được để trống</span>";
				return $alert;
			}else{
				
				$query = "INSERT INTO tbl_promotion(productId,PromotionPrice,expiredTimeout) VALUES('$productId','$PromotionPrice','$expiredTimeout') ";
				$result = $this->db->insert($query);
				if($result){
					$alert = "<span class='success'>Thêm khuyến mãi thành công</span>";
					return $alert;
				}else {
					$alert = "<span class='error'>Thêm khuyến mãi thất bại</span>";
					return $alert;
				}
			}
		}
        public function del_promotion($id)
		{
			$query = "DELETE FROM `tbl_promotion` where promotionId = '$id'";
			$result = $this->db->delete($query);
			if($result){
					$alert = "<span class='success'>Xóa khuyến mãi thành công</span>";
					return $alert;
				}else {
					$alert = "<span class='error'>Xóa khuyến mãi thất bại</span>";
					return $alert;
				}
		}
        public function get_promotion($id)
        {
            $query = "SELECT * FROM tbl_promotion WHERE productId='$id' AND expiredTimeout>Now() ORDER BY PromotionDate DESC LIMIT 1";
			$result = $this->db->select($query);
            return $result;
        }
		public function update_qty_product($id,$qty)
        {
            $query = "UPDATE tbl_product SET product_soldout=product_soldout+'$qty' ,product_remain=product_remain-'$qty' WHERE productId='$id'";
			$result = $this->db->update($query);
            return $result;
        }
	}
 ?>