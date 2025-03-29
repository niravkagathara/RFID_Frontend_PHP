<?php
include_once 'Dbconfig.php';
class Student extends Dbconfig{

  function getAll(){
    $sql = "SELECT * FROM students WHERE is_active = 1";
    $result=mysqli_query($this->con,$sql);
    $resArray = array();
    while($row=mysqli_fetch_assoc($result)){
        $resArray[]=$row;
    }
    return $resArray;
  }
  function getbyuid($uid){
    $sql = "SELECT * FROM students WHERE uid='$uid';";
    $result=mysqli_query($this->con,$sql);
    $resArray=mysqli_fetch_assoc($result);
    return $resArray;

  }
  function getById($id){
    $sql = "SELECT * FROM students WHERE id=$id;";
    $result=mysqli_query($this->con,$sql);
    $resArray=mysqli_fetch_assoc($result);
    return $resArray;
  }
  function deleteById($id){
    try {
      $this->con->begin_transaction();
      
      // Delete attendance
      $stmt = $this->con->prepare("DELETE FROM attendance WHERE student_id = ?");
      $stmt->bind_param("i", $id);
      $stmt->execute();
      
      // Delete student
      $stmt = $this->con->prepare("DELETE FROM students WHERE id = ?");
      $stmt->bind_param("i", $id);
      $stmt->execute();
      
      $this->con->commit();
      return "Student Record Deleted Successfully";
  } catch (Exception $e) {
      $this->con->rollback();
      return "Error deleting student: " . $e->getMessage();
  }
  }
  function updateById($input){
    extract($input);
    $sql = "UPDATE students SET uid='$uid', name='$name',enrollment='$enrollment',rollno='$rollno',semester='$semester',branch='$branch',batch='$batch',division='$division' WHERE id=$id;";
    mysqli_query($this->con,$sql);
    $resmeassage="Student Record Updated Successfully";
    return $resmeassage;
  }
  function addStudent($uid,$name,$enrollment,$rollno,$semester,$branch,$batch,$division){
    // extract($input);
    // print_r($input);
    $sql = "INSERT INTO students (id,uid,name,enrollment,rollno,semester,branch,batch,division) VALUES (null,'$uid','$name','$enrollment','$rollno',$semester,'$branch','$batch','$division');";
    mysqli_query($this->con,$sql);
    $resmeassage="Student Record Added Successfully";
    return $resmeassage;
  }

}
?>