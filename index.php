<?php
include 'config.php';
$name_err = $email_err =$err= $phone_err =  "";


if (isset($_POST['submit'])){
$name = $_POST['name'];
$country = $_POST['country'];
$city = $_POST['city'];
$desc = $_POST['desc'];

$email = $_POST['email'];
$phone = $_POST['mob'];
$allowTypes = array('jpg','png','jpeg','gif');
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
$targetDir = "upload/";
$fileName = $_FILES["file"]["name"];

$targetFilePath = $targetDir . $fileName;
$fileType = pathinfo($targetFilePath,PATHINFO_EXTENSION);
if(in_array($fileType, $allowTypes)){
    if(move_uploaded_file($_FILES["file"]["tmp_name"], $targetFilePath)){
            $sql = "insert into users(name, email, phone, descr, country, city, img) values('$name', '$email', '$phone','$desc', '$country', '$city', '$fileName')";
         
            $res = mysqli_query($con, $sql);
            if($res){
                header('location:show.php');
            }
            else{
                $err = "something err";
            }
    }
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

<p class="danger"><?php echo $err;?></p>
    <h3>Form</h3>

    <form action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]);?>" method="post" enctype="multipart/form-data">
<label  for="name">name</label>
<input  type="text" name="name" required placeholder="please enter your name" class="form-control">
<p class="danger"><?php echo $name_err;?></p>
<label for="email">email</label>
<input name="email" type="email" required placeholder="please enter your email" class="form-control">
<p class="danger"><?php echo $email_err;?></p>
<label for="mob">Moile no</label>
<input name="mob" type="tel" pattern="[6-9]{1}[0-9]{9}" required placeholder="please enter your mobile no" class="form-control">
<p class="danger"><?php echo $phone_err;?></p>
<label for="country">Country</label>
<select id="country" class="selectpicker form-control" name="country">
                        <option value=""> Select country  </option>

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
                    <select class=" form-control" id="city" name="city">
                        <option value=""> Select City </option>

                    </select>
                    
<label for="email">description</label></br>
<textarea name="desc" class="input" cols="60" rows="3"></textarea>
<p class="danger"><?php ?></p>
<input type="file" name="file">
                        </br>
                        <div class="container">
<button type="submit" name="submit">submit</button>
</div>
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