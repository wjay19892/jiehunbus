<?php
class LinkAction extends CommonAction {
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
		$upload_list = $accessory->imgUpload(0,"link");
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
		$upload_list = $accessory->imgUpload(0,"link");
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
			$this->assign ( 'jumpUrl', U($name.'/index'));
			$this->success ('编辑成功!');
		} else {
			//错误提示
			$this->error ('编辑失败!');
		}
	}
    public function sort()
    {
		$node = D('Link');
        if(!empty($_GET['sortId'])) {
            $map = array();
            $map['status'] = 1;
            $map['id']   = array('in',$_GET['sortId']);
            $sortList   =   $node->where($map)->order('sort asc')->select();
        }else{
            $sortList   =   $node->where('status=1')->order('sort asc')->select();
        }
        $this->assign("sortList",$sortList);
        $this->display();
        return ;
    }
	
	public function _filter(&$map){
  		if(!empty($map['name'])){
  			$map['name'] = array('like',"%{$map['name']}%");
  		}
  	}
}
?>