<?php

require_once "pdo.php";

session_start();


if ( isset($_POST['acc_name']) && isset($_POST['acc_type']) && isset($_POST['user_id'])  && isset($_POST['acc_id']))
 {

  
  // Data validation


	
    if ( strlen($_POST['acc_name']) < 1 || strlen($_POST['acc_type']) < 1 )
	 {
 
		$_SESSION['error'] = 'Missing data';
	        header("Location: edit_account_info.php?acc_id=".$_POST['acc_id']);

                return;

         }


 

    $sql = "UPDATE account SET acc_name = :acc_name, acc_type = :acc_type, user_id = :user_id  WHERE acc_id = :acc_id";


	

    $stmt = $pdo->prepare($sql);

    $stmt->execute(array(
 ':acc_name' => $_POST['acc_name'],

		          ':acc_type' => $_POST['acc_type'],
			  ':user_id' => $_POST['user_id'],
                          ':acc_id' => $_POST['acc_id']));
				

    $_SESSION['success'] = 'Record updated';

    header( 'Location: index_account_info.php' ) ;

    return;

}


// Guardian: Make sure that acc_id is present

if ( ! isset($_GET['acc_id']) ) 
{

  $_SESSION['error'] = "Missing acc_id";

  header('Location: index_account_info.php');

  return;

}



$stmt = $pdo->prepare("SELECT * FROM account where acc_id = :xyz");

$stmt->execute(array(":xyz" => $_GET['acc_id']));

$row = $stmt->fetch(PDO::FETCH_ASSOC);

if ( $row === false ) 
{

    $_SESSION['error'] = 'Bad value for acc_id';

    header( 'Location: index_account_info.php' ) ;

    return;


}

// Flash pattern

if ( isset($_SESSION['error']) )
{
   
    echo '<p style="color:red">'.$_SESSION['error']."</p>\n";

    unset($_SESSION['error']);

}


$n = htmlentities($row['acc_name']);

$e = htmlentities($row['acc_type']);

$p = htmlentities($row['user_id']);

$acc_id = $row['acc_id'];

?>

<p>Edit Account</p>

<form method="post">

<p>AccName:
<input type="text" name="acc_name" value="<?= $n ?>"></p>

<p>AccType:
<input type="text" name="acc_type" value="<?= $e ?>"></p>

<p>User_id:
<input type="text" name="user_id" value="<?= $p ?>"></p>
<input type="hidden" name="acc_id" value="<?= $acc_id ?>">
<p><input type="submit" value="Update"/>

<a href="index_account_info.php">Cancel</a>
</p>

</form>
