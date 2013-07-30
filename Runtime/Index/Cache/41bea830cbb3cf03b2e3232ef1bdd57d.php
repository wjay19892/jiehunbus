<?php if (!defined('THINK_PATH')) exit();?><script>
$(function(){
	memberReminds();
});
</script>
<div class="jvf_remind_top">      
    <label for="filter"><?php echo L("member_show");?>:</label>
    <select id="filter" name="filter">
        <option <?php if(($filter == "") OR ($filter == "all")): ?>selected="selected"<?php endif; ?> value="all"><?php echo L("member_reminds_all");?></option>
                    <option <?php if(($filter == "unread")): ?>selected="selected"<?php endif; ?> value="unread"><?php echo L("member_reminds_unread");?></option>
                    <option <?php if(($filter == "read")): ?>selected="selected"<?php endif; ?> value="read"><?php echo L("member_reminds_read");?></option>
    </select>
</div>
      
<div id="feed_div" class="e jvf_mbpd">
       <ul class="el">
       <?php if(is_array($remindsdata)): $i = 0; $__LIST__ = $remindsdata;if( count($__LIST__)==0 ) : echo "" ;else: foreach($__LIST__ as $key=>$vo): ++$i;$mod = ($i % 2 )?><li class="clearfix">
	       		<div class="clearfix"><?php echo ($vo["content"]); ?> <span class="xg1"><span title="<?php echo (toDate($vo["addtime"])); ?>"><?php echo (dgmdate($vo["addtime"])); ?></span></span><a title="<?php echo L("delete");?>" class="o del" href="<?php echo U('Member/delremind/id/'.$vo['id']);?>"><?php echo L("delete");?></a></div>
	       </li><?php endforeach; endif; else: echo "" ;endif; ?>
       </ul>
</div>

<div class="jvf_page">
<?php echo ($page); ?>
</div>