<?php
// 本文档自动生成，仅供测试运行
class UpgradeAction extends CommonAction
{
	
    public function check()
    {  
    	$id = intval($_REQUEST['id']);
    	if($id){
    		$task = S('upgrade_task');
    		$crrtask = $task['task_'.$id];
    		$path = PUBLIC_PATH.'upgrade/'.$crrtask['filename'];
    		$crrsize = filesize($path);
    		if($crrtask){
	    		$crrtask['downing'] = percentage($crrsize,$crrtask['size']);
	    		if($crrtask['downing'] == 100){
	    			unset($task['task_'.$id]);
	    			S('upgrade_task',$task);
	    		}
	    		$this->success($crrtask);
    		}else{
    			$this->error('操作错误');
    		}
    	}
    }
    
   	public function down(){
   		set_time_limit(0);
   		ignore_user_abort(true);
   		$lock = S('upgrade_start_lock');
   		if(!$lock){
   			$dir = PUBLIC_PATH.'upgrade/';
   			if(!file_exists($dir)){
   				@mkdir($dir,0777,true);
   			}
   			foreach (S('upgrade_task') as $value){
   				if($value['crrsize'] < $value['size']){
   					if($value['id']){
   						import("ORG.Net.Http");
		   				$data = array(
		   						'id'=>$value['id'],
		   						'os'=>2,
		   						'host'=>base64_encode($_SERVER['HTTP_HOST']),
		   				);
		   				$path = $dir.$value['filename'];
		   				$conf = array(
		   						'block'=>false,
		   						'filepath'=>$path,
		   						'post'=>http_build_query($data),
		   				);
		   				$url = 'http://upgrade.jvfnet.com/index.php/Upgrade/down';
		   				Http::fsockopen_download($url,$conf);
		   			}
   				}
   			}
   			S('upgrade_start_lock',null);
   		}
   	}
}
?>