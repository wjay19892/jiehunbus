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
<script type="text/javascript"> 
ieGo();
function ieGo(){ 
		var ie = !-[1,];  
		if(ie == true) {
			var ua = navigator.userAgent.toLowerCase();
			var version = parseInt(ua.match(/msie ([\d.]+)/)[1]);
			if(version <= 7) {
				location.href='<?php echo U('Ie6/index');?>'; 
			}
		}
	}
</script>
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
<script type="text/javascript" src="../Public/js/baidumap_one.js"></script>
<script type="text/javascript" src="http://api.map.baidu.com/api?v=1.3&callback=load_map_wrapper"></script>
<script>
$(document).ready(function(){
	goodsIndex(<?php echo ($data["id"]); ?>);
	document.getElementById("bdshell_js").src = "http://bdimg.share.baidu.com/static/js/shell_v2.js?cdnversion=" + new Date().getHours();
});
function load_map_wrapper(){
	<?php if(($data["latitude"] != '') AND ($data["longitude"] != '')): ?>var map = new jvfMap("map","<?php echo ($data["latitude"]); ?>","<?php echo ($data["longitude"]); ?>",<?php echo ($data["zoom"]); ?>,false);
	map.addTags("<?php echo ($data["latitude"]); ?>","<?php echo ($data["longitude"]); ?>","<?php echo ($data["address"]); ?>",<?php echo ($data["zoom"]); ?>,"<?php echo ($data["short_title"]); ?><br /><?php echo L("address_text");?>：<?php echo ($data["address"]); ?><br /><?php echo L("phone_text");?>：<?php echo ($data["tel"]); ?>");
	map.addTags('<?php echo ($locate["lat"]); ?>','<?php echo ($locate["lng"]); ?>','<?php echo ($locate["address"]); ?>',<?php echo ($data["zoom"]); ?>,'locate');
	<?php else: ?>
	initialize();<?php endif; ?>
}
</script>
<!--头部——开始-->
<div class="mainbody body_bot body_con clearfix">
	<div class="jvf_body clearfix">
       <div class="detail_left jvf_fl">
       		<div class="jvf_frame detail_left_con clearfix">
            	<div class="pd10 clearfix">
                	<div class="detail_shop_title">
                            <h1><a href="javascript:;"><?php echo ($data["title"]); ?></a></h1>
                        </div>
                    <div class="detail_left_con_l jvf_fl2">
                        <div class="jvf_allimg evaluation_all">
                        	<div class="clearfix star_t">
                            <div class="jvf_fl"><?php echo L("goods_index_satisfaction_title");?>：</div><div class="rating_big jvf_fl">
                  <div class="filled_big star_<?php echo ($evaluate_data["total"]["star"]); ?>"></div>
                </div>
                            </div>
                        </div>
                        <div class="smll_star clearfix">
                        	<ul>
                        	<?php if(is_array($evaluate_data["data"])): $i = 0; $__LIST__ = $evaluate_data["data"];if( count($__LIST__)==0 ) : echo "" ;else: foreach($__LIST__ as $key=>$vo): ++$i;$mod = ($i % 2 )?><li>
                                	<div class="jvf_fl jvf_over" title="<?php echo ($vo["name"]); ?>" style="width:64px;"><?php echo ($vo["name"]); ?>：</div>
                                    <div class=" rating jvf_fl ">
                                            <div class="filled star_<?php echo ($vo["star"]); ?>"></div>
                                    </div>
                                </li><?php endforeach; endif; else: echo "" ;endif; ?>
                            </ul>
                        
                        </div>
                        
                        <div class="price">
                        	<?php echo L("original_text");?>：<span style="text-decoration:line-through;"><?php echo ($data["original"]); ?></span><br />
                            <?php echo L("now_price");?>：<span class="price_j">&yen;<?php echo ($data["price"]); ?></span></br>
                            
                        </div>
                        <div class="price_bot clearfix">
                        	<?php if(in_array($data['id'],$collection_arr)): ?><div class="price_collectionHover jvf_fl"><a class="jvf_allimg jvf_over" href="<?php echo U('Member/removeFavorites/gid/'.$data['id']);?>"><?php echo L("remove_favorites");?></a></div>
                            <?php else: ?>
                            <div class="price_collection jvf_fl"><a class="jvf_allimg jvf_over" href="<?php echo U('Member/saveFavorites/gid/'.$data['id']);?>"><?php echo L("add_favorites");?></a></div><?php endif; ?>
                            <?php if(in_array($data['id'],$shoppingCartId)): ?><div class="price_cartHover jvf_fl"><a class="jvf_allimg jvf_over" href="<?php echo U('Goods/updateNum/id/'.$data['id'].'/num/0');?>" rel="<?php echo ($data['id']); ?>"><?php echo L("remove_text");?></a></div>
                            <?php else: ?>
                            <div class="price_cart jvf_fl"><a class="jvf_allimg jvf_over" href="<?php echo U('Goods/buy/id/'.$data['id']);?>" rel="<?php echo ($data['id']); ?>"><?php echo L("add_shoppingcart");?></a></div><?php endif; ?>

                            <div class="price_purchase jvf_fr">
                                <a class="jvf_allimg jvf_callme" href="javascript:;" uid="<?php echo $data['promulgator']['id'];?>">对话商家</a>
                            </div>


                        </div>
                    </div>
                    <div class="detail_left_con_r jvf_fr2">
                    
                    	<div class="exhibition"><img src="<?php echo ($data["accessory"]["0"]["path"]); ?>" /></div>
                        <div class="exhibition_list clearfix">
                            <div class="exhibition_list_left jvf_fl"><a class="jvf_allimg" href="javascript:;"></a></div>
                            <div class="exhibition_list_content jvf_fl">
                                <ul class="exhibition_list_con jvf_fl clearfix">
                                <?php if(is_array($data["accessory"])): $i = 0; $__LIST__ = $data["accessory"];if( count($__LIST__)==0 ) : echo "" ;else: foreach($__LIST__ as $key=>$vo): ++$i;$mod = ($i % 2 )?><li <?php if(($i)  ==  "1"): ?>class="pic_active"<?php endif; ?>><a href="<?php echo ($vo["path"]); ?>" ><img width="50" height="33" src="<?php echo ($vo["thumbnail"]); ?>" alt="<?php echo ($vo["title"]); ?>" /></a></li><?php endforeach; endif; else: echo "" ;endif; ?>
                                </ul>
                            </div>
                           <div class="exhibition_list_right jvf_fl"><a class="jvf_allimg" href="javascript:;"></a></div>
                        </div>
                    </div>
                    <div class="jvf_cl"></div>
                    <div class="contact clearfix">
                    	<ul class="clearfix yysj">
                        	<li><?php echo L("member_printcoupon_server");?>：<?php echo ($data["tel"]); ?></li>
                            <li>营业时间：<?php echo ($data["promulgator"]["business"]["opening"]); ?></li>
                        </ul>
                        <div class="clearfix"><span class="jvf_fl"><?php echo L("address_text");?>：</span><a href="javascript:;" id="addressMap" rel="<?php echo ($data['id']); ?>"><span class="jvf_over mw210 jvf_fl"><?php echo ($data["address"]); ?></span><span class="jvf_adr jvf_fl pr"><em class="jvf_ico"></em><?php echo distance($locate['lat'],$locate['lng'],$data['latitude'],$data['longitude']);?></span></a></div>
                        <?php if(!empty($memberdata) AND !$isComplaint): ?><div class="clearfix jvf_report">
                        	<a href="<?php echo U('Member/report/gid/'.$data['id']);?>">
                        		<div class="jvf_allimg jvf_report_ico jvf_fl"></div>
                        		<div class="jvf_fl"><?php echo L("report");?></div>
                        	</a>
                        </div><?php endif; ?>
                    </div>
                    <div>
                    <!-- Baidu Button BEGIN -->
    <div id="bdshare" class="bdshare_t bds_tools get-codes-bdshare">
        <span class="bds_more"><?php echo L("share_to");?>：</span>
        <a class="bds_qzone"></a>
        <a class="bds_tsina"></a>
        <a class="bds_tqq"></a>
        <a class="bds_renren"></a>
		<a class="shareCount"></a>
    </div>
