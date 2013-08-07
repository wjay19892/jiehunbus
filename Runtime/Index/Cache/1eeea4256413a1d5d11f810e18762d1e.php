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
			if(version <=6) {
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
<script type="text/javascript">
$(function(){
	shoppingCart();
});
</script>
<div class="mainbody body_bot body_con clearfix">
	<div class="jvf_body">
    	<!--购物车-->
         <div class="jvf_w100_con jvf_shoppcart">
            <div class="jvf_w100_tit"><?php echo L("shoppingcart_my_cart");?></div>
            	<div style="padding:10px;">
                    <div class="emptygoods" id="emptyGoods" <?php if(empty($goodsdata)): ?>style="display:block;"<?php else: ?>style="display:none;"<?php endif; ?>>
                        <p><a href="<?php echo U('Index/index');?>"><?php echo L("shoppingcart_return_index");?></a></p>
                    </div>
                    <div id="haveGoods" <?php if(empty($goodsdata)): ?>style="display:none;"<?php else: ?>style="display:block;"<?php endif; ?>>
                      <table width="100%" cellspacing="0" cellpadding="0" class="jvf_cartList">
                        <colgroup>
                        <col width="32">
                        <col width="160">
                        <col>
                        <col width="116">
                        <col width="78">
                        <col width="78">
                        <col width="60">
                        </colgroup>
                        <thead>
                          <tr>
                            <th class="nobg"><input type="checkbox" id="cartSelectAllTop" name="cartSelectAllBot"></th>
                            <th class="sc_left"><?php echo L("select_all");?></th>
				            <th><?php echo L("goods_title");?></th>
				            <th><?php echo L("nums_text");?></th>
				            <th><?php echo L("unit_price");?></th>
				            <th><?php echo L("subtotal");?></th>
				            <th class="nobg">&nbsp;</th>
                          </tr>
                        </thead>
                        <tfoot>
                          <tr>
                            <td><input type="checkbox" id="cartSelectAllBot" name="cartSelectAllTop"></td>
                            <td colspan="6" class="sc_left"><?php echo L("select_all");?>&nbsp;&nbsp;<a href="javascript:;" id="delGoodsMore" class="a_blue"><?php echo L("bulk_delete");?></a></td>
                          </tr>
                        </tfoot>
                        <?php if(is_array($goodsdata)): $i = 0; $__LIST__ = $goodsdata;if( count($__LIST__)==0 ) : echo "" ;else: foreach($__LIST__ as $key=>$vo): ++$i;$mod = ($i % 2 )?><tbody>
	                        <tr>
	                          <td>&nbsp;</td>
	                          <td class="sc_pt_inline"><input type="checkbox" name="cartIds" value="<?php echo ($vo["id"]); ?>">
	                            <a href="<?php echo U('Goods/index/id/'.$vo['id']);?>" target="_blank">
	                              <img src="<?php echo ($vo["accessory"]["thumbnail"]); ?>"></a>
	                            </td>
	                          <td><div class="sc_txt"><a href="<?php echo U('Goods/index/id/'.$vo['id']);?>" target="_blank"><?php echo ($vo["title"]); ?></a></div>
	                          </td><td class="sc_pt_inline2">
	                              <a class="minus jvf_member_bg" title="<?php echo L("minus_one");?>"></a>
	                              <input type="text" class="sc_pt_count" maxlength="3" value="<?php echo ($nums[$vo['id']]); ?>" id="goods_<?php echo ($vo["id"]); ?>">
	                              <a class="plus jvf_member_bg" title="<?php echo L("plus_one");?>"></a>
	                          </td>
	                          <td class="fontred">&yen;<span id="unitprice_<?php echo ($vo["id"]); ?>"><?php echo ($vo["price"]); ?></span></td>
	                          <td>&yen;<span id="subtotal_<?php echo ($vo["id"]); ?>"><?php echo ($vo['price'] * $nums[$vo['id']]); ?></span></td>
	                          <td><a id="deleteGoods_<?php echo ($vo["id"]); ?>" href="javascript:;" class="a_blue"><?php echo L("delete");?></a></td>
	                        </tr>
                          </tbody><?php endforeach; endif; else: echo "" ;endif; ?>
                          </table>
                      <div class="sc_bot_total"><span><?php echo L("total_amount");?>：&yen;<strong id="totalPriceBot"></strong></span></div>
                      <div class="go_pay"><a href="<?php echo U('Index/index');?>" class="jvf_continue"><?php echo L("shoppingcart_return");?>&gt;&gt;</a><span class="jvf_mgf"><a class="btn p2153" href="javascript:loginAfter(function(){goUrl(APP+'/Member/payment')})" id="cartSubmitBot"><?php echo L("shoppingcart_go_pay");?></a></span></div>
                    </div>
                    <?php if(!empty($latelydata)): ?><dl class="recent_goods mt20">
                    <dt><h2><?php echo L("recently_viewed_goods");?></h2></dt>
                    <dd>
                    <div class="search_jieguo">
                    <?php if(is_array($latelydata)): $i = 0; $__LIST__ = $latelydata;if( count($__LIST__)==0 ) : echo "" ;else: foreach($__LIST__ as $key=>$vo): ++$i;$mod = ($i % 2 )?><ul class="shangpu_product_list">
                            <li class="list_photo jvf_shoppingCart">
                                <a href="<?php echo U('Goods/index/id/'.$vo['id']);?>" target="_blank">
                                    <img src="<?php echo ($vo["accessory"]["thumbnail"]); ?>" alt="<?php echo ($vo["title"]); ?>">
                                </a>
                            </li>
                            <li class="list_name">
                                <a href="<?php echo U('Goods/index/id/'.$vo['id']);?>" target="_blank"><?php echo ($vo["title"]); ?></a>
                            </li>
                        <li class="list_price">
                          <div class="jvf_fl"><span class="jvf_fl"><?php echo L("now_price");?></span><font class="f18 fontred">&nbsp;&yen;<?php echo ($vo["price"]); ?></font></div>
                          <div class="jvf_fr"><?php echo L("cost_price");?>：&yen;<?php echo ($vo["original"]); ?></div>
                        </li>
                        </ul><?php endforeach; endif; else: echo "" ;endif; ?>
                    </div>
                    <div class="jvf_cl"></div>
                    </dd>
                  </dl><?php endif; ?>
                  </div>
        
          
        </div>
        <!--购物车——end-->
        <div class="jvf_w100"></div>
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