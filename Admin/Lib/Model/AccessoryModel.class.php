<?php
class AccessoryModel extends CommonModel{
	//图片上传的基本方法。未完成。待配置扩展......
	/**
	 * 上传图片的通公基础方法
	 *
	 * @param integer $water  0:不加水印 1:打印水印
	 * @param string $dir  上传的文件夹
	 * @param string $width  缩略图最大宽度 例如"700,350"
	 * @param string $height  缩略图最大高度 例如"300,150"
	 * @param boolean $showstatus true:返回带状态的数组 false:返回上传列表的数组
	 * @return array
	 */
	public function imgUpload($water = 0,$dir='attachment',$width="",$height="",$showstatus = false){
		 $sysconfig = C('sysconfig');
		 if (!empty($_FILES)) {
		 	$a = import("ORG.Net.UploadFile");
        	$upload = new UploadFile();
			$upload->allowExts = explode(',', $sysconfig['site_upload_allowexts']);
        	//设置附件上传目录
       		$upload->savePath = UPLOADIMG.$dir."/";
	            //设置上传文件大小
	        $upload->maxSize =  $sysconfig['site_upload_maxsize'];
	        //设置上传文件类型
	
	        //设置需要生成缩略图，仅对图像文件有效
	        $upload->thumb = true;
	        // 设置引用图片类库包路径
	        $upload->imageClassPath = 'ORG.Util.Image';
	        //设置需要生成缩略图的文件后缀
	        $upload->thumbPrefix = 'm_,s_';  //生产2张缩略图
	        //设置缩略图最大宽度
	        if(empty($width))$upload->thumbMaxWidth = $sysconfig['site_big_width'].','.$sysconfig['site_small_width'];
			else $upload->thumbMaxWidth = $width;
	        //设置缩略图最大高度
	        if(empty($height))$upload->thumbMaxHeight = $sysconfig['site_big_heigth'].','.$sysconfig['site_small_heigth'];
			else $upload->thumbMaxHeight = $height;
	        //设置上传文件规则
	        $upload->saveRule = uniqid;
	        //删除原图
	        $upload->thumbRemoveOrigin = false;
			if(!is_dir($upload->savePath))@mk_dir($upload->savePath,0777);
	        if (!$upload->upload()) {
	            //捕获上传异常
				if($showstatus)
				{
					$result['status'] = false;
					$result['uploadList'] = false;
					$result['msg'] = $upload->getErrorMsg();
					return $result;
				}
				else
				return $uploadList = $upload->getErrorMsg();
	        } else {
	            //取得成功上传的文件信息
				
	            $uploadList = $upload->getUploadFileInfo();
				$water_mark = getcwd().$sysconfig['site_water_image'];
				foreach($uploadList as $k=>$fileItem){
					if($water&&file_exists($water_mark)&&$sysconfig['site_water_mark'] == 1){
						import("ORG.Util.Image");
						$path = $fileItem['savepath'].'m_'.$fileItem['savename'];							
						$a=Image::water($path,$water_mark,$path,$sysconfig['site_water_alpha'],$sysconfig['site_water_position']);
					}
					$recpath = str_replace(ROOT_PATH,"",$upload->savePath);
					$data['type'] = 'img';
					$data['title']= '';
					$data['origin']= $recpath.$fileItem['savename'];
					$data['path'] = $recpath.'m_'.$fileItem['savename'];
					$data['thumbnail'] = $recpath.'s_'.$fileItem['savename'];
					$data['size']= $fileItem['size'];
					$data['uploadtime'] = time();
					$imageInfo = getimagesize(ROOT_PATH.$data['origin']);
					$data['origin_width'] = $imageInfo[0]?$imageInfo[0]:0;
					$data['origin_height'] = $imageInfo[1]?$imageInfo[1]:0;
					$imageInfo = getimagesize(ROOT_PATH.$data['path']);
					$data['path_width'] = $imageInfo[0]?$imageInfo[0]:0;
					$data['path_height'] = $imageInfo[1]?$imageInfo[1]:0;
					$imageInfo = getimagesize(ROOT_PATH.$data['thumbnail']);
					$data['thumbnail_width'] = $imageInfo[0]?$imageInfo[0]:0;
					$data['thumbnail_height'] = $imageInfo[1]?$imageInfo[1]:0;
					$list = $this->add($data);
					$uploadList[$k]['id'] = $list;
        			$uploadList[$k]['recpath'] = $recpath;
				}
				if($showstatus)
				{
					$result['status'] = true;
					$result['uploadList'] = $uploadList;
					$result['msg'] = '';
					return $result;
				}
				else
				return $uploadList;
	        }
        } 
		
	}
	
	//上传文件
	public function fileUpload($dir='attachment',$showstatus = false){
		 $sysconfig = C('sysconfig');
		 if (!empty($_FILES)) {
		 	import("ORG.Net.UploadFile");
        	$upload = new UploadFile();
        	
			$upload->allowExts = explode(',', $sysconfig['site_upload_allowexts']);
        	//设置附件上传目录
       		$upload->savePath = UPLOADFILE.$dir."/";
	        //设置上传文件大小
	        $upload->maxSize =  $sysconfig['site_upload_maxsize'];
			if(!is_dir($upload->savePath))@mk_dir($upload->savePath,0777);
			$upload->saveRule = uniqid;
	        if (!$upload->upload()) {
	            //捕获上传异常
	            
				if($showstatus)
				{
					$result['status'] = false;
					$result['uploadList'] = false;
					$result['msg'] = $upload->getErrorMsg();
					return $result;
				}
				else
				return $uploadList = $upload->getErrorMsg();
	        } else {
	            $uploadList = $upload->getUploadFileInfo();
				foreach($uploadList as $k=>$fileItem){
					$recpath = str_replace(ROOT_PATH,"",$upload->savePath);
					$data['type'] = $fileItem['extension'];
					$data['title']= '';
					$data['origin']= $recpath.$fileItem['savename'];
					$data['path'] = '';
					$data['thumbnail'] = '';
					$data['size']= $fileItem['size'];
					$data['uploadtime'] = time();
					$list = $this->add($data);
					$uploadList[$k]['id'] = $list;
        			$uploadList[$k]['recpath'] = $recpath;
				}
				
				if($showstatus)
				{
					$result['status'] = true;
					$result['uploadList'] = $uploadList;
					$result['msg'] = '';
					return $result;
				}
				else
				return $uploadList;
			}
        }
	}
	
}
?>