<?php
session_start();

require_once "./config.php";

if (!isset($_SESSION["loggedin"]) || $_SESSION["loggedin"] !== true) {
    header("location: login.php");
    exit;
}
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="icon" href="Assets/Nicon.ico">
    <link rel="stylesheet" href="./src/css/moviezone.css">
    <title>Netflix India – Watch TV Shows Online, Watch Movies Online</title>



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

    <section class="container">
        <div class="head">
            <img src="Assets/Nlogo.png">

            <ul class="netflix-line">
                <li class="navigation-tab">
                    <a href="#">Home</a>
                </li>
                <li class="navigation-tab">
                    <a href="#">TV Shows</a>
                </li>
                <li class="navigation-tab">
                    <a href="#">Movies</a>
                </li>
                <li class="navigation-tab">
                    <a href="#">New & Popular</a>
                </li>
                <li class="navigation-tab">
                    <a href="#">My List</a>
                </li>
                <li class="navigation-tab">
                    <a href="./logout.php">Logout</a>
                </li>
                <li class="navigation-tab">
                    <a href="#">
                        <div id="google_translate_element"></div>
                    </a>
                </li>

            </ul>
    </section>
    <section class="video1">
        <div class="gif-play" controls>

            <video class="video" autoplay="" playsinline="" muted="" loop="">
                <source src="./moviezone/Assets/money-heist-gif.mp4" type="video/mp4">
            </video>

            <img src="./moviezone/Assets/n-series.webp" alt="n-series-png">
            <p>Eight thieves take hostages and lock themselves in the Royal Mint of Spain as a criminal mastermind
                manipulates the police to carry out his plan.</p>
        </div>

        <div class="play-button">
            <img src="./moviezone/Assets/icons8-play-24.png" alt="play-button">
            <a data-uia="play-button" href="Assets/money-heist-gif.mp4"><b> Play </b></a>
        </div>

        <div class="more-info">
            <img src="./moviezone/Assets/icons8-info-24.png" alt="info">
            <a href="#"><b> More Info </b></a>
        </div>
    </section>


    <?php

$sqlPopular = "SELECT * FROM content WHERE popular = 1";

$result = $conn->query($sqlPopular);

if ($result->num_rows > 0) {
    echo '<div class="box">';
    echo '<h3 style="color: #fff;">Trending Now</h3>';
    echo '<div class="no">';

    while ($row = $result->fetch_assoc()) {
        $thumbnailImage = "./contents/thumbnail/" . $row['thumbnail'];
        $videoURL = "./contents/video/" . $row['video'];

        echo '<a href="' . $videoURL . '" target="_blank"><img src="' . $thumbnailImage . '" alt="Thumbnail Image"></a>';
    }

    echo '</div>';
    echo '</div>';
}
// else {
//     echo '<p style="color:#fff"; text-align:center;>No trending content found.</p>';
// }

$sqlKid = "SELECT * FROM content WHERE kids_anime = 1";

$result = $conn->query($sqlKid);

if ($result->num_rows > 0) {
    echo '<div class="box">';
    echo '<h3 style="color: #fff;">Kids Animation</h3>';
    echo '<div class="no">';

    while ($row = $result->fetch_assoc()) {
        $thumbnailImage = "./contents/thumbnail/" . $row['thumbnail'];
        $videoURL = "./contents/video/" . $row['video'];

        echo '<a href="' . $videoURL . '" target="_blank"><img src="' . $thumbnailImage . '" alt="Thumbnail Image"></a>';
    }

    echo '</div>';
    echo '</div>';
}
// else {
//     echo '<p style="color:#fff"; text-align:center;>No Kids content found.</p>';
// }
?>
    <?php

$sqlPopular = "SELECT * FROM content WHERE popular = 1";

$result = $conn->query($sqlPopular);

if ($result->num_rows > 0) {
    echo '<div class="box">';
    echo '<h3 style="color: #fff;">Popular on Netflix</h3>';
    echo '<div class="no">';

    while ($row = $result->fetch_assoc()) {
        $thumbnailImage = "./contents/thumbnail/" . $row['thumbnail'];
        $videoURL = "./contents/video/" . $row['video'];

        echo '<a href="' . $videoURL . '" target="_blank"><img src="' . $thumbnailImage . '" alt="Thumbnail Image"></a>';
    }

    echo '</div>';
    echo '</div>';
}
// else {
//     echo '<p style="color:#fff"; text-align:center;>No popular content found.</p>';
// }

?>

    <?php

$sqlNewRelease = "SELECT * FROM content WHERE new_release = 1";

$result = $conn->query($sqlNewRelease);

if ($result->num_rows > 0) {
    echo '<div class="box">';
    echo '<h3 style="color: #fff;">New Releases</h3>';
    echo '<div class="no">';

    while ($row = $result->fetch_assoc()) {
        $thumbnailImage = "./contents/thumbnail/" . $row['thumbnail'];
        $videoURL = "./contents/video/" . $row['video'];

        echo '<a href="' . $videoURL . '" target="_blank"><img src="' . $thumbnailImage . '" alt="Thumbnail Image"></a>';
    }

    echo '</div>';
    echo '</div>';
}
// else {
//     echo '<p style="color:#fff"; text-align:center;>No new release content found.</p>';
// }

?>
    <?php

$sqlMovies = "SELECT * FROM content WHERE movies = 1";

$result = $conn->query($sqlMovies);

if ($result->num_rows > 0) {
    echo '<div class="box">';
    echo '<h3 style="color: #fff;">Movies</h3>';
    echo '<div class="no">';

    while ($row = $result->fetch_assoc()) {
        $thumbnailImage = "./contents/thumbnail/" . $row['thumbnail'];
        $videoURL = "./contents/video/" . $row['video'];

        echo '<a href="' . $videoURL . '" target="_blank"><img src="' . $thumbnailImage . '" alt="Thumbnail Image"></a>';
    }

    echo '</div>';
    echo '</div>';
}
// else {
//     echo '<p style="color:#fff"; text-align:center;>No movies content found.</p>';
// }

?>
    <?php

$sqlTv = "SELECT * FROM content WHERE tv_shows = 1";

$result = $conn->query($sqlTv);

if ($result->num_rows > 0) {
    echo '<div class="box">';
    echo '<h3 style="color: #fff;">TV / Shows</h3>';
    echo '<div class="no">';

    while ($row = $result->fetch_assoc()) {
        $thumbnailImage = "./contents/thumbnail/" . $row['thumbnail'];
        $videoURL = "./contents/video/" . $row['video'];

        echo '<a href="' . $videoURL . '" target="_blank"><img src="' . $thumbnailImage . '" alt="Thumbnail Image"></a>';
    }

    echo '</div>';
    echo '</div>';
}
// else {
//     echo '<p style="color:#fff"; text-align:center;>No tv content found.</p>';
// }

?>


</body>

</html>