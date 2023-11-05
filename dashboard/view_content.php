<?php
session_start();
require "../config.php";

require "./php_scripts/head_scripts.php";

if (!isset($_SESSION["adminloggedin"]) || $_SESSION["adminloggedin"] !== true) {
    header("location: index.php");
    exit;
}

if (isset($_GET['delete_id'])) {
    $delete_id = $_GET['delete_id'];

    // Prepare a DELETE query
    $delete_sql = "DELETE FROM content WHERE id = ?";

    if ($stmt = $conn->prepare($delete_sql)) {
        $stmt->bind_param("i", $delete_id);

        if ($stmt->execute()) {
            echo "<script defer>
                window.onload = function(){
                    Swal.fire(
                        '',
                        'Content has been deleted Successfully!',
                        'success'
                    )
                    }
                </script>";

            // echo "Content with ID $delete_id has been deleted.";
        } else {
            echo "Error deleting content: " . $stmt->error;
        }

        $stmt->close();
    }
}

$sql = "SELECT * FROM content";

$result = $conn->query($sql);

if ($result->num_rows > 0) {
    echo "<table class='table'>";
    echo "<tr>
            <th>Title</th>
            <th>Description</th>
            <th>Logo Image</th>
            <th>Thumbnail</th>
            <th>Video</th>
            <th>Popular</th>
            <th>New Release</th>
            <th>TV Shows</th>
            <th>Movies</th>
            <th>Kids Anime</th>
            <th>Action</th>
          </tr>";

    while ($row = $result->fetch_assoc()) {
        echo "<tr>";
        echo "<td>" . $row["title"] . "</td>";
        echo "<td>" . $row["description"] . "</td>";

        $logoImg = "../contents/logo/" . $row["logo_img"];
        echo "<td><img width='120px' height='120px' src='" . $logoImg . "' /></td>";

        $thumbnailImg = "../contents/thumbnail/" . $row["thumbnail"];
        echo "<td><img width='120px' height='120px' src='" . $thumbnailImg . "' /></td>";

        $videoF = "../contents/video/" . $row["video"];
        echo "<td><video  width='340' height='140' muted controls>
        <source src='" . $videoF . "' type='video/mp4'></video></td>";

        echo "<td>" . ($row["popular"] ? "Yes" : "No") . "</td>";
        echo "<td>" . ($row["new_release"] ? "Yes" : "No") . "</td>";
        echo "<td>" . ($row["tv_shows"] ? "Yes" : "No") . "</td>";
        echo "<td>" . ($row["movies"] ? "Yes" : "No") . "</td>";
        echo "<td>" . ($row["kids_anime"] ? "Yes" : "No") . "</td>";

        $delete_id = $row["id"];
        echo "<td><a href='view_content.php?delete_id=$delete_id' class='btn btn-danger btn-sm'>Delete</a></td>";

        echo "</tr>";
    }

    echo "</table>";
} else {
    echo "No content found in the database.";
}

$conn->close();
