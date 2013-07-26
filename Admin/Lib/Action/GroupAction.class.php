<?php
class GroupAction extends CommonAction {
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
		$model	=	D("Groups_nav");
		$list	=	$model->where('status=1')->getField('id,name');
		$this->assign('groups_navList',$list);
	}
	
	// 获取配置类型
	public function _before_add() {
		$model	=	D("Groups_nav");
		$list	=	$model->where('status=1')->select();
		$this->assign('list',$list);
	}
	
	public function _before_edit() {
		$model	=	D("Groups_nav");
		$list	=	$model->where('status=1')->select();
		$this->assign('list',$list);
	}
	
    public function sort()
    {
		$node = D('Group');
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