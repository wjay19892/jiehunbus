<?php
class ComplaintAction extends CommonAction {
// 获取配置类型
	public function _before_add() {
		$model	=	D("Complaint_item");
		$list	=	$model->order('`sort` asc')->select();
		$this->assign('list',$list);
	}
	
	public function _before_edit() {
		$model	=	D("Complaint_item");
		$list	=	$model->order('`sort` asc')->select();
		$this->assign('list',$list);
	}
	
  	public function down(){
  		$model = D('Complaint');
  		$dbpre = C('DB_PREFIX');
  		$sql = "SELECT E.id,G.title,M.name,EI.name as item,E.value 
  				FROM `{$dbpre}evaluate` as E left join `{$dbpre}goods` as G on E.gid = G.id 
  				left join `{$dbpre}member` as M on E.uid = M.id 
  				left join `{$dbpre}evaluate_items` as EI on E.item = EI.id";
  		$data = $model->query($sql);
  		$keynames = array(
  			'id'=>array('ID','num'),
  			'title'=>'商品',
  			'name'=>'用户',
  			'item'=>'投诉项',
  		);
  		
  		exportExcel($data,$keynames,'投诉日志_'.date("Y-m-d"));
  	}
}
?>