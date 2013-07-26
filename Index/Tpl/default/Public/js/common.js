window.loadFun = [];
window.onload = function(){
	for(var fun in window.loadFun){
		window.loadFun[fun]();
	}
}

$.extend({
	onload:function(fun) {
		window.loadFun.push(fun);
	}
});

function   j(a,how,b){//正确浮点运算  
    if(a.toString().indexOf(".")   <   0   &&   b.toString().indexOf(".")   <   0){//没小数  
          return   eval(a   +   how   +   b);  
    }  
    //至少一个有小数  
    var   alen   =   a.toString().split(".");  
    if(alen.length   ==   1){//没有小数  
        alen   =   0;  
    }else   {  
            alen   =   alen[1].length;  
      }  
    var   blen   =   b.toString().split(".");  
    if(blen.length   ==   1){  
        blen   =   0;  
    }else   {  
            blen   =   blen[1].length;  
      }
    if(blen   >   alen)alen   =   blen;  
    blen   =   "1";
    for(;alen   >   0;   alen--){//创建一个相应的倍数  
                blen   =   blen   +   "0";
    }
    switch(how){  
          case   "+":  
                        return   Math.round(a   *   blen   +   b   *   blen)   /   blen;  
                  break;  
          case   "-":  
                        return   Math.round(a   *   blen   -   b   *   blen)   /   blen;  
                  break;  
          case   "*":  
                        return   Math.round((a   *   blen)   *   (b   *   blen))   /   (blen   *   blen);  
                  break;  
          default:  
                  return   eval(a   +   how   +   b);  
    }  
}

function jvfDialogAfter(){
	var content = '';
	return content;
}

function toPrice(price){
	price = Math.round(price * 100) / 100;
	price = price.toString();
	var index=price.indexOf('.');
	if(index < 0){
		price += '.';
		index = price.length - 1;
	}
	while(price.length <= index + 2){
		price += '0';
	}
	return price;
}

(function(a) {
    a.fn.textPlaceholder = function() {
    	if(a.browser.msie){
	        var c = "text-placeholder",
	        b = !!("placeholder" in document.createElement("INPUT"));
	        return this.each(function() {
	            if (this.placeholder && b) {
	                return
	            }
	            var e = a(this),
	            g = e.attr("placeholder"),
	            f = e.val(),
	            d = this.form;
	            if (f === "" || f === g) {
	                e.addClass(c);
	                e.val(g)
	            }
	            e.focus(function() {
	                if (e.hasClass(c)) {
	                    e.val("");
	                    e.removeClass(c)
	                }
	            });
	            e.blur(function() {
	                if (e.val() === "") {
	                    e.addClass(c);
	                    e.val(g)
	                } else {
	                    e.removeClass(c)
	                }
	            });
	            if (d) {
	                a(d).submit(function() {
	                    if (e.hasClass(c)) {
	                        e.val("")
	                    }
	                })
	            }
	        })
	    }
    }
})(jQuery);


jQuery.cookie = function(name, value, options) {
    if (typeof value != 'undefined') { // name and value given, set cookie
        options = options || {};
        if (value === null) {
            value = '';
            options.expires = -1;
        }
        var expires = '';
        if (options.expires && (typeof options.expires == 'number' || options.expires.toUTCString)) {
            var date;
            if (typeof options.expires == 'number') {
                date = new Date();
                date.setTime(date.getTime() + (options.expires * 24 * 60 * 60 * 1000));
            } else {
                date = options.expires;
            }
            expires = '; expires=' + date.toUTCString(); // use expires attribute, max-age is not supported by IE
        }
        var path = options.path ? '; path=' + options.path : '';
        var domain = options.domain ? '; domain=' + options.domain : '';
        var secure = options.secure ? '; secure' : '';
        document.cookie = [name, '=', encodeURIComponent(value), expires, path, domain, secure].join('');
    } else { // only name given, get cookie
        var cookieValue = null;
        if (document.cookie && document.cookie != '') {
            var cookies = document.cookie.split(';');
            for (var i = 0; i < cookies.length; i++) {
                var cookie = jQuery.trim(cookies[i]);
                // Does this cookie string begin with the name we want?
                if (cookie.substring(0, name.length + 1) == (name + '=')) {
                    cookieValue = decodeURIComponent(cookie.substring(name.length + 1));
                    break;
                }
            }
        }
        return cookieValue;
    }
};


//QQ表情插件

jQuery.fn.qqFace = function(contentBox,callback) {
	var box = $(contentBox);
	if(box.length <= 0){
		alert('缺少赋值对象');
		return false;
	}
	var path= PUBLIC+'/Images/face/';
	var face = {"\u5fae\u7b11":"14","\u6487\u5634":"1","\u8272":"2","\u53d1\u5446":"3","\u5f97\u610f":"4","\u6d41\u6cea":"5","\u5bb3\u7f9e":"6","\u95ed\u5634":"7","\u7761":"8","\u5927\u54ed":"9","\u5c34\u5c2c":"10","\u53d1\u6012":"11","\u8c03\u76ae":"12","\u5472\u7259":"13","\u60ca\u8bb6":"0","\u96be\u8fc7":"15","\u9177":"16","\u51b7\u6c57":"96","\u6293\u72c2":"18","\u5410":"19","\u5077\u7b11":"20","\u53ef\u7231":"21","\u767d\u773c":"22","\u50b2\u6162":"23","\u9965\u997f":"24","\u56f0":"25","\u60ca\u6050":"26","\u6d41\u6c57":"27","\u61a8\u7b11":"28","\u5927\u5175":"29","\u594b\u6597":"30","\u5492\u9a82":"31","\u7591\u95ee":"32","\u5618":"33","\u6655":"34","\u6298\u78e8":"35","\u8870":"36","\u9ab7\u9ac5":"37","\u6572\u6253":"38","\u518d\u89c1":"39","\u64e6\u6c57":"97","\u62a0\u9f3b":"98","\u9f13\u638c":"99","\u7cd7\u5927\u4e86":"100","\u574f\u7b11":"101","\u5de6\u54fc\u54fc":"102","\u53f3\u54fc\u54fc":"103","\u54c8\u6b20":"104","\u9119\u89c6":"105","\u59d4\u5c48":"106","\u5feb\u54ed\u4e86":"107","\u9634\u9669":"108","\u4eb2\u4eb2":"109","\u5413":"110","\u53ef\u601c":"111","\u83dc\u5200":"112","\u897f\u74dc":"89","\u5564\u9152":"113","\u7bee\u7403":"114","\u4e52\u4e53":"115","\u5496\u5561":"60","\u996d":"61","\u732a\u5934":"46","\u73ab\u7470":"63","\u51cb\u8c22":"64","\u793a\u7231":"116","\u7231\u5fc3":"66","\u5fc3\u788e":"67","\u86cb\u7cd5":"53","\u95ea\u7535":"54","\u70b8\u5f39":"55","\u5200":"56","\u8db3\u7403":"57","\u74e2\u866b":"117","\u4fbf\u4fbf":"59","\u6708\u4eae":"75","\u592a\u9633":"74","\u793c\u7269":"69","\u62e5\u62b1":"49","\u5f3a":"76","\u5f31":"77","\u63e1\u624b":"78","\u80dc\u5229":"79","\u62b1\u62f3":"118","\u52fe\u5f15":"119","\u62f3\u5934":"120","\u5dee\u52b2":"121","\u7231\u4f60":"122","NO":"123","OK":"124","\u7231\u60c5":"42","\u98de\u543b":"85","\u8df3\u8df3":"43","\u53d1\u6296":"41","\u6004\u706b":"86","\u8f6c\u5708":"125","\u78d5\u5934":"126","\u56de\u5934":"127","\u8df3\u7ef3":"128","\u6325\u624b":"129","\u6fc0\u52a8":"130","\u8857\u821e":"131","\u732e\u543b":"132","\u5de6\u592a\u6781":"133","\u53f3\u592a\u6781":"134"};
	if($('.dFace').length <= 0){
		var html = '<div class="dFace" style="display:none;"><div>';
		for(x in face){
			html += '<a href="javascript:;" title="'+x+'" face="'+face[x]+'"></a>';
		}
		html +='</div><div class="facePreview" style="display:none;"><div><p class="faceImg"><img src=""></p><p class="faceName"></p></div></div>';
		$('body').append(html);
		$('.dFace a').hover(function(e){
		    var left = $('.dFace').offset().left + $('.dFace').width() / 2;
			var facePreview = $('.dFace .facePreview');
			if(e.pageX < left){
				facePreview.css({marginLeft:350});
			}else{
				facePreview.css({marginLeft:-1});
			}
			var src = path+$(this).attr('face')+'.gif';
			var title = $(this).attr('title');
			facePreview.find('.faceImg img').attr('src',src);
			facePreview.find('.faceName').text(title);
			facePreview.show();
		},function(){
			$('.dFace .facePreview').hide();
		});
	}
	var undoc = function(){
		$('.dFace a').unbind('click.face');
		$('.dFace').hide();
	}

	var uncli = function(){
		if(typeof callback == 'function'){
			callback();
		}
	}
	var clearEvent = function (){
		$('.dFace a').unbind('click.face');
		$(document).unbind('click.face');
	}
	return this.each(function(){
		$(this).unbind('click');
		$(this).click(function(){
			clearEvent();
		    var offset = $(this).offset();
			var xtop = offset.top + $(this).height();
			$('.dFace').css({top:xtop,left:offset.left}).show();
			setTimeout(function() {
				$('.dFace a').one('click.face',function(){
					var title='['+$(this).attr('title')+']';
					box.val(box.val()+title);
					uncli();
					undoc();
					return false;
				});
				$(document).one('click.face',function(){
					undoc();
				});
			},0);
		});
	});
}

jQuery.cookie = function(name, value, options) {
    if (typeof value != 'undefined') { // name and value given, set cookie
        options = options || {};
        if (value === null) {
            value = '';
            options.expires = -1;
        }
        var expires = '';
        if (options.expires && (typeof options.expires == 'number' || options.expires.toUTCString)) {
            var date;
            if (typeof options.expires == 'number') {
                date = new Date();
                date.setTime(date.getTime() + (options.expires * 24 * 60 * 60 * 1000));
            } else {
                date = options.expires;
            }
            expires = '; expires=' + date.toUTCString(); // use expires attribute, max-age is not supported by IE
        }
        var path = options.path ? '; path=' + options.path : '';
        var domain = options.domain ? '; domain=' + options.domain : '';
        var secure = options.secure ? '; secure' : '';
        document.cookie = [name, '=', encodeURIComponent(value), expires, path, domain, secure].join('');
    } else { // only name given, get cookie
        var cookieValue = null;
        if (document.cookie && document.cookie != '') {
            var cookies = document.cookie.split(';');
            for (var i = 0; i < cookies.length; i++) {
                var cookie = jQuery.trim(cookies[i]);
                // Does this cookie string begin with the name we want?
                if (cookie.substring(0, name.length + 1) == (name + '=')) {
                    cookieValue = decodeURIComponent(cookie.substring(name.length + 1));
                    break;
                }
            }
        }
        return cookieValue;
    }
};


jQuery.fn.upMove = function(item,num,time) {
	if(!time){time = 3000}
    return this.each(function(){
    	var c = {
    			id:$(this),
    			move:function(item,num){
    				var id = this.id;
    				var div = id.find(item);
    				var length = div.length;
    		    	if(length < num){
    		    		return false;
    		    	}
    		    	var end = length - 1;
			    	var first = div.eq(0);
			    	var last = div.eq(end);
			    	var height = '-'+first.outerHeight();
			    	id.animate({marginTop: height},500,function(){
			    		id.css('margin-top','0px');
			    		first.insertAfter(last);
			    	});
    			}
    	}
    	setInterval(function(){
    		c.move(item,num);
    	},time);
    });
}

jQuery.fn.tip = function(content,time) {
    return this.each(function(){
    	var uuid = guid();
    	var t = $(this);
    	t.removeTip();
    	t.attr('guid',uuid);
    	var offset = $(this).offset();
    	var left = offset.left + $(this).outerWidth() + 8;
    	var style='style="top:'+offset.top+'px;left:'+left+'px;"';
    	var html = '<div class="jvf_prompt" id="'+uuid+'" '+style+'>'+content+'</div>';
    	$('body').append(html);
    	if(time){
    		$('#'+uuid).fadeOut(time,function(){
    			//t.removeTip();
    			$(this).remove();
    			t.removeAttr('guid');
    		});
    	}
    });
}

jQuery.fn.removeTip = function() {
    return this.each(function(){
    	var uuid = $(this).attr('guid');
    	$('#'+uuid).remove();
    	$(this).removeAttr('guid');
    });
}

var shoppingCartNum = {
		inc:function(){
			var num = parseInt($('#shoppingCartNum').text());
			num++;
			$('#shoppingCartNum').text(num);
		},
		dec:function(){
			var num = parseInt($('#shoppingCartNum').text());
			num--;
			$('#shoppingCartNum').text(num);
		},
		update:function(num){
			var num = parseInt(num);
			$('#shoppingCartNum').text(num);
		}
}

var loading = {
		id:'#jvf_loading',
		html:'<div class="jvf_loading" id="jvf_loading"><img src="'+TPL_PUBLIC+'images/loading.gif" /><span></span></div>',
		ing:L.LOADING,
		empty:L.LOADING_END,
		loadingStart:function(box){
			$loading = $(this.html);
			$loading.find('span').text(this.ing);
			$(box).append($loading);
			$loading.show();
		},
		loadingEnd:function(){
			$loading = $('.jvf_loading');
			$loading.remove();
		},
		loadingNot:function(box){
			this.loadingEnd();
			$loading = $(this.html);
			$loading.find('span').text(this.empty);
			$(box).append($loading);
			$loading.show();
			var t = this;
			setTimeout(function() {
				t.loadingEnd();
			},2000);
		}
}

var maxTextNum = 140;

function islogin(){
	var login = $.cookie('islogin');
	if(login){
		return true;
	}else{
		return false;
	}
}

function guid(){
	var c= {g:function(){
		return (((1 + Math.random()) * 0x10000) | 0).toString(16).substring(1);
	}};
	var guid = (c.g() + c.g() + "-" + c.g() + "-" + c.g() + "-" +
			c.g() + "-" + c.g() + c.g() + c.g()).toUpperCase();
	return guid;
}

function globalEvent(){
	$("input[placeholder], textarea[placeholder]").textPlaceholder();
	
	$.datepicker.regional['zh-CN'] = {
		closeText: '关闭',
		prevText: '&#x3c;上月',
		nextText: '下月&#x3e;',
		currentText: '今天',
		monthNames: ['一月','二月','三月','四月','五月','六月',
		'七月','八月','九月','十月','十一月','十二月'],
		monthNamesShort: ['一','二','三','四','五','六',
		'七','八','九','十','十一','十二'],
		dayNames: ['星期日','星期一','星期二','星期三','星期四','星期五','星期六'],
		dayNamesShort: ['周日','周一','周二','周三','周四','周五','周六'],
		dayNamesMin: ['日','一','二','三','四','五','六'],
		weekHeader: '周',
		dateFormat: 'yy-mm-dd',
		firstDay: 1,
		isRTL: false,
		showMonthAfterYear: true,
			yearRange:"c-70:c+10",
		yearSuffix: '年'};
	$.datepicker.setDefaults($.datepicker.regional['zh-CN']);
		
	$('.header .header_top li.left_mu2').hover(function(){
		$(this).find('span.weizhi_con').show();
	},function(){
		$(this).find('span.weizhi_con').hide();
	});
	
	$('.header .header_search .header_search_inp1').hover(function(){
		$(this).find('ul').show();
	},function(){
		$(this).find('ul').hide();
	});
	
	$('.header .header_search_inp1 ul a').click(function(){
		$(this).parent().parent().siblings('div.moren').text($(this).text());
		$('#searchForm').attr('action',$(this).attr('rel'));
	});
	
	$('#searchForm input[name="submit_button"]').click(function(){
		$('#searchForm').submit();
	});
	
	$('.jvf_getUser').live('mouseover',function(){
		var t = $(this);
		var uid = $(this).attr('uid');
		if(uid){
			var uuid = $(this).attr('guid');
			if(uuid){
				$('#'+uuid).show();
			}else{
				var uuid = guid();
				$.get(APP+'/Index/getUser/uid/'+uid,function(data){
					var html = '<div class="jvf_information_box" id="'+uuid+'" style="display:none;">';
					html += data;
					html += '</div>';
					$('body').append(html);
					t.attr('guid',uuid);
					var offset = t.offset();
			    	var left = offset.left + t.outerWidth();
			    	$('#'+uuid).css({top:offset.top,left:left});
			    	t.one('mousemove',function(){
			    		$('#'+uuid).show();
			    	}).one('mouseout',function(){
			    		$('#'+uuid).hide();
			    	});
				});
			}
		}
	}).live('mouseout',function(){
		var uuid = $(this).attr('guid');
		if(uuid){
			window.jvf_information_box = setTimeout(function() {
			$('#'+uuid).hide();
			},200);
		}		
	});
	
	$('.jvf_information_box').live('mouseover',function(){
		clearTimeout(window.jvf_information_box);
		$(this).show();
	}).live('mouseout',function(){
		$(this).hide();
	});
	
	$('.information_box_head .but_a[add="add"]').live('click',function(){
		var t = $(this);
		var href = $(this).attr('href');
		$.getJSON(href,function(data){
			if(data.status == 1){
				t.tip(data.info,2000);
				t.text(L.REMOVE_ATTENTION);
				t.removeAttr('add');
				t.attr('href',href.replace('attention','removeattention'));
				t.attr('remove','remove');
			}else{
				t.tip(data.info,3000);
			}
		});
		return false;
	});
	
	$('.information_box_head .but_a[remove="remove"]').live('click',function(){
		var t = $(this);
		var href = $(this).attr('href');
		$.getJSON(href,function(data){
			if(data.status == 1){
				t.tip(data.info,2000);
				t.text(L.ADD_ATTENTION);
				t.removeAttr('remove');
				t.attr('href',href.replace('removeattention','attention'));
				t.attr('add','add');
			}else{
				t.tip(data.info,3000);
			}
		});
		return false;
	});
	
	$('.jvf_boxnav a:not([uid])').live('click',function(){
		var t = $(this);
		var href = t.attr('href');
		var uuid = guid();
		t.attr('guid',uuid);
		loginAfter(function(){
			$.getJSON(href,function(data){
				if(data.status == 1){
					jvfDialogHtml(uuid, data.info);
				}else{
					t.tip(data.info,2000);
				}
			});
		});
		return false;
	});
	
	
	if(first_landing){
		$.onload(function(){
			var uuid = guid();
			jvfDialog(uuid,APP+'/Member/step');
		});
	}
	
	if(islogin() && ISCHAT == 1){
		chatBox();
	}else{
		$('a.jvf_callme').live('click',function(event){
			jvfDialog('signinDialog',APP+'/User/signin');
		});
	}
}

function addressMap(){
	$('.jvf_address').live('click',function(){
		var gid = $(this).attr('gid');
		var uid = $(this).attr('uid');
		if(gid){
			para = 'gid/'+gid;
		}
		if(uid){
			para = 'uid/'+uid;
		}
		jvfDialog('mapsbox_'+gid, APP+'/Index/maps/'+para);
	});
}


function index(){
	$('#slides').slides({
		preload: true,
		preloadImage: '../Public/images/slide_img/loading.gif',
		play: 5000,
		pause: 2500,
		hoverPause: true,
		animationStart: function(){
			$('.caption').animate({
				bottom:-35
			},100);
		},
		animationComplete: function(current){
			$('.caption').animate({
				bottom:0
			},200);
			if (window.console && console.log) {
				// example return of current slide number
				//console.log(current);
			};
		}
	});
	$('#nerby li').hover(function(){
		$('#nerby .small_nerby').show();
		$('#nerby .big_nerby').hide();
		$(this).find('.small_nerby').hide();
		$(this).find('.big_nerby').show();
	});
	$('#newComment').upMove('.pingjia_con',3);
	collect();
	addressMap();
}

