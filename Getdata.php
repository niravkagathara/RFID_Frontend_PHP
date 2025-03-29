<?php
header("Content-Type: application/json");
header("Access-Control-Allow-Origin: *");
header("Access-Control-Allow-Methods: POST, GET,OPTIONS");
header("Access-Control-Allow-Headers: Content-Type, Access-Control-Allow-Headers, Authorization, X-Requested-With");

date_default_timezone_set('Asia/Kolkata');
$d = date("Y-m-d");
$t = date("H:i:sa");
$dt = date("Y-m-d H:i:sa");
include_once "./classes/Student.php";
$s = new Student();
include_once "./classes/Attendance.php";
$a = new attendance();
include_once "./classes/latest_uid.php";
$l = new Uid();
$resObj = array();
// $data = ""; // Default value for $data
// Read input JSON data
$data = json_decode(file_get_contents("php://input"), true);

$method = $_SERVER['REQUEST_METHOD'];


if ($method == 'POST') {
    if (isset($data['uid'])) {
        $uid = $data["uid"];
        $insert = $l->insertuid($uid);
        if ($insert == "UID Updated Successfully") {
            $msg = "latest uid inserted";
        }
        // $uid=$_GET['uid'];
        // $uida=$conn->real_escape_string($data["uid"]);
        $dataa = $s->getbyuid($uid);
        // print_r($dataa);
        if (isset($dataa)) {
            extract($data);
            $enrollment = $dataa['enrollment'];
            $student_id = $dataa['id'];
            $name = $dataa['name'];
            $rollno = $dataa['rollno'];
            $uida = $dataa['uid'];

            $status = 'Present';
            $attendance_data = $a->addattendance($uida, $student_id, $status, $d, $t, $dt);
            if ($attendance_data == 'inserted success') {
                $resObj['status_code'] = 200;
                $resObj['message1'] =  "    Present    ";
                $resObj['message2'] = "$enrollment  ";
            }
            // else{
            //     $resObj['status_code'] = 300;
            //     // $resObj['message1'] =  '  '.$enrollment.'  ';
            //     $resObj['message2'] = "Not Allowed!";
            // }
        } else {
            $resObj['status_code'] = 301;
            // $resObj['message1'] =  '  '.$enrollment.'  ';
            $resObj['message2'] = "Not Allowed!";
        }
        // else{
        //     //write here add student code
        //     $resObj['status_code'] = 300;
        //     $resObj['message1'] = "Data Not found ";
        //     $resObj['message2'] = "OR not register";

        // }
    } else if (isset($data['msg'])) {
        if ($data['msg'] == "Student Record Added Successfully") {
            $resObj['status_code'] = 302;
            $resObj['message1'] = "Add new student";
            $resObj['message2'] = "  Successfully  ";
        } else if ($data['msg'] == "Student Record Updated Successfully") {
            $resObj['status_code'] = 303;
            $resObj['message1'] = "Student updated";
            $resObj['message2'] = "  Successfully  ";
        } else {
            $resObj['status_code'] = 304;
            $resObj['message1'] = " Add or Update ";
            $resObj['message2'] = "     Error     ";
        }
    } else {
        $resObj['status_code'] = 404;
        $resObj['message1'] = "Api error or system error";
        $resObj['message2'] = "          ";
    }
} elseif ($method === "GET") {
    // $result = $conn->query("SELECT * FROM students");
    // // $students = [];
    // while ($row = $result->fetch_assoc()) {
    //     $students[] = $row;
    // }

    $students = $l->uid();
    extract($students);
    $uida = $students['uid'];
    // echo $uid;
    $resObj['uid'] = $uida;
    // echo json_encode($students);

} else {
    $resObj['status_code'] = 405;
    $resObj['message2'] = "Invalid Method";
}
// $conn->close();

// echo(json_encode($resObj));
// header('Content-Type: application/json');
echo json_encode($resObj, JSON_PRETTY_PRINT);
