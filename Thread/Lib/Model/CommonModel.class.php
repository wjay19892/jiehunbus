<?php
class CommonModel extends Model {
	//获取数据
	function getData($map,$limit,$order = '`sort` desc'){
		return $this->where($map)->limit($limit)->order($order)->findAll();
	}
	
	//获取单个的所有数据
	function getOne($id){
		if($id){
			if(is_array($id)){
				$data = $this->where($id)->find();
			}else{
				$data = $this->find($id);
			}
		}else{
			$data = array();
		}
		return $data;
	}
	
	//获取统计值
	function getCount($map){
		return $this->where($map)->count();
	}
	
	//插入数据
	function insert($data){
		$data = $this->create($data);
		if($data){
			$info = $this->add($data);
			return $info;
		}else{
			return false;
		}
	}
	
	//判断条件是否存在 直接输入ID也行
	function isExist($where){
		if(!is_array($where)){
			$map[$this->getPk()] = array('eq',$where);
		}else{
			$map = $where;
		}
		if(!empty($map)){
			$data = $this->where($map)->find();
			if(!empty($data)){
				return true;
			}
			return false;
		}
		return false;
	}
	
	//获取条件的 所有某个字段的集合用逗号分割 默认是主键
	function getGather($map,$field){
		if (empty($field)){
			$field = $this->getPk();
		}
		$data = $this->where($map)->field("group_concat(CAST({$field} AS char)) as gather")->find();
		return $data['gather'];
	}
	
	function getGatherArr($map,$field){
		$data = $this->getGather($map,$field);
		return explode(',', $data);
	}
	
}
?>