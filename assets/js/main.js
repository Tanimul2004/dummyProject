// assets/js/main.js

// Profile dropdown toggle
function toggleProfileMenu() {
  const menu = document.getElementById("profileMenu");
  menu.classList.toggle("hidden");
}

// Auto hide alert messages
setTimeout(() => {
  document.querySelectorAll(".alert").forEach(el => {
    el.style.display = "none";
  });
}, 4000);

// Confirm before claiming an item
function confirmClaim() {
  return confirm("Are you sure you want to claim this item? Admin verification required.");
}

// Image preview before upload
function previewImage(event) {
  const img = document.getElementById("preview");
  img.src = URL.createObjectURL(event.target.files[0]);
  img.classList.remove("hidden");
}
