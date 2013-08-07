<?php if (!defined('THINK_PATH')) exit();?><!DOCTYPE html PUBLIC '-//W3C//DTD XHTML 1.0 Transitional//EN' 'http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd'>
<html>
<head>
<title>页面提示</title>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8">
<meta http-equiv='Refresh' content='<?php echo ($waitSecond); ?>;URL=<?php echo ($jumpUrl); ?>'>
<link href="__PUBLIC__/Css/style.css" />
<link href="../Public/css/style.css" rel="stylesheet" type="text/css"/>
</head>
<body>
<div class="message">
		<div class="jvf_msg_title" ></div>
     <div class="msg_bod">
		<div class="tCenter space mag_tishi"><?php echo ($msgTitle); ?></div>
        <div style="padding:10px; width:500px; margin:0 auto;">
            <div style="float:left;">
                <?php if(($status)  ==  "1"): ?><div class="tiaoz_chengg"></div>
                <?php else: ?>
                    <div class="tiaoz_shib"></div><?php endif; ?>
            </div>
            <div style="float:left;display: inline; float: left;line-height: 34px; margin-left: 19px;">
            <?php if(isset($message)): ?><div style="color: blue;font-size: 17px;font-weight: bold;"><?php echo ($message); ?></div><?php endif; ?>   
            
            <?php if(isset($closeWin)): ?><div>系统将在 <span style="color:blue;font-weight:bold"><?php echo ($waitSecond); ?></span> 秒后自动关闭，如果不想等待,直接点击 <a href="<?php echo ($jumpUrl); ?>">这里</a> 关闭</div><?php endif; ?>
            <?php if(!isset($closeWin)): ?><div>系统将在 <span style="color:blue;font-weight:bold"><?php echo ($waitSecond); ?></span> 秒后自动跳转,如果不想等待,直接点击 <a href="<?php echo ($jumpUrl); ?>">这里</a> 跳转</div><?php endif; ?>
            </div>
    <div class="jvf_cl"></div>
		
    </div>
	</div>

</body>
</html>