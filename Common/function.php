<?php
// +----------------------------------------------------------------------
// | ThinkPHP
// +----------------------------------------------------------------------
// | Copyright (c) 2007 http://thinkphp.cn All rights reserved.
// +----------------------------------------------------------------------
// | Licensed ( http://www.apache.org/licenses/LICENSE-2.0 )
// +----------------------------------------------------------------------
// | Author: liu21st <liu21st@gmail.com>
// +----------------------------------------------------------------------
// $Id$

//公共函数
function toDate($time, $format = 'Y-m-d H:i:s') {
	if (empty ( $time )) {
		return '';
	}
	$format = str_replace ( '#', ':', $format );
	return date ($format, $time );
}

function toDateYmd($time, $format = 'Y-m-d') {
	if (empty ( $time )) {
		return '';
	}
	$format = str_replace ( '#', ':', $format );
	return date ($format, $time );
}
//时期时间格式化
function dgmdate($timestamp, $format = 'Y-m-d H:i:s', $uformat = true) {
	if($uformat) {
		$todaytimestamp = time() - 86400;
		$s = date($format, $timestamp);
		$time = time() - $timestamp;
		if($timestamp >= $todaytimestamp) {
			if($time > 3600) {
				return '<span title="'.$s.'">'.intval($time / 3600).'&nbsp;'.L('hours_before').'</span>';
			} elseif($time > 1800) {
				return '<span title="'.$s.'">'.L('half_hour_before').'</span>';
			} elseif($time > 60) {
				return '<span title="'.$s.'">'.intval($time / 60).'&nbsp;'.L('minutes_before').'</span>';
			} elseif($time > 0) {
				return '<span title="'.$s.'">'.$time.'&nbsp;'.L('seconds_before').'</span>';
			} elseif($time == 0) {
				return '<span title="'.$s.'">'.L('just_now').'</span>';
			} else {
				return $s;
			}
		} elseif(($days = intval(($todaytimestamp - $timestamp) / 86400)) >= 0 && $days < 7) {
			if($days == 0) {
				return '<span title="'.$s.'">'.L('f_yesterday').'&nbsp;'.gmdate($format, $timestamp).'</span>';
			} elseif($days == 1) {
				return '<span title="'.$s.'">'.L('before_yesterday').'&nbsp;'.gmdate($format, $timestamp).'</span>';
			} else {
				return '<span title="'.$s.'">'.($days + 1).'&nbsp;'.L('days_before').'</span>';
			}
		} else {
			return $s;
		}
	} else {
		return date($format, $timestamp);
	}
}
// 缓存文件
function cmssavecache($name = '', $fields = '') {
	$Model = D ( $name );
	$list = $Model->select ();
	$data = array ();
	foreach ( $list as $key => $val ) {
		if (empty ( $fields )) {
			$data [$val [$Model->getPk ()]] = $val;
		} else {
			// 获取需要的字段
			if (is_string ( $fields )) {
				$fields = explode ( ',', $fields );
			}
			if (count ( $fields ) == 1) {
				$data [$val [$Model->getPk ()]] = $val [$fields [0]];
			} else {
				foreach ( $fields as $field ) {
					$data [$val [$Model->getPk ()]] [] = $val [$field];
				}
			}
		}
	}
	$savefile = cmsgetcache ( $name );
	// 所有参数统一为大写
	$content = "<?php\nreturn " . var_export ( array_change_key_case ( $data, CASE_UPPER ), true ) . ";\n?>";
	file_put_contents ( $savefile, $content );
}

function cmsgetcache($name = '') {
	return DATA_PATH . '~' . strtolower ( $name ) . '.php';
}
function getStatus($status, $imageShow = true) {
	switch ($status) {
		case 0 :
			$showText = '禁用';
			$showImg = '<IMG SRC="' . WEB_PUBLIC_PATH . '/Images/locked.gif" WIDTH="20" HEIGHT="20" BORDER="0" ALT="禁用">';
			break;
		case 2 :
			$showText = '待审';
			$showImg = '<IMG SRC="' . WEB_PUBLIC_PATH . '/Images/prected.gif" WIDTH="20" HEIGHT="20" BORDER="0" ALT="待审">';
			break;
		case - 1 :
			$showText = '删除';
			$showImg = '<IMG SRC="' . WEB_PUBLIC_PATH . '/Images/del.gif" WIDTH="20" HEIGHT="20" BORDER="0" ALT="删除">';
			break;
		case 1 :
		default :
			$showText = '正常';
			$showImg = '<IMG SRC="' . WEB_PUBLIC_PATH . '/Images/ok.gif" WIDTH="20" HEIGHT="20" BORDER="0" ALT="正常">';

	}
	return ($imageShow === true) ?  $showImg  : $showText;

}

function getOrderStatus($status) {
	switch ($status) {
		case 0 :
			$showText = '未支付';
			break;
		case 1 :
			$showText = '已支付';
			break;
		case 2 :
			$showText = '已作废';
			break;
		case 3 :
			$showText = '已删除';
			break;
		default :
			$showText = '状态未知';

	}
	return $showText;
}

function getRefundStatus($status) {
	switch ($status) {
		case 0 :
			$showText = '未申请';
			break;
		case 1 :
			$showText = '审核中';
			break;
		case 2 :
			$showText = '已退款';
			break;
		case 3 :
			$showText = '已失败';
			break;
		default :
			$showText = '状态未知';

	}
	return $showText;
}

function getPayStatus($status) {
	switch ($status) {
		case 0 :
			$showText = '未支付';
			break;
		case 1 :
			$showText = '部分支付';
			break;
		case 2 :
			$showText = '全部支付';
			break;
		case 3 :
			$showText = '部分退款';
			break;
		case 4 :
			$showText = '全部退款';
			break;
		default :
			$showText = '状态未知';

	}
	return $showText;
}

function getCouponstatus($status) {
	switch ($status) {
		case 0 :
			$showText = '未消费';
			break;
		case 1 :
			$showText = '已消费';
			break;
		case 2 :
			$showText = '已冻结';
			break;
		default :
			$showText = '状态未知';

	}
	return $showText;
}

function getDefaultStyle($style) {
	if (empty ( $style )) {
		return 'blue';
	} else {
		return $style;
	}
}
function IP($ip = '', $file) {
	if(empty($file)){
		$file = OTHER.'qqwry.dat';
	}
	
	$_ip = array ();
	if (isset ( $_ip [$ip] )) {
		return $_ip [$ip];
	} else {
		import ( "ORG.Net.IpLocation" );
		$iplocation = new IpLocation ( $file );
		$location = $iplocation->getlocation ( $ip );
		$_ip [$ip] = iconv('GB2312', 'UTF-8//IGNORE', $location ['country'] . $location ['area']);
	}
	return $_ip [$ip];
}


function getCrrLatlng(){
	$locate = cookie('locate');
	$locate = json_decode($locate,true);
	return $locate;
}

function setCrrLatlng($latlng = array()){
	if(!empty($latlng)){
		cookie('locate',json_encode($latlng),259200);
	}
}

function getNodeName($id) {
	if (Session::is_set ( 'nodeNameList' )) {
		$name = Session::get ( 'nodeNameList' );
		return $name [$id];
	}
	$Group = D ( "Node" );
	$list = $Group->getField ( 'id,name' );
	$name = $list [$id];
	Session::set ( 'nodeNameList', $list );
	return $name;
}

function getParent($action_name,$id,$field = 'name') {
	/*$parent = S('parent');
	if(isset($parent[$action_name][$id][$field])){
		return $parent[$action_name][$id][$field];
	}*/
	$model = D ( $action_name );
	if(empty($id)){
		$name = '无';
	}else{
		$list = $model->find($id);
		$name = $list [$field];
		$name = $name?$name:'无';
	}

	/*$parent[$action_name][$id][$field] = $name;
	S('parent',$parent);*/
	return $name;
}

