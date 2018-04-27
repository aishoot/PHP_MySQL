<?php
$con=mysqli_connect("localhost","root","******","myDB");
// 检测连接
if (mysqli_connect_errno())
{
    echo "连接失败: " . mysqli_connect_error();
} else {
    echo "数据库连接成功。<br>";
}

$result = mysqli_query($con,"SELECT * FROM MyGuests ORDER BY age");
while($row = mysqli_fetch_array($result))
{
    echo $row['firstname'];
    echo " " . $row['lastname'];
    echo " " . $row['age'];
    echo "<br>";
}

mysqli_close($con);
?>
