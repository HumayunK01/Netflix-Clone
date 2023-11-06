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
        <?php include 'src/style.css'; ?>
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
        <div class="form">
            <!-- Login form container -->
            <h1 class="login-title">Sign Up</h1>
            <!-- Login title -->
            <div class="login-inputs">
                <!-- Input fields for login -->
                <input type="text" placeholder="Full Name" class="input-field" required autofocus>
                <!-- Input fields for login -->
                <input type="text" placeholder="Email Address" class="input-field" required autofocus>
                <!-- Email input field -->
                <input type="password" placeholder="Password" class="input-field" required>
                <!-- Password input field -->
            </div>
            <button class="login-button">Sign Up</button>
            <!-- Sign Up button -->
            <div class="info">
                <!-- Info section with Sign Up link -->
                <p>Have an account?</p><a href="../index.php">Sign In</a>
            </div>
            <div class="captcha">
                <!-- Google reCAPTCHA information -->
                <p>This page is protected by Google reCAPTCHA to ensure you're not a bot. <span>Learn more</span></p>
            </div>
        </div>
    </main>
</body>

</html>