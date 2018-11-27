<?php
    session_start();
 
    require_once('home-helper.php');
    $_SESSION['username'] = "jbelt1";
    $body = "<h1 id=\"error\">You need to login or regist first!</h1>";

    if (isset($_SESSION['username'])) {
        $username = $_SESSION['username'];
        
        $host = "localhost";
	    $user = "root";
	    $password = "";
	    $database = "application_tracker";
	    $table = "applications";
	    $db_connection = new mysqli($host, $user, $password, $database);
	
        $sqlQuery = sprintf("select * from $table where username = '%s'", $username);
        $result = $db_connection->query($sqlQuery);

        if ($result) {
            $numRows = $result->num_rows;
            if ($numRows==0) {
                $username .= " no results!";
            }
            else {
                $applications = "";
                while ($recordArray = $result->fetch_array(MYSQLI_ASSOC)) {
                    $company = $recordArray["company"];
                    $description = $recordArray["description"];
                    $id = $recordArray["id"];
                    $position = $recordArray["position"];
                    $contact_email = $recordArray["contact_email"];
                    $contact_number = $recordArray["contact_number"];
                    $start_date = $recordArray["start_date"];
                    $due_date = $recordArray["due_date"];

                    $application = <<<EOT
<div class="application">
    <div class="application-top">
        <p class="application-company">$company</p>
        <p class="application-position">$position</p>
        <p class="application-due-date"><strong>Due: </strong>$due_date</p>
    </div>
    <div class="application-extra">
        <p class="application-description">$description</p>
        <div class="application-bottom">
            <p class="application-email">$contact_email</p>
            <p class="application-phone">$contact_number</p>
            <p class="application-start-date"><strong>Started: </strong>$start_date</p>
        </div>
    </div>
</div>
EOT;
                    $applications .= $application;
                }
            }
        }

        else {
            $username .= " failed!";
        }

        $body = <<<EOPAGE
<div id="home">
    <div id="nav">
        <img src="default-avatar.png" id="avatar">
        <p>$username</p>
    </div>
    <div id="main">
        <div id="top">
            <h1 id="main-header">Applications</h1>
            <button id="add">New</button>
        </div>
        <div id="applications">
            $applications
        </div>
    </div>
</div>
EOPAGE;
    } 
    echo createHome($body);

    function connectToDB($host, $user, $password, $database) {
        $db = mysqli_connect($host, $user, $password, $database);
        if (mysqli_connect_errno()) {
            echo "Connect failed.\n".mysqli_connect_error();
            exit();
        }
        return $db;
    }
?>