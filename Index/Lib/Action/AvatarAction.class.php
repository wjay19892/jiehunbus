<?php
class AvatarAction extends CommonAction {
	function avatar_upload(){
		@header("Expires: 0");
		@header("Cache-Control: private, post-check=0, pre-check=0, max-age=0", FALSE);
		@header("Pragma: no-cache");
		$model = D('Accessory');
		$data = $model->uploadImg(0,"avatar");
		/*if($data[0]['id']){
			$uid = $this->getinput('id','P');
			$map['id'] = array('eq',$uid);
			$member = D('Member');
			$info = $member->where($map)->setField('header',$data[0]['id']);
			if($info){
			    $member_feed = D('Member_feed');
		     	$tip = $member_feed->addFeed($this->memberinfo['id'],'avatar',$this->memberinfo['id'],'Member');
				$config = C('sysconfig');
				$value_log = D('Value_log');
				$v_lmap['uid'] = array('eq',$this->memberinfo['id']);
				$v_lmap['content'] = array('eq','[avatar]');
				$v_lmap['rel_id'] = array('eq',$this->memberinfo['id']);
				$v_lmap['rel_module'] = array('eq',"avatar");
				$value_logdata = $value_log->getDataAll($v_lmap);
				if(empty($value_logdata)){
					$tip = $member->addVal($this->memberinfo['id'],$config['site_mb_avatarcredits'],'[avatar]',$this->memberinfo['id'],"avatar");
				}
			}
		}*/
		$json = $this->_format($data);
		echo json_encode($json);
	}
	
	function camera(){
		@header("Expires: 0");
		@header("Cache-Control: private, post-check=0, pre-check=0, max-age=0", FALSE);
		@header("Pragma: no-cache");
		$pic_name = uniqid();
		//生成图片存放路径
		$new_avatar_path = UPLOADIMG.'avatar/'.$pic_name.'.jpg';
		//将POST过来的二进制数据直接写入图片文件.
		$len = file_put_contents($new_avatar_path,file_get_contents("php://input"));
		//原始图片比较大，压缩一下. 效果还是很明显的, 使用80%的压缩率肉眼基本没有什么区别
		$avtar_img = imagecreatefromjpeg($new_avatar_path);
		imagejpeg($avtar_img,$new_avatar_path,80);
		//输出新保存的图片位置, 测试时注意改一下域名路径, 后面的statusText是成功提示信息.
		//status 为1 是成功上传，否则为失败.
		$recpath = str_replace(ROOT_PATH,"",$new_avatar_path);
		$model = D('Accessory');
		$data['type'] = 'img';
		$data['title']= '';
		$data['origin']= $recpath;
		$data['path'] = str_replace($pic_name.'.jpg','m_'.$pic_name.'.jpg',$recpath);
		$data['thumbnail'] = str_replace($pic_name.'.jpg','s_'.$pic_name.'.jpg',$recpath);
		$data['size']= $len;
		$data['uploadtime'] = time();
		$list = $model->add($data);
		/*if($list){
			$map['id'] = array('eq',$this->memberinfo['id']);
			$member = D('Member');
			$info = $member->where($map)->setField('header',$list);
			if($info){
			    $member_feed = D('Member_feed');
		     	$tip = $member_feed->addFeed($this->memberinfo['id'],'avatar',$this->memberinfo['id'],'Member');
				$config = C('sysconfig');
				$value_log = D('Value_log');
				$v_lmap['uid'] = array('eq',$this->memberinfo['id']);
				$v_lmap['content'] = array('eq','[avatar]');
				$v_lmap['rel_id'] = array('eq',$this->memberinfo['id']);
				$v_lmap['rel_module'] = array('eq',"avatar");
				$value_logdata = $value_log->getDataAll($v_lmap);
				if(empty($value_logdata)){
					$tip = $member->addVal($this->memberinfo['id'],$config['site_mb_avatarcredits'],'[avatar]',$this->memberinfo['id'],"avatar");
				}
			}
		}*/
		$json = array();
		$json['data']['photoId'] = $list;
		$json['data']['urls'][0] = str_replace(ROOT_PATH,"",$new_avatar_path);
		$json['status'] = 1;
		$json['statusText'] = L('upload_success');
		
		echo json_encode($json);
	}
	
