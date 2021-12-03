</div>
   <div class="footer">
   	  <div class="wrapper">	
	     <div class="section group">
				<div class="col_1_of_4 span_1_of_4">
						<h4>Thông tin</h4>
						<ul>
						<li><a href="aboutus.php">Về chúng tôi</a></li>
						<li><a href="services.php">Dịch vụ</a></li>
						<li><a href="contact.php"><span>Liên hệ</span></a></li>
						</ul>
					</div>
				<div class="col_1_of_4 span_1_of_4">
					<h4>Tại sao bạn nên chọn chúng tôi</h4>
						<ul>
						<li><a href="aboutus.php">Về chúng tôi</a></li>
						<li><a href="services.php">Dịch vụ</a></li>
						<li><a href="policy.php"><span>Chính sách</span></a></li>
						
						</ul>
				</div>
				<div class="col_1_of_4 span_1_of_4">
					<h4>Giỏ hàng của tôi</h4>
						<ul>
						 <?php 
	  $login_check = Session::get('customer_login');
	  if($login_check){
	  	echo '';
      }
                            else
                            {
                                echo '<li><a href="login.php">Đăng nhập</a></li>';
                            }
	   ?>
							 <?php 
	  $login_check = Session::get('customer_login');
	  if($login_check){
	  	 echo '<li><a href="cart.php">Xem giỏ hàng</a></li>';
      }
                            else
                            {
                                echo '';
                            }
	   ?>
							 <?php 
	  $login_check = Session::get('customer_login');
	  if($login_check){
	  	 echo '<li><a href="wishlist.php">Sản phẩm yêu thích</a></li>';
      }
                            else
                            {
                                echo '';
                            }
	   ?>
							<li><a href="faq.html">Giúp đỡ</a></li>
						</ul>
				</div>
				<div class="col_1_of_4 span_1_of_4">
					<h4>Liên hệ</h4>
						<ul>
							<li><span>0399291115</span></li>
							<li><span>0372105799</span></li>
						</ul>
						<div class="social-icons">
							<h4>Theo dõi chúng tôi</h4>
					   		  <ul>
							      <li class="facebook"><a href="https://www.facebook.com/hieulm1609" target="_blank"> </a></li>
							      <li class="twitter"><a href="https://twitter.com/Hieule1609" target="_blank"> </a></li>
							      <li class="googleplus"><a href="https://www.google.com/intl/vi/gmail/about/#" target="_blank"> </a></li>
							      <li class="contact"><a href="#" target="_blank"> </a></li>
							      <div class="clear"></div>
						     </ul>
   	 					</div>
				</div>
			</div>
			<div class="copy_right">
				<p>coppy right @2019</p>
		   </div>
     </div>
    </div>
    <script type="text/javascript">
		$(document).ready(function() {
	
			
			$().UItoTop({ easingType: 'easeOutQuart' });
			
		});
	</script>
    <a href="#" id="toTop" style="display: block;"><span id="toTopHover" style="opacity: 1;"></span></a>
    <link href="css/flexslider.css" rel='stylesheet' type='text/css' />
	  <script defer src="js/jquery.flexslider.js"></script>
	  <script type="text/javascript">
		$(function(){
		  SyntaxHighlighter.all();
		});
		$(window).load(function(){
		  $('.flexslider').flexslider({
			animation: "slide",
			start: function(slider){
			  $('body').removeClass('loading');
			}
		  });
		});
	  </script>
</body>
</html>
