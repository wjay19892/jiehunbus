<?php if (!defined('THINK_PATH')) exit();?><!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<meta http-equiv="X-UA-Compatible" content="IE=7" />
<title><?php echo C("sysconfig.site_name");?></title>

<link href="__PUBLIC__/dwz/themes/default/style.css" rel="stylesheet" type="text/css"/>
<link href="__PUBLIC__/dwz/themes/css/core.css" rel="stylesheet" type="text/css"/>
<link href="../Public/css/common.css" rel="stylesheet" type="text/css"/>
<!--[if IE]>
<link href="__PUBLIC__/dwz/themes/css/ieHack.css" rel="stylesheet" type="text/css"/>
<![endif]-->

<script src="__PUBLIC__/dwz/js/speedup.js" type="text/javascript"></script>
<script src="__PUBLIC__/dwz/js/jquery-1.7.2.min.js" type="text/javascript"></script>
<script src="__PUBLIC__/dwz/js/jquery.dragsort-0.4.3.min.js" type="text/javascript"></script>
<script src="__PUBLIC__/dwz/js/jquery.cookie.js" type="text/javascript"></script>
<script src="__PUBLIC__/dwz/js/jquery.validate.js" type="text/javascript"></script>
<script src="__PUBLIC__/dwz/js/jquery.bgiframe.js" type="text/javascript"></script>
<script src="__PUBLIC__/xheditor/xheditor-1.1.9-zh-cn.min.js" type="text/javascript"></script>
<script src="__PUBLIC__/dwz/js/jquery.ajaxupload.js" type="text/javascript"></script>
<script src="__PUBLIC__/dwz/js/dwz.min.js" type="text/javascript"></script>
<script src="__PUBLIC__/dwz/js/dwz.regional.zh.js" type="text/javascript"></script>
<script src="__PUBLIC__/dwz/js/jquery.qqFace.min.js" type="text/javascript"></script>
<script src="../Public/js/common.js" type="text/javascript"></script>
<style type="text/css">
	#header{height:85px}
	#leftside, #container, #splitBar, #splitBarProxy{top:90px}
</style>
<script type="text/javascript">
function fleshVerify(){
	//重载验证码
	$('#verifyImg').attr("src", '__APP__/Public/verify/'+new Date().getTime());
}
function dialogAjaxMenu(json){
	dialogAjaxDone(json);
	if (json.statusCode == DWZ.statusCode.ok){
		$("#sidebar").loadUrl("__APP__/Public/menu");
	}
}
function navTabAjaxMenu(json){
	navTabAjaxDone(json);
	if (json.statusCode == DWZ.statusCode.ok){
		$("#sidebar").loadUrl("__APP__/Public/menu");
	}
}
$(function(){
	DWZ.init("__PUBLIC__/dwz/dwz.frag.xml", {
		loginUrl:"__APP__/Public/login_dialog", loginTitle:"登录",	// 弹出登录对话框
//		loginUrl:"__APP__/Public/login",	//跳到登录页面
		statusCode:{ok:1,error:0},
		pageInfo:{pageNum:"pageNum", numPerPage:"numPerPage", orderField:"_order", orderDirection:"_sort"}, //【可选】
		debug:false,	// 调试模式 【true|false】
		callback:function(){
			initEnv();
			$("#themeList").theme({themeBase:"__PUBLIC__/dwz/themes"});
		}
	});
	
});
//清理浏览器内存,只对IE起效，FF不需要
if ($.browser.msie) {
	window.setInterval("CollectGarbage();", 10000);
}
</script>
<script type="text/javascript"> 
var HOST        = window.location.host;
var Per_host    ="http://"+HOST;
var ROOT = '__ROOT__';
var PUBLIC      ='__PUBLIC__';
var URL     ='__URL__';
var APP     ='__APP__';
</script>
<script type="text/javascript" src="http://api.map.baidu.com/api?v=1.3"></script>
</head>

