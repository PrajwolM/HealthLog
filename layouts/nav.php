<?php include '../layouts/header.php'?>
    <nav class="pe-3 ps-3 navbar navbar-expand-lg bg-body-tertiary">
        <div class="container-fluid">
            <a class="navbar-brand" href="index.php">            
                <i class="fa-solid fa-heart-pulse"></i> <span>HealthLogs</span>
            </a>

            <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
                <span class="navbar-toggler-icon"></span>
            </button>
            <div class="collapse navbar-collapse" id="navbarSupportedContent">
                <ul class="navbar-nav me-auto mb-2 mb-lg-0">
                    <li class="nav-item">
                        <a class="nav-link active" aria-current="page" href="index.php">Home</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="../pages/services.php">Services</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="../pages/doctor-details.php">Doctors</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="../pages/contact.php">Contact</a>
                    </li>
                </ul>
                <a class="nav-link login-link" href="../pages/login.php">Login</a>
            </div>
        </div>
    </nav> 