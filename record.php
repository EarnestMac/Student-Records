<?php
// Initialize the session
session_start();
 
// Check if the user is logged in, if not then redirect him to login page
if(!isset($_SESSION["loggedin"]) || $_SESSION["loggedin"] !== true){
    header("location: login.php");
    exit;
}
?>

<!DOCTYPE html>
<html>
<head>
    <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <meta http-equiv="X-UA-Compatible" content="ie=edge">
</head>
<style>
@import url('https://fonts.googleapis.com/css2?family=Texturina:wght@200&display=swap');
table {
  border-collapse: collapse;
  width: 100%;
}
th {
  font-size: 20px;
  font-weight: bold;
  text-align: center;
  height: 30px;
  text-decoration: underline;
  padding: 8px;
}
td {
  text-align: center;
  vertical-align: middle;
}
img {
  display: block;
  margin-left: auto;
  margin-right: auto;
  width: 50%;
}
h1 {
  font-family: 'Texturina', serif;
  display: block;
  text-align: center;
  letter-spacing: 3px;
  margin-bottom: 25px;
}
.column {
  margin-bottom: 25px;
}
</style>
<body>
    
<img src="" alt="">

<?php

$search = $_POST['search'];
$column = $_POST['column'];

$servername = "localhost";
$username = "";
$password = "";
$dbName = "";

$conn = mysqli_connect($servername, $username, $password, $dbName);

if ($conn->connect_error){
    die("Connection failed: ". $conn->connect_error);
}

$sql = "SELECT firstName, lastName, streetAddress, city, state, zipCode, phone, email, gender, dateOfBirth, veteranStatus, affiliation, courseName, courseNumberId, dateEnrolled, dateCompleted, locationName, creditHours, grade, certificateReceived
FROM rosters
LEFT JOIN courses
	ON rosters.courseID = courses.courseId
LEFT JOIN locations
	ON rosters.locationId = locations.locationId
LEFT JOIN students	
	ON rosters.studentId = students.studentId
LEFT JOIN grades
	ON rosters.gradeId = grades.gradeId
WHERE $column LIKE '%$search%'";

$result = $conn->query($sql);

if ($result->num_rows > 0){
echo"<table border='1' margin='auto'>
     <tr>
     <th>Course</th>
     <th>Course #</th>
     <th>Date of Enrollment</th>
     <th>Date of Completion</th>
     <th>Location</th>
     <th>Credit Hours</th>
     <th>Grade</th>
     <th>Certification Received</th>
     </tr>";
}
    $row = $result->fetch_assoc();
        echo"<h1>Official Transcript</h1>";
    echo"<div class='column'; style='float: left; width: 50%'>";
            echo"<h4><u>Name</u>: {$row['firstName']} {$row['lastName']}</h4>";
            echo"<h4><u>Address</u>: {$row['streetAddress']}<br>&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp{$row['city']} {$row['state']}  {$row['zipCode']}<br>
             </h4>";
        echo"<h4><u>Phone</u>: {$row['phone']}</h4>";
        echo"<h4><u>Email</u>: {$row['email']}</h4>";
    echo"</div>";
    echo"<div class='column'; style='float: right; width: 50%'>";
        echo"<h4><u>Gender</u>: {$row['gender']}</h4>";
        echo"<h4><u>Date of Birth</u>: {$row['dateOfBirth']}</h4>";
        echo"<h4><br></h4";
        echo"<h4><u>Veteran Status</u>: {$row['veteranStatus']}</h4>";
        echo"<h4><u>Department Affiliation</u>: {$row['affiliation']}</h4>";
    echo"</div>";
$result = $conn->query($sql);
while($row = $result->fetch_assoc() ){
        echo"<tr><td>{$row['courseName']}</td><td>{$row['courseNumberId']}</td><td>{$row['dateEnrolled']}</td><td>{$row['dateCompleted']}</td><td>{$row['locationName']}</td><td>{$row['creditHours']}</td><td>{$row['grade']}</td><td>{$row['certificateReceived']}</td></tr>";
} 
    echo"</table>";
    
    echo"<h5 style='position: fixed; bottom: 0; width: 100%; text-align: left'>'Blank', Executive Director: ____________________</h5>";
    echo"<h5 style='position: fixed; bottom: 0; width: 100%; text-align:right'>Date: ____________________</h5>";

?>


</body>
</html>
