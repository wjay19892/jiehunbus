<?php
class SearchAction extends CommonAction
{
    public function index()
    {
    	//获取查询条件
    	$data = Init_GP(array('search_key','favorites','minprice1','maxprice1','fgid'));
        //var_dump($data);
    	$map = $this->_filters($data);
    	$goods = D('Goods');
    	$price_rangedata = $goods->price_rangeCount($map);
    	$distance_range = D('Distance_range');
    	$distance_rangedata = $distance_range->getData();
		$categorydata = $goods->categoryCount($map);
		$regiondata = $goods->regionCount($map);
		$this->assign('regiondata',$regiondata);//地区
		$this->assign('categorydata',$categorydata);//分类
    	$this->assign('distance_rangedata',$distance_rangedata);//距离
    	$this->assign('price_rangedata',$price_rangedata);//价格
    	$this->assign('condition',json_encode($data));
		$this->display();
    }
    
    public function ajaxSearch(){
    //获取查询条件
    	$data = Init_GP(array('search_key','favorites','minprice1','maxprice1','fgid','minprice','maxprice','region','category','sort','promulgator','mindistance','maxdistance','recommend','evaluate'));
    	$map = $this->_filters($data);
    	$goods = D('Goods');
    	$fields = $goods->getDbFields();
    	//获取的是上架的产品
    	if(isset($_REQUEST['sort'])){
    		$sort = trim(Char_cv($_REQUEST['sort']));
    	}
    	if(!empty($sort)){
    		$arr = explode(' ', $sort);
    		$sc = array('asc','desc');
    		if(in_array($arr[0], $fields)){
    			if($arr[0] == 'price')$arr[0] = 'cast(`price` as DECIMAL)';
    			if(in_array($arr[1], $sc)){
    				$order = $arr[0].' '.$arr[1];
    			}
    		}
    	}
    	
    	if(isset($data['mindistance'])){
    		$mindistance = GetNum($data['mindistance']);
    	}
    	if(isset($data['maxdistance'])){
    		$maxdistance = GetNum($data['maxdistance']);
    	}
    	
    	if(!empty($mindistance) || !empty($maxdistance)){
    		$latlng = getCrrLatlng();
			$field = '* , (round(6378.137 * 2 * sin(sqrt(pow(sin((radians('.$latlng['lat'].')-radians(`latitude`))/2),2) + cos(radians('.$latlng['lat'].'))*cos(radians(`latitude`))*pow(sin(((radians('.$latlng['lng'].')-radians(`longitude`))/2)),2)))*10000)/10000*1000) as distance';
    		$having = "distance >= {$mindistance} and distance < {$maxdistance}";
    	}
    	
    	$goods_count = $goods->getCount($map,$field,$having);
    	$limit = $this->page($goods_count,'',$data);
    	$goodsdata = $goods->getDataAll($map,$limit,$sort,$field,$having);
		$this->assign('goodsdata',$goodsdata);
		$result['html'] = $this->fetch('list');
		$result['page'] = $this->get('page');
		$this->success($result);
    }
    
    public function regionAll(){
    	$data = Init_GP(array('search_key','favorites','minprice1','maxprice1','fgid','region','inputType','minprice','maxprice','all'));
    	$map = $this->_filters($data);
    	unset($map['rid']);
    	//统计分类中符合条件的数量
    	$region = D('Region');
    	$other_map = addPre($map, 'G');
    	$regiondata = $region->getNumCount($other_map,$data['all']);
    	$region_arr = explode(',', $data['region']);
		$this->assign('region_arr',$region_arr);
    	$this->assign('regiondata',$regiondata);
    	if(empty($data['inputType'])){
    		$data['inputType'] = 'checkbox';
    	}
    	$this->assign('inputType',$data['inputType']);
    	$this->display();
    }
    
	public function categoryAll(){
    	$data = Init_GP(array('search_key','favorites','minprice1','maxprice1','fgid','category','inputType','minprice','maxprice','all'));
    	$map = $this->_filters($data);
    	unset($map['cid']);
    	//统计分类中符合条件的数量
    	$goods_category = D('Goods_category');
    	$other_map = addPre($map, 'G');
    	$categorydata = $goods_category->getNumCount($other_map,$data['all']);
    	$category_arr = explode(',', $data['category']);
		$this->assign('category_arr',$category_arr);
    	$this->assign('categorydata',$categorydata);
    	
    	if(empty($data['inputType'])){
    		$data['inputType'] = 'checkbox';
    	}
    	$this->assign('inputType',$data['inputType']);
    	$this->display();
    }
    
