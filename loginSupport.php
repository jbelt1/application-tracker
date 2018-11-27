<?php
    $host = "localhost";
    $user = "dbuser";
    $password = "goodbyeWorld";
    $database = "application_tracker";
    $table = "users";

    function generatePage($body) {
        $page = <<<EOPAGE
            <!doctype html>
            <html>
                <head> 
                    <meta charset="utf-8"/> 
                    <title>Form Example</title>	
                    <meta http-equiv="X-UA-Compatible" content="IE=edge">
                    <meta name="viewport" content="width=device-width, initial-scale=1">
                    <link rel="stylesheet" href="src/styles/Main.css" />
                </head>
                        
                <body>
                        $body
                </body>
            </html>
EOPAGE;
    
        return $page;
    }

    function generateStartPage($loginError, $registerError) {
        $StartPage = <<<EOPAGE
        <div id="main-wrapper">
            <div id="login-container" class="container">
                <h1 align="center">Login</h1>
                <form action="login.php" method="post">
                    <strong>Username: </strong><input type="text" id="loginUsername" name="loginUsername" required> <br>
                    <strong>Password: </strong><input type="password" id="loginPassword" name="loginPassword" required> <br>
                    <input type="submit" value="Login" value="Login" class="button">
                </form>
                <p>
                    $loginError
                </p>
            </div>
    
            <div id="register-container" class="container">
                <h1 align="center">Register</h1>
                <form action="register.php" method="post">
                    <strong>Username: </strong><input type="text" id="registerUsername" name="registerUsername" required> <br>
                    <strong>Password: </strong><input type="password" id="registerPassword" name="registerPassword" required> <br>
                    <strong>Verify Password: </strong><input type="password" id="verifyPassword" name="verifyPassword" required> <br>
                    <input type="submit" value="Register" id="register" class="button">
                </form>
                <p id="registerError">
                    $registerError
                </p>
            </div>
        <div>
    
        <script src="http://ajax.googleapis.com/ajax/libs/jquery/3.1.1/jquery.min.js" type="text/javascript"></script>
        <script src="src/js/formValidation.js"></script> 
EOPAGE;
    
        echo generatePage($StartPage);
    }
?>