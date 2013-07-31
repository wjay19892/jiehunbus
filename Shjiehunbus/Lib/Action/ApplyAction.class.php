<?php
class ApplyAction extends CommonAction {
    /**
     +----------------------------------------------------------
     * 默认排序操作
     +----------------------------------------------------------
     * @access public
     +----------------------------------------------------------
     * @return void
     +----------------------------------------------------------
     * @throws FcsException
     +----------------------------------------------------------
     */
	function insert() {
		//B('FilterString');
		$data = $_POST;
		$accessory = D('Accessory');
		$upload_list = $accessory->imgUpload(0,"avatar");
		if($upload_list)
		{
			foreach($upload_list as $upload_item)
			{
				if($upload_item['key']=="logo")
				{
					$data['logo'] = $upload_item['recpath'].$upload_item['savename'];
				}
			}
		}
		$name=$this->getActionName();
		$model = D ($name);
		if (false === $model->create ($data)) {
			$this->error ( $model->getError () );
		}
		//保存当前数据对象
		$list=$model->add ($data);
		if ($list!==false) { //保存成功
			if($data['status'] == 1){
				$member = D('Member');
				$member->setField("isbusiness",1,"id={$data['uid']}");
			}
			$this->assign ( 'jumpUrl', U($name.'/index'));
			$this->success ('新增成功!');
		} else {
			//失败提示
			$this->error ('新增失败!');
		}
	}
	function update() {
		//B('FilterString');
		$data = $_POST;
		$accessory = D('Accessory');
		$upload_list = $accessory->imgUpload(0,"avatar");
		if($upload_list)
		{
			foreach($upload_list as $upload_item)
			{
				if($upload_item['key']=="logo")
				{
					$data['logo'] = $upload_item['recpath'].$upload_item['savename'];
				}
			}
		}
		$name=$this->getActionName();
		$model = D ( $name );
		if (false === $model->create ($data)) {
			$this->error ( $model->getError () );
		}
		// 更新数据
		$list=$model->save ($data);
		if (false !== $list) {
			//成功提示
			$member = D('Member');
			if($data['status'] == 1){
				$member->setField("isbusiness",1,"id={$data['uid']}");
			}else{
				$member->setField("isbusiness",0,"id={$data['uid']}");
			}
			$this->assign ( 'jumpUrl', U($name.'/index'));
			$this->success ('编辑成功!');
		} else {
			//错误提示
			$this->error ('编辑失败!');
		}
	}
	
	public function _filter(&$map){
  		if(!empty($map['name'])){
  			$map['name'] = array('like',"%{$map['name']}%");
  		}
  	}

	public function pass(){
		$id = intval($_GET['id']);
		if(empty($id)){
			$this->error ('操作失败!');
		}
		$name=$this->getActionName();
		$model = D ( $name );
		$data = $model->where("id={$id}")->find();
		if(empty($data)){
			$this->error ('操作失败!');
		}else{
			$model->setField("status",1,"id={$id}");
			$member = D('Member');
			$member->setField("isbusiness",1,"id={$data['uid']}");
			$this->success ('通过审核');
		}
	}

	public function revocation(){
		$id = intval($_GET['id']);
		if(empty($id)){
			$this->error ('操作失败!');
		}
		$name=$this->getActionName();
		$model = D ( $name );
		$data = $model->where("id={$id}")->find();
		if(empty($data)){
			$this->error ('操作失败!');
		}else{
			$model->setField("status",2,"id={$id}");
			$member = D('Member');
			$member->setField("isbusiness",0,"id={$data['uid']}");
			$this->success ('已撤销');
		}
	}
	
}
?>