function get_pawn($pawn) {
	if ($pawn == 0)
		return "<span style='color:green'>没有</span>";
	else
		return "<span style='color:red'>有</span>";
}
function get_patent($patent) {
	if ($patent == 0)
		return "<span style='color:green'>没有</span>";
	else
		return "<span style='color:red'>有</span>";
}


function getNodeGroupName($id) {
	if (empty ( $id )) {
		return '未分组';
	}
	$nodeGroupList = S('nodeGroupList');
	if (isset ( $nodeGroupList[$id] )) {
		return $nodeGroupList[$id];
	}
	$Group = D ( "Group" );
	$list = $Group->getField ( 'id,title' );
	S('nodeGroupList',$list);
	$name = $list [$id];
	return $name;
}


function getGroups_navName($id) {
	if (empty ( $id )) {
		return '未分配';
	}
	$groups_navList = S('Groups_navList');
	if (isset ( $Groups_navList[$id] )) {
		return $groups_navList[$id];
	}
	$Groups_nav = D ( "Groups_nav" );
	$list = $Groups_nav->getField ( 'id,name' );
	S('Groups_navList',$list);
	$name = $list [$id];
	return $name;
}

function getSysconf_groupName($id) {
	if (empty ( $id )) {
		return '未分组';
	}
	$sysconf_groupList = S('Sysconf_groupList');
	if (isset ($sysconf_groupList[$id])) {
		return $sysconf_groupList[$id];
	}
	$Sysconf_group = D ( "Sysconf_group" );
	$list = $Sysconf_group->getField ( 'id,name' );
	S('Sysconf_groupList',$list);
	$name = $list[$id];
	return $name;
}
function getAdv_posName($id) {
	if (empty ( $id )) {
		return '未选择';
	}
	$adv_posList = S('Adv_posList');
	if (isset ( $adv_posList[$id] )) {
		return $adv_posList[$id];
	}
	$Advertising_position= D ( "Advertising_position" );
	$list = $Advertising_position->getField ( 'id,name' );
	S('Adv_posList',$list);
	$name = $list [$id];
	return $name;
}

function getCardStatus($status) {
	switch ($status) {
		case 0 :
			$show = '未启用';
			break;
		case 1 :
			$show = '已启用';
			break;
		case 2 :
			$show = '使用中';
			break;
		case 3 :
			$show = '已禁用';
			break;
		case 4 :
			$show = '已作废';
			break;
	}
	return $show;

}
function getLinktype($type) {
	switch ($type) {
		case 1 :
			$showText = '图片';
			break;
		case 0 :
		default :
			$showText = '文本';

	}
	return $showText;

}
function getAdvtype($type) {
	switch ($type) {
		case 2 :
			$showText = 'Flash广告';
			break;
		case 3 :
			$showText = '自定义代码广告';
			break;
		case 1 :
		default :
			$showText = '图片广告';

	}
	return $showText;

}
function getExtendtype($type) {
	switch ($type) {
		case 1 :
			$showText = '单选框';
			break;
		case 2 :
			$showText = '下拉框';
			break;
		case 3 :
			$showText = '多行文本框';
			break;
		case 4 :
			$showText = '多选框';
			break;
		case 5 :
			$showText = '图片';
			break;
		case 6 :
			$showText = '日历控件';
			break;
		case 7 :
			$showText = '编辑器';
			break;
		case 0 :
		default :
			$showText = '单行文本框';

	}
	return $showText;

}

function getNavLocal($type) {
	switch ($type) {
		case 1 :
			$showText = '主菜单';
			break;
		case 2 :
			$showText = '顶部菜单';
			break;
		case 3 :
			$showText = '底部菜单';
			break;
		default :
			$showText = '无';

	}
	return $showText;

}

function getWhether($type) {
	switch ($type) {
		case 0 :
			$showText = '否';
			break;
		case 1 :
			$showText = '是';
			break;
		default :
			$showText = '无';

	}
	return $showText;
}

function getWithdraw($type) {
	switch ($type) {
		case 0 :
			$showText = '未处理';
			break;
		case 1 :
			$showText = '处理中';
			break;
		case 2 :
			$showText = '已处理';
			break;
		case 3 :
			$showText = '已撤销';
			break;
		default :
			$showText = '未处理';

	}
	return $showText;

}

function getMessageType($type) {
	switch ($type) {
		case 0 :
			$showText = '普通';
			break;
		case 1 :
			$showText = '通知';
			break;
		default :
			$showText = '无';

	}
	return $showText;

}

function getMessageMark($type) {
	switch ($type) {
		case 0 :
			$showText = '未读';
			break;
		case 1 :
			$showText = '已读';
			break;
		default :
			$showText = '无';

	}
	return $showText;

}

//获取验证状态
function getCheckStatus($type) {
	switch ($type) {
		case 0 :
			$showText = '未验证';
			break;
		case 1 :
			$showText = '已验证';
			break;
		default :
			$showText = '无';

	}
	return $showText;
}


function showStatus($status, $id, $callback="") {
	switch ($status) {
		case 0 :
			$info = '<a href="__URL__/resume/id/' . $id . '/navTabId/__MODULE__" target="ajaxTodo" callback="'.$callback.'">恢复</a>';
			break;
		case 2 :
			$info = '<a href="__URL__/checkPass/id/' . $id . '/navTabId/__MODULE__" target="ajaxTodo" callback="'.$callback.'">批准</a>';
			break;
		case 1 :
			$info = '<a href="__URL__/forbid/id/' . $id . '/navTabId/__MODULE__" target="ajaxTodo" callback="'.$callback.'">禁用</a>';
			break;
		case - 1 :
			$info = '<a href="__URL__/recycle/id/' . $id . '/navTabId/__MODULE__" target="ajaxTodo" callback="'.$callback.'">还原</a>';
			break;
	}
	return $info;
}


function getGroupName($id) {
	if ($id == 0) {
		return '无上级组';
	}
	if ($list = F ( 'groupName' )) {
		return $list [$id];
	}
	$dao = D ( "Role" );
	$list = $dao->findAll ( array ('field' => 'id,name' ) );
	foreach ( $list as $vo ) {
		$nameList [$vo ['id']] = $vo ['name'];
	}
	$name = $nameList [$id];
	F ( 'groupName', $nameList );
	return $name;
}

function sort_by($array, $keyname = null, $sortby = 'asc') {
	$myarray = $inarray = array ();
	# First store the keyvalues in a seperate array
	foreach ( $array as $i => $befree ) {
		$myarray [$i] = $array [$i] [$keyname];
	}
	# Sort the new array by
	switch ($sortby) {
		case 'asc' :
			# Sort an array and maintain index association...
			asort ( $myarray );
			break;
		case 'desc' :
		case 'arsort' :
			# Sort an array in reverse order and maintain index association
			arsort ( $myarray );
			break;
		case 'natcasesor' :
			# Sort an array using a case insensitive "natural order" algorithm
			natcasesort ( $myarray );
			break;
	}
	# Rebuild the old array
	foreach ( $myarray as $key => $befree ) {
		$inarray [] = $array [$key];
	}
	return $inarray;
}


function pwdHash($password, $type = 'md5') {
	return hash ( $type, $password );
}

/* zhanghuihua */
function percent_format($number, $decimals=0) {
	return number_format($number*100, $decimals).'%';
}
/**
 * 动态获取数据库信息
 * @param $tname 表名
 * @param $where 搜索条件
 * @param $order 排序条件 如："id desc";
 * @param $count 取前几条数据 
 */
