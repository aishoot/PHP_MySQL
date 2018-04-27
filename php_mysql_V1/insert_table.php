<?php
$servername = "localhost";
$username = "root";
$password = "******";
$dbname = "myDB";

//创建连接
$conn = new mysqli($servername, $username, $password, $dbname);
//检测连接
if($conn->connect_error){
    die("连接失败.".$conn->connect_error);
}else{
    echo "数据库连接成功。<br>";
}

$sql = "INSERT INTO MyGuests (firstname, lastname, email)
VALUES ('John', 'Doe', 'john@example.com');";
$sql .= "INSERT INTO MyGuests (firstname, lastname, email)
VALUES ('Mary', 'Moe', 'mary@example.com');";
$sql .= "INSERT INTO MyGuests (firstname, lastname, email)
VALUES ('Julie', 'Dooley', 'julie@example.com')";

if($conn->multi_query($sql) === TRUE){
    echo "新纪录插入成功。";
} else {
    echo "Error:".$sql."<br>".$conn->error;
}

$conn->close();
?>
