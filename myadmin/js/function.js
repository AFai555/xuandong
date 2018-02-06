//莫言创意
$(function(){
	$('.dropdown').hover(function(){
			$("ul", this).show();			
	},function(){
			$("ul", this).hide();	
	});
	
	$("#allbox").click(function(){
		$(".listbox").attr("checked",this.checked);
	});

});

function Esccfm() {
	if (!confirm("确认要退出登陆？")) {
		window.event.returnValue = false;
	}
}

function delcfm() {
	if (!confirm("确定删除？删除后不可恢复!")) {
		window.event.returnValue = false;
	}
}

function submit01(){
document.form1.action="?act=checkbox&lx=1";
document.form1.submit();
}

function submit02(){
document.form1.action="?act=checkbox&lx=2";
document.form1.submit();
}

function submit03(){
document.form1.action="?act=checkbox&lx=3";
document.form1.submit();
}