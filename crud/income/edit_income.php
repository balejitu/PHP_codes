<?php

require_once "pdo.php";

session_start();


if ( isset($_POST['description']) && isset($_POST['type']) && isset($_POST['amount']) && isset($_POST['acc_id']) && isset($_POST['trans_id']) )
 {

  
  // Data validation


	
    if ( strlen($_POST['type']) < 1 || strlen($_POST['description']) < 1 || strlen($_POST['acc_id'])<1 )
	 {
 
		$_SESSION['error'] = 'Missing data';
	
        header("Location: edit_transaction.php?trans_id=".$_POST['trans_id']);

                return;

         }


    $sql2 = "update account

              set account.curr_balance  = account.curr_balance + :amount
               where account.acc_id = :acc_id";
    $stmt2=$pdo->prepare($sql2);
    $stmt2->execute(array(':amount' => $_POST['amount'], ':acc_id' => $_POST['acc_id']));
	echo("ghhg");
      $sql = "UPDATE transaction_info SET description = :description, type = :type, acc_id = :acc_id, amount = :amount WHERE trans_id = :trans_id";


	

    $stmt = $pdo->prepare($sql);

    $stmt->execute(array(
 ':description' => $_POST['description'],

		          ':type' => $_POST['type'],
			  ':amount' => $_POST['amount'],
			  ':acc_id' => $_POST['acc_id'],
                          ':trans_id' => $_POST['trans_id']));

$sql3 = "update account

              set account.curr_balance  = account.curr_balance - :amount
              where account.acc_id = :acc_id";
   $stmt3=$pdo->prepare($sql3);
    $stmt3->execute(array(':amount' => $_POST['amount'], ':acc_id' => $_POST['acc_id']));
				

    $_SESSION['success'] = 'Record updated';

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



$stmt = $pdo->prepare("SELECT * FROM transaction_info where trans_id = :xyz");

$stmt->execute(array(":xyz" => $_GET['trans_id']));

$row = $stmt->fetch(PDO::FETCH_ASSOC);

if ( $row === false ) 
{

    $_SESSION['error'] = 'Bad value for trans_id';

    header( 'Location: index_transaction.php' ) ;

    return;


}

// Flash pattern

if ( isset($_SESSION['error']) )
{
   
    echo '<p style="color:red">'.$_SESSION['error']."</p>\n";

    unset($_SESSION['error']);

}


$n = htmlentities($row['description']);

$e = htmlentities($row['type']);

$p = htmlentities($row['acc_id']);

$c = htmlentities($row['amount']);
$trans_id = $row['trans_id'];
?>

<p>Edit Transaction</p>

<form method="post">


<p>Description:
<input type="text" name="description" value="<?= $n ?>"></p>

<p>Type:
<input type="text" name="type" value="<?= $e ?>"></p>

<p>AccId:
<input type="text" name="acc_id" value="<?= $p ?>"></p>

<p>Amount:<input type="text" name="amount" value="<?=$c ?>"></p>
<input type="hidden" name="trans_id" value="<?= $trans_id ?>">

<p><input type="submit" value="Update"/>

<a href="index_transaction.php">Cancel</a>
</p>

</form>
