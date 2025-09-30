<?php
include("database.php");
session_start(); 
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Login Page</title>
    </head>
<body>
    <h1 style="text-align: center;">MY BLOG</h1>
    <a href="index.php">HOME</a>
    <br><br>
     <div class="form-container">
<h2 style="text-align: center;">LOGIN PAGE</h2>
    <form action="loginpage.php"  method="post" style="text-align: center;">
        <b>USERNAME:</b>
        <input type="text" name="username"><br><br>
        <b>PASSWORD:</b>
        <input type="password" name="password"><br><br>
        <input type="submit" name="login" value="Login"><br>
        new user??
        <a href="register.php">Register</a>
    </form> 
    </div>
</body>
</html>
<?php
if (isset($_POST["login"])) {
    if (empty($_POST["username"]) || empty($_POST["password"])) {
        echo "Enter Username/password !!!<br>";
    } else {
        $conn=mysqli_connect($db_server,$db_user,$db_pass,$db_name);
        $user=mysqli_real_escape_string($conn, $_POST["username"]);
        $pass=$_POST["password"];
        $sql="SELECT * FROM users Where username='$user'";
        $res=mysqli_query($conn,$sql);
        if(mysqli_num_rows($res)>0){
            $row = mysqli_fetch_assoc($res);
             if(password_verify($pass, $row["password"])){
                echo "Login successful!!!";
                $_SESSION["username"] = $user;
                header("refresh:2; url=myblog.php");
            }
             else{
                echo "Incorrect Password!!!";
             }
        }
        else{
            echo "User not Found!!!";
        }
    }
}
?>
