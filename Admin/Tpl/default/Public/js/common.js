
function empty(val){
	if(typeof(val) == "undefined" || val==null || val=="" || val==0){
		return true;
	}else{
		return false;
	}
}
function repeatAjaxDone(json){
	DWZ.ajaxDone(json);
	if (json.statusCode == DWZ.statusCode.ok){
		if (json.forwardUrl){
			//setTimeout("ajaxTodo('"+json.forwardUrl+"',repeatAjaxDone);", 500 );
			ajaxTodo(json.forwardUrl,repeatAjaxDone);
		}else{
			if(json.navTabId){
				navTab.reload(json.forwardUrl, {navTabId: json.navTabId});
				$.pdialog.closeCurrent();
			}
		}
	}
}

function replaceHref(t,url){
	sid_user = $('#sid_user').val();
	if(typeof(sid_user) == 'undefined'){
		alertMsg.warn('请选择');
		return false;
	}else{
		location.href=url.replace('{sid_user}',sid_user);
	}
}

function uploadOne(img,input,data){
	var img = $('#'+img);
	if(data.err != ''){
		img.hide();
		alertMsg.error('上传失败');
	}else{
		img.attr('src',data.msg.url);
		img.show();
		var input = $("input[name="+input+"]");
		var isid=arguments[3]?true:false;
        if(isid){
			input.val(data.msg.id);
		}else{
			input.val(data.msg.relpath);
		}
	}
}

function lookUpBack(args,type,group){
	var $box;
	if(empty(type)){
		$box = navTab.getCurrentPanel();
	}else{
		$box = $("body").data(type);
	}
	$box.find(":input[group="+group+"]").each(function(){
		var $input = $(this), field = $input.attr("field");
		for (var key in args) {
			if (field == key) {
				$input.val(args[key]);
				break;
			}
		}
	});
	$.pdialog.closeCurrent();
}

function insertGoodsImg(data){
	if(empty(data.err)){
		var html= '<li class="sortableitem"><div class="jvf_clos"><span onclick="deleteImg(this);">×</span></div><input type="hidden" name="imgs[]" value="'+data.msg.id+'" /><img src="'+data.msg.thumbnail+'" /></li>';
		$('#imgBox').append(html);
	}else{
		alertMsg.error(data.err);
	}
}

function deleteImg(t){
	var li = $(t).parents(".sortableitem");
	li.remove();
}

function imgBoxdrag(){
	$( "#imgBox" ).dragsort({dragSelectorExclude:"span"});
}

function getGroup(t){
	var href = $(t).attr('href');
	var uid = $(t).parent().siblings().find('input[name="main"]').val();
	var length = href.indexOf('/uid/');
	var d = href.substr(0,length);
	if(d){
		href = d;
	}
	href += '/uid/'+uid;
	$(t).attr('href',href);
};

function clearGroup(t){
	$(t).parent().siblings().find('input[group="friends_group"]').val('');
}

function qqface(id,box,top,left){
	var pata = {
			id : 'facebox_'+id, //表情盒子的ID
			assign: 'message_'+id, //给那个控件赋值
			path: PUBLIC+'/Images/face/'	//表情存放的路径
		}
	if(!empty(box))pata.box = box;
	if(!empty(box))pata.top = top;
	if(!empty(box))pata.left = left;
	$('#face_'+id).qqFace(pata);
}

$(function(){
	$('.jvf_jia,.jvf_jian').live('click',function(){
		var href = $(this).attr('href');
		var sort = $(this).parent().prev();
		$.getJSON(href,function(data){
			if(data.status == 1){
				sort.text(data.info);
			}else{
				alertMsg.error(data.info);
			}
		});
		return false;
	});
	
});