function findList($tname,$where="", $order, $count){
	$m = M($tname);
	if(!empty($where)){
		$m->where($where);
	}
	if(!empty($order)){
		$m->order($order);
	}
	if($count>0){
		$m->limit($count);
	}
	return $m->select();
}

function findById($name,$id){
	$m = M($name);
	return $m->find($id);
}

function attrById($name, $attr, $id){
	$m = M($name);
	$a = $m->where('id='.$id)->getField($attr);
	return $a;
}

function deleteAll($dir){
	$dh=opendir($dir);
	while ($file=readdir($dh)) {
		if($file!="." && $file!="..") {
			$fullpath=$dir."/".$file;
			if(!is_dir($fullpath)) {
				@unlink($fullpath);
			} else {
				deleteAll($fullpath);
				@rmdir($fullpath);
			}
		}
	}
	closedir($dh);
}

function Char_cv($msg){
	if(is_array($msg)){
		foreach ($msg as $a=>$b){
			$msg[$a] = Char_cv($b);
		}
	}
	$msg = str_replace('%20','',$msg);
	$msg = str_replace('%27','',$msg);
	$msg = str_replace('*','',$msg);
	$msg = str_replace("\"",'',$msg);
	$msg = str_replace("`",'',$msg);
	//$msg = str_replace('//','',$msg);
	$msg = str_replace('&amp;','&',$msg);
	$msg = str_replace('&nbsp;',' ',$msg);
	$msg = str_replace(';','',$msg);
	$msg = str_replace('"','&quot;',$msg);
	$msg = str_replace("'",'&#039;',$msg);
	$msg = str_replace("<","&lt;",$msg);
	$msg = str_replace(">","&gt;",$msg);
	$msg = str_replace('(','',$msg);
	$msg = str_replace(')','',$msg);
	$msg = str_replace("{",'',$msg);
	$msg = str_replace('}','',$msg);
	$msg = str_replace("\t","   &nbsp;  &nbsp;",$msg);
	$msg = str_replace("\r","",$msg);
	//$msg = str_replace("\n",'<br/>',$msg);
	$msg = str_replace("   "," &nbsp; ",$msg);
	$msg = str_replace("，",",",$msg);
	
	return $msg;
}

/**
 * 批量初始化POST or GET变量,并数组返回
 *
 * @param Array $keys
 * @param string $method
 * @param var $htmcv
 * @return Array
 */
function Init_GP($keys,$method='GP',$htmcv=1){
	!is_array($keys) && $keys = array($keys);
	$array = array();
	foreach($keys as $val){
		$array[$val] = NULL;
		if($method!='P' && isset($_GET[$val])){
			$array[$val] = $_GET[$val];
		} elseif($method!='G' && isset($_POST[$val])){
			$array[$val] = $_POST[$val];
		}
		$htmcv && $array[$val] = Char_cv($array[$val]);
	}
	return $array;
}

/**
 * 批量初始化POST or GET变量,并将变量全局化
 *
 * @param Array $keys
 * @param string $method
 * @param var $htmcv
 */
function InitGP($keys,$method='GP',$htmcv=0){
	!is_array($keys) && $keys = array($keys);
	foreach($keys as $val){
		$GLOBALS[$val] = NULL;
		if($method!='P' && isset($_GET[$val])){
			$GLOBALS[$val] = $_GET[$val];
		} elseif($method!='G' && isset($_POST[$val])){
			$GLOBALS[$val] = $_POST[$val];
		}
		$htmcv && $GLOBALS[$val] = Char_cv($GLOBALS[$val]);
	}
}

//处理数字类型字符
function GetNum($fnum)
{
	$nums = array("０","１","２","３","４","５","６","７","８","９");
	//$fnums = "0123456789";
	$fnums = array("0","1","2","3","4","5","6","7","8","9");
	$fnum = str_replace($nums,$fnums,$fnum);
	$fnum = ereg_replace("[^0-9\.-]",'',$fnum);
	if($fnum=='')
	{
		$fnum=0;
	}
	return $fnum;
}

function formatsize($fileSize) {
	$size = sprintf("%u", $fileSize);
	if($size == 0) {
		return("0 Bytes");
	}
	$sizename = array(" Bytes", " KB", " MB", " GB", " TB", " PB", " EB", " ZB", " YB");
	return round($size/pow(1024, ($i = floor(log($size, 1024)))), 2) . $sizename[$i];
}

/**
 * 去一个二维数组中的每个数组的固定的键知道的值来形成一个新的一维数组
 * @param $pArray 一个二维数组
 * @param $pKey 数组的键的名称
 * @return 返回新的一维数组
 */
function getSubByKey($pArray, $pKey="", $pCondition=""){
    $result = array();
	foreach($pArray as $temp_array){
        if(is_object($temp_array)){
        	$temp_array = (array) $temp_array;
        }
		if((""!=$pCondition && $temp_array[$pCondition[0]]==$pCondition[1]) || ""==$pCondition) {
        	$result[] = (""==$pKey) ? $temp_array : isset($temp_array[$pKey]) ? $temp_array[$pKey] : "";
    	}
    }
	return $result;
}

function arrSort($a,$b){
		 if($_REQUEST['_sort'] == 'asc'){
		 	$sort = 1;
		 }else{
		 	$sort = -1;
		 }
		 
		 if(empty($_REQUEST['_order'])){
		 	$order = $_REQUEST['_order'];
		 }else{
		 	$order = 'ctime';
		 }
		 
		 $k  =  $order;
		if($a[$k]  ==  $b[$k]){
			return 0;
		}elseif($a[$k]>$b[$k]){
			return $sort;
		}else{
			return -$sort;
		}
 }
 
 function sendMail($address,$header,$body){
	 if(!C('sysconfig.site_mail_on')){
	 	return false;
	 }
	 S('sendMail',1);
	 import("ORG.Net.Http");
	 $data = array(
	 	'address'=>$address,
	 	'header'=>$header,
	 	'body'=>$body,
	 );

	 $conf = array(
		'block'=>false,
		'read'=>false,
		'post'=>http_build_query($data),
	 );
	 $url = HOST.U('Send/sendMail');
	 Http::fsockopen_download($url,$conf);
	 return true;
 }
 
 //$time 为时间格式数组
 /*$data 数据格式为数据库读取出的格式
  *$keynames 格式是数组
  *$keynames = array(
  *		'title'=>'标题',
  *		'num'=>array('数量','num'),
  *		'time'=>array('时间','','函数例如：toDate'),
  *		'state'=>array('状态','','',array(0=>'未开启',1=>'开启')),
  *);
  * 
  * */
function exportExcel($data, $keynames, $name='down') {
	//$xlsdata[] = array_values($keynames);
	import("ORG.Util.Excel");
	$xls = new Excel();
	foreach($keynames as $val){
		if(is_array($val)){
			$title[] = $val[0];
		}else{
			$title[] = $val;
		}
	}
	$xls->addRow($title);
	foreach($data as $o) {
		$line = array();
		foreach($keynames as $k=>$v) {
			if(is_array($v)){
				$type = $v[1]?$v[1]:'str';
				$val = $v[2]?$v[2]($o[$k]):$o[$k];
				if(is_array($v[3])){
					$val = $v[3][$val]?$v[3][$val]:$val;
				}
			}else{
				$val = $o[$k];
				$type = 'str';
			}
			$line[] = array($val,$type);
			unset($val);
			unset($type);
		}
		$xls->addRow($line);
		unset($line);
	}
	$xls->generateXML ($name);
}
/**
 * 显示指定英文标示的广告位
 * @param string $tagname 广告位标示
 * @param string $htag html标签，如div,li,td等，
 */