function collect(){
	var collClick = function(t){
		var t = $(t);
		loginAfter(function(){
			var url = t.attr('href');
			$.getJSON(url,function(data){
				t.tip(data.info,2000);
				if(data.status == 1){
					if(t.is('.coll')){
						url = url.replace('saveFavorites','removeFavorites');
						t.attr('href',url);
						t.removeClass('coll');
						t.addClass('collHover');
					}else{
						url = url.replace('removeFavorites','saveFavorites');
						t.attr('href',url);
						t.removeClass('collHover');
						t.addClass('coll');
					};
				}
			});
		});
	}
	
	var cartClick = function(t){
		var t = $(t);
		var url = t.attr('href');
		var id = t.attr('rel');
		$.getJSON(url,function(data){
			if(data.status == 1){
				if(t.is('.cart')){
					t.tip(data.info,2000);
					t.attr('href',APP+'/Goods/updateNum/id/'+id+'/num/0');
					t.removeClass('cart');
					t.addClass('cartHover');
					shoppingCartNum.inc();
				}else{
					t.tip(L.SUCCESS_REMOVE_SHOPPINGCART,2000);
					t.attr('href',APP+'/Goods/buy/id/'+id);
					t.removeClass('cartHover');
					t.addClass('cart');
					shoppingCartNum.dec();
				};
			}else{
				t.tip(data.info,2000);
			}
		});
	}
	
	$('.shop_all .coll').live('mouseover',function(){
		$(this).tip(L.ADD_FAVORITES);
	}).live('mouseout',function(){
		$(this).removeTip();
	}).live('click',function(){
		collClick(this);
		return false;
	});
	
	$('.shop_all .collHover').live('mouseover',function(){
		$(this).tip(L.REMOVE_FAVORITES);
	}).live('mouseout',function(){
		$(this).removeTip();
	}).live('click',function(){
		collClick(this);
		return false;
	});
	
	$('.shop_all .cart').live('mouseover',function(){
		$(this).tip(L.ADD_SHOPPINGCART);
	}).live('mouseout',function(){
		$(this).removeTip();
	}).live('click',function(){
		cartClick(this);
		return false;
	});
	
	$('.shop_all .cartHover').live('mouseover',function(){
		$(this).tip(L.REMOVE_SHOPPINGCART);
	}).live('mouseout',function(){
		$(this).removeTip();
	}).live('click',function(){
		cartClick(this);
		return false;
	});
}

function loginAfter(fn){
	if(islogin()){
		fn();
	}else{
		jvfDialog('signinDialog',APP+'/User/signin');
	};
};
window.jvfdialogmap = {};
function jvfDialog(id,url){
	if(window.jvfdialogmap[id]){
		$('#'+id).dialog('open');
	}else{
		window.jvfdialogmap[id] = url;
		$.get(url,function(data){
			$(data).appendTo('body').attr('id',id);
			$('#'+id).dialog({
				modal: true,
				resizable:false,
				width:$('#'+id).width(),
			});
		});
	}
}

function jvfDialogHtml(id,html,option){
    var $html = $('#'+id);
	if($html.html()){
        $html.dialog('open');
	}else{
        $(html).appendTo('body').attr('id',id);
        $html = $('#'+id);
        var op = {
            modal: true,
            resizable:false,
            width:$html.width(),
            minHeight:$html.height()
        }
        $.extend(op,option || {});
        $html.dialog(op);
	}
}

function city(){
	$('#changeCity select[name="province"]').change(function(){
		var pid = $(this).val();
		if(pid != -1){
			$.getJSON(APP+'/Index/cityChild/pid/'+pid,function(data){
				if(data.status == 1){
					var html = $('#changeCity #defaultCity').html();
					for(var vo in data.info){
						html += '<option value="'+data.info[vo].spelling+'">'+data.info[vo].name+'</option>';
					}
					$('#changeCity select[name="city"]').html(html);
				}
			});
		}	
	});
	
	$('#changeCity input[type="button"]').click(function(){
		var cy = $('#changeCity select[name="city"]').val();
		if(cy != -1){
			goUrl(APP+'/'+cy);
		}
	});
	
	$('.hasallcity li').hover(function(){
		$('.hasallcity li').removeClass('hover');
		$(this).addClass('hover');
	});
}

function goUrl(url){
	window.location.href=url;
};

function visit_location(){
	$('#setvisit_locationform #submit').click(function(){
		var para = $('#setvisit_locationform').serialize();
		var action = $('#setvisit_locationform').attr('action');
		var t = $(this);
		if(!$('#setvisit_locationform #address').val()){
			t.tip(L.MEMBER_LOCATION_ADDRESS_EMPTY);
		}else{
			$.post(action,para,function(data){
				if(data.status == 1){
					t.tip(data.info,2000);
					goUrl(APP+'/Index/index');
				}else{
					t.tip(data.info,2000);
				}
			},'json');
		}
	});
	$('#setvisit_locationform #addmarker').click(function(){
		codeAddress($('#setvisit_locationform #address').val());
	});
	
	$('#setvisit_locationform #showmarker').click(function(){
		showMarker();
	});
	
	$('#setvisit_locationform #address').keypress(function(e){
		var keyCode = e.keyCode ? e.keyCode : e.which ? e.which : e.charCode;
		if (keyCode == 13) {  
			codeAddress($('#setvisit_locationform #address').val());
            return false;
        } else {  
            return true;
        }
	});
}

function signin(ajaxbool){
	var submit = function(){
		var para = $('#signinform').serialize();
		var action = $('#signinform').attr('action');
		var t = $('#signinform #submit');
		var signin_email = $('#signinform #signin_email').val();
		var signin_password =$('#signinform #signin_password').val();
		if(!signin_email){
			$('#signinform #signin_email').tip(L.PLEASE_INPUT_MAIL);
		}else if(!signin_password){
			$('#signinform #signin_password').tip(L.PLEASE_INPUT_PASSWORD);
		}else{
			$.post(action,para,function(data){
				t.tip(data.info,2000);
				if(data.status==2)goUrl(APP+"/User/noverifymail");
				if(data.status==1){
					if(ajaxbool){
						window.location.reload();
					}else{
						goUrl(APP+'/Member/index');
					}
				}
			},'json');
		}
	}
	$('#signinform #submit').click(function(){
		submit();
	});
	
	$('#signinform #signin_password').keypress(function(e){
		var keyCode = e.keyCode ? e.keyCode : e.which ? e.which : e.charCode;
		if (keyCode == 13) {  
			submit();
        }
	});
	
	$('#signinform #signin_email,#signinform #signin_password').focus(function(){
		$(this).removeTip();
	});
	
	$('#forgotPassword').click(function(){
		var url = $(this).attr('href');
		jvfDialog('forgotPassworDialog', url);
		return false;
	});
}

function register(){
	$('#user_new #submit').click(function(){
		var para = $('#user_new').serialize();
		var action = $('#user_new').attr('action');
		var t = $(this);
		var user_first_name = $('#user_new #user_first_name').val();
		var user_email =$('#user_new #user_email').val();
		var user_password =$('#user_new #user_password').val();
		var user_password_confirmation =$('#user_new #user_password_confirmation').val();
		if(!user_first_name){
			$('#user_new #user_first_name').tip(L.PLEASE_INPUT_USERNAME);
		}else if(!user_email){
			$('#user_new #user_email').tip(L.PLEASE_INPUT_MAIL);
		}else if(!user_password){
			$('#user_new #user_password').tip(L.PLEASE_INPUT_PASSWORD);
		}else if(!user_password_confirmation){
			$('#user_new #user_password_confirmation').tip(L.PLEASE_INPUT_CONFIRM_PASSWORD);
		}else{
			$.post(action,para,function(data){
				t.tip(data.info,2000);
				if(data.status==1)goUrl(APP+"/Member/index");
				if(data.status==2)goUrl(APP+"/User/noverifymail");
				if(data.status==3)goUrl(APP+"/User/noverifymail");
			},'json');
		}
	});
	
	$('#user_new #user_first_name,#user_new #user_email,#user_new #user_password,#user_new #user_password_confirmation').focus(function(){
		$(this).removeTip();
	});
	
	$('#user_new .agreement').click(function(){
		var t = $(this);
		var url = t.attr('href');
		var uuid = t.attr('guid');
		if(!uuid){
			uuid = guid();
			t.attr('guid',uuid);
		}
		jvfDialog(uuid, url);
		return false;
	});
}

function goodsIndex(gid){
	$.getScript(TPL_PUBLIC+'js/jquery.colorbox-min.js');
	$('#extension_detail li').click(function(){
		var li = $('#extension_detail li');
		var div = $('#extension .extension_con');
		var index = li.index($(this));
		li.removeClass('selected');
		$(this).addClass('selected');
		div.hide();
		div.eq(index).show();
	});
	
	$('#exchange_tab li a').click(function(){
		var t = $(this);
		var crr_li = t.parent();
		var li = $('#exchange_tab li');
		var div = $('#exchange .extension_exchange');
		var index = li.index(crr_li);
		li.removeClass('selected');
		crr_li.addClass('selected');
		div.hide();
		div.eq(index).show();
		if(t.attr('get')){
			var url = t.attr('href');
			$.get(url,function(data){
				div.eq(index).html(data);
				t.removeAttr('get');
			});
		}
		return false;
	});
	
	$('#bigMap,#addressMap').click(function(){
		var gid = $(this).attr('rel');
		jvfDialog('maps', APP+'/Index/maps/gid/'+gid);
	});
	
	var imgCycle = function(op){
		var li = $('.exhibition_list_con li');
		var active = $('.exhibition_list_con li.pic_active');
		var index = li.index(active);
		var lenth = li.index();
		if(op.left){
			index--;
			if(index < 0){
				index = lenth;
			}
		}
		if(op.right){
			index++;
			if(index > lenth){
				index = 0;
			}
		}
		if(op.obj){
			index = li.index(op.obj);
		}
		var crr = li.eq(index);
		li.removeClass('pic_active');
		crr.addClass('pic_active');
		$('.exhibition img').attr('src',crr.find('a').attr('href'));
	}
	
	$('.exhibition_list_left').click(function(){
		imgCycle({left:true});
	});
	
	$('.exhibition_list_right').click(function(){
		imgCycle({right:true});
	});
	
	$('.exhibition_list_con li a').click(function(){
		imgCycle({obj:$(this).parent()});
		return false;
	});
	
	$('.exhibition').click(function(){
		$(".exhibition_list_con li a").colorbox({rel:'goodsImg',open:true});
	});
	
	$('.jvf_report a').click(function(){
		var t = $(this);
		var url = t.attr('href');
		var uuid = t.attr('guid');
		if(!uuid){
			uuid = guid();
			t.attr('guid',uuid);
		}
		loginAfter(function(){
			jvfDialog(uuid, url);
		});
		return false;
	});
	
	var collClick = function(t){
		var t = $(t);
		var parent = t.parent();
		loginAfter(function(){
			var url = t.attr('href');
			$.getJSON(url,function(data){
				//t.tip(data.info,2000);
				if(data.status == 1){
					if(parent.is('.price_collection')){
						url = url.replace('saveFavorites','removeFavorites');
						t.attr('href',url);
						t.text(L.REMOVE_FAVORITES);
						parent.removeClass('price_collection');
						parent.addClass('price_collectionHover');
					}else{
						url = url.replace('removeFavorites','saveFavorites');
						t.attr('href',url);
						t.text(L.ADD_FAVORITES);
						parent.removeClass('price_collectionHover');
						parent.addClass('price_collection');
					};
				}
			});
		});
	}
	
	var cartClick = function(t){
		var t = $(t);
		var url = t.attr('href');
		var id = t.attr('rel');
		var parent = t.parent();
		$.getJSON(url,function(data){
			if(data.status == 1){
				if(parent.is('.price_cart')){
					//t.tip(data.info,2000);
					t.attr('href',APP+'/Goods/updateNum/id/'+id+'/num/0');
					t.text(L.REMOVE_TEXT);
					parent.removeClass('price_cart');
					parent.addClass('price_cartHover');
					shoppingCartNum.inc();
				}else{
					//t.tip(L.SUCCESS_REMOVE_SHOPPINGCART,2000);
					t.attr('href',APP+'/Goods/buy/id/'+id);
					t.text(L.ADD_SHOPPINGCART);
					parent.removeClass('price_cartHover');
					parent.addClass('price_cart');
					shoppingCartNum.dec();
				};
			}else{
				t.tip(data.info,2000);
			}
		});
	}
	
	$('.price_bot .price_collection a').live('click',function(){
		collClick(this);
		return false;
	});
	
	$('.price_bot .price_collectionHover a').live('click',function(){
		collClick(this);
		return false;
	});
	
	$('.price_bot .price_cart a').live('click',function(){
		cartClick(this);
		return false;
	});
	
	$('.price_bot .price_cartHover a').live('click',function(){
		cartClick(this);
		return false;
	});
	$.get(APP+'/Talk_about/lists/gid/'+gid,function(data){
		$('#exchange div.extension_exchange').eq(0).html(data);
	});
	
	$('.jvf_page a').live('click',function(e){
		var t = $(this);
		var href = t.attr('href');
		var box = t.parents('.extension_exchange');
		$.get(href,function(data){
			box.html(data);
		});
		return false;
	});
	
	$('.msgbox .mediawrap li a').live('click',function(){
		var uuid = guid();
		$(this).parent().parent().find('a').colorbox({rel:uuid,open:true,maxWidth:900});
		return false;
	});
	
	$('.jvf_message').live('click',function(){
		var t = $(this);
		var href = t.attr('href');
		var uuid = guid();
		t.attr('guid',uuid);
		loginAfter(function(){
			$.getJSON(href,function(data){
				if(data.status == 1){
					jvfDialogHtml(uuid, data.info);
				}else{
					t.tip(data.info,2000);
				}
			});
		});
		return false;
	});
	
	talk_about();
	talk_aboutReply();
	talk_aboutMsg();
}

var getLength = function(str) {
		return Math.ceil(str.replace(/^\s+|\s+$/ig,'').replace(/[^\x00-\xff]/ig,'xx').length/2);
};

function talk_about(){
	var countNum = function(){
		var num = getLength($('#talk_aboutBox textarea[name="content"]').val());
		var textNum = maxTextNum - num;
		var html;
		if(textNum < 0){
			html = L.EXCEED+'<em class="error">'+Math.abs(textNum)+'</em>'+L.WORD_TEXT;
		}else{
			html = L.CAN_ENTER+'<em>'+textNum+'</em>'+L.WORD_TEXT;
		}
		$('#talk_aboutBox #textNum').html(html);
	}
	$('#talk_aboutBox textarea[name="content"]').keyup(function(e){
		countNum();
	});
	
	$('#talk_aboutBox #face').qqFace('#talk_aboutBox textarea[name="content"]',function(){
		countNum();
	});
	
	$('#talk_aboutBox #quanzhi a').click(function(){
		var t = $(this);
		var content = $('#talk_aboutBox textarea[name="content"]');
		content.val(content.val()+'#'+t.text()+'#');
		countNum();
	});
	
	$('#talk_aboutBox #label').click(function(){
		var t = $(this);
		var content = $('#talk_aboutBox textarea[name="content"]');
		var default_label = '#'+L.DEFAULT_LABEL+'#';
		var crr_content = content.val()+default_label;
		var start = content.val().indexOf(default_label)+ 1;
		textArea = content[0];
		if(!start){
			content.val(crr_content);
			start = content.val().indexOf(default_label)+ 1;
		}
        var end = start + default_label.length - 2;
        if ($.browser.msie) { //IE
             var rng = textArea.createTextRange();
             rng.collapse(true);
             rng.moveEnd("character",end)
             rng.moveStart("character",start)
             rng.select();
        }else if (textArea.selectionStart || (textArea.selectionStart == '0')) { // Mozilla/Netscape…
            textArea.selectionStart = start;
            textArea.selectionEnd = end;
        }
		countNum();
	});
	
	$('#talk_aboutBox #friend').click(function(){
		var t = $(this);
		var uuid = t.attr('guid');
		if(!uuid){
			uuid = guid();
			t.attr('guid',uuid);
			$.get(APP+'/Member/friendAll',function(data){
				var html = $(data);
				$('body').append(html);
				html.attr('id',uuid);
				var offset = t.offset();
		    	var left = offset.left -60;
		    	var top = offset.top + t.outerHeight() + 9;
		    	html.css('left',left+'px');
		    	html.css('top',top+'px');
		    	html.show();
			});
		}else{
			var box = $('#'+uuid);
			if(box.is(':hidden')){
				box.show();
			}else{
				box.hide();
			}
		}
	});
	
	$('#talk_aboutBox #submit').click(function(){
		var t = $(this);
		loginAfter(function(){
			var para = $('#talk_aboutBox').serialize();
			var num = getLength($('#talk_aboutBox textarea[name="content"]').val());
			var textNum = maxTextNum - num;
			if(textNum < 0){
				t.tip(L.EXCEED+Math.abs(textNum)+L.WORD_TEXT,2000);
			}else{
				$.post(APP+'/Member/doTalk_about',para,function(data){
					if(data.status == 0){
						t.tip(data.info,2000);
					}else{
						t.tip(L.RELEASE_SUCCESS,2000);
						$('#talk_aboutBox .jvf_sample_list').html('');
						$('#talk_aboutBox textarea[name="content"]').val('');
						countNum();
						$.get(APP+'/Talk_about/getOne/tid/'+data.info,function(content){
							$('#exchange div.extension_exchange').eq(0).find('ul.talk_aboutBox').prepend(content);
						});
					}
				},'json');
			}
		});
	});
	
	$('#talk_aboutBox .jvf_sample a.del').live('click',function(){
		var box = $('#talk_aboutBox .jvf_sample_list');
		var div = $(this).parents('.jvf_sample');
			div.remove();
		if(!box.html()){
			box.hide();
		}
	});
	
	$.getScript(PUBLIC+'/dwz/js/jquery.ajaxupload.js',function(){
		new AjaxUpload('#imgs', {
		    action: APP+'/Xheditor/upLoadImg',
		    name: 'images',
		    onSubmit : function(file , ext){
		        if (ext && /^(jpg|png|jpeg|gif)$/.test(ext)){
		            this.setData({
		            'ext': ext
		            });
		            this.disable();
		        } else {
		            return false;
		        }
		    },
		    onComplete : function(file,response){
		    	var data=eval("("+response+")");
		    	if(data.err == ''){
		    		var box = $('#talk_aboutBox .jvf_sample_list');
		    		var html = '<div class="jvf_sample clearfix"><input name="imgs[]" type="hidden" value="'+data.msg.id+'"><span class="jvf_fl clearfix"><em class="jvf_allimg sample_img jvf_fl"></em><a class="filename jvf_fl" href="'+ROOT+data.msg.relpath+'" target="_blank">'+data.msg.localname+'</a></span><a class="del jvf_allimg jvf_fl" href="javascript:;"></a></div>';
		    		box.append(html);
		    		box.show();
		    	}else{
		    		$('#imgs').tip(data.err);
		    	}
		        this.enable();
		    }
		});		
	});

	$('.go_sina,.go_qzone').live('click',function(){
		var t = $(this);
		var url = t.attr('href');
		$.getJSON(url,function(data){
			if(data.status == 1){
				t.attr('class',t.attr('class').replace('go_','close_'));
				t.attr('href',url.replace('remove','bind'));
			}
		});
		return false;
	});

	$('.close_sina,.close_qzone').live('click',function(){
		var t = $(this);
		var url = t.attr('href');
		var type = t.attr('type');
		if(type == 0){
			var uri;
			if(url.match('Weibo')){
				uri = APP+'/Login_port/index/id/1';
			}
			if(url.match('QQ')){
				uri = APP+'/Login_port/index/id/5';
			}
			window.open(uri,'_blank',"height=500, width=400, toolbar=no, menubar=no, scrollbars=no, resizable=no, location=no, status=no,top=200,left=400");
		}else{
			$.getJSON(url);
		}
		t.attr('class',t.attr('class').replace('close_','go_'));
		t.attr('href',url.replace('bind','remove'));
		t.removeAttr('type');
		return false;
	});
}

