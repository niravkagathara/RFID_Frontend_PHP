<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta content="width=device-width, initial-scale=1.0" name="viewport">

    <title>game developers</title>
    <meta content="" name="description">
    <meta content="" name="keywords">

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

    <!-- =======================================================
  * Template Name: NiceAdmin
  * Template URL: https://bootstrapmade.com/nice-admin-bootstrap-admin-html-template/
  * Updated: Apr 20 2024 with Bootstrap v5.3.3
  * Author: BootstrapMade.com
  * License: https://bootstrapmade.com/license/
  ======================================================== -->
</head>
<?php
require_once 'auth_check.php';
require "../classes/Student.php";
$s = new Student();
$response = array();

?>

<body>

    <!-- ======= Header ======= -->
    <?php require_once 'header.php'; ?>
    <!-- ======= Sidebar ======= -->
    <?php require_once 'sidebar.php'; ?>
    <main id="main" class="main">
        <div class="pagetitle">
            <h1>Student Details</h1>
            <nav>
                <ol class="breadcrumb">
                    <li class="breadcrumb-item"><a href="index.html">Home</a></li>
                    <li class="breadcrumb-item active">Student Details</li>
                </ol>
            </nav>
        </div><!-- End Page Title -->

        <section class="section">
            <div class="row">
                <div class="col-lg-12">

                    <div class="card">
                        <div class="card-body">
                            <h5 class="card-title">Current RFID Scan</h5>
                            
                            <!-- Student Details Card -->
                            <div class="card shadow-sm">
    <div class="card-header  text-white">
        <h5 class="card-title mb-0">Student Information</h5>
    </div>
    <div class="card-body">
        <div class="row mb-4">
            <div class="col-md-12">
                <div class="input-group">
                    <span class="input-group-text bg-light">UID:</span>
                    <input type="text" class="form-control form-control-lg" id="uid" readonly>
                    <button class="btn btn-outline-secondary" type="button" id="copyUidBtn">
                        <i class="bi bi-clipboard"></i> Copy
                    </button>
                </div>
            </div>
        </div>
        
        <!-- Student Details Section -->
        <div id="studentDetails" style="display: none;">
            <div class="student-profile-section mb-4 p-3 border rounded">
                <h6 class="section-title text-primary mb-3">Personal Information</h6>
                <div class="row">
                    <div class="col-md-4 mb-3">
                        <div class="detail-item">
                            <span class="detail-label">Name</span>
                            <p id="name" class="detail-value font-weight-bold"></p>
                        </div>
                    </div>
                    <div class="col-md-4 mb-3">
                        <div class="detail-item">
                            <span class="detail-label">Enrollment No</span>
                            <p id="enrollment" class="detail-value"></p>
                        </div>
                    </div>
                    <div class="col-md-4 mb-3">
                        <div class="detail-item">
                            <span class="detail-label">Roll No</span>
                            <p id="rollno" class="detail-value"></p>
                        </div>
                    </div>
                </div>
            </div>
            
            <div class="student-profile-section mb-4 p-3 border rounded">
                <h6 class="section-title text-primary mb-3">Academic Information</h6>
                <div class="row">
                    <div class="col-md-4 mb-3">
                        <div class="detail-item">
                            <span class="detail-label">Semester</span>
                            <p id="semester" class="detail-value"></p>
                        </div>
                    </div>
                    <div class="col-md-4 mb-3">
                        <div class="detail-item">
                            <span class="detail-label">Branch</span>
                            <p id="branch" class="detail-value"></p>
                        </div>
                    </div>
                    <div class="col-md-4 mb-3">
                        <div class="detail-item">
                            <span class="detail-label">Batch</span>
                            <p id="batch" class="detail-value"></p>
                        </div>
                    </div>
                    <div class="col-md-4 mb-3">
                        <div class="detail-item">
                            <span class="detail-label">Division</span>
                            <p id="division" class="detail-value"></p>
                        </div>
                    </div>
                </div>
            </div>
            
            <div class="text-center mt-4" id="editButtonContainer">
                <button class="btn btn-primary px-4" id="editButton">
                    <i class="bi bi-pencil-square me-2"></i>Edit Student Details
                </button>
                <input type="hidden" id="studentId">
            </div>
        </div>
        
        <!-- No Student Found Section -->
        <div id="noStudent" class="text-center py-4" style="display: none;">
            <div class="alert alert-warning d-inline-block">
                <i class="bi bi-exclamation-triangle-fill me-2"></i>
                No student found with this UID!
            </div>
            <div class="mt-3" id="addButtonContainer">
                <button class="btn btn-success px-4" id="addButton">
                    <i class="bi bi-plus-circle me-2"></i>Add New Student
                </button>
            </div>
        </div>
    </div>
