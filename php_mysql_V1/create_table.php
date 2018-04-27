<?php
$servername = "localhost";
$username = "root";
$password = "*****";
$dbname = "myDB";

//创建连接
$conn = new mysqli($servername, $username, $password, $dbname);
//检测连接
if($conn->connect_error){
    die("连接失败:".$conn->connect_error);
}else{
    echo "数据库连接成功.<br>";
}

//使用sql创建数据表
$sql = "CREATE TABLE MyGuests(
id INT(6) UNSIGNED AUTO_INCREMENT PRIMARY KEY,
firstname VARCHAR(30) NOT NULL,
lastname VARCHAR(30) NOT NULL,
email VARCHAR(50),
reg_data TIMESTAMP
)";

if($conn->query($sql) === TRUE){
    echo "Table创建成功。";
} else {
    echo "Table创建失败:".$conn->error;
}

$conn->close();
?>
