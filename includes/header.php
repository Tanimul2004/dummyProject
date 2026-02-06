<?php
session_start();
include_once "../config/db.php";
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Lost & Found Assistant</title>

    <!-- Tailwind CDN -->
    <script src="https://cdn.tailwindcss.com"></script>

    <!-- Custom CSS -->
    <link rel="stylesheet" href="../assets/css/tailwind.css">

    <!-- Font Awesome -->
    <link rel="stylesheet"
          href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.1/css/all.min.css">

    <!-- JS -->
    <script src="../assets/js/main.js" defer></script>
</head>

<body class="bg-slate-900 text-gray-200">

<header class="bg-slate-950 border-b border-slate-800">
    <div class="max-w-7xl mx-auto px-4 py-3 flex justify-between items-center">

        <!-- Logo -->
        <a href="../index.php"
           class="text-2xl font-bold text-indigo-400 hover:text-indigo-300">
            Lost<span class="text-green-400">&</span>Found
        </a>

        <!-- Desktop Menu -->
        <nav class="hidden md:flex items-center gap-6">

            <a href="../index.php" class="hover:text-indigo-400 transition">
                Home
            </a>

            <?php if (isset($_SESSION['user_id'])): ?>
                <?php
                $uid = (int) $_SESSION['user_id'];
                $query = mysqli_query($conn, "SELECT image, name FROM users WHERE id=$uid");
                $user = mysqli_fetch_assoc($query);

                $profileImg = $user['image']
                    ? "../assets/images/users/" . $user['image']
                    : "../assets/images/default-user.png";
                ?>

                <!-- Profile Dropdown -->
                <div class="relative">
                    <button onclick="toggleProfileMenu()" class="flex items-center gap-2">
                        <img src="<?= $profileImg ?>"
                             class="w-10 h-10 rounded-full border border-indigo-500 object-cover">
                        <i class="fa-solid fa-chevron-down text-sm"></i>
                    </button>

                    <div id="profileMenu"
                         class="hidden absolute right-0 mt-3 w-44 bg-slate-900 rounded-lg shadow-xl overflow-hidden">

                        <div class="px-4 py-2 text-sm text-gray-400 border-b border-slate-700">
                            <?= htmlspecialchars($user['name']) ?>
                        </div>

                        <a href="../user/profile.php"
                           class="block px-4 py-2 hover:bg-slate-800">
                            <i class="fa-regular fa-user mr-2"></i> Profile
                        </a>

                        <a href="../user/edit-profile.php"
                           class="block px-4 py-2 hover:bg-slate-800">
                            <i class="fa-solid fa-pen mr-2"></i> Edit Profile
                        </a>

                        <a href="../auth/logout.php"
                           class="block px-4 py-2 text-red-400 hover:bg-slate-800">
                            <i class="fa-solid fa-right-from-bracket mr-2"></i> Logout
                        </a>
                    </div>
                </div>

            <?php else: ?>
                <a href="../auth/login.php"
                   class="px-4 py-2 rounded bg-indigo-600 hover:bg-indigo-500 transition">
                    Login
                </a>

                <a href="../auth/register.php"
                   class="px-4 py-2 rounded border border-indigo-500 hover:bg-indigo-600 transition">
                    Register
                </a>
            <?php endif; ?>

        </nav>

        <!-- Mobile Menu Button -->
        <button class="md:hidden text-2xl" onclick="document.getElementById('mobileMenu').classList.toggle('hidden')">
            <i class="fa-solid fa-bars"></i>
        </button>
    </div>

    <!-- Mobile Menu -->
    <div id="mobileMenu" class="hidden md:hidden bg-slate-900 border-t border-slate-800">
        <div class="px-4 py-3 space-y-3">
            <a href="../index.php" class="block hover:text-indigo-400">Home</a>

            <?php if (!isset($_SESSION['user_id'])): ?>
                <a href="../auth/login.php" class="block hover:text-indigo-400">Login</a>
                <a href="../auth/register.php" class="block hover:text-indigo-400">Register</a>
            <?php endif; ?>
        </div>
    </div>
</header>
