<?php
session_start();

require "./config.php";
$u_name = $u_email = $u_password = "";
$u_name_err = $u_email_err = $u_password_err = "";
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    if (empty(trim($_POST["u_name"]))) {
        $u_name_err = "Please enter your full name.";
    } else {
        $u_name = trim($_POST["u_name"]);
    }
    if (empty(trim($_POST["u_email"]))) {
        $u_email_err = "Please enter your email address.";
    } elseif (!filter_var(trim($_POST["u_email"]), FILTER_VALIDATE_EMAIL)) {
        $u_email_err = "Invalid email address format.";
    } else {
        $u_email = trim($_POST["u_email"]);
    }
    if (empty(trim($_POST["u_password"]))) {
        $u_password_err = "Please enter a password.";
    } elseif (strlen(trim($_POST["u_password"])) < 8) {
        $u_password_err = "Password must have at least 8 characters.";
    } else {
        $u_password = trim($_POST["u_password"]);
    }
    if (empty($u_name_err) && empty($u_email_err) && empty($u_password_err)) {
        $sql = "INSERT INTO users (u_name, u_email, u_password) VALUES (?, ?, ?)";

        if ($stmt = $conn->prepare($sql)) {
            $hashed_password = password_hash($u_password, PASSWORD_DEFAULT);
            $stmt->bind_param("sss", $u_name, $u_email, $hashed_password);
            if ($stmt->execute()) {
                header("location: ./login.php");
                exit();
            } else {
                echo "Error: " . $stmt->error;
            }

            $stmt->close();
        }
    }
    $conn->close();
}
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Netflix India – Watch TV Shows Online, Watch Movies Online</title>
    <!-- Define the document title -->
    <link rel="shortcut icon" href="https://assets.nflxext.com/us/ffe/siteui/common/icons/nficon2023.ico"
        type="image/x-icon">
    <!-- Set the favicon for the website -->
    <style>
    <?php include 'src/css/signup.css';
    ?>
    </style>
    <!-- Link to an external CSS stylesheet for styling -->
</head>

<body>
    <nav>
        <!-- Navigation section -->
        <div class="logo">
            <!-- Logo container -->
            <a href="#"><img src="https://www.freepnglogos.com/uploads/netflix-logo-0.png" alt="Logo"></a>
            <!-- Netflix logo with a link to the homepage -->
        </div>
    </nav>
    <main>
        <!-- Main content section -->
        <form action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]); ?>" method="POST" class="form">
            <!-- Login form container -->
            <h1 class="login-title">Sign Up</h1>
            <!-- Login title -->
            <div class="login-inputs">
                <!-- Input fields for login -->
                <input type="text" placeholder="Full Name" class="input-field" name="u_name" required autofocus>
                <!-- Input fields for login -->
                <input type="text" placeholder="Email Address" class="input-field" name="u_email" required autofocus>
                <!-- Email input field -->
                <input type="password" placeholder="Password" class="input-field" name="u_password" required>
                <!-- Password input field -->
            </div>
            <button type="submit" name="signup" class="login-button">Sign Up</button>
            <!-- Sign Up button -->
            <div class="info">
                <!-- Info section with Sign Up link -->
                <p>Have an account?</p><a href="./login.php">Sign In</a>
            </div>
            <div class="captcha">
                <!-- Google reCAPTCHA information -->
                <p>This page is protected by Google reCAPTCHA to ensure you're not a bot. <span>Learn more</span></p>
            </div>
        </form>
    </main>
</body>

</html>