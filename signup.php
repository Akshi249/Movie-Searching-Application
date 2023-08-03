<!DOCTYPE html>
<html lang="en">
<head>
<meta name="viewport" content="width=device-width, initial-scale=1.0">
<title>sign up...</title>
</head>
<body>
<?php
if($_SERVER["REQUEST_METHOD"]=="POST"){
  function filterInput($data){
  $data=trim($data);
  $data=stripslashes($data);
  $data=htmlspecialchars($data);
  return $data;
  }
 $email=$_POST["email"];
 $password=$_POST["password"];
 $email=filterInput($email);
 $password=filterInput($password);
 $conn=new mysqli("localhost","root","","movie search data");
  if($conn->connect_error)
   {
     die("connection to database failed ". $conn->connect_error);
   }
  else
   {
    $sql="select emailID from signupdata where emailID='$email'";
    $res=$conn->query($sql);
    if($res->num_rows>0){
       include("userLogin.html");
       echo "<p style='text-align:center'>";
       echo "email id ".$email." already exits, please try logging in with correct credentials";
       echo "</p>";
     }
    else{
    $sql="insert into signupdata(emailID,password) values('$email', '$password')";
    if($conn->query($sql))
     {
      include("userLogin.html");
      //include("profile.php");
     }
    else 
     die("account creation failed ". $conn->error);
   }
  }
 }
?>
</body>
</html>