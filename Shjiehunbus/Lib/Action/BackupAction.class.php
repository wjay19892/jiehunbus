<?php
// 后台用户模块
class BackupAction extends CommonAction {
	 private $path;
	 public function _initialize() {
		parent::_initialize();
		$this->path = PUBLIC_PATH.'database/';
		if(!is_dir($path))@mk_dir($this->path,0777);
	 }

	 public function index(){
	 	$filename = $_REQUEST['filename']?'*'.$_REQUEST['filename'].'*':'*';
		$data	=	glob($this->path.$filename);
		foreach ($data as $i=>$file){
			if(is_dir($file)){
				$dir[$i]['filename']    = basename($file);
				$dir[$i]['ctime']        = filectime($file);
				$tmp = glob($file.'/*');
				foreach ($tmp as $children){
					$dir[$i]['size'] += filesize($children);
					$dir[$i]['total']++;
				}
			}
		}		
		// 对结果排序
		usort($dir,'arrSort');
		$this->assign('list', $dir);
		$this->display();
	 }
	 
	 public function delete(){
	 	$data = Init_GP(array('ids'));
	 	$data['ids'] = explode(',', $data['ids']);
	 	if(!empty($data['ids'])){
	 		if(is_writable($this->path)){
	 			foreach ($data['ids'] as $filename){
		 			$file = $this->path.$filename.'/';
		 			deleteAll($file);
		 			@rmdir($file);
	 			}
	 			$this->success('删除成功');
	 		}else{
	 			$this->error('删除失败,无权限');
	 		}	 		
	 	}else{
	 		$this->error('删除失败');
	 	}
	 }
	 
	 public function backup(){
	 	$this->assign('table', D('Database')->getTableList());
	 	$this->display();
	 }
	 
	public function doBackUp() {
		$data = Init_GP(array('size','table','volume','filename','startform','tableid'));
		$sizelimit = GetNum($data['size']);
		if($sizelimit < 1){
			$this->error('分卷大小必填');
		}
		
		if(empty($data['table'])){
			$backup_table = S('backup_table');
			if($backup_table !== false){
				$tables = $backup_table;
			}else{
				$this->error('请选择备份的表');
			}
		}else{
			$tables	= $data['table'];
			S('backup_table',$tables);
		}
		
		// 当前卷号
		$volume		= $data['volume'] ? (GetNum($data['volume']) + 1) : 1;
		// 备份文件的文件夹
		if(empty($data['filename'])){
			$filename	= date('YmdHis');
		}else{
			$filename = $data['filename'];
		}
		
		$startfrom	= GetNum($data['startform']);
		$tableid	= GetNum($data['tableid']);
		$tablenum	= count($tables);
		$filesize	= $sizelimit*1024;
		$complete	= true;
		$tabledump	= '';
		
		for(; $complete && ($tableid < $tablenum) && strlen($tabledump)+500 < $filesize; $tableid++ ){
			
			$sqlDump = D('Database')->getTableSql($tables[$tableid], $startfrom, $filesize,strlen($tabledump),$complete);
			
			$tabledump .= $sqlDump['tabledump']; 
			$complete	= $sqlDump['complete'];
			$startfrom	= intval($sqlDump['startform']);
			if($complete)
				$startfrom = 0;
		}
		
		!$complete && $tableid--;
		
		if ( trim($tabledump) ) {
			$dir = $this->path.$filename.'/';
			if(!is_dir($dir))@mk_dir($dir,0777);
			$filepath = $dir.'/'.C('DB_NAME').'_'.$volume.'.sql';
			$fp = @fopen($filepath,'wb');
			
			if ( ! fwrite($fp,$tabledump) ) {
				$this->error('文件目录写入失败, 请检查Public/database/目录是否可写');
			}else {
				$url_param = array(
					'filename'		=> $filename,
					'size'		=> $sizelimit,
					'tableid'		=> $tableid,
					'startform'		=> $startfrom,
					'volume'		=> $volume,
					'navTabId'=>$_REQUEST['navTabId'],
				);
				$url = U('Backup/doBackUp', $url_param);
				$this->assign('jumpUrl',$url);
				$this->success("备份第{$volume}卷成功");
			}
		}else {
			S('backup_table',null);
			//$this->assign('navTabId',__MODULE__);
			//$this->assign('jumpUrl',1);
			$this->success("备份成功");
		}
	}
	
	public function import(){
		$data = Init_GP(array('folder','num'));
		$folder_arr = explode(',', $data['folder']);
		$data['folder'] = $folder_arr[0];
		if(empty($data['folder'])){
			$this->error('请选择文件名');
		}
		$num = $data['num']?$data['num']:1;
		
		$sqldump = '';
		$file = $this->path.$data['folder'].'/'.C('DB_NAME').'_'.$num.'.sql';
		
		if(file_exists($file)){
			$fp = @fopen($file,'rb');
			$sqldump = fread($fp,filesize($file));
			fclose($fp);
			$ret = D('Database')->import($sqldump);
			if($ret) {
				$num++;
				$file = $this->path.$data['folder'].'/'.C('DB_NAME').'_'.$num.'.sql';
				if(file_exists($file)){
					$name = $num-1;
					$name .= '卷';
					$url_param = array(
						'folder'		=> $data['folder'],
						'num'		=> $num,
					);
					$url = U('Backup/import', $url_param);
					$this->assign('jumpUrl',$url);
				}
				$this->success("导入{$name}成功");
			}else{
				$this->error('导入失败');
			}
		}else{
			$this->error('导入失败');
		}
	}
	
	public function package(){
		$data = Init_GP(array('folder'));
		$folder_arr = explode(',', $data['folder']);
		$data['folder'] = $folder_arr[0];
		if(strripos($data['folder'],'.') || strripos($data['folder'],'/')){
			$this->error('非法操作');
		}
		
		if(empty($data['folder'])){
			$this->error('请选择文件名');
		}
		$list	=	glob($this->path.$data['folder'].'/*');
		if(empty($list)){
			$this->error('操作错误');
		}
		foreach ($list as $i=>$file){
			$files[$i]    = basename($file);
		}
		import('ORG.Util.Zip');
		$zip = new Zip();
		$zip->addFiles($list,$files);
		$zip->output($data['folder'].".zip"); 
	}
	
}
?>