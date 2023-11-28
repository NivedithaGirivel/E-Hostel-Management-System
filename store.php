<?php
// Include the connection file
include("connection.php");

// Check if the form is submitted
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Sanitize user input to prevent SQL injection
    $username = mysqli_real_escape_string($conn, $_POST["registrationNumber"]);
    $billAmount = mysqli_real_escape_string($conn, $_POST["Amount"]);

    // Query the database for the user's current amount
    $result = $conn->query("SELECT amount FROM users WHERE userid = '$username'");

    if ($result->num_rows > 0) {
        // Fetch the current amount
        $userRow = $result->fetch_assoc();
        $currentAmount = $userRow["amount"];

        // Check if the user has sufficient balance
        if ($currentAmount >= $billAmount) {
            // Calculate the new amount after deducting the bill amount
            $newAmount = $currentAmount - $billAmount;

            // Update the user's amount in the database
            $updateQuery = "UPDATE users SET amount = $newAmount WHERE userid = '$username'";
            if ($conn->query($updateQuery) === TRUE) {
                // Display success message or perform other actions

                echo "<script> alert(\"Purchase successful! Your new amount is: $newAmount\"); </script>";
            } else {
                // Display error message if the update fails
                echo "Error updating amount: " . $conn->error;
            }
        } else {
            // Insufficient balance, display an error message
            echo "<script> alert(\"Insufficient balance! Please recharge your account.\"); </script>";
        }
    } else {
        // User not found, display an error message
        echo "User not found!";
    }
}

// Close the database connection
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
        <a href="login.php" class="w3-bar-item w3-button">LOGIN</a>
        <a href="signup.php" class="w3-bar-item w3-button">REGISTER</a>
        <a href="food.php" class="w3-bar-item w3-button">MESS</a>
        <a href="#" class="w3-bar-item w3-button">LAUNDRY</a>
        <a href="store.php" class="w3-bar-item w3-button">STORE</a>
    </div>
</div>
<div class="w3-container w3-padding-64 w3-red w3-grayscale-min w3-xlarge" id="store" style="height:100%;">
    <div class="w3-content">
      <h1 class="w3-center w3-jumbo" style="margin-bottom:64px;">STORE</h1>
    
      <form action="#" method="post">
     
        <p><input class="w3-input w3-padding-16 w3-border" type="number" placeholder="UserID" id="registrationNumber" name="registrationNumber"></p>
        <p><input class="w3-input w3-padding-16 w3-border" type="number" placeholder="Amount" id="Amount" name="Amount"></p>
        <p><button class="w3-button w3-light-grey w3-block" type="submit">SUBMIT</button></p>
      </form>
      </form>
    </div>
  </div>

</body>
</html>