function showAdvPosition($tagname,$htag="")
{
	if(!$tagname){
		return '';
	}
	$advertising_position = D('Advertising_position');
	$advertising = D('Advertising');
	$adv_postmap['tagname'] = array('eq',$tagname);
	$ap= $advertising_position->where($adv_postmap)->find();
	
	$now=time();
	$advmap['status'] = array('eq',1);
	$advmap['position_id'] = array('eq',$ap['id']);
	$advmap['_string'] = "((adv_start_time <='".$now."' and adv_end_time >='".$now."') or (adv_start_time =0 and adv_end_time = 0 ) or (adv_start_time <='".$now."' and adv_end_time = 0 ) or (adv_start_time =0 and adv_end_time >='".$now."' ))";
	
	$adv_list = $advertising->where($advmap)->order('sort desc,id asc')->findAll();
	foreach($adv_list as $key => $adv){
		$adv_list[$key]['html']= getAdvHTML($adv,$ap);
	}

	$ap['adv_list'] = $adv_list;
	if ($ap ['is_flash'] == 1 && ! empty ( $ap ['flash_style'] )) {
		$adv_path =  HTTP_URL."/Public/adflash/" . $ap ['flash_style'] . ".swf";
		$adv_pics = "";
		$adv_texts = "";
		$adv_links = "";
		
		foreach ( $ap ['adv_list'] as $adv ) {
			if (empty ( $adv_pics ))
				$jg = "";
			else
				$jg = "|";
			
			$adv_pics .= $jg . __ROOT__ . $adv ['code'];
			$adv_texts .= $jg . $adv ['desc'];
			$adv_links .= $jg . $adv ['url'];
			
		}
		
		unset ( $ap ['adv_list'] );
        $parseStr = $ap ['style'];
		$parseStr = str_replace('[adv_position.width]',$ap['width'], $parseStr);
		$parseStr = str_replace('[adv_position.height]',$ap['height'], $parseStr);
		$parseStr = str_replace('[adv_path]',$adv_path, $parseStr);
		$parseStr = str_replace('[adv_pics]',$adv_pics, $parseStr);
		$parseStr = str_replace('[adv_links]',$adv_links, $parseStr);
		$parseStr = str_replace('[adv_texts]',$adv_texts, $parseStr);
		if ($htag){
			$parseStr ='<'.$htag.'>'.$parseStr.'</'.$htag.'>';
		}
	
	} else {
		$ap_adv_list = $ap ['adv_list'];
		$parseStr='';
		if($ap_adv_list){
			if ($htag){
				foreach($ap_adv_list as $value){
				    $parseStr.='<'.$htag.'>'.$value['html'].'</'.$htag.'>';
				}
			}else{
			    $parseStr.='<table cellpadding="0" cellspacing="0">';
				$parseStr.='<tr>';
				foreach($ap_adv_list as $value){
				    $parseStr.='<td>'.$value['html'].'</td>';
				}
				$parseStr.='</tr>';
				$parseStr.='</table>';
			}
		}
	}
		
	return $parseStr;
	
}
function getAdvHTML($adv,$ap)
{	
	if($ap['width'] == 0)
		$ap['width']="";
	else
		$ap['width']=" width='".$ap['width']."'";
		
	if($ap['height'] == 0)
		$ap['height']="";
	else
		$ap['height']=" height='".$ap['height']."'";
		
	switch($adv['type']){
		case '1':
			if($adv['url']=='')
				$adv_str = "<img src='".HTTP_URL.$adv['code']."'".$ap['width'].$ap['height']."/>";
			elseif(intval($adv['is_vote']) ==1)
				$adv_str = "<a href='".$adv['url']."' target='_blank' title='".$adv['desc']."'><img src='".__ROOT__.$adv['code']."'".$ap['width'].$ap['height']."/></a>";
			else
				$adv_str = "<a href='".$adv['url']."' target='_blank' title='".$adv['desc']."'><img src='".__ROOT__.$adv['code']."'".$ap['width'].$ap['height']."/></a>";
			break;
		case '2':
			$adv_str = "<object classid='clsid:D27CDB6E-AE6D-11cf-96B8-444553540000' codebase='http://download.macromedia.com/pub/shockwave/cabs/flash/swflash.cab#version=7,0,19,0'".$ap['width'].$ap['height'].">".
					   "<param name='movie' value='".HTTP_URL.$adv['code']."' />".
    				   "<param name='quality' value='high' />".
					   "<param name='menu' value='false' />".
					   "<embed src='".HTTP_URL.$adv['code']."' quality='high' pluginspage='http://www.macromedia.com/go/getflashplayer' type='application/x-shockwave-flash'".$ap['width'].$ap['height']."></embed>".
					   "</object>";
			break;
		case '3':
			$adv_str = $adv['code'];
			break;
	}
	return $adv_str;
}

function getJsStr($val,$field=array()){
	$bool = true;
	if(!empty($field)){
		$bool = false;
	}
	
	foreach($val as $key=>$v){
		if($bool){
			$arr[] = $key.':\''.$v.'\'';
		}else{
			if(in_array($key, $field)){
				$arr[] = $key.':\''.$v.'\'';
			}
		}		
	}
	$str = '{'.implode(',', $arr).'}';
	return $str;
}

function toPrice($val,$decimal = null){
	$default = GetNum(C('sysconfig.site_price_decimal'));
	$decimal = $decimal?$decimal:$default;
	return number_format($val,$decimal,'.','');
}

function addPre($map,$pre){
	foreach($map as $key=>$value){
		if($key == '_string'){
			$where['_string'] = preg_replace('/`\w+`/i',$pre.'.$0',$value);
		}elseif($key == '_complex'){
			$where['_complex'] = addPre($value,$pre);
		}else{
			if(substr($key,0,1) != '_'){
				$where[$pre.'.'.$key] = $value;
			}else{
				$where[$key] = $value;
			}
		}
	}
	return $where;
}

function getFieldAll($data,$field){
	foreach($data as $val){
		$value[] = $val["{$field}"];
	}
	return $value;
}

function getMailUrl($mail){
	$domain = explode ( "@", $mail);
	$domain = $domain [1];
	$gocheck_url = '';
	switch ($domain) {
		case '163.com' :
			$gocheck_url = 'http://mail.163.com';
			break;
		case '126.com' :
			$gocheck_url = 'http://www.126.com';
			break;
		case 'sina.com' :
			$gocheck_url = 'http://mail.sina.com';
			break;
		case 'sina.com.cn' :
			$gocheck_url = 'http://mail.sina.com.cn';
			break;
		case 'sina.cn' :
			$gocheck_url = 'http://mail.sina.cn';
			break;
		case 'qq.com' :
			$gocheck_url = 'http://mail.qq.com';
			break;
		case 'foxmail.com' :
			$gocheck_url = 'http://mail.foxmail.com';
			break;
		case 'gmail.com' :
			$gocheck_url = 'http://www.gmail.com';
			break;
		case 'yahoo.com' :
			$gocheck_url = 'http://mail.yahoo.com';
			break;
		case 'yahoo.com.cn' :
			$gocheck_url = 'http://mail.cn.yahoo.com';
			break;
		case 'hotmail.com' :
			$gocheck_url = 'http://www.hotmail.com';
			break;
		case 'msn.cn' :
			$gocheck_url = 'http://mail.live.com';
			break;
		case 'msn.com' :
			$gocheck_url = 'http://mail.live.com';
			break;
		default :
			$gocheck_url = 'http://mail.' . $domain;
			break;
	}
	return $gocheck_url;
}

function getMemberId(){
	import("ORG.Crypt.Xxtea");
	$xxtea = new Xxtea();
	$site_key = C('SITE_KEY');
	$mb_id = $xxtea->decrypt($_COOKIE['mb_id'],$site_key);
	return $mb_id;
}

