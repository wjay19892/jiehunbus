<?php
class Talk_about_relationModel extends CommonModel {
	
	public function getDataAll($map,$limit,$order = 'id desc'){
		$prefix = C('DB_PREFIX');
		$map = addPre($map,'TAC');
		$and = $map?' AND '.$this->db->_parseWhere($map):'';
		$limit = $limit?'LIMIT '.$limit:'';
		$sql = "SELECT TAC.*,M.name,A.thumbnail as header FROM `{$prefix}talk_about_comment` as TAC INNER JOIN `{$prefix}member` as M on TAC.uid = M.id{$and} left join `{$prefix}accessory` as A on M.header = A.id order by {$order} {$limit}";
		$data = $this->query($sql);
		return $data;
	}
	
	public function getOne($id){
		if(!is_array($id)){
			$map[$this->getPk()]=array('eq',$id);
		}else{
			$map = $id;
		}
		$data = $this->getDataAll($map,'0,1');
		return $data[0];
	}
	
	public function insert($data){
		$time = time();
		$data['addtime'] = $time;
		$content = $data['content'];
		
		$talk_about = D('Talk_about');
		if($talk_about->isExist($data['tid'])){
			$info = parent::insert($data);
			if($info){
				$talk_about->setInc('comment',"id={$data['tid']}");
			}else{
				return false;
			}
		}else{
			return false;
		}
		return $info;
	}
	
}
?>