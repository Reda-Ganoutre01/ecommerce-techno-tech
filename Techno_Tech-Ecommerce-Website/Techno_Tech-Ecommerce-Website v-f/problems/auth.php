<?php
session_start();
include('includ/connection.php');

if (isset($_POST['login'])) {
    if (isset($_POST['email']) && isset($_POST['password'])) {
        $email = strtolower($_POST["email"]);
        $password = $_POST["password"];

        if (empty($email)) {
            $email_error = "<h5 style='color:red;opacity:0.9' >Please insert Email </h5>";
        }
        if (empty($password)) {
            $password_error = "<h5 style='color:red;opacity:0.9' >Please insert password </h5>";
        }

        if (!isset($email_error) && !isset($password_error)) {
            $sql = "SELECT * FROM client WHERE email_client=? LIMIT 1";
            $stmt = $conn->prepare($sql);
            $stmt->bind_param("s", $email);
            $stmt->execute();
            $result = $stmt->get_result();
            $row = $result->fetch_assoc();

            if ($row && password_verify($password, $row['mod_pass_client'])) {
                $_SESSION['username'] = $row['nom_client'];
                $_SESSION['email'] = $row['email_client'];
                header("Location: index.php");
                exit();
            } else {
                $login_error = '<h4 style="color:red;opacity:0.9">Your password or email is incorrect</h4>';
            }
        }
    }
}

if (isset($_POST['register'])) {
    $username = $_POST['Username'];
    $email = strtolower($_POST['email']);
    $password = $_POST['password'];
    $repetpassword = $_POST['Repet_password'];

    $errors = [];

    if (empty($username) || empty($email) || empty($password) || empty($repetpassword)) {
        $errors[] = '<h4 style="color:red;opacity:0.9">All fields are required</h4>';
    }
    if (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
        $errors[] = '<h4 style="color:red;opacity:0.9">Email is not valid</h4>';
    }
    if (strlen($password) < 8) {
        $errors[] = '<h4 style="color:red;opacity:0.9">Password must be at least 8 characters long</h4>';
    }
    if ($password !== $repetpassword) {
        $errors[] = '<h4 style="color:red;opacity:0.9">Passwords do not match</h4>';
    }

    if (empty($errors)) {
        $sql = "SELECT * FROM client WHERE nom_client = ? OR email_client = ?";
        $stmt = $conn->prepare($sql);
        $stmt->bind_param("ss", $username, $email);
        $stmt->execute();
        $result = $stmt->get_result();

        if ($result->num_rows > 0) {
            $errors[] = "<h4 style='color:green;opacity:0.9'>User already registered</h4>";
        } else {
            $hashed_password = password_hash($password, PASSWORD_DEFAULT);
            $sql_insert = "INSERT INTO client(nom_client,email_client,mod_pass_client) VALUES(?,?,?)";
            $stmt = $conn->prepare($sql_insert);
            $stmt->bind_param("sss", $username, $email, $hashed_password);

            if ($stmt->execute()) {
                $_SESSION['username'] = $username;
                $_SESSION['email'] = $email;
                header("Location: index.php");
                exit();
            } else {
                $errors[] = "ERROR: " . $stmt->error;
            }
        }
    }

    foreach ($errors as $error) {
        echo "<div class='alert alert-danger'>$error</div>";
    }
}
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.2/css/all.min.css">
    <link rel="stylesheet" href="CSS/style_auth.css">
</head>

<body>
    <?php include('header.php'); ?>
    <div class="g1">
        <div class="container1" id="container">
            <div class="form-container1 sign-up">
                <!-- Registration Form -->
                <form action='' method='POST'>
                    <h1>Create Account</h1>
                    <span>or use your email for registration</span>
                    <input type="text" placeholder="Name" name='Username'>
                    <input type="email" placeholder="Email" name='email'>
                    <input type="password" placeholder="Password" name='password'>
                    <input type="password" placeholder="Confirm Password" name='Repet_password'>
                    <button type="submit" name='register'>Sign Up</button>
                </form>
            </div>

            <div class="form-container1 sign-in">
                <!-- Login Form -->
                <form action='' method='POST'>
                    <h1>Sign In</h1>
                    <span>or use your email and password</span>
                    <input type="email" placeholder="Email" name='email'>
                    <?php if (isset($email_error)) echo $email_error; ?>
                    <input type="password" placeholder="Password" name='password'>
                    <?php if (isset($password_error)) echo $password_error; ?>
                    <?php if (isset($login_error)) echo $login_error; ?>
                    <a href="#">Forgot Your Password?</a>
                    <button type='submit' name='login'>Sign In</button>
                </form>
            </div>

            <div class="toggle-container1">
                <div class="toggle">
                    <div class="toggle-panel toggle-left">
                        <h1>Welcome Back!</h1>
                        <p>Enter your personal details to use all site features</p>
                        <button class="hidden" id="login">Sign In</button>
                    </div>
                    <div class="toggle-panel toggle-right">
                        <h1>Hello Member!</h1>
                        <p>Register with your personal details to use all site features</p>
                        <button class="hidden" id="register">Sign Up</button>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <?php include('footer.php'); ?>
    <script src="script/script_auth.js"></script>
</body>

</html>