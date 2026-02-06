<?php
session_start();
include "../config/db.php";

if (isset($_POST['login'])) {
    $email = $_POST['email'];
    $pass = $_POST['password'];

    $res = mysqli_query($conn, "SELECT * FROM users WHERE email='$email'");
    $user = mysqli_fetch_assoc($res);

    if ($user && password_verify($pass, $user['password'])) {
        $_SESSION['user_id'] = $user['id'];
        $_SESSION['role'] = $user['role'];

        if ($user['role'] === 'admin') {
            header("Location: ../admin/dashboard.php");
        } else {
            header("Location: ../user/dashboard.php");
        }
    } else {
        $error = "Invalid email or password!";
    }
}
?>

<?php include "../includes/header.php"; ?>

<section class="min-h-screen flex items-center justify-center">
    <form method="POST"
        class="bg-zinc-800 p-8 rounded-xl w-full max-w-md shadow-lg">

        <h2 class="text-3xl font-bold text-center mb-6">Login</h2>

        <?php if (isset($error)) echo "<p class='text-red-400 mb-3'>$error</p>"; ?>

        <input type="email" name="email" placeholder="Email"
            class="w-full p-3 mb-3 rounded bg-zinc-900" required>

        <input type="password" name="password" placeholder="Password"
            class="w-full p-3 mb-4 rounded bg-zinc-900" required>

        <button name="login"
            class="w-full bg-blue-600 py-3 rounded hover:bg-blue-700">
            Login
        </button>

        <p class="text-center text-sm mt-4">
            Don’t have an account?
            <a href="register.php" class="text-blue-400">Register</a>
        </p>
    </form>
</section>

<?php include "../includes/footer.php"; ?>