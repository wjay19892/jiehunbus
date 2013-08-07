<?php if (!defined('THINK_PATH')) exit();?><?php if(is_array($users)): $i = 0; $__LIST__ = $users;if( count($__LIST__)==0 ) : echo "" ;else: foreach($__LIST__ as $key=>$vo): ++$i;$mod = ($i % 2 )?><li>
	<a href="<?php echo U('User/space/id/'.$vo['id']);?>" class="jvf_getUser" uid="<?php echo ($vo["id"]); ?>"><img width="50" height="50" src="<?php echo ($vo["header"]["thumbnail"]); ?>" /></a>
    <div><?php echo ($vo["name"]); ?></div>
</li><?php endforeach; endif; else: echo "" ;endif; ?>