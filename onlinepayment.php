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
<form action="" method="Get">
	<div class="main">
		<div class="content">
			<div class="section group">
				<div class="heading">
					<h3>Thanh toán online</h3>
					
					<?php if((isset($_GET['cardnumber'])&&$_GET['cardnumber']=='')||(isset($_GET['name'])&&$_GET['name']=='')||(isset($_GET['date'])&&$_GET['date']=='')||(isset($_GET['code'])&&$_GET['code']=='')||(isset($_GET['bank'])&&$_GET['bank']=='null')||(isset($_GET['pass'])&&$_GET['pass']==''))
					{
						echo '<span style="text-align: center;" class="error">Không được để trống</span>';
					}
					?>
					
					<div class="onlinepayment">
						
					<form>

							Thanh toán bằng thẻ quốc tế Visa,Master,JBC <span><a href="?Card=QT" class="luachon">Chọn</a></span><br>
							<?php if(isset($_GET['Card'])&&$_GET['Card']=='QT') 
							echo'<br><div class="Card">
							<form action="" method="">
								
								Nhập thẻ thanh toán<br><br>

								Số thẻ:<br>
								<input type="text" name="cardnumber" placeholder="VD:0000 0000 0000 0000"><br>
								Tên in trên thẻ:<br>
								<input type="text" name="name" placeholder="VD:NGUYEN VAN A"><br>
								Ngày hết hạn:<br>
								<input type="text" name="date" placeholder="mm/yyyy"><br>
								Mã bảo mật:<br>
								<input type="text" name="code" placeholder="VD:123"><br>

							</form>
</div>'
?>

<br><br>
							Thẻ ATM nội địa/Internet Banking <span><a href="?Card=ND" class="luachon">Chọn</a></span><br>
							<?php if(isset($_GET['Card'])&&$_GET['Card']=='ND') 
							echo'<br><div class="Card">
							<form action="" method="">
								
								Nhập thẻ thanh toán<br><br>

								<select name="bank" id="">
								<option value="null">Lựa chọn ngân hàng</option>         
								<option value="ACB">Ngân hàng Á Châu</option>
								<option value="DongABank">Ngân hàng Đông Á</option>
								<option value="BacABank">Ngân hàng Bắc Á</option>
								<option value="NamABank">Ngân hàng Nam Á</option>
								<option value="VIB">Ngân hàng quốc tế</option>
								<option value="SCB">Ngân hàng Sài Gòn</option>
								<option value="VietABank">Ngân hàng Việt Á</option>
								<option value="BIDV">Ngân hàng Đầu tư và Phát triển Việt Nam</option>
								</select>
								<br>
								<br>
								Tên tài khoản:<br>
								<input type="text" name="name" placeholder="VD:NGUYEN VAN A"><br>
								Mật khẩu:<br>
								<input type="password" name="pass" placeholder="Mật khẩu"><br>
								Mã xác nhận:<br>
								<input type="text" name="code" placeholder="VD:123"><br>

							</form>
</div>'?>

						</form>
					</div>
				</div>
</select>


			</div>
		</div>
		<a style="background:gray" href="payment.php">Quay lại</a>
		<?php if(isset($_GET['Card'])){
		echo'<center style="padding-bottom: 20px;"><input type="submit" value="Tiếp tục" class="a_order"></center>';}?>
		<?php if((!empty($_GET['cardnumber'])&&!empty($_GET['name'])&&!empty($_GET['date'])&&!empty($_GET['code'])||(!empty($_GET['name'])&&!empty($_GET['pass'])&&!empty($_GET['code'])&&$_GET['bank']!='null')))
		{
			header('Location:offlinepayment.php?online=true');
		}
		?>
	
	</div>
</form>
<?php
include 'inc/footer.php';
?>