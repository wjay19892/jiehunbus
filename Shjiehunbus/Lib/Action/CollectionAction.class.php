<?php
class CollectionAction extends CommonAction {
  	public function down(){
  		$model = D('Collection');
  		$dbpre = C('DB_PREFIX');
  		$sql = "SELECT C.id,M.name,G.title,C.remark,C.ispublic,C.isfail,C.addtime 
  				FROM `{$dbpre}collection` as C 
  				left join `{$dbpre}goods` as G on C.gid = G.id 
  				left join `{$dbpre}member` as M on C.uid = M.id ";
  		$data = $model->query($sql);
  		$keynames = array(
  			'id'=>array('ID','num'),
  			'name'=>'会员',
	  		'title'=>'商品',
  			'remark'=>'备注',
  			'ispublic'=>array('类型','','getWhether'),
  			'isfail'=>array('标记','','getWhether'),
  			'addtime'=>array('收藏时间','','toDate'),
  		);
  		exportExcel($data,$keynames,'会员收藏_'.date("Y-m-d"));
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