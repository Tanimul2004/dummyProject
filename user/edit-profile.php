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

if (isset($_POST['update'])) {
  $name = $_POST['name'];
  $phone = $_POST['phone'];

  if (!empty($_FILES['image']['name'])) {
    $image = time().'_'.$_FILES['image']['name'];
    move_uploaded_file($_FILES['image']['tmp_name'],
      "../assets/images/users/".$image);

    mysqli_query($conn,
      "UPDATE users SET name='$name', phone='$phone', image='$image' WHERE id='$uid'");
  } else {
    mysqli_query($conn,
      "UPDATE users SET name='$name', phone='$phone' WHERE id='$uid'");
  }

  header("Location: profile.php");
}
?>

<section class="max-w-xl mx-auto mt-10 bg-zinc-800 p-6 rounded-xl">
  <h2 class="text-2xl font-bold mb-4">Edit Profile</h2>

  <form method="POST" enctype="multipart/form-data" class="space-y-4">
    <input name="name" value="<?= $user['name']; ?>"
      class="w-full p-3 bg-zinc-900 rounded" required>

    <input name="phone" value="<?= $user['phone']; ?>"
      class="w-full p-3 bg-zinc-900 rounded">

    <input type="file" name="image">

    <button name="update"
      class="w-full bg-green-600 py-3 rounded">
      Update Profile
    </button>
  </form>
</section>

<?php include "../includes/footer.php"; ?>
