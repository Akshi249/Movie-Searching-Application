<!DOCTYPE html>
<html lang="en">
<head>
<meta name="viewport" content="width=device-width, initial-scale=1.0">
<title>Movie Information</title>
<style>
table{
border-collapse:collapse;
width:100%;
}
th,td{
padding :8px;
border : 2px solid black;
}
</style>
<link href="CSS/list-style.css" rel="stylesheet">
<link href="CSS/body-style.css" rel="stylesheet">
<link href="CSS/footer-style.css" rel="stylesheet">
</head>
<body class="animated-bg" style="text-align:center;background-size:cover;background-repeat:no-repeat">
<ul>
<li ><a href="index.html">HOME</a></li>
<li><a href="movies.html">MOVIE INFO</a></li>
<li><a href="aboutus.html">ABOUT US</a></li>
<li ><a href="contactUs.html">QUERIES</a></li>
</ul>
<?php
if($_SERVER["REQUEST_METHOD"]=="POST")
{
  $api_key="e14d06f4080e28e71fc6dfc1a4f3fcaf";
  $base_url="https://api.themoviedb.org/3";
  $movie_name=$_POST["movie"];
  $items_per_page=5;
  $current_page=isset($_GET['page'])?intval($_GET['page']):1;
  $offset=($current_page-1)*$items_per_page;
  $emailId=$_POST['email'];
  $currentdate=date("Y-m-d");
  $con=new mysqli("localhost","root","","movie search data");
  if($con->connect_error)
     echo "currently can not establish connection to database to store the use data in the database due to the following error <br>".$con->connect_error;
  else{
    $sql="insert into usersearchdata(emailId, dateOfSearch, movieSearched, lastLogin) values('$emailId','$currentdate', '$movie_name','$currentdate')";
    if(($con->query($sql))==false)
      echo "currently cannot store data into database due to following error".$con->error;
   }
  $search_query=urlencode($movie_name);
  $url="{$base_url}/search/movie?api_key={$api_key}&query={$search_query}";
  $ch=curl_init();
  curl_setopt($ch,CURLOPT_URL,$url);
  curl_setopt($ch,CURLOPT_RETURNTRANSFER,1);
  $response=curl_exec($ch);
  curl_close($ch);
  if($response==false){
    echo "<p style='text-algin:center;font-style:bold;font-size:20px'>";
    echo "Failed to fecth details for movie".$movie_name;
    echo "<br> please check your network connection, before you could try again";
    echo "</p>";
    die();
    }
  $data=json_decode($response,true);
  //var_dump($data);
  //echo "API URL: ". $url. " <br>";
  $total_pages=$data['total_pages'];
  //echo "total pages ".$total_pages;
   echo "<div class='pagination'>";
   for($i=1;$i<=$total_pages;$i++){
     $active_class=($i===$current_page)?'active':'';
     echo '<a href="?page= ' . $i. '" class="' . $active_class . '">' . $i . '</a>';
     }
    echo "</div>";
  if(isset($data['results']) && count($data['results'])>0){
    $movie_info=$data['results'][0];
    echo "<table>";
    echo "<tr>";
    echo "<th>";
    echo "TITLE";
    echo "</th>";
    echo "<th>";
    echo "RELEASE DATE";
    echo "</th>";
    echo "<th>";
    echo "OVERVIEW";
    echo "</th>";
    echo "<th>";
    echo "LANGUAGE";
    echo "</th>";
    echo "<th>";
    echo "AVERAGE RATING";
    echo "</th>";
    foreach($data['results'] as $movie_info1){
       echo "<tr>";
       echo "<td>";
       echo $movie_info1['title'];
       echo "</td>";
       echo "<td>";
       echo $movie_info1['release_date'];
       echo "</td>";
       echo "<td>";
       echo $movie_info1['overview'];
       echo "</td>";
       echo "<td>";
       echo $movie_info1['original_language'];
       echo "</td>";
       echo "<td>";
       echo $movie_info1['vote_average'];
       echo "</td>";
      echo "</tr>";
     }
   echo "</table>";
   
  }
  else 
   die("movie not found");
}
?>
<!--<h2 >Movie Information</h2>
<table>
<tr>
<th>TITLE</th>
<th>RELEASE DATE</th>
<th>OVERVIEW</th>
</tr>
<tr>
<td><?php echo $movie_info['title']; ?></td>
<td><?php echo $movie_info['release_date']; ?> </td>
<td><?php echo $movie_info['overview']; ?> </td>
</tr>
</table>
<footer class="footer">
 <div class="footer-content">
  <p>&copy;2023 ROBOT SPACE. All Rights Reserved.</p>
 </div>
</footer>-->
</body>
</html>
