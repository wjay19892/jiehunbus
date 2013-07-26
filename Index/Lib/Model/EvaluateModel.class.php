<?php
class EvaluateModel extends CommonModel {
	function getEvaluateVal($gid){
		$prefix = C('DB_PREFIX');
    	$data = $this->Table("{$prefix}evaluate as E")->
					  join("RIGHT JOIN {$prefix}evaluate_items as I ON E.item = I.id AND E.gid = {$gid}")->
					  field("I.name,avg(E.value) as avg")->
					  group('I.id')->
					  order('I.sort desc')->
					  findAll();
		return $data;
	}
}
?>