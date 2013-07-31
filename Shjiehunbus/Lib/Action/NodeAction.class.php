<?php
class NodeAction extends CommonAction {
	public function _filter(&$map)
	{
		if(isset($map['pid'])){
			$currentNodeId = $map['pid'];
			S('currentNodeId',$currentNodeId);
		}else{
			$currentNodeId = S('currentNodeId');
			$map['pid'] = $currentNodeId = $currentNodeId?$currentNodeId:0;
			if($_REQUEST['nav'] == 'back' && $map['pid']){
				$model	=	D("Node");
				$backdata = $model->find($map['pid']);
				$map['pid'] = $currentNodeId = $backdata['pid'];
				S('currentNodeId',$currentNodeId);
			}else if($_REQUEST['_']){
				$map['pid'] = $currentNodeId = 0;
				S('currentNodeId',$currentNodeId);
			}
		}
		
		if(!empty($map['name'])){
  			$map['name'] = array('like',"%{$map['name']}%");
  		}
		
		//获取上级节点
		$node  = D("Node");
        if(isset($map['pid'])) {
            if($node->getById($map['pid'])) {
            	$path_str = $this->getPath($map['pid']);
            	$this->assign('path_str',$path_str);
                $this->assign('level',$node->level+1);
                $this->assign('nodeName',$node->name);
            }else {
                $this->assign('level',1);
            }
        }
	}
	
	protected function getPath($pid){
		$node  = D("Node");
		if($node->getById($pid)){
			$path_str = '/'.$node->title;
			if($node->pid != 0){
				$path_str = $this->getPath($node->pid).$path_str;
			}
		};
		return $path_str;
	}

	public function _before_index() {
		$model	=	D("Group");
		$list	=	$model->where('status=1')->getField('id,title');
		$this->assign('groupList',$list);
	}

	// 获取配置类型
	public function _before_add() {
		$model	=	D("Group");
		$list	=	$model->where('status=1')->select();
		$this->assign('list',$list);
		$node	=	D("Node");
		$id = intval($_REQUEST['id']);
		if(empty($id)){
			$id = S('currentNodeId');
		}
		$node->getById($id);
        $this->assign('pid',$node->id);
		$this->assign('level',$node->level+1);
	}

    public function _before_patch() {
		$model	=	D("Group");
		$list	=	$model->where('status=1')->select();
		$this->assign('list',$list);
		$node	=	D("Node");
		$node->getById(S('currentNodeId'));
        $this->assign('pid',$node->id);
		$this->assign('level',$node->level+1);
    }
    
	public function _before_edit() {
		$model	=	D("Group");
		$list	=	$model->where('status=1')->select();
		$this->assign('list',$list);
	}
	
	public function tree(){
		$name=$this->getActionName();
		$model	=	D($name);
		$map['pid'] = array('eq',0);
		$data = $model->where($map)->findAll();
		foreach($data as &$value){
			$map['pid'] = array('eq',$value['id']);
			$value['children'] = $model->where($map)->findAll();
			foreach($value['children'] as &$val){
				$map['pid'] = array('eq',$val['id']);
				$val['children'] = $model->where($map)->findAll();
			}
		}
		$this->assign('data',$data);
		$this->display();
	}

    /**
     +----------------------------------------------------------
     * 默认排序操作
     +----------------------------------------------------------
     * @access public
     +----------------------------------------------------------
     * @return void
     +----------------------------------------------------------
     */
    public function sort()
    {
		$node = D('Node');
        if(!empty($_GET['sortId'])) {
            $map = array();
            $map['status'] = 1;
            $map['id']   = array('in',$_GET['sortId']);
            $sortList   =   $node->where($map)->order('sort asc')->select();
        }else{
            if(!empty($_GET['pid'])) {
                $pid  = $_GET['pid'];
            }else {
                $pid  = $_SESSION['currentNodeId'];
            }
            if($node->getById($pid)) {
                $level   =  $node->level+1;
            }else {
                $level   =  1;
            }
            $this->assign('level',$level);
            $sortList   =   $node->where('status=1 and pid='.$pid.' and level='.$level)->order('sort asc')->select();
        }
        $this->assign("sortList",$sortList);
        $this->display();
        return ;
    }
    
	public function foreverdelete() {
    	//删除指定记录
    	$name=$this->getActionName();
    	$model = D ($name);
    	if (! empty ( $model )) {
    		$id = $_REQUEST ['id'];
    		if (isset ( $id )) {
    			$id = explode(',', $id);
    			$map = array(
    					'id'=>array('in',$id),
    					'pid'=>array('in',$id),
    					'_logic'=>'or',
    			);
    			if (false !== $model->where ( $map )->delete ()) {
    				$this->success ('删除成功！');
    			} else {
    				$this->error ('删除失败！');
    			}
    		} else {
    			$this->error ( '非法操作' );
    		}
    	}
    	$this->forward ();
    }
}
?>