<script type="text/javascript" id="bdshare_js" data="type=tools&amp;uid=668549" ></script>
<script type="text/javascript" id="bdshell_js"></script>
<!-- Baidu Button END -->
                    </div>
                </div>
            </div>
       		<div class="detail_bot jvf_allimg"></div>
            
            <!--扩展字段-->
            <div class="jvf_frame detail_left_con clearfix">
            	<div class="extension_top" id="extension_detail">
                	<ul class="clearfix">
                    	<li class="selected"><a href="javascript:;"><?php echo L("member_gooddetail_title");?></a></li>
                        <?php if(is_array($data["expand"])): $i = 0; $__LIST__ = $data["expand"];if( count($__LIST__)==0 ) : echo "" ;else: foreach($__LIST__ as $key=>$vo): ++$i;$mod = ($i % 2 )?><li><a href="javascript:;"><?php echo ($vo["key"]); ?></a></li><?php endforeach; endif; else: echo "" ;endif; ?>
                    </ul>
                </div>
                <div id="extension">
	                <div class="extension_con">
					<?php echo ($data["detail"]); ?>
	                </div>
	                <?php if(!empty($data["expand"])): ?><?php if(is_array($data["expand"])): $i = 0; $__LIST__ = $data["expand"];if( count($__LIST__)==0 ) : echo "" ;else: foreach($__LIST__ as $key=>$vo): ++$i;$mod = ($i % 2 )?><div class="extension_con" style="display:none;"><?php echo (expand_html($vo)); ?></div><?php endforeach; endif; else: echo "" ;endif; ?><?php endif; ?>
                </div>
            
            </div>
            <div class="detail_bot jvf_allimg"></div>
             <!--扩展字段-->
             <!--发表感受-->
            <div class="jvf_frame detail_left_con clearfix">
            <form id="talk_aboutBox">
           		<div class="jvf_sendcnt_tit2"><!--<?php echo L("goods_index_jvf_sendcnt_tit");?>--></div>
                <div class="jvf_sendcnt">
                	<div class="jvf_cntbox"><textarea autocomplete="off" name="content"></textarea></div>
                	<div class="jvf_insertfun">
                    	<a href="javascript:;" id="face"><em class="inserttximg jvf_allimg"></em><?php echo L("face_text");?></a>
                        <!--<a href="javascript:;" id="imgs"><em class="insertimg jvf_allimg"></em><?php echo L("photos_text");?></a>-->
                        <div class="together jvf_fr">
							<span class="hackie right_f share_published"> <span style="top: -3px;position: relative;">同步到：</span> 
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
                    <input name="gid" type="hidden" value="<?php echo ($data["id"]); ?>">
                </div>
                <div class="jvf_sendbutj clearfix">
                    <span class="jvf_sendbut jvf_fr"><a class="jvf_allimg" href="javascript:;" id="submit"><?php echo L("release_text");?></a></span>
                    <span class="jvf_counttxt jvf_fr" id="textNum" style="margin-right:20px;"><?php echo L("can_enter");?><em>140</em><?php echo L("word_text");?></span>
                </div>
            </form>
            </div>
            <div class="detail_bot jvf_allimg"></div>
             <!--发表感受-->
            <!--评价推荐-->
            <div class="jvf_frame detail_left_con clearfix">
            	<div class="extension_top" id="exchange_tab">
                	<ul class="clearfix">
                    	<li class="selected"><a href="javascript:;"><?php echo L("mood");?></a></li>
                        <li><a href="<?php echo U('Comment/ajaxComment/gid/'.$data['id']);?>" get="get"><?php echo L("evaluate");?></a></li>
                        <li><a href="<?php echo U('Recommend/ajaxRecommend/gid/'.$data['id']);?>" get="get"><?php echo L("recommend");?></a></li>
                    </ul>
                </div>
                <div id="exchange">
                	<div class="extension_exchange clearfix"></div>
                	<div class="extension_exchange clearfix" style="display:none;"></div>
                	<div class="extension_exchange clearfix" style="display:none;"></div>
                </div>
            </div>
            <div class="detail_bot jvf_allimg"></div>
            <!--评价推荐——end-->
             
            
       </div>
       
       <div class="detail_right jvf_fr">
