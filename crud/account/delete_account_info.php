<?php

require_once "pdo.php";

session_start();


if ( isset($_POST['delete']) && isset($_POST['acc_id']) )
 {
    $sql = "DELETE FROM account WHERE acc_id = :zip";

      $stmt = $pdo->prepare($sql);
  
    $stmt->execute(array(':zip' => $_POST['acc_id']));
  
    $_SESSION['success'] = 'Record deleted';
  
    header( 'Location: index_account_info.php' ) ;
  
    return;

}


// Guardian: Make sure that user_id is present

if ( ! isset($_GET['acc_id']) )
  {
  
  $_SESSION['error'] = "Missing acc_id";
  
  header('Location: index_account_info.php');

    return;
  
}


$stmt = $pdo->prepare("SELECT acc_name, acc_id FROM account where acc_id = :xyz");

$stmt->execute(array(":xyz" => $_GET['acc_id']));

$row = $stmt->fetch(PDO::FETCH_ASSOC);

if ( $row === false ) 
{
    $_SESSION['error'] = 'Bad value for acc_id';

     header( 'Location: index_account_info.php' ) ;
 
    return;

}

?>

<p>Confirm: Deleting <?= htmlentities($row['acc_name']) ?></p>


<form method="post">

<input type="hidden" name="acc_id" value="<?= $row['acc_id'] ?>">

<input type="submit" value="Delete" name="delete">

<a href="index_account_info.php">Cancel</a>

</form>
