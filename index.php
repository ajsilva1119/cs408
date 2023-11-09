<?php
    session_start();
    require_once 'Dao.php';
    print_r($_SESSION);

    // Store the current URL in a session variable
    $_SESSION['redirect_url'] = $_SERVER['REQUEST_URI'];

    $dao = new dao();
    // if(!isset($_SESSION['authenticated'])) {
    //     header('Location: ../pages/login.php');
    //     exit; 
    //   }

    if (isset($_SESSION["user_id"])) {
        
        $user = $dao->getUser($_SESSION["user_id"]);
    }

    // Check if a post creation success message is set
    $postCreatedMessage = isset($_SESSION['post_created']) && $_SESSION['post_created'] ? '<div id="post-message">Thanks for the post!</div>' : '';

    // Reset the session variable
    $_SESSION['post_created'] = false;

    //set most recent post
    $mostRecentPost = $dao->getMostRecentPost();
    $mostRecentUsername = null;
    if ($mostRecentPost) {
        $mostRecentUsername = $dao->getUser($mostRecentPost['UserID']);
    }
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>DiscTalk</title>
    <link rel="shortcut icon" href="Bronco.png">
    <link rel="stylesheet" type="text/css" href="stylesheets\home.css">
</head>
<body>
    <nav>
        <ul>
            
            <form>
                <li><a href="#">Search</a></li> 
                <input type="text" name="search"> <input type="submit" name="searchbutton">
                <li>
                    <?php if (isset($user)) :?>
                        <span style="color: white;"><?= $user["Username"] ?></span></li>
                        <li><a href="#">My Posts</a></li>
                        <li><a href="../pages/logout.php">Logout</a></li>
                    <?php else: ?>
                        <a href="../pages\login.php">Sign In</a></li>
                    <?php endif; ?>
            </form>
        </ul>

    </nav>
    <header class="style-header">
        <h1>Welcome to Disc Golf Fourms!</h1>
        <img src="Bronco.png" alt="logo" width="100" height="100" class="style-image"> 
    </header>
    <nav>
        <li>
            <?php if (isset($user)) :?>
                <a href="../pages/createPost.php"><button> Post </button></a>
            <?php else: ?>
            <?php endif; ?>
        </li>
    </nav>

    <!-- Display post creation success message -->
    <?= $postCreatedMessage ?>

    <div class="section-container">
        <a href="pages/comment.php?post_id=<?= $mostRecentPost['PostID'] ?>">
            <section class="section">
            <?php if ($mostRecentPost): ?>
                <h2><?= $mostRecentPost['Title'] ?></h2> </a>
                <p><?= $mostRecentPost['Content'] ?></p>
                <p>Posted by: <?= $mostRecentUsername['Username'] ?></p>
            <?php else: ?>
                <p>No posts available</p>
            <?php endif; ?>
            </section>
        
    </div>
    <footer>
        &copy; Hello to my first website!
    </footer>
    <script>
    // Check if the success message element exists
    var postMessage = document.getElementById('post-message');

    // If the element exists, add a delay and then hide it
    if (postMessage) {
        setTimeout(function () {
            postMessage.style.display = 'none';
        }, 5000); // 5000 milliseconds (5 seconds) delay, adjust as needed
    }
</script>
</body>
</html>