<?php

require_once "pdo.php";

session_start();

?>

<html>

<head>
</head>
<body>

<?php

if ( isset($_SESSION['error']) ) 
{
    echo '<p style="color:red">'.$_SESSION['error']."</p>\n";

    unset($_SESSION['error']);

}

if ( isset($_SESSION['success']) )
 {
    echo '<p style="color:green">'.$_SESSION['success']."</p>\n";

      unset($_SESSION['success']);

 }


echo('<table border="1">'."\n");

$stmt = $pdo->query("SELECT name, email, password, user_id,city FROM user_info ");

echo "<tr><td>";

      echo('name');
 
      echo("</td><td>");
  
    echo('email');
 
      echo("</td><td>");

      echo('password');
  
      echo("</td><td>");

      echo('city');
  
      echo("</td><td>");
while ( $row = $stmt->fetch(PDO::FETCH_ASSOC) )
 {
    echo "<tr><td>";

      echo(htmlentities($row['name']));
 
      echo("</td><td>");
  
    echo(htmlentities($row['email']));
 
      echo("</td><td>");

      echo(htmlentities($row['password']));
  
      echo("</td><td>");

      echo(htmlentities($row['city']));
  
      echo("</td><td>");
      echo('<a href="edit_user_info.php?user_id='.$row['user_id'].'">Edit</a> / ');

      echo('<a href="delete_user_info.php?user_id='.$row['user_id'].'">Delete</a>');
  
    echo("</td></tr>\n");
}
?>
</table>
      
<a href="add_user_info.php">Add New</a>
      





