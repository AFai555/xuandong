<?php
require './include/conn.php';
if ($_GET['u']!=''){
	if ($row=_get_one_tj('member',"my_username='{$_GET['u']}'")){
		$_SESSION['referee']=$row['id'];
	}else{
		$_SESSION['referee']=0;
	}
}
$logo_url=_get_one('logo_up','1');
$img_url=_get_one('logo_up','2');
?>
<?php session_start();?>
<!DOCTYPE html>
<html><head><meta http-equiv="Content-Type" content="text/html; charset=UTF-8"><script type="text/javascript" charset="utf-8" async src="./other/crmqq.php"></script><script type="text/javascript" charset="utf-8" async src="./other/contains.js"></script><script type="text/javascript" charset="utf-8" async src="./other/localStorage.js"></script><script type="text/javascript" charset="utf-8" async src="./other/Panel.js"></script>
<meta charset="utf-8">
<meta http-equiv="X-UA-Compatible" content="IE=edge">
<title><?php echo $config_title?>-<?php echo $config_name?></title>
<meta name="description" content="<?php echo $config_dis?>">
<meta name="keywords" content="<?php echo $config_title?>">
<link rel="stylesheet" type="text/css" href="./other/base.css">
<link rel="stylesheet" type="text/css" href="./other/style.css">
<script src="./other/hm.js"></script><script src="./other/jquery.min.js" type="text/javascript"></script>
<script src="./other/jquery.sslide.js" type="text/javascript"></script>

<link rel="stylesheet" type="text/css" href="css/kefu.css">
<script src="js/jquery-1.8.3.min.js" type="text/javascript"></script>
<script type="text/javascript">
	$(function(){
		$("#aFloatTools_Show").click(function(){
			$('#divFloatToolsView').animate({width:'show',opacity:'show'},100,function(){$('#divFloatToolsView').show();});
			$('#aFloatTools_Show').hide();
			$('#aFloatTools_Hide').show();				
		});
		$("#aFloatTools_Hide").click(function(){
			$('#divFloatToolsView').animate({width:'hide', opacity:'hide'},100,function(){$('#divFloatToolsView').hide();});
			$('#aFloatTools_Show').show();
			$('#aFloatTools_Hide').hide();	
		});
	});
</script>
<!--[if lt IE 9]> <script type="text/javascript" src="new_js/html5.js"> </script><![endif]-->
<!--[if IE 6]>
    <script type="text/javascript" src="new_js/DD_belatedPNG.js" ></script>
    <script> DD_belatedPNG.fix('img,div,li,em,i,h3,.png,a'); </script>
    <![endif]-->
    <script>
var _hmt = _hmt || [];
(function() {
  var hm = document.createElement("script");
  hm.src = "//hm.baidu.com/hm.js?28878ce152e99eaa35ae52ba2ac57e70";
  var s = document.getElementsByTagName("script")[0]; 
  s.parentNode.insertBefore(hm, s);
})();
</script>

</head>
<body>
<!-- header -->
<div class="header">

  <div class="wrapper">
   
    <div class="logo"> <a href="" title="<?php echo $config_name?>首页"><img src="<?php echo $logo_url['imgurl']?>" alt="<?php echo $config_name?>logo"></a> </div>
  <!--  logo end-->
    <div class="txt"><strong ><?php echo $config_d_dis?></strong>  </div>
    <div class="tel"> <span>咨询热线：</span> <strong><?php echo $c_tel?></strong> </div>
  </div>
  <!--wrapper end-->
</div>
<!-- /header -->
<div class="naver">
  <ul class="wrapper">
    <li><a href="" class="cur">网站首页</a></li>
    <li><a href="/admin.php?act=gj">新闻发布</a></li>
    <li><a href="/admin.php?act=wb">微  博</a></li>
    <li><a href="/admin.php?act=lt">论  坛</a></li>
    <li><a href="/admin.php?act=wx">微  信</a></li>
    <li><a href="#bd">联系我们</a></li>
     <?php if ($_SESSION['userid']!='') :?>
        <li>[<?php echo $_SESSION['user_name']?>] <a href="loginout.php" target="_parent">退出</a></li>
        <?php else :?>
    <li><a href="/login.php">登陆</a></li>
    <li><a href="/reg.php">注册</a></li>
     <?php endif ;?>
  </ul>
