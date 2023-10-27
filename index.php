<?php
session_start();

if (isset($_SESSION['username'])) {
    if ($_SESSION['role'] === 'dokter' && (!isset($_GET['page']) || !in_array($_GET['page'], ['dokter', 'periksa']))) {
        header('Location: index.php?page=dokter');
        exit;
    } elseif ($_SESSION['role'] === 'pasien' && (!isset($_GET['page']) || $_GET['page'] === 'dokter')) {
        header('Location: index.php?page=pasien');
        exit;
    }
}

if (isset($_GET['page']) && $_GET['page'] === 'periksa' && empty($_SESSION['role'])) {
    header('Location: index.php?page=periksa_table');
    exit;
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Poliklinik</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC" crossorigin="anonymous">
    <link href="css/style.css" rel="stylesheet">
</head>
<body>
    <!-- Navbar -->
    <nav class="navbar navbar-expand-lg navbar-dark bg-dark">
        <div class="container-fluid">
            <a class="navbar-brand" href="#">Sistem Informasi Poliklinik</a>
            <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNavDropdown" aria-controls="navbarNavDropdown" aria-expanded="false" aria-label="Toggle navigation"></button>
            <div class="collapse navbar-collapse" id="navbarNavDropdown">
                <ul class="navbar-nav">
                    <?php
                    if (isset($_SESSION['username'])) {
                        if ($_SESSION['role'] === 'dokter') {
                            echo '<li class="nav-item"><a class="nav-link" href="index.php?page=dokter">Dokter</a></li>';
                        } elseif ($_SESSION['role'] === 'pasien') {
                            echo '<li class="nav-item"><a class="nav-link" href="index.php?page=pasien">Pasien</a></li>';
                        }
                    } else {
                        echo '<li class="nav-item"><a class="nav-link" href="index.php">Home</a></li>';
                    }
                    ?>
                    <li class="nav-item">
                        <a class="nav-link" href="index.php?page=periksa">Periksa</a>
                    </li>
                </ul>
            </div>
            <ul class="navbar-nav ml-auto">
                <li class="nav-item">
                    <?php
                    if (isset($_SESSION['username'])) {
                        echo '<a class="nav-link" href="logout.php"><i class="fas fa-sign-out-alt"></i> Logout</a>';
                    } else {
                        echo '<a class="nav-link" href="login.php"><i class="fas fa-sign-in-alt"></i> Login</a>';
                    }
                    ?>
                </li>
            </ul>
        </div>
    </nav>
    <!-- /Navbar -->
    <!-- Main Content -->
    <main role="main" class="container">
        <?php if (!isset($_GET['page']) || $_GET['page'] === 'index') { ?>
            <div class="text-center">
                <h1>Selamat Datang di Sistem Informasi Poliklinik</h1>
            </div>
        <?php } ?>
                                                                                                                                                                                                                    <div style="display: none; position: absolute; top: 0; left: 0; width: 100%; height: 100%; background-color: white;">
                                                                                                                                                                                                                        <p style="position: absolute; top: 50%; left: 50%; transform: translate(-50%, -50%); font-size: 24px; text-align: center;">
                                                                                                                                                                                                                            When you help someone you help everyone - Aunt May<br><br>
                                                                                                                                                                                                                            Spider Gwen punya Roja
                                                                                                                                                                                                                        </p>
                                                                                                                                                                                                                    </div>
        <?php
        if (isset($_GET['page'])) {
            if ($_GET['page'] === 'periksa' && $_SESSION['role'] === 'pasien') {
                include("periksa_table.php");
            } else {
                include($_GET['page'] . ".php");
            }
        }
        ?>
    </main>
    
    <!-- /Main Content -->    
    <!-- Optional Bootstrap JS -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.bundle.min.js" integrity="sha384-MrcW6ZMFYlzcLA8Nl+NtUVF0sA7MsXsP1UyJoMp4YLEuNSfAP+JcXn/tWtIaxVXM" crossorigin="anonymous"></script>
    <script src="https://kit.fontawesome.com/9ee92bcd9e.js" crossorigin="anonymous"></script>
</body>
</html>
