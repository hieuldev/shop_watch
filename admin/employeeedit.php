
<?php include 'inc/header.php';?>
<?php include 'inc/sidebar.php';?>
<?php include '../classes/employee.php';  ?>
<?php
    // gọi class category
    $employee = new employee();
    if(!isset($_GET['adminId']) || $_GET['adminId'] == NULL){
        echo "<script> window.location = 'productlist.php' </script>";
        
    }else {
        $id = $_GET['adminId']; // Lấy adminId trên host
    } 
    if($_SERVER['REQUEST_METHOD'] == 'POST' && isset($_POST['submit'])){
        // LẤY DỮ LIỆU TỪ PHƯƠNG THỨC Ở FORM POST
        $updateEmployee = $employee -> update_employee($_POST, $id); // hàm check catName khi submit lên
    }
  ?>
<div class="grid_10">
    <div class="box round first grid">
        <h2>Sửa nhân viên</h2>
        <?php 
            if(isset($updateEmployee)){
                echo $updateEmployee;
            }
         ?>
         <?php 
         $get_employee_by_id = $employee->getemployeebyId($id);
         if($get_employee_by_id){
            while ($result = $get_employee_by_id->fetch_assoc()) {
                # code...
            
          ?>   
        <div class="block">

         <form action="" method="post">
            <table class="form">
               
                <tr>
                    <td>
                        <label>Tên nhân viên</label>
                    </td>
                    <td>
                        <input name="adminName" value="<?php echo $result['adminName'] ?>" type="text" class="medium" />
                    </td>
                </tr>
                  <tr>
                    <td>
                        <label>Email</label>
                    </td>
                    <td>
                        <input name="adminEmail" value="<?php echo $result['adminEmail'] ?>" type="text" class="medium" />
                    </td>
                </tr>
                 <tr>
                    <td>
                        <label>Tên đăng nhập</label>
                    </td>
                    <td>
                        <input name="adminUser" value="<?php echo $result['adminUser'] ?>" type="text" class="medium" />
                    </td>
                </tr>
                <tr>
                    <td>
                        <label>Mật khẩu</label>
                    </td>
                    <td>
                        <input name="adminPass" value="<?php echo $result['adminPass'] ?>" type="password" class="medium" />
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


