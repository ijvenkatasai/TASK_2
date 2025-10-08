<?php
session_start();
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Index</title>
</head>
<style>
    body {
      background-color: #2c2c2c;
      color: #e0e0e0;
      
      margin: 0;
      padding: 0;
    }

.top-right {
  position: absolute;
  top: 20px;
  right: 20px;
}

.btn {
  background-color: #4681f4;
  color: white;
  border: none;
  padding: 10px 20px;
  margin-left: 10px;
  border-radius: 5px;
  cursor: pointer;
}
.btn:hover {
  background-color: #3a6edc;
}
h1 {
      text-align: center;
      color: #F2BFA4;
      margin-top: 40px;
      font-size: 3rem;
    }
</style>
<body>
  <h1 >MY BLOG</h1>

  <div class="top-right">
    <a href="loginpage.php"><button class="btn">LOGIN</button></a>
    <a href="register.php"><button class="btn">REGISTER</button></a>
  </div>

  <p style="text-align: center; font-size: 18px; margin-top: 80px;">
    Welcome to <strong>My Blog</strong> — a space where ideas come alive! Whether you're here to share your thoughts, explore new perspectives, or simply enjoy a good read, you've found the right place. Dive into posts, connect with others, and make your voice heard. Let's build something meaningful together.

  </p>
</body>

</html>
