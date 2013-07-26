<?php
class ApplyModel extends CommonModel {
	public function getOne($id){
		$data = parent::getOne($id);
		if(!empty($data['logo'])){
			$data['logo'] = __ROOT__.$data['logo'];
		}

		return $data;
	}
}
?>