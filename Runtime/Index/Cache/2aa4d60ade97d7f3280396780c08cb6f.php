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
	memberAdministration();
});
</script>
<div class="mainbody body_bot body_con clearfix">
	<div class="jvf_member_body clearfix">
       <div class="mb_left jvf_fl3">
       		<div class="mb_left_con">
            	 <!--发表感受-->
<div class="jvf_frame detail_left_con clearfix">
	<div class="jvf_sendcnt_tit"></div>
	<!--<?php echo L("jvf_sendcnt_tit");?>-->
	<form id="talk_aboutBox">
	<div class="jvf_sendcnt">
    	<div class="jvf_cntbox">
    	<textarea tabindex="1" autocomplete="off" name="content"></textarea></div>
    	<div class="jvf_insertfun pr clearfix">
			<div class="jvf_fl">
				<a href="javascript:;" id="face"><em class="inserttximg jvf_allimg"></em><?php echo L("face_text");?></a>
				<a href="javascript:;" id="imgs"><em class="insertimg jvf_allimg"></em><?php echo L("photos_text");?></a>
				<a href="javascript:;" id="label"><em class="newtopicimg jvf_allimg"></em><?php echo L("topic");?></a>
				<!--<a href="javascript:;" id="friend"><em class="friendimg jvf_ico"></em><?php echo L("friend");?></a>-->
			</div>
            <div class="together jvf_fr">
            	<span class="hackie right_f share_published"> <span style="top:-3px; *top:0px; position: relative;">同步到：</span>  
				<?php if($_SESSION['sina']['bind']){ ?>
				<a class="jvf_tongbu go_sina" title="取消同步到新浪微博" href="<?php echo U('Member/removeWeibo');?>"></a>
				<?php }else{ ?>
				<a class="jvf_tongbu close_sina" <?php if(empty($_SESSION['sina'])){ ?>type="0"<?php } ?> title="你还没有授权新浪微博，点击去授权" href="<?php echo U('Member/bindWeibo');?>"></a>
				<?php } ?>
				<?php if($_SESSION['qq']['bind']){ ?>
				<a class="jvf_tongbu go_qzone" title="取消同步到QQ空间" href="<?php echo U('Member/removeQQ');?>"></a>
				<?php }else{ ?>
				<a class="jvf_tongbu close_qzone" <?php if(empty($_SESSION['qq'])){ ?>type="0"<?php } ?> title="你还没有授权QQ空间，点击去授权" href="<?php echo U('Member/bindQQ');?>"></a>
				<?php } ?>
				</span>
            </div>
        </div>
        <div class="jvf_sample_list clearfix" style="display: none;"></div>
    </div>
    <div class="jvf_sendbutj clearfix">
    	<span class="jvf_quanzi jvf_fl" id="quanzhi"><span><?php echo L("circle");?>：</span>
    		<?php if(is_array($oftenLabel)): $i = 0; $__LIST__ = $oftenLabel;if( count($__LIST__)==0 ) : echo "" ;else: foreach($__LIST__ as $key=>$vo): ++$i;$mod = ($i % 2 )?><a href="javascript:;" lid="<?php echo ($vo["id"]); ?>"><?php echo ($vo["name"]); ?></a><?php endforeach; endif; else: echo "" ;endif; ?>
    	</span>
		<div class="jvf_fr">
        <span class="jvf_sendbut"><a class="jvf_allimg" href="javascript:;" id="submit"><?php echo L("post_text");?></a></span>
        <span class="jvf_counttxt" id="textNum"><?php echo L("can_enter");?><em>140</em><?php echo L("word_text");?></span>
		</div>
    </div>
    </form>
