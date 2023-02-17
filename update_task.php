<?php
include('conn.php');

if($_POST["task_id"])
{
 
 if($_POST['status'] == 0) {
    $status = 1;
 } else {
    $status = 0;
 }
 $data = array(
  ':status'  => $status,
  ':task_id'  => $_POST["task_id"]
 );

 $query = "
 UPDATE tasks 
 SET status = :status 
 WHERE task_id = :task_id
 ";

 $statement = $connect->prepare($query);

 if($statement->execute($data))
 {
  echo $status;
 }
}

?>
