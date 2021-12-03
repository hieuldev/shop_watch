
<?php 
	include 'inc/header.php';
	// include 'inc/slider.php';
 ?>
 <?php 
	$login_check = Session::get('customer_login');
	if ($login_check) {
		header('Location:index.php'); 
	}
?>

<?php
    // gọi class category
     
    if($_SERVER['REQUEST_METHOD'] == 'POST' && isset($_POST['submit'])){
        // LẤY DỮ LIỆU TỪ PHƯƠNG THỨC Ở FORM POST
        $insertCustomer = $cs -> insert_customer($_POST);
    }
 ?>
 <?php 
 	if($_SERVER['REQUEST_METHOD'] == 'POST' && isset($_POST['login'])){
        // LẤY DỮ LIỆU TỪ PHƯƠNG THỨC Ở FORM POST
        $login_Customer = $cs -> login_customer($_POST);
    }
 ?>
 <div class="main">
    <div class="content">
    	 <div class="login_panel">
        	<h3>Khách hàng đã có tài khoản</h3>
        	<p>Hãy đăng nhập vào mẫu dưới đây.</p>
             <?php
            if(isset($login_Customer))
            {
                echo $login_Customer;
            }
            ?>
        	<form action="" method="post" id="member">
                	<input type="text" name="email" class="field" placeholder="Nhập Email...">
                    <input type="password" name="password" class="field" placeholder="Nhập mật khẩu...">
                 
                 <p class="note">Nếu bạn quên mật khẩu hãy điền email và click  <a href="#">vào đây</a></p>
                    <div class="buttons"><div><input type="submit" class="grey" name="login" value="Đăng nhập"></div></div>
                </form>
                    </div>
    	<div class="register_account">
    		<h3>Đăng ký tài khoản mới</h3>
            <?php
            if(isset($insertcustommer))
            {
                echo $insertcustommer;
            }
            ?>
    		<form action="" method="post">
		   			 <table>
		   				<tbody>
						<tr>
						<td>
							<div>
							<input type="text" name="name" placeholder="Tên người dùng...">
							</div>
							
							<div>
							    <input type="text" name="password" placeholder="Mật khẩu...">
							</div>
							
							<div>
                                <input type="text" name="phone" placeholder="Điện thoại..."> 
								
							</div>
							<div>
								<input type="text" name="email" placeholder="Email...">
							</div>
		    			 </td>
		    			<td>
						<div>
							<input type="text" name="address" placeholder="Địa chỉ">
						</div>
		    		<div>
						  <input type="text" name="city" placeholder="Thành phố... ">
				 </div>		        
	
		           <div>
                      
		         <select id="country" name="country" onchange="change_country(this.value)" class="frm-field required">
							<option value="null">Lựa chọn quốc gia</option>         
							<option value="Vn">Việt Nam</option>
							
		         </select>
		          </div>
				  
				  <div>
					<input type="text" name="zipcode" placeholder="Mã bưu điện...">
				</div>
		    	</td>
		    </tr> 
		    </tbody></table> 
		   <div class="search"><div><input type="submit" name="submit" class="grey" value="Tạo tài khoản"></div></div>
		    <p class="terms">Bằng việc ấn vào nút 'Tạo tài khoản' bạn đã chấp nhận những <a href="rules.php">Điều kiện &amp; Điều khoản</a>.</p>
		    <div class="clear"></div>
		    </form>
    	</div>  	
       <div class="clear"></div>
    </div>
 </div>
<?php
include "inc/footer.php";

?>