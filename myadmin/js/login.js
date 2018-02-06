$(function(){
	var errortxt=$('#errortxt');
	$('#submit').click(function(){
	//点击事件开始
		if ($('#adminname').val()==""){errortxt.show();errortxt.text('用户名必须填写');$('#adminname').focus();return false;}
		if ($('#password').val()==""){errortxt.show();errortxt.text('密码必须填写');$('#password').focus();return false;}
		if ($('#VerifyCode').val()==""){errortxt.show();errortxt.text('验证码必须填写');$('#VerifyCode').focus();return false;}
	//AJAX事件开始
		$.post('loginajax.php',{adminname:$('#adminname').val(),password:$('#password').val(),VerifyCode:$('#VerifyCode').val()},function(data){
		var jdata=eval("("+data+")");
		if (jdata.status==1){
			errortxt.show();
			errortxt.text(jdata.info);
		}else if(jdata.status==2){
			 window.location.href='./index.php'; 
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