<?php
class CommentAction extends CommonAction {
  	public function down(){
  		$model = D('Comment');
  		$dbpre = C('DB_PREFIX');
  		$sql = "SELECT C.id,C.content,C.addtime,G.title,M.name 
  				FROM `{$dbpre}comment` as C 
  				left join `{$dbpre}goods` as G on C.gid = G.id 
  				left join `{$dbpre}member` as M on C.reviewer = M.id";
  		$data = $model->query($sql);
  		$keynames = array(
  			'id'=>array('ID','num'),
  			'title'=>'商品',
  			'name'=>'评论者',
  			'content'=>'评论内容',
  			'addtime'=>array('评论时间','','toDate'),
  		);
  		exportExcel($data,$keynames,'评论日志_'.date("Y-m-d"));
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