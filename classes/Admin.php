<?php
include_once 'Dbconfig.php';
class Admin extends Dbconfig
{
function checklogin($input)
{
  extract($input);

  $sql = "SELECT * FROM admin_table WHERE admin_email_address = ? AND admin_password = ?;";

  $stGetByIdStu = mysqli_prepare($this->con, $sql);

  //binding parameters to sql prepare statement
  mysqli_stmt_bind_param($stGetByIdStu, 'ss', $email, $password);

  //executing sql prepare statement
  mysqli_stmt_execute($stGetByIdStu);
  $res = mysqli_stmt_get_result($stGetByIdStu);
  $resArray = mysqli_fetch_assoc($res);
  return $resArray;
}
function getById($id)
  {
    $sql = "SELECT * FROM admin_table WHERE admin_id=?;";
    $stGetByIdStu = mysqli_prepare($this->con, $sql);

    //binding parameters to sql prepare statement
    mysqli_stmt_bind_param($stGetByIdStu, 'i', $id);

    //executing sql prepare statement
    mysqli_stmt_execute($stGetByIdStu);
    $res = mysqli_stmt_get_result($stGetByIdStu);
    $resArray = mysqli_fetch_assoc($res);
    return $resArray;
  }
}
?>