<?php
class Expand_groupAction extends CommonAction {
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
	public function _before_add() {
		$model	=	D("Expand");
		$list	=	$model->where('id>0')->select();
		$this->assign('list',$list);
	}
	function insert() {
	     $data = $_POST;
		 $data['expand_ids'] = implode(",",$data['expand_ids']);
		//B('FilterString');
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
		$model	=	D("Expand");
		$list	=	$model->where('id>0')->select();
		$this->assign('list',$list);
	}
	function edit() {
		$name=$this->getActionName();
		$model = D ( $name );
		$id = $_REQUEST [$model->getPk ()];
		$vo = $model->getById ( $id );
		$vo['expand_ids'] = explode(",",$vo['expand_ids']);
		$this->assign ( 'vo', $vo );
		$this->display ();
	}
	function update() {
	     $data = $_POST;
		 $data['expand_ids'] = implode(",",$data['expand_ids']);
		//B('FilterString');
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
		$node = D('Expand_group');
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