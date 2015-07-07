<?php 
//include_once("box/header.php");
//include_once("class/chang.class.php");
include_once("../conn.php");


if($_POST!=""){
	//echo $_POST["student_tel"];
	//echo "<script>alert('".$_POST["student_tel"]."');ript>";
	if($_POST["student_id"]=="" || $_POST["student_gender"]=="" || $_POST["student_tel"]=="" || $_POST["student_name"]==""){
		echo "<script>alert('購買人資料不齊全!');</script>";
		echo "<script>location.href = 'shop.php';</script> "; 
	
	}else{
		foreach($_POST as $key => $post){
			if($post==""){
				$_POST[$key]=0;
			}
		}
		if($_POST["bonus_id"]!=""){
			$bonus_id=str_replace (",","|",$_POST["bonus_id"]);
		}else{
			$bonus_id=0;
		}
		$sqlbuy="INSERT INTO `buy`(`student_name`, `student_id`, `student_sex`, `student_tel`, `total_price`, `bonus_num`, `team`) VALUES ('".$_POST["student_name"]."',".$_POST["student_id"].",".$_POST["student_gender"].",".$_POST["student_tel"].",".$_POST["endprice"].",'".$bonus_id."',1)";
		mysql_query($sqlbuy);
		$buy_id = mysql_insert_id();
		
		foreach($_SESSION['product'] as list($p_id, $num, $addp_id)){
			//主產品
			$productprice="select pro_price from product where p_id=".$p_id;
			$resultpro=mysql_fetch_array(mysql_query($productprice));
			$subtotal=$resultpro["pro_price"]*$num;
			$sqldetail="INSERT INTO `buy_detail`(`buy_id`, `prduct_id`, `product_num`, `subtotal`) VALUES (".$buy_id.",".$p_id.",".$num.",".$subtotal.")";
			mysql_query($sqldetail);
			
			//加購產品
			if($addp_id!=0){
				$addprice="select pro_price from product where p_id=".$addp_id;
				$resultadd=mysql_fetch_array(mysql_query($addprice));
				$sqldetail="INSERT INTO `buy_detail`(`buy_id`, `prduct_id`, `product_num`, `subtotal`) VALUES (".$buy_id.",".$addp_id.",1,".$resultadd["pro_price"].")";
				mysql_query($sqldetail);
			}
			
		}
		
		//更新折價卷狀態
		$bonus=explode("|",$bonus_id);
		foreach($bonus as $value){
			$updatebonus="UPDATE `bonus` SET `bounus_status`=1 WHERE bonus_id=".$value;
			mysql_query($updatebonus);
		}
		echo "<script>alert('訂單成功,交貨時間賣家將以電話方式通知');</script>";
		session_destroy();
		echo "<script>location.href = 'index.php';</script> ";
	}
}else{
	echo "<script>alert('請先加入商品!');</script>";
}


?>
