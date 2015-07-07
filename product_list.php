<?php 
include_once("conn.php"); 
include_once("class/chang.class.php"); 

if(isset($_GET["c_id"])){
	$c_id=$_GET["c_id"];
}
$sql_product="select * from product where add_product=0 and pro_catelog=".$c_id;
$result_product=mysql_query($sql_product);
?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title>UNI-SHOP</title>
<link rel="stylesheet" href="css/bootstrap.min.css">
<link rel="stylesheet" href="css/bootstrap-theme.min.css">
<link rel="stylesheet" href="css/base.css">
</head>
<body background="images/th.jpg">
    <header> 
    	<div class="container">
            <a href="images/logo.png"><img src="images/logo.png" style="width:100%; overflow:hidden;"/></a> 
            <p class="text-center"><img src="images/001.gif" alt="" width="517" height="39" /><img src="images/001.gif" alt="" width="517" height="39" /></p>
    	</div>
    </header>
    <section>
    	<div class="container">
            <div class="row">
                <div class="col-sm-3">
                    <ul class="list-unstyled">
                        <li><a href="index.php">全部商品</a></li>
                        <?php while($catelog=mysql_fetch_array($result_catelog)){?>
                        <li><a href="product_list.php?c_id=<?=$catelog["catelog_id"];?>"> <?=$catelog["catelog_name"]; ?></a></li>
                        <?php }?>
                    </ul>
                </div>
                <div class="col-sm-9">
                	<div class="row">
                    	<?php while($product=mysql_fetch_array($result_product)){
                    		$product_img=array();
							$product_img=explode("|",$product["pro_img"]);
						?>
                        <div class="col-sm-3">
                			<div class="product_box text-center">
                            	<a href="product.php?p_id=<?=$product["p_id"] ?>">
                                	<figure class="img-responsive product_img"><img src="images/product/<?=$product_img[0] ?>" /></figure>
                                	<p class="txt"><?=$product["pro_price"] ?>元</p>
                                    <h5 class="title"><?=$product["pro_name"] ?></h5>
                                </a>
                            </div>
                        </div>
                        <?php }?>
                    </div>
                </div>
            </div>
    	</div>
    </section>
</body>
</html>
