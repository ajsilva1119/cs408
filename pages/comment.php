<?php
    session_start();
    require_once '../Dao.php';

    // Store the current URL in a session variable
    $_SESSION['redirect_url'] = $_SERVER['REQUEST_URI'];

    // if(!isset($_SESSION['authenticated'])) {
    //     header('Location: ../pages/login.php');
    //     exit; 
    //   }

    if (isset($_SESSION["user_id"])) {
        $dao = new dao();
        $user = $dao->getUser($_SESSION["user_id"]);
    }

    if (isset($_GET['post_id'])) {
        $post_id = $_GET['post_id'];

        echo "Debug: post_id = " . $post_id;

        $dao = new Dao();

        // Fetch post details based on post_id
        $post = $dao->getPostById($post_id);

        echo "Debug: post_id after fetch = " . $post_id;
        echo "Debug: post after fetch = " . print_r($post, true);
    } else {
        // Handle the case when post_id is not set
        echo "Debug: post_id is not set in the URL";
    }

    $replies = $dao->getRepliesByPostId($post_id);
    
?>
    
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Welcome to Disc Golf Fourms!</title>
    <link rel="icon" href="favicon.ico" type="image/x-icon">
    <link rel="shortcut icon" href="favicon.ico" type="image/x-icon">
    <link rel="stylesheet" type="text/css" href="../stylesheets\comments.css">
</head>
<body>
    <nav>
        <ul>
            <img src="../Bronco.png" alt="logo" width="25" height="25" style="float:left">
            <form>
            <li><a href="#">Search</a></li> 
                <input type="text" name="search"> <input type="submit" name="searchbutton">
                <li><a href="../index.php">Home</a></li> 
                <li>
                    <?php if (isset($user)) :?>
                        <span style="color: white;"><?= $user["Username"] ?></span></li>
                        <li><a href="#">My Posts</a></li>
                        <li><a href="../pages/logout.php">Logout</a></li>
                    <?php else: ?>
                        <a href="../pages/login.php">Sign In</a></li>
                    <?php endif; ?>
            </form>
        </ul>
    </nav>
    <header class="style-header">
        <?php
            // Check if title and content parameters are set
            if (isset($post)) {
                // Display post title and content
                echo "<h1>{$post['Title']}</h1>";
                echo "<p>{$post['Content']}</p>";
            } else {
                // Display an error message if parameters are missing
                echo "<p>Maybe not working</p>";
            }
        ?>
    </header>
    <nav>
        <?php if (isset($user)) :?>
            <button id="toggleReplyForm" >Reply</button>
        <?php else: ?>
        <?php endif; ?>
        
        <!-- <label for="filter" class="label">Filter:</label> -->

        <!-- <select name="filter" id="flter">
        <option value="most">--</option>
            <option value="most">Most Liked</option>
            <option value="least">Least Liked</option>
        </select> -->
    </nav>
    <div>
        <section class="section">
            <form id="replyForm" class="reply-form" method="post" action="../handlers/reply-handler.php" style="display: none;">
                <input type="hidden" name="post_id" value="<?= $post_id ?>">
                
                <div style="text-align: center; margin: 15px;">
                    <label for="reply_content">Your Reply:</label>

                    <div><textarea id="reply_content" name="reply_content" rows="10" style="width: 80%;" required></textarea></div>
                </div>

                <input type="submit" value="Send">
            </form>
        </section>
    </div>
    <?php if (is_array($replies)) : ?>
        <?php foreach ($replies as $reply): ?>
            <div>
                <section class="section">
                    <h2>Reply</h2></Br>
                    <p><?= $reply['Content'] ?></p></Br>
                    <p>Posted by User ID: <?= $reply['Username'] ?></p>
                    <!-- Add more details or formatting as needed -->
                </section>
            </div>
        <?php endforeach; ?>
        <?php else: ?>
            <p>No replies available</p>
        <?php endif; ?>
    
    <footer>
        &copy; Hello to my first website!
    </footer>
    <script>
        // JavaScript to toggle the visibility of the reply form
        document.getElementById('toggleReplyForm').addEventListener('click', function() {
            var replyForm = document.getElementById('replyForm');
            replyForm.style.display = (replyForm.style.display === 'none' || replyForm.style.display === '') ? 'block' : 'none';
        });
    </script>
</body>
</html>