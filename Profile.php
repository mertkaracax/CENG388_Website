<?php
     $url = $_SERVER['REQUEST_URI'];
     $url_components = parse_url($url);
     // Use parse_str() function to parse the
     // string passed via URL
     parse_str($url_components['query'], $params);
     // Display result
     $us = $params['username'];

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
                        $sql = "SELECT username, phone FROM Users
                        WHERE username = '$us'";
                        $result = mysqli_query($conn, $sql);
                        if (mysqli_num_rows($result) > 0) {
                                $row = mysqli_fetch_assoc($result);
                                $phone = $row['phone'];
                        }
    $path = "";
    if (file_exists("profile-photos/$us.png")){
       $path = "profile-photos/$us.png";
    }
    else {
        $path = "images/avatar.png";
    }
?>

<html>
    <head>
        <title>HomePage</title>
        <link rel="stylesheet" href="styling/profile.css">
    </head>
    <pody>
        <div class= 'main'>
            <div class= 'home-container'>
                <nav>
                    <a class = "nav-a" href="" style="background-color:white"><p style="color:black"p>@<?=strtoupper($params['username'])?></p></a>
                    <a class = "nav-a" href="Homee.php?username=<?=$params['username']?>" ><p>Home</p></a>
                    <a class = "nav-a" href="Message.php?username=<?=$params['username']?>"><p>Post</p></a>
                    <a class = "nav-a" href='Update.php?username=<?=$params['username']?>'><p>Upload Image</p></a>
                    <a class = "nav-a" href="index.php"><p>Log out</p></a>
                </nav>
                <div class='profile-photo-container'>
                    <img class="avatar" src= <?= $path ?> alt="avatar">
                    <a href = "pp-update.php?username=<?=$params['username']?>"><img class = "edit" src="images/edit.png" alt=""> </a>
                </div>
                
                <div class = "info">
                    <p class = "p-info">Username: </p>
                    <p class = "p-info"><b><?= $us ?></b> <a  href="us-update.php?username=<?=$params['username']?>"> <img class = "mini-img" src="images/edit.png" alt=""> </a></p>
                </div>
                <div class = "info">
                    <p class = "p-info">Phone: </p>
                    <p class = "p-info"><b><?=$phone ?></b><a  href="ph-update.php?username=<?=$params['username']?>&phone=<?=$phone?>"> <img class = "mini-img" src="images/edit.png" alt=""> </a></p>      
                </div>
                
                <a href="Images.php?username=<?=$us?>" style="cursor: pointer;text-decoration: none" class = "info-photo">
                    <p class = "p-info" style = "color: white">My Images </p>
                </a>  
       
  
                
                
        </div>
        
        
    </pody>
</html>