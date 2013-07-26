var geocoder;
var map = [];
var map_marker;
var markersArray = [];
var bounds = [];
var overlay;
function initialize(mapId, lat_1, lng_1, zoom_1) {
	lat_1 = lat_1 || 39.904214;
	lng_1 = lng_1 || 116.407413;
	zoom_1 = zoom_1 || 12;
	geocoder = new google.maps.Geocoder();
	bounds[mapId] = new google.maps.LatLngBounds();
    var latlng = new google.maps.LatLng(lat_1, lng_1);
	
    var myOptions = {
      zoom: zoom_1,
      center: latlng,
	  mapTypeControl: true,
	  mapTypeControlOptions: {style: google.maps.MapTypeControlStyle.DROPDOWN_MENU},
      panControl: true,
      zoomControl: true,
      zoomControlOptions: {
          style: google.maps.ZoomControlStyle.SMALL
      },
      scaleControl: true,     
	  streetViewControl: false,
      mapTypeId: google.maps.MapTypeId.ROADMAP
    }
    map[mapId] = new google.maps.Map(document.getElementById(mapId), myOptions);
	
	if(mapId=="allmap_canvas"){
		overlay = new google.maps.OverlayView();
		overlay.draw = function() {};
		overlay.setMap(map['allmap_canvas']);
	}
	deleteOverlays(mapId);
}

function codeAddress() {
    var address = document.getElementById("address").value;
    geocoder.geocode( { 'address': address}, function(results, status) {
      if (status == google.maps.GeocoderStatus.OK) {
        map['map_canvas'].setCenter(results[0].geometry.location);
		AddMarkerObject('map_canvas',results[0].geometry.location,address,'');
      } else {
        alert("标记失败！" + status+"。" );
      }
    });
}

