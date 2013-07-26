<?php
$config	= array(
    'URL_MODEL'=>1, // 如果你的环境不支持PATHINFO 请设置为3
	'DB_TYPE'=>'mysql',
	'DB_HOST'=>'localhost',
	'DB_NAME'=>'jiehunbus',
	'DB_USER'=>'root',
	'DB_PWD'=>'root',
	'DB_PORT'=>'3306',
	'DB_PREFIX'=>'jh_',
	'SITE_KEY'=>'1feG0oaU0A9DclaP3N4O5Fb83K2U5J6cfQbF2ZcBay1meCabbe9E300gb59m9I2n',
	//'APP_DEBUG'=>true,	//调试模式开关
	

	'VAR_PAGE'=>'pageNum',
	'DATA_CACHE_TABLE'=>'cache',
	'TOKEN_ON'              => false,     // 关闭令牌验证
	'APP_PLUGIN_ON'=>true,
	'LANG_SWITCH_ON' =>   true,
	'USER_AUTH_KEY'=>'authId',	// 用户认证SESSION标记
//	'TMPL_STRIP_SPACE'      => true,      //运营时开启
);

return $config;
?>