function talk_aboutReply(){
	var countNum = function(){
		var num = getLength($('#talk_aboutReply textarea[name="content"]').val());
		var textNum = maxTextNum - num;
		var html;
		if(textNum < 0){
			html = L.EXCEED+'<em class="error">'+Math.abs(textNum)+'</em>'+L.WORD_TEXT;
		}else{
			html = L.CAN_ENTER+'<em>'+textNum+'</em>'+L.WORD_TEXT;
		}
		$('#talk_aboutReply #textNum').html(html);
	}
	$('#talk_aboutReply textarea[name="content"]').keyup(function(e){
		countNum();
	});
	$('#talk_aboutReply #face').qqFace('#talk_aboutReply textarea[name="content"]',function(){
		countNum();
	});
	
	$('.user_say_box .clos a.jvf_allimg').click(function(){
		$('.user_say_box').hide();
		$('.user_say_box').siblings('.jvf_insertping_list').hide();
	});
	
	$('#talk_aboutReply #submit').click(function(){
		var t = $(this);
		loginAfter(function(){
			var form = $('#talk_aboutReply');
			var para = form.serialize();
			var num = getLength($('#talk_aboutReply textarea[name="content"]').val());
			var textNum = maxTextNum - num;
			var action = form.attr('action');
			var rel = form.attr('rel');
			if(textNum < 0){
				t.tip(L.EXCEED+Math.abs(textNum)+L.WORD_TEXT,2000);
			}else{
				$.post(action,para,function(data){
					if(data.status == 0){
						t.tip(data.info,2000);
					}else{
						t.tip(L.RELEASE_SUCCESS,2000);
						$('#talk_aboutReply textarea[name="content"]').val('');
						$('#talk_aboutReply #textNum').html(L.CAN_ENTER+'<em>'+maxTextNum+'</em>'+L.WORD_TEXT);
						var box = t.parents('.msgbox');
						if(rel == 'comment'){
							var span = box.find('.comment span');
							$.get(APP+'/Talk_about/getCommentOne/id/'+data.info,function(content){
								if(box.html()){
									box.find('.jvf_insertping_list').prepend(content).show();
								}else{
									$('#exchange div.extension_exchange').eq(1).find('ul.ss_comment').prepend(content);
								}
							});
						}else{
							var span = box.find('.tabroadcast span');
							$.get(APP+'/Talk_about/getOne/tid/'+data.info,function(content){
								$('#exchange div.extension_exchange').eq(0).find('ul.talk_aboutBox').prepend(content);
							});
						}
						var num = parseInt(span.text());
						if(num){
							num ++;
						}else{
							num = 1;
						}
						span.text(num);
						
					}
				},'json');
			}
		});
	});
}

function talk_aboutReplyClear(){
	$('#talk_aboutReply textarea[name="content"]').val('');
	$('#talk_aboutReply #textNum').html(L.CAN_ENTER+'<em>'+maxTextNum+'</em>'+L.WORD_TEXT);
	$('#talk_aboutReply input').remove();
}

function talk_aboutMsg(){
	$('.tabroadcast').live('click',function(){
		talk_aboutReplyClear();
		var t = $(this);
		var tid = $(this).attr('tid');
		var div = t.parents('.user_say_bot');
		var list = div.siblings('.jvf_insertping_list');
		var input = '<input type="hidden" name="tid" value="'+tid+'"/>';
		$('#talk_aboutReply').append(input);
		div.after($('.user_say_box'));
		$('#talk_aboutReply').attr('action',APP+'/Member/doTalk_about_tabroadcast').attr('rel','tabroadcast');
		$('.user_say_box').show();
		list.hide();
	});
	
	$('.comment').live('click',function(){
		talk_aboutReplyClear();
		var t = $(this);
		var tid = $(this).attr('tid');
		var input = '<input type="hidden" name="tid" value="'+tid+'"/>';
		$('#talk_aboutReply').append(input);
		var div = t.parents('.user_say_bot');
		var list = div.siblings('.jvf_insertping_list');
		div.after($('.user_say_box'));
		$('#talk_aboutReply').attr('action',APP+'/Member/doTalk_about_comment').attr('rel','comment');
		$('.user_say_box').show();
		if(list.html()){
			$.get(APP+'/Talk_about/getComment/tid/'+tid,function(data){
				if(data){
					list.html(data);
					list.show();
				}
			});
		}else{
			list.show();
		}
		
	});
	
	$('.likes').live('click',function(){
		var t = $(this);
		loginAfter(function(){
			var tid = t.attr('tid');
			$.getJSON(APP+'/Member/talk_aboutLike/tid/'+tid,function(data){
				if(data.status == 1){
					var span = t.find('span');
					var num = parseInt(span.text());
					if(num){
						num ++;
					}else{
						num = 1;
					}
					span.text(num);
				}else{
					t.tip(data.info,2000);
				}
			});
		});
	});
	
	$('.talk_aboutBox .jvf_insertping_list .replycite').live('click',function(){
		var t = $(this);
		var username = t.attr('username');
		var textarea = t.parents('.jvf_insertping_list').siblings('.user_say_box').find('textarea[name="content"]');
		var pre = '回复:@'+username+' ';
		textarea.val(pre);
	});
}

function shoppingCart(){
	statistics();
	$('#cartSelectAllTop,#cartSelectAllBot').click(function(){
		var checked = $(this).attr('checked');
		var checkbox = $('.jvf_cartList input[type="checkbox"]');
		if(checked){
            checkbox.attr('checked',checked);
		}else{
            checkbox.removeAttr('checked',checked);
		}
	});
	
	$('.minus').click(function(){
		var input = $(this).siblings('input');
		var val = parseInt(input.val()) - 1;
		if(val<=0 || !val){val = 1;}
		input.val(val);
		inputNum(input);
	});
	
	$('.plus').click(function(){
		var input = $(this).siblings('input');
		var val = parseInt(input.val()) + 1;
		if(val<=0 || !val){val = 1;}
		input.val(val);
		inputNum(input);
	});
	
	$('.sc_pt_count').keyup(function(){
		var input = $(this);
		var val = parseInt(input.val());
		if(val<=0 || !val){val = 1;}	
		input.val(val);
		inputNum(input);
	});
	
	function statistics(){
		var statistics = 0;
		$('span[id*="subtotal_"]').each(function(n,i){
			statistics = j(statistics ,'+',parseFloat($(this).text()));
		});
		$('#totalPriceTop,#totalPriceBot').text(statistics);
	}
	
	function inputNum(input){
		var id = input.attr('id').replace('goods_','');
		var num = parseInt(input.val());
		updateNum(id,num,input);
	}
	
	function updateNum(id,num,input){
		var para = 'id='+id+'&num='+num;
		$.ajax({
			url:APP+'/Goods/updateNum/',
			data:para,
			dataType:'json',
			type:'POST',
			global:false,
			success:function(data){
				if(data.info){
					input.val(data.info.num);
					input.tip(data.info.msg,3000);
					num = data.info.num;
				}
				var unitprice = parseFloat($('#unitprice_'+id).text());
				unitprice = unitprice ? unitprice:0;
				var subtotal = j(unitprice,'*',num);
				$('#subtotal_'+id).text(subtotal);
				statistics();
			}
		});
	}
	
	$('a[id*="deleteGoods_"]').click(function(){
		var id = $(this).attr('id').replace('deleteGoods_','');
		var tbody = $(this).parents('tbody');
		tbody.remove();
		statistics();
		var html = $('.jvf_cartList tbody').length;
		if(!html){
			$('#haveGoods').hide();
			$('#emptyGoods').show();
		}
		updateNum(id,0);
	});
	
	$('#delGoodsMore').click(function(){
        var ids = [];
		$('.sc_pt_inline input:checked').each(function(n,i){
			var id = $(this).val();
			var tbody = $(this).parents('tbody');
			tbody.remove();
			ids.push(id);
		});
		statistics();
        var html = $('.jvf_cartList tbody').length;
        if(!html){
            $('#haveGoods').hide();
            $('#emptyGoods').show();
        }
        $.post(APP+'/Goods/shoppingCartDel',{ids:ids});
	});
	
	$('#cartSubmitBot,#cartSubmitTop').click(function(){
		if(islogin()){
			jumpurl(APP+'/Member/payment');
		}else{
			tiplogin();
		}
	});
}

function searchIndex(condition){
	var $container = $('.category_shop');
	var $page = $('.jvf_page');
	$.getScript(PUBLIC+'/dwz/js/jquery.masonry.min.js',function(){
		reset();
	});
	var scrollboot = true;
	$(window).scroll(function(){
		var bottom = $container.offset().top + $container.outerHeight() - $(this).height();
		var scrollTop=$(document).scrollTop();//滚动条距离
		if(scrollTop>=bottom && scrollboot){
			scrollboot = false;
			var href = $page.find('.current').next('a').attr('href');
			if(href){
				loading.loadingStart('.jvf_body');
				$.getJSON(href,function(data){
					loading.loadingEnd();
					$page.html(data.info.page);
					$newElems = $(data.info.html);
					$container.append($newElems).masonry( 'appended', $newElems, false );
					scrollboot = true;
				});
			}else{
				loading.loadingNot('.jvf_body');
			}
		}
	});
	
	$('.category_j li a').click(function(){
		$('.category_j li a').removeClass('fontbold');
		condition.category = $(this).attr('cid');
		$(this).addClass('fontbold');
		reset();
		var para = [];
		para.push('cid='+condition.category);
		para.push('search_key='+condition.search_key);
		para.push('favorites='+condition.favorites);
		
		$.post(APP+'/Search/son',para.join('&'),function(data){
			var son = $('.category_j .category_sun');
			if(data.info.html.length > 0){
				son.html(data.info.html).show();
			}else{
				son.hide();
			}
		},'json');
	});
	
	$('.category_j .category_sun li a').live('click',function(){
		$('.category_j .category_sun li a').removeClass('fontbold');
		condition.category = $(this).attr('cid');

		$(this).addClass('fontbold');
		reset();
	});
	
	$('.category_v li a').click(function(){
		$('.category_v li a').removeClass('fontbold');
		condition.region = $(this).attr('rid');
		$(this).addClass('fontbold');
		reset();
	});
	
	$('.category_f li a').click(function(){
		$('.category_f li a').removeClass('fontbold');

		condition.minprice = $(this).attr('min');
		condition.maxprice = $(this).attr('max');
		$(this).addClass('fontbold');
		reset();
	});


	
	$('.category_n li a').click(function(){
		$('.category_n li a').removeClass('fontbold');
		condition.mindistance = $(this).attr('min');
		condition.maxdistance = $(this).attr('max');
		$(this).addClass('fontbold');
		reset();
	});
	
	$('.shop_nav .nav_right li a').click(function(){
		var a = $('.shop_nav .nav_right li a');
		a.removeClass('fontbold');
		var sort = $(this).attr('sort');
		condition.sort = $(this).attr('field') +' '+ sort;
		$(this).addClass('fontbold');
		a.find('em.jvf_allimg').removeClass('up').removeClass('dow').addClass('mor');
		if(sort == 'asc'){
			$(this).attr('sort','desc');
			$(this).find('em.jvf_allimg').removeClass('mor').removeClass('dow').addClass('up');
		}else if(sort == 'desc'){
			$(this).attr('sort','asc');
			$(this).find('em.jvf_allimg').removeClass('mor').removeClass('up').addClass('dow');
		}
		reset();
	});
	
	$('.shop_nav .nav_left li a').click(function(){
		var rel = $(this).attr('rel');
		$('.shop_nav .nav_right li a em.jvf_allimg').removeClass('up').removeClass('dow').addClass('mor');
		if(rel =='all'){
			condition.sort = '';
			$('.shop_nav .nav_right li a').removeClass('fontbold');
			$('.shop_nav .nav_right li a:first').addClass('fontbold');
		}else if(rel =='new'){
			condition.sort = 'addtime desc';
			var a = $('.shop_nav .nav_right li a[field="addtime"]');
			a.attr('sort','asc');
			a.find('em.jvf_allimg').removeClass('mor').removeClass('up').addClass('dow');
			$('.shop_nav .nav_right li a').removeClass('fontbold');
			a.addClass('fontbold');
		}
		$('.shop_nav .nav_left li a').removeClass('fontbold');
		$(this).addClass('fontbold');
		reset();
	});
	
	function reset(){
		loading.loadingStart('.jvf_body');
		$.post(APP+'/Search/ajaxSearch',getPara(),function(data){
			loading.loadingEnd();
			$page.html(data.info.page);
			var html = $(data.info.html);
			$container.html(html);
			if($container.is('.masonry')){
					$container.masonry('reload');
			}else{
			      $container.masonry({
			        itemSelector : '.shop_all'
			      });
			}
			scrollboot = true;
		},'json');
	}
		
	
	function getPara(){
		var para = [];
		for(var k in condition){
			para.push(k+'='+condition[k]);
		}
		return para.join('&');
	}
	collect();
	addressMap();
}

function circleIndex(condition){
	var $container = $('.category_shop');
	var $page = $('.jvf_page');
	$.getScript(PUBLIC+'/dwz/js/jquery.masonry.min.js',function(){
		reset();
	});
	
	$('.circle_list li a').click(function(){
		condition.lid = $(this).attr('lid');
		reset();
	});
	
	
	var scrollboot = true;
	
	$(window).scroll(function(){
		var bottom = $container.offset().top + $container.outerHeight() - $(this).height();
		var scrollTop=$(document).scrollTop();//滚动条距离
		if(scrollTop>=bottom && scrollboot){
			scrollboot = false;
			var href = $page.find('.current').next('a').attr('href');
			if(href){
				loading.loadingStart('.jvf_body');
				$.getJSON(href,function(data){
					loading.loadingEnd();
					$page.html(data.info.page);
					$newElems = $(data.info.html);
					$container.append($newElems).masonry( 'appended', $newElems, false );
					scrollboot = true;
				});
			}else{
				loading.loadingNot('.jvf_body');
			}
		}
	});
	
	function reset(){
		loading.loadingStart('.jvf_body');
		$.post(APP+'/Circle/ajaxCircle',getPara(),function(data){
			loading.loadingEnd();
			$page.html(data.info.page);
			$container.find('.shop_all:not(:first)').remove();
			var html = $(data.info.html);
			$container.append(html);
			if($container.is('.masonry')){
					$container.masonry('reload');
			}else{
			      $container.masonry({
			        itemSelector : '.shop_all'
			      });
			}
			scrollboot = true;
		},'json');
	}
	
	function getPara(){
		var para = [];
		for(var k in condition){
			para.push(k+'='+condition[k]);
		}
		return para.join('&');
	}
	
	ajaxCircle();
}


function nearbyIndex(condition){
	condition = condition?condition:{};
	var $container = $('.category_shop');
	var $page = $('.jvf_page');	
	$.getScript(PUBLIC+'/dwz/js/jquery.masonry.min.js',function(){
		reset();
	});
	var scrollboot = true;
	$(window).scroll(function(){
		var bottom = $container.offset().top + $container.outerHeight() - $(this).height();
		var scrollTop=$(document).scrollTop();//滚动条距离
		if(scrollTop>=bottom && scrollboot){
			scrollboot = false;
			var href = $page.find('.current').next('a').attr('href');
			if(href){
				loading.loadingStart('.jvf_body');
				$.getJSON(href,function(data){
					loading.loadingEnd();
					$page.html(data.info.page);
					$newElems = $(data.info.html);
						$container.append($newElems).masonry( 'appended', $newElems, false );
						scrollboot = true;
				});
			}else{
				loading.loadingNot('.jvf_body');
			}
		}
	});
	
	$('.shop_nav .nav_right li a').click(function(){
		var a = $('.shop_nav .nav_right li a');
		a.removeClass('fontbold');
		var sort = $(this).attr('sort');
		condition.sort = $(this).attr('field') +' '+ sort;
		$(this).addClass('fontbold');
		a.find('em.jvf_allimg').removeClass('up').removeClass('dow').addClass('mor');
		if(sort == 'asc'){
			$(this).attr('sort','desc');
			$(this).find('em.jvf_allimg').removeClass('mor').removeClass('dow').addClass('up');
		}else if(sort == 'desc'){
			$(this).attr('sort','asc');
			$(this).find('em.jvf_allimg').removeClass('mor').removeClass('up').addClass('dow');
		}
		reset();
	});
	
	function reset(){
		loading.loadingStart('.jvf_body');
		$.post(APP+'/Nearby/ajaxNearby',getPara(),function(data){
			loading.loadingEnd();
			$page.html(data.info.page);
			var html = $(data.info.html);
			$container.html(html);
			if($container.is('.masonry')){
					$container.masonry('reload');
			}else{
			      $container.masonry({
			        itemSelector : '.shop_all'
			      });
			}
			scrollboot = true;
		},'json');
	}
	
	function getPara(){
		var para = [];
		for(var k in condition){
			para.push(k+'='+condition[k]);
		}
		return para.join('&');
	}
	
	$('.xsort_all .xsort').mouseover(function(){
		$(this).siblings('.xsort_nav').show();
		$(this).addClass('xsortHover');
	});
	
	$('.xsort_all').mouseout(function(e){
		$('body').one('mouseover',function(e){
			var t = $(e.target);
			var all = t.parents('.xsort_all');
			if(all.html()){
				var ul = t.siblings('.xsort_nav');
				if(ul.html() && t.attr('cid')){
					t.parent().siblings('li').find('.xsort_nav').hide();
					ul.show();
				}
			}else{
				$('.xsort_all .xsort').removeClass('xsortHover');
				$('.xsort_all .xsort_nav').hide();
			}
		});
	});
	
	$('.xsort_nav a').click(function(){
		condition.category = $(this).attr('cid');
		$('.xsort_all .xsort').removeClass('xsortHover');
		$('.xsort_all .xsort_nav').hide();
		reset();
	});
	
	
	collect();
	addressMap();
}

function nearbyFriend(condition){
	condition = condition?condition:{};
	var $container = $('.category_shop');
	var $page = $('.jvf_page');
	$.getScript(PUBLIC+'/dwz/js/jquery.masonry.min.js',function(){
		reset();
	});
	var scrollboot = true;
	$(window).scroll(function(){
		var bottom = $container.offset().top + $container.outerHeight() - $(this).height();
		var scrollTop=$(document).scrollTop();//滚动条距离
		if(scrollTop>=bottom && scrollboot){
			scrollboot = false;
			var href = $page.find('.current').next('a').attr('href');
			if(href){
				loading.loadingStart('.jvf_body');
				$.getJSON(href,function(data){
					loading.loadingEnd();
					$page.html(data.info.page);
					$newElems = $(data.info.html);
					$container.append($newElems).masonry( 'appended', $newElems, false );
					scrollboot = true;
				});
			}else{
				loading.loadingNot('.jvf_body');
			}
		}
	});
	
	$('.shop_nav .nav_right li a').click(function(){
		var a = $('.shop_nav .nav_right li a');
		a.removeClass('fontbold');
		$(this).addClass('fontbold');
		condition.sex = $(this).attr('sex');
		reset();
	});
	
	function reset(){
		loading.loadingStart('.jvf_body');
		$.post(APP+'/Nearby/ajaxFriend',getPara(),function(data){
			loading.loadingEnd();
			$page.html(data.info.page);
			var html = $(data.info.html);
			$container.html(html);
			if($container.is('.masonry')){
					$container.masonry('reload');
			}else{
			      $container.masonry({
			        itemSelector : '.shop_all'
			      });
			}
			scrollboot = true;
		},'json');
	}
	
	function getPara(){
		var para = [];
		for(var k in condition){
			para.push(k+'='+condition[k]);
		}
		return para.join('&');
	}
	addressMap();
	ajaxFriend();
}

