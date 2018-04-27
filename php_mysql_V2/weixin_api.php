<?php
/***
$con=mysqli_connect("localhost","root","zhp123456","rooftop");
// 检测连接
if (mysqli_connect_errno())
{
    echo "连接失败: " . mysqli_connect_error();
} else {
    echo "数据库连接成功。<br>";
}

$result = mysqli_query($con,"SELECT * FROM NYC");
while($row = mysqli_fetch_assoc($result))
{
    //echo $row['firstname'];
    //echo " " . $row['lastname'];
    //echo " " . $row['age']."<br>";
    echo json_encode($row);  //将请求结果转换为json格式
    //echo "<br>";
}

mysqli_close($con);  **/

define("appid", "wx52b43c6a5ef2467b");
define("secretid", "f3f8f13552a4286891ebae9b720d3d17");
$logcode=$_GET["logcode"];

$WeChatURL='https://api.weixin.qq.com/sns/jscode2session?appid='.appid.'&secret='.secretid.'&js_code='.$logcode.'&grant_type=authorization_code';
try {
    $content = file_get_contents($WeChatURL);
    $arr_json = json_decode($content, true); //must do json_decode
    $boolErrcode = isset($arr_json["errcode"]);
    //echo var_dump($boolErrcode)."<br>";
    //echo $content."<br>"; 

    if($boolErrcode)  //have error code
    {
        $arr = array("openid" => "0");
        echo json_encode($arr);
    }else{
        echo $content;
    }
} catch (Exception $e) {
    die("Unable to request api.weixin.");
}

?>
