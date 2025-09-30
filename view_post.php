<?php
include("database.php");
session_start();
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>VIEW POST</title>
</head>
<body>
    <h1 style="text-align: center;">MY BLOG </h1>
    <h2 style="text-align: center;">POSTS</h2>
    <a href="myblog.php"><button>BACK</button></a><br><br>
    <?php
$conn=mysqli_connect($db_server,$db_user,$db_pass,$db_name);
$user_id = mysqli_real_escape_string($conn, $_SESSION["username"]);
$sql = "SELECT * FROM posts WHERE user_id = '$user_id'";
$res=mysqli_query($conn,$sql);
if(mysqli_num_rows($res)>0){
            while ($row = mysqli_fetch_assoc($res)) {
            echo "Post_id: " . $row["id"] . "<br>";
            echo "Title: " . htmlspecialchars($row["title"]) . "<br>";
            echo "Content: " . nl2br(htmlspecialchars($row["content"])) . "<br>";
            echo "Created_at: " . $row["created_at"] . "<br><br>";
        }


}else{
    echo "No Posts found!!!";
}

?>

</body>
</html>
