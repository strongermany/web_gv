<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Instructor Dashboard</title>
    <!-- Bootstrap CSS -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/css/bootstrap.min.css" rel="stylesheet">
    <!-- Custom CSS -->
    <link rel="stylesheet" href="<?php echo Base_URL ?>public/css/styles.css">
    <style>
        .dropdown-menu {
            z-index: 9999;
            position: absolute !important;
            display: block !important;
        }
    </style>

    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@400;600&family=Open+Sans:wght@400;600&display=swap" rel="stylesheet">
</head>

<body>
    <header class="bg-primary text-white py-3">
        <div class="container">
            <h1 class="text-center">Instructor Dashboard</h1>
            <nav class="navbar navbar-expand-lg navbar-light bg-light mt-3">
                <div class="container-fluid">
                    <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNav" aria-controls="navbarNav" aria-expanded="false" aria-label="Toggle navigation">
                        <span class="navbar-toggler-icon"></span>
                    </button>
                    <div class="collapse navbar-collapse" id="navbarNav">
                        <ul class="navbar-nav mx-auto">
                            <li class="nav-item"><a class="nav-link" href="homePage.php">Home</a></li>
                            <li class="nav-item"><a class="nav-link" href="uploadDocuments.php">Upload Documents</a></li>
                            <li class="nav-item"><a class="nav-link" href="enterGrades.php">Enter Grades</a></li>
                            <li class="nav-item"><a class="nav-link" href="takeAttendance.php">Take Attendance</a></li>
                            <li class="nav-item"><a class="nav-link" href="login.php">Logout</a></li>
                            <!-- Dropdown for Class Types -->
                            <li class="nav-item dropdown">
                                <a class="nav-link dropdown-toggle" href="#" id="classDropdown" role="button" data-bs-toggle="dropdown" aria-expanded="false">
                                    Select Class
                                </a>
                                <ul class="dropdown-menu" aria-labelledby="classDropdown">
                                    <?php if (!empty($list) && is_array($list)): ?>
                                        <?php foreach ($list as $value): ?>
                                            <li>
                                                <a class="dropdown-item" href="classDetails.php?id=<?php echo htmlspecialchars($value['Id_class']); ?>">
                                                    <?php echo htmlspecialchars($value['Name_class']); ?>
                                                </a>
                                            </li>
                                        <?php endforeach; ?>
                                    <?php else: ?>
                                        <li><span class="dropdown-item text-muted">No classes available</span></li>
                                    <?php endif; ?>
                                </ul>
                            </li>
                        </ul>
                    </div>
                </div>
            </nav>
        </div>
    </header>
    <!-- Bootstrap JS -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/js/bootstrap.bundle.min.js"></script>
</body>

</html>