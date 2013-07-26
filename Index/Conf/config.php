<?php
$config = require(ROOT_PATH."/Conf/config.php");
$array = array(
	'LANG_SWITCH_ON'=>true,
    'LANG_LIST'=>'zh-cn,zh-tw',
	'DEFAULT_THEME'=>'default',
);
return array_merge($config,$array);

?>