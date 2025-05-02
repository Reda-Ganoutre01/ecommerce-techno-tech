<?php
session_start();
include('includ/connection.php');

// Check if the form data has been submitted
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Retrieve the data from the form
    $id_produit = $_POST['id_produit'];

    // Prepare and execute SQL query to delete the product
    $query = "DELETE FROM favorite WHERE id_produit = ?";
    $stmt = $conn->prepare($query);
    $stmt->bind_param("i", $id_produit);
    if ($stmt->execute()) {
        // Product deleted successfully
        echo "Product deleted successfully!";
        header("Location: favorite_page.php"); // Redirect back to the favorite page
    } else {
        // Error occurred while deleting product
        echo "Error deleting product: " . $stmt->error;
    }

    // Close the statement
    $stmt->close();
} else {
    // If the form data has not been submitted, redirect the user back to the previous page
    header("Location: previous_page.php");
    exit();
}

// Close the database connection
$conn->close();
?>