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
				<label>会员类型：</label>
				<SELECT name="isbusiness" class="combox">
					<option value="">所有</option>
					<option value="1">商家</option>
					<option value="0">用户</option>
				</SELECT>
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
    <!--  功能操作区域  -->
	<div class="panelBar">
		<ul class="toolBar">
			<li><a class="add" href="__URL__/add" target="dialog" mask="true" width="650" height="330"><span>新增</span></a></li>
			<li><a class="delete" href="__URL__/foreverdelete/id/{sid_node}/navTabId/__MODULE__" target="ajaxTodo" calback="navTabAjaxMenu" title="你确定要删除吗？" warn="请选择"><span>删除</span></a></li>
			<li><a class="edit" href="__URL__/edit/id/{sid_node}" target="dialog" mask="true" warn="请选择" width="650" height="330"><span>修改</span></a></li>
		</ul>
	</div>
   <!-- 功能操作区域结束 -->
	<table class="table" width="100%" layoutH="138">
		<thead>
		<tr>
			<th width="60">编号</th>
			<th width="100" orderField="name" <?php if($_REQUEST["_order"] == 'name'): ?>class="<?php echo ($_REQUEST["_sort"]); ?>"<?php endif; ?>>用户帐号</th>
            <th width="100" orderField="mail" <?php if($_REQUEST["_order"] == 'mail'): ?>class="<?php echo ($_REQUEST["_sort"]); ?>"<?php endif; ?>>电子邮件</th>
            <th width="80" orderField="regtime" <?php if($_REQUEST["_order"] == 'regtime'): ?>class="<?php echo ($_REQUEST["_sort"]); ?>"<?php endif; ?>>注册时间</th>
			<th width="40" orderField="isbusiness" <?php if($_REQUEST["_order"] == 'isbusiness'): ?>class="<?php echo ($_REQUEST["_sort"]); ?>"<?php endif; ?>>会员类型</th>
			<th width="80" orderField="regip" <?php if($_REQUEST["_order"] == 'regip'): ?>class="<?php echo ($_REQUEST["_sort"]); ?>"<?php endif; ?>>注册IP</th>
            <th width="40" orderField="mailstatus" <?php if($_REQUEST["_order"] == 'mailstatus'): ?>class="<?php echo ($_REQUEST["_sort"]); ?>"<?php endif; ?>>邮箱验证</th>
            <th width="40" orderField="phonestatus" <?php if($_REQUEST["_order"] == 'phonestatus'): ?>class="<?php echo ($_REQUEST["_sort"]); ?>"<?php endif; ?>>手机验证</th>
			<th width="40" orderField="status" <?php if($_REQUEST["_order"] == 'status'): ?>class="<?php echo ($_REQUEST["_sort"]); ?>"<?php endif; ?>>状态</th>
			<th width="60">操作</th>
		</tr>
		</thead>
		<tbody>
		<?php if(is_array($list)): $i = 0; $__LIST__ = $list;if( count($__LIST__)==0 ) : echo "" ;else: foreach($__LIST__ as $key=>$vo): ++$i;$mod = ($i % 2 )?><tr target="sid_node" rel="<?php echo ($vo['id']); ?>">
				<td><?php echo ($vo['id']); ?></td>
				<td><?php echo ($vo['name']); ?></td>
                <td><?php echo ($vo['mail']); ?></td>
                <td><?php echo ($vo['regtime']); ?></td>
				<td>
					<?php if(($$vo['isbusiness'])  ==  "1"): ?>商家
					<?php else: ?>
					用户<?php endif; ?>
				</td>
				<td><?php echo ($vo['regip']); ?></td>
                <td><?php echo (getCheckStatus($vo['mailstatus'])); ?></td>
                <td><?php echo (getCheckStatus($vo['phonestatus'])); ?></td>
                <td><?php echo (getStatus($vo['status'])); ?></td>
				<td><?php echo (showStatus($vo['status'],$vo['id'])); ?> <a href="__URL__/edit/id/<?php echo ($vo['id']); ?>" target="dialog" rel="__MODULE___edit"  width="650" height="330">编辑</a></td>
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