<!DOCTYPE html>
<html>
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Create New User</title>
    <link rel="shortcut icon" href="../Bronco.png">
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
        <h1>Create A New User</h1>
    </header>
    <nav>
    </nav>
    
    <div class="create-user-container">
        <div class="create-user-box">
            <h1>Signup</h1>
            <form class="create-user-form" action="../handlers/CreateUser-handler.php" method="post">
                <div>
                    <label for="name">Username</label>
                    <input type="text" id="name" name="name" place>
                </div>
                
                <div>
                    <label for="email">Email</label>
                    <input type="email" id="email" name="email">
                </div>
                
                <div>
                    <label for="password">Password</label>
                    <input type="password" id="password" name="password">
                </div>
                
                <div>
                    <label for="password_confirmation">Repeat password</label>
                    <input type="password" id="password_confirmation" name="password_confirmation">
                </div>
                
                <input type="submit" value="Create Account">
            </form>
        </div>
    </div>  
</body>
</html>