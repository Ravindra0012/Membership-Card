<?php
$servername = "localhost"; 
$username = "root"; 
$password = ""; 
$database = "membership_db"; 

$conn = new mysqli($servername, $username, $password, $database);

if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

$name = $_POST['name'];
$email = $_POST['email'];
$number = $_POST['number'];
$age = $_POST['age'];
$gender = $_POST['gender'];


$target_dir = "uploads";

if (!is_dir($target_dir)) {
    mkdir($target_dir, 0777, true);
}

$target_file = $target_dir . basename($_FILES["photo"]["name"]);
move_uploaded_file($_FILES["photo"]["tmp_name"], $target_file);

$sql = "INSERT INTO membership (name, email, number, age, gender, photo) VALUES ('$name', '$email', '$number', '$age', '$gender', '$target_file')";

if ($conn->query($sql) === TRUE) {
    echo "New record created successfully";
} else {
    echo "Error: " . $sql . "<br>" . $conn->error;
}

$conn->close();
?>
