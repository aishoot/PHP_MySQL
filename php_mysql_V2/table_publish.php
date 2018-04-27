<?php
$method = $_GET["method"];   //select, insert, modify
$pid = $_GET["pid"];
$openID = $_GET["openID"];
$lid = $_GET["lid"];
$picURL = $_GET["picURL"];
$detail_text = $_GET["detail_text"];
$like_num = $_GET["like_num"];
$comment_num = $_GET["comment_num"];
$lat = $_GET["lat"];
$lng = $_GET["lng"];
$upload_time = $_GET["upload_time"];
$con=mysqli_connect("localhost", "root", "rooftop", "rooftop");

// 检测连接
if (mysqli_connect_errno())
{
    echo "连接失败: " . mysqli_connect_error();
}

if ($method=="select_openID")
{
    $result = mysqli_query($con, "SELECT * FROM Publish where openID=". "\"".$openID."\"");
    $arr = array();
    while($row = mysqli_fetch_assoc($result))
    {
        array_push($arr, $row);
        //echo json_encode($row);
    }
    
    foreach ($arr as $key => $value)
    {
        $name[$key] = $value['like_num'];
    }
    array_multisort($name, SORT_DESC, $arr);  //降序,默认为升序
    $arr_slice = array_slice($arr, 0, 30);   //返回前30条记录
    echo json_encode($arr_slice);
}
elseif ($method=="select_lid_time")
{
    $result = mysqli_query($con, "SELECT * FROM Publish where Lid=". "\"".$lid."\"");
    $arr = array();
    while($row = mysqli_fetch_assoc($result))
    {
        array_push($arr, $row);
        //echo json_encode($row);
    }

    foreach ($arr as $key => $value)
    {  
	$name[$key] = $value['upload_time'];
    }
    array_multisort($name, SORT_DESC, $arr);  //降序,默认为升序
    $arr_slice = array_slice($arr, 0, 30);   //返回前30条记录
    echo json_encode($arr_slice);
}
elseif ($method=="select_lid_like")
{
    $result = mysqli_query($con, "SELECT * FROM Publish where Lid=". "\"".$lid."\"");
    $arr = array();
    while($row = mysqli_fetch_assoc($result))
    {
        array_push($arr, $row);
        //echo json_encode($row);
    }
    
    foreach ($arr as $key => $value)
    {
        $name[$key] = $value['like_num'];
    }
    array_multisort($name, SORT_DESC, $arr);  //降序,默认为升序
    $arr_slice = array_slice($arr, 0, 30);   //返回前30条记录
    echo json_encode($arr_slice);
}
elseif ($method=="select_all")
{
    $result = mysqli_query($con, "SELECT * FROM Publish");
    $arr = array();
    while($row = mysqli_fetch_assoc($result))
    {
        array_push($arr, $row);
        //echo json_encode($row);
    }
    echo json_encode($arr);
    //print_r($arr);
}
elseif ($method=="insert")
{
    mysqli_query($con, "INSERT INTO Publish(openID, Lid, picURL, detail_text, like_num, comment_num, lat, lng, upload_time)"." VALUES (".$openID. ",". $lid. ",". $picURL. ",". $detail_text. ",". $like_num. ",". $comment_num. ",". $lat. ",". $lng. ",". $upload_time. ")");
    echo "插入成功.";
    //echo "INSERT INTO Publish(openID, Lid, picURL, detail_text, like_num, comment_num, lat, lng)"." VALUES (".$openID. ",". $lid. ",". $picURL. ",". $detail_text. ",". $like_num. ",". $comment_num. ",". $lat. ",". $lng. ")";
}
elseif ($method=="modify")
{
    if ($like_num!=NULL){
        mysqli_query($con, "UPDATE Publish SET like_num=". $like_num. " WHERE pid=".$pid);
    }
    if ($comment_num!=NULL){
        mysqli_query($con, "UPDATE Publish SET comment_num=". $comment_num. " WHERE pid=".$pid);
    }
    echo "修改成功.";
}
else
{
     echo "读取错误。";
}

mysqli_close($con);
?>
