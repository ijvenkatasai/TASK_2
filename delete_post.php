<?php
include("database.php");
session_start();
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>DELETE POST</title>
</head>
<body>
    <h1 style="text-align: center;">MY BLOG </h1>
    <h2 style="text-align: center;">DELETE POST</h2>
    <a href="myblog.php"><button>Back</button></a>
    <br><br><br><br>
    <div>
        <form action="delete_post.php" method="POST" style="text-align: center;">
        POST_ID:
        <input type="text" name="postid">
        <input type="submit" name="delete" value="Delete"><br><br>
    
        </form>
        
    </div>
    
</body>
</html>
<?php
if (isset($_POST["delete"]))  {
    $conn = mysqli_connect($db_server, $db_user, $db_pass, $db_name);
    $post_id = mysqli_real_escape_string($conn, $_POST["postid"]);
    if(!empty($post_id)){
    $sql = "SELECT * FROM posts WHERE id = '$post_id'";
    $res = mysqli_query($conn, $sql);

    if (mysqli_num_rows($res) > 0) {
        $s = "DELETE FROM posts WHERE id = '$post_id'";
        mysqli_query($conn, $s);
        echo "Post Deleted successfully!!!";
        header("refresh:2; url=myblog.php");
    } else {
        echo "No Post Found!!!";
        header("refresh:2; url=myblog.php");
    }
}
    else{
        echo"Enter Post Id!!!";
    }
    }
    mysqli_close($conn);

?>
