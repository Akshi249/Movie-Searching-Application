<!DOCTYPE html>
<html lang="en">
<head>
<title>
query login..
</title>
<meta name="viewport" content="width=device-width, initial-scale=1.0">
<link href="CSS/list-style.css" rel="stylesheet">
<link href="CSS/body-style.css" rel="stylesheet">
</head>
<body class="animated-bg" style="background-repeat:no-repeat;background-size:cover">
<?php
if($_SERVER['REQUEST_METHOD']=="POST")
{
  if(!empty($_POST['rem']))
  {
   if(!empty($_POST['pwd']))
   {
    $con=new mysqli("localhost","root","","movie search data");
    if($con->connect_error)
    {
     die("connection failed".$con->connect_error);
    }
    else
     {
       $eml=$_POST['rem'];
       $pwrd=$_POST['pwd'];
       $sql="select emailID from signupdata where emailID='$eml'";
       if($con->query($sql))
       {
         $res=$con->query($sql);
         if($res->num_rows==0){
           include("signUp.html");
          echo "<p style='text-align:center;font-size:20px;font-style:bold'>email you entered is not registered with us</p>";
          echo "<p style='text-align:center;font-size:20px;font-style:bold'>please try creating new account</p>";
          die();
          }
         else
          {
            $sql="select password from signupdata where password='$pwrd'";
            if($con->query($sql))
             {
               $res=$con->query($sql);
               if($res->num_rows==0)
                {
                  echo "wrong password.."."<br>";
                  echo "please try again"."<br>";
                  echo 'include("raisequery.html")';
                }
                else{
                    $email=$_POST['rem'];
                   // echo "HELLO....".$email."<br>";
                    include("raisequery.html");
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
         die("some error has occurred..".$con->error);
       }
     }
   }
   else
    {
    echo "password is required"."<br>";
    }
  }
  else
  {
   echo "enter the registered email it is must if you want to raise query means"."<br>";
   $con->close();
  }
 $con->close();
}
?>
</body>
</form>
