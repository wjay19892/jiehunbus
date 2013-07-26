<?php
// 本文档自动生成，仅供测试运行
class IndexAction extends CommonAction
{
	public $memberinfo = null;
	function _initialize() {
		//公用函数
		//parent::_initialize();
		$this->_islogin();
		if(empty($this->memberinfo)){
			$this->error('您尚未登录',true);
		}
	}
	
    public function index()
    {  
       ignore_user_abort(true);
       $key = "Member_{$this->memberinfo['id']}";
       $n = 0;
       $para = md5(microtime(true));
       $this->setOnline();
	   do{
		   $data = S($key);
		   if(!empty($data['login'])){
		   		$data[$para] = $data['login'];
		   		unset($data['login']);
		   }
		   if($data[$para] == null){
		   	  $data[$para] = array();
		   }
		   S($key,$data);
		   if(empty($data[$para]) && !connection_aborted()){
			   sleep(1);
		   }else{
		   	   break;
		   }
		   $n++;
	   }while($n < 25);
	   
	   foreach ($data[$para] as &$value){
   	   		$arr[] = $value['id'];
   	   		$value['addtime'] = toDate($value['addtime']);
   	   		$value['content'] = contentFilter($value['content']);
   	   }
   	   $ids = implode(',', $arr);
   	   if(!empty($ids)){
	   	   $chat_log = D('Chat_log');
	   	   $prefix = C('DB_PREFIX');
	   	   $chat_log->query("UPDATE `{$prefix}chat_log` SET `mark` = '1' WHERE `id` in({$ids})");
   	   }
   	   $result = $data[$para];
   	   unset($data[$para]);
   	   S($key,$data);
	   $this->ajaxReturn($result);
    }
    
    protected function setOnline(){
    	$online = S('online');
		$online["{$this->memberinfo['id']}"] = time();
		S('online',$online);
    }
}
?>