</div>
<!--naver end-->
<!-- banner -->
<div class="banner">
  <div class="focusBox">
    <ul class="pic" style="position: relative; width: 1366px; height: 432px; ">
     
          <li style="background:url(<?php echo $img_url['imgurl']?>) no-repeat center 0px;"></li>
    </ul>
    <a class="prev" href="javascript:void(0)"></a> <a class="next" href="javascript:void(0)"></a>
    <ul class="hd">
      <li class="on"></li>
    </ul>
  </div>
  <script type="text/javascript">
		jQuery(".focusBox").slide({ mainCell:".pic",effect:"fold", autoPlay:true, delayTime:600, trigger:"click"});
	</script>
  
</div>
<!-- /banner -->
<!-- main -->
<div class="main">
  <div class="bk50"></div>
  <div class="row_01">
    <div class="wrapper">
      <div class="head">
        <h2>我们能做什么？</h2>
        <h3>为企业提供"全方位"的互联网品牌推广营销服务！</h3>
        <p>致力于打造"中国互联网新闻营销第一品牌"，以"多、快、好、省"的良好的口碑，赢得市场和企业的一致认可。</p>
      </div>
      <div class="bk40"></div>
      <div class="body">
        <ul>
          <li class="i1">
            <div class="thumb"><a href="/admin.php?act=gj"></a> </div>
            <div class="desc">
              <h3>新闻发布</h3>
              <p>指在百度上，发布带有"百度新闻源"属性的媒体，通过搜索相关关键字就可直接在百度首页相关信息区域展示，在最短的时间内获得最大的信息曝光率。</p>
            </div>
          </li>
          <li class="i4">
            <div class="thumb"> <a href="/admin.php?act=lt"></a> </div>
            <div class="desc">
              <h3>论坛推广</h3>
              <p>利用论坛这种网络交流的平台，通过文字、图片等方式发布的信息，从而让目标客户更加深刻地了解产品和服务。最终达到宣传的目的。</p>
            </div>
          </li>
          <li class="i3">
            <div class="thumb"> <a href="#"></a> </div>
            <div class="desc">
              <h3>微博推广</h3>
              <p>用更新微博向网友传播的信息，树立着良好的形象。每天的更新的内容就可以跟大家交流，或者有大家所感兴趣的话题，这样就可以达到营销的目的。</p>
            </div>
          </li>
          <li class="i2">
            <div class="thumb"> <a href="/admin.php?act=wx"></a> </div>
            <div class="desc">
              <h3>微信推广</h3>
              <p>利用公众账户的大量精准粉丝进行推广，企业根据不同的行业广告选择适合的公众号，提供用户需要的信息，推广自己的产品，从而实现点对点的营销。</p>
            </div>
          </li>
        </ul>
      </div>
      <div class="bk50"></div>
    </div>
    <!--wrapper end-->
  </div>
  <!--row_01 end-->
  <div class="row_02 com_bg">
    <div class="bk30"></div>
    
    <!--wrapper end-->
  </div>
  <!--row_02 end-->
  <div class="row_03">
    <div class="wrapper">
      <div class="head">
        <h2>我们的优势</h2>
      </div>
      <div class="body">
        <ul class="left">
          <li class="i1">
            <h3>8000媒体资源</h3>
            <p>媒体合作覆盖国内各大门户行业网站</p>
          </li>
          <li class="i2">
            <h3>5000企业合作</h3>
            <p>上市集团、政府机构、公关公司战略合作</p>
          </li>
          <li class="i3">
            <h3>200专业写手</h3>
            <p>国内各大新闻媒体专业主编级别写手服务</p>
          </li>
          <li class="i4">
            <h3>方便快捷</h3>
            <p>免费注册，24小时自助新闻发布平台</p>
          </li>
          <li class="i5">
            <h3>优势发稿</h3>
            <p>当天出稿，高效率高服务，效果立竿见影</p>
          </li>
          <li class="i6">
            <h3>企业保障</h3>
            <p>正规流程、正规合同、正规发票、企业定制</p>
          </li>
          <div class="clear"></div>
        </ul>
      </div>
    </div>
    <!--wrapper end-->
  </div>
  <!--row_03 end-->

  <!--row_05 end-->
  <div class="row_05">
    <div class="wrapper">
      <div class="head">
        <h2>用户点评</h2>
      </div>
      <div class="bk40"></div>
      <div class="foucebox">
        <div class="bd">
          <ul style="position: relative; width: 1040px; height: 72px; ">
            <li style="position: absolute; width: 1040px; left: 0px; top: 0px; display: none; ">
              <div class="body">
                <p>在互联网快速发展的今天，就是一个靠"脸"生存的时代! 产品的口碑直接影响着公司的发展，企业品牌形象也受到越来越多的企业的重视。<br>
                  <?php echo $config_name?>平台的兴起，很好的解决了企业在品牌公关上渠道的弱势，一站式的新闻稿发布，口碑由自己掌握。希望能越来越好，提供更多便利服务。</p>
                <div class="icon_01"></div>
                <div class="icon_02"></div>
              </div>
            </li>
            <li style="position: absolute; width: 1040px; left: 0px; top: 0px; display: none; ">
              <div class="body">
                <p>和<?php echo $config_name?>平台合作2年来，发布了几十次新闻稿，给我的感觉是专业、效率高、服务好、价格实惠。是一个值得长期合作的好伙伴。<br>
                  祝<?php echo $config_name?>越办越好，深深的体会到了该平台带来的便捷性，在此之前每次的新闻发布会，都需要找每一家媒体商谈，费用高不说，更是一个耗时费神的事情。</p>
                <div class="icon_01"></div>
                <div class="icon_02"></div>
              </div>
            </li>
            <li style="position: absolute; width: 1040px; left: 0px; top: 0px; display: list-item; ">
              <div class="body">
                <p>在中国的古语中有句"酒香不怕巷子深"的说法，然而在互联网时代，网络上每天产生的信息量太多，不注重推广好产品也会被埋没。<br>
                  在电子商务快速发展的今天，非常感谢<?php echo $config_name?>这个平台，非常方便快捷的把企业口碑快速传播出去，解决了每一个营销人员头痛的事情。</p>
                <div class="icon_01"></div>
                <div class="icon_02"></div>
              </div>
            </li>
          </ul>
        </div>
        <div class="bk40"></div>
        <div class="hd foot">
          <div class="hoverBg" style="margin-left: 158px; "></div>
          <ul>
            <li class="">
              <div class="thumb"><img src="./other/icon_13.png" alt="100教育"></div>
              <div class="desc">
                <h4>营销主管</h4>
                <p>100教育</p>
              </div>
              <div class="clear"></div>
            </li>
            <li class="">
              <div class="thumb"><img src="./other/icon_13_2.png" alt="环球雅思"></div>
              <div class="desc">
                <h4>网络主管</h4>
                <p>环球雅思</p>
              </div>
              <div class="clear"></div>
            </li>
            <li class="on">
              <div class="thumb"><img src="./other/icon_13_3.png" alt="顺丰优选"></div>
              <div class="desc">
                <h4>SEO主管</h4>
                <p>顺丰优选</p>
              </div>
              <div class="clear"></div>
            </li>
          </ul>
        </div>
      </div>
      <script type="text/javascript">

		jQuery(".foucebox").slide({ mainCell:".bd ul", effect:"fold", autoPlay:true, delayTime:300, triggerTime:50, startFun:function(i){
				//下面代码控制鼠标状态滑动
				jQuery(".foucebox .hoverBg").animate({"margin-left":79*i},100);
			}
		});

	</script>
    </div>
  </div>
  <div class="row_06 com_bg">
    <div class="wrapper">
      <div class="head">
        <h2>成功案例</h2>
      </div>
      <div class="body">
        <div id="slideBox" class="slideBox">
          <div class="bd">
            <ul>
              <li style="display: none; ">
                <div class="desc">
                  <div class="intro">
                    <h3>飞利浦电子企业宣传新闻</h3>
                    <p>飞利浦电子公司在全球企业500强中居第58位，在世界电子行业中排名第9，在60多个国家设有营业机构，其股票在9个国家的16个交易所上市。</p>
                    <p>飞利浦电子针对在中国新推出"V989手机"和"智芯IH电饭煲"做了最新的新闻媒体报道，旨在通过互联网的高速传播，更快的将新产品覆盖到各层次的消费者面前。</p>
                  </div>
                  <div class="report">
                    <h4>部分媒体报道：</h4>
                    <p><a rel="nofollow" target="_blank" href="http://news.sina.com.cn/o/2015-01-19/183431417921.shtml">新浪网-新闻</a> <a rel="nofollow" target="_blank" href="http://digi.163.com/15/0116/23/AG48OE28001664LU.html">网易-数码</a> <a rel="nofollow" target="_blank" href="http://news.zol.com.cn/502/5028345.html">中关村在线</a> <a rel="nofollow" target="_blank" href="http://mobile.it168.com/a2015/0116/1699/000001699365.shtml">IT168</a> <a rel="nofollow" target="_blank" href="http://mobile.yesky.com/372/45247372.shtml">天极网</a> <a rel="nofollow" target="_blank" href="http://network.chinabyte.com/403/13217903.shtml">比特网</a> <a rel="nofollow" target="_blank" href="http://it.msn.com.cn/861756/013892544527b.shtml">MSN中国</a> <a rel="nofollow" target="_blank" href="http://mobile.pconline.com.cn/602/6028161.html">太平洋电脑网</a> <a rel="nofollow" target="_blank" href="http://mobile.pconline.com.cn/602/6028161.html">手机中国网</a> <a rel="nofollow" target="_blank" href="http://www.chinadaily.com.cn/hqcj/xfly/2015-02-10/content_13214679.html">中国日报网-财经</a> <a rel="nofollow" target="_blank" href="http://news.ifeng.com/a/20150304/43260173_0.shtml">凤凰网-新闻</a> <a rel="nofollow" target="_blank" href="http://hea.163.com/15/0309/12/AK90401F001628C1.html">网易-家电</a> <a rel="nofollow" target="_blank" href="http://article.pchome.net/content-1785630.html?via=touch">电脑之家</a> <a rel="nofollow" target="_blank" href="http://www.pcpop.com/doc/1/1075/1075054.shtml">泡泡网</a> <a rel="nofollow" target="_blank" href="http://deco.rayli.com.cn/consume/2015-02-06/451560.shtml">瑞丽网-消费</a> <a rel="nofollow" target="_blank" href="http://tech.hexun.com/2015-02-07/173169570.html">和讯网-科技</a> <a rel="nofollow" target="_blank" href="http://china.huanqiu.com/hot/2015-03/5810386.html">环球网-财经</a> <a rel="nofollow" target="_blank" href="http://china.huanqiu.com/hot/2015-03/5810386.html">中国网-新闻</a></p>
                  </div>
                </div>
                <div class="thumb"><img src="./other/img_07.jpg" alt="飞利浦电子企业宣传新闻稿"></div>
                <div class="clear"></div>
              </li>
              <li style="display: none; ">
                <div class="desc">
                  <div class="intro">
                    <h3>海尔电器企业宣传新闻</h3>
                    <p>中国海尔创立于1984年，经过30年创业创新，发展成为全球家电第一品牌，引领现代生活方式的新潮流，以创新独到的方式全面优化生活和环境质量。</p>
                    <p>海尔品牌为了让更多消费者了解其新产品和质量，在新闻稿营销上面尝试了很多年，取得了非常好的市场效果。</p>
                  </div>
                  <div class="report">
                    <h4>部分媒体报道：</h4>
                    <p> <a rel="nofollow" target="_blank" href="http://www.focus.cn/news/home-2015-03-27/428769.html">搜狐网焦点</a> <a rel="nofollow" target="_blank" href="http://cq.qq.com/a/20150327/050865.htm">腾讯网</a> <a rel="nofollow" target="_blank" href="http://pc.ea3w.com/147/1479573.html">万维家电网</a> <a rel="nofollow" target="_blank" href="http://news.cheari.com/jdy/newsdetail.action?id=89467">环球家电网</a> <a rel="nofollow" target="_blank" href="http://hea.163.com/15/0326/16/ALL92FKQ001628C1.html">网易家电</a> <a rel="nofollow" target="_blank" href="http://info.homea.hc360.com/2015/03/2612581047763.shtml">慧聪网家电</a> <a rel="nofollow" target="_blank" href="http://jydq.cena.com.cn/2015-03/27/content_269454.htm">电子信息产业网</a> <a rel="nofollow" target="_blank" href="http://it.21cn.com/prnews/a/2015/0326/15/29286170.shtml">21CN科技</a> <a rel="nofollow" target="_blank" href="http://news.cheaa.com/2015/0326/440375.shtml">中国家电网</a> <a rel="nofollow" target="_blank" href="http://tech.southcn.com/t/2015-03/26/content_120917553.htm">南方网</a> <a rel="nofollow" target="_blank" href="http://digital.ynet.com/293860/972723469229b.shtml">北青网</a> <a rel="nofollow" target="_blank" href="http://www.abi.com.cn/news/htmfiles/2015-3/155460.shtml">艾肯家电网</a> <a rel="nofollow" target="_blank" href="http://www.pcpop.com/doc/sd/17/176839.shtml">泡泡网</a> <a rel="nofollow" target="_blank" href="http://qingbao.stcn.com/2015/0326/12131170.shtml">证券时报</a> <a rel="nofollow" target="_blank" href="http://jt.chinadaily.com.cn/15/0327/09/MR67320.html">千龙网</a> <a rel="nofollow" target="_blank" href="http://tech.gmw.cn/jd/2015-03/23/content_15183950.htm">光明网</a> </p>
                  </div>
                </div>
                <div class="thumb"><img src="./other/img_07-2.jpg" alt="海尔电器企业宣传新闻"> </div>
                <div class="clear"></div>
              </li>
              <li style="display: list-item; ">
                <div class="desc">
                  <div class="intro">
                    <h3>京东商城企业宣传新闻</h3>
                    <p>京东商城是中国B2C市场较大的3C网购专业平台。是中国电子商务领域较受消费者欢迎和较具影响力的电子商务网站之一。2010年，京东商城跃升为中国首家规模超过百亿的网络零售企业。2013年5月京东商城超市业务正式上线，京东将超市也搬到线上。</p>
                  </div>
                  <div class="report">
                    <h4>部分媒体报道：</h4>
                    <p> <a rel="nofollow" target="_blank" href="http://stock.jrj.com.cn/2015/03/19033618983923.shtml">金融界</a> <a rel="nofollow" target="_blank" href="http://news.163.com/15/0319/15/AL346T1L00014AED.html">网易新闻</a> <a rel="nofollow" target="_blank" href="http://insurance.hexun.com/2015-03-18/174151680.html">和讯网保险</a> <a rel="nofollow" target="_blank" href="http://insurance.cnfol.com/baoxiandongtai/20150318/20336331.shtml">中金在线</a> <a rel="nofollow" target="_blank" href="http://www.ccstock.cn/jrjg/insurance/2015-03-19/A1426705378359.html">中国资本证券网</a> <a rel="nofollow" target="_blank" href="http://economy.enorth.com.cn/system/2015/03/16/030089292.shtml">北方网</a> <a rel="nofollow" target="_blank" href="http://stock.huagu.com/f10/601099/news/2445092.html">华股财经</a> <a rel="nofollow" target="_blank" href="http://finance.people.com.cn/n/2015/0310/c1004-26666508.html">人民网财经</a> <a rel="nofollow" target="_blank" href="http://finance.people.com.cn/n/2015/0310/c1004-26666508.html">湖北新闻网</a> <a rel="nofollow" target="_blank" href="http://www.cs.com.cn/sylm/jsbd/201503/t20150309_4660113.html">中证网</a> <a rel="nofollow" target="_blank" href="http://finance.ifeng.com/a/20150309/13541565_0.shtml">凤凰网财经</a> <a rel="nofollow" target="_blank" href="http://www.hb.xinhuanet.com/2015-03/12/c_1114616548.htm">新华网</a> <a rel="nofollow" target="_blank" href="http://lady.gmw.cn/newspaper/2015-03/12/content_105088707.htm">光明网</a> <a rel="nofollow" target="_blank" href="http://www.sznews.com/banking/content/2015-03/11/content_11290575.htm">深圳新闻网</a> <a rel="nofollow" target="_blank" href="http://news.xinmin.cn/shehui/2015/03/10/27012562.html">新民网</a> <a rel="nofollow" target="_blank" href="http://finance.huanqiu.com/roll/2015-03/5952099.html">环球网财经</a> </p>
                  </div>
                </div>
                <div class="thumb"><img src="./other/img_07-3.jpg" alt="京东商城企业宣传新闻"></div>
                <div class="clear"></div>
              </li>
              <li style="display: none; ">
                <div class="desc">
                  <div class="intro">
                    <h3>人人贷企业宣传新闻</h3>
                    <p>定义你自己的金融,中国3A信用评级互联网理财借贷平台,为投资理财用户和贷款用户两端提供公平、透明、安全、高效的互联网金融服务。</p>
                  </div>
                  <div class="report">
                    <h4>部分媒体报道：</h4>
                    <p> <a rel="nofollow" target="_blank" href="http://bank.hexun.com/2015-02-10/173250701.html">和讯网财经</a> <a rel="nofollow" target="_blank" href="http://www.chinairn.com/news/20150211/140714986.shtml">中国行业研究网</a> <a rel="nofollow" target="_blank" href="http://money.163.com/15/0210/19/AI48I3SH00252H36.html">网易财经</a> <a rel="nofollow" target="_blank" href="http://money.163.com/15/0210/19/AI48I3SH00252H36.html">凤凰网财经</a> <a rel="nofollow" target="_blank" href="http://finance.sina.com.cn/stock/t/20150210/175721521262.shtml">新浪网财经</a> <a rel="nofollow" target="_blank" href="http://stock.sohu.com/20150210/n408914244.shtml">搜狐网财经</a> <a rel="nofollow" target="_blank" href="http://www.cs.com.cn/sylm/jsbd/201502/t20150210_4644468.html">中证网</a> <a rel="nofollow" target="_blank" href="http://stock.10jqka.com.cn/20150210/c570706349.shtml">同花顺网</a> <a rel="nofollow" target="_blank" href="http://www.ccstock.cn/2015-02-11/A1423657017714.html">中国资本证券网</a> <a rel="nofollow" target="_blank" href="http://xiaofei.china.com.cn/news/info-11-9-97558.html">中国网消费</a> <a rel="nofollow" target="_blank" href="http://finance.caijing.com.cn/20150211/3820562.shtml">财经网</a> <a rel="nofollow" target="_blank" href="http://www.howbuy.com/news/2015-02-11/2989627.html">好买基金网</a> <a rel="nofollow" target="_blank" href="http://biz.cnhan.com/html/633/2015/0317/5629.html">汉网</a> <a rel="nofollow" target="_blank" href="http://hn.cnr.cn/zyjjq/jjqshxt/20150317/t20150317_518023239.shtml">中国广播网</a> <a rel="nofollow" target="_blank" href="http://money.news18a.com/news/150210/2/story_271103.html">网通社</a> <a rel="nofollow" target="_blank" href="http://news.stcn.com/2015/0212/12027177.shtml">证券时报网</a> </p>
                  </div>
                </div>
                <div class="thumb"><img src="./other/img_07-4.jpg" alt="人人贷企业宣传新闻"></div>
                <div class="clear"></div>
              </li>
            </ul>
          </div>
          <div class="hd">
            <ul>
              <li class="">1</li>
              <li class="">2</li>
              <li class="on">3</li>
              <li class="">4</li>
            </ul>
          </div>
        </div>
        <script type="text/javascript">
						jQuery(".slideBox").slide({mainCell:".bd ul",autoPlay:true});
					</script>
        <!--slideBox end-->
      </div>
    </div>
    <!--wrapper end-->
  </div>
  <!--row_06 end-->
  <div class="row_07">
    <div class="wrapper">
      <div class="bk70"></div>
       <div class="head">
        <div class="box left">
          <div class="hd"> <span><a href="/showallnews.php" target="_blank"><img src="./other/icon_16.png" alt=""></a></span>
            <h3>平台公告</h3>
          </div>
          <div class="bd" style="white-space:nowrap;overflow:hidden;text-overflow:ellipsis;">
            <ul id="news1">
            
            	
