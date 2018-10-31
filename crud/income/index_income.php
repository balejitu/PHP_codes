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
$stmt = $pdo->query("SELECT trans_id, description, creation_time, type,amount, acc_id FROM transaction_info ");
echo "<tr><td>";
 
echo "</td><td>";
echo('description');
echo "</td><td>";
echo('creation_time');
echo "</td><td>";
echo('type');
echo "</td><td>";
echo('amount');
echo "</td><td>";
echo('acc_id');
echo("</td><td>");
while ( $row = $stmt->fetch(PDO::FETCH_ASSOC) )
 {
    echo "<tr><td>";
      echo(htmlentities($row['trans_id']));
 
      echo("</td><td>");
  
    echo(htmlentities($row['description']));
	
 
      echo("</td><td>");
      echo(htmlentities($row['creation_time']));
  
      echo("</td><td>");
      echo(htmlentities($row['type']));
  
      echo("</td><td>");
      echo(htmlentities($row['amount']));
  
      echo("</td><td>");
      echo(htmlentities($row['acc_id']));
  
      echo("</td><td>");
      echo('<a href="edit_transaction.php?trans_id='.$row['trans_id'].'">Edit</a> / ');
      echo('<a href="delete_transaction.php?trans_id='.$row['trans_id'].'">Delete</a>');
  
    echo("</td></tr>\n");
}
?>
</table>
<a href="add_transaction.php">Add New</a>
<a href="../start.php">Go Back</a>