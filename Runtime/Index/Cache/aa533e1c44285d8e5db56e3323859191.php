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
<script type="text/javascript" src="../Public/js/baidumap_location.js"></script>
<script type="text/javascript" src="http://api.map.baidu.com/api?v=1.3&callback=load_map_wrapper"></script>
<script>
$(function(){
	goodsRelease();
});

function load_map_wrapper(){
	<?php if(($goodsdata["latitude"] != '') AND ($goodsdata["latitude"] != '')): ?>initialize('map_canvas');
	addTags(<?php echo ($goodsdata["latitude"]); ?>,<?php echo ($goodsdata["longitude"]); ?>,"<?php echo ($goodsdata["address"]); ?>","map_canvas",<?php echo ($goodsdata["zoom"]); ?>);
	<?php elseif(($memberdata.business.latitude != '') AND ($memberdata.business.latitude != '')): ?>
	initialize('map_canvas');
	addTags(<?php echo ($memberdata["business"]["latitude"]); ?>,<?php echo ($memberdata["business"]["longitude"]); ?>,"<?php echo ($memberdata["business"]["address"]); ?>","map_canvas",<?php echo ($memberdata["business"]["zoom"]); ?>);
	<?php else: ?>
	initialize('map_canvas');<?php endif; ?>
}
</script>
<div class="mainbody body_bot body_con clearfix">
	<div class="jvf_body clearfix">

