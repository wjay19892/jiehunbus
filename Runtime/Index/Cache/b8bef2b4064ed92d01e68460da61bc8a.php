<?php if (!defined('THINK_PATH')) exit();?><script>
$(function(){
	memberCommentorder(<?php echo C("sysconfig.evaluate_total");?>);
})
</script>

<div style="width:500px;" title="<?php echo L("evaluate");?>">
            <form class="cmxform" id="commentorderform" action="<?php echo U('Member/commentadd');?>" method="post">
                <input type="hidden" value="<?php echo ($o_detailsdata["id"]); ?>" name="odid">
                <div class="segment jvf_box_con">
                    <div class="text">
                        <span><?php echo L("goods_title");?>：</span>
                        <a class="bold" href="<?php echo U('Goods/index/id/'.$o_detailsdata['gid']);?>" target="_blank"><?php echo ($o_detailsdata["good"]["title"]); ?></a>
                        <input type="hidden" value="<?php echo ($o_detailsdata["gid"]); ?>" name="gid">
                    </div>
                    <div id="review_stats">
		              <ul class="stats clearfix" id="stats_left">
		                <?php if(is_array($evaluate_itemsdata)): $i = 0; $__LIST__ = $evaluate_itemsdata;if( count($__LIST__)==0 ) : echo "" ;else: foreach($__LIST__ as $key=>$vo): ++$i;$mod = ($i % 2 )?><li> <span class="attribute"><?php echo ($vo["name"]); ?>:</span>
                          <div class="jvf_fr clearfix">
		                    <div class="rating jvf_fl" style="cursor: pointer;">
		                      <div class="filled star_10"></div>
		                    </div>
                            <div class="jvf_fl" style="color:#ccc;">
		                    (<span class="fen"><?php echo C("sysconfig.evaluate_total");?></span>)
                            </div>
                          </div>
		                    <input type="hidden" name="item<?php echo ($vo["id"]); ?>" value="<?php echo C("sysconfig.evaluate_total");?>"/>
		                  </li><?php endforeach; endif; else: echo "" ;endif; ?>
		              </ul>
		            </div>
                    <div class="clearfix">
                        <div class="jvf_fl"><?php echo L("evaluate_content");?>：</div>
                        <textarea id="message_addcomment" class="jvf_inputt jvf_fl" name="content" rows="5" style="width:370px;" placeholder="<?php echo L("evaluate_content");?>"></textarea>
                        <a class="faceBtn" id="face_addcomment"></a>
                    </div>
                </div>
                <div class="jvf_box_buttom">
                    <input type="button" value="<?php echo L("submit_text");?>" name="commit" class="btn p2153 f14 linebl">
                </div>
            </form>
   

</div>