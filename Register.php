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

        if (isset($_POST['phone'])){
            $ph = $_POST['phone'];
            $us = $_POST['username'];
            $psw = $_POST['password'];
            $sql = "SELECT username FROM Users
            WHERE username = '$us'";
            $result = mysqli_query($conn, $sql);
            if (mysqli_num_rows($result) > 0) {
                echo "<script> alert('Username already exists') </script>";
            }
            else {
                $sql = "INSERT INTO Users (phone, username, passwordd)
                VALUES ('$ph', '$us', '$psw')";
                if ($conn->query($sql) === TRUE) {
                sleep(1.3);
                header("Location: index.php");
               
                } else {
                echo "Error: " . $sql . "<br>" . $conn->error;
                }
            }
            
            
            $conn->close();
        }


?>


<html>
    <head>
        <title>Final Project</title>
        <link rel = "stylesheet" href = "styling/register.css">
    </head>
    <body>
        
        
        <div class= 'main'>
            <div class= 'form-container'>
                
                <form  method="post">
                <a href="index.php"><img src="images/back.png" alt="back.png" width="30" height="30"></a>
                    <div class="container">
                        <input type="text" placeholder="Phone" name="phone" required>
                        <input type="text" placeholder="Username" name="username" required>
                        <input type="password" placeholder="Password" name="password" required>
                        <button type="submit"><span>SAVE</span> </button>    
                    </div>
                </form>
                <img class="iyte" src="images/iyte.png" alt="iyte amblem">
                <p style="position:absolute; bottom: 5px; font-size: 12px; font-family: 'Courier New', Courier, monospace;">MERT KARACA <br> 260201055 </p>
            </div>
        </div>

      
    </body>
 
</html>
