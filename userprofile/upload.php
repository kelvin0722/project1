<?php

//extracting data from post

extract($_POST);

// check if a file was submitted
$target_dir = "uploads/";
$target_file = $target_dir . basename($_FILES["fileToUpload"]["name"]);
$file_name=basename($_FILES["fileToUpload"]["name"]);
echo "<br><em>".$file_name."</em>";
$uploadOk = 1;
$imageFileType = pathinfo($target_file,PATHINFO_EXTENSION);
// Check if image file is a actual image or fake image
if(isset($_POST["submit"])) {
    $check = getimagesize($_FILES["fileToUpload"]["tmp_name"]);
    if($check !== false) {
        echo "File is an image - " . $check["mime"] . ".";
        $uploadOk = 1;
    } else {
        echo "File is not an image.";
        $uploadOk = 0;
    }
}
// Check if file already exists
if (file_exists($target_file)) {
    echo "Sorry, file already exists.";
    $uploadOk = 0;
}
// Check file size
if ($_FILES["fileToUpload"]["size"] > 500000) {
    echo "Sorry, your file is too large.";
    $uploadOk = 0;
}
// Allow certain file formats
if($imageFileType != "jpg" && $imageFileType != "png" && $imageFileType != "jpeg"
&& $imageFileType != "gif" ) {
    echo "Sorry, only JPG, JPEG, PNG & GIF files are allowed.";
    $uploadOk = 0;
}
// Check if $uploadOk is set to 0 by an error
if ($uploadOk == 0) {
    echo "Sorry, your file was not uploaded.";
// if everything is ok, try to upload file
} else {
    if (move_uploaded_file($_FILES["fileToUpload"]["tmp_name"], $target_file)) {
        echo "The file ". basename( $_FILES["fileToUpload"]["name"]). " has been uploaded.";
    } else {
        echo "Sorry, there was an error uploading your file.";
    }
}
if($uploadOk==1){
    
    require_once 'connect.php';
    
    
$idno=mysqli_escape_string($con,$_POST['id']);
$firstname=mysqli_escape_string($con,$_POST['fname']);
$lastname=mysqli_escape_string($con,$_POST['lname']);
$age=mysqli_escape_string($con,$_POST['age']);
$town=mysqli_escape_string($con,$_POST['town']);
$maritalstatus=mysqli_escape_string($con,$_POST['status']);
$education=mysqli_escape_string($con,$_POST['edu']);
$admin_phone='0700355166';//admin phone number;

echo $idno."<br>";
echo $firstname."<br>";
echo $lastname."<br>";
echo $education."<br>";
echo $maritalstatus."<br>";
echo $town."<br>";





$sql = "INSERT INTO employee_tbl(id,firstname,lastname,age,town,Maritalstatus,Education,imagename,adminphone)
    VALUES ('$idno','$firstname','$lastname','$age','$town','$maritalstatus','$education','$file_name','$admin_phone')";
    
    
 $result=$con->query($sql);
 if (!$result) die($con->error);
  $rows = $result->num_rows;
    if($rows > 0)
    {
        
        $msg="Successfull";
        
        
    }
    else
      {
        header('location:admin.php');
       }
    
    echo $msg;
}

?>