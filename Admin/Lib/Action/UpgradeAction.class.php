<?php
class UpgradeAction extends CommonAction {
  	
	public $crrtime = null;
	public $crrversion = null;
	public function _initialize(){
		parent::_initialize();
		$this->crrtime = @file_get_contents(PUBLIC_PATH.'upgrade.dat');
		$this->crrversion = @file_get_contents(PUBLIC_PATH.'version.dat');
		$this->assign('crrtime',$this->crrtime);
		$this->assign('crrversion',$this->crrversion);
	}
	
	public function index(){
		$this->display();
	}
	
	public function getList(){
		$list = $this->_getUpgrade();
		$dir = PUBLIC_PATH.'upgrade/';
		if($list){
			foreach($list as &$value){
				$file_path = $dir.$value['filename'];
				$crrsize = filesize($file_path);
				if(file_exists($file_path) && $crrsize == $value['size']){
					$value['downstatus'] = 1;
				}else{
					$task = S('upgrade_task');
					$crrtask = $task['task_'.$value['id']];
					if(!empty($crrtask)){
						$value['downstatus'] = 2;
						$value['downing'] = percentage($crrsize,$crrtask['size']);
					}else{
						$value['downstatus'] = 0;
					}
				}
			}
			$this->assign('list',$list);
		}
		$result = $this->fetch();
		$this->success($result);
	}
	
	public function explain(){
		$id = intval($_REQUEST['id']);
		$val = $this->_findUpgrade($id);
		if($val){
			$this->assign('content',$val['explain']);
		}
		$this->display();
	}
	
	public function execution(){
		$id = intval($_REQUEST['id']);
		if(!$id){
			$this->error('操作错误');
		}
		$value = $this->_findUpgrade($id);
		if(empty($value)){
			$this->error('操作错误');
		}
		$root_path = ROOT_PATH.'/';
		if(!is_writable($root_path)){
			$this->error('根目录不可写，升级时请先开启根目录写权限');
		}
		$dir = PUBLIC_PATH.'upgrade/';
		$filepath = $dir.$value['filename'];
		$arr = explode('.', $value['filename']);
		$dir = $dir.$arr[0].'/';
		if(file_exists($dir)){
			$folder = $dir.'/upgrade/';
			if(file_exists($folder)){
				//执行更新文件
				copyDir($folder, $root_path);
			}
			$sqlfile = $dir.'/upgrade.sql';
			if(file_exists($sqlfile)){
				//执行sql文件
				$sql = @file_get_contents($sqlfile);
				$ret = D('Database')->import($sql);
			}
			$executefile = $dir.'/execute.php';
			if(file_exists($executefile)){
				//执行执行文件用于操作修改文件名等
				include_once($executefile);
			}
		}
		$this->_delList($id);
		$this->success('升级成功');
	}
	
	public function down(){
		$id = intval($_REQUEST['id']);
		$val = $this->_findUpgrade($id);
		if($val){
			$task = S('upgrade_task');
			$task['task_'.$id] = array(
						'crrsize'=>0,
						'size' => $val['size'],
						'filename'=>$val['filename'],
						'id'=>$val['id'],
			);
			S('upgrade_task',$task);
			$lock = S('upgrade_start_lock');
			if(!$lock){
				import("ORG.Net.Http");
				$conf = array(
						'block'=>false,
						'read'=>false,
				);
				$url = HOST.U('Thread://Upgrade/down');
				Http::fsockopen_download($url,$conf);
			}
			$this->success('操作成功');
		}else{
			$this->error('操作错误');
		}
	}
	public function installation(){
		$id = intval($_REQUEST['id']);
		if(!$id){
			$this->error('操作错误');
		}
		$value = $this->_findUpgrade($id);
		if($this->crrversion != $value['version']){
			$this->assign('error','安装错误,不适用当前版本');
		}else{
			$arr = explode('.', $value['filename']);
			$dir = PUBLIC_PATH.'upgrade/'.$arr[0].'/';
			if(file_exists($dir)){
				$unzip = true;
			}else{
				$unzip = false;
			}
			$this->assign('data',$value);
			$this->assign('unzip',$unzip);
		}
		$this->display();
	}
	
	public function checkFiles(){
		$modified = getModified();
		$this->assign('list',$modified);
		$this->display();
	}
	
	public function agreement(){
		$this->display();
	}
	
	public function unzip(){
		set_time_limit(0);
		$id = intval($_REQUEST['id']);
		if(!$id){
			$this->error('操作错误');
		}
		$value = $this->_findUpgrade($id);
		if(empty($value)){
			$this->error('操作错误');
		}
		$dir = PUBLIC_PATH.'upgrade/';
		$filepath = $dir.$value['filename'];
		$arr = explode('.', $value['filename']);
		$todir = $dir.$arr[0].'/';
		import("ORG.Util.Zip");
		$zip = new Zip();
		$return = $zip->Extract($filepath, $todir);
		if($return == -1){
			$this->error('解压失败');
		}else{
			$this->success('解压成功');
		}
	}
	
	protected function _findUpgrade($id){
		$list = $this->_getUpgrade();
		if($list){
			foreach ($list as $val){
				if($val['id'] = $id){
					return $val;
				}
			}
		}
		return false;
	}
	
	protected function _getUpgrade(){
		$upgrade_time = S('upgrade_time');
		if(!empty($upgrade_time) && time() - $upgrade_time < 1200){
			return S('upgrade_list');
		}else{
			$list = $this->_getList();
			if($list['status'] == 1){
				return $list['info'];
			}else{
				$this->assign('error',$list['info']);
			}
		}
		return false;
	}
	
	protected function _getList(){
		import("ORG.Net.Http");
		$data = array(
				'host'=>base64_encode($_SERVER['HTTP_HOST']),
				'os'=>2,
				'update_time'=>$this->crrtime,
		);
		$conf = array(
				'block'=>false,
				'timeout'=>10,
				'post'=>http_build_query($data),
		);
		$url = 'http://upgrade.jvfnet.com/index.php/Upgrade/getList';
		$json = Http::fsockopen_download($url,$conf);
		if(empty($json)){
			$list['status'] = 0;
			$list['info'] = '网络连接错误';
		}else{
			$list = json_decode($json,true);
			if($list['status'] == 1){
				S('upgrade_list',$list['info']);
				S('upgrade_time',time());
			}
		}
		return $list;
	}
	
	protected function _delList($id){
		$list = S('upgrade_list');
		if($list){
			foreach ($list as $key=>$val){
				if($val['id'] = $id){
					unset($list[$key]);
				}
			}
		}
		S('upgrade_list',$list);
	}
}
?>