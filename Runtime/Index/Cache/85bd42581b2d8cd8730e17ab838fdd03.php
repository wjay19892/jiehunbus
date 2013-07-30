<?php if (!defined('THINK_PATH')) exit();?>
	<div class="information_box_top clearfix">
            <div class="information_box_head jvf_fl">
                <div class="userpic"><a href="<?php echo U('User/space/id/'.$data['id']);?>"><img src="<?php echo ($data["header"]); ?>"></a></div>
                <?php if(!in_array($data['id'],$memberdata['attention_ids'])): ?><a class="but_a" href="<?php echo U('Member/attention/id/'.$data['id']);?>" add="add"><?php echo L("add_attention");?></a>
                <?php else: ?>
                <a class="but_a" href="<?php echo U('Member/removeattention/id/'.$data['id']);?>" remove="remove"><?php echo L("remove_attention");?></a><?php endif; ?>
            </div>
        
            <div class="jvf_fl information_user">
                <p class="information_usname"><a href="<?php echo U('User/space/id/'.$data['id']);?>"><?php echo ($data["name"]); ?></a></p>
                <p><span class="j"><?php echo L("mood");?>：<?php echo ($data["talkcount"]); ?></span><span class="v">|</span><span class="f"><?php echo L("add_attention");?>：<?php echo ($data["listencount"]); ?></span></p>
                <div class="jvf_boxnav">
                <a href="<?php echo U('Member/addfriend/id/'.$data['id']);?>"><?php echo L("addfriend");?></a>
                <a href="<?php echo U('Member/sendpm/id/'.$data['id']);?>"><?php echo L("private_letter");?></a>
                <a href="javascript:;" uid="<?php echo ($data['id']); ?>" class="jvf_callme"><?php echo L("chat");?></a> </div>
            </div>
    </div>
    
    <div class="jvf_cl"></div>
    <div class="box_signature">
    	<p><span class="marks_star jvf_ico"></span><?php echo ($data["self_introduction"]); ?><span class="marks_end jvf_ico"></span ></p>
    </div>
    <div class="user_grade"><?php echo L("level_text");?>：<?php echo ($data["level"]); ?></div>
    <div class="box_jvf jvf_allimg"></div>