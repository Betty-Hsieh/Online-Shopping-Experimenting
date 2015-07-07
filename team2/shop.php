<?php 
include_once("../box/header.php");
include_once("../class/chang.class.php");  

if($_SESSION['product']==""){
	echo "<script>alert('請先加入商品')</script>";
	header("location:index.php");
}
?>

    <section>
    	<div class="container">
            <h5>購物車清單</h5>
            <form action="end.php" method="post">
            <div>
            	 <ul class="list-unstyled text-center carlist">
                    <li>
                        <div class="row">
                            <div class="col-sm-1">加購</div>
                            <div class="col-sm-2">商品圖片</div>
                            <div class="col-sm-2">商品名稱</div>
                            <div class="col-sm-4">商品描述</div>
                            <div class="col-sm-1">購買數量</div>
                            <div class="col-sm-1">單價</div>
                            <div class="col-sm-1">刪除</div>
                        </div>
                    </li>
				<?php 
				$subprice=0;
				//while (list($p_id, $num, $addp_id, $addnum) = each($_SESSION['product'])) {
				foreach($_SESSION['product'] as list($p_id, $num, $addp_id)){
					$sql_product="select * from product where p_id=".$p_id;
					$result_product=mysql_query($sql_product);
					while($product=mysql_fetch_array($result_product)){
						$subprice=$subprice+($product["pro_price"]*$num);
						$product_img=array();
						$product_img=explode("|",$product["pro_img"]);
						$product_array=array($p_id,$num,$addp_id);
						
				?>
                    <li class="caritem">
                        <div class="row cart_main">
                            <div class="col-sm-1"></div>
                            <div class="col-sm-2"><figure class="img-responsive car_img"><img class="product_img" src="../images/product/<?php echo $product_img[0] ?>"  /></figure></div>
                            <div class="col-sm-2"><?php echo $product["pro_name"] ?></div>
                            <div class="col-sm-4"><?php echo $product["pro_descript"] ?></div>
                            <div class="col-sm-1"><?php echo $num ?></div>
                            <div class="col-sm-1"><?php echo $product["pro_price"] ?>元</div>
                            <div class="col-sm-1" id="btn"><input type="button" value="刪除" onclick="location='../delproduct.php?p_id=<?php echo $p_id ?>';"></div>
                        </div>
                         <?php 
							$sql_addproduct="select * from product where parent_id=".$p_id." and add_product=1";
							$result_addproduct=mysql_query($sql_addproduct);
							while($addproduct=mysql_fetch_array($result_addproduct)){
						?>
                        <div class="row cart_add">
                            <div class="col-sm-1"><input type="checkbox" value="<?php echo $addproduct["p_id"] ?>" class="addchecked" name="addproduct"></div>
                            <div class="col-sm-2"><figure><img class="add_img img-responsive"  src="../images/product/<?php echo $addproduct["pro_img"] ?>"/></figure></div>
                            <div class="col-sm-8 text-left">我要加<?php echo $addproduct["pro_price"] ?>元買<?php echo $addproduct["pro_name"] ?></div>
                            <div class="col-sm-1"></div>
                        </div>
                        <?php } ?>
                    </li>		
               <?php
					}
				}
				?>
                </ul>
            </div>
           	<div class="row text-center">
            	<ul class="list-unstyled" id="bonus_list">
			<?php
				if(count($_SESSION['product'])>4){
					$k=3;
				}else{
					$k=count($_SESSION['product']);
				}
				for($j=0;$j<$k;$j++){
			?>
                <li>
                    <div class="col-sm-3"></div>
                    <div class="col-sm-2 text-center">折價卷<?php echo $j+1 ?></div>
                    <div class="col-sm-6 text-left"><input type="text" name="bouns<?php echo $j+1 ?>" class="bonus_number"/></div>
                    <div class="col-sm-1"><span class="bonus_price"></span></div>
                </li>                
            <?php
				}
				
			?>
            	</ul>
            </div>
            <input type="hidden" value="<?php echo $subprice; ?>" id="subprice" >
            <div class="row text-center">
            	<div class="col-sm-9"></div>
                <p class="text-right">總金額：<span id="totalprice"></span>元</p>
                <input type="hidden" value="" name="endprice" id="endprice" >
                <input type="hidden" value="" name="addp_id" id="addp_id" >
                <input type="hidden" value="" name="bonus_id" id="bonus_id" >
                
            </div>
            <h4>購買人(以下欄位皆為必填，資料不齊全視同訂購不成功)</h4>
            <div>
            	<div class="row buyer">
					<div class="col-sm-2">姓名：</div>
                    <div class="col-sm-4"><input type="text" name="student_name"></div>
                    <div class="col-sm-2">性別：</div>
                    <div class="col-sm-4"><input type="radio" name="student_gender" value="1" checked="checked">男生<input type="radio" name="student_gender" value="0">女生</div>   
                </div>
                <div class="row buyer">
                	<div class="col-sm-2">學號：</div>
                    <div class="col-sm-4"><input type="text" name="student_id"></div>
                    <div class="col-sm-2">連絡電話：</div>
                    <div class="col-sm-4"><input type="text" name="student_tel"></div>
                </div>
            </div>
            <div class="row">
            	<p class="col-sm-6 text-left"><a href="index.php">繼續購物</a></p>
            	<p class="col-sm-6 text-right">P.S.如到貨/缺貨皆以電話通知<input type="submit" value="確認購買"></p>
            </div>
            </form>
    	</div>
    </section>
</body>
</html>