</div>
<div class="detail_bot jvf_allimg"></div>
 <!--发表感受-->
      			<div class="extension_top">
                	<ul class="clearfix">
                    	<li><a href="<?php echo U('Member/friends');?>" get="get"><?php echo L("friends_management");?></a></li>
                        <li><a href="<?php echo U('Member/myattention');?>" get="get"><?php echo L("listen_management");?></a></li>
                        <li><a href="<?php echo U('Member/reviews');?>" get="get"><?php echo L("my_evaluation_goods");?></a></li>
                        <li><a href="<?php echo U('Member/references');?>" get="get"><?php echo L("my_recommend_goods");?></a></li>
                    </ul>
                </div>
                <div class="clearfix administration_box">
                	<!--好友管理-->
                	<div class="administration_item"></div>
                    <!--好友管理——end-->
                    <!--听众管理-->
                	<div class="administration_item" style="display:none;"></div>
                    <!--听众管理——end-->
                    <!--您评价的-->
                	<div class="administration_item" style="display:none;"></div>
                    <!--您评价的——end-->
                    <!--您推荐的商品-->
                	<div class="administration_item" style="display:none;"></div>
                    <!--您推荐的商品——end-->
                </div>
            </div>
       </div>
       <div class="mb_right jvf_fr3">

		<div class="mb_nav">
     	<div class="mb_index <?php if((ACTION_NAME)  ==  "index"): ?>current<?php endif; ?>">
         	<a class="jvf_allimg" href="<?php echo U('Member/index');?>"><em class="jvf_allimg mb_index_ico"></em><?php echo L("member_goods_mbtit");?></a>
         </div>
         <div class="mb_inbox <?php if((ACTION_NAME)  ==  "inbox"): ?>current<?php endif; ?>">
         	<a class="jvf_allimg" href="<?php echo U('Member/inbox');?>"><em class="jvf_allimg mb_inbox_ico"></em><?php echo L("inbox_text");?></a>
         </div>
         <div class="mb_listings <?php if((ACTION_NAME)  ==  "listings"): ?>current<?php endif; ?>">
         	<a class="jvf_allimg" href="<?php echo U('Member/listings');?>"><em class="jvf_allimg mb_listings_ico"></em><?php echo L("my_interaction");?></a>
         </div>
         <div class="mb_listings <?php if((ACTION_NAME)  ==  "administration"): ?>current<?php endif; ?>">
         	<a class="jvf_allimg" href="<?php echo U('Member/administration');?>"><em class="jvf_allimg mb_administration_ico"></em><?php echo L("interaction_management");?></a>
         </div>
         <div class="mb_edit <?php if((ACTION_NAME)  ==  "edit"): ?>current<?php endif; ?>">
         	<a class="jvf_allimg" href="<?php echo U('Member/edit');?>"><em class="jvf_allimg mb_edit_ico"></em><?php echo L("personal_settings");?></a>
         </div>
         <div class="mb_account <?php if((ACTION_NAME)  ==  "account"): ?>current<?php endif; ?>">
         	<a class="jvf_allimg" href="<?php echo U('Member/account');?>"><em class="jvf_allimg mb_account_ico"></em><?php echo L("account_info");?></a>
         </div>
         <div class="mb_goods <?php if((ACTION_NAME)  ==  "goods"): ?>current<?php endif; ?>">
         	<?php if(($memberdata["isbusiness"])  ==  "1"): ?><a class="jvf_allimg" href="<?php echo U('Member/goods');?>"><em class="jvf_allimg mb_goods_ico"></em><?php echo L("seller_center");?>
            </a>
         	<?php else: ?>
			<a style="color: #CCCCCC;" class="jvf_allimg" href="<?php echo U('Member/apply_seller');?>"><em class="jvf_allimg mb_goods_ico"></em><?php echo L("seller_center");?>
			<?php if(empty($applying)): ?><span class="shenqingsj">申请商家平台！</span>
			<?php else: ?>
			<span class="shenqingsj">正在审核</span><?php endif; ?>
            </a><?php endif; ?>
         </div>
     </div>
     
     
		<div class="mb_head_user mg0a">
     	<div class="mb_head_img">
         <a href="<?php echo U('User/space/id/'.$memberdata['id']);?>"><img src="<?php echo ($memberdata["header"]["path"]); ?>" /></a>
         <div class="space_operation clearfix">
                 <a href="<?php echo U('Member/edit');?>"><?php echo L("edit_data");?></a>
                 <a href="<?php echo U('Member/edit/item/upLoad');?>"><?php echo L("upload_header");?></a>
         </div>
         </div>
         <div class="mb_username"><a href="<?php echo U('User/space/id/'.$memberdata['id']);?>"><?php echo ($memberdata["name"]); ?></a></div>
         
         <div class="mb_jvf">
             <ul class="clearfix">
                 <li>
                     <?php echo L("audience");?>：<a href="<?php echo U('Member/listings');?>"><?php echo ($allNum["attention"]); ?></a><br>
                     
                 </li>
                 <li>
                     <?php echo L("listen");?>：<a href="<?php echo U('Member/listings/item/ajaxCircle');?>"><?php echo ($allNum["was_attention"]); ?></a><br>
                    
                 </li>
                 <li>
                     <?php echo L("my_say");?>：<a href="<?php echo U('Member/index');?>"><?php echo ($allNum["talk_about"]); ?></a><br>
                     
                 </li>
                 <li>
                     <?php echo L("favorites");?>：<a href="<?php echo U('Search/index/favorites/my');?>"><?php echo ($allNum["favorites"]); ?></a><br>
                     
                 </li>
                 <li>
                     <?php echo L("like");?>：<a href="<?php echo U('Member/listings/item/like');?>"><?php echo ($allNum["like"]); ?></a><br>
                     
                 </li>
                <!-- <li>
                     <?php echo L("user_space_goods_order");?>：<a href="<?php echo U('Member/index/item/buyOrderList');?>"><?php echo ($allNum["order"]); ?></a><br>
                     
                 </li>-->
             </ul>
         </div>
         <div class="space_verification clearfix">
         	<span class="sp1 jvf_fl"><?php echo L("verification_text");?>：</span>
             <div class="sp2 jvf_fl clearfix"><span class="mail jvf_allimg jvf_fl"  title="<?php echo L("mail_verification");?>"></span><span class="jvf_fl"><?php if(($memberdata["mailstatus"])  ==  "0"): ?><?php echo L("not_verified");?><?php else: ?><?php echo L("verified");?><?php endif; ?></span></div>
             <div class="sp3 jvf_fl clearfix"><span class="mobile jvf_allimg jvf_fl" title="<?php echo L("phone_verification");?>"></span><span class="jvf_fl"><?php if(($memberdata["phonestatus"])  ==  "0"): ?><?php echo L("not_verified");?><?php else: ?><?php echo L("verified");?><?php endif; ?></span></div>
         </div>
         
         <!-- <div class="shop_renzheng">
       	 <div class="jvf_shopman clearfix">
             <span title="<?php echo L("businesses_certified");?>" class="shopman_ico jvf_allimg jvf_fl"></span>
             <span style="line-height: 28px;margin-left: 7px;" class="jvf_fl"><?php echo L("certified_businesses");?></span>
             <div  class="space_guanzhu jvf_fr"><a href="<?php echo U('User/space/id/'.$memberdata['id']);?>"><?php echo L("look_my_homepage");?></a></div>
         </div>
         </div> -->
         
         <div class="jvf_frame mbinqz">
         	<div class="mbinqz_tit"><?php echo L("my_interested_circle");?></div>
            <div style="padding:10px;">
            <?php if(is_array($mycircle)): $i = 0; $__LIST__ = $mycircle;if( count($__LIST__)==0 ) : echo "" ;else: foreach($__LIST__ as $key=>$vo): ++$i;$mod = ($i % 2 )?><a class="qz qzlist" href="<?php echo U('Circle/index/lid/'.$vo['id']);?>" target="_blank"><?php echo ($vo["name"]); ?></a><?php endforeach; endif; else: echo "" ;endif; ?>
            <div class="tr">
            	<a href="<?php echo U('Member/editLabel');?>" class="editLabel"><?php echo L("edit");?></a>
            </div>
            
            </div>
            <div class="mbinqz_tit"><?php echo L("my_interested_topic");?></div>
	        <div style="padding:10px;">
	            <?php if(is_array($mylabel)): $i = 0; $__LIST__ = $mylabel;if( count($__LIST__)==0 ) : echo "" ;else: foreach($__LIST__ as $key=>$vo): ++$i;$mod = ($i % 2 )?><a class="bq bqlist" href="<?php echo U('Circle/index/lid/'.$vo['id']);?>" target="_blank"><?php echo ($vo["name"]); ?></a><?php endforeach; endif; else: echo "" ;endif; ?>
	            <div class="tr">
	            	<a href="<?php echo U('Member/editLabel');?>" class="editLabel"><?php echo L("edit");?></a>
	            </div>
	         </div>
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