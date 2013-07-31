<?php if (!defined('THINK_PATH')) exit();?><form id="pagerForm" action="__URL__" method="post">
	<input type="hidden" name="pageNum" value="1"/>
	<input type="hidden" name="_order" value="<?php echo ($_REQUEST["_order"]); ?>"/>
	<input type="hidden" name="_sort" value="<?php echo ($_REQUEST["_sort"]); ?>"/>
</form>


<div class="pageHeader">
	<form rel="pagerForm" onsubmit="return navTabSearch(this);" action="__URL__" method="post">
	<div class="searchBar">
		<ul class="searchContent">
			<li>
				<label>文件名：</label>
				<input type="text" name="filename" value=""/>
			</li>
		</ul>
		<div class="subBar">
			<ul>
				<li><div class="buttonActive"><div class="buttonContent"><button type="submit">查询</button></div></div></li>
			</ul>
		</div>
	</div>
	</form>
</div>

<div class="pageContent">
	<div class="panelBar">
		<ul class="toolBar">
			<li><a class="add" href="__URL__/backup" target="dialog" mask="true"><span>备份</span></a></li>
			<li><a class="delete" href="__URL__/delete/ids/{sid_user}/navTabId/__MODULE__" target="ajaxTodo" calback="navTabAjaxMenu" title="你确定要删除吗？"><span>删除</span></a></li>
			<li><a class="edit" href="__URL__/import/folder/{sid_user}" target="ajaxTodo" callback="repeatAjaxDone" title="你确定要导入吗？"><span>导入</span></a></li>
			<li class="line">line</li>
			<li><a class="icon" onclick="replaceHref(this,'__URL__/package/folder/{sid_user}');"><span>打包下载</span></a></li>
		</ul>
	</div>

	<table class="table" width="100%" layoutH="138">
		<thead>
		<tr>
			<th width="50"></th>
			<th width="800" orderField="filename" <?php if($_REQUEST["_order"] == 'filename'): ?>class="<?php echo ($_REQUEST["_sort"]); ?>"<?php endif; ?>>文件名</th>
			<th width="130" orderField="ctime" <?php if($_REQUEST["_order"] == 'ctime'): ?>class="<?php echo ($_REQUEST["_sort"]); ?>"<?php endif; ?>>创建时间</th>
			<th width="80" orderField="size" <?php if($_REQUEST["_order"] == 'size'): ?>class="<?php echo ($_REQUEST["_sort"]); ?>"<?php endif; ?>>尺寸</th>
			<th width="50" orderField="total" <?php if($_REQUEST["_order"] == 'total'): ?>class="<?php echo ($_REQUEST["_sort"]); ?>"<?php endif; ?>>卷数</th>
		</tr>
		</thead>
		<tbody>
		<?php if(is_array($list)): $i = 0; $__LIST__ = $list;if( count($__LIST__)==0 ) : echo "" ;else: foreach($__LIST__ as $key=>$vo): ++$i;$mod = ($i % 2 )?><tr target="sid_user" rel="<?php echo ($vo["filename"]); ?>">
				<td></td>
				<td><?php echo ($vo["filename"]); ?></td>
				<td><?php echo (date("Y-m-d H:i:s",$vo["ctime"])); ?></td>
				<td><?php echo (formatsize($vo["size"])); ?></td>
				<td><?php echo ($vo["total"]); ?></td>
			</tr><?php endforeach; endif; else: echo "" ;endif; ?>
		</tbody>
	</table>
</div>