<?php
include_once 'Dbconfig.php';
class Uid extends Dbconfig{

  function uid(){
        $sql = "SELECT uid FROM latest_uid ORDER BY id DESC LIMIT 1;";
        $result=mysqli_query($this->con,$sql);
        $resArray=mysqli_fetch_assoc($result);
        return $resArray;
  }
  function insertuid($uid){
    $sql = "INSERT INTO latest_uid (uid) VALUES ('$uid') ON DUPLICATE KEY UPDATE uid='$uid'";
    $result=mysqli_query($this->con,$sql);
    if(isset($result)) {
        // Delete older UIDs, keeping only the latest 3
        $deleteQuery = "DELETE FROM latest_uid WHERE id NOT IN (
                            SELECT id FROM (
                                SELECT id FROM latest_uid ORDER BY id DESC LIMIT 1
                            ) AS temp
                        )";
        // $conn->query($deleteQuery);
        $resulta=mysqli_query($this->con,$deleteQuery);

        return "UID Updated Successfully";
    } else {
        return "Error updating UID";
    }
  }
}
  ?>