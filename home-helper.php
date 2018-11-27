<?php
    function createHome($body) {
        $page = <<<EOPAGE
<!doctype html>
<html>
    <head> 
        <meta charset="utf-8" />
        <meta name="viewport" content="width=device-width, initial-scale=1.0" />
        <title>Home</title>	
        <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script>
        <script src="src/js/home.js"></script>
        <link href="src/styles/home.css" rel="stylesheet">
    </head>
            
    <body>
        $body
    </body>
</html>
EOPAGE;

        return $page;
    }
?>
