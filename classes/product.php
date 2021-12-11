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
		private $dbWarehose;
		private $dbSlider;
		private $dbPromotion;
		private $fm;
		public function __construct()
		{
			$database=new Database();
            $this->db=$database->data->tbl_product;
			$this->dbWarehose=$database->data->tbl_warehouse;
			$this->dbSlider=$database->data->tbl_slider;
			$this->dbPromotion=$database->data->tbl_promotion;
			$this->fm = new Format();
		}

		public function insert_product($data,$files){
			
			$productName = $this->fm->validation( $data['productName']);
			$product_code = $this->fm->validation( $data['product_code']);

			$productQuantity = $this->fm->validation($data['productQuantity']);
			$category = $this->fm->validation( $data['category']);
			$brand = $this->fm->validation( $data['brand']);
			$product_desc = $this->fm->validation( $data['product_desc']);
			$price = $this->fm->validation( $data['price']);
			$type = $this->fm->validation( $data['type']);
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
				$result = $this->db->insertOne(['productName'=>$productName,'product_code'=>$product_code,'product_remain'=>$productQuantity,'productQuantity'=>$productQuantity,'product_soldout'=>'0','cat'=>$category,'brand'=>$brand,'product_desc'=>$product_desc,'price'=>$price,'type'=>$type,'image'=>$unique_image]);
				if($result){
					$alert = "<span class='success'>Thêm sản phẩm thành công</span>";
					return $alert;
				}else {
					$alert = "<span class='error'>Thêm sản phẩm thất bại</span>";
					return $alert;
				}
			}
		}
		public function insert_slider($data,$files)
		{
			$sliderName = $this->fm->validation( $data['sliderName']);
			$type = $this->fm->validation( $data['type']);
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
				$alert = "<span class='error'>Không được để trống</span>";
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
					$result =$this->dbSlider->insertOne(['sliderName'=>$sliderName,'type'=>$type,'slider_image'=>$unique_image]);
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
			$result = $this->dbSlider->find();
			return $result;
		}
		public function show_product_warehouse(){
			$result = $this->dbWarehose->find();
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
			$result = $this->db->find();
			return $result;
		}
		public function update_type_slider($id,$type){

			$type = $this->fm->validation( $type);
			$result = $this->dbSlider->updateOne(['_id'=>new MongoDB\BSON\ObjectId($id)],['$set'=>['type'=>$type]]);
			return $result;
		}
		public function del_slider($id)
		{
			$result = $this->dbSlider->deleteOne(['_id'=>new MongoDB\BSON\ObjectId($id)]);
			if($result){
				$alert = "<span class='success'>Xóa Slider thành công</span>";
				return $alert;
			}else {
				$alert = "<span class='success'>Xóa Slider thất bại</span>";
				return $alert;
			}
		}
		public function update_quantity_product($data,$id){
			$product = $this->fm->validation( $data['productName']);
			$product_code = $this->fm->validation( $data['product_code']);
			$product_more_quantity = $this->fm->validation( $data['product_more_quantity']);
			$product_remain = $this->fm->validation( $data['product_remain']);
			$unit_price=$this->fm->validation( $data['unit_price']);
			if($product_more_quantity == ""){

				$alert = "<span class='error'>Không được để trống</span>";
				return $alert; 
			}else{
					$qty_total = $product_more_quantity + $product_remain;
					$result = $this->db->updateOne(['_id'=>new MongoDB\BSON\ObjectId($id)],['$set'=>['product_remain'=>$qty_total]]);
					}
					$result =$this->dbWarehose->insertOne(['product'=>$product,'product_code'=>$product_code,'product_remain'=>$product_remain,'import_quantity'=>$product_more_quantity,'unit_price'=>$unit_price,'createTime'=>date("Y-m-d H:i:s")]);

					if($result){
						$alert = "<span class='success'>Thêm số lượng thành công</span>";
						return $alert;
					}else{
						$alert = "<span class='error'>Thêm số lượng không thành công</span>";
						return $alert;
					}
				
		}
		public function update_product($data,$files,$id){
	
			$productName = $this->fm->validation( $data['productName']);
			$product_code = $this->fm->validation( $data['product_code']);
			$productQuantity = $this->fm->validation( $data['productQuantity']);
			$brand = $this->fm->validation( $data['brand']);
			$category = $this->fm->validation( $data['category']);
			$product_desc = $this->fm->validation( $data['product_desc']);
			$price = $this->fm->validation( $data['price']);
			$type = $this->fm->validation( $data['type']);
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
					$result = $this->db->updateOne(['_id'=>new MongoDB\BSON\ObjectId($id)],['$set'=>['productName'=>$productName,'product_code'=>$product_code,'product_remain'=>$productQuantity,'productQuantity'=>$productQuantity,'product_soldout'=>'0','cat'=>$category,'brand'=>$brand,'product_desc'=>$product_desc,'price'=>$price,'type'=>$type,'image'=>$unique_image]]);
					if($result){
						$alert = "<span class='success'>Sản phẩm được cập nhật thành công</span>";
						return $alert;
					}else{
						$alert = "<span class='error'>Sản phẩm được cập nhật thất bại</span>";
						return $alert;
					}
				}else{
					//Nếu người dùng không chọn ảnh
					$result = $this->db->updateOne(['_id'=>new MongoDB\BSON\ObjectId($id)],['$set'=>['productName'=>$productName,'product_code'=>$product_code,'product_remain'=>$productQuantity,'productQuantity'=>$productQuantity,'product_soldout'=>'0','cat'=>$category,'brand'=>$brand,'product_desc'=>$product_desc,'price'=>$price,'type'=>$type]]);
					if($result){
						$alert = "<span class='success'>Sản phẩm được cập nhật thành công</span>";
						return $alert;
					}else{
						$alert = "<span class='error'>Sản phẩm được cập nhật thất bại</span>";
						return $alert;
					}
				}
			}

		}
		public function del_product($id)
		{
			$result = $this->db->deleteOne(['_id'=>new MongoDB\BSON\ObjectId($id)]);
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
			$result = $this->db->findOne(['_id'=>new MongoDB\BSON\ObjectId($id)]);
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
			$productid = $this->fm->validation( $productid);
			$customer_id = $this->fm->validation( $customer_id);
			
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
			$productid = $this->fm->validation( $productid);
			$customer_id = $this->fm->validation( $customer_id);
			
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
			$result = $this->dbPromotion->find();
			return $result;
		}
        public function insert_promotion($data){
			
			$product = $this->fm->validation( $data['product']);
			$PromotionPrice = $this->fm->validation( $data['PromotionPrice']);
			$promotionDate = $this->fm->validation( $data['PromotionDate']);
			$expiredTimeout = $this->fm->validation( $data['expiredTimeout']);
			

			if($product =="" || $PromotionPrice == "" || $expiredTimeout == "" ){
				$alert = "<span class='error'>Không được để trống</span>";
				return $alert;
			}
			else if($expiredTimeout<$promotionDate ){
				$alert = "<span class='error'>Ngày bắt đầu không được lớn hơn ngày kết thúc</span>";
				return $alert;
			}
			else{
				$result =$this->dbPromotion->insertOne(['product'=>$product,'PromotionPrice'=>$PromotionPrice,'PromotionDate'=>$promotionDate,'expiredTimeout'=>$expiredTimeout]);
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
			$result = $this->dbPromotion->deleteOne(['_id'=>new MongoDB\BSON\ObjectId($id)]);
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