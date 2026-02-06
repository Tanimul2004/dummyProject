<?php
session_start();
include "../config/db.php";

if (isset($_POST['register'])) {
  $name = $_POST['name'];
  $email = $_POST['email'];
  $pass = password_hash($_POST['password'], PASSWORD_DEFAULT);

  $check = mysqli_query($conn, "SELECT * FROM users WHERE email='$email'");
  if (mysqli_num_rows($check) > 0) {
    $error = "Email already exists!";
  } else {
    mysqli_query($conn,
      "INSERT INTO users (name,email,password) VALUES ('$name','$email','$pass')"
    );
    header("Location: login.php");
  }
}
?>

<?php include "../includes/header.php"; ?>

<section class="min-h-screen flex items-center justify-center">
  <form method="POST"
    class="bg-zinc-800 p-8 rounded-xl w-full max-w-md shadow-lg">

    <h2 class="text-3xl font-bold text-center mb-6">Create Account</h2>

    <?php if(isset($error)) echo "<p class='text-red-400 mb-3'>$error</p>"; ?>

    <input type="text" name="name" placeholder="Full Name"
      class="w-full p-3 mb-3 rounded bg-zinc-900" required>

    <input type="email" name="email" placeholder="Email"
      class="w-full p-3 mb-3 rounded bg-zinc-900" required>

    <input type="password" name="password" placeholder="Password"
      class="w-full p-3 mb-4 rounded bg-zinc-900" required>

    <button name="register"
      class="w-full bg-purple-600 py-3 rounded hover:bg-purple-700">
      Register
    </button>

    <p class="text-center text-sm mt-4">
      Already have an account?
      <a href="login.php" class="text-purple-400">Login</a>
    </p>
  </form>
</section>

<?php include "../includes/footer.php"; ?>