<!--店家信息-->
            <div class="jvf_frame w225 mg0a">
                <div class="detail_head w213">
                    <a href="<?php echo U('User/space/id/'.$data['promulgator']['id']);?>"><img src="<?php echo ($data["promulgator"]["business"]["logo"]); ?>" /></a>
                    <div class="attestation"></div>
                </div>
                <div class="detail_username w213 jvf_over"><a href="<?php echo U('User/space/id/'.$data['promulgator']['id']);?>"><?php echo ($data["promulgator"]["business"]["name"]); ?></a></div>
                <div class="clearfix detail_tell">
                    <div class="message jvf_fl"><a class="jvf_allimg jvf_message" href="<?php echo U('Member/sendpm/id/'.$data['promulgator']['id']);?>"><?php echo L("guestbook");?></a></div>
                    <div class="chat jvf_fr"><a class="jvf_allimg jvf_callme" href="javascript:;" uid="<?php echo $data['promulgator']['id'];?>"><?php echo L("real_time_chat");?></a></div>
                </div>
                <div class="suspbtn">
                                <a class="btns-ex btn-ex-t1 follow" href="<?php echo U('User/goods/id/'.$data['promulgator']['id']);?>"><span>商家商品列表</span></a>
                            </div>
                <?php if(!empty($data['promulgator']['business']['characteristic'])): ?><div class="sh-mod shop-serv">
                        <div class="hd">
                            <span class="n">商家特色</span>
                        </div>
                        <div class="bd">
                            <ul class="cls">
                            <?php
                                $characteristic = explode(',',str_replace('，',',',$data['promulgator']['business']['characteristic']));
                            ?>
                            <?php if(is_array($characteristic)): $i = 0; $__LIST__ = $characteristic;if( count($__LIST__)==0 ) : echo "" ;else: foreach($__LIST__ as $key=>$vo): ++$i;$mod = ($i % 2 )?><li><span><?php echo ($vo); ?></span></li><?php endforeach; endif; else: echo "" ;endif; ?>
                            </ul>
                            <span class="x1"></span>
                        </div>
                </div><?php endif; ?>
                
                <ul class="response clearfix">
                      <li class="response_rate clearfix"> <span class="icon jvf_allimg"></span>
                      <div class="jvf_fl">
                        <h5><?php echo ($data["promulgator"]["level"]["name"]); ?></h5>
                        <h6><?php echo L("level_text");?></h6>
                      </div>
                      </li>
                      <li class="response_time clearfix"> <span class="icon jvf_allimg"></span>
                      <div class="jvf_fl">
                        <h5><?php echo (toDateRefer($data["promulgator"]["lastlog"]["addtime"])); ?></h5>
                        <h6><?php echo L("goods_index_last_login_time");?></h6>
                      </div>
                      </li>
                      <li class="updatedness clearfix"> <span class="icon jvf_allimg"></span>
                      <div class="jvf_fl">
                        <h5><?php echo (toDateRefer($data["promulgator"]["regtime"])); ?></h5>
                        <h6><?php echo L("reg_time");?></h6>
                        </div>
                      </li>
                </ul>
            </div>
            <div class="jvf_allimg shop_bot mg0a"></div>
            <!--店家信息-->

       		<!--地图-->
       		<div class="jvf_frame w235 mg0a" id="smallMap">
            	<div style="width:225px; margin:5px;height: 225px;" id="map">
                </div>
                <div class="amplification mg0a">
                	<a href="javascript:;" id="bigMap" rel="<?php echo ($data["id"]); ?>"><span class="jvf_allimg"></span><?php echo L("view_map");?></a>
                </div>
            </div>
            <div class="jvf_allimg shop_bot mg0a"></div>
            <!--地图-->
            
            <!--同类商品-->
            <div class="jvf_frame w225 mg0a">
            	<div class="rig_title"><?php echo L("goods_index_similar_list");?></div>
            	<?php if(is_array($similar)): $i = 0; $__LIST__ = $similar;if( count($__LIST__)==0 ) : echo "" ;else: foreach($__LIST__ as $key=>$vo): ++$i;$mod = ($i % 2 )?><div class="similar clearfix">
                	<div class="similar_img"><a href="<?php echo U('Goods/index/id/'.$vo['id']);?>"><img src="<?php echo ($vo["accessory"]["thumbnail"]); ?>" alt="<?php echo ($vo["title"]); ?>" /></a></div>
                    	<h4><a href="<?php echo U('Goods/index/id/'.$vo['id']);?>"><?php echo ($vo["title"]); ?></a></h4>
                        <div class="author clearfix">
                        	<div class="author_img jvf_fl">
                            <img width="40" height="40" src="<?php echo ($vo["promulgator"]["header"]["thumbnail"]); ?>"/>
                            </div>
                            <div class="author_con jvf_fl">
                            <?php echo L("cost_price");?>：<span><?php echo ($vo["original"]); ?></span><br />
                        	<?php echo L("goods_manager");?>：<a href="<?php echo U('User/space/id/'.$vo['promulgator']['id']);?>"><?php echo ($vo["promulgator"]["name"]); ?></a>
                            <div class="author_xianjia">&yen;<?php echo ($vo["price"]); ?></div>
                            </div>
                        </div>
                        
                </div><?php endforeach; endif; else: echo "" ;endif; ?>
            </div>
            <div class="jvf_allimg shop_bot mg0a"></div>
            <!--同类商品-->
       </div>
       
       
	</div>
</div>
<div class="user_say_box" style="display:none;">
 	<div class="say_box_tit clearfix">
         <div class="jvf_fr clos"><a class="jvf_allimg" href="javascript:;"></a></div>
    </div>
    <form id="talk_aboutReply">
    <div class="cont">
         <textarea class="inputtxt" name="content"></textarea>
	</div>
    <div class="jvf_insertping">
    	<a href="javascript:;" id="face"><em class="inserttximg jvf_allimg"></em><?php echo L("face_text");?></a>
        <div class="clearfix jvf_fr jvf_fabtn">
        <a class="jvf_fr btn pd020" href="javascript:;" id="submit"><?php echo L("post_text");?></a>
        <span class="jvf_counttxt jvf_fr" id="textNum"><?php echo L("can_enter");?><em>140</em><?php echo L("word_text");?></span>
        </div>
		<div class="jvf_cl"></div>
    </div>
    </form>
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