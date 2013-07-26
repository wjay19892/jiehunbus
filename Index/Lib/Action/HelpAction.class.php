<?php
class HelpAction extends CommonAction
{
	private $classid;
	private $model;
	public function _initialize(){
		parent::_initialize();
		$this->classid = 1;
		$this->model = D('Article');
	}
	
    public function index()
    {
    	$data = Init_GP(array('id'));
    	$id = GetNum($data['id']);
    	$left = $this->model->getCategoryArticle($this->classid);
    	$articles_category = D('Articles_category');
    	$map['pid'] = array('eq',$this->classid);
    	$articles_categorydata = $articles_category->getData($map);
    	$tmp['status'] = array('eq',1);
    	foreach($articles_categorydata as &$value){
    		$tmp['cid'] = array('eq',$value['id']);
    		$value['articles'] =  $this->model->getData($tmp);
    		unset($tmp['cid']);
    	}
    	$this->assign('articles_categorydata',$articles_categorydata);
    	$this->assign('left',$left);
    	if(empty($id)){
    		$data = $left[0];
    	}else{
    		$data = $this->model->find($id);
    	}
    	if(!empty($data['link'])){
    		redirect($data['link']);
    	}
		$this->assign('title',$data['title']);
		$this->assign('keywords',$data['keywords']);
		$this->assign('description',$data['description']);
    	$this->assign('data',$data);
		$this->display();
    }
    
}
?>