	function save_avatar(){
		@header("Expires: 0");
		@header("Cache-Control: private, post-check=0, pre-check=0, max-age=0", FALSE);
		@header("Pragma: no-cache");
		
		if($this->memberinfo){
			//这里传过来会有两种类型，一先一后, big和small, 保存成功后返回一个json字串，客户端会再次post下一个.
			$type = isset($_GET['type'])?trim($_GET['type']):'small';
			$pic_id = intval($_GET['photoId']);
			$accessory = D('Accessory');
			$accessorydata = $accessory->find($pic_id);
			
			if($type=="big"){
				$new_avatar_path = ROOT_PATH .$accessorydata['path'];
			}
			if($type=="small"){
				$new_avatar_path = ROOT_PATH .$accessorydata['thumbnail'];
			}
			
			//将POST过来的二进制数据直接写入图片文件.
			$len = file_put_contents($new_avatar_path,file_get_contents("php://input"));
			
			//原始图片比较大，压缩一下. 效果还是很明显的, 使用80%的压缩率肉眼基本没有什么区别
			//小图片 不压缩约6K, 压缩后 2K, 大图片约 50K, 压缩后 10K
			$avtar_img = imagecreatefromjpeg($new_avatar_path);
			imagejpeg($avtar_img,$new_avatar_path,80);
			//nix系统下有必要时可以使用 chmod($filename,$permissions);
			//status 为1 是成功上传，否则为失败.
			$json = array();
			$json['data']['urls'][0] = str_replace(ROOT_PATH,"",$new_avatar_path);
			$json['status'] = 1;
			$json['statusText'] = L('upload_success');
			
			if($type=="small"){
				$map['id'] = array('eq',$this->memberinfo['id']);
				$member = D('Member');
				$info = $member->where($map)->setField('header',$pic_id);
				if($info){
					$member_feed = D('Member_feed');
					$tip = $member_feed->addFeed($this->memberinfo['id'],'avatar',$this->memberinfo['id'],'Member');
					$config = C('sysconfig');
					$value_log = D('Value_log');
					$v_lmap['uid'] = array('eq',$this->memberinfo['id']);
					$v_lmap['content'] = array('eq','[avatar]');
					$v_lmap['rel_id'] = array('eq',$this->memberinfo['id']);
					$v_lmap['rel_module'] = array('eq',"avatar");
					$value_logdata = $value_log->getDataAll($v_lmap);
					if(empty($value_logdata)){
						$tip = $member->addVal($this->memberinfo['id'],$config['site_mb_avatarcredits'],'[avatar]',$this->memberinfo['id'],"avatar");
					}
				}
			}
		}else{
			$json['status'] = 0;
			$json['statusText'] = L('upload_error');
		}	
		
		echo json_encode($json);
	}
	
	function getinput($k, $var='R') {
		switch($var) {
			case 'G': $var = &$_GET; break;
			case 'P': $var = &$_POST; break;
			case 'C': $var = &$_COOKIE; break;
			case 'R': $var = &$_REQUEST; break;
		}
		return isset($var[$k]) ? $var[$k] : NULL;
	}
	
	function _format($data){
		if(is_array($data)){
			$json = array(
				'err'=>'',
				'msg'=>array(
					'url'=>__ROOT__.$data[0]['recpath'].$data[0]['savename'],
					'relpath'=>$data[0]['recpath'].$data[0]['savename'],
					'localname'=>$data[0]['savename'],
					'id'=>$data[0]['id'],
				),
			);
		}else{
			$json = array(
				'err'=>$data,
			);
		}
		
		return $json;
	}
}
?>