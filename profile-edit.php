<?php
    session_start();
    require_once('profile-edit-helper.php');

    $avatar = "<img src=\"default-avatar.png\" id=\"avatar\" />";
    $big_avatar = "<img src=\"default-avatar.png\" id=\"big-avatar\" />";
    $edit_error = "";
    if (isset($_SESSION['username'])) {
        $username = $_SESSION['username'];
        
        $host = "localhost";
	    $user = "root";
	    $password = "";
	    $database = "application_tracker";
        $applications_table = "applications";
        $users_table = "users";

	    $db_connection = new mysqli($host, $user, $password, $database);

        $sqlQuery = sprintf("select (avatar) from $users_table where username = '%s'", $username);
        $result = $db_connection->query($sqlQuery);

        if ($result) {
            $numRows = $result->num_rows;
            $recordArray = $result->fetch_array(MYSQLI_ASSOC);
            
            $avatar_img = $recordArray['avatar'];
            if ($avatar_img) {
                $avatar = "<img src=\"getAvatar.php?username=$username\" id=\"avatar\" />";
                $big_avatar = "<img src=\"getAvatar.php?username=$username\" id=\"big-avatar\" />";
            }
            else {
                $avatar = "<img src=\"default-avatar.png\" id=\"avatar\" />";
                $big_avatar = "<img src=\"default-avatar.png\" id=\"big-avatar\" />";
            }
        }

        $body = <<<EOPAGE
<div id="profile-edit-page">
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
        <div id="edit">
            $big_avatar
            <h1 align="center">Update</h1>
            <form action="edit.php" id="edit-form" method="post" enctype="multipart/form-data">
                <div id="edit-form-container">
                    <strong>Avatar: </strong><input type="file" id="avatar-input" name="avatar-input" accept="image/jpeg">
                    <input type="submit" value="Update" id="edit-form-submit" >
                </div>
            </form>
            <p id="editError">
                $edit_error
            </p>
        </div>
            </form
        </div>
    </div>
</div>
EOPAGE;
    } 
    $db_connection->close();
    echo createEdit($body);

    function connectToDB($host, $user, $password, $database) {
        $db = mysqli_connect($host, $user, $password, $database);
        if (mysqli_connect_errno()) {
            echo "Connect failed.\n".mysqli_connect_error();
            exit();
        }
        return $db;
    }
?>