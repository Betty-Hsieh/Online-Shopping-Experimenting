<?php 
include_once("../box/header.php");
include_once("../class/chang.class.php");  
?>
    <section>
    	<div class="container">
            <h5>購物車清單</h5>
            <div>
            	 <ul class="list-unstyled text-center carlist">
                    <li>
                        <div class="row">
                            <div class="col-sm-1">刪除</div>
                            <div class="col-sm-2">商品圖片</div>
                            <div class="col-sm-2">商品名稱</div>
                            <div class="col-sm-5">商品描述</div>
                            <div class="col-sm-1">購買數量</div>
                            <div class="col-sm-1">單價</div>
                        </div>
                    </li>
				<?php 
				$totalprice=0;
				//while (list($p_id, $num, $addp_id, $addnum) = each($_SESSION['product'])) {
				foreach($_SESSION['product'] as list($p_id, $num, $addp_id)){
					$sql_product="select * from product where p_id=".$p_id;
					$result_product=mysql_query($sql_product);
					while($product=mysql_fetch_array($result_product)){
						$totalprice=$totalprice+$product["pro_price"];
						$product_img=array();
						$product_img=explode("|",$product["pro_img"]);
						$sql_addproduct="select * from product where parent_id=".$p_id." and add_product=1";
						$result_addproduct=mysql_query($sql_addproduct);
				?>
                    <li class="caritem">
                        <div class="row">
                            <div class="col-sm-1" id="btn"><button value="<?=$p_id ?>" onclick="">刪除</button></div>
                            <div class="col-sm-2"><figure class="img-responsive car_img"><img class="product_img" src="../images/product/<?=$product_img[0] ?>"  /></figure></div>
                            <div class="col-sm-2"><?=$product["pro_name"] ?></div>
                            <div class="col-sm-5"><?=$product["pro_descript"] ?></div>
                            <div class="col-sm-1"><?=$num ?></div>
                            <div class="col-sm-1"><?=$product["pro_price"] ?>元</div>
                        </div>
                    </li>
                    <?php while($addproduct=mysql_fetch_array($result_addproduct)){
						$totalprice=$totalprice+$addproduct["pro_price"];
					?>
                    <li class="cart_add">
                    	<div class="row">
                            <div class="col-sm-1"></div>
                            <div class="col-sm-2"><figure><img class="add_img img-responsive"  src="../images/product/<?=$addproduct["pro_img"] ?>"/></figure></div>
                            <div class="col-sm-2"><?=$addproduct["pro_name"] ?></div>
                            <div class="col-sm-5">加購商品</div>
                            <div class="col-sm-1">1</div>
                            <div class="col-sm-1"><?=$addproduct["pro_price"] ?>元</div>
                        </div>
                    </li>
                    <?php }?>
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
                <div class="col-sm-2 text-center">折價卷<?=$j+1 ?></div>
                <div class="col-sm-6 text-left"><input type="text" name="bouns" value="" id="bouns_number<?=$j ?>"/></div>
                <div class="col-sm-1"><p id="bouns_price<?=$j ?>">元</p></div>
                </li>
                <script> 
					//扣bounus
					var bouns_number='#bouns_number<?php echo $j ?>'; 
					var bouns_id=new array();
					$("bouns_number").on('change', function postinput(){
						alert(0);
					  var bouns_number = $(this).val(); // this.value
					  $.ajax({ 
						url: '../bouns.php',
						data: { bouns_number: bouns_number },
						type: 'post',
						cache: true,
						success: function(response) {
						  //var bouns_id=response;
						  var idnum;
						  var bouns_price;
						  alert(bouns_id);
						  bouns_id.push(response);
						  idnum=bouns_id.length
						  bouns_price=idnum*30;
						  totalprice=subtotal-bouns_price;
						  
						  $("#bouns_price").html(bouns_price);
						  $("#totalprice").html(totalprice);
						  
						}
					  });
					});
                </script>
            <?php
				}
				
			?>
            	</ul>
            </div>
            <input type="hidden" value="<?=$subtotal ?>" id="subtotal" >
            <div class="row text-center">
            	<div class="col-sm-9"></div>
                
                <p class="text-right">折扣金額：<span id="bouns_price"></span>元</p>
                <p class="text-right">總金額：<span id="totalprice"></span>元</p>
            </div>
            <h4>購買人</h4>
            <div>
            	<div class="row">
					<div class="col-sm-2">姓名：</div>
                    <div class="col-sm-4"><input type="text" name="student_name"></div>
                    <div class="col-sm-2">性別：</div>
                    <div class="col-sm-4"><input type="radio" name="student_gender" value="1">男生<input type="radio" name="student_gender" value="0">女生</div>   
                </div>
                <div class="row">
                	<div class="col-sm-2">學號：</div>
                    <div class="col-sm-4"><input type="text" name="student_id"></div>
                    <div class="col-sm-2">連絡電話：</div>
                    <div class="col-sm-4"><input type="text" name="student_tel"></div>
                </div>
            </div>
            <p class="text-center">P.S.如到貨/缺貨皆以電話通知</p>
            <p class="text-center"><input type="submit" value="確認購買"></p>
            </form>
    	</div>
    </section>
</body>
</html>
