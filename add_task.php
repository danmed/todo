<?php
include('conn.php');

if($_POST["task_name"])
{
 $data = array(
  ':task_name' => trim($_POST["task_name"]),
  ':person_name' => trim($_POST["person_name"]),
 );

 $query = "
 INSERT INTO tasks 
 (task, person) 
 VALUES (:task_name, :person_name)
 ";

 $statement = $connect->prepare($query);

 if($statement->execute($data))
 {
  $task = $connect->lastInsertId();


  
  $result = "<li class=\"list-group-item d-flex justify-content-between align-items-start\" id=\"list-group-item-$task\" data-id=$task>
            <div class=\"ms-2 me-auto\">
                <div class=\"fw-bold\">$_POST[task_name]</div>
                $_POST[person_name]
            </div>
            <span class=\"badge bg-danger rounded-pill\" data-id=$task>Delete</span>
            </li>";
  echo $result;
 }
}


?>
