<?php
$conn = mysqli_connect("localhost", "root", "", "lost_found");

if (!$conn) {
  die("Database connection failed");
}
