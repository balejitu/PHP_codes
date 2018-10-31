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
$user_id_unique = $_SESSION['key'];

echo "<tr><td>";

      echo('acc_id');
 
      echo("</td><td>");
  
    echo('acc_name');
 
      echo("</td><td>");

      echo('acc_type');
  
      echo("</td><td>");

      echo('user_id');
  
      echo("</td><td>");
      echo('curr_balance');
      echo("</td><td>");

$stmt = $pdo->prepare("SELECT acc_id, acc_name, acc_type, curr_balance FROM account Where account.user_id = :ll");

$stmt->bindValue(':ll',$user_id_unique);
$stmt->execute();
while ( $row = $stmt->fetch(PDO::FETCH_ASSOC) )
 {
    echo "<tr><td>";

      echo(htmlentities($row['acc_id']));
 
      echo("</td><td>");
  
    echo(htmlentities($row['acc_name']));
 
      echo("</td><td>");

      echo(htmlentities($row['acc_type']));
  
      echo("</td><td>");

      echo(htmlentities($user_id_unique));
  
      echo("</td><td>");
      echo(htmlentities($row['curr_balance']));
      echo("</td><td>");
      echo('<a href="edit_account_info.php?acc_id='.$row['acc_id'].'">Edit</a> / ');

      echo('<a href="delete_account_info.php?acc_id='.$row['acc_id'].'">Delete</a>');
  
    
      echo("</td></tr>\n");

}

?>

</table>

<a href="add_account_info.php">Add New</a>
<a href="../start.php">Go Back</a>




