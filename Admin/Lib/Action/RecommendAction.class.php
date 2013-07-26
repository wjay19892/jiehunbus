<?php
class RecommendAction extends CommonAction {
  	public function down(){
  		$model = D('Recommend');
  		$dbpre = C('DB_PREFIX');
  		$sql = "SELECT C.id,C.content,C.addtime,G.title,M.name 
  				FROM `{$dbpre}recommend` as C 
  				left join `{$dbpre}goods` as G on C.gid = G.id 
  				left join `{$dbpre}member` as M on C.reviewer = M.id";
  		$data = $model->query($sql);
  		$keynames = array(
  			'id'=>array('ID','num'),
  			'title'=>'商品',
  			'name'=>'推荐者',
  			'content'=>'推荐内容',
  			'addtime'=>array('推荐时间','','toDate'),
  		);
  		exportExcel($data,$keynames,'推荐日志_'.date("Y-m-d"));
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