function memberIndex(item){
	memberRight();
	var crrIndex = 0;
	
	$.getScript(PUBLIC+'/dwz/js/jquery.masonry.min.js',function(){
		reset();
	});
	
	$('.extension_top li a').click(function(){
		loading.loadingEnd();
		$('.extension_top li').removeClass('selected');
		var li = $(this).parent();
		li.addClass('selected');
		crrIndex = $('.extension_top li').index(li);
		var item = $('.jvf_member_box .jvf_member_item');
		item.hide().eq(crrIndex).show();
		if(crrIndex != 0){
			var crr_a = li.find('a');
			if(crr_a.attr('get')){
				var url = crr_a.attr('href');
				$.get(url,function(data){
					item.eq(crrIndex).html(data);
					crr_a.removeAttr('get');
				});
			}
		}
		return false;
	});

	
	$('.jvf_member_item .jvf_page a').live('click',function(){
		var t = $(this);
		var url = t.attr('href');
		var item = t.parents('.jvf_member_item');
		$.get(url,function(data){
			item.html(data);
		});
		return false;
	});
	
	var scrollboot = true;
	
	$(window).scroll(function(){
		if(crrIndex == 0){
			var $container = $('.jvf_member_box .jvf_member_item').eq(crrIndex);
			var $page = $('.jvf_all_page .jvf_page').eq(crrIndex);
			var bottom = $container.offset().top + $container.outerHeight() - $(this).height();
			var scrollTop=$(document).scrollTop();//滚动条距离
			if(scrollTop>=bottom && scrollboot){
				scrollboot = false;
				var $container = $('.jvf_member_box .jvf_member_item').eq(crrIndex);
				var $page = $('.jvf_all_page .jvf_page').eq(crrIndex);
				var href = $page.find('.current').next('a').attr('href');
				if(href){
					loading.loadingStart('.jvf_member_box');
					$.getJSON(href,function(data){
						loading.loadingEnd();
						$page.html(data.info.page);
						$newElems = $(data.info.html);
						$container.append($newElems).masonry( 'appended', $newElems, false );
						scrollboot = true;
					});
				}else{
					loading.loadingNot('.jvf_member_box');
				}	
			}
		}
	});
	
	function reset(){
		var href = $('.extension_top li').eq(crrIndex).find('a').attr('href');
		var $container = $('.jvf_member_box .jvf_member_item').eq(crrIndex);
		var $page = $('.jvf_all_page .jvf_page').eq(crrIndex);
		loading.loadingStart('.jvf_member_box');
		$.post(href,function(data){
			loading.loadingEnd();
			$page.html(data.info.page);
			var html = $(data.info.html);
			$container.html(html);
			if($container.is('.masonry')){
					$container.masonry('reload');
			}else{
			      $container.masonry({
			        itemSelector : '.shop_all'
			      });
			}
			scrollboot = true;
		},'json');
	}
	
	ajaxCircle();
	if(item == 'buyOrderList'){
		$('.extension_top li a').eq(4).trigger('click');
	}
}

function memberReminds(){
	$('.jvf_remind_top #filter').unbind('change');
	$('.jvf_remind_top #filter').change(function(){
		var t = $(this);
		var url = APP+'/Member/reminds/'+t.attr('name')+'/'+t.val();
		var item = t.parents('.jvf_member_item');
		$.get(url,function(data){
			item.html(data);
		});
	});
	
	$('#feed_div li a.del').unbind('click');
	$('#feed_div li a.del').click(function(){
		var t = $(this);
		var url = t.attr('href');
		$.getJSON(url,function(data){
			t.tip(data.info,2000);
			if(data.status == 1){
				t.parent().parent().remove();
			}
		});
		return false;
	});
	
	$('.addfriend').click(function(){
		var t = $(this);
		var url = t.attr('href');
		var uuid = t.attr('guid');
		if(!uuid){
			uuid = guid();
			t.attr('guid',uuid);
		}
		jvfDialog(uuid, url);
		return false;
	});
}

function memberRight(){
	$('.mb_right .mb_head_user .mb_head_img').hover(function(){
		$(this).find('.space_operation').show();
	},function(){
		$(this).find('.space_operation').hide();
	});
	
	$('.mb_right .mbinqz .editLabel').click(function(){
		var t = $(this);
		var url = t.attr('href');
		var uuid = t.attr('guid');
		if(!uuid){
			uuid = guid();
			$('.mb_right .mbinqz .editLabel').attr('guid',uuid);
		}
		jvfDialog(uuid, url);
		return false;
	});
	
	talk_about();
}

function memberInbox(){
	memberRight();
	$('#sendpm').click(function(){
		var t = $(this);
		var url = t.attr('href');
		var uuid = t.attr('guid');
		loginAfter(function(){
			if(uuid){
				jvfDialogHtml(uuid);
			}else{
				uuid = guid();
				$.getJSON(url,function(data){
					if(data.status == 1){
						jvfDialogHtml(uuid, data.info);
						t.attr('guid',uuid);
					}else{
						t.tip(data.info,2000);
					}
				});
			}
		});
		return false;
	});
	
	$('#inbox_box .detail,#inbox_box .reply').live('click',function(){
		var t = $(this);
		var url = t.attr('href');
		var uuid = t.attr('guid');
		if(!uuid){
			uuid = guid();
			t.attr('guid',uuid);
		}
		loginAfter(function(){
			jvfDialog(uuid, url);
		});
		return false;
	});
	
	$('#inbox_box .delete').live('click',function(){
		var t = $(this);
		var url = t.attr('href');
		$.getJSON(url,function(data){
			if(data.status == 1){
				t.parents('li').remove();
			}else{
				t.tip(data.info,2000);
			}
		});
		return false;
	});
}

function memberAddFriend(){
	$('#friendaddform #submit').click(function(){
		var t = $(this);
		var form = t.parents('form.cmxform');
		var url = form.attr('action');
		var para = form.serialize();
		$.post(url,para,function(data){
			t.tip(data.info,2000);
			if(data.status == 1){
				t.parents('.ui-dialog').find('.ui-dialog-titlebar-close').trigger('click');
			}
		},'json');
	});
}




function userSpace(uid){
	var href = APP+'/Circle/ajaxCircle/uid/'+uid;
	userShare(uid,href);
}

function userAttention(uid){
	var href = APP+'/Circle/ajaxCircle/attention/'+uid;
	userShare(uid,href);
}

function userWasAttention(uid){
	var href = APP+'/Circle/ajaxCircle/wasAttention/'+uid;
	userShare(uid,href);
}

function userFriends(uid){
	var href = APP+'/Circle/ajaxCircle/friends/'+uid;
	userShare(uid,href);
}

function userGoods(uid){
	var href = APP+'/Search/ajaxSearch/promulgator/'+uid;
	userShare(uid,href);
}

function userRecommend(uid){
	var href = APP+'/Search/ajaxSearch/recommend/'+uid;
	userShare(uid,href);
}

function userEvaluate(uid){
	var href = APP+'/Search/ajaxSearch/evaluate/'+uid;
	userShare(uid,href);
}

function userShare(uid,url){
	userRight();
	var $container = $('.jvf_member_body .left_box');
	var $page = $('.jvf_member_body .jvf_page');
	
	$.getScript(PUBLIC+'/dwz/js/jquery.masonry.min.js',function(){
		reset();
	});
	
	var scrollboot = true;
	
	$(window).scroll(function(){
		var bottom = $container.offset().top + $container.outerHeight() - $(this).height();
		var scrollTop=$(document).scrollTop();//滚动条距离
		if(scrollTop>=bottom && scrollboot){
			scrollboot = false;
			var href = $page.find('.current').next('a').attr('href');
			if(href){
				loading.loadingStart('.mb_left_con');
				$.getJSON(href,function(data){
					loading.loadingEnd();
					$page.html(data.info.page);
						$container.append($newElems).masonry( 'appended', $newElems, false );
						scrollboot = true;
				});
			}else{
				loading.loadingNot('.mb_left_con');
			}	
		}
	});
	
	function reset(){
		loading.loadingStart('.mb_left_con');
		$.post(url,function(data){
			loading.loadingEnd();
			$page.html(data.info.page);
			var html = $(data.info.html);
			$container.html(html);
			if($container.is('.masonry')){
					$container.masonry('reload');
			}else{
			      $container.masonry({
			        itemSelector : '.shop_all'
			      });
			}
			scrollboot = true;
		},'json');
	}
}

function userRight(){
	$('.mb_head_user .mb_head_img').hover(function(){
		$(this).find('.space_operation').show();
	},function(){
		$(this).find('.space_operation').hide();
	});
	
	$('.space_guanzhu a[add="add"]').live('click',function(){
		var t = $(this);
		var href = $(this).attr('href');
		$.getJSON(href,function(data){
			if(data.status == 1){
				t.tip(data.info,2000);
				t.text(L.USER_REMOVE_ATTENTION);
				t.removeAttr('add');
				t.attr('href',href.replace('attention','removeattention'));
				t.attr('remove','remove');
			}else{
				t.tip(data.info,3000);
			}
		});
		return false;
	});
	
	$('.space_guanzhu a[remove="remove"]').live('click',function(){
		var t = $(this);
		var href = $(this).attr('href');
		$.getJSON(href,function(data){
			if(data.status == 1){
				t.tip(data.info,2000);
				t.text(L.USER_ADD_ATTENTION);
				t.removeAttr('remove');
				t.attr('href',href.replace('removeattention','attention'));
				t.attr('add','add');
			}else{
				t.tip(data.info,3000);
			}
		});
		return false;
	});
	
	$('.space_operation a:not([uid])').click(function(){
		var t = $(this);
		var href = t.attr('href');
		var uuid = guid();
		t.attr('guid',uuid);
		loginAfter(function(){
			$.getJSON(href,function(data){
				if(data.status == 1){
					jvfDialogHtml(uuid, data.info);
				}else{
					t.tip(data.info,3000);
				}
			});
		});
		return false;
	});
	
	addressMap();
	ajaxCircle();
}

function talk_aboutDetail(tid){
	$.get(APP+'/Talk_about/lists/tid/'+tid,function(data){
		$('#exchange div.extension_exchange').eq(0).html(data);
	});
	
	$('.jvf_page a').live('click',function(e){
		var t = $(this);
		var href = t.attr('href');
		var box = t.parents('.extension_exchange');
		$.get(href,function(data){
			box.html(data);
		});
		return false;
	});
	
	$('#exchange_tab li').click(function(){
		var li = $('#exchange_tab li');
		var div = $('#exchange .extension_exchange');
		var index = li.index($(this));
		li.removeClass('selected');
		$(this).addClass('selected');
		div.hide();
		var crrdiv = div.eq(index);
		crrdiv.show();
		var crr_tid = crrdiv.attr('tid');
		if(index == 1 && crr_tid){
			crrdiv.removeAttr('tid');
			$.get(APP+'/Talk_about/getComment/tid/'+crr_tid,function(data){
				crrdiv.find('ul.ss_comment').html(data);
			});
		}
	});
	
	$('.ss_comment .replycite').live('click',function(){
		var t = $(this);
		var username = t.attr('username');
		var talk_aboutReply = $('#talk_aboutReply');
		if(!(talk_aboutReply.attr('rel') == 'comment' && talk_aboutReply.find('input[name="tid"]').val() == $('.ss_detail_ri .user_say_bot .comment').attr('tid'))){
			$('.ss_detail_ri .user_say_bot .comment').trigger('click');
		}
		var textarea = talk_aboutReply.find('textarea[name="content"]');
		var pre = '回复:@'+username+' ';
		textarea.val(pre);
	});
	
	talk_aboutReply();
	talk_aboutMsg();
	collect();
	addressMap();
	userRight();
}

function memberSendpm(){
	$('#showfsbox select.fsgs').change(function(){
		var gid = $(this).val();
		if(gid == 0){
			$('#selectorbox li').show();
		}else{
			$('#selectorbox li').hide();
			$('#selectorbox li[gid="'+gid+'"]').show();
		}		
	});
	
	$("#selectorbox input[id*='fsid_']").click(function(){
	    var name = '';
		var s = [];
		$("#selectorbox input[id*='fsid_']").each(function(i,n){
			var val = $(this).val();
			if($(this).attr('checked')){
				var txt = $("#selectorbox label[for='fsid_"+val+"']").html();
				s.push(txt);
			}
		});
		for(var i in s){
			name +=s[i]+';';
		}
		$('.jvf_sendpm input[name="name"]').val(name); 
	});
	
	$('#pmsendform #submit').click(function(){
		var t = $(this);
		var form = $('#pmsendform');
		var para = form.serialize();
		var url = form.attr('action');
		var name = form.find('#name');
		var content = form.find('#content');
		if(!name.val()){
			name.tip(L.PLEASE_INPUT_ADDRESSEE,2000);
			return false;
		}
		
		if(!content.val()){
			content.tip(L.PLEASE_INPUT_MESSAGE_CONTENT,2000);
			return false;
		}
		
		$.post(url,para,function(data){
			t.tip(data.info,2000);
			if(data.status == 1){
				content.val('');
			}
		},'json');
		
	});
	
}

function memberListings(request){
	memberRight();
	var crrIndex = 0;
	
	$('.extension_top li a').click(function(){
		loading.loadingEnd();
		$('.extension_top li').removeClass('selected');
		var li = $(this).parent();
		li.addClass('selected');
		crrIndex = $('.extension_top li').index(li);
		var item = $('.listings_box .listings_item');
		item.hide().eq(crrIndex).show();
			var crr_a = li.find('a');
			if(crr_a.attr('get')){
				if(crrIndex > 3){
					var url = crr_a.attr('href');
					$.get(url,function(data){
						item.eq(crrIndex).html(data);
					});
				}else{
					reset();
				}
				crr_a.removeAttr('get');
			}
		return false;
	});
	
	if(request.item == 'chatLog'){
		var a = $('.extension_top li a').eq(4);
		a.attr('href',a.attr('href')+'?'+getPara());
		a.trigger('click');
		$('.extension_top li a').eq(0).attr('get','get');
	}else if(request.item == 'ajaxCircle'){
		var a = $('.extension_top li a').eq(1);
		a.trigger('click');
		$('.extension_top li a').eq(0).attr('get','get');
	}else if(request.item == 'like'){
		var a = $('.extension_top li a').eq(3);
		a.trigger('click');
		$('.extension_top li a').eq(0).attr('get','get');
	}
	
	$.getScript(PUBLIC+'/dwz/js/jquery.masonry.min.js',function(){
		reset();
	});
	
	function getPara(){
		var para = [];
		for(var k in request){
			if(k != 'item'){
				para.push(k+'='+request[k]);
			}
		}
		return para.join('&');
	}
	
	
	$('.listings_item .jvf_page a').live('click',function(){
		var t = $(this);
		var url = t.attr('href');
		var item = t.parents('.listings_item');
		$.get(url,function(data){
			item.html(data);
		});
		return false;
	});
	
	var scrollboot = true;
	
	$(window).scroll(function(){
		if(crrIndex <= 3){
			var $container = $('.listings_box .listings_item').eq(crrIndex);
			var $page = $('.jvf_all_page .jvf_page').eq(crrIndex);
			var bottom = $container.offset().top + $container.outerHeight() - $(this).height();
			var scrollTop=$(document).scrollTop();//滚动条距离
			if(scrollTop>=bottom && scrollboot){
				scrollboot = false;
				var href = $page.find('.current').next('a').attr('href');
				if(href){
					loading.loadingStart('.mb_left_con');
					$.getJSON(href,function(data){
						loading.loadingEnd();
						$page.html(data.info.page);
						$newElems = $(data.info.html);
							$container.append($newElems).masonry( 'appended', $newElems, false );
							scrollboot = true;
					});
				}else{
					loading.loadingNot('.mb_left_con');
				}		
			}
		}
	});
	
	function reset(){
		var href = $('.extension_top li').eq(crrIndex).find('a').attr('href');
		var $container = $('.listings_box .listings_item').eq(crrIndex);
		var $page = $('.jvf_all_page .jvf_page').eq(crrIndex);
		loading.loadingStart('.mb_left_con');
		$.post(href,function(data){
			loading.loadingEnd();
			$page.html(data.info.page);
			var html = $(data.info.html);
			$container.html(html);
			if($container.is('.masonry')){
					$container.masonry('reload');
			}else{
			      $container.masonry({
			        itemSelector : '.shop_all'
			      });
			}
			scrollboot = true;
		},'json');
	}
	
	ajaxCircle();
}

function memberEdit(item){
	memberRight();
	var crrIndex = 0;
	$('.extension_top li a').click(function(){
		$('.extension_top li').removeClass('selected');
		var t = $(this);
		var li = $(this).parent();
		li.addClass('selected');
		crrIndex = $('.extension_top li').index(li);
		var item = $('.jvf_edit_box .jvf_edit_item');
		item.hide().eq(crrIndex).show();
		if(t.attr('get')){
			var url = t.attr('href');
			$.get(url,function(data){
				item.eq(crrIndex).html(data);
			});
			t.removeAttr('get');
		}
		return false;
	});
	
	memberAvatar();
	
	if(item){
		if(item == 'upLoad'){
			$('.extension_top li a').eq(1).trigger('click');
		}else if(item == 'privacy'){
			$('.extension_top li a').eq(4).trigger('click');
		}
	}
	
	xheditorBox();
	$.getScript(TPL_PUBLIC+'js/jquery.form.js',function(){
		$('#updateSubmit').click(function(){
			var t = $(this);
			$('#updateform').ajaxSubmit({
				success: function(data) {
					t.tip(data.info,2000);
				},
				dataType: 'json'
			}); 
		});
	});
	
	$('#addphone').click(function(){
		$('.phoneBox').show();
	});
	
	$('#smsauthcode').click(function(){
		var t = $(this);
		var phone = t.parents('tr').attr('data-number');
		$("#phone_number").val(phone);
		$.getJSON(APP+'/Member/smsphone/phone/'+phone,function(data){
			if(data.status == 1){
				$('.send-verification-error').html(data.info).show();
				$('.phoneBox').show();
				$("#smsphone").hide();
				setTimeout(function(){
					$("#smsphone").show()
				}, 60000);
			}else{
				t.tip(data.info,2000);
			}
		});
	});
	
	$("#smsphone").live('click',function() {
		var t = $(this);
	    var phone = $("#phone_number").val();
		$.getJSON(APP+'/Member/smsphone/phone/'+phone,function(data){
			if(data.status == 1){
				$('.send-verification-error').html(data.info).show();
				$('.phoneBox').show();
				$("#smsphone").hide();
				setTimeout(function(){
					$("#smsphone").show()
				}, 60000);
			}else{
				t.tip(data.info,2000);
			}
		});
		return false;
	});
	
	$("#verifyphone").live('click',function() {
		var t = $(this);
	    var phone = $("#phone_number").val();
		var authcode = $("#phone_authcode").val();
		var url = APP+'/Member/phoneverify/phone/'+phone+'/authcode/'+authcode;
		
		$.getJSON(url,function(data){
			t.tip(data.info,2000);
			if(data.status == 1){
				$('.phoneBox').hide();
				var tr = $('.phone-numbers-table tr:first');
				tr.attr('data-number',phone);
				tr.find('th').text(phone);
				var span = tr.find('.unverified');
				span.attr('class','verified');
				span.html('<span class="icon"></span>'+L.VERIFICATION_TEXT+'</span>');
			}
		});
		return false;
	});
}

