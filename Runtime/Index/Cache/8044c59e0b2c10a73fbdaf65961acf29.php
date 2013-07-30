<?php if (!defined('THINK_PATH')) exit();?><?php if(empty($commentdata)): ?><li class="reviews-list-item clearfix"><?php echo L("comment_releasedlist_empty");?></li>
<?php else: ?>
<?php if(is_array($commentdata)): $i = 0; $__LIST__ = $commentdata;if( count($__LIST__)==0 ) : echo "" ;else: foreach($__LIST__ as $key=>$vo): ++$i;$mod = ($i % 2 )?><li class="reviews-list-item clearfix">
  	
          <div class="jvf_fl userpic1">
               <a href="<?php echo U('User/space/id/'.$vo['goods']['promulgator']['id']);?>" rel="no-follow"><img width="50px" height="50px" alt="<?php echo ($vo["goods"]["promulgator"]["name"]); ?>" src="<?php echo ($vo["goods"]["promulgator"]["header"]["thumbnail"]); ?>" ></a><br />
               <?php echo L("goods_manager");?>
          </div>
        <div class="bubble jvf_fl jvf_frame">
     	   <p class="message">
        	<?php echo L("goods_manager");?>：<a class="name" href="<?php echo U('User/space/id/'.$vo['goods']['promulgator']['id']);?>"><?php echo ($vo["goods"]["promulgator"]["name"]); ?></a><br />
          	<?php echo L("goods_title");?>：<a href="<?php echo U('Goods/index/id/'.$vo['goods']['id']);?>"><?php echo ($vo["goods"]["title"]); ?></a><br>
         <div class="pdl10 clearfix">
           <span class="jvf_fl" style="line-height:16px;"><?php echo L("evaluate");?>：</span>
           <div class="jvf_fl rating">
               <div class="filled star_<?php echo ($vo["goods"]["evaluate"]["total"]["star"]); ?>"></div>
           </div>
		</div>
       <div class="clearfix pd510">
       	<span class="jvf_ico yh1 jvf_fl"></span>
       	<span class="jvf_fl"><?php echo ($vo["content"]); ?></span>
       	<span class="jvf_ico yh2 jvf_fl"></span></div>
        <div class="bubble_bot">
        <span class="date">
        	<span title="<?php echo (toDate($vo["addtime"])); ?>"><?php echo (dgmdate($vo["addtime"])); ?></span>
        </span>
        	<!--<?php if(($now - $vo['addtime']) <= 1209600): ?><span class="edit"><a class="editcomment" href="<?php echo U('Member/editcomment/id/'.$vo['id']);?>"><?php echo L("edit_text");?></a></span><?php endif; ?>-->
        </div>
       </div>
  </li><?php endforeach; endif; else: echo "" ;endif; ?><?php endif; ?>