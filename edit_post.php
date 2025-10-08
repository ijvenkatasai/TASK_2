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
    <style>
        body {
            background-color: #1e1e1e;
            color: #f0f0f0;
            margin: 0;
            padding: 0;
        }

        h1, h2 {
            text-align: center;
            color: #F2BFA4;
            margin-top: 30px;
        }

        .note {
            color: #ff4d4d;
            text-align: center;
            margin-top: 10px;
            font-size: 0.95em;
        }

        .container {
            max-width: 500px;
            margin: 30px auto;
            padding: 25px;
            background-color: #2c2c2c;
            border-radius: 10px;
            color: #F2BFA4;
            box-shadow: 0 0 10px rgba(255,255,255,0.1);
        }

        label, input[type="text"], textarea {
            display: block;
            width: 100%;
            margin-bottom: 20px;
            font-size: 1em;
        }

        input[type="text"], textarea {
            padding: 10px;
            border-radius: 5px;
            border: 1px solid #000000ff;
            width: 95%;
        }

      

        input[type="submit"], button {
            background-color: #007bff;
            color: white;
            padding: 5px 10px;
            font-size: 1em;
            border: none;
            border-radius: 5px;
            font-weight: bold;
            cursor: pointer;
            transition: background-color 0.3s ease;
        }

        input[type="submit"]:hover, button:hover {
            background-color: #0056b3;
        }

        .back-button {
            margin: 20px 0 0 10px;
        }

        .message {
            text-align: center;
            font-weight: bold;
            color: #28a745;
            margin-top: 20px;
        }

        .error {
            text-align: center;
            font-weight: bold;
            color: #dc3545;
            margin-top: 20px;
        }
        .submit-button {
    text-align: center;
}
    </style>
</head>
<body>
    <h1>MY BLOG</h1>
    <h2>EDIT POST</h2>
    <div class="back-button">
        <a href="myblog.php"><button>Back</button></a>
    </div>
    <p class="note">Note: Need Post ID to edit/update. (Go to View Post to know the Post ID).</p>
    <div class="container">
        <form action="edit_post.php" method="POST">
            <label for="post_id">POST ID:</label>
            <input type="text" name="post_id" id="post_id">

            <label for="newtitle">NEW POST TITLE:</label>
            <input type="text" name="newtitle" id="newtitle">

            <label for="content">NEW POST CONTENT:</label>
            <textarea id="content" name="newcontent" rows="10"></textarea>
             <div class="submit-button">
<input type="submit" name="update" value="UPDATE">
             </div>
            
            <p class="note">Note: Leave empty if you don't want to change. Otherwise, old data will be updated.</p>
        </form>
    </div>
    
</body>
</html>

<?php
if (isset($_POST["update"])) {
    $id = $_POST["post_id"];
    $title = $_POST["newtitle"];
    $content = $_POST["newcontent"];
    $conn = mysqli_connect($db_server, $db_user, $db_pass, $db_name);
    $sql = "SELECT * FROM posts WHERE id = '$id'";
    $res = mysqli_query($conn, $sql);
    if (mysqli_num_rows($res) > 0) {
        $title = mysqli_real_escape_string($conn, $title);
        $content = mysqli_real_escape_string($conn, $content);
        if (!empty($title)) {
            $sql = "UPDATE posts SET title = '$title' WHERE id = $id";
            mysqli_query($conn, $sql);
            echo '<div class="message">Title is updated!!!</div>';
        }
        if (!empty($content)) {
            $sql = "UPDATE posts SET content = '$content' WHERE id = $id";
            mysqli_query($conn, $sql);
            echo '<div class="message">Content is updated!!!</div>';
        }
    } else {
        echo '<div class="error">Post Not found!!!</div>';
    }
    header("refresh:2; url=myblog.php");
    mysqli_close($conn);
}
?>
