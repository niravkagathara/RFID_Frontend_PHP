<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Student Attendance Filter</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
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
    <style>
        .filter-section {
            background-color: #f8f9fa;
            padding: 20px;
            border-radius: 5px;
            margin-bottom: 20px;
        }
        .result-table {
            margin-top: 20px;
        }
        .loading {
            display: none;
            text-align: center;
            padding: 20px;
        }
        .pagination-info {
            margin: 10px 0;
            font-weight: bold;
        }
        table {
            font-size: 0.9rem;
        }
        th {
            white-space: nowrap;
        }
    </style>
</head>
<body>
    <?php require_once 'auth_check.php';
?>  <?php require_once 'header.php'; ?>
<!-- ======= Sidebar ======= -->
<?php require_once 'sidebar.php'; ?>
<main id="main" class="main">
    <div class="container mt-4">
        <h2 class="mb-4">Student Attendance Filter</h2>
        
        <div class="filter-section">
            <form id="filterForm">
                <div class="row g-3">
                    <!-- Student Info Filters -->
                    <div class="col-md-4">
                        <label for="uid" class="form-label">Student UID</label>
                        <input type="text" class="form-control" id="uid" name="uid" placeholder="Enter UID">
                    </div>
                    
                    <div class="col-md-4">
                        <label for="name" class="form-label">Student Name</label>
                        <input type="text" class="form-control" id="name" name="name" placeholder="Enter name">
                    </div>
                    
                    <div class="col-md-4">
                        <label for="status" class="form-label">Attendance Status</label>
                        <select class="form-select" id="status" name="status">
                            <option value="">All Statuses</option>
                            <option value="Present">Present</option>
                            <option value="Absent">Absent</option>
                        </select>
                    </div>
                    
                    <!-- Roll Number Filters -->
                    <div class="col-md-3">
                        <label for="rollno" class="form-label">Exact Roll No</label>
                        <input type="number" class="form-control" id="rollno" name="rollno" placeholder="Exact roll no">
                    </div>
                    
                    <div class="col-md-3">
                        <label for="rollno_from" class="form-label">Roll No From</label>
                        <input type="number" class="form-control" id="rollno_from" name="rollno_from" placeholder="From">
                    </div>
                    
                    <div class="col-md-3">
                        <label for="rollno_to" class="form-label">Roll No To</label>
                        <input type="number" class="form-control" id="rollno_to" name="rollno_to" placeholder="To">
                    </div>
                    
                    <div class="col-md-3">
                        <label for="semester" class="form-label">Semester</label>
                        <select class="form-select" id="semester" name="semester">
                            <option value="">All Semesters</option>
                            <option value="1">1</option>
                            <option value="2">2</option>
                            <option value="3">3</option>
                            <option value="4">4</option>
                            <option value="5">5</option>
                            <option value="6">6</option>
                        </select>
                    </div>
                    
                    <!-- Branch/Batch/Division -->
                    <div class="col-md-4">
                        <label for="branch" class="form-label">Branch</label>
                        <select class="form-select" id="branch" name="branch">
                            <option value="">All Branches</option>
                            <option value="CSE">CSE</option>
                            <option value="ECE">ECE</option>
                            <option value="ME">ME</option>
                            <option value="EE">EE</option>
                            <option value="CE">CE</option>
                        </select>
                    </div>
                    
                    <div class="col-md-4">
                        <label for="batch" class="form-label">Batch</label>
                        <input type="text" class="form-control" id="batch" name="batch" placeholder="Enter batch">
                    </div>
                    
                    <div class="col-md-4">
                        <label for="division" class="form-label">Division</label>
                        <select class="form-select" id="division" name="division">
                            <option value="">All Divisions</option>
                            <option value="A">A</option>
                            <option value="B">B</option>
                            <option value="C">C</option>
                        </select>
                    </div>
                    
                    <!-- Date/Time Filters -->
                    <div class="col-md-3">
                        <label for="date_from" class="form-label">Date From</label>
                        <input type="date" class="form-control" id="date_from" name="date_from">
                    </div>
                    
                    <div class="col-md-3">
                        <label for="date_to" class="form-label">Date To</label>
                        <input type="date" class="form-control" id="date_to" name="date_to">
                    </div>
                    
                    <div class="col-md-3">
                        <label for="time_from" class="form-label">Time From</label>
                        <input type="time" class="form-control" id="time_from" name="time_from">
                    </div>
                    
                    <div class="col-md-3">
                        <label for="time_to" class="form-label">Time To</label>
                        <input type="time" class="form-control" id="time_to" name="time_to">
                    </div>
                    
                    <!-- Action Buttons -->
                    <div class="col-12 text-center mt-3">
                        <button type="submit" class="btn btn-primary me-2">
                            <i class="bi bi-funnel"></i> Apply Filters
                        </button>
                        <button type="button" id="resetFilters" class="btn btn-secondary">
                            <i class="bi bi-arrow-counterclockwise"></i> Reset
                        </button>
                    </div>
                </div>
            </form>
        </div>
        
        <!-- Loading Indicator -->
        <div id="loading" class="loading">
            <div class="spinner-border text-primary" role="status">
                <span class="visually-hidden">Loading...</span>
            </div>
            <p>Loading data...</p>
        </div>
        
        <!-- Results Count -->
        <div id="resultsCount" class="pagination-info"></div>
        
        <!-- Results Table -->
        <div id="results" class="result-table">
            <div class="table-responsive">
                <table class="table table-striped table-bordered table-hover">
                    <thead class="table-dark">
                        <tr>
                            <th>ID</th>
                            <th>UID</th>
                            <th>Name</th>
                            <th>Roll No</th>
                            <th>Semester</th>
                            <th>Branch</th>
                            <th>Status</th>
                            <th>Date</th>
                            <th>Time</th>
                        </tr>
                    </thead>
                    <tbody id="resultsBody">
                        <!-- Results will be populated here -->
                    </tbody>
                </table>
            </div>
        </div>
    </div>
