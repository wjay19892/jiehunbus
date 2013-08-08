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
				<label>会员：</label>
				<input type="hidden" name="uid" group="member" field="id">
				<input name="member_name" type="text" readonly="readonly" group="member" field="name"/>
				<a class="btnLook" href="<?php echo U('Member/lookUp/group/member');?>" target="dialog" rel="member_lookup">查找带回</a>
			</li>
			<li>
				<label>组名：</label>
				<input type="text" name="name" >
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
			<th width="100" orderField="uid" <?php if($_REQUEST["_order"] == 'uid'): ?>class="<?php echo ($_REQUEST["_sort"]); ?>"<?php endif; ?>>会员</th>
			<th width="800" orderField="name" <?php if($_REQUEST["_order"] == 'name'): ?>class="<?php echo ($_REQUEST["_sort"]); ?>"<?php endif; ?>>组名</th>
			<th width="80">操作</th>
		</tr>
		</thead>
		<tbody>
		<?php if(is_array($list)): $i = 0; $__LIST__ = $list;if( count($__LIST__)==0 ) : echo "" ;else: foreach($__LIST__ as $key=>$vo): ++$i;$mod = ($i % 2 )?><tr target="sid_node" rel="<?php echo ($vo['id']); ?>">
				<td><?php echo ($vo['id']); ?></td>
				<td><?php echo (getParent('Member',$vo['uid'],'name')); ?></td>
				<td><?php echo ($vo['name']); ?></td>
				<td><a href="__URL__/edit/id/<?php echo ($vo['id']); ?>" target="dialog" rel="__MODULE___edit">编辑</a></td>
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