<?php
extract($_POST);
 function add_member()
 {
   // Create connection
    require_once 'connect.php';
     $sql="INSERT INTO membertbl (id,firstname,secondname,emailaddress,dateofbirth,gender,marritalstatus,city,county,username,password)
      VALUES
      ('$_POST[id]','$_POST[fname]','$_POST[sname]','$_POST[email]','$_POST[dob]','$_POST[gender]','$_POST[status]','$_POST[city]','$_POST[county]','$_POST[uname]','$_POST[pass]')";
      if (!mysqli_query($con,$sql))
      {
      die('Error: ' . mysqli_error($con));
      }
      mysqli_close($con);
  }

  function login_member()
  {
    //create connection

    require_once 'connect.php';
    session_start();
    $username=mysqli_real_escape_string($con,$_POST['uname']);
    $password=mysqli_real_escape_string($con,$_POST['pass']);
    $sql="SELECT *FROM membertbl WHERE username='$username' AND password='$password'";
    $result=mysqli_query($con,$sql);
    $row=mysqli_fetch_array($result,MYSQLI_ASSOC);

    $count=mysqli_num_rows($result);

    if($count==1){
      $_SESSION['login_user']=$username;
      header("location:index.php");
    }else{
      $error="Your login name or passwords do not match!!";
    }

  }



 ?>