</div>

<style>
    .card {
        border-radius: 10px;
        overflow: hidden;
    }
    
    .card-header {
        padding: 1rem 1.5rem;
    }
    
    .student-profile-section {
        background-color: #f8f9fa;
    }
    
    .section-title {
        font-weight: 600;
        border-bottom: 2px solid #dee2e6;
        padding-bottom: 0.5rem;
    }
    
    .detail-item {
        padding: 0.5rem;
    }
    
    .detail-label {
        display: block;
        font-size: 0.8rem;
        color: #6c757d;
        font-weight: 500;
    }
    
    .detail-value {
        font-size: 1rem;
        color: #212529;
        margin-bottom: 0;
    }
    
    #uid {
        background-color: #f8f9fa;
        font-weight: bold;
    }
</style>

<!-- Bootstrap Icons (optional) -->
<link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.8.0/font/bootstrap-icons.css">
                            
                        </div>
                    </div>

                </div>
            </div>
        </section>
    </main>
    <p id="phpOutput"></p>
    <?php require_once 'footer.php'; ?>

    <script>
        let a = null; // Stores the current UID
        let b = null; // Stores the previous UID

        async function fetchUID() {
            // const apiUrl = "https://rfid-node-api-sql.vercel.app/rfid";
            const apiUrl = "http://localhost:80/Rfid/Getdata.php";

            try {
                const response = await fetch(apiUrl);
                const data = await response.json();

                if (data && data.uid) {
                    document.getElementById("uid").value = data.uid;
                    return data.uid; // ✅ Return the UID
                } else {
                    console.log("UID not found");
                    return null;
                }
            } catch (error) {
                console.error("Error fetching UID:", error);
                return null;
            }
        }

        async function checkUID() {
            let newUID = await fetchUID();
            if (newUID !== null && newUID !== a) {
                a = newUID; // Update current UID before making the request
                data();
            }
        }

        async function data() {
            let jsVariable = await fetchUID(); // Wait for fetchUID() to complete
            $.ajax({
                url: "http://localhost:80/Rfid/admin/data.php",
                type: "POST",
                data: {
                    js_data: jsVariable
                },
                dataType: "json",
                success: function(response) {
                    if (typeof response === 'string') {
                        response = JSON.parse(response);
                    }
                    
                    if (response.status_code === 200) {
                        // Show student details and hide "no student" message
                        $("#studentDetails").show();
                        $("#noStudent").hide();
                        
                        // Populate student data
                        $("#name").text(response.student.name);
                        $("#enrollment").text(response.student.enrollment);
                        $("#rollno").text(response.student.rollno);
                        $("#semester").text(response.student.semester);
                        $("#branch").text(response.student.branch);
                        $("#batch").text(response.student.batch);
                        $("#division").text(response.student.division);
                        $("#studentId").val(response.student.id);
                        
                    } else {
                        // Show "no student" message and hide student details
                        $("#studentDetails").hide();
                        $("#noStudent").show();
                    }
                },
                error: function(xhr, status, error) {
                    console.error("Error:", error);
                    document.getElementById("phpOutput").innerHTML = "Error retrieving student data.";
                }
            });
        }

        // Handle Add New Student button click
        $(document).on('click', '#addButton', function() {
            const uid = $("#uid").val();
            if (uid) {
                // window.location.href = `add_student.php?uid=${uid}`;
                window.location.href = `add_new_student.php`;

            }
        });

        // Handle Edit Student button click
        $(document).on('click', '#editButton', function() {
            const studentId = $("#studentId").val();
            const uid = $("#uid").val();

            if (studentId) {
                // window.location.href = `edit_student.php?uid=${uid}`;
                window.location.href = `check_data.php`;

            }
        });

        setInterval(checkUID, 1000);
        document.addEventListener("DOMContentLoaded", fetchUID);
    </script>

    <!-- ======= Footer ======= -->


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