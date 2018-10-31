<?php
require_once "pdo.php";
session_start();
if ( isset($_POST['delete']) && isset($_POST['trans_id']) )
 {
      $sql = "DELETE FROM transaction_info WHERE trans_id = :zip";
      $stmt = $pdo->prepare($sql);
      $stmt->execute(array(':zip' => $_GET['trans_id']));
      $_SESSION['success'] = 'Record deleted';
      header( 'Location: index_transaction.php' ) ;
      return;
 }
// Guardian: Make sure that trans_id is present
if ( ! isset($_GET['trans_id']) )
  {
  $_SESSION['error'] = "Missing trans_id";
  header('Location: index_transaction.php');
    return;
  
}
$stmt = $pdo->prepare("SELECT description,trans_id FROM transaction_info where trans_id = :xyz");
$stmt->execute(array(":xyz" => $_GET['trans_id']));
$row = $stmt->fetch(PDO::FETCH_ASSOC);
if ( $row === false ) 
{
    $_SESSION['error'] = 'Bad value for trans_id';
     header( 'Location: ../start.php' ) ;
 
    return;
}
?>

<p>Confirm: Deleting <?= htmlentities($row['description']) ?></p>


<form method="post">

<input type="hidden" name="trans_id" value="<?= $row['trans_id'] ?>">

<input type="submit" value="Delete" name="delete">

<a href="index_transaction.php">Cancel</a>

</form>