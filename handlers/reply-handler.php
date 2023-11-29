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

    // Insert the reply into the database
    require_once '../Dao.php';
    $dao = new Dao();
    $success = $dao->addReply($post_id, $user_id, $content);

    if ($success) {
        // Fetch updated replies
        $updatedReplies = $dao->getRepliesByPostId($post_id);

        // Output success status and updated replies HTML
        echo json_encode(array('success' => true, 'replies' => renderReplies($updatedReplies)));
    } else {
        // Output failure status
        echo json_encode(array('success' => false, 'message' => 'Failed to add reply.'));
    }
} else {
    // Handle the case when the request method is not POST
    echo "Invalid request method.";
}

// Function to render replies HTML
function renderReplies($replies) {
    ob_start(); // Start output buffering

    if (is_array($replies)) {
        foreach ($replies as $reply) {
            ?>
            <div>
                <section class="section">
                    <h2>Reply</h2></Br>
                    <p><?= $reply['Content'] ?></p></Br>
                    <p>Posted by User ID: <?= $reply['Username'] ?></p>
                    <!-- Add more details or formatting as needed -->
                </section>
            </div>
            <?php
        }
    } else {
        ?>
        <p>No replies available</p>
        <?php
    }

    return ob_get_clean(); // Return the buffered output as a string
}

//     if ($success) {
//         // Return a JSON response indicating success
//         echo json_encode(['success' => true]);
//         exit;
//     } else {
//         // Return a JSON response indicating failure
//         echo json_encode(['error' => 'Failed to add reply']);
//         exit;
//     }
// } else {
//     // Return a JSON response indicating an invalid request method
//     echo json_encode(['error' => 'Invalid request method']);
//     exit;
// }

//     if ($success) {
//         // Redirect or handle the successful reply submission
//         header("Location: ../pages/comment.php?post_id=$post_id");
//         exit;
//     } else {
//         // Handle the case when the reply insertion fails
//         echo "Failed to add reply.";
//     }
// } else {
//     // Handle the case when the request method is not POST
//     echo "Invalid request method.";
// }
?>
