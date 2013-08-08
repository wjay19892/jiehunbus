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
				<input name="name" type="text" readonly="readonly" group="member" field="name"/>
				<a class="btnLook" href="<?php echo U('Member/lookUp/group/member/');?>" target="dialog" rel="member_lookup">查找带回</a>
			</li>
			<li style="width: 600px;">
				<label>记录时间：</label>
				<input type="text" name="mintime" class="date" readonly="true" format="yyyy-MM-dd HH:mm:ss"/>
				<a class="inputDateButton" href="javascript:;">选择</a>
				<span style="float: left;" >&nbsp;～&nbsp;</span>
				<input type="text" name="maxtime" class="date" readonly="true" format="yyyy-MM-dd HH:mm:ss"/>
				<a class="inputDateButton" href="javascript:;">选择</a>
			</li>
			<li>
				<label>是否成功：</label>
				<SELECT name="status" class="combox">
					<option value="">所有</option>
					<option value="1">是</option>
					<option value="0">否</option>
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
			<li class="line">line</li>
			<li class=""><a title="实要导出这些记录吗?" targettype="navTab" target="dwzExport" href="__URL__/down/" class="icon"><span>导出EXCEL</span></a></li>
		</ul>
	</div>
   <!-- 功能操作区域结束 -->
	<table class="table" width="100%" layoutH="138">
		<thead>
		<tr>
			<th width="60">编号</th>
			<th width="80" orderField="uid" <?php if($_REQUEST["_order"] == 'uid'): ?>class="<?php echo ($_REQUEST["_sort"]); ?>"<?php endif; ?>>用户</th>
			<th width="200" orderField="cash" <?php if($_REQUEST["_order"] == 'cash'): ?>class="<?php echo ($_REQUEST["_sort"]); ?>"<?php endif; ?>>充值金额</th>
			<th width="200" orderField="bank_id" <?php if($_REQUEST["_order"] == 'bank_id'): ?>class="<?php echo ($_REQUEST["_sort"]); ?>"<?php endif; ?>>充值方式</th>
			<th width="200" orderField="addtime" <?php if($_REQUEST["_order"] == 'addtime'): ?>class="<?php echo ($_REQUEST["_sort"]); ?>"<?php endif; ?>>充值时间</th>
			<th width="80" orderField="status" <?php if($_REQUEST["_order"] == 'status'): ?>class="<?php echo ($_REQUEST["_sort"]); ?>"<?php endif; ?>>是否成功</th>
			<th width="80">操作</th>
		</tr>
		</thead>
		<tbody>
		<?php if(is_array($list)): $i = 0; $__LIST__ = $list;if( count($__LIST__)==0 ) : echo "" ;else: foreach($__LIST__ as $key=>$vo): ++$i;$mod = ($i % 2 )?><tr target="sid_node" rel="<?php echo ($vo['id']); ?>">
				<td><?php echo ($vo['id']); ?></td>
				<td><?php echo (getParent('Member',$vo['uid'],'name')); ?></td>
				<td><?php echo ($vo['cash']); ?></td>
				<td><?php echo ($vo['bank_id']); ?></td>
				<td><?php echo ($vo['addtime']); ?></td>
				<td><?php echo (getWhether($vo['status'])); ?></td>
				<td>
				<a href="__URL__/edit/id/<?php echo ($vo['id']); ?>" target="dialog" rel="__MODULE___edit">编辑</a>
				<?php if($vo['status'] == 0): ?><a href="__URL__/complete/id/<?php echo ($vo['id']); ?>/navTabId/__MODULE__" target="ajaxTodo" calback="navTabAjaxMenu" title="你确定要设为已充值？" warn="请选择">成功</a><?php endif; ?>
				</td>
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