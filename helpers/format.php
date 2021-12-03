<?php
/**
* Format Class
*/
class Format{
 public function formatDate($date){
    return date('F j, Y, g:i a', strtotime($date));
 }

 public function textShorten($text, $limit = 400)
 //van ban lon hon 400 ki tu se hien thi dau ... o cuoi
 {
    $text = $text. " ";
    $text = substr($text, 0, $limit);
    $text = substr($text, 0, strrpos($text, ' '));
    $text = $text."...";
    return $text;
 }

 public function validation($data)//kiem tra form trong hay khong trong
 {
    $data = trim($data);
    $data = stripcslashes($data);//stripcslashes loai bo ki tu dac biet
    $data = htmlspecialchars($data);
    return $data;
 }

 public function title(){
    $path = $_SERVER['SCRIPT_FILENAME'];
    $title = basename($path, '.php');//basename tra ve phan duoi cua duong dan
    //$title = str_replace('_', ' ', $title);
    if ($title == 'index') {
     $title = 'trang chủ';
    }else if ($title == 'contact') {
     $title = 'liên hệ';
    }
    return $title = ucfirst($title);//chuyen chu cai dau thanh in hoa
   }
 public function format_currency($n=0){
        $n=(string)$n;
        $n=strrev($n);//strrev dao nguoc chuoi
        $res='';
        for($i=0;$i<strlen($n);$i++){
            if($i%3==0 && $i!=0){
                $res.='.';
            
            }
            $res.=$n[$i];
        }
        $res=strrev($res);
        return $res;
    
    
    }
}
?>
 
