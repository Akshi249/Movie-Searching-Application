<!DOCTYPE html>
<html lang="en">
<head>
<meta name="viewport" content="width=device-width, initial-scale=1.0">
<title>update password</title>
<link href="CSS/list-style.css" rel="stylesheet">
</head>
<body>
<?php
if($_SERVER['REQUEST_METHOD']=="POST")
{
 if(!empty($_POST['email']))
 {
   if(!empty($_POST['password']))
   {
     $eml=$_POST['email'];
     $pwd=$_POST['password'];
     $con=new mysqli("localhost","root","","movie search data");
     if($con->connect_error)
      {
        die("unable to connect to database".$con->connect_error);
      }
     else
      {
        $sql="update signupdata set password='$pwd' where emailID='$eml'";
        if($con->query($sql))
        {
          echo "password updated succesfully";
          include("userLogin.html");
        }
        else
        {
         die("error has occurred".$con->error);
        }
       $con->close();
      }
   }
   else
   {
     echo "password is required";
     include("setpassword.html");
     exit();
   }
 }
 else
 {
  echo "registered email required";
  include("setpassword.html");
  exit();
 }
}
?>
</body>
</html>
