<?php
session_start();
if (!isset($_SESSION['user_id'])) {
  header("Location: ../auth/login.php");
  exit;
}
include "../config/db.php";
include "../includes/header.php";
?>

<?php
// auth + db + header already included above

if (isset($_POST['submit'])) {
  $title = $_POST['title'];
  $desc = $_POST['description'];
  $location = $_POST['location'];
  $category = $_POST['category'];
  $user_id = $_SESSION['user_id'];

  $imgName = null;
  if (!empty($_FILES['image']['name'])) {
    $imgName = time() . "_" . $_FILES['image']['name'];
    move_uploaded_file(
      $_FILES['image']['tmp_name'],
      "../assets/images/items/" . $imgName
    );
  }

  $sql = "INSERT INTO items 
  (user_id, category_id, type, title, description, location, image) 
  VALUES 
  ('$user_id','$category','lost','$title','$desc','$location','$imgName')";

  mysqli_query($conn, $sql);
  echo "<p class='text-green-400 text-center mt-4'>Lost item submitted for admin review.</p>";
}
?>

<section class="max-w-xl mx-auto mt-10 bg-zinc-800 p-6 rounded-xl">
  <h2 class="text-2xl font-bold mb-4">Report Lost Item</h2>

  <form method="POST" enctype="multipart/form-data" class="space-y-4">

    <input type="text" name="title" placeholder="Item Title"
      class="w-full p-3 rounded bg-zinc-900" required>

    <textarea name="description" placeholder="Item Description"
      class="w-full p-3 rounded bg-zinc-900" required></textarea>

    <input type="text" name="location" placeholder="Where it was lost"
      class="w-full p-3 rounded bg-zinc-900" required>

    <select name="category" class="w-full p-3 rounded bg-zinc-900" required>
      <option value="">Select Category</option>
      <?php
      $cats = mysqli_query($conn, "SELECT * FROM categories");
      while ($c = mysqli_fetch_assoc($cats)) {
        echo "<option value='{$c['id']}'>{$c['name']}</option>";
      }
      ?>
    </select>

    <input type="file" name="image" class="w-full text-sm">

    <button name="submit"
      class="w-full bg-purple-600 py-3 rounded hover:bg-purple-700">
      Submit Lost Item
    </button>
  </form>
</section>

<?php include "../includes/footer.php"; ?>
