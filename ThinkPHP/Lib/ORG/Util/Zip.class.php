<?php
/* $Id: zip.lib.php,v 1.1 2004/02/14 15:21:18 anoncvs_tusedb Exp $ */
// vim: expandtab sw=4 ts=4 sts=4:


/**
*
* Developers Blon
* @access  public
*/
class Zip extends Think
{
    /**
     * Array to store compressed data
     *
     * @var  array    $datasec
     */
    var $datasec      = array();

    /**
     * Central directory
     *
     * @var  array    $ctrl_dir
     */
    var $ctrl_dir     = array();

    /**
     * End of central directory record
     *
     * @var  string   $eof_ctrl_dir
     */
    var $eof_ctrl_dir = "\x50\x4b\x05\x06\x00\x00\x00\x00";

    /**
     * Last offset position
     *
     * @var  integer  $old_offset
     */
    var $old_offset   = 0;

	var $total_files = 0;
 	var $total_folders = 0;
    /**
     * Converts an Unix timestamp to a four byte DOS date and time format (date
     * in high two bytes, time in low two bytes allowing magnitude comparison).
     *
     * @param  integer  the current Unix timestamp
     *
     * @return integer  the current date in a four byte DOS format
     *
     * @access private
     */
    function unix2DosTime($unixtime = 0) {
        $timearray = ($unixtime == 0) ? getdate() : getdate($unixtime);

        if ($timearray['year'] < 1980) {
            $timearray['year']    = 1980;
            $timearray['mon']     = 1;
            $timearray['mday']    = 1;
            $timearray['hours']   = 0;
            $timearray['minutes'] = 0;
            $timearray['seconds'] = 0;
        } // end if

        return (($timearray['year'] - 1980) << 25) | ($timearray['mon'] << 21) | ($timearray['mday'] << 16) |
                ($timearray['hours'] << 11) | ($timearray['minutes'] << 5) | ($timearray['seconds'] >> 1);
    } // end of the 'unix2DosTime()' method


    /**
     * Adds "file" to archive
     *
     * @param  string   file contents
     * @param  string   name of the file in the archive (may contains the path)
     * @param  integer  the current timestamp
     *
     * @access public
     */
    function addFile($data, $name, $time = 0)
    {
        $name     = str_replace('\\', '/', $name);

        $dtime    = dechex($this->unix2DosTime($time));
        $hexdtime = '\x' . $dtime[6] . $dtime[7]
                  . '\x' . $dtime[4] . $dtime[5]
                  . '\x' . $dtime[2] . $dtime[3]
                  . '\x' . $dtime[0] . $dtime[1];
        eval('$hexdtime = "' . $hexdtime . '";');

        $fr   = "\x50\x4b\x03\x04";
        $fr   .= "\x14\x00";            // ver needed to extract
        $fr   .= "\x00\x00";            // gen purpose bit flag
        $fr   .= "\x08\x00";            // compression method
        $fr   .= $hexdtime;             // last mod time and date

        // "local file header" segment
        $unc_len = strlen($data);
        $crc     = crc32($data);
        $zdata   = gzcompress($data);
        $zdata   = substr(substr($zdata, 0, strlen($zdata) - 4), 2); // fix crc bug
        $c_len   = strlen($zdata);
        $fr      .= pack('V', $crc);             // crc32
        $fr      .= pack('V', $c_len);           // compressed filesize
        $fr      .= pack('V', $unc_len);         // uncompressed filesize
        $fr      .= pack('v', strlen($name));    // length of filename
        $fr      .= pack('v', 0);                // extra field length
        $fr      .= $name;

        // "file data" segment
        $fr .= $zdata;

        // "data descriptor" segment (optional but necessary if archive is not
        // served as file)
        $fr .= pack('V', $crc);                 // crc32
        $fr .= pack('V', $c_len);               // compressed filesize
        $fr .= pack('V', $unc_len);             // uncompressed filesize

        // add this entry to array
        $this -> datasec[] = $fr;

        // now add to central directory record
        $cdrec = "\x50\x4b\x01\x02";
        $cdrec .= "\x00\x00";                // version made by
        $cdrec .= "\x14\x00";                // version needed to extract
        $cdrec .= "\x00\x00";                // gen purpose bit flag
        $cdrec .= "\x08\x00";                // compression method
        $cdrec .= $hexdtime;                 // last mod time & date
        $cdrec .= pack('V', $crc);           // crc32
        $cdrec .= pack('V', $c_len);         // compressed filesize
        $cdrec .= pack('V', $unc_len);       // uncompressed filesize
        $cdrec .= pack('v', strlen($name) ); // length of filename
        $cdrec .= pack('v', 0 );             // extra field length
        $cdrec .= pack('v', 0 );             // file comment length
        $cdrec .= pack('v', 0 );             // disk number start
        $cdrec .= pack('v', 0 );             // internal file attributes
        $cdrec .= pack('V', 32 );            // external file attributes - 'archive' bit set

        $cdrec .= pack('V', $this -> old_offset ); // relative offset of local header
        $this -> old_offset += strlen($fr);

        $cdrec .= $name;

        // optional extra field, file comment goes here
        // save to central directory
        $this -> ctrl_dir[] = $cdrec;
    } // end of the 'addFile()' method


