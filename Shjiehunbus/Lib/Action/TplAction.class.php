<?php
class TplAction extends CommonAction{
	// 框架首页
	public function index() {
		$configpath = ROOT_PATH.'/Index/Conf/config.php';
		$configpath = realpath($configpath);
		$configcontent = file_get_contents($configpath);
		preg_match('/\'DEFAULT_THEME\'=>\'(.*?)\',/iUs',$configcontent,$reg);
		if(empty($reg[1])){
			$currtpl = 'default';
		}else{
			$currtpl = $reg[1];
		}
		

		$tplpath = ROOT_PATH.'/Index/Tpl/';
		$tplpath = realpath($tplpath);
		$arr = scandir($tplpath);
		$this->assign('currtpl',$currtpl);
		$this->assign('arr',$arr);
		$this->display();
	}

	public function save(){
		$data = Init_GP(array('tpl'));
		$configpath = ROOT_PATH.'/Index/Conf/config.php';
		$configpath = realpath($configpath);
		$configcontent = file_get_contents($configpath);
		$configcontent = preg_replace('/\'DEFAULT_THEME\'=>\'(.*?)\',/iUs',"'DEFAULT_THEME'=>'{$data['tpl']}',",$configcontent);
		@file_put_contents($configpath, $configcontent);
		$this->success('更改模板成功，请清空缓存！');
	}
}
?>