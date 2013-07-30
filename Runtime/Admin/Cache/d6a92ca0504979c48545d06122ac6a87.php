<?php if (!defined('THINK_PATH')) exit();?><form method="post" action="__URL__/save/navTabId/__MODULE__" class="pageForm required-validate" enctype="multipart/form-data" onsubmit="return iframeCallback(this, navTabAjaxDone);" >
<div class="pageContent">
    <div class="pageFormContent" layoutH="56">
        <div class="tabs">
            <div class="tabsHeader">
                <div class="tabsHeaderContent">
                    <ul>
                    <?php if(is_array($sysconf_grouplist)): $i = 0; $__LIST__ = $sysconf_grouplist;if( count($__LIST__)==0 ) : echo "" ;else: foreach($__LIST__ as $key=>$groupname): ++$i;$mod = ($i % 2 )?><li><a href="javascript:;"><span><?php echo ($groupname); ?></span></a></li><?php endforeach; endif; else: echo "" ;endif; ?>   
                    </ul>
                </div>
            </div>
            <div class="tabsContent" layoutH="90" style="padding:0px">
    
                <?php if(is_array($conf_list)): foreach($conf_list as $key=>$vo): ?><div>
                <table width="100%" class="list">
                  <thead>
                    <tr height="25">
                       <th width="250" style="text-align:center;">参数说明</th>
                       <th style="text-align:center;">参数值</th>
                       <th width="220" style="text-align:center;">变量名</th>
                     </tr>
                  </thead>
                  <tbody>
                  <?php if(empty($vo)): ?><tr>
                        <td colspan="3" style="text-align:center;">此分组暂无配置项</td>
                    </tr>
                  <?php else: ?>
                    <?php if(is_array($vo)): foreach($vo as $key=>$vo_item): ?><tr>
                        <td style="text-align:right;" width="250"><?php echo ($vo_item['name']); ?>：</td>
                        <td>
                            <?php if($vo_item['list_type'] == 0): ?><!-- 手动输入 -->
                                <input type="text" name="<?php echo ($vo_item["key"]); ?>" class="" style="width:300px" value="<?php echo ($vo_item["val"]); ?>" /><?php endif; ?>
                            
                            <?php if($vo_item['list_type'] == 1): ?><?php if(is_array($vo_item['val_arr'])): foreach($vo_item['val_arr'] as $key=>$val_item): ?><!-- 单选 -->
                                <label style="width:auto;"><?php echo L("TITLE_".$vo_item['key']."_".$val_item);?>：<input type="radio" name="<?php echo ($vo_item["key"]); ?>" class="" value="<?php echo ($val_item); ?>"  <?php if($val_item == $vo_item['val']): ?>checked="checked"<?php endif; ?> /></label><?php endforeach; endif; ?><?php endif; ?>
                            
                            <?php if($vo_item['list_type'] == 2): ?><select name="<?php echo ($vo_item["key"]); ?>" class="combox">
                                    <?php if(is_array($vo_item['val_arr'])): foreach($vo_item['val_arr'] as $key=>$val_item): ?><!-- 下拉 -->
                                    <option value="<?php echo ($val_item); ?>" <?php if($val_item == $vo_item['val']): ?>selected="selected"<?php endif; ?>><?php echo L("TITLE_".$vo_item['key']."_".$val_item);?></option><?php endforeach; endif; ?>
                                </select><?php endif; ?>
                            
                            <?php if($vo_item['list_type'] == 3): ?><!-- 文本域 -->
                                <textarea rows="4" cols="80" name="<?php echo ($vo_item["key"]); ?>" class="textInput"><?php echo ($vo_item['val']); ?></textarea><?php endif; ?>
                                                           
                            <?php if($vo_item['list_type'] == 4): ?><!-- 图片域 -->
                                <input type="file"  name="<?php echo ($vo_item["key"]); ?>" class="valid" /> 
                                <?php if($vo_item['val'] != ''): ?><a href="__ROOT__<?php echo ($vo_item["val"]); ?>" target="_blank" >查看</a><?php endif; ?><?php endif; ?>
                            
                            <?php if($vo_item['list_type'] == 5): ?><!-- 编辑器 -->
                                <textarea id="<?php echo ($vo_item["key"]); ?>"  class="editor" name="<?php echo ($vo_item["key"]); ?>" rows="8" cols="80" tools="mfull" upLinkUrl="<?php echo U('Xheditor/fileUpload');?>" upLinkExt="zip,rar,txt" upImgUrl="<?php echo U('Xheditor/upLoadImg');?>" upImgExt="jpg,jpeg,gif,png" upFlashUrl="<?php echo U('Xheditor/fileUpload');?>" upFlashExt="swf" upMediaUrl="<?php echo U('Xheditor/fileUpload');?>" upMediaExt="avi"><?php echo ($vo_item["val"]); ?></textarea><?php endif; ?>   
                        </td>
                        <td width="220" style="text-align:center;"><?php echo ($vo_item['key']); ?></td>
                    </tr><?php endforeach; endif; ?><?php endif; ?>
                  <tbody>
                </table>
                </div><?php endforeach; endif; ?>
            </div>
            <div class="tabsFooter">
                <div class="tabsFooterContent"></div>
            </div>
	    </div>
    </div>
    <div class="formBar">
        <ul>
            <li><div class="buttonActive"><div class="buttonContent"><button type="submit">保存</button></div></div></li>
            <li><div class="button"><div class="buttonContent"><button type="button" class="close">取消</button></div></div></li>
        </ul>
    </div> 
</div>
</form>