<?php 
include_once("conn.php"); 
include_once("class/chang.class.php"); 

if(isset($_GET["p_id"])){
	$p_id=$_GET["p_id"];
}
$sql_product="select * from product where p_id=".$p_id;
$result_product=mysql_query($sql_product);

$sql_addproduct="select * from product where parent_id=".$p_id." and add_product=1";
$result_addproduct=mysql_query($sql_addproduct);
?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title>UNI-SHOP</title>
<link rel="stylesheet" href="//code.jquery.com/ui/1.11.4/themes/smoothness/jquery-ui.css">
<script src="http://code.jquery.com/jquery-1.10.2.js"></script>
<script src="http:/resources/demos/external/jquery-mousewheel/jquery.mousewheel.js"></script>
<script src="http://code.jquery.com/ui/1.11.4/jquery-ui.js"></script>
<script src="js/chang.js"></script>
<link rel="stylesheet" href="css/bootstrap.min.css">
<link rel="stylesheet" href="css/bootstrap-theme.min.css">
<link rel="stylesheet" href="css/base.css">
</head>
<body background="images/th.jpg">
    <header> 
    	<div class="container">
            <a href="index.php"><img src="images/logo.png" style="width:100%; overflow:hidden;"/></a> 
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
                	<form action="shopping_car.php" method="post">
                    	<?php while($product=mysql_fetch_array($result_product)){
							$product_img=array();
							$product_img=explode("|",$product["pro_img"]);
						?>
                        <div class="row">
                            <div class="col-sm-6">
                                <figure class="img-responsive  product_img"><img src="images/product/<?=$product_img[0] ?>" /></figure>
                            </div>
                            <div class="col-sm-6">
                                <h4 class="title"><?=$product["pro_name"] ?></h5>
                                <p><?=$product["pro_descript"] ?></p>
                                <p class="txt"><?=$product["pro_price"] ?>元</p>
                                <span>數量：</span><input id="spinner" name="num">
                                <p class="text-center"><input type="submit" value="加入購物車" /></p> 
                            </div>
                        </div>
                        <input type="hidden" name="p_id" value="<?=$product["p_id"] ?>" />
                        <?php while($addproduct=mysql_fetch_array($result_addproduct)){?>
                        <div class="row addproduct1">
                            <h5>加購商品</h5>
                            <div class="col-sm-1"><input type="checkbox" value="<?=$addproduct["p_id"] ?>" name="addp_id" /></div>
                            <div class="col-sm-3">
                                <figure class="img-responsive addimg"><img class="product_img" src="images/product/<?=$addproduct["pro_img"] ?>" /></figure>
                            </div>
                            <div class="col-sm-1"><?=$addproduct["pro_price"] ?>元</div>
                            <div class="col-sm-3"><?=$addproduct["pro_name"] ?></div>                       
                        </div>
                        <div class="row addproduct1">
                            <h5>加購商品</h5>
                            <div class="col-sm-1"><input type="checkbox" value="<?=$addproduct["p_id"] ?>" name="addp_id" /></div>
                            <div class="col-sm-1"><?=$addproduct["pro_price"]+$product["pro_price"] ?>元</div>
                            <div class="col-sm-3">
                                <figure class="img-responsive addimg"><img class="product_img" src="images/<?=$product_img[0] ?>" /></figure>
                            </div>
                            <div class="col-sm-1">+</div>
                            <div class="col-sm-3">
                                <figure class="img-responsive addimg"><img class="product_img" src="images/<?=$addproduct["pro_img"] ?>" /></figure>
                            </div>
                            <div class="col-sm-3"><?=$product["pro_descript"] ?></div>                        
                        </div>
                        
                        <?php
						}
							echo "<div class='text-center'>";
							if(count($product_img)>1){
								for($i=1;$i<count($product_img);$i++){
									echo "<figure class='img-responsive '><img src='images/product/".$product_img[$i]."' /></figure>";	
								}
							}
							echo "</div>";
						 }
						?>
                    </form>
                </div>
            </div>
    	</div>
    </section>
</body>
</html>
