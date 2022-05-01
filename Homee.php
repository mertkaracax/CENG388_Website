<?php
     $url = $_SERVER['REQUEST_URI'];
     $url_components = parse_url($url);
     // Use parse_str() function to parse the
     // string passed via URL
     parse_str($url_components['query'], $params)
     // Display result
?>

<html>
    <head>
        <title>HomePage</title>
        <link rel="stylesheet" href="styling/home.css">
    </head>
    <pody>
        <div class= 'main'>
            <div class= 'home-container'>
                <nav>
                    <a href="Profile.php?username=<?=$params['username']?>"><p>@<?=strtoupper($params['username'])?></p></a>
                    <a href="" style="background-color:white"><p style="color:black">Home</p></a>
                    <a href="Message.php?username=<?=$params['username']?>"><p>Post</p></a>
                    <a href='Update.php?username=<?=$params['username']?>'><p>Upload Image</p></a>
                    <a href="index.php"><p>Log out</p></a>
                </nav>
                <div class="messages-container">
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
                    $sql = "SELECT username, messagee, datee FROM Messages;";
                    $result = mysqli_query($conn, $sql);
                    if (mysqli_num_rows($result) > 0) {
                        while($row = mysqli_fetch_assoc($result)) {
                            $name = $row['username'] ;
                            $msj = $row['messagee'];
                            $tarih = $row['datee'];
                            if (file_exists("profile-photos/$name.png")){
                                $path = "profile-photos/$name.png";
                             }
                             else {
                                 $path = "images/avatar.png";
                             }
                            echo "<div class = 'listItem'>
                                <p class='li-p'>$msj</p>
                                <div class = 'info'> 
                                    <img class = 'mini-pp' src='$path'></img>
                                    <div class='p-container'>
                                        <p class = 'mini-name'><b>$name</b></p>
                                        <p class = 'mini-date'>$tarih</p>
                                    </div>
                                </div>
                             </div> ";
                        }
                    } else {
                      echo "0 results";
                    }

                ?>    
                </div>
            </div>
        </div>
        
        
    </pody>
</html>