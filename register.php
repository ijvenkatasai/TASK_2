<?php
include("database.php");
session_start();
?>
<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <title>REGISTER</title>
  <style>
    body {
      background-color: #2c2c2c;
      color: #e0e0e0;
      margin: 0;
      padding: 0;
    }

    h1 {
      text-align: center;
      color: #F2BFA4;
      margin-top: 40px;
      
    }

    a {
      color: #4681f4;
      text-decoration: none;
      font-weight: bold;
    }

    a:hover {
      color: #3a6edc;
      text-decoration: underline;
    }

    .form-container {
      background-color: #3a3a3a;
      max-width: 400px;
      margin: 40px auto;
      padding: 30px;
      border-radius: 10px;
      box-shadow: 0 0 10px rgba(0,0,0,0.5);
    }

    h2 {
      color: #F2BFA4;
      margin-bottom: 20px;
      text-align: center;
    }

    label {
      display: block;
      margin-top: 15px;
      font-weight: bold;
    }

    input[type="text"],
    input[type="password"] {
      width: 90%;
      padding: 10px;
      margin-top: 5px;
      border: none;
      border-radius: 5px;
      background-color: #e0e0e0;
      color: #333;
    }

    input[type="submit"] {
      background-color: #4681f4;
      color: white;
      border: none;
      padding: 10px 20px;
      margin-top: 20px;
      border-radius: 6px;
      cursor: pointer;
      font-weight: bold;
      transition: background-color 0.3s ease, transform 0.2s ease;
    }

    input[type="submit"]:hover {
      background-color: #3a6edc;
      transform: scale(1.05);
      align-items: center;
    }
    .submit-wrapper {
  text-align: center;
  margin-top: 20px;
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
  </style>
</head>
<body>
  <h1>MY BLOG</h1>
  <div style="text-align: center; margin-top: 10px;">
    <a href="index.php">HOME</a>
  </div>

  <div class="form-container">
    <h2>REGISTER</h2>
    <form action="register.php" method="post">
      <label>USERNAME:</label>
      <input type="text" name="username">

      <label>CREATE PASSWORD:</label>
      <input type="password" name="password">

      <label>CONFIRM PASSWORD:</label>
      <input type="password" name="confirmpassword">

      <div class="submit-wrapper">
  <input type="submit" name="submit" value="Submit">
</div>

    </form>
  </div>
</body>
</html>
<?php
if (isset($_POST["submit"])) {
    if (empty($_POST["username"]) || empty($_POST["password"])) {
        echo '<div class="error">Enter Username/password !!!</div>';
    } elseif ($_POST["password"] != $_POST["confirmpassword"]) {
        echo '<div class="error">Password and confirm password should be same!!!</div>';
    } else {
        try{
             $conn=mysqli_connect($db_server,$db_user,$db_pass,$db_name);
    
        $username = mysqli_real_escape_string($conn, $_POST["username"]);
        $password = $_POST["password"];
        $pass = password_hash($password, PASSWORD_DEFAULT);

        $sql = "INSERT INTO users (username, password) VALUES ('$username', '$pass')";

        mysqli_query($conn,$sql);
        echo '<div class="message">Registered successfully!!!</div>'; 
        header("refresh:2; url=loginpage.php");
        }catch(mysqli_sql_exception){
            echo '<div class="error">Username is Already taken!!!</div>';
        }
    }
}
?>
