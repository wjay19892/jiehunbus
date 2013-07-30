<?php if (!defined('THINK_PATH')) exit();?><div class="ajax_comment">
<ul>
<?php if(empty($commentdata)): ?><li class="reviews-list-item"><?php echo L("comment_reviewslist_empty");?></li>
<?php else: ?>
<?php if(is_array($commentdata)): $i = 0; $__LIST__ = $commentdata;if( count($__LIST__)==0 ) : echo "" ;else: foreach($__LIST__ as $key=>$vo): ++$i;$mod = ($i % 2 )?><li class="reviews-list-item clearfix" >
	         <div class="jvf_fl userpic1">
	              <a rel="no-follow" href="<?php echo U('User/space/id/'.$vo['reviewer']['id']);?>"><img width="50px" height="50px" src="<?php echo ($vo["reviewer"]["header"]["thumbnail"]); ?>" alt="<?php echo ($vo["reviewer"]["name"]); ?>"></a><br>
	              <?php echo L("evaluators");?></div>
	       <div class="bubble jvf_fl jvf_frame">
	          <p class="message">
	          <?php echo L("evaluators");?>：<a href="<?php echo U('User/space/id/'.$vo['reviewer']['id']);?>" class="name"><?php echo ($vo["reviewer"]["name"]); ?></a><br>
	           <?php echo L("goods_title");?>：<a href="<?php echo U('Goods/index/id/'.$vo['goods']['id']);?>"><?php echo ($vo["goods"]["title"]); ?></a><br>
	        </p><div class="pdl10 clearfix">
	          <span style="line-height:16px;" class="jvf_fl"><?php echo L("evaluate");?>：</span>
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
	                  </div>
	     </div>
	</li><?php endforeach; endif; else: echo "" ;endif; ?><?php endif; ?>
</ul>
</div>
<div class="jvf_page">
<?php echo ($page); ?>
</div>