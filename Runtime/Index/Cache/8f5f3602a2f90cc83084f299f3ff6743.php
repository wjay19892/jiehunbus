<?php if (!defined('THINK_PATH')) exit();?><!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title><?php if(empty($title)): ?><?php echo C("sysconfig.site_title");?><?php else: ?><?php echo ($title); ?><?php endif; ?></title>
<meta name="title" content="<?php if(empty($title)): ?><?php echo C("sysconfig.site_title");?><?php else: ?><?php echo ($title); ?><?php endif; ?>" />
<meta name="keywords" content="<?php if(empty($keywords)): ?><?php echo C("sysconfig.site_keywords");?><?php else: ?><?php echo ($keywords); ?><?php endif; ?>" />
<meta name="description" content="<?php if(empty($description)): ?><?php echo C("sysconfig.site_description");?><?php else: ?><?php echo ($description); ?><?php endif; ?>" />
<link type="text/css" rel="stylesheet" media="screen" href="../Public/css/jvf_common.css" />
<?php if(!empty($memberdata) AND (C('sysconfig.is_open_chat') == 1) ): ?><link href="../Public/css/chat.css" rel="stylesheet" type="text/css" /><?php endif; ?>
<script src="__PUBLIC__/dwz/js/jquery-1.7.2.min.js"></script>
<script src="__PUBLIC__/dwz/js/jquery-ui-1.8.19.custom.min.js" type="text/javascript"></script>
<script src="<?php echo U('Index/language');?>" type="text/javascript"></script>

<script type="text/javascript">
	var ROOT = '__ROOT__';
	var APP = '__APP__';
	var URL = '__SELF__';
	var ACTION = '<?php echo constant("MODULE_NAME");?>';
	var PUBLIC = '__PUBLIC__';
	var IMG_PATH = '../Public/images/';
	var TPL_PUBLIC = '../Public/';
	var ISCHAT = <?php echo C("sysconfig.is_open_chat");?>;
	var ICON = "../Public/images/bmarker_orange.png";
	<?php if(($memberdata["step"])  ==  "0"): ?>var first_landing = true;
	<?php else: ?>
	var first_landing = false;<?php endif; ?>
</script>
<!--[if IE 6]>
		<script src="../Public/js/DD_belatedPNG_0.0.8a-min.js" type="text/javascript"></script>
		<script type="text/javascript">
		try { 
			document.execCommand('BackgroundImageCache', false, true); 
        } catch (e) {
        }
		DD_belatedPNG.fix('.jvf_allimg,img,li,span,.fujin_ico,.rating,.filled,.header_top_mubg a,.jvf_ui_bgtb,.jvf_ui_bg,.header,.header_con_menu ul li a,.jvf_ico,.pagination li a,.linkbg,.filled_big,.rating_big,.attestation');
		</script>
<![endif]-->

<script src="../Public/js/common.js" type="text/javascript"></script>
<script src="../Public/js/scrolltopcontrol.js" type="text/javascript"></script>
<body>
</head>

