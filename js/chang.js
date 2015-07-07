// JavaScript Document
$(function() {
	//數量按鈕	
	var spinner = $( "#spinner" ).spinner();
	$( "#disable" ).click(function() {
		if ( spinner.spinner( "option", "disabled" ) ) {
			spinner.spinner( "enable" );
		} else {
			spinner.spinner( "disable" );
		}
	});
	$( "#destroy" ).click(function() {
		if ( spinner.spinner( "instance" ) ) {
			spinner.spinner( "destroy" );
		} else {
			spinner.spinner();
		}
	});
	$( "#getvalue" ).click(function() {
		alert( spinner.spinner( "value" ) );
	});
	$( "#setvalue" ).click(function() {
		spinner.spinner( "value", 5 );
	});
	$( "button" ).button();	
	
	//取得目前金額並顯示
	var subtotal=$("#subprice").val();
	var endprice=$("#endprice").val();
	if(endprice==""){
		endprice=$("#subprice").val();
		$("#endprice").val(subtotal);
	}
	$("#totalprice").html(endprice);
	
	
	//組2組4 加購
	var addp_id = new Array();  //儲存加購id
	$(".addchecked:input[name=addproduct]").click(function(){    //按下checkbox
		var p_id=$(this).val();
		if($(this).prop("checked") == true){
			$.ajax({ 
				url: '../addproduct.php',
				data: { p_id: p_id },
				type: 'post',
				success: function(response) {
					addp_id.push(p_id);   //將p_id存入陣列
					endprice=parseInt(endprice)+parseInt(response);
					$("#endprice").val(endprice);
					$("#totalprice").html(endprice);
					$("#addp_id").val(addp_id);
				}
			});
		}else if($(this).prop("checked") == false){
			$.ajax({ 
				url: '../addproduct.php',
				data: { p_id: p_id },
				type: 'post',
				success: function(response) {
					endprice=parseInt(endprice)-parseInt(response);
					$("#endprice").val(endprice);
					$("#totalprice").html(endprice);
					addp_id.splice(addp_id.indexOf(p_id), 1);   //刪除指定的元素
					$("#addp_id").val(addp_id);		
				}
			});	
		}		
	});
	

	//扣bounus  
	var bonus_id = new Array();  //儲存折價卷id
	$(".bonus_number").on('change', function(){
		var bonus_number = $(this).val(); // this.value
		var bonus_index=$(this).index(".bonus_number");
		$.ajax({ 
			url: '../bouns.php',
			data: { bonus_number: bonus_number },
			type: 'post',
			success: function(response) {
				var idnum;
				if(isNaN(response)==false && response!=""){
					$(".bonus_price").eq(bonus_index).text("-30元");
					$(".bonus_number").eq(bonus_index).attr('disabled', true);
					bonus_id.push(response);
					idnum=bonus_id.length;
					endprice=endprice-30;
				}else{
					alert("折價卷輸入錯誤")
					$(".bonus_number").eq(bonus_index).attr('disabled', false);
					$(".bonus_number").eq(bonus_index).val("");
					idnum=bonus_id.length;
					endprice=endprice-30;
				}
				$("#bonus_id").val(bonus_id);
				$("#totalprice").html(endprice);
				$("#endprice").val(endprice);
			}
		});
	});
});