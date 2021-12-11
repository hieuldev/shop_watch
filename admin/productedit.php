
<?php include 'inc/header.php';?>
<?php include 'inc/sidebar.php';?>
<?php include '../classes/category.php';  ?>
<?php include '../classes/brand.php';  ?> 
<?php include '../classes/product.php';  ?>
<?php
    // gọi class category
    $pd = new product();
    if(!isset($_GET['productid']) || $_GET['productid'] == NULL){
        echo "<script> window.location = 'productlist.php' </script>";
        
    }else {
        $id = $_GET['productid']; // Lấy productid trên host
    } 
    if($_SERVER['REQUEST_METHOD'] == 'POST' && isset($_POST['submit'])){
        // LẤY DỮ LIỆU TỪ PHƯƠNG THỨC Ở FORM POST
        $updateProduct = $pd -> update_product($_POST, $_FILES, $id); // hàm check catName khi submit lên
    }
  ?>
<div class="grid_10">
    <div class="box round first grid">
        <h2>Sửa sản phẩm</h2>
        <?php 
            if(isset($updateProduct)){
                echo $updateProduct;
            }
         ?>
         <?php 
         $result_product = $pd->getproductbyId($id);
         if($result_product){
          ?>   
        <div class="block">

         <form action="" method="post" enctype="multipart/form-data">
            <table class="form">
               
                <tr>
                    <td>
                        <label>Tên sản phẩm</label>
                    </td>
                    <td>
                        <input name="productName" value="<?php echo $result_product['productName'] ?>" type="text" class="medium" />
                    </td>
                </tr>
                  <tr>
                    <td>
                        <label>Code sản phẩm</label>
                    </td>
                    <td>
                        <input name="product_code" value="<?php echo $result_product['product_code'] ?>" type="text" class="medium" />
                    </td>
                </tr>
                 <tr>
                    <td>
                        <label>Số lượng sản phẩm</label>
                    </td>
                    <td>
                        <input name="productQuantity" value="<?php echo $result_product['productQuantity'] ?>" type="text" class="medium" />
                    </td>
                </tr>
                <tr>
                    <td>
                        <label>Loại sản phẩm</label>
                    </td>
                    <td>
                        <select id="select" name="category">
                            <option>Lựa chọn loại sản phẩm</option>
                            <?php 
                            $cat = new category();
                            $catlist = $cat->show_category();
                            if($catlist){
                            foreach($catlist as $result){
                             ?>
                            <option 
                            <?php 
                            if($result['catName']==$result_product['cat'])
                                { echo 'selected'; }
                             ?>    
                            value=" <?php echo $result['catName'] ?> "> <?php echo $result['catName'] ?></option>
                            
                            <?php 
                            }
                             }
                             ?>
                        </select>
                    </td>
                </tr>
                <tr>
                    <td>
                        <label>Thương hiệu</label>
                    </td>
                    <td>
                        <select id="select" name="brand">
                            <option>Lựa chọn thương hiệu</option>
                            <?php 
                            $brand = new brand();
                            $brandlist = $brand->show_brand();
                            if($brandlist){
                            foreach($brandlist as $result){
                             ?>
                            <option
                            <?php 
                            if($result['brandName']==$result_product['brand'])
                                { echo 'selected'; }
                             ?> 
                             value=" <?php echo $result['brandName'] ?> "> <?php echo $result['brandName'] ?> </option>
                            
                            <?php 
                            }
                             
                             ?>
                        </select>
                    </td>
                </tr>
                
                 <tr>
                    <td style="vertical-align: top; padding-top: 9px;">
                        <label>Mô tả</label>
                    </td>
                    <td>
                        <textarea name="product_desc" class="tinymce"><?php echo $result_product['product_desc'] ?></textarea>
                    </td>
                </tr>
                <tr>
                    <td>
                        <label>Giá</label>
                    </td>
                    <td>
                        <input name="price" value="<?php echo $result_product['price'] ?>" type="text" class="medium" />
                    </td>
                </tr>
            
                <tr>
                    <td>
                        <label>Ảnh</label>
                    </td>
                    <td>
                        <img src="uploads/<?php echo $result_product['image'] ?>" width="100"><br>
                        <input name="image" type="file" />
                    </td>
                </tr>
                
                <tr>
                    <td>
                        <label>loại sản phẩm</label>
                    </td>
                    <td>
                        <select id="select" name="type">
                            <option>Lựa chọn loại sản phẩm</option>
                            <?php 
                            if ($result_product['type'] ==0) {
                             ?>
                            <option selected value="0">Không nổi bật</option>
                            <option value="1">Nổi bật</option>
                            <?php 
                                }else{
                            ?>
                            <option value="0">Không nổi bật</option>
                            <option selected value="1">Nổi bật</option>    
                            <?php 
                        }
                             ?>
                             
                        
                        </select>
                    </td>
                </tr>

                <tr>
                    <td></td>
                    <td>
                        <input type="submit" name="submit" value="Cập nhật" />
                    </td>
                </tr>
            </table>
            </form>
            <?php 
            }
            }
             ?>
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


