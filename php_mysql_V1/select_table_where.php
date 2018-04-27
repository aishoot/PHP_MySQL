<?php
$servername = "localhost";
$username = "root";
$password = "******";
$dbname = "myDB";
 
// 创建连接
$conn = new mysqli($servername, $username, $password, $dbname);
// Check connection
if ($conn->connect_error) {
    die("连接失败: " . $conn->connect_error);
} else {
    echo "数据库连接成功.<br>";
}

$result = mysqli_query($conn,"SELECT * FROM MyGuests WHERE firstname='John'");

while($row = mysqli_fetch_array($result))
{
    echo $row['firstname'] . " " . $row['lastname'];
    echo "<br>";
}

$conn->close();
?>