<?php
$_result=_query("SELECT * FROM news WHERE hide =1 and lei = 1 ORDER BY px_id DESC  LIMIT 0 , 5");
while (!!$row=_mysql_list($_result)) {
?>
            	<li><a href="shownews.php?sid=<?php echo $row['id']?>" target="_blank"><?php echo $row['title']?></a></li>
<?php }?>
           
            
<!--<em style='float:right;padding-right:5px;'>".date("m-d",strtotime($r['news_time']))."</em>--></ul>
          </div>
        </div>
        <div class="box center">
          <div class="hd">
          <span><a href="/showallnews.php" target="_blank"><img src="./other/icon_16.png" alt=""></a></span>
            <h3>客户案例</h3>
          </div>
          <div class="bd"  style="white-space:nowrap;overflow:hidden;text-overflow:ellipsis;">
            <ul id="news2"> 
           <?php
$_result=_query("SELECT * FROM news WHERE hide =1 and lei = 2 ORDER BY px_id DESC  LIMIT 0 , 5");
while (!!$row=_mysql_list($_result)) {
?>
            	<li><a href="shownews.php?sid=<?php echo $row['id']?>" target="_blank"><?php echo $row['title']?></a></li>
<?php }?>
<!--<em style='float:right;padding-right:5px;'>".date("m-d",strtotime($r['news_time']))."</em>--></ul>
          </div>
        </div>
        <div class="box right">
          <div class="hd">
          <span><a href="/showallnews.php" target="_blank"><img src="./other/icon_16.png" alt=""></a></span>
            <h3>行业新闻</h3>
          </div>
          <div class="bd"  style="white-space:nowrap;overflow:hidden;text-overflow:ellipsis;">
           <ul id="news3"> 
         <?php
