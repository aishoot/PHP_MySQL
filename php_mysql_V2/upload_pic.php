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
		//echo "上传文件名: " . $_FILES["up_file"]["name"] . "<br>";
		//echo "文件类型: " . $_FILES["up_file"]["type"] . "<br>";
		//echo "文件大小: " . ($_FILES["up_file"]["size"] / 1024) . " kB<br>";
		//echo "文件临时存储的位置: " . $_FILES["up_file"]["tmp_name"] . "<br>";
		
		// 判断当期目录下的 picture 目录是否存在该文件
		// 如果没有 picture 目录，你需要创建它，picture 目录权限为 777
		if (file_exists("picture/" . $_FILES["up_file"]["name"]))
		{
			echo $_FILES["up_file"]["name"] . " 文件已经存在。 ";
		}
		else
		{
			// 如果 picture 目录不存在该文件则将文件上传到 picture 目录下, 并按时间戳和文件大小重命名
                        date_default_timezone_set("Asia/Shanghai");
                        $time = date("YmdHis");
                        $pic_size_kb = floor($_FILES["up_file"]["size"] / 1024);
                        $pic_name = $time. "_". $pic_size_kb. "k." .$extension;
			move_uploaded_file($_FILES["up_file"]["tmp_name"], "picture/".$pic_name);
			//echo "文件存储在: " . "picture/" . $pic_name;
                        $arr_site = array ("site"=>("https://www.katouspace.com/rooftop/picture/".$pic_name), "upload_time"=>$time);
                        //$arr_site = array ("site"=>("https://www.katouspace.com/rooftop/picture/".$pic_name));
                        echo json_encode($arr_site);
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
