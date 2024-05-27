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
        <span class="jfk" name="departureLoc">Baku</span>
        <span class="sfo" name="arrivalLoc">Tokyo</span>
      
        <span class="jfk jfkslip" name="departureLoc">Baku</span>
        <span class="sfo sfoslip" name="arrivalLoc">Tokyo</span>

        <div class="sub-content">
          <span class="name" name="name">PASSENGER NAME<br><span>Aqsin, Abdulla</span></span>
          <span class="flight" name="flightNum">FLIGHT N&deg;<br><span>X3-65C3</span></span>
          <span class="gate">GATE<br><span>11B</span></span>
          <span class="seat" name="seatNum">SEAT<br><span>45A</span></span>
          <span class="boardingtime">BOARDING TIME<br><span>25 May 2024</span></span>
              
           <span class="flight flightslip" name="flightNum">FLIGHT N&deg;<br><span>X3-65C3</span></span>
            <span class="seat seatslip" name="seatNum">SEAT<br><span>45A</span></span>
           <span class="name nameslip" name="name">PASSENGER NAME<br>
            <span><?php echo !empty($user_data['UName']) ? $user_data['UName'] . ', ' : ''; ?><?php echo !empty($user_data['Surname']) ? $user_data['Surname'] : ''; ?></span></span>
        </div>
      </div>
    </div>
  </div>
</body>
  </html>