$_result=_query("SELECT * FROM news WHERE hide =1 and lei = 3 ORDER BY px_id DESC  LIMIT 0 , 5");
while (!!$row=_mysql_list($_result)) {
?>
            	<li><a href="shownews.php?sid=<?php echo $row['id']?>" target="_blank"><?php echo $row['title']?></a></li>
<?php }?>
<!--<em style='float:right;padding-right:5px;'>".date("m-d",strtotime($r['news_time']))."</em>--></ul>
          </div>
        </div>
        <div class="clear"></div>
      </div>
      <div class="bk70"></div>
      <div class="links">
        <div class="links_top"><span>战略合作伙伴</span></div>
        <ul class="ul_links">
          <li><img src="./other/links_img1.jpg" alt="客户案例" width="158" height="77"></li>
          <li><img src="./other/links_img2.jpg" alt="客户案例" width="158" height="77"></li>
          <li><img src="./other/links_img3.jpg" alt="客户案例" width="158" height="77"></li>
          <li><img src="./other/links_img4.jpg" alt="客户案例" width="158" height="77"></li>
          <li><img src="./other/links_img5.jpg" alt="客户案例" width="158" height="77"></li>
          <li><img src="./other/links_img6.jpg" alt="客户案例" width="158" height="77"></li>
          <li><img src="./other/links_img7.jpg" alt="客户案例" width="158" height="77"></li>
          <li><img src="./other/links_img8.jpg" alt="客户案例" width="158" height="77"></li>
          <li><img src="./other/links_img9.jpg" alt="客户案例" width="158" height="77"></li>
          <li><img src="./other/links_img10.jpg" alt="客户案例" width="158" height="77"></li>
        </ul>
      </div>
      <div class="bk70"></div>
    </div>
    <!--wrapper end-->
  </div>
  <!--row_07 end-->
