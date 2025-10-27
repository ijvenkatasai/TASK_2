<?php
include("database.php");
session_start(); 
if (!isset($_SESSION["username"]) || $_SESSION["role"] !== "admin") {
    header("Location: admin.php");
    exit();
}

?>
<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8" />
  <meta name="viewport" content="width=device-width, initial-scale=1.0" />
  <title>ADMIM HOME</title>
  <style>
    body {
      background-color: #1e1e1e;
      color: #e0e0e0;
      margin: 0;
      padding: 0;
    }
    h1 {
      text-align: center;
      color: #F2BFA4;
      margin-top: 40px;
    }
    .top-bar {
      display: flex;
      justify-content: flex-end;
      padding: 20px 40px;
    }
    .top-bar a {
      background-color: #4681f4;
      color: white;
      padding: 10px 20px;
      border-radius: 6px;
      text-decoration: none;
      font-weight: bold;
    }
    .top-bar a:hover {
      background-color: #3a6edc;
    }
    .post {
      background-color: #3a3a3a;
      padding: 15px;
      margin: 20px auto;
      max-width: 800px;
      border-radius: 8px;
      border-left: 5px solid #F2BFA4;
    }
    .post h3 {
      margin: 0;
      color: #F2BFA4;
    }
    .post p {
      margin: 10px 0;
      line-height: 1.5;
    }
    .edit-btn, .delete-btn {
      display: inline-block;
      margin-top: 10px;
      padding: 6px 12px;
      border-radius: 4px;
      text-decoration: none;
      font-weight: bold;
      color: white;
    }
    .edit-btn {
      background-color: #28a745;
    }
    .edit-btn:hover {
      background-color: #218838;
    }
    .delete-btn {
      background-color: #dc3545;
      margin-left: 10px;
    }
    .delete-btn:hover {
      background-color: #c82333;
    }
    .message, .error {
      text-align: center;
      font-weight: bold;
      margin-top: 20px;
    }
    .message {
      color: #28a745;
    }
    .error {
      color: #dc3545;
    }
    .pagination {
      text-align: center;
      margin-top: 20px;
    }
    .pagination a {
      color: #F2BFA4;
      margin: 0 5px;
      text-decoration: none;
      font-weight: bold;
    }
    .pagination a:hover {
      text-decoration: underline;
      color: #fff;
    }
    .pagination .current {
      color: #fff;
      font-weight: bold;
      margin: 0 5px;
    }
  </style>
</head>
<body>
  <h1>MY BLOG</h1>
  <div class="top-bar">
    <a href="index.php">Logout</a>
  </div>

  <h2 style="margin-left: 40px;"><?php echo "Welcome ", $_SESSION["username"], ","; ?></h2>

<?php
$conn = mysqli_connect($db_server, $db_user, $db_pass, $db_name);
$limit = 10;
$page = isset($_GET['page']) ? (int)$_GET['page'] : 1;
$offset = ($page - 1) * $limit;

// Handle delete request
if (isset($_GET['delete_id'])) {
  $delete_id = (int)$_GET['delete_id'];
  $delete_sql = "DELETE FROM posts WHERE id = $delete_id";
  if (mysqli_query($conn, $delete_sql)) {
    $_SESSION['message'] = "Post deleted successfully";
    header("Location: myblog.php?page=$page");
    exit();
  } else {
    echo '<div class="error">Failed to delete post.</div>';
  }
}

// Show flash message
if (isset($_SESSION['message'])) {
  echo '<div class="message" id="flash-message">' . $_SESSION['message'] . '</div>';
  unset($_SESSION['message']);
}
?>

<script>
  // Hide flash message after 60 seconds
  setTimeout(() => {
    const msg = document.getElementById('flash-message');
    if (msg) msg.style.display = 'none';
  }, 60000);
</script>

<?php
// Fetch posts
$sql = "SELECT * FROM posts ORDER BY created_at DESC LIMIT $limit OFFSET $offset";
$res = mysqli_query($conn, $sql);

if (mysqli_num_rows($res) > 0) {
  while ($row = mysqli_fetch_assoc($res)) {
    echo '<div class="post">';
    echo '<h3>' . htmlspecialchars($row["title"]) . '</h3>';
    echo '<p><strong>Post ID:</strong> ' . $row["id"] . '</p>';
    echo '<p>' . nl2br(htmlspecialchars($row["content"])) . '</p>';
    echo '<p><em>Created at: ' . $row["created_at"] . '</em></p>';
    echo '<p><strong>Author:</strong> ' . $row["user_id"] . '</p>';
    echo '<a class="edit-btn" href="edit_post.php?id=' . $row["id"] . '">Edit</a>';
    echo '<a class="delete-btn" href="myblog.php?delete_id=' . $row["id"] . '&page=' . $page . '" onclick="return confirm(\'Are you sure you want to delete this post?\')">Delete</a>';
    echo '</div>';
  }

  // Pagination
  $count_sql = "SELECT COUNT(*) AS total FROM posts";
  $count_res = mysqli_query($conn, $count_sql);
  $count_row = mysqli_fetch_assoc($count_res);
  $total_posts = $count_row['total'];
  $total_pages = ceil($total_posts / $limit);

  echo '<div class="pagination">';
  if ($page > 1) {
    echo '<a href="myblog.php?page=' . ($page - 1) . '">Previous</a>';
  }
  for ($i = 1; $i <= $total_pages; $i++) {
    if ($i == $page) {
      echo '<span class="current">' . $i . '</span>';
    } else {
      echo '<a href="myblog.php?page=' . $i . '">' . $i . '</a>';
    }
  }
  if ($page < $total_pages) {
    echo '<a href="myblog.php?page=' . ($page + 1) . '">Next</a>';
  }
  echo '</div>';
} else {
  echo '<div class="error">No Posts found!!!</div>';
}
?>
</body>
</html>
