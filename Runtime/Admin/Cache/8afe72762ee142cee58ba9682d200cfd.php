<?php if (!defined('THINK_PATH')) exit();?>	
<div class="accordion" fillSpace="sideBar">
    <?php if(is_array($groupdata)): $i = 0; $__LIST__ = $groupdata;if( count($__LIST__)==0 ) : echo "" ;else: foreach($__LIST__ as $key=>$vo): ++$i;$mod = ($i % 2 )?><div class="accordionHeader">
		<h2><span>Folder</span><?php echo ($vo["title"]); ?></h2>
	</div>
	<div class="accordionContent">
	
		<ul class="tree treeFolder">
			<?php if(is_array($vo["menu"])): $i = 0; $__LIST__ = $vo["menu"];if( count($__LIST__)==0 ) : echo "" ;else: foreach($__LIST__ as $key=>$item): ++$i;$mod = ($i % 2 )?><?php if((strtolower($item['name']))  !=  "public"): ?><?php if((strtolower($item['name']))  !=  "index"): ?><?php if(($item['access'])  ==  "1"): ?><li><a href="__APP__/<?php echo ($item['name']); ?>/index/" target="navTab" rel="<?php echo ($item['name']); ?>"><?php echo ($item['title']); ?></a></li><?php endif; ?><?php endif; ?><?php endif; ?><?php endforeach; endif; else: echo "" ;endif; ?>
		</ul>

	</div><?php endforeach; endif; else: echo "" ;endif; ?>

</div>