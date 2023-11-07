<!DOCTYPE html>
<html>
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login Page</title>
    <link rel="shortcut icon" href="Bronco.png">
    <link rel="stylesheet" type="text/css" href="..\stylesheets\home.css">
</head>
<body>
    <nav>
        <ul>
            
            <form>
                <li><a href="../index.php">Home</a></li> 
            </form>
        </ul>
    </nav>
    <header class="style-header">
        <h1>Login</h1>
    </header>
    <nav>
    </nav>
    <div class="section-container">
        <div class="section login-container">
            <div class="login-box">
                <h2>Login</h2>
                <form class="create-user-form" action="../handlers/login-handler.php" method="post" >
                <div>
                    <label for="email">Email</label>
                    <input type="email" id="email" name="email" >
                </div>
                
                <div>
                    <label for="password">Password</label>
                    <input type="password" id="password" name="password">
                </div>
                <input type="submit" value="Login">
                </form>
            </div>
            <a href="CreateUser.php">
                <h4>Create user</h4>
            </a>
        </div>
    </div>
    <footer>
        &copy; Hello to my first website!
    </footer>
</body>
</html>