<!DOCTYPE html>
<html>
<head>
<title>forgot password</title>
<link href="CSS/list-style.css" rel="stylesheet">
<link href="CSS/body-style.css" rel="stylesheet">
</head>
<body>
<?php
if($_SERVER['REQUEST_METHOD']=='POST')
{
  if(!empty($_POST['eml']))
  {
    $con=new mysqli("localhost","root","","movie search data");
    if($con->connect_error)
    {
      die("unable to connect to database".$con->connect_error);
    }
    else
    {
      $eml=$_POST['eml'];
      $sql="select password from signupdata where emailID='$eml'";
      if($con->query($sql))
      {
        $res=$con->query($sql);
        if(($row=$res->fetch_assoc())==0)
        {
          include("signUp.html");
          echo "<p style='text-align:center;font-size:20px;font-style:bold'>email you entered is not registered with us</p>";
          echo "<p style='text-align:center;font-size:20px;font-style:bold'>please try creating new account</p>";
          
          $con->close();
          exit();
        }
        else
        {
           include("setpassword.html");
           $con->close();
           exit();
        }
      }
      else
      {
       die("some error has occurred".$con->error);
      }
    }
  }
  else
  {
    echo "<p style='text-align:center;font-size:20px;font-style:bold'>please enter the registered email</p>";
    include("forgot.html");
    exit();
  }
}
?>
</body>
</html>