    /**
     * Dumps out file
     *
     * @return  string  the zipped file
     *
     * @access public
     */
    function file()
    {
        $data    = implode('', $this -> datasec);
        $ctrldir = implode('', $this -> ctrl_dir);

        return
            $data .
            $ctrldir .
            $this -> eof_ctrl_dir .
            pack('v', sizeof($this -> ctrl_dir)) .  // total # of entries "on this disk"
            pack('v', sizeof($this -> ctrl_dir)) .  // total # of entries overall
            pack('V', strlen($ctrldir)) .           // size of central dir
            pack('V', strlen($data)) .              // offset to start of central dir
            "\x00\x00";                             // .zip file comment length
    } // end of the 'file()' method
    

    /**
     * A Wrapper of original addFile Function
     *
     * Created By Hasin Hayder at 29th Jan, 1:29 AM
     *
     * @param array An Array of files with relative/absolute path to be added in Zip File
     *
     * @access public
     */
    function addFiles($files /*Only Pass Array*/,$file_names)
    {
        foreach($files as $k=>$file)
        {
	        if (is_file($file)) //directory check
	        {
	            //$data = implode("",file($file));
	            	$data = file_get_contents($file);
	           
	                  $this->addFile($data,$file_names[$k]);
	        }
        }
    }
    
    /**
     * A Wrapper of original file Function
     *
     * Created By Hasin Hayder at 29th Jan, 1:29 AM
     *
     * @param string Output file name
     *
     * @access public
     */
    function output($file)
    {
//        $fp=fopen($file,"w");        
//        fwrite($fp,$this->file());
//        fclose($fp);
 	 	 //dump($content);exit;
	     header("Content-Disposition: attachment; filename=$file");
	    	//header("Content-Type: application/octet-stream");
	     echo($this->file());  
    }
    
    
	function Extract ( $zn, $to, $index = Array(-1) )
	 {
	   $ok = 0; $zip = @fopen($zn,'rb');
	   if(!$zip) return(-1);
	   $cdir = $this->ReadCentralDir($zip,$zn);
	   $pos_entry = $cdir['offset'];
	
	   if(!is_array($index)){ $index = array($index);  }
	   for($i=0; $index[$i];$i++){
	   		if(intval($index[$i])!=$index[$i]||$index[$i]>$cdir['entries'])
			return(-1);
	   }
	   for ($i=0; $i<$cdir['entries']; $i++)
	   {
	     @fseek($zip, $pos_entry);
	     $header = $this->ReadCentralFileHeaders($zip);
	     $header['index'] = $i; $pos_entry = ftell($zip);
	     @rewind($zip); fseek($zip, $header['offset']);
	     if(in_array("-1",$index)||in_array($i,$index))
	     	$stat[$header['filename']]=$this->ExtractFile($header, $to, $zip);
	   }
	   fclose($zip);
	   return $stat;
	 }
	
