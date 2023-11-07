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
                        <li><a href="../pages/logout">Logout</a></li>
                    <?php else: ?>
                        <a href="../pages/login.php">Sign In</a></li>
                    <?php endif; ?>
            </form>
        </ul>
    </nav>
    <header class="style-header">
        <h1>About Me</h1>
        <p> I really like disc golf!</p> 
        
    </header>
    <footer>
            <p>Likes 12 </p>
            
    </footer>
    <nav>
        <label for="filter" class="label">Filter:</label>

        <select name="filter" id="flter">
        <option value="most">--</option>
            <option value="most">Most Liked</option>
            <option value="least">Least Liked</option>
        </select>
    </nav>
    <div>
        <section class="section">
            <h2>Commet one</h2>
            <ul>
                <p> I agree!<i</p>
            </ul>
            <button class="like-button">Like</button>
            <button class="reply-button">Reply</button>
        </section >
   
    </div>
    <footer>
        &copy; Hello to my first website!
    </footer>
</body>
</html>