<?php
include("connection.php");

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Sanitize user input to prevent SQL injection
    $username = mysqli_real_escape_string($conn, $_POST["registrationNumber"]);
    $password = mysqli_real_escape_string($conn, $_POST["password"]);

    // Check if the user already exists
    $duplicate = $conn->query("SELECT * FROM users WHERE userid = '$username'");

    if ($duplicate->num_rows > 0) {
        echo "<script> alert(\"User Already Exists\"); </script>";
    } else {
        // Use prepared statements to prevent SQL injection
        $stmt = $conn->prepare("INSERT INTO users (userid, password, amount) VALUES (?, ?, 20000)");
        $stmt->bind_param("ss", $username, $password);

        if ($stmt->execute()) {
            
            echo "<script> alert(\"Registered successfully!\"); </script>";
        } else {
            echo "Error: " . $stmt->error;
        }

        $stmt->close();
    }
}

$conn->close();
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link rel="stylesheet" href="https://www.w3schools.com/w3css/4/w3.css">
    <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Amatic+SC">
    <style>
        body, html {height: 100%}
        body,h1,h2,h3,h4,h5,h6 {font-family: "Amatic SC", sans-serif}
        .menu {display: none}
        .bgimg {
            background-repeat: no-repeat;
            background-size: cover;
            background-image: url("download.jpg");
            min-height: 90%;
        }
    </style>
</head>
<body>

<!-- Navbar (sit on top) -->
<div class="w3-top w3-hide-small">
    <div class="w3-bar w3-xlarge w3-black w3-opacity w3-hover-opacity-off" id="myNavbar">
        <a href="index.html" class="w3-bar-item w3-button">HOME</a>
        <a href="login.html" class="w3-bar-item w3-button">LOGIN</a>
        <a href="#" class="w3-bar-item w3-button">REGISTER</a>
        <a href="food.html" class="w3-bar-item w3-button">MESS</a>
        <a href="laundry.html" class="w3-bar-item w3-button">LAUNDRY</a>
        <a href="store.html" class="w3-bar-item w3-button">STORE</a>
    </div>
</div>
<div class="w3-container w3-blue-grey w3-padding-64 w3-xxlarge" id="reg" style="height:100%;">
    <div class="w3-content">
    
      <h1 class="w3-center w3-jumbo" style="margin-bottom:64px">SIGN-UP</h1>
      <div class="w3-row w3-center w3-border w3-border-dark-grey">
        <a href="javascript:void(0)" onclick="openMenu(event, 'Pizza');" id="myLink">
          <div style="text-align: center;"></div>
        </a>
      </div>
  
  
      <form action="#" method="post">
        <p><input class="w3-input w3-padding-16 w3-border" type="number" placeholder="UserID" id="registrationNumber" name="registrationNumber"></p>
        <p><input class="w3-input w3-padding-16 w3-border" type="password" placeholder="Password" id="password" name="password"></p>
        <p><button class="w3-button w3-light-grey w3-block" type="submit" name="submit" id="submit">SUBMIT</button></p>
    </form>
      </div>
  
  </div>

</body>
</html>
