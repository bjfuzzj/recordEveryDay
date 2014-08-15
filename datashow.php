<?php
require 'connect.php';
$cgi=getCGI();
$action=isset($cgi['action'])?$cgi['action']:'index';

if(!$action) die('error');

$json=array();
if($action=='index'){
	$sql = "select name,sum(num) as total from data group by name";
	$data = $mysql->getData( $sql );
	if(count($data)>=1){
		include("index_show.php");
	}
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
			$sql = "insert into data set num=$cishu ,name='$huodong',des='$des',time='$shijian'";
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
	$sql="select * from data where name = '$name' ";
	$data = $mysql->getData( $sql );
	if(count($data)>=1){
		include("show_show.php");
	}
	exit;
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