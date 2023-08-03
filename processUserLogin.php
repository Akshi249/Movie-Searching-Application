<!DOCTYPE html>
<html lang="en">
<head>
<meta name="viewport" content="width=device-width, initial-scale=1.0">
<title>Your's Favourite Movie</title>
<link href="CSS/list-style.css" rel="stylesheet">
<link href="CSS/body-style.css" rel="stylesheet">
</head>
<body class="animated-bg" style="background-repeat:no-repeat;background-size:cover;">
<div style="text-align:center;">
<?php
if($_SERVER["REQUEST_METHOD"]=="POST")
{
  function filterInput($data){
  $data=trim($data);
  $data=stripslashes($data);
  $data=htmlspecialchars($data);
  return $data;
 }
  $useremail=filterInput($_POST["email"]);
  $password=filterInput($_POST["password"]);
  $conn=new mysqli("localhost","root","","movie search data");
  if($conn->connect_error)
     die("connection can not be established due to some internet or internal error ". $conn->connect_error);
  else{
      $sql="select emailID from signupdata where emailID='$useremail'";
      $res=$conn->query($sql);
      if($res->num_rows==0)
      {
        include("signUp.html");
        echo "<p>The entered email is not registered with us...</p>";
        echo "<p>please try creating new account</p>";
        
      }
      else{
       $sql="select password from signupdata where password='$password'";
       $res=$conn->query($sql);
       if($res->num_rows==0)
       {
        include("userLogin.html");
        echo "<p>wrong password</p>";
       }
       else{
         $_SESSION["email"]=$useremail;
         include ("movieSearch.html");
         echo "<p style='margin-left:0px; font-size:20px;font-style:bold'>";
         echo "Hello, ". $useremail;
         echo "<br>Below in table format, you can find the names of movie and the date on which you searched for them";
         echo "<br>Happy Movie Searching";
         echo "</p>";
         include("profile.php");
       }
     }
   }   
}
?>
</div>
</body>
</html>