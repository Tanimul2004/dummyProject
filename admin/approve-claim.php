<?php
session_start();
if (!isset($_SESSION['user_id']) || $_SESSION['role'] !== 'admin') {
  header("Location: ../auth/login.php");
  exit;
}


include "../includes/auth_check.php";
include "../config/db.php";

$claim_id = $_GET['id'];
$item_id  = $_GET['item'];

// Approve selected claim
mysqli_query($conn,"
  UPDATE claims SET status='approved' WHERE id='$claim_id'
");

// Reject others
mysqli_query($conn,"
  UPDATE claims SET status='rejected'
  WHERE item_id='$item_id' AND id!='$claim_id'
");

// Resolve item
mysqli_query($conn,"
  UPDATE items SET status='resolved' WHERE id='$item_id'
");

header("Location: dashboard.php");
