<?php if (!defined('THINK_PATH')) exit();?>	<ul class="talk_aboutBox">
    <?php if(empty($talk_aboutdata)): ?><li class="reviews-list-item"><?php echo L("comment_reviewslist_empty");?></li>
<?php else: ?>
	<?php if(is_array($talk_aboutdata)): $i = 0; $__LIST__ = $talk_aboutdata;if( count($__LIST__)==0 ) : echo "" ;else: foreach($__LIST__ as $key=>$vo): ++$i;$mod = ($i % 2 )?>		<li class="clearfix">
        	<div class="userpic jvf_fl">
            	<a href="<?php echo U('User/space/id/'.$vo['uid']);?>" class="jvf_getUser" uid="<?php echo ($vo["uid"]); ?>"><img src="<?php echo ($vo["header"]); ?>"></a>
            </div>
            <div class="msgbox jvf_fl">
            	<div class="user_say"><span><a href="<?php echo U('User/space/id/'.$vo['uid']);?>"><?php echo ($vo["name"]); ?>：</a></span><?php echo ($vo["content"]); ?><br />
            	<?php if(!empty($vo["source"])): ?><div class="jvf_relay"><span><a href="<?php echo U('User/space/id/'.$vo['source']['uid']);?>"><?php echo ($vo["source"]["name"]); ?>：</a></span>
                		<?php echo ($vo["source"]["content"]); ?>
                		<div class="mediawrap">
			                	<ul class="clearfix">
			                		<?php if(is_array($vo["source"]["accessory"])): $i = 0; $__LIST__ = $vo["source"]["accessory"];if( count($__LIST__)==0 ) : echo "" ;else: foreach($__LIST__ as $key=>$v): ++$i;$mod = ($i % 2 )?><li><a href="<?php echo ($v["origin"]); ?>"><img src="<?php echo ($v["thumbnail"]); ?>" /></a></li><?php endforeach; endif; else: echo "" ;endif; ?>
			                    </ul>
			             </div>
                    </div><?php endif; ?>
                </div>
                <?php if(empty($vo["source"])): ?><div class="mediawrap">
                	<ul class="clearfix">
                	<?php if(is_array($vo["accessory"])): $i = 0; $__LIST__ = $vo["accessory"];if( count($__LIST__)==0 ) : echo "" ;else: foreach($__LIST__ as $key=>$v): ++$i;$mod = ($i % 2 )?><li><a href="<?php echo ($v["origin"]); ?>"><img src="<?php echo ($v["thumbnail"]); ?>" /></a></li><?php endforeach; endif; else: echo "" ;endif; ?>
                    </ul>
                </div><?php endif; ?>
                <div class="user_say_bot clearfix">
                	<div class="jvf_fl"><?php echo (dgmdate($vo["addtime"])); ?></div>
                    <div class="jvf_fr">
                    	<a href="javascript:;" class="tabroadcast" tid="<?php echo ($vo['tid']?$vo['tid']:$vo['id']); ?>"><?php echo L("broadcast");?>(<?php echo ($vo["forwarding"]); ?>)</a>
                    	<span class="lin">|</span>
                    	<a href="javascript:;" class="comment" tid="<?php echo ($vo["id"]); ?>"><?php echo L("comment");?>(<span><?php echo ($vo["comment"]); ?></span>)</a>
                    	<span class="lin">|</span>
                    	<a href="javascript:;" class="likes" tid="<?php echo ($vo["id"]); ?>"><?php echo L("like");?>(<span><?php echo ($vo["likes"]); ?></span>)</a>
                    </div>
                </div>
                
                        <ul class="jvf_insertping_list" style="display:none;">
                        	
                        </ul>
            </div>
        </li>
<?php endforeach; endif; else: echo "" ;endif; ?><?php endif; ?>
	</ul>
	<div class="jvf_page">
	<?php echo ($page); ?>
	</div>