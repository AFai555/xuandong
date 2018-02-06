if(typeof(jQuery)!="undefined")
{
   jQuery.fn.extend({
         scrollFollow:function (opts){
           var os=this;
           //默认参数定义
           //动画持续时间
           var duration=200;
           //上边距
           var offset=200;           
           
            
            //获取函数传入的参数
           if(opts)
           {
               if(!isNaN(opts.duration))
               {
                   duration=parseInt(opts.duration);
               }
               if(!isNaN(opts.offset))
               {
                   offset=parseInt(opts.offset);
               }
           }
            //定义css默认属性，预处理
           os.each(function (){
               var o=$(this);
               o.css("position","absolute").appendTo("body");
           });
           
           //响应滚动条滚动事件
           $(window).scroll(function (){
                var scrollPos; 
	            if (typeof window.pageYOffset != 'undefined') { 
		            scrollPos = window.pageYOffset; 
	            } 
	            else if (typeof document.compatMode != 'undefined' && document.compatMode != 'BackCompat') { 
		            scrollPos = document.documentElement.scrollTop; 
	            } 
	            else if (typeof document.body != 'undefined') { 
		            scrollPos = document.body.scrollTop; 
	            }
	            os.stop();
                os.each(function (){
                   var o=$(this);
                   o.animate({"top":offset+scrollPos},duration);
               });
           });
          
           return this;
       }
   });
}

/**
页面载入
 **/
$(document).ready(function ()
{ 
   $("#cleft_box").scrollFollow({speed:200,offset:200});//speed:参数为动画持续时间,offset:为距离顶部的距离
});