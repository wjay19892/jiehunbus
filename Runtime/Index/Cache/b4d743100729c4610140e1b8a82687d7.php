<?php if (!defined('THINK_PATH')) exit();?><h3 class="map-description <?php if(($vo["type"])  ==  "1"): ?>exact<?php else: ?>public<?php endif; ?>" lid="<?php echo ($vo["id"]); ?>">
   <span class="icon"></span>
   <?php echo L("member_location_address");?><span class="address"><?php echo ($vo["address"]); ?></span>
   <a class="editaddress" href="<?php echo U('Member/editlocation/id/'.$vo['id']);?>"><?php echo L("edit");?></a>
   <a class="deladdress" href="<?php echo U('Member/dellocation/id/'.$vo['id']);?>"><?php echo L("delete");?></a>
   <a class="defaultaddress" href="<?php echo U('Member/setlocation/id/'.$vo['id']);?>" <?php if(($vo["type"])  ==  "1"): ?>style="display:none;"<?php endif; ?>><span class="protip"><?php echo L("setdefault");?></span></a>
</h3>