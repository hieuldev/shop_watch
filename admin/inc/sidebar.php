<div class="grid_2">
    <div class="box sidemenu">
        <div class="block" id="section-menu">
            <ul class="section menu">
                <?php if(isset($_SESSION['RankId'])&&$_SESSION['RankId']=='1')
                echo'<li><a class="menuitem">Danh mục sản phẩm</a>
                    <ul class="submenu">
                        <li><a href="catadd.php">Thêm danh mục</a> </li>
                        <li><a href="catlist.php">Danh sách danh mục</a> </li>
                    </ul>
                </li>
                <li><a class="menuitem">Thương hiệu sản phẩm</a>
                    <ul class="submenu">
                        <li><a href="brandadd.php">Thêm thương hiệu</a> </li>
                        <li><a href="brandlist.php">Danh sách thương hiệu</a> </li>
                    </ul>
                </li>
                <li><a class="menuitem">Sản phẩm</a>
                    <ul class="submenu">
                        <li><a href="productadd.php">Thêm sản phẩm</a> </li>
                        <li><a href="productlist.php">Liệt kê sản phẩm</a> </li>
                    </ul>
                </li>
                <li><a class="menuitem">Kho Hàng</a>
                    <ul class="submenu">
                        <li><a href="warehouse.php">Quản lý kho</a> </li>
                     
                    </ul>
                </li>
                
               <li><a class="menuitem">Quản lí Slider</a>
                    <ul class="submenu">
                        <li><a href="slideradd.php">Thêm slider</a> </li>
                        <li><a href="sliderlist.php">Tất cả slider</a> </li>
                    </ul>
                </li>
				 <li><a class="menuitem">Quản lí tin tức</a>
                    <ul class="submenu">
                        <li><a href="newsadd.php">Thêm tin tức</a> </li>
                        <li><a href="newslist.php">Tất cả tin tức</a> </li>
                    </ul>
                </li>
                <li><a class="menuitem">Báo cáo thống kê</a>
                    <ul class="submenu">
                        <li><a href="productbycat.php">Thống kê sản phẩm theo danh mục</a> </li>
                        <li><a href="customerInfor.php">Thống kê khách hàng</a> </li>
                        <li><a href="monthlyrevenue.php">Thống kê doanh thu từng tháng</a> </li>
                    </ul>
                </li>'
                ?> 
				<?php if(isset($_SESSION['RankId'])&&$_SESSION['RankId']=='2')
                    echo '
                    <li><a class="menuitem" href="promotionlist.php">Danh sách khuyến mãi</a>
                    
                </li>';
                    ?>
                
            </ul>
        </div>
    </div>
</div>