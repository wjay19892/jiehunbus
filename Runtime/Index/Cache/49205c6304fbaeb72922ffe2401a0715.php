<?php if (!defined('THINK_PATH')) exit();?><div class="ajax_recommend">
<ul>
<?php if(empty($recommenddata)): ?><li class="reviews-list-item"><?php echo L("recommend_refernceslist_empty_data");?></li>
<?php else: ?>
<?php if(is_array($recommenddata)): $i = 0; $__LIST__ = $recommenddata;if( count($__LIST__)==0 ) : echo "" ;else: foreach($__LIST__ as $key=>$vo): ++$i;$mod = ($i % 2 )?><li class="reviews-list-item clearfix">
      <div class="jvf_fl userpic1">
           <a rel="no-follow" href="<?php echo U('User/space/id/'.$vo['reviewer']['id']);?>"><img width="50px" height="50px" src="<?php echo ($vo["reviewer"]["header"]["thumbnail"]); ?>" alt="<?php echo ($vo["reviewer"]["name"]); ?>"></a><br>
         <?php echo L("recommended_by");?> </div>
    <div class="bubble jvf_fl jvf_frame">
       <p class="message">
        <?php echo L("recommended_by");?>：<a href="<?php echo U('User/space/id/'.$vo['reviewer']['id']);?>" class="name"><?php echo ($vo["reviewer"]["name"]); ?></a><br>
      </p><div class="clearfix pd510">
        <span class="jvf_ico yh1 jvf_fl"></span>
        <span class="jvf_fl jvf_over mw420"><?php echo ($vo["content"]); ?></span>
        <span class="jvf_ico yh2 jvf_fl"></span>
      </div>
      <div class="bubble_bot clearfix">
      <span class="date"><span title="<?php echo (toDate($vo["addtime"])); ?>"><?php echo (dgmdate($vo["addtime"])); ?></span></span>
      </div>
</li><?php endforeach; endif; else: echo "" ;endif; ?><?php endif; ?>
</ul>
</div>
<div class="jvf_page">
<?php echo ($page); ?>
</div>