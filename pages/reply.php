<?php
    session_start();
    require_once '../Dao.php';
    print_r($_SESSION);

    // if(!isset($_SESSION['authenticated'])) {
    //     header('Location: ../pages/login.php');
    //     exit; 
    //   }

      if (isset($_SESSION["user_id"])) {
        $dao = new dao();
        $user = $dao->getUser($_SESSION["user_id"]);
      }
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title> Create post</title>
    <link rel="icon" href="../favicon.ico" type="image/x-icon">
    <link rel="shortcut icon" href="../favicon.ico" type="image/x-icon">
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
                        <li><a href="../pages/logout">Logout</a></li>
                    <?php else: ?>
                        <a href="../pages/login.php">Sign In</a></li>
                    <?php endif; ?>
            </form>
        </ul>
    </nav>
    
    <div class="section-container">
        <div class="section login-container">
            <div class="login-box">
                <h2>Create Post</h2>
                <form class="create-user-form" method="post" action="../handlers/createPost-handler.php">
                    <div style="text-align: center; margin: 15px;"><label for="title">Title:</label>
                    <input type="text" id="title" name="title" required> </div>

                    <div style="text-align: center;"><label for="content">Content:</label></Br>
                    <textarea id="content" name="content" rows="10"  style="width: 80%;" required></textarea></div>

                    <input type="submit" value="Create Post">
                </form>
            </div>
        </div>
    </div>
    <footer>
        &copy; Hello to my first website!
    </footer>
</body>
</html>