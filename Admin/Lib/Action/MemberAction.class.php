<?php
class MemberAction extends CommonAction {
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
	// 获取配置类型
	public function _before_add() {
		$model	=	D("Attachment");
		$list	=	$model->select();
		foreach($list as &$v)
		{
			if(!empty($v['enum']))$v['enum'] = explode(",",$v['enum']);
		}
		$this->assign('list',$list);
	}
	function insert() {
		//B('FilterString');
		$data = $_POST;
		
		$accessory = D('Accessory');

		$upload_list = $accessory->imgUpload(0,"member");
		if($upload_list){
			foreach($upload_list as $upload_item){
				$data[$upload_item['key']] = $upload_item['recpath'].$upload_item['savename'];
			}
		}
		$data['password']=md5($data['password']);
		$data['regtime']=time();
		$medata=array();//主表数据
		$me_atdata=array();//扩展数据
		foreach($data as $k=>$value){//分离数据
		    if(is_array($value))$value= implode(",",$value);
			if(intval($k)){
			    $me_atdata[$k]=$value;
			}else{
				$medata[$k]=$value;
			}
		}

		$name=$this->getActionName();
		$model = D ($name);
		if (false === ($medata = $model->create ($medata))) {
			$this->error ( $model->getError () );
		}
		//保存当前数据对象
		$list=$model->add ($medata);
		
		if ($list!==false) { //保存成功
		    $Member_attachment = D ('Member_attachment');
			foreach($me_atdata as $k=>$value){
               $metadata = array(
					'uid'=>$list,
					'aid'=>$k,
					'val'=>$value
				);
				$metadata = $Member_attachment->create($metadata);
				$result=$Member_attachment->add($metadata);
				unset ($metadata, $result);
			}
			$this->assign ( 'jumpUrl', U($name.'/index'));
			$this->success ('新增成功!');
		} else {
			//失败提示
			$this->error ('新增失败!');
		}
	}
	function edit() {
		$name=$this->getActionName();
		$model = D ( $name );
		$id = $_REQUEST [$model->getPk ()];
		$vo = $model->getById ( $id );
		
		$accessory = D('Accessory');
		$accdata = $accessory->where('id='.$vo['header'])->find();
		$vo['headerpath']=$accdata['origin'];
		
		$attachment = D ('Attachment');
		$list=$attachment->getdata($id);
		foreach($list as &$v)
		{
			if(!empty($v['enum']))$v['enum'] = explode(",",$v['enum']);
			if($v['type']==4)$v['val'] = explode(",",$v['val']);
		}
		$this->assign ( 'vo', $vo );
		$this->assign ( 'list', $list );
		$this->display ();
	}
	function update() {
		//B('FilterString');
		$data = $_POST;
		
		$accessory = D('Accessory');

		$upload_list = $accessory->imgUpload(0,"member");
		if($upload_list){
			foreach($upload_list as $upload_item){
				$data[$upload_item['key']] = $upload_item['recpath'].$upload_item['savename'];
			}
		}
		if(!empty($data['password'])){
			$data['password']=md5($data['password']);
		}else{
			unset($data['password']);
		}
		$medata=array();//主表数据
		$me_atdata=array();//扩展数据
		foreach($data as $k=>$value){//分离数据
		    if(is_array($value))$value= implode(",",$value);
			if(intval($k)){
			    $me_atdata[$k]=$value;
			}else{
				$medata[$k]=$value;
			}
		}
			
		$name=$this->getActionName();
		$model = D ( $name );
		if (false === $model->create ($medata)) {
			$this->error ( $model->getError () );
		}
		// 更新数据
		$list=$model->save ($medata);
		if (false !== $list) {
			//成功提示
			$Member_attachment = D ('Member_attachment');
			foreach($me_atdata as $k=>$value){
			    $where = 'aid='.$k.' and uid='.$medata['id'];
				$matarray = $Member_attachment->where($where)->find();
				$metadata = array(
					'uid'=>$medata['id'],
					'aid'=>$k,
					'val'=>$value
				);
				$metadata = $Member_attachment->create($metadata);
				if(empty($matarray)){
					$result=$Member_attachment->add($metadata);
				}else{
					$result=$Member_attachment->where($where)->save($metadata);
				}
				unset ($where, $matarray, $metadata, $result);
			}
			$this->assign ( 'jumpUrl', U($name.'/index'));
			$this->success ('编辑成功!');
		} else {
			//错误提示
			$this->error ('编辑失败!');
		}
	}
    public function sort()
    {
		$node = M('Member');
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
    	if(!empty($map['mail'])){
  			$map['mail'] = array('like',"%{$map['mail']}%");
  		}
  	}

}
?>