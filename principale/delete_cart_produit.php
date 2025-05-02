<?php
session_start();
include('includ/connection.php');

// Redirect to login page if user is not logged in
if (!isset($_SESSION['email']) || !isset($_SESSION['username'])) {
    header("Location: login.php");
    exit();
}

// Check if the form is submitted
if (isset($_POST['delete_product'])) {
    // Get the product ID to delete
    $product_id = $_POST['product_id'];

    // Perform the deletion query
    $stmt = $conn->prepare("DELETE FROM cart WHERE id = ?");
    $stmt->bind_param("i", $product_id);
    if ($stmt->execute()) {
        // Product deleted successfully, redirect back to the cart page
        header("Location: cart_page.php");
        exit();
    } else {
        // Error occurred during deletion
        echo "Error deleting product.";
    }
} else {
    // Redirect back to the cart page if form is not submitted properly
    header("Location: cart.php");
    exit();
}
?>
