<?php
session_start();
require "../config.php";

require "./php_scripts/head_scripts.php";

if (!isset($_SESSION["adminloggedin"]) || $_SESSION["adminloggedin"] !== true) {
    header("location: index.php");
    exit;
}

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $title = $_POST["title"];
    $description = $_POST["description"];
    // $video = $_POST["video"];
    $popular = isset($_POST["popular"]) ? 1 : 0;
    $new_release = isset($_POST["new_release"]) ? 1 : 0;
    $tv_shows = isset($_POST["tv_shows"]) ? 1 : 0;
    $movies = isset($_POST["movies"]) ? 1 : 0;
    $kids_anime = isset($_POST["kids_anime"]) ? 1 : 0;

    if (isset($_FILES["img_logo"]) && isset($_FILES["thumbnail"]) && isset($_FILES["video"])) {
        $img_logo = $_FILES["img_logo"]["name"];
        $thumbnail = $_FILES["thumbnail"]["name"];
        $video_file = $_FILES["video"]["name"];

        $logo_directory = "../contents/logo/";
        $thumbnail_directory = "../contents/thumbnail/";
        $video_directory = "../contents/video/";

        if (!file_exists($logo_directory)) {
            mkdir($logo_directory, 0777, true);
        }
        if (!file_exists($thumbnail_directory)) {
            mkdir($thumbnail_directory, 0777, true);
        }
        if (!file_exists($video_directory)) {
            mkdir($video_directory, 0777, true);
        }

        if (move_uploaded_file($_FILES["img_logo"]["tmp_name"], $logo_directory . $img_logo) &&
            move_uploaded_file($_FILES["thumbnail"]["tmp_name"], $thumbnail_directory . $thumbnail) &&
            move_uploaded_file($_FILES["video"]["tmp_name"], $video_directory . $video_file)) {
        }

    }

    $sql = "INSERT INTO content (title, description, logo_img, thumbnail, video, popular, new_release, tv_shows, movies, kids_anime)
            VALUES (?, ?, ?, ?, ?, ?, ?, ?, ?, ?)";
    $stmt = $conn->prepare($sql);
    $stmt->bind_param("sssssiiiii", $title, $description, $img_logo, $thumbnail, $video_file, $popular, $new_release, $tv_shows, $movies, $kids_anime);

    if ($stmt->execute()) {
        echo "<script defer>
                window.onload = function(){
                    Swal.fire(
                        'Content Created Successfully!',
                        '',
                        'success'
                    )
                    }
                </script>";

    } else {
        echo "Error: " . $stmt->error;
    }

    $stmt->close();
}

$conn->close();

?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Content</title>
</head>

<body>
    <div class="container">
        <div class="mt-5 d-flex justify-content-between align-items-center">
            <div class="">
                <h3 class="">Add Content</h3>
            </div>
            <div class="">
                <a href="./view_content.php" class="btn btn-sm btn-success">View</a>
                <a href="./update_content.php" class="btn btn-sm btn-warning d-none">Modify</a>
            </div>
        </div>
        <form action="content.php" method="post" enctype="multipart/form-data" class="mt-4 row">
            <div class="form-group mb-3 col-12">
                <label for="title">Title:</label>
                <input type="text" name="title" required class="form-control">
            </div>

            <div class="form-group mb-3 col-12">
                <label for="description">Description:</label>
                <textarea name="description" required class="form-control"></textarea>
            </div>

            <div class="form-group mb-3 col-6">
                <label for="img_logo">Logo Image:</label>
                <input type="file" name="img_logo" accept="image/*" class="form-control">
            </div>

            <div class="form-group mb-3 col-6">
                <label for="thumbnail">Thumbnail Image:</label>
                <input type="file" name="thumbnail" accept="image/*" class="form-control">
            </div>

            <div class="form-group mb-3 col-12">
                <label for="video">Video URL:</label>
                <input type="file" name="video" required class="form-control">
            </div>

            <div class="form-group mb-3">
                <label>Categories:</label><br>
                <div class="form-check form-check-inline">
                    <input type="checkbox" name="popular" value="1" class="form-check-input">
                    <label class="form-check-label">Popular</label>
                </div>
                <div class="form-check form-check-inline">
                    <input type="checkbox" name="new_release" value="1" class="form-check-input">
                    <label class="form-check-label">New Release</label>
                </div>
                <div class="form-check form-check-inline">
                    <input type="checkbox" name="tv_shows" value="1" class="form-check-input">
                    <label class="form-check-label">TV Shows</label>
                </div>
                <div class="form-check form-check-inline">
                    <input type="checkbox" name="movies" value="1" class="form-check-input">
                    <label class="form-check-label">Movies</label>
                </div>
                <div class="form-check form-check-inline">
                    <input type="checkbox" name="kids_anime" value="1" class="form-check-input">
                    <label class="form-check-label">Kids Anime</label>
                </div>
            </div>

            <button type="submit" class="btn btn-dark mt-3 col-2">Insert</button>
        </form>
    </div>
</body>

</html>
