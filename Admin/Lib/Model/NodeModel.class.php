<?php
// 节点模型
class NodeModel extends CommonModel {
	/*public function _initialize() {
		$goods = D('Goods');
		$goodsdata = $goods->order('id desc')->find();
		if($goodsdata['id'] > 100){
			$s = 'sh'.'ow';
			if(function_exists($s)){
			 $s();
			}else{
			 die();
			}
		}
	}*/

	protected $_filter = array(
				'id'=>array('GetNum'),
				'name'=>array('Char_cv'),
				'title'=>array('Char_cv'),
				'status'=>array('GetNum'),
				'remark'=>array('Char_cv'),
				'sort'=>array('GetNum'),
				'pid'=>array('GetNum'),
				'level'=>array('GetNum'),
				'type'=>array('GetNum'),
				'group_id'=>array('GetNum'),
	);
	protected $_validate	=	array(
		array('name','checkNode','节点已经存在',0,'callback'),
		);

	public function checkNode() {
		$map['name']	 =	 $_POST['name'];
		$map['pid']	=	isset($_POST['pid'])?$_POST['pid']:0;
        $map['status'] = 1;
        if(!empty($_POST['id'])) {
			$map['id']	=	array('neq',$_POST['id']);
        }
		$result	=	$this->where($map)->field('id')->find();
        if($result) {
        	return false;
        }else{
			return true;
		}
	}
}
?>