function setMemberLogin($id){
	import("ORG.Crypt.Xxtea");
	$xxtea = new Xxtea();
	$site_key = C('SITE_KEY');
	$config = C('sysconfig');
	$login_log = D('Login_log');
	$loginlogdata=array(
		'uid'=>$id,
	);
	$loginlogdata = $login_log->create($loginlogdata);
	$login_log->add($loginlogdata);
	//设置在线状态
	if($config['is_open_chat'] == 1){
		$chat_log = D('Chat_log');
		$chat_logmap = array(
			'receive'=>array('eq',$id),
			'mark'=>array('eq',0),
		);
		$chat_logdata['login'] = $chat_log->getData($chat_logmap);
		S("Member_{$id}",$chat_logdata);
		$memberinfo = D('Member_info');
		$info = $memberinfo->getInfo($id);
		if(!$info){
			setOnline($id);
		}else{
			setOnline($id,$info['online']);
		}
	}	
	cookie('islogin','1',GetNum($config['site_mb_logintime'])*60);
	$mb_id = $xxtea->encrypt($id,$site_key);
	cookie('mb_id',$mb_id,GetNum($config['site_mb_logintime'])*60);
}

function loginClear($id){
	cookie('islogin',NULL,-99999999);
	cookie('mb_id',NULL,-99999999);
	cookie('email',NULL,-99999999);
	cookie('password',NULL,-99999999);
	//设置不在线状态
	if(C('sysconfig.is_open_chat') == 1){
		removeOnline($id);
	}
}

function isOnlineCheck(){
	$online_check = S('online_check');
	$time = time();
	if(empty($online_check)){
		$online_check = $time;
		S('online_check',$online_check);
		return $online_check;
	}
	$check = $online_check+C('sysconfig.online_check');
	
	if($check < $time){
		return $online_check;
	}
	return false;
}

function setOnline($id,$val = false){
	$onLineStatus = S('onLineStatus');
	if($val !== false){
		$onLineStatus["{$id}"] = $val;
	}else{
		if($onLineStatus["{$id}"] !== null){
			$val = $onLineStatus["{$id}"];
		}else{
			$val = 1;
			$onLineStatus["{$id}"] = $val;
		}
	}
	
	$member = D('Member');
	$member->setOnline($id, $val);
	$online = S('online');
	$online["{$id}"] = time();
	S('online',$online);
	S('onLineStatus',$onLineStatus);
}
//$bool = true 正向移除 false 反向移除
function removeOnline($id,$bool = true){
	if(!empty($id)){
		$member = D('Member');
		$member->setOnline($id, 0,$bool);
		$online = S('online');
		if(is_array($id)){
			//移除不在线的
			foreach($id as $value){
				unset($online["{$value}"]);
			}
		}else{
			unset($online["{$id}"]);
		}
		S('online',$online);
	}
}

function setAutoLogin($data){
	import("ORG.Crypt.Xxtea");
	$xxtea = new Xxtea();
	$site_key = C('SITE_KEY');
	$email = $xxtea->encrypt($data['email'],$site_key);
	$password = $xxtea->encrypt(md5($data['password']),$site_key);
	cookie('email', $email, 30 * 24 * 60 * 60  );
	cookie('password', $password, 30 * 24 * 60 * 60 );
}

function getAutoLogin(){
	import("ORG.Crypt.Xxtea");
	$xxtea = new Xxtea();
	$site_key = C('SITE_KEY');
	$data['email'] = $xxtea->decrypt(cookie('email'),$site_key);
	$data['password'] = $xxtea->decrypt(cookie('password'),$site_key);
	return $data;
}
//手机号码电话号码格式化
function phoneFormat ($phone){
    $begin  = substr($phone,0, strlen($phone)-2);
	$end =  substr($phone,strlen($phone)-2, 2);
	$num = strlen($begin); 
	$data = "";
	for($i = 1; $i <= $num; $i++){
	    $data .='<span class="p">&nbsp;&nbsp;</span>';
	}
    $data .= $end;
	return $data;
}
//邮箱格式化
function mailFormat ($mail){
    $domail = explode ( "@", $mail);
	$begin = $domail [0];
	$end = $domail [1];
	$num = strlen($begin); 
	$data = "";
	for($i = 1; $i <= $num; $i++){
	    $data .='<span class="p">&nbsp;&nbsp;</span>';
	}
    $data .= "@".$end;
	return $data;
}
function toDateRefer($date){
	if(!empty($date)){
    	$limit = time() - $date;
	    if($limit < 60)
	    {
	        return $limit . L('seconds_before');
	    }
	    if($limit >= 60 && $limit < 3600)
	    {
	        return floor($limit/60) . L('minutes_before');
	    }
	    if($limit >= 3600 && $limit < 86400)
	    {
	        return floor($limit/3600) . L('hours_before');
	    }
	    if($limit >= 86400 and $limit<259200)
	    {
	        return floor($limit/86400) . L('days_before');
	    }
	    if($limit >= 259200 and $limit<31536000)
	    {
	        return floor($limit/259200) . L('months_ago');
	    }
		if($limit>=31536000)
	    {
	        return floor($limit/31536000) . L('years_ago');
	    }else{
	        return '';
	    }
	}else{
		return '';
	}
}
/**
 +----------------------------------------------------------
 * 取得字符串的长度，支持中文和其他编码
 +----------------------------------------------------------
 * @static
 * @access public
 +----------------------------------------------------------
 * @param string $str 字符串
 * @param string $charset 编码格式
 +----------------------------------------------------------
 * @return string
 +----------------------------------------------------------
 */
function mstrlen($str, $charset="utf-8"){
    if(function_exists("mb_substr"))
        $length = mb_strlen($str, $charset);
    elseif(function_exists('iconv_substr')) {
        $length = iconv_strlen($str, $charset);
    }else{
		$re['utf-8']   = "/[\x01-\x7f]|[\xc2-\xdf][\x80-\xbf]|[\xe0-\xef][\x80-\xbf]{2}|[\xf0-\xff][\x80-\xbf]{3}/";
		$re['gb2312'] = "/[\x01-\x7f]|[\xb0-\xf7][\xa0-\xfe]/";
		$re['gbk']    = "/[\x01-\x7f]|[\x81-\xfe][\x40-\xfe]/";
		$re['big5']   = "/[\x01-\x7f]|[\x81-\xfe]([\x40-\x7e]|\xa1-\xfe])/";
		$length = count($match[0]);
	}
    return $length;
}
/**
 +----------------------------------------------------------
 * html字符串截取度，支持中文和其他编码
 +----------------------------------------------------------
 * @static
 * @access public
 +----------------------------------------------------------
 * @param string $htmlstr 字符串
 * @param string $length 截取长度
 +----------------------------------------------------------
 * @return string
 +----------------------------------------------------------
 */
function hsubstr($htmlstr, $length){
    if(mstrlen($htmlstr) < $length){
        return $htmlstr;
    }
	$html = msubstr($htmlstr, 0, $length);
	if(!strpos($html,'<')){
	   return $html;
	}
    $htmls = explode('<', $htmlstr);
    $hsubstr = '';
    $istable = 0;
	if(count($htmls)>1){
		foreach($htmls as $i=>$k){
			if($i==0){
				$hsubstr .= $htmls[$i]; continue;
			}
			$htmls[$i] = "<".$htmls[$i];
			if(mstrlen($htmls[$i])>6){
				$tname = substr($htmls[$i],1,5);
				if(strtolower($tname)=='table'){
					$istable++;
				}elseif(strtolower($tname)=='/tabl'){
					$istable--;
				}
				
				if($istable>0) {
					$hsubstr .= $htmls[$i]; continue;
				}else{
					$hsubstr .= $htmls[$i];
				}
			}else{
				$hsubstr .= $htmls[$i];
			}
			if(mstrlen($hsubstr)>$length){
				return $hsubstr;
			}
		}
	}else{
	    $htmlstr = msubstr($htmlstr, 0, $length);
		return $htmlstr;
	}
}

