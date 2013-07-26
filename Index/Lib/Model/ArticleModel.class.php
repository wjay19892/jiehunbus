<?php
class ArticleModel extends CommonModel {
	//获取分类的ID的文章
	function getCategoryArticle($id,$num){
		$map= array(
			'cid'=>array('eq',$id),
			'status'=>array('eq',1),
		);
		return $this->getData($map,$num,'`sort` desc,`id` desc');
	}
	
	//获取分类的ID的统计
	function getCategoryCount($id){
		$map= array(
				'cid'=>array('eq',$id),
				'status'=>array('eq',1),
		);
		return $this->getCount($map);
	}
}
?>