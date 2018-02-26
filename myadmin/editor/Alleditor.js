//编码器通用调用
KindEditor.ready(function(K) {
K.create('.editor_content', {
	width : '900px',
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
K('#insertfile').click(function() {
	editor.loadPlugin('insertfile', function() {
		editor.plugin.fileDialog({
			fileUrl : K('#url').val(),
			clickFn : function(url, title) {
				K('#url').val(url);
				editor.hideDialog();
			}
		});
	});
});

});