<?php
class Comment_replyAction extends CommonAction {
  	public function down(){
  		$model = D('Comment_reply');
  		$dbpre = C('DB_PREFIX');
  		$sql = "SELECT CR.id,CR.cid,CR.content,CR.addtime,M1.name as uid,M2.name as reviewer
  				FROM `{$dbpre}comment_reply` as CR 
  				left join `{$dbpre}member` as M1 on CR.reviewer = M1.id
  				left join `{$dbpre}member` as M2 on CR.uid = M2.id";
  		$data = $model->query($sql);
  		$keynames = array(
  			'id'=>array('ID','num'),
  			'cid'=>'评论ID',
  			'uid'=>'回复者',
  			'reviewer'=>'接收者',
  			'content'=>'回复内容',
  			'addtime'=>array('回复时间','','toDate'),
  		);
  		exportExcel($data,$keynames,'回复日志_'.date("Y-m-d"));
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