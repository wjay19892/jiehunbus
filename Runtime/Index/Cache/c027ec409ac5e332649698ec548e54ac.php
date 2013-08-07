<?php if (!defined('THINK_PATH')) exit();?><script type="text/javascript" src="../Public/js/baidumap_location.js"></script>
<script type="text/javascript" src="http://api.map.baidu.com/api?v=1.3&callback=load_map_wrapper"></script>
<script>
$(function(){
	memberStep();
});

function load_map_wrapper(){
	initialize("map_canvas");
	addTags('<?php echo ($locate["lat"]); ?>','<?php echo ($locate["lng"]); ?>','<?php echo ($locate["address"]); ?>',"map_canvas",'');
}
</script>
<div class="jvf_setall" style="width:600px;" title="<?php echo L("quickly_set_up");?>">
	<div class="jvf_set">
    	<h2><?php echo L("jvf_set");?></h2>
    </div>
    <div class="set_conall">
        <div class="set_con clearfix">
        	<div class="step_item">
	            <div class="set1"></div>
	            <div class="set_lin"></div>
            </div>
            <div class="step_item">
	            <div class="set2"></div>
	            <div class="set_lin"></div>
           	</div>
           	<div class="step_item">
	            <div class="set3"></div>
	            <div class="set_lin"></div>
            </div>
            <div class="step_item">
            	<div class="set4"></div>
            </div>
        </div>
        <div class="set_contx clearfix">
            <div><?php echo L("first_step");?></div>
            <div><?php echo L("second_step");?></div>
            <div><?php echo L("third_step");?></div>
            <div><?php echo L("complete");?></div>
        </div>
    </div>
    <div class="set_cent">
    	<img src="../Public/images/guangg001.jpg" />
    </div>
    <div class="set_cent" style="display:none;">
    	<h3><?php echo L("first_step");?>：<?php echo L("setvisit_location");?></h3>
        <p><?php echo L("set_cent");?></p>
        <div class="jvf_frame" style="margin-top:5px;">
        <form method="post" action="<?php echo U('Member/addlocation');?>" class="clearfix" id="add_locationform">
            <div class="setmap_startit">
                 <label for="user_name"><?php echo L("visit_location_address");?></label>
                 <input type="text" id="address" name="address" placeholder="<?php echo L("visit_location_address");?>" value="<?php echo ($locate["address"]); ?>" class="jvf_inputt">
                 <a id="addmarker" href="javascript:;" onclick="codeAddress($('.setmap_startit #address').val());"><?php echo L("map_addmarker");?></a>（*先标记，再提交）
                 <!--<a id="showmarker" href="javascript:;" onclick="showMarker($('.setmap_startit #address').val())"><?php echo L("map_showmarker");?></a>-->
        	</div>
        	<input type="hidden" readonly="readonly" value="" id="longitude" name="longitude">
	          <input type="hidden" readonly="readonly" value="" id="latitude" name="latitude">
	          <input type="hidden" readonly="readonly" value="" id="zoom" name="zoom">
        	<div id="map_canvas" style="height:300px;"></div>
         </form>
         </div>
    </div>
    <div class="set_cent" style="display:none;">
    	<h3><?php echo L("second_step");?>：<?php echo L("you_are_interested");?></h3>
        <p><?php echo L("second_step_tip");?></p>
        <div class="jvf_frame" style="margin-top:5px;">
        	<div class="h3list"><?php echo L("my_interested");?></div>
        	<form action="<?php echo U('Member/labelAdds');?>" id="label_form">
            <div class="quaned_list">
            	<div><?php echo L("quanz_list");?></div>
            	
            </div>
            </form>
        </div>
        <div class="jvf_frame" style="margin-top:5px;">
            <div class="h3list"><?php echo L("quanz_list");?></div>
            <div class="quanz_list">
            	
            </div>
            <div class="gengh"><a href="javascript:;" class="quanz_btn"><?php echo L("for_a_group");?></a></div>
            
            <div class="h3list"><?php echo L("biaoq_list");?></div>
            <div class="biaoq_list">
            	
            </div>
            <div class="gengh clearfix"><a href="javascript:;" class="biaoq_btn"><?php echo L("for_a_group");?></a></div>
       </div>
    </div>
    
    <div class="set_cent" style="display:none;">
    	<h3><?php echo L("third_step");?>：<?php echo L("listen_their");?></h3>
        <p><?php echo L("third_step_tip");?></p>
        <div class="jvf_frame" style="margin-top:5px;">
            <div class="h3list"><?php echo L("same_interest");?></div>
            <div class="gzlist">
            	<ul class="clearfix">
                	
                </ul>
            </div>
            <div class="gengh clearfix">
            	<a style="color:#f9aa00" href="javascript:;" id="togetherListen"><?php echo L("a_key_listen_them");?></a>
            	<a href="javascript:;" id="nextsame"><?php echo L("for_a_group");?></a>
            </div>
       </div>
    </div>
    
    <div class="set_cent" style="display:none;">
    	<h3><?php echo L("complete");?>：<?php echo L("start_your_journey");?></h3>
        <p><?php echo L("complete_tip");?></p>
        <img src="../Public/images/guangg002.jpg" />
    </div>
    
    <div class="set_btn">
    <a class="btn p2153 f14 linebl exit" href="javascript:;"><?php echo L("a_later");?></a>
    <a class="btn p2153 f14 linebl start" href="javascript:;"><?php echo L("start");?></a>
    </div>
    
    <div class="set_btn" style="display:none;">
	   <a class="btn p2153 f14 linebl exit" href="javascript:;"><?php echo L("a_later");?></a>
	   <a class="btn p2153 f14 linebl down" id="submit_local" href="javascript:;"><?php echo L("next_step");?></a>
    </div>
    
    <div class="set_btn" style="display:none;">
	   <a class="btn p2153 f14 linebl exit" href="javascript:;"><?php echo L("a_later");?></a>
	   <a class="btn p2153 f14 linebl down" id="submit_label" href="javascript:;"><?php echo L("next_step");?></a>
    </div>
    
    <div class="set_btn" style="display:none;">
	   <a class="btn p2153 f14 linebl exit" href="javascript:;"><?php echo L("a_later");?></a>
	   <a class="btn p2153 f14 linebl down" href="javascript:;"><?php echo L("next_step");?></a>
    </div>
    
    <div class="set_btn" style="display:none;">
     <a class="btn p2153 f14 linebl end" href="javascript:;"><?php echo L("complete");?></a>
    </div>
 
</div>