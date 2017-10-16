<?php

require "connect.php";
include "usr_authenticate.php";

$record_count = $con->query("SELECT * FROM posts");


$query = $con->prepare("SELECT post_id,title,LEFT (body,300)AS body,category_name FROM posts INNER JOIN categories ON categories.category_id = posts.category_id where posts.category_id = 2 order by post_id DESC ");
$query->execute();
$query->bind_result($post_id,$title,$body,$category);




?>
<!DOCTYPE html>
<html lang="en">
<head>
  <title>Main Page</title>
  <meta charset="UTF-8">
  <meta name=description content="">
  <meta name=viewport content="width=device-width, initial-scale=1">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">

        <link rel="stylesheet" type="text/css" href="css/style.css" />

</head>

<body>
<?php
include("header.php");
?>
<div id="catNiew" class="catnav" >
    <a href="index.php">Home</a>
    <a href="Uncategorized.php" >Uncategorized</a>
    <a href="_php.php">PHP</a>
    <a href="logout.php" style="float: right;" >LOG OUT</a>
</div>
<div >
  <?php
  while ($query->fetch()):
    $lastspace = strrpos($body, ' ');
    ?>
    <article id="container">
      <h2><?php echo $title; ?></h2>
      <p><?php echo substr($body,0,$lastspace)."<a href='post.php?id=$post_id'>..READ MORE</a>";?></p>
      <p><b>Category: </b><?php echo $category;?></p>
    </article>
  <?php endwhile ?>
</div>
</body>
<?php
include("footer.php");
?>
</html>
