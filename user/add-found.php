<?php
// auth + db + header
session_start();
if (!isset($_SESSION['user_id'])) {
    header("Location: ../auth/login.php");
    exit;
}
include "../config/db.php";
include "../includes/header.php";

if (isset($_POST['submit'])) {
    $title = $_POST['title'];
    $desc = $_POST['description'];
    $location = $_POST['location'];
    $found_date = $_POST['found_date'];
    $category = $_POST['category'];
    $user_id = $_SESSION['user_id'];

    $imgName = time() . "_" . $_FILES['image']['name'];
    move_uploaded_file(
        $_FILES['image']['tmp_name'],
        "../assets/images/items/" . $imgName
    );

    $sql = "INSERT INTO items 
  (user_id, category_id, type, title, description, location, found_date, image) 
  VALUES 
  ('$user_id','$category','found','$title','$desc','$location','$found_date','$imgName')";

    mysqli_query($conn, $sql);
    echo "<p class='text-green-400 text-center mt-4'>Found item submitted for admin approval.</p>";
}
?>

<section class="max-w-xl mx-auto mt-10 bg-zinc-800 p-6 rounded-xl">
    <h2 class="text-2xl font-bold mb-4">Report Found Item</h2>

    <form method="POST" enctype="multipart/form-data" class="space-y-4">

        <input type="text" name="title" placeholder="Item Title"
            class="w-full p-3 rounded bg-zinc-900" required>

        <textarea name="description" placeholder="How & where you found it"
            class="w-full p-3 rounded bg-zinc-900" required></textarea>

        <input type="text" name="location" placeholder="Found Location"
            class="w-full p-3 rounded bg-zinc-900" required>

        <input type="date" name="found_date"
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

        <input type="file" name="image" required>

        <button name="submit"
            class="w-full bg-blue-600 py-3 rounded hover:bg-blue-700">
            Submit Found Item
        </button>
    </form>
</section>

<?php include "../includes/footer.php"; ?>