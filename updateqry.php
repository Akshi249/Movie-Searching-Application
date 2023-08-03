<!DOCTYPE html>
<html lang="en">
<head>
<meta name="viewport" content="width=device-width, initial-scale=1.0">
<title>updating query...</title>
<link href="CSS/list-style.css" rel="stylesheet">
<link href="CSS/body-style.css" rel="stylesheet">
<link href="CSS/footer-style.css" rel="stylesheet">
</head>
<body class="animated-bg" style="background-repeat:no-repeat;background-size:cover">
<ul>
<li ><a href="index.html">HOME</a></li>
<li><a href="movies.html">MOVIE INFO</a></li>
<li><a href="aboutus.html">ABOUT US</a></li>
<li ><a href="contactUs.html">QUERIES</a></li>
</ul>
<?php
if($_SERVER['REQUEST_METHOD']=="POST")
{
  $isu=$_POST['isu'];
  $eml=$_POST['eml'];
  $con=new mysqli("localhost","root","","free_test");
  if($con->connect_error)
  {
    die("falied to connect to database".$con->connect_error);
  }
  else
  {
    $sql="update query set issolv=1 where qid=$isu";
    if($con->query($sql))
    {
     echo "<p style='margin-top:100px;font-size:20px;color:black;text-align:center;font-style:bold'>ISSUE SOLVED</p>";
     echo "<p style='font-size:20px;color:black;font-style:bold;text-align:center'>WANT TO NOTIFY USER ?</p>";
     echo "<p style='text-align:center'><a href='mailto:$eml' style='text-align:center;text-decoration:none;color:black;font-style:bold;font-size:20px'>NOTIFY USER</a></p>";
     $sql="delete from query where qid=$isu";
     if(!$con->query($sql))
      die("Error:".$con->error);
    }
    else
    {
      die("error has occurred".$con->error);
    }
  }
}
?>
<footer class="footer">
 <div class="footer-content">
  <p>&copy;2023 ROBOT SPACE. All Rights Reserved.</p>
 </div>
</footer>
</body>
</html>