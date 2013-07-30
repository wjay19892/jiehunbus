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
<script type="text/javascript">
$(function(){
	memberPayment();
});
</script>
<div class="mainbody body_bot body_con clearfix">
	<div class="jvf_body">
    	<div class="jvf_w100_con jvf_shoppcart">
        	<div class="jvf_w100_tit"><?php echo L("member_payment_title");?></div>
            <div class="layout ">
  <div class="bargain_bor mt10">
    <h6 class="bold"><?php echo L("my_order");?></h6>
    <div class="cart_login_text"><?php echo L("member_payment_total");?><?php echo count($goodsdata);?><?php echo L("member_payment_slowly");?>&nbsp;&nbsp;
    <a style="display: inline;" class="none_order_alink hidden" id="hideListMsg" href="javascript:;"><?php echo L("member_payment_hidelistmsg");?></a>
    <a class="none_order_alink_1" id="showListMsg" href="javascript:;" style="display: none;"><?php echo L("member_payment_showlistmsg");?></a></div>
    <div class="cart_shopcont">
      <table cellspacing="0" cellpadding="0" border="0" width="915" class="hidden" id="listMsgTable" style="display: table;">
        <tbody><tr class="cart_cont_table_bor7">
          <td width="20" height="30" align="center">&nbsp;</td>
          <td width="570" align="center"><strong class="bold"><?php echo L("goods_title");?></strong></td>
          <td width="100" align="center"><strong class="bold"><?php echo L("nums_text");?></strong></td>
          <td width="100" align="center"><strong class="bold"><?php echo L("unit_price");?></strong></td>
          <td width="110" align="center"><strong class="bold"><?php echo L("subtotal");?></strong></td>
          <td width="20" align="center">&nbsp;</td>
        </tr>
        <?php if(is_array($goodsdata)): $i = 0; $__LIST__ = $goodsdata;if( count($__LIST__)==0 ) : echo "" ;else: foreach($__LIST__ as $key=>$vo): ++$i;$mod = ($i % 2 )?><tr class="cart_cont_table_bor9">
	          <td>&nbsp;</td>
	          <td align="left">
              <a style="float: left;" href="<?php echo U('Goods/index/id/'.$vo['id']);?>" target="_blank">
                   <img width="120" height="72" src="<?php echo ($vo["accessory"]["path"]); ?>">
              </a>
              <span style="float: left;margin-left: 10px;"><?php echo ($vo["title"]); ?></span>
              </td>
	          <td align="center" class="arial cart_cent"><?php echo ($nums[$vo['id']]); ?></td>
	          <td align="center" class="arial cart_cent">&yen;<?php echo ($vo["price"]); ?></td>
	          <td align="center" class="arial cart_cent">
	          		&yen;
	          			<?php $tmp = $nums[$vo['id']] * $vo['price'];
	          			$total += $tmp;
	          			echo toPrice($tmp); ?>
	          </td>
	          <td>&nbsp;</td>
	        </tr><?php endforeach; endif; else: echo "" ;endif; ?>    
	    </tbody>
	    </table>
    </div>
    <ul class="order_total">
      <li class="total font14px"><?php echo L("total_amount");?>：&yen;<b id="totalPrices" class="font18px fontred"><?php echo (toPrice($total)); ?></b></li>
    </ul>
  </div>
  <div id="payforproductMain" class="clearfix">
    <form target="_blank" method="post" id="payForm">
      <?php if(!empty($orderdata)): ?><input id="oid" name="oid" type="hidden" value="<?php echo ($orderdata["id"]); ?>"><?php endif; ?>
            <div class="bargain_bor mt10 mb">

        <div class="cart_bor">
          <ul class="account_info">
            <li class="mobile bold"><?php echo L("mail_text");?>：<?php if(($memberdata["mailstatus"])  ==  "1"): ?><?php echo ($memberdata["mail"]); ?><?php else: ?><?php echo L("no_verification");?><?php endif; ?></li>
            <!--<li class="balance"><strong class="font14px bold"><?php echo L("account_balance");?>：</strong><span class="arial font18px">&yen;<b id="balanceTf"><?php echo (toPrice($memberdata["cash"])); ?></b></span></li>-->
            <li class="mobile bold"><label for="phone"><?php echo L("phone_text");?>：</label><input type="text" class="jvf_inputt" value="<?php if(empty($orderdata)): ?><?php echo ($memberdata["phone"]); ?><?php else: ?><?php echo ($orderdata["phone"]); ?><?php endif; ?>" placeholder="<?php echo L("phone_text");?>" name="phone" id="phone">
            	<?php if(C('sysconfig.verify_phone_format')): ?><span><?php echo L("phone_example_international");?></span>
				<?php else: ?>
				<span><?php echo L("phone_example_domestic");?></span><?php endif; ?>
			</li>
            <!--<li id="needPriceWrap" class="balance hidden" style="display: list-item;"><?php if(($orderdata["incharge"])  >  "0"): ?><strong class="font14px bold"><?php echo L("status_pay");?>：</strong><span class="arial font18px fontff5500">&yen;<b id="incharge"><?php echo ($orderdata["incharge"]); ?></b></span>，<?php endif; ?><strong class="font14px bold"><?php echo L("member_payment_needpricewrap");?>：</strong><span class="arial font18px fontff5500">&yen;<b id="needPrice">0</b></span></li>
            <li class="mobile"><?php echo L("member_payment_verification");?></li>
            <li class="balance"><input type="checkbox" id="iscash" value="1" name="iscash"><label for="iscash"><?php echo L("member_payment_iscash");?></label></li>-->
            <li class="mobile bold" style="height: auto;line-height: auto;"><label class="jvf_fl" for="remark"><?php echo L("remark_text");?>：</label><textarea cols="30" rows="4" placeholder="<?php echo L("remark_text");?>" class="jvf_inputt" name="remark" id="remark"><?php echo ($orderdata["remark"]); ?></textarea></li>
          </ul>

        </div>
      </div>
      <div class="goods_buy_butt">
        <input type="submit" id="goodsBuyBtn" class="btn p2153 f20 jvf_bold" value="<?php echo L("member_payment_submint");?>">
      </div>
    </form>
  </div>
</div>
        
        </div>
    </div>
    <div class="jvf_w100"></div>
    
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