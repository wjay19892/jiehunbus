<?php 
//邮件发送类
class Latlng{
	static public $earth_radius = 6378.137;
	
	static public function getDistance($lat1 , $lng1, $lat2, $lng2)
	{
		$radLat1 = deg2rad($lat1);
		$radLat2 = deg2rad($lat2);
		$a = $radLat1 - $radLat2;
		$b = deg2rad($lng1) - deg2rad($lng2);
		$s = 2 * sin(sqrt(pow(sin($a/2),2) + cos($radLat1)*cos($radLat2)*pow(sin($b/2),2)));
		$s = $s * self::$earth_radius;
		$s = round($s * 10000) / 10000;
		return $s;
	}
	
	static public function getRange($lat,$lng,$distance){		
		$dlng = rad2deg(2*asin(sin($distance/(2*self::$earth_radius))/cos(deg2rad($lat))));
		$dlat = rad2deg($distance/self::$earth_radius);
		$arr = array(
				'minlng'=>$lng - $dlng,
				'maxlng'=>$lng + $dlng,
				'minlat'=>$lat - $dlat,
				'maxlat'=>$lat + $dlat,
		);
		return $arr;
	}
}
?>