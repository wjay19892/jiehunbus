<?php
class FriendsAction extends CommonAction {
  	public function down(){
  		$model = D('Friends');
  		$dbpre = C('DB_PREFIX');
  		$sql = "SELECT F.id,FG.name as group_name,M1.name as main,M2.name as friend,F.remark,F.addtime 
  				FROM `{$dbpre}friends` as F left join `{$dbpre}member` as M1 on F.main = M1.id
  				left join `{$dbpre}member` as M2 on F.friend = M2.id
  				left join `{$dbpre}friends_group` as FG on F.gid = FG.id";
  		$data = $model->query($sql);
  		
  		$keynames = array(
  			'id'=>array('ID','num'),
  			'main'=>'主人',
  			'group_name'=>'分组',
  			'friend'=>'好友',
  			'remark'=>'备注',
  			'addtime'=>array('添加时间','','toDate'),
  		);
  		
  		exportExcel($data,$keynames,'好友关系_'.date("Y-m-d"));
  	}
  	
	public function _filter(&$map){
  		$data = Init_GP(array('mintime','maxtime'));
  		$mintime = strtotime($data['mintime']);
  		$maxtime = strtotime($data['maxtime']);
  		if ($mintime && $maxtime) {
				$map ['addtime'] = array('between',"{$mintime},{$maxtime}");
		}
  	}
}
?>