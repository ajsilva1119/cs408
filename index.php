<?php
    session_start();
    require_once 'Dao.php';
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
                        <li><a href="../pages/logout">Logout</a></li>
                    <?php else: ?>
                        <a href="pages\login.php">Sign In</a></li>
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
                <a href="post.php"><button> Post </button></a>
            <?php else: ?>
            <?php endif; ?>
    </nav>
    <div class="section-container">
        <a href="pages\comment.php">
            <section class="section">
                <h2>About Me</h2>
        </a>
                <p>I really like disc golf</p>
            </section>
        <section class="section">
            <h2>Top discs</h2>
            <ul>
                <li>Discmania</li>
                <li>Innova Beast</li>
                <li>Prodigy Pa-3</li>
                <p> These are my favorite discs I would reccommed to you!</p>
            </ul>
        </section >
        <section class="section">
            <h2>Newest disc!!</h2>
            <p>This is my newest disc you look at it </p>
            <img src="Disc.png" alt="logo" width="75" height="75" class="style-image"> 
        </section>
    </div>
    <footer>
        &copy; Hello to my first website!
    </footer>
</body>
</html>