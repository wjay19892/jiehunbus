<?php if (!defined('THINK_PATH')) exit();?><form id="pagerForm" action="__URL__" method="post">
	<input type="hidden" name="pageNum" value="1"/>
	<input type="hidden" name="_order" value="<?php echo ($_REQUEST["_order"]); ?>"/>
	<input type="hidden" name="_sort" value="<?php echo ($_REQUEST["_sort"]); ?>"/>
</form>



<div class="pageHeader">
	<form onsubmit="return navTabSearch(this);" action="__URL__" method="post">
	<div class="searchBar">
		<ul class="searchContent">
			<li>
				<label>用户帐号：</label>
				<input type="text" name="name" class="medium" >
			</li>
			<li>
				<label>电子邮件：</label>
				<input type="text" name="mail" class="medium" >
			</li>
			<li>
				<label>状态：</label>
				<SELECT name="status" class="combox">
					<option value="">所有</option>
					<option value="1">启用</option>
					<option value="0">禁用</option>
				</SELECT>
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
	<table class="table" width="100%" layoutH="138">
		<thead>
		<tr>
			<th width="60">编号</th>
			<th width="100" orderField="name" <?php if($_REQUEST["_order"] == 'name'): ?>class="<?php echo ($_REQUEST["_sort"]); ?>"<?php endif; ?>>用户帐号</th>
            <th width="100" orderField="mail" <?php if($_REQUEST["_order"] == 'mail'): ?>class="<?php echo ($_REQUEST["_sort"]); ?>"<?php endif; ?>>电子邮件</th>
            <th width="100" orderField="value" <?php if($_REQUEST["_order"] == 'value'): ?>class="<?php echo ($_REQUEST["_sort"]); ?>"<?php endif; ?>><?php echo C("sysconfig.site_credits_name");?></th>
            <th width="100" orderField="cash" <?php if($_REQUEST["_order"] == 'cash'): ?>class="<?php echo ($_REQUEST["_sort"]); ?>"<?php endif; ?>>现金</th>
			<th width="60">操作</th>
		</tr>
		</thead>
		<tbody>
		<?php if(is_array($list)): $i = 0; $__LIST__ = $list;if( count($__LIST__)==0 ) : echo "" ;else: foreach($__LIST__ as $key=>$vo): ++$i;$mod = ($i % 2 )?><tr target="sid_node" rel="<?php echo ($vo['id']); ?>">
				<td><?php echo ($vo['id']); ?></td>
				<td><?php echo ($vo['name']); ?></td>
                <td><?php echo ($vo['mail']); ?></td>
                <td><?php echo ($vo['value']); ?></td>
                <td><?php echo ($vo['cash']); ?></td>
				<td><a href="__URL__/edit/id/<?php echo ($vo['id']); ?>" target="dialog" rel="__MODULE___edit"  width="650" height="330">编辑</a></td>
			</tr><?php endforeach; endif; else: echo "" ;endif; ?>
		</tbody>
	</table>

	<div class="panelBar">
		<div class="pages">
			<span>共<?php echo ($totalCount); ?>条</span>
		</div>
		<div class="pagination" targetType="navTab" totalCount="<?php echo ($totalCount); ?>" numPerPage="<?php echo ($numPerPage); ?>" pageNumShown="10" currentPage="<?php echo ($currentPage); ?>"></div>
	</div>
</div>