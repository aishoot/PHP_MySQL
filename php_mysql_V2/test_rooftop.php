<?php
$con=mysqli_connect("localhost","root","rooftop","rooftop");
/** 检测连接
if (mysqli_connect_errno())
{
    echo "MySQL connect failed: " . mysqli_connect_error();
} else {
    echo "MySQL connect succeed.<br>";
}***/

$result = mysqli_query($con, "SELECT * FROM User where openID=\"rooftop\"");
$isExsit = 0;
while($row = mysqli_fetch_assoc($result))
{
    //echo $row['firstname'];
    //echo " " . $row['lastname'];
    //echo " " . $row['age']."<br>";
    echo json_encode($row);
    echo "<br>";
   // echo var_dump($result);
    $isExsit = 1;
}

if($isExsit){
    echo "存在";
}else{
    echo "查询数据不存在";
}

mysqli_close($con);
?>
