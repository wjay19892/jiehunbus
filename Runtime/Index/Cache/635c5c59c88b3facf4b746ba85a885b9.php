<?php if (!defined('THINK_PATH')) exit();?><?php if(is_array($nerbygoods)): $i = 0; $__LIST__ = $nerbygoods;if( count($__LIST__)==0 ) : echo "" ;else: foreach($__LIST__ as $key=>$vo): ++$i;$mod = ($i % 2 )?><div class="shop_all">
     <div class="jvf_frame w225">
         <div class="shopall_img"><a href="<?php echo U('Goods/index/id/'.$vo['id']);?>"><img width="213" src="<?php echo ($vo["accessory"]["path"]); ?>" height="<?php echo ($vo["accessory"]["thumbnail_height"]); ?>"></a></div>
         <div class="shop_name"><a href="<?php echo U('Goods/index/id/'.$vo['id']);?>"><?php echo ($vo["title"]); ?></a></div>
         <div class="shop_adr clearfix"><a class="jvf_fl jvf_over mw145 jvf_address" href="javascript:;" gid="<?php echo ($vo["id"]); ?>"><?php echo ($vo["address"]); ?></a><span class="jvf_adr jvf_fl pr"><em class="jvf_ico"></em><?php echo distance($locate['lat'],$locate['lng'],$vo['latitude'],$vo['longitude']);?></span></div>
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