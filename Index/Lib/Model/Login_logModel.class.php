<?php
// 用户模型
class Login_logModel extends CommonModel {
	protected $_auto = array ( 
	    array('addtime','time',1,'function'), // 对addtime字段在更新的时候写入当前时间戳
		array('ip','get_client_ip',1,'function') , // 对ip字段使get_client_ip函数处理
		array('address','IP',1,'function') , // 对address字段使getlocaltion函数处理
	);
	
	function getLastLog($map){
		$data = $this->where($map)->order('id desc')->find();
		return $data;
	}
}
?>