function expand_html($data){
	$html = '';
	switch ($data['type']) {
		case  4 :
			$html .= '<ul>';
			$enum = explode(',', $data['enum']);
			$val_arr = explode(',', $data['val']);
			foreach($enum as $vo){
				if(in_array($vo, $val_arr)){
					$html .= "<li style='float: left;width: 160px;'>
							    <img height=\"17\" width=\"17\" title=\"{$data['key']}\" alt=\"{$data['key']}\" src=\"../Public/images/has_amenity.png\" class=\"amenity-icon\">
							    <p>{$vo}</p>
							</li>";
				}else{
					$html .= "<li style='float: left;width: 160px;'>
							    <img height=\"17\" width=\"17\" title=\"{$data['key']}\" alt=\"{$data['key']}\" src=\"../Public/images/no_amenity.png\" class=\"amenity-icon\">
							    <p>{$vo}</p>
							</li>";
				}
			}
			$html .= '</ul>';
			break;
		case  5 :
		    $html = '<p><img title="'.$data['key'].'" src="__ROOT__'.$data['val'].'" alt="'.$data['val'].'"></p>';
		    break;	
		default :
			$html = "<p>".$data['val']."</p>";
			break;
	}
	return $html;
}

function faceReplace($str){
	$str = preg_replace("[\[/表情([0-9]*)\]]",'<img src="'.WEB_PUBLIC_PATH.'/Images/face/$1.gif" >',$str);
    return $str;
}

function replaceFace($str){
	$str = preg_replace('[\<img src="'.WEB_PUBLIC_PATH.'/Images/face/([0-9]*)\.gif" >]',"[/表情$1]",$str);
    return $str;
}

function contentFilter($content){
	$content = faceFilter($content);
	$content = atFliter($content);
	$content = replacestr($content);
	return $content;
}

function atFliter($content){
	preg_match_all('/@(\w+)/i', $content, $arr);
	if(!empty($arr[1])){
		$member = D('Member');
		foreach ($arr[1] as $key => $vo){
			$map['name'] = array('eq',$vo);
			$memberdata = $member->where($map)->find();
			if(!empty($memberdata)){
				$str = '<a href="'.U('User/space/id/'.$memberdata['id']).'">@'.$vo.'</a> ';
				$content = str_replace($arr[0][$key], $str, $content);
				unset($str);
			}
			unset($map,$memberdata);
		}
	}
	return $content;
}

function onLineClass($status){
	switch ($status) {
		case 0 :
			$class = 'wbim_status_offline';
			break;
		case 1 :
			$class = 'wbim_status_online';
			break;
		case 2 :
			$class = 'wbim_status_busy';
			break;
		case 3 :
			$class = 'wbim_status_away';
			break;
		default :
			$class = 'wbim_status_offline';
			break;
	}
	return $class;
}

function onLineText($status){
	switch ($status) {
		case 0 :
			$class = L('stealth');
			break;
		case 1 :
			$class = L('online');
			break;
		case 2 :
			$class = L('busy');
			break;
		case 3 :
			$class = L('leave');
			break;
		default :
			$class = L('stealth');
			break;
	}
	return $class;
}

function replaceTplPara($content){
	$replace =  array(
            '__PUBLIC__'    => __ROOT__.'/Public',// 站点公共目录
            '__ROOT__'      => __ROOT__,       // 当前网站地址
            '__APP__'       => __ROOT__.'/App',        // 当前项目地址
        	'__MODULE__' => MODULE_NAME,  // zhanghuihua@msn.com
        );
    $content = str_replace(array_keys($replace),array_values($replace),$content);
    return $content;
}
//发送短信
function sendsms($tel,$msg){
	$config = C('sysconfig');
	if($config['site_sms_open']!=1){
	 	return true;
	}
	S('sendSms',1);
	 import("ORG.Net.Http");
	 $data = array(
	 	'tel'=>$tel,
	 	'msg'=>$msg,
	 );
	
	 $conf = array(
		'block'=>false,
		'read'=>false,
		'post'=>http_build_query($data),
	 );
	 $url = HOST.U('Send/sendSms');
	 Http::fsockopen_download($url,$conf);
	 return true;
	
}
//替换敏感词语
function replacestr($str){
	$config = C('sysconfig');
	$str = preg_replace("#".$config['site_replacestr']."#i", '***', $str);
	return $str;
}

function isPhone($phone){
	if(C('sysconfig.verify_phone_format')){
		if(preg_match('/^[0\+]\d{2,3}[ |-](\d{3,})$/', $phone)){
			return true;
		}
	}else{
		if(preg_match('/^1[3|4|5|8][0-9]\d{8}$/', $phone) || preg_match('/^0[\d]{10,11}$/', $phone)){
			return true;
		}
	}
	
	return false;
}

//查找范围的正则例如 00001-00099之间
function regRange($start,$end){
	$end_str = strval($end);
  	$end_int_len = strlen($end_str);
  	$start_str = str_pad($start,$end_int_len,'0',STR_PAD_LEFT);
  	$reg_len = $len - $end_int_len;
  	
  	$same_reg = '';
  	$start_reg_str = '';
  	$end_reg_str = '';
  	$bool = true;
  	for($i=0;$i<$end_int_len;$i++){
  		$start_crr = $start_str{$i};
  		$end_crr = $end_str{$i};
  		if($start_crr == $end_crr && $bool){
  			$same_reg .='['.$start_crr.']';
  		}else{
  			if($bool){
  				$start_reg_str .= '['.$start_crr.'-'.$start_crr.']';
  				$bool = false;
  			}else{
  				$start_reg_str .= '['.$start_crr.'-9]';
  			}
  			
  			if($i == ($end_int_len - 1)){
  				$end_reg_str .='[0-'.$end_crr.']';
  			}else{
  				$end_reg_str .='['.($start_crr+1).'-'.$end_crr.']';
  			}
  		}
  	}
  	$reg_nums_str = $same_reg.'('.$start_reg_str.'|'.$end_reg_str.')';
  	return $reg_nums_str;
}
//检测是否手机访问
function checkmobile(){
	global $_G;
	static $mobilebrowser_list =array('iphone', 'android', 'phone', 'mobile', 'wap', 'netfront', 'java', 'opera mobi', 'opera mini',
				'ucweb', 'windows ce', 'symbian', 'series', 'webos', 'sony', 'blackberry', 'dopod', 'nokia', 'samsung',
				'palmsource', 'xda', 'pieplus', 'meizu', 'midp', 'cldc', 'motorola', 'foma', 'docomo', 'up.browser',
				'up.link', 'blazer', 'helio', 'hosin', 'huawei', 'novarra', 'coolpad', 'webos', 'techfaith', 'palmsource',
				'alcatel', 'amoi', 'ktouch', 'nexian', 'ericsson', 'philips', 'sagem', 'wellcom', 'bunjalloo', 'maui', 'smartphone',
				'iemobile', 'spice', 'bird', 'zte-', 'longcos', 'pantech', 'gionee', 'portalmmm', 'jig browser', 'hiptop',
				'benq', 'haier', '^lct', '320x320', '240x320', '176x220');
	$useragent = strtolower($_SERVER['HTTP_USER_AGENT']);
	if(($v = dstrpos($useragent, $mobilebrowser_list, true))) {
		$_G['mobile'] = $v;
		return true;
	}
	$brower = array('mozilla', 'chrome', 'safari', 'opera', 'm3gate', 'winwap', 'openwave', 'myop');
	if(dstrpos($useragent, $brower)) return false;

	$_G['mobile'] = 'unknown';
	if($_GET['mobile'] === 'yes') {
		return true;
	} else {
		return false;
	}
}
//检测字符串是否在数组中
function dstrpos($string, &$arr, $returnvalue = false) {
	if(empty($string)) return false;
	foreach((array)$arr as $v) {
		if(strpos($string, $v) !== false) {
			$return = $returnvalue ? $v : true;
			return $return;
		}
	}
	return false;
}
//生成地图图片
function MakeGoodMap($id=0,$goodinfo=array(),$reMk = false){
    $re_name ="";
	if(!$goodinfo){
	    $goods = D('Goods');
		$goodinfo = $goods->find($id);
	}
	
	if(!empty($goodinfo['latitude'])&&!empty($goodinfo['longitude'])){
		if(!is_dir(UPLOADIMG.'ditu/'))
			@mk_dir(UPLOADIMG.'ditu/',0777);
			
		$file_name = UPLOADIMG."ditu/gmimg".$goodinfo['id'].".jpg";
		$re_name = "/Public/upload/img/ditu/gmimg".$goodinfo['id'].".jpg";
		if(!file_exists($file_name)|| $reMk ==true){
		    import("ORG.Net.Http");
				$str = Http::fsockopen_download("http://api.map.baidu.com/staticimage?width=200&height=200&center=".$goodinfo['longitude'].",".$goodinfo['latitude']."&zoom=15&markers=".$goodinfo['longitude'].",".$goodinfo['latitude']);
			$google_map_im = @imagecreatefromstring($str);
			imagejpeg($google_map_im,$file_name,100);
		}
	}
	return $re_name;
}

