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
		$data = $model->imgUpload(0,"avatar","200,50","200,50");
		$json = $this->_format($data);
		echo json_encode($json);
	}
	
	function goodsImgLoad(){
		$model = D('Accessory');
		$data = $model->imgUpload(1,"Goods");
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