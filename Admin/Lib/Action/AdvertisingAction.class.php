<?php
class AdvertisingAction extends CommonAction {
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
	public function _before_index() {
		$model	=	D("Advertising_position");
		$list	=	$model->getField('id,name');
		$this->assign('Advertising_positionlist',$list);
	}
	
	// 获取配置类型
	public function _before_add() {
		$model	=	D("Advertising_position");
		$list	=	$model->select();
		$this->assign('list',$list);
	}
	function insert() {
		//B('FilterString');
		$data = $_POST;
 
       	if($data['type']!=1)$data['url'] = "";
		
		$accessory = D('Accessory');
		if($data['type']==1){
		     $upload_list = $accessory->imgUpload(0,"adv");
		}elseif($data['type']==2){
		    $upload_list = $accessory->fileUpload("adv");
		}

		if($upload_list)
		{
			foreach($upload_list as $upload_item)
			{
				if($upload_item['key']=="code")
				{
					$data['code'] = $upload_item['recpath'].$upload_item['savename'];
				}
			}
		}

		if(empty($data['adv_start_time']))
			$data['adv_start_time'] = 0;
		else 
			$data['adv_start_time'] = strtotime($data['adv_start_time']);
			
		if(empty($data['adv_end_time']))
			$data['adv_end_time'] = 0;
		else 
			$data['adv_end_time'] = strtotime($data['adv_end_time']);
			
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
	public function _before_edit() {
		$model	=	D("Advertising_position");
		$list	=	$model->select();
		$this->assign('list',$list);
	}
	function update() {
		//B('FilterString');
		$data = $_POST;
       	if($data['type']!=1)$data['url'] = "";
		
		$accessory = D('Accessory');
		if($data['type']==1){
		     $upload_list = $accessory->imgUpload(0,"adv");
		}elseif($data['type']==2){
		    $upload_list = $accessory->fileUpload("adv");
		}

		if($upload_list)
		{
			foreach($upload_list as $upload_item)
			{
				if($upload_item['key']=="code")
				{
					$data['code'] = $upload_item['recpath'].$upload_item['savename'];
				}
			}
		}

		if(empty($data['adv_start_time']))
			$data['adv_start_time'] = 0;
		else 
			$data['adv_start_time'] = strtotime($data['adv_start_time']);
			
		if(empty($data['adv_end_time']))
			$data['adv_end_time'] = 0;
		else 
			$data['adv_end_time'] = strtotime($data['adv_end_time']);
			
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
	public function getadvertising() {
	    $id = GetNum($_GET['id']);
		$model	=	D("Advertising");
		$list	=	$model->where("id=".$id)->find();
    	echo json_encode($list);
		exit;
	}
    public function sort()
    {
		$node = D('Advertising');
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