<body scroll="no">
	<div id="layout">
		<div id="header">
			<div class="headerNav">
				<a href="__APP__">首 页</a>
				<ul class="nav">
                	
					<li><a href="__APP__/Public/clearCache" target="ajaxTodo" >清空缓存</a></li>
                    <li><a href="__ROOT__/index.php" target="_blank" >前台首页</a></li>
					<li><a href="__APP__/Public/main" target="dialog" width="580" height="360" rel="sysInfo">系统消息</a></li>
					<li><a href="__APP__/Public/password/" target="dialog" mask="true">修改密码</a></li>
					<li><a href="__APP__/Public/profile/" target="dialog" mask="true">修改资料</a></li>
					<li><a href="__APP__/Public/logout/">退出</a></li>
				</ul>
				<ul class="themeList" id="themeList">
					<li theme="default"><div class="selected">蓝色</div></li>
					<li theme="green"><div>绿色</div></li>
					<li theme="purple"><div>紫色</div></li>
					<li theme="silver"><div>银色</div></li>
				</ul>
			</div>
					
			<div id="navMenu">
				<ul>
                    <?php if(is_array($topmenu)): $i = 0; $__LIST__ = $topmenu;if( count($__LIST__)==0 ) : echo "" ;else: foreach($__LIST__ as $key=>$item): ++$i;$mod = ($i % 2 )?><li <?php if(($item['id'])  ==  $topmenuid): ?>class="selected"<?php endif; ?>>
                    	<a href="<?php echo U('Public/menu/id/'.$item['id']);?>"><span><?php echo ($item["name"]); ?></span></a>
                    </li><?php endforeach; endif; else: echo "" ;endif; ?>
				</ul>
			</div>
		</div>
		
		<div id="leftside">
			<div id="sidebar_s">
				<div class="collapse">
					<div class="toggleCollapse"><div></div></div>
				</div>
			</div>
			
			<div id="sidebar">
				<div class="toggleCollapse"><h2>主菜单</h2><div>收缩</div></div>
					
<div class="accordion" fillSpace="sideBar">
    <?php if(is_array($groupdata)): $i = 0; $__LIST__ = $groupdata;if( count($__LIST__)==0 ) : echo "" ;else: foreach($__LIST__ as $key=>$vo): ++$i;$mod = ($i % 2 )?><div class="accordionHeader">
		<h2><span>Folder</span><?php echo ($vo["title"]); ?></h2>
	</div>
	<div class="accordionContent">
	
		<ul class="tree treeFolder">
			<?php if(is_array($vo["menu"])): $i = 0; $__LIST__ = $vo["menu"];if( count($__LIST__)==0 ) : echo "" ;else: foreach($__LIST__ as $key=>$item): ++$i;$mod = ($i % 2 )?><?php if((strtolower($item['name']))  !=  "public"): ?><?php if((strtolower($item['name']))  !=  "index"): ?><?php if(($item['access'])  ==  "1"): ?><li><a href="__APP__/<?php echo ($item['name']); ?>/index/" target="navTab" rel="<?php echo ($item['name']); ?>"><?php echo ($item['title']); ?></a></li><?php endif; ?><?php endif; ?><?php endif; ?><?php endforeach; endif; else: echo "" ;endif; ?>
		</ul>

	</div><?php endforeach; endif; else: echo "" ;endif; ?>

</div>

			</div>
		</div>

		<div id="container">
			<div id="navTab" class="tabsPage">
				<div class="tabsPageHeader">
					<div class="tabsPageHeaderContent"><!-- 显示左右控制时添加 class="tabsPageHeaderMargin" -->
						<ul class="navTab-tab">
							<li tabid="main" class="main"><a href="javascript:void(0)"><span><span class="home_icon">我的主页</span></span></a></li>
						</ul>
					</div>
					<div class="tabsLeft">left</div><!-- 禁用只需要添加一个样式 class="tabsLeft tabsLeftDisabled" -->
					<div class="tabsRight">right</div><!-- 禁用只需要添加一个样式 class="tabsRight tabsRightDisabled" -->
					<div class="tabsMore">more</div>
				</div>
				<ul class="tabsMoreList">
					<li><a href="javascript:void(0)">我的主页</a></li>
				</ul>
				<div class="navTab-panel tabsPageContent">
					<div>
						<div class="accountInfo">
							<div class="right">
								<p><?php echo (date('Y-m-d g:i a',time())); ?></p>
							</div>
							<p><span><?php echo C("sysconfig.site_name");?></span></p>
							<p>欢迎登陆, <?php echo ($_SESSION['loginUserName']); ?></p>
						</div>
						<div class="pageFormContent" layoutH="80">
							<div class="jvf_ad_ind">
                                <ul>
                                    <li>未处理的投诉<a href="<?php echo U('Complaint/index/status/0');?>" target="navTab" rel="Complaint" title="投诉"><?php echo (($complaintCount)?($complaintCount):0); ?></a></li>
                                
                                <li>未处理的发布<a href="<?php echo U('Release/index/audit/1');?>" target="navTab" rel="Release" title="发布"><?php echo (($releaseCount)?($releaseCount):0); ?></a></li>
                                
                               <!-- <li>未处理的提现<a href="<?php echo U('Withdraw/index/status/0');?>" target="navTab" rel="Withdraw" title="提现"><?php echo (($withdrawCount)?($withdrawCount):0); ?></a></li>
                                <li>未处理的退款<a href="<?php echo U('Refunds/index/status/0');?>" target="navTab" rel="Refunds" title="退款"><?php echo (($refundsCount)?($refundsCount):0); ?></a></li>-->
                                </ul>
                            </div>
						</div>
					</div>
				</div>
			</div>
		</div>

	</div>
	
	<div id="footer">Copyright &copy; 2012-2013 <a href="http://www.jiehunbus.com" target="_blank">jiehunbus.com</a></div>


</body>
</html>