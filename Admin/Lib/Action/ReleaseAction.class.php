<?php
class ReleaseAction extends CommonAction {
    
	// 获取配置类型
	public function index(){
		$goods = A('Goods');
		$_REQUEST['audit']=1;
		$goods->_index();
		$this->display();
	}
	
	public function isRelease(){
		$id = intval($_REQUEST['id']);
		if($id){
			$model = D('Goods');
			$data = array(
					'id'=>$id,
					'audit'=>0,						
			);
			$info = $model->save($data);
			if($info !== false){
				$this->success('发布成功');
			}else{
				$this->error('发布失败');
			}
		}else{
			$this->error('发布失败');
		}
	}
	
}
?>