<?php
require 'connect.php';
$cgi=getCGI();

$login=isset($cgi['login'])?$cgi['login']:'';
$register=isset($cgi['register'])?$cgi['register']:'';
header("Content-type: text/html; charset=utf-8");
//登陆
if($login=='登陆'){
	//获取输入的信息
	$username = isset($cgi['username'])?$cgi['username']:'';
	$passcode = isset($cgi['passcode'])?$cgi['passcode']:'';
	if(empty($username) || empty($passcode))
	{
		echo "用户名或者密码错误";
	}
	//获取session的值
	$sql="select * from user where username='$username' and password ='".md5($passcode)."' limit 1";
	$data = $mysql->getData( $sql );
	if(count($data)>=1){
		session_start();
		//判断权限
		if($data[0]['flag'] == 1){
			echo "用户状态不正确";
		}else{
			$_SESSION['username'] = $data[0]['username'];
			$_SESSION['flag'] = $data[0]['flag'];
			$_SESSION['userid']=$data[0]['userid'];
			echo<<<EOF
		<script>
		alert("欢迎来到日省吾身吧台");
		window.location.href="./datashow.php";
		</script>
EOF;
		}
	}else{
		echo<<<EOF
		<script>
		alert("用户不存在，请先注册");
		window.location.href="./register.php";
		</script>
EOF;
		exit;	
	
	}
}elseif($register=='注册'){
	//获取输入的信息
	$username = isset($cgi['username'])?$cgi['username']:'';
	$passcode = isset($cgi['passcode'])?$cgi['passcode']:'';
	if(empty($username) || empty($passcode))
	{
		echo<<<EOF
		<script>
		alert("用户民或密码为空");
		window.location.href="./register.php";
		</script>
EOF;
		exit;
	}
	//获取session的值
	$sql="select * from user where username='$username' limit 1";
	$data = $mysql->getData( $sql );
	if(count($data)>=1){
		echo<<<EOF
		<script>
		alert("此用户名已经被注册");
		window.location.href="./register.php";
		</script>
EOF;
		exit;
	}else{
		$sql="insert into user  set username='$username',flag=0,password='".md5($passcode)."'";
		$mysql->runSql( $sql );
		if( $mysql->errno() != 0 )
		{
			die( "Error:" . $mysql->errmsg() );
		}
		$userid = $mysql->lastId();
		session_start();
		//判断权限
		$_SESSION['username'] = $username;
		$_SESSION['flag'] = 0;
		$_SESSION['userid']=$userid;
		echo<<<EOF
		<script>
		alert("注册成功");
		window.location.href="./datashow.php";
		</script>
EOF;


	}
}

//获取参数
function getCGI()
{
	$cgi=array();
	foreach($_POST as $key => $value)
	{
		$vv = $value;
		$vv = strip_tags($vv);
		$cgi[$key] = trim($vv);
	}
	foreach($_GET as $key => $value)
	{
		$vv = $value;
		$vv = strip_tags($vv);
		$cgi[$key] = trim($vv);
	}
 
	return $cgi;
}