<!--头部——开始-->
	<div class="header ie6fixedTL">
    	<div class="header_top clearfix">
            <ul class="top_menul jvf_fl clearfix">
            	<?php if(C('sysconfig.is_switch_region')): ?><li class="header_top_mubg left_mu1 clearfix">
                	<span class="jvf_fl spanno1" ><em class="jvf_ico"></em><?php echo ($switch_region["crr"]["name"]); ?></span>
                    <a class="jvf_fl" href="<?php echo U('Index/city');?>">[<?php echo L("select_city");?>]</a></li>
            	<li>|</li><?php endif; ?>
                <li class="header_top_mubg left_mu2"><a href="<?php echo U('Index/visit_location');?>">
                <em></em> <?php echo L("visit_location");?></a>
                	<span class="weizhi_con" style="display:none;"><?php echo ($locate["address"]); ?><em class="weizhi_top_j jvf_allimg"></em></span>
                </li>
                <?php if(!empty($memberdata)): ?><li>|</li>
                <li class="header_top_mubg left_mu3"><a href="<?php echo U('Member/inbox');?>">
                <em></em>
                <?php echo L("inbox_text");?><span>(<?php echo ($memberdata["message"]); ?>)</span></a> </li>
                <li>|</li>
                <li class="header_top_mubg left_mu4"><a href="<?php echo U('Search/index/favorites/my');?>">				
                <em></em>
                <?php echo L("favorites_text");?><span>(<?php echo ($memberdata["favorites"]); ?>)</span></a></li><?php endif; ?>
                <li>|</li>
                <li class="header_top_mubg left_mu5"><a href="<?php echo U('Goods/shoppingCart');?>">
                <em></em>
                <?php echo L("shoppingcart");?><span>(<span id="shoppingCartNum"><?php echo ($shoppingCartNum); ?></span>)</span></a></li>
            </ul>
            
            <ul class="top_menur jvf_fr clearfix">
            	<?php if(empty($memberdata)): ?><li><?php echo L("please_first");?></li>
                <li><a href="<?php echo U('User/signin');?>">[&nbsp;<?php echo L("login_text");?>&nbsp;]</a></li>
                <li><?php echo L("please_after");?></li>
                <li><a href="<?php echo U('User/register');?>">[&nbsp;<?php echo L("reg_text");?>&nbsp;]</a></li>
                <?php else: ?>
                <li class="left_mu1"><?php echo L("welcome_home");?></li>
                <li>，</li>
                <li><a href="<?php echo U('User/space/id/'.$memberdata['id']);?>"><?php echo ($memberdata["name"]); ?></a></li>
                <li>|</li>
                <li><a href="<?php echo U('Member/index');?>"><?php echo L("member_center");?></a> </li>
                <li>|</li>
				<?php if(($memberdata["isbusiness"])  ==  "1"): ?><li><a href="<?php echo U('Goods/release');?>">发布商品</a></li>
                <li>|</li><?php endif; ?>
                <li><a href="<?php echo U('User/logout');?>"><?php echo L("login_out");?></a></li><?php endif; ?>
                <!--<li>|</li>
                <li class="header_top_mubg right_mu1"><a href="<?php echo U('Help/index');?>">
                <em></em>
                <?php echo L("help_text");?></a></li>
                -->
            </ul>
        </div>
        
        <div class="header_con clearfix">
        	<div class="header_logo jvf_fl">
            	<h1><a href="__ROOT__"><img src="__ROOT__<?php echo C("sysconfig.site_logo");?>" alt="<?php echo C("sysconfig.site_name");?>" /></a></h1>
            </div>
            <div class="jvf_fl header_con_menu">
            	<ul>
            	<?php if(is_array($mainnav)): $i = 0; $__LIST__ = $mainnav;if( count($__LIST__)==0 ) : echo "" ;else: foreach($__LIST__ as $key=>$vo): ++$i;$mod = ($i % 2 )?><li <?php if(($vo["isdefault"] == 1) OR (__SELF__ == $vo['url']) ): ?>class="menu_active"<?php endif; ?>><a href="<?php echo ($vo["url"]); ?>" <?php if(($vo["isblank"])  ==  "1"): ?>target="_blank"<?php endif; ?> ><?php echo ($vo["title"]); ?></a></li><?php endforeach; endif; else: echo "" ;endif; ?>
                </ul>
            </div>
           <!--搜索
            <div class="header_search jvf_fr clearfix">
            	<form id="searchForm" action="<?php echo U('Search/index');?>" method="get">
                <span class="header_search_inp1">
                	<div class="moren"><?php echo L("search_goods");?></div>
                	<ul style="display: none;">
                    	<li><a href="javascript:;" rel="<?php echo U('Search/index');?>"><?php echo L("search_goods");?></a></li>
                    </ul>
                </span>
                <span class="header_search_inp2"><input type="text" placeholder="<?php echo L("search_input_tip");?>" name="search_key"></span>
                <span class="header_search_but"><input type="button" value="<?php echo L("search_text");?>" name="submit_button"></span>
                </form>
        	</div>
            -->
        </div>
    </div>