</main>
<?php require_once 'footer.php'; ?>
    <!-- JavaScript Libraries -->
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
    <script>
        $(document).ready(function() {
            // Handle form submission
            $('#filterForm').on('submit', function(e) {
                e.preventDefault();
                loadFilteredData();
            });
            
            // Handle reset button
            $('#resetFilters').on('click', function() {
                $('#filterForm')[0].reset();
                $('#resultsBody').empty();
                $('#resultsCount').empty();
            });
            
            // Function to load filtered data
            function loadFilteredData() {
                $('#loading').show();
                $('#resultsBody').empty();
                
                // Get all form data
                const formData = $('#filterForm').serialize();
                
                $.ajax({
                    url: '../classes/filter_attendance.php',
                    type: 'POST',
                    data: formData,
                    dataType: 'json',
                    success: function(response) {
                        if (response.success) {
                            displayResults(response.data, response.count);
                        } else {
                            showError(response.error || 'Unknown error occurred');
                        }
                    },
                    error: function(xhr, status, error) {
                        let errorMsg = 'Error loading data';
                        try {
                            const response = JSON.parse(xhr.responseText);
                            if (response.error) errorMsg = response.error;
                        } catch (e) {
                            errorMsg = error;
                        }
                        showError(errorMsg);
                    },
                    complete: function() {
                        $('#loading').hide();
                    }
                });
            }
            
            // Function to display results
            function displayResults(data, count) {
                const $resultsBody = $('#resultsBody');
                $resultsBody.empty();
                
                if (count === 0) {
                    $resultsBody.html('<tr><td colspan="9" class="text-center">No records found matching your criteria</td></tr>');
                    $('#resultsCount').html('Showing 0 records');
                    return;
                }
                
                // Update count
                $('#resultsCount').html(`Showing ${count} records`);
                
                // Add data rows
                data.forEach(row => {
                    const $row = $('<tr>');
                    
                    $row.append(`<td>${row.id || ''}</td>`);
                    $row.append(`<td>${row.uid || ''}</td>`);
                    $row.append(`<td>${row.name || ''}</td>`);
                    $row.append(`<td>${row.rollno || ''}</td>`);
                    $row.append(`<td>${row.semester || ''}</td>`);
                    $row.append(`<td>${row.branch || ''}</td>`);
                    $row.append(`<td>${row.status || ''}</td>`);
                    $row.append(`<td>${row.Date || ''}</td>`);
                    $row.append(`<td>${row.time || ''}</td>`);
                    
                    $resultsBody.append($row);
                });
            }
            
            // Function to show error message
            function showError(message) {
                $('#resultsBody').html(`<tr><td colspan="9" class="text-center text-danger">${message}</td></tr>`);
                $('#resultsCount').empty();
            }
            
            // Load initial data if needed
            // loadFilteredData();
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