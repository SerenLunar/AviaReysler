<?php
$host = "localhost";
$username = "root";
$password = "";
$db = "aviareysler";

$connection = mysqli_connect($host, $username, $password, $db);
mysqli_set_charset($connection, "UTF8");
if (!$connection) {
    die("error: " . mysqli_connect_error());
}

if (isset($_POST["submit"])) {
    $name = $_POST["name"];
    $surname = $_POST["surname"];
    $email = $_POST["email"];
    $phone = $_POST["tel"];
    $gender = $_POST["gender"];
    $birthday = $_POST["date"];

    $sql = "INSERT INTO users (UName, Surname, Email, Phone, Gender, Birthday) 
            VALUES ('$name', '$surname', '$email', '$phone', '$gender', '$birthday')";

    if (mysqli_query($connection, $sql)) {
        echo "success.";
    } else {
        echo "error: " . $sql . "<br>" . mysqli_error($connection);
    }
    
    mysqli_close($connection);
}
?>