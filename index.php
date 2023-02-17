<?php

//index.php

include('conn.php');

$query = "
 SELECT * FROM tasks 
 ORDER BY task_id DESC
";

$statement = $connect->prepare($query);

$statement->execute();

$result = $statement->fetchAll();

?>

<!doctype html>
<html lang="en">
  <head>
    <!-- Required meta tags -->
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <!-- Bootstrap CSS -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC" crossorigin="anonymous">

    <title>Todo App</title>
  </head>
  <body>
    <!-- Optional JavaScript; choose one of the two! -->
    <div class="container">
    <br>
    <h1 align="center">Todo App</h1>
    <br>
    <br>
    <div class="col-lg-12 g-2">
    <form method="post" id="to_do_form">
        <div class="row">
        
        <span id="message"></span>
            <div class="col">
                <input type="text" id="task_name" class="form-control" placeholder="Task name" aria-label="Task name">
            </div>
            <div class="col">
                <input type="text" id="person_name" class="form-control" placeholder="Person" aria-label="person name">
            </div>
            <div class="col">
            <button type="submit" id="add_task" class="btn btn-primary">Add Task</button>
        
        </form>
        </div>
    </div>
    <br>
    <br>
  <!-- On tables -->
  <div class="col-lg-12 g-4">
  <ol class="list-group list-group-numbered">
  <?php
       foreach($result as $row) {
        $style = '';
        if($row["status"] == '1')
        {
         $style = 'background-color : green';
        }
    ?>
  <li style="<?php echo $style;?>" class="list-group-item d-flex justify-content-between align-items-start" id="list-group-item-<?php echo $row['task_id'];?>" data-id=<?php echo $row['task_id'];?> data-status=<?php echo $row['status'];?> >
    <div class="ms-2 me-auto">
      <div class="fw-bold"><?php echo $row['task'];?></div>
      <?php echo $row['person'];?>
    </div>
    <span class="badge bg-danger rounded-pill" data-id=<?php echo $row['task_id'];?>>Delete</span>
  </li>
  <?php
    }
       ?>
</ol>
</div>

<!-- On rows -->

</div>
    <!-- Option 1: Bootstrap Bundle with Popper -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.bundle.min.js" integrity="sha384-MrcW6ZMFYlzcLA8Nl+NtUVF0sA7MsXsP1UyJoMp4YLEuNSfAP+JcXn/tWtIaxVXM" crossorigin="anonymous"></script>
    <script src="https://code.jquery.com/jquery-3.6.3.js" integrity="sha256-nQLuAZGRRcILA+6dMBOvcRh5Pe310sBpanc6+QBmyVM=" crossorigin="anonymous"></script>
  </body>
</html>

<script>
 
 $(document).ready(function(){
  
  $(document).on('submit', '#to_do_form', function(event){
   event.preventDefault();
   if($('#task_name').val() == '')
   {
    $('#message').html('<div class="alert alert-danger">Enter Task Name</div>');
    return false;
   }
   else
   {
    $('#add_task').attr('disabled', 'disabled');
    var task_name = $('#task_name').val();
    var person_name = $('#person_name').val();
    $.ajax({
     url:"add_task.php",
     method:"POST",
     data:{task_name:task_name,person_name:person_name},
     success:function(data)
     {
      $('#add_task').attr('disabled', false);
      $('#to_do_form')[0].reset();
      $('.list-group').prepend(data);
     }
    })
   }
  });

  $(document).on('click', '.list-group-item', function(){
   var task_id = $(this).data('id');
   var status = $(this).data('status');
   $.ajax({
    url:"update_task.php",
    method:"POST",
    data:{task_id:task_id,status:status},
    success:function(data)
    {
      $('#list-group-item-'+task_id).data('status', data); 
      if (data == 1) {
        $('#list-group-item-'+task_id).css('background-color', 'green');
      } else {
        $('#list-group-item-'+task_id).css('background-color', 'white');
      }
     
    }
   })
  });

  $(document).on('click', '.badge', function(){
   var task_id = $(this).data('id');

   $.ajax({
    url:"delete_task.php",
    method:"POST",
    data:{task_id:task_id},
    success:function(data)
    {
     $('#list-group-item-'+task_id).fadeOut('slow').remove();
    }
   })
  });

 });
</script>
