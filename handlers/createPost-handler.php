<?php
session_start();

if (!isset($_SESSION['authenticated'])) {
    header('Location: ../pages/login.php');
    exit;
}

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    // Validate and sanitize the input
    $title = htmlspecialchars($_POST['title']);
    $content = htmlspecialchars($_POST['content']);

    // Check if title and content are not empty
    if (empty($title) || empty($content)) {
        echo "Title and content are required.";
        exit;
    }

    // Assuming you have a Dao class and a function to add posts
    require_once '../Dao.php';
    $dao = new Dao();

    // Get the user ID from the session
    $userId = $_SESSION['user_id'];

    // Add the post to the database
    $dao->addPost($userId, $title, $content);

    // Redirect to a success page or wherever you want
    $_SESSION['post_created'] = true;
    header('Location: ../index.php');
    exit;
} else {
    // Handle other HTTP methods if needed
    echo "Invalid request method.";
    exit;
}
?>
