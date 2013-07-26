<?php
class ArticleAction extends CommonAction {

	// 获取配置类型
	public function _before_add() {
		$model	=	D("Articles_category");
		$list	=	$model->order('`path` asc')->select();
		$this->assign('list',$list);
	}
	
	public function _before_edit() {
		$model	=	D("Articles_category");
		$list	=	$model->order('`path` asc')->select();
		$this->assign('list',$list);
	}
	
	public function _before_foreverdelete(){
		$name=$this->getActionName();
		$model = D ($name);
		if(! empty ( $model )){
			$id = $_REQUEST ['id'];
			if (isset ( $id )) {
				$arr = explode ( ',', $id );
				$map = array(
					'id'=>array('in',$arr),
					'type'=>array('eq',1),
				);
				$data = $model->where($map)->find();
				if(!empty($data)){
					$this->error($data['title'].'为系统内置文章不可删除');
				}
			}else{
				$this->error('参数错误');
			}
		}
	}
	
	public function clearList(){
		$cid = intval($_REQUEST['cid']);
		if($cid){
			$name=$this->getActionName();
			$model = D($name);
			$modelmap['cid'] = array('eq',$cid);
			$info = $model->where($modelmap)->delete();
			if($info){
				$this->success('清空成功');
			}else{
				$this->error('清空失败');
			}
		}else{
			$this->error('清空失败');
		}
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