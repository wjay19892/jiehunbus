<?php
class ArticleAction extends CommonAction
{
	private $model;
	public function _initialize(){
		parent::_initialize();
		$this->model = D('Article');
	}
	
	public function lists(){
		$cid = intval($_REQUEST['cid']);
		if(!$cid){
			$this->error(L('operational_error'));
		}
		
		$articles_category = D('Articles_category');
		$categorydata = $articles_category->getOne($cid);
		$path = explode(',', $categorydata['path']);
		foreach($path as $value){
			if($value){
				$c = $articles_category->getOne($value);
				$names[] = $c['name'];
			}
		}
		$categorydata['path'] = $names;
		$count = $this->model->getCategoryCount($cid);
		$limit = $this->page($count);
		$articledata = $this->model->getCategoryArticle($cid,$limit);
		$this->assign('articledata',$articledata);
		$this->assign('categorydata',$categorydata);
		$this->display();
	}
	
    public function detail()
    {
    	$id = intval($_REQUEST['id']);
    	if(!$id){
    		$this->error(L('operational_error'));
    	}
    	$data = $this->model->getOne($id);
    	if($data['status'] != 1){
    		$this->error(L('operational_error'));
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