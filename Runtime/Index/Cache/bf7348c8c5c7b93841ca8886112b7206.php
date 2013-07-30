<?php if (!defined('THINK_PATH')) exit();?><div id="feed_div" class="e jvf_dynamic">
<?php if(empty($feeds_list)): ?><div style="width:680px;" id="like_space" class="block-space shop_all">
			<div class="index-space">
				<i></i>您的好友没有任何动静！！或者您在这里还没有结识新的朋友。赶快行动起来，和他们一起分享快乐吧！
			</div>
	</div>
<?php else: ?>
<?php if(is_array($feeds_list)): $i = 0; $__LIST__ = $feeds_list;if( count($__LIST__)==0 ) : echo "" ;else: foreach($__LIST__ as $key=>$vo): ++$i;$mod = ($i % 2 )?><h4 class="et"><?php if($key == 'today'): ?><?php echo L("today");?><?php elseif($key == 'yesterday'): ?><?php echo L("yesterday");?><?php else: ?><?php echo ($key); ?><?php endif; ?></h4>
 <ul class="el">
 <?php if(is_array($vo)): $i = 0; $__LIST__ = $vo;if( count($__LIST__)==0 ) : echo "" ;else: foreach($__LIST__ as $key=>$value): ++$i;$mod = ($i % 2 )?><?php if(is_array($value["feed"])): $i = 0; $__LIST__ = $value["feed"];if( count($__LIST__)==0 ) : echo "" ;else: foreach($__LIST__ as $key=>$feed): ++$i;$mod = ($i % 2 )?><li class="clearfix" id="feed_<?php echo ($feed["id"]); ?>_li">
	     <div class="clearfix"> <a class="t" href="javascript:void(0);" title=""><img src="../Public/images/feed/<?php echo ($feed["type"]); ?>.gif"></a><?php echo ($feed["content"]); ?><span class="xg1"><span title="<?php echo (toDate($feed["addtime"])); ?>"><?php echo (dgmdate($feed["addtime"])); ?></span></span></div>
	 </li><?php endforeach; endif; else: echo "" ;endif; ?><?php endforeach; endif; else: echo "" ;endif; ?>  
 </ul><?php endforeach; endif; else: echo "" ;endif; ?><?php endif; ?>
</div>
<div class="jvf_page">
<?php echo ($page); ?>
</div>