<!--头部——结束-->
<script>
	$(function(){
		userFriends(<?php echo ($userdata['id']); ?>);
	});
</script>
<div class="mainbody body_bot body_con clearfix">
	<div class="jvf_member_body clearfix">
       <div class="mb_left jvf_fl3">
       		<!--粉丝-->
            <div class="mb_left_con">
            	<h2 class="jvf_space_tit"><?php echo L("ta_friend_said");?></h2>
            	<div class="left_box"></div>
            	<div class="jvf_page" style="display:none;">
				</div>
            </div>
            <!--粉丝-->
       </div>
       <div class="mb_right jvf_fr3">
<div class="mb_head_user mg0a" style="padding-top:10px;">
       <div class="mb_head_img">
  	<a href="<?php echo U('User/space/id/'.$userdata['id']);?>"><img src="<?php echo ($userdata["header"]["path"]); ?>" /></a>
      <div class="space_operation clearfix" style="padding-left:1px; z-index:1;">
          <a href="<?php echo U('Member/addfriend/id/'.$userdata['id']);?>"><?php echo L("addfriend");?></a>
          <a href="<?php echo U('Member/sendpm/id/'.$userdata['id']);?>"><?php echo L("send_message");?></a>
          <a href="javascript:;" uid="<?php echo ($userdata['id']); ?>" class="jvf_callme"><?php echo L("to_chat");?></a>
      </div>
      <div class="attestation"></div>
  </div>
  <div class="mb_username clearfix"><a charset="jvf_fl" href="<?php echo U('User/space/id/'.$userdata['id']);?>">
	<?php if(($userdata["isbusiness"])  ==  "1"): ?><?php echo ($userdata["business"]["name"]); ?></br>
	(<?php echo L("goods_manager");?>:<?php echo ($userdata["name"]); ?>)
	<?php else: ?>
	<?php echo ($userdata["name"]); ?><?php endif; ?>
  	<?php if(($userdata["sex"])  ==  "0"): ?><span class="jvf_ico unman" ><?php endif; ?>
  	<?php if(($userdata["sex"])  ==  "1"): ?><span class="jvf_ico man" ><?php endif; ?>
  	<?php if(($userdata["sex"])  ==  "2"): ?><span class="jvf_ico woman" ><?php endif; ?>
  </span></a></div>
 
  <div class="jvf_space clearfix">
      <ul>
          <li class="jvf_fl">
              <a href="<?php echo U('User/evaluate/id/'.$userdata['id']);?>">(<?php echo ($userdata["evaluate"]); ?>)</a><br>
              <?php echo L("ta_evaluation_goods");?>
          </li>
          <li class="jvf_fr">
              <a href="<?php echo U('User/recommend/id/'.$userdata['id']);?>">(<?php echo ($userdata["recommend"]); ?>)</a><br>
              <?php echo L("ta_recommend_goods");?>
          </li>
      </ul>
  </div>  
  <div class="space_verification clearfix">
  	<span class="sp1 jvf_fl"><?php echo L("verification_text");?>：</span>
      <div class="sp2 jvf_fl clearfix"><span class="mail jvf_allimg jvf_fl"  title="<?php echo L("mail_verification");?>"></span><span class="jvf_fl"><?php if(($userdata["mailstatus"])  ==  "0"): ?><?php echo L("not_verified");?><?php else: ?><?php echo L("verified");?><?php endif; ?></span></div>
      <div class="sp3 jvf_fl clearfix"><span class="mobile jvf_allimg jvf_fl" title="<?php echo L("phone_verification");?>"></span><span class="jvf_fl"><?php if(($userdata["phonestatus"])  ==  "0"): ?><?php echo L("not_verified");?><?php else: ?><?php echo L("verified");?><?php endif; ?></span></div>
      <div class="sp4 jvf_fl clearfix"><span class="tmall jvf_allimg jvf_fl" title="商家验证"></span><span class="jvf_fl"><?php if(($userdata["phonestatus"])  ==  "0"): ?><?php echo L("not_verified");?><?php else: ?><?php echo L("verified");?><?php endif; ?></span></div>
  </div>
  		
