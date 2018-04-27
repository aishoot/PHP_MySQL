<?php
$method = $_GET["method"];   //select, insert
$lid = $_GET["lid"];
$lat_NW = $_GET["lat_NW"];
$lng_NW = $_GET["lng_NW"];
$lat_SE = $_GET["lat_SE"];
$lng_SE = $_GET["lng_SE"];
$location_name = $_GET["location_name"];
$con=mysqli_connect("localhost", "root", "rooftop", "rooftop");

// 检测连接
if (mysqli_connect_errno())
{
    echo "连接失败: " . mysqli_connect_error();
}

if ($method=="select")
{
    $result = mysqli_query($con, "SELECT * FROM Location where Lid=".$lid);
    while($row = mysqli_fetch_assoc($result))
    {   
        echo json_encode($row);  
    }

}
elseif ($method=="insert")
{
    //mysqli_query($con, "INSERT INTO Location(lat_NW, lng_NW, lat_SE, lng_SE, location_name)". " VALUES (".$lat_NW. ",". $lng_NW. ",". $lat_SE. ",". $lng_SE. ",". $location_name.")");
    echo "插入成功.";
    //echo "INSERT INTO Location(lat_NW, lng_NW, lat_SE, lng_SE, location_name)". " VALUES (".$lat_NW. ",". $lng_NW. ",". $lat_SE. ",". $lng_SE. ",". $location_name.")";
}
else
{
     echo "读取错误。";
}

mysqli_close($con);
?>
