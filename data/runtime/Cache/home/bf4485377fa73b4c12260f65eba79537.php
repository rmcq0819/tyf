<?php if (!defined('THINK_PATH')) exit();?><html>
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8">
</head>
<title>PHP文件上传</title>

<body>
 <!-- 文件上传表单，enctype属性是必须的 -->
 <form name="form" enctype="multipart/form-data" method="post" action="<?php echo U('Activity/upload_video');?>">
	<input type="file" name="video">
	<input type="submit" value="提交">
 </form>  
</body>
</html>