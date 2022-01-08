<?php
require 'config.php';
$name_err = $email_err = $phone_err =  "";
if(isset($_POST['update'])){
    $id = $_GET['id'];
$name = $_POST['name'];
$country = $_POST['country'];
$city = $_POST['city'];
$desc = $_POST['descr'];

$email = $_POST['email'];
$phone = $_POST['mob'];
    if(empty($name))  
    {  
           $name_err = "<p>Please Enter Name</p>";  
    }  
    else  
    {  
        if(!preg_match("/^[a-zA-Z ]*$/", $name))  
           {  
                $name_err = "<p>Only Letters and whitespace allowed</p>";  
           }  
    }  
    if(empty($email))  
    {  
           $email_err = "<p>Please Enter Email</p>";  
    }  
      else  
      {  
           if(!filter_var($email, FILTER_VALIDATE_EMAIL))  
           {  
                $email_err = "<p>Invalid Email formate</p>";  
           }  
      }  
      if(!empty($phone)){
          if(!is_numeric($phone)){
$phone_err= "mobile no must be numeric";
          }
      }
      if($phone_err == "" && $email_err=="" && $name_err==""){
$sql = "update users set name='$name', email='$email', phone='$phone', country='$country', city='$city', descr='$desc' where id='$id'";
echo $sql;
$res = mysqli_query($con, $sql);
if($res){
    header('location:show.php');
}else{
    echo "<alert>something happened</alert>";
}
}
}

?>


<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/css/bootstrap.min.css" integrity="sha384-Gn5384xqQ1aoWXA+058RXPxPg6fy4IWvTNh0E263XmFcJlSAwiGgFAW/dAiS6JXm" crossorigin="anonymous">
    <title>form</title>
</head>
<body>

<div class="container justify-content-center">
    <h3>Form</h3>
<?php

$id = $_GET['id'];
$sql =  "select users.id, users.country, users.city, users.name, city.ci_name, country.con_name, users.descr, users.img, users.phone, users.email from users join country on country.id=users.country join city on users.city= city.id where users.id='$id'" ;
$res = mysqli_query($con, $sql);
if($row = mysqli_fetch_assoc($res)){

?>
    <form class="form" action="" method="post">

<label  for="name">name</label>
<input  type="text" value="<?php echo $row['name'] ;?>" name="name" required placeholder="please enter your name" class="form-control ">

<label for="email">email</label>
<input name="email" type="email" value="<?php echo $row['email'] ;?>" required placeholder="please enter your email" class="form-control  ">

<label for="molie">Moile no</label>
<input name="mob" type="tel" pattern="[6-9]{1}[0-9]{9}" value="<?php echo $row['phone']; ?>" required placeholder="please enter your mobile no" class=" form-control">
</br>
<label for="country">Country</label>
<select id="country" class="selectpicker form-control" name="country">
                        <option value="<?php echo $row['country']; ?>"> <?php  echo $row['con_name']; ?>  </option>

                        <?php 
                        $sql = "select id, con_name from country";
                        $res = mysqli_query($con, $sql);
                        while($q = mysqli_fetch_assoc($res)) 
                        {
                        ?>
                            <option value="<?php echo $q['id']; ?>"><?php echo $q['con_name'] ; ?></option>
                        <?php } ?>
                    </select>

                    <label for="city">City</label>
                    <div class="container">
                    <select class=" form-control" id="city" name="city">
                        <option value="<?php echo $row['city']; ?>"> <?php echo $row['ci_name']; ?> </option>

                    </select>
                    </div>

                        
<label for="descr">description</label>
<textarea name="descr"   class="form-control input" cols="60" rows="3"><?php echo $row['descr']; ?></textarea>

<?php  } ?>


<button type="submit" class="submit btn btn-primary" name="update">UPDATE</button>

    </form>
</div>
<script src="//ajax.googleapis.com/ajax/libs/jquery/1.9.1/jquery.min.js"></script>

<script type="text/javascript">
        $(document).ready(function() {
            $('#country').on('change',function() {
                
                var id = $(this).val();
               
              
                    $.ajax({
                        method: "POST",
                        url: 'ajax.php',
                        data: {
                            id: id
                        },
                        dataType: "html",
                        success: function(data) {
                           $("#city").html(data);
                        }
                    });
               
                console.log(id);
            })
        });
    </script>
</body>
</html>