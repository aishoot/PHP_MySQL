<?php
$method = $_GET["method"];   //select, insert, modify
$cid = $_GET["cid"];
$openID = $_GET["openID"];
$pid = $_GET["pid"];
$detail_text = $_GET["detail_text"];
$like_num = $_GET["like_num"];
$con=mysqli_connect("localhost", "root", "rooftop", "rooftop");

// 检测连接
if (mysqli_connect_errno())
{
    echo "数据库连接失败: " . mysqli_connect_error();
}

if ($method=="select")
{
    $result = mysqli_query($con, "SELECT * FROM Comment where Pid=".$pid);
    $arr = array();
    while($row = mysqli_fetch_assoc($result))
    {   
        //echo json_encode($row);
        $arr[] = $row;
    }
    foreach ($arr as $key => $value)
    {
        $name[$key] = $value['timestamp'];
    }
    array_multisort($name, SORT_DESC, $arr);  //降序,默认为升序
    //$arr_slice = array_slice($arr, 0, 30);   //返回前30条记录
    echo json_encode($arr);
}
elseif ($method=="insert")
{
    mysqli_query($con, "INSERT INTO Comment(openID, Pid, detail_text, like_num)". " VALUES (".$openID. ",". $pid. ",". $detail_text. ",". $like_num. ")");
    echo "插入成功."."<br>";
    echo "INSERT INTO Comment(openID, Pid, detail_text, like_num)". " VALUES (".$openID. ",". $pid. ",". $detail_text. ",". $like_num. ")";
}
elseif($method=="modify")
{
    mysqli_query($con, "UPDATE Comment SET like_num=".$like_num." WHERE Cid=".$cid);
    echo "修改成功";
}
else
{
     echo "请确认对数据库操作的方式";
}

mysqli_close($con);
?>