<div class="fb_shop jvf_frame ">
<h2  class="fb_tit">发布商品</h2>
<form action="<?php echo U('Goods/doRelease');?>" class="hosting_new" id="releaseForm" method="post">
<?php if(!empty($goodsdata["id"])): ?><input name="id" value="<?php echo ($goodsdata["id"]); ?>" type="hidden"/><?php endif; ?>
<div class="goods_fb">
    <ul class="narrow_page_section_content rounded_bottom clearfix" id="details">
        <li>
            <div class="label_with_description">
                <label for="title">
                   <?php echo L("goods_release_title");?>:
                </label>
            </div>
            <input type="text"  class="w400" value="<?php echo ($goodsdata["title"]); ?>" name="title" id="title">
        </li>
        <li>
            <div class="label_with_description">
                <label for="short_title">
                   <?php echo L("goods_release_short_title");?>:
                </label>
            </div>
            <input type="text" style="width: 129px" value="<?php echo ($goodsdata["short_title"]); ?>" name="short_title" id="short_title">
      </li>
      <li>
          <div class="label_with_description">
              <label for="addCategory">
                  <?php echo L("category_text");?>:
              </label>
          </div>
          <input type="hidden" value="<?php echo ($goodsdata["cid"]); ?>" readonly="readonly" id="category" name="cid">
          <input type="text" value="<?php echo ($goodsdata["category_name"]); ?>" style="width: 50px;" readonly="readonly" id="category_name" name="category_name">
          <a id="addCategory" href="<?php echo U('Search/categoryAll/inputType/radio/all/1');?>">
              <?php echo L("category_add");?>
          </a>
      </li>
      <li>
          <div class="label_with_description">
              <label for="addRegion">
                  <?php echo L("region_text");?>:
              </label>
          </div>
          <input type="hidden" value="<?php echo ($goodsdata["rid"]); ?>" readonly="readonly" id="region" name="rid">
          <input type="text" style="width: 50px;" value="<?php echo ($goodsdata["region_name"]); ?>" readonly="readonly" id="region_name" name="region_name">
          <a id="addRegion" href="<?php echo U('Search/regionAll/inputType/radio/all/1');?>">
             <?php echo L("region_add");?>
          </a>
      </li>
      <li>
          <div class="label_with_description">
              <label for="original">
                  <?php echo L("original_text");?>:
              </label>
          </div>
          <input type="text" value="<?php echo ($goodsdata["original"]); ?>" style="width: 50px;" name="original" id="original">
      </li>
      <!--<li>
          <div class="label_with_description">
              <label for="payment">
                  <?php echo L("payment_text");?>:
              </label>
          </div>
          
          <label class="goods_danx"><input type="radio" value="0" name="payment" <?php if(($goodsdata["payment"])  ==  "0"): ?>checked="checked"<?php endif; ?>><?php echo L("now_price");?></label>
          <label class="goods_danx"><input type="radio" value="1" name="payment" <?php if(($goodsdata["payment"])  ==  "1"): ?>checked="checked"<?php endif; ?>><?php echo L("payment_deposit");?></label>
      </li>-->
      <li>
          <div class="label_with_description">
              <label for="price" id="price" <?php if(($goodsdata["payment"])  ==  "1"): ?>style="display: none;"<?php endif; ?>>
                 <?php echo L("now_price");?>:
              </label>
			  <!--<label for="deposit" id="deposit" <?php if(($goodsdata["payment"])  ==  "0"): ?>style="display: none;"<?php endif; ?>>
                  <?php echo L("payment_deposit");?>:
              </label>-->
          </div>
          <input type="text" value="<?php echo ($goodsdata["price"]); ?>" style="width: 50px;" name="price">
      </li>
      <li>
          <div class="label_with_description">
              <label for="num">
                 <?php echo L("nums_text");?>:
              </label>
          </div>
          <input type="text" value="<?php echo ($goodsdata["num"]); ?>" style="width: 50px;" name="num" id="num">
      </li>
      <!--<li>
          <div class="label_with_description">
              <label for="onenum">
                  <?php echo L("member_gooddetail_sales_quota");?>:
              </label>
          </div>
          <input type="text" value="<?php echo ($goodsdata["onenum"]); ?>" style="width: 50px;" name="onenum" id="onenum"><span><?php echo L("onenum_tip");?></span>
      </li>-->
      <!--<li>
          <div class="label_with_description">
              <label for="onenum">
                  <?php echo L("goods_release_pre");?>:
              </label>
          </div>
          <input type="text" value="<?php echo ($goodsdata["pre"]); ?>" style="width: 50px;" name="pre" id="pre">
      </li>-->
      <!--<li>
          <div class="label_with_description">
              <label for="starttime">
                  <?php echo L("goods_release_validity");?>:
              </label>
          </div>
          <input type="text" readonly="readonly" style="width: 129px;" class="jvf_date" <?php if(empty($goodsdata["starttime"])): ?>value="<?php echo toDateYmd(time());?>"<?php else: ?>value="<?php echo (toDateYmd($goodsdata["starttime"])); ?>"<?php endif; ?> name="starttime" id="starttime">
          <span>～</span>
          <input type="text" readonly="readonly" style="width: 129px;" class="jvf_date" <?php if(empty($goodsdata["endtime"])): ?>value="<?php echo toDateYmd(time()+86400);?>"<?php else: ?>value="<?php echo (toDateYmd($goodsdata["endtime"])); ?>"<?php endif; ?> name="endtime" id="endtime">
      </li>-->
      <li>
          <div class="label_with_description">
              <label for="onenum">
                  店长<?php echo L("goods_release_phone");?>:
              </label>
          </div>
          <input type="text" value="<?php echo ($goodsdata["tel"]); ?>" style="width: 129px;" name="tel" id="tel">
      </li>
      <li>
          <div class="label_with_description">
              <label for="onenum">
                  <?php echo L("address_text");?>:
              </label>
          </div>
          <input type="text" value="<?php echo ($goodsdata['address']?$goodsdata['address']:$memberdata['business']['address']); ?>" class="w400" name="address" id="address">
          <a onclick="codeAddress($('#address').val());" href="javascript:;"><?php echo L("map_addmarker");?></a>
          <a onclick="showMarker();" href="javascript:;"><?php echo L("map_showmarker");?></a>
            </li>
            <li>
                <div id="map_canvas" class="fb_mpf"></div>
                <input type="hidden" readonly="readonly" value="<?php echo ($goodsdata['longitude']?$goodsdata['longitude']:$memberdata['business']['longitude']); ?>" id="longitude" name="longitude">
                <input type="hidden" readonly="readonly" value="<?php echo ($goodsdata['latitude']?$goodsdata['latitude']:$memberdata['business']['latitude']); ?>" id="latitude" name="latitude">
                <input type="hidden" readonly="readonly" value="<?php echo ($goodsdata['zoom']?$goodsdata['zoom']:$memberdata['business']['zoom']); ?>" id="zoom" name="zoom">
            </li>
            <li>
                <div class="label_with_description">
                    <label for="short_title">
                        SEO <?php echo L("keywords");?>：
                    </label>
                </div>
                <textarea rows="4" cols="57" name="keywords"><?php echo ($goodsdata["keywords"]); ?></textarea>
            </li>
            <li>
                <div class="label_with_description">
                    <label for="short_title">
                        SEO <?php echo L("description");?>：
                    </label>
                </div>
                <textarea rows="4" cols="57" name="description"><?php echo ($goodsdata["description"]); ?></textarea>
            </li>
            
            <li>
                <div class="label_with_description">
                    <label for="detail">
                        <?php echo L("content_text");?>：
                    </label>
                </div>
                <textarea name="detail" style="width:500px;height: 302px;" class="editor" upImgUrl="<?php echo U('Xheditor/upLoadImg');?>" upImgExt="jpg,jpeg,gif,png" cols="40"><?php echo ($goodsdata["detail"]); ?></textarea>
            </li>
            <li>
                <div class="label_with_description">
                    <label for="short_title">
                        <?php echo L("member_avatar_upload");?>：
                    </label>
                </div>
                <div>
                	<a href="javascript:;" id="upload_button" class="btn linebl f14 p2153"><?php echo L("member_avatar_upload");?></a>
                	<ul id="imgBox" class="clearfix">
                	<?php if(is_array($goodsdata["accessory"])): $i = 0; $__LIST__ = $goodsdata["accessory"];if( count($__LIST__)==0 ) : echo "" ;else: foreach($__LIST__ as $key=>$vo): ++$i;$mod = ($i % 2 )?><li class="sortableitem"><div class="jvf_clos"><span>×</span></div><input type="hidden" name="imgs[]" value="<?php echo ($vo["id"]); ?>"><img src="<?php echo ($vo["thumbnail"]); ?>"></li><?php endforeach; endif; else: echo "" ;endif; ?>
                	</ul>
                </div>
            </li>
            <li>
                <div class="label_with_description">
                    <label for="egid"><?php echo L("goods_release_expand");?>:</label>
                </div>
                <select class="jvf_inputb" name="egid">
                    <option value="0"><?php echo L("goods_release_select");?></option>
                    <?php if(is_array($expand_groupList)): $i = 0; $__LIST__ = $expand_groupList;if( count($__LIST__)==0 ) : echo "" ;else: foreach($__LIST__ as $key=>$item): ++$i;$mod = ($i % 2 )?><option value="<?php echo ($item["id"]); ?>" <?php if(($goodsdata["egid"])  ==  $item['id']): ?>selected="selected"<?php endif; ?>><?php echo ($item["name"]); ?></option><?php endforeach; endif; else: echo "" ;endif; ?>
                </select>
            </li>
            <li id="expandBox">
                <ul id="expand">
