<?php include 'inc/header.php';?>
<?php include 'inc/sidebar.php';?>
<?php include '../classes/password.php'?>
<?php if($_SERVER['REQUEST_METHOD']=='POST'&&isset($_POST['submit']))
{
$pass=new password();
$newpass=$pass->updatePass($_POST);
}?>
<div class="grid_10">
    <div class="box round first grid">
        <h2>Thay đổi mật khẩu</h2>
        <?php
        if(isset($newpass))
        {
            echo $newpass;

        } 
        ?>
        <div class="block">               
         <form action="changepassword.php" method="post">
            <table class="form">					
                <tr>
                    <td>
                        <label>Mật khẩu cũ</label>
                    </td>
                    <td>
                        <input type="password" placeholder="Nhập mật khẩu cũ..."  name="oldpass" class="medium" />
                    </td>
                </tr>
				 <tr>
                    <td>
                        <label>Mật khẩu mới</label>
                    </td>
                    <td>
                        <input type="password" placeholder="Nhập mật khẩu mới..." name="newpass" class="medium" />
                    </td>
                </tr>
				 
				
				 <tr>
                    <td>
                    </td>
                    <td>
                        <input type="submit" name="submit" Value="Cập nhật" />
                    </td>
                </tr>
            </table>
            </form>
        </div>
    </div>
</div>
<?php include 'inc/footer.php';?>