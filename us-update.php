<?php
//LOCAL
// $servername = "localhost";
// $username = "Mert";
// $password = "x";
// $dbname = "FinalHW";
// // Create connection
// $conn = mysqli_connect($servername, $username, $password, $dbname);

//HEROKU
$cleardb_url = parse_url(getenv("CLEARDB_DATABASE_URL"));
$cleardb_server = $cleardb_url["host"];
$cleardb_username = $cleardb_url["user"];
$cleardb_password = $cleardb_url["pass"];
$cleardb_db = substr($cleardb_url["path"],1);
$active_group = 'default';
$query_builder = TRUE;
// Connect to DB
$conn = mysqli_connect($cleardb_server, $cleardb_username, $cleardb_password, $cleardb_db);

// Check connection
if (!$conn) {
  die("Connection failed: " . mysqli_connect_error());
}
echo "<script>console.log('Debug Objects: " . "MYSQL Connected successfully" . "' );</script>";

$url = $_SERVER['REQUEST_URI'];
     $url_components = parse_url($url);
     // Use parse_str() function to parse the
     // string passed via URL
     parse_str($url_components['query'], $params);
     // Display result
     $user = $params['username'];

if (isset($_POST['username'])){
    $us = $_POST['username'];
    $sql = "UPDATE Users SET username='$us' WHERE username='$user'";
    $result = mysqli_query($conn, $sql);
    header("Location: Profile.php?username=$us");
    
};




$conn->close();
?>
<html>
    <head>
        <title>Final Project</title>
        <link rel="stylesheet" href="styling/us-update.css">
    </head>
    <body>
        
        <div class= 'main'>
        
            <div class= 'form-container'>
                <form method="post">
                <a href="Profile.php?username=<?= $user?>"><img src="images/back.png" alt="back.png" width="30" height="30"></a>
                    <div class="container">
                        <p>Current username: <b><?= $user ?></b></p>
                        <input type="text" placeholder="New Username" name="username" required>
                        <button type="submit"><span>UPDATE</span> </button>     
                    </div>

                </form>
                
            </div>
        </div>

      
    </body>
</html>