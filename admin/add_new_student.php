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


if ($_SERVER['REQUEST_METHOD'] == 'POST' && isset($_POST['submit'])) {
    $id = $_POST['id'];
    $uid = $_POST['uid'];
    $name = $_POST['name'];
    $enrollment = $_POST['enrollment'];
    $rollno = $_POST['rollno'];
    $semester = $_POST['semester'];
    $branch = $_POST['branch'];
    $batch = $_POST['batch'];
    $division = $_POST['division'];

    if (!empty($id)) {
        $updateData = [
            'id' => $id,
            'uid' => $uid,
            'name' => $name,
            'enrollment' => $enrollment,
            'rollno' => $rollno,
            'semester' => $semester,
            'branch' => $branch,
            'batch' => $batch,
            'division' => $division
        ];
        $message = $s->updateById($updateData);
    } else {
        $message = $s->addStudent($uid, $name, $enrollment, $rollno, $semester, $branch, $batch, $division);
    }
    // echo "<script>alert('$message');</script>";
    // $url = "https://rfid-node-api-sql.vercel.app/rfid"; // API endpoint
    $url = "http://localhost:80/Rfid/Getdata.php"; // API endpoint

    // Data to send (message "abc")
    $data = array("msg" => $message);
    $jsonData = json_encode($data); // Convert array to JSON

    // cURL setup
    $ch = curl_init($url);
    curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
    curl_setopt($ch, CURLOPT_POST, true);
    curl_setopt($ch, CURLOPT_POSTFIELDS, $jsonData);
    curl_setopt($ch, CURLOPT_HTTPHEADER, array(
        'Content-Type: application/json',  // Set header for JSON
        'Content-Length: ' . strlen($jsonData)
    ));

    // Execute request
    $response = curl_exec($ch);
    curl_close($ch);

    // Decode JSON response
    $responseData = json_decode($response, true);

    // Output response
    // header('Content-Type: application/json');
    // if(isset($responseData)){
    //     echo json_encode($responseData);

    // }


}
?>

<body>

    <!-- ======= Header ======= -->
    <?php require_once 'header.php'; ?>
    <!-- ======= Sidebar ======= -->
    <?php require_once 'sidebar.php'; ?>
    <main id="main" class="main">
        <h2>Add Student</h2>
        <form method="POST" action="">
            <label>UID:</label>
            <input type="text" id="uid" name="uid" readonly><br><br>

            <label>Name:</label>
            <input type="text" name="name" id="name" required><br><br>

            <label>Enrollment:</label>
            <input type="text" name="enrollment" id="enrollment" required><br><br>

            <label>Roll No:</label>
            <input type="text" name="rollno" id="rollno" required><br><br>

            <label>Semester:</label>
            <input type="number" name="semester" id="semester" required><br><br>

            <label>Branch:</label>
            <input type="text" name="branch" id="branch" required><br><br>

            <label>Batch:</label>
            <input type="text" name="batch" id="batch" required><br><br>

            <label>Division:</label>
            <input type="text" name="division" id="division" required><br><br>
            <input type="hidden" hidden id="id" name="id"><br><br>

            <button type="submit" id="refreshButton" name="submit">Add Student</button>
        </form>
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
                        // document.getElementById("phpOutput").innerHTML = "Student found: " + response.student.name;

                        $("#name").val(response.student.name);
                        $("#id").val(response.student.id);
                        $("#enrollment").val(response.student.enrollment);
                        $("#rollno").val(response.student.rollno);
                        $("#semester").val(response.student.semester);
                        $("#branch").val(response.student.branch);
                        $("#batch").val(response.student.batch);
                        $("#division").val(response.student.division);
                    } else {
                        // document.getElementById("phpOutput").innerHTML = "No student found!";
                        $("#name").val('');
                        $("#id").val('');
                        $("#enrollment").val('');
                        $("#rollno").val('');
                        $("#semester").val('');
                        $("#branch").val('');
                        $("#batch").val('');
                        $("#division").val('');
                    }
                },
                error: function(xhr, status, error) {
                    console.error("Error:", error);
                    document.getElementById("phpOutput").innerHTML = "Error retrieving student data.";
                }
            });
        }

        // setInterval(fetchUID, 3000);
        // window.onload = async function() {
        //     await fetchUID(); // Fetch UID when the page loads
        //     await data(); // Fetch UID when the page loads

        // };
        document.getElementById("refreshButton").addEventListener("click", async function() {
            await fetchUID(); // Refresh UID when the button is clicked
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