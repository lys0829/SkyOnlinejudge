<?php
if(!defined('IN_SKYOJSYSTEM'))
{
  exit('Access denied');
}

class class_toj{
    public $version = '1.0';
    public $name = 'Toj capturer';
	public $description = 'TOJ capturer for test';
	public $copyright = 'test by LFsWang';
	public $pattern = "/^toj[0-9]+$/";
	private $api = 'http://210.70.137.215/oj/be/api';
	private $useraclist = array();
	
	function post($data)
	{
	    $context['http'] = array (
			'timeout'   => 60,
			'method'	=> 'POST',
			'content'   => http_build_query($data, '', '&'),
		);
		$response = @file_get_contents('http://210.70.137.215/oj/be/api', false, stream_context_create($context));
		return $response;
	}
	
	function preprocess($userlist,$problist)
	{
	    global $_E;
	    $query = array('reqtype' => 'AC','acct_id' => 0 );
	    foreach($userlist as $uid)
	    {
	        $query['acct_id'] = $uid;
	        if( $cache = DB::loadcache("class_toj_uid_$uid") )
	        {
	            $_E['template']['dbg'].="$uid load form cache<br>";
	            $this->useraclist[$uid] = $cache;
	        }
	        elseif( $aclist = $this->post($query) )
	        {
	            $_E['template']['dbg'].="$uid download from toj<br>";
	            $this->useraclist[$uid]  = json_decode($aclist)->ac;
	            DB::putcache(   "class_toj_uid_$uid",
	                            $this->useraclist[$uid],
	                            rand(1,5));
	        }
	    }
	}
	
	function query($uid,$pid)
	{
	    $pid = preg_replace('/[^0-9]*/','',$pid);
	    if(in_array($pid,$this->useraclist[$uid]))
	    {
	        return 9;
	    }
	    else
	    {
	        return 0;
	    }
	}
	
	function showname($str)
	{
	    $pid = preg_replace('/[^0-9]*/','',$str);
	    $str="<a href='http://toj.tfcis.org/oj/pro/$pid/'>TOJ $pid</a>";
	    return $str;
	}
}