<?php
// auth + db + header
session_start();
if (!isset($_SESSION['user_id'])) {
    header("Location: ../auth/login.php");
    exit;
}
include "../config/db.php";
include "../includes/header.php";
$user_id = $_SESSION['user_id'];

$result = mysqli_query(
    $conn,
    "SELECT * FROM items WHERE user_id='$user_id' ORDER BY created_at DESC"
);
?>

<section class="max-w-6xl mx-auto mt-10">
    <h2 class="text-2xl font-bold mb-4">My Items</h2>

    <div class="grid md:grid-cols-3 gap-6">
        <?php while ($row = mysqli_fetch_assoc($result)) { ?>
            <div class="bg-zinc-800 p-4 rounded">
                <img src="../assets/images/items/<?= $row['image'] ?>" class="rounded mb-2">
                <h3 class="font-semibold"><?= $row['title'] ?></h3>
                <p class="text-sm text-zinc-400">Status: <?= $row['status'] ?></p>
            </div>
        <?php } ?>
    </div>
</section>

<?php include "../includes/footer.php"; ?>