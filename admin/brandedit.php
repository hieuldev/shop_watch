<?php include 'inc/header.php';?>
<?php include 'inc/sidebar.php';?>

<?php include '../classes/brand.php';  ?>
<?php
    $brand = new brand(); 
    if(!isset($_GET['brandid']) || $_GET['brandid'] == NULL){
        echo "<script> window.location = 'brandlist.php' </script>";
        
    }else {
        $id = $_GET['brandid']; // Lấy catid trên host
    }
    // gọi class category
    if($_SERVER['REQUEST_METHOD'] == 'POST'){
        // LẤY DỮ LIỆU TỪ PHƯƠNG THỨC Ở FORM POST
       
        $updateBrand = $brand -> update_brand($_POST,$id); // hàm check catName khi submit lên
    }
    
  ?>
        <div class="grid_10">
            <div class="box round first grid">
                <h2>Sửa thương hiệu</h2>      
               <div class="block copyblock"> 
                <?php 
                    if(isset($updateBrand)){
                        echo $updateBrand;
                    }
                 ?>
                 <?php 
                    $result = $brand->getbrandbyId($id);
                    if($result){    
                  ?>
                 <form action="" method="post">
                    <table class="form">					
                        <tr>
                            <td>
                                <input type="text" value="<?php echo $result['brandName']; ?>" name="brandName" placeholder="Sửa thương hiệu sản phẩm..." class="medium" />
                            </td>
                        </tr>
                        <tr>
                   
                    <td>
                        <select id="select" name="type">
                            <option>Lựa chọn loại thương hiệu</option>
                            <?php 
                            if ($result['topBrand'] ==0) {
                             ?>
                              <option selected value="0">Thương hiệu bình thường</option>
                              <option value="1">Thương hiệu hàng đầu</option>         
                            <?php 
                                }else{
                            ?>
                               <option selected value="1">Thương hiệu hàng đầu</option>
                            <option value="0">Thương hiệu bình thường</option>
                            <?php 
                        }
                             ?>         
                        </select>
                    </td>
                </tr>
						<tr> 
                            <td>
                                <input type="submit" name="submit" Value="Sửa" />
                            </td>
                        </tr>
                    </table>
                   </form>
                    <?php 
                        }                 
                     ?>
                </div>
            </div>
        </div>
<?php include 'inc/footer.php';?>