<?php 
	include 'inc/header.php';
	// include 'inc/slider.php';
 ?>
 <?php 
	  $login_check = Session::get('customer_login');
	  if ($login_check==false) {
	  	header('Location:login.php');
	  }
	   ?>
<?php if($_SERVER['REQUEST_METHOD']=='POST' && isset($_POST['submit']))
{
    $id=Session::get('customer_id');
    $changepass=$pw->updateUserPass($_POST,$id); 
}
 ?>
 <div class="main">
    <div class="content">
    	<div class="section group">
    		<div class="content_top">
    		<div class="heading">
    		<h3>Đổi mật khẩu</h3>
    		</div>
    		<div class="clear"></div>
        </div>
        <?php 
        if(isset($changepass))
        {
            echo $changepass;
        }
        ?>
        <form action="" method="post">
    	<table class="tblone">
    		
        <tr>
                    <td>
                        <label>Mật khẩu cũ</label>
                    </td>
                    <td>
                        <input type="password" placeholder="Nhập mật khẩu cũ..."  name="oldpass" class="medium" />
                    </td>
                </tr>
				 <tr>
                    <td>
                        <label>Mật khẩu mới</label>
                    </td>
                    <td>
                        <input type="password" placeholder="Nhập mật khẩu mới..." name="newpass" class="medium" />
                    </td>
                </tr>
				 
				
				 <tr>
                    <td>
                    </td>
                    <td>
                        <input type="submit" name="submit" Value="Update" />
                    </td>
                </tr>
                </table>
            </form>
    		
<?php 
	include 'inc/footer.php';
 ?>

<?php 
	include 'inc/header.php';
	// include 'inc/slider.php';
 ?>
 