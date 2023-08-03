<!DOCTYPE html>
<html lang="en">
<head>
<meta name="viewport" content="width=device-width, initial-scale=1.0">
<title>raising query..</title>
<link href="CSS/body-style.css" rel="stylesheet">
<link href="CSS/list-style.css" rel="stylesheet">
<link href="CSS/footer-style.css" rel="stylesheet">
</head>
<body class="animated-bg" style="background-size:cover;background-repeat:no-repeat">
<ul>
<li ><a href="index.html">HOME</a></li>
<li><a href="movies.html">MOVIE INFO</a></li>
<li><a href="aboutus.html">ABOUT US</a></li>
<li ><a href="contactUs.html">QUERIES</a></li>
</ul>
<?php
if($_SERVER['REQUEST_METHOD']=="POST")
{
 if(!empty($_POST['qre']))
 {
  if(!empty($_POST['qdt']))
  {
   if(!empty($_POST['issue']))
   {
    $reml=$_POST['em'];
    $qrem=$_POST['qre'];
    $qrdate=$_POST['qdt'];
    $qr=$_POST['issue'];
    if($reml==$qrem)
    {
     $con=new mysqli("localhost","root","","movie search data");
     if($con->connect_error)
      {
        die("econnection failed..".$con->connect_error);
      }
      else
      {
        $sql="insert into userqueries(queryRaisedDate,emailID,issueFaced,statusOfIssue) values('$qrdate','$qrem','$qr',0)";
        if($con->query($sql))
        {
          echo "<h3 style='margin:120px;display:inline;text-align:center;font-size:20px;font-style:bold;color:blue'>
                <p>Hey $reml....!!!!!!!!</p>
                <p>Thank You for letting us the issue,that you are facing with our website</p>
                <p>At the same we are very sorry about the issue that has been caused,will do our best to resolve your issue.</p>
                <p>Keep Preparing for placements by taking free tests on our website....</p>
                <p style='font-size:30px'>THANK YOU...!!!!!!!</p>
                </h3>";
        }
        else
        {
         die("ERROR: ".$con->error);
        }
      }
    }
    else
    {
     echo "<h3>the email which u are using to raise the issue is not rigistered with us..</h3>"."<br>";
     echo "<h3>please use the same which u used while creating ur account on this website to raise the issue</h3>"."<br>";
     echo "<h3>registered email:</h3>".$remal."<br>";
     echo "<h3>query raising email..</h3>".$qreml."<br>";
    }
   }
   else
   {
    die("please tell us the problem that u are facing with our website");
   }
  }
  else
  {
   die("date of raising query is required");
  }
 }
 else
 {
   die("email is required");
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
