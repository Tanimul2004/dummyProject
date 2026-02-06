<?php
session_start();
if (!isset($_SESSION['user_id'])) {
  header("Location: ../auth/login.php");
  exit;
}
include "../config/db.php";
include "../includes/header.php";

if (isset($_POST['submit'])) {
  $user_id = $_SESSION['user_id'];
  $title = $_POST['title'];
  $description = $_POST['description'];
  $location = $_POST['location'];
  $category = $_POST['category'];

  $image = null;
  if (!empty($_FILES['image']['name'])) {
    $image = time().'_'.$_FILES['image']['name'];
    move_uploaded_file($_FILES['image']['tmp_name'], "../assets/images/items/".$image);
  }

  mysqli_query($conn, "
    INSERT INTO items 
    (user_id, category_id, type, title, description, location, image)
    VALUES
    ('$user_id','$category','lost','$title','$description','$location','$image')
  ");

  echo "<p class='text-green-400 text-center mt-4'>
        Lost device information submitted.
        </p>";
}
?>

<section class="max-w-xl mx-auto mt-10 bg-zinc-800 p-6 rounded-xl">
  <h2 class="text-2xl font-bold mb-4">Post a LOST Device</h2>

  <form method="POST" enctype="multipart/form-data" class="space-y-4">
    <input name="title" placeholder="Device name (e.g. Samsung A51)"
      class="w-full p-3 bg-zinc-900 rounded" required>

    <textarea name="description" placeholder="Describe your device clearly"
      class="w-full p-3 bg-zinc-900 rounded" required></textarea>

    <input name="location" placeholder="Where you lost it"
      class="w-full p-3 bg-zinc-900 rounded" required>

    <select name="category" class="w-full p-3 bg-zinc-900 rounded" required>
      <option value="">Select Category</option>
      <?php
      $cats = mysqli_query($conn,"SELECT * FROM categories");
      while($c=mysqli_fetch_assoc($cats)){
        echo "<option value='{$c['id']}'>{$c['name']}</option>";
      }
      ?>
    </select>

    <input type="file" name="image">

    <button name="submit"
      class="w-full bg-purple-600 py-3 rounded hover:bg-purple-700">
      Submit Lost Device
    </button>
  </form>
</section>

<?php include "../includes/footer.php"; ?>