    public function son(){
    	$data = Init_GP(array('search_key','favorites'));
    	$map = $this->_filters($data);
        //如果分类id有值
       // if(!empty($_REQUEST['fgid'])){
       //     $cid = intval($_REQUEST['fgid']);
       // }
        //else{
            $cid = intval($_REQUEST['cid']);
       // }

    	$goods = D('Goods');
    	$where['pid'] = array('eq',$cid);
    	$categorydata = $goods->categoryCount($map,1,$where);
    	$this->assign('categorydata',$categorydata);
    	$result['html'] = $this->fetch('son');
    	$this->success($result);
    }
    
    protected function _filters($data){
    	$search_key = $data['search_key'];
        //价格添加参数前台
        $minprice1=$data['minprice1'];
        $maxprice1=$data['maxprice1'];
        //风格id
        $fgid=$data['fgid'];
        if(!empty($minprice1)||!empty($maxprice1)){
            $this->assign('minprice1',$minprice1);
            $this->assign('maxprice1',$maxprice1);
        }else{
            $this->assign('minprice1',-1);//设置默认值，设置了minprice1是大于=0的
            $this->assign('maxprice1',-1);
        }
        
        if(!empty($fgid)){
            $this->assign('fenggeid',$fgid);
        }else{
            $this->assign('fenggeid',-1);
        }


		$map = array();
		if(isset($data['minprice'])){
    		$minprice = GetNum($data['minprice']);
		}
		if(isset($data['maxprice'])){
    		$maxprice = GetNum($data['maxprice']);
		}
		
    	if(!empty($search_key) && $search_key != L('search_input_tip')){
    		$this->assign('search_key',$search_key);
    		$key_array = preg_split('/[\s|\,|\+|\-]/i', $search_key);
    		foreach($key_array as &$value){
    			$value = "LOCATE('{$value}',CONCAT(`title`,`address`,`keywords`,`description`,`detail`))>0";
    		}
    		$map['_string'] = implode(' and ', $key_array);
    	}
    	
    	$favorites = $data['favorites'];
    	if(!empty($favorites) && !empty($this->memberinfo)){
    		$collection = D('Collection');
    		$collectionmap = array(
    			'uid'=>array('eq',$this->memberinfo['id']),
    		);
    		$gids = $collection->getGather($collectionmap,'gid');
    		$map['id'] = array('in',$gids);
    	}
    	
    	if(!empty($minprice) || !empty($maxprice)){
    		if(isset($map['_string'])){
    			$map['_string'] .= ' and ';
    		}
    		$map['_string'] = "price >= {$minprice} and price < {$maxprice}";
    	}
    	
    	if(!empty($data['region'])){
    		$region = D('Region');
    		$region_map['id'] = array('in',"{$data['region']}");
    		$regiondata = getFieldAll($region->getChild($region_map),'child');
    		$rids = implode(',', $regiondata);
    		$map['rid'] = array('in',"{$rids}");
    	}
    	
   		if(!empty($data['category'])){
   			$category = D('Goods_category');
    		$category_map['id'] = array('in',"{$data['category']}");
    		$categorydata = getFieldAll($category->getChild($category_map),'child');
    		$cids = implode(',', $categorydata);
    		$map['cid'] = array('in',"{$cids}");
    	}
    	
    	if(!empty($data['promulgator'])){
    		$promulgator = intval($data['promulgator']);
    		$map['promulgator'] = array('eq',$promulgator);
    	}
    	 
    	if(!empty($data['recommend'])){
    		$recommend = intval($data['recommend']);
    		$recommendmodel = D('recommend');
    		$recommendmap['reviewer'] = array('eq',$recommend);
    		$map['id'] = array('in',$recommendmodel->getGather($recommendmap,'gid'));
    	}
		
        if(!empty($data['evaluate'])){
		    $evaluate = intval($data['evaluate']);
		    $evaluatemodel = D('Evaluate');
		    $evaluatemap['uid'] = array('eq',$evaluate);
    		$map['id'] = array('in',$evaluatemodel->getGather($evaluatemap,'gid'));
    	}
    	//默认必须加的
    	$map['audit'] = array('eq',0);
    	$map['status'] = array('eq',1);
    	return $map;
    }
    
}
?>