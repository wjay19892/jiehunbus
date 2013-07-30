<?php if (!defined('THINK_PATH')) exit();?><script>
$(function(){
	memberBankfanh("<?php echo ($url); ?>");
});
</script>
<div style="width:340px;height: 240px;">
<?php if(empty($form)): ?><div id="paySuccess" title="<?php echo L("pay_success");?>">
       <div class="segment jvf_box_con">
			  <div class="pay_icon"><?php echo L("member_bankfanh_paySuccess_pay_icon");?><br>
	          	<?php echo L("member_bankfanh_paySuccess_div");?></div>
			  </div>
			  <div class="jvf_box_buttom clearfix">
			  <div class="pay_butt_1">
		     <a class="btn p2153 f14 linebl pay_success" href="javascript:;"><?php echo L("member_bankfanh_paySuccess_close_info");?></a>
			  </div>
		</div>
	</div>
<?php else: ?>	
	<div title="<?php echo L("member_bankfanh_payPlatform_title");?>" id="payPlatform">
     
      <div class="segment jvf_box_con">
			  <div class="pay_icon"><?php echo L("member_bankfanh_payPlatform_pay_icon_before");?><?php echo ($paytype); ?><?php echo L("member_bankfanh_payPlatform_pay_icon_after");?><br></div>
              <div class="psm">
	          	<?php echo L("member_bankfanh_payPlatform_br");?><br />
                <?php echo L("member_bankfanh_payPlatform_div_before");?><?php echo ($paytype); ?><?php echo L("member_bankfanh_payPlatform_div_after");?>
                </div>
			  </div>
              
			  <div class="jvf_box_buttom clearfix">
			  <div class="jvf_tsall">
		     <div class="pay_butt_1 jvf_fl"><a class="btn p2153 f14 linebl switch_type"  href="javascript:;" oid="<?php echo ($oid); ?>"><?php echo L("member_bankfanh_payPlatform_close_info");?></a></div>
	        <div class="pay_butt_2 jvf_fl">
	          <?php echo ($form); ?>
	          <a class="btn p2153 f14 linebl" style="color:#FFF;" href="javascript:;" onclick="$('#paysubmit').submit();$('#payPlatform').hide();$('#payLoading').show();"><?php echo ($paytype); ?><?php echo L("member_bankfanh_payPlatform_title");?></a>
	        </div>
			  </div>
			 </div>
	</div><?php endif; ?>
<div class="hidden" title="<?php echo L("member_bankfanh_payLoading_title");?>" id="payLoading">
  
			  <div class="segment jvf_box_con">
			  <div class="pay_icon">
              	<?php echo L("member_bankfanh_payLoading_pay_icon");?><br><?php echo L("member_bankfanh_payLoading_br");?>
              </div>
              <div class="psm"><?php echo L("member_bankfanh_payLoading_div");?><br>
              <?php echo L("member_bankfanh_payLoading_div_br");?></div>
			  </div>
			  <div class="jvf_box_buttom clearfix">
			  <div class="jvf_tsall">
		      <div class="pay_butt_1 jvf_fl">
		      <a class="btn p2153 f14 linebl pay_success" style="color:#FFF;" href="javascript:;" onclick="goUrl(APP+'/Member/index');"><?php echo L("member_bankfanh_payLoading_pay_butt_1");?></a></div>
		        <div class="pay_butt_2 jvf_fl">
		          <a class="btn p2153 f14 linebl switch_type" style="color:#FFF;" href="javascript:;"><?php echo L("member_bankfanh_payLoading_pay_butt_2");?></a>
		        </div>
			  </div>
			  </div>
</div>
 
</div>