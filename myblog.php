<?php
include("database.php");
session_start();
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>MY BLOG</title>
</head>
<body>
    <h1 style="text-align: center;">MY BLOG </h1>
    <h2><b><p><?php echo "Welcome ",$_SESSION["username"],",";?></p></b></h2>
    <div style="text-align: center;">
        <a href="create_post.php">CREATE POST</a><br><br>
        <a href="view_post.php">VIEW POST</a><br><br>
        <a href="edit_post.php">EDIT POST</a><br><br>
        <a href="delete_post.php">DELETE POST</a><br><br>
        <a href="index.php" >LOG OUT</a><br>
    </div>
</body>
</html>
<?php

?>