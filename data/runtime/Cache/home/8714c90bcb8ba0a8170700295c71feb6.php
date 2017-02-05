<?php if (!defined('THINK_PATH')) exit();?><html>
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8">
</head>
<title>PHP文件上传</title>
<style type="text/css" rel="stylesheet" />
.border{
 background-color:#000000
}
.box{
 background-color:#f8f8f9;
}
.text{ 
 color:#000000;
 font-family: "宋体";
 font-size: 12px;
 font-weight:bold
}
input, select{
 font-size: 12px;
}
body{
  margin: 0;
}
</style>
<body>
 <!-- 文件上传表单，enctype属性是必须的 -->
 <form name="form" enctype="multipart/form-data" method="post" action="<?php echo U('Activity/upload_vedio');?>">
	<input type="file" name="vedio">
	<input type="submit" value="提交">
 </form>  
</body>
</html>