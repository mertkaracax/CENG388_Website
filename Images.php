<?php
     $url = $_SERVER['REQUEST_URI'];
     $url_components = parse_url($url);
     // Use parse_str() function to parse the
     // string passed via URL
     parse_str($url_components['query'], $params);
     // Display result
     $us = $params['username'];

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
        <link rel="stylesheet" href="styling/images.css">
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
                <div>
                <?php 
                    if (file_exists($us)) {
                        $files = scandir($us);
                        foreach ($files as $file) {
                            if ($file != '.' && $file != '..' ) {
                                echo "<img class='mid-img' src='$us/$file'> </img>";
                            }
                        }
                    }
                    else {
                        echo "You haven't shared a photo yet";
                    }
                    
                    
                ?>
                </div>
                
                <a href="Profile.php?username=<?=$us?>" style="cursor: pointer; margin-top: 2%; text-decoration: none" class = "info-photo">
                    <p class = "p-info" style = "color: white">Back </p>
                </a>  
       
  
                
                
        </div>
        
        
    </pody>
</html>