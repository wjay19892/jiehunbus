<?php if (!defined('THINK_PATH')) exit();?><dd class="wbim_msgl">
    <div class="wbim_msgpos">
        <div class="msg_time">
            <?php echo ($vo["send_name"]); ?> <?php echo (toDate($vo["addtime"])); ?>
        </div>
        <div class="msg_box">
            <p class="txt">
                <?php echo (contentFilter($vo["content"])); ?>
            </p>
        </div>
    </div>
</dd>