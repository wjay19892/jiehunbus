<?php if (!defined('THINK_PATH')) exit();?><script>
$(function(){
	memberFriends();
});
</script>
<div class="clearfix friends_gl">
	<div class="sidebar jvf_fr">
	    <div class="boxC jvf_frame">
	    <h3><?php echo L("member_friends_group");?></h3>
	    <ul class="ulE">
	    	<li id="dt_all" <?php if($gid === ""): ?>class="curr"<?php endif; ?>><a href="<?php echo U('Member/friends');?>"><?php echo L("member_friends_all");?></a> [<span id="fcount"><?php echo ($total); ?></span>]</li>
	        <?php if(is_array($friendgroups)): $i = 0; $__LIST__ = $friendgroups;if( count($__LIST__)==0 ) : echo "" ;else: foreach($__LIST__ as $key=>$vo): ++$i;$mod = ($i % 2 )?><li gid="<?php echo ($vo["id"]); ?>" <?php if(($gid)  ==  $vo['id']): ?>class="curr"<?php endif; ?>>
	        	<div class="lis">
	        	<a class="mr5 groupname jvf_onlin jvf_fl maxw" href="<?php echo U('Member/friends/gid/'.$vo['id']);?>"><?php echo ($vo["name"]); ?></a>
	          <span class="jvf_fl">[<?php echo ($vo["count"]); ?>]</span>
	          
	        	</div>
	          <div class="jvf_cl"></div>
	        </li><?php endforeach; endif; else: echo "" ;endif; ?>
	        <li id="dt_ng" <?php if(($gid)  ==  "0"): ?>class="curr"<?php endif; ?>><a href="<?php echo U('Member/friends/gid/0');?>"><?php echo L("no_group");?></a> [<span id="fcount"><?php echo ($ngcount); ?></span>]</li>
	    </ul>
	    <div class="addBox"></div>
	    <div class="pd5">
	      <span class="cp addImg"><?php echo L("member_friends_add_group");?></span></div>
	    </div>
	</div>
                          
                          
                          
     <div class="clearfix jvf_fl friends_list">
     <div class="contentB p_lr_10">
    <div class="friList mb10" id="friList">
      <?php if(empty($friendsdata)): ?><div style="width:510px;" id="like_space" class="block-space shop_all">
                <div class="index-space">
                    <i></i>您在这里还没有结识新的朋友。赶快行动起来，和他们一起分享快乐吧！
                </div>
        </div>
    <?php else: ?>
       <?php if(is_array($friendsdata)): $i = 0; $__LIST__ = $friendsdata;if( count($__LIST__)==0 ) : echo "" ;else: foreach($__LIST__ as $key=>$vo): ++$i;$mod = ($i % 2 )?><dl uid="<?php echo ($vo["frienddata"]["id"]); ?>" class="clearfix nadlA">
           <div class="jvf_fl friends_im"><a href="<?php echo U('User/space/id/'.$vo['frienddata']['id']);?>" class="img_50 _cardshow"><img width="50" height="50" src="<?php echo ($vo["frienddata"]["header"]["thumbnail"]); ?>"></a></div>
             <div class="nadlCon">
               <div class="nadlCon_l jvf_fl">
                 <p class="mb5"> <a href="<?php echo U('User/space/id/'.$vo['frienddata']['id']);?>" class="b _cardshow"><?php echo ($vo["frienddata"]["name"]); ?></a> </p>
                 <p class="mb5"></p>
                 <p><?php echo L("be_concerned");?>：<span class="mr20"><?php echo ($vo["frienddata"]["attention_num"]); ?></span><?php echo L("last_sign");?>: <?php echo (toDateRefer($vo["frienddata"]["lastlog"]["addtime"])); ?></p>
               </div>
               <div class="nadlCon_r jvf_fl pr">
                   <a href="javascript:;" class="link_down" title="<?php echo L("member_friends_re_group");?>"><?php if(empty($vo["groupdata"])): ?><span><?php echo L("no_group");?></span><?php else: ?><span class="jvf_onlin maxw"><?php echo ($vo["groupdata"]["name"]); ?></span><?php endif; ?></a>
               </div>
               <div class="nadlCon_c jvf_fr pr">
                 <p class="mb5"><img src="../Public/images/feed/mnfollow.png"></p>
               </div>
               <div class="jvf_cl"></div>
             </div>
       </dl><?php endforeach; endif; else: echo "" ;endif; ?><?php endif; ?>
       </div>
       <div class="jvf_page">
		<?php echo ($page); ?>
		</div>
       <div class="mb10 clearfix"></div>
     </div>
 </div>   
</div>