	  function ReadFileHeader($zip)
	  {
	    $binary_data = fread($zip, 30);
	    $data = unpack('vchk/vid/vversion/vflag/vcompression/vmtime/vmdate/Vcrc/Vcompressed_size/Vsize/vfilename_len/vextra_len', $binary_data);
	
	    $header['filename'] = fread($zip, $data['filename_len']);
	    if ($data['extra_len'] != 0) {
	      $header['extra'] = fread($zip, $data['extra_len']);
	    } else { $header['extra'] = ''; }
	
	    $header['compression'] = $data['compression'];$header['size'] = $data['size'];
	    $header['compressed_size'] = $data['compressed_size'];
	    $header['crc'] = $data['crc']; $header['flag'] = $data['flag'];
	    $header['mdate'] = $data['mdate'];$header['mtime'] = $data['mtime'];
	
	    if ($header['mdate'] && $header['mtime']){
	     $hour=($header['mtime']&0xF800)>>11;$minute=($header['mtime']&0x07E0)>>5;
	     $seconde=($header['mtime']&0x001F)*2;$year=(($header['mdate']&0xFE00)>>9)+1980;
	     $month=($header['mdate']&0x01E0)>>5;$day=$header['mdate']&0x001F;
	     $header['mtime'] = mktime($hour, $minute, $seconde, $month, $day, $year);
	    }else{$header['mtime'] = time();}
	
	    $header['stored_filename'] = $header['filename'];
	    $header['status'] = "ok";
	    return $header;
	  }
	
	 function ReadCentralFileHeaders($zip){
	    $binary_data = fread($zip, 46);
	    $header = unpack('vchkid/vid/vversion/vversion_extracted/vflag/vcompression/vmtime/vmdate/Vcrc/Vcompressed_size/Vsize/vfilename_len/vextra_len/vcomment_len/vdisk/vinternal/Vexternal/Voffset', $binary_data);
	
	    if ($header['filename_len'] != 0)
	      $header['filename'] = fread($zip,$header['filename_len']);
	    else $header['filename'] = '';
	
	    if ($header['extra_len'] != 0)
	      $header['extra'] = fread($zip, $header['extra_len']);
	    else $header['extra'] = '';
	
	    if ($header['comment_len'] != 0)
	      $header['comment'] = fread($zip, $header['comment_len']);
	    else $header['comment'] = '';
	
	    if ($header['mdate'] && $header['mtime'])
	    {
	      $hour = ($header['mtime'] & 0xF800) >> 11;
	      $minute = ($header['mtime'] & 0x07E0) >> 5;
	      $seconde = ($header['mtime'] & 0x001F)*2;
	      $year = (($header['mdate'] & 0xFE00) >> 9) + 1980;
	      $month = ($header['mdate'] & 0x01E0) >> 5;
	      $day = $header['mdate'] & 0x001F;
	      $header['mtime'] = mktime($hour, $minute, $seconde, $month, $day, $year);
	    } else {
	      $header['mtime'] = time();
	    }
	    $header['stored_filename'] = $header['filename'];
	    $header['status'] = 'ok';
	    if (substr($header['filename'], -1) == '/')
	      $header['external'] = 0x41FF0010;
	    return $header;
	 }
	
