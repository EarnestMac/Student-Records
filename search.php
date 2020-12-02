<?php
// Initialize the session
session_start();
 
// Check if the user is logged in, if not then redirect him to login page
if(!isset($_SESSION["loggedin"]) || $_SESSION["loggedin"] !== true){
    header("location: login.php");
    exit;
};

?>

<!DOCTYPE html>
<html>
<head>
    <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
</head>

<style>
fieldset {
    background-color: lightgrey;
    border: none;
    border-radius: 20px;
    margin: 10px 0 0 10px;
    width: 480px;
    height: 300px;
}
h2 {
    background-color: black;
    color: darkred;
    margin: 0 -11px 0 -11px;
    padding: 15px;
    position: relative;
    text-align: center;
    bottom: 5px;
    border-radius: 10px;
} 
#submit {
    width: 150px;
    height: 45px;
    border-radius: 10px;
    border: none;
    margin-top: -7px;
    color: dark red;
    margin-left: 145px;
    font-size: 20px;
    font-weight: bold;
}
    
</style>
<body>
<fieldset>   
    
<h2>FIRE Tech Search</h2>

<form action="record.php" target="_blank" method="post">
<br>
<input classtype="text" name="search" placeholder="Search">
    <br>
    <br>
    <br>
    <select name="column">
    <option value="lastName">Last Name</option>
    <option value="firstName">First Name</option>
    <option value="email">Email</option>
    <option value="streetAddress">Address</option>
    <option value="city">City</option>
    <option value="state">State</option>
    <option value="phone">Phone Number</option>
    <option value="courseName">Course Name</option>
    </select>
    <br>
    <br>
    <br>
<input id="submit" type="submit">
</form>
</fieldset>

        <a href="logout.php" class="btn btn-danger">Sign Out of Your Account</a>
    </p>

</body>
</html>