function codeLatLng(addresslatlng) {
    geocoder.geocode({'latLng': addresslatlng}, function(results, status) {
      if (status == google.maps.GeocoderStatus.OK) {
        if (results[0]) {
          //return results[1].formatted_address;
		  AddMarkerObject('map_canvas',addresslatlng,results[0].formatted_address,'');
        } else {
          return "";;
        }
      } else {
        return "";
      }
    });
}
//增加标记
function AddMarkerObject(mapId,center,address,name){
	if(mapId=="allmap_canvas"){
		var number = markersArray.length;
	}else if(mapId=="map_canvas"){
		var number = 0;
	}
	var image = new google.maps.MarkerImage(ICON,new google.maps.Size(32,32), new google.maps.Point(0,0),new google.maps.Point(16,32));  
	var shadow = new google.maps.MarkerImage(SHADOW, new google.maps.Size(59,32), new google.maps.Point(0,0),new google.maps.Point(16,32)); 
	var marker = new google.maps.Marker({
		draggable: false,
		icon: image,
		shadow: shadow,
		map: map[mapId], 
		position: center,
		title: address,
		zIndex: number
	});
	if(mapId=="allmap_canvas"){
		markersArray[marker.zIndex]=marker;
		map_Mark(marker,name)
	}else if(mapId=="map_canvas"){
		deleteMarker();
		marker.setDraggable(true);
		map_marker=marker;
		Mark(marker);
	}
}
//增加标记 查看编辑使用
function addTags(lat,lng,ads,mapId,name) {	
	var latlng = new google.maps.LatLng(lat, lng);
	if(mapId=="map_canvas"){
		AddMarkerObject(mapId,latlng,ads,'');
		map[mapId].setCenter(latlng);
	}else if(mapId=="allmap_canvas"){
        bounds[mapId].extend(latlng);
		AddMarkerObject(mapId,latlng,ads,name);
		map[mapId].setCenter(bounds[mapId].getCenter());
		map[mapId].fitBounds(bounds[mapId]);
		var zm = map[mapId].getZoom();
		if(zm >13){
			zm = 13;
		}else if(13 > zm  > 10) {
            zm  = zm  - 2;
        }
		map[mapId].setZoom(zm);	
	}else{
		return ;
	}	
}
//增加事件处理
function Mark(_Marker){
	var myMarker = _Marker;
	var s = "<div id='info' style='width:210px;height:45px;'><p><b>把气球拖动到你要标记的地方</b></p><p>点击左边的 ＋ 和 － 按钮可以缩放地图</p><p><a href='javascript:void(0);' onclick='deleteMarker()'>删除标记</a>&nbsp;&nbsp;&nbsp;&nbsp;<a href='javascript:void(0);' onclick='clearMarker()'>隐藏标记</a></p></div>";
	
	var infowindow = new google.maps.InfoWindow({
		content: s
	});
	
	google.maps.event.addListener(myMarker, "mouseover", function() {
		infowindow.open(map['map_canvas'],myMarker);
	});
	google.maps.event.addListener(map['map_canvas'], "mouseout", function() {
		infowindow.close();
	});
	google.maps.event.addListener(myMarker, "dragstart", function() {
		infowindow.close();
	});
	google.maps.event.addListener(map['map_canvas'], "idle", function() {											
		infowindow.close();
		CreateData();	
	});
	google.maps.event.addListener(myMarker, "dragend", function() {
	    CreateData();
		infowindow.open(map['map_canvas'],myMarker);
	});
}
var activeInfoWindow = null;
var activeInfoWindowMarker = null;
function map_Mark(_Marker,name){
	var myMarker = _Marker;
	
	google.maps.event.addListener(myMarker, "click", function() {											
		openInfoWindow(myMarker,name)
	});
	google.maps.event.addListener(map['allmap_canvas'], "rightclick", function() {											
		closeInfoWindow();
	});
	google.maps.event.addListener(map['allmap_canvas'], "idle", function() {
		mapListenerCallback();
	});

}
function openInfoWindow(_Marker,name){
	var c = activeInfoWindow;
	activeInfoWindowMarker = _Marker;
	if(c){
		c.setContent(name);
		c.open(map['allmap_canvas'], _Marker)
	}else{
		c = activeInfoWindow = new google.maps.InfoWindow({
			content: name,
			maxWidth: 241
		});
		google.maps.event.addListenerOnce(c, "closeclick", 
		function(){
			c = activeInfoWindow = activeInfoWindowMarker = null
		});
		c.open(map['allmap_canvas'], _Marker)
	}
}
function closeInfoWindow(){
	if(activeInfoWindow){
		google.maps.event.clearInstanceListeners(activeInfoWindow);
		activeInfoWindow.close();
		activeInfoWindow = activeInfoWindowMarker = null;
		return true
	}else{
		return false
	}
}
function mapListenerCallback(){
	if (activeInfoWindow && activeInfoWindowMarker) {
		var i = overlay.getProjection().fromLatLngToContainerPixel(activeInfoWindowMarker.getPosition());
		var j = i.x;
		var g = i.y;
		var d = 75;
		var m = $("#allmap_canvas");
		var e = m.width();
		var c = m.height();
		var k = 180;
		if (j < 0 || g < 0 || (j > (e + d)) || g > (c + k)) {
			closeInfoWindow();
		}
	}
}
//删除所有标记
function deleteOverlays(mapId) {
	if(mapId=="allmap_canvas"){
		if(markersArray.length ==0 ){ 
			return ;
		}
		if (markersArray) {
			for (i in markersArray) {
				markersArray[i].setMap(null);
			}
			markersArray.length = 0;
			return ;
		}
	}else if(mapId=="map_canvas"){
		if(map_marker==null ) return ;
		map_marker.setMap(null);
		map_marker = null;
		CreateData();
	}
}
function CreateData(){
	if(map_marker==null){
		document.getElementById("longitude").value = "";
		document.getElementById("latitude").value = "";
		document.getElementById("zoom").value = "";
	}else{
		var gll = map_marker.getPosition();
		var Lng = gll.lng();
		var Lat = gll.lat();
		var Zoom = map['map_canvas'].getZoom();
		document.getElementById("longitude").value = Lng;
		document.getElementById("latitude").value = Lat;
		document.getElementById("zoom").value = Zoom;
	}
	
}
// 删除指定标记
function deleteMarker(){
	if(map_marker==null ) return ;
	map_marker.setMap(null);
	map_marker = null;
    CreateData();
}
// 隐藏指定标记
function clearMarker() {
    map_marker.setMap(null);
}
// 显示标记
function showMarker() {
    if(map_marker==null ) return ;
    map_marker.setMap(map['map_canvas']);
}