<?php
include_once 'Dbconfig.php';
class Attendance extends Dbconfig {

    // Get all attendance records with student names
    function getAllWithStudents() {
        $sql = "SELECT a.*, s.name as student_name, s.uid, s.rollno, s.enrollment,s.semester,s.branch,s.batch,s.division 
                FROM attendance a
                JOIN students s ON a.student_id = s.id";
        $result = mysqli_query($this->con, $sql);
        $resArray = array();
        while($row = mysqli_fetch_assoc($result)) {
            $resArray[] = $row;
        }
        return $resArray;
    }
    function getByStudentId($studentId) {
        // Assuming you're using PDO
       
        $stmt = $this->con->prepare("SELECT * FROM attendance WHERE student_id = ? ORDER BY created_at DESC");
        $stmt->execute([$studentId]);
        $stmt->execute();
        $result = $stmt->get_result();
        return $result->fetch_all(MYSQLI_ASSOC);
    }
    // Get single attendance record by ID
    function getById($id) {
        $stmt = $this->con->prepare("SELECT * FROM attendance WHERE id = ?");
        $stmt->bind_param("i", $id);
        $stmt->execute();
        $result = $stmt->get_result();
        return $result->fetch_assoc();
    }

    // Delete attendance record
    function deleteById($id) {
        $stmt = $this->con->prepare("DELETE FROM attendance WHERE id = ?");
        $stmt->bind_param("i", $id);
        $stmt->execute();
        return "Attendance Record Deleted Successfully";
    }

    // Update attendance record
    function updateById($input) {
      // Ensure all required fields are present
      if (!isset($input['id'], $input['uid'], $input['student_id'], 
                $input['status'], $input['Date'], $input['time'])) {
          return "Missing required fields";
      }
  
      // Prepare the statement
      $stmt = $this->con->prepare("UPDATE attendance SET 
                                  uid = ?, 
                                  student_id = ?, 
                                  status = ?,
                                  Date = ?,
                                  time = ?
                                  WHERE id = ?");
      
      if (!$stmt) {
          error_log("Prepare failed: " . $this->con->error);
          return "Prepare failed";
      }
      
      // Bind parameters - note: 6 parameters now (1 less than before)
      $bind = $stmt->bind_param("sisssi", 
          $input['uid'],
          $input['student_id'],
          $input['status'],
          $input['Date'],
          $input['time'],
          $input['id']
      );
      
      if (!$bind) {
          error_log("Bind failed: " . $stmt->error);
          return "Bind failed";
      }
      
      $execute = $stmt->execute();
      if (!$execute) {
          error_log("Execute failed: " . $stmt->error);
          return "Execute failed: " . $stmt->error;
      }
      
      return "Attendance Record Updated Successfully";
  }

    // Add new attendance record
    function addAttendancea($data) {
        $stmt = $this->con->prepare("INSERT INTO attendance 
                                    (uid, student_id, status, Date, time, Date_time) 
                                    VALUES (?, ?, ?, ?, ?, ?)");
        $stmt->bind_param("sissss",
            $data['uid'],
            $data['student_id'],
            $data['status'],
            $data['Date'],
            $data['time'],
            $data['Date_time']
        );
        $stmt->execute();
        return "Attendance Record Added Successfully";
    }

    function addattendance($uid,$student_id,$status,$date,$time,$date_time){
        // extract($input);
        // print_r($input);
        $sql = "INSERT INTO attendance (id,uid,student_id,status,Date,time,Date_time) VALUES (null,'$uid','$student_id','$status','$date','$time','$date_time');";
        mysqli_query($this->con,$sql);
        $resmeassage="inserted success";
        return $resmeassage;
      }
    // Get attendance by student ID
    function getAttendanceByStudentId($student_id) {
        $stmt = $this->con->prepare("SELECT * FROM attendance WHERE student_id = ?");
        $stmt->bind_param("i", $student_id);
        $stmt->execute();
        $result = $stmt->get_result();
        $resArray = array();
        while($row = $result->fetch_assoc()) {
            $resArray[] = $row;
        }
        return $resArray;
    }
}
?>