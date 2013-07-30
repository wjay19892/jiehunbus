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
				<label>商家名称：</label>
				<input type="text" name="name">
			</li>
			<li>
				<label>状态：</label>
				<SELECT name="status" class="combox">
					<option value="">所有</option>
					<option value="1">已审核</option>
					<option value="0">未审核</option>
					<option value="2">已撤销</option>
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
			<li><a class="add" href="__URL__/add" target="dialog" rel="__MODULE___add"><span>新增</span></a></li>
			<li><a class="delete" href="__URL__/foreverdelete/id/{sid_node}/navTabId/__MODULE__" target="ajaxTodo" calback="navTabAjaxMenu" title="你确定要删除吗？" warn="请选择"><span>删除</span></a></li>
			<li><a class="edit" href="__URL__/edit/id/{sid_node}" target="dialog" rel="__MODULE___edit" warn="请选择"><span>修改</span></a></li>
		</ul>
	</div>
   <!-- 功能操作区域结束 -->
	<table class="table" width="100%" layoutH="138">
		<thead>
		<tr>
			<th width="60">编号</th>
			<th width="100" orderField="name" <?php if($_REQUEST["_order"] == 'name'): ?>class="<?php echo ($_REQUEST["_sort"]); ?>"<?php endif; ?>>商家名称</th>
			<th width="80">会员</th>
            <th width="200">公司名称</th>
            <th width="80">负责人</th>
			<th width="80" orderField="addtime" <?php if($_REQUEST["_order"] == 'addtime'): ?>class="<?php echo ($_REQUEST["_sort"]); ?>"<?php endif; ?>>申请时间</th>
			<th width="80" orderField="status" <?php if($_REQUEST["_order"] == 'status'): ?>class="<?php echo ($_REQUEST["_sort"]); ?>"<?php endif; ?>>状态</th>
			<th width="80">操作</th>
		</tr>
		</thead>
		<tbody>
		<?php if(is_array($list)): $i = 0; $__LIST__ = $list;if( count($__LIST__)==0 ) : echo "" ;else: foreach($__LIST__ as $key=>$vo): ++$i;$mod = ($i % 2 )?><tr target="sid_node" rel="<?php echo ($vo['id']); ?>">
				<td><?php echo ($vo['id']); ?></td>
				<td><?php echo (getParent('Member',$vo['uid'],'name')); ?></td>
				<td><?php echo ($vo['name']); ?></td>
                <td><?php echo ($vo['companyname']); ?></td>
                <td><?php echo ($vo['fz_name']); ?></td>
				<td><?php echo ($vo['addtime']); ?></td>
				<td>
					<?php if(($vo['status'])  ==  "0"): ?>未审核<?php endif; ?>
					<?php if(($vo['status'])  ==  "1"): ?>已审核<?php endif; ?>
					<?php if(($vo['status'])  ==  "2"): ?>已撤销<?php endif; ?>
				</td>
				<td><a href="__URL__/edit/id/<?php echo ($vo['id']); ?>" target="dialog" rel="__MODULE___edit">编辑</a><?php if(($vo['status'])  ==  "0"): ?>&nbsp;&nbsp;<a href="__URL__/pass/id/<?php echo ($vo['id']); ?>" target="ajaxTodo" calback="navTabAjaxMenu" title="你确定要审核通过么？" warn="请选择">审核通过</a>&nbsp;&nbsp;<a href="__URL__/revocation/id/<?php echo ($vo['id']); ?>" target="ajaxTodo" calback="navTabAjaxMenu" title="你确定要撤销么？" warn="请选择">撤销</a><?php endif; ?></td>
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