</div>
<!-- /main -->
<div class="btm_bg">
  <div id="bd" class="btm"> <span>加入 <?php echo $config_name?> 立刻使用新闻稿发布平台！</span> <a target="_blank" rel="nofollow" href="/reg.php"><img src="./other/btn_ljjr.jpg" alt="注册账号" width="236" height="40" style="display:block; float:right; margin-top:13px;"></a> </div>
</div>
<!-- footer -->
<div class="footer com_bg">
  <div class="wrapper">
    <div class="row_08">
      <div class="box1">
        <div class="head">
          <h3>商务合作</h3>
        </div>
        <div class="body">
          <ul>
            <li>QQ：<?php echo $config_qa?></li>
            <li>咨询电话：<?php echo $c_tel?></li>
          </ul>
        </div>
      </div>
      <!--box1 end-->
      <div class="box2">
        <div class="head">
          <h3>服务咨询</h3>
        </div>
        <div class="body">
          <ul>
            <li>客服一：<?php echo $config_qa?>（主管）<a target="_blank" rel="nofollow" href="http://wpa.qq.com/msgrd?v=3&uin=<?php echo $config_qa?>&site=qq&menu=yes"><img border="0" src="./other/button_121.gif" alt="点击这里给我发消息" title="点击这里给我发消息"></a></li>
            <li>客服二：<?php echo $config_qb?>（客服）<a target="_blank" rel="nofollow" href="http://wpa.qq.com/msgrd?v=3&uin=<?php echo $config_qb?>&site=qq&menu=yes"><img border="0" src="./other/button_121.gif" alt="点击这里给我发消息" title="点击这里给我发消息"></a></li>
          </ul>
        </div>
      </div>
      <!--box2 end-->
      <div class="box3">
        <div class="head">
          <h3>联系我们</h3>
        </div>
        <div class="body">
          <ul>
            <li>电话：<?php echo $c_tel?></li>
            <li>邮箱：<?php echo $c_email?></li>
            
            <li>地址：<?php echo $c_dress?></li>
          </ul>
        </div>
      </div>
      <!--box3 end-->
      <div class="box4">
        <div class="head">
          <h3></h3>
        </div>
        <div class="body"><a href="/" target="_blank"></a></div>
      </div>
     <!-- box4 end-->
      <div class="clear"></div>
    </div>
  </div>
  <!--row_08 end-->
  <div class="copyright">
    <div class="thumb">
      <ul>
        <li><img src="./other/img74.gif"></li>
        <li><img src="./other/img75.gif"></li>
        <li><img src="./other/img76.gif"></li>
        <li><img src="./other/img77.png"></li>
      </ul>
    </div>
    <div class="foot_txt">
      <p><?php echo $config_name?>&nbsp;<a href="">(<?php echo $c_ym?>)</a>&nbsp;&nbsp;© 2017-2019&nbsp;All Right Reserved.&nbsp;&nbsp;法律顾问：刘飞</p>
      <p><a href="http://www.miibeian.gov.cn/" rel="nofollow" target="_blank"></a> <?php echo $c_bah?>版权所有：<?php echo $c_comp?> <a href=""><strong>软文推广</strong></a>首选（<a href="/"><b><?php echo $config_name?></b></a>）新闻稿自助发布平台</p>
      <p><?php echo $config_name?>是国内最大的软文发布平台，隶属于<?php echo $c_comp?>，是您选择软文推广的最佳服务商，<?php echo $config_name?>：老品牌、大影响、高效率、发遍全网络！</p>
    </div>
    <div class="clear"></div>
  </div>
  <!--wrapper end-->
