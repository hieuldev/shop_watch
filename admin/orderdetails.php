<?php include 'inc/header.php';?>
<?php include 'inc/sidebar.php';?>
<?php 
	$filepath = realpath(dirname(__FILE__));
	include_once ($filepath.'/../classes/cart.php');
	include_once ($filepath.'/../helpers/format.php');
 ?>
 <?php
    $ct = new cart();
    if(isset($_GET['id_detail'])){
    	$id = $_GET['id_detail'];
    }

  ?>
        <div class="grid_10">
            <div class="box round first grid">
                <h2>Đơn hàng</h2>
                <div class="block">        
                    <table class="data display datatable" id="example">
					<thead>
						<tr>
							<th>No.</th>
							<th>Sản phẩm</th>
                            <th>Số lượng</th>
                            <th>Giá</th>
							<th>Thành tiền</th>
						</tr>
					</thead>
					<tbody>
						<?php 
						$ct = new cart();
						$fm = new Format();
						$get_inbox_cart = $ct -> get_inbox_detail($id);
						if ($get_inbox_cart) {
							$i=0;
							while ($result = $get_inbox_cart->fetch_assoc()) {
								$i++;
							
						 ?>
						<tr class="odd gradeX">
							<td><?php echo $i; ?></td>
							<td><?php echo $result['ProductName'] ?></td>
                            <td><?php echo $result['Quantity'] ?></td>
                            <td><?php echo $result['Price'] ?></td>
                            <td><?php echo $result['TotalPrice'] ?></td>
							
							<?php }}?>
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
