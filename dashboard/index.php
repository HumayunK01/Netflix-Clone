<?php
session_start();
// login pass Asad12@34
require_once "../config.php";

if (isset($_SESSION["adminloggedin"]) && $_SESSION["adminloggedin"] === true) {
    header("location: dashboard.php");
    exit;
}
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Dashboard - Login</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet"
        integrity="sha384-T3c6CoIi6uLrA9TneNEoa7RxnatzjcDSCmG1MXxSR1GAsXEV/Dwwykc2MPK8M2HN" crossorigin="anonymous">
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js"
        integrity="sha384-C6RzsynM9kWDrMNeT87bh95OGNyZPhcTNXj1NW7RuBCsyN/o0jlpcV8Qyq46cDfL" crossorigin="anonymous">
    </script>
</head>

<?php

$email = $password = "";
$emailErr = $passwordErr = "";

if ($_SERVER["REQUEST_METHOD"] == "POST" && isset($_POST["login"])) {
    if (empty($_POST["a_email"])) {
        $emailErr = "Email is required";
    } else {
        $email = validateInput($_POST["a_email"]);
        if (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
            $emailErr = "Invalid email format";
        }
    }

    if (empty($_POST["a_password"])) {
        $passwordErr = "Password is required";
    } else {
        $password = validateInput($_POST["a_password"]);
        $uppercase = preg_match('@[A-Z]@', $password);
        $lowercase = preg_match('@[a-z]@', $password);
        $number = preg_match('@[0-9]@', $password);
        $specialChars = preg_match('@[^\w]@', $password);

        if (!$uppercase || !$lowercase || !$number || !$specialChars || strlen($password) <= 8) {
            $passwordErr = "Password should be at least 8 characters in length and should include at least one upper case letter, one number, and one special character.";
        } else {
            $password = validateInput($_POST["a_password"]);
        }

    }

    if (!empty($email) && !empty($password)) {
        $stmt = $conn->prepare("SELECT * FROM admin WHERE a_email = ?");
        $stmt->bind_param("s", $email);
        $stmt->execute();
        $result = $stmt->get_result();

        if ($result->num_rows == 1) {
            $row = $result->fetch_assoc();
            if (isset($row['a_password'])) {
                $storedPassword = $row["a_password"];

                if (password_verify($password, $storedPassword)) {
                    session_start();
                    $_SESSION["adminloggedin"] = true;
                    $_SESSION["admin_email"] = $email;
                    $_SESSION["admin_name"] = $row["a_name"];

                    header("Location: dashboard.php");
                    exit();
                } else {
                    $passwordErr = "Invalid password";
                }
            } else {
                die("Error: Unable to authenticate. Please try again later.");
            }
        } else {
            $emailErr = "User not found";
        }

        $stmt->close();
    }
}

$conn->close();

?>

<body>
    <div class="container">

        <div class="mt-5 pt-5">
            <h3 class="fs-4 text-uppercase">Netflix Administrator</h3>
            <form class="row g-3" action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]); ?>" method="POST">
                <div class="col-12">
                    <label for="inputEmail4" class="form-label">Email</label>
                    <input type="email" name="a_email" class="form-control" id="inputEmail4"
                        value="<?php echo $email; ?>">
                    <span class="form-text error"><?php echo $emailErr; ?></span>
                </div>
                <div class="col-12">
                    <label for="inputPassword4" class="form-label">Password</label>
                    <input type="password" name="a_password" class="form-control" id="inputPassword4">
                    <span class="form-text error"><?php echo $passwordErr; ?></span>
                </div>

                <div class="col-12">
                    <button type="submit" class="btn btn-dark" name="login">Sign in</button>
                </div>
            </form>
        </div>

    </div>

</body>

</html>