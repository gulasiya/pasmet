<?php

$group = intval($_POST['group']);
$startTime = intval($_POST['start_time']);
$fullName = $_POST['full_name'];
$email = $_POST['email'];
$age = intval($_POST['age']);
$gender = intval($_POST['gender']);
$password = $_POST['password'];
$end_datetime = time();
$diffSeconds = $end_datetime - $startTime;


$host = '127.0.0.1';
$database = 'experiment';
$db_user ='root';
$db_password = '';

$link = mysqli_connect($host, $db_user, $db_password, $database) or die('Database connecting error');

$sql = "INSERT INTO statistics " .
        "(group_id, full_name, email, password, age, gender, seconds) " .
        "VALUES " .
        "({$group}, '{$fullName}', '{$email}', '{$password}', {$age}, {$gender}, {$diffSeconds})";

$result = mysqli_query($link, $sql) or die("Ошибка " . mysqli_error($link));

mysqli_close($link);
?>

<!doctype html>
<html lang="en">
<head>

    <meta charset="UTF-8">

    <title>Password meter</title>

    <link rel="stylesheet" href="styles/style.css">
</head>
<body>

    <div class="container">
        <h2 class="title">
            Thank you for participating in survey
        </h2>

        <iframe frameborder="0" style="width: 750px; height: 560px" src="http://games16.happyneuron.com/aspx/member/LaunchGame.aspx?gamenum=17">
        </iframe>
    </div>

</body>
</html>
