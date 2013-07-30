<?php if (!defined('THINK_PATH')) exit();?><table cellspacing="0" width="100%" cellpadding="0" border="0" class="trips_list jvf_mbwid">
	<thead>
		<tr>
		  <th width="300px"><?php echo L("member_valuelog_time");?></th>
		  <th width="200px"><?php echo C("sysconfig.site_credits_name");?></th>
		  <th width="200px"><?php echo L("detail_text");?></th>
		</tr>
	</thead>
	<tbody>
		<?php if(is_array($value_logdata)): $i = 0; $__LIST__ = $value_logdata;if( count($__LIST__)==0 ) : echo "" ;else: foreach($__LIST__ as $key=>$vo): ++$i;$mod = ($i % 2 )?><tr>
		  <td class="txc">
		      <span><?php echo ($vo["addtime"]); ?></span>
		  </td>
		  <td class="txc">
		      <span><?php echo ($vo["val"]); ?></span>
		  </td>
		  <td class="txc">
		    <span><?php echo (getValueContent($vo["content"])); ?></span>
		  </td>
		</tr><?php endforeach; endif; else: echo "" ;endif; ?>
		<tr>
			<td colspan="10"><div class="jvf_page"><?php echo ($page); ?></div></td>
		</tr>
	</tbody>
</table>