<?php
session_start();
if (!isset($_SESSION['user_id']) || $_SESSION['role'] !== 'admin') {
  header("Location: ../auth/login.php");
  exit;
}

include "../includes/auth_check.php";
include "../config/db.php";
include "../includes/header.php";

$items = mysqli_fetch_assoc(mysqli_query($conn,"SELECT COUNT(*) total FROM items"))['total'];
$users = mysqli_fetch_assoc(mysqli_query($conn,"SELECT COUNT(*) total FROM users"))['total'];
$claims = mysqli_fetch_assoc(mysqli_query($conn,"SELECT COUNT(*) total FROM claims"))['total'];
?>

<section class="max-w-6xl mx-auto mt-10 grid md:grid-cols-3 gap-6">
  <div class="bg-purple-700 p-6 rounded-xl text-center">
    <h2 class="text-3xl font-bold"><?= $items ?></h2>
    <p>Total Items</p>
  </div>

  <div class="bg-blue-700 p-6 rounded-xl text-center">
    <h2 class="text-3xl font-bold"><?= $users ?></h2>
    <p>Total Users</p>
  </div>

  <div class="bg-emerald-700 p-6 rounded-xl text-center">
    <h2 class="text-3xl font-bold"><?= $claims ?></h2>
    <p>Total Claims</p>
  </div>
</section>

<?php include "../includes/footer.php"; ?>
