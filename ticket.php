<?php
$host = "localhost";
$username = "root";
$password = "";
$db = "aviareysler";

// Veritabanına bağlanma
$connection = mysqli_connect($host, $username, $password, $db);
mysqli_set_charset($connection, "UTF8");
if (!$connection) {
    die("error: " . mysqli_connect_error());
}
$user_data = null;
$row = "SELECT MAX(flightID) AS last_insert_id FROM users";
    $resultRow = mysqli_query($connection, $row);
    $rowFlight = mysqli_fetch_assoc($resultRow);
    $last_insert_id = $rowFlight["last_insert_id"];
	


    // Kullanıcı bilgilerini veritabanından çekme
    $fetch_query = "SELECT UName, Surname, departure_Loc, arrival_Loc, departure_DT,seat_num, flight_num 
                    FROM users 
                    JOIN flight ON users.flightID = flight.flightID 
                    WHERE users.flightID='$last_insert_id'";

    $fetch_result = mysqli_query($connection, $fetch_query);

    if (mysqli_num_rows($fetch_result) > 0) {
        $user_data = mysqli_fetch_assoc($fetch_result);
    } else {
        echo "User not found.";
    }

mysqli_close($connection);
?>

<!DOCTYPE html>
<html>
    <head>
    <link rel="stylesheet" href="assets/css/ticket.css">
    </head>
    <body>
<div class="box">
    <div class="clip"></div>
    <ul class="left">
      <li></li>
      <li></li>
      <li></li>
      <li></li>
      <li></li>
      <li></li>     <li></li>
      <li></li>
      <li></li>
      <li></li>
      <li></li>
      <li></li>
      <li></li>
      <li></li>
      <li></li>
      <li></li>
      <li></li>
      <li></li>
    </ul>
    
    <ul class="right">
      <li></li>
      <li></li>
      <li></li>
      <li></li>
      <li></li>
      <li></li>
      <li></li>
      <li></li>
      <li></li>
      <li></li>
      <li></li>
      <li></li>
      <li></li>
      <li></li>
    </ul>
    
    <div class="ticket">
      <span class="airline">Chelebi</span>
      <span class="airline airlineslip">Airline</span>
      <span class="boarding">Boarding pass</span>
      <div class="content">
    <span class="jfk" ><?php echo !empty($user_data['departure_Loc']) ? $user_data['departure_Loc'] : ''; ?></span>
    <span class="sfo"><?php echo !empty($user_data['arrival_Loc']) ? $user_data['arrival_Loc'] : ''; ?></span>

    <span class="jfk jfkslip"><?php echo !empty($user_data['departure_Loc']) ? $user_data['departure_Loc'] : ''; ?></span>
    <span class="sfo sfoslip"><?php echo !empty($user_data['arrival_Loc']) ? $user_data['arrival_Loc'] : ''; ?></span>



        <div class="sub-content">
          <span class="name" >PASSENGER NAME<br>
          <span><?php echo !empty($user_data['UName']) ? $user_data['UName']. ', ' : ''; ?><?php echo !empty($user_data['Surname']) ? $user_data['Surname'] : ''; ?></span></span>
          <span class="flight">FLIGHT N&deg;<br>
          <span><?php echo !empty($user_data['flight_num']) ? $user_data['flight_num'] : ''; ?></span></span>
          <span class="gate">GATE<br><span>11B</span></span>
          <span class="seat">SEAT<br>
          <span><?php echo !empty($user_data['seat_num']) ? $user_data['seat_num'] : ''; ?></span></span>
          <span class="boardingtime">BOARDING TIME<br>
          <span><?php echo !empty($user_data['departure_DT']) ? $user_data['departure_DT'] : ''; ?></span></span>
              
           <span class="flight flightslip" >FLIGHT N&deg;<br>
           <span><?php echo !empty($user_data['flight_num']) ? $user_data['flight_num'] : ''; ?></span></span>
            <span class="seat seatslip">SEAT<br>
            <span><?php echo !empty($user_data['seat_num']) ? $user_data['seat_num'] : ''; ?></span></span>
           <span class="name nameslip" >PASSENGER NAME<br>
           <span><?php echo !empty($user_data['UName']) ? $user_data['UName'] . ', ' : ''; ?><?php echo !empty($user_data['Surname']) ? $user_data['Surname'] : ''; ?></span></span>
        </div>
      </div>
    </div>
  </div>
</body>
  </html>