</div>
<!-- /footer -->
<script type="text/javascript">
   $(function(){
 	 $.get("user/indexlogin.php",{"num":10},function(data){
		if(data.length>3)
		{ 
			$("#loginform").css("display","none");
			$(".logined").css("display","block");
			$(".userNameTxt").html(data);
		}
	});
	$(".otherLoginBtn").click(function(){
		$("#loginform").css("display","block");
		$(".logined").css("display","none");
	});
	$.get("inc/indexnews.php",{"num":5},function(data){
		$("#news1").html(data); 
	});

	$.get("inc/indexnews.php",{"num":5,"type":3},function(data){
		$("#news2").html(data); 
	});
	
	$.get("inc/indexnews.php",{"num":5,"type":4},function(data){
		$("#news3").html(data); 
	});
})
</script>

<!--kefu-->
<div id="floatTools" class="rides-cs" style="height:246px;">
  <div class="floatL">
  	<a style="display:block" id="aFloatTools_Show" class="btnOpen" title="查看在线客服" style="top:20px" href="javascript:void(0);">展开</a>
  	<a style="display:none" id="aFloatTools_Hide" class="btnCtn" title="关闭在线客服" style="top:20px" href="javascript:void(0);">收缩</a>
  </div>
  <div id="divFloatToolsView" class="floatR" style="display: none;height:237px;width: 140px;">
    <div class="cn">
      <h3 class="titZx"><?php echo $config_name?>在线客服</h3>
      <ul>
        <li><span>客服一</span> <a target="_blank" href="http://wpa.qq.com/msgrd?v=3&uin=<?php echo $config_qa?>&site=qq&menu=yes"><img border="0" src="images/online.png" alt="点击这里给我发消息" title="点击这里给我发消息"/></a> </li>
        <li><span>客服二</span> <a target="_blank" href="http://wpa.qq.com/msgrd?v=3&uin=<?php echo $config_qb?>&site=qq&menu=yes"><img border="0" src="images/online.png" alt="点击这里给我发消息" title="点击这里给我发消息"/></a> </li>
        <li><span>客服三</span> <a target="_blank" href="http://wpa.qq.com/msgrd?v=3&uin=<?php echo $config_qc?>&site=qq&menu=yes"><img border="0" src="images/online.png" alt="点击这里给我发消息" title="点击这里给我发消息"/></a> </li>
      
      
        <li style="border:none;"><span>电话：<?php echo $c_tel?></span> </li>
      </ul>
    </div>
  </div>
</div>
<!--kefu-->

</body></html>