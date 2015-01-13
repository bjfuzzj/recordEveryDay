<html>
<head>
<meta charset="utf-8">
<link href="http://github-proxy.kodono.info/?q=https://raw.github.com/Aymkdn/Datepicker-for-Bootstrap/master/datepicker.css" rel="stylesheet">
</head>
<body>
<!-- 最新 Bootstrap 核心 CSS 文件 -->
<link rel="stylesheet" href="http://cdn.bootcss.com/twitter-bootstrap/3.0.3/css/bootstrap.min.css">

<!-- 可选的Bootstrap主题文件（一般不用引入） -->
<link rel="stylesheet" href="http://cdn.bootcss.com/twitter-bootstrap/3.0.3/css/bootstrap-theme.min.css">

<div class="jumbotron">
      <div class="container">
        <h1>欢迎来到"日省吾身"吧台</h1>
        <p>这个只是记录我自己的一个状态 <a href="./datashow.php?action=logout">退出</a></p> 
        <p><a class="btn btn-primary btn-lg" onclick="getout(' ')" role="button">开始记录 »</a></p>
      </div>
</div>



<form  action ='./datashow.php' method="post" class="form-inline" role="form" style="display:none">
  <div class="form-group has-success">
    <label class="sr-only" for="exampleInputPassword2">类型</label>
    <input type="text" class="form-control" id="huodong" name = "huodong"  placeholder="请输入类型">
  </div>
  <div class="form-group has-success">
    <label class="sr-only" for="exampleInputPassword2">次数</label>
    <input type="text" class="form-control" id="cishu"  name = "cishu" placeholder="请输入次数">
  </div>

   <div class="form-group has-success">
    <label class="sr-only" for="exampleInputPassword2">简介</label>
    <input type="text" class="form-control" id="des" value=''  name = "des" placeholder="请输入简介">
  </div>

   <div class="form-group has-success">
    <label class="sr-only" for="exampleInputPassword2">时间</label>
    <input type="text" class="span2" name="shijian" value="" id="dp1">
  </div>
  <input type="hidden"  name="action"  value="update">
  <button type="submit" class="btn btn-default">提交</button>
</form>




<?php
$all_css= array('default','primary','success','info','warning','danger');
$echo_num=3;
echo "<div class=\"row\"><div class=\"col-sm-4\">";

if($data){
foreach($data as $key => $value){
	$css=$all_css[rand(0,5)];
echo<<<EOF
          <div class="panel panel-$css">
            <div class="panel-heading">
              <h3 class="panel-title" onclick="getout('$value[name]')">$value[name]</h3>
            </div>
            <div class="panel-body" onclick="getshow('$value[name]')">
              截止到现在一共$value[name]----$value[total]次
            </div>
          </div>
EOF;
	if(($key+1)>=$echo_num && $key<(count($data)-1) && ($key+1)%$echo_num==0)
	echo "</div><div class=\"col-sm-4\">";
}
echo "</div>";

}

?>


<!-- jQuery文件。务必在bootstrap.min.js 之前引入 -->
<script src="http://cdn.bootcss.com/jquery/1.10.2/jquery.min.js"></script>

<!-- 最新的 Bootstrap 核心 JavaScript 文件 -->
<script src="http://cdn.bootcss.com/twitter-bootstrap/3.0.3/js/bootstrap.min.js"></script>

<script src="http://github-proxy.kodono.info/?q=https://raw.github.com/Aymkdn/Datepicker-for-Bootstrap/master/bootstrap-datepicker.js"></script>
	<script>
		$(function(){
			window.prettyPrint && prettyPrint();
			$('#dp1').datepicker({
				format: 'yyyy-mm-dd'
			});
		})

		function getout(name){
			if(name==' ') name="请输入类型 ";
			if(name){
				$('.form-inline').show();			
				$("#huodong").val(name);
			}
		}

		function getshow(name){
			var myDate = new Date();
			var time=myDate.getFullYear();
			if(name){
				window.open("./datashow.php?action=show&time="+time+"&name="+name);
			}
		}


</script>
</body>
</html>
