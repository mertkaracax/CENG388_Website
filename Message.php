<?php
    $url = $_SERVER['REQUEST_URI'];
    $url_components = parse_url($url);
    // Use parse_str() function to parse the
    // string passed via URL
    parse_str($url_components['query'], $params) ;

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

    if (isset($_POST['message'])){
        $us = $params['username'];
        $msg = $_POST['message'];
        $date = date("Y-m-d H:i:s");
        $sql = "INSERT INTO Messages (username, messagee, datee)
        VALUES ('$us', '$msg', '$date')";
        if ($conn->query($sql) === TRUE) {
            sleep(1);
            header("Location: Homee.php?username=$us");
        
        } else {
          echo "Error: " . $sql . "<br>" . $conn->error;
        
        $conn->close();
        }
    }
?>
     
<html>
    <head>
        <title>HomePage</title>
        <link rel="stylesheet" href="styling/message.css">
    </head>
    <body>
        <div class= 'main'>
            <div class= 'home-container'>
                <nav>
                    <a href="Profile.php?username=<?=$params['username']?>"><p>@<?=strtoupper($params['username'])?></p></a>
                    <a href="Homee.php?username=<?=$params['username']?>"><p>Home</p></a>
                    <a href="" style="background-color:white"><p style="color:black">Post</p></a>
                    <a href="Update.php?username=<?=$params['username']?>"><p>Upload Image</p></a>
                    <a href="index.php"><p>Log out</p></a>
                </nav>
                <form method = "post">
                <p class='textarea-header'>Write about your complaint</p>
                <textarea  placeholder="placeholder" style="padding: 15px; border:2px solid black; font-size:20px;border-radius:20px;margin-top:25%" name="message" rows="10" cols="45"></textarea>
                  <button type="submit"> <span>SEND</span> </button>
                </form>   
            </div>
        </div>
        
        
    </body>
</html>