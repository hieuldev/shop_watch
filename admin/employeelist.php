<?php include 'inc/header.php';?>
<?php include 'inc/sidebar.php';?>
<?php include '../classes/employee.php';  ?>
<?php

    $employee = new employee();     
    if(!isset($_GET['delid']) || $_GET['delid'] == NULL){
        // echo "<script> window.location = 'catlist.php' </script>";
        
    }else {
        $id = $_GET['delid']; // Lấy catid trên host
        $delemployee = $employee -> del_employee($id); // hàm check delete Name khi submit lên
    }
 ?> 

        <div class="grid_10">
            <div class="box round first grid">
                <h2>Danh sách nhân viên</h2>
                <div><a href="employeeadd.php">Thêm mới</a></div>
                <div class="block">  
                <?php 
                    if(isset($delemployee)){
                        echo $delemployee;
                    }
                 ?>      
                    <table class="data display datatable" id="example">
					<thead>
						<tr>
							<th>No.</th>
							<th>Tên nhân viên</th>
							<th>Email</th>
                            <th>Tên đăng nhập</th>
                            <th>Mật khẩu</th>
							<th>Xử lý</th>
						</tr>
					</thead>
					<tbody>
						<?php 
							$list_employee = $employee -> list_employee();
							if($list_employee){
								$i = 0;
                                foreach($list_employee as $result){
									$i++;
								
						?>
						<tr class="odd gradeX">
							<td><?php echo $i; ?></td>
							<td><?php echo $result['adminName']; ?></td>
							<td><?php echo $result['adminEmail']; ?></td><td><?php echo $result['adminUser']; ?></td><td><?php echo $result['adminPass']; ?></td>
							<td><a href="employeeedit.php?adminId=<?php echo $result['_id']; ?>">Sửa</a> || <a onclick = "return confirm('Bạn chắc chắn muốn xóa ?')" href="?delid=<?php echo $result['_id'] ?>">Xóa</a></td>
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

