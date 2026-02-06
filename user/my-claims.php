<?php
session_start();
include "../config/db.php";
include "../includes/header.php";

$user_id = $_SESSION['user_id'];

$result = mysqli_query($conn, "
  SELECT claims.*, items.title 
  FROM claims 
  JOIN items ON claims.item_id = items.id
  WHERE claims.user_id = '$user_id'
  ORDER BY claims.created_at DESC
");
?>

<section class="max-w-6xl mx-auto mt-10">
    <h2 class="text-2xl font-bold mb-4">My Claims</h2>

    <div class="space-y-4">
        <?php while ($row = mysqli_fetch_assoc($result)) { ?>
            <div class="bg-zinc-800 p-4 rounded">
                <h3 class="font-semibold"><?= $row['title'] ?></h3>
                <p class="text-sm text-zinc-400">
                    Status: <b><?= $row['status'] ?></b>
                </p>
                <p class="text-sm mt-2"><?= $row['claim_message'] ?></p>
            </div>
        <?php } ?>
    </div>
</section>

<?php include "../includes/footer.php"; ?>