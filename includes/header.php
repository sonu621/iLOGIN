<?php

session_start();

// Check if the user is authenticated
$authentication = isset($_SESSION['authenticated']) && $_SESSION['authenticated'] === true;
?>

<!doctype html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Login demo</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet"
        integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">
    <link href="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-icons/1.10.0/font/bootstrap-icons.min.css" rel="stylesheet">
    <link href="https://cdn.datatables.net/1.11.5/css/dataTables.bootstrap5.min.css" rel="stylesheet">
    <style>
        html, body {
            height: 100%;
        }
        body {
            display: flex;
            flex-direction: column;
        }
        .container {
            flex: 1;
        }
        footer {
            flex-shrink: 0;
        }
        .file-upload {
            position: relative;
            display: flex;
            flex-direction: column;
            align-items: center;
            justify-content: center;
            height: 150px;
            padding: 30px;
            border: 1px dashed silver;
            border-radius: 5px;
        }
        .file-upload input{
            position: absolute;
            width: 100%;
            height: 100%;
            top: 0;
            left: 0;
            opacity: 0;
            cursor: pointer;
        }
        .preview_img {
            width: 80px;
            height: 80px;
            object-fit: cover;
            border-radius: 100%;
            border: 2px solid silver;
        }
    </style>
</head> 

<body>
    <nav class="navbar navbar-expand-lg bg-body-tertiary border-bottom shadow-sm">
        <div class="container-fluid">
            <a class="navbar-brand" href="index.php">iLOGIN</a>
            <button class="navbar-toggler" type="button" data-bs-toggle="collapse"
                data-bs-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false"
                aria-label="Toggle navigation">
                <span class="navbar-toggler-icon"></span>
            </button>
            <div class="collapse navbar-collapse" id="navbarSupportedContent">
                <ul class="navbar-nav me-auto mb-2 mb-lg-0">
                    <li class="nav-item">
                        <a class="nav-link active" href="index.php">Home</a>
                    </li>
                </ul>
                <?php if ($authentication) { ?>
                    <ul class="navbar-nav ms-auto">
                        <li class="nav-item dropdown">
                            <a class="nav-link dropdown-toggle text-dark" href="#" role="button" data-bs-toggle="dropdown"
                                aria-expanded="false">
                                Admin
                            </a>
                            <ul class="dropdown-menu dropdown-menu-end">
                                <li><a class="dropdown-item" href="profile.php">Profile</a></li>
                                <li><a class="dropdown-item" href="setting.php">Settings</a></li>
                                <hr class="dropdown-divider">
                                <li><a class="dropdown-item" href="logout.php">Logout</a></li>
                            </ul>
                        </li>
                    </ul>
                <?php } else { ?>
                    <ul class="navbar-nav ms-auto">
                        <li class="nav-item">
                            <a href="register.php" class="btn btn-outline-success me-2">Register</a>
                        </li>
                        <li class="nav-item">
                            <a href="login.php" class="btn btn-primary me-2">Login</a>
                        </li>
                    </ul>
                <?php } ?>
            </div>
        </div>
    </nav>