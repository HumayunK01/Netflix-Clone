<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Dashboard</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.1/dist/css/bootstrap.min.css" rel="stylesheet"
        integrity="sha384-4bw+/aepP/YC94hEpVNVgiZdgIC5+VKNBQNGCHeKRQN+PtmoHDEXuppvnDJzQIu9" crossorigin="anonymous">
    <script src="//cdn.jsdelivr.net/npm/sweetalert2@11"></script>

    <style>
    .nav-link {
        cursor: pointer;
    }
    </style>

</head>

<body>

    <nav class="navbar navbar-expand-lg bg-body-tertiary" data-bs-theme="dark">
        <div class="container-fluid">
            <a class="navbar-brand lead" href="#">Netflix</a>
            <button class="navbar-toggler" type="button" data-bs-toggle="collapse"
                data-bs-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false"
                aria-label="Toggle navigation">
                <span class="navbar-toggler-icon"></span>
            </button>
            <div class="collapse navbar-collapse" id="navbarSupportedContent">
                <ul class="navbar-nav me-auto mb-2 mb-lg-0">

                    <li class="nav-item">
                        <a class="nav-link" dynamic_href="content.php">Manage Content</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" dynamic_href="view_content.php">View Content</a>
                    </li>

                    <li class="nav-item">
                        <a class="nav-link" dynamic_href="./profile.php">Profile</a>
                    </li>

                </ul>
                <div class="d-flex" role="search">
                    <a href="./logout.php">
                        <button class="btn btn-danger btn-sm">Logout</button>
                    </a>
                </div>
            </div>
        </div>
    </nav>
