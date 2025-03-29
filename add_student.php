<?php
include_once "./classes/Student.php";
$s = new Student();
$response = array();

if ($_SERVER['REQUEST_METHOD'] == 'POST' && isset($_POST['js_data'])) {
    $uida = $_POST['js_data']; // Fetch UID from AJAX
    $data = $s->getbyuid($uida); // Fetch student data by UID

    if ($data) {
        $response['status_code'] = 200;
        $response['message'] = "Student found";
        $response['student'] = $data;
    } else {
        $response['status_code'] = 404;
        $response['message'] = "No student found for this UID";
    }

    header('Content-Type: application/json');
    echo json_encode($response);
    exit;
}

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

<!DOCTYPE html>
<html>

<head>
    <title>Add Student</title>
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
</head>

<body>

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
    <p id="phpOutput"></p>

    <script>
        let a = null;  // Stores the current UID
let b = null;  // Stores the previous UID

        async function fetchUID() {
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
            let newUID = await fetchUID(); // Fetch the latest UID
            if (newUID !== null) {
                if (a === newUID) {
                    // console.log("UID has not changed. Running xvb()");
                   // Call xvb() if UID is unchanged
                   return;
                }else{
                      data();
                }

                // Update values for next comparison
                b = a;
                a = newUID;
            }
        }

        async function data() {
            let jsVariable = await fetchUID(); // Wait for fetchUID() to complete
            $.ajax({
                url: "http://localhost/Rfid/add_student.php",
                type: "POST",
                data: {
                    js_data: jsVariable
                },
                dataType: "json",
                success: function(response) {
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

</body>

</html>