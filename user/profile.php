<?php
session_start();
if (!isset($_SESSION['user_id'])) {
  header("Location: ../auth/login.php");
  exit;
}
include "../config/db.php";
include "../includes/header.php";

$uid = $_SESSION['user_id'];
$user = mysqli_fetch_assoc(mysqli_query($conn,
  "SELECT * FROM users WHERE id='$uid'"));
?>

<section class="max-w-xl mx-auto mt-10 bg-zinc-800 p-6 rounded-xl text-center">
  <img src="../assets/images/users/<?= $user['image']; ?>"
    class="w-32 h-32 rounded-full mx-auto mb-4">

  <h2 class="text-2xl font-bold"><?= $user['name']; ?></h2>
  <p><?= $user['email']; ?></p>
  <p><?= $user['phone']; ?></p>

  <a href="edit-profile.php"
    class="inline-block mt-4 bg-blue-600 px-6 py-2 rounded">
    Edit Profile
  </a>
</section>

<?php include "../includes/footer.php"; ?>
