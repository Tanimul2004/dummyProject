<?php
session_start();
if (!isset($_SESSION['user_id']) || $_SESSION['role'] !== 'admin') {
  header("Location: ../auth/login.php");
  exit;
}


include "../includes/auth_check.php";
include "../config/db.php";
include "../includes/header.php";

if (isset($_GET['approve'])) {
    mysqli_query($conn, "UPDATE items SET status='approved' WHERE id=" . $_GET['approve']);
}
if (isset($_GET['reject'])) {
    mysqli_query($conn, "UPDATE items SET status='rejected' WHERE id=" . $_GET['reject']);
}

$items = mysqli_query($conn, "
  SELECT items.*, users.name 
  FROM items 
  JOIN users ON items.user_id = users.id
  WHERE status='pending'
");
?>

<section class="max-w-6xl mx-auto mt-10">
    <h2 class="text-2xl font-bold mb-4">Pending Items</h2>

    <?php while ($row = mysqli_fetch_assoc($items)) { ?>
        <div class="bg-zinc-800 p-4 rounded mb-4">
            <h3 class="font-semibold"><?= $row['title'] ?></h3>
            <p class="text-sm"><?= $row['description'] ?></p>

            <a href="?approve=<?= $row['id'] ?>"
                class="px-4 py-2 bg-green-600 rounded">Approve</a>

            <a href="?reject=<?= $row['id'] ?>"
                class="px-4 py-2 bg-red-600 rounded ml-2">Reject</a>
        </div>
    <?php } ?>
</section>

<?php include "../includes/footer.php"; ?>