function memberAvatar(){
	//允许上传的图片类型
	var extensions = 'jpg,jpeg,gif,png';
	//保存缩略图的地址.
	var saveUrl = APP+'/Avatar/save_avatar';
	//保存摄象头拍摄图片的地址.
	var cameraPostUrl = APP+'/Avatar/camera';
	//头像编辑器flash的地址.
	var editorFlaPath = TPL_PUBLIC + 'js/AvatarEditor.swf';
	function useCamera(){
		var content = '<div style="width:560px;"><embed height="464" width="560" ';
		content +='flashvars="type=camera';
		content +='&postUrl='+cameraPostUrl+'?&radom=1';
		content += '&saveUrl='+saveUrl+'?radom=1" ';
		content +='pluginspage="http://www.macromedia.com/go/getflashplayer" type="application/x-shockwave-flash" ';
		content +='allowscriptaccess="always" quality="high" ';
		content +='src="'+editorFlaPath+'"/>'+jvfDialogAfter()+'</div>';
		return content;
	}
	function buildAvatarEditor(pic_id,pic_path,post_type){
		var content = '<div style="width:560px;"><embed height="464" width="560"'; 
		content+='flashvars="type='+post_type;
		content+='&photoUrl='+pic_path;
		content+='&photoId='+pic_id;
		content+='&postUrl='+cameraPostUrl+'?&radom=1';
		content+='&saveUrl='+saveUrl+'?radom=1"';
		content+=' pluginspage="http://www.macromedia.com/go/getflashplayer"';
		content+=' type="application/x-shockwave-flash"';
		content+=' allowscriptaccess="always" quality="high" src="'+editorFlaPath+'"/>'+jvfDialogAfter()+'</div>';
		return content;
	}
	/**
	* 提供给FLASH的接口 ： 没有摄像头时的回调方法
	*/
	function noCamera(){
		alert(L.MEMBER_AVATAR_NOCAMERA);
	}
	/**
	* 提供给FLASH的接口：编辑头像保存成功后的回调方法
	*/
	function checkFile(){
		var path = $('#user_header_pic').val();
		var ext = getExt(path);
		var re = new RegExp("(^|\\s|,)" + ext + "($|\\s|,)", "ig");
		if(extensions != '' && (re.exec(extensions) == null || ext == '')) {
			alert('{%member_avatar_checkfile}');
			return false;
		}
		return true;
	}
	function getExt(path) {
		return path.lastIndexOf('.') == -1 ? '' : path.substr(path.lastIndexOf('.') + 1, path.length).toLowerCase();
	}
	
	$.getScript(PUBLIC+'/dwz/js/jquery.ajaxupload.js',function(){
		new AjaxUpload('#up', {
    	    action: APP+'/Avatar/avatar_upload',
    	    name: 'header_pic',
    	    onSubmit : function(file , ext){
    	        if (ext && /^(jpg|png|jpeg|gif)$/.test(ext)){
    	            this.setData({
    	            'ext': ext
    	            });
    	            this.disable();
    	        } else {
    	            return false;
    	        }

    	    },
    	    onComplete : function(file,response){
    	    	var data=eval("("+response+")");
    	    	if(data.err==""){
				    var name = data.msg.localname;
				    //var id = name.substr(0,name.lastIndexOf('.'));
				    var id= data.msg.id;
					var html = buildAvatarEditor(id,data.msg.url,"photo");
					uuid = guid();
					jvfDialogHtml(uuid, html);
					$('#up').attr('guid',uuid);
				}else{
					$('#up').tip(data.err,2000);
				};
    	        this.enable();
    	    }
    	});
	});
	
	$("#cam").live('click',function() {
		var t= $(this);
		var uuid = t.attr('guid');
		if(!uuid){
			uuid = guid();
			var html = useCamera();
		}
		jvfDialogHtml(uuid, html);
	});
	

}

function avatarSaved(data){
	var uuid = $("#up").attr('guid');
	$('#'+uuid).dialog('close');
	$.getJSON(APP+'/Member/myHeader',function(data){
		if(data.status == 1){
			$('.edit_bimg img').attr('src',data.info.path);
			$('.edit_simg img').attr('src',data.info.thumbnail);
		}
	});
}

function memberAccount(item){
	memberRight();
	var crrIndex = 0;
	$('.extension_top li a').click(function(){
		var t= $(this);
		$('.extension_top li').removeClass('selected');
		var li = $(this).parent();
		li.addClass('selected');
		crrIndex = $('.extension_top li').index(li);
		var item = $('.jvf_account_box .jvf_account_item');
		item.hide().eq(crrIndex).show();
		if(t.attr('get')){
			var url = t.attr('href');
			$.get(url,function(data){
				item.eq(crrIndex).html(data);
			});
			t.removeAttr('get');
		}
		return false;
	});
	
	$('.jvf_account1 .jvf_center a,#level_list').click(function(){
		var t = $(this);
		var uuid = t.attr('guid');
		var url = t.attr('href');
		if(!uuid){
			uuid = guid();
		}
		jvfDialog(uuid, url);
		return false;
	});
	
	$('#value_log').click(function(){
		$('.extension_top li a:last').trigger('click');
	});
	
	$('.jvf_page a').live('click',function(e){
		var t = $(this);
		var href = t.attr('href');
		var box = t.parents('.jvf_account_item');
		$.get(href,function(data){
			box.html(data);
		});
		return false;
	});
	
	if(item == 'mycoupons'){
		$('.extension_top li a').eq(1).trigger('click');
	}else if(item == 'rechargeList'){
		$('.extension_top li a').eq(3).trigger('click');
	}
	
}

function memberGoods(){
	memberRight();
	var crrIndex = 0;
	$('.extension_top li a').click(function(){
		var t = $(this);
		$('.extension_top li').removeClass('selected');
		var li = $(this).parent();
		li.addClass('selected');
		crrIndex = $('.extension_top li').index(li);
		var item = $('.jvf_goods_box .jvf_goods_item');
		item.hide().eq(crrIndex).show();
		if(t.attr('get')){
			var url = t.attr('href');
			$.get(url,function(data){
				item.eq(crrIndex).html(data);
			});
			t.removeAttr('get');
		}
		return false;
	});
	
	$('.gooddetail').live('click',function(){
		var t = $(this);
		var url = t.attr('href');
		var uuid = t.attr('guid');
		if(!uuid){
			uuid = guid();
			t.attr('guid',uuid);
		}
		jvfDialog(uuid, url);
		return false;
	});
	
	$('.editgood').live('click',function(){
		var t = $(this);
		var url = t.attr('href');
		var uuid = t.attr('guid');
		if(!uuid){
			uuid = guid();
			t.attr('guid',uuid);
		}
		jvfDialog(uuid, url);
		return false;
	});
	
	$('.delGoods').live('click',function(){
		var t = $(this);
		var url = t.attr('href');
		$.getJSON(url,function(data){
			t.tip(data.info,2000);
			if(data.status == 1){
				t.parents('tr').remove();
			}
		});
		return false;
	});
	
	$('.jvf_page a').live('click',function(e){
		var t = $(this);
		var href = t.attr('href');
		var box = t.parents('.jvf_goods_item');
		$.get(href,function(data){
			box.html(data);
		});
		return false;
	});
}

function memberViewpm(){
	$('.jvf_box_buttom a.btn').unbind('click');
	$('.jvf_box_buttom a.btn').click(function(){
		$(this).parents('.ui-dialog').find('.ui-dialog-titlebar-close').trigger('click');
	});
	return false;
}

function memberRelpypm(){
	$('.cmxform #submit').unbind('click');
	$('.cmxform #submit').click(function(){
		var t = $(this);
		var form = t.parents('form.cmxform');
		var para = form.serialize();
		var url = form.attr('action');
		var content = form.find('#content');
		if(!content.val()){
			content.tip(L.PLEASE_INPUT_MESSAGE_CONTENT,2000);
			return false;
		}
		
		$.post(url,para,function(data){
			t.tip(data.info,2000);
			if(data.status == 1){
				content.val('');
				t.parents('.ui-dialog').find('.ui-dialog-titlebar-close').trigger('click');
			}
		},'json');
	});
}

function memberPayment(){
	$('#payForm').submit(function(){
		var para = $(this).serialize();
		$.post(APP+'/Member/pay',para,function(data){
			if(data.status == 0){
				if(data.data == 1){
					$('#phone').tip(data.info,2000);
					$('#phone').focus();
				}else{
					$('#goodsBuyBtn').tip(data.info,2000);
				}
			}else{
				var id = guid();
                var op = {};
                op.close = function(event, ui){
                    goUrl(APP+'/Member/payment/oid/'+data.info.oid);
                }
				jvfDialogHtml(id,data.info.html,op);
			}
		},'json');
		return false;
	});

    function needPrice(){
        var totalPrices = parseFloat($('#totalPrices').text());
        var incharge = Number($('#incharge').html());
        var balanceTf = parseFloat($('#balanceTf').text());
        var result = totalPrices-incharge;
        if($('#iscash').attr('checked')){
            var cope = totalPrices-incharge;
            if(cope > balanceTf){
                result = j(cope,'-',balanceTf);
            }else{
                result = 0;
            }
        }
        $('#needPrice').text(toPrice(result));
    }
    needPrice();
	$('#iscash').click(function(){
        needPrice();
	});

	$('#hideListMsg').click(function(){
		controlList('hideListMsg','showListMsg');
	});
	
	$('#showListMsg').click(function(){
		controlList('showListMsg','hideListMsg');
	});

	function controlList(obj,obj2){
		var $tab=$('#listMsgTable');
		if(obj=='showListMsg'){
			$tab.fadeIn(500);
		}else{
			$tab.fadeOut(200);
		}
		$('#'+obj).hide();
		$('#'+obj2).show();
	}
}

function memberPrivacy(){
	$('#user_profile_info_submit').click(function(){
		var t= $(this);
		var form = $('#editprivacy');
		var para = form.serialize();
		var url = form.attr('action');
		$.post(url,para,function(data){
			t.tip(data.info,2000);
		},'json');
	});
	
	$('#user_preference_submit').click(function(){
		var t= $(this);
		var form = $('#editisfeed');
		var para = form.serialize();
		var url = form.attr('action');
		$.post(url,para,function(data){
			t.tip(data.info,2000);
		},'json');
	});
}

function memberLocation(){
	$('#addaddress').click(function(){
		var form = $("#addlocationform");
		form.attr('action',APP+'/Member/addlocation');
		form.find("input[name='id']").val('');
		form.find("input[name='type']").val('');
		form.find("input[name='address']").val('');
		form.find("input[name='longitude']").val('');
		form.find("input[name='latitude']").val('');
	    $('#addlocation').show();
    	try{
   		    initialize("map_canvas");
   		}catch(e){
		}
	});
	
	$('#addlocation .cancel').click(function(){
       $('#addlocation').hide();
    });
	
	$('#addlocation #addmarker').click(function(){
		codeAddress($('#addlocation #address').val());
	});
	$('#addlocation #showmarker').click(function(){
		showMarker($('#addlocation #address').val());
	});
	
	$('#addlocation #address').keypress(function(e){
		var keyCode = e.keyCode ? e.keyCode : e.which ? e.which : e.charCode;
		if (keyCode == 13) {  
			$('#addlocation #addmarker').trigger('click');
            return false;
        } else {  
            return true;
        }
	});
	
	$('#addlocation #submit').click(function(){
		var t= $(this);
		var form = $('#addlocationform');
		var url =form.attr('action');
		var para = form.serialize();
		$.post(url,para,function(data){
			if(data.status == 1){
				$('#addlocation').hide();
				var id = form.find('#id').val();
				if(id){
					$('.map-description[lid="'+id+'"] .address').text(form.find('#address').val());
				}else{
					$('.edit_setmap_con').prepend(data.info);
				}
			}else{
				t.tip(data.info,2000);
			}
		},'json');
	});
	
	$('.edit_setmap_con .deladdress').live('click',function(){
		var t = $(this);
		var url = t.attr('href');
		$.getJSON(url,function(data){
			t.tip(data.info,2000);
			if(data.status == 1){
				t.parents('h3.map-description').remove();
			}
		});
		return false;
	});
	$('.edit_setmap_con .defaultaddress').live('click',function(){
		var t = $(this);
		var url = t.attr('href');
		$.getJSON(url,function(data){
			t.tip(data.info,2000);
			if(data.status == 1){
				$('.edit_setmap_con .defaultaddress').show();
				t.hide();
			}
		});
		return false;
	});
	
	$('.edit_setmap_con .editaddress').live('click',function(){
		var t = $(this);
		var url = t.attr('href');
		$.getJSON(url,function(data){
			if(data.status == 1){
				var form = $('#addlocationform');
				form.attr('action',APP+'/Member/updatelocation');
				form.find('#id').val(data.info.id);
				form.find('#address').val(data.info.address);
				form.find('#type').val(data.info.type);
				form.find('#longitude').val(data.info.lng);
				form.find('#latitude').val(data.info.lat);
				$('#addlocation').show();
				try{
		   		    initialize("map_canvas");
		   		    addTags(data.info.lat,data.info.lng,data.info.address,"map_canvas",'');
		   		}catch(e){
		   			
				}
			}else{
				t.tip(data.info,2000);
			}
		});
		return false;
	});
}

function memberMycoupons(){
	$('#inbox_filter_form #filter').unbind('change');
	$('#inbox_filter_form #filter').change(function(){
		var t= $(this);
		var form = $('#inbox_filter_form');
		var url = form.attr('action');
		var para = form.serialize();
		var box = t.parents('.jvf_account_item');
		$.post(url,para,function(data){
			box.html(data);
		});
	});
	$('.smscoupon').unbind('change');
	$('.smscoupon').click(function(){
		var t= $(this);
		var url = form.attr('href');
		$.getJSON(url,function(data){
			t.tip(data.info,2000);
		});
		return false;
	});
}

function memberChatLog(){
	$('#inbox_filter_form #filter').unbind('click');
	$('#inbox_filter_form #filter').click(function(){
		var t= $(this);
		var form = $('#inbox_filter_form');
		var url = form.attr('action');
		var para = form.serialize();
		var box = t.parents('.listings_item');
		$.post(url,para,function(data){
			box.html(data);
		});
	});
	$('#inbox_filter_form input[name="name"]').unbind('keypress');
	$('#inbox_filter_form input[name="name"]').keypress(function(e){
		var keyCode = e.keyCode ? e.keyCode : e.which ? e.which : e.charCode;
		if (keyCode == 13) {
			$('#inbox_filter_form #filter').trigger('click');
            return false;
        } else {  
            return true;
        }
	});
}

function memberSellcoupons(){
	$('#inbox_filter_form').unbind('submit');
	$('#inbox_filter_form').submit(function(){
		var t = $(this);
		var form = $('#inbox_filter_form');
		var url = form.attr('action');
		var para = form.serialize();
		var box = t.parents('.jvf_goods_item');
		$.post(url,para,function(data){
			box.html(data);
		});
		return false;
	});
}

function memberAdministration(){
	memberRight();
	var crrIndex = 0;
	$('.extension_top li a').click(function(){
		var t = $(this);
		$('.extension_top li').removeClass('selected');
		var li = $(this).parent();
		li.addClass('selected');
		crrIndex = $('.extension_top li').index(li);
		var item = $('.administration_box .administration_item');
		item.hide().eq(crrIndex).show();
		if(t.attr('get')){
			var url = t.attr('href');
			$.get(url,function(data){
				item.eq(crrIndex).html(data);
			});
			t.removeAttr('get');
		}
		return false;
	});
	
	if(!$('.extension_top li.selected').html()){
		$('.extension_top li a').eq(crrIndex).trigger('click');
	}
	
	$('.jvf_page:not([id]) a').live('click',function(e){
		var t = $(this);
		var href = t.attr('href');
		var box = t.parents('.administration_item');
		$.get(href,function(data){
			box.html(data);
		});
		return false;
	});
}

function memberVerifycoupon(){
	$("#coupon-query").unbind('click');
	$("#coupon-query").click(function(){
		var t=$(this);
	    var sn = $('#coupon-input-sn');
	    var val = sn.val();
		if(!val){
			sn.tip(L.PLEASE_INPUT+L.VOUCHER_SN,2000);
			return ;
		}
		var url = APP+'/Member/querycoupon/';
		$.post(url,{sn:val},function(data){
		    t.tip(data.info,2000);
		},'json');	
	});
	
	$("#coupon-consume").unbind('click');
	$('#coupon-consume').click(function(){
		var t = $(this);
		var sn = $('#coupon-input-sn');
		var pass = $('#coupon-input-pass');
		if(!sn.val()){
			sn.tip(L.PLEASE_INPUT+L.VOUCHER_SN,2000);
			return ;
		}
		if(!pass.val()){
			pass.tip(L.PLEASE_INPUT + L.VOUCHER_PASS,2000);
			return ;
		}
		if(sn && pass){
	        if(confirm(L.MEMBER_VERIFYCOUPON_CONFIRM)){
	        	var form = $("#couponform");
	        	var url = form.attr('action');
	        	var para = form.serialize();
	        	$.post(url,para,function(data){
	        		t.tip(data.info,2000);
	        		if(data.status == 1){
	        			sn.val('');
	        			pass.val('');
	        		}
	        	},'json');
			}
		}
	});
}

function chatBox(){
	$.onload(function(){
		$.getJSON(APP+'/Member/chatBox',function(data){
			if(data.status == 1){
				$('body').append(data.data);
				webim();
			}
		});
	});
}

