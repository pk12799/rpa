<?php
require 'config.php';
header('Content-Type: application/json');
$id = $_POST['id'];

if(isset($_POST['id'])){

    echo "<option value=''>Select City</option>";
    $sql =  "select * from city where coun_code='$id'"; 
echo $sql;
    $res = mysqli_query($con, $sql);
    while($data = mysqli_fetch_assoc($res)){
        $id = $data['id'];
        $name= $data['ci_name']; 
        echo "<option value='$id'>$name</option>";
}
}
?>