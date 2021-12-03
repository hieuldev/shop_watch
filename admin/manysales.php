<?php include 'inc/header.php';?>
<?php include 'inc/sidebar.php';?>
<?php include '../classes/category.php';  ?>
<?php include '../classes/cart.php';  ?>
<?php include '../classes/brand.php';  ?> 
<?php include '../classes/product.php';  ?>
<?php require_once '../helpers/format.php'; ?>
<?php
    $pd = new cart();   

 ?> 

        <div class="grid_10">
            <div class="box round first grid">
                <h2>HÀNG BÁN CHẠY</h2>
                
                <div class="block">       
                    <table class="data display datatable" id="example">
					<thead>
						<tr>
					<th>No.</th>
                    
					<th>Code sản phẩm</th>
					<th>Tên sản phẩm</th>
					<th>Số lượng bán</th>
					<th>Đơn giá</th>
                    <th>Thành tiền</th>
	
				</tr>
					</thead>
					<tbody>
						<?php 
				
				$pdlist = $pd->manysales();
				$i = 0;
                $tongnhap=0;
                        $tongtien=0;
							
					if($pdlist){
					
							while ($result = $pdlist->fetch_assoc()){
								$i++;
                                $tongnhap+=$result['quantity'];
                                $tongtien+=$result['price']*$result['quantity'];
                                
				 ?>
						<tr class="odd gradeX">
							<td><?php echo $i ?></td>
					<td><?php echo $result['productId'] ?></td>
					<td><?php echo $result['productName'] ?></td>
					
				
					<td>
						<?php echo $result['quantity'] ?>

					</td>
					<td>
						<?php echo $result['price'] ?>

					</td>
                    <td>
						<?php echo $result['price']*$result['quantity'] ?>

					</td>
					
						</tr>
						<?php 
							}
						}
						 ?>
					</tbody>
				</table>
                   
               </div>
            </div>
        </div>
<script type="text/javascript">
	$(document).ready(function () {
	    setupLeftMenu();

	    $('.datatable').dataTable();
	    setSidebarHeight();
	});
</script>
<?php include 'inc/footer.php';?>

