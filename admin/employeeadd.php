<?php include 'inc/header.php';?>
<?php include 'inc/sidebar.php';?>
<?php include '../classes/employee.php';  ?>
<?php
    // gọi class category
    $employee = new employee(); 
    if($_SERVER['REQUEST_METHOD'] == 'POST' && isset($_POST['submit'])){
        // LẤY DỮ LIỆU TỪ PHƯƠNG THỨC Ở FORM POST
        $insertEmployee = $employee -> insert_employee($_POST); // hàm check catName khi submit lên
    }
  ?>
<div class="grid_10">
    <div class="box round first grid">
        <h2>Thêm nhân viên</h2>
        <?php 
            if(isset($insertEmloyee)){
                echo $insertEmployee;
            }
         ?>   
        <div class="block">

         <form action="employeeadd.php" method="post" enctype="multipart/form-data">
            <table class="form">
               
                <tr>
                    <td>
                        <label>Tên nhân viên</label>
                    </td>
                    <td>
                        <input name="adminName" type="text" placeholder="Nhập tên nhân viên..." class="medium" />
                    </td>
                </tr>
                <tr>
                    <td>
                        <label>Email</label>
                    </td>
                    <td>
                        <input name="adminEmail" type="text" placeholder="Nhập email..." class="medium" />
                    </td>
                </tr>
                  <tr>
                    <td>
                        <label>Tên đăng nhập</label>
                    </td>
                    <td>
                        <input name="adminUser" type="text" placeholder="Nhập tên đăng nhập..." class="medium" />
                    </td>
                </tr>
                <tr>
                    <td>
                        <label>Mật khẩu</label>
                    </td>
                    <td>
                        <input name="adminPass" type="password" placeholder="Nhập mật khẩu..." class="medium" />
                    </td>
                </tr>
                <td>
                        <input type="submit" name="submit" Value="Lưu" />
                    </td>
            </table>
            </form>
            <div><a href="employeelist.php"><?php echo '<<<'?></a></div>
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


