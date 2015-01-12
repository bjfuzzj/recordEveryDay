<?php
session_start();
require 'connect.php';
$cgi=getCGI();
$action=isset($cgi['action'])?$cgi['action']:'index';
$temp_time=date("Y",time());
$time=isset($cgi['time'])?$cgi['time']:'2015';
$time.='-00-00';

if(!$action) die('error');
if(!isset($_SESSION['userid']) || empty($_SESSION['userid'])){
echo<<<EOF
		<script>
		alert("你还为登陆，请登陆后再访问");
		window.location.href="./register.php";
		</script>
EOF;
}
$userid=$_SESSION['userid'];
$json=array();
if($action=='index'){
	$sql = "select name,sum(num) as total from data  where userid=$userid and time > '$time' group by name ";
	$data = $mysql->getData( $sql );
	include("index_show.php");
	exit;
}elseif($action=='update'){

echo "<meta http-equiv=\"Content-Type\" content=\"text/html; charset=utf-8\" /> ";
	$huodong=$cgi['huodong'];
	$cishu=$cgi['cishu'];
	$shijian=$cgi['shijian'];
	$des=$cgi['des'];
	if(empty($huodong)|| empty($cishu)||empty($shijian)){
echo<<<EOF
			<script>
			alert("参数有误");
			window.location.href="./datashow.php"; 
			</script>
EOF;
	}
			$sql = "insert into data set num=$cishu ,name='$huodong',des='$des',time='$shijian',userid=$userid";
			$mysql->runSql( $sql );
			if( $mysql->errno() != 0 ){
			echo<<<EOF
			<script>
			alert("插入失败");
			window.location.href="./datashow.php"; 
			</script>
EOF;
			}else{
			echo<<<EOF
			<script>
			alert("插入成功");
			window.location.href="./datashow.php"; 
			</script>
EOF;
			}
}

elseif($action=='show'){
	echo "<meta http-equiv=\"Content-Type\" content=\"text/html; charset=utf-8\" /> ";
	$name=$_GET['name'];
	$time=$_GET['time'];
	$sql="select * from data where userid=$userid and time>'$time' and name = '$name' ";
	$data = $mysql->getData( $sql );
	if(count($data)>=1){
		include("show_show.php");
	}
	exit;
}

elseif($action=='logout'){
	if(isset($_SESSION['username'])) unset($_SESSION['username']);
	if(isset($_SESSION['flag'])) unset($_SESSION['flag']);
	if(isset($_SESSION['userid'])) unset($_SESSION['userid']);
			echo<<<EOF
			<script>
			alert("安全退出");
			window.location.href="./register.php"; 
			</script>
EOF;
}
function getCGI()
{
	$cgi=array();
	foreach($_POST as $key => $value)
	{
		$vv = $value;
		if(get_magic_quotes_gpc()) $vv = stripcslashes($vv);
		$cgi[$key] = trim($vv);
	}
	foreach($_GET as $key => $value)
	{
		$vv = $value;
		if(get_magic_quotes_gpc()) $vv = stripcslashes($vv);
		$cgi[$key] = trim($vv);
	}
 
	return $cgi;
}