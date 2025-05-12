<?php
session_start();
error_reporting(E_ALL);
ini_set('display_errors', 1);


include 'db.php';



if ($_SERVER['REQUEST_METHOD'] ==='POST') {
    if(!isset($_SESSION['user_id'])) {
        die("user must login to post a comment");
    }

    $user_id = $_SESSION['user_id'];
    $thread_id = isset($_POST['thread_id']) ? intval($_POST['thread_id']) : 0;
    $content = trim($_POST['content']);

    if ($thread_id <= 0) {
        die("Invalid thread ID.");
    }

    if (!empty($content)) {
        $stmt = $conn->prepare("INSERT INTO replies (thread_id, user_id, content, created_at) VALUES (?,?,?, NOW())");
        $stmt->bind_param("iis", $thread_id, $user_id, $content);

        if($stmt->execute()) {
            echo "success";
            exit;
        } else {
            die("Error inserting reply: " . $stmt->error);
        }
    } else {
        echo "Reply content connot be empty.";
    }
}
?>