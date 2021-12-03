<?php 
require 'vendor/autoload.php';
?>
<?php
Class Database{
   public $data;
 
 public function __construct(){
  $client= new MongoDB\Client;
  $this->data=$client->shop_watch;
 }
}
    ?>
 