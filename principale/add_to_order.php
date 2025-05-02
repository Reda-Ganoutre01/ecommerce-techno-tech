<?php
session_start();
include('includ/connection.php');
if (!isset($_SESSION['id_client'])) {
    header("Location: login.php");
    exit();
}
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    if (isset($_POST['total-price']) && isset($_POST['totalProduit'])) {
        $total_price = $_POST['total-price'];
        $total_products = $_POST['totalProduit'];
    } else {
        echo "Total price or total product not provided.";
        exit(); // Stop execution if required data is not provided
    }

    $nom = $_POST['nom'];
    $number = $_POST['number'];
    $email = $_POST['email'];
    $method = $_POST['method'];
    $address1 = $_POST['address1'];
    $address2 = $_POST['address2'];
    $ville = $_POST['Ville'];
    $currentTime = date("Y-m-d H:i:s");
    $payment_status = 'en cours';

    $adresse = $address1 . ', ' . $address2 . ', ' . $ville;

    if (isset($_SESSION['id_client'])) {
        $id_client = $_SESSION['id_client'];

        $stmt = $conn->prepare("INSERT INTO commande (id_client, nom, `number`, email, method, address, total_price, total_products, placed_on, payment_status) VALUES (?, ?, ?, ?, ?, ?, ?, ?, ?, ?)");

        if ($stmt === false) {
            // Error occurred while preparing the statement
            die('Error preparing statement: ' . $conn->error);
        }

        // Execute the statement
        $bind_result = $stmt->bind_param("issdsisiss", $id_client, $nom, $number, $email, $method, $adresse, $total_price, $total_products, $currentTime, $payment_status);

        // Check if binding parameters was successful
        if ($bind_result === false) {
            // Error occurred while binding parameters
            die('Error binding parameters: ' . $stmt->error);
        }

        // Execute the prepared statement
        if ($stmt->execute()) {
            // Order inserted successfully, now delete products from cart
            $stmt = $conn->prepare("DELETE FROM cart WHERE id_client = ?");
            $stmt->bind_param("i", $id_client);
            if ($stmt->execute()) {
                // Cart cleared successfully
                header("Location: cart_page.php");
                exit();
            } else {
                // Error clearing the cart
                echo "Error clearing the cart: " . $stmt->error;
            }
        } else {
            // Error occurred while adding order
            echo "Error adding order: " . $stmt->error;
        }

        // Close the statement
        $stmt->close();
    } else {
        // id_client is not set in the session
        echo "Error: id_client is not set in the session.";
    }
} else {
    // If the form data has not been submitted, redirect the user back to the previous page
    header("Location: previous_page.php");
    exit();
}
?>
