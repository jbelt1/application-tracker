<?php
    session_start();
 
    require_once('home-helper.php');
    $body = "<h1 id=\"error\">You need to login or regist first!</h1>";
    $applications = "";

    $avatar = "<img src=\"default-avatar.png\" id=\"avatar\" />";

    if (isset($_SESSION['username'])) {
        $username = $_SESSION['username'];
        
        $host = "localhost";
	    $user = "root";
	    $password = "";
	    $database = "application_tracker";
        $applications_table = "applications";
        $users_table = "users";

	    $db_connection = new mysqli($host, $user, $password, $database);
	
        $sqlQuery1 = sprintf("select * from $applications_table where username = '%s'", $username);
        $result1 = $db_connection->query($sqlQuery1);

        $sqlQuery2 = sprintf("select (avatar) from $users_table where username = '%s'", $username);
        $result2 = $db_connection->query($sqlQuery2);

        if ($result1) {
            $numRows1 = $result1->num_rows;
            if ($numRows1==0) {
                $applications = "<h2 id=\"empty\">No applications yet!</h2>";
            }
            else {
                while ($recordArray = $result1->fetch_array(MYSQLI_ASSOC)) {
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

        if ($result2) {
            $numRows2 = $result2->num_rows;
            $recordArray = $result2->fetch_array(MYSQLI_ASSOC);
            
            $avatar_img = $recordArray['avatar'];
            if ($avatar_img) {
                $avatar = "<img src=\"getAvatar.php?username=$username\" id=\"avatar\" />";
            }
            else {
                $avatar = "<img src=\"default-avatar.png\" id=\"avatar\" />";
            }
        }

        $body = <<<EOPAGE
<div id="home">
    <div id="nav">
        $avatar
        <form action="home.php" method="get">
            <input type="submit" value="$username" name="home" id="home-link"/>
        </form>
    </div>
    <div id="profile-edit">
        <div id="profile-edit-container">
            <form action="profile-edit.php" method="get">
                <input type="submit" class="edit-submit" value="Edit Profile" name="edit-profile" id="edit-profile"/>
            </form>
            <form action="logout.php" method="post">
                <input type="submit" class="edit-submit" value="Logout" name="logout" id="logout"/>
            </form>
        </div>
    </div>
    <div id="main">
        <div id="top">
            <h1 id="main-header">Applications</h1>
            <form action="formSubmission.html">
                <button id="add">New</button>
            </form>
        </div>
        <div id="applications">
            $applications
        </div>
    </div>
</div>
EOPAGE;
    } 

    $db_connection->close();
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