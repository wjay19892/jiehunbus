var advpositionHTML='<table cellpadding="0" cellspacing="0">\r\n<tr>\r\n<foreach name="adv_list" item="adv">\r\n<td>{$adv.html}</td>\r\n</foreach>\r\n</tr>\r\n</table>';

var advPositionSwf="<script type=\"text/javascript\">\r\ndocument.write('<object classid=\"clsid:d27cdb6e-ae6d-11cf-96b8-444553540000\" codebase=\"http://fpdownload.macromedia.com/pub/shockwave/cabs/flash/swflash.cab#version=6,0,0,0\" width=\"[adv_position.width]\" height=\"[adv_position.height]\"><param name=\"allowScriptAccess\" value=\"sameDomain\"><param name=\"movie\" value=\"[adv_path]\"><param name=\"quality\" value=\"high\"><param name=\"bgcolor\" value=\"#F0F0F0\"><param name=\"menu\" value=\"false\"><param name=wmode value=\"opaque\"><param name=\"FlashVars\" value=\"pics=[adv_pics]&links=[adv_links]&borderwidth=[adv_position.width]&borderheight=[adv_position.height]&textheight=0\"><embed src=\"[adv_path]\" FlashVars=\"pics=[adv_pics]&links=[adv_links]&borderwidth=[adv_position.width]&borderheight=[adv_position.height]&textheight=0\" quality=\"high\" width=\"[adv_position.width]\" height=\"[adv_position.height]\" wmode=\"opaque\" allowScriptAccess=\"sameDomain\" type=\"application/x-shockwave-flash\" pluginspage=\"http://www.macromedia.com/go/getflashplayer\" /></object>');\r\n</script>";

function changAdvType(obj)
{
	var type = obj.value;
	var advid = $("#advid").val();  //可能存在的广告ID
	var code = "";
	$.ajax({
		  url: APP+"/Advertising/getadvertising/id/"+advid,
		  cache: false,
		  dataType: 'json',
		  success:function(data)
		  {	
			if(data)
			{
				if(data!="null")
				code = data.code;
			}	
			var html ="";
			if(type==1||type==2)
			{
				if(type==1)
				{
					$("#urlrow").show();
				}
				else
				{
					$("#urlrow").hide();
				}
				html = "<input type='file' name='code' />";
				if(code!="")
				{
					html += "&nbsp;&nbsp;<a href='"+ROOT+code+"' target='_blank'>查看</a>";
				}
			}
			else
			{
				$("#urlrow").hide();
				html ="<textarea name='code' class='textInput' rows='3' cols='60' >"+code+"</textarea>";
			}
			$("#code").html(html);
		  }
		}); 

	
}

function UpdatePositionStyle(obj)
{
	if($("input",obj).attr("checked"))
		$("#style").val(advPositionSwf);
	else
		$("#style").val(advpositionHTML);
}