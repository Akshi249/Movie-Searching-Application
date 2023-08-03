<!DOCTYPE html>
<html lang="en">
<head>
<meta name="viewport" content="width=device-width, initial-scale=1.0">
<style>
.ir:hover{
background-color:blue;
font-size:30px;
padding:5px;
font-style:bold;
margin:5px;
}
.ir{
font-size:25px;
background-color:grey;
padding:5px;
font-style:bold;
margin:5px;
}
.or{
background-color:pink;
font-size:25px;
font-style:bold;
padding:5px;
margin:5px;
}
</style>
<title>Your's Favourite Movie Information</title>
</head>
<body>
<div >
<?php
$email=$_SESSION['email'];
$con=new mysqli("localhost","root","","movie search data");
 if($con->connect_error)
  die("currently cannot establish connection to database due to following error ".$con->connect_error);
 else{
  $sql=" select dateOfSearch, movieSearched, lastLogin from usersearchdata where emailId='$email' ";
  $res=$con->query($sql);
  if($res==false)
    die("failed to fetch data from database due to following error ".$con->error);
  else {
     if($res->num_rows>0){
       echo "<table style='border:3px solid black;text-align:center;margin-top:150px' class='t'>";
       echo "<tr class='or' >";
       echo "<th style='padding:5px'>";
       echo "DATE OF SEARCH";
       echo "</th>";
       echo "<th style='padding:5px'>";
       echo "MOVIE SEARCHED";
       echo "</th>";
       echo "<th style='padding:5px'>";
       echo "LAST SEARCHED";
       echo "</th>";
       echo "</tr>";
      while($row=$res->fetch_assoc()){
        echo "<tr class='ir' >";
        echo "<td>";
        echo $row['dateOfSearch'];
        echo "</td>";
        echo "<td>";
        echo $row['movieSearched'];
        echo "</td>";
        echo "<td>";
        echo $row['lastLogin'];
        echo "</td>";
        echo "</tr>";
       }
      echo "</table>";
      }
     else 
       echo "No Results Found";
   }
 }
?>
</div>
</body>
</html>