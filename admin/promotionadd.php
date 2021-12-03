<?php include 'inc/header.php';?>
<?php include 'inc/sidebar.php';?>
<?php include '../classes/product.php';  ?>
<?php
    // gọi class category
    $promotion = new product(); 
    if($_SERVER['REQUEST_METHOD'] == 'POST' && isset($_POST['submit'])){
        // LẤY DỮ LIỆU TỪ PHƯƠNG THỨC Ở FORM POST
        $insertpromotion = $promotion -> insert_promotion($_POST); // hàm check catName khi submit lên
    }
  ?>
<div class="grid_10">
    <div class="box round first grid">
        <h2>Thêm nhân viên</h2>
        <?php 
            if(isset($insertpromotion)){
                echo $insertpromotion;
            }
         ?>   
        <div class="block">

         <form action="promotionadd.php" method="post" enctype="multipart/form-data">
            <table class="form">
               
                <tr>
                    <td>
                        <label>Sản phẩm</label>
                    </td>
                    <td>
                        <select id="select" name="productId">
                            <option>Chọn sản phẩm</option>
                            <?php 
                            $pd = new product();
                            $pdlist = $pd->show_product();
                            if($pdlist){
                                while ($result = $pdlist->fetch_assoc()){
                            
                             ?>
                            <option value=" <?php echo $result['productId'] ?> "> <?php echo $result['productName'] ?> </option>
                            
                            <?php 
                            }
                             }
                             ?>
                        </select>
                    </td>
                </tr>
                <tr>
                    <td>
                        <label>Giá khuyến mãi</label>
                    </td>
                    <td>
                        <input name="PromotionPrice" type="text" placeholder="Nhập giá khuyến mãi..." class="medium" />
                    </td>
                </tr>
                  <tr>
                    <td>
                        <label>Thời gian kết thúc</label>
                    </td>
                    <td>
                        <input name="expiredTimeout" type="date" placeholder="Nhập thời gian kết thúc..." class="medium" />
                    </td>
                </tr>
                
                <td>
                        <input type="submit" name="submit" Value="Lưu" />
                    </td>
            </table>
            </form>
            <div><a href="promotionlist.php"><?php echo '<<<'?></a></div>
        </div>
    </div>
</div>
<!-- Load TinyMCE -->
<script src="js/tiny-mce/jquery.tinymce.js" type="text/javascript"></script>
<script type="text/javascript">
    $(document).ready(function () {
        setupTinyMCE();
        setDatePicker('date-picker');
        $('input[type="checkbox"]').fancybutton();
        $('input[type="radio"]').fancybutton();
    });
</script>
<!-- Load TinyMCE -->
<?php include 'inc/footer.php';?>


