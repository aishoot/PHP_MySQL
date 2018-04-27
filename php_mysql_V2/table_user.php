<?php
$method = $_GET["method"];   //select, insert
$openID = $_GET["openID"];
$avatar = $_GET["avatar"];
$name = $_GET["name"];
define("appid", "wx52b43c6a5ef2467b");
define("secretid", "f3f8f13552a4286891ebae9b720d3d17");
$logcode=$_GET["logcode"];
$con=mysqli_connect("localhost", "root", "rooftop", "rooftop");

// 检测连接
if (mysqli_connect_errno())
{
    echo "连接失败: " . mysqli_connect_error();
}

if ($method=="select")
{
    $result = mysqli_query($con, "SELECT * FROM User where openID=\"".$openID."\"");
    while($row = mysqli_fetch_assoc($result))
    {   
        echo json_encode($row);  
    }

}
elseif ($method=="insert")
{
    $WeChatURL='https://api.weixin.qq.com/sns/jscode2session?appid='.appid.'&secret='.secretid.'&js_code='.$logcode.'&grant_type=authorization_code';
    $content = file_get_contents($WeChatURL);
    $arr_json = json_decode($content, true);
    $boolErrcode = isset($arr_json["errcode"]);

    if($boolErrcode)  //have error code
    {
        //$arr = array("openid" => "0");
        //echo json_encode($arr);
        //echo "INSERT INTO User(openID,avatar,name)". " VALUES(\"". "test". "\",\"".$avatar."\",\"".$name. "\")";
        die("未正确请求微信服务器，返回错误码。");
    }else
    {
        echo $content;
        $is_exsit = 0;
        $result = mysqli_query($con, "SELECT * FROM User where openID=\"".$arr_json["openid"]."\"");
        while($row = mysqli_fetch_assoc($result))
        {
            $is_exsit = 1;
        }
        if(!$is_exsit){
            mysqli_query($con, "INSERT INTO User(openID,avatar,name)". " VALUES(\"". $arr_json["openid"]. "\",\"".$avatar."\",\"".$name. "\")");
            //echo "<br>"."插入成功。";
        }else{
            //echo "<br>"."此用户在数据库已存在。";
        }
    }
}
else
{
     echo "读取错误。";
}

mysqli_close($con);
?>
