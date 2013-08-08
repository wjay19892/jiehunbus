<?php  require(ROOT_PATH."/Common/common.php"); return array ( 'app_debug' => false, 'app_domain_deploy' => false, 'app_sub_domain_deploy' => false, 'app_plugin_on' => true, 'app_file_case' => false, 'app_group_depr' => '.', 'app_group_list' => '', 'app_autoload_reg' => false, 'app_autoload_path' => 'Think.Util.', 'app_config_list' => array ( 0 => 'taglibs', 1 => 'routes', 2 => 'tags', 3 => 'htmls', 4 => 'modules', 5 => 'actions', ), 'cookie_expire' => 3600, 'cookie_domain' => '', 'cookie_path' => '/', 'cookie_prefix' => '', 'default_app' => '@', 'default_group' => 'Home', 'default_module' => 'Index', 'default_action' => 'index', 'default_charset' => 'utf-8', 'default_timezone' => 'PRC', 'default_ajax_return' => 'JSON', 'default_theme' => 'default', 'default_lang' => 'zh-cn', 'db_type' => 'mysql', 'db_host' => 'localhost', 'db_name' => 'jiehunbus', 'db_user' => 'root', 'db_pwd' => 'root', 'db_port' => '3306', 'db_prefix' => 'jh_', 'db_suffix' => '', 'db_fieldtype_check' => false, 'db_fields_cache' => true, 'db_charset' => 'utf8', 'db_deploy_type' => 0, 'db_rw_separate' => false, 'data_cache_time' => -1, 'data_cache_compress' => false, 'data_cache_check' => false, 'data_cache_type' => 'Db', 'data_cache_path' => './Runtime/Shjiehunbus/Temp/', 'data_cache_subdir' => false, 'data_path_level' => 1, 'error_message' => '您浏览的页面暂时发生了错误！请稍后再试～', 'error_page' => '', 'html_cache_on' => false, 'html_cache_time' => 60, 'html_read_type' => 0, 'html_file_suffix' => '.shtml', 'lang_switch_on' => true, 'lang_auto_detect' => false, 'log_exception_record' => true, 'log_record' => false, 'log_file_size' => 2097152, 'log_record_level' => array ( 0 => 'EMERG', 1 => 'ALERT', 2 => 'CRIT', 3 => 'ERR', ), 'page_rollpage' => 5, 'page_listrows' => '20', 'session_auto_start' => true, 'show_run_time' => false, 'show_adv_time' => false, 'show_db_times' => false, 'show_cache_times' => false, 'show_use_mem' => false, 'show_page_trace' => false, 'show_error_msg' => true, 'tmpl_engine_type' => 'Think', 'tmpl_detect_theme' => false, 'tmpl_template_suffix' => '.html', 'tmpl_content_type' => 'text/html', 'tmpl_cachfile_suffix' => '.php', 'tmpl_deny_func_list' => 'echo,exit', 'tmpl_parse_string' => '', 'tmpl_l_delim' => '{', 'tmpl_r_delim' => '}', 'tmpl_var_identify' => 'array', 'tmpl_strip_space' => false, 'tmpl_cache_on' => false, 'tmpl_cache_time' => '-1', 'tmpl_action_error' => 'Public:success', 'tmpl_action_success' => 'Public:success', 'tmpl_trace_file' => './ThinkPHP/Tpl/PageTrace.tpl.php', 'tmpl_exception_file' => './ThinkPHP/Tpl/ThinkException.tpl.php', 'tmpl_file_depr' => '/', 'taglib_begin' => '<', 'taglib_end' => '>', 'taglib_load' => true, 'taglib_build_in' => 'cx', 'taglib_pre_load' => '', 'tag_nested_level' => 3, 'tag_extend_parse' => '', 'token_on' => false, 'token_name' => '__hash__', 'token_type' => 'md5', 'url_case_insensitive' => false, 'url_router_on' => false, 'url_route_rules' => array ( ), 'url_model' => 1, 'url_pathinfo_model' => 2, 'url_pathinfo_depr' => '/', 'url_html_suffix' => '', 'var_group' => 'g', 'var_module' => 'm', 'var_action' => 'a', 'var_router' => 'r', 'var_page' => 'pageNum', 'var_template' => 't', 'var_language' => 'l', 'var_ajax_submit' => 'ajax', 'var_pathinfo' => 's', 'site_key' => '1feG0oaU0A9DclaP3N4O5Fb83K2U5J6cfQbF2ZcBay1meCabbe9E300gb59m9I2n', 'data_cache_table' => 'cache', 'user_auth_key' => 'authId', 'user_auth_on' => true, 'user_auth_type' => 1, 'admin_auth_key' => 'administrator', 'user_auth_model' => 'User', 'auth_pwd_encoder' => 'md5', 'user_auth_gateway' => '/Public/login', 'not_auth_module' => 'Public', 'require_auth_module' => '', 'not_auth_action' => 'sortInc,sortDec', 'require_auth_action' => '', 'guest_auth_on' => false, 'guest_auth_id' => 0, 'db_like_fields' => 'title|remark|content', 'rbac_role_table' => 'role', 'rbac_user_table' => 'role_user', 'rbac_access_table' => 'access', 'rbac_node_table' => 'node', 'lang_list' => 'zh-cn', 'default_admin' => 'admin', 'sysconfig' => array ( 'site_name' => '结婚巴士', 'site_url' => 'http://127.0.0.1', 'site_title' => '结婚巴士', 'site_keywords' => '婚纱摄影', 'site_description' => '结婚巴士-专做婚纱摄影的网站.www.jiehunbus.com', 'site_powerby' => 'Copyright © 2012-2013 JiehunBus.com. ', 'site_beian' => '苏ICP证66688888号', 'site_closed' => '0', 'site_logo' => '/Public/upload/img/site/51f480d73b232.png', 'site_tongji' => '', 'site_services_tel' => '0512-66668888', 'site_services_email' => 'jiehunbus@126.com', 'site_work_times' => '周一至周五 9:00-17:00', 'site_page_listrows' => '20', 'site_credits_name' => '积分', 'site_couponname' => '优惠券', 'site_replacestr' => '她妈|它妈|他妈|你妈|去死|贱人|www|日|操|草你马|狗日的', 'site_prepaid_card_name' => '充值卡', 'site_mail_on' => '1', 'site_smtp_server' => 'smtp.126.com', 'site_smtp_port' => '25', 'site_smtp_account' => 'jiehunbus@126.com', 'site_services_password' => '1000000', 'site_reply_address' => 'jiehunbus@126.com', 'site_smtp_auth' => '1', 'site_smtp_is_ssl' => '0', 'site_sendmail_pay' => '0', 'site_sendmail_coupon' => '0', 'site_sendmail_usecoupon' => '0', 'site_price_decimal' => '2', 'evaluate_total' => '100', 'is_open_chat' => '1', 'recently_num' => '100', 'chat_log_num' => '100', 'online_check' => '600', 'site_refund_isallow' => '1', 'verify_phone_format' => '0', 'is_switch_region' => '1', 'site_upload_allowexts' => 'jpg,gif,png,jpeg', 'site_upload_maxsize' => '1024000', 'site_water_mark' => '1', 'site_big_width' => '334', 'site_big_heigth' => '', 'site_small_width' => '213', 'site_small_heigth' => '', 'site_water_image' => '/Public/upload/img/site/51f4b37323a44.png', 'site_water_position' => '4', 'site_water_alpha' => '80', 'site_mb_allowreg' => '1', 'site_mb_autoreg' => '0', 'site_mb_logintime' => '600', 'site_mb_bigavatar' => '/Public/upload/img/site/4eeaad8122cf7.png', 'site_mb_smallavatar' => '/Public/upload/img/site/4eeaad813263f.png', 'site_mb_phone_verify' => '0', 'site_mb_verifycredits' => '100', 'site_mb_invitecredits' => '100', 'site_mb_buycredits' => '100', 'site_mb_invitebuycredits' => '200', 'site_mb_invitesellcredits' => '200', 'site_mb_avatarcredits' => '200', 'site_mb_invitetime' => '600', 'site_mb_sellcredits' => '100', 'site_sms_open' => '1', 'site_sms_sendhttp' => 'http://124.172.250.160/WebService.asmx/mt?Sn=jf&Pwd=888888&mobile=[tel]&content=[msg]', 'site_sms_type' => 'UTF-8', 'site_sms_success' => '.+0.+int.+', 'site_sendsms_pay' => '0', 'site_sendsms_coupon_auto' => '0', 'site_sendsms_coupon' => '1', 'site_sendsms_coupon_num' => '3', 'site_sendsms_usecoupon' => '0', 'site_sendsms_code_time' => '60', 'sys_tpl_cache' => '0', 'sys_tpl_time' => '-1', 'sys_data_cache' => 'Db', 'sys_default_lang' => 'zh-cn', 'sys_url_suffix' => '', 'sys_lang_auto_detect' => '0', 'distribution_auto' => '1', 'distribution_unity_open' => '1', 'distribution_unity_type' => '1', 'distribution_unity_value' => '0', 'distribution_level_open' => '1', 'distribution_goods_open' => '0', 'release_open' => '1', 'release_audit' => '1', ), ); ?>