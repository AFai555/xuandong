$(function(){
	var errortxt=$('#errorTxt');
	$('#submit').click(function(){
	//点击事件开始
		if ($('#username').val()=="" || $('#pasd').val()==""){errortxt.show();errortxt.text('用户名或密码不能为空');$('#username').focus();return false;}
		//验证码
		
		if ($('#VerifyCode').val()==""){errortxt.show();errortxt.text('验证码不能为空');$('#VerifyCode').focus();return false;}
	//AJAX事件开始
		$.post('regajax.php',{username:$('#username').val(),password:$('#pasd').val(),VerifyCode:$('#VerifyCode').val()},function(data){
		var jdata=eval("("+data+")");
		if (jdata.status==1){
			errortxt.show();
			errortxt.text(jdata.info);
		}else if(jdata.status==2){
			 window.location.href='./admin.php'; 
		}
		});
		return false;
	//点击事件结束
	});
	//点击提示框隐藏
	errortxt.click(function(){
		$(this).hide();
	});
})