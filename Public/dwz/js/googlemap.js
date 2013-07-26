var geocoder;
var map;
var marker;

function initialize(lat_1, lng_1, zoom_1) {
	lat_1 = lat_1 || 39.904214;
	lng_1 = lng_1 || 116.407413;
	zoom_1 = zoom_1 || 10;
    geocoder = new google.maps.Geocoder();
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
    map = new google.maps.Map(document.getElementById("map_canvas"), myOptions);
	google.maps.event.addListener(map, 'rightclick', function(event) {     codeLatLng(event.latLng);   }); 
}

function setMapsCenter(address){
	geocoder.geocode({'address': address}, function(results, status) {
      if (status == google.maps.GeocoderStatus.OK) {
  		map.setCenter(results[0].geometry.location);
      }
    });
}

function codeAddress() {
    var address = document.getElementById("address").value;
    geocoder.geocode( { 'address': address}, function(results, status) {
      if (status == google.maps.GeocoderStatus.OK) {
        map.setCenter(results[0].geometry.location);
		AddMarkerObject(results[0].geometry.location,address);
      } else {
        alert("标记失败！" + status+"。" );
      }
    });
}

function codeLatLng(addresslatlng) {
    geocoder.geocode({'latLng': addresslatlng}, function(results, status) {
      if (status == google.maps.GeocoderStatus.OK) {
        if (results[0]) {
          address = results[1].formatted_address;
		  document.getElementById("address").value = address;
		  AddMarkerObject(addresslatlng,results[0].formatted_address);
        } else {
          return "";;
        }
      } else {
        return "";
      }
    });
}

//增加标记
function AddMarkerObject(center,address){
    deleteMarker();
	marker = new google.maps.Marker({
		draggable: true,
		map: map, 
		position: center,
		title: address
	});
	CreateData();
	Mark(marker);
}
//增加标记 查看编辑使用
function addTags(lat,lng,ads,mapId,zoom) {	
	var latlng = new google.maps.LatLng(lat, lng);
	if(mapId=="map_canvas"){
		AddMarkerObject(latlng,ads);
		map.setCenter(latlng);
		map.setZoom(zoom);	
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
		infowindow.open(map,myMarker);
	});
	google.maps.event.addListener(map, "mouseout", function() {
		infowindow.close();
	});
	google.maps.event.addListener(myMarker, "dragstart", function() {
		infowindow.close();
	});
	google.maps.event.addListener(map, "idle", function() {											
		infowindow.close();
		CreateData();	
	});
	google.maps.event.addListener(myMarker, "dragend", function() {
	    CreateData();
		infowindow.open(map,myMarker);
	});
}


function CreateData(){
	if(marker==null){
		document.getElementById("longitude").value = "";
		document.getElementById("latitude").value = "";
		document.getElementById("zoom").value = "";
	}else{
		var gll = marker.getPosition();
		var Lng = gll.lng();
		var Lat = gll.lat();
		var Zoom = map.getZoom();
		document.getElementById("longitude").value = Lng;
		document.getElementById("latitude").value = Lat;
		document.getElementById("zoom").value = Zoom;
	}
	
}

// 删除指定标记
function deleteMarker(){
	if(marker==null ) return ;
	marker.setMap(null);
	marker = null;
    CreateData();
}
// 隐藏指定标记
function clearMarker() {
    marker.setMap(null);
}
// 显示所有标记
function showMarker() {
    if(marker==null ) return ;
    marker.setMap(map);
}