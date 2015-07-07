<?php
include_once("conn.php"); 
$p_id=$_GET["p_id"];
//print_r($_SESSION['product']);
foreach($_SESSION['product'] as $key=>$value){
  if(in_array($p_id,$value)){
    $arraykey=$key;
	unset($_SESSION['product'][$arraykey]);
  }
}
echo "<script>window.history.back();</script>";
?>