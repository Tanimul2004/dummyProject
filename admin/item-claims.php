<?php
session_start();
if (!isset($_SESSION['user_id']) || $_SESSION['role'] !== 'admin') {
  header("Location: ../auth/login.php");
  exit;
}
include "../includes/auth_check.php";
include "../config/db.php";
include "../includes/header.php";

$item_id = $_GET['id'];

$result = mysqli_query($conn,"
  SELECT claims.*, users.name 
  FROM claims 
  JOIN users ON claims.user_id = users.id
  WHERE item_id='$item_id'
");
?>

<section class="max-w-6xl mx-auto mt-10">
<h2 class="text-2xl font-bold mb-4">Claims for Item</h2>

<?php while($row=mysqli_fetch_assoc($result)){ ?>
  <div class="bg-zinc-800 p-4 rounded mb-4">
    <h3 class="font-semibold"><?= $row['name'] ?></h3>
    <p><?= $row['claim_message'] ?></p>
    <p class="text-sm text-zinc-400"><?= $row['proof_details'] ?></p>

    <a href="approve-claim.php?id=<?= $row['id'] ?>&item=<?= $item_id ?>"
      class="px-4 py-2 bg-emerald-600 rounded mt-2 inline-block">
      Approve This Claim
    </a>
  </div>
<?php } ?>
</section>

<?php include "../includes/footer.php"; ?>
