<?php
$filepath = realpath(dirname(__FILE__));
include_once($filepath . '/../lib/database.php');
include_once($filepath . '/../helpers/format.php');
?>
<?php
class news
{
    private $db;
    private $fm;
    public function __construct()
    {
        $this->db = new Database();
        $this->fm = new Format();
    }
    public function insert_news($data, $file)
    {
        $newsTitle = mysqli_real_escape_string($this->db->link, $data['newsTitle']);
        $newsContent = mysqli_real_escape_string($this->db->link, $data['newsContent']);
        $type = mysqli_real_escape_string($this->db->link, $data['newsType']);
        $img_name = $_FILES['newsImg']['name'];
        $img_tmp = $_FILES['newsImg']['tmp_name'];
        if ($_FILES['newsImg']['error'] > 0) {
            $alert = "<span class='error'>Lỗi tập tin</span>";
            return $alert;
        } else {
            move_uploaded_file($_FILES['newsImg']['tmp_name'], 'uploads/' . $_FILES['newsImg']['name']);
        }
        if ($newsTitle == "" || $type == "" || $newsContent == "") {
            $alert = "<span class='error'>Hãy nhập đầy đủ</span>";
            return $alert;
        } else {
            $query = "insert into tbl_news(newsTitle,newsImg,newsContent,newsType) values('$newsTitle','$img_name','$newsContent','$type')";
            $result = $this->db->insert($query);
            if ($result) {
                $alert = "<span class='success'>Nhập tin tức thành công</span>";
                return $alert;
            } else {
                $alert = "<span class='error'>Nhập tin tức thất bại</span>";
                return $alert;
            }
            echo $img_tmp;
        }
    }
    public function news_showlist()
    {
        $query =
            "SELECT * FROM tbl_news";
        $result = $this->db->select($query);
        return $result;
    }
    public function show_flashnews()
    {
        $query =
            "SELECT * FROM tbl_news order by newsID desc limit 2";
        $result = $this->db->select($query);
        return $result;
    }
    public function del_newsid($id)
    {
        $query = "DELETE FROM tbl_news where newsID = '$id' ";
        $result = $this->db->delete($query);
        if ($result) {
            $alert = "<span class='success'>Xóa tin tức thành công</span>";
            return $alert;
        } else {
            $alert = "<span class='success'>Xóa tin tức thất bại</span>";
            return $alert;
        }
    }
    public function getnewsId($id)
    {
        $query = "SELECT * FROM tbl_news where newsID= '$id' ";
        $result = $this->db->select($query);
        return $result;
    }
    public function update_news($data, $file, $id)
    {
        $newsTitle = mysqli_real_escape_string($this->db->link, $data['newsTitle']);
        $newsContent = mysqli_real_escape_string($this->db->link, $data['newsContent']);
        $type = mysqli_real_escape_string($this->db->link, $data['newsType']);

        // kiểm tra hình ảnh và lấy hình ảnh cho vào folder upload
        $permited = array('jpg', 'jpeg', 'png', 'gif');
        $img_name = $_FILES['newsImg']['name'];
        $img_size = $_FILES['newsImg']['size'];
        $img_temp = $_FILES['newsImg']['tmp_name'];
        if ($newsTitle == "" || $newsContent == "" || $type == "") {
            $alert = "<span class='error'>file không được trống</span>";
            return $alert;
        } else {
            if ($_FILES['newsImg']['error'] > 0) {
                $query = "UPDATE tbl_news SET newsTitle = '$newsTitle',newsContent = '$newsContent',newsType= '$type' WHERE newsID = '$id'";
            } else {
                move_uploaded_file($_FILES['newsImg']['tmp_name'], 'uploads/' . $_FILES['newsImg']['name']);
                $query = "UPDATE tbl_news SET newsTitle = '$newsTitle',newsImg='$img_name',newsContent = '$newsContent',newsType= '$type' WHERE newsID = '$id'";
            }
        }

        $result = $this->db->update($query);
        if ($result) {
            $alert = "<span class='success'>Sửa tin tức thành công</span>";
            return $alert;
        } else {
            $alert = "<span class='error'>Sửa tin tức thất bại</span>";
            return $alert;
        }
    }
    public function del_news($id)
    {
        $query = "DELETE FROM tbl_news where newsID = '$id' ";
        $result = $this->db->delete($query);
        if ($result) {
            $alert = "<span class='success'>Xóa tin tức thành công</span>";
            return $alert;
        } else {
            $alert = "<span class='success'>Xóa tin tức thất bại</span>";
            return $alert;
        }
    }
    
    public function news_type()
    {
        $query = "SELECT DISTINCT newsType FROM tbl_news order by newsType desc ";
        $result = $this->db->select($query);
        return $result;
    }
    public function show_newdetails($newsID)
    {
        $query = "SELECT *FROM tbl_news where newsID='$newsID' ";
        $result = $this->db->select($query);
        return $result;
    }
}
?>