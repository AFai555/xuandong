//编码器图片栏目调用
var len = $("#picsbox li").length;

KindEditor.ready(function(K) {
K.create('.editor_content', {
	width : '800px',
	height : '400px',
	filterMode : false,
	wellFormatMode : false,
	newlineTag : 'br',
	allowFileManager : true
});

var editor = K.editor({
	allowFileManager : true
});

K('#image').click(function() {
		editor.loadPlugin('image', function() {
			editor.plugin.imageDialog({
				imageUrl : K('#img').val(),
				clickFn : function(url, title, width, height, border, align) {
					K('#img').val(url);
					editor.hideDialog();
				}
			});
		});
	});

K('#picsBut').click(function() {
		editor.loadPlugin('image', function() {
			editor.plugin.imageDialog({
				clickFn : function(url, title, width, height, border, align) {
					K('#picsbox').append('<li><img src="'+url+'" /><span onClick=del(this,"'+url+'")>删除</span></li>');
					K('#pics').val(K('#pics').val()+url+"|");
					len += 1;
					editor.hideDialog();
				}
			});
		});
	});

});

function del(o,url) {
	if(o){
		$(o).parent().remove();
		$("#pics").val($("#pics").val().replace(url+'|','').replace(url,''));
		len -= 1;
	}
};


//控制图片滚动
$(function(){
		   
	$('.pee').hover(function(){
		$(this).addClass('online');					 
	},function(){
		$(this).removeClass('online');					 
	});	
	
	
	var index=0;
	
	$('#picleft').click(function(){
		index -= 1;
		if(index == -1) {index = len - 1;};
		//alert(index);
		showPics(index);
	});
	
	$('#picright').click(function(){
		index += 1;
		if(index == len) {index = 0;};
		showPics(index);
	});

	function showPics(index){
		var nowLeft = -index*91;
		$('#picsbox').animate({left:nowLeft},'slow');
	}

});

