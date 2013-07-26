<?php
define('COMMON_ALL', ROOT_PATH.'/Common/');
define('PUBLIC_PATH', ROOT_PATH.'/Public/');
define('OTHER', PUBLIC_PATH."other/");
define('UPLOAD', PUBLIC_PATH."upload/");
define('UPLOADIMG', UPLOAD."img/");
define('UPLOADFILE', UPLOAD."file/");
define('HOST','http://'.$_SERVER['HTTP_HOST']);
define('HTTP_URL','http://'.$_SERVER ['HTTP_HOST'].__ROOT__);
include COMMON_ALL."function.php";
Load('extend');

if(is_file(COMMON_ALL.'sysconfig.php'))C('sysconfig',array_change_key_case(include COMMON_ALL.'sysconfig.php'));
if(!isset($_SERVER['REQUEST_URI'])) {  
    $_SERVER['REQUEST_URI'] = $_SERVER['PHP_SELF'];
    if(isset($_SERVER['QUERY_STRING'])) $_SERVER['REQUEST_URI'] .= '?'.$_SERVER['QUERY_STRING'];
}
if(C('sysconfig.sys_tpl_cache') == '1'){
	C('TMPL_CACHE_ON',true);
}else{
	C('TMPL_CACHE_ON',false);
}
C('TMPL_CACHE_TIME',C('sysconfig.sys_tpl_time'));
C('DATA_CACHE_TYPE',C('sysconfig.sys_data_cache'));
C('PAGE_LISTROWS',C('sysconfig.site_page_listrows'));
C('URL_HTML_SUFFIX',C('sysconfig.sys_url_suffix'));
?>