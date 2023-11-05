<?php
session_start();

require "../config.php";

require "./php_scripts/head_scripts.php";

if (!isset($_SESSION["adminloggedin"]) || $_SESSION["adminloggedin"] !== true) {
    header("location: index.php");
    exit;
}
?>

<?php

if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['update_profile'])) {
    $adminEmail = $_POST['admin_email'];
    $currentPassword = $_POST['admin_password'];
    $newPassword = $_POST['admin_new_password'];

    $session_admin = $_SESSION['admin_email'];

    $sql = "SELECT a_password FROM admin WHERE a_email = '$session_admin'";
    $result = mysqli_query($conn, $sql);

    if ($result && mysqli_num_rows($result) > 0) {
        $row = mysqli_fetch_assoc($result);
        $hashedPassword = $row['admin_password'];

        if (password_verify($currentPassword, $hashedPassword)) {
            if (!empty($newPassword)) {
                $hashedNewPassword = password_hash($newPassword, PASSWORD_DEFAULT);
                $updateSql = "UPDATE admin SET a_email = '$adminEmail', a_password = '$hashedNewPassword' WHERE a_email = '$session_admin'";

                $_SESSION['admin_email'] = $adminEmail;
                $_SESSION['admin_password'] = $hashedNewPassword;

            } else {
                $updateSql = "UPDATE admin SET a_email = '$adminEmail' WHERE a_email = '$session_admin'";

            }

            if (mysqli_query($conn, $updateSql)) {
                $_SESSION['admin_email'] = $adminEmail;

                echo "<script defer>
                window.onload = function(){
                    Swal.fire(
                        'Profile Updated Successfully!',
                        '',
                        'success'
                    )
                    }
                </script>";
            } else {
                // echo "Error updating profile: " . mysqli_error($conn);
            }
        } else {

            echo "<script defer>
            window.onload = function(){
                Swal.fire(
                    'Current password does not match.',
                    '',
                    'error'
                );
            }
        </script>";

        }
    } else {
        // echo "Admin not found in the database.";
    }
}
?>


<!-- <script>
    setInterval(() => {
        window.location.href = window.location.href;
    }, 500);
</script> -->

<div class="container col-md-4 my-5">

    <h2>Edit Profile</h2>

    <br>


    <form method="POST" action="./profile.php">
        <div class="mb-3">
            <label for="exampleInputEmail1" class="form-label">Update Email address</label>
            <input type="email" name="admin_email" required value="<?php echo $_SESSION['admin_email']; ?>"
                class="form-control" id="exampleInputEmail1" aria-describedby="emailHelp">
        </div>

        <div class="mb-3">
            <label for="exampleInputPassword1" class="form-label">Current Password *</label>
            <input type="password" name="admin_password" class="form-control" id="exampleInputPassword1" required>
        </div>

        <div class="mb-3">
            <label for="exampleInputPassword1" class="form-label">New Password</label>
            <input type="password" name="admin_new_password" class="form-control" id="exampleInputPassword1">
        </div>

        <button type="submit" class="btn btn-primary" name="update_profile">Update Profile</button>
    </form>

</div>