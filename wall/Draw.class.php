<?php

class Draw{

	public function __construct()
	{
		require_once 'functions.php';
	}

	//查找原数据表内容
	public function index(){
		$mysql=new SaeMysql();
		$sql="SELECT * FROM userinfo ORDER BY subscribe_time DESC";
		$data=$mysql->getData($sql);
		return $data;
	}


	//查询备表内容
	public function index2(){
		$mysql=new SaeMysql();
		$sql="SELECT * FROM userdraw ORDER BY subscribe_time DESC";
		$data=$mysql->getData($sql);
		return $data;
	}

	//二维数组降维
	protected function my_array_unique($array2D){
		foreach ($array2D as $v){        //错误
		$v = implode(",",$v);
		$temp[] = $v;
		}
		$temp = array_unique($temp);
		foreach ($temp as $k => $v){        //错误
			$temp[$k] = explode(",",$v);
		}
		return $temp;
		}

//剔除数组
	public function  unique($array, $total, $unique = true)
	{
		$newArray = array();
		if ((bool)$unique) {
			$array = $this->my_array_unique($array);
		}
		shuffle($array);             //错误
		$length = count($array);
		for ($i = 0; $i < $total; $i++) {
			if ($i < $length) {
				$newArray[] = $array[$i];
			}
		}
		return $newArray;
	}



	//实例化memcache
	public function _memcache_int(){
		//实例化

		$mmc=new Memcache();

		$mmc->connect();           //使用当前应用的memcache

		return $mmc;

	}

	//设置memcache的值
	public function _memcache_set($key,$value,$time=0){

		$mmc=$this->_memcache_int();
		$mmc->set($key,$value,0,$time);
	}

	//获取memcache
	public function _memcache_get($key){

		$mmc=$this->_memcache_int();
		return $mmc->get($key);
	}

}