<?php
session_start();
require "../config.php";

require "./php_scripts/head_scripts.php";

if (!isset($_SESSION["adminloggedin"]) || $_SESSION["adminloggedin"] !== true) {
    header("location: index.php");
    exit;
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
        <source src=" . $videoF . " type='video/mp4'></video></td>";

        echo "<td>" . ($row["popular"] ? "Yes" : "No") . "</td>";
        echo "<td>" . ($row["new_release"] ? "Yes" : "No") . "</td>";
        echo "<td>" . ($row["tv_shows"] ? "Yes" : "No") . "</td>";
        echo "<td>" . ($row["movies"] ? "Yes" : "No") . "</td>";
        echo "<td>" . ($row["kids_anime"] ? "Yes" : "No") . "</td>";
        echo "</tr>";
    }

    echo "</table>";
} else {
    echo "No content found in the database.";
}

$conn->close();