	 function ReadCentralDir($zip,$zip_name){
		$size = filesize($zip_name);
	
		if ($size < 277) $maximum_size = $size;
		else $maximum_size=277;
		
		@fseek($zip, $size-$maximum_size);
		$pos = ftell($zip); $bytes = 0x00000000;
		
		while ($pos < $size){
			$byte = @fread($zip, 1); $bytes=($bytes << 8) | ord($byte);
			if ($bytes == 0x504b0506 or $bytes == 0x2e706870504b0506){ $pos++;break;} $pos++;
		}
		
		$fdata=fread($zip,18);
		
		$data=@unpack('vdisk/vdisk_start/vdisk_entries/ventries/Vsize/Voffset/vcomment_size',$fdata);
		
		if ($data['comment_size'] != 0) $centd['comment'] = fread($zip, $data['comment_size']);
		else $centd['comment'] = ''; $centd['entries'] = $data['entries'];
		$centd['disk_entries'] = $data['disk_entries'];
		$centd['offset'] = $data['offset'];$centd['disk_start'] = $data['disk_start'];
		$centd['size'] = $data['size'];  $centd['disk'] = $data['disk'];
		return $centd;
	  }
	
	 function ExtractFile($header,$to,$zip){
		$header = $this->readfileheader($zip);
		
		if(substr($to,-1)!="/") $to.="/";
		if($to=='./') $to = '';	
		$pth = explode("/",$to.$header['filename']);
		$mydir = '';
		for($i=0;$i<count($pth)-1;$i++){
			if(!$pth[$i]) continue;
			$mydir .= $pth[$i]."/";
			if((!is_dir($mydir) && @mkdir($mydir,0777)) || (($mydir==$to.$header['filename'] || ($mydir==$to && $this->total_folders==0)) && is_dir($mydir)) ){
				@chmod($mydir,0777);
				$this->total_folders ++;
			}
		}
		
		if(strrchr($header['filename'],'/')=='/') return;	
	
		if (!($header['external']==0x41FF0010)&&!($header['external']==16)){
			if ($header['compression']==0){
				$fp = @fopen($to.$header['filename'], 'wb');
				if(!$fp) return(-1);
				$size = $header['compressed_size'];
			
				while ($size != 0){
					$read_size = ($size < 2048 ? $size : 2048);
					$buffer = fread($zip, $read_size);
					$binary_data = pack('a'.$read_size, $buffer);
					@fwrite($fp, $binary_data, $read_size);
					$size -= $read_size;
				}
				fclose($fp);
				touch($to.$header['filename'], $header['mtime']);
			}else{
				$fp = @fopen($to.$header['filename'].'.gz','wb');
				if(!$fp) return(-1);
				$binary_data = pack('va1a1Va1a1', 0x8b1f, Chr($header['compression']),
				Chr(0x00), time(), Chr(0x00), Chr(3));
				
				fwrite($fp, $binary_data, 10);
				$size = $header['compressed_size'];
			
				while ($size != 0){
					$read_size = ($size < 1024 ? $size : 1024);
					$buffer = fread($zip, $read_size);
					$binary_data = pack('a'.$read_size, $buffer);
					@fwrite($fp, $binary_data, $read_size);
					$size -= $read_size;
				}
			
				$binary_data = pack('VV', $header['crc'], $header['size']);
				fwrite($fp, $binary_data,8); fclose($fp);
		
				$gzp = @gzopen($to.$header['filename'].'.gz','rb') or die("Cette archive est compress閑");
				if(!$gzp) return(-2);
				$fp = @fopen($to.$header['filename'],'wb');
				if(!$fp) return(-1);
				$size = $header['size'];
			
				while ($size != 0){
					$read_size = ($size < 2048 ? $size : 2048);
					$buffer = gzread($gzp, $read_size);
					$binary_data = pack('a'.$read_size, $buffer);
					@fwrite($fp, $binary_data, $read_size);
					$size -= $read_size;
				}
				fclose($fp); gzclose($gzp);
			
				touch($to.$header['filename'], $header['mtime']);
				@unlink($to.$header['filename'].'.gz');
				
			}
		}
		
		$this->total_files ++;
		return true;
	 }

    

} // end of the 'zipfile' class
?>