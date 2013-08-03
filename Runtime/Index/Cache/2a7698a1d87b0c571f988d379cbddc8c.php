<?php if (!defined('THINK_PATH')) exit();?><?php if(empty($talk_aboutdata)): ?><div style="width:680px;" id="like_space" class="block-space shop_all">
			<div class="index-space">
				<i></i>这里空空如也、寸草不生、空无一物、人去楼空、总之什么都没有！！
			</div>
	</div>
<?php else: ?>
<?php if(is_array($talk_aboutdata)): $i = 0; $__LIST__ = $talk_aboutdata;if( count($__LIST__)==0 ) : echo "" ;else: foreach($__LIST__ as $key=>$vo): ++$i;$mod = ($i % 2 )?><div class="shop_all">
    <div class="jvf_frame w225 pr">
    		<?php if(!empty($vo['accessory']) || !empty($vo['goods_accessory'])): ?><div class="comwit">
        	<a href="<?php echo U('Talk_about/detail/id/'.$vo['id']);?>">
        		<?php if(empty($vo["gid"])): ?><img width="213" src="<?php echo ($vo["accessory"]["0"]["thumbnail"]); ?>" height="<?php echo ($vo["accessory"]["0"]["thumbnail_height"]); ?>">
        		<?php else: ?>
        		<img width="213" src="<?php echo ($vo["goods_accessory"]["thumbnail"]); ?>" height="<?php echo ($vo["goods_accessory"]["thumbnail_height"]); ?>"><?php endif; ?>
        	</a>
        	</div><?php endif; ?>
            <div class="comwit_c circle_con">
            	<span class="marks_star jvf_ico"></span>
            	<?php echo ($vo["content"]); ?>
                <span class="marks_end jvf_ico"></span>
            </div>
            <div class="jvf_frame_bot clearfix">
            	<div class="user_head jvf_fl"><a href="<?php echo U('User/space/id/'.$vo['uid']);?>" uid="<?php echo ($vo['uid']); ?>" class="jvf_getUser"><img width="35" height="35" src="<?php echo ($vo["header"]); ?>"></a></div>
                <div class="user_at jvf_fl"><span class="user_name"><a href="<?php echo U('User/space/id/'.$vo['uid']);?>"><?php echo ($vo["name"]); ?></a></span>
                	<?php if(!empty($vo["gid"])): ?><span class="jvf_ico at"></span>
	                    <a href="<?php echo U('Goods/index/id/'.$vo['gid']);?>"><?php echo ($vo["title"]); ?></a>
                    <?php else: ?>
	                    <?php if(!empty($vo["member"])): ?><span class="jvf_ico at"></span>
	                    <?php if(is_array($vo["member"])): $i = 0; $__LIST__ = $vo["member"];if( count($__LIST__)==0 ) : echo "" ;else: foreach($__LIST__ as $key=>$v): ++$i;$mod = ($i % 2 )?><a href="<?php echo U('User/space/id/'.$v['uid']);?>"><?php echo ($v["name"]); ?>；</a><?php endforeach; endif; else: echo "" ;endif; ?>
	                    <?php else: ?>
	                    <span class="jvf_ico bo"></span>
	                    <?php if(is_array($vo["label"])): $i = 0; $__LIST__ = $vo["label"];if( count($__LIST__)==0 ) : echo "" ;else: foreach($__LIST__ as $key=>$v): ++$i;$mod = ($i % 2 )?><a href="<?php echo U('Circle/index/lid/'.$v['lid']);?>">#<?php echo ($v["name"]); ?>#</a><?php endforeach; endif; else: echo "" ;endif; ?><?php endif; ?><?php endif; ?>
                    <?php if(!empty($vo["source"])): ?><span class="jvf_ico at"></span>
	                    <a href="<?php echo U('User/space/id/'.$vo['source']['uid']);?>"><?php echo ($vo["source"]["name"]); ?></a>
	                    <?php echo ($vo["source"]["content"]); ?><?php endif; ?>
                </div>
            </div>
            
            <div class="space_operation clearfix">
                  <a href="<?php echo U('Member/talk_aboutLike/tid/'.$vo['id']);?>" class="like"><?php echo L("like");?></a>
                  <a href="<?php echo U('Talk_about/detail/id/'.$vo['id']);?>" target="_blank"><?php echo L("detail_text");?></a>
     		 </div>
            
    </div>
    <div class="jvf_allimg shop_bot"></div>
</div><?php endforeach; endif; else: echo "" ;endif; ?><?php endif; ?>