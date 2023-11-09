<?php
session_start();

if (isset($_SESSION["loggedin"]) && $_SESSION["loggedin"] === true) {
    header("location: contents.php");
    exit;
}

require "./config.php";
if ($_SERVER["REQUEST_METHOD"] == "POST" && isset($_POST["login"])) {
    $email = $_POST["email"];
    $password = $_POST["password"];
    if (empty($email) || empty($password)) {
        echo "Please enter both email and password.";
    } else {
        $sql = "SELECT * FROM users WHERE u_email = ?";

        if ($stmt = $conn->prepare($sql)) {
            $stmt->bind_param("s", $email);

            if ($stmt->execute()) {
                $result = $stmt->get_result();

                if ($result->num_rows == 1) {
                    $row = $result->fetch_assoc();
                    if (password_verify($password, $row["u_password"])) {
                        session_start();

                        $_SESSION["loggedin"] = true;
                        $_SESSION["user_id"] = $row["u_id"];
                        $_SESSION["user_email"] = $row["u_email"];

                        header("location: contents.php");
                    } else {
                        echo "Incorrect password.";
                    }
                } else {
                    echo "No account found with that email address.";
                }
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



    <script type="text/javascript">
    function googleTranslateElementInit() {
        new google.translate.TranslateElement({
            pageLanguage: 'en'
        }, 'google_translate_element');
    }
    </script>
    <script type="text/javascript" src="//translate.google.com/translate_a/element.js?cb=googleTranslateElementInit">
    </script>
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

    <div id="google_translate_element"></div>

    <main>
        <!-- Main content section -->
        <form action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]); ?>" method="POST" class="form">
            <!-- Login form container -->
            <h1 class="login-title">Sign In</h1>
            <!-- Login title -->
            <div class="login-inputs">
                <!-- Input fields for login -->
                <input type="text" placeholder="Email Address" class="input-field" name="email" required autofocus>
                <!-- Email input field -->
                <input type="password" placeholder="Password" class="input-field" name="password" required>
                <!-- Password input field -->
            </div>
            <button type="submit" class="login-button" name="login">Sign In</button>
            <!-- Sign In button -->
            <div class="login-check">
                <!-- Remember me and Need help section -->
                <label class="remember-me">
                    <!-- Checkbox for "Remember me" -->
                    <input type="checkbox" checked> Remember me
                </label>
                <a href="#" class="need-help">Need help?</a>
                <!-- "Need help?" link -->
            </div>
            <div class="info">
                <!-- Info section with Sign Up link -->
                <p>New to Netflix?</p><a href="./signup.php">Sign Up Now!</a>
            </div>
            <div class="captcha">
                <!-- Google reCAPTCHA information -->
                <p>This page is protected by Google reCAPTCHA to ensure you're not a bot. <span>Learn more</span></p>
            </div>
        </form>
    </main>
</body>

</html>