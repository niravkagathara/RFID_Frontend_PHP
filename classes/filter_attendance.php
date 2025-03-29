<?php
header('Content-Type: application/json');
require_once 'Dbconfig.php'; // Your database connection file

// Enable error reporting for debugging
error_reporting(E_ALL);
ini_set('display_errors', 1);

function filterAttendanceData($filters) {
    $conn = new Dbconfig;
    
    // Base query joining student and attendance tables
    $query = "SELECT a.*, s.name, s.enrollment, s.rollno, s.semester, s.branch, s.batch, s.division 
              FROM attendance a
              JOIN students s ON a.student_id = s.id
              WHERE 1=1"; // Start with a true condition for easier WHERE clause building
    
    $params = [];
    $types = '';
    
    // Process each possible filter
    if (!empty($filters['uid'])) {
        $query .= " AND a.uid = ?";
        $params[] = $filters['uid'];
        $types .= 's';
    }
    
    if (!empty($filters['student_id'])) {
        $query .= " AND a.student_id = ?";
        $params[] = $filters['student_id'];
        $types .= 'i';
    }
    
    if (!empty($filters['status'])) {
        $query .= " AND a.status = ?";
        $params[] = $filters['status'];
        $types .= 's';
    }
    
    // Date range filtering
    if (!empty($filters['date_from']) || !empty($filters['date_to'])) {
        if (!empty($filters['date_from']) && !empty($filters['date_to'])) {
            $query .= " AND a.Date BETWEEN ? AND ?";
            $params[] = $filters['date_from'];
            $params[] = $filters['date_to'];
            $types .= 'ss';
        } elseif (!empty($filters['date_from'])) {
            $query .= " AND a.Date >= ?";
            $params[] = $filters['date_from'];
            $types .= 's';
        } elseif (!empty($filters['date_to'])) {
            $query .= " AND a.Date <= ?";
            $params[] = $filters['date_to'];
            $types .= 's';
        }
    }
    
    // Time range filtering
    if (!empty($filters['time_from']) || !empty($filters['time_to'])) {
        if (!empty($filters['time_from']) && !empty($filters['time_to'])) {
            $query .= " AND a.time BETWEEN ? AND ?";
            $params[] = $filters['time_from'];
            $params[] = $filters['time_to'];
            $types .= 'ss';
        } elseif (!empty($filters['time_from'])) {
            $query .= " AND a.time >= ?";
            $params[] = $filters['time_from'];
            $types .= 's';
        } elseif (!empty($filters['time_to'])) {
            $query .= " AND a.time <= ?";
            $params[] = $filters['time_to'];
            $types .= 's';
        }
    }
    
    // Student information filtering
    if (!empty($filters['name'])) {
        $query .= " AND s.name LIKE ?";
        $params[] = '%' . $filters['name'] . '%';
        $types .= 's';
    }
    
    if (!empty($filters['rollno'])) {
        $query .= " AND s.rollno = ?";
        $params[] = $filters['rollno'];
        $types .= 'i';
    }
    
    if (!empty($filters['rollno_from']) && !empty($filters['rollno_to'])) {
        $query .= " AND s.rollno BETWEEN ? AND ?";
        $params[] = $filters['rollno_from'];
        $params[] = $filters['rollno_to'];
        $types .= 'ii';
    }
    
    if (!empty($filters['semester'])) {
        $query .= " AND s.semester = ?";
        $params[] = $filters['semester'];
        $types .= 'i';
    }
    
    if (!empty($filters['branch'])) {
        $query .= " AND s.branch = ?";
        $params[] = $filters['branch'];
        $types .= 's';
    }
    
    if (!empty($filters['batch'])) {
        $query .= " AND s.batch = ?";
        $params[] = $filters['batch'];
        $types .= 's';
    }
    
    if (!empty($filters['division'])) {
        $query .= " AND s.division = ?";
        $params[] = $filters['division'];
        $types .= 's';
    }
    
    // Add sorting by date and time
    $query .= " ORDER BY a.Date DESC, a.time DESC";
    
    // Prepare and execute the query
    $stmt = $conn->prepare($query);
    
    if (!empty($params)) {
        $stmt->bind_param($types, ...$params);
    }
    
    $stmt->execute();
    $result = $stmt->get_result();
    
    $data = [];
    while ($row = $result->fetch_assoc()) {
        $data[] = $row;
    }
    
    $stmt->close();
    $conn->close();
    
    return $data;
}

// Handle AJAX request
try {
    if ($_SERVER['REQUEST_METHOD'] === 'POST') {
        // Get filters from POST data
        $filters = [
            'uid' => $_POST['uid'] ?? '',
            'student_id' => $_POST['student_id'] ?? '',
            'status' => $_POST['status'] ?? '',
            'date_from' => $_POST['date_from'] ?? '',
            'date_to' => $_POST['date_to'] ?? '',
            'time_from' => $_POST['time_from'] ?? '',
            'time_to' => $_POST['time_to'] ?? '',
            'name' => $_POST['name'] ?? '',
            'rollno' => $_POST['rollno'] ?? '',
            'rollno_from' => $_POST['rollno_from'] ?? '',
            'rollno_to' => $_POST['rollno_to'] ?? '',
            'semester' => $_POST['semester'] ?? '',
            'branch' => $_POST['branch'] ?? '',
            'batch' => $_POST['batch'] ?? '',
            'division' => $_POST['division'] ?? ''
        ];
        
        // Filter out empty values
        $filters = array_filter($filters, function($value) {
            return $value !== '';
        });
        
        $data = filterAttendanceData($filters);
        
        echo json_encode([
            'success' => true,
            'data' => $data,
            'count' => count($data)
        ]);
    } else {
        echo json_encode([
            'success' => false,
            'error' => 'Invalid request method. Only POST allowed.'
        ]);
    }
} catch (Exception $e) {
    echo json_encode([
        'success' => false,
        'error' => $e->getMessage(),
        'trace' => $e->getTraceAsString()
    ]);
}
?>