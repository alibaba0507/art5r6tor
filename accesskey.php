<?php
//$str = file_get_contents('userkey.dat');
//$accesskey = unserialize($str);
//if (!is_array($accesskey))
//	$accesskey = array();
//$accesskey = array('AccessKey1','alida001');


function addFreeToken($email,$token)
{
	
	if (!filter_var($email, FILTER_VALIDATE_EMAIL))
	{
		//error_log("invalid email $email");
		return -1; // invalid email address
	}	
	$key = checkForUserEmail($email,"");
	
	if (trim(rtrim($key)) == "")
	{ 
		$str = file_get_contents('userkey.dat');
		$accesskey = unserialize($str);
		$today = strtotime(date("Y-m-d")." +3 days");
		$val = $email."|".$today;
		$accesskey[$token] = $val;
		
		file_put_contents("userkey.dat",serialize($accesskey));
		return 1;// success
	}else
		return -1;
}
function addToken($email,$token)
{
	if (!filter_var($email, FILTER_VALIDATE_EMAIL))
		return -1; // invalid email address
	$key = checkForUserEmail($email,"");
	$str = file_get_contents('userkey.dat');
	$accesskey = unserialize($str);
	$today = strtotime(date("Y-m-d")." +30 days");
	if (trim(rtrim($key)) != "")
	{ 
		unset($accesskey[$key]);
	}
	$val = $email."|".$today;
	$accesskey[$token] = $val;
	
	file_put_contents("userkey.dat",serialize($accesskey));
	return 1;// success
}

function checkForUserEmail($email,$gettime)
{
	$str = file_get_contents('userkey.dat');
	$accesskey = unserialize($str);
	//error_log(print_R($arr));
	if (is_array($accesskey))
	{
		//error_log("This is an array");
		foreach ($accesskey as $value) 
	   {
		//$line = $arr[$k];
		//error_log("Value is $value");
		$val = explode("|", $value);// $val[0] = email, $val[1] expired date.
		if (trim(rtrim($val[0])) == trim(rtrim($email)))
		{
			return ($gettime != "")? $val[1] : key($accesskey);
		}
	  }
	}
	//else
	//	error_log("This is NOT AN ARRAY");
	
	return "";
}
function getExpired($key)
{
	$str = file_get_contents('userkey.dat');
	//error_log(" validatetoken after ....$str  ");
	$accesskey = unserialize($str);
	if (is_array($accesskey)  && isset($accesskey[$key]))
	{
		 $val = explode("|", $accesskey[$key]);// $val[0] = email, $val[1] expired date.
		
			return  $val[1] ;
		
	}
	return -1;
}
/**
 * @retutn 0 - expired , -1 - not found, 1 - found
 */
function validatetoken($key)
{
	// error_log(" validatetoken .... ");
	$str = file_get_contents('userkey.dat');
	//error_log(" validatetoken after ....$str  ");
	$accesskey = unserialize($str);
	//error_log(" validatetoken after ....$key  ");
	if (trim($key) == "")
		 return -1;
	if (is_array($accesskey)  && isset($accesskey[$key]))
	{
		//error_log(" Key found .... is_array");
		$line = $accesskey[$key];
		//error_log(" Key found .... $line");
		// this will be '|' delimeted  lime
		$val = explode("|", $line);// $val[0] = email, $val[1] expired date.
		$today = date("Y-m-d");
		$expire = $val[1]; //from db
        $today_time = strtotime($today);
        $expire_time = ($expire);
        if ($expire_time < $today_time) { return 0;} // expired } else {return 1; // valid}
		else return 1;
		
	}else
	{
		//error_log(" Key found .... ret -1");
		return -1; // not found
	}	
}

function generateactivationtoken()
	{
		$gen;
	    //error_log("generateactivationtoken .....");
		$cnt = 0;
		do
		{
			$gen = md5(uniqid(mt_rand(), false));
			//if ($cnt < 20)
           // {
			//	error_log("generateactivationtoken .....$gen");
			//}   
		    $cnt++;
		}
		while(validatetoken($gen) > 0);
	
		return $gen;
	}
	
	
	
?>