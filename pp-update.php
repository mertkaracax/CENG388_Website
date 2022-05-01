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





$conn->close();

$target_dir = "profile-photos/";
$target_file = $target_dir . $user . ".png";
$uploadOk = 1;
$imageFileType = strtolower(pathinfo($target_file,PATHINFO_EXTENSION));

  // Check if image file is a actual image or fake image
if(isset($_POST["submit"])) {
    $check = getimagesize($_FILES["fileToUpload"]["tmp_name"]);
    if($check !== false) {
      echo "File is an image - " . $check["mime"] . ".";
      $uploadOk = 1;
    } else {
      echo "File is not an image.";
      $uploadOk = 0;
    }

  // Check if file already exists
  // if (file_exists($target_file)) {
  //   echo "Sorry, file already exists.";
  //   $uploadOk = 0;
  // }

  // Check file size
  // if ($_FILES["fileToUpload"]["size"] > 500000) {
  //   echo "Sorry, your file is too large.";
  //   $uploadOk = 0;
  // }

  // Allow certain file formats
  if($imageFileType != "jpg" && $imageFileType != "png" && $imageFileType != "jpeg"
  && $imageFileType != "gif" ) {
    echo "Sorry, only JPG, JPEG, PNG & GIF files are allowed.";
    $uploadOk = 0;
  }

  // Check if $uploadOk is set to 0 by an error
  if ($uploadOk == 0) {
    echo "Sorry, your file was not uploaded.";
  // if everything is ok, try to upload file
  } else {
    if (move_uploaded_file($_FILES["fileToUpload"]["tmp_name"], $target_file)) {
      echo "The file ". htmlspecialchars( basename( $_FILES["fileToUpload"]["name"])). " has been uploaded.";
    } else {
      echo "Sorry, there was an error uploading your file.";
    }
  }
}

?>
<html>
    <head>
        <title>Final Project</title>
        <link rel="stylesheet" href="styling/pp-update.css">
    </head>
    <body>
        
        <div class= 'main'>
        
            <div class= 'form-container'>
            <form method="post" enctype="multipart/form-data">
              <a href="Profile.php?username=<?= $user?>"><img src="images/back.png" alt="back.png" width="30" height="30"></a>
                <p style="margin-bottom:2%">Select image to upload:</p>
                <input class = "file-button" type="file" name="fileToUpload" id="fileToUpload">
                <button name="submit" type="submit"><span>UPDATE</span> </button> 
            </form>
                
            </div>
        </div>

      
    </body>
</html>