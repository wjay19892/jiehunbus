<?php
class XheditorAction extends CommonAction {
	function upLoadImg(){
		$model = D('Accessory');
		$data = $model->imgUpload();
		$json = $this->_format($data);
		echo json_encode($json);
	}
	
	function fileUpload(){
		$model = D('Accessory');
		$data = $model->fileUpload();
		$json = $this->_format($data);
		echo json_encode($json);
	}
	
	function avatarUpload(){
		$model = D('Accessory');
		$data = $model->imgUpload(0,"avatar","225,68","225,68");
		$json = $this->_format($data);
		echo json_encode($json);
	}
	
	function goodsImgLoad(){
		$model = D('Accessory');
		$data = $model->imgUpload(1,"goods");
		$json = $this->_format($data);
		echo json_encode($json);
	}
	
	function siteImgLoad(){
		$model = D('Accessory');
		$data = $model->imgUpload(0,"site");
		$json = $this->_format($data);
		echo json_encode($json);
	}
	
	function _format($data){
		if(is_array($data)){
			$json = array(
				'err'=>'',
				'msg'=>array(
					'url'=>__ROOT__.$data[0]['recpath'].$data[0]['savename'],
					'relpath'=>$data[0]['recpath'].$data[0]['savename'],
					'localname'=>$data[0]['savename'],
					'middle'=>__ROOT__.$data[0]['recpath'].'m_'.$data[0]['savename'],
					'thumbnail'=>__ROOT__.$data[0]['recpath'].'s_'.$data[0]['savename'],
					'size'=>$data[0]['size'],
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