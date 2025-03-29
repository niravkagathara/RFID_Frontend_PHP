<?php
require_once 'auth_check.php';
require "../classes/Student.php";
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
}?>