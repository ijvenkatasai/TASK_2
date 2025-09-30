<?php
include("database.php");
session_start();
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>EDIT POST</title>
</head>
<body>
    <h1 style="text-align: center;">MY BLOG </h1>
    <h2 style="text-align: center;">EDIT POST</h2>
    <p style="color: red;">Note:Need Post ID to edit/update.(go to view post to know the post ID).</p>
    <div>
        <form action="edit_post.php" method="POST">
            POST_ID:
            <input type="text" name="post_id">
            <br><br>
            NEW_POST_TITLE:
            <input type="text" name="newtitle">
            <br><br>
            <label for="postcontent">NEW_POST_CONTENT:</label><br>
<textarea id="content" name="newcontent" rows="10" cols="60"></textarea><br><br>
<input type="submit" name="update" value="UPDATE">
    <p style="color: red;">Note:leave empty if you don't want change else The old data will be updated with the new data. </p>

</form>
    </div>
    <a href="myblog.php"><button>Back</button></a><br>
    
</body>
</html>
<?php
if (isset($_POST["update"])) {
    $id=$_POST["post_id"];
    $title = $_POST["newtitle"];
    $content = $_POST["newcontent"];
    $conn = mysqli_connect($db_server, $db_user, $db_pass, $db_name);
    $sql = "SELECT * FROM posts WHERE id = '$id'";
    $res=mysqli_query($conn,$sql);
    if(mysqli_num_rows($res)>0){
        $title = mysqli_real_escape_string($conn, $title);
    if(!empty($title)){
       $sql = "UPDATE posts SET title = '$title'WHERE id = $id";
       mysqli_query($conn,$sql);
       echo "Title is updated!!!";
    }
    if(!empty($content)){
         $sql = "UPDATE posts SET content = '$content'WHERE id = $id";
         mysqli_query($conn,$sql);
         echo "Content is updated!!!";
    }
    }else{
        echo "Post Not found!!!";
    }
    header("refresh:2; url=myblog.php");

        mysqli_close($conn);
    }
    
?>