<div class="jvf_spaadr"><?php echo L("default_location");?>：<a href="javascript:;" class="jvf_address" uid="<?php echo ($userdata["id"]); ?>"><?php echo ($userdata["address"]); ?><span class="jvf_juli fujin_ico"><?php echo distance($locate['lat'],$locate['lng'],$userdata['location']['lat'],$userdata['location']['lng']);?></span></a></div>
<div class="clearfix shop_renzheng">
	<!-- <div class="jvf_shopman jvf_fl">
      <span class="shopman_ico jvf_allimg jvf_fl" title="<?php echo L("businesses_certified");?>"></span>
      <span class="jvf_fl" style="line-height: 28px;margin-left: 7px;"><?php echo L("businesses_certified");?></span>
    </div> -->
    <div  class="space_guanzhu jvf_fr">
    	<?php if(!in_array($userdata['id'],$memberdata['attention_ids'])): ?><a href="<?php echo U('Member/attention/id/'.$userdata['id']);?>" add="add"><?php echo L("user_add_attention");?></a>
    	<?php else: ?>
    	<a href="<?php echo U('Member/removeattention/id/'.$userdata['id']);?>" remove="remove"><?php echo L("user_remove_attention");?></a><?php endif; ?>
    	</div>
    </div>
</div>
<div class="mb_nav">
	<div class="jvf_shuo <?php if((ACTION_NAME)  ==  "space"): ?>current<?php endif; ?>">
    	<a class="jvf_allimg" href="<?php echo U('User/space/id/'.$userdata['id']);?>"><em class="jvf_allimg jvf_shuo_ico"></em><?php echo L("ta_talk_about");?><span>(<?php echo ($userdata["talk_about"]); ?>)</span></a>
    </div>
    <div class="jvf_fesi <?php if((ACTION_NAME)  ==  "attention"): ?>current<?php endif; ?>">
    	<a class="jvf_allimg" href="<?php echo U('User/attention/id/'.$userdata['id']);?>"><em class="jvf_allimg jvf_fesi_ico"></em><?php echo L("ta_audience");?><span>(<?php echo ($userdata["was_attention"]); ?>)</span></a>
    </div>
    <div class="jvf_guzu <?php if((ACTION_NAME)  ==  "wasAttention"): ?>current<?php endif; ?>">
    	<a class="jvf_allimg" href="<?php echo U('User/wasAttention/id/'.$userdata['id']);?>"><em class="jvf_allimg jvf_guzu_ico"></em><?php echo L("ta_listen");?><span>(<?php echo ($userdata["attention"]); ?>)</span></a>
    </div>
    <div class="jvf_hayo <?php if((ACTION_NAME)  ==  "friends"): ?>current<?php endif; ?>">
    	<a class="jvf_allimg" href="<?php echo U('User/friends/id/'.$userdata['id']);?>"><em class="jvf_allimg jvf_hayo_ico"></em><?php echo L("ta_friends");?><span>(<?php echo ($userdata["friends"]); ?>)</span></a>
    </div>
    <div class="jvf_zila <?php if((ACTION_NAME)  ==  "info"): ?>current<?php endif; ?>">
    	<a class="jvf_allimg" href="<?php echo U('User/info/id/'.$userdata['id']);?>"><em class="jvf_allimg jvf_zila_ico"></em><?php echo L("ta_data");?></a>
    </div>
	<?php if(($userdata["isbusiness"])  ==  "1"): ?><div class="jvf_zila <?php if((ACTION_NAME)  ==  "goods"): ?>current<?php endif; ?>">
    	<a class="jvf_allimg" href="<?php echo U('User/goods/id/'.$userdata['id']);?>"><em class="jvf_allimg jvf_shop_ico"></em>TA发布的商品<span>(<?php echo ($userdata["goodsnum"]); ?>)</span></a>
    </div><?php endif; ?>
    </div>
