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
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Student Profile</title>
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
                        <h3 class="text-center">Student Profile</h3>
                    </div>
                    <div class="card-body">
                        <div class="row mb-3">
                            <div class="col-md-4 fw-bold">ID:</div>
                            <div class="col-md-8"><?php echo $studentData['id']; ?></div>
                        </div>
                        <div class="row mb-3">
                            <div class="col-md-4 fw-bold">UID:</div>
                            <div class="col-md-8"><?php echo $studentData['uid']; ?></div>
                        </div>
                        <div class="row mb-3">
                            <div class="col-md-4 fw-bold">Name:</div>
                            <div class="col-md-8"><?php echo $studentData['name']; ?></div>
                        </div>
                        <div class="row mb-3">
                            <div class="col-md-4 fw-bold">Enrollment:</div>
                            <div class="col-md-8"><?php echo $studentData['enrollment']; ?></div>
                        </div>
                        <div class="row mb-3">
                            <div class="col-md-4 fw-bold">Roll No:</div>
                            <div class="col-md-8"><?php echo $studentData['rollno']; ?></div>
                        </div>
                        <div class="row mb-3">
                            <div class="col-md-4 fw-bold">Semester:</div>
                            <div class="col-md-8"><?php echo $studentData['semester']; ?></div>
                        </div>
                        <div class="row mb-3">
                            <div class="col-md-4 fw-bold">Branch:</div>
                            <div class="col-md-8"><?php echo $studentData['branch']; ?></div>
                        </div>
                        <div class="row mb-3">
                            <div class="col-md-4 fw-bold">Batch:</div>
                            <div class="col-md-8"><?php echo $studentData['batch']; ?></div>
                        </div>
                        <div class="row mb-3">
                            <div class="col-md-4 fw-bold">Division:</div>
                            <div class="col-md-8"><?php echo $studentData['division']; ?></div>
                        </div>
                        <div class="text-center mt-4">
                            <a href="students.php" class="btn btn-primary">Back to Students</a>
                            <a href="edit_student_crud.php?id=<?php echo $studentData['id']; ?>" class="btn btn-warning">Edit Profile</a>
                        </div>
                    </div>
                </div>
                
                <!-- Attendance Records Section -->
                <div class="card mt-4">
                    <div class="card-header">
                        <h4 class="text-center">Attendance Records</h4>
                    </div>
                    <div class="card-body">
                        <?php
                        // Assuming you have an Attendance class to fetch records
                        include_once '../classes/Attendance.php';
                        $attendance = new Attendance();
                        $attendanceRecords = $attendance->getByStudentId($studentData['id']);
                        
                        if (!empty($attendanceRecords)) {
                        ?>
                        <div class="table-responsive">
                            <table class="table table-bordered">
                                <thead>
                                    <tr>
                                        <th>ID</th>
                                        <th>Status</th>
                                        <th>Date</th>
                                        <th>Time</th>
                                        <th>Created At</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <?php foreach ($attendanceRecords as $record): ?>
                                    <tr>
                                        <td><?php echo $record['id']; ?></td>
                                        <td><?php echo $record['status']; ?></td>
                                        <td><?php echo $record['Date'] != '0000-00-00' ? $record['Date'] : 'N/A'; ?></td>
                                        <td><?php echo $record['time'] != '00:00:00' ? $record['time'] : 'N/A'; ?></td>
                                        <td><?php echo $record['created_at']; ?></td>
                                    </tr>
                                    <?php endforeach; ?>
                                </tbody>
                            </table>
                        </div>
                        <?php } else { ?>
                            <p class="text-center">No attendance records found for this student.</p>
                        <?php } ?>
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