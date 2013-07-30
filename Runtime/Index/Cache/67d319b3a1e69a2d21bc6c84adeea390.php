<?php if (!defined('THINK_PATH')) exit();?><?php if(is_array($nerbyfriend)): $i = 0; $__LIST__ = $nerbyfriend;if( count($__LIST__)==0 ) : echo "" ;else: foreach($__LIST__ as $key=>$vo): ++$i;$mod = ($i % 2 )?><div class="shop_all jvf_fl">
    <div class="jvf_frame w225 pr">
        <div class="maxtx_img"><a href="<?php echo U('User/space/id/'.$vo['id']);?>">
        <img width="213" height="213" src="<?php echo ($vo["header"]["path"]); ?>"></a>
        <div class="space_operation clearfix">
        <?php if(!in_array($vo['id'],$memberdata['attention_ids'])): ?><a class="but_a" href="<?php echo U('Member/attention/id/'.$vo['id']);?>" add="add"><?php echo L("add_attention");?></a>
        <?php else: ?>
          <a class="but_a" href="<?php echo U('Member/removeattention/id/'.$vo['id']);?>" remove="remove"><?php echo L("remove_attention");?></a><?php endif; ?>
          <a href="<?php echo U('Member/addfriend/id/'.$vo['id']);?>" class="doDialog"><?php echo L("addfriend");?></a>
          <a href="<?php echo U('Member/sendpm/id/'.$vo['id']);?>" class="doDialog"><?php echo L("private_letter");?></a>
          <a href="javascript:;" uid="<?php echo ($vo['id']); ?>" class="jvf_callme"><?php echo L("chat");?></a>
      </div>
        </div>
        <div class="meber_name clearfix"><a class="jvf_fl jvf_over" href="<?php echo U('User/space/id/'.$vo['id']);?>"><?php echo ($vo["name"]); ?></a>
        <?php if(($vo["sex"])  ==  "0"): ?><span class="jvf_ico unman jvf_fr"></span><?php endif; ?>
       	<?php if(($vo["sex"])  ==  "1"): ?><span class="jvf_ico man jvf_fr"></span><?php endif; ?>
       	<?php if(($vo["sex"])  ==  "2"): ?><span class="jvf_ico woman jvf_fr"></span><?php endif; ?>
        </div>
        <div class="member_jianj"><span class="marks_star jvf_ico"></span><?php echo ($vo["self_introduction"]); ?><span class="marks_end jvf_ico"></span></div>
        <div class="member_adr"><?php echo L("come_from");?>：<?php echo ($vo["address"]); ?></div>
        <div class="shop_adr clearfix"><a class="jvf_fl jvf_over mw145 jvf_address" href="javascript:;" uid="<?php echo ($vo["id"]); ?>"><?php echo L("default_location_away");?></a><span class="jvf_adr jvf_fl pr"><em class="jvf_ico"></em><?php echo (formatDistance($vo["distance"])); ?></span></div>
        
        <div class="member_con_bot clearfix">
        	<ul>
            	<li>
                	<?php echo L("audience");?>：<a href="javascript:;"><?php echo ($vo["was_attention"]); ?></a><br />
                </li>
                <li>
                	<?php echo L("listen");?>：<a href="javascript:;"><?php echo ($vo["attention"]); ?></a>
                </li>
                <li>
                	<?php echo L("mood");?>：<a href="javascript:;"><?php echo ($vo["talk_about"]); ?></a><br />
                </li>
            </ul>
        </div>
    </div>
    <div class="jvf_allimg shop_bot"></div>
</div><?php endforeach; endif; else: echo "" ;endif; ?>