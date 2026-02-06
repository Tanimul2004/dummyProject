<?php include "includes/header.php"; ?>

<section class="max-w-7xl mx-auto px-4 mt-10">
    <h2 class="text-3xl font-bold mb-6 text-center">
        Lost & Found Items
    </h2>

    <div class="grid sm:grid-cols-2 lg:grid-cols-3 gap-6">

        <div class="bg-zinc-800 rounded-xl p-5 hover:shadow-lg hover:shadow-purple-500/30 transition">
            <img src="assets/images/sample.jpg" class="rounded-lg mb-4">
            <h3 class="text-xl font-semibold">Black Wallet</h3>
            <p class="text-zinc-400 text-sm mt-2">
                Found near main gate on 12 Jan
            </p>
            <a href="claim.php" class="inline-block mt-4 px-4 py-2 bg-purple-600 rounded-lg hover:bg-purple-700">
                Claim Item
            </a>
        </div>

    </div>
</section>

<?php include "includes/footer.php"; ?>