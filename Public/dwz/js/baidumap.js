var geocoder;
var map;
var marker;
function initialize(lat_1, lng_1, zoom_1,id_name) {
	lat_1 = lat_1 || 39.915;
	lng_1 = lng_1 || 116.404;
	zoom_1 = zoom_1 || 12;
	id_name = id_name?id_name:"map_canvas";
	map = new BMap.Map(id_name);            // 创建Map实例
	var point = new BMap.Point(lng_1, lat_1);    // 创建点坐标
	map.centerAndZoom(point,zoom_1);
	map.addControl(new BMap.NavigationControl({type: BMAP_NAVIGATION_CONTROL_SMALL}));  
	map.addControl(new BMap.ScaleControl());  
	//map.addControl(new BMap.MapTypeControl()); 
	map.enableScrollWheelZoom();
	geocoder = new BMap.Geocoder();
	map.addEventListener('click', function(e){codeLatLng(e.point);}); 
}
  
function codeAddress() {
    var address = document.getElementById("address").value;
	var myGeo = new BMap.Geocoder();
    myGeo.getPoint(address, function(point){
        if(point){
            AddMarkerObject(point,address);
        }else{
            var ls = new BMap.LocalSearch(map);
            ls.search(address);
            ls.setSearchCompleteCallback(function(rs){
                if (ls.getStatus() == BMAP_STATUS_SUCCESS){
                    var poi = rs.getPoi(0);
                    if(poi){
                        AddMarkerObject(poi.point,address);
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
		    AddMarkerObject(point,address)
		}else {
		    alert("标记失败！" );
		}
    });        

}
//增加标记
function AddMarkerObject(center,address){
    deleteMarker();
	marker = new BMap.Marker(center,{
		enableDragging: true,					 
		title: address
	});
	map.centerAndZoom(center,map.getZoom());
	map.addOverlay(marker);
	CreateData();
	Mark(marker);
}
//增加标记 查看编辑使用
function addTags(lat,lng,ads,mapId,zoom) {	
	var point = new BMap.Point(lng, lat);
	if(mapId=="map_canvas"){
		AddMarkerObject(point,ads);
		map.centerAndZoom(point,zoom);
	}else{
		return ;
	}	
}
//增加事件处理
function Mark(_Marker){
	var myMarker = _Marker;
	var s = "<b>把气球拖动到你要标记的地方</b><p>拖动左边的比例尺可以缩放地图</p><a href='javascript:void(0);' onclick='deleteMarker()'>删除标记</a><br/><a href='javascript:void(0);' onclick='clearMarker()'>隐藏标记</a>";

	var infoWindow = new BMap.InfoWindow(s);
    myMarker.addEventListener("mouseover", function(){this.openInfoWindow(infoWindow);});
	myMarker.addEventListener("dragstart", function(){this.closeInfoWindow();});
	myMarker.addEventListener("dragend", function(){CreateData();});
	map.addEventListener("zoomend", function(){
	   myMarker.closeInfoWindow();
       CreateData();
	});
	map.addEventListener("dragstart", function(){myMarker.closeInfoWindow();});
	map.addEventListener("mouseout", function(){myMarker.closeInfoWindow();});

}
function CreateData(){
	if(marker==null){
		document.getElementById("longitude").value = "";
		document.getElementById("latitude").value = "";
		document.getElementById("zoom").value = "";
	}else{
		var gll = marker.getPosition();
		var Lng = gll.lng;
		var Lat = gll.lat;
		var Zoom = map.getZoom();
		document.getElementById("longitude").value = Lng;
		document.getElementById("latitude").value = Lat;
		document.getElementById("zoom").value = Zoom;
	}
	
}
// 删除指定标记
function deleteMarker(){
	if(marker==null ) return ;
	map.clearOverlays();
	marker = null;
    CreateData();
}
// 隐藏指定标记
function clearMarker() {
   map.clearOverlays();
}
// 显示所有标记
function showMarker() {
    if(marker==null ) 
	{
		return false;
	}
    map.addOverlay(marker);
}