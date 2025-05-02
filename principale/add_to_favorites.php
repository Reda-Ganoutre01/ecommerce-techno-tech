<?php
if (session_status() == PHP_SESSION_NONE) {
    session_start();
}include('includ/connection.php');

// Check if the form data has been submitted
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Retrieve the data from the form
    $id_produit = $_POST['id_produit'];
    $nom_produit = $_POST['nom_produit'];
    $prix_produit = $_POST['prix_produit'];
    $image = $_POST['image'];
    
    if(isset($_SESSION['id_client'])) {
        $id_client = $_SESSION['id_client'];
    
        // Prepare the SQL query using placeholders
        $stmt = $conn->prepare("INSERT INTO favorite (id_client, id_produit, nom_produit, prix_produit, image) VALUES (?, ?, ?, ?, ?)");
    
        // Check if the statement was successfully prepared
        if ($stmt === false) {
            // Error occurred while preparing the statement
            die('Error preparing statement: ' . $conn->error);
        }
    
        // Bind parameters to the prepared statement
        $bind_result = $stmt->bind_param("iisds", $id_client, $id_produit, $nom_produit, $prix_produit, $image);
    
        // Check if binding parameters was successful
        if ($bind_result === false) {
            // Error occurred while binding parameters
            die('Error binding parameters: ' . $stmt->error);
        }
    
        // Execute the prepared statement
        if ($stmt->execute()) {
            // Product added to favorites successfully
            echo "Product added to favorites!";
            header("Location: favorite_page.php");
        } else {
            // Error occurred while adding product to favorites
            echo "Error adding product to favorites: " . $stmt->error;
        }
    
        // Close the statement
        $stmt->close();
    } else {
        header("Location: login.php");
        exit();    
    }
} else {
// If the form data has not been submitted, redirect the user back to the previous page
header("Location: previous_page.php");
exit();
}

// Close the database connection
$conn->close();
?>