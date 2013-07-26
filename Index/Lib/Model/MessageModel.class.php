<?php
class MessageModel extends CommonModel {
	protected $_filter = array(
		'content'=>array('contentFilter'),
	);
	protected $_auto = array ( 
		array('type','0'),  // 新增的时候把type字段设置为0
		array('mark','0'),  // 新增的时候把mark字段设置为0
		array('addtime','time',1,'function'), // 对addtime字段在更新的时候写入当前时间戳
	);
    //获取短信息
    function getMessageData($map='',$limit=''){
	    $prefix = C('DB_PREFIX');
		$data = $this->Table("{$prefix}message as M")->
			   join("{$prefix}member as ME on M.send = ME.id")->
			   where($map)->field('M.*,ME.name as sendname')->
			   order('M.id desc')->limit($limit)->
			   findAll();
		return $data;
	}
	//获取短信息数量
	function getCount($map){
	    $prefix = C('DB_PREFIX');
		return $this->Table("{$prefix}message as M")->
			   join("{$prefix}member as ME on M.send = ME.id")->
			   where($map)->count();
	}
	//获取单个短信息
    function getOne($id){
	    $map['M.id'] = array('eq',$id);
	    $prefix = C('DB_PREFIX');
		$data = $this->Table("{$prefix}message as M")->
			   join("{$prefix}member as ME on M.send = ME.id")->
			   where($map)->field('M.*,ME.name as sendname')->
			   find();
		return $data;
	}

}
?>