<?php

	$filepath = realpath(dirname(__FILE__));
	include_once ($filepath.'/../lib/database.php');
	include_once ($filepath.'/../helpers/format.php');
?>
<?php
class password{
    private $db;
    private $fm;
    public function __construct()
    {
      $this->db=new Database();
      $this->fm=new Format();  
    }
public function updatePass($data){
 $oldpass=md5(mysqli_real_escape_string($this->db->link,$data['oldpass']));
 $newpass=md5(mysqli_real_escape_string($this->db->link,$data['newpass']));
 if($oldpass==""||$newpass=="")
 {
    $alert = "<span class='error'>Không được để trống </span>";
    return $alert;  
 }
 else{
 $query="select *from tbl_admin where adminPass='$oldpass'";
 $result=$this->db->select($query);
 if($result)
 {
 $query="update tbl_admin set adminPass='$newpass'";
 $result=$this->db->update($query);
 if($result)
 {
    $alert = "<span class='success'>Đổi mật khẩu thành công</span>";
    return $alert;
 }
 else
 {
    $alert = "<span class='error'>Đổi mật khẩu thất bại</span>";
    return $alert;
 }
}
else
{
    $alert = "<span class='error'>Mật khẩu cũ không đúng</span>";
    return $alert;
}
}}
public function updateUserPass($data,$id){
   $oldpass=mysqli_real_escape_string($this->db->link,$data['oldpass']);
   $newpass=mysqli_real_escape_string($this->db->link,$data['newpass']);
   if($oldpass==""||$newpass=="")
   {
      $alert = "<span class='error'>Không được để trống </span>";
      return $alert;  
   }
   else{
   $oldpass=md5($oldpass);
   $newpass=md5($newpass);
   $query="select *from tbl_customer where password='$oldpass' and customer_id='$id'";
   $result=$this->db->select($query);
   if($result)
   {
   $query="update tbl_customer set password='$newpass' where customer_id='$id'";
   $result=$this->db->update($query);
   if($result)
   {
      $alert = "<span class='success'>Đổi mật khẩu thành công</span>";
      return $alert;
   }
   else
   {
      $alert = "<span class='error'>Đổi mật khẩu thất bại</span>";
      return $alert;
   }
  }
  else
  {
      $alert = "<span class='error'>Mật khẩu cũ không đúng</span>";
      return $alert;
  }
  }}
}
?>