<!DOCTYPE html>
<html lang="en">
<head>
<meta name="viewport" content="width=device-width, initial-scale=1.0">
<title>Admin login....</title>
<link href="CSS/list-style.css" rel="stylesheet">
<link href="CSS/body-style.css" rel="stylesheet">
<link href="CSS/footer-style.css" rel="stylesheet">
<style>
table{
border-collapse:collapse;
width:100%;
}
th,td{
padding :8px;
border : 2px solid black;
}
.ir{
font-size:25px;
padding:5px;
font-style:bold;
margin:5px;
}
.or{
font-size:25px;
font-style:bold;
padding:5px;
margin:5px;
}
</style>
</head>
<body class="animated-bg" style="background-repeat:no-repeat;background-size:cover">
<ul>
<li ><a href="index.html">HOME</a></li>
<li><a href="movies.html">MOVIE INFO</a></li>
<li><a href="aboutus.html">ABOUT US</a></li>
<li ><a href="contactUs.html">QUERIES</a></li>
</ul>
<div style="text-align:center;margin-top:90px">
<?php
if($_SERVER["REQUEST_METHOD"]=="POST")
{
  function filterInput($data){
  $data=trim($data);
  $data=stripslashes($data);
  $data=htmlspecialchars($data);
  return $data;
  }
 $username=filterInput($_POST["email"]);
 $password=filterInput($_POST["password"]);
 if($username=="AdmiN" && $password=="123@Admin"){
   $con=new mysqli("localhost","root","","movie search data");
   if($con->connect_error)
     die("connection to database failed".$con->connect_error);
   else{
     $sql="select count(*) as 'total' from signupdata";
       if($con->query($sql)){
         $res=$con->query($sql);
         while($row=$res->fetch_assoc()){
           $v1=$row['total'];
           echo "<div style='color:black;font-size:30px;font-style:bold;text-align:center;'>
           <p>NUMBER OF USERS ON MOVIE SEARCH WEBSITE :  <span> $v1</span> </p>
           </div>";
           }
         }
       else 
         die("error has occurred".$con->error);
      }
  $sql="select count(issueFaced) as 'issues' from userqueries";
   if($con->query($sql)){
     $res=$con->query($sql);
     while($row=$res->fetch_assoc()){
        $v1=$row['issues'];
        echo "<div style='color:black;font-size:30px;font-style:bold;text-align:center;'>
        <p>TOTAL QUERIES RISED :  <span> $v1</span> </p>
        </div>";
       }
     }
   else 
    die("error has occurred".$con->error);
 echo "<p style='display:block;text-align:center'><div style='font-size:25px;display:inline;font-style:bold;text-align:center;background-color:blue;color:white;border:2px solid black;margin-top:40px'>QUERIES RISED</div></p>";
 $sql="select * from userqueries where statusOfIssue=0";
 if($con->query($sql))
 {
  $res=$con->query($sql);
  echo "<table style='border:3px solid black;margin-left:auto;margin-right:auto;text-align:center;' class='t'>";
  echo "<tr class='or'>";
  echo "<th style='padding:5px' >DATE OF QUERY RISED</th>";
  echo "<th style='padding:5px'>USER EMAIL</th>";
  echo "<th style='padding:5px'>QUERY RISED</th>";
  echo "<th style='padding:5px'>UPDATE</th>";
  echo "</tr>";
       if($res->num_rows==0)
         {
          echo "<tr class='ir'>";
          echo "<td>no data available</td>";
          echo "<td>no data available</td>";
          echo "<td>no data available</td>";
          echo "<td>no data available</td>";
          echo "</tr>";          
         }
         while($row=$res->fetch_assoc())
          {
            $v1=$row['queryRaisedDate'];
            $v2=$row['emailID'];
            $v3=$row['issueFaced'];
            $v4=$row['statusOfIssue'];
            echo "<tr class='ir'>";
            echo "<td>$v1</td>";
            echo "<td>$v2</td>";
            echo "<td>$v3</td>";
            echo "<td><form action='updateqry.php' method='post'><input type='text' value=$v2 name='eml' style='display:none'><input type='text' value=$v4 name='isu' style='display:none'><input type='submit' value='Update Query'></form></td>";
            echo "</tr>";
          }
   echo "</table>";
  }
 else
    die("error has occurred".$con->error);
}
else{
   echo "admin user credentials are incorrect.. please try again";
  }
}
?>
</div>
<footer class="footer">
 <div class="footer-content">
  <p>&copy;2023 ROBOT SPACE. All Rights Reserved.</p>
 </div>
</footer>
</body>
</html>