<?php 
include_once("../conn.php"); 
include_once("../class/chang.class.php");

$chang = new chang;

if(!empty($_SESSION["product"])){
	$same=0;
	for($i=0;$i<count($_SESSION["product"]);$i++){
		//if session內已有相同的產品
		if($_SESSION["product"][$i][0]==$_POST["p_id"]){
			$_SESSION["product"][$i][1]=$_SESSION["product"][$i][1]+$_POST["num"];   //修正數量
			if(isset($_POST["addp_id"])){									 //修正加購商品
				$_SESSION["product"][$i][2]=$_POST["addp_id"];
				//$_SESSION["product"][$i][3]+=1;   //加購商品+1
			}
			$same+=1;   //修改一筆資料+1
		}
	}
	if($same==0){    //沒有修改到任何資料
		if(isset($_POST["addp_id"])){ 
			$addp_id=$_POST["addp_id"];
		}else{
			$addp_id=0;
		}
		$chang->addproduct($_POST["p_id"],$_POST["num"],$addp_id);
	}
}else{
	$_SESSION["product"]=array();
	if(isset($_POST["addp_id"])){ 
		$addp_id=$_POST["addp_id"];
	}else{
		$addp_id=0;
	}
	$chang->addproduct($_POST["p_id"],$_POST["num"],$addp_id);
}
print_r($_SESSION["product"]);
header("Location:shop.php" );
?>