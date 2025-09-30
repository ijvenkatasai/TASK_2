<?php
include("database.php");
session_start();
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>CREATE POST</title>
</head>
<body>
    <h1 style="text-align: center;">MY BLOG</h1>
    <h2 style="text-align: center;">CREATE POST</h2><br>
    <a href="myblog.php"><button>Back</button></a>
    <form action="create_post.php" method="POST" style="text-align: center;">
        
        <b>TITLE:</b><br>
        <input type="text" name="title"><br><br>
        <b><label for="content">CONTENT:</label><br></b>
        <textarea id="content" name="content" rows="10" cols="60"></textarea><br><br>
        <input type="submit" name="POST" value="POST">
    </form>
</body>
</html>
<?php
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $title = $_POST["title"];
    $content = $_POST["content"];
    $user_id = $_SESSION["username"]; 

    if (empty($title)) {
        echo "Assign Title!!!";
    } else {
        $conn = mysqli_connect($db_server, $db_user, $db_pass, $db_name);
        $title = mysqli_real_escape_string($conn, $title);
        $content = mysqli_real_escape_string($conn, $content);
        $user_id = mysqli_real_escape_string($conn, $user_id);

        $sql = "INSERT INTO posts (title, content, user_id) 
                VALUES ('$title', '$content', '$user_id')";
        try{
         mysqli_query($conn, $sql);
         echo "POST Created Successfully!!!!";
        }catch(mysqli_sql_exception){
                 echo "Title is Already Taken!!!";
        }
        header("refresh:2; url=myblog.php");

        mysqli_close($conn);
    }
}
?>