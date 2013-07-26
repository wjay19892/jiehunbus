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
                <!--购物车<li>|</li>
                <li class="header_top_mubg left_mu5"><a href="<?php echo U('Goods/shoppingCart');?>">
                <em></em>
                <?php echo L("shoppingcart");?><span>(<span id="shoppingCartNum"><?php echo ($shoppingCartNum); ?></span>)</span></a></li>-->
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
<link type="text/css" rel="stylesheet" media="screen" href="../Public/css/slide_style.css" />
<script src="../Public/js/slides.min.jquery.js"></script>
<script>
		$(function(){
			index();
		});
</script>
<!----搜索开始---->

<form id="searchForm" action="<?php echo U('Search/index');?>" method="get">
<div id="car_top" class="clearfix">
    <div id="main_box">
        <div class="hr70"></div>
        <h1 class="h3_title">请选择一款您喜欢的婚纱照风格</h1>
        <div class="hr28"></div>
        <div id="select_box">
            <div class="searchbg">
<!--TOP搜索下拉框开始-->
<script type="text/javascript" src="../Public/js/selectbox.js"></script>
<!--TOP搜索下拉框结束-->
                <div class="search_fg">
                    <p>请选择风格</p>
                    <input type="text" id="search_fg" name="fgid" style="display:none;">
                    <div class="search_display">
                        <div class="fgaitop"></div>
                        <div class="fgaicenter">
                            <div class="alphabetbrand">
                                <ul>
                                    <li>
                                        <div class="alphabetbrand2">           
                                            <?php if(is_array($goods_categorydata)): $i = 0; $__LIST__ = $goods_categorydata;if( count($__LIST__)==0 ) : echo "" ;else: foreach($__LIST__ as $key=>$vo): ++$i;$mod = ($i % 2 )?><a ref="<?php echo ($vo["name"]); ?>" mid="<?php echo ($vo["id"]); ?>" href="javascript:void(0);"><?php echo ($vo["name"]); ?></a><?php endforeach; endif; else: echo "" ;endif; ?>
                                        </div>
                                    </li>
                                </ul>        
                            </div>
                        </div>
                        <div class="ppaibottom">
                            收起
                            <img align="absmiddle" src="../Public/images/up.png">
                        </div>
                    </div>
                </div>
                <div class="search_jg">
                    <p>请选择价格</p>
                    <input type="text" id="search_jgmin" name="minprice1" style="display:none;">
                    <input type="text" id="search_jgmax" name="maxprice1" style="display:none;">
                    <div class="search_display">
                        <div class="jgaitop"></div>
                        <div class="jgaicenter">
                            <div class="alphabetbrand4">
                                <ul>
                                    <li>
                                        <div class="alphabetbrand5">           
                                            
                                                
                                            <?php if(is_array($price_rangedata)): $i = 0; $__LIST__ = $price_rangedata;if( count($__LIST__)==0 ) : echo "" ;else: foreach($__LIST__ as $key=>$vo): ++$i;$mod = ($i % 2 )?><a ref="<?php echo ($vo["name"]); ?>" min="<?php echo ($vo["min"]); ?>" max="<?php echo ($vo["max"]); ?>" href="javascript:void(0);"><?php echo ($vo["name"]); ?></a><?php endforeach; endif; else: echo "" ;endif; ?>
                                        </div>
                                    </li>
                                </ul>        
                            </div>
                        </div>
                        <div class="jgaibottom">
                            收起
                            <img align="absmiddle" src="../Public/images/up.png">
                        </div>
                    </div>
                </div>
                <input class="search_sp" type="text" placeholder="您还可以直接输入商品名搜索" name="search_key">
                <div class="searchbg2">
                    <input class="searchbg1" type="button" value="搜 索" name="submit_button">
                </div>
            </div>
        </div>

    </div>
</div>
</form>
<!----搜索结束---->

