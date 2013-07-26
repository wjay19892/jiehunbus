<?php
class Sysconf_listAction extends CommonAction {
    /**
     +----------------------------------------------------------
     * 默认排序操作
     +----------------------------------------------------------
     * @access public
     +----------------------------------------------------------
     * @return void
     +----------------------------------------------------------
     * @throws FcsException
     +----------------------------------------------------------
     */
	public function _before_index() {
		$model	=	D("Sysconf_group");
		$list	=	$model->where('status=1')->order('sort desc,id asc')->getField('id,name');
		$this->assign('sysconf_grouplist',$list);
	}
	public function index(){
	    $model	=	D("Sysconf");
		$list =  $model->where("status=1 and group_id>0 and is_show = 1")->order('sort desc,id asc')->findAll();
		
		$Sysconf_group	=	D("Sysconf_group");
		$groupsort = $Sysconf_group->where('status=1')->order('sort desc,id asc')->getField('id,name');
		$conf_list = array(); //用于输出分组格式化后的数组
		foreach($groupsort as $key=>$val){
		   $conf_list[$key] = array();
		}
		foreach($list as $k=>$v){
			$v['val_arr'] = explode(",",$v['val_arr']);
			$conf_list[$v['group_id']][$k] = $v;
		}	
		//ksort($conf_list);
		$this->assign("conf_list",$conf_list);
		$this->display();
	}
	public function save(){
		$data = $_POST;

		$accessory = D('Accessory');
		$upload_list = $accessory->imgUpload(0,"site");
		if($upload_list)
		{
			foreach($upload_list as $upload_item)
			{
				if($upload_item['key']=="site_logo"){
					$data['site_logo'] = $upload_item['recpath'].$upload_item['savename'];
				}elseif($upload_item['key']=="site_water_image"){
					$data['site_water_image'] = $upload_item['recpath'].$upload_item['savename'];
				}elseif($upload_item['key']=="site_mb_bigavatar"){
					$data['site_mb_bigavatar'] = $upload_item['recpath'].$upload_item['savename'];
				}elseif($upload_item['key']=="site_mb_smallavatar"){
					$data['site_mb_smallavatar'] = $upload_item['recpath'].$upload_item['savename'];
				}elseif($upload_item['key']=="site_wap_logo"){
					$data['site_wap_logo'] = $upload_item['recpath'].$upload_item['savename'];
				}else{
				   $key = $upload_item['key'];
				   $data[$key] = $upload_item['recpath'].$upload_item['savename'];
				}
			}
		}
		$config = D('Sysconf');
		foreach ($data as $key=>$val){
			if($key!="__hash__" && $key!="ajax"){
				$key = Char_cv($key);
				$val = $val;
				$where['key']=$key;
				$value['val']=$val;
				$info = $config->where($where)->save($value);
			}
		}
		unset($data);
		$model	=	D("Sysconf");
		$list =  $model->where("status=1 and group_id>0 and is_show = 1")->order('group_id asc,sort desc,id asc')->findAll();
		
		$file = ROOT_PATH."/Common/sysconfig.php";
		if(!is_writeable($file))
		{
			$this->error("配置文件'{$file}'不支持写入，无法修改系统配置参数！");
		}
		$content = "<?php\n";
		$content .= "return array(\n";
		
		foreach ($list as $k=>$value){
		        $key = $value['key'];
				$val = $value['val'];
				if($key == 'site_tongji'){
					$val = addslashes($val);
				}
				$content .= "\t'$key'=>'$val',\n";
		}
		$content .= ");\n";
		$content .= "\n?>";
		unset($list);
		$return = @file_put_contents($file,$content);
		if ($config->error == null && $return != 0){
		    $public = A('Public');
			$public->cacheClear();
			$this->success('修改系统配置成功');
		}else{
			$this->error($config->getError());
		}
	}
	

}
?>