function webim(){
	var wbim_list_expand = $('.wbim_list_expand');
	var wbim_chat_box = $('.wbim_chat_box');
	var wbim_tip = $('#wbim_tip');
	var textarea = $('#message_chat');
	var wbim_face_box = $('.wbim_face_box');
	var key_code = 'event.which == 13 || event.which == 10';
	var wbim_chat_list = $('.wbim_chat_list');
	var wbim_box = $('#wbim_box');
	$('.wbim_min_friend,.wbim_min_chat').hover(function(){
		$(this).addClass('wbim_min_box_hover');
	},function(){
		$(this).removeClass('wbim_min_box_hover');
	});
	
	$('.wbim_min_friend').click(function(event){
		wbim_list_expand.show();
		$('body').one("click", function (e) {//对document绑定一个影藏Div方法
			wbim_list_expand.hide();
		});
		event.stopImmediatePropagation();
	});

	$('.wbim_min_chat').click(function(event){
		wbim_chat_box.show();
		openChatBox(get_crr_chat_firend());
		//event.stopImmediatePropagation();
	});
	
	$('#wbim_box').click(function(event){
		$('#facebox_chat').hide();
		event.stopImmediatePropagation();
	});
	

	$('.wbim_clicknone,.wbim_list_expand .wbim_icon_mini').click(function(){
		wbim_list_expand.hide();
	});

	$('.wbim_chat_box .wbim_icon_mini').click(function(){
		wbim_chat_box.hide();
	});

	$('.wbim_chat_box .wbim_icon_close').click(function(){
		wbim_chat_box.hide();
		wbim_tip.attr('class','wbim_min_box_col2');
		$('.wbim_chat_friend_list').html('');
		ing_chat_count();
	});

	$('.wbim_list_expand .wbim_tit_lf').hover(function(){
		$(this).addClass('wbim_tit_lf_hover');
		$(this).find('ul').show();
	},function(){
		$(this).removeClass('wbim_tit_lf_hover');
		$(this).find('ul').hide();
	});

	$('#chat_friends li').click(function(){
		openChatBox($(this));
	});
	
	function set_crr_chat_firend(t){
		var uid = t.attr('uid');
		var name = t.attr('title');
		var online = t.attr('online');
		var a = $('#crr_chat_firend a');
		var span = $('#crr_chat_firend span[class*=wbim_status]');
		$('.wbim_min_nick').text(name);
		a.text(name);
		a.attr('title',name);
		a.attr('href',APP+'/User/space/id/'+uid);
		$('#crr_chat_firend').attr('uid',uid);
		span.attr('class',online);
	}
	
	function get_crr_chat_firend(){
		var t = $('.wbim_chat_friend_list li[class=wbim_active]');
		return t;
	}
	
	function getChat_log(uid){
		var dl = $('.wbim_chat_list dl[uid='+uid+']');
		if(dl.html() == null){
			$.ajax({
				url:APP+'/Member/getChat_log/uid/'+uid,
				dataType:'json',
				type:'GET',
				global:false,
				async:false,
				success:function(data){
					if(data.status == 1){
						$('.wbim_chat_list').append(data.data);
						dl = $('.wbim_chat_list dl[uid='+uid+']'); 
					}
				}
			});
		}
		return dl;
	}
	
	function activeFriend(uid,t){
		var activeid = $('.wbim_chat_friend_list li[uid='+uid+']');
		if(activeid.html() == null){
			var uid = t.attr('uid');
			var name = t.attr('title');
			var online = t.attr('online');
			$('.wbim_min_nick').text(name);
			$('.wbim_chat_friend_list li').removeClass('wbim_active');
			var src = t.find('.wbim_userhead img').attr('src');
			var html = '<li title="'+name+'" class="wbim_active" uid="'+uid+'">'
					 + '<div class="wbim_userhead">'
					 + '<img src="'+src+'" alt="'+name+'">'
					 + '<span class="'+online+'"></span>'
					 + '</div>'
					 + '<div class="wbim_username">'+name+'</div>'
					 + '<a class="wbim_icon_close_s" href="javascript:;"></a></li>';
			$('.wbim_chat_friend_list').append(html);
			ing_chat_count();
			$('.wbim_chat_friend_list .wbim_icon_close_s').unbind('click');
			$('.wbim_chat_friend_list .wbim_icon_close_s').click(function(){
				if($('.wbim_chat_friend_list li').index() > 0){
					var li = $(this).parent();
					var first = li.siblings().first();
					$('.wbim_chat_friend_list li').removeClass('wbim_active');
					first.addClass('wbim_active');
					set_crr_chat_firend(first);
					li.remove();
					var uid = first.attr('uid');
					var contentid = getChat_log(uid);
					$('.wbim_chat_list dl').hide();
					contentid.show();
					if($('.wbim_chat_friend_list li').index() == 0){
						$('.wbim_chat_friend_list li .wbim_icon_close_s').hide();
					}
				}
				ing_chat_count();
			});

			$('.wbim_chat_friend_list li').unbind('click');
			$('.wbim_chat_friend_list li').click(function(){
				$('.wbim_chat_friend_list li').removeClass('wbim_active');
				$(this).addClass('wbim_active');
				var uid = $(this).attr('uid');
				var contentid = getChat_log(uid);
				set_crr_chat_firend($(this));
				$('.wbim_chat_list dl').hide();
				contentid.show();
			});
		}else{
			$('.wbim_chat_friend_list li').removeClass('wbim_active');
			activeid.addClass('wbim_active');
		}
		
		set_crr_chat_firend(t);
		var contentid = getChat_log(uid);
		$('.wbim_chat_list dl').hide();
		contentid.show();
		if($('.wbim_chat_friend_list li').index() > 0){
			$('.wbim_chat_lf').show();
			$('.wbim_chat_box').removeClass('wbim_chat_box_s');
			$('.wbim_chat_friend_list .wbim_icon_close_s').show();
		}
		
		var activeid = $('.wbim_chat_friend_list li[uid='+uid+']');
		var lis = $('.wbim_chat_friend_list li');
		var index = lis.index(activeid);
		if(index > 8){
			var count = lis.index();
			var differ = index-9;
			lis.slice(0,differ).insertAfter(activeid);
		}
	}
	
	function openChatBox(t){
		var uid = t.attr('uid');
		var activeid = activeFriend(uid,t);
		t.find('.wbim_icon_msg_s').hide();
		$('.wbim_min_chat').removeClass('wbim_min_chat_msg');
		wbim_tip.attr('class','wbim_min_box_col3');
		wbim_chat_box.show();
		scrollBottom();
		$('body').one("click", function () {//对document绑定一个影藏Div方法
			wbim_chat_box.hide();
		});
	}

	textarea.keyup(function(){
		var val = $(this).val();
		var length = 200 - val.length;
		if(length < 0 ){
			$(this).val(val.substr(0,200));
			length = 0;
		}
		$('.wbim_chat_count').text(length);
	});

	textarea.keydown(function(event){
		if(eval(key_code)){
			send();
		}
	});


	$('.wbim_face_list a').click(function(){
		var val = textarea.val() + $(this).attr('title');
		textarea.val(val);
		wbim_face_box.hide();
	});

	$('.wbim_btn_choose_a').click(function(){
		$('.wbim_btn_choose ul').toggle();
	});
	
	$('.wbim_btn_choose li').click(function(){
		$('.wbim_btn_choose li').removeClass('curr');
		$(this).addClass('curr');
		$('.wbim_btn_choose ul').hide();
		var event = $(this).attr('event');
		
		if(event == 1){
			key_code = 'event.which == 13 || event.which == 10';
		}else if(event == 2){
			key_code = 'event.ctrlKey && event.which == 13 || event.which == 10';
		}
	});

	$('.wbim_list_group_tit').click(function(){
		$(this).toggleClass('wbim_open').toggleClass('wbim_close');
		$(this).siblings('ul').toggle();
	});

	$('.wbim_btn_publish').click(function(){
		send();
	});

	function send(){
		var val = textarea.val();
		var uid = $('.wbim_chat_friend_list .wbim_active').attr('uid');
		var contentid = getChat_log(uid);
		var para = 'uid='+uid+'&content='+val;
		$.ajax({
			url:APP+'/Member/sendChat/',
			data:para,
			dataType:'json',
			type:'POST',
			global:false,
			success:function(data){
				if(data.status == 1){
					contentid.append(data.data);
					scrollBottom();
					textarea.val('');
				}
			}
		});
	}

	function receive(uid,html){
		var contentid = getChat_log(uid);
		contentid.append(html);
		scrollBottom();
	}

	function scrollBottom(){
		var top = wbim_chat_list[0].scrollHeight;
		wbim_chat_list.scrollTop(top);
	}

	function ing_chat_count(){
		$('.wbim_online_count').text($('.wbim_chat_friend_list li').index() + 1);
	}
	
	$('#face_chat').qqFace('#message_chat');
	
	$('.wbim_list_srchin input:text').keyup(function(){
		var val = $(this).val();
		if(!val){
			$('#chat_friends').show();
			$('#chat_search').hide();
		}else{
			var li = $('#chat_friends li[title*="'+val+'"]');
			var html = '';
			if(!li.html()){
				html = '<li class="noresult">'+L.NORESULT+'</li>';
			}else{
				li.each(function(i,n){
					html += '<li title="'+$(this).attr('title')+'" uid="'+$(this).attr('uid')+'">'+$(this).html()+'</li>';
				});
			}
			$('#chat_search ul').html(html);
			$('#chat_friends').hide();
			$('#chat_search').show();
			$('.wbim_list_srchin .wbim_icon_close_s').show();
			$('#chat_friends li').unbind('click');
			$('#chat_friends li').click(function(){
				openChatBox($(this));
			});
		}
	});
	
	$('.wbim_list_srchin .wbim_icon_close_s').click(function(){
		$(this).hide();
		$('.wbim_list_srchin input:text').val('');
		$('#chat_search ul').html('');
		$('#chat_friends').show();
		$('#chat_search').hide();
	});
	
	$('#online_status li').click(function(){
		var val = $(this).find('span').attr('class');
		var txt = $(this).text();
		var status = '';
		if(val=='wbim_status_offline'){
			status = 0;
		}else if(val=='wbim_status_online'){
			status = 1;
		}else if(val=='wbim_status_busy'){
			status = 2;
		}else if(val=='wbim_status_away'){
			status = 3;
		}else{
			status = '';
		}
		$.getJSON(APP+'/Member/setOnline/info/'+status,function(data){
			if(data.status == 1){
				$('.statusbox span').attr('class',val);
				$('#status_result_span').attr('class',val);
				$('#status_result_txt').text(txt);
				$('#status_result_span').attr('class',val);
				$('#online_status').hide();
			}
		});
	});
	
	$('a.jvf_callme').live('click',function(event){
		var uid = $(this).attr('uid');
		var li = $('#chat_friends li[uid='+uid+']');
		if(!li.html()){
			$.ajax({
				url:APP+'/Member/getChatUser/uid/'+uid,
				dataType:'json',
				type:'GET',
				global:false,
				async:false,
				success:function(data){
					if(data.status == 1){
						var group = $('#chat_friends .wbim_list_group').first();
						group.find('ul').prepend(data.data);
						li = $('#chat_friends li[uid='+uid+']');
						var count = group.find('.wbim_list_group_tit span');
						var num = parseInt(count.text()) + 1;
						count.text(num);
						$('#chat_friends li').unbind('click');
						$('#chat_friends li').click(function(){
							openChatBox($(this));
						});
					}
				}
			});
		}
		openChatBox(li.eq(0));
		return false;
	});
	
	function thread(){
		$.ajax({
			url:ROOT+'/thread.php',
			dataType:'json',
			type:'POST',
			global:false,
			success:function(data){
				if(data.status == 1){
					if(data.data){
						var count = parseInt($('.wbim_min_chat .wbim_min_nick').text().replace(L.YOU_HAVE,'').replace(L.ITEM_MSG,''));
						if(isNaN(count))count = 0;
						$.each(data.data,function(i,n){
							
							var t_all = $('#chat_friends li[uid='+this.send+']');
							t_all.find('.wbim_icon_msg_s').show();
							var t = t_all.first();
							var name = t.attr('title');
							if(this.send_name != name)this.send_name = name;
							activeFriend(this.send,t);
							
							var html=  '<dd class="wbim_msgr">'
							    +   '<div class="wbim_msgpos">'
						        +   '<div class="msg_time">'
						        +   this.send_name+' '+this.addtime
						        +	'</div>'
						        +	'<div class="msg_box">'
						        +    '<p class="txt">'
						        +        this.content
						        +    '</p>'
						        +	'</div>'
								+	'</div>'
								+	'</dd>';
							receive(this.send,html);
							if($('.wbim_chat_box').css('display') != 'block' || get_crr_chat_firend().attr('uid') != this.send){
								count++;
							}							
						});
						if(count > 0){
							$('.wbim_min_chat').addClass('wbim_min_chat_msg');
							$('.wbim_min_chat .wbim_min_nick').text(L.YOU_HAVE+count+L.ITEM_MSG);
							wbim_tip.attr('class','wbim_min_box_col3');
						}
					}
					setTimeout(function() {
						thread();
				    },
				    0);
				}
			}
		});
	}
	thread();
	setInterval(function() {
		updateStatus();
    }, 100000);
	
	function updateStatus(){
		$.ajax({
			url:APP+'/Member/getFriendsStatus',
			dataType:'json',
			type:'GET',
			global:false,
			async:false,
			success:function(data){
				if(data.status == 1){
					var uid = $('#crr_chat_firend').attr('uid');
					if(data.data){
						$.each(data.data,function(i,n){
							var li = $('li[uid='+n.uid+']');
							li.find('span[class*=wbim_status_]').attr('class',n.online);
							if(li.attr('online')){
								li.attr('online',n.online);
							}
							if(uid == n.uid){
								$('#crr_chat_firend span[class*=wbim_status_]').attr('class',n.online);
							}
						});
					}					
				}
			}
		});
	}
	
	$('.wbim_scrolltop_n').click(function(){
		var lis = $('.wbim_chat_friend_list li');
		if(lis.index() > 8){
			lis.first().insertAfter(lis.last());
		}
	});
	
	$('.wbim_scrollbtm_n').click(function(){
		var lis = $('.wbim_chat_friend_list li');
		if(lis.index() > 8){
			lis.last().insertBefore(lis.first());
		}
	});
	
	$('.wbim_history').click(function(){
		var uid = get_crr_chat_firend().attr('uid');
		var url = APP+'/Member/listings/item/chatLog/uid/'+uid;
		$(this).attr('href',url);
	});
}

function userNoverifymail(){
	$("#sendmail").click(function(){
		var t = $(this);
		var form = $('#resendmail');
		var para = form.serialize();
		var url = form.attr('action');
		$.post(url,para,function(data){
			t.tip(data.info,2000);
			if(data.status==1){
				t.attr("disabled", true);
				setTimeout(function(){
					t.attr("disabled", false);
				}, 60000);
			};
		},'json');
	});
}

function apply_seller(){
	$.getScript(PUBLIC+'/dwz/js/jquery.ajaxupload.js',function(){
		new AjaxUpload('#upload_button', {
    	    action: APP+'/Xheditor/goodsImgLoad',
    	    name: 'images',
    	    onSubmit : function(file , ext){
    	        if (ext && /^(jpg|png|jpeg|gif)$/.test(ext)){
    	            this.setData({
    	            'ext': ext
    	            });
    	            this.disable();
    	        } else {
    	            return false;
    	        }

    	    },
    	    onComplete : function(file,response){
    	    	var data=eval("("+response+")");
    	    	insertGoodsImg(data);
    	        this.enable();
    	    }
    	});
	});

	function insertGoodsImg(data){
    	if(!data.err){
    		var html= '<li class="sortableitem"><div class="jvf_clos"><span>×</span></div><input type="hidden" name="logo" value="'+data.msg.relpath+'" /><img src="'+data.msg.thumbnail+'" /></li>';
    		$('#imgBox').html(html);
    	}else{
    		alert(data.err);
    	}
    }

	$('.sortableitem .jvf_clos span').live('click',function(){
		var li = $(this).parents(".sortableitem");
		li.remove();
	});

	$('#do_apply_seller_form').submit(function(){
		var form = $(this);
		var name = form.find('#name');
		if(name.val()){
			if(name.val().length <= 2){
				name.focus();
				name.tip('商家名称太短');
				return false;
			}
		}else{
			name.focus();
			name.tip('请填写商家名称');
			return false;
		}
		
		var fz_name = form.find('#fz_name');
		if(fz_name.val()){
			if(fz_name.val().length <= 2){
				fz_name.focus();
				fz_name.tip('负责人姓名太短');
				return false;
			}
		}else{
			fz_name.focus();
			fz_name.tip('请填写负责人');
			return false;
		}

		var companyname = form.find('#companyname');
		if(companyname.val()){
			if(companyname.val().length <= 2){
				companyname.focus();
				companyname.tip('企业名称太短');
				return false;
			}
		}else{
			companyname.focus();
			companyname.tip('请填写企业名称');
			return false;
		}

		var logo = form.find('input[name="logo"]');
		if(!logo.val()){
			var upload_button = form.find('#upload_button');
			upload_button.focus();
			upload_button.tip('请上传logo');
			return false;
		}

		var tel = form.find('#tel');
		if(tel.val()){
			if(!tel.val().match(/((\d{11})|^((\d{7,8})|(\d{4}|\d{3})-(\d{7,8})|(\d{4}|\d{3})-(\d{7,8})-(\d{4}|\d{3}|\d{2}|\d{1})|(\d{7,8})-(\d{4}|\d{3}|\d{2}|\d{1}))$)/)){
				tel.focus();
				tel.tip('预约电话格式不正确');
				return false;
			}
		}else{
			tel.focus();
			tel.tip('请填写预约电话');
			return false;
		}

		var opening = form.find('#opening');
		if(opening.val()){
			if(opening.val().length <= 2){
				opening.focus();
				opening.tip('营业时间太短');
				return false;
			}
		}else{
			opening.focus();
			opening.tip('请填写营业时间');
			return false;
		}

		var type = form.find('#type');
		if(type.val()){
			if(type.val().length <= 2){
				type.focus();
				type.tip('商家类型太短');
				return false;
			}
		}else{
			type.focus();
			type.tip('请填写商家类型');
			return false;
		}

		var characteristic = form.find('#characteristic');
		if(characteristic.val()){
			if(characteristic.val().length <= 2){
				characteristic.focus();
				characteristic.tip('商家特色太短');
				return false;
			}
		}else{
			characteristic.focus();
			characteristic.tip('请填写商家特色');
			return false;
		}

		var services = form.find('#characteristic');
		if(services.val()){
			if(services.val().length <= 2){
				services.focus();
				services.tip('服务范围太短');
				return false;
			}
		}else{
			services.focus();
			services.tip('请填写服务范围');
			return false;
		}

		var address = form.find('#address');
		if(address.val()){
			if(address.val().length <= 2){
				address.focus();
				address.tip('地址太短');
				return false;
			}
		}else{
			address.focus();
			address.tip('请填写地址');
			return false;
		}
	});
}

function goodsRelease(){
	$('input.jvf_date').datepicker();
	$('input[name="payment"]').click(function(){
		var val = $(this).val();
		if(val == 1){
			$('#price').hide();
			$('#deposit').show();
		}else{
			$('#price').show();
			$('#deposit').hide();
		}
	});
	if(!$('input[name="payment"]:checked').val()){
		$('input[name="payment"]').eq(0).trigger('click');
	}
	
	$('.jvf_inputb').change(function(){
		var t = $(this);
		var val = t.val();
		var url = APP+'/Goods/expand/id/' + val;
    	$.getJSON(url,function(data){
    		if(data.status == 1){
    			$("#expandBox").html(data.info);
    		}
    	});
	});
	
	$('#category_submit').live('click',function(){
		$('#category_box input[name="category[]"]').each(function(){
			if($(this).attr('checked')){
				$('#category').val($(this).val());
				$('#category_name').val($(this).next().text());
				$(this).parents('.ui-dialog').find('.ui-dialog-titlebar-close').trigger('click');
			}
		});
	});
	
	$('#region_submit').live('click',function(){
		$('#region_box input[name="region[]"]').each(function(){
			if($(this).attr('checked')){
				$('#region').val($(this).val());
				$('#region_name').val($(this).next().text());
				$(this).parents('.ui-dialog').find('.ui-dialog-titlebar-close').trigger('click');
			}
		});
	});
	
	function insertGoodsImg(data){
    	if(!data.err){
    		var html= '<li class="sortableitem"><div class="jvf_clos"><span>×</span></div><input type="hidden" name="imgs[]" value="'+data.msg.id+'" /><img src="'+data.msg.thumbnail+'" /></li>';
    		$('#imgBox').append(html);
    	}else{
    		alert(data.err);
    	}
    }
	
	$('.sortableitem .jvf_clos span').live('click',function(){
		var li = $(this).parents(".sortableitem");
		li.remove();
	});
	
	$.getScript(PUBLIC+'/dwz/js/jquery.ajaxupload.js',function(){
		new AjaxUpload('#upload_button', {
    	    action: APP+'/Xheditor/goodsImgLoad',
    	    name: 'images',
    	    onSubmit : function(file , ext){
    	        if (ext && /^(jpg|png|jpeg|gif)$/.test(ext)){
    	            this.setData({
    	            'ext': ext
    	            });
    	            this.disable();
    	        } else {
    	            return false;
    	        }

    	    },
    	    onComplete : function(file,response){
    	    	var data=eval("("+response+")");
    	    	insertGoodsImg(data);
    	        this.enable();
    	    }
    	});
	});
	
	function imgBoxdrag(){
    	$( "#imgBox" ).dragsort({dragSelectorExclude:"span"});
    }
	
	$.getScript(PUBLIC+'/dwz/js/jquery.dragsort-0.4.3.min.js',function(){
		imgBoxdrag();
	});
	
	$('.good_bot a.terms').click(function(){
		var t = $(this);
		var url = t.attr('href');
		var uuid = t.attr('guid');
		if(!uuid){
			uuid = guid();
		}
		jvfDialog(uuid, url);
		t.attr('guid',uuid);
		return false;
	});
	
	$('#post_room_submit_button').click(function(){
		var t = $(this);
		var form = $("#releaseForm");
		form.attr('action',APP+'/Goods/doRelease');
		form.removeAttr('target');
		if(verification()){
			var url = form.attr('action');
			var para = form.serialize();
			$.post(url,para,function(data){
				t.tip(data.info,2000);
				if(data.status == 1){
					goUrl(APP+'/Member/goods');
				}
			},'json');
		}else{
			t.tip(L.PARAMETER_ERROR,2000);
		}
	});
	
	$('#post_room_view_button').click(function(){
		var t = $(this);
		var form = $("#releaseForm");
		form.attr('action',APP+'/Goods/view');
		form.attr('target','_blank');
		if(verification()){
			form.submit();
		}else{
			t.tip(L.PARAMETER_ERROR,2000);
		}
	});
	
	$('#title,#short_title,#num,#tel,#address').focusin(function(){
		$(this).removeTip();
	});
	
	$('#tos_confirm').click(function(){
		$(this).removeTip();
	});
	
	
	function verification(){
		var form = $("#releaseForm");
		var bool = true;
		var target = form.attr('target');
		var title = form.find('#title');
		var title_val = title.val();
		if(title_val){
			if(title_val.length < 10){
				title.tip(L.TITLE_SHORT);
				bool = false;
			}
		}else{
			title.tip(L.PLEASE_INPUT_TITLE);
			bool = false;
		}
		
		var short_title = form.find('#short_title');
		var short_title_val = short_title.val();
		if(!short_title_val){
			short_title.tip(L.PLEASE_INPUT_SHORT_TITLE);
			bool = false;
		}
		
		var num = form.find('#num');
		var num_val = short_title.val();
		if(!num_val){
			num.tip(L.PLEASE_INPUT_NUMS);
			bool = false;
		}else{
			if(parseInt(num_val) < 1){
				num.tip(L.NUMS_SMALL);
				bool = false;
			}
		}
		
		var tel = form.find('#tel');
		var tel_val = tel.val();
		if(!tel_val){
			tel.tip(L.PLEASE_INPUT_PHONE);
			bool = false;
		}
		
		var address = form.find('#address');
		var address_val = address.val();
		if(!address_val){
			address.tip(L.PLEASE_INPUT_ADDRESS);
			bool = false;
		}
		
		var tos_confirm = form.find('#tos_confirm');
		var tos_confirm_val = tos_confirm.attr('checked');
		if(!tos_confirm_val){
			tos_confirm.tip(L.PLEASE_AGREE_TERMS_USE);
			bool = false;
		}
		
		return bool
	}
	
	$('#addCategory,#addRegion').click(function(){
		var t = $(this);
		var url = t.attr('href');
		var uuid = t.attr('guid');
		if(!uuid){
			uuid = guid();
		}
		jvfDialog(uuid, url);
		t.attr('guid',uuid);
		return false;
	});
	
	xheditorBox();
}

