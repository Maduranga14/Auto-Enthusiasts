<?php
include 'db.php';

$firstName = $_POST['firstName'];
$lastName = $_POST['lastName'];
$username = $_POST['username'];
$email = $_POST['email'];
$password = password_hash($_POST['password'], PASSWORD_DEFAULT);
$interests = $_POST['selectedInterests'];

$stmt = $conn->prepare("INSERT INTO users (first_name, last_name, username, email, password_hash, interests) VALUES (?,?,?,?,?,?)");
$stmt->bind_param("ssssss",$firstName,$lastName,$username, $email, $password, $interests);

if ($stmt->execute()) {
    echo "registeration successful!";
}else{
    echo "Error:" . $stmt->error;
}

$stmt->close();
$conn->close();
