<?php
session_start();
include "config/db.php";

$item_id = $_GET['id'] ?? null;

// If not logged in → force login
if (!isset($_SESSION['user_id'])) {
    header("Location: auth/login.php");
    exit;
}

// Fetch item
$item = mysqli_fetch_assoc(
    mysqli_query($conn, "SELECT * FROM items WHERE id='$item_id'")
);

if (!$item || $item['status'] != 'approved') {
    die("Invalid or unavailable item.");
}

// Submit claim
if (isset($_POST['submit'])) {
    $message = $_POST['message'];
    $proof = $_POST['proof'];
    $user_id = $_SESSION['user_id'];

    mysqli_query($conn, "
    INSERT INTO claims (item_id, user_id, claim_message, proof_details)
    VALUES ('$item_id','$user_id','$message','$proof')
  ");

    echo "<p class='text-green-400 text-center mt-4'>
    Claim submitted successfully. Admin will review.
  </p>";
}
?>

<?php include "includes/header.php"; ?>

<section class="max-w-xl mx-auto mt-10 bg-zinc-800 p-6 rounded-xl">
    <h2 class="text-2xl font-bold mb-2">Claim Item</h2>
    <p class="text-zinc-400 mb-4">
        Item: <b><?= $item['title'] ?></b>
    </p>

    <form method="POST" class="space-y-4">

        <textarea name="message"
            placeholder="Explain why this item belongs to you"
            class="w-full p-3 rounded bg-zinc-900"
            required></textarea>

        <textarea name="proof"
            placeholder="Any proof details (marks, serial no, etc.)"
            class="w-full p-3 rounded bg-zinc-900"
            required></textarea>

        <button name="submit"
            class="w-full bg-emerald-600 py-3 rounded hover:bg-emerald-700">
            Submit Claim
        </button>
    </form>
</section>

<?php include "includes/footer.php"; ?>