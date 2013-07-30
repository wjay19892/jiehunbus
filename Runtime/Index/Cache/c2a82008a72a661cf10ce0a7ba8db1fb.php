<?php if (!defined('THINK_PATH')) exit();?><script>
$(function(){
	memberRelpypm();
});
</script>
<div style="width:390px;" title="<?php echo L("member_replypm_title");?>">
    <form class="cmxform" action="<?php echo U('Member/pmsend');?>" method="post">
        <div class="segment box_replypm">
            <div class="clearfix mb10">
                <label><?php echo L("addressee");?>：</label>
                <input class="jvf_user_id" id="name" name="name" type="text" value="<?php echo ($membinfo["name"]); ?>" readonly="readonly" />
                <input type="hidden" id="receive" name="receive" value="<?php echo ($membinfo["id"]); ?>"/>
            </div>
            <div class="clearfix">
               <label><?php echo L("content_text");?>：</label>
               <textarea id="content" class="jvf_user_id" name="content" rows="5" placeholder="<?php echo L("content_text");?>"></textarea>
            </div>
        </div>
        <div class="jvf_box_buttom">
            <input type="button" id="submit" value="<?php echo L("send_text");?>" name="commit" class="btn p2153 f14 linebl">
            <span id="forgotnotice" style="display:none;"></span>
        </div>
    </form>
     
</div>