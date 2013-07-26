<?php
class AccountAction extends CommonAction {
	public function index(){
		//列表过滤器，生成查询Map对象
		
		$map = $this->_search ('Member');
		$this->_filter ( $map );
		$model = D ('Member');
		$this->_list ( $model, $map );
		$this->display ();
		return;
	}
	
	function edit() {
		$model = D('Member');
		$id = $_REQUEST [$model->getPk ()];
		$vo = $model->getById ( $id );
		$this->assign ( 'vo', $vo );
		$this->display ();
	}
	
	function update(){
		$data = Init_GP(array('id','field','type','val','content'));
		$id = intval($data['id']);
		if(empty($id))$this->error('ID不存在');
		if(empty($data['content']))$this->error('内容不存在');
		if($data['field'] == 'value'){
			$num = GetNum($data['val']);
		}else if($data['field'] == 'cash'){
			$num = toPrice($data['val']);
		}
		if($num <= 0)$this->error('值必须大于0');
		if($data['type'] == 'inc'){
			$fun = 'setInc';
			$val = $num;
		}else if($data['type'] == 'dec'){
			$fun = 'setDec';
			$val = -$num;
		}
		
		if($data['field'] == 'value'){
			$log = D('Value_log');
		}else if($data['field'] == 'cash'){
			$log = D('Cash_log');
		}
		
		$model = D('Member');
		$model->$fun("{$data['field']}","id={$id}",$num);
		$logdata = array(
			'uid'=>$id,
			'val'=>$val,
			'content'=>$data['content'],
			'addtime'=>toDate(time()),
		);
		$log->add($logdata);
		$this->success ('编辑成功!');
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