<?php
include_once '../classes/Student.php';
require_once 'auth_check.php';

if(!isset($_GET['id']) || empty($_GET['id'])) {
    header("Location: students.php");
    exit();
}

$student = new Student();
$studentData = $student->getById($_GET['id']);

if(!$studentData) {
    header("Location: students.php");
    exit();
}

if($_SERVER['REQUEST_METHOD'] == 'POST') {
    $input = $_POST;
    $input['id'] = $_GET['id'];
    $result = $student->updateById($input);
    
    header("Location: profile.php?id=".$_GET['id']."&success=".urlencode($result));
    exit();
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Edit Student</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
     <!-- Favicons -->
     <link href="assets/img/favicon.png" rel="icon">
    <link href="assets/img/apple-touch-icon.png" rel="apple-touch-icon">

    <!-- Google Fonts -->
    <link href="https://fonts.gstatic.com" rel="preconnect">
    <link href="https://fonts.googleapis.com/css?family=Open+Sans:300,300i,400,400i,600,600i,700,700i|Nunito:300,300i,400,400i,600,600i,700,700i|Poppins:300,300i,400,400i,500,500i,600,600i,700,700i" rel="stylesheet">

    <!-- Vendor CSS Files -->
    <link href="assets/vendor/bootstrap/css/bootstrap.min.css" rel="stylesheet">
    <link href="assets/vendor/bootstrap-icons/bootstrap-icons.css" rel="stylesheet">
    <link href="assets/vendor/boxicons/css/boxicons.min.css" rel="stylesheet">
    <link href="assets/vendor/quill/quill.snow.css" rel="stylesheet">
    <link href="assets/vendor/quill/quill.bubble.css" rel="stylesheet">
    <link href="assets/vendor/remixicon/remixicon.css" rel="stylesheet">
    <link href="assets/vendor/simple-datatables/style.css" rel="stylesheet">

    <!-- Template Main CSS File -->
    <link href="assets/css/style.css" rel="stylesheet">
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
</head>
<body> <?php require_once 'header.php'; ?>
    <!-- ======= Sidebar ======= -->
    <?php require_once 'sidebar.php'; ?>
    <main id="main" class="main">
    <div class="container mt-5">
        <div class="row">
            <div class="col-md-8 mx-auto">
                <div class="card">
                    <div class="card-header">
                        <h3 class="text-center">Edit Student</h3>
                    </div>
                    <div class="card-body">
                        <form method="POST">
                            <div class="mb-3">
                                <label for="uid" class="form-label">UID</label>
                                <input type="text" class="form-control" id="uid" name="uid" value="<?php echo $studentData['uid']; ?>" required>
                            </div>
                            <div class="mb-3">
                                <label for="name" class="form-label">Name</label>
                                <input type="text" class="form-control" id="name" name="name" value="<?php echo $studentData['name']; ?>" required>
                            </div>
                            <div class="mb-3">
                                <label for="enrollment" class="form-label">Enrollment</label>
                                <input type="text" class="form-control" id="enrollment" name="enrollment" value="<?php echo $studentData['enrollment']; ?>" required>
                            </div>
                            <div class="mb-3">
                                <label for="rollno" class="form-label">Roll No</label>
                                <input type="text" class="form-control" id="rollno" name="rollno" value="<?php echo $studentData['rollno']; ?>" required>
                            </div>
                            <div class="mb-3">
                                <label for="semester" class="form-label">Semester</label>
                                <input type="number" class="form-control" id="semester" name="semester" value="<?php echo $studentData['semester']; ?>" required>
                            </div>
                            <div class="mb-3">
                                <label for="branch" class="form-label">Branch</label>
                                <input type="text" class="form-control" id="branch" name="branch" value="<?php echo $studentData['branch']; ?>" required>
                            </div>
                            <div class="mb-3">
                                <label for="batch" class="form-label">Batch</label>
                                <input type="text" class="form-control" id="batch" name="batch" value="<?php echo $studentData['batch']; ?>" required>
                            </div>
                            <div class="mb-3">
                                <label for="division" class="form-label">Division</label>
                                <input type="text" class="form-control" id="division" name="division" value="<?php echo $studentData['division']; ?>" required>
                            </div>
                            <div class="text-center">
                                <button type="submit" class="btn btn-primary">Update Student</button>
                                <a href="profile.php?id=<?php echo $studentData['id']; ?>" class="btn btn-secondary">Cancel</a>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
    </main>
    <?php require_once 'footer.php'; ?>
    <a href="#" class="back-to-top d-flex align-items-center justify-content-center"><i class="bi bi-arrow-up-short"></i></a>

<!-- Vendor JS Files -->
<script src="assets/vendor/apexcharts/apexcharts.min.js"></script>
<script src="assets/vendor/bootstrap/js/bootstrap.bundle.min.js"></script>
<script src="assets/vendor/chart.js/chart.umd.js"></script>
<script src="assets/vendor/echarts/echarts.min.js"></script>
<script src="assets/vendor/quill/quill.js"></script>
<script src="assets/vendor/simple-datatables/simple-datatables.js"></script>
<script src="assets/vendor/tinymce/tinymce.min.js"></script>
<script src="assets/vendor/php-email-form/validate.js"></script>

<!-- Template Main JS File -->
<script src="assets/js/main.js"></script>
</body>
</html>