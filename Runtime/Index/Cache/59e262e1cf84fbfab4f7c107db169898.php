<?php if (!defined('THINK_PATH')) exit();?><dl uid="<?php echo ($uid); ?>" style="display: block;">
<?php if(is_array($logdata)): $i = 0; $__LIST__ = $logdata;if( count($__LIST__)==0 ) : echo "" ;else: foreach($__LIST__ as $key=>$vo): ++$i;$mod = ($i % 2 )?><dd <?php if(($vo["receive"])  ==  $uid): ?>class="wbim_msgl"<?php else: ?>class="wbim_msgr"<?php endif; ?>>
	    <div class="wbim_msgpos">
	        <div class="msg_time">
	            <?php echo ($vo["send_name"]); ?> <?php echo (toDate($vo["addtime"])); ?>
	        </div>
	        <div class="msg_box">
	            <p class="txt">
	                <?php echo (contentFilter($vo["content"])); ?>
	            </p>
	        </div>
	    </div>
	</dd><?php endforeach; endif; else: echo "" ;endif; ?>
</dl>