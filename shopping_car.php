<?php 
include_once("conn.php"); 
include_once("class/chang.class.php");
if(isset($_POST["addp_id"])){
	$addproduct=$_POST["addp_id"];
}else{
	$addproduct=0;
}
echo $addproduct;

$addtocar=array();
array_push($addtocar,$_POST["p_id"],$_POST["num"],$addproduct);
array_push($_SESSION['product'],$addtocar);
header("Location:shop.php" );
?>