<?php include 'inc/header.php';?>
<?php include 'inc/sidebar.php';?>
<div class="grid_10">
    <div class="box round first grid">
        <h2>Cập nhập tên trang web và mô tả</h2>
        <div class="block sloginblock">               
         <form>
            <table class="form">					
                <tr>
                    <td>
                        <label>Tên trang web</label>
                    </td>
                    <td>
                        <input type="text" placeholder="Điền tên website vào đây ..."  name="title" class="medium" />
                    </td>
                </tr>
				 <tr>
                    <td>
                        <label>Slogan của website</label>
                    </td>
                    <td>
                        <input type="text" placeholder="Nhập slogan của website vào đây ..." name="slogan" class="medium" />
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