<div class="mainbody0 body_bot body_con clearfix">
	<div class="jvf_body">  
        <!--为您推荐的商品-->
        <div class="jvf_tuijian">
            <div class="tuijian_title">
                <h2><?php echo L("index_recommend");?></h2>
            </div>
            <div class="tuijian_con clearfix">
            <?php if(is_array($sortgoods)): $i = 0; $__LIST__ = $sortgoods;if( count($__LIST__)==0 ) : echo "" ;else: foreach($__LIST__ as $key=>$vo): ++$i;$mod = ($i % 2 )?><div class="shop_all jvf_fl">
                    <div class="jvf_frame w225">
                        <div class="tuijian_img"><a href="<?php echo U('Goods/index/id/'.$vo['id']);?>"><img src="<?php echo ($vo["accessory"]["thumbnail"]); ?>" width="213" height="143" ></a></div>
                        <div class="index_shop_name"><a href="<?php echo U('Goods/index/id/'.$vo['id']);?>"><?php echo ($vo["title"]); ?></a></div>
                        <div class="shop_adr clearfix"><a class="jvf_fl jvf_over mw145 jvf_address" href="javascript:;" gid="<?php echo ($vo["id"]); ?>"><?php echo ($vo["address"]); ?></a><span class="jvf_juli fujin_ico"><?php echo distance($locate['lat'],$locate['lng'],$vo['latitude'],$vo['longitude']);?></span></div>
                        <div class="shop_conbot clearfix">
                            <a href="<?php echo U('Goods/index/id/'.$vo['id']);?>"><?php echo L("detail_text");?></a>
                            <a href="<?php echo U('Goods/index/id/'.$vo['id']);?>"><?php echo L("recommend");?>(<?php echo ($vo["recommend"]); ?>)</a>
                            <a href="<?php echo U('Goods/index/id/'.$vo['id']);?>"><?php echo L("evaluate");?>(<?php echo ($vo["comment"]); ?>)</a>
                            
                            <?php if(in_array($vo['id'],$collection_arr)): ?><a class="jvf_ico collHover icow" href="<?php echo U('Member/removeFavorites/gid/'.$vo['id']);?>"></a>
                            <?php else: ?>
                            <a class="jvf_ico coll icow" href="<?php echo U('Member/saveFavorites/gid/'.$vo['id']);?>"></a><?php endif; ?>
                        </div>
                        <div class="jvf_frame_bot clearfix">
                            <div class="jvf_fl">
                            <a href="<?php echo U('User/space/id/'.$vo['promulgator']['id']);?>" uid="<?php echo ($vo['promulgator']['id']); ?>" class="jvf_getUser"><img width="35" height="35" src="<?php echo ($vo["promulgator"]["header"]["thumbnail"]); ?>"></a>
                            </div>
                            <div class="shop_zur jvf_fl clearfix">
                                <span class="jvf_fl"><?php echo L("cost_price");?>：</span><span class="yuanjia">&yen;<?php echo ($vo["original"]); ?></span>
                                <div class="jvf_cl"></div>
                                <span class="jvf_fl"><?php echo L("goods_manager");?>：</span><span class="jvf_fl jvf_over w100 user_name"><a href="<?php echo U('User/space/id/'.$vo['promulgator']['id']);?>"><?php echo ($vo["promulgator"]["name"]); ?></a></span>
                            </div>
                            <div class="jvf_xianjia">&yen;<?php echo ($vo["price"]); ?></div>
                        </div>
                    </div>
                    <div class="jvf_allimg shop_bot"></div>
                </div><?php endforeach; endif; else: echo "" ;endif; ?>
            </div>
        </div>
        

        <div class="mainbody_right jvf_fr">
            <div class="jvf_title">
                <h2><?php echo L("announcement");?><span><a target="_blank" href="<?php echo U('Article/lists/cid/2');?>"><?php echo L("more_text");?></a></span></h2>
                <div class="mainbody_right_list">
                    <ul class="clearfix">
                    <?php if(is_array($announcement)): $i = 0; $__LIST__ = $announcement;if( count($__LIST__)==0 ) : echo "" ;else: foreach($__LIST__ as $key=>$vo): ++$i;$mod = ($i % 2 )?><li><a target="_blank" href="<?php echo U('Article/detail/id/'.$vo['id']);?>" ><?php echo ($vo["title"]); ?></a> <span><?php echo (toDate($vo["addtime"])); ?></span></li><?php endforeach; endif; else: echo "" ;endif; ?>
                    </ul>
                </div class="mainbody_right_list2">
                
                <h2><?php echo L("recently_talk_about");?><span><a target="_blank" href="<?php echo U('Circle/index');?>"><?php echo L("more_text");?></a></span></h2>
                <div class="mainbody_right_listj">
                    <ul>
                    <?php if(is_array($recentlyTalk_about)): $i = 0; $__LIST__ = $recentlyTalk_about;if( count($__LIST__)==0 ) : echo "" ;else: foreach($__LIST__ as $key=>$vo): ++$i;$mod = ($i % 2 )?><li>
                        <span class="user_name"><a href="<?php echo U('User/space/id/'.$vo['uid']);?>"><?php echo ($vo["name"]); ?></a></span>
                        <?php if(!empty($vo["gid"])): ?><span class="jvf_ico at"></span>
                        <a href="<?php echo U('Goods/index/id/'.$vo['gid']);?>"><?php echo ($vo["title"]); ?>：</a>
                        <?php else: ?>
	                        <?php if(!empty($vo["member"])): ?><span class="jvf_ico at"></span>
	                        <?php if(is_array($vo["member"])): $i = 0; $__LIST__ = $vo["member"];if( count($__LIST__)==0 ) : echo "" ;else: foreach($__LIST__ as $key=>$v): ++$i;$mod = ($i % 2 )?><a href="<?php echo U('User/space/id/'.$v['uid']);?>"><?php echo ($v["name"]); ?>：</a><?php endforeach; endif; else: echo "" ;endif; ?>
	                        <?php else: ?>
	                        <span class="jvf_ico bo"></span>
	                        <?php if(is_array($vo["label"])): $i = 0; $__LIST__ = $vo["label"];if( count($__LIST__)==0 ) : echo "" ;else: foreach($__LIST__ as $key=>$v): ++$i;$mod = ($i % 2 )?><a href="<?php echo U('Circle/index/lid/'.$v['lid']);?>"><?php echo ($v["name"]); ?>：</a><?php endforeach; endif; else: echo "" ;endif; ?><?php endif; ?><?php endif; ?>
                        <?php echo ($vo["content"]); ?>
                        <?php if(!empty($vo["source"])): ?><span class="jvf_ico at"></span>
                        <a href="<?php echo U('User/space/id/'.$vo['source']['uid']);?>"><?php echo ($vo["source"]["name"]); ?></a>
                        <?php echo ($vo["source"]["content"]); ?><?php endif; ?>
                        </li><?php endforeach; endif; else: echo "" ;endif; ?>                        
                    </ul>
                </div>
            </div>
        </div>
        <div class="jvf_cl"></div>
        <!--显示欢迎词<div class="jvf_advertising"><?php echo L("jvf_advertising");?></div>-->
        
        <div class="mainbody_con clearfix">
            <div class="mainbody_conj jvf_con_cm jvf_fl">
                <h2 class="clearfix"><span class="jvf_fl"><?php echo L("nerby_goods");?></span><span class="jvf_fr mor"><a target="_blank" href="<?php echo U('Nearby/index');?>"><?php echo L("more_text");?></a></span></h2>
                <div class="mainbody_conj_list">
                    <ul id="nerby">
                    <?php if(is_array($nerbygoods)): $i = 0; $__LIST__ = $nerbygoods;if( count($__LIST__)==0 ) : echo "" ;else: foreach($__LIST__ as $key=>$vo): ++$i;$mod = ($i % 2 )?><li>
                            <div class="big_nerby pr clearfix fujin_xx fujin_<?php echo ($i); ?>" <?php if(($i)  !=  "1"): ?>style="display:none;"<?php endif; ?>>
                            	<em class="fujin_ico a_em"></em>
                                <div class="fujin_img boder_img jvf_fl">
                                    <a href="<?php echo U('Goods/index/id/'.$vo['id']);?>"><img src="<?php echo ($vo["accessory"]["thumbnail"]); ?>"></a>
                                </div>
                                <div class="fujin_xx_right jvf_fl">
                                    <a class="jvf_over w325" href="<?php echo U('Goods/index/id/'.$vo['id']);?>"><?php echo ($vo["title"]); ?></a>
                                    <div class="jvf_star clearfix">
                                        <span class="jvf_fl"><?php echo L("evaluate");?>：</span>
                                        <div class="jvf_fl rating pr">
                                            <div class="filled star_<?php echo ($vo["evaluate"]["total"]["star"]); ?>"></div>
                                        </div>
                                    </div>
                                    <div class="clearfix">
                                        <span class="jvf_fl"><?php echo L("address_text");?>：</span><span class="jvf_fl" style="width: 210px;height: 19px;overflow: hidden;"><?php echo ($vo["address"]); ?></span>
                                        
                                        <span class="jvf_adr jvf_fl pr"><em class="jvf_ico"></em><?php echo distance($locate['lat'],$locate['lng'],$vo['latitude'],$vo['longitude']);?></span>
                                    </div>
                                    <div class="fujin_dinw">&yen;<?php echo ($vo["price"]); ?></div>
                                </div>
                            </div>
                            
                            <div class="small_nerby pr clearfix fujin_li_<?php echo ($i); ?>" <?php if(($i)  ==  "1"): ?>style="display:none;"<?php endif; ?>>
                                <em class="fujin_ico b_em"></em>
                                <a class="fujin_a jvf_over jvf_fl" href="<?php echo U('Goods/index/id/'.$vo['id']);?>"><?php echo ($vo["title"]); ?></a>
                                <div class="jvf_fr jvf_jitj">
                                   
                                    <div class="jvf_tuijianb pr fr"><em class="fujin_ico"></em><?php echo ($vo["comment"]); ?></div>
                                     <div class="jvf_julia pr fr"><em class="fujin_ico"></em><?php echo (formatDistance($vo["distance"])); ?></div>
                                </div>
                            </div>
                       </li><?php endforeach; endif; else: echo "" ;endif; ?>
          
                    </ul>
                    
                </div>
                
                
            </div>
            <div class=" jvf_fl mainbody_conv"></div>
            <div class="mainbody_conf jvf_con_cm jvf_fr">
                <h2 class="clearfix"><span class="jvf_fl"><?php echo L("new_comment");?></span><span class="jvf_fr mor"><a href="<?php echo U('Comment/index');?>" target="_blank"><?php echo L("more_text");?></a></span></h2>
                <div class="pingjj">
                <div id="newComment">
                <?php if(is_array($newcomment)): $i = 0; $__LIST__ = $newcomment;if( count($__LIST__)==0 ) : echo "" ;else: foreach($__LIST__ as $key=>$vo): ++$i;$mod = ($i % 2 )?><div class="pingjia_con clearfix">
                    <div class="pingjia_img jvf_fl boder_img">
                        <img width="35" height="35" src="<?php echo ($vo["reviewer"]["header"]["thumbnail"]); ?>">
                    </div>
                    <div class="jvf_fl pingjia_rig">
                        <div class="pingjia_tit jvf_over w382">
                        	<span class="user_name"><a href="<?php echo U('User/space/id/'.$vo['reviewer']['id']);?>"><?php echo ($vo["reviewer"]["name"]); ?></a></span>
                        	<span class="jvf_ico at"></span><a href="<?php echo U('Goods/index/id/'.$vo['gid']);?>"><?php echo ($vo["title"]); ?></a>
                            <div class="jvf_star mb clearfix">
                                        <span class="jvf_fl"><?php echo L("evaluate");?>：</span>
                                        <div class="jvf_fl rating">
                                            <div class="filled star_<?php echo ($vo["evaluate"]["total"]["star"]); ?>"></div>
                                        </div>
                            </div>
                        </div>
                    </div>
                    <div class="jvf_cl"></div>
                    <div class="pingjia_hf clearfix"><span class="jvf_ico yh1 jvf_fl"></span><span class="jvf_fl jvf_over mw420"><?php echo ($vo["content"]); ?></span><span class="jvf_ico yh2 jvf_fl"></span></div>
                </div><?php endforeach; endif; else: echo "" ;endif; ?>
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