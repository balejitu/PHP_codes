<?php

require_once "pdo.php";

session_start();


if ( isset($_POST['delete']) && isset($_POST['user_id']) )
 {
    $sql = "DELETE FROM user_info WHERE user_id = :zip";

      $stmt = $pdo->prepare($sql);
  
    $stmt->execute(array(':zip' => $_POST['user_id']));
  
    $_SESSION['success'] = 'Record deleted';
  
    header( 'Location: index_user_info.php' ) ;
  
    return;

}


// Guardian: Make sure that user_id is present

if ( ! isset($_GET['user_id']) )
  {
  
  $_SESSION['error'] = "Missing user_id";
  
  header('Location: index_user_info.php');

    return;
  
}


$stmt = $pdo->prepare("SELECT name, user_id FROM user_info where user_id = :xyz");

$stmt->execute(array(":xyz" => $_GET['user_id']));

$row = $stmt->fetch(PDO::FETCH_ASSOC);

if ( $row === false ) 
{
    $_SESSION['error'] = 'Bad value for user_id';

     header( 'Location: index_user_info.php' ) ;
 
    return;

}

?>

<p>Confirm: Deleting <?= htmlentities($row['name']) ?></p>


<form method="post">

<input type="hidden" name="user_id" value="<?= $row['user_id'] ?>">

<input type="submit" value="Delete" name="delete">

<a href="index_user_info.php">Cancel</a>

</form>
