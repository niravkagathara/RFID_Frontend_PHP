<?php
include_once '../classes/Attendance.php';
include_once '../classes/Student.php';
require_once 'auth_check.php';

$attendance = new Attendance();
$student = new Student();

// Handle form submissions
if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    if (isset($_POST['add'])) {
        $result = $attendance->addAttendancea($_POST);
        header("Location: attendance.php");
        exit();
    } elseif (isset($_POST['update'])) {
        $result = $attendance->updateById($_POST);
        header("Location: attendance.php");
        exit();
    }
}

// Handle delete action
if (isset($_GET['delete'])) {
    $result = $attendance->deleteById($_GET['delete']);
    header("Location: attendance.php");
    exit();
}

$attendanceRecords = $attendance->getAllWithStudents();
$students = $student->getAll();
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Attendance Management</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="https://cdn.datatables.net/1.13.6/css/dataTables.bootstrap5.min.css">
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

<body>

    <?php require_once 'header.php'; ?>
    <!-- ======= Sidebar ======= -->
    <?php require_once 'sidebar.php'; ?>
    <main id="main" class="main">

        <div class="container mt-5">
            <h2>Attendance Records</h2>

            <!-- Add New Attendance Button -->
            <button class="btn btn-primary mb-3" data-bs-toggle="modal" data-bs-target="#addModal">
                Add New Attendance
            </button>

            <!-- Attendance Table -->
            <table id="attendanceTable" class="table table-striped">
                <thead>
                    <tr>
                        <th>ID</th>
                        <th>UID</th>
                        <th>Student Name</th>
                        <th>Roll Number</th>
                        <th>Enrollment</th>
                        <th>Uid</th>
                        <th>semester</th>
                        <th>division</th>
                        <th>branch</th>
                        <th>status</th>
                        <th>Date</th>
                        <th>Time</th>
                        <th>Actions</th>
                    </tr>
                </thead>
                <tbody>
                    <?php foreach ($attendanceRecords as $record): ?>
                        <tr>
                            <td><?= $record['id'] ?></td>
                            <td><?= $record['uid'] ?></td>
                            <td><?= $record['student_name'] ?></td>
                            <td><?= $record['rollno'] ?></td>
                            <td><?= $record['enrollment'] ?></td>
                            <td><?= $record['uid'] ?></td>
                            <td><?= $record['semester'] ?></td>
                            <td><?= $record['division'] ?></td>
                            <td><?= $record['branch'] ?></td>
                            <td><?= $record['status'] ?></td>

                            <td><?= $record['Date'] ?></td>
                            <td><?= $record['time'] ?></td>
                            <td>
                                <button class="btn btn-sm btn-warning edit-btn"
                                    data-id="<?= $record['id'] ?>"
                                    data-uid="<?= $record['uid'] ?>"
                                    data-student="<?= $record['student_id'] ?>"
                                    data-status="<?= $record['status'] ?>"
                                    data-date="<?= $record['Date'] ?>"
                                    data-time="<?= $record['time'] ?>">
                                    Edit
                                </button>
                                <a href="?delete=<?= $record['id'] ?>" class="btn btn-sm btn-danger"
                                    onclick="return confirm('Are you sure?')">Delete</a>
                            </td>
                        </tr>
                    <?php endforeach; ?>
                </tbody>
            </table>
        </div>

        <!-- Add Modal -->
        <div class="modal fade" id="addModal" tabindex="-1" aria-hidden="true">
            <div class="modal-dialog">
                <div class="modal-content">
                    <form method="POST">
                        <div class="modal-header">
                            <h5 class="modal-title">Add Attendance Record</h5>
                            <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                        </div>
                        <div class="modal-body">
                            <div class="mb-3">
                                <label class="form-label">UID</label>
                                <input type="text" name="uid" class="form-control" required>
                            </div>
                            <div class="mb-3">
                                <label class="form-label">Student</label>
                                <select name="student_id" class="form-select" required>
                                    <?php foreach ($students as $student): ?>
                                        <option value="<?= $student['id'] ?>"><?= $student['name'] ?></option>
                                    <?php endforeach; ?>
                                </select>
                            </div>
                            <div class="mb-3">
                                <label class="form-label">Status</label>
                                <select name="status" class="form-select" required>
                                    <option value="Present">Present</option>
                                    <option value="Absent">Absent</option>
                                    <option value="Late">Late</option>
                                </select>
                            </div>
                            <div class="mb-3">
                                <label class="form-label">Date</label>
                                <input type="date" name="Date" class="form-control" required>
                            </div>
                            <div class="mb-3">
                                <label class="form-label">Time</label>
                                <input type="time" name="time" class="form-control" required>
                            </div>
                            <input type="hidden" name="Date_time" value="<?= date('Y-m-d H:i:s') ?>">
                        </div>
                        <div class="modal-footer">
                            <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                            <button type="submit" name="add" class="btn btn-primary">Save</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>

        <!-- Edit Modal -->
        <div class="modal fade" id="editModal" tabindex="-1" aria-hidden="true">
            <div class="modal-dialog">
                <div class="modal-content">
                    <form method="POST">
                        <div class="modal-header">
                            <h5 class="modal-title">Edit Attendance Record</h5>
                            <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                        </div>
                        <div class="modal-body">
                            <input type="hidden" name="id" id="edit_id">
                            <div class="mb-3">
                                <label class="form-label">UID</label>
                                <input type="text" name="uid" id="edit_uid" class="form-control" required>
                            </div>
                            <div class="mb-3">
                                <label class="form-label">Student</label>
                                <select name="student_id" id="edit_student" class="form-select" required>
                                    <?php foreach ($students as $student): ?>
                                        <option value="<?= $student['id'] ?>"><?= $student['name'] ?></option>
                                    <?php endforeach; ?>
                                </select>
                            </div>
                            <div class="mb-3">
                                <label class="form-label">Status</label>
                                <select name="status" id="edit_status" class="form-select" required>
                                    <option value="Present">Present</option>
                                    <option value="Absent">Absent</option>
                                    <option value="Late">Late</option>
                                </select>
                            </div>
                            <div class="mb-3">
                                <label class="form-label">Date</label>
                                <input type="date" name="Date" id="edit_date" class="form-control" required>
                            </div>
                            <div class="mb-3">
                                <label class="form-label">Time</label>
                                <input type="time" name="time" id="edit_time" class="form-control" required>
                            </div>
                            <input type="hidden" name="Date_time" value="<?= date('Y-m-d H:i:s') ?>">
                        </div>
                        <div class="modal-footer">
                            <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                            <button type="submit" name="update" class="btn btn-primary">Update</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </main>
    <?php require_once 'footer.php'; ?>

    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
    <script src="https://cdn.datatables.net/1.13.6/js/jquery.dataTables.min.js"></script>
    <script src="https://cdn.datatables.net/1.13.6/js/dataTables.bootstrap5.min.js"></script>

    <script>
        $(document).ready(function() {
            $('#attendanceTable').DataTable();

            // Handle edit button click
            $('.edit-btn').click(function() {
                $('#edit_id').val($(this).data('id'));
                $('#edit_uid').val($(this).data('uid'));
                $('#edit_student').val($(this).data('student'));
                $('#edit_status').val($(this).data('status'));
                $('#edit_date').val($(this).data('date'));
                $('#edit_time').val($(this).data('time'));

                $('#editModal').modal('show');
            });
        });
    </script>

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