<?php
session_start();

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    // Check if the user is logged in
    if (!isset($_SESSION['user_id'])) {
        // Redirect or handle the case when the user is not logged in
        header('Location: ../pages/login.php');
        exit;
    }

    // Get the form data
    $post_id = $_POST['post_id'];
    $user_id = $_SESSION['user_id'];
    $content = $_POST['reply_content'];

    // Validate the form data (you can add more validation as needed)

    // Insert the reply into the database
    require_once '../Dao.php';
    $dao = new Dao();
    $success = $dao->addReply($post_id, $user_id, $content);

    if ($success) {
        // Redirect or handle the successful reply submission
        header("Location: ../pages/comment.php?post_id=$post_id");
        exit;
    } else {
        // Handle the case when the reply insertion fails
        echo "Failed to add reply.";
    }
} else {
    // Handle the case when the request method is not POST
    echo "Invalid request method.";
}
?>
