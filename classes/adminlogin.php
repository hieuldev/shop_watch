<?php
	$filepath = realpath(dirname(__FILE__));
	include ($filepath.'/../lib/session.php');
	Session::checkLogin(); // gọi hàm check login để ktra session
	include_once($filepath.'/../lib/database.php');
	include_once($filepath.'/../helpers/format.php');
?>



<?php 
	/**
	* 
	*/
	class adminlogin
	{
		private $db;
		private $fm;
		public function __construct()
		{
			$database=new Database();
            $this->db=$database->data->tbl_admin;
			$this->fm = new Format();
		}
		public function longin_admin($adminUser,$adminPass){
			$adminUser = $this->fm->validation($adminUser); //gọi ham validation từ file Format để ktra
			$adminPass = md5($this->fm->validation($adminPass));

			if(empty($adminUser) || empty($adminPass)){
				$alert = "User và Pass không nhập rỗng";
				return $alert;
			}else{
				//$query = "SELECT * FROM tbl_admin WHERE adminUser = '$adminUser' AND adminPass = '$adminPass' LIMIT 1 ";
				$result = $this->db->findOne(['adminUser'=>$adminUser,'adminPass'=>$adminPass]);

				if($result != false){
					Session::set('adminlogin', true); // set adminlogin đã tồn tại
					// gọi function Checklogin để kiểm tra true.
					Session::set('adminId', $result['_id']);
					Session::set('adminUser', $result['adminUser']);
					Session::set('adminName', $result['adminName']);
                    Session::set('RankId', $result['RankId']);
					header("Location:index.php");
				}else {
					$alert = "User và Pass không đúng";
					return $alert;
				}
			}
         

		}
        
	}
 ?>