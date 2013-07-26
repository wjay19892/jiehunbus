var jvfMap = function(id,lat_1,lng_1,zoom_1,big){
	var map,bounds,marker,locate;
	if(typeof big == 'undefined'){
		big = true;
	}
    lat_1 = lat_1 || 39.915;
	lng_1 = lng_1 || 116.404;
	zoom_1 = zoom_1 || 12;
	map = new BMap.Map(id);            // 创建Map实例
	var point = new BMap.Point(lng_1, lat_1);    // 创建点坐标
	map.centerAndZoom(point,zoom_1);
	map.enableScrollWheelZoom();
	if(big){
		map.addControl(new BMap.NavigationControl());
		map.addControl(new BMap.ScaleControl());
	}
	bounds = new BMap.Bounds();
	// 删除标记
	var deleteMarker = function(){
		if(marker==null ) return ;
		map.clearOverlays();
		marker = null;
		locate = null;
	}();
	
	//增加事件处理
	var Mark = function(_Marker,name){
		if(big){
			var myMarker = _Marker;
			var s = name;
			var infoWindow = new BMap.InfoWindow(s);
		    myMarker.addEventListener("mouseover", function(){this.openInfoWindow(infoWindow);});
			myMarker.addEventListener("dragstart", function(){this.closeInfoWindow();});
			myMarker.addEventListener("dragend", function(){CreateData();});
			map.addEventListener("zoomend", function(){
			   myMarker.closeInfoWindow();
			});
			map.addEventListener("dragstart", function(){myMarker.closeInfoWindow();});
			map.addEventListener("mouseout", function(){myMarker.closeInfoWindow();});
		}
	}
	//增加标记
	var AddMarkerObject = function(center,address,name){
		if(name=="locate"){
			locate = new BMap.Marker(center,{					 
				title: address
			});
			var oldIcon = locate.getIcon();
			var myIcon = new BMap.Icon(ICON,new BMap.Size(23,25));
			myIcon.setImageOffset(oldIcon.imageOffset);
			myIcon.setAnchor(oldIcon.anchor);
			myIcon.setInfoWindowAnchor(oldIcon.infoWindowAnchor); 
			locate.setIcon(myIcon);
			map.addOverlay(locate);
			Mark(locate,"您当前的位置：<br />"+address)
		}else{
			marker = new BMap.Marker(center,{					 
				title: address
			});
			map.addOverlay(marker);
			Mark(marker,name);
		}
	}
	//增加标记 查看编辑使用
	this.addTags = function(lat,lng,ads,zoom,name) {
		var point = new BMap.Point(lng, lat);
		AddMarkerObject(point,ads,name);
		bounds.extend(point);
		map.setCenter(bounds.getCenter());
		map.setViewport(bounds);	
	}
	
}

