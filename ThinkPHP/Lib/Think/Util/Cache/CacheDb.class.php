<?php
// +----------------------------------------------------------------------
// | ThinkPHP [ WE CAN DO IT JUST THINK IT ]
// +----------------------------------------------------------------------
// | Copyright (c) 2009 http://thinkphp.cn All rights reserved.
// +----------------------------------------------------------------------
// | Licensed ( http://www.apache.org/licenses/LICENSE-2.0 )
// +----------------------------------------------------------------------
// | Author: liu21st <liu21st@gmail.com>
// +----------------------------------------------------------------------
// $Id$

/**
 +------------------------------------------------------------------------------
 * 数据库类型缓存类
     CREATE TABLE THINK_CACHE (
       id int(11) unsigned NOT NULL auto_increment,
       cachekey varchar(255) NOT NULL,
       expire int(11) NOT NULL,
       data blob,
       datasize int(11),
       datacrc int(32),
       PRIMARY KEY (id)
     );
 +------------------------------------------------------------------------------
 * @category   Think
 * @package  Think
 * @subpackage  Util
 * @author    liu21st <liu21st@gmail.com>
 * @version   $Id$
 +------------------------------------------------------------------------------
 */
class CacheDb extends Cache
{//类定义开始

    /**
     +----------------------------------------------------------
     * 缓存数据库对象 采用数据库方式有效
     +----------------------------------------------------------
     * @var string
     * @access protected
     +----------------------------------------------------------
     */
    var $db;

    /**
     +----------------------------------------------------------
     * 架构函数
     +----------------------------------------------------------
     * @access public
     +----------------------------------------------------------
     */
    function __construct($options='')
    {
        if(empty($options)){
            $options= array
            (
                'db'        => C('DB_NAME'),
                'table'     => C('DB_PREFIX').C('DATA_CACHE_TABLE'),
                'expire'    => C('DATA_CACHE_TIME'),
            );
        }
        $this->options = $options;
        import('Db');
        $this->db  = DB::getInstance();
		
        $this->connected = is_resource($this->db);
        $this->type = strtoupper(substr(__CLASS__,6));
		
    }

    /**
     +----------------------------------------------------------
     * 是否连接
     +----------------------------------------------------------
     * @access private
     +----------------------------------------------------------
     * @return boolen
     +----------------------------------------------------------
     */
    private function isConnected()
    {
        return $this->connected;
    }


    /**
     +----------------------------------------------------------
     * 读取缓存
     +----------------------------------------------------------
     * @access public
     +----------------------------------------------------------
     * @param string $name 缓存变量名
     +----------------------------------------------------------
     * @return mixed
     +----------------------------------------------------------
     */
    public function get($name)
    {
        $name  =  addslashes($name);
        N('cache_read',1);
        $result  =  $this->db->query('select `data`,`datacrc`,`datasize` from `'.$this->options['table'].'` where `cachekey`=\''.$name.'\' and (`expire` =-1 OR `expire`>'.time().') limit 0,1');
		$result = isset($result[0])?$result[0]:null;
        if(!empty($result)) {
            if(is_object($result)) {
            	$result  =  get_object_vars($result);
            }
			
            if(C('DATA_CACHE_CHECK')) {//开启数据校验
                if($result['datacrc'] != md5($result['data'])) {//校验错误
                    return false;
                }
            }
            $content   =  $result['data'];
            if(C('DATA_CACHE_COMPRESS') && function_exists('gzcompress')) {
                //启用数据压缩
                $content   =   gzuncompress($content);
            }
			
            $content    =   unserialize($content);
            return $content;
        }
        else {
            return false;
        }
    }

    /**
     +----------------------------------------------------------
     * 写入缓存
     +----------------------------------------------------------
     * @access public
     +----------------------------------------------------------
     * @param string $name 缓存变量名
     * @param mixed $value  存储数据
     * @param integer $expire  有效时间（秒）
     +----------------------------------------------------------
     * @return boolen
     +----------------------------------------------------------
     */
    public function set($name, $value,$expireTime=0)
    {
        $data   =   serialize($value);
        $name  =  addslashes($name);
        N('cache_write',1);
        if( C('DATA_CACHE_COMPRESS') && function_exists('gzcompress')) {
            //数据压缩
            $data   =   gzcompress($data,3);
        }
		
        if(C('DATA_CACHE_CHECK')) {//开启数据校验
        	$crc  =  md5($data);
        }else {
        	$crc  =  '';
        }
        $expire =  !empty($expireTime)? $expireTime : $this->options['expire'];
        $map    = array();
        $map['cachekey']	 =	 $name;
        $map['data']	=	$data	 ;
        $map['datacrc']	=	$crc;
        $map['expire']	=	($expire==-1)?-1: (time()+$expire) ;//缓存有效期为－1表示永久缓存
        $map['datasize']	=	strlen($data);
        $result  =  $this->db->query('select `id` from `'.$this->options['table'].'` where `cachekey`=\''.$name.'\' limit 0,1');
		$result = $result[0];
        if(!empty($result)) {
        	//更新记录
			$map['id'] = $result['id'];
			/*$options = $this->options;
			$options['where'] = array(
				'id'=>array('eq',$result[0]['id']),	
			);*/
            $result  =  $this->db->insert($map,$this->options,true);
        }else {
        	//新增记录
            $result  =  $this->db->insert($map,$this->options);
        }
		
        if($result) {
            return true;
        }else {
        	return false;
        }
    }

    /**
     +----------------------------------------------------------
     * 删除缓存
     +----------------------------------------------------------
     * @access public
     +----------------------------------------------------------
     * @param string $name 缓存变量名
     +----------------------------------------------------------
     * @return boolen
     +----------------------------------------------------------
     */
    public function rm($name)
    {
        $name  =  addslashes($name);
        return $this->db->query('delete from `'.$this->options['table'].'` where `cachekey`=\''.$name.'\'');
    }

    /**
     +----------------------------------------------------------
     * 清除缓存
     +----------------------------------------------------------
     * @access public
     +----------------------------------------------------------
     * @return boolen
     +----------------------------------------------------------
     */
    public function clear()
    {
        return $this->db->query('truncate table `'.$this->options['table'].'`');
    }

}//类定义结束
?>