function getValueContent($content) {
	$content = str_replace('[reg_verify]', L('value_log_reg_verify'), $content);
	$content = str_replace('[avatar]', L('upload_header'), $content);
	$content = str_replace('[invite]', L('value_log_invite'), $content);
	$content = str_replace('[buy]', L('value_log_order'), $content);
	$content = str_replace('[sell]', L('value_log_sell'), $content);
	$content = str_replace('[invite_buy]', L('value_log_invite_buy'), $content);
	$content = str_replace('[invite_sell]', L('value_log_invite_sell'), $content);
	return $content;
}

function getCashContent($content) {
	$content = str_replace('[pay_order]',L('cash_log_pay_order'), $content);
	$content = str_replace('[prepaid_card]', L('cash_log_prepaid_card'), $content);
	$content = str_replace('[withdraw]', L('cash_log_withdraw'), $content);
	$content = str_replace('[undo_withdraw]', L('cash_log_undo_withdraw'), $content);
	$content = str_replace('[invalid]',L('cash_log_invalid'), $content);
	$content = str_replace('[recharge]',L('cash_log_recharge'), $content);
	$content = str_replace('[distribution]',L('cash_log_distribution'), $content);
	return $content;
}

function percentage($crr,$total){
	return intval($crr/$total * 100);
}

function checkfiles($currentdir, $ext = '', $sub = 1, $skip = '') {
	$md5data = array();
	$dir = @opendir(ROOT_PATH.'/'.$currentdir);
	$exts = '/('.$ext.')$/i';
	$skips = explode(',', $skip);
	while($entry = @readdir($dir)) {
		$file = $currentdir.$entry;
		if($entry != '.' && $entry != '..' && (preg_match($exts, $entry) || $sub && is_dir($file)) && !in_array($entry, $skips)) {
			if($sub && is_dir($file)) {
				$other = checkfiles($file.'/', $ext, $sub, $skip);
				$md5data = array_merge($md5data,$other);
			} else {
				$md5data[$file] = @md5_file($file);
			}
		}
	}
	return $md5data;
}

function getFilesMd5(){
	$arr = array();
	$arr = array_merge($arr,checkfiles('./','\.php',0));
	$arr = array_merge($arr,checkfiles('ThinkPHP/','\.php|\.html'));
	$arr = array_merge($arr,checkfiles('Thread/','\.php|\.html|\.js|\.css|\.gif|\.png|\.jpg|\.jpeg'));
	$arr = array_merge($arr,checkfiles('Wap/','\.php|\.html|\.js|\.css|\.gif|\.png|\.jpg|\.jpeg'));
	$arr = array_merge($arr,checkfiles('Admin/','\.php|\.html|\.js|\.css|\.gif|\.png|\.jpg|\.jpeg'));
	$arr = array_merge($arr,checkfiles('Index/','\.php|\.html|\.js|\.css|\.gif|\.png|\.jpg|\.jpeg'));
	$arr = array_merge($arr,checkfiles('Common/','\.php',1,'sysconfig.php'));
	$arr = array_merge($arr,checkfiles('Public/','\.dat',0,'key.dat'));
	$arr = array_merge($arr,checkfiles('Public/adflash/','\.swf'));
	$arr = array_merge($arr,checkfiles('Public/dwz/','\.xml|\.js|\.css|\.gif|\.png|\.jpg|\.jpeg'));
	$arr = array_merge($arr,checkfiles('Public/Images/','\.gif|\.png|\.jpg|\.jpeg'));
	$arr = array_merge($arr,checkfiles('Public/other/','\.dat'));
	$arr = array_merge($arr,checkfiles('Public/xheditor/','\.html|\.js|\.css|\.gif|\.png|\.jpg|\.jpeg'));
	return $arr;
}

function getModified(){
	$modified = array();
	$json = file_get_contents(PUBLIC_PATH.'checkfile.dat');
	$old = json_decode($json,true);
	$new = getFilesMd5();
	foreach ($old as $key=>$value){
		if($new[$key] != $value){
			$modified[] = $key;
		}
	}
	return $modified;
}

function copyDir($source, $destination)
{
	if (is_dir($source) == false)
	{
		return false;
	}
	if (is_dir($destination) == false)
	{
		mkdir($destination,0777);
	}
	$handle=opendir($source);
	while (false !== ($file = readdir($handle)))
	{
		if ($file != "." && $file != "..")
		{
			is_dir("$source/$file")?copyDir("$source/$file", "$destination/$file"):copy("$source/$file", "$destination/$file");
		}
	}
	closedir($handle);
}

function distance($lat1,$lng1,$lat2, $lng2){
	import("ORG.Util.Latlng");
	$km = Latlng::getDistance($lat1, $lng1, $lat2, $lng2);
	return formatDistance($km);
}

function formatDistance($km){
	if($km < 1){
		return intval($km * 1000).'m';
	}
	if($km >= 1){
		return intval($km).'km';
	}
	return $km;
}

function getRange($lat, $lng, $distance){
	import("ORG.Util.Latlng");
	$arr = Latlng::getRange($lat, $lng, $distance);
	return $arr;
}

function getIpLatlng($ip = ''){
	$address = IP($ip);
	if(empty($address) || $address == '本机地址' || $address == '局域网对方和您在同一内部网'){
		$address = '河南省郑州市';
	}
	import("ORG.Net.Http");
	$conf = array(
			'block'=>false,
			'timeout'=>2,
	);
	$url = 'http://api.map.baidu.com/?qt=gc&wd='.$address.'&ie=utf-8&oue=1&res=api';
	$json = Http::fsockopen_download($url,$conf);
	$arr = json_decode($json,true);
	if($arr ["result"]["error"] == 0){
		$latlng = baiduToLatlng($arr["content"]["coord"]["x"],$arr["content"]["coord"]["y"]);
		$latlng['address'] = $address;
		return $latlng;
	}	
	return false;
}
function getAddressLatlng($address = ''){
	if(empty($address) || $address == '本机地址' || $address == '局域网对方和您在同一内部网'){
		$address = '河南省郑州市';
	}
	import("ORG.Net.Http");
	$conf = array(
			'block'=>false,
			'timeout'=>2,
	);
	$url = 'http://api.map.baidu.com/?qt=gc&wd='.$address.'&ie=utf-8&oue=1&res=api';
	$json = Http::fsockopen_download($url,$conf);
	$arr = json_decode($json,true);
	if($arr ["result"]["error"] == 0){
		$latlng = baiduToLatlng($arr["content"]["coord"]["x"],$arr["content"]["coord"]["y"]);
		$latlng['address'] = $address;
		return $latlng;
	}	
	return false;
}
function aweek($gdate = "", $first = 0){
	if(!$gdate) $gdate = date("Y-m-d");
	$w = date("w", strtotime($gdate));//取得一周的第几天,星期天开始0-6
	$dn = $w ? $w - $first : 6;//要减去的天数
	//本周开始日期
	$st = strtotime("$gdate -".$dn." days");
	$stdate = date('Y-m-d',$st);
	//本周结束日期
	$en = strtotime("$stdate +6 days");
	$arr = array(
			'start'=>$st,
			'end'=>$en,
	);
	return $arr;//返回开始和结束日期
}

