<?php if (!defined('THINK_PATH')) exit();?><script>
$(function(){
	memberReviews();
});
</script>
<div class="edit_head_top clearfix">
    <h2> <span class="pingj_ico jvf_mbpng jvf_fl"></span>
        <p class="jvf_fl"><?php echo L("member_reviews_post");?></p>
        <div class="jvf_fl"><?php echo L("member_reviews_post_div");?></div>
    </h2>
</div>
<div class="reviews_section">
    <h4> <span class="icons-tiny-light-grey"></span><?php echo L("waiting_for_evaluation");?></h4>
</div>
    <div class="mb_pj">
     	<ul>
     	<?php if(is_array($ordersdata)): $i = 0; $__LIST__ = $ordersdata;if( count($__LIST__)==0 ) : echo "" ;else: foreach($__LIST__ as $key=>$vo): ++$i;$mod = ($i % 2 )?><li class="reviews-list-item clearfix">

                  <div class="jvf_fl userpic1">
                       <a href="<?php echo U('User/space/id/'.$vo['good']['promulgator']['id']);?>" rel="no-follow">
                       	<img width="50px" height="50px" alt="<?php echo ($vo["good"]["promulgator"]["name"]); ?>" src="<?php echo ($vo["good"]["promulgator"]["header"]["thumbnail"]); ?>">
                       </a><br />
                       <?php echo L("goods_manager");?>
                  </div>
                <div class="bubble jvf_fl jvf_frame">
             	   <p class="message">
                	<?php echo L("goods_manager");?>：<a class="name" href="<?php echo U('User/space/id/'.$vo['good']['promulgator']['id']);?>"><?php echo ($vo["good"]["promulgator"]["name"]); ?></a><br />
                  	<?php echo L("order_sn");?>：<?php echo ($vo["order_info"]["sn"]); ?><br>
                  <?php echo L("goods_title");?>：<a href="<?php echo U('Goods/index/id/'.$vo['good']['id']);?>"><?php echo ($vo["good"]["title"]); ?></a><br>
                  <?php echo L("nums_text");?>：<?php echo ($vo["num"]); ?><br>
                  <?php echo L("order_mark");?>：<?php echo L("mark_buy");?></p>
                  <div class="bubble_bot">
                  	<span class="date">
                  		<span title="<?php echo (toDate($vo["addtime"])); ?>"><?php echo (dgmdate($vo["addtime"])); ?></span>
                  	</span>
                  	<span class="edit">
                  		<a href="<?php echo U('Member/viewo_details/id/'.$vo['id']);?>" class="vieworder"><?php echo L("member_reviews_view_detail");?></a>
                  		&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
                  		<a href="<?php echo U('Member/commentorder/id/'.$vo['id']);?>" class="commentadd"><?php echo L("evaluate");?></a>
                  	</span>
                  </div>
                  </div>
            </li><?php endforeach; endif; else: echo "" ;endif; ?>
        </ul>
     </div>
     <div class="reviews_section">
     <h4 class="bdt"> <span class="icons-tiny-light-grey"></span><?php echo L("member_reviews_set_host");?></h4>
     </div>
                         
    <div class="mb_pj">
       <ul id="released_content">
           
       </ul>
       <div class="jvf_page" id="released_page">
	   </div>
    </div>