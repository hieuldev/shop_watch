<?php
include "../lib/session.php";
Session::checkSession();
?>
<?php
  header("Cache-Control: no-cache, must-revalidate");
  header("Pragma: no-cache"); 
  header("Expires: Sat, 26 Jul 1997 05:00:00 GMT"); 
  header("Cache-Control: max-age=2592000");
?>
<!DOCTYPE html>
<html>
<head>
    <meta http-equiv="content-type" content="text/html; charset=utf-8" />
    <title>Admin</title>
    <link rel="stylesheet" type="text/css" href="css/reset.css" media="screen" />
    <link rel="stylesheet" type="text/css" href="css/text.css" media="screen" />
    <link rel="stylesheet" type="text/css" href="css/grid.css" media="screen" />
    <link rel="stylesheet" type="text/css" href="css/layout.css" media="screen" />
    <link rel="stylesheet" type="text/css" href="css/nav.css" media="screen" />
    <link href="css/table/demo_page.css" rel="stylesheet" type="text/css" />
    <!-- BEGIN: load jquery -->
    <script src="js/jquery-1.6.4.min.js" type="text/javascript"></script>
    <script type="text/javascript" src="js/jquery-ui/jquery.ui.core.min.js"></script>
    <script src="js/jquery-ui/jquery.ui.widget.min.js" type="text/javascript"></script>
    <script src="js/jquery-ui/jquery.ui.accordion.min.js" type="text/javascript"></script>
    <script src="js/jquery-ui/jquery.effects.core.min.js" type="text/javascript"></script>
    <script src="js/jquery-ui/jquery.effects.slide.min.js" type="text/javascript"></script>
    <script src="js/jquery-ui/jquery.ui.mouse.min.js" type="text/javascript"></script>
    <script src="js/jquery-ui/jquery.ui.sortable.min.js" type="text/javascript"></script>
    <script src="js/table/jquery.dataTables.min.js" type="text/javascript"></script>
    <!-- END: load jquery -->
    <script type="text/javascript" src="js/table/table.js"></script>
    <script src="js/setup.js" type="text/javascript"></script>
	 <script type="text/javascript">
        $(document).ready(function () {
            setupLeftMenu();
		    setSidebarHeight();
        });
    </script>

</head>
<body>
    <div class="container_12">
        <div class="grid_12 header-repeat">
            <div id="branding">
                <div class="floatleft logo">
                    <img src="../images/logodongho.jfif" alt="Logo" />
				</div>
				<div class="floatleft middle">
					<h1>Cửa hàng đồng hồ </h1>
					
				</div>
                <div class="floatright">
                    <div class="floatleft">
                        <img src="img/img-profile.jpg" alt="Profile Pic" /></div>
                    <div class="floatleft marginleft10">
                        <ul class="inline-ul floatleft">
                            <li>Xin chào Admin</li>
                        
                            <li><a href="?action=logout">Đăng xuất</a>
                            </li>
                            <?php
                            if(isset($_GET['action'])&&$_GET['action']='logout')
                            {
                               Session::destroy();
                            }
                            ?>
                        </ul>
                    </div>
                </div>
                <div class="clear">
                </div>
            </div>
        </div>
        <div class="clear">
        </div>
        <div class="grid_12">
            <ul class="nav main">
                <?php if(isset($_SESSION['RankId'])&&$_SESSION['RankId']=='1')
{echo'<li class="ic-dashboard"><a href="index.php"><span>Dashboard</span></a> </li>
                
                <li class="ic-form-style"><a href="userprofile.php"><span>Hồ sơ người dùng</span></a></li>
                <li class="ic-form-style"><a href="employeelist.php"><span>Quản lý nhân viên</span></a></li>
				<li class="ic-typography"><a href="changepassword.php"><span>Đổi mật khẩu</span></a></li>
				<li class="ic-form-style"><a href="promotionlist.php"><span>Danh sách khuyến mãi</span></a></li>
                <li class="ic-charts"><a href="http://localhost:81/shop_watch/"><span>Chuyển đến website</span></a></li>';}
                else if(isset($_SESSION['RankId'])&&$_SESSION['RankId']=='2')
                {echo'<li class="ic-dashboard"><a href="index.php"><span>Dashboard</span></a> </li>
                <li class="ic-typography"><a href="changepassword.php"><span>Đổi mật khẩu</span></a></li>
                <li class="ic-grid-tables"><a href="inbox.php"><span>Xem danh sách đơn hàng</span></a></li>
                <li class="ic-charts"><a href="http://localhost:81/shop_watch/"><span>Chuyển đến website</span></a></li>';
                }
    ?>
            </ul>
        </div>
        <div class="clear">
        </div>

    