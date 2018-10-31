<?php

require_once "pdo.php";

session_start();


if ( isset($_POST['description']) && isset($_POST['type'])
 && isset($_POST['amount']) && isset($_POST['acc_id'])) 
{

    // Data validation
 
   if ( strlen($_POST['type']) < 1 || strlen($_POST['acc_id']) < 1 || strlen($_POST['amount'])<1)
     {

        $_SESSION['error'] = 'Missing data';
 
       header("Location: add_transaction.php");

       return;

     }







      $sql = "INSERT INTO transaction_info (description,type,amount,acc_id)

            VALUES (:description, :type, :amount, :acc_id)";

      $sql2 = "update account
		set account.curr_balance = account.curr_balance-:amount
		where account.acc_id = :acc_id";	 
    $stmt = $pdo->prepare($sql);

    $stmt2=$pdo->prepare($sql2);
    $stmt2->execute(array(':amount' => $_POST['amount'], ':acc_id' => $_POST['acc_id']));
    $stmt->execute(array(
 ':description' => $_POST['description'], ':type' => $_POST['type'],
':amount' => $_POST['amount'],':acc_id' => $_POST['acc_id']));
    $_SESSION['success'] = 'Record Added';

    header( 'Location: index_transaction.php' ) ;

    return;

}

// Flash pattern



if ( isset($_SESSION['error']) )
    {
    echo '<p style="color:red">'.$_SESSION['error']."</p>\n";

    unset($_SESSION['error']);
}
?>

<p>Add A New Transaction</p>

<form method="post">

<p>Description:
<input type="text" name="description"></p>

<p>Type:
<input type="text" name="type"></p>

<p>AccId:<input type="number" name = "acc_id"></p>
<p>Amount:<input type="number" name = "amount"></p>
<p><input type="submit" value="Add New"/>

<a href="../start.php">Cancel</a>
</p>

</form>
