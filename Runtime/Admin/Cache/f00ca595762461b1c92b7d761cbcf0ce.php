<?php if (!defined('THINK_PATH')) exit();?><div class="pageContent">

	<form method="post" action="__URL__/doBackUp/navTabId/__MODULE__" class="pageForm required-validate" onsubmit="return validateCallback(this, repeatAjaxDone)">
		<div class="pageFormContent" layoutH="58">
			<dl>
				<dt>分卷大小：</dt>
				<dd>
					<input type="text" class="required textInput valid" name="size" min="1" value="1000">(KB)
				</dd>
			</dl>
			<dl>
				<dt>数据库表：</dt>
				<dd>
				<?php if(is_array($table)): $i = 0; $__LIST__ = $table;if( count($__LIST__)==0 ) : echo "" ;else: foreach($__LIST__ as $key=>$vo): ++$i;$mod = ($i % 2 )?><input type="checkbox" name="table[]" value="<?php echo ($vo["Name"]); ?>" checked="checked" /><?php echo ($vo["Name"]); ?>(<?php echo (formatsize($vo["Data_length"])); ?>)<br><?php endforeach; endif; else: echo "" ;endif; ?>
				</dd>
			</dl>
		</div>
		
		<div class="formBar">
			<label style="float:left"><input type="checkbox" class="checkboxCtrl" group="table[]" checked="checked" />全选</label>
			<ul>
				<li><div class="button"><div class="buttonContent"><button type="button" class="checkboxCtrl" group="table[]" selectType="invert">反选</button></div></div></li>
				<li><div class="buttonActive"><div class="buttonContent"><button type="submit">提交</button></div></div></li>
			</ul>
		</div>
	</form>

</div>