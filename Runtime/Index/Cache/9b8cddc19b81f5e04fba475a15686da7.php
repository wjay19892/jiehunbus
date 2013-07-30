<?php if (!defined('THINK_PATH')) exit();?><li uid="<?php echo ($vo["id"]); ?>" title="<?php echo ($vo["name"]); ?>" online="<?php echo (onLineClass($vo["online"])); ?>" class="">
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
</li>