<?php include 'inc/header.php';?>
<?php include 'inc/sidebar.php';?>
<?php include '../classes/customer.php';?>
    <?php 
	$filepath = realpath(dirname(__FILE__));
	include_once ($filepath.'/../classes/cart.php');
	include_once ($filepath.'/../helpers/format.php');
 ?>
<?php
    $cs = new customer(); 
    if(!isset($_GET['customerid']) || $_GET['customerid'] == NULL){
        echo "<script> window.location = 'inbox.php' </script>";
        
    }else {
        $id = $_GET['customerid']; // Lấy customerid trên host
    }

   
    
  ?>
        <div class="grid_10">
            <div class="box round first grid">
                <h2>Thông tin</h2>      
               <div class="block copyblock"> 
               
                 <?php 
                    $get_customer = $cs->show_customers($id);
                    if($get_customer){
                        while ($result = $get_customer->fetch_assoc()) {
                            
                        
                  ?>
                 <form action="" method="post">
                    <table class="form">					
                        <tr>
                            <td>Tên</td>
                            
                            <td>
                                <input type="text" readonly="readonly" value="<?php echo $result['name']; ?>" name="catName" placeholder="Sửa danh mục sản phẩm..." class="medium" />
                            </td>
                        </tr>
                        <tr>
                            <td>Điện thoại</td>
                            
                            <td>
                                <input type="text" readonly="readonly" value="<?php echo $result['phone']; ?>" name="catName" placeholder="Sửa danh mục sản phẩm..." class="medium" />
                            </td>
                        </tr>
                        <tr>
                            <td>Thành phố</td>
                            
                            <td>
                                <input type="text" readonly="readonly" value="<?php echo $result['city']; ?>" name="catName" placeholder="Sửa danh mục sản phẩm..." class="medium" />
                            </td>
                        </tr>
                        <tr>
                            <td>Quốc gia</td>
                           
                            <td>
                                <input type="text" readonly="readonly" value="<?php echo $result['country']; ?>" name="catName" placeholder="Sửa danh mục sản phẩm..." class="medium" />
                            </td>
                        </tr>
                        <tr>
                            <td>Địa chỉ</td>
                            
                            <td>
                                <input type="text" readonly="readonly" value="<?php echo $result['address']; ?>" name="catName" placeholder="Sửa danh mục sản phẩm..." class="medium" />
                            </td>
                        </tr>
                        <tr>
                            <td>Mã bưu điện</td>
                            
                            <td>
                                <input type="text" readonly="readonly" value="<?php echo $result['zipcode']; ?>" name="catName" placeholder="Sửa danh mục sản phẩm..." class="medium" />
                            </td>
                        </tr>
                        <tr>
                            <td>Email</td>
                           
                            <td>
                                <input type="text" readonly="readonly" value="<?php echo $result['name']; ?>" name="catName" placeholder="Sửa danh mục sản phẩm..." class="medium" />
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
<?php include 'inc/footer.php';
?>