<?php

include 'config.php';

$sql = "select users.id, users.name, city.ci_name, country.con_name, users.descr, users.img, users.phone, users.email from users join country on country.id=users.country join city on users.city= city.id order by id";

$res=mysqli_query($con, $sql);



?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Show data</title>
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/css/bootstrap.min.css" integrity="sha384-Gn5384xqQ1aoWXA+058RXPxPg6fy4IWvTNh0E263XmFcJlSAwiGgFAW/dAiS6JXm" crossorigin="anonymous">
   
</head>
<body>
    <div class="container">
 
    <h3 class="h3">User Data</h3>
    <table class="table">
  <thead>
    <tr>
     
      <th scope="col">NAME</th>
      <th scope="col">EMAIL</th>
      <th scope="col">PHONE NO</th>
    
      <th scope="col">COUNTRY</th>
      <th scope="col">CITY</th>
      
      <th scope="col">description</th>
      <th scope="col">IMAGE</th>
      <th scope="col">UPDATE</th>
    </tr>
  </thead>
  <?php 
      
      while($row = mysqli_fetch_assoc($res)){
      
      ?>
  <tbody>
     
    <tr>
      
      <td><?php  echo $row['name']; ?></td>
      <td><?php  echo $row['email']; ?></td>
      <td> <?php echo $row['phone']; ?></td>
     
      <?php
    


?>
      <td><?php echo $row['con_name']  ?></td>

      <td><?php echo $row['ci_name']; ?></td>
      <td><?php echo $row['descr']; ?></td>
      <td><img height="80px" weight="60px" src="upload/<?php echo $row['img']; ?>"></img></td>
      <td><a href="update.php?id=<?php echo $row['id']; ?>">update/</a><a href="delete.php?id=<?php echo $row['id']; ?>">delete</a></td>
    </tr>
  
  </tbody>
  <?php } ?>
</table>

    </div>
</body>
</html>