<?php

include "conn.php";

if (isset($_POST['login'])) {
  $username = $_POST['username'];
  $password = $_POST['password'];

  $query = mysqli_query($conn, "SELECT * FROM tb_login WHERE username = '$username' AND password = '$password'");

  if (mysqli_num_rows($query) > 0) {
    session_start();
    $_SESSION['login'] = TRUE;
    $_SESSION['username'] = $username;
    header("Location: index.php");
  } else {
    header("Location: login.php");
  }
}

include "../components/header.php";
?>

<div class="container-fluid mt-5 pb-5">
  <h1>Login</h1>
  <form action="login.php" method="post">
    <div class="mb-3">
      <label class="form-label">Username</label>
      <input type="text" name="username" class="form-control">
    </div>
    <div class="mb-3">
      <label class="form-label">Password</label>
      <input type="password" name="password" class="form-control">
    </div>
    <button type="submit" name="login" class="btn btn-primary">Submit</button>
  </form>
</div>
<?php include "../components/footer.php";
