<?php if (!defined('THINK_PATH')) exit();?><div id="wbim_box" class="wbim_box" style="position: fixed; bottom: 0px; right:70px;">
    <div class="wbim_list_expand" style="z-index: 1001; right: 0px; bottom: 0px; display: none;">
        <div class="wbim_list_con">
            <div class="wbim_tit">
                <div class="wbim_titin">
                    <div class="wbim_tit_lf">
                        <div node-type="status_manager">
                            <div class="tit">
                                <span class="<?php echo (onLineClass($memberdata["online"])); ?>" id="status_result_span">
                                </span>
                                <span class="txt" id="status_result_txt"><?php echo (onLineText($memberdata["online"])); ?> </span>
                                <span class="icon">
                                </span>
                            </div>
                            <div class="linert">
                            </div>
                            <ul style="display: none; visibility: visible;" id="online_status">
                                <li class="lingtop">
                                </li>
                                <li>
                                    <a href="javascript:void(0)">
                                        <span class="wbim_status_online">
                                        </span>
                                        <?php echo L("status_online");?>
                                    </a>
                                </li>
                                <li>
                                    <a href="javascript:void(0)">
                                        <span class="wbim_status_busy">
                                        </span>
                                        <?php echo L("status_busy");?>
                                    </a>
                                </li>
                                <li>
                                    <a href="javascript:void(0)">
                                        <span class="wbim_status_away">
                                        </span>
                                        <?php echo L("status_leave");?>
                                    </a>
                                </li>
                                <li>
                                    <a href="javascript:void(0)">
                                        <span class="wbim_status_offline">
                                        </span>
                                        <?php echo L("status_stealth");?>
                                    </a>
                                </li>
                            </ul>
                        </div>
                    </div>
                    <div class="wbim_tit_rt">
                        <a href="<?php echo U('Member/edit/item/privacy');?>" title="<?php echo L("member_chatbox_set");?>" target="_blank"
                        class="wbim_icon_setup">
                        </a>
                        <a hidefocus="true" title="<?php echo L("member_chatbox_min");?>" class="wbim_icon_mini" href="javascript:void(0)">
                        </a>
                    </div>
                </div>
            </div>
            <div class="wbim_line">
            </div>
            <div class="wbim_list_srch">
                <div class="wbim_list_srchin">
                    <a href="javascript:void(0)" hidefocus="true" style="display: none;" class="wbim_icon_close_s">
                    </a>
                    <input type="text" placeholder="<?php echo L("member_chatbox_placeholder");?>">
                </div>
            </div>
            <div class="wbim_list_box">
                <div class="wbim_list_friend" style="" id="chat_friends">
                    <div class="wbim_list_group">
                        <div class="wbim_list_group_tit wbim_close" title="<?php echo L("member_chatbox_recent_contact");?>">
                            	<?php echo L("member_chatbox_recent_contact");?>[<span><?php echo count($recently);?></span>]</div>
                        <ul style="display:none">
                        <?php if(is_array($recently)): $i = 0; $__LIST__ = $recently;if( count($__LIST__)==0 ) : echo "" ;else: foreach($__LIST__ as $key=>$vo): ++$i;$mod = ($i % 2 )?><li uid="<?php echo ($vo["id"]); ?>" title="<?php echo ($vo["name"]); ?>" online="<?php echo (onLineClass($vo["online"])); ?>" class="">
                                <div class="wbim_userhead">
                                    <img src="<?php echo ($vo["header"]["thumbnail"]); ?>">
                                    <span style="display:none;" class="wbim_icon_msg_s">
                                    </span>
                                    <span class="<?php echo (onLineClass($vo["online"])); ?>">
                                    </span>
                                </div>
                                <div class="wbim_username">
                                    <?php echo ($vo["name"]); ?>
                                </div>
                            </li><?php endforeach; endif; else: echo "" ;endif; ?>
                        </ul>
                    </div>
                    <?php if(is_array($data)): $i = 0; $__LIST__ = $data;if( count($__LIST__)==0 ) : echo "" ;else: foreach($__LIST__ as $key=>$vo): ++$i;$mod = ($i % 2 )?><div class="wbim_list_group">
                        <div class="wbim_list_group_tit wbim_close" title="<?php echo ($vo["group"]); ?>">
                            <?php echo ($vo["group"]); ?>[<span><?php echo ($vo["count"]); ?></span>]
                        </div>
                        <ul style="display:none">
                        	<?php if(is_array($vo["friends"])): $i = 0; $__LIST__ = $vo["friends"];if( count($__LIST__)==0 ) : echo "" ;else: foreach($__LIST__ as $key=>$v): ++$i;$mod = ($i % 2 )?><li uid="<?php echo ($v["id"]); ?>" title="<?php echo ($v["name"]); ?>" online="<?php echo (onLineClass($v["online"])); ?>" class="">
                                <div class="wbim_userhead">
                                    <img src="<?php echo ($v["header"]["thumbnail"]); ?>">
                                    <span style="display:none;" class="wbim_icon_msg_s">
                                    </span>
                                    <span class="<?php echo (onLineClass($v["online"])); ?>">
                                    </span>
                                </div>
                                <div class="wbim_username">
                                    <?php echo ($v["name"]); ?>
                                </div>
                            </li><?php endforeach; endif; else: echo "" ;endif; ?>
                        </ul>
                    </div><?php endforeach; endif; else: echo "" ;endif; ?>
                </div>
                <div class="wbim_list_friend" style="display: none;" id="chat_search">
                    <ul></ul>
                </div>
            </div>
            <div class="wbim_list_pos">
                <a href="javascript:void(0)" hidefocus="true" class="wbim_clicknone">
                    <span class="wbim_icon_arrd">
                    </span>
                </a>
            </div>
        </div>
    </div>
    <div node-type="wbim_chat_box" style="position: absolute; right: 199px; bottom: 0px; z-index: 1001; display: none;"
    class="wbim_chat_box wbim_chat_box_s">
        <div node-type="wbim_chat_con" class="wbim_chat_con">
            <div node-type="wbim_tit" class="wbim_tit">
                <div node-type="wbim_titin" class="wbim_titin">
                    <div class="wbim_tit_lf" id="crr_chat_firend">
                        <p>
                            <span node-type="wbim_status" class="wbim_status_online">
                            </span>
                            <span class="txt">
                                <a node-type="wbim_tit_lf_name" target="_blank" title="" href="/">
                                </a>
                            </span>
                            <span node-type="wbim_tit_lf_count" class="bringin" style="display: none;">
                                	<?php echo L("member_chatbox_are_entering");?>
                            </span>
                        </p>
                    </div>
                    <div class="wbim_tit_rt">
                        <a node-type="wbim_icon_mini" title="<?php echo L("member_chatbox_min");?>" hidefocus="true" class="wbim_icon_mini"
                        href="javascript:;">
                        </a>
                        <a node-type="wbim_icon_close" title="<?php echo L("clost_text");?>" hidefocus="true" class="wbim_icon_close"
                        href="javascript:;">
                        </a>
                    </div>
                </div>
            </div>
            <div node-type="wbim_chat_lf" class="wbim_chat_lf" style="display: none;">
                <a href="javascript:;" hidefocus="true" node-type="wbim_scrolltop"
                class="wbim_scrolltop_n">
                </a>
                <div class="wbim_chat_friend_box">
                    <ul node-type="wbim_chat_friend_list" class="wbim_chat_friend_list">
                    </ul>
                </div>
                <a href="javascript:;" hidefocus="true" node-type="wbim_scrollbtm"
                class="wbim_scrollbtm_n">
                </a>
            </div>
            <div class="wbim_chat_rt">
                <div class="wbim_chat_up">
                    <div node-type="wbim_chat_tips" class="wbim_chat_tips" style="display: none;">
                        <span class="wbim_icon_tips">
                        </span>
                        <span node-type="wbim_chat_tips_content">
                        </span>
                        <a class="wbim_icon_close_s" node-type="wbim_icon_close_s" href="javascript:;"
                        hidefocus="true">
                        </a>
                    </div>
                    <div class="wbim_chat_list">
                        
                    </div>
                </div>
                <div node-type="wbim_chat_toolbar" class="wbim_chat_toolbar">
                    <div node-type="wbim_chat_toolbarin" class="wbim_chat_toolbarin">
                        <div node-type="wbim_face" class="wbim_face">
                            <a href="javascript:;" id="face_chat" title="<?php echo L("member_chatbox_face_chat");?>"
                            class="wbim_icon_face">
                            </a>
                            <div id="wbim_face_box" style="position: relative;">
                            </div>
                        </div>
                        <a href="javascript:;" target="_blank"
                        title="<?php echo L("chat_log");?>" node-type="wbim_history" class="wbim_history">
                            <span class="wbim_icon_chatdoc">
                            </span>
                            <?php echo L("chat_log");?>
                        </a>
                    </div>
                </div>
                <div style="margin-top:1px;" node-type="wbim_chat_input" class="wbim_chat_input">
                    <div node-type="root" class="wbim_chat_input_tips" style="display: none;">
                        <div node-type="fl" class="fl">
                        </div>
                        <div node-type="fr" class="fr">
                        </div>
                    </div>
                    <textarea id="message_chat"></textarea>
                </div>
                <div node-type="wbim_chat_btm" class="wbim_chat_btm">
                    <div class="wbim_chat_btmin">
                        <div class="wbim_chat_btm_rt">
                            <p class="wbim_tips_char">
                                <span class="wbim_chat_count">
                                    0
                                </span>
                            </p>
                            <div node-type="wbim_btn_send" class="wbim_btn_send">
                                <a title="<?php echo L("send_text");?>" href="javascript:;" class="wbim_btn_publish" node-type="wbim_btn_publish"
                                hidefocus="true">
                                    <?php echo L("send_text");?>
                                </a>
                                <div class="wbim_btn_choose">
                                    <a class="wbim_btn_choose_a" node-type="wbim_btn_choose_a">
                                        <?php echo L("member_chatbox_select");?>
                                    </a>
                                    <ul node-type="wbim_btn_choose">
                                        <li event="1" class="curr">
                                            <span>
                                            </span>
                                            <em>
                                                <a node-type="wbim_enter_send" href="javascript:;">
                                                    <?php echo L("member_chatbox_enter_send");?>
                                                </a>
                                            </em>
                                        </li>
                                        <li class="line">
                                            <span>
                                            </span>
                                            <em>
                                            </em>
                                        </li>
                                        <li class="" event="2">
                                            <span>
                                            </span>
                                            <em>
                                                <a node-type="wbim_ctrlenter_send" href="javascript:;">
                                                    <?php echo L("member_chatbox_ctrl_enter_send");?>
                                                </a>
                                            </em>
                                        </li>
                                    </ul>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div node-type="wbim_confirm_box" style="left: 130px; z-index: 100; top: 150px; position: absolute; display: none;">
            <div class="wbim_confirm_box">
                <div class="wbim_confirm_con">
                    <div class="wbim_confirm_info">
                        <p class="wbim_confirm_p">
                            <span class="wbim_icon_ask">
                            </span>
                            <span class="txt">
                                <?php echo L("member_chatbox_tip");?>
                            </span>
                        </p>
                        <p class="wbim_confirm_btn">
                            <a node-type="wbim_btn_c" class="wbim_btn_c" href="javascript:;">
                                <em>
                                    <?php echo L("enter");?>
                                </em>
                            </a>
                            <a node-type="wbim_btn_n" class="wbim_btn_n" href="javascript:;">
                                <em>
                                    <?php echo L("cancel");?>
                                </em>
                            </a>
                        </p>
                    </div>
                </div>
            </div>
            <div node-type="wbim_box_pop" class="wbim_box_pop" style="position:absolute; width:420px; height:365px; top:-126px; left:-130px;">
            </div>
        </div>
    </div>
    <div class="wbim_min_box_col2" style="position: absolute; bottom: 0px; right: 0px;" id="wbim_tip">
        <div class="wbim_min_box">
            <div class="wbim_min_friend">
                <p class="statusbox">
                    <span class="<?php echo (onLineClass($memberdata["online"])); ?>">
                    </span>
                </p>
                              000000000000000000000000000000000000000000000000000           <?php echo L("member_chatbox_chat");?>(
                <span class="wbim_online_count">
                    0
                </span>
                )
            </div>
            <div class="wbim_min_line wbim_min_linefor3">
            </div>
            <div class="wbim_min_chat">
                <span class="wbim_icon_msg">
                </span>
                <span class="wbim_min_text_pre" style="display: inline;">
                    <?php echo L("member_chatbox_is_in");?>
                </span>
                <span class="wbim_min_nick">
                </span>
                <span class="line">
                </span>
                <span class="wbim_min_text">
                    <?php echo L("member_chatbox_chating");?>
                </span>
            </div>
        </div>
    </div>
</div>