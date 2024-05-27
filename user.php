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

if (isset($_POST["submitR"])) {
	// Kullanıcı bilgilerini al
	$name = $_POST["name"];
	$surname = $_POST["surname"];
	$email = $_POST["email"];
	$phone = $_POST["tel"];
	$gender = $_POST["gender"];
	$birthday = $_POST["date"];

	// Aynı ad ve soyad ile başka kullanıcılar var mı kontrol et
	$check_query = "SELECT * FROM users WHERE UName='$name' AND Surname='$surname'";
	$check_result = mysqli_query($connection, $check_query);
    $row = "SELECT MAX(flightID) AS last_insert_id FROM flight";
    $resultRow = mysqli_query($connection, $row);
    $rowFlight = mysqli_fetch_assoc($resultRow);
    $last_insert_id = $rowFlight["last_insert_id"];
	// Kullanıcı varsa
	if (mysqli_num_rows($check_result) > 0) {
        $update_user_query = "UPDATE users SET flightID='$last_insert_id' WHERE UName='$name' AND Surname='$surname'";
        if (!mysqli_query($connection, $update_user_query)) {
            echo "Error updating user record: " . mysqli_error($connection);
        } else {
            echo "User record updated successfully.";
        }
    } else {
		// Kullanıcı yoksa, yeni bir kullanıcı oluştur
		$insert_user_query = "INSERT INTO users (UName, Surname, Email, Phone, Gender, Birthday, flightID)
                             VALUES ('$name', '$surname', '$email', '$phone', '$gender', '$birthday', '$last_insert_id')";

            if (mysqli_query($connection, $insert_user_query)) {
                echo "User record created successfully.";
            } else {
                echo "Error creating user record: " . mysqli_error($connection);
                exit(); // Programın devam etmemesi gereken bir hata durumu
            }

		}
	// Kullanıcı kaydı tamamlandıktan sonra yönlendirme yap
	header("Location: ticket.php");
    exit();
}

mysqli_close($connection);
?>