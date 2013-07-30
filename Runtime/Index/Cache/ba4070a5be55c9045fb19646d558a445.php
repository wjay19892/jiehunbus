<?php if (!defined('THINK_PATH')) exit();?><script>
$(function(){
	memberReport();
});
</script>
<div title="<?php echo L("report");?>" style="width:300px;">
	<div class="box_fk"><?php echo L("report_box_fk");?></div>
	<form id="complaintForm" action="<?php echo U('Member/complaint');?>">
		<input type="hidden" name="gid" value="<?php echo ($_REQUEST['gid']); ?>">
	<div  class="box_ju">
    	<ul>
    	<?php if(is_array($complaint_item_data)): $i = 0; $__LIST__ = $complaint_item_data;if( count($__LIST__)==0 ) : echo "" ;else: foreach($__LIST__ as $key=>$vo): ++$i;$mod = ($i % 2 )?><li><input type="radio" name="item" <?php if(($i)  ==  "1"): ?>checked="checked"<?php endif; ?>><span><?php echo ($vo["name"]); ?></span></li><?php endforeach; endif; else: echo "" ;endif; ?>
            <li><input class="jvf_inputt" type="text" name="other" placeholder="<?php echo L("input_reason");?>" size="30"></li>
        </ul>
    </div>
   	<div class="jvf_box_buttom" style=" border-top:1px solid #E4E4E4;">
           <input type="button" class="btn p2153 f14 linebl" name="commit" value="<?php echo L("submit_text");?>" id="submit">
    </div>
	</form>
 
</div>