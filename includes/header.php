<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <title>Lost & Found Assistant</title>
    <script src="https://cdn.tailwindcss.com"></script>
</head>

<body class="bg-zinc-900 text-zinc-100">

    <header class="bg-gradient-to-r from-purple-600 to-blue-600">
        <div class="max-w-7xl mx-auto px-4 py-4 flex justify-between items-center">

            <h1 class="text-2xl font-bold tracking-wide">
                Lost<span class="text-yellow-300">Found</span>
            </h1>

            <nav class="hidden md:flex gap-6 font-medium">
                <a href="index.php" class="hover:text-yellow-300">Home</a>
                <a href="auth/login.php" class="hover:text-yellow-300">Login</a>
                <a href="auth/register.php" class="hover:text-yellow-300">Register</a>
            </nav>

            <!-- Mobile Menu Button -->
            <button id="menuBtn" class="md:hidden">
                ☰
            </button>
        </div>

        <!-- Mobile Menu -->
        <div id="mobileMenu" class="hidden bg-zinc-800 md:hidden px-4 py-4 space-y-2">
            <a href="index.php" class="block">Home</a>
            <a href="auth/login.php" class="block">Login</a>
            <a href="auth/register.php" class="block">Register</a>
        </div>
    </header>