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
    
    if (isset($_POST['username'])){
        $us = $_POST['username'];
        $psw = $_POST['password'];
        $sql = "SELECT username, passwordd FROM Users
        WHERE username = '$us' AND passwordd = '$psw'";
        $result = mysqli_query($conn, $sql);
    
        if (mysqli_num_rows($result) > 0) {
            sleep(1);
            $file = fopen("logs.txt", "a") or die("Unable to open file!");
            $txt = "[". $us . "] " .date("F j, Y, g:i a") . "\n";
            fwrite($file, $txt);
            fclose($file);
            $row = mysqli_fetch_assoc($result);
            printf("%s %s",$row['username'] ,$row['passwordd']);
            header("Location: Homee.php?username=$us");
        } else {
            echo "<script>alert('Wrong username or password.');</script>";
        }
    }
    
    
    $conn->close();
?>
<html>
    <head>
        <title>Final Project</title>
        <link rel="stylesheet" href="styling/index.css">
    </head>
    <body>
        
        <div class= 'main'>
                
            <div class= 'form-container'>
                
               <img src="images/iyte.png" alt="iyte amblem">
                
               <a class = "register-button" href="Register.php">Register</a>
                <form method="post">
                    <div class="container">
                        <input type="text" placeholder="Username" name="username" required>
                        <input type="password" placeholder="Password" name="password" required>
                        <button type="submit"><span>LOGIN</span> </button> 
                        
                    </div>

                </form>
                <p style="position:absolute; bottom: 5px; font-size: 12px; font-family: 'Courier New', Courier, monospace;">MERT KARACA <br> 260201055 </p>
            </div>
        </div>

      
    </body>
</html>