</div>
       </div>
	</div>
</div>
<!--jvf_list-->
<div class="jvf_list body_bot">
	<div class="pad10 clearfix">
		<?php if(is_array($footerArticle)): $i = 0; $__LIST__ = $footerArticle;if( count($__LIST__)==0 ) : echo "" ;else: foreach($__LIST__ as $key=>$vo): ++$i;$mod = ($i % 2 )?><div class="jvf_list_con jvf_fl">
            <ul>
            <?php if(is_array($vo["article"])): $i = 0; $__LIST__ = $vo["article"];if( count($__LIST__)==0 ) : echo "" ;else: foreach($__LIST__ as $key=>$v): ++$i;$mod = ($i % 2 )?><li><a href="<?php echo U('Help/index/id/'.$v['id']);?>"><?php echo ($v["title"]); ?></a></li><?php endforeach; endif; else: echo "" ;endif; ?>
            </ul>
        </div><?php endforeach; endif; else: echo "" ;endif; ?>
        
       
        <!--logo显示 <div class="jvf_list_con jvf_logobot jvf_fl">
            <a href=""><img width="200" height="114" src="../Public/images/jvf_logo.jpg"></a>
        </div>-->
    </div>
</div>
<!--jvf_list_end-->
<!--footer-->
<div class="footer">
	<div class="body_con">
        <div class="link clearfix">
            <span class="jvf_fl"><?php echo L("links");?>：</span>
            <ul class="jvf_fl">
               <?php if(is_array($linkdata)): $i = 0; $__LIST__ = $linkdata;if( count($__LIST__)==0 ) : echo "" ;else: foreach($__LIST__ as $key=>$vo): ++$i;$mod = ($i % 2 )?><li>
					<a href="<?php echo ($vo["url"]); ?>">
					<?php if(($vo["type"])  ==  "1"): ?><img src="__ROOT__<?php echo ($vo["logo"]); ?>"><?php else: ?><?php echo ($vo["name"]); ?><?php endif; ?>
					</a>
				  </li><?php endforeach; endif; else: echo "" ;endif; ?>
            </ul>
        </div>
    </div>
    <div class="linkbg"></div>
    <div class="body_con">
    <div class="footernav">
		  <?php if(is_array($footernav)): $i = 0; $__LIST__ = $footernav;if( count($__LIST__)==0 ) : echo "" ;else: foreach($__LIST__ as $key=>$vo): ++$i;$mod = ($i % 2 )?><?php if(($key)  !=  "0"): ?><span>|</span><?php endif; ?>
		  <span> <a href="<?php echo ($vo["url"]); ?>" title="<?php echo ($vo["title"]); ?>" 
		  <?php if(($vo["isblank"])  ==  "1"): ?>target="_blank"<?php endif; ?>
		  ><?php echo ($vo["title"]); ?></a> </span><?php endforeach; endif; else: echo "" ;endif; ?>
	</div>
          <div id="copyright">
      <?php echo L("services_tel");?>：<?php echo C("sysconfig.site_services_tel");?>&nbsp;&nbsp;&nbsp;&nbsp;<?php echo L("services_mail");?>：<?php echo C("sysconfig.site_services_email");?>&nbsp;&nbsp;&nbsp;&nbsp;<?php echo L("work_times");?>：<?php echo C("sysconfig.site_work_times");?> </div>
    	  <div id="copyright"><?php echo C("sysconfig.site_powerby");?>&nbsp;&nbsp;<a target="_blank" href="http://www.miibeian.gov.cn/"><?php echo C("sysconfig.site_beian");?></a></div>
		  <div id="copyright"><?php echo stripslashes(C('sysconfig.site_tongji'));?></div>
     </div>
</div>
<!--footer_end-->
</body>
</html>