<?php if(is_array($expand)): $i = 0; $__LIST__ = $expand;if( count($__LIST__)==0 ) : echo "" ;else: foreach($__LIST__ as $key=>$att): ++$i;$mod = ($i % 2 )?><li>
	<div class="label_with_description">
    <label><?php echo ($att["key"]); ?>：</label>
    </div>
    <?php if($att['type'] == 0): ?><!-- 手动输入 -->
        <input type="text" name="<?php echo ($att["id"]); ?>" class="textInput" value="<?php echo ($att["val"]); ?>" /><?php endif; ?>
    
    <?php if($att['type'] == 1): ?><div class="jvf_expand_content">
        <?php if(is_array($att['enum'])): foreach($att['enum'] as $key=>$enum_item): ?><!-- 单选 -->
        <label class="radioButton"><input type="radio" name="<?php echo ($att["id"]); ?>" value="<?php echo ($enum_item); ?>"  <?php if($enum_item == $att['val']): ?>checked="checked"<?php endif; ?> /><?php echo ($enum_item); ?></label><?php endforeach; endif; ?>
      </div><?php endif; ?>
    
    <?php if($att['type'] == 2): ?><select name="<?php echo ($att["id"]); ?>">
            <?php if(is_array($att['enum'])): foreach($att['enum'] as $key=>$enum_item): ?><!-- 下拉 -->
            <option value="<?php echo ($enum_item); ?>" <?php if($enum_item == $att['val']): ?>selected="selected"<?php endif; ?>><?php echo ($enum_item); ?></option><?php endforeach; endif; ?>
        </select><?php endif; ?>
    
    <?php if($att['type'] == 3): ?><!-- 文本域 -->
        <textarea rows="3" cols="55" name="<?php echo ($att["id"]); ?>" class="textInput"><?php echo ($att['val']); ?></textarea><?php endif; ?>
    
    <?php if($att['type'] == 4): ?><div class="jvf_expand_content">
        <?php if(is_array($att['enum'])): foreach($att['enum'] as $key=>$enum_item): ?><!-- 多选 -->
        <label class="radioButton"><input type="checkbox" name="<?php echo ($att["id"]); ?>[]" value="<?php echo ($enum_item); ?>"  <?php if(in_array($enum_item,$att['val'])): ?>checked="checked"<?php endif; ?> /><?php echo ($enum_item); ?></label><?php endforeach; endif; ?>
      </div><?php endif; ?>
                                   
    <?php if($att['type'] == 5): ?><!-- 图片域 -->
        <input type="file"  name="<?php echo ($att["id"]); ?>" class="valid" /> 
        <?php if($att['val'] != ''): ?><a href="__ROOT__<?php echo ($att["val"]); ?>" target="_blank" ><?php echo C("view_text");?></a><?php endif; ?><?php endif; ?>
    
    <?php if($att['type'] == 6): ?><!-- 日历控件 -->
        <input type="text" readonly="true" format="yyyy-MM-dd" class="jvf_date" name="<?php echo ($att["id"]); ?>" value="<?php echo ($att['val']); ?>"><?php endif; ?>
    
    <?php if($att['type'] == 7): ?><!-- 编辑器 -->
        <textarea id="<?php echo ($att["id"]); ?>"  class="editor" name="<?php echo ($att["id"]); ?>" rows="6" cols="55" tools="mfull" upLinkUrl="<?php echo U('Xheditor/fileUpload');?>" upLinkExt="zip,rar,txt" upImgUrl="<?php echo U('Xheditor/upLoadImg');?>" upImgExt="jpg,jpeg,gif,png" upFlashUrl="<?php echo U('Xheditor/fileUpload');?>" upFlashExt="swf" upMediaUrl="<?php echo U('Xheditor/fileUpload');?>" upMediaExt="avi"><?php echo ($att["val"]); ?></textarea><?php endif; ?>
</li><?php endforeach; endif; else: echo "" ;endif; ?>
</ul>
<script>
			xheditorBox();
			$('input.jvf_date').datepicker();
		</script>
            </li>
        </ul>
       
    </div>
    
    <div class="good_bot clearfix">
	<div class="jvf_fl xy">
    <input type="checkbox" value="1" name="tos_confirm" id="tos_confirm">
    <label for="tos_confirm">
        <span style="cursor:pointer;"><?php echo L("goods_release_agree");?></span>
        <a class="terms" href="<?php echo U('Index/terms');?>"><?php echo L("goods_release_terms");?></a>
    </label>
    </div>
    <input type="button" value="<?php echo L("goods_release_submit");?>" id="post_room_submit_button" class="btn p2153 f14 linebl">
	<input type="button" value="<?php echo L("goods_release_view");?>" id="post_room_view_button" class="btn p2153 f14 linebl">     
</div>
     </div> 

</form>
</div>
<div class="detail_bot jvf_allimg"></div>
 </div>
 <div>       
 
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