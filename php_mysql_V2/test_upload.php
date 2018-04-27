<html>
<head>
<meta charset="utf-8">
<title>天台文件上传</title>
</head>
<body>

<!--form action="upload_pic.php" method="post" enctype="multipart/form-data"-->
<form method="post" enctype="multipart/form-data">
        <label for="file">文件名：</label>
        <input type="file" name="up_file" id="file"><br>
        <input type="submit" name="submit" value="提交">
</form>
</body>
</html>

<?php
// 允许上传的图片后缀
$allowedExts = array("gif", "jpeg", "jpg", "png");
$temp = explode(".", $_FILES["up_file"]["name"]);
$extension = end($temp);     // 获取文件后缀名
$max_file_size = 20971520;   //20MB

$file_format =  ($_FILES["up_file"]["type"] == "image/gif")
			|| ($_FILES["up_file"]["type"] == "image/jpeg")
			|| ($_FILES["up_file"]["type"] == "image/jpg")
			|| ($_FILES["up_file"]["type"] == "image/pjpeg")
			|| ($_FILES["up_file"]["type"] == "image/x-png")
			|| ($_FILES["up_file"]["type"] == "image/png");

if ($file_format && ($_FILES["up_file"]["size"] < $max_file_size)
&& in_array($extension, $allowedExts)   //保证文件格式
&& !empty($_FILES['up_file']['name']))
{
	if ($_FILES["up_file"]["error"] > 0)
	{
		echo "错误：: " . $_FILES["up_file"]["error"] . "<br>";
	}
	else
	{
		echo "上传文件名: " . $_FILES["up_file"]["name"] . "<br>";
		echo "文件类型: " . $_FILES["up_file"]["type"] . "<br>";
		echo "文件大小: " . ($_FILES["up_file"]["size"] / 1024) . " kB<br>";
		echo "文件临时存储的位置: " . $_FILES["up_file"]["tmp_name"] . "<br>";
		
		// 判断当期目录下的 picture 目录是否存在该文件
		// 如果没有 picture 目录，你需要创建它，picture 目录权限为 777
		if (file_exists("picture/" . $_FILES["up_file"]["name"]))
		{
			echo $_FILES["up_file"]["name"] . " 文件已经存在。 ";
		}
		else
		{
			// 如果 picture 目录不存在该文件则将文件上传到 upload 目录下
			move_uploaded_file($_FILES["up_file"]["tmp_name"], "picture/" . $_FILES["up_file"]["name"]);
			echo "文件存储在: " . "picture/" . $_FILES["up_file"]["name"];
		}
	}
}
else
{
	echo "非法的文件格式"."<br>";
        echo "上传文件格式是否正确(file_format):";
        var_dump($file_format);
        echo "<br>";
        echo "上传文件类型:";
        var_dump($_FILES["up_file"]["type"]);
        echo "<br>";
        echo "上传文件大小:".($_FILES["up_file"]["size"] < $max_file_size)."<br>";
        echo "上传文件是否为图片(in_array):".in_array($extension, $allowedExts)."<br>";
        echo "文件是否不为空:".!empty($_FILES['up_file']['name'])."<br>";
}
?>