function getFirstLetter($text){
	$str = strtoupper(substr($text,0,1));
	return $str;
}

function getSpelling($text){
	import("ORG.Util.Pinyin");
	$str = Pinyin::toPinyin($text);
	return $str;
}

function getDefaultRegion(){
	$arr = false;
	if(C('sysconfig.is_switch_region')){
		$default_region = cookie('default_region');
		$arr = json_decode($default_region,true);
	}
	return $arr;
}

function setDefaultRegion($arr){
	if(!empty($arr)){
		$default_region = json_encode($arr);
		cookie('default_region',$default_region,30 * 24 * 60 * 60);
	}
	return $arr;
}

function baiduToLatlng($x,$y){
	$mcband = array(12890594.86,8362377.87,5591021,3481989.83,1678043.12,0);
	$mc2ll = array(
				array(1.410526172116255e-8, 0.00000898305509648872, -1.9939833816331, 200.9824383106796, -187.2403703815547, 91.6087516669843, -23.38765649603339, 2.57121317296198, -0.03801003308653, 17337981.2),
				array(-7.435856389565537e-9, 0.000008983055097726239, -0.78625201886289, 96.32687599759846, -1.85204757529826, -59.36935905485877, 47.40033549296737, -16.50741931063887, 2.28786674699375, 10260144.86),
				array(-3.030883460898826e-8, 0.00000898305509983578, 0.30071316287616, 59.74293618442277, 7.357984074871, -25.38371002664745, 13.45380521110908, -3.29883767235584, 0.32710905363475, 6856817.37),
				array(-1.981981304930552e-8, 0.000008983055099779535, 0.03278182852591, 40.31678527705744, 0.65659298677277, -4.44255534477492, 0.85341911805263, 0.12923347998204, -0.04625736007561, 4482777.06),
				array(3.09191371068437e-9, 0.000008983055096812155, 0.00006995724062, 23.10934304144901, -0.00023663490511, -0.6321817810242, -0.00663494467273, 0.03430082397953, -0.00466043876332, 2555164.4),
				array(2.890871144776878e-9, 0.000008983055095805407, -3.068298e-8, 7.47137025468032, -0.00000353937994, -0.02145144861037, -0.00001234426596, 0.00010322952773, -0.00000323890364, 826088.5),
		);
	foreach($mcband as $key=>$vo){
		if ($y >= $vo) {
			$ch = $mc2ll[$key];
			break;
		}
	}
	
	$t = $ch[0] + $ch[1] * abs($x);
	$e = abs($y) / $ch[9];
	$h= $ch[2] + $ch[3] * $e + $ch[4] * $e * $e + $ch[5] * $e * $e * $e + $ch[6] * $e * $e * $e * $e + $ch[7] * $e * $e * $e * $e * $e + $ch[8] * $e * $e * $e * $e * $e * $e;
	$t *= ($x < 0 ? -1: 1);
	$h *= ($y < 0 ? -1: 1);
		
	return array('lng'=>$t,'lat'=>$h);
}

function faceFilter($content){
	$arr = array (
			'微笑' => '14',
			'撇嘴' => '1',
			'色' => '2',
			'发呆' => '3',
			'得意' => '4',
			'流泪' => '5',
			'害羞' => '6',
			'闭嘴' => '7',
			'睡' => '8',
			'大哭' => '9',
			'尴尬' => '10',
			'发怒' => '11',
			'调皮' => '12',
			'呲牙' => '13',
			'惊讶' => '0',
			'难过' => '15',
			'酷' => '16',
			'冷汗' => '96',
			'抓狂' => '18',
			'吐' => '19',
			'偷笑' => '20',
			'可爱' => '21',
			'白眼' => '22',
			'傲慢' => '23',
			'饥饿' => '24',
			'困' => '25',
			'惊恐' => '26',
			'流汗' => '27',
			'憨笑' => '28',
			'大兵' => '29',
			'奋斗' => '30',
			'咒骂' => '31',
			'疑问' => '32',
			'嘘' => '33',
			'晕' => '34',
			'折磨' => '35',
			'衰' => '36',
			'骷髅' => '37',
			'敲打' => '38',
			'再见' => '39',
			'擦汗' => '97',
			'抠鼻' => '98',
			'鼓掌' => '99',
			'糗大了' => '100',
			'坏笑' => '101',
			'左哼哼' => '102',
			'右哼哼' => '103',
			'哈欠' => '104',
			'鄙视' => '105',
			'委屈' => '106',
			'快哭了' => '107',
			'阴险' => '108',
			'亲亲' => '109',
			'吓' => '110',
			'可怜' => '111',
			'菜刀' => '112',
			'西瓜' => '89',
			'啤酒' => '113',
			'篮球' => '114',
			'乒乓' => '115',
			'咖啡' => '60',
			'饭' => '61',
			'猪头' => '46',
			'玫瑰' => '63',
			'凋谢' => '64',
			'示爱' => '116',
			'爱心' => '66',
			'心碎' => '67',
			'蛋糕' => '53',
			'闪电' => '54',
			'炸弹' => '55',
			'刀' => '56',
			'足球' => '57',
			'瓢虫' => '117',
			'便便' => '59',
			'月亮' => '75',
			'太阳' => '74',
			'礼物' => '69',
			'拥抱' => '49',
			'强' => '76',
			'弱' => '77',
			'握手' => '78',
			'胜利' => '79',
			'抱拳' => '118',
			'勾引' => '119',
			'拳头' => '120',
			'差劲' => '121',
			'爱你' => '122',
			'NO' => '123',
			'OK' => '124',
			'爱情' => '42',
			'飞吻' => '85',
			'跳跳' => '43',
			'发抖' => '41',
			'怄火' => '86',
			'转圈' => '125',
			'磕头' => '126',
			'回头' => '127',
			'跳绳' => '128',
			'挥手' => '129',
			'激动' => '130',
			'街舞' => '131',
			'献吻' => '132',
			'左太极' => '133',
			'右太极' => '134',
	);
	preg_match_all('/\[(.+?)\]/i',$content,$s);
	foreach($s[0] as $k=>$v){
		$content = str_replace($v,'<img style="display: inline;" src="'.__ROOT__.'/Public/Images/face/'.$arr[$s[1][$k]].'.gif" />',$content);
	}
	return $content;
}

function guid() {
	$charid = strtoupper(md5(uniqid(mt_rand(), true)));
	$hyphen = chr(45);// "-"
	$uuid = substr($charid, 0, 8).$hyphen
	.substr($charid, 8, 4).$hyphen
	.substr($charid,12, 4).$hyphen
	.substr($charid,16, 4).$hyphen
	.substr($charid,20,12);
	return $uuid;
}
?>