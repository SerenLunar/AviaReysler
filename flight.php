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

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $dep_loc = $_POST["departure"];
    $arr_loc = $_POST["arrival"];
    $dep_DT = $_POST["departure_DT"];
    $arr_DT = $_POST["arrival_DT"];
    
    $sql = "INSERT INTO flight (departure_Loc, arrival_Loc, departure_DT, arrival_DT) 
            VALUES ('$dep_loc', '$arr_loc', '$dep_DT', '$arr_DT')";

    if (mysqli_query($connection, $sql)) {
        echo "success.";
        $last_insert_id = mysqli_insert_id($connection);
            function randomFlightNum($conn) {
        $chars = 'ABCDEFGHIJKLMNOPQRSTUVWXYZ';
        $nums = '0123456789';
        
        $random_chars = $chars[rand(0, strlen($chars) - 1)] . $chars[rand(0, strlen($chars) - 1)];
        $random_nums = $nums[rand(0, strlen($nums) - 1)] . $nums[rand(0, strlen($nums) - 1)] . $nums[rand(0, strlen($nums) - 1)];
        
        $randomFlightNum = $random_chars . $random_nums;
        
        // Bu nömrənin bazada mövcud olub olmadığını yoxlamaq
        $checkQuery = "SELECT COUNT(*) as count FROM flight WHERE flight_num = '$randomFlightNum'";
        $result = $conn->query($checkQuery);
        $row = $result->fetch_assoc();
        $count = $row['count'];
        
        // Əgər bu nömrə mövcud deyilsə, onu qaytar
        if ($count == 0) {
            return $randomFlightNum;
        } else {
            // Əks halda, yenidən random nömrə yarat
            return randomFlightNum($conn);
        }
    }
    
    // Random oturacaq nömrəsini yaratmaq üçün funksiya
    function randomSeatNum() {
        $chars = 'ABCDEFGHIJKLMNOPQRSTUVWXYZ'; // Harfler
        $nums = '0123456789'; // Rakamlar
        
        $random_chars = $chars[rand(0, strlen($chars) - 1)];
        $random_nums = $nums[rand(0, strlen($nums) - 1)] . $nums[rand(0, strlen($nums) - 1)];
        
        // Rastgele oluşturulan oturma numarasını birleştir ve geri döndür
        $randomSeatNum = $random_chars . $random_nums;
        return $randomSeatNum;
    }
    
    // Random uçuş nömrəsini yaratmaq
    $randomFlightNum = randomFlightNum($connection);
    
    // Random oturacaq qadını nömrəsini yaratmaq
    $randomSeatNum = randomSeatNum();
    
    // flight cədvəlini yeniləmək
    $sqlFlight = "UPDATE flight SET flight_num='$randomFlightNum', seat_num='$randomSeatNum' WHERE flightID='$last_insert_id'";
    if (mysqli_query($connection, $sqlFlight)) {
        echo "flight cədvəli yeniləndi\n";
    } else {
        echo "Xəta: " . $sqlFlight . "<br>" . mysqli_error($connection);
    }
    } else {
        echo "error: " . $sql . "<br>" . mysqli_error($connection);
    }
}


    mysqli_close($connection);
    header("Location: register.html");

?>
