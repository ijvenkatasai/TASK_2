<?php
include("database.php");
session_start();
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>REGISTER</title>
</head>
<body>
    <h1 style="text-align: center;">MY BLOG </h1>
    <a href="index.php">HOME</a>
    <br><br>
     <div class="form-container">
<h2 style="text-align: center;">REGISTER</h2>
    <form action="register.php"  method="post" style="text-align: center;">
        <b>USERNAME:   </b>
        <input type="text" name="username"><br><br>
        <b>CREATE PASSWORD:</b>
        <input type="password" name="password"><br><br>
        <b>CONFIRM PASSWORD:</b>
        <input type="password" name="confirmpassword"><br><br>
        <input type="submit" name="submit" value="submit">
    </form>
</div>
</body>
</html>
<?php
if (isset($_POST["submit"])) {
    if (empty($_POST["username"]) || empty($_POST["password"])) {
        echo "Enter Username/password !!!<br>";
    } elseif ($_POST["password"] != $_POST["confirmpassword"]) {
        echo "Password and confirm password should be same!!!<br>";
    } else {
        $conn=mysqli_connect($db_server,$db_user,$db_pass,$db_name);
        echo "Registered successfully!!!<br>";
        $username = mysqli_real_escape_string($conn, $_POST["username"]);
        $password = $_POST["password"];
        $pass = password_hash($password, PASSWORD_DEFAULT);

        $sql = "INSERT INTO users (username, password) VALUES ('$username', '$pass')";

        mysqli_query($conn,$sql); 
        header("refresh:2; url=loginpage.php");
                    
        
    }
}
?>