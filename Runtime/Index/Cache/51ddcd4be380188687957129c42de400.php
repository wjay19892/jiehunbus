<?php if (!defined('THINK_PATH')) exit();?><?php if(is_array($labeldata)): $i = 0; $__LIST__ = $labeldata;if( count($__LIST__)==0 ) : echo "" ;else: foreach($__LIST__ as $key=>$vo): ++$i;$mod = ($i % 2 )?><a class="bq bqlist" href="javascript:;" lid="<?php echo ($vo["id"]); ?>"><?php echo ($vo["name"]); ?></a><?php endforeach; endif; else: echo "" ;endif; ?>