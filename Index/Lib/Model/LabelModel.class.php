<?php
class LabelModel extends CommonModel {
	public function getNameID($name){
		$tmp['name'] = array('eq',$name);
		$id = $this->where($where)->getField('id');
		if($id){
			$data = array(
					'name'=>$name,
					'addtime'=>time(),
					);
			$id = $this->add($data);
		}
		return $id;
	}
	
	public function incCount($id,$num = 1){
		$this->setInc('count',"id={$id}",$num);
	}
	
	public function getData($map,$limit='',$order='id desc'){
		return parent::getData($map,$limit,$order);
	}
}
?>