function xheditorBox(_box){
	var $p = $(_box || document);
	$.getScript(PUBLIC+'/xheditor/xheditor-1.1.9-zh-cn.min.js',function(){
		if ($.fn.xheditor) {
			$("textarea.editor",$p).each(function(){
				var $this = $(this);
				var op = {skin: 'nostyle',tools:'Bold,Italic,Underline,Strikethrough,FontColor,|,Align,List,Outdent,Indent,|,Link,Unlink,Img,Emot,|,Source'};
				var upAttrs = [
					["upLinkUrl","upLinkExt","zip,rar,txt"],
					["upImgUrl","upImgExt","jpg,jpeg,gif,png"],
					["upFlashUrl","upFlashExt","swf"],
					["upMediaUrl","upMediaExt","avi"]
				];
				$(upAttrs).each(function(i){
					var urlAttr = upAttrs[i][0];
					var extAttr = upAttrs[i][1];
					
					if ($this.attr(urlAttr)) {
						op[urlAttr] = $this.attr(urlAttr);
						op[extAttr] = $this.attr(extAttr) || upAttrs[i][2];
					}
				});
				op['editorRoot'] = PUBLIC+'/xheditor/';
				$this.xheditor(op);
			});
		}
	});
}

function memberFriends(){
	$('.addImg').unbind('click').click(function(){
		var div = $('.addBox');
		var s  = div.html();
		if(!s){
			var html = '<div style="vertical-align:middle;">'
	          	+'<input class="input" style="position: relative;top: -1px;width: 40px;" type="text">'
	          	+'<span class="btn2 queren" style="margin:0 4px;"><button type="button">'+L.ENTER+'</button></span>'
	         	+'<span class="btn2 quxiao"><button type="button">'+L.CANCEL+'</button></span>'
	          	+'</div>';
			div.html(html);
		}else{
			div.html('');
		}
	});
	
	$('.ulE li:not([id="dt_all"])').die('mouseenter').die('mouseleave').live('mouseenter',function(){
		var con = $(this).find('.operate').html();
		if(!con){
			var html = '<div class="operate">'
				  	+'<a class="adel cp mr10" title="'+L.DELETE+'"></a>'
				  	+'<a class="aedit mr5 cp" title="'+L.EDIT+'"></a>'
				  	+'</div>';
		    $(this).find('.lis').prepend(html);
		}
	}).live('mouseleave',function(){
		var operate = $(this).find('.operate');
		operate.remove();
	});
	
	$('.quxiao').die('click').live('click',function(){
		var div_this = $(this).parent();
		var div_list = div_this.next();
		div_this.remove();
		div_list.show();
	});
	
	$('.ulE a.aedit').die('click').live('click',function(){
		var li = $(this).parents('li');
		var div = $(this).parents('.lis');
		var gid = li.attr('gid');
		var html = '<div style="vertical-align:middle;">'
	          	+'<input class="input" style="position: relative;top: -1px;width: 40px;" type="text" gid="'+gid+'">'
	          	+'<span class="btn2 queren" style="margin:0 4px;"><button type="button">'+L.ENTER+'</button></span>'
	         	+'<span class="btn2 quxiao"><button type="button">'+L.CANCEL+'</button></span>'
	          	+'</div>';
        div.hide();
        li.prepend(html);
	});
	
	$('.ulE a.adel').die('click').live('click',function(){
		var li = $(this).parents('li');
		var div = $(this).parents('.lis');
		var gid = li.attr('gid');
		var url = APP+'/Member/friendsGroupDel/id/'+gid;
		$.getJSON(url,function(data){
			if(data.status == 1){
				li.remove();
			}else{
				tipBox(input,data.info,{left:-150,top:-2});
			}
		});
	});
	
	$('.queren').die('click').live('click',function(){
		var input = $(this).prev();
		var gid = input.attr('gid');
		var url = '';
		var para = '';
		var name= input.val();
		if(!name){
			input.tip(L.MEMBER_FRIENDS_ALERT,2000);
			input.focus();
			return false;
		}
		if(!gid){
			url = APP+'/Member/friendsGroupAdd';
			para = 'name='+name;
		}else{
			url = APP+'/Member/friendsGroupEdit';
			para = 'id='+gid+'&name='+name;
		}
		var div_this = $(this).parent();
		var div_list = div_this.next();
		$.post(url,para,function(data){
			if(data.status == 1){
				if(!gid){
					var html = '<li gid="'+data.info.id+'">'
				          	+'<div class="lis">'
				          	+'<a class="mr5 groupname jvf_onlin jvf_fl maxw" href="'+APP+'/Member/friends/gid/'+data.info.id+'">'+data.info.name+'</a><span>[0]</span>'
				          	+'</div>'
				            +'</li>';
				    $('.ulE li:last').before(html);
				}else{
					var li = $('.ulE li[gid="'+data.info.id+'"]');
					li.find('.lis a.groupname').text(data.info.name);
				}
				div_this.remove();
				div_list.show();
			}else{
				input.tip(data.info,2000);
			}
		},'json');
	});
	
	$('.link_down').unbind('click').click(function(){
		var lis = $('.ulE li:not([id="dt_all"],[id="dt_ng"])');
		var friGroup = $(this).parent().find('.friGroup');
		if(!friGroup.html()){
			var html = '<div class="f_fenz jvf_frame"><ul>';
			lis.each(function(n,i){
				var name = $(this).find('a.groupname').text();
				var gid = $(this).attr('gid');
				html += '<li gid="'+gid+'"><a href="javascript:;">'+name+'</a></li>';
			});
			html += '</ul></div>';
			$(this).parent().append(html);
		}
	});
	
	$('.nadlCon_r').die('mouseleave').live('mouseleave',function(){
		var div = $(this).find('.f_fenz');
		div.remove();
	});
	
	$('.f_fenz li a').die('click').live('click',function(){
		var li = $(this).parent();
		var gid = li.attr('gid');
		var uid = li.parents('.nadlA').attr('uid');
		var name= $(this).text();
		var url = APP+'/Member/friendsSetGroup/gid/'+gid+'/uid/'+uid;
		$.getJSON(url,function(data){
			if(data.status == 1){
				$('.nadlA[uid="'+uid+'"] .nadlCon_r a.link_down span').text(name);
				li.parents('.f_fenz').remove();
			}else{
				li.tip(data.info,2000);
			}
		});
	});
	
	$('.friends_gl dl').die('mouseenter').die('mouseleave').live('mouseenter',function(){
		var div = $(this).find('.nadlCon_c');
		var con = div.find('.operate_hd').html();
		if(!con){
			var html = '<div class="f_gl"><ul>'
	                +'<li><a class="sendFriend" href="javascript:;">'+L.MEMBER_FRIENDS_SEND+'</a></li>'
	                +'<li><a class="delFriend" href="javascript:;">'+L.DEL_FRIEND+'</a></li>'
	                +'</ul></div>';
	        div.append(html);
		}
	}).live('mouseleave',function(){
		var operate = $(this).find('.nadlCon_c .f_gl');
		operate.remove();
	});
	
	$('.delFriend').die('click').live('click',function(){
		var dl = $(this).parents('dl');
		var uid = dl.attr('uid');
		var url = APP+'/Member/removefriend/id/'+uid;
		var t = $(this);
		$.getJSON(url,function(data){
			if(data.status == 1){
				dl.remove();
			}else{
				t.tip(data.info,2000);
			}
		});
	});
	
	$('.sendFriend').die('click').live('click',function(){
		var dl = $(this).parents('dl');
		var uid = dl.attr('uid');
		var url = APP+'/Member/sendpm/id/'+uid;
		var uuid = guid();
		jvfDialog(uuid, url);
	});
	
	$('.ulE li .groupname,.ulE li#dt_all a,.ulE li#dt_ng a').die('click').live('click',function(){
		var t = $(this);
		var url = t.attr('href');
		$.get(url,function(data){
			t.parents('.administration_box').html(data);
		});
		return false;
	});
}

function memberReviews(){
	$.getJSON(APP+'/Comment/ajaxreleasedComment/',function(result){
		$('#released_content').html(result.data.commentdata);
		$('#released_page').html(result.data.page);
	});
	
	$('#released_page a').live('click',function(){
		var url = $(this).attr('href');
		$.getJSON(url,function(result){
			$('#released_content').html(result.data.commentdata);
			$('#released_page').html(result.data.page);
		});
		return false;
	});
	
	$('.vieworder,.commentadd,.editcomment').live('click',function(){
		var t = $(this);
		var url = t.attr('href');
		var uuid = t.attr('guid');
		if(!uuid){
			uuid = guid();
			t.attr('guid',uuid);
		}
		jvfDialog(uuid, url);
		return false;
	});
}

function memberReferences(){
	$.getJSON(APP+'/Recommend/ajaxreleasedRecommend/',function(result){
		$('#recommend_content').html(result.data.recommenddata);
		$('#recommend_page').html(result.data.page);
	});
	
	$('#recommend_page a').live('click',function(){
		var url = $(this).attr('href');
		$.getJSON(url,function(result){
			$('#recommend_content').html(result.data.recommenddata);
			$('#recommend_page').html(result.data.page);
		});
		return false;
	});
	
	$('.editrecommend').live('click',function(){
		var t = $(this);
		var url = t.attr('href');
		var uuid = t.attr('guid');
		if(!uuid){
			uuid = guid();
			t.attr('guid',uuid);
		}
		jvfDialog(uuid, url);
		return false;
	});
}

function memberMyattention(){
	$('#attentionList dl').live('mouseenter',function(){
		$(this).find('.nadlCon_c .f_gl').show();
	}).live('mouseleave',function(){
		$(this).find('.nadlCon_c .f_gl').hide();
	});
	
	$('#attentionList .nadlCon_c .f_gl a').live('click',function(){
		var t = $(this);
		var url = t.attr('href');
		$.getJSON(url,function(data){
			if(data.status == 1){
				if(t.is('.cancel')){
					t.tip(data.info,2000);
					t.parents('dl').remove();
				}else{
					var uuid = guid();
					jvfDialogHtml(uuid, data.info);
				}
			}else{
				t.tip(data.info,2000);
			}
		});
		return false;
	});
}

function memberStep(){
	var crrIndex = 0;
	$('.jvf_setall .set_btn .exit,.jvf_setall .set_btn .end').click(function(){
		$(this).parents('.ui-dialog').find('.ui-dialog-titlebar-close').trigger('click');
	});
	
	$('.jvf_setall .set_btn .start').click(function(){
		crrIndex = 0;
		reset();
	});
	
	$('.jvf_setall .set_btn .down').click(function(){
		crrIndex ++;
		reset();
	});
	
	function reset(){
		var set_btn = $('.jvf_setall .set_btn');
		var set_cent = $('.jvf_setall .set_cent');
		var step_item = $('.jvf_setall .set_conall .step_item');
		var set_contx = $('.jvf_setall .set_contx div');
		set_contx.removeClass('setco');
		step_item.removeClass('selected');
		if(crrIndex >= 0){
			set_contx.eq(crrIndex).addClass('setco');
			step_item.eq(crrIndex).addClass('selected').prevAll().addClass('selected');
			step_item.eq(crrIndex).nextAll().removeClass('selected');
		}
		set_btn.hide();
		set_btn.eq(crrIndex+1).show();
		set_cent.hide();
		set_cent.eq(crrIndex+1).show();
	}
	
	function randomSys(){
		$.get(APP+'/Circle/randomSys',function(data){
			$('.jvf_frame .quanz_list').html(data);
		});
	}
	
	function randomLabel(){
		$.get(APP+'/Circle/randomLabel',function(data){
			$('.jvf_frame .biaoq_list').html(data);
		});
	}
	
	randomSys();
	randomLabel();
	$('.jvf_frame .quanz_btn').click(function(){
		randomSys();
	});
	
	$('.jvf_frame .biaoq_btn').click(function(){
		randomLabel();
	});
	
	$('.jvf_frame .quanz_list a,.jvf_frame .biaoq_list a').live('click',function(){
		var t = $(this);
		var crr = t.clone();
		$('.jvf_frame .quaned_list').append(crr);
		var html = '<input name="lids[]" type="hidden" value="'+t.attr('lid')+'"/>';
		crr.append(html);
	});
	
	$('.jvf_frame .quaned_list a').live('click',function(){
		var t = $(this);
		t.remove();
	});
	
	$('.jvf_setall #submit_local').click(function(){
		var form = $('#add_locationform');
		var url = form.attr('action');
		var para = form.serialize();
		$.post(url,para);
	});
	
	function sameHobby(){
		$.get(APP+'/Member/sameHobby',function(data){
			$('.gzlist ul').html(data);
		});
	}
	
	$('.jvf_setall #submit_label').click(function(){
		var form = $('#label_form');
		var url = form.attr('action');
		var para = form.serialize();
		$.post(url,para,function(){
			sameHobby();
		});		
	});
	
	$('.jvf_setall #nextsame').click(function(){
		sameHobby();
	});
	
	$('.jvf_setall #togetherListen').click(function(){
		var t = $(this);
		var uids = [];
		$('.gzlist li a').each(function(){
			uids.push($(this).attr('uid'));
		});
		var str = uids.join(',');
		$.post(APP+'/Member/togetherListen','uids='+str,function(data){
			t.tip(data.info,2000);
		},'json');
	});
}

function memberPrepaidCard(){
	$('#submitCardForm').unbind('click');
	$('#submitCardForm').click(function(){
		var t = $(this);
		var form = $('#prepaidCardForm');
		var url = form.attr('action');
		var para = form.serialize();
		var sn = form.find('input[name="sn"]');
		var pwd = form.find('input[name="pwd"]');
		if(!sn.val()){
			sn.tip(L.MEMBER_CHECKPREPAIDCARD_EMPTY_SN,2000);
			return false;
		}
		
		if(!pwd.val()){
			pwd.tip(L.MEMBER_CHECKPREPAIDCARD_EMPTY_PWD,2000);
			return false;
		}
		
		$.post(url,para,function(data){
			t.tip(data.info,2000);
			if(data.status == 1){
				t.parents('.ui-dialog').find('.ui-dialog-titlebar-close').trigger('click');
				window.location.reload();
			}
		},'json');
		
	});
}

function memberWithdraw(){
	$('#submitAddwithdraw').unbind('click');
	$('#submitAddwithdraw').click(function(){
		var t = $(this);
		var form = $('#addwithdraw');
		var url = form.attr('action');
		var para = form.serialize();
		var cash = form.find('input[name="cash"]');
		var bank_id = form.find('input[name="bank_id"]');
		var bank_card = form.find('input[name="bank_card"]');
		var realname = form.find('input[name="realname"]');
		
		if(!cash.val()){
			cash.tip(L.MEMBER_ADDWITHDRAW_CASH,2000);
			return false;
		}
		
		if(!bank_id.val()){
			bank_id.tip(L.MEMBER_ADDWITHDRAW_BANK_ID,2000);
			return false;
		}
		
		if(!bank_card.val()){
			bank_card.tip(L.MEMBER_ADDWITHDRAW_BANK_CARD,2000);
			return false;
		}
		
		if(!realname.val()){
			realname.tip(L.MEMBER_ADDWITHDRAW_REALNAME,2000);
			return false;
		}
		
		$.post(url,para,function(data){
			t.tip(data.info,2000);
			if(data.status == 1){
				t.parents('.ui-dialog').find('.ui-dialog-titlebar-close').trigger('click');
			}
		},'json');
	});
}

function memberRecharge(){
	$('#goodsBuyBtn').unbind('click');
	$('#goodsBuyBtn').click(function(){
        var t = $(this);
		var form = $('#payForm');
		var url = form.attr('action');
		var para = form.serialize();
		var cash = form.find('input[name="cash"]');
		if(!cash.val()){
			cash.tip(L.PLEASE_INPUT_AMOUNT,2000);
            cash.focus();
			return false;
		}
		$.post(url,para,function(data){
			if(data.status == 0){
				if(data.data == 1){
					cash.tip(data.info,2000);
					cash.focus();
				}else{
					t.tip(data.info,2000);
				}
			}else{
				jvfDialogHtml(guid(),data.info.html);
			}
		},'json');
		return false;
	});
}

function memberFriendadd(){
	$('#agree_addfriendform input[name="commit"]').unbind('click');
	$('#agree_addfriendform input[name="commit"]').click(function(){
		var t = $(this);
		var form = t.parents('#agree_addfriendform');
		var url = form.attr('action');
		var para = form.serialize();
		$.post(url,para,function(data){
			t.tip(data.info,2000);
			if(data.status == 1){
				t.parents('.ui-dialog').find('.ui-dialog-titlebar-close').trigger('click');
			}
		},'json');
	});
}

function memberCommentorder(total){
	var CL = {cla:'',fen:''};
	$('.stats .rating').unbind('mousemove');
	$('.stats .rating').unbind('mouseover');
	$('.stats .rating').unbind('mouseout');
	$('.stats .rating').unbind('mousedown');
	$('#commentorderform input[name="commit"]').unbind('click');
	$('#commentorderform input[name="commit"]').click(function(){
		var t = $(this);
		var form = t.parents('#commentorderform');
		var url = form.attr('action');
		var para = form.serialize();
		var content = form.find('textarea[name="content"]');
		if(!content.val()){
			content.tip(L.PLEASE_INPUT_EVALUATE_CONTENT,2000);
		}
		$.post(url,para,function(data){
			t.tip(data.info,2000);
			if(data.status == 1){
				t.parents('.ui-dialog').find('.ui-dialog-titlebar-close').trigger('click');
			}
		},'json');
	});
	
	$('.stats .rating').mousemove(function(event){
		var chi = $(this).children();
		var x = event.pageX;
		var c = x - $(this).offset().left;
		var fen = Math.round(c / 0.77);
		var star = Math.round(c / 7.7);
		var n = 'filled star_'+star;
		chi.attr('class',n);
		if(fen > total){
			fen = total;
		}
		if(fen < 0){
			fen = 0;
		}
		$(this).siblings().find('.fen').text(fen);
		$(this).parent().siblings('input').val(fen);
	}).mouseover(function(){
		var chi = $(this).children();
		var cla = chi.attr('class');
		chi.attr('class','');
		CL.cla = cla;
		CL.fen = $(this).parent().siblings('input').val();
	}).mouseout(function(){
		var chi = $(this).children();
		chi.attr('class',CL.cla);
		$(this).siblings().find('.fen').text(CL.fen);
		$(this).parent().siblings('input').val(CL.fen);
	}).mousedown(function(event){
		var x = event.pageX;
		var c = x - $(this).offset().left;
		CL.fen = Math.round(c / 0.77);
		if(CL.fen > total){
			CL.fen = total;
		}
		if(CL.fen < 0){
			CL.fen = 0;
		}
		var star = Math.round(c / 7.7);
		CL.cla = 'filled star_'+star;
	});
}

function memberViewo_details(){
	$(".drawback,.commentadd").unbind('click');
	$(".drawback,.commentadd").click(function() {
		var t= $(this);
		var url = t.attr('href');
		var uuid = t.attr('guid');
		if(!uuid){
			uuid = guid();
			t.attr('guid',uuid);
		}
		jvfDialog(uuid, url);
		return false;
	});
}

function memberWithdraw_log(){
	$('.withdraw_log a.view').unbind('click');
	$('.withdraw_log a.del').unbind('click');
	$('.withdraw_log a.view').click(function(){
		var t = $(this);
		var url = t.attr('href');
		var uuid = t.attr('guid');
		if(!uuid){
			uuid = guid();
			t.attr('guid',uuid);
		}
		jvfDialog(uuid, url);
		return false;
	});
	$('.withdraw_log a.cancel').click(function(){
		var t = $(this);
		var url = t.attr('href');
		$.getJSON(url,function(data){
			t.tip(data.info,2000)
			if(data.status == 1){
				t.remove();
				t.parent().prev().find('span').text(L.STATUS_REVOCATION);
			}
		});
		return false;
	});
}

function memberBusinessInvitation(){
	$.getScript(TPL_PUBLIC + '/js/ZeroClipboard.js',function(){
		ZeroClipboard.setMoviePath(TPL_PUBLIC + '/js/ZeroClipboard.swf' );  //和copy.php不在同一目录需设置setMoviePath
	    ZeroClipboard.setMoviePath(TPL_PUBLIC + '/js/ZeroClipboard10.swf' );
	    var clip = new ZeroClipboard.Client();   //创建新的Zero Clipboard对象
	    clip.setText( '' ); // will be set later on mouseDown   //清空剪贴板
	    clip.setHandCursor( true );      //设置鼠标移到复制框时的形状
	    clip.setCSSEffects( true );          //启用css
	    clip.addEventListener( 'load', function(client) {
	        //alert( "movie is loaded" );
	    } );
	    clip.addEventListener( 'complete', function(client, text) {     //复制完成后的监听事件		
	        alert(L.COPY_SUCCESS);
	        //clip.hide(); // 复制一次后，hide()使复制按钮失效，防止重复计算使用次数
	    } );
	    clip.addEventListener( 'mouseOver', function(client) {
	        //alert("mouse over");
	    } );
	    clip.addEventListener( 'mouseOut', function(client) {
	        //alert("mouse out");
	    } );
	    clip.addEventListener( 'mouseDown', function(client) {
	        // set text to copy here
	    clip.setText( document.getElementById('fb_message').value );
	        //alert("mouse down");
	    } );
	    clip.addEventListener( 'mouseUp', function(client) {
	        // alert("mouse up");
	    } );
	    clip.glue( 'fb-send-button' );
	});
	
	$('#references_emails input[name="commit"]').click(function(){
		var t = $(this);
		var form = t.parents('#references_emails');
		var url = form.attr('action');
		var para = form.serialize();
		$.post(url,para,function(data){
			t.tip(data.info,2000);
			if(data.status == 1){
				form.find('#email_addresses').val('');
			}
		},'json');
	});
	
	$.getJSON(APP+'/Recommend/ajaxreferencesRecommend/',function(result){
		$('#recommend_content').html(result.data.recommenddata);
		$('#recommend_page').html(result.data.page);
	});
	
	$('#recommend_page a').click(function(){
		var t = $(this);
		var url = t.attr('href');
		$.getJSON(url,function(result){
			$('#recommend_content').html(result.data.recommenddata);
			$('#recommend_page').html(result.data.page);
		});
		return false;
	});
}

function incomeEvaluation(){
	$.getJSON(APP+'/Comment/ajaxreviewsComment/',function(result){
		$('#comment_content').html(result.data.commentdata);
		$('#comment_page').html(result.data.page);
	});
	
	$('#comment_page a').click(function(){
		var t = $(this);
		var url = t.attr('href');
		$.getJSON(url,function(result){
			$('#comment_content').html(result.data.commentdata);
			$('#comment_page').html(result.data.page);
		});
		return false;
	});
}

function memberVerification(){
	$('#sendmail').click(function(){
		var t = $(this);
		var form = $('#resendmail');
		var url = form.attr('action');
		var para = form.serialize();
		$.post(url,para,function(data){
			t.tip(data.info,2000);
			t.hide();
			setTimeout(function(){
				$("#sendmail").show();
			}, 60000);
		},'json');
	});
	
	$('#addphone_verification').click(function(){
		$('.phone-number-verify').show();
	});
	
	$('#smsauthcode_verification').click(function(){
		var t = $(this);
		var phone = t.parents('tr').attr('data-number');
		$("#phone_number_verification").val(phone);
		$.getJSON(APP+'/Member/smsphone/phone/'+phone,function(data){
			if(data.status == 1){
				$('.send-verification-error').html(data.info).show();
				$('.phone-number-verify').show();
				$("#smsphone_verification").hide();
				setTimeout(function(){
					$("#smsphone_verification").show()
				}, 60000);
			}else{
				t.tip(data.info,2000);
			}
		});
	});
	
	$("#smsphone_verification").live('click',function() {
		var t = $(this);
	    var phone = $("#phone_number_verification").val();
		$.getJSON(APP+'/Member/smsphone/phone/'+phone,function(data){
			if(data.status == 1){
				$('.send-verification-error').html(data.info).show();
				$('.phone-number-verify').show();
				$("#smsphone_verification").hide();
				setTimeout(function(){
					$("#smsphone_verification").show()
				}, 60000);
			}else{
				t.tip(data.info,2000);
			}
		});
		return false;
	});
	
	$("#verifyphone_verification").live('click',function() {
		var t = $(this);
	    var phone = $("#phone_number_verification").val();
		var authcode = $("#phone_authcode_verification").val();
		var url = APP+'/Member/phoneverify/phone/'+phone+'/authcode/'+authcode;
		
		$.getJSON(url,function(data){
			t.tip(data.info,2000);
			if(data.status == 1){
				$('.phone-number-verify').hide();
				var tr = $('.phone-numbers-table tr:first');
				tr.attr('data-number',phone);
				tr.find('th').text(phone);
				var span = tr.find('.unverified');
				span.attr('class','verified');
				span.html('<span class="icon"></span>'+L.VERIFICATION_TEXT+'</span>');
			}
		});
		return false;
	});
	
}

function memberBankfanh(url){
	$('.pay_success,.switch_type').unbind('click');
	$('.pay_success').click(function(){
		var t = $(this);
		t.parents('.ui-dialog').find('.ui-dialog-titlebar-close').trigger('click');
		if(url){
			goUrl(url);
		}
	});
	
	$('.switch_type').click(function(){
		var t = $(this);
		t.parents('.ui-dialog').find('.ui-dialog-titlebar-close').trigger('click');
		var oid = t.attr('oid');
		if(oid){
			goUrl(APP+'/Member/payment/oid/'+oid);
		}
	});
}

function ajaxforgot_password(){
	$('#forgotform input[name="commit"]').click(function(){
		var t= $(this);
		var form = t.parents('form');
		var url = form.attr('action');
		var para = form.serialize();
		$.post(url,para,function(data){
			t.tip(data.info,2000);
		},'json');
	});
}

function memberModifyPwd(){
	$('#submitPwdForm').click(function(){
		var t = $(this);
		var form = $('#setPwdForm');
		var url = form.attr('action');
		var para = form.serialize();
		
		var oldpwd = form.find('input[name="oldpwd"]');
		if(!oldpwd.val()){
			oldpwd.tip(L.MEMBER_SAVEPWD_EMPTY_OLDPWD,2000);
			return false;
		}
		
		var newpwd = form.find('input[name="newpwd"]');
		if(!newpwd.val()){
			newpwd.tip(L.MEMBER_SAVEPWD_EMPTY_NEWPWD,2000);
			return false;
		}
		
		if(newpwd.val().length < 5){
			newpwd.tip(L.PASSWORDS_MINLENGTH,2000);
			return false;
		}
		
		var newpwd2 = form.find('input[name="newpwd2"]');
		if(!newpwd2.val()){
			newpwd2.tip(L.MEMBER_SAVEPWD_EMPTY_NEWPWD2,2000);
			return false;
		}
		
		if(newpwd2.val() != newpwd.val()){
			newpwd2.tip(L.MEMBER_MODIFYPWD_DIFFERENT,2000);
			return false;
		}
		
		$.post(url,para,function(data){
			t.tip(data.info,2000);
			if(data.status == 1){
				goUrl(APP+'/User/signin');
			}
		},'json');
		
	});
}

function memberBuyOrderList(){
	$('.jvf_mbwid .vieworder').click(function(){
		var t = $(this);
		var url = t.attr('href');
		var uuid = t.attr('guid');
		if(!uuid){
			uuid = guid();
			t.attr('guid',uuid);
		}
		jvfDialog(uuid, url);
		return false;
	});
	$('.jvf_mbwid .Invalid').click(function(){
		var t = $(this);
		var url = t.attr('href');
		$.getJSON(url,function(data){
			t.tip(data.info,2000);
			if(data.status == 1){
				t.prev().remove();
				t.parent().prev().find('span').text(L.STATUS_ALLREFUND);
				t.remove();
			}
		});
		return false;
	});
	
}

function userSetpwd(){
	$('#setpassword input[name="commit"]').click(function(){
		var t = $(this);
		var form = $('#setpassword');
		var url = form.attr('action');
		var para = form.serialize();
		
		var password = form.find('input[name="password"]');
		if(!password.val()){
			password.tip(L.PLEASE_INPUT_PASSWORD,2000);
			return false;
		}
	
		if(password.val().length < 5){
			password.tip(L.PASSWORDS_MINLENGTH,2000);
			return false;
		}
		
		var password_confirmation = form.find('input[name="password_confirmation"]');
		if(!password_confirmation.val()){
			password_confirmation.tip(L.PLEASE_INPUT_CONFIRM_PASSWORD,2000);
			return false;
		}
		
		if(password_confirmation.val() != password.val()){
			password_confirmation.tip(L.PASSWORDS_NOT_EQUAL,2000);
			return false;
		}
		
		$.post(url,para,function(data){
			t.tip(data.info,2000);
			if(data.status == 1){
				goUrl(APP+'/User/signin');
			}
		},'json');
		
	});
}

function memberFriendAll(){
	$('.at_friend .clos').unbind('click');
	$('.at_friend .clos').click(function(){
		var t =$(this);
		t.parents('.at_friend').hide();
	});
	$('.at_friend input[name="friendname"]').unbind('keyup');
	$('.at_friend input[name="friendname"]').keyup(function(){
		var val = $(this).val();
		var lis = $('.at_friend_list li');
		if(!val){
			lis.show();
		}else{
			lis.hide();
			$('.at_friend_list li[title*="'+val+'"]').show();
		}
	});
	
	$('.at_friend .at_friend_list li').unbind('click');
	$('.at_friend .at_friend_list li').click(function(){
		var t =$(this);
		var content = $('#talk_aboutBox textarea[name="content"]');
		content.val(content.val()+'@'+t.attr('title')+' ');
		t.parents('.at_friend').hide();
	});
}

function memberAddreferences(){
	$('#recommend_good').change(function(){
		var t = $(this);
		var val = t.val();
		var viewgood = $('#viewgood');
		if(val != 0){
			viewgood.find('a').attr('href',APP+'/Goods/index/id/'+val);
			viewgood.show();
		}else{
			viewgood.hide();
		}
	});
	
	$('#recommendform input[name="commit"]').click(function(){
		var t = $(this);
		var form = $('#recommendform');
		var url = form.attr('action');
		var para = form.serialize();
		
		var gid = form.find('#recommend_good');
		if(!gid.val()){
			gid.tip(L.MEMBER_ADDREFERENCES_SELECT,2000);
			return false;
		}
		var content = form.find('#recommend_content');
		if(!content.val()){
			content.tip(L.MEMBER_ADDREFERENCES_INPUT,2000);
			return false;
		}
		
		$.post(url,para,function(data){
			t.tip(data.info,2000);
			if(data.status == 1){
				content.val('');
				gid.val(0);
				$('#viewgood').hide();
			}
		},'json');
	});
}

function memberDrawback(){
	$('#refundform input[name="commit"]').unbind('click');
	$('#refundform input[name="commit"]').click(function(){
		var t = $(this);
		var form = $('#refundform');
		var url = form.attr('action');
		var para = form.serialize();
		
		var refund_reason = form.find('#refund_reason');
		if(!refund_reason.val()){
			refund_reason.tip(L.MEMBER_DRAWBACK_ALERT,2000);
			return false;
		}
		
		$.post(url,para,function(data){
			t.tip(data.info,2000);
			if(data.status == 1){
				t.parents('.ui-dialog').find('.ui-dialog-titlebar-close').trigger('click');
			}
		},'json');
	});
}

function memberReport(){
	$('#complaintForm input[name="commit"]').unbind('click');
	$('#complaintForm input[name="commit"]').click(function(){
		var t = $(this);
		var form = $('#complaintForm');
		var url = form.attr('action');
		var para = form.serialize();		
		$.post(url,para,function(data){
			t.tip(data.info,2000);
			if(data.status == 1){
				t.parents('.ui-dialog').find('.ui-dialog-titlebar-close').trigger('click');
				$('.jvf_report').fadeOut();
			}
		},'json');
	});
}

function ajaxCircle(){
	$('.shop_all').live('mouseover',function(){
		$(this).find('.space_operation').show();
	}).live('mouseout',function(){
		$(this).find('.space_operation').hide();
	});
	
	$('.shop_all .space_operation .like').live('click',function(){
		var t = $(this);
		var url = t.attr('href');
		$.getJSON(url,function(data){
			t.tip(data.info,2000);
		});
		return false;
	});
}

function ajaxFriend(){
	$('.masonry-brick').live('mouseover',function(){
		$(this).find('.space_operation').show();
	}).live('mouseout',function(){
		$(this).find('.space_operation').hide();
	});
	
	$('.masonry-brick .but_a[add="add"]').live('click',function(){
		var t = $(this);
		var href = $(this).attr('href');
			loginAfter(function(){
			$.getJSON(href,function(data){
				if(data.status == 1){
					t.tip(data.info,2000);
					t.text(L.REMOVE_ATTENTION);
					t.removeAttr('add');
					t.attr('href',href.replace('attention','removeattention'));
					t.attr('remove','remove');
				}else{
					t.tip(data.info,3000);
				}
			});
		});
		return false;
	});
	
	$('.masonry-brick .space_operation .but_a[remove="remove"]').live('click',function(){
		var t = $(this);
		var href = $(this).attr('href');
		loginAfter(function(){
			$.getJSON(href,function(data){
				if(data.status == 1){
					t.tip(data.info,2000);
					t.text(L.ADD_ATTENTION);
					t.removeAttr('remove');
					t.attr('href',href.replace('removeattention','attention'));
					t.attr('add','add');
				}else{
					t.tip(data.info,3000);
				}
			});
		});
		return false;
	});
	
	$('.masonry-brick .space_operation a.doDialog').live('click',function(){
		var t = $(this);
		var href = t.attr('href');
		var uuid = guid();
		t.attr('guid',uuid);
		loginAfter(function(){
			$.getJSON(href,function(data){
				if(data.status == 1){
					jvfDialogHtml(uuid, data.info);
				}else{
					t.tip(data.info,3000);
				}
			});
		});
		return false;
	});
}

function memberEditLabel(){
	function randomSys(){
		$.get(APP+'/Circle/randomSys',function(data){
			$('.jvf_frame .quanz_list').html(data);
		});
	}
	
	function randomLabel(){
		$.get(APP+'/Circle/randomLabel',function(data){
			$('.jvf_frame .biaoq_list').html(data);
		});
	}
	
	randomSys();
	randomLabel();
	$('.jvf_frame .quanz_btn').click(function(){
		randomSys();
	});
	
	$('.jvf_frame .biaoq_btn').click(function(){
		randomLabel();
	});
	
	$('.jvf_frame .quanz_list a,.jvf_frame .biaoq_list a').live('click',function(){
		var t = $(this);
		var crr = t.clone();
		t.remove();
		var lid = crr.attr('lid');
		if(!$('.jvf_frame .quaned_list a[lid="'+lid+'"]').html()){
			$('.jvf_frame .quaned_list').append(crr);
			var html = '<input name="lids[]" type="hidden" value="'+t.attr('lid')+'"/>';
			crr.append(html);
		}
	});
	
	$('.jvf_frame .quaned_list a').live('click',function(){
		var t = $(this);
		var crr = t.clone();
		crr.find('input').remove();
		if(crr.is('.qzlist')){
			$('.jvf_frame .quanz_list').append(crr);
		}else{
			$('.jvf_frame .biaoq_list').append(crr);
		}
		t.remove();
	});
	
	$('#edit_submit').click(function(){
		var t = $(this);
		var form = $('#label_form');
		var url = form.attr('action');
		var para = form.serialize();
		$.post(url,para,function(data){
			t.tip(data.info,2000);
			if(data.status == 1){
				t.parents('.ui-dialog').find('.ui-dialog-titlebar-close').trigger('click');
			}
		},'json');
	});
}

function userInfo(){
}

function CommentIndex(condition){
	condition = condition?condition:{};
	var $container = $('.category_shop');
	var $page = $('.jvf_page');
	$.getScript(PUBLIC+'/dwz/js/jquery.masonry.min.js',function(){
		reset();
	});	
	
	var scrollboot = true;
	
	$(window).scroll(function(){
		var bottom = $container.offset().top + $container.outerHeight() - $(this).height();
		var scrollTop=$(document).scrollTop();//滚动条距离
		if(scrollTop>=bottom && scrollboot){
			scrollboot = false;
			var href = $page.find('.current').next('a').attr('href');
			if(href){
				$.getJSON(href,function(data){
					$page.html(data.info.page);
					$newElems = $(data.info.html);
						$container.append($newElems).masonry( 'appended', $newElems, false );
						scrollboot = true;
				});
			}			
		}
	});
	
	function reset(){
		$.post(APP+'/Comment/ajaxList',getPara(),function(data){
			$page.html(data.info.page);
			$container.find('.shop_all').remove();
			var html = $(data.info.html);
			$container.append(html);
			if($container.is('.masonry')){
					$container.masonry('reload');
			}else{
			      $container.masonry({
			        itemSelector : '.shop_all'
			      });
			}
		},'json');
	}
	
	function getPara(){
		var para = [];
		for(var k in condition){
			para.push(k+'='+condition[k]);
		}
		return para.join('&');
	}
}

$(function(){
	globalEvent();
});