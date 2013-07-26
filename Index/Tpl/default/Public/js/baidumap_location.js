var geocoder;
var map = [];
var map_marker;
var markersArray = [];
var bounds = [];
function initialize(mapId, lat_1, lng_1, zoom_1) {
	lat_1 = lat_1 || 39.915;
	lng_1 = lng_1 || 116.404;
	zoom_1 = zoom_1 || 12;
	map[mapId] = new BMap.Map(mapId);            // 创建Map实例
	var point = new BMap.Point(lng_1, lat_1);    // 创建点坐标
	map[mapId].centerAndZoom(point,zoom_1);
	map[mapId].enableScrollWheelZoom();
	map[mapId].addControl(new BMap.NavigationControl({type: BMAP_NAVIGATION_CONTROL_SMALL}));  
	map[mapId].addControl(new BMap.ScaleControl()); 
		
	bounds[mapId] = new BMap.Bounds();
	geocoder = new BMap.Geocoder();
	deleteOverlays(mapId);
}
function codeAddress(address) {
	var ls = new BMap.LocalSearch(map['map_canvas']);
	var myGeo = new BMap.Geocoder();
    myGeo.getPoint(address, function(point){
        if(point){
            AddMarkerObject('map_canvas',point,address);
        }else{
            var ls = new BMap.LocalSearch(map['map_canvas']);
            ls.search(address);
            ls.setSearchCompleteCallback(function(rs){
                if (ls.getStatus() == BMAP_STATUS_SUCCESS){
                    var poi = rs.getPoi(0);
                    if(poi){
                        AddMarkerObject('map_canvas',poi.point,address);
                    }else{
                        alert("标记失败！");
                    }
                }else{
                    alert("标记失败！");
                }
            });
        }
    });
}
function codeLatLng(point) {
    geocoder.getLocation(point, function(rs){
        var address = rs.address;
		if (address) {
			document.getElementById("address").value = address;
		    AddMarkerObject('map_canvas',point,address,'')
		}else {
		    alert("标记失败！" );
		}
    });        

}
//增加标记
function AddMarkerObject(mapId,center,address,name){
	if(mapId=="allmap_canvas"){
		var marker = new BMap.Marker(center,{					 
			title: address
		});
		var oldIcon = marker.getIcon();
		var myIcon = new BMap.Icon(ICON,new BMap.Size(23,25));
		myIcon.setImageOffset(oldIcon.imageOffset);
		myIcon.setAnchor(oldIcon.anchor);
		myIcon.setInfoWindowAnchor(oldIcon.infoWindowAnchor); 
		marker.setIcon(myIcon);

		markersArray.push(marker);
	    map[mapId].addOverlay(marker);
		map_Mark(marker,name)
	}else if(mapId=="map_canvas"){
		deleteMarker();
		map[mapId].setCenter(center);
        map_marker = new BMap.Marker(center,{
			enableDragging: true,						 
			title: address
		});
		var oldIcon = map_marker.getIcon();
		var myIcon = new BMap.Icon(ICON,new BMap.Size(23,25));
		myIcon.setImageOffset(oldIcon.imageOffset);
		myIcon.setAnchor(oldIcon.anchor);
		myIcon.setInfoWindowAnchor(oldIcon.infoWindowAnchor); 
		map_marker.setIcon(myIcon);
		CreateData();
		map[mapId].addOverlay(map_marker);
		Mark(map_marker);
	}
}
//增加标记 查看编辑使用
function addTags(lat,lng,ads,mapId,name) {	
	var point = new BMap.Point(lng, lat);
	if(mapId=="map_canvas"){
		AddMarkerObject(mapId,point,ads,'');
	}else if(mapId=="allmap_canvas"){
        bounds[mapId].extend(point);
		AddMarkerObject(mapId,point,ads,name);
		map[mapId].setCenter(bounds[mapId].getCenter());
		map[mapId].setViewport(bounds[mapId]);	
	}else{
		return ;
	}	
}
//增加事件处理
function Mark(_Marker){
	var myMarker = _Marker;
	var s = "<div id='info' style='width:210px;height:45px;'><p><b>把气球拖动到你要标记的地方</b></p><p>点击左边的 ＋ 和 － 按钮可以缩放地图</p><p><a href='javascript:void(0);' onclick='deleteMarker()'>删除标记</a>&nbsp;&nbsp;&nbsp;&nbsp;<a href='javascript:void(0);' onclick='clearMarker()'>隐藏标记</a></p></div>";
	
	var infoWindow = new BMap.InfoWindow(s);
    myMarker.addEventListener("mouseover", function(){this.openInfoWindow(infoWindow);});
	myMarker.addEventListener("dragstart", function(){this.closeInfoWindow();});
	myMarker.addEventListener("dragend", function(){CreateData();});
	map['map_canvas'].addEventListener("zoomend", function(){
	   myMarker.closeInfoWindow();
       CreateData();
	});
	map['map_canvas'].addEventListener("dragstart", function(){myMarker.closeInfoWindow();});
	map['map_canvas'].addEventListener("mouseout", function(){myMarker.closeInfoWindow();});
}
var activeInfoWindow = null;
var activeInfoWindowMarker = null;
function map_Mark(_Marker,name){
	var myMarker = _Marker;
	
	myMarker.addEventListener("click", function(){openInfoWindow(myMarker,name);});
	map['allmap_canvas'].addEventListener("zoomend", function(){mapListenerCallback();});
	map['allmap_canvas'].addEventListener("dragend", function(){mapListenerCallback();});
	map['allmap_canvas'].addEventListener('rightclick', function(){closeInfoWindow();}); 
}
function openInfoWindow(_Marker,name){
	var c = activeInfoWindow;
	activeInfoWindowMarker = _Marker;
	if(c){
		c.setContent(name);
		activeInfoWindowMarker.openInfoWindow(c);
	}else{
		c = activeInfoWindow = new BMap.InfoWindow(name,{
			maxWidth: 241
		});
		c.addEventListener("closeclick", 
		function(){
			c = activeInfoWindow = activeInfoWindowMarker = null
		});
		activeInfoWindowMarker.openInfoWindow(c);
	}
}
function closeInfoWindow(){
	if(activeInfoWindow){
		map['allmap_canvas'].closeInfoWindow();
		activeInfoWindow = activeInfoWindowMarker = null;
		return true
	}else{
		return false
	}
}
function mapListenerCallback(){
	if (activeInfoWindow && activeInfoWindowMarker) {
		var i = map['allmap_canvas'].pointToPixel(activeInfoWindowMarker.getPosition());
		var j = i.x;
		var g = i.y;
		var d = 107;
		var m = $("#allmap_canvas");
		var e = m.width();
		var c = m.height();
		var k = 252;
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
		markersArray = [];
		map['allmap_canvas'].clearOverlays();
	}else if(mapId=="map_canvas"){
		if(map_marker==null ) return ;
		map['map_canvas'].clearOverlays();
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
		var Lng = gll.lng;
		var Lat = gll.lat;
		var Zoom = map['map_canvas'].getZoom();
		document.getElementById("longitude").value = Lng;
		document.getElementById("latitude").value = Lat;
		document.getElementById("zoom").value = Zoom;
	}
	
}
// 删除标记
function deleteMarker(){
	if(map_marker==null ) return ;
	map['map_canvas'].clearOverlays();
	map_marker = null;
    CreateData();
}
// 隐藏标记
function clearMarker() {
   map['map_canvas'].clearOverlays();
}
// 显示标记
function showMarker() {
    if(map_marker==null ) return ;